<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\BusinessTask;

class TaskReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $task;
    public $daysLeft;

    /**
     * Create a new message instance.
     *
     * @param  \App\Models\BusinessTask  $task
     * @param  int  $daysLeft
     * @return void
     */
    public function __construct(BusinessTask $task, int $daysLeft)
    {
        $this->task = $task;
        $this->daysLeft = $daysLeft;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Reminder: Task Due in {$this->daysLeft} Days")
                    ->view('default.panel.business.task.task_reminder', [
                        'task' => $this->task,
                        'daysLeft' => $this->daysLeft,
                    ]);
    }
}
