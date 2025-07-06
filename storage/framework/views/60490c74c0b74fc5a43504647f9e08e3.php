<?php if(auth()->guard()->check()): ?>
    <?php if(auth()->user()->isAdmin()): ?>
        <?php if (isset($component)) { $__componentOriginalb5e767ad160784309dfcad41e788743b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb5e767ad160784309dfcad41e788743b = $attributes; } ?>
<?php $component = App\View\Components\Alert::resolve(['variant' => 'warn-fill','icon' => 'tabler-info-circle','size' => 'xs'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Alert::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'top-notice-bar top-notice-bar-hidden items-center rounded-none py-1 text-xs shadow-none lg:h-[--top-notice-bar-height]','id' => 'top-notice-bar','x-data' => '{ noticeBarHidden: true }',':class' => '{ \'hidden\': noticeBarHidden, \'top-notice-bar-hidden\': noticeBarHidden, \'top-notice-bar-visible\': !noticeBarHidden }']); ?>
            <script>
                // Initially hide the notice bar by setting it to 'hidden' in localStorage
                localStorage.setItem('lqdTopBarNotice', 'hidden');
                document.getElementById('top-notice-bar').classList.add('top-notice-bar-hidden');
                document.getElementById('top-notice-bar').classList.remove('top-notice-bar-visible');
                document.getElementById('top-notice-bar').style.display = 'none';
            </script>
            <!-- Bar content removed for visibility -->
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb5e767ad160784309dfcad41e788743b)): ?>
<?php $attributes = $__attributesOriginalb5e767ad160784309dfcad41e788743b; ?>
<?php unset($__attributesOriginalb5e767ad160784309dfcad41e788743b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb5e767ad160784309dfcad41e788743b)): ?>
<?php $component = $__componentOriginalb5e767ad160784309dfcad41e788743b; ?>
<?php unset($__componentOriginalb5e767ad160784309dfcad41e788743b); ?>
<?php endif; ?>
    <?php endif; ?>
<?php endif; ?>
<?php /**PATH F:\DELL\Desktop\Novuk\resources\views/default/panel/layout/partials/top-notice-bar.blade.php ENDPATH**/ ?>