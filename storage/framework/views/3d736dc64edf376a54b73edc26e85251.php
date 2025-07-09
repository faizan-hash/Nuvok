<header class="lqd-header relative flex h-[--header-height] border-b border-header-border bg-header-background text-xs font-medium transition-colors max-lg:h-[65px]">
    <div class="<?php echo \Illuminate\Support\Arr::toCssClasses([
        'lqd-header-container flex w-full grow gap-2 px-4 max-lg:w-full max-lg:max-w-none',
        'container' => !$attributes->get('layout-wide'),
        'container-fluid' => $attributes->get('layout-wide'),
        Theme::getSetting('wideLayoutPaddingX', '') =>
            filled(Theme::getSetting('wideLayoutPaddingX', '')) &&
            $attributes->get('layout-wide'),
    ]); ?>">

        
        <div class="mobile-nav-logo flex items-center gap-3 lg:hidden">
            <button
                class="lqd-mobile-nav-toggle size-10 flex items-center justify-center"
                type="button"
                x-init
                @click.prevent="$store.mobileNav.toggleNav()"
                :class="{ 'lqd-is-active': !$store.mobileNav.navCollapse }"
            >
                <span class="lqd-mobile-nav-toggle-icon relative h-[2px] w-5 rounded-xl bg-current"></span>
            </button>
            <?php if (isset($component)) { $__componentOriginalfcd9f9dda10a0d29a59ffd5e02ae1d1e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfcd9f9dda10a0d29a59ffd5e02ae1d1e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.header-logo','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('header-logo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfcd9f9dda10a0d29a59ffd5e02ae1d1e)): ?>
<?php $attributes = $__attributesOriginalfcd9f9dda10a0d29a59ffd5e02ae1d1e; ?>
<?php unset($__attributesOriginalfcd9f9dda10a0d29a59ffd5e02ae1d1e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfcd9f9dda10a0d29a59ffd5e02ae1d1e)): ?>
<?php $component = $__componentOriginalfcd9f9dda10a0d29a59ffd5e02ae1d1e; ?>
<?php unset($__componentOriginalfcd9f9dda10a0d29a59ffd5e02ae1d1e); ?>
<?php endif; ?>
        </div>

        
        <?php if($title ?? false): ?>
            <div class="header-title-container peer/title hidden items-center lg:flex">
                <h1 class="m-0 font-semibold">
                    <?php echo e($title); ?>

                </h1>
            </div>
        <?php endif; ?>

        <?php echo $__env->first(['focus-mode::header', 'components.includes.ai-tools', 'vendor.empty'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        
        <div class="header-search-container flex items-center peer-[&.header-title-container]/title:grow peer-[&.header-title-container]/title:justify-center">
            <?php if (isset($component)) { $__componentOriginal53f735d50787b0384453e20d5300da69 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal53f735d50787b0384453e20d5300da69 = $attributes; } ?>
<?php $component = App\View\Components\HeaderSearch::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('header-search'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\HeaderSearch::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal53f735d50787b0384453e20d5300da69)): ?>
<?php $attributes = $__attributesOriginal53f735d50787b0384453e20d5300da69; ?>
<?php unset($__attributesOriginal53f735d50787b0384453e20d5300da69); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal53f735d50787b0384453e20d5300da69)): ?>
<?php $component = $__componentOriginal53f735d50787b0384453e20d5300da69; ?>
<?php unset($__componentOriginal53f735d50787b0384453e20d5300da69); ?>
<?php endif; ?>
        </div>

        <div class="header-actions-container flex grow justify-end gap-4 max-lg:basis-2/3 max-lg:gap-2">

            
            <?php if($actions ?? false): ?>
                <?php echo e($actions); ?>

            <?php else: ?>
                <div class="flex items-center max-xl:gap-2 max-lg:hidden xl:gap-3">
                    <?php if(Auth::user()->isAdmin()): ?>
                        <?php if (isset($component)) { $__componentOriginale67687e3e4e61f963b25a6bcf3983629 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale67687e3e4e61f963b25a6bcf3983629 = $attributes; } ?>
