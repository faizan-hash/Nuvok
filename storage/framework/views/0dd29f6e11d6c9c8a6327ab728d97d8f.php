<head>
    <?php if(! empty($setting->google_analytics_code)): ?>
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo e($setting->google_analytics_code); ?>"></script>
   

    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() {dataLayer.push(arguments);}
        gtag("js", new Date());
        gtag("config", '<?php echo e($setting->google_analytics_code); ?>');
    </script>
    <?php endif; ?>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="description" content="<?php echo e(getMetaDesc($setting, $settings_two)); ?>">
    <?php if(isset($setting->meta_keywords)): ?>
        <meta name="keywords" content="<?php echo e($setting->meta_keywords); ?>">
    <?php endif; ?>
    <style>
        table.dataTable td.sorting_1 {
    background-color: transparent !important;
}
table.dataTable td.sorting_1 {
    background-color: transparent !important;
}
    </style>
   
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <!-- Select2 CSS -->
     <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link rel="icon" href="<?php echo e(custom_theme_url($setting->favicon_path ?? 'assets/favicon.ico', true)); ?>">
    <title><?php echo e(getMetaTitle($setting, $settings_two, ' ') ?? $setting->site_name); ?> | <?php echo $__env->yieldContent('title'); ?></title>
    <?php if(filled($google_fonts_string = \App\Helpers\Classes\ThemeHelper::googleFontsString())): ?>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?<?php echo e($google_fonts_string); ?>&display=swap" rel="stylesheet">
    <?php endif; ?>
    <script>window.liquid = {assetsPath: '<?php echo e(custom_theme_url('assets')); ?>'};</script>
    <!-- CSS files -->
    <?php if(!isset($disable_tblr) && empty($disable_tblr)): ?>
        <link href="<?php echo e(custom_theme_url('/assets/css/tabler.css')); ?>" rel="stylesheet"/>
        <link href="<?php echo e(custom_theme_url('/assets/css/tabler-vendors.css')); ?>" rel="stylesheet"/>
    <?php endif; ?>
    <link href="<?php echo e(custom_theme_url('/assets/libs/toastr/toastr.min.css')); ?>" rel="stylesheet"/>
    <link href="<?php echo e(custom_theme_url('/assets/libs/introjs/introjs.min.css')); ?>" rel="stylesheet">
    <?php echo $__env->yieldContent('additional_css'); ?>
    <?php echo $__env->yieldPushContent('css'); ?>
    <?php echo app('Illuminate\Foundation\Vite')(\App\Helpers\Classes\ThemeHelper::dashboardScssPath()); ?>
    <?php if($setting->dashboard_code_before_head != null): ?>
        <?php echo $setting->dashboard_code_before_head; ?>

    <?php endif; ?>
    <?php echo setting('google_tag_manager',''); ?>

    <script>window.pusherConfig = <?php echo json_encode(\Illuminate\Support\Arr::except(config('broadcasting.connections.pusher'), ['secret', 'app_id'])) ?>;</script>
    <?php echo app('Illuminate\Foundation\Vite')(\App\Helpers\Classes\ThemeHelper::appJsPath()); ?>
    <?php if(setting('additional_custom_css') != null): ?>
        <?php echo setting('additional_custom_css'); ?>

    <?php endif; ?>
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

    <?php echo $__env->yieldPushContent('before-head-close'); ?>
</head>
<?php /**PATH F:\DELL\Desktop\Novuk\resources\views/default/panel/layout/partials/head.blade.php ENDPATH**/ ?>