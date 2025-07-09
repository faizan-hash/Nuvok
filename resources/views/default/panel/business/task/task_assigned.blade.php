<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Task Assigned</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #4f46e5;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .content {
            padding: 20px;
            border: 1px solid #e5e7eb;
            border-top: none;
            border-radius: 0 0 8px 8px;
        }
        .task-details {
            background-color: #f9fafb;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
        }
        .detail-row {
            margin-bottom: 10px;
            display: flex;
        }
        .detail-label {
            font-weight: 600;
            width: 120px;
            color: #6b7280;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4f46e5;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 500;
        }
        .footer {
            margin-top: 30px;
            font-size: 14px;
            color: #6b7280;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>New Task Assigned</h1>
    </div>
    
    <div class="content">
        <p>Hello {{ $client->first_name }},</p>
        <p>You have been assigned a new task:</p>
        
        <div class="task-details">
            <div class="detail-row">
                <span class="detail-label">Task Title:</span>
                <span>{{ $task->title }}</span>
            </div>
            @if($task->description)
            <div class="detail-row">
                <span class="detail-label">Description:</span>
                <span>{{ $task->description }}</span>
            </div>
            @endif
            @if($task->project)
            <div class="detail-row">
                <span class="detail-label">Project:</span>
                <span>{{ $task->project->title }}</span>
            </div>
            @endif
            <div class="detail-row">
                <span class="detail-label">Priority:</span>
                <span style="color: {{ $task->priority->color ?? '#000' }};">
                    {{ $task->priority->title }}
                </span>
            </div>
            @if($task->starting_date)
            <div class="detail-row">
                <span class="detail-label">Start Date:</span>
                <span>{{ $task->starting_date->format('M d, Y') }}</span>
            </div>
            @endif
            @if($task->due_date)
            <div class="detail-row">
                <span class="detail-label">Due Date:</span>
                <span>{{ $task->due_date->format('M d, Y') }}</span>
            </div>
            @endif
        </div>    
        <div class="footer">
            <p>This is an automated notification. Please do not reply to this email.</p>
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </div>
</body>
</html>