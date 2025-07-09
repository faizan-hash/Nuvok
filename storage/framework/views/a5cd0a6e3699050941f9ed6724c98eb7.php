<?php
    $container_base_class = 'lqd-input-container relative';
    $input_base_class = 'lqd-input block peer w-full px-4 py-2 border border-input-border bg-input-background text-input-foreground text-base ring-offset-0 transition-colors
		focus:border-secondary focus:outline-0 focus:ring focus:ring-secondary
		dark:focus:ring-foreground/10
		sm:text-2xs';
    $input_checkbox_base_class = 'lqd-input peer rounded border-input-border
		focus:ring focus:ring-secondary
		dark:focus:ring-foreground/10';
    $input_checkbox_custom_wrapper_base_class = 'lqd-input-checkbox-custom-wrap inline-flex items-center justify-center size-[18px] shrink-0 rounded-full bg-foreground/10 text-heading-foreground bg-center bg-no-repeat
		peer-checked:bg-primary/[7%] peer-checked:text-primary';
    $label_base_class = 'lqd-input-label flex cursor-pointer items-center gap-2 text-2xs font-medium leading-none text-label';
    $label_extra_base_class = 'ms-auto';

    $variations = [
        'size' => [
            'none' => 'lqd-input-size-none rounded-lg',
            'sm' => 'lqd-input-sm h-9 rounded-md',
            'md' => 'lqd-input-md h-10 rounded-lg',
            'lg' => 'lqd-input-lg h-11 rounded-xl',
            'xl' => 'lqd-input-xl h-14 rounded-2xl px-6',
            '2xl' => 'lqd-input-2xl h-16 rounded-full px-8',
        ],
    ];

    if ($type === 'textarea') {
        $size = 'none';
    }

    $size = isset($variations['size'][$size]) ? $variations['size'][$size] : $variations['size']['md'];

    if ($switcher) {
        $input_checkbox_base_class .= ' lqd-input-switcher w-12 h-6 border-2 border-input-border rounded-full cursor-pointer appearance-none [background-size:1.3rem] bg-left bg-no-repeat transition-all
			checked:bg-right checked:bg-heading-foreground checked:border-heading-foreground
			dark:checked:bg-label dark:checked:border-label';
    } elseif ($custom) {
        $input_checkbox_base_class = 'lqd-input peer rounded size-0 invisible absolute top-0 start-0';
    }

    if ($type !== 'checkbox' && $type !== 'radio') {
        $label_base_class .= ' mb-3';
    }

    if (!empty($label) && empty($id)) {
        $id = str()->random(10);
    }

    if ($stepper) {
        $input_base_class .= ' lqd-input-stepper appearance-none text-center px-2';
    }
?>

<div
    <?php echo e($attributes->withoutTwMergeClasses()->twMergeFor('container', $container_base_class, $containerClass, $attributes->get('class:container'))); ?>

    <?php if($attributes->has('x-show')): ?> x-show="<?php echo e($attributes->get('x-show')); ?>" <?php endif; ?>
    <?php if($type === 'password'): ?> x-data='{
		type: "<?php echo e($type); ?>",
		get inputValueVisible() { return this.type !== "password" },
		toggleType() {
			this.type = this.type === "text" ? "password" : "text";
		}
    }' <?php endif; ?>
    <?php if($stepper): ?> x-data='{
		value: <?php echo e(!empty($value) ? $value : 0); ?>,
		min: <?php echo e($attributes->has('min') ? $attributes->get('min') : 0); ?>,
		max: <?php echo e($attributes->has('max') ? $attributes->get('max') : 999999); ?>,
		step: <?php echo e($attributes->has('step') ? $attributes->get('step') : 1); ?>,
		setValue(value) {
			this.value = value;
			this.$refs.input.setAttribute("value", this.value);
		}
	}' <?php endif; ?>
    <?php if($type === 'select' && $addNew): ?> x-data="{ 'newOptions': [] }" <?php endif; ?>
>
    
    <?php if(!empty($label) || ($type === 'checkbox' || $type === 'radio')): ?>
        <label
            <?php echo e($attributes->withoutTwMergeClasses()->twMergeFor('label', $label_base_class, $attributes->get('class:label'))); ?>

            for=<?php echo e($id); ?>

        >
            
            <?php if($type === 'checkbox' || $type === 'radio'): ?>
                <input
                    id="<?php echo e($id); ?>"
                    <?php echo e($attributes->withoutTwMergeClasses()->twMerge($input_checkbox_base_class, $attributes->get('class'))); ?>

                    name="<?php echo e($name); ?>"
                    type=<?php echo e($type); ?>

                    <?php if($value): ?> value=<?php echo e($value); ?> <?php endif; ?>
                    <?php echo e($attributes); ?>

                >
                <?php if($custom): ?>
                    <span <?php echo e($attributes->withoutTwMergeClasses()->twMergeFor('custom-wrap', $input_checkbox_custom_wrapper_base_class)); ?>></span>
                <?php endif; ?>
            <?php endif; ?>

            <span <?php echo e($attributes->withoutTwMergeClasses()->twMergeFor('label-txt', 'lqd-input-label-txt', $attributes->get('class:label-txt'))); ?>>
                <?php echo e($label); ?>

            </span>

            <?php if($type === 'checkbox' || $type === 'radio'): ?>
                <?php echo e($slot); ?>

            <?php endif; ?>

            <?php if(!empty($labelExtra)): ?>
                <span <?php echo e($attributes->withoutTwMergeClasses()->twMergeFor('label-extra', $label_extra_base_class, $attributes->get('class:label-extra'))); ?>>
                    <?php echo e($labelExtra); ?>

                </span>
            <?php endif; ?>

            
            <?php if(!empty($tooltip)): ?>
                <?php if (isset($component)) { $__componentOriginal9acd6c99af8d8c9491f2759be41ef2c4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9acd6c99af8d8c9491f2759be41ef2c4 = $attributes; } ?>
