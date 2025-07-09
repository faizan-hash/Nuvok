<?php
    use App\Domains\Entity\EntityStats;
    $wordModels = EntityStats::word();
    $imageModels = EntityStats::image();

    $team = auth()->user()->getAttribute('team');
    $teamManager = auth()->user()->getAttribute('teamManager');
?>

<?php if($team): ?>
    <div class="flex flex-wrap items-center justify-between gap-y-4 text-base font-medium leading-normal">
        <div class="lg-w/5-12 w-full md:w-1/2">
            <h2 class="mb-[1em]"><?php echo e(__('Active Workspace:')); ?></h2>
            <p class="mb-4 font-bold">
                <?php echo e($teamManager->name . ' ' . $teamManager->surname); ?>

                <?php if (isset($component)) { $__componentOriginald30cf9cba6bb540c6bffcc9785239679 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald30cf9cba6bb540c6bffcc9785239679 = $attributes; } ?>
<?php $component = App\View\Components\Badge::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Badge::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'ms-2 text-2xs']); ?>
                    <?php echo app('translator')->get('Team Manager'); ?>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald30cf9cba6bb540c6bffcc9785239679)): ?>
<?php $attributes = $__attributesOriginald30cf9cba6bb540c6bffcc9785239679; ?>
<?php unset($__attributesOriginald30cf9cba6bb540c6bffcc9785239679); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald30cf9cba6bb540c6bffcc9785239679)): ?>
<?php $component = $__componentOriginald30cf9cba6bb540c6bffcc9785239679; ?>
<?php unset($__componentOriginald30cf9cba6bb540c6bffcc9785239679); ?>
<?php endif; ?>
            </p>

            <?php echo app('translator')->get("You have the Team plan which has a remaining balance of <strong class='font-bold '>:word</strong> words and <strong class='font-bold '>:image</strong> images. You can contact your team manager if you need more credits.", ['word' => $wordModels->totalCredits(), 'image' => $imageModels->totalCredits()]); ?>
        </div>
        <div class="ms-auto w-full md:w-1/2">
            <div class="relative">
                <div
                    class="relative [&_.apexcharts-canvas]:mx-auto [&_.apexcharts-canvas]:max-w-full [&_.apexcharts-legend-text]:!m-0 [&_.apexcharts-legend-text]:!pe-2 [&_.apexcharts-legend-text]:ps-2 [&_.apexcharts-legend-text]:!text-foreground [&_.apexcharts-svg]:max-w-full"
                    id="chart-credit"
                ></div>
                <h3 class="group absolute left-1/2 top-[calc(50%-5px)] m-0 -translate-x-1/2 text-center text-xs font-normal">
                    <strong class="block text-[2em] font-semibold leading-none max-sm:text-[1.5em]">
                        <?php
            if (is_null($wordModels->checkIfThereUnlimited() ? __('Unlimited') : $wordModels->totalCredits())) {
                echo '0';
            } else if ( !is_numeric($wordModels->checkIfThereUnlimited() ? __('Unlimited') : $wordModels->totalCredits() ) ) {
                echo $wordModels->checkIfThereUnlimited() ? __('Unlimited') : $wordModels->totalCredits();
            } else {
                echo number_shorten($wordModels->checkIfThereUnlimited() ? __('Unlimited') : $wordModels->totalCredits());
            }
            ?>
                        <?php if(!$wordModels->checkIfThereUnlimited()): ?>
                            <span
                                class="pointer-events-none invisible absolute bottom-full left-1/2 mb-1 -translate-x-1/2 translate-y-1 scale-90 rounded-md bg-heading-foreground/10 px-2 py-1 text-base leading-none text-heading-foreground opacity-0 blur-md backdrop-blur-lg transition-all group-hover:visible group-hover:translate-y-0 group-hover:scale-100 group-hover:opacity-100 group-hover:blur-0"
                            >
                                <?php echo is_numeric($wordModels->totalCredits()) ? rtrim(rtrim(number_format((float) $wordModels->totalCredits(), 2), '0'), '.') : ($wordModels->totalCredits()); ?>
                            </span>
                        <?php endif; ?>
                    </strong>
                    <?php echo e(__('Words')); ?>

                </h3>
            </div>
            <?php if (isset($component)) { $__componentOriginalb223a1c6a53e59e4d348d69e8bc0381b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb223a1c6a53e59e4d348d69e8bc0381b = $attributes; } ?>
<?php $component = App\View\Components\CreditList::resolve(['showType' => 'button','modalTriggerPos' => 'block'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('credit-list'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\CreditList::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'mt-4','expanded-modal-trigger' => true,'modal-trigger-variant' => 'ghost-shadow']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb223a1c6a53e59e4d348d69e8bc0381b)): ?>
<?php $attributes = $__attributesOriginalb223a1c6a53e59e4d348d69e8bc0381b; ?>
<?php unset($__attributesOriginalb223a1c6a53e59e4d348d69e8bc0381b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb223a1c6a53e59e4d348d69e8bc0381b)): ?>
<?php $component = $__componentOriginalb223a1c6a53e59e4d348d69e8bc0381b; ?>
<?php unset($__componentOriginalb223a1c6a53e59e4d348d69e8bc0381b); ?>
<?php endif; ?>
        </div>
    </div>
