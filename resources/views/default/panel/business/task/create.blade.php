@extends('panel.layout.settings', ['layout' => 'fullwidth'])

@section('title', isset($task) ? __('Edit Task') : __('Create New Task'))

@section('additional_css')
<style>
 
 /* Form container */
    /*.text-sm{*/
    /*    color:#89909D;*/
    /*}*/
    .rounded-md{
        color:#89909D;
    }

#send_notification {
    accent-color: #89909D;
    margin-bottom: 6px;
}   

.select2-container--default .select2-selection--multiple {
    background-color: white !important;
    border: 1px solid #d1d5db !important; /* border-gray-300 
    border-radius: 0.375rem !important;   /* rounded-md 
    padding: 0.5rem !important;
    color: #111827 !important; /* text-black 
}

 Light mode: Placeholder text color 
.select2-container--default .select2-search__field {
    color: #111827 !important;
}
.select2-results__options  {
    background-color: #1F2937 !important;
    background-color: white !important;
}
.theme-dark .select2-results__options  {
    background-color: #1F2937 !important;
    background-color: white !important;
}


</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="{{ asset('bussiness/custom-create.css') }}" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
@endsection

@section('settings')
<div class="business-tasks w-full">
   <form method="POST" 
      action="{{ isset($task) ? route('dashboard.business.task.update', $task->id) : route('dashboard.business.task.store') }}"
      enctype="multipart/form-data" 
      class="space-y-6">
    @csrf
    @if(isset($task))
        @method('PUT')
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- Title --}}
        <div>
            <label for="title" class="block text-sm font-medium text-black dark:text-white required">Title</label>
            <input type="text" id="title" name="title" 
                   value="{{ old('title', $task->title ?? '') }}"
                   class="mt-1 block w-full rounded-md  bg-white dark:bg-[#171B21] border-gray-300 dark:border-gray-600 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-2"required>
            @error('title')
                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        {{-- Project --}}
        <div>
            <label for="project_id" class="block text-sm font-medium text-black dark:text-white required">Project</label>
            <select id="project_id" name="project_id"
                    class="mt-1 block w-full   bg-white dark:bg-[#171B21] border border-gray-300 dark:border-gray-600 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500"required>
                <option value="">Select Project</option>
                @foreach($projects as $project)
                    <option value="{{ $project->id }}" {{ old('project_id', $task->project_id ?? '') == $project->id ? 'selected' : '' }}>
                        {{ $project->title }}
                    </option>
                @endforeach
            </select>
            @error('project_id')
                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        {{-- Description --}}
        <div class="md:col-span-2">
            <label for="description" class="block text-sm font-medium text-black dark:text-white required">Description</label>
            <textarea id="description" name="description" rows="4"
                      class="mt-1 block w-full  bg-white dark:bg-[#171B21] border border-gray-300 dark:border-gray-600 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500"required></textarea>{{ old('description', $task->description ?? '') }}</textarea>
            @error('description')
                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        {{-- Starting Date --}}
        <div>
            <label for="starting_date" class="block text-sm font-medium text-black dark:text-white required">Starting Date</label>
            <input type="date" id="starting_date" name="starting_date"
                   value="{{ old('starting_date', isset($task) ? $task->starting_date->format('Y-m-d') : '') }}"
                   class="mt-1 block w-full   bg-white dark:bg-[#171B21] border border-gray-300 dark:border-gray-600 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500" required/>
            @error('starting_date')
                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        {{-- Due Date --}}
        <div>
            <label for="due_date" class="block text-sm font-medium text-black dark:text-white required">Due Date</label>
            <input type="date" id="due_date" name="due_date"
                   value="{{ old('due_date', isset($task) ? $task->due_date->format('Y-m-d') : '') }}"
                   class="mt-1 block w-full  bg-white dark:bg-[#171B21] border border-gray-300 dark:border-gray-600 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500" required/>
            @error('due_date')
                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        {{-- Priority --}}
        <div>
            <label for="priority_id" class="block text-sm font-medium text-black dark:text-white required">Priority</label>
            <select id="priority_id" name="priority_id"
                   class="mt-1 block w-full bg-white dark:bg-[#171B21] border border-gray-300 dark:border-gray-600 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500"required>
                <option value="">Select Priority</option>
                @foreach($priorities as $priority)
                    <option value="{{ $priority->id }}" {{ old('priority_id', $task->priority_id ?? '') == $priority->id ? 'selected' : '' }}>
                        {{ $priority->title }}
                    </option>
                @endforeach
            </select>
            @error('priority_id')
                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        {{-- Status --}}
        <div>
            <label for="status_id" class="block text-sm font-medium text-black dark:text-white required">Status</label>
            <select id="status_id" name="status_id"
                    class="mt-1 block w-full  bg-white dark:bg-[#171B21] border border-gray-300 dark:border-gray-600 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500"required>
                <option value="">Select Status</option>
                @foreach($statuses as $status)
                    <option value="{{ $status->id }}" {{ old('status_id', $task->status_id ?? '') == $status->id ? 'selected' : '' }}>
                        {{ $status->title }}
                    </option>
                @endforeach
            </select>
            @error('status_id')
                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
            @enderror
        </div>

             {{-- Assigned Clients --}}
        <div class="md:col-span-2">
            <label for="assigned_clients" class="block text-sm font-medium text-black dark:text-white required">Assign To Clients</label>
            <select id="assigned_clients" name="assigned_clients[]" multiple
                    class="select2 mt-1 block w-full rounded-md  bg-white border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2"required>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}"
                        {{ in_array($client->id, old('assigned_clients', $assignedClients ?? [])) ? 'selected' : '' }}>
                        {{ $client->first_name }} {{ $client->last_name }}
                    </option>
                @endforeach
            </select>
            @error('assigned_clients')
                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        {{-- Job Type --}}
        <div>
            <label for="job_type_id" class="block text-sm font-medium text-black dark:text-white required">Job Type</label>
            <select id="job_type_id" name="job_type_id"
                     class="mt-1 block w-full   bg-white dark:bg-[#171B21] border border-gray-300 dark:border-gray-600 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500"required>
                <option value="">Select Job Type</option>
                @foreach($jobTypes as $jobType)
                    <option value="{{ $jobType->id }}"
                        data-steps='@json(json_decode($jobType->job_steps))'
                        {{ (old('job_type_id') == $jobType->id || (isset($task) && $task->job_type_id == $jobType->id)) ? 'selected' : '' }}>
                        {{ $jobType->job_type }}
                    </option>
                @endforeach
            </select>
            @error('job_type_id')
                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        {{-- Initial Task Image Upload --}}
        <div>
            <label for="initial_task_image" class="block text-sm font-medium text-black dark:text-white {{ isset($task) ? '' : 'required' }}">
                Initial Task Image
            </label>
            <input type="file" name="initial_task_image" id="initial_task_image" accept="image/*"
                   class="mt-1 block w-full  bg-white dark:bg-[#171B21] border border-gray-300 dark:border-gray-600 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500" required/>
            @error('initial_task_image')
                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
            @enderror

            @if (isset($task) && $task->initial_task_image)
                <p class="mt-1 text-sm text-black dark:text-white">Current image:</p>
                <img src="{{ asset('public/' . $task->initial_task_image) }}" alt="Initial Task Image"
                     class="mt-1 w-32 h-32 object-cover rounded-md border border-gray-300 dark:border-gray-600">
            @endif
        </div>

       {{-- Job Steps --}}
        <div>
            <label class="block text-sm font-medium text-black dark:text-white ">Job Steps</label>
            
            <div id="job_steps_container"
                 class="mt-1 p-2 min-h-[40px] border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-[#171B21] shadow-sm"required>
                
                <ul id="job_steps_list" style="color: #767D88;" class="list-disc pl-5 text-sm text-black">
                    @if (old('job_type_id') || (isset($task) && $task->jobType))
                        @foreach (json_decode(old('job_steps', $task->jobType->job_steps ?? '[]')) as $step)
                            <li>{{ $step }}</li>
                        @endforeach
                    @else
                        <li>Select a job type to see steps...</li>
                    @endif
                </ul>
            </div>
        </div>


    </div>

    <div class="flex justify-center mt-4">
        <div class="flex items-center">
            <input 
                id="send_notification" 
                name="send_notification" 
                type="checkbox" 
                class="h-4 w-4 text-black dark:text-white bg-white dark:bg-[#171B21] border-gray-300 dark:border-gray-600 rounded focus:ring-indigo-500"
                {{ old('send_notification') ? 'checked' : '' }}>
            <label for="send_notification" class="ml-2 text-sm text-black dark:text-white">
                Send email notification to assigned clients
            </label>
        </div>
    </div>

    <div class="btn-container mt-4">
        <button type="submit" class="submit-btn bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md">
            {{ isset($task) ? 'Update Task' : 'Continue' }}
        </button>
    </div>
</form>


</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
//   $(document).ready(function () {
//     $('.select2').each(function () {
//         $(this).select2({
//             theme: 'default',
//             width: '100%',
//             dropdownParent: $(this).closest('div')
//         });
//     });
// });


</script>
<script>
    $(document).ready(function() {
        $('.select2').select2();

        // Get the job_steps_container and job_steps_list
        var jobStepsContainer = $('#job_steps_container');
        var jobStepsList = $('#job_steps_list');

        // Function to update job steps display
        function updateJobSteps(selectedJobTypeId) {
            if (selectedJobTypeId) {
                var selectedOption = $('#job_type_id option[value="' + selectedJobTypeId + '"]');
                var jobStepsData = selectedOption.data('steps');

                jobStepsList.empty(); // Clear existing steps

                if (jobStepsData && jobStepsData.length > 0) {
                    jobStepsData.forEach(function(step) {
                        jobStepsList.append('<li>' + step + '</li>');
                    });
                } else {
                    jobStepsList.append('<li>No steps defined for this job type.</li>');
                }
            } else {
                jobStepsList.empty();
                jobStepsList.append('<li>Select a job type to see steps...</li>');
            }
        }

        // Initial call to set job steps based on old value or existing task
        var initialJobTypeId = $('#job_type_id').val();
        updateJobSteps(initialJobTypeId);

        // Event listener for job type select change
        $('#job_type_id').on('change', function() {
            updateJobSteps($(this).val());
        });

       

        // Ensure the initial_task_image is only required on create
        var isUpdatePage = {{ isset($task) ? 'true' : 'false' }};
        if (isUpdatePage) {
            $('#initial_task_image').prop('required', false);
        }
    });
</script>

@endsection