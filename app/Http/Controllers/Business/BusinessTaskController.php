<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\BusinessTask;
use App\Models\BusinessStatus;
use App\Models\BusinessClient;
use App\Models\BusinessProject;
use App\Models\BusinessJobType;
use App\Models\BusinessPriority;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str; 
use App\Mail\TaskAssignedNotification; // Add this for the Mailable class
use App\Http\Controllers\Business\SmsTwilioController; // Corrected casing for SMS Controller
use App\Models\ContactHistory;
use Illuminate\Support\Facades\Auth;
use App\Models\BusinessTaskComment;
use App\Models\BusinessTaskAttachmentFile;
use Illuminate\Support\Facades\Storage;
use App\Models\BusinessCredit;
use App\Services\BusinessCreditService;

class BusinessTaskController extends Controller
{
    public function index()
    {
        $projects = BusinessProject::all();  
       
        $clients = BusinessClient::all();    
        $priorities = BusinessPriority::all(); 
        $tasks = BusinessTask::with(['priority', 'status', 'project', 'clients'])
            ->when(request('project_id'), fn($q) => $q->where('project_id', request('project_id')))
            ->when(request('client_id'), fn($q) => $q->where('client_id', request('client_id')))
            ->when(request('priority_id'), fn($q) => $q->where('priority_id', request('priority_id')))
            ->when(request('status_id'), fn($q) => $q->where('status_id', request('status_id')))
            ->when(request('date_from'), fn($q) => $q->whereDate('due_date', '>=', request('date_from')))
            ->when(request('date_to'), fn($q) => $q->whereDate('due_date', '<=', request('date_to')))
            ->when(request('search'), fn($q) => $q->where(function ($query) {
                $query->where('title', 'like', '%' . request('search') . '%')
                      ->orWhere('description', 'like', '%' . request('search') . '%');
            }))
            ->get();
        $statuses = BusinessStatus::all();   
        return view('default.panel.business.task.index', compact('tasks', 'statuses', 'projects', 'clients', 'priorities'));        
    }

