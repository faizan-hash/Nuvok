<?php echo adsense_tools_728x90(); ?>

<section class="site-section py-10 transition-all duration-700 md:translate-y-8 md:opacity-0 [&.lqd-is-in-view]:translate-y-0 [&.lqd-is-in-view]:opacity-100">
    <div class="container">
        <div class="rounded-[50px] border p-10 max-sm:px-5">
            <?php if (isset($component)) { $__componentOriginal044312fc7e45484e118b3e1951e4e85f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal044312fc7e45484e118b3e1951e4e85f = $attributes; } ?>
<?php $component = App\View\Components\SectionHeader::resolve(['mb' => '7','width' => 'w-3/5','title' => 'Smart Tools by NuvokAI.','subtitle' => 'Everything you need to run your service business — quotes, invoices, content, and more — all powered by NuvokAI.'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('section-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\SectionHeader::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                <h6 class="mb-6 inline-block rounded-md bg-[#083D91] bg-opacity-15 px-3 py-1 text-[13px] font-medium text-[#083D91]">
                    <span class="text-sm font-medium text-gray-800">
                        <?php echo e(__('NuvokAI')); ?>

                    </span>
                </h6>
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal044312fc7e45484e118b3e1951e4e85f)): ?>
<?php $attributes = $__attributesOriginal044312fc7e45484e118b3e1951e4e85f; ?>
<?php unset($__attributesOriginal044312fc7e45484e118b3e1951e4e85f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal044312fc7e45484e118b3e1951e4e85f)): ?>
<?php $component = $__componentOriginal044312fc7e45484e118b3e1951e4e85f; ?>
<?php unset($__componentOriginal044312fc7e45484e118b3e1951e4e85f); ?>
<?php endif; ?>
            <div class="grid grid-cols-3 gap-3 max-lg:grid-cols-2 max-md:grid-cols-1">
                <?php $__currentLoopData = $tools; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo $__env->make('landing-page.tools.item', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</section>
<?php /**PATH /var/www/Novuk/resources/views/default/landing-page/tools/section.blade.php ENDPATH**/ ?>