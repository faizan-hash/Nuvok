<a
        <?php echo e($attributes->class(['flex shrink-0 items-center justify-center'])); ?>

        href="<?php echo e(LaravelLocalization::localizeUrl(route('dashboard.index'))); ?>"
>
    <?php if(isset($setting->logo_dashboard)): ?>
        <img
                class="dark:hidden"
                src="<?php echo e(custom_theme_url($setting->logo_dashboard_path, true)); ?>"
                <?php if(isset($setting->logo_dashboard_2x_path)): ?> srcset="/<?php echo e($setting->logo_dashboard_2x_path); ?> 2x" <?php endif; ?>
                alt="<?php echo e($setting->site_name); ?>"
        >
        <img
                class="hidden dark:block"
                src="<?php echo e(custom_theme_url($setting->logo_dashboard_dark_path, true)); ?>"
                <?php if(isset($setting->logo_dashboard_dark_2x_path)): ?> srcset="/<?php echo e($setting->logo_dashboard_dark_2x_path); ?> 2x"
                <?php endif; ?>
                alt="<?php echo e($setting->site_name); ?>"
        >
    <?php else: ?>
        <img
                class="dark:hidden"
                src="<?php echo e(custom_theme_url($setting->logo_path, true)); ?>"
                <?php if(isset($setting->logo_2x_path)): ?> srcset="/<?php echo e($setting->logo_2x_path); ?> 2x" <?php endif; ?>
                alt="<?php echo e($setting->site_name); ?>"
        >
        <img
                class="hidden dark:block"
                src="<?php echo e(custom_theme_url($setting->logo_dark_path, true)); ?>"
                <?php if(isset($setting->logo_dark_2x_path)): ?> srcset="/<?php echo e($setting->logo_dark_2x_path); ?> 2x" <?php endif; ?>
                alt="<?php echo e($setting->site_name); ?>"
        >
    <?php endif; ?>
</a><?php /**PATH /var/www/Novuk/resources/views/components/header-logo.blade.php ENDPATH**/ ?>