    public function create()
    {
        $priorities = BusinessPriority::all();
        $statuses = BusinessStatus::all();
        $clients = BusinessClient::all();
        $projects = BusinessProject::all();
         $jobTypes = BusinessJobType::all();  
        return view('default.panel.business.task.create', compact('priorities', 'statuses', 'clients', 'projects','jobTypes'));
    }



public function store(Request $request)
{
   // Define validation rules
   $validated = $request->validate([
    'title' => 'required|string|max:255',
    'description' => 'required|string',
    'project_id' => 'required|exists:business_projects,id',
    'starting_date' => 'required|date',
    'due_date' => 'required|date|after_or_equal:starting_date',
    'priority_id' => 'required|exists:business_priorities,id',
    'status_id' => 'required|exists:business_statuses,id',
    'job_type_id' => 'required|exists:business_jobs_checklist,id',
    'assigned_clients' => 'required|array',
    'assigned_clients.*' => 'exists:business_clients,id',
    'initial_task_image' => 'required|image|max:2048',
], [
    'status_id.required' => 'The status field is required.',
    'status_id.exists' => 'The selected status is invalid.',

    // (optional) More custom messages:
    'title.required' => 'The title field is required.',
    'project_id.required' => 'The project field is required.',
    'job_type_id.required' => 'The job type field is required.',
    'priority_id.required' => 'The priority field is required.',
    'assigned_clients.required' => 'You must assign at least one client.',
    'initial_task_image.required' => 'An image must be uploaded.',
]);

    
    // Extract only the validated data needed for processing
    $data = $request->only([
        'title',
        'description',
        'project_id',
        'starting_date',
        'due_date',
        'priority_id',
        'status_id',
        'job_type_id',
    ]);

    if ($request->hasFile('initial_task_image')) {
        $file = $request->file('initial_task_image');
        $imageName = time() . '.' . $file->getClientOriginalExtension();

        $destinationPath = public_path('before/initial_task_image');
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        $file->move($destinationPath, $imageName);
        $data['initial_task_image'] = 'before/initial_task_image/' . $imageName;
    }

    try {
        // Check and consume task credit
        $user = auth()->user();
        if (!BusinessCreditService::hasCredits($user, 'tasks')) {
            return redirect()->back()->with(['type' => 'error', 'message' => 'You have no task credits left. Please upgrade your plan.']);
        }
        
        if (!BusinessCreditService::consumeCredits($user, 'tasks')) {
            return redirect()->back()->with(['type' => 'error', 'message' => 'Failed to consume task credit. Please try again.']);
        }

        $task = BusinessTask::create($data);

        $task = BusinessTask::with(['priority', 'project', 'status'])->find($task->id);

        if ($request->has('assigned_clients')) {
            $task->clients()->sync($request->assigned_clients);

            $clients = BusinessClient::whereIn('id', $request->assigned_clients)->get();
            foreach ($clients as $client) {
                $message = $this->generateTaskCreationNotificationMessage($task, $client);

                // Always send SMS if client has a mobile number
                if ($client->mobile) {
                    try {
                        app(\App\Http\Controllers\Business\SmsTwilioController::class)
                            ->sendCustomSms($client->mobile, $message);
                    } catch (\Exception $e) {
                        Log::error("SMS failed for client {$client->id}: " . $e->getMessage());
                    }
                }
                // Keep email sending as it was, still dependent on 'send_notification' if it is desired to be controlled
                if ($request->boolean('send_notification')) {
                    try {
                        Mail::to($client->email)->send(
                            new TaskAssignedNotification($task, $client)
                        );
                    } catch (\Exception $e) {
                        Log::error("Email failed for client {$client->id}: " . $e->getMessage());
                    }
                }
            }
        }
        
        ContactHistory::create([
            'user_id' => Auth::id(),
            'action_type' => 'task_create',
            'reference_id' => $task->id,
            'reference_type' => 'BusinessTask',
            'description' => 'Created task: ' . $task->title,
        ]);

        return redirect()->route('dashboard.business.task.index')->with(['type' => 'success', 'message' => 'Task created successfully.']);
    } catch (\Exception $e) {
        Log::error('Task creation failed: ' . $e->getMessage(), [
            'user_id' => auth()->id(),
            'input_data' => $data,
        ]);

        return back()->with(['type' => 'error', 'message' => 'Failed to create task. Please check logs.']);
    }
}

    // public function store(Request $request)
    // {
    //   $request->validate([
    //         'title' => 'required|string|max:255',
    //         'description' => 'nullable|string',
    //         'starting_date' => 'nullable|date',
    //         'due_date' => 'nullable|date|after_or_equal:starting_date',
    //         'priority_id' => 'required|exists:business_priorities,id',
    //         'status_id' => 'required|exists:business_statuses,id',
    //         'project_id' => 'nullable|exists:business_projects,id',
    //         'assigned_clients' => 'nullable|array',
    //         'assigned_clients.*' => 'exists:business_clients,id',
    //         'initial_task_image' => 'required|image|max:2048',
    //     ]);
        
    //     $data = $request->only([
    //         'project_id',
    //         'title',
    //         'description',
    //         'starting_date',
    //         'due_date',
    //         'priority_id',
    //         'status_id',
    //     ]);
        
    //     if ($request->hasFile('initial_task_image')) {
    //         $file = $request->file('initial_task_image');
    //         $imageName = time() . '.' . $file->getClientOriginalExtension();
        
    //         $destinationPath = public_path('before/initial_task_image');
    //         if (!file_exists($destinationPath)) {
    //             mkdir($destinationPath, 0755, true);
    //         }
        
    //         $file->move($destinationPath, $imageName);
    //         $data['initial_task_image'] = 'before/initial_task_image/' . $imageName;
    //     }
        
    //     $task = BusinessTask::create($data);

    //     // Decrement task credit
    //     auth()->user()->businessCredits->decrement('tasks');

