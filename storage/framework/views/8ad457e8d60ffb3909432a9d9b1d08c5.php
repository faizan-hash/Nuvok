<h4 class="mt-4 mb-2"><?php echo e(__('AI Credits')); ?></h4>

<table class="mb-4 w-full table-auto border-collapse border">
    <thead>
        <tr class="bg-foreground/10">
            <th class="border p-2 text-start"><?php echo e(__('Model')); ?></th>
            <th class="border p-2 text-end"><?php echo e(__('Credits')); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $drivers = $plan->exists ? $model->forPlan($plan)->list() : $model->forUser(auth()->user())->list();
                $groupName = $drivers->isNotEmpty() ? $drivers->first()->enum()->subLabel() : '';
                $isUnlimited = $model->checkIfThereUnlimited();
                $credits = $model->totalCredits();
                $tooltip_anchor = $loop->index < 4 ? 'top' : 'bottom';
            ?>
            <?php if(!$isUnlimited && $credits <= 0): ?>
                <?php continue; ?>
            <?php endif; ?>
            <tr>
                <td class="flex justify-between border p-2">
                    <?php echo e($groupName); ?>

                    <?php if (isset($component)) { $__componentOriginal9acd6c99af8d8c9491f2759be41ef2c4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9acd6c99af8d8c9491f2759be41ef2c4 = $attributes; } ?>
<?php $component = App\View\Components\InfoTooltip::resolve(['drivers' => $drivers,'anchor' => $tooltip_anchor] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('info-tooltip'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\InfoTooltip::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class:content' => 'max-h-48 overflow-y-auto']); ?>
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
                </td>
                <td class="border p-2 text-end">
                    <?php echo e($isUnlimited ? __('Unlimited') : $credits); ?>

                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>

<h4 class="mt-4 mb-2"><?php echo e(__('Business Credits')); ?></h4>
<table class="mb-4 w-full table-auto border-collapse border">
    <thead>
        <tr class="bg-foreground/10">
            <th class="border p-2 text-start"><?php echo e(__('Category')); ?></th>
            <th class="border p-2 text-end"><?php echo e(__('Credits')); ?></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="border p-2"><?php echo e(__('Invoices')); ?></td>
            <td class="border p-2 text-end"><?php echo e($businessCredits->invoices ?? 0); ?></td>
        </tr>
        <tr>
            <td class="border p-2"><?php echo e(__('Clients')); ?></td>
            <td class="border p-2 text-end"><?php echo e($businessCredits->clients ?? 0); ?></td>
        </tr>
        <tr>
            <td class="border p-2"><?php echo e(__('Projects')); ?></td>
            <td class="border p-2 text-end"><?php echo e($businessCredits->projects ?? 0); ?></td>
        </tr>
        <tr>
            <td class="border p-2"><?php echo e(__('Tasks')); ?></td>
            <td class="border p-2 text-end"><?php echo e($businessCredits->tasks ?? 0); ?></td>
        </tr>
    </tbody>
</table>
<?php /**PATH /var/www/Novuk/resources/views/default/components/credit-list-partial.blade.php ENDPATH**/ ?>