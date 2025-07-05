<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use App\Models\BusinessTask;
use App\Mail\TaskReminderMail;
use Illuminate\Support\Facades\Mail;
use App\Models\BusinessEmailLog;
class SendTaskReminderEmails extends Command
{
     protected $signature = 'emails:send-task-reminders';

    // Optionally, add a description
    protected $description = 'Send reminder emails for upcoming business tasks';
  public function handle()
{
    $daysToNotify = [15, 7, 3, 1];
    $today = now();

    foreach ($daysToNotify as $daysLeft) {
        $targetDate = $today->copy()->addDays($daysLeft)->toDateString();

        $tasks = BusinessTask::whereDate('due_date', $targetDate)->with('clients')->get();

        foreach ($tasks as $task) {
            foreach ($task->clients as $client) {
                $alreadySent = BusinessEmailLog::where([
                    'user_id' => $client->id,
                    'related_type' => BusinessTask::class,
                    'related_id' => $task->id,
                    'email_type' => 'reminder_' . $daysLeft
                ])->exists();

                if (!$alreadySent) {
                    Mail::to($client->email)->send(new TaskReminderMail($task, $daysLeft));

                    BusinessEmailLog::create([
                        'user_id' => $client->id,
                        'related_type' => BusinessTask::class,
                        'related_id' => $task->id,
                        'email_type' => 'reminder_' . $daysLeft,
                        'sent_at' => now(),
                    ]);
                }
            }
        }
    }
}
}
