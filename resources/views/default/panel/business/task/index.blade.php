@extends('panel.layout.settings', ['layout' => 'fullwidth'])

@section('title', __('Business Tasks'))
@section('titlebar_actions')
 <x-button
    class="text-inherit hover:text-foreground"
    variant="link"
    href="{{ LaravelLocalization::localizeUrl(route('dashboard.index')) }}"
>
    <x-tabler-chevron-left
        class="size-4"
        stroke-width="1.5"
    />
    {{ __('Back to dashboard') }}
</x-button>
@endsection
@section('additional_css')
<link href="{{ custom_theme_url('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('bussiness/custom.css') }}" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7692faf57e.js" crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.css" rel="stylesheet" />

      <style>
@media (max-width: 768px) {
    .kanban-board {
        flex-direction: column;
        gap: 1rem;
        padding: 0.5rem;
        height: auto; /* Ensure board doesn't create its own scroll */
    }

    .kanban-column {
        width: 100%;
        min-height: 200px;
        max-height: 60vh; /* Limit column height relative to viewport */
        display: flex;
        flex-direction: column;
    }

    .kanban-column h3 {
        position: sticky;
        top: 0;
        background: #f9f9f9;
        z-index: 2;
        padding: 0.5rem 0;
    }

    .kanban-items {
        flex-grow: 1;
        overflow-y: auto;
        -webkit-overflow-scrolling: touch; /* Smooth scrolling on iOS */
        scrollbar-width: thin; /* For Firefox */
        padding-bottom: 1rem; /* Space at bottom */
    }

    /* Custom scrollbar for better mobile visibility */
    .kanban-items::-webkit-scrollbar {
        width: 6px;
        height: 6px;
    }
    .kanban-items::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 3px;
    }

    .task-card {
        padding: 0.75rem;
        margin-bottom: 0.75rem;
        transform: translateZ(0); /* Improve scrolling performance */
    }

    /* Prevent double-scrolling issues */
    html, body {
        overflow-x: hidden;
        height: 100%;
    }
    body {
        position: relative;
    }
}

