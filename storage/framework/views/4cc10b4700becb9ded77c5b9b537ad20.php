<?php
    $current_url = url()->current();

    $base_class = 'lqd-titlebar pt-3 pb-3 border-b transition-colors';
    $container_base_class = 'lqd-titlebar-container flex flex-wrap items-center justify-between gap-y-4';
    $before_base_class = 'lqd-titlebar-before w-full';
    $after_base_class = 'lqd-titlebar-after w-full';
    $pretitle_base_class = 'lqd-titlebar-pretitle text-xs text-foreground/70 m-0';
    $title_base_class = 'lqd-titlebar-title m-0';
    $subtitle_base_class = 'lqd-titlebar-subtitle mt-1 text-2xs opacity-80 only:my-0 last:mb-0';
    $actions_base_class = 'lqd-titlebar-actions flex flex-wrap items-center gap-2';

    $generator_link = route('dashboard.user.openai.list') === $current_url ? '#lqd-generators-filter-list' : LaravelLocalization::localizeUrl(route('dashboard.user.openai.list'));
    $wide_container_px = Theme::getSetting('wideLayoutPaddingX', '');
    $has_title = true;
    $has_pretitle = true;
    $has_subtitle = view()->hasSection('titlebar_subtitle');
    $titlebar_after_in_nav_col = $attributes->has('titlbar-after-place') && $attributes->get('titlbar-after-place') === 'col-nav';
    $title_section_name = '';

    if (view()->hasSection('titlebar_title')) {
        $title_section_name = 'titlebar_title';
    } elseif (view()->hasSection('title')) {
        $title_section_name = 'title';
    }

    if ($attributes->has('title') && blank($attributes->get('title'))) {
        $has_title = false;
    }
    if ($attributes->has('pretitle') && blank($attributes->get('pretitle'))) {
        $has_pretitle = false;
    }

    if (!$attributes->get('layout-wide')) {
        $container_base_class .= ' container';
    } else {
        $container_base_class .= ' container-fluid';

        if (!empty($wide_container_px)) {
            $container_base_class .= ' ' . $wide_container_px;
        }
    }
?>
<div
    id="lqd-titlebar"
    <?php echo e($attributes->withoutTwMergeClasses()->twMerge($base_class, $attributes->get('class'))); ?>

>
    <div <?php echo e($attributes->twMergeFor('container', $container_base_class)); ?>>
        <?php if(view()->hasSection('titlebar_before') || !empty($before)): ?>
            <div <?php echo e($attributes->twMergeFor('before', $before_base_class)); ?>>
                <?php if(view()->hasSection('titlebar_before')): ?>
                    <?php echo $__env->yieldContent('titlebar_before'); ?>
                <?php elseif(!empty($before)): ?>
                    <?php echo e($before); ?>

                <?php endif; ?>
            </div>
        <?php endif; ?>

        <div class="lqd-titlebar-col lqd-titlebar-col-nav group/titlebar-nav flex w-full flex-col gap-2 lg:w-7/12">
            <?php if($has_pretitle): ?>
                <p <?php echo e($attributes->twMergeFor('pretitle', $pretitle_base_class)); ?>>
                    <?php if(view()->hasSection('titlebar_pretitle')): ?>
                        <?php echo $__env->yieldContent('titlebar_pretitle'); ?>
                    <?php elseif(view()->hasSection('pretitle')): ?>
                        <?php echo $__env->yieldContent('pretitle'); ?>
                    <?php else: ?>
                        <?php if(route('dashboard.user.index') === $current_url || route('dashboard.admin.index') === $current_url): ?>
                            <?php echo e(__('Dashboard')); ?>


                       <?php elseif(Str::startsWith($current_url, url('dashboard/business'))): ?>
                         
                        <?php else: ?>
                         <?php if (isset($component)) { $__componentOriginale67687e3e4e61f963b25a6bcf3983629 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale67687e3e4e61f963b25a6bcf3983629 = $attributes; } ?>
