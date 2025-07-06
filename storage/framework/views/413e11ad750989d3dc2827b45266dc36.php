<?php $__env->startSection('content'); ?>
    <header class="fixed inset-x-0 top-0 flex justify-center border-b bg-background/10 px-4 py-6 backdrop-blur-md">
        <figure>
            <?php if(isset($setting->logo_dashboard)): ?>
                <img
                    class="max-h-14 w-auto dark:hidden"
                    src="<?php echo e(custom_theme_url($setting->logo_dashboard_path, true)); ?>"
                    <?php if(isset($setting->logo_dashboard_2x_path)): ?> srcset="/<?php echo e($setting->logo_dashboard_2x_path); ?> 2x" <?php endif; ?>
                    alt="<?php echo e($setting->site_name); ?>"
                >
                <img
                    class="hidden max-h-14 w-auto dark:block"
                    src="<?php echo e(custom_theme_url($setting->logo_dashboard_dark_path, true)); ?>"
                    <?php if(isset($setting->logo_dashboard_dark_2x_path)): ?> srcset="/<?php echo e($setting->logo_dashboard_dark_2x_path); ?> 2x" <?php endif; ?>
                    alt="<?php echo e($setting->site_name); ?>"
                >
            <?php else: ?>
                <img
                    class="max-h-14 w-auto dark:hidden"
                    src="<?php echo e(custom_theme_url($setting->logo_path, true)); ?>"
                    <?php if(isset($setting->logo_2x_path)): ?> srcset="/<?php echo e($setting->logo_2x_path); ?> 2x" <?php endif; ?>
                    alt="<?php echo e($setting->site_name); ?>"
                >
                <img
                    class="hidden max-h-14 w-auto dark:block"
                    src="<?php echo e(custom_theme_url($setting->logo_dark_path, true)); ?>"
                    <?php if(isset($setting->logo_dark_2x_path)): ?> srcset="/<?php echo e($setting->logo_dark_2x_path); ?> 2x" <?php endif; ?>
                    alt="<?php echo e($setting->site_name); ?>"
                >
            <?php endif; ?>
        </figure>
    </header>
    <div class="flex min-h-screen flex-col items-center justify-center py-12">
        <div class="mx-auto w-full pt-20 text-center lg:w-5/12">
            <h1 class="text-[40vw] leading-none opacity-10 sm:text-[212px]">
                <?php echo $__env->yieldContent('error_code', '404'); ?>
            </h1>

            <h3 class="text-4xl font-bold">
                <?php echo $__env->yieldContent('error_title', __('Looks like you’re lost.')); ?>
            </h3>

            <p class="mb-14 text-sm font-medium opacity-90">
                <?php echo $__env->yieldContent('error_subtitle', __('We can’t seem to find the page you’re looking for.')); ?>
            </p>

            <div class="mx-auto sm:w-8/12">
                <?php if (isset($component)) { $__componentOriginale67687e3e4e61f963b25a6bcf3983629 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale67687e3e4e61f963b25a6bcf3983629 = $attributes; } ?>
<?php $component = App\View\Components\Button::resolve(['size' => 'lg','href' => ''.e(route('index')).''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Button::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-full']); ?>
                    <?php echo e(__('Take me back to the homepage')); ?>

                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale67687e3e4e61f963b25a6bcf3983629)): ?>
<?php $attributes = $__attributesOriginale67687e3e4e61f963b25a6bcf3983629; ?>
<?php unset($__attributesOriginale67687e3e4e61f963b25a6bcf3983629); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale67687e3e4e61f963b25a6bcf3983629)): ?>
<?php $component = $__componentOriginale67687e3e4e61f963b25a6bcf3983629; ?>
<?php unset($__componentOriginale67687e3e4e61f963b25a6bcf3983629); ?>
<?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('panel.layout.app', ['disable_tblr' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\DELL\Desktop\Novuk\resources\views/default/layout/error.blade.php ENDPATH**/ ?>