@media (max-width: 480px) {
    .kanban-column {
        max-height: 50vh; /* Slightly smaller columns on very small screens */
    }
    
    .kanban-items {
        overscroll-behavior-y: contain; /* Prevent scroll chaining */
    }
}



        
        .kanban-board { display: flex; gap: 1rem; }
        .kanban-column {
                flex: 1;
                background: #f9f9f9;
                border: 1px solid #ddd;
                border-radius: 8px;
                padding: 1rem;
                display: flex;
                flex-direction: column;
                max-height: 460px; /* or adjust as needed */
            }

            .kanban-items {
                overflow-y: auto;
                flex-grow: 1;
            }

        /* .kanban-column { flex: 1; background: #f9f9f9; border: 1px solid #ddd; border-radius: 8px; padding: 1rem; } */
        .kanban-column h3 { text-align: center; margin-bottom: 1rem; }
        .task-card {
            background: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1rem;
            cursor: grab;
            transition: box-shadow 0.3s;
        }
        .task-card:hover {
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
    </style>
@endsection

@section('settings')
<div class="business-tasks w-full">
<div class="controls mt-8">
    <form method="GET" action="{{ route('dashboard.business.task.index') }}" class="flex items-center gap-8">
        <div class="left-controls" id="searchControls">
            <div class="bulk-actions">
                <select name="bulk_action" class="select-company bulk-action-select">
                    <option value="">Bulk Actions</option>
                    <option value="delete">Delete Selected</option>
                </select>
            </div>
            <input id="globalSearch" name="search" class="search" type="text" placeholder="Search by project title" 
                   value="{{ request('search') }}" onchange="this.form.submit()">
        </div>
        <div class="right-controls">
            <x-button variant="ghost" class="btn-filter"><i class="fa-solid fa-filter"></i> Filter</x-button>
            <x-button href="{{ route('dashboard.business.task.create') }}" class="btn-create">
                 <x-tabler-plus class="size-4 mr-1" />{{__('Create New') }} 
            </x-button>
        </div>
    </form>
</div>
<div class="filter-fields {{ request()->has('client_id') || request()->has('project_id') || request()->has('priority_id') || request()->has('status_id') || request()->has('date_from') || request()->has('date_to') ? '' : 'hidden' }}" id="filterBox">
   <form method="GET" action="{{ route('dashboard.business.task.index') }}">
    <div class="form-row-inline">
        <div class="form-group">
            <label>Client</label>
            <select name="client_id">
                <option value="">All Clients</option>
                @foreach($clients as $client)
                <option value="{{ $client->id }}" {{ request('client_id') == $client->id ? 'selected' : '' }}>
                    {{ $client->first_name }} {{ $client->last_name }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Project</label>
            <select name="project_id">
                <option value="">All Projects</option>
                @foreach($projects as $project)
                <option value="{{ $project->id }}" {{ request('project_id') == $project->id ? 'selected' : '' }}>
                    {{ $project->title }}
                </option>
                @endforeach
            </select>
        </div>
    </div>
     <div class="form-row-inline">
        <div class="form-group">
            <label>Priority</label>
            <select name="priority_id">
                <option value="">All Priorities</option>
                @foreach($priorities as $priority)
                <option value="{{ $priority->id }}" {{ request('priority_id') == $priority->id ? 'selected' : '' }}>
                    {{ $priority->title }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Status</label>
            <select name="status_id">
                <option value="">All Statuses</option>
                @foreach($statuses as $status)
                <option value="{{ $status->id }}" {{ request('status_id') == $status->id ? 'selected' : '' }}>
                    {{ $status->title }}
                </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-row-inline">
        <div class="form-group">
            <label>Date From</label>
            <input type="date" name="date_from" value="{{ request('date_from') }}">
        </div>
        <div class="form-group">
            <label>Date To</label>
            <input type="date" name="date_to" value="{{ request('date_to') }}">
        </div>
    </div>
    <div class="filter-actions">
        <x-button type="submit" class="btn-apply">Apply Filters</x-button>
        <x-button href="{{ route('dashboard.business.task.index') }}" class="btn-reset">Reset</x-button>
    </div>
</form>
</div>
    <!-- Completed Task Modal -->
    <div id="completedTaskModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center hidden z-50">
        <div class="bg-white p-6 rounded-lg w-full max-w-md">
            <h2 class="text-lg font-semibold mb-4">Upload Image for Completed Task</h2>
            <form id="completedTaskForm" enctype="multipart/form-data">
                <input type="hidden" name="task_id" id="modal_task_id">
                <div class="mb-4">
                    <label class="block mb-1 font-medium">Upload Image</label>
                    <input type="file" name="completed_task_image"  class="w-full border p-2 rounded" >
                </div>
                <div class="flex justify-end gap-3">
                    <button type="button" onclick="closeCompletedModal()" class="btn-filter lqd-btn-outline px-4 py-2 rounded">Cancel</button>
                    <button type="submit" class=" lqd-btn-outline text-white px-4 py-2 rounded">Submit</button>
                </div>
            </form>
        </div>
    </div>

<div class="kanban-board">
    @foreach($statuses as $status)
        <div class="kanban-column" data-status-id="{{ $status->id }}">
            <h3>
                {{ $status->title }}
                (<span class="task-count" data-status-id="{{ $status->id }}">
                    {{ $tasks->where('status_id', $status->id)->count() }}
                </span>)
            </h3>
            <div class="kanban-items" id="status-{{ $status->id }}">
                @foreach($tasks->where('status_id', $status->id) as $task)
                    <div class="task-card" data-task-id="{{ $task->id }}">
                        <div class="flex justify-between items-center">
                            <strong>{{ $task->title }}</strong>
                            <span class="badge badge-{{ strtolower($task->priority->title) }}">
                                {{ ucfirst($task->priority->title) }}
                            </span>
                        </div>
                        <p class="text-xs mt-2">{{ Str::limit($task->description, 50) }}</p>
                        <div class="flex justify-between items-center mt-3 text-xs text-gray-500">
                            <span><i class="fas fa-calendar-alt"></i> {{ $task->due_date->diffForHumans() }}</span>
                            <div class="flex gap-2">
                            <a href="{{ route('dashboard.business.task.show', $task->id) }}">Details</a>
                            <a href="{{ route('dashboard.business.task.edit', $task->id) }}">Edit</a>
                            <form action="{{ route('dashboard.business.task.destroy', $task->id) }}" method="POST" onsubmit="return confirm('Are you sure?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                            </form>
                        </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>
</div>
@section('additional_scripts')
<script>
    let draggedTask = null;
    let originalColumn = null;
    document.addEventListener('DOMContentLoaded', function () {

    // Initialize Sortable for each kanban-items container
    document.querySelectorAll('.kanban-items').forEach(function (el) {
        new Sortable(el, {
            group: 'kanban',
            animation: 150,
onEnd: function (evt) {
    let taskId = evt.item.dataset.taskId;
    let newStatusId = evt.to.closest('.kanban-column').dataset.statusId;
    let oldStatusId = evt.from.closest('.kanban-column').dataset.statusId;

    let completedStatusId = '{{ $statuses->firstWhere("title", "Completed")->id ?? "4" }}';

    // Store references globally
    draggedTask = evt.item;
    originalColumn = evt.from;

    // Update DOM counts immediately
    const oldCountEl = document.querySelector(`.task-count[data-status-id="${oldStatusId}"]`);
    const newCountEl = document.querySelector(`.task-count[data-status-id="${newStatusId}"]`);
    oldCountEl.textContent = evt.from.querySelectorAll('.task-card').length;
    newCountEl.textContent = evt.to.querySelectorAll('.task-card').length;

    // If moved to Completed, show modal — DO NOT SEND AJAX YET
    if (newStatusId === completedStatusId) {
        document.getElementById('modal_task_id').value = taskId;
        document.getElementById('completedTaskModal').classList.remove('hidden');
        return;
    }

    // ✅ Send AJAX ONLY for non-completed status updates
    fetch('{{ route("dashboard.business.task.updateStatus") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            task_id: taskId,
            status_id: newStatusId
        })
    })
    .then(response => response.json())
    .then(data => {
        if (!data.success) {
            throw new Error('Update failed');
        }
    })
    .catch(() => {
        originalColumn.appendChild(evt.item);
        oldCountEl.textContent = originalColumn.querySelectorAll('.task-card').length;
        newCountEl.textContent = evt.to.querySelectorAll('.task-card').length;
        alert('Error updating status. Task was reverted.');
    });
}


 
        });
    });

          
});
function closeCompletedModal() {
    // Move task back
    if (draggedTask && originalColumn) {
        const completedColumn = draggedTask.closest('.kanban-column'); // before move
        const completedStatusId = completedColumn.dataset.statusId;

        originalColumn.appendChild(draggedTask);

        const originalColumnStatusId = originalColumn.closest('.kanban-column').dataset.statusId;

        // Update counts
        document.querySelector(`.task-count[data-status-id="${originalColumnStatusId}"]`).textContent =
            originalColumn.querySelectorAll('.task-card').length;

        document.querySelector(`.task-count[data-status-id="${completedStatusId}"]`).textContent =
            completedColumn.querySelectorAll('.task-card').length;
    }

    // Hide modal
    document.getElementById('completedTaskModal').classList.add('hidden');

    // Reset globals
    draggedTask = null;
    originalColumn = null;
}




