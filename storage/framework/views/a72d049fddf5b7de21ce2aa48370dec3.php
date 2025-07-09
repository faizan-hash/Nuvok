<?php if (isset($component)) { $__componentOriginalb27b722146f03c6dfe842ca439b6bf3b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb27b722146f03c6dfe842ca439b6bf3b = $attributes; } ?>
<?php $component = App\View\Components\Navbar\Item::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('navbar.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Navbar\Item::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <?php if (isset($component)) { $__componentOriginal126c4535e58580b638d09b22979d8bfc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal126c4535e58580b638d09b22979d8bfc = $attributes; } ?>
<?php $component = App\View\Components\Navbar\Divider::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('navbar.divider'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Navbar\Divider::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal126c4535e58580b638d09b22979d8bfc)): ?>
<?php $attributes = $__attributesOriginal126c4535e58580b638d09b22979d8bfc; ?>
<?php unset($__attributesOriginal126c4535e58580b638d09b22979d8bfc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal126c4535e58580b638d09b22979d8bfc)): ?>
<?php $component = $__componentOriginal126c4535e58580b638d09b22979d8bfc; ?>
<?php unset($__componentOriginal126c4535e58580b638d09b22979d8bfc); ?>
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
<?php endif; ?><?php /**PATH /var/www/Novuk/resources/views/default/components/navbar/partials/types/divider.blade.php ENDPATH**/ ?>