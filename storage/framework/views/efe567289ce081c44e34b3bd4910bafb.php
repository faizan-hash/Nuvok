<?php

    use App\Domains\Entity\Enums\EntityEnum;
    $base_class = 'lqd-remaining-credit relative mx-2 flex flex-col gap-3 text-2xs';
    $progress_base_class = 'lqd-progress flex h-2 overflow-hidden rounded-full';
    $progressbar_text_base_class = 'lqd-progress-bar grow-0 basis-auto bg-primary';
    $progressbar_image_base_class = 'lqd-progress-bar grow-0 basis-auto bg-secondary';
    $legend_text_base_class = 'group';
    $legend_box_text_base_class = '';
    $legend_image_base_class = 'group';
    $legend_box_image_base_class = 'bg-secondary';
    $modal_trigger_base_class = '';

    $variations = [
        'progressHeight' => [
            'sm' => 'h-1',
            'md' => 'h-2',
        ],
    ];

    $progressHeight = $variations['progressHeight'][$progressHeight] ?? $variations['progressHeight']['md'];

    $random = random_int(100000, 900000);

    if ($modalTriggerPos === 'inline' && $showType !== 'button') {
        $base_class .= ' pe-12';
        $modal_trigger_base_class .= ' absolute end-0 top-0 size-9 shrink-0 p-0 outline-heading-foreground/10 hover:bg-primary hover:text-primary-foreground';
    }
?>

<?php if($showType === 'directly'): ?>
    <div id="credit-list-partial-direct-<?php echo e($random); ?>">
        <div class="grid min-h-[140px] w-full place-items-center overflow-x-scroll rounded-lg p-6 lg:overflow-visible">
            <svg
                class="animate-spin text-gray-300"
                viewBox="0 0 64 64"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
            >
                <path
                    d="M32 3C35.8083 3 39.5794 3.75011 43.0978 5.20749C46.6163 6.66488 49.8132 8.80101 52.5061 11.4939C55.199 14.1868 57.3351 17.3837 58.7925 20.9022C60.2499 24.4206 61 28.1917 61 32C61 35.8083 60.2499 39.5794 58.7925 43.0978C57.3351 46.6163 55.199 49.8132 52.5061 52.5061C49.8132 55.199 46.6163 57.3351 43.0978 58.7925C39.5794 60.2499 35.8083 61 32 61C28.1917 61 24.4206 60.2499 20.9022 58.7925C17.3837 57.3351 14.1868 55.199 11.4939 52.5061C8.801 49.8132 6.66487 46.6163 5.20749 43.0978C3.7501 39.5794 3 35.8083 3 32C3 28.1917 3.75011 24.4206 5.2075 20.9022C6.66489 17.3837 8.80101 14.1868 11.4939 11.4939C14.1868 8.80099 17.3838 6.66487 20.9022 5.20749C24.4206 3.7501 28.1917 3 32 3L32 3Z"
                    stroke="currentColor"
                    stroke-width="5"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                ></path>
                <path
                    class="text-gray-900"
                    d="M32 3C36.5778 3 41.0906 4.08374 45.1692 6.16256C49.2477 8.24138 52.7762 11.2562 55.466 14.9605C58.1558 18.6647 59.9304 22.9531 60.6448 27.4748C61.3591 31.9965 60.9928 36.6232 59.5759 40.9762"
                    stroke="currentColor"
                    stroke-width="5"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >
                </path>
            </svg>
        </div>
    </div>
