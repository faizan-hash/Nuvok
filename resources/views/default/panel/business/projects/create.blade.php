@use(\App\Domains\Entity\Enums\EntityEnum)
@extends('panel.layout.settings', ['layout' => 'fullwidth'])

@section('title', isset($project) ? __('Edit Project') : __('Create New Project'))
@section('titlebar_actions', '')

@section('additional_css')

<style>
    /* Form container */
    /*.text-sm{*/
    /*    color:#89909D;*/
    /*}*/
    .rounded-md{
        color:#89909D;
    }


    /* Native select text color */
    select {
        color: #89909D !important;
    }
    .dark select {
        color: #d1d5db !important;
    }

    
</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="{{ asset('bussiness/custom-create.css') }}" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<script src="https://kit.fontawesome.com/7692faf57e.js" crossorigin="anonymous"></script>
@endsection
@section('settings')
    <div class="business-projects w-full">
    <form method="POST" 
      action="{{ isset($project) ? route('dashboard.business.projects.update', $project->id) : route('dashboard.business.projects.store') }}" 
      enctype="multipart/form-data" 
      class="project-form space-y-6">
    @csrf
    @if(isset($project))
        @method('PUT')
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        {{-- Title Field --}}
        <div>
            <label for="title" class="block text-sm font-medium text-black dark:text-white required">Title</label>
            <input type="text" id="title" name="title" 
                   value="{{ old('title', $project->title ?? '') }}" 
                   placeholder="Enter Project Title"
                   class="mt-1 block w-full text-black dark:text-white bg-white dark:bg-[#171B21] border border-gray-300 dark:border-gray-600 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500"
                   style="height: 40px; padding: 10px;" required>
            @error('title')
                <span class="block mt-1 text-sm text-red-500">{{ $message }}</span>
            @enderror
        </div>

        {{-- Status Field --}}
        <div>
            <label for="status_id" class="block text-sm font-medium text-black dark:text-white required">Status</label>
            <select id="status_id" name="status_id"
                    class="mt-1 block w-full text-black dark:text-white bg-white dark:bg-[#171B21] border border-gray-300 dark:border-gray-600 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500"
                    style="height: 40px; padding: 10px;" required>
                <option value="">Select Status</option>
                <option value="1" {{ old('status_id', $project->status_id ?? '') == 1 ? 'selected' : '' }}>Pending</option>
                <option value="2" {{ old('status_id', $project->status_id ?? '') == 2 ? 'selected' : '' }}>In Progress</option>
                <option value="3" {{ old('status_id', $project->status_id ?? '') == 3 ? 'selected' : '' }}>Completed</option>
            </select>
            @error('status_id')
                <span class="block mt-1 text-sm text-red-500">{{ $message }}</span>
            @enderror
        </div>

        {{-- Starting Date Field --}}
        <div>
            <label for="starting_date" class="block text-sm font-medium text-black dark:text-white required">Starting Date</label>
            <input type="date" id="starting_date" name="starting_date"
                   value="{{ old('starting_date', $project->starting_date ?? '') }}"
                  class="mt-1 block w-full  dark:text-[#656667] bg-white dark:bg-[#171B21] border border-gray-300 dark:border-gray-600 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500"
                   style="height: 40px; padding: 10px;">
            @error('starting_date')
                <span class="block mt-1 text-sm text-red-500">{{ $message }}</span>
            @enderror
        </div>

        {{-- Ending Date Field --}}
        <div>
            <label for="ending_date" class="block text-sm font-medium text-black dark:text-white required">Ending Date</label>
            <input type="date" id="ending_date" name="ending_date"
                   value="{{ old('ending_date', $project->ending_date ?? '') }}"
                  class="mt-1 block w-full  bg-white dark:bg-[#171B21] border border-gray-300 dark:border-gray-600 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500"
                   style="height: 40px; padding: 10px;">
            @error('ending_date')
                <span class="block mt-1 text-sm text-red-500">{{ $message }}</span>
            @enderror
        </div>

        {{-- Budget Field --}}
        <div>
            <label for="budget" class="block text-sm font-medium text-black dark:text-white required">Budget</label>
            <input type="number" step="0.01" id="budget" name="budget"
                   value="{{ old('budget', $project->budget ?? '') }}"
                   placeholder="Enter Budget"
                   class="mt-1 block w-full text-black dark:text-white bg-white dark:bg-[#171B21] border border-gray-300 dark:border-gray-600 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500"
                   style="height: 40px; padding: 10px;">
            @error('budget')
                <span class="block mt-1 text-sm text-red-500">{{ $message }}</span>
            @enderror
        </div>

       {{-- Project User --}}
        <div>
            <label for="user_id" class="block text-sm font-medium text-black dark:text-white required">
                Project User
                <div class="icon-container">
                    <span class="icon-hover">
                        <i class="fas fa-question-circle"></i>
                    </span>
                    <div class="hover-box">
                        Select one or more users to assign to this project. Users represent project team members with specific roles.
                    </div>
                </div>
            </label>
            <select id="user_id" name="user_id[]" multiple
                    class="select2 mt-1 block w-full rounded-md border border-gray-600 bg-gray-700 text-gray-200 shadow-sm focus:border-indigo-400 focus:ring-indigo-400"
                    style="height: 40px; padding: 10px;">
                @foreach($clients as $user)
                    <option value="{{ $user->id }}"
                        {{ in_array($user->id, old('user_id', isset($project) ? $project->users->pluck('id')->toArray() : [])) ? 'selected' : '' }}>
                        {{ $user->first_name }} {{ $user->last_name }}
                    </option>
                @endforeach
            </select>
            @error('user_id')
                <span class="block mt-1 text-sm text-red-500">{{ $message }}</span>
            @enderror
        </div>


        {{-- Client Field --}}
        <div>
            <label for="client_id" class="block text-sm font-medium text-black dark:text-white required">Client</label>
            <select id="client_id" name="client_id"
                   class="mt-1 block w-full text-black dark:text-white bg-white dark:bg-[#171B21] border border-gray-300 dark:border-gray-600 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500"
                    style="height: 40px; padding: 10px;">
                <option value="">Select Client</option>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}" {{ old('client_id', $project->client_id ?? '') == $client->id ? 'selected' : '' }}>
                        {{ $client->first_name }} {{ $client->last_name }}
                    </option>
                @endforeach
            </select>
            @error('client_id')
                <span class="block mt-1 text-sm text-red-500">{{ $message }}</span>
            @enderror
        </div>

        {{-- Description Field --}}
        <div class="md:col-span-2">
            <label for="description" class="block text-sm font-medium text-black dark:text-white required">Description</label>
            <textarea id="description" name="description"
                      placeholder="Enter Description"
                      rows="4"
                      class="mt-1 block w-full text-black dark:text-white bg-white dark:bg-[#171B21] border border-gray-300 dark:border-gray-600 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500"
                      style="padding: 10px;">{{ old('description', $project->description ?? '') }}</textarea>
            @error('description')
                <span class="block mt-1 text-sm text-red-500">{{ $message }}</span>
            @enderror
        </div>
    </div>
 
    {{-- Submit Button --}}
    <div class="btn-container">
        <button type="submit" class="submit-btn bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md">
            {{ isset($project) ? 'Update' : 'Continue' }} 
        </button>
    </div>
</form>


    </div>
    {{-- Include jQuery before Select2 --}}
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function () {
        $('.select2').select2({
            width: 'resolve', // Ensures proper width if inside Tailwind form elements
            placeholder: "Select users",
            allowClear: true
        });
    });
</script>

@endsection