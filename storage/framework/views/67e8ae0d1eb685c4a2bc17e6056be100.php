<footer class="lqd-page-footer mt-auto py-8">
    <div class="container">
        <div class="flex flex-wrap items-center gap-4 md:flex-nowrap">
            <div class="order-2 grow basis-full md:order-first md:basis-0 lg:ms-auto">
                <p><?php echo e(__('Version')); ?>: <?php echo e(format_double($setting->script_version)); ?></p>
                <?php if(Config::get('app.show_load_time') === true): ?>
					<?php echo e(__('Load time')); ?>:
                    <?php echo e(microtime(true) - LARAVEL_START); ?>

                <?php endif; ?>
            </div>
            <div class="grow basis-full md:basis-0 md:text-end">
                <p>
                    <?php echo e(__('Copyright')); ?> &copy; <?php echo date('Y'); ?>
                    <a href="<?php echo e(route('index')); ?>">
                        <?php echo e($setting->site_name); ?>

                    </a>.
                    <?php echo e(__('All rights reserved.')); ?>

                </p>
            </div>
        </div>
    </div>
</footer>
<?php /**PATH /var/www/Novuk/resources/views/default/panel/layout/footer.blade.php ENDPATH**/ ?>