<?php else: ?>
    <?php
        $wordContainUnlimited = $imageContainUnlimited = false;
        $imageCreditsCount = $wordCreditsCount = 0;
        $wordEntities = $imageEntities = null;

        if (auth()->check()) {
            $wordEntities = \App\Domains\Entity\EntityStats::word()->forUser(auth()->user());
            $imageEntities = \App\Domains\Entity\EntityStats::image()->forUser(auth()->user());
            $businessCredits = auth()->user()->businessCredits;

            $wordContainUnlimited = $wordEntities->checkIfThereUnlimited();
            $imageContainUnlimited = $imageEntities->checkIfThereUnlimited();

            $wordCreditsCount = $wordEntities->totalCredits();
            $imageCreditsCount = $imageEntities->totalCredits();
            $invoiceCreditsCount = $businessCredits->invoices ?? 0;
            $clientCreditsCount = $businessCredits->clients ?? 0;
            $projectCreditsCount = $businessCredits->projects ?? 0;
        }

        $totalCreditsCount = $imageCreditsCount + $wordCreditsCount;
        $totalCreditsCount = (int) $totalCreditsCount === 0 ? 1 : $totalCreditsCount;

        if ($wordContainUnlimited && $imageContainUnlimited) {
            $progressbar_text_base_class .= ' shrink-1';
            $progressbar_image_base_class .= ' shrink-1';
        } else {
            $progressbar_text_base_class .= ' shrink-0';
            $progressbar_image_base_class .= ' shrink-0';
        }

        $uniqueDriversByDefaultImageModel = $imageEntities
            ? $imageEntities
                ->list()
                ->filter(function ($driver) {
                    $engine = $driver->engine();
                    $defaultModel = $engine?->getDefaultImageModel();
                    return $defaultModel && EntityEnum::fromSlug($driver->enum()->slug()) === $defaultModel;
                })
                ->unique(function ($driver) {
                    return $driver->engine()->value;
                })
            : collect();
    ?>

    <div
        <?php echo e($attributes->withoutTwMergeClasses()->twMerge($base_class, $attributes->get('class'))); ?>

        <?php if($aiImage): ?> x-data="{
			init() {
				if ( this.activeGenerator ) {
					this.generator = this.activeGenerator;
					this.$watch('activeGenerator', value => {
						if ( value === 'flux-pro' ) {
							value = 'fal_ai';
						}
						this.generator = value;
					});
				}
			},
            _generator: '<?php echo e($uniqueDriversByDefaultImageModel->first()?->engine()->value); ?>',
			get generator() {
				return this._generator;
			},
			set generator(value) {
				this._generator = value;
			}
        }" <?php endif; ?>
    >
        <?php if($showType !== 'button'): ?>
            <div
                class="<?php echo e(@twMerge($style === 'inline' ? 'lqd-remaining-credits-legends flex items-center justify-between gap-3 gap-y-1.5 flex-wrap' : '', $attributes->get('class:legends'))); ?>">
                <?php if($aiImage): ?>
                    <?php $__currentLoopData = $uniqueDriversByDefaultImageModel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $driver): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if (isset($component)) { $__componentOriginal07d54d3605705181242a790d5190a505 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal07d54d3605705181242a790d5190a505 = $attributes; } ?>
<?php $component = App\View\Components\Legend::resolve(['size' => ''.e($legendSize).'','label' => ''.e(__($driver->enum()->value)).''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('legend'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Legend::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => ''.e(@twMerge(['hidden'], $legend_text_base_class, $attributes->get('class:legend-text'))).'','class:box' => ''.e(@twMerge($legend_box_text_base_class, $attributes->get('class:legend-text-box'))).'','class:label' => ''.e(@twMerge($attributes->get('class:legend-text-label'))).'','id' => 'generator-legend-'.e($driver->engine()->value).'',':class' => '{ hidden: generator !== \''.e($driver->engine()->value).'\', flex: generator === \''.e($driver->engine()->value).'\' }']); ?>
                            <span class="ms-auto font-medium">
                                <?php echo e($driver->isUnlimitedCredit() ? __('Unlimited') : $driver->creditBalance()); ?>

                            </span>
                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal07d54d3605705181242a790d5190a505)): ?>
