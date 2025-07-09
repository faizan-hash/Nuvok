<?php
    $base_class = 'lqd-dropdown flex relative group/dropdown [--dropdown-offset:0px]';
    $trigger_base_class = 'lqd-dropdown-trigger hover:translate-y-0
	before:absolute before:-inset-3 before:pointer-events-none
	group-[&.lqd-is-active]/dropdown:before:pointer-events-auto';
    $dropdown_base_class = 'lqd-dropdown-dropdown absolute top-full opacity-0 invisible z-50 translate-y-1 pointer-events-none transition-all mt-[--dropdown-offset]
		before:absolute before:bottom-full before:-top-[--dropdown-offset] before:inset-x-0
		group-[&.lqd-is-active]/dropdown:opacity-100 group-[&.lqd-is-active]/dropdown:visible group-[&.lqd-is-active]/dropdown:translate-y-0 group-[&.lqd-is-active]/dropdown:pointer-events-auto
		[&.dropdown-anchor-bottom]:top-auto [&.dropdown-anchor-bottom]:bottom-full [&.dropdown-anchor-bottom]:mt-0 [&.dropdown-anchor-bottom]:mb-[--dropdown-offset] [&.dropdown-anchor-bottom]:before:bottom-full [&.dropdown-anchor-bottom]:before:-top-[--dropdown-offset]';
    $dropdown_content_base_class =
        'lqd-dropdown-dropdown-content min-w-44 border border-dropdown-border rounded-dropdown bg-dropdown-background text-dropdown-foreground shadow-lg shadow-black/5';

    if ($anchor === 'start') {
        $dropdown_base_class .= ' start-0';
    } else {
        $dropdown_base_class .= ' end-0';
    }
?>

<div
    <?php echo e($attributes->withoutTwMergeClasses()->twMerge($base_class, $attributes->get('class'))); ?>

    style="<?php echo \Illuminate\Support\Arr::toCssStyles([
        '--dropdown-offset: ' . $offsetY . '' => !empty($offsetY),
    ]) ?>"
    x-data="dropdown({ triggerType: '<?php echo e($triggerType); ?>' })"
    x-bind="parent"
    x-ref="parent"
>
    <?php if (isset($component)) { $__componentOriginale67687e3e4e61f963b25a6bcf3983629 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale67687e3e4e61f963b25a6bcf3983629 = $attributes; } ?>
<?php $component = App\View\Components\Button::resolve(['variant' => ''.e($trigger->attributes->get('variant') ? $trigger->attributes->get('variant') : 'link').''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Button::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['attributes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($attributes->twMergeFor('trigger', $trigger_base_class, $trigger->attributes->get('class'))),'x-bind' => 'trigger']); ?>
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

    <div
        <?php echo e($attributes->twMergeFor('dropdown-dropdown', $dropdown_base_class)); ?>

        x-bind="dropdown"
        x-init="$refs.parent.addEventListener('mouseenter', function() {
            const parentRect = $refs.parent.getBoundingClientRect();
            const dropdownRect = $el.getBoundingClientRect();
            $el.classList.toggle('dropdown-anchor-bottom', parentRect.bottom + dropdownRect.height > window.innerHeight && parentRect.top - dropdownRect.height > 0);
        })"
    >
        <div <?php echo e($attributes->twMergeFor('dropdown', $dropdown_content_base_class, $dropdown->attributes->get('class'))); ?>>
            <?php echo e($dropdown); ?>

        </div>
    </div>
</div>
<?php /**PATH /var/www/Novuk/resources/views/default/components/dropdown/dropdown.blade.php ENDPATH**/ ?>