    //     $task = BusinessTask::with(['priority', 'project', 'status'])->find($task->id);
    //     if ($request->has('assigned_clients')) {
    //         $task->clients()->sync($request->assigned_clients);
    //     }
        
    //   if ($request->boolean('send_notification') && $request->has('assigned_clients')) {
    //     $clients = BusinessClient::whereIn('id', $request->assigned_clients)->get();
    //     $notificationType = $request->input('notification_type', 'sms');
    //     foreach ($clients as $client) {
    //         $message = $this->generateTaskNotificationMessage($task, $client);
    //         // Send SMS
    //         if (in_array($notificationType, ['sms', 'both']) && $client->mobile) {
    //             try {
    //                 app(\App\Http\Controllers\business\SmsTwilioController::class)
    //                     ->sendCustomSms($client->mobile, $message);
    //             } catch (\Exception $e) {
    //                 \Log::error("SMS failed for client {$client->id}: " . $e->getMessage());
    //             }
    //         }

    //         // Send Email
    //             try {
    //                 Mail::to($client->email)->send(
    //                     new TaskAssignedNotification($task, $client)
    //                 );
    //             } catch (\Exception $e) {
    //                 \Log::error("Email failed for client {$client->id}: " . $e->getMessage());
    //             }
    //     }
    // }
            
