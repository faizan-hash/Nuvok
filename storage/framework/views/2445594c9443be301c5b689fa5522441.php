<?php if (isset($component)) { $__componentOriginalf8d22cb0bbc2c20a18faee8523755af5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8d22cb0bbc2c20a18faee8523755af5 = $attributes; } ?>
<?php $component = App\View\Components\Box::resolve(['style' => '3','title' => ''.__($item->title).'','desc' => ''.__($item->description).''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('box'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Box::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('image', null, []); ?> 
        <figure class="group-hover:scale-105 relative z-0 inline-block transition-all duration-300">
            <div style="height: 100px; width: 64px; margin: 0 auto; display: flex; align-items: center; justify-content: center; color: #60027C;">
                <?php if(str_starts_with($item->image, '<svg')): ?>
                    <?php echo $item->image; ?>

                <?php else: ?>
                    <img
                        class="-mx-8 max-w-[calc(100%+4rem)]"
                        src="<?php echo e(custom_theme_url($item->image, true)); ?>"
                        alt="<?php echo __($item->title); ?>"
                        style="margin-top: 20px;"
                    >
                <?php endif; ?>
            </div>
        </figure>
     <?php $__env->endSlot(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf8d22cb0bbc2c20a18faee8523755af5)): ?>
<?php $attributes = $__attributesOriginalf8d22cb0bbc2c20a18faee8523755af5; ?>
<?php unset($__attributesOriginalf8d22cb0bbc2c20a18faee8523755af5); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf8d22cb0bbc2c20a18faee8523755af5)): ?>
<?php $component = $__componentOriginalf8d22cb0bbc2c20a18faee8523755af5; ?>
<?php unset($__componentOriginalf8d22cb0bbc2c20a18faee8523755af5); ?>
<?php endif; ?>
<?php /**PATH /var/www/Novuk/resources/views/default/landing-page/tools/item.blade.php ENDPATH**/ ?>