<div class="lqd-empty-doc flex flex-col items-center justify-center py-8 text-center lg:min-h-[450px]">
    <figure class="mb-5">
        <svg
            class="fill-primary/30"
            width="150"
            height="150"
            viewBox="0 0 150 150"
            xmlns="http://www.w3.org/2000/svg"
        >
            <path d="M75 150C116.421 150 150 116.421 150 75C150 33.5786 116.421 0 75 0C33.5786 0 0 33.5786 0 75C0 116.421 33.5786 150 75 150Z" />
            <path
                class="fill-background"
                d="M120 150H30V53C34.242 52.9952 38.3089 51.308 41.3084 48.3085C44.308 45.3089 45.9952 41.242 46 37H104C103.996 39.1014 104.408 41.1828 105.213 43.1238C106.018 45.0648 107.2 46.8268 108.691 48.308C110.172 49.7991 111.934 50.9816 113.875 51.787C115.817 52.5924 117.898 53.0047 120 53V150Z"
            />
            <path
                d="M88 108H62C60.3431 108 59 109.343 59 111C59 112.657 60.3431 114 62 114H88C89.6569 114 91 112.657 91 111C91 109.343 89.6569 108 88 108Z"
                fill-opacity="0.8"
            />
            <path
                d="M88 66H62C60.3431 66 59 67.3431 59 69C59 70.6569 60.3431 72 62 72H88C89.6569 72 91 70.6569 91 69C91 67.3431 89.6569 66 88 66Z"
                fill-opacity="0.8"
            />
            <path
                d="M97 120H53C51.3431 120 50 121.343 50 123C50 124.657 51.3431 126 53 126H97C98.6569 126 100 124.657 100 123C100 121.343 98.6569 120 97 120Z"
                fill-opacity="0.8"
            />
            <path
                d="M97 78H53C51.3431 78 50 79.3431 50 81C50 82.6569 51.3431 84 53 84H97C98.6569 84 100 82.6569 100 81C100 79.3431 98.6569 78 97 78Z"
                fill-opacity="0.8"
            />
        </svg>
    </figure>
    <h2 class="mb-4"><?php echo e(__("You don't have any documents.")); ?></h2>
    <p class="mb-5"><?php echo e(__('Start generating texts by adding a document.')); ?></p>
    <?php if (isset($component)) { $__componentOriginale67687e3e4e61f963b25a6bcf3983629 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale67687e3e4e61f963b25a6bcf3983629 = $attributes; } ?>
<?php $component = App\View\Components\Button::resolve(['variant' => 'ghost-shadow','href' => ''.e(LaravelLocalization::localizeUrl(route('dashboard.user.openai.list'))).''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Button::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
        <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('tabler-plus'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(BladeUI\Icons\Components\Svg::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'size-4']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $attributes = $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $component = $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>
        <?php echo e(__('Add New')); ?>

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
<?php /**PATH /var/www/Novuk/resources/views/default/panel/user/openai/documents_empty.blade.php ENDPATH**/ ?>