<?php use \App\Domains\Entity\Enums\EntityEnum; ?>

<?php $__env->startSection('title', isset($client) ? __('Edit Client') : __('Create New Client')); ?>
<?php $__env->startSection('titlebar_actions', ''); ?>
<?php $__env->startSection('additional_css'); ?>
<style>
    .business-clients .form-group label {
    color: #89909D !important;
}

.dark .business-clients .form-group label {
    color: #89909D !important;
}
.font-medium{
    margin-top: 12px;
}
</style>
    <link href="<?php echo e(custom_theme_url('/assets/libs/select2/select2.min.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(asset('bussiness/custom-create.css')); ?>" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7692faf57e.js" crossorigin="anonymous"></script>
  
<?php $__env->stopSection(); ?>

<?php $__env->startSection('settings'); ?>
<div class="business-clients w-full">
<form method="POST" 
      action="<?php echo e(isset($client) ? route('dashboard.business.clients.update', $client->id) : route('dashboard.business.clients.store')); ?>" 
      enctype="multipart/form-data" 
      class="space-y-6">
    <?php echo csrf_field(); ?>
    <?php if(isset($client)): ?>
        <?php echo method_field('PUT'); ?>
    <?php endif; ?>

    
    <div class="flex justify-center">
        <div class="relative w-24 h-24">
            <img id="avatar-preview"
                 src="<?php echo e(isset($client) && $client->avatar ? asset('uploads/'.$client->avatar) : asset('bussiness/clints/download.png')); ?>"
                 alt="Client Avatar"
                 class="w-24 h-24 rounded-full object-cover border border-gray-300">
            <label for="avatar-upload"
                   class="absolute bottom-0 right-0 bg-white dark:bg-gray-700 p-1 rounded-full cursor-pointer border border-gray-300">
                <i class="fas fa-camera text-sm text-gray-600 dark:text-white"></i>
                <input id="avatar-upload" type="file" name="avatar" accept="image/*" class="hidden">
            </label>
        </div>
    </div>

    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label for="first_name" class="block text-sm font-medium text-gray-700 dark:text-white required">First Name</label>
            <input type="text" id="first_name" name="first_name"
                   value="<?php echo e(old('first_name', $client->first_name ?? '')); ?>"
                   class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-[#171B21] dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                   placeholder="Enter First Name" required>
            <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="text-sm block mt-1 text-red-500"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div>
            <label for="last_name" class="block text-sm font-medium text-gray-700 dark:text-white">Last Name</label>
            <input type="text" id="last_name" name="last_name"
                   value="<?php echo e(old('last_name', $client->last_name ?? '')); ?>"
                   class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-[#171B21] dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                   placeholder="Enter Last Name">
            <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="text-sm block mt-1 text-red-500"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
    </div>

    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label for="id_number" class="block text-sm font-medium text-gray-700 dark:text-white required">ID Number</label>
            <input type="text" id="id_number" name="id_number"
                   value="<?php echo e(old('id_number', $client->id_number ?? '')); ?>"
                   class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-[#171B21] dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                   placeholder="Enter ID Number" required>
            <?php $__errorArgs = ['id_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="text-sm block mt-1 text-red-500"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div>
            <label for="company_name" class="block text-sm font-medium text-gray-700 dark:text-white required">Company Name</label>
            <input type="text" id="company_name" name="company_name"
                   value="<?php echo e(old('company_name', $client->company_name ?? '')); ?>"
                   class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-[#171B21] dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                   placeholder="Enter Company Name" required>
            <?php $__errorArgs = ['company_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="text-sm block mt-1 text-red-500"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
    </div>

    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-white required">Email</label>
            <input type="email" id="email" name="email"
                   value="<?php echo e(old('email', $client->email ?? '')); ?>"
                   class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-[#171B21] dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                   placeholder="Enter Email" required>
            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="text-sm block mt-1 text-red-500"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div>
            <label for="mobile" class="block text-sm font-medium text-gray-700 dark:text-white required">Mobile</label>
            <input type="tel" id="mobile" name="mobile"
                   value="<?php echo e(old('mobile', $client->mobile ?? '')); ?>"
                   class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-[#171B21] dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                   placeholder="123 456 789" required>
            <?php $__errorArgs = ['mobile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="text-sm block mt-1 text-red-500"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
    </div>

    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label for="job_type" class="block text-sm font-medium text-gray-700 dark:text-white required">Job Type</label>
            <input type="text" id="job_type" name="job_type"
                   value="<?php echo e(old('job_type', $client->job_type ?? '')); ?>"
                   class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-[#171B21] dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                   placeholder="Enter Job Type" required>
            <?php $__errorArgs = ['job_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="text-sm block mt-1 text-red-500"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div>
            <label for="address" class="block text-sm font-medium text-gray-700 dark:text-white required">Address</label>
            <input type="text" id="address" name="address"
                   value="<?php echo e(old('address', $client->address ?? '')); ?>"
                   class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-[#171B21] dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                   placeholder="Enter Address" required>
            <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="text-sm block mt-1 text-red-500"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
    </div>

    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-white <?php echo e(!isset($client) ? 'required' : ''); ?>">Password</label>
            <input type="password" id="password" name="password"
                   placeholder="<?php echo e(isset($client) ? 'Leave blank to keep current' : 'Enter Password'); ?>"
                   class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-[#171B21] dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                   <?php echo e(!isset($client) ? 'required' : ''); ?>>
            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="text-sm block mt-1 text-red-500"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-white <?php echo e(!isset($client) ? 'required' : ''); ?>">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation"
                   placeholder="<?php echo e(isset($client) ? 'Leave blank to keep current' : 'Confirm Password'); ?>"
                   class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-[#171B21] dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                   <?php echo e(!isset($client) ? 'required' : ''); ?>>
            <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="text-sm block mt-1 text-red-500"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
    </div>

    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label for="industry" class="block text-sm font-medium text-gray-700 dark:text-white">Industry</label>
            <input type="text" id="industry" name="industry"
                   value="<?php echo e(old('industry', $client->industry ?? '')); ?>"
                   class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-[#171B21] dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                   placeholder="Enter Industry">
            <?php $__errorArgs = ['industry'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="text-sm block mt-1 text-red-500"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div>
            <label for="country" class="block text-sm font-medium text-gray-700 dark:text-white">Country</label>
            <input type="text" id="country" name="country"
                   value="<?php echo e(old('country', $client->country ?? '')); ?>"
                   class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-[#171B21] dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                   placeholder="Enter Country">
            <?php $__errorArgs = ['country'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="text-sm block mt-1 text-red-500"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
    </div>

    
    <div class="btn-container">
        <button type="submit" class="submit-btn bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md">
            <?php echo e(isset($client) ? 'Update' : 'Continue'); ?> 
        </button>
    </div>
</form>


<script>
document.addEventListener('DOMContentLoaded', function() {
  const avatarUpload = document.getElementById('avatar-upload');
  const avatarPreview = document.getElementById('avatar-preview');
  
  avatarUpload.addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
        avatarPreview.src = e.target.result;
      }
      reader.readAsDataURL(file);
    }
  });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('panel.layout.settings', ['layout' => 'fullwidth'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/Novuk/resources/views/default/panel/business/clients/create.blade.php ENDPATH**/ ?>