<?php $attributes = $__attributesOriginal07d54d3605705181242a790d5190a505; ?>
<?php unset($__attributesOriginal07d54d3605705181242a790d5190a505); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal07d54d3605705181242a790d5190a505)): ?>
<?php $component = $__componentOriginal07d54d3605705181242a790d5190a505; ?>
<?php unset($__componentOriginal07d54d3605705181242a790d5190a505); ?>
<?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <?php if (isset($component)) { $__componentOriginal07d54d3605705181242a790d5190a505 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal07d54d3605705181242a790d5190a505 = $attributes; } ?>
<?php $component = App\View\Components\Legend::resolve(['size' => ''.e($legendSize).'','label' => ''.e(__($labelWords)).''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('legend'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Legend::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => ''.e(@twMerge($legend_text_base_class, $attributes->get('class:legend-text'))).'','class:box' => ''.e(@twMerge($legend_box_text_base_class, $attributes->get('class:legend-text-box'))).'','class:label' => ''.e(@twMerge($attributes->get('class:legend-text-label'))).'']); ?>
                        <span class="ms-auto font-medium">
                            <?php
            if (is_null($wordEntities->checkIfThereUnlimited() ? __('Unlimited') : $wordEntities->totalCredits())) {
                echo '0';
            } else if ( !is_numeric($wordEntities->checkIfThereUnlimited() ? __('Unlimited') : $wordEntities->totalCredits() ) ) {
                echo $wordEntities->checkIfThereUnlimited() ? __('Unlimited') : $wordEntities->totalCredits();
            } else {
                echo number_shorten($wordEntities->checkIfThereUnlimited() ? __('Unlimited') : $wordEntities->totalCredits());
            }
            ?>
                        </span>
                        <?php if(!$wordEntities->checkIfThereUnlimited()): ?>
                            <span
                                class="pointer-events-none invisible absolute bottom-full left-1/2 mb-1 -translate-x-1/2 translate-y-1 scale-90 rounded-md bg-heading-foreground/10 px-2 py-1 font-medium leading-none text-heading-foreground opacity-0 blur-md backdrop-blur-lg transition-all group-hover:visible group-hover:translate-y-0 group-hover:scale-100 group-hover:opacity-100 group-hover:blur-0"
                            >
                                <?php echo is_numeric($wordEntities->totalCredits()) ? rtrim(rtrim(number_format((float) $wordEntities->totalCredits(), 2), '0'), '.') : ($wordEntities->totalCredits()); ?>
                            </span>
                        <?php endif; ?>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal07d54d3605705181242a790d5190a505)): ?>
<?php $attributes = $__attributesOriginal07d54d3605705181242a790d5190a505; ?>
<?php unset($__attributesOriginal07d54d3605705181242a790d5190a505); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal07d54d3605705181242a790d5190a505)): ?>
<?php $component = $__componentOriginal07d54d3605705181242a790d5190a505; ?>
<?php unset($__componentOriginal07d54d3605705181242a790d5190a505); ?>
<?php endif; ?>
                <?php endif; ?>

                <?php if (isset($component)) { $__componentOriginal07d54d3605705181242a790d5190a505 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal07d54d3605705181242a790d5190a505 = $attributes; } ?>
<?php $component = App\View\Components\Legend::resolve(['size' => ''.e($legendSize).'','label' => ''.e(__($labelImages)).''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('legend'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Legend::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => ''.e(@twMerge($legend_image_base_class, $attributes->get('class:legend-image'))).'','class:box' => ''.e(@twMerge($legend_box_image_base_class, $attributes->get('class:legend-image-box'))).'','class:label' => ''.e(@twMerge($attributes->get('class:legend-image-label'))).'']); ?>
                    <span class="ms-auto font-medium">
                        <?php
            if (is_null($imageEntities->checkIfThereUnlimited() ? __('Unlimited') : $imageEntities->totalCredits())) {
                echo '0';
            } else if ( !is_numeric($imageEntities->checkIfThereUnlimited() ? __('Unlimited') : $imageEntities->totalCredits() ) ) {
                echo $imageEntities->checkIfThereUnlimited() ? __('Unlimited') : $imageEntities->totalCredits();
            } else {
                echo number_shorten($imageEntities->checkIfThereUnlimited() ? __('Unlimited') : $imageEntities->totalCredits());
            }
            ?>
                    </span>
                    <?php if(!$imageEntities->checkIfThereUnlimited()): ?>
                        <span
                            class="pointer-events-none invisible absolute bottom-full left-1/2 mb-1 -translate-x-1/2 translate-y-1 scale-90 rounded-md bg-heading-foreground/10 px-2 py-1 font-medium leading-none text-heading-foreground opacity-0 blur-md backdrop-blur-lg transition-all group-hover:visible group-hover:translate-y-0 group-hover:scale-100 group-hover:opacity-100 group-hover:blur-0"
                        >
                            <?php echo is_numeric($imageEntities->totalCredits()) ? rtrim(rtrim(number_format((float) $imageEntities->totalCredits(), 2), '0'), '.') : ($imageEntities->totalCredits()); ?>
                        </span>
                    <?php endif; ?>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal07d54d3605705181242a790d5190a505)): ?>
