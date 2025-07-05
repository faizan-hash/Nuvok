@extends('panel.layout.settings', ['layout' => 'fullwidth'])

@section('title', __('Task Details'))
@section('titlebar_actions')
    <a href="{{ route('dashboard.business.task.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg transition duration-200 ease-in-out">
        <i class="fas fa-arrow-left mr-2"></i> {{ __('Back to Tasks') }}
    </a>
@endsection

@section('additional_css')
 <link href="{{ asset('bussiness/custom.css') }}" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    .avatar {
        @apply flex items-center justify-center rounded-full w-10 h-10 text-white font-semibold text-sm;
    }
    .comment-user-avatar {
        @apply flex items-center justify-center rounded-full w-8 h-8 text-white font-semibold text-xs mr-2;
    }
    .tab-btn.active {
        @apply border-b-2 border-blue-500 text-blue-600;
    }
    .timer-display {
        font-family: 'Courier New', monospace;
    }
    .attachment-icon {
        @apply flex items-center justify-center w-12 h-12 rounded-lg bg-gray-100 text-gray-500 mr-3;
    }
    .priority-high {
        @apply bg-red-100 text-red-800;
    }
    .priority-medium {
        @apply bg-yellow-100 text-yellow-800;
    }
    .priority-low {
        @apply bg-green-100 text-green-800;
    }
</style>
@endsection