<?php $component = App\View\Components\InfoTooltip::resolve(['text' => ''.e($tooltip).''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('info-tooltip'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\InfoTooltip::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9acd6c99af8d8c9491f2759be41ef2c4)): ?>
<?php $attributes = $__attributesOriginal9acd6c99af8d8c9491f2759be41ef2c4; ?>
<?php unset($__attributesOriginal9acd6c99af8d8c9491f2759be41ef2c4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9acd6c99af8d8c9491f2759be41ef2c4)): ?>
<?php $component = $__componentOriginal9acd6c99af8d8c9491f2759be41ef2c4; ?>
<?php unset($__componentOriginal9acd6c99af8d8c9491f2759be41ef2c4); ?>
<?php endif; ?>
            <?php endif; ?>
        </label>
    <?php endif; ?>

    
    <?php if($type === 'password' || !empty($icon) || !empty($action) || $stepper): ?>
        <div class="relative">
    <?php endif; ?>

    
    <?php if($type !== 'checkbox' && $type !== 'radio' && $type !== 'select' && $type !== 'textarea' && $type !== 'color'): ?>
        <input
            id="<?php echo e($id); ?>"
            <?php echo e($attributes->withoutTwMergeClasses()->twMerge($input_base_class, $size, $attributes->get('class'))); ?>

            name="<?php echo e($name); ?>"
            value="<?php echo e($value); ?>"
            <?php if($type === 'password'): ?> :type="type" <?php endif; ?>
            type=<?php echo e($type); ?>

            placeholder="<?php echo e($placeholder); ?>"
            <?php echo e($attributes); ?>

            <?php if($stepper): ?> :value="(value).toString().includes('.') ? parseFloat(value).toFixed(2) : value"
				x-ref="input" <?php endif; ?>
        />

        <?php echo e($slot); ?>

    <?php endif; ?>

    
    <?php if($type === 'select'): ?>
        <select
            id="<?php echo e($id); ?>"
            <?php echo e($attributes->withoutTwMergeClasses()->twMerge('cursor-pointer', $input_base_class, $size, $attributes->get('class'))); ?>

            name="<?php echo e($name); ?>"
            value="<?php echo e($value); ?>"
            placeholder="<?php echo e($placeholder); ?>"
            <?php echo e($attributes); ?>

        >
            <?php echo e($slot); ?>

            <?php if($addNew): ?>
                <template
                    x-for="option in newOptions"
                    :key="option"
                >
                    <option
                        x-text="option"
                        x-bind:value="option"
                    ></option>
                </template>
            <?php endif; ?>
        </select>
        <?php if($attributes->has('multiple')): ?>
            <small class="mt-1 block">
                <?php echo e(__('Hold cmd(on mac) or ctrl(on pc) to select multiple items.')); ?>

            </small>
        <?php endif; ?>
        <?php if($addNew): ?>
            <?php if (isset($component)) { $__componentOriginale6a555649da86b3de44465cdfe004aa4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale6a555649da86b3de44465cdfe004aa4 = $attributes; } ?>
