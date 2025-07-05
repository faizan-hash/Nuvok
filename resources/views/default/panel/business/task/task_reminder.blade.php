<<<<<<< HEAD
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Reminder</title>
</head>
<body>
<h2>Task Reminder</h2>
<p>Dear Client,</p>

<p>This is a reminder that the task <strong>{{ $task->title }}</strong> is due in <strong>{{ $daysLeft }} day(s)</strong>.</p>

<p>Due Date: {{ \Carbon\Carbon::parse($task->due_date)->format('F j, Y') }}</p>

<p>Please ensure it is completed on time.</p>

<p>Thank you,<br>Your Company</p>
<p>If you have any questions, feel free to reach out.</p>
<p>Best regards,<br>Your Company</p>
</body>
=======
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Reminder</title>
</head>
<body>
<h2>Task Reminder</h2>
<p>Dear Client,</p>

<p>This is a reminder that the task <strong>{{ $task->title }}</strong> is due in <strong>{{ $daysLeft }} day(s)</strong>.</p>

<p>Due Date: {{ \Carbon\Carbon::parse($task->due_date)->format('F j, Y') }}</p>

<p>Please ensure it is completed on time.</p>

<p>Thank you,<br>Your Company</p>
<p>If you have any questions, feel free to reach out.</p>
<p>Best regards,<br>Your Company</p>
</body>
>>>>>>> f4799b86f474e344473c5131907406fc349bf0dc
</html>