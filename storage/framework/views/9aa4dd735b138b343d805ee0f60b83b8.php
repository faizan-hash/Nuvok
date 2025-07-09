<?php
    $items = app(\App\Services\Common\MenuService::class)->generate();
    $isAdmin = \Auth::user()?->isAdmin();
    // Exclude specific keys including 'pages' and 'google_adsense'
    $excludedKeys = ['license', 'frontend', 'marketplace', 'update', 'blog', 'themes', 'announcements', 'pages', 'google_adsense'];
?>

<?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if(!in_array($key, $excludedKeys) && \App\Helpers\Classes\PlanHelper::planMenuCheck($userPlan, $key)): ?>
        <?php if(data_get($item, 'is_admin')): ?>
            <?php if($isAdmin): ?>
                <?php if(data_get($item, 'show_condition', true) && data_get($item, 'is_active')): ?>
                    <?php if($item['children_count']): ?>
                        <?php if ($__env->exists('default.components.navbar.partials.types.item-dropdown')) echo $__env->make('default.components.navbar.partials.types.item-dropdown', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php else: ?>
                        <?php if ($__env->exists('default.components.navbar.partials.types.' . $item['type'])) echo $__env->make('default.components.navbar.partials.types.' . $item['type'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endif; ?>
        <?php else: ?>
            <?php if(data_get($item, 'show_condition', true) && data_get($item, 'is_active')): ?>
                <?php if($item['children_count']): ?>
                    <?php if ($__env->exists('default.components.navbar.partials.types.item-dropdown')) echo $__env->make('default.components.navbar.partials.types.item-dropdown', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php else: ?>
                    <?php if ($__env->exists('default.components.navbar.partials.types.' . $item['type'])) echo $__env->make('default.components.navbar.partials.types.' . $item['type'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH /var/www/Novuk/resources/views/default/panel/layout/partials/menu.blade.php ENDPATH**/ ?>