<?php else: ?>
    <h3 class="mb-8">
        <?php echo app('translator')->get('Your Plan'); ?>
    </h3>

    <p class="mb-3 font-medium leading-relaxed text-heading-foreground/60">
        <?php if(auth()->user()->activePlan() !== null): ?>
            <?php echo e(__('You have currently')); ?>

            <strong class="text-heading-foreground"><?php echo e(getSubscriptionName()); ?></strong>
            <?php echo e(__('plan.')); ?>

            <?php echo e(__('Will refill automatically in')); ?> <?php echo e(getSubscriptionDaysLeft()); ?> <?php echo e(__('Days.')); ?>

            <?php echo e(checkIfTrial() === true ? __('You are in Trial time.') : ''); ?>

        <?php else: ?>
            <?php echo e(__('You have no subscription at the moment. Please select a subscription plan or a token pack.')); ?>

        <?php endif; ?>

        <?php if($setting->feature_ai_image): ?>
            <?php echo e(__('Total')); ?>

            <strong class="text-heading-foreground">
                <?php echo is_numeric($wordModels->checkIfThereUnlimited() ? __('Unlimited') : $wordModels->totalCredits()) ? rtrim(rtrim(number_format((float) $wordModels->checkIfThereUnlimited() ? __('Unlimited') : $wordModels->totalCredits(), 2), '0'), '.') : ($wordModels->checkIfThereUnlimited() ? __('Unlimited') : $wordModels->totalCredits()); ?>
            </strong>
            <?php echo e(__('word and')); ?>

            <strong class="text-heading-foreground">
                <?php echo is_numeric($imageModels->checkIfThereUnlimited() ? __('Unlimited') : $imageModels->totalCredits()) ? rtrim(rtrim(number_format((float) $imageModels->checkIfThereUnlimited() ? __('Unlimited') : $imageModels->totalCredits(), 2), '0'), '.') : ($imageModels->checkIfThereUnlimited() ? __('Unlimited') : $imageModels->totalCredits()); ?>

            </strong>
            <?php echo e(__('image tokens left.')); ?>

        <?php else: ?>
            <?php echo e(__('Total')); ?>

            <strong class="text-heading-foreground">
                <?php echo is_numeric($wordModels->checkIfThereUnlimited() ? __('Unlimited') : $wordModels->totalCredits()) ? rtrim(rtrim(number_format((float) $wordModels->checkIfThereUnlimited() ? __('Unlimited') : $wordModels->totalCredits(), 2), '0'), '.') : ($wordModels->checkIfThereUnlimited() ? __('Unlimited') : $wordModels->totalCredits()); ?>
            </strong>
            <?php echo e(__('tokens left.')); ?>

        <?php endif; ?>
    </p>

    <div class="relative">
        <div
            class="relative [&_.apexcharts-canvas]:mx-auto [&_.apexcharts-canvas]:max-w-full [&_.apexcharts-legend-text]:!m-0 [&_.apexcharts-legend-text]:!pe-2 [&_.apexcharts-legend-text]:ps-2 [&_.apexcharts-legend-text]:!text-foreground [&_.apexcharts-svg]:max-w-full"
            id="chart-credit"
        ></div>
        <h3 class="group absolute left-1/2 top-[calc(50%-5px)] m-0 -translate-x-1/2 text-center text-xs font-normal">
            <strong class="block text-[2em] font-semibold leading-none max-sm:text-[1.5em]">
                <?php
            if (is_null($wordModels->checkIfThereUnlimited() ? __('Unlimited') : $wordModels->totalCredits())) {
                echo '0';
            } else if ( !is_numeric($wordModels->checkIfThereUnlimited() ? __('Unlimited') : $wordModels->totalCredits() ) ) {
                echo $wordModels->checkIfThereUnlimited() ? __('Unlimited') : $wordModels->totalCredits();
            } else {
                echo number_shorten($wordModels->checkIfThereUnlimited() ? __('Unlimited') : $wordModels->totalCredits());
            }
            ?>
                <?php if(!$wordModels->checkIfThereUnlimited()): ?>
                    <span
                        class="pointer-events-none invisible absolute bottom-full left-1/2 mb-1 -translate-x-1/2 translate-y-1 scale-90 rounded-md bg-heading-foreground/10 px-2 py-1 text-base leading-none text-heading-foreground opacity-0 blur-md backdrop-blur-lg transition-all group-hover:visible group-hover:translate-y-0 group-hover:scale-100 group-hover:opacity-100 group-hover:blur-0"
                    >
                        <?php echo is_numeric($wordModels->totalCredits()) ? rtrim(rtrim(number_format((float) $wordModels->totalCredits(), 2), '0'), '.') : ($wordModels->totalCredits()); ?>
                    </span>
                <?php endif; ?>
            </strong>
            <?php echo e(__('Words')); ?>

        </h3>
    </div>

    <div class="mt-4 flex flex-wrap items-center justify-center gap-4">
        <?php if (isset($component)) { $__componentOriginalb223a1c6a53e59e4d348d69e8bc0381b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb223a1c6a53e59e4d348d69e8bc0381b = $attributes; } ?>