<?php $attributes = $__attributesOriginal07d54d3605705181242a790d5190a505; ?>
<?php unset($__attributesOriginal07d54d3605705181242a790d5190a505); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal07d54d3605705181242a790d5190a505)): ?>
<?php $component = $__componentOriginal07d54d3605705181242a790d5190a505; ?>
<?php unset($__componentOriginal07d54d3605705181242a790d5190a505); ?>
<?php endif; ?>

                <?php if (isset($component)) { $__componentOriginal07d54d3605705181242a790d5190a505 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal07d54d3605705181242a790d5190a505 = $attributes; } ?>
<?php $component = App\View\Components\Legend::resolve(['size' => ''.e($legendSize).'','label' => ''.e(__('Invoices')).''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('legend'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Legend::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => ''.e(@twMerge($legend_text_base_class, $attributes->get('class:legend-text'))).'','class:box' => ''.e(@twMerge($legend_box_text_base_class, $attributes->get('class:legend-text-box'))).'','class:label' => ''.e(@twMerge($attributes->get('class:legend-text-label'))).'']); ?>
                    <span class="ms-auto font-medium">
                        <?php
            if (is_null($invoiceCreditsCount)) {
                echo '0';
            } else if ( !is_numeric($invoiceCreditsCount ) ) {
                echo $invoiceCreditsCount;
            } else {
                echo number_shorten($invoiceCreditsCount);
            }
            ?>
                    </span>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal07d54d3605705181242a790d5190a505)): ?>
<?php $attributes = $__attributesOriginal07d54d3605705181242a790d5190a505; ?>
<?php unset($__attributesOriginal07d54d3605705181242a790d5190a505); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal07d54d3605705181242a790d5190a505)): ?>
<?php $component = $__componentOriginal07d54d3605705181242a790d5190a505; ?>
<?php unset($__componentOriginal07d54d3605705181242a790d5190a505); ?>
<?php endif; ?>

                <?php if (isset($component)) { $__componentOriginal07d54d3605705181242a790d5190a505 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal07d54d3605705181242a790d5190a505 = $attributes; } ?>
<?php $component = App\View\Components\Legend::resolve(['size' => ''.e($legendSize).'','label' => ''.e(__('Clients')).''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('legend'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Legend::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => ''.e(@twMerge($legend_text_base_class, $attributes->get('class:legend-text'))).'','class:box' => ''.e(@twMerge($legend_box_text_base_class, $attributes->get('class:legend-text-box'))).'','class:label' => ''.e(@twMerge($attributes->get('class:legend-text-label'))).'']); ?>
                    <span class="ms-auto font-medium">
                        <?php
            if (is_null($clientCreditsCount)) {
                echo '0';
            } else if ( !is_numeric($clientCreditsCount ) ) {
                echo $clientCreditsCount;
            } else {
                echo number_shorten($clientCreditsCount);
            }
            ?>
                    </span>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal07d54d3605705181242a790d5190a505)): ?>
<?php $attributes = $__attributesOriginal07d54d3605705181242a790d5190a505; ?>
<?php unset($__attributesOriginal07d54d3605705181242a790d5190a505); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal07d54d3605705181242a790d5190a505)): ?>
<?php $component = $__componentOriginal07d54d3605705181242a790d5190a505; ?>
<?php unset($__componentOriginal07d54d3605705181242a790d5190a505); ?>
<?php endif; ?>

                <?php if (isset($component)) { $__componentOriginal07d54d3605705181242a790d5190a505 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal07d54d3605705181242a790d5190a505 = $attributes; } ?>
<?php $component = App\View\Components\Legend::resolve(['size' => ''.e($legendSize).'','label' => ''.e(__('Projects')).''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('legend'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Legend::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => ''.e(@twMerge($legend_text_base_class, $attributes->get('class:legend-text'))).'','class:box' => ''.e(@twMerge($legend_box_text_base_class, $attributes->get('class:legend-text-box'))).'','class:label' => ''.e(@twMerge($attributes->get('class:legend-text-label'))).'']); ?>
                    <span class="ms-auto font-medium">
                        <?php
            if (is_null($projectCreditsCount)) {
                echo '0';
            } else if ( !is_numeric($projectCreditsCount ) ) {
                echo $projectCreditsCount;
            } else {
                echo number_shorten($projectCreditsCount);
            }
            ?>
                    </span>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal07d54d3605705181242a790d5190a505)): ?>
