<?php if($item['show_condition']): ?>
    <?php
        $href =
            $item['route_slug'] && \App\Helpers\Classes\Helper::hasRoute($item['route'])
                ? route($item['route'], $item['route_slug'])
                : (\App\Helpers\Classes\Helper::hasRoute($item['route'])
                    ? route($item['route'])
                    : '');
        $is_active = $href === url()->current() || activeRoute(...$item['active_condition'] ?: []);
    ?>

    <?php if (isset($component)) { $__componentOriginalb27b722146f03c6dfe842ca439b6bf3b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb27b722146f03c6dfe842ca439b6bf3b = $attributes; } ?>
<?php $component = App\View\Components\Navbar\Item::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('navbar.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Navbar\Item::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => ''.e(data_get($item, 'parent_key') ? data_get($item, 'parent_key') . '-' : '').''.e(data_get($item, 'key')).'']); ?>
        <?php if (isset($component)) { $__componentOriginal4bc111d20df937dde026191dc017d829 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4bc111d20df937dde026191dc017d829 = $attributes; } ?>
<?php $component = App\View\Components\Navbar\Link::resolve(['letterIconStyles' => ''.e($item['letter_icon_bg']).'','label' => ''.e(__($item['label'])).'','href' => ''.e($item['route']).'','slug' => ''.e($item['route_slug']).'','icon' => ''.e($item['icon']).'','activeCondition' => ''.e($is_active).'','letterIcon' => ''.e((int) $item['letter_icon']).'','badge' => ''.e(data_get($item, 'badge') ?? '').''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('navbar.link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Navbar\Link::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class:letter-icon' => ''.e($item['letter_icon_bg']).'','class' => ''.e(data_get($item, 'class')).'','data-name' => ''.e(data_get($item, 'data-name')).'','onclick' => ''.e(data_get($item, 'onclick') ?? '').'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4bc111d20df937dde026191dc017d829)): ?>
<?php $attributes = $__attributesOriginal4bc111d20df937dde026191dc017d829; ?>
<?php unset($__attributesOriginal4bc111d20df937dde026191dc017d829); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4bc111d20df937dde026191dc017d829)): ?>
<?php $component = $__componentOriginal4bc111d20df937dde026191dc017d829; ?>
<?php unset($__componentOriginal4bc111d20df937dde026191dc017d829); ?>
<?php endif; ?>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb27b722146f03c6dfe842ca439b6bf3b)): ?>
<?php $attributes = $__attributesOriginalb27b722146f03c6dfe842ca439b6bf3b; ?>
<?php unset($__attributesOriginalb27b722146f03c6dfe842ca439b6bf3b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb27b722146f03c6dfe842ca439b6bf3b)): ?>
<?php $component = $__componentOriginalb27b722146f03c6dfe842ca439b6bf3b; ?>
<?php unset($__componentOriginalb27b722146f03c6dfe842ca439b6bf3b); ?>
<?php endif; ?>
<?php endif; ?>
<?php /**PATH /var/www/Novuk/resources/views/default/components/navbar/partials/types/item.blade.php ENDPATH**/ ?>