<?php $component = App\View\Components\Button::resolve(['variant' => 'link','href' => ''.e(LaravelLocalization::localizeUrl(route('dashboard.index'))).''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Button::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'text-inherit hover:text-foreground']); ?>
                              <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('tabler-chevron-left'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(BladeUI\Icons\Components\Svg::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'size-4','stroke-width' => '1.5']); ?>
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
                              <?php echo e(__('Back to dashboard')); ?>

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
                </p>
            <?php endif; ?>
            <?php if($has_title): ?>
                <h1 <?php echo e($attributes->twMergeFor('title', $title_base_class)); ?>>
                    <?php echo $__env->yieldContent($title_section_name); ?>
                </h1>
            <?php endif; ?>
            <?php if($has_subtitle): ?>
                <p <?php echo e($attributes->twMergeFor('subtitle', $subtitle_base_class)); ?>>
                    <?php echo $__env->yieldContent('titlebar_subtitle'); ?>
                </p>
            <?php endif; ?>
            <?php
                $status_titlebar_after = $titlebar_after_in_nav_col && (!$has_pretitle && !$has_subtitle) && (view()->hasSection('titlebar_after') || !empty($after));

                $theme = \Theme::get();

                if ($theme == 'sleek' && request()->routeIs('dashboard.user.openai.list')) {
                    $status_titlebar_after = $titlebar_after_in_nav_col && !$has_pretitle && (view()->hasSection('titlebar_after') || !empty($after));
                }
            ?>

            <?php if($status_titlebar_after): ?>
                <div <?php echo e($attributes->twMergeFor('after', $after_base_class)); ?>>
                    <?php if(view()->hasSection('titlebar_after')): ?>
                        <?php echo $__env->yieldContent('titlebar_after'); ?>
                    <?php elseif(!empty($after)): ?>
                        <?php echo e($after); ?>

                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>

        <div
            class="lqd-titlebar-col lqd-titlebar-col-actions group/titlebar-actions max-lg:has-[.max-lg\:hidden:only-child]:hidden flex w-full flex-wrap gap-y-3 lg:w-5/12 lg:justify-end">
            <?php if (! empty(trim($__env->yieldContent('titlebar_actions_before')))): ?>
                <?php echo $__env->yieldContent('titlebar_actions_before'); ?>
            <?php endif; ?>

            <?php if(view()->hasSection('titlebar_actions')): ?>
                <div <?php echo e($attributes->twMergeFor('actions', $actions_base_class)); ?>>
                    <?php echo $__env->yieldContent('titlebar_actions'); ?>
                </div>
            <?php elseif(!empty($actions)): ?>
                <div <?php echo e($attributes->twMergeFor('actions', $actions_base_class, $actions->attributes->get('class'))); ?>>
                    <?php echo e($actions); ?>

                </div>
            <?php else: ?>
                <div <?php echo e($attributes->twMergeFor('actions', $actions_base_class, 'max-lg:hidden')); ?>>
                    <?php if(request()->routeIs('dashboard.user.openai.documents.all') && !isset($currfolder)): ?>
                        <?php if (isset($component)) { $__componentOriginale6a555649da86b3de44465cdfe004aa4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale6a555649da86b3de44465cdfe004aa4 = $attributes; } ?>
<?php $component = App\View\Components\Modal::resolve(['title' => ''.e(__('New Folder')).'','disableModal' => ''.e($app_is_demo).'','disableModalMessage' => ''.e(__('This feature is disabled in Demo version.')).''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Modal::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                             <?php $__env->slot('trigger', null, ['variant' => 'ghost-shadow']); ?> 
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
                                <?php echo e(__('New Folder')); ?>

                             <?php $__env->endSlot(); ?>
                             <?php $__env->slot('modal', null, []); ?> 
                                <?php if ($__env->exists('panel.user.openai.components.modals.create-new-folder')) echo $__env->make('panel.user.openai.components.modals.create-new-folder', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                             <?php $__env->endSlot(); ?>
                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale6a555649da86b3de44465cdfe004aa4)): ?>
<?php $attributes = $__attributesOriginale6a555649da86b3de44465cdfe004aa4; ?>
<?php unset($__attributesOriginale6a555649da86b3de44465cdfe004aa4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale6a555649da86b3de44465cdfe004aa4)): ?>
<?php $component = $__componentOriginale6a555649da86b3de44465cdfe004aa4; ?>
<?php unset($__componentOriginale6a555649da86b3de44465cdfe004aa4); ?>
<?php endif; ?>
                    <?php else: ?>
                        <?php if (isset($component)) { $__componentOriginale67687e3e4e61f963b25a6bcf3983629 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale67687e3e4e61f963b25a6bcf3983629 = $attributes; } ?>
<?php $component = App\View\Components\Button::resolve(['variant' => 'ghost-shadow','href' => ''.e(LaravelLocalization::localizeUrl(route('dashboard.user.openai.documents.all'))).''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Button::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                            <?php echo e(__('My Documents')); ?>

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
                    <?php if (isset($component)) { $__componentOriginale67687e3e4e61f963b25a6bcf3983629 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale67687e3e4e61f963b25a6bcf3983629 = $attributes; } ?>
<?php $component = App\View\Components\Button::resolve(['href' => ''.e($generator_link).''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
                        <?php echo e(__('New')); ?>

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
            <?php endif; ?>

            <?php if (! empty(trim($__env->yieldContent('titlebar_actions_after')))): ?>
                <?php echo $__env->yieldContent('titlebar_actions_after'); ?>
            <?php endif; ?>
        </div>

        <?php if(!$titlebar_after_in_nav_col && (($has_pretitle || $has_subtitle) && (view()->hasSection('titlebar_after') || !empty($after)))): ?>
            <div <?php echo e($attributes->twMergeFor('after', $after_base_class)); ?>>
                <?php if(view()->hasSection('titlebar_after')): ?>
                    <?php echo $__env->yieldContent('titlebar_after'); ?>
                <?php elseif(!empty($after)): ?>
                    <?php echo e($after); ?>

                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php /**PATH /var/www/Novuk/resources/views/default/components/titlebar.blade.php ENDPATH**/ ?>