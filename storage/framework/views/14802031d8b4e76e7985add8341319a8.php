<?php
    $base_class = 'lqd-navbar-link flex items-center gap-2 ps-navbar-link-ps pe-navbar-link-pe pt-navbar-link-pt pb-navbar-link-pb rounded-xl relative transition-colors group/link
		hover:bg-navbar-background-hover/5 hover:text-navbar-foreground-hover
		[&.active]:bg-navbar-background-active/5 [&.active]:text-navbar-foreground-active
		dark:[&.active]:bg-transparent
		dark:before:w-1.5 dark:before:h-full dark:before:absolute dark:before:top-0 dark:before:-start-2 dark:before:bg-primary dark:before:rounded-e-lg dark:before:opacity-0
		dark:[&.active]:before:opacity-100';
    $label_base_class = 'lqd-nav-link-label flex grow gap-2 items-center transition-[opacity,transform,visbility] [&_.lqd-nav-item-badge]:ms-auto';
    $letter_icon_base_class = 'lqd-nav-link-letter-icon inline-flex size-6 shrink-0 items-center justify-center rounded-md bg-primary text-4xs text-primary-foreground';

    $target = '_self';

    // setting href
    if (!empty($href) && $href !== '#') {
        if (is_string($href) && Route::has($href)) {
            $href = !empty($slug) ? route($href, $slug) : route($href);
        } else {
            $target = '_blank';
        }

        if ($localizeHref) {
            $href = LaravelLocalization::localizeUrl($href);
        }
    }

    // if (empty(trim($activeCondition)) && !empty($href)) {
    //     $activeCondition = $href === url()->current();
    // }
    if ($activeCondition) {
        $base_class .= ' active';
    }
?>

<a
    <?php echo e($attributes->withoutTwMergeClasses()->twMerge($base_class, $attributes->get('class'))); ?>

    href="<?php echo e($href); ?>"
    target="<?php echo e($target); ?>"
    <?php if($dropdownTrigger): ?> @click.prevent="toggleDropdownOpen()" <?php endif; ?>
    <?php if($app_is_not_demo && ($activeCondition && !empty(trim($activeCondition)))): ?> x-init="$el.parentElement.offsetTop > window.innerHeight && $el.closest('.lqd-navbar-inner').scrollTo({ top: (($el.parentElement.offsetHeight + $el.parentElement.offsetTop) / 2) })" <?php endif; ?>
    <?php if($triggerType === 'modal'): ?> @click.prevent="toggleModal()" <?php endif; ?>
>
    <?php if($letterIcon && !empty($label)): ?>
        <span
            <?php echo e($attributes->twMergeFor('letter-icon', $letter_icon_base_class)); ?>

            <?php if(!empty($letterIconStyles)): ?> style="<?php echo e($letterIconStyles); ?>" <?php endif; ?>
        >
            <?php echo e(mb_substr($label, 0, 1)); ?>

        </span>
    <?php endif; ?>
    <?php if(!empty($icon) || !empty($iconHtml)): ?>
        <span
            class="lqd-nav-link-icon bg-navbar-icon-background text-navbar-icon-foreground group-hover/link:bg-navbar-icon-background-hover group-hover/link:text-navbar-icon-foreground-hover group-[&.active]/link:bg-navbar-icon-background-active group-[&.active]/link:text-navbar-icon-foreground-active"
        >
            <?php if(!empty($iconHtml)): ?>
                <?php echo $iconHtml; ?>

            <?php else: ?>
                <?php if (isset($component)) { $__componentOriginal511d4862ff04963c3c16115c05a86a9d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal511d4862ff04963c3c16115c05a86a9d = $attributes; } ?>
<?php $component = Illuminate\View\DynamicComponent::resolve(['component' => $icon] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('dynamic-component'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\DynamicComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'size-navbar-icon','stroke-width' => '1.5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal511d4862ff04963c3c16115c05a86a9d)): ?>
<?php $attributes = $__attributesOriginal511d4862ff04963c3c16115c05a86a9d; ?>
<?php unset($__attributesOriginal511d4862ff04963c3c16115c05a86a9d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal511d4862ff04963c3c16115c05a86a9d)): ?>
<?php $component = $__componentOriginal511d4862ff04963c3c16115c05a86a9d; ?>
<?php unset($__componentOriginal511d4862ff04963c3c16115c05a86a9d); ?>
<?php endif; ?>
            <?php endif; ?>
        </span>
    <?php endif; ?>

    <?php if(!empty($label)): ?>
        <span <?php echo e($attributes->twMergeFor('label', $label_base_class, $attributes->get('class:label'))); ?>>
            <?php echo e($label); ?>

        </span>
    <?php endif; ?>

    <?php if(($new && $app_is_demo) || !empty($badge)): ?>
        <?php if (isset($component)) { $__componentOriginald30cf9cba6bb540c6bffcc9785239679 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald30cf9cba6bb540c6bffcc9785239679 = $attributes; } ?>
<?php $component = App\View\Components\Badge::resolve(['variant' => 'secondary'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Badge::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'ms-auto rounded-md text-4xs group-[&.navbar-shrinked]/body:hidden']); ?>
            <?php if($new && $app_is_demo): ?>
                <?php echo e(__('New')); ?>

            <?php elseif(!empty($badge)): ?>
                <?php echo e($badge); ?>

            <?php endif; ?>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald30cf9cba6bb540c6bffcc9785239679)): ?>
<?php $attributes = $__attributesOriginald30cf9cba6bb540c6bffcc9785239679; ?>
<?php unset($__attributesOriginald30cf9cba6bb540c6bffcc9785239679); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald30cf9cba6bb540c6bffcc9785239679)): ?>
<?php $component = $__componentOriginald30cf9cba6bb540c6bffcc9785239679; ?>
<?php unset($__componentOriginald30cf9cba6bb540c6bffcc9785239679); ?>
<?php endif; ?>
    <?php endif; ?>

    <?php if($dropdownTrigger): ?>
        <span class="lqd-nav-link-expander ms-auto shrink-0 group-[&.navbar-shrinked]/body:hidden">
            <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('tabler-plus'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(BladeUI\Icons\Components\Svg::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-3','stroke-width' => '2.5']); ?>
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
        </span>
    <?php endif; ?>
</a>
<?php /**PATH /var/www/Novuk/resources/views/default/components/navbar/partials/link-markup.blade.php ENDPATH**/ ?>