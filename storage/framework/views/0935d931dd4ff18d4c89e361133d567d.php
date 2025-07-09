<?php
    $sort_buttons = [
        [
            'label' => __('Date'),
            'sort' => 'created_at',
        ],
        [
            'label' => __('Title'),
            'sort' => 'title',
        ],
        [
            'label' => __('Type'),
            'sort' => 'openai_id',
        ],
        [
            'label' => __('Cost'),
            'sort' => 'credits',
        ],
    ];

    $filter_buttons = [
        [
            'label' => __('All'),
            'filter' => 'all',
        ],
        [
            'label' => __('Favorites'),
            'filter' => 'favorites',
        ],
        [
            'label' => __('Text'),
            'filter' => 'text',
        ],
        [
            'label' => __('Image'),
            'filter' => 'image',
        ],
        [
            'label' => __('Code'),
            'filter' => 'code',
        ],
    ];
?>


<?php $__env->startSection('title', __('My Documents')); ?>
<?php $__env->startSection('titlebar_title'); ?>
    <?php echo e($currfolder?->name ? __("Folder: $currfolder?->name") : __('My Documents')); ?>

<?php $__env->stopSection(); ?>


<?php if($items && count($items) > 0): ?>
    <?php $__env->startSection('titlebar_after'); ?>
        <div class="flex flex-wrap items-center justify-between gap-y-2">
            <?php if(blank($currfolder)): ?>
                <div class="flex flex-wrap items-center gap-1">
                    <?php echo e(__('Sort by:')); ?>

                    <?php if (isset($component)) { $__componentOriginal0feec11b8470b4bf00c37924b86dc0af = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0feec11b8470b4bf00c37924b86dc0af = $attributes; } ?>
<?php $component = App\View\Components\Dropdown\Dropdown::resolve(['offsetY' => '1rem'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('dropdown.dropdown'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Dropdown\Dropdown::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'pe-3']); ?>
                         <?php $__env->slot('trigger', null, ['class' => 'px-2 py-1','variant' => 'link','size' => 'xs']); ?> 
                            <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('tabler-arrows-sort'); ?>
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
                         <?php $__env->endSlot(); ?>

                         <?php $__env->slot('dropdown', null, ['class' => 'overflow-hidden text-2xs font-medium']); ?> 
                            <form
                                class="lqd-sort-list flex flex-col"
                                action="<?php echo e(route('dashboard.user.openai.documents.all', ['id' => $currfolder?->id, 'listOnly' => 'true'])); ?>"
                                method="GET"
                                x-init
                                x-target="lqd-docs-container"
                                @submit="$store.documentsFilter.changePage('1')"
                            >
                                <input
                                    type="hidden"
                                    name="filter"
                                    :value="$store.documentsFilter.filter"
                                >
                                <input
                                    type="hidden"
                                    name="page"
                                    value="1"
                                >
                                <input
                                    type="hidden"
                                    name="sortAscDesc"
                                    :value="$store.documentsFilter.sortAscDesc"
                                >
                                <?php $__currentLoopData = $sort_buttons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $button): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <button
                                        class="group flex w-full items-center gap-1 px-3 py-2 hover:bg-foreground/5 [&.active]:bg-foreground/5"
                                        :class="$store.documentsFilter.sort === '<?php echo e($button['sort']); ?>' && 'active'"
                                        name="sort"
                                        value="<?php echo e($button['sort']); ?>"
                                        @click="$store.documentsFilter.changeSort('<?php echo e($button['sort']); ?>')"
                                    >
                                        <?php echo e($button['label']); ?>

                                        <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('tabler-caret-down-filled'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(BladeUI\Icons\Components\Svg::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'size-3 opacity-0 transition-all group-[&.active]:opacity-80',':class' => '$store.documentsFilter.sortAscDesc === \'asc\' && \'rotate-180\'']); ?>
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
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </form>
                         <?php $__env->endSlot(); ?>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0feec11b8470b4bf00c37924b86dc0af)): ?>
<?php $attributes = $__attributesOriginal0feec11b8470b4bf00c37924b86dc0af; ?>
<?php unset($__attributesOriginal0feec11b8470b4bf00c37924b86dc0af); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0feec11b8470b4bf00c37924b86dc0af)): ?>
<?php $component = $__componentOriginal0feec11b8470b4bf00c37924b86dc0af; ?>
<?php unset($__componentOriginal0feec11b8470b4bf00c37924b86dc0af); ?>
<?php endif; ?>

                    <form
                        class="lqd-filter-list flex flex-wrap items-center gap-x-4 gap-y-2 text-heading-foreground max-sm:gap-3"
                        action="<?php echo e(route('dashboard.user.openai.documents.all', ['id' => $currfolder?->id, 'listOnly' => 'true'])); ?>"
                        method="GET"
                        x-init
                        x-target="lqd-docs-container"
                        @submit="$store.documentsFilter.changePage('1')"
                    >
                        <input
                            type="hidden"
                            name="sort"
                            :value="$store.documentsFilter.sort"
                        >
                        <input
                            type="hidden"
                            name="page"
                            value="1"
                        >
                        <input
                            type="hidden"
                            name="sortAscDesc"
                            :value="$store.documentsFilter.sortAscDesc"
                        >
                        <?php $__currentLoopData = $filter_buttons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $button): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if (isset($component)) { $__componentOriginale67687e3e4e61f963b25a6bcf3983629 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale67687e3e4e61f963b25a6bcf3983629 = $attributes; } ?>
