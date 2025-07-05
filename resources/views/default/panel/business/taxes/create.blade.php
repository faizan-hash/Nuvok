<<<<<<< HEAD
@extends('panel.layout.settings', ['layout' => 'fullwidth'])
@section('title', isset($tax) ? __('Edit Tax') : __('Create New Tax'))
@section('titlebar_actions', '')
@section('additional_css')
<style>
     .text-sm{
        color:#89909D;
    }
    .rounded-md{
        color:#89909D;
    }
</style>
    <link href="{{ custom_theme_url('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('bussiness/custom-create.css') }}" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7692faf57e.js" crossorigin="anonymous"></script>
@endsection
@section('settings')
<div class="business-taxes w-full">
   <form method="POST" 
      action="{{ isset($tax) ? route('dashboard.business.taxes.update', $tax->id) : route('dashboard.business.taxes.store') }}" 
      class="tax-form space-y-6">
    @csrf
    @isset($tax)
        @method('PUT')
    @endisset
    
  <div class="form-row grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="form-group">
        <label for="name" class="block text-sm font-medium text-black dark:text-white required">Tax Name</label>
        <input type="text" id="name" name="name" 
               value="{{ old('name', $tax->name ?? '') }}" 
               placeholder="e.g. VAT, GST, Sales Tax"
               required
               class="mt-1 block w-full text-black dark:text-white bg-white dark:bg-[#171B21] border border-gray-300 dark:border-gray-600 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500" />
        @error('name')
            <span class="block mt-1 text-sm text-red-500">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="rate" class="block text-sm font-medium text-black dark:text-white required">Rate (%)</label>
        <input type="number" id="rate" name="rate" 
               value="{{ old('rate', $tax->rate ?? '') }}" 
               min="0" max="100" step="0.01"
               placeholder="e.g. 18.5"
               required
               class="mt-1 block w-full text-black dark:text-white bg-white dark:bg-[#171B21] border border-gray-300 dark:border-gray-600 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500" />
        @error('rate')
            <span class="text-sm mt-1 block text-red-500">{{ $message }}</span>
        @enderror
    </div>
</div>


    <div class="btn-container">
        <button type="submit" class="submit-btn bg-indigo-600 text-white hover:bg-indigo-700 px-4 py-2 rounded-md">
            {{ isset($tax) ? 'Update' : 'Continue' }} 
        </button>
    </div>
</form>
</div>
=======
@extends('panel.layout.settings', ['layout' => 'fullwidth'])
@section('title', isset($tax) ? __('Edit Tax') : __('Create New Tax'))
@section('titlebar_actions', '')
@section('additional_css')
<style>
     .text-sm{
        color:#89909D;
    }
    .rounded-md{
        color:#89909D;
    }
</style>
    <link href="{{ custom_theme_url('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('bussiness/custom-create.css') }}" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7692faf57e.js" crossorigin="anonymous"></script>
@endsection
@section('settings')
<div class="business-taxes w-full">
   <form method="POST" 
      action="{{ isset($tax) ? route('dashboard.business.taxes.update', $tax->id) : route('dashboard.business.taxes.store') }}" 
      class="tax-form space-y-6">
    @csrf
    @isset($tax)
        @method('PUT')
    @endisset
    
  <div class="form-row grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="form-group">
        <label for="name" class="block text-sm font-medium text-black dark:text-white required">Tax Name</label>
        <input type="text" id="name" name="name" 
               value="{{ old('name', $tax->name ?? '') }}" 
               placeholder="e.g. VAT, GST, Sales Tax"
               required
               class="mt-1 block w-full text-black dark:text-white bg-white dark:bg-[#171B21] border border-gray-300 dark:border-gray-600 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500" />
        @error('name')
            <span class="block mt-1 text-sm text-red-500">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="rate" class="block text-sm font-medium text-black dark:text-white required">Rate (%)</label>
        <input type="number" id="rate" name="rate" 
               value="{{ old('rate', $tax->rate ?? '') }}" 
               min="0" max="100" step="0.01"
               placeholder="e.g. 18.5"
               required
               class="mt-1 block w-full text-black dark:text-white bg-white dark:bg-[#171B21] border border-gray-300 dark:border-gray-600 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500" />
        @error('rate')
            <span class="text-sm mt-1 block text-red-500">{{ $message }}</span>
        @enderror
    </div>
</div>


    <div class="btn-container">
        <button type="submit" class="submit-btn bg-indigo-600 text-white hover:bg-indigo-700 px-4 py-2 rounded-md">
            {{ isset($tax) ? 'Update' : 'Continue' }} 
        </button>
    </div>
</form>
</div>
>>>>>>> f4799b86f474e344473c5131907406fc349bf0dc
@endsection