<?php $component = App\View\Components\CreditList::resolve(['showType' => 'button','modalTriggerPos' => 'block'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('credit-list'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\CreditList::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['expanded-modal-trigger' => true,'modal-trigger-variant' => 'ghost-shadow']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb223a1c6a53e59e4d348d69e8bc0381b)): ?>
<?php $attributes = $__attributesOriginalb223a1c6a53e59e4d348d69e8bc0381b; ?>
<?php unset($__attributesOriginalb223a1c6a53e59e4d348d69e8bc0381b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb223a1c6a53e59e4d348d69e8bc0381b)): ?>
<?php $component = $__componentOriginalb223a1c6a53e59e4d348d69e8bc0381b; ?>
<?php unset($__componentOriginalb223a1c6a53e59e4d348d69e8bc0381b); ?>
<?php endif; ?>

        <?php if (isset($component)) { $__componentOriginale67687e3e4e61f963b25a6bcf3983629 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale67687e3e4e61f963b25a6bcf3983629 = $attributes; } ?>
<?php $component = App\View\Components\Button::resolve(['variant' => 'ghost-shadow','href' => ''.e(LaravelLocalization::localizeUrl(route('dashboard.user.payment.subscription'))).''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Button::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'hover:bg-primary','data-name' => ''.e(\App\Enums\Introduction::SELECT_PLAN).'']); ?>
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
            <?php echo e(__('Select a Plan')); ?>

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

        <?php if(getSubscriptionStatus()): ?>
            <?php if (isset($component)) { $__componentOriginale67687e3e4e61f963b25a6bcf3983629 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale67687e3e4e61f963b25a6bcf3983629 = $attributes; } ?>
<?php $component = App\View\Components\Button::resolve(['variant' => 'danger','href' => ''.e(LaravelLocalization::localizeUrl(route('dashboard.user.payment.cancelActiveSubscription'))).''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Button::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['onclick' => 'return confirm(\'Are you sure to cancel your plan? You will lose your remaining usage.\');']); ?>
                <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('tabler-circle-minus'); ?>
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
                <?php echo e(__('Cancel My Plan')); ?>

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
    </div>
<?php endif; ?>

<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(custom_theme_url('/assets/libs/apexcharts/dist/apexcharts.min.js')); ?>"></script>
    <script>
        // @formatter:off
        document.addEventListener("DOMContentLoaded", function() {
            "use strict";

            <?php
                if ($wordModels->checkIfThereUnlimited()) {
                    $remainingPercentage = 999999999999;
                } elseif ($total_words === 0) {
                    $remainingPercentage = $wordModels->totalCredits();
                } else {
                    $remainingPercentage = round(($wordModels->totalCredits() / $total_words) * 100, 2);
                }
            ?>

            const remainingPercentage = <?php echo e($remainingPercentage); ?>;
            const usedPercentage = 100 - remainingPercentage;
            const options = {
                series: [remainingPercentage, usedPercentage],
                labels: [<?php echo json_encode(__('Remaining'), 15, 512) ?>, <?php echo json_encode(__('Used'), 15, 512) ?>],
                colors: ['#9A34CD', 'rgba(154,52,205,0.2)'],
                tooltip: {
                    style: {
                        color: '#ffffff',
                    },
                },
                chart: {
                    type: 'donut',
                    height: 215,
                },
                legend: {
                    position: 'bottom',
                    fontFamily: 'inherit',
                },
                plotOptions: {
                    pie: {
                        startAngle: -90,
                        endAngle: 90,
                        offsetY: 0,
                        donut: {
                            size: '70%',
                        }
                    },
                },
                grid: {
                    padding: {
                        bottom: -130
                    }
                },
                stroke: {
                    width: 5,
                    colors: 'hsl(var(--background))'
                },
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: document.getElementById('chart-credit').parentElement.offsetWidth
                        },
                    }
                }],
                dataLabels: {
                    enabled: false,
                }
            };
            window.ApexCharts && (new ApexCharts(document.getElementById('chart-credit'), options)).render();
        });
        // @formatter:on
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH /var/www/Novuk/resources/views/default/panel/user/finance/subscriptionStatus.blade.php ENDPATH**/ ?>