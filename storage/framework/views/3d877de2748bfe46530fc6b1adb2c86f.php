<?php if (isset($component)) { $__componentOriginal3b4e0a1d5ce26d5a5fd0d9220bdf3aab = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3b4e0a1d5ce26d5a5fd0d9220bdf3aab = $attributes; } ?>
<?php $component = App\View\Components\Titlebar::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('titlebar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Titlebar::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Illuminate\Support\Arr::toCssClasses([
        'px-5 lg:px-10' => isset($layout_wide),
    ])),'layout-wide' => ''.e(isset($layout_wide) ? $layout_wide : '').'']); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3b4e0a1d5ce26d5a5fd0d9220bdf3aab)): ?>
<?php $attributes = $__attributesOriginal3b4e0a1d5ce26d5a5fd0d9220bdf3aab; ?>
<?php unset($__attributesOriginal3b4e0a1d5ce26d5a5fd0d9220bdf3aab); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3b4e0a1d5ce26d5a5fd0d9220bdf3aab)): ?>
<?php $component = $__componentOriginal3b4e0a1d5ce26d5a5fd0d9220bdf3aab; ?>
<?php unset($__componentOriginal3b4e0a1d5ce26d5a5fd0d9220bdf3aab); ?>
<?php endif; ?>
<?php /**PATH /var/www/Novuk/resources/views/default/panel/layout/titlebar.blade.php ENDPATH**/ ?>