</script>
<!--<script>-->
<!--document.getElementById('completedTaskForm').addEventListener('submit', function (e) {-->
<!--    e.preventDefault();-->

<!--    let form = e.target;-->
<!--    let formData = new FormData(form);-->

<!--    let taskId = document.getElementById('modal_task_id').value;-->

<!--      fetch(`/dashboard/business/task/${taskId}/upload-completion-image`, {-->
<!--        method: 'POST',-->
<!--        headers: {-->
<!--            'X-CSRF-TOKEN': '{{ csrf_token() }}'-->
<!--        },-->
<!--        body: formData-->
<!--    })-->
<!--    .then(response => response.json())-->
<!--    .then(data => {-->
<!--        if (data.success) {-->
<!--            alert('Image uploaded successfully!');-->
<!--            closeCompletedModal();-->
<!--        } else {-->
<!--            alert('Upload failed. Please try again.');-->
<!--        }-->
<!--    })-->
<!--    .catch(error => {-->
<!--        console.error(error);-->
<!--        alert('An error occurred.');-->
<!--    });-->
<!--});-->
<!--</script>-->
<script>
document.getElementById('completedTaskForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);
    const taskId = document.getElementById('modal_task_id').value;

    fetch(`/dashboard/business/task/${taskId}/upload-completion-image`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content // ✅ Use meta token
        },
        body: formData
    })
    .then(async response => {
        const data = await response.json();
        if (data.success) {
            alert('Image uploaded successfully!');
            // closeCompletedModal();
            completeTaskSuccessfully();
        } else {
            alert(data.message || 'Upload failed.');
        }
    })
    .catch(error => {
        console.error(error);
        alert('An error occurred.');
    });
});
function completeTaskSuccessfully() {
     let completedStatusId = '{{ $statuses->firstWhere("title", "Completed")->id ?? "4" }}';

    const taskId = document.getElementById('modal_task_id').value;
  fetch('{{ route("dashboard.business.task.updateStatus") }}', {
    method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            task_id: taskId,
            status_id: completedStatusId  // Make sure you define this or fetch from modal
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // alert('Image uploaded and status updated!');
            document.getElementById('completedTaskModal').classList.add('hidden');
            // Update counts if needed here
            draggedTask = null;
            originalColumn = null;
        } else {
            alert(data.message || 'Status update failed.');
        }
    });
}

</script>



<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle filter box
    const filterButton = document.querySelector('.btn-filter');
    const filterBox = document.getElementById('filterBox');
    
    if (filterButton && filterBox) {
        filterButton.addEventListener('click', function() {
            filterBox.classList.toggle('hidden');
            if (!filterBox.classList.contains('hidden')) {
                filterButton.innerHTML = '<i class="fa-solid fa-xmark"></i> Close Filter';
            } else {
                filterButton.innerHTML = '<i class="fa-solid fa-filter"></i> Filter';
            }
        });
    }
});
</script>
@endsection
@endsection
