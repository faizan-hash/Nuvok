<?php $__env->startPush('css'); ?>
    <style>
        @keyframes search-border-play {
            0% {
                transform: rotate(0);
            }

            10% {
                opacity: 1;
            }

            90% {
                opacity: 1;
            }

            100% {
                transform: rotate(360deg);
                opacity: 0;
            }
        }

        .header-search-border-play-inner {
            --color-1: #A2A4EF;
            --color-2: #1EC59F;
            background: conic-gradient(from 0deg, transparent 0%, var(--color-1) 10%, var(--color-2) 20%, transparent 30%);
            animation: search-border-play 4.5s linear 1;
        }
    </style>
<?php $__env->stopPush(); ?>

<form
    class="<?php echo \Illuminate\Support\Arr::toCssClasses([
        @twMerge(
            'header-search relative group transition-all',
            $attributes->get('class')),
        'header-search-in-content' => $inContent,
        'max-lg:invisible max-lg:fixed max-lg:bottom-16 max-lg:left-0 max-lg:z-[99] max-lg:m-0 max-lg:me-0 max-lg:!w-full max-lg:origin-bottom max-lg:-translate-y-2 max-lg:scale-95 max-lg:opacity-0 max-lg:[&.lqd-is-active]:visible max-lg:[&.lqd-is-active]:translate-y-0 max-lg:[&.lqd-is-active]:scale-100 max-lg:[&.lqd-is-active]:opacity-100' => !$inContent,
    ]); ?>"
    <?php if(!$inContent): ?> x-init :class="{ 'lqd-is-active': !$store.mobileNav.searchCollapse }" <?php endif; ?>
>
    <div class="<?php echo \Illuminate\Support\Arr::toCssClasses([
        'relative w-full max-lg:bg-white max-lg:p-3 max-lg:dark:bg-zinc-800' => !$inContent,
    ]); ?>">
        <?php if(!$inContent): ?>
            <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('tabler-search'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(BladeUI\Icons\Components\Svg::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'lqd-header-search-icon pointer-events-none absolute start-3 top-1/2 z-10 w-5 -translate-y-1/2 opacity-75 max-lg:start-6','stroke-width' => '1.5']); ?>
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
        <?php endif; ?>

        <?php if($inContent): ?>
            <div class="relative">
                <div class="header-search-border pointer-events-none absolute -inset-1 overflow-hidden rounded-full bg-heading-foreground/5">
                    <div class="header-search-border-play absolute left-1/2 top-1/2 aspect-square min-h-full min-w-full -translate-x-1/2 -translate-y-1/2 rounded-[inherit]">
                        <div class="header-search-border-play-inner absolute min-h-full min-w-full opacity-0"></div>
                    </div>
                </div>
        <?php endif; ?>
        <?php if (isset($component)) { $__componentOriginala97611b31e90fc7dc431a34465dcc851 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala97611b31e90fc7dc431a34465dcc851 = $attributes; } ?>
<?php $component = App\View\Components\Forms\Input::resolve(['containerClass' => 'peer','type' => 'search','placeholder' => ''.e(__('Search for templates and documents...')).''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\Input::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Illuminate\Support\Arr::toCssClasses([
                'header-search-input',
                'ps-10 max-lg:rounded-md' => !$inContent,
                @twMerge(
                    'rounded-full border-clay bg-clay transition-colors',
                    $attributes->get('class:input')),
            ])),'onkeydown' => 'return event.key != \'Enter\';']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala97611b31e90fc7dc431a34465dcc851)): ?>
<?php $attributes = $__attributesOriginala97611b31e90fc7dc431a34465dcc851; ?>
<?php unset($__attributesOriginala97611b31e90fc7dc431a34465dcc851); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala97611b31e90fc7dc431a34465dcc851)): ?>
<?php $component = $__componentOriginala97611b31e90fc7dc431a34465dcc851; ?>
<?php unset($__componentOriginala97611b31e90fc7dc431a34465dcc851); ?>
<?php endif; ?>
        
        <?php if($inContent): ?>
			</div>
		<?php endif; ?>
		

        <?php if(!$inContent): ?>
            <kbd
                class="peer-focus-within:scale-70 pointer-events-none absolute end-3 top-1/2 z-10 inline-block -translate-y-1/2 rounded-full bg-background px-2 py-1 text-3xs leading-none opacity-0 transition-all group-[.is-searching]:invisible group-[.is-searching]:opacity-0 peer-focus-within:invisible peer-focus-within:opacity-0 max-lg:hidden">
                <span class="search-shortcut-key"></span> + K
            </kbd>
        <?php endif; ?>

        <span class="absolute end-12 top-1/2 -translate-y-1/2">
            <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('tabler-loader-2'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(BladeUI\Icons\Components\Svg::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'hidden animate-spin group-[.is-searching]:block','stroke-width' => '1.5','role' => 'status']); ?>
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

        <?php if(!$inContent): ?>
            <span
                class="pointer-events-none absolute end-3 top-1/2 -translate-x-2 -translate-y-1/2 opacity-0 transition-all group-[.done-searching]:hidden group-[.is-searching]:hidden peer-focus-within:translate-x-0 peer-focus-within:opacity-100 rtl:-scale-x-100"
            >
                <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('tabler-chevron-right'); ?>
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
            </span>
        <?php endif; ?>

        <div
            class="navbar-search-results absolute start-0 top-[calc(100%+17px)] z-50 hidden max-h-96 w-full overflow-y-auto overscroll-contain rounded-md bg-background shadow-[0_10px_70px_rgba(0,0,0,0.1)] group-[.done-searching]:block dark:bg-background max-lg:bottom-full max-lg:end-0 max-lg:start-0 max-lg:top-auto max-lg:w-auto"
            id="search_results"
        >
            <h3 class="m-0 border-b px-3 py-3 text-base font-medium">
                <?php echo e(__('Search results')); ?>

            </h3>
            <!-- Search results here -->
            <div class="search-results-container"></div>
        </div>
    </div>
</form>
<?php /**PATH /var/www/Novuk/resources/views/default/components/header-search.blade.php ENDPATH**/ ?>