<?php $attributes = $__attributesOriginal07d54d3605705181242a790d5190a505; ?>
<?php unset($__attributesOriginal07d54d3605705181242a790d5190a505); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal07d54d3605705181242a790d5190a505)): ?>
<?php $component = $__componentOriginal07d54d3605705181242a790d5190a505; ?>
<?php unset($__componentOriginal07d54d3605705181242a790d5190a505); ?>
<?php endif; ?>

                <?php if (isset($component)) { $__componentOriginal07d54d3605705181242a790d5190a505 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal07d54d3605705181242a790d5190a505 = $attributes; } ?>
<?php $component = App\View\Components\Legend::resolve(['size' => ''.e($legendSize).'','label' => ''.e(__('Tasks')).''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('legend'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Legend::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => ''.e(@twMerge($legend_text_base_class, $attributes->get('class:legend-text'))).'','class:box' => ''.e(@twMerge($legend_box_text_base_class, $attributes->get('class:legend-text-box'))).'','class:label' => ''.e(@twMerge($attributes->get('class:legend-text-label'))).'']); ?>
                    <span class="ms-auto font-medium">
                        <?php
            if (is_null($businessCredits->tasks ?? 0)) {
                echo '0';
            } else if ( !is_numeric($businessCredits->tasks ?? 0 ) ) {
                echo $businessCredits->tasks ?? 0;
            } else {
                echo number_shorten($businessCredits->tasks ?? 0);
            }
            ?>
                    </span>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal07d54d3605705181242a790d5190a505)): ?>
<?php $attributes = $__attributesOriginal07d54d3605705181242a790d5190a505; ?>
<?php unset($__attributesOriginal07d54d3605705181242a790d5190a505); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal07d54d3605705181242a790d5190a505)): ?>
<?php $component = $__componentOriginal07d54d3605705181242a790d5190a505; ?>
<?php unset($__componentOriginal07d54d3605705181242a790d5190a505); ?>
<?php endif; ?>
            </div>
            <div <?php echo e($attributes->twMergeFor('progress', $progress_base_class, $progressHeight)); ?>>
                <div
                    <?php echo e($attributes->twMergeFor('progressbar-text', $progressbar_text_base_class)); ?>

                    style="width: <?php echo e($wordContainUnlimited ? 100 : ($wordCreditsCount / $totalCreditsCount) * 100); ?>%"
                ></div>
                <div
                    <?php echo e($attributes->twMergeFor('progressbar-image', $progressbar_image_base_class)); ?>

                    style="width: <?php echo e($imageContainUnlimited ? 100 : ($imageCreditsCount / $totalCreditsCount) * 100); ?>%"
                ></div>
            </div>
        <?php endif; ?>
        <?php if (isset($component)) { $__componentOriginale6a555649da86b3de44465cdfe004aa4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale6a555649da86b3de44465cdfe004aa4 = $attributes; } ?>
