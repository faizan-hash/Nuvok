<?php if (isset($component)) { $__componentOriginalf4613edb01d2718d9bf48627a0341a40 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf4613edb01d2718d9bf48627a0341a40 = $attributes; } ?>
<?php $component = App\View\Components\Navbar\Navbar::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('navbar.navbar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Navbar\Navbar::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf4613edb01d2718d9bf48627a0341a40)): ?>
<?php $attributes = $__attributesOriginalf4613edb01d2718d9bf48627a0341a40; ?>
<?php unset($__attributesOriginalf4613edb01d2718d9bf48627a0341a40); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf4613edb01d2718d9bf48627a0341a40)): ?>
<?php $component = $__componentOriginalf4613edb01d2718d9bf48627a0341a40; ?>
<?php unset($__componentOriginalf4613edb01d2718d9bf48627a0341a40); ?>
<?php endif; ?>
<?php /**PATH /var/www/Novuk/resources/views/default/panel/layout/navbar.blade.php ENDPATH**/ ?>