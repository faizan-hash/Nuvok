<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TaskAssignedNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $task;
    public $client;

    public function __construct($task, $client)
    {
        $this->task = $task;
        $this->client = $client;
    }

    public function build()
    {
        return $this->subject('New Task Assigned: ' . $this->task->title)
                   ->view('default.panel.business.task.task_assigned');
    }
}