@section('settings')
<div class="max-w-6xl mx-auto px-4 py-6 sm:px-6 lg:px-8 font-sans">
    <!-- Task Header Section -->
    <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4">
            <h1 class="text-2xl font-bold text-gray-800">{{ $task->title }}</h1>
            <div class="mt-2 md:mt-0">
                @php
                    $priorityClass = 'priority-medium';
                    if(isset($task->priority)) {
                        if(strtolower($task->priority->title) === 'high') $priorityClass = 'priority-high';
                        elseif(strtolower($task->priority->title) === 'low') $priorityClass = 'priority-low';
                    }
                @endphp
                <span class="px-3 py-1 rounded-full text-xs font-medium {{ $priorityClass }}">
                    {{ $task->priority->title ?? 'N/A' }}
                </span>
                <span class="ml-2 px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-medium">
                    {{ $task->status->title ?? 'N/A' }}
                </span>
            </div>
        </div>

        <!-- Task Meta Information -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
            <div class="flex items-center text-gray-600">
                <i class="fas fa-project-diagram mr-2 text-gray-400"></i>
                <span class="text-sm"><span class="font-medium">Project:</span> {{ $task->project->title ?? 'N/A' }}</span>
            </div>
            <div class="flex items-center text-gray-600">
                <i class="fas fa-calendar-alt mr-2 text-gray-400"></i>
                <span class="text-sm"><span class="font-medium">Start:</span> {{ $task->starting_date->format('d M Y') }}</span>
            </div>
            <div class="flex items-center text-gray-600">
                <i class="fas fa-calendar-check mr-2 text-gray-400"></i>
                <span class="text-sm"><span class="font-medium">Due:</span> {{ $task->due_date->format('d M Y') }}</span>
            </div>
            <div class="flex items-center text-gray-600">
                <i class="fas fa-clock mr-2 text-gray-400"></i>
                <span class="text-sm">
                    <span class="font-medium">Days Left:</span> 
                    @php
                        $daysLeft = now()->diffInDays($task->due_date, false);
                        $daysText = $daysLeft > 0 ? "$daysLeft days" : ($daysLeft < 0 ? "Overdue by ".abs($daysLeft)." days" : "Due today");
                    @endphp
                    <span class="{{ $daysLeft < 0 ? 'text-red-500' : ($daysLeft == 0 ? 'text-yellow-500' : 'text-green-500') }}">
                        {{ $daysText }}
                    </span>
                </span>
            </div>
            <div class="flex items-center text-gray-600">
                <i class="fas fa-users mr-2 text-gray-400"></i>
                <span class="text-sm"><span class="font-medium">Team:</span> {{ $task->clients->count() }} members</span>
            </div>
        </div>

        <!-- Task Description -->
        <div class="mb-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Description</h3>
            <div class="bg-gray-50 rounded-lg p-4">
                <p class="text-gray-700 whitespace-pre-line">{{ $task->description ?? 'No description provided' }}</p>
            </div>
        </div>

        <!-- Team Members -->
        <div class="mb-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-3">Team Members</h3>
            @if($task->clients->count() > 0)
                <div class="flex flex-wrap gap-3">
                    @foreach($task->clients as $client)
                        <div class="flex items-center bg-gray-50 rounded-full px-3 py-1">
                            <div class="avatar" style="background-color: {{ '#' . substr(md5($client->email), 0, 6) }}">
                                {{ substr($client->first_name . ' ' . $client->last_name, 0, 1) }}
                            </div>
                            <span class="ml-2 text-sm text-gray-700">{{ $client->first_name }} {{ $client->last_name }}</span>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 italic">No team members assigned</p>
            @endif
        </div>
    </div>

    <!-- Tabs Section -->
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <!-- Tab Header -->
        <div class="border-b border-gray-200">
           <nav class="flex -mb-px" style="gap: 30px;">
                <button data-tab="comments" class="tab-btn text-gray-500 hover:text-gray-700 border-transparent">
                    <i class="fas fa-comments mr-2"></i>Comments
                </button>
                <button class="tab-btn py-4 px-6 text-center border-b-2 font-medium text-sm text-gray-500 hover:text-gray-700" 
                        data-tab="attachments">
                    <i class="fas fa-paperclip mr-2"></i>Attachments
                </button>
                <button class="tab-btn py-4 px-6 text-center border-b-2 font-medium text-sm text-gray-500 hover:text-gray-700" 
                        data-tab="time-tracking">
                    <i class="fas fa-stopwatch mr-2"></i>Time Tracking
                </button>
            </nav>
        </div>

        <!-- Tab Contents -->
        <div class="p-6">
            <!-- Comments Tab -->
            <div id="comments" class="tab-content active">
                <div id="commentsContainer" class="space-y-4 mb-6">
                    @foreach($task->comments as $comment)
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center">
                                @php
                                    $isClient = $comment->client->first_name ?? false;
                                    $email = $isClient ? ($comment->client->email ?? 'default@example.com') : ($comment->user->email ?? 'default@example.com');
                                    $initial = $isClient 
                                        ? substr(($comment->client->first_name ?? '') . ' ' . ($comment->client->last_name ?? ''), 0, 1) 
                                        : substr($comment->user->name ?? '', 0, 1);
                                    $initial = $initial ?: '?';
                                    $bgColor = '#' . substr(md5($email), 0, 6);
                                @endphp

                                <div class="comment-user-avatar flex items-center justify-center rounded-full w-8 h-8 text-white font-semibold text-xs mr-2" 
                                    style="background-color: {{ $bgColor }}"
                                    title="{{ $isClient ? ($comment->client->name ?? 'Unknown') : ($comment->user->name ?? 'Unknown') }}">
                                    {{ $initial }}
                                </div>
                                <span class="text-sm font-medium text-gray-700">
                                    {{ $isClient ? ($comment->client->name ?? 'Unknown Client') : ($comment->user->name ?? 'Unknown User') }}
                                </span>
                            </div>
                                <span class="text-xs text-gray-500">{{ $comment->created_at->format('d M Y H:i') }}</span>
                            </div>
                            <div class="text-gray-700 text-sm pl-10">
                                {{ $comment->comment }}
                            </div>
                        </div>
                    @endforeach
                </div>
                <form id="commentForm" class="comment-form">
                    @csrf
                    <div class="mb-3">
                        <textarea 
                            name="comment" 
                            id="commentContent" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                            rows="3" 
                            placeholder="Type your message..."></textarea>
                    </div>
                    <button type="submit" class="btn-create">
                        Post Comment
                    </button>
                </form>
            </div>
            <!-- Attachments Tab -->
         <div id="attachments" class="tab-content hidden">
                <div id="attachmentsContainer" class="mb-6">
                    @if($task->attachments->count() > 0)
                        <div class="space-y-3">
                            @foreach($task->attachments as $attachment)
                                <div class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50 transition duration-150 ease-in-out">
                                    <div class="attachment-icon">
                                        @php
                                            $fileIcon = 'fa-file';
                                            $extension = strtolower(pathinfo($attachment->file_name, PATHINFO_EXTENSION));
                                            
                                            $fileIcons = [
                                                'pdf' => 'fa-file-pdf',
                                                'doc' => 'fa-file-word',
                                                'docx' => 'fa-file-word',
                                                'xls' => 'fa-file-excel',
                                                'xlsx' => 'fa-file-excel',
                                                'ppt' => 'fa-file-powerpoint',
                                                'pptx' => 'fa-file-powerpoint',
                                                'jpg' => 'fa-file-image',
                                                'jpeg' => 'fa-file-image',
                                                'png' => 'fa-file-image',
                                                'gif' => 'fa-file-image',
                                                'zip' => 'fa-file-archive',
                                                'rar' => 'fa-file-archive',
                                                'mp3' => 'fa-file-audio',
                                                'mp4' => 'fa-file-video',
                                            ];
                                            
                                            if (array_key_exists($extension, $fileIcons)) {
                                                $fileIcon = $fileIcons[$extension];
                                            }
                                        @endphp
                                        <i class="fas {{ $fileIcon }} text-xl text-blue-500"></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="text-sm font-medium text-gray-900 truncate">
                                            <a href="{{ asset('storage/'.$attachment->file_path) }}" target="_blank" class="hover:text-blue-600">
                                                {{ $attachment->file_name }}
                                            </a>
                                        </div>
                                        <div class="flex items-center text-xs text-gray-500">
                                            <span>{{ round($attachment->file_size / 1024) }} KB</span>
                                            <span class="mx-2">•</span>
                                            <span>{{ strtoupper($extension) }} file</span>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <a href="{{ asset('storage/'.$attachment->file_path) }}" download="{{ $attachment->file_name }}" 
                                        class="p-2 text-blue-600 hover:text-blue-800 rounded-full hover:bg-blue-50 transition duration-150">
                                            <i class="fas fa-download"></i>
                                        </a>
                                        <button class="p-2 text-red-600 hover:text-red-800 rounded-full hover:bg-red-50 transition duration-150 delete-attachment"
                                                data-id="{{ $attachment->id }}" title="Delete Attachment">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <i class="fas fa-paperclip text-4xl text-gray-300 mb-2"></i>
                            <p class="text-gray-500">No attachments yet</p>
                        </div>
                    @endif
                </div>
                
                <form id="attachmentForm" enctype="multipart/form-data" class="mt-4">
                    @csrf
                    <input type="file" name="attachment" id="attachmentInput" class="hidden" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.jpg,.jpeg,.png,.gif,.txt,.zip,.rar">
                    
                    <div class="flex items-center space-x-3">
                        <button type="button" onclick="document.getElementById('attachmentInput').click()" 
                                class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-lg transition duration-200 ease-in-out flex items-center">
                            <i class="fas fa-plus mr-2"></i> Select File
                        </button>
                        
                        <span id="fileName" class="text-sm text-gray-500 truncate max-w-xs flex-1">
                            No file selected (Max 10MB)
                        </span>
                        
                        <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition duration-200 ease-in-out hidden flex items-center" 
                                id="attachmentSubmit" disabled>
                            <span id="uploadText">Upload</span>
                            <span id="uploadSpinner" class="ml-2 hidden">
                                <i class="fas fa-spinner fa-spin"></i>
                            </span>
                        </button>
                    </div>
                    
                    <div id="uploadProgress" class="mt-2 hidden">
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div id="progressBar" class="bg-blue-600 h-2.5 rounded-full" style="width: 0%"></div>
                        </div>
                        <div id="progressText" class="text-xs text-gray-500 mt-1 text-right">0%</div>
                    </div>
                    
                    <div id="uploadError" class="text-red-500 text-sm mt-2 hidden"></div>
                </form>
            </div>           
            <!-- Time Tracking Tab -->
            <div id="time-tracking" class="tab-content hidden">
                <div class="flex items-center justify-between bg-gray-50 rounded-lg p-4 mb-6">
                    <div class="flex items-center space-x-6">
                        <button id="timerToggle" class="btn-create-task">
                            <i class="fas fa-play mr-2"></i>Start Timer
                        </button>
                        <div class="text-2xl font-mono font-medium" id="timerDisplay">00:00:00</div>
                    </div>
                    <div class="text-sm text-gray-500">
                        Current session will be recorded when stopped
                    </div>
                </div>
                
                <div id="timerHistory">
                    <h4 class="text-lg font-semibold text-gray-800 mb-3">Time Logs</h4>
                    @if($task->timers->count() > 0)
                        <div class="space-y-3">
                            @foreach($task->timers as $timer)
                                <div class="flex items-center justify-between p-3 border border-gray-200 rounded-lg">
                                    <div class="text-sm text-gray-700">
                                        <i class="far fa-clock mr-2 text-gray-400"></i>
                                        {{ $timer->started_at->format('d M Y H:i') }} - 
                                        @if($timer->ended_at)
                                            {{ $timer->ended_at->format('d M Y H:i') }}
                                        @else
                                            <span class="text-yellow-600">Ongoing</span>
                                        @endif
                                    </div>
                                    <div class="text-sm font-medium text-gray-900">
                                        @if($timer->ended_at)
                                            {{ gmdate('H:i:s', $timer->duration) }}
                                        @else
                                            <span class="text-yellow-600">In Progress</span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 italic">No time logs recorded</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@section('additional_scripts')