<?php $component = App\View\Components\Button::resolve(['tag' => 'button','type' => 'submit','variant' => 'ghost'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Button::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Illuminate\Support\Arr::toCssClasses([
                                    'lqd-filter-btn inline-flex rounded-full px-2.5 py-0.5 transition-colors hover:bg-foreground/5 [&.active]:bg-foreground/5 hover:translate-y-0 text-2xs leading-tight',
                                    // 'active' => $filter == $button['filter'],
                                ])),'name' => 'filter','value' => ''.e($button['filter']).'',':class' => '$store.documentsFilter.filter === \''.e($button['filter']).'\' && \'active\'','@click' => '$store.documentsFilter.changeFilter(\''.e($button['filter']).'\')']); ?>
                                <?php echo e($button['label']); ?>

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
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </form>
                </div>
            <?php endif; ?>
        </div>
    <?php $__env->stopSection(); ?>
    <?php $__env->startSection('titlebar_actions_after'); ?>
        <div class="<?php echo \Illuminate\Support\Arr::toCssClasses([
            'lqd-docs-view-toggle lqd-view-toggle relative z-1 flex w-full items-center gap-2 lg:ms-auto lg:justify-end',
            'mt-3 lg:-mb-16' => blank($currfolder),
        ]); ?>">
            <button
                class="lqd-view-toggle-trigger size-7 inline-flex items-center justify-center rounded-md transition-colors hover:bg-foreground/5 [&.active]:bg-foreground/5"
                :class="$store.docsViewMode.docsViewMode === 'list' && 'active'"
                x-init
                @click="$store.docsViewMode.change('list')"
                title="List view"
            >
                <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('tabler-list'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(BladeUI\Icons\Components\Svg::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'size-5','stroke-width' => '1.5']); ?>
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
            <button
                class="lqd-view-toggle-trigger size-7 inline-flex items-center justify-center rounded-md transition-colors hover:bg-foreground/5 [&.active]:bg-foreground/5"
                :class="$store.docsViewMode.docsViewMode === 'grid' && 'active'"
                x-init
                @click="$store.docsViewMode.change('grid')"
                title="Grid view"
            >
                <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('tabler-layout-grid'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(BladeUI\Icons\Components\Svg::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'size-5','stroke-width' => '1.5']); ?>
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
    <?php $__env->stopSection(); ?>
<?php endif; ?>

<?php $__env->startSection('content'); ?>
    <div class="py-10">
        
        <?php if($currfolder == null): ?>
            <?php if(isset(auth()->user()->folders) && count(auth()->user()->folders) > 0): ?>
                <div class="mb-6 grid grid-cols-3 !gap-5 max-md:grid-cols-1">
                    <?php $__currentLoopData = auth()->user()->folders ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $folder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if (isset($component)) { $__componentOriginal866da1c60e74d598000d09783405b12b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal866da1c60e74d598000d09783405b12b = $attributes; } ?>
<?php $component = App\View\Components\Documents\Folder::resolve(['folder' => $folder] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('documents.folder'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Documents\Folder::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal866da1c60e74d598000d09783405b12b)): ?>
<?php $attributes = $__attributesOriginal866da1c60e74d598000d09783405b12b; ?>
<?php unset($__attributesOriginal866da1c60e74d598000d09783405b12b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal866da1c60e74d598000d09783405b12b)): ?>
<?php $component = $__componentOriginal866da1c60e74d598000d09783405b12b; ?>
<?php unset($__componentOriginal866da1c60e74d598000d09783405b12b); ?>
<?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>
        <?php else: ?>
            <div class="mb-6 flex items-center gap-3">
                <?php if (isset($component)) { $__componentOriginale67687e3e4e61f963b25a6bcf3983629 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale67687e3e4e61f963b25a6bcf3983629 = $attributes; } ?>
<?php $component = App\View\Components\Button::resolve(['href' => ''.e(route('dashboard.user.openai.documents.all')).'','variant' => 'secondary'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Button::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'aspect-square rounded-lg','title' => ''.e(__('Back to documents')).'']); ?>
                    <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('tabler-arrow-left'); ?>
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
                <?php if (isset($component)) { $__componentOriginal866da1c60e74d598000d09783405b12b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal866da1c60e74d598000d09783405b12b = $attributes; } ?>
<?php $component = App\View\Components\Documents\Folder::resolve(['folder' => $currfolder,'folderSingleView' => ''.e(true).''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('documents.folder'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Documents\Folder::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal866da1c60e74d598000d09783405b12b)): ?>
<?php $attributes = $__attributesOriginal866da1c60e74d598000d09783405b12b; ?>
<?php unset($__attributesOriginal866da1c60e74d598000d09783405b12b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal866da1c60e74d598000d09783405b12b)): ?>
<?php $component = $__componentOriginal866da1c60e74d598000d09783405b12b; ?>
<?php unset($__componentOriginal866da1c60e74d598000d09783405b12b); ?>
<?php endif; ?>
            </div>
        <?php endif; ?>

        
        <?php if(!$items || count($items) === 0): ?>
            <?php echo $__env->make('panel.user.openai.documents_empty', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php else: ?>
            <?php echo $__env->make('panel.user.openai.documents_container', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('panel.layout.app', ['disable_tblr' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/Novuk/resources/views/default/panel/user/openai/documents.blade.php ENDPATH**/ ?>