<?php $component = App\View\Components\Button::resolve(['href' => ''.e(route('dashboard.admin.index')).'','variant' => 'ghost-shadow'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Button::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                            <?php echo e(__('Admin Panel')); ?>

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

                    <?php if($settings_two->liquid_license_type == 'Extended License'): ?>
                        <?php if($subscription = getSubscription()): ?>
                            <?php if (isset($component)) { $__componentOriginale67687e3e4e61f963b25a6bcf3983629 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale67687e3e4e61f963b25a6bcf3983629 = $attributes; } ?>
<?php $component = App\View\Components\Button::resolve(['href' => ''.e(route('dashboard.user.payment.subscription')).'','variant' => 'ghost-shadow'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Button::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'max-xl:hidden']); ?>
                                <?php echo e($subscription?->plan?->name); ?> -  <?php echo e(getSubscriptionDaysLeft()); ?>

                                <?php echo e(__('Days Left')); ?>

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
                        <?php else: ?>
                            <?php if (isset($component)) { $__componentOriginale67687e3e4e61f963b25a6bcf3983629 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale67687e3e4e61f963b25a6bcf3983629 = $attributes; } ?>
<?php $component = App\View\Components\Button::resolve(['href' => ''.e(route('dashboard.user.payment.subscription')).'','variant' => 'ghost-shadow'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Button::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'max-xl:hidden']); ?>
                                <?php echo e(__('No Active Subscription')); ?>

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

                        <?php if (isset($component)) { $__componentOriginale67687e3e4e61f963b25a6bcf3983629 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale67687e3e4e61f963b25a6bcf3983629 = $attributes; } ?>
<?php $component = App\View\Components\Button::resolve(['href' => ''.e(route('dashboard.user.payment.subscription')).''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Button::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'max-xl:hidden']); ?>
                            <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('tabler-bolt'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(BladeUI\Icons\Components\Svg::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'size-4 fill-current']); ?>
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
                            <span class="max-lg:hidden">
                                <?php echo e(__('Upgrade')); ?>

                            </span>
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

            <div class="flex items-center gap-4 max-lg:gap-2">
                
                <?php if(Theme::getSetting('dashboard.supportedColorSchemes') === 'all'): ?>
                    <?php if (isset($component)) { $__componentOriginaleecbb9db3a7b2f7d8583df3373bbdf39 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaleecbb9db3a7b2f7d8583df3373bbdf39 = $attributes; } ?>
<?php $component = App\View\Components\LightDarkSwitch::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('light-dark-switch'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\LightDarkSwitch::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaleecbb9db3a7b2f7d8583df3373bbdf39)): ?>
<?php $attributes = $__attributesOriginaleecbb9db3a7b2f7d8583df3373bbdf39; ?>
<?php unset($__attributesOriginaleecbb9db3a7b2f7d8583df3373bbdf39); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaleecbb9db3a7b2f7d8583df3373bbdf39)): ?>
<?php $component = $__componentOriginaleecbb9db3a7b2f7d8583df3373bbdf39; ?>
<?php unset($__componentOriginaleecbb9db3a7b2f7d8583df3373bbdf39); ?>
<?php endif; ?>
                <?php endif; ?>

                <?php echo $__env->first(['focus-mode::ai-tools-button', 'components.includes.ai-tools-button', 'vendor.empty'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <?php if(setting('notification_active', 0)): ?>
                    
                    <?php if (isset($component)) { $__componentOriginale5bc9b34dd139a393f71cdc403b71855 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale5bc9b34dd139a393f71cdc403b71855 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.notifications','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('notifications'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale5bc9b34dd139a393f71cdc403b71855)): ?>
<?php $attributes = $__attributesOriginale5bc9b34dd139a393f71cdc403b71855; ?>
<?php unset($__attributesOriginale5bc9b34dd139a393f71cdc403b71855); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale5bc9b34dd139a393f71cdc403b71855)): ?>
<?php $component = $__componentOriginale5bc9b34dd139a393f71cdc403b71855; ?>
<?php unset($__componentOriginale5bc9b34dd139a393f71cdc403b71855); ?>
<?php endif; ?>
                <?php endif; ?>

                
                <?php if(count(explode(',', $settings_two->languages)) > 1): ?>
                    <?php if (isset($component)) { $__componentOriginalca074c87bfce15121138192735c7695a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalca074c87bfce15121138192735c7695a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.language-dropdown','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('language-dropdown'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalca074c87bfce15121138192735c7695a)): ?>
<?php $attributes = $__attributesOriginalca074c87bfce15121138192735c7695a; ?>
<?php unset($__attributesOriginalca074c87bfce15121138192735c7695a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalca074c87bfce15121138192735c7695a)): ?>
<?php $component = $__componentOriginalca074c87bfce15121138192735c7695a; ?>
<?php unset($__componentOriginalca074c87bfce15121138192735c7695a); ?>
<?php endif; ?>
                <?php endif; ?>

                
                <?php if (isset($component)) { $__componentOriginale67687e3e4e61f963b25a6bcf3983629 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale67687e3e4e61f963b25a6bcf3983629 = $attributes; } ?>
<?php $component = App\View\Components\Button::resolve(['variant' => 'link','href' => ''.e(route('dashboard.user.payment.subscription')).''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Button::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'lqd-header-upgrade-btn size-10 flex items-center justify-center border p-0 text-current dark:bg-white/[3%] lg:hidden']); ?>
                    <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('tabler-bolt'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(BladeUI\Icons\Components\Svg::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['stroke-width' => '1.5']); ?>
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

                
                <?php if (isset($component)) { $__componentOriginald26e54664725015b4d5304353f34e090 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald26e54664725015b4d5304353f34e090 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.user-dropdown','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('user-dropdown'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald26e54664725015b4d5304353f34e090)): ?>
<?php $attributes = $__attributesOriginald26e54664725015b4d5304353f34e090; ?>
<?php unset($__attributesOriginald26e54664725015b4d5304353f34e090); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald26e54664725015b4d5304353f34e090)): ?>
<?php $component = $__componentOriginald26e54664725015b4d5304353f34e090; ?>
<?php unset($__componentOriginald26e54664725015b4d5304353f34e090); ?>
<?php endif; ?>
            </div>
        </div>
    </div>
</header>
<?php /**PATH /var/www/Novuk/resources/views/default/components/header.blade.php ENDPATH**/ ?>