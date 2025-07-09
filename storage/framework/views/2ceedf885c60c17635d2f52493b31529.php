<?php
    $user_avatar = Auth::user()->avatar;

    if (!Auth::user()->github_token && !Auth::user()->google_token && !Auth::user()->facebook_token) {
        $user_avatar = '/' . $user_avatar;
    }
?>

<?php if (isset($component)) { $__componentOriginal0feec11b8470b4bf00c37924b86dc0af = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0feec11b8470b4bf00c37924b86dc0af = $attributes; } ?>
<?php $component = App\View\Components\Dropdown\Dropdown::resolve(['anchor' => 'end','offsetY' => '20px'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('dropdown.dropdown'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Dropdown\Dropdown::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'header-user-dropdown']); ?>
     <?php $__env->slot('trigger', null, ['class' => 'size-9 p-0']); ?> 
        <span
            class="size-full inline-block rounded-full bg-cover"
            style="background-image: url(<?php echo e(custom_theme_url($user_avatar)); ?>)"
        ></span>
     <?php $__env->endSlot(); ?>

     <?php $__env->slot('dropdown', null, ['class' => 'min-w-52']); ?> 
        <div class="px-3 pt-3">
            <p class="m-0 text-foreground"><?php echo e(Auth::user()->fullName()); ?></p>
            <p class="text-3xs text-foreground/70"><?php echo e(Auth::user()->email); ?></p>
        </div>

        <hr>

        <?php if (isset($component)) { $__componentOriginalb223a1c6a53e59e4d348d69e8bc0381b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb223a1c6a53e59e4d348d69e8bc0381b = $attributes; } ?>
<?php $component = App\View\Components\CreditList::resolve(['modalTriggerPos' => 'block'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('credit-list'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\CreditList::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class:legends' => 'gap-1','class:modal-trigger' => 'text-2xs w-full','modal-trigger-variant' => 'ghost-shadow','expanded-modal-trigger' => true]); ?>
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

        <hr>

        <div class="pb-2 text-2xs">
            <a
                class="flex w-full items-center px-3 py-2 hover:bg-foreground/5"
                href="<?php echo e(route('dashboard.user.2fa.activate')); ?>"
            >
                <?php echo e(__('2-Factor Auth.')); ?>

            </a>
            <a
                class="flex w-full items-center px-3 py-2 hover:bg-foreground/5"
                href="<?php echo e(route('dashboard.user.payment.subscription')); ?>"
            >
                <?php echo e(__('Plan')); ?>

            </a>
            <a
                class="flex w-full items-center px-3 py-2 hover:bg-foreground/5"
                href="<?php echo e(route('dashboard.user.orders.index')); ?>"
            >
                <?php echo e(__('Orders')); ?>

            </a>
            <a
                class="flex w-full items-center px-3 py-2 hover:bg-foreground/5"
                href="<?php echo e(route('dashboard.user.settings.index')); ?>"
            >
                <?php echo e(__('Settings')); ?>

            </a>
            <form
                class="flex w-full"
                id="logout"
                method="POST"
                action="<?php echo e(route('logout')); ?>"
            >
                <?php echo csrf_field(); ?>
                <button
                    class="flex w-full items-center px-3 py-2 hover:bg-foreground/10"
                    type="submit"
                >
                    <?php echo e(__('Logout')); ?>

                </button>
            </form>
        </div>

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
<?php /**PATH /var/www/Novuk/resources/views/default/components/user-dropdown.blade.php ENDPATH**/ ?>