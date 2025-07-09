<nav class="lqd-bottom-menu fixed inset-x-0 bottom-0 z-50 hidden h-16 flex-wrap border-t bg-background/10 text-2xs font-medium backdrop-blur-md backdrop-saturate-150 max-lg:flex">
    <ul class="grid w-full grid-cols-4 place-items-center">
        <li class="w-full">
            <a
                class="flex flex-col items-center text-inherit"
                href="<?php echo e(route('dashboard.user.openai.chat.chat')); ?>"
            >
                <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('tabler-message'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(BladeUI\Icons\Components\Svg::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
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
            </a>
        </li>
        <li class="w-full">
            <a
                class="flex flex-col items-center text-inherit"
                href="<?php echo e(route('dashboard.user.openai.documents.all')); ?>"
            >
                <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('tabler-clipboard-text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(BladeUI\Icons\Components\Svg::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
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
            </a>
        </li>
        <li class="w-full">
            <button
                class="group flex h-auto w-full flex-col items-center text-inherit"
                type="button"
                x-init
                @click.prevent="$store.mobileNav.toggleSearch()"
                :class="{ 'lqd-is-active': !$store.mobileNav.searchCollapse }"
            >
                <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('tabler-search'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(BladeUI\Icons\Components\Svg::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
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
        </li>
        <li class="w-full">
            <button
                class="group flex h-auto w-full translate-x-0 transform-gpu flex-col items-center rounded-full bg-none text-inherit text-white outline-none"
                type="button"
                x-init
                @click.prevent="$store.mobileNav.toggleTemplates()"
                :class="{ 'lqd-is-active': !$store.mobileNav.templatesCollapse }"
            >
                <span
                    class="relative mb-1 inline-flex h-[30px] w-[30px] items-center justify-center overflow-hidden rounded-full before:absolute before:left-0 before:top-0 before:h-full before:w-full before:animate-spin-grow before:rounded-full before:bg-gradient-to-r before:from-[#8d65e9] before:via-[#5391e4] before:to-[#6bcd94]"
                >
                    <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('tabler-plus'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(BladeUI\Icons\Components\Svg::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'size-5 relative rotate-0 transition-transform duration-300 group-[.lqd-is-active]:rotate-[135deg]']); ?>
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
            </button>
        </li>
    </ul>
</nav>

<div
    class="invisible fixed bottom-16 right-0 z-[99] max-h-[calc(85vh-4rem)] w-full origin-bottom translate-y-2 scale-95 overflow-y-auto overscroll-contain rounded-t-2xl bg-[#fff] opacity-0 shadow-[-5px_-10px_30px_rgba(0,0,0,0.07)] transition-all dark:bg-zinc-800 lg:!hidden [&.lqd-is-active]:visible [&.lqd-is-active]:translate-y-0 [&.lqd-is-active]:scale-100 [&.lqd-is-active]:opacity-100"
    x-init
    :class="{ 'lqd-is-active': !$store.mobileNav.templatesCollapse }"
>
    <ul class="relative h-full text-2xs font-medium text-heading-foreground">
        <?php $__currentLoopData = $aiWriters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $aiWriter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="relative">
                <a
                    class="flex items-center gap-2 border-b border-l-0 border-r-0 border-t-0 border-solid border-[--tblr-border-color] p-3 py-2 text-inherit"
                    <?php if(($aiWriter->type == 'text' || $aiWriter->type == 'code') && $aiWriter->slug != 'ai_webchat'): ?> href="<?php echo e(LaravelLocalization::localizeUrl(route('dashboard.user.openai.generator.workbook', $aiWriter->slug))); ?>"
					<?php elseif($aiWriter->slug == 'ai_webchat' && \Illuminate\Support\Facades\Route::has('dashboard.user.openai.webchat.workbook')): ?>
           	 		href="<?php echo e(route('dashboard.user.openai.webchat.workbook')); ?>"
					<?php else: ?> href="<?php echo e(LaravelLocalization::localizeUrl(route('dashboard.user.openai.generator', $aiWriter->slug))); ?>" <?php endif; ?>
                >
                    <span
                        class="size-9 [&_svg]:size-5 relative inline-flex items-center justify-center rounded-full transition-all duration-300"
                        style="background: <?php echo e($aiWriter->color); ?>"
                    >
                        <span class="inline-block transition-all duration-300">
                            <?php echo html_entity_decode($aiWriter->image); ?>

                        </span>
                    </span>
                    <?php echo e($aiWriter->title); ?>

                </a>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</div>
<?php /**PATH /var/www/Novuk/resources/views/default/components/bottom-menu.blade.php ENDPATH**/ ?>