<?php $component = App\View\Components\Modal::resolve(['title' => ''.e(__('Your Credit List')).'','disableFocus' => true] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Modal::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Illuminate\Support\Arr::toCssClasses(['static', '-mt-3' => $modalTriggerPos === 'inline']))]); ?>
             <?php $__env->slot('trigger', null, ['class' => ''.e(@twMerge($modal_trigger_base_class, $attributes->get('class:modal-trigger'))).'','variant' => ''.e($attributes->has('modal-trigger-variant') ? $attributes->get('modal-trigger-variant') : 'outline').'','title' => ''.e(__('View Your Credits')).'']); ?> 
                <?php if($attributes->has('expanded-modal-trigger')): ?>
                    <?php echo e(__('View Your Credits')); ?>

                <?php else: ?>
                    <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('tabler-eye'); ?>
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
                <?php endif; ?>
             <?php $__env->endSlot(); ?>
             <?php $__env->slot('modal', null, []); ?> 
                <h3 class="mb-2"><?php echo e(__('Unlock your creativity with credits')); ?></h3>
                <p class="mb-5"><?php echo e(__('Each credit unlocks powerful AI tools and features designed to enhance your content creation.')); ?></p>

                <div
                    class="credit-list-partial"
                    id="credit-list-partial-<?php echo e($random); ?>"
                >
                    <div class="grid min-h-[140px] w-full place-items-center overflow-x-scroll rounded-lg p-6 lg:overflow-visible">
                        <svg
                            class="animate-spin text-gray-300"
                            viewBox="0 0 64 64"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                        >
                            <path
                                d="M32 3C35.8083 3 39.5794 3.75011 43.0978 5.20749C46.6163 6.66488 49.8132 8.80101 52.5061 11.4939C55.199 14.1868 57.3351 17.3837 58.7925 20.9022C60.2499 24.4206 61 28.1917 61 32C61 35.8083 60.2499 39.5794 58.7925 43.0978C57.3351 46.6163 55.199 49.8132 52.5061 52.5061C49.8132 55.199 46.6163 57.3351 43.0978 58.7925C39.5794 60.2499 35.8083 61 32 61C28.1917 61 24.4206 60.2499 20.9022 58.7925C17.3837 57.3351 14.1868 55.199 11.4939 52.5061C8.801 49.8132 6.66487 46.6163 5.20749 43.0978C3.7501 39.5794 3 35.8083 3 32C3 28.1917 3.75011 24.4206 5.2075 20.9022C6.66489 17.3837 8.80101 14.1868 11.4939 11.4939C14.1868 8.80099 17.3838 6.66487 20.9022 5.20749C24.4206 3.7501 28.1917 3 32 3L32 3Z"
                                stroke="currentColor"
                                stroke-width="5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            ></path>
                            <path
                                class="text-gray-900"
                                d="M32 3C36.5778 3 41.0906 4.08374 45.1692 6.16256C49.2477 8.24138 52.7762 11.2562 55.466 14.9605C58.1558 18.6647 59.9304 22.9531 60.6448 27.4748C61.3591 31.9965 60.9928 36.6232 59.5759 40.9762"
                                stroke="currentColor"
                                stroke-width="5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >
                            </path>
                        </svg>
                    </div>
                </div>

                <div class="mt-4 border-t pt-3 text-end">
                    <?php if (isset($component)) { $__componentOriginale67687e3e4e61f963b25a6bcf3983629 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale67687e3e4e61f963b25a6bcf3983629 = $attributes; } ?>
<?php $component = App\View\Components\Button::resolve(['variant' => 'outline'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Button::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['@click.prevent' => 'modalOpen = false']); ?>
                        <?php echo e(__('Close')); ?>

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
                    <?php if (isset($component)) { $__componentOriginale67687e3e4e61f963b25a6bcf3983629 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale67687e3e4e61f963b25a6bcf3983629 = $attributes; } ?>
<?php $component = App\View\Components\Button::resolve(['href' => ''.e(route('dashboard.user.payment.subscription')).''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Button::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                        <?php echo e(__('Upgrade Plan')); ?>

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
    </div>
<?php endif; ?>
<script>
    <?php if($isJs): ?>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('<?php echo route('credit-list-partial', ['cache_key' => request('credit-list-cache'), 'plan_id' => $plan?->id]); ?>')
                .then(response => response.json())
                .then(data => {
                    let ID1 = '#credit-list-partial-direct-<?php echo e($random); ?>';
                    let ID2 = '#credit-list-partial-<?php echo e($random); ?>';

                    if (document.querySelector(ID1)) {
                        document.querySelector(ID1).innerHTML = data.html;
                    }

                    if (document.querySelector(ID2)) {
                        document.querySelector(ID2).innerHTML = data.html;
                    }
                });
        });
    <?php else: ?>
        fetch('<?php echo route('credit-list-partial', ['cache_key' => request('credit-list-cache'), 'plan_id' => $plan?->id]); ?>')
            .then(response => response.json())
            .then(data => {
                let ID1 = '#credit-list-partial-direct-<?php echo e($random); ?>';
                let ID2 = '#credit-list-partial-<?php echo e($random); ?>';

                if (document.querySelector(ID1)) {
                    document.querySelector(ID1).innerHTML = data.html;
                }

                if (document.querySelector(ID2)) {
                    document.querySelector(ID2).innerHTML = data.html;
                }
            });
    <?php endif; ?>
</script>
<?php /**PATH /var/www/Novuk/resources/views/default/components/credit-list.blade.php ENDPATH**/ ?>