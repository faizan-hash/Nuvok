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
    <?php if (isset($component)) { $__componentOriginalc9fbb615564265c2282eb7b2e59c05dd = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc9fbb615564265c2282eb7b2e59c05dd = $attributes; } ?>
<?php $component = App\View\Components\Navbar\Label::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('navbar.label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Navbar\Label::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e(__(data_get($item, 'label'))).'']); ?>
        <?php echo e(__(data_get($item, 'label'))); ?>

     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc9fbb615564265c2282eb7b2e59c05dd)): ?>
<?php $attributes = $__attributesOriginalc9fbb615564265c2282eb7b2e59c05dd; ?>
<?php unset($__attributesOriginalc9fbb615564265c2282eb7b2e59c05dd); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc9fbb615564265c2282eb7b2e59c05dd)): ?>
<?php $component = $__componentOriginalc9fbb615564265c2282eb7b2e59c05dd; ?>
<?php unset($__componentOriginalc9fbb615564265c2282eb7b2e59c05dd); ?>
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
<?php /**PATH /var/www/Novuk/resources/views/default/components/navbar/partials/types/label.blade.php ENDPATH**/ ?>