<script>
    $(document).ready(function() {
         $('#commentForm').on('submit', function (e) {
            e.preventDefault();

            const comment = $('#commentContent').val().trim();
            if (!comment) return;

            $.ajax({
                url: '{{ route("dashboard.business.task.comment.store", $task->id) }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    comment: comment
                },
                success: function (response) {
                    const now = new Date();
                    const formattedDate = now.toLocaleDateString('en-US', {
                        day: 'numeric',
                        month: 'short',
                        year: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit'
                    });
                       const name = response.comment.user.first_name? response.comment.user.first_name :response.comment.user.name;
                        const email = response.comment.user.email;
                        const initial = getInitial(name);
                        const bgColor = getAvatarColor(email);
                        function getInitial(name) {
                            return name?.trim().charAt(0).toUpperCase() || '?';
                        }
                        function getAvatarColor(email) {
                            return '#' + md5(email).substring(0, 6);
                        }
                        function md5(string) {
                            return CryptoJS.MD5(string).toString();
                        }
                        const newComment = `
                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="flex items-center justify-between mb-2">
                                    <div class="flex items-center">
                                        <div class="comment-user-avatar flex items-center justify-center rounded-full w-8 h-8 text-white font-semibold text-xs mr-2"
                                            style="background-color: ${bgColor};">
                                            ${initial}
                                        </div>
                                        <span class="text-sm font-medium text-gray-700">${name}</span>
                                    </div>
                                    <span class="text-xs text-gray-500">${formattedDate}</span>
                                </div>
                                <div class="text-gray-700 text-sm pl-10">
                                    ${$('<div>').text(comment).html()}
                                </div>
                            </div>
                        `;
                    $('#commentsContainer').append(newComment);
                    $('#commentContent').val('');

                    $('html, body').animate({
                        scrollTop: $('#commentsContainer').children().last().offset().top - 100
                    }, 300);
                },
                error: function (xhr) {
                    alert('Error posting comment');
                }
            });
        });
          $('button[data-tab="comments"]').addClass('btn-create-task')
                .removeClass('text-gray-500 hover:text-gray-700 border-transparent');
            
            // Hide all tab contents except Comments
            $('.tab-content').addClass('hidden').removeClass('active');
            $('#comments').removeClass('hidden').addClass('active');
        });

        // Tab functionality
        $('.tab-btn').click(function() {
            const tabId = $(this).data('tab');
            console.log(tabId);
            // Update active tab button
            $('.tab-btn').removeClass('btn-create-task')
                        .addClass('text-gray-500 hover:text-gray-700 border-transparent');
            
            $(this).addClass('btn-create-task')
                .removeClass('text-gray-500 hover:text-gray-700 border-transparent');
            
            // Update active tab content
            $('.tab-content').removeClass('active').addClass('hidden');
            $(`#${tabId}`).addClass('active').removeClass('hidden');
        let timerInterval;
        let seconds = 0;
        const timerDisplay = $('#timerDisplay');
        const timerToggle = $('#timerToggle');
        // Timer functionality
        timerToggle.on('click', function() {
            if (timerToggle.text().includes('Start')) {
                // Start timer
                timerToggle.html('<i class="fas fa-stop mr-2"></i>Stop Timer').removeClass('bg-green-600 hover:bg-green-700').addClass('bg-red-600 hover:bg-red-700');
                
                // AJAX call to start timer on server
                $.ajax({
                    url: '{{ route("dashboard.business.task.timer.start", $task->id) }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        seconds = 0;
                        updateTimerDisplay();
                        timerInterval = setInterval(updateTimerDisplay, 1000);
                    },
                    error: function(xhr) {
                        alert('Error starting timer');
                    }
                });
            } else {
                // Stop timer
                timerToggle.html('<i class="fas fa-play mr-2"></i>Start Timer').removeClass('bg-red-600 hover:bg-red-700').addClass('bg-green-600 hover:bg-green-700');
                clearInterval(timerInterval);
                
                // AJAX call to stop timer on server
                $.ajax({
                    url: '{{ route("dashboard.business.task.timer.stop", $task->id) }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // Refresh timer history
                        $('#timerHistory').load(' #timerHistory > *');
                    },
                    error: function(xhr) {
                        alert('Error stopping timer');
                    }
                });
            }
        });
        
        function updateTimerDisplay() {
            seconds++;
            const hours = Math.floor(seconds / 3600);
            const minutes = Math.floor((seconds % 3600) / 60);
            const secs = seconds % 60;
            timerDisplay.text(
                `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`
            );
        }
        
        // Check for active timer on page load
        $.ajax({
            url: '{{ route("dashboard.business.task.timer.active", $task->id) }}',
            method: 'GET',
            success: function(response) {
                if (response.active) {
                    timerToggle.html('<i class="fas fa-stop mr-2"></i>Stop Timer').removeClass('bg-green-600 hover:bg-green-700').addClass('bg-red-600 hover:bg-red-700');
                    seconds = Math.floor((new Date() - new Date(response.started_at))) / 1000;
                    updateTimerDisplay();
                    timerInterval = setInterval(updateTimerDisplay, 1000);
                }
            }
        });
            // Show selected file name
    $('#attachmentInput').on('change', function() {
        if (this.files.length > 0) {
            const file = this.files[0];
            const fileSizeMB = (file.size / (1024*1024)).toFixed(2);
            
            $('#fileName').text(`${file.name} (${fileSizeMB} MB)`);
            $('#attachmentSubmit').removeClass('hidden').prop('disabled', false);
            
            // Check file size
            if (file.size > 10 * 1024 * 1024) { // 10MB
                $('#uploadError').text('File size exceeds 10MB limit').removeClass('hidden');
                $('#attachmentSubmit').prop('disabled', true);
            } else {
                $('#uploadError').addClass('hidden');
            }
        } else {
            $('#fileName').text('No file selected (Max 10MB)');
            $('#attachmentSubmit').addClass('hidden').prop('disabled', true);
        }
    });
    
    // AJAX for attachments with progress
    $('#attachmentForm').on('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const file = $('#attachmentInput')[0].files[0];
        
        if (!file) {
            $('#uploadError').text('Please select a file first').removeClass('hidden');
            return;
        }
        
        if (file.size > 10 * 1024 * 1024) {
            $('#uploadError').text('File size exceeds 10MB limit').removeClass('hidden');
            return;
        }
        
        // Show loading state
        $('#uploadText').text('Uploading...');
        $('#uploadSpinner').removeClass('hidden');
        $('#attachmentSubmit').prop('disabled', true);
        $('#uploadProgress').removeClass('hidden');
        $('#uploadError').addClass('hidden');
        
        $.ajax({
            url: '{{ route("dashboard.business.task.attachment.store", $task->id) }}',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            xhr: function() {
                const xhr = new window.XMLHttpRequest();
                
                xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                        const percentComplete = Math.round((e.loaded / e.total) * 100);
                        $('#progressBar').css('width', percentComplete + '%');
                        $('#progressText').text(percentComplete + '%');
                    }
                }, false);
                
                return xhr;
            },
            success: function(response) {
                // Add new attachment to list
                const fileSizeKB = Math.round(response.attachment.file_size / 1024);
                const extension = response.attachment.file_name.split('.').pop().toLowerCase();
                
                // Determine file icon
                let fileIcon = 'fa-file';
                const fileIcons = {
                    'pdf': 'fa-file-pdf',
                    'doc': 'fa-file-word',
                    'docx': 'fa-file-word',
                    'xls': 'fa-file-excel',
                    'xlsx': 'fa-file-excel',
                    'ppt': 'fa-file-powerpoint',
                    'pptx': 'fa-file-powerpoint',
                    'jpg': 'fa-file-image',
                    'jpeg': 'fa-file-image',
                    'png': 'fa-file-image',
                    'gif': 'fa-file-image',
                    'zip': 'fa-file-archive',
                    'rar': 'fa-file-archive'
                };
                
                if (fileIcons[extension]) {
                    fileIcon = fileIcons[extension];
                }
                
                const attachmentHtml = `
                <div class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50 transition duration-150 ease-in-out">
                    <div class="attachment-icon">
                        <i class="fas ${fileIcon} text-xl text-blue-500"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="text-sm font-medium text-gray-900 truncate">
                            <a href="${response.file_url}" target="_blank" class="hover:text-blue-600">
                                ${response.attachment.file_name}
                            </a>
                        </div>
                        <div class="flex items-center text-xs text-gray-500">
                            <span>${fileSizeKB} KB</span>
                            <span class="mx-2">•</span>
                            <span>${extension.toUpperCase()} file</span>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <a href="${response.file_url}" download="${response.attachment.file_name}" 
                           class="p-2 text-blue-600 hover:text-blue-800 rounded-full hover:bg-blue-50 transition duration-150">
                            <i class="fas fa-download"></i>
                        </a>
                        <button class="p-2 text-red-600 hover:text-red-800 rounded-full hover:bg-red-50 transition duration-150 delete-attachment"
                                data-id="${response.attachment.id}" title="Delete Attachment">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                </div>
                `;
                
                if ($('#attachmentsContainer').find('.text-center').length) {
                    // Replace "no attachments" message
                    $('#attachmentsContainer').html(`<div class="space-y-3">${attachmentHtml}</div>`);
                } else {
                    // Prepend to existing list
                    $('#attachmentsContainer .space-y-3').prepend(attachmentHtml);
                }
                
                // Reset form
                $('#attachmentInput').val('');
                $('#fileName').text('No file selected (Max 10MB)');
                $('#attachmentSubmit').addClass('hidden');
                $('#uploadProgress').addClass('hidden');
                $('#progressBar').css('width', '0%');
                $('#progressText').text('0%');
                
                // Show success message
                toastr.success(response.message);
            },
            error: function(xhr) {
                let errorMessage = 'Error uploading file';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }
                
                $('#uploadError').text(errorMessage).removeClass('hidden');
            },
            complete: function() {
                $('#uploadText').text('Upload');
                $('#uploadSpinner').addClass('hidden');
                $('#attachmentSubmit').prop('disabled', false);
            }
        });
    });
    
    // Delete attachment
    $(document).on('click', '.delete-attachment', function() {
        const attachmentId = $(this).data('id');
        const attachmentElement = $(this).closest('.flex.items-center.p-3');
        
        if (confirm('Are you sure you want to delete this attachment?')) {
            $.ajax({
                url: '{{ route("dashboard.business.task.attachment.destroy", ["task" => $task->id, "attachment" => "ATTACHMENT_ID"]) }}'.replace('ATTACHMENT_ID', attachmentId),
                method: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                beforeSend: function() {
                    attachmentElement.find('button').prop('disabled', true);
                    attachmentElement.css('opacity', '0.6');
                },
                success: function(response) {
                    attachmentElement.remove();
                    toastr.success(response.message);
                    
                    // If no attachments left, show empty state
                    if ($('#attachmentsContainer .space-y-3').children().length === 0) {
                        $('#attachmentsContainer').html(`
                            <div class="text-center py-8">
                                <i class="fas fa-paperclip text-4xl text-gray-300 mb-2"></i>
                                <p class="text-gray-500">No attachments yet</p>
                            </div>
                        `);
                    }
                },
                error: function(xhr) {
                    toastr.error('Error deleting attachment');
                    attachmentElement.find('button').prop('disabled', false);
                    attachmentElement.css('opacity', '1');
                }
            });
        }
    });
    });
</script>
@endsection
@endsection