    //     return redirect()->route('dashboard.business.task.index')->with('success', 'Task created successfully.');
    // }
    public function uploadCompletionImage(Request $request, \App\Models\BusinessTask $task)
    {
        try {
            \Log::info('Request received', ['task_id' => $task->id]);
    
            $request->validate([
                'completed_task_image' => 'required|image|max:2048',
            ]);
    
            if ($request->hasFile('completed_task_image')) {
                $file = $request->file('completed_task_image');
                $imageName = time() . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path('after/completed_task_image');
    
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }
    
                $file->move($destinationPath, $imageName);
    
                $task->completed_task_image = 'after/completed_task_image/' . $imageName;
                $task->save();
    
                return response()->json(['success' => true]);
            }
    
            return response()->json(['success' => false, 'message' => 'No image found.']);
    
        } catch (\Exception $e) {
            \Log::error('Upload image error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Server error'], 500);
        }
    }

    protected function generateTaskCreationNotificationMessage($task, $client)
    {
        return sprintf(
            "Hello %s,\nYou have been assigned a new task: %s\nDue Date: %s\nPriority: %s\nDescription: %s",
            $client->first_name,
            $task->title,
            $task->due_date ? $task->due_date->format('M d, Y') : 'Not specified',
            $task->priority->title, // Assuming priority relationship exists
            $task->description ? Str::limit($task->description, 100) : 'No description'
        );
    }

    protected function generateTaskCompletionNotificationMessage($task, $client)
    {
        return sprintf(
            "Hello %s,\nTask \'%s\' has been completed.\nThank you!",
            $client->first_name,
            $task->title
        );
    }
    public function show(BusinessTask $task)
    {
       $task->load(['priority', 'status', 'project', 'clients', 'comments.client', 'comments.user', 'attachments', 'timers']);
        return view('default.panel.business.task.show', compact('task'));
    }
    
    public function storeComment(Request $request, BusinessTask $task)
    {
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);
        $comment = $task->comments()->create([
            'user_id' => auth()->id(),
            'comment' => $request->comment,
        ]);

        return response()->json([
            'success' => true,
            'comment' => $comment->load('user'),
            'message' => 'Comment added successfully'
        ]);
    }

    /**
     * Delete a comment
     */
    public function destroyComment(\App\Models\BusinessTaskComment $comment)
    {
        // Authorization check - ensure user owns the comment
        if ($comment->user_id !== auth()->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $comment->delete();

        return response()->json([
            'success' => true,
            'message' => 'Comment deleted successfully'
        ]);
    }

    /**
     * Store a new attachment for the task
     */
    public function storeAttachment(Request $request, BusinessTask $task)
    {
        $request->validate([
            'attachment' => 'required|file|max:10240', // 10MB max
        ]);

        $file = $request->file('attachment');
        $path = $file->store('task_attachments', 'public');
        
        $attachment = $task->attachments()->create([
            'file_name' => $file->getClientOriginalName(),
            'file_path' => $path,
            'mime_type' => $file->getMimeType(),
            'file_size' => $file->getSize(),
            'user_id' => auth()->id(),
        ]);

        return response()->json([
            'success' => true,
            'attachment' => $attachment,
            'file_url' => asset('storage/'.$path),
            'message' => 'File uploaded successfully'
        ]);
    }

    /**
     * Delete an attachment
     */
    public function destroyAttachment(\App\Models\BusinessTaskAttachmentFile $attachment)
    {
        // Authorization check
        if ($attachment->user_id !== auth()->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        Storage::disk('public')->delete($attachment->file_path);
        $attachment->delete();

        return response()->json([
            'success' => true,
            'message' => 'Attachment deleted successfully'
        ]);
    }

    /**
     * Start a new timer for the task
     */
    public function startTimer(Request $request, BusinessTask $task)
    {
        // Check if there's already an active timer
        $activeTimer = $task->timers()->whereNull('ended_at')->first();
        
        if ($activeTimer) {
            return response()->json([
                'success' => false,
                'error' => 'Timer already running'
            ], 400);
        }

        $timer = $task->timers()->create([
            'user_id' => auth()->id(),
            'start_time' => now(), 
            'started_at' => now(),
        ]);
        

        return response()->json([
            'success' => true,
            'timer' => $timer,
            'message' => 'Timer started successfully'
        ]);
    }

    /**
     * Stop the active timer
     */
    public function stopTimer(Request $request, BusinessTask $task)
    {
        $timer = $task->timers()->whereNull('ended_at')->first();
        
        if (!$timer) {
            return response()->json([
                'success' => false,
                'error' => 'No active timer found'
            ], 400);
        }

        $timer->update([
            'ended_at' => now(),
            'duration' => $timer->started_at->diffInSeconds(now()),
        ]);

        return response()->json([
            'success' => true,
            'timer' => $timer,
            'message' => 'Timer stopped successfully'
        ]);
    }

    /**
     * Check for active timer
     */
    public function activeTimer(BusinessTask $task)
    {
        $timer = $task->timers()
            ->whereNull('ended_at')
            ->first();

        return response()->json([
            'active' => $timer ? true : false,
            'start_time'  => $timer,
            'started_at' => $timer ? $timer->started_at : null,
        ]);
    }

    public function edit(BusinessTask $task)
    {
        $priorities = BusinessPriority::all();
        $statuses = BusinessStatus::all();
        $clients = BusinessClient::all();
        $projects = BusinessProject::all();
        $jobTypes = BusinessJobType::all();  
        $assignedClients = $task->clients->pluck('id')->toArray();
        
        return view('default.panel.business.task.create', compact(
            'task', 
            'priorities', 
            'statuses', 
            'clients', 
            'projects',
            'assignedClients',
            'jobTypes'
        ));
    }

   public function update(Request $request, BusinessTask $task)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'starting_date' => 'nullable|date',
        'due_date' => 'nullable|date|after_or_equal:starting_date',
        'priority_id' => 'required|exists:business_priorities,id',
        'status_id' => 'required|exists:business_statuses,id',
        'project_id' => 'nullable|exists:business_projects,id',
        'assigned_clients' => 'nullable|array',
        'assigned_clients.*' => 'exists:business_clients,id',
        'job_type_id' => 'required|exists:business_jobs_checklist,id', // Required on update too
        'initial_task_image' => 'nullable|image|max:2048', // Optional on update
    ]);

    $data = $request->only([
        'project_id',
        'title',
        'description',
        'starting_date',
        'due_date',
        'priority_id',
        'status_id',
        'job_type_id',
    ]);

    // Handle image upload if present
    if ($request->hasFile('initial_task_image')) {
        $file = $request->file('initial_task_image');
        $imageName = time() . '.' . $file->getClientOriginalExtension();

        $destinationPath = public_path('before/initial_task_image');
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        $file->move($destinationPath, $imageName);
        $data['initial_task_image'] = 'before/initial_task_image/' . $imageName;

        // Optional: You might want to delete old image file if exists
        if ($task->initial_task_image && file_exists(public_path($task->initial_task_image))) {
            @unlink(public_path($task->initial_task_image));
        }
    }

    try {
        $task->update($data);

        if ($request->has('assigned_clients')) {
            $task->clients()->sync($request->assigned_clients);
        } else {
            $task->clients()->detach();
        }

        if ($request->boolean('send_notification') && $request->has('assigned_clients')) {
            $clients = BusinessClient::whereIn('id', $request->assigned_clients)->get();
            $notificationType = $request->input('notification_type', 'sms');

            foreach ($clients as $client) {
                $message = $this->generateTaskCreationNotificationMessage($task, $client);

                if (in_array($notificationType, ['sms', 'both']) && $client->mobile) {
                    try {
                        app(\App\Http\Controllers\Business\SmsTwilioController::class)
                            ->sendCustomSms($client->mobile, $message);
                    } catch (\Exception $e) {
                        Log::error("SMS failed for client {$client->id}: " . $e->getMessage());
                    }
                }

                try {
                    Mail::to($client->email)->send(
                        new TaskAssignedNotification($task, $client)
                    );
                } catch (\Exception $e) {
                    Log::error("Email failed for client {$client->id}: " . $e->getMessage());
                }
            }
        }
        
        ContactHistory::create([
            'user_id' => Auth::id(),
            'action_type' => 'task_update',
            'reference_id' => $task->id,
            'reference_type' => 'BusinessTask',
            'description' => 'Updated task: ' . $task->title,
        ]);


        return redirect()->route('dashboard.business.task.index')->with(['type' => 'success', 'message' => 'Task updated successfully.']);
    } catch (\Exception $e) {
        Log::error('Task update failed: ' . $e->getMessage(), [
            'user_id' => auth()->id(),
            'task_id' => $task->id,
            'input_data' => $data,
        ]);

        return back()->with(['type' => 'error', 'message' => 'Failed to update task. Please check logs.']);
    }
}


    public function destroy(BusinessTask $task)
    {
        // We don't return credits when items are deleted
        // No need to check or manipulate credits here

        ContactHistory::create([
            'user_id' => Auth::id(),
            'action_type' => 'task_delete',
            'reference_id' => $task->id,
            'reference_type' => 'BusinessTask',
            'description' => 'Deleted task: ' . $task->title,
        ]);
        
        $task->clients()->detach();
        $task->delete();
        
        return redirect()->route('dashboard.business.task.index')->with(['type' => 'success', 'message' => 'Task deleted successfully.']);
    }
    public function updateStatus(Request $request)
    {
        $request->validate([
            'task_id' => 'required|exists:business_tasks,id',
            'status_id' => 'required|exists:business_statuses,id',
        ]);
    
        $task = BusinessTask::find($request->task_id);
        $oldStatusId = $task->status_id; // Store old status ID
        $newStatusId = $request->status_id; // Get new status ID

        $task->update([
            'status_id' => $newStatusId,
        ]);

        $completedStatus = \App\Models\BusinessStatus::where('title', 'Completed')->first();

        // If the task is moved to 'Completed' status
        if ($completedStatus && $newStatusId == $completedStatus->id) {
            $task->load(['priority', 'status', 'project', 'clients']); // Eager load relationships
            $clients = $task->clients;

            foreach ($clients as $client) {
                $message = $this->generateTaskCompletionNotificationMessage($task, $client);
                if ($client->mobile) {
                    try {
                        app(\App\Http\Controllers\Business\SmsTwilioController::class)
                            ->sendCustomSms($client->mobile, $message);
                    } catch (\Exception $e) {
                        Log::error("SMS failed for client {$client->id} on task completion: " . $e->getMessage());
                    }
                }
            }
        }
    
        return response()->json([
            'success' => true,
            'message' => 'Task status updated successfully.',
            'data' => $task,
        ]);
    }
    

}