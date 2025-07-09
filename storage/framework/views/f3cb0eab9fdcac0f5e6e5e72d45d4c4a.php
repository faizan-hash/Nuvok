<?php
    $base_class = 'lqd-modal lqd-modal-' . $type . ' relative';
    $modal_base_class = 'lqd-modal-modal z-[999] flex items-center justify-center overflow-y-auto overscroll-contain';
    $modal_backdrop_base_class = 'lqd-modal-backdrop fixed inset-0 bg-black/5 backdrop-blur-sm';
    $modal_head_base_class = 'lqd-modal-head flex flex-wrap items-center gap-3 border-b px-4 py-2 relative';
    $modal_body_base_class = 'lqd-modal-body p-10';
    $modal_content_base_class =
        'lqd-modal-content relative z-[100] max-h-[95vh] min-w-[min(calc(100%-2rem),540px)] rounded-xl bg-background shadow-2xl shadow-black/10 overflow-y-auto';
    $modal_close_btn_base_class = 'lqd-modal-close size-8 ms-auto inline-flex items-center justify-center rounded-lg transition-all hover:bg-foreground/20';

    if ($type !== 'inline') {
        $modal_base_class .= ' fixed inset-0';
    } else {
        $modal_base_class .= ' hidden fixed max-md:inset-0 md:absolute top-full min-w-[min(calc(100vw-2rem),450px)] mt-3';

        if ($anchor === 'start') {
            $modal_base_class .= ' start-0';
        } else {
            $modal_base_class .= ' end-0';
        }
    }

    if ($type === 'page') {
        $modal_base_class .= ' ';
        $modal_content_base_class .= ' max-h-screen bg-transparent shadow-none w-[clamp(100%,1440px,90vw)]';
        $modal_head_base_class .= ' border-none p-0 w-[clamp(100%,1440px,90vw)]';
        $modal_body_base_class .= ' py-24 px-0';
        $modal_close_btn_base_class .= ' absolute top-11 end-0 lg:end-11 bg-background text-heading-foreground size-14 rounded-full hover:bg-background hover:scale-110';
    }
?>

<div
    <?php echo e($attributes->withoutTwMergeClasses()->twMerge($base_class, $attributes->get('class'))); ?>

    x-data="{
        modalOpen: false,
        toggleModal() {
            <?php if($disableModal): ?> toastr.info( '<?php echo e($disableModalMessage); ?>' )
			<?php else: ?>
			this.modalOpen = !this.modalOpen <?php endif; ?>
        }
    }"
>
    <?php if(!empty($trigger)): ?>
        <?php if($trigger->attributes['custom'] ?? false): ?>
            <?php echo e($trigger); ?>

        <?php else: ?>
            <?php if (isset($component)) { $__componentOriginale67687e3e4e61f963b25a6bcf3983629 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale67687e3e4e61f963b25a6bcf3983629 = $attributes; } ?>
<?php $component = App\View\Components\Button::resolve(['href' => ''.e($trigger->attributes['href']).'','variant' => ''.e($trigger->attributes['variant']).'','size' => ''.e($trigger->attributes['size']).''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Button::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => ''.e($trigger->attributes['class']).'','attributes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($attributes->twMergeFor('trigger')),'@click.prevent' => 'toggleModal()']); ?>
                <?php echo e($trigger); ?>

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
        <?php endif; ?>
    <?php endif; ?>
    <?php if(!empty($modal) && !$disableModal): ?>
        <?php if($type !== 'inline'): ?>
            <template x-teleport="body">
        <?php endif; ?>
        <div
            <?php echo e($modal->attributes); ?>

            <?php echo e($attributes->twMergeFor('modal', $modal_base_class)); ?>

            x-show="modalOpen"
            x-transition
            @keyup.escape="modalOpen = false"
            :class="{ 'hidden': !modalOpen }"
            <?php if(!$disableFocus): ?> x-trap="modalOpen" <?php endif; ?>
        >
            <div <?php echo e($attributes->twMergeFor('modal-backdrop', $modal_backdrop_base_class)); ?>></div>

            <div
                <?php echo e($attributes->twMergeFor('modal-content', $modal_content_base_class)); ?>

                @click.outside="modalOpen = false"
            >
                <?php if($type === 'page'): ?>
                    <div class="container px-0">
                <?php endif; ?>
                <?php if($type !== 'inline'): ?>
                    <div <?php echo e($attributes->twMergeFor('modal-head', $modal_head_base_class)); ?>>
                        <?php if(!empty($title)): ?>
                            <h4 class="my-0"><?php echo e($title); ?></h4>
                        <?php endif; ?>
                        <?php if(!empty($headContent)): ?>
                            <?php echo e($headContent); ?>

                        <?php endif; ?>

                        <button
                            <?php echo e($attributes->twMergeFor('close-btn', $modal_close_btn_base_class)); ?>

                            type="button"
                            @click.prevent="modalOpen = false"
                        >
                            <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('tabler-x'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(BladeUI\Icons\Components\Svg::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'size-5']); ?>
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
                        </button>
                    </div>
                <?php endif; ?>
                <?php if($type === 'page'): ?>
            </div>
    <?php endif; ?>

    <div <?php echo e($attributes->twMergeFor('modal-body', $modal_body_base_class)); ?>>
        <div class="container p-0">
            <?php echo e($modal); ?>

        </div>
    </div>
</div>
</div>
<?php if($type !== 'inline'): ?>
    </template>
<?php endif; ?>
<?php endif; ?>
</div>
<?php /**PATH /var/www/Novuk/resources/views/default/components/modal.blade.php ENDPATH**/ ?>