<?php $component = App\View\Components\Modal::resolve(['title' => ''.e(__('New value')).''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Modal::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class:modal-backdrop' => 'backdrop-blur-sm bg-foreground/15']); ?>
                 <?php $__env->slot('trigger', null, ['class' => 'mt-3','variant' => 'primary']); ?> 
                    <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('tabler-plus'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(BladeUI\Icons\Components\Svg::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'size-3','stroke-width' => '3']); ?>
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

                 <?php $__env->endSlot(); ?>

                 <?php $__env->slot('modal', null, ['x-data' => true]); ?> 
                    <?php if (isset($component)) { $__componentOriginala97611b31e90fc7dc431a34465dcc851 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala97611b31e90fc7dc431a34465dcc851 = $attributes; } ?>
<?php $component = App\View\Components\Forms\Input::resolve(['id' => 'new_'.e($id).'','name' => 'new_'.e($name).'','size' => 'lg'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\Input::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['@keyup.enter' => '$refs.submitBtn.click(); modalOpen = false','x-ref' => 'new_'.e($id).'']); ?>
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
                    <div class="mt-4 border-t pt-3">
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
                            <?php echo e(__('Cancel')); ?>

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
<?php $component = App\View\Components\Button::resolve(['tag' => 'button','variant' => 'primary'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Button::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['x-ref' => 'submitBtn','@click' => 'newOptions.push($refs.new_'.e($id).'.value); $refs.new_'.e($id).'.value = \'\';']); ?>
                            <?php echo e(__('Add')); ?>

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
        <?php endif; ?>
    <?php endif; ?>

    
    <?php if($type === 'textarea'): ?>
        <textarea
            id="<?php echo e($id); ?>"
            <?php echo e($attributes->withoutTwMergeClasses()->twMerge($input_base_class, $size, $attributes->get('class'))); ?>

            name="<?php echo e($name); ?>"
            value="<?php echo e($value); ?>"
            placeholder="<?php echo e($placeholder); ?>"
            <?php echo e($attributes); ?>

        ><?php echo e($slot); ?></textarea>
    <?php endif; ?>

    
    <?php if($type === 'color'): ?>
        <div
            <?php echo e($attributes->withoutTwMergeClasses()->twMerge($input_base_class, 'flex items-center gap-3', $size, $attributes->get('class'))); ?>

            x-data="{ 'colorVal': '<?php echo e($value); ?>' }"
        >
            <div class="relative size-5 gap-4 overflow-hidden rounded-full border shadow-sm focus-within:ring focus-within:ring-secondary">
                <input
                    class="relative -start-1/2 -top-1/2 h-[200%] w-[200%] cursor-pointer appearance-none rounded-full border-none p-0"
                    id="<?php echo e($id); ?>"
                    name="<?php echo e($name); ?>"
                    value="<?php echo e($value); ?>"
                    type=<?php echo e($type); ?>

                    :value="colorVal"
                    @input="colorVal = $event.target.value"
                    x-ref="colorInput"
                    <?php echo e($attributes); ?>

                />
            </div>
            <input
                class="grow border-none bg-transparent text-inherit outline-none"
                id="<?php echo e($id); ?>_value"
                name="<?php echo e($name); ?>_value"
                value="<?php echo e($value); ?>"
                type="text"
                :value="colorVal"
                placeholder="<?php echo e($placeholder); ?>"
                @input="colorVal = $event.target.value"
                @click="$refs.colorInput.click()"
            />
            <?php if (isset($component)) { $__componentOriginale67687e3e4e61f963b25a6bcf3983629 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale67687e3e4e61f963b25a6bcf3983629 = $attributes; } ?>
<?php $component = App\View\Components\Button::resolve(['variant' => 'outline','size' => 'sm'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Button::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'hidden','@click' => 'colorVal = \'\'',':class' => '{ \'hidden\': colorVal === \'\' }']); ?>
                <?php echo app('translator')->get('Clear'); ?>
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

    
    <?php if($type === 'password'): ?>
        <button
            class="lqd-show-password absolute end-3 top-1/2 z-10 inline-flex size-7 -translate-y-1/2 cursor-pointer items-center justify-center rounded bg-none transition-colors hover:bg-foreground/10"
            type="button"
            @click="toggleType()"
        >
            <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('tabler-eye'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(BladeUI\Icons\Components\Svg::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5','stroke-width' => '1.5',':class' => 'inputValueVisible ? \'hidden\' : \'\'']); ?>
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
            <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('tabler-eye-off'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(BladeUI\Icons\Components\Svg::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'hidden w-5','stroke-width' => '1.5',':class' => 'inputValueVisible ? \'!block\' : \'hidden\'']); ?>
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
    <?php endif; ?>

    
    <?php if(!empty($icon)): ?>
        <?php echo $icon; ?>

    <?php endif; ?>

    
    <?php if(!empty($action)): ?>
        <div class="absolute inset-y-0 end-0 border-s">
            <?php echo e($action); ?>

        </div>
    <?php endif; ?>

    
    <?php if($stepper): ?>
        <button
            class="lqd-stepper-btn absolute start-0 top-0 inline-flex aspect-square h-full w-10 items-center justify-center rounded-s-input transition-colors hover:bg-heading-foreground hover:text-heading-background"
            type="button"
            @click="setValue(Math.max(min, value - step))"
        >
            <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('tabler-minus'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(BladeUI\Icons\Components\Svg::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-4','stroke-width' => '1.5']); ?>
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
            class="lqd-stepper-btn absolute end-0 top-0 inline-flex aspect-square h-full w-10 items-center justify-center rounded-e-input transition-colors hover:bg-heading-foreground hover:text-heading-background"
            type="button"
            @click="setValue(Math.min(max, value + step))"
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
<?php $component->withAttributes(['class' => 'w-4','stroke-width' => '1.5']); ?>
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
    <?php endif; ?>

    
    <?php if($type === 'password' || !empty($icon) || !empty($action) || $stepper): ?>
</div>
<?php endif; ?>
</div>
<?php /**PATH /var/www/Novuk/resources/views/default/components/forms/input.blade.php ENDPATH**/ ?>