<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\BusinessProject;
use App\Models\BusinessClient;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables; 
use App\Models\ContactHistory;
use Illuminate\Support\Facades\Auth;
use App\Models\BusinessCredit;
use App\Services\BusinessCreditService;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $query = BusinessProject::with('client')->latest();

        // Search by project title
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Filter by status
        if ($request->filled('status_id')) {
            $query->where('status_id', $request->status_id);
        }

        // Filter by client
        if ($request->filled('client_id')) {
            $query->where('client_id', $request->client_id);
        }

        // Filter by exact project title
        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        $projects = $query->paginate(10);
        $clients = BusinessClient::orderBy('first_name')->get();

        return view('default.panel.business.projects.index', compact('projects', 'clients'));
    }
    public function create()
    {
        $clients = BusinessClient::all();
        return view('default.panel.business.projects.create', compact('clients'));
    }

    public function edit(BusinessProject $project)
    {
        $clients = BusinessClient::all();
        return view('default.panel.business.projects.create', compact('project', 'clients'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'starting_date' => 'required|date',
            'ending_date' => 'required|date',
            'budget' => 'required|numeric',
            'status_id' => 'required|in:1,2,3',
            'user_id' => 'required|array',
            'user_id.*' => 'exists:business_clients,id',
            'client_id' => 'required|exists:business_clients,id',
        ]);
    
        // Check and consume project credit
        $user = auth()->user();
        if (!BusinessCreditService::hasCredits($user, 'projects')) {
            return redirect()->back()->with(['type' => 'error', 'message' => 'You have no project credits left. Please upgrade your plan.']);
        }
        
        if (!BusinessCreditService::consumeCredits($user, 'projects')) {
            return redirect()->back()->with(['type' => 'error', 'message' => 'Failed to consume project credit. Please try again.']);
        }

        // Create project without user_id
        $project = BusinessProject::create($validated);
    
        // Attach users using the pivot table
        if (!empty($validated['user_id'])) {
            $project->users()->attach($validated['user_id']);
        }
        
        
        ContactHistory::create([
            'user_id' => Auth::id(),
            'action_type' => 'project_create',
            'reference_id' => $project->id,
            'reference_type' => 'BusinessProject',
            'description' => 'Created project: ' . $project->title,
        ]);
    
        return redirect()->route('dashboard.business.projects.index')
               ->with(['type' => 'success', 'message' => 'Project created successfully']);
    }
    public function update(Request $request, BusinessProject $project)
    {
        $validated = $request->validate([
             'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'starting_date' => 'nullable|date',
            'ending_date' => 'nullable|date',
            'budget' => 'nullable|numeric',
            'status_id' => 'required|in:1,2,3',
            'user_id' => 'nullable|array',
            'user_id.*' => 'exists:business_clients,id',
            'client_id' => 'nullable|exists:business_clients,id',
        ]);
    
        $project->update($validated);
    
        // Sync users using the pivot table
        $project->users()->sync($request->user_id ?? []);
        
      ContactHistory::create([
        'user_id' => Auth::id(),
        'action_type' => 'project_update',
        'reference_id' => $project->id,
        'reference_type' => 'BusinessProject',
        'description' => 'Updated project: ' . $project->title,
    ]);
    
        return redirect()->route('dashboard.business.projects.index')
               ->with(['type' => 'success', 'message' => 'Project updated successfully']);
    }
    public function destroy(BusinessProject $project)
    {
        // We don't return credits when items are deleted
        // No need to check or manipulate credits here

        ContactHistory::create([
            'user_id' => Auth::id(),
            'action_type' => 'project_delete',
            'reference_id' => $project->id,
            'reference_type' => 'BusinessProject',
            'description' => 'Deleted project: ' . $project->title,
        ]);
        
        $project->delete();
        return redirect()->route('dashboard.business.projects.index')->with(['type' => 'success', 'message' => 'Project deleted successfully']);
    }
    public function bulkdelete(Request $request)
    {
        // We don't return credits when items are deleted
        // No need to check or manipulate credits here
        $ids = $request->input('ids');
        BusinessProject::whereIn('id', $ids)->delete();
    
        return response()->json(['success' => true]);
    }
    public function getProjectdata(Request $request)
    {
        try {
            // Add user filtering to only show projects for the current user
            $user = auth()->user();
            $query = BusinessProject::with('client')
                ->latest();
            
            // Add filtering based on request parameters
            if ($request->filled('title')) {
                $query->where('title', 'like', '%' . $request->title . '%');
            }
            
            if ($request->filled('status')) {
                $query->where('status_id', $request->status);
            }
            
            if ($request->filled('client')) {
                $query->where('client_id', $request->client);
            }
         
            return DataTables::of($query)
                ->addColumn('checkbox', function ($row) {
                    return ''; // JS will handle checkbox rendering
                })
                ->addColumn('client_name', function ($row) {
                    return $row->client ? $row->client->first_name . ' ' . $row->client->last_name : '—';
                })
                ->addColumn('status_id', function ($row) {
                    $statuses = [
                        1 => 'Not Started',
                        2 => 'On Going', 
                        3 => 'Finished'
                    ];
                    return $statuses[$row->status_id] ?? 'Unknown';
                })
                ->addColumn('actions', function ($row) {
                    return ''; // JS renders action buttons
                })
                ->rawColumns(['checkbox', 'actions']) // Allow HTML in these columns
                ->make(true);
        } catch (\Exception $e) {
            \Log::error('Project DataTable Error: ' . $e->getMessage());
            return response()->json([
                'error' => true,
                'message' => 'Error loading projects: ' . $e->getMessage()
            ], 500);
        }
    }

}
