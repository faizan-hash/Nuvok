<?php
    $theme = get_theme();
    $disable_floating_menu = true;
    $wide_layout_px_class = Theme::getSetting('wideLayoutPaddingX', '');
    $theme_google_fonts = Theme::getSetting('dashboard.googleFonts');
    $sidebarEnabledPages = Theme::getSetting('dashboard.sidebarEnabledPages') ?? [];
    $has_sidebar = in_array(Route::currentRouteName(), $sidebarEnabledPages, true) || (isset($has_sidebar) && $has_sidebar);

    if (!empty($wide_layout_px)) {
        $wide_layout_px_class = $wide_layout_px;
    }
?>
<!doctype html>
<html
    class="scroll-smooth"
    lang="<?php echo e(LaravelLocalization::getCurrentLocale()); ?>"
    dir="<?php echo e(LaravelLocalization::getCurrentLocaleDirection()); ?>"
>
<?php echo $__env->make('panel.layout.partials.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<body
    data-theme="<?php echo e(setting('dash_theme')); ?>"
    class="<?php echo \Illuminate\Support\Arr::toCssClasses([
        'group/body bg-background font-body text-xs text-foreground antialiased transition-bg',
        'has-sidebar' => $has_sidebar,
        'is-admin-page' =>
            Auth::check() &&
            (Route::is('dashboard.admin*') ||
                Route::is('dashboard.blog*') ||
                Route::is('dashboard.page*')),
        'is-auth-page' => Route::is('login', 'register', 'forgot_password'),
    ]); ?>"
>

    <?php echo $__env->first(['onboarding-pro::banner', 'vendor.empty'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php if ($__env->exists('panel.layout.after-body-open')) echo $__env->make('panel.layout.after-body-open', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('panel.layout.partials.mode-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('panel.layout.partials.loading', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->renderWhen($app_is_not_demo, 'default.panel.layout.partials.top-notice-bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>
<style>
    .lqd-navbar{
        height: 100vh;
    overflow-y: hidden;
    white-space: nowrap;
    }
    .lqd-navbar > * {
    display: inline-block; /* har child element ko horizontal line me lana ke liye */
    vertical-align: top;
}
.lqd-navbar-inner{
    width: 220px;
}

    </style>
    
    <div class="lqd-page relative flex min-h-full flex-col">

        <div class="lqd-page-wrapper grow-1 flex">
            <?php if(auth()->guard()->check()): ?>
                <?php if(!isset($disable_navbar)): ?>
                    <?php echo $__env->make('panel.layout.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>
            <?php endif; ?>

            <div class="lqd-page-content-wrap flex grow flex-col overflow-hidden">
                <?php if($good_for_now): ?>
                    <?php if(auth()->guard()->check()): ?>
                        <?php if(!isset($disable_header)): ?>
                            <?php echo $__env->make('panel.layout.header', ['layout_wide', isset($layout_wide) ? $layout_wide : ''], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endif; ?>
                        <?php if(!isset($disable_titlebar)): ?>
                            <?php echo $__env->make('panel.layout.titlebar', ['layout_wide', isset($layout_wide) ? $layout_wide : ''], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php echo $__env->yieldContent('before_content_container'); ?>
                    <div class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                        'lqd-page-content-container',
                        'h-full',
                        'container' => !isset($layout_wide) || empty($layout_wide),
                        'container-fluid' => isset($layout_wide) && !empty($layout_wide),
                        $wide_layout_px_class =>
                            filled($wide_layout_px_class) &&
                            (isset($layout_wide) && !empty($layout_wide)),
                    ]); ?>">

                        <?php echo $__env->yieldContent('content'); ?>

                        <?php echo $__env->first(['onboarding-pro::survey', 'vendor.empty'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    </div>
                <?php elseif(Auth::check() && !$good_for_now && Route::currentRouteName() != 'dashboard.admin.settings.general'): ?>
                    <div class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                        'lqd-page-content-container',
                        'container' => !isset($layout_wide) || empty($layout_wide),
                        'container-fluid' => isset($layout_wide) && !empty($layout_wide),
                        $wide_layout_px_class =>
                            filled($wide_layout_px_class) &&
                            (isset($layout_wide) && !empty($layout_wide)),
                    ]); ?>">
                        <?php echo $__env->make('vendor.installer.magicai_c4st_Act', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                <?php else: ?>
                    <?php if(auth()->guard()->check()): ?>
                        <?php if(!isset($disable_header)): ?>
                            <?php echo $__env->make('panel.layout.header', ['layout_wide', isset($layout_wide) ? $layout_wide : ''], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endif; ?>
                        <?php if(!isset($disable_titlebar)): ?>
                            <?php echo $__env->make('panel.layout.titlebar', ['layout_wide', isset($layout_wide) ? $layout_wide : ''], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php echo $__env->yieldContent('before_content_container'); ?>
                    <div class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                        'lqd-page-content-container',
                        'container' => !isset($layout_wide) || empty($layout_wide),
                        'container-fluid' => isset($layout_wide) && !empty($layout_wide),
                        $wide_layout_px_class =>
                            filled($wide_layout_px_class) &&
                            (isset($layout_wide) && !empty($layout_wide)),
                    ]); ?>">

                        <?php echo $__env->yieldContent('content'); ?>
                    </div>
                <?php endif; ?>

                <?php if(auth()->guard()->check()): ?>
                    <?php if(!isset($disable_footer)): ?>
                        <?php echo $__env->make('panel.layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>

                    <?php if($has_sidebar && (!isset($disable_default_sidebar) || empty($disable_default_sidebar))): ?>
                        <?php if ($__env->exists('panel.layout.sidebar')) echo $__env->make('panel.layout.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php if(auth()->guard()->check()): ?>
        <?php if(!isset($disable_floating_menu)): ?>
            <?php if (isset($component)) { $__componentOriginal1186fbc95105283416f541ca20a2df8e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1186fbc95105283416f541ca20a2df8e = $attributes; } ?>
<?php $component = App\View\Components\FloatingMenu::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('floating-menu'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\FloatingMenu::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1186fbc95105283416f541ca20a2df8e)): ?>
<?php $attributes = $__attributesOriginal1186fbc95105283416f541ca20a2df8e; ?>
<?php unset($__attributesOriginal1186fbc95105283416f541ca20a2df8e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1186fbc95105283416f541ca20a2df8e)): ?>
<?php $component = $__componentOriginal1186fbc95105283416f541ca20a2df8e; ?>
<?php unset($__componentOriginal1186fbc95105283416f541ca20a2df8e); ?>
<?php endif; ?>
        <?php endif; ?>
        <?php if(!isset($disable_mobile_bottom_menu)): ?>
            <?php if (isset($component)) { $__componentOriginal4fd86c034ffd3ed5f13bef4e5d216cbd = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4fd86c034ffd3ed5f13bef4e5d216cbd = $attributes; } ?>
<?php $component = App\View\Components\BottomMenu::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('bottom-menu'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\BottomMenu::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4fd86c034ffd3ed5f13bef4e5d216cbd)): ?>
<?php $attributes = $__attributesOriginal4fd86c034ffd3ed5f13bef4e5d216cbd; ?>
<?php unset($__attributesOriginal4fd86c034ffd3ed5f13bef4e5d216cbd); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4fd86c034ffd3ed5f13bef4e5d216cbd)): ?>
<?php $component = $__componentOriginal4fd86c034ffd3ed5f13bef4e5d216cbd; ?>
<?php unset($__componentOriginal4fd86c034ffd3ed5f13bef4e5d216cbd); ?>
<?php endif; ?>
        <?php endif; ?>
    <?php endif; ?>

    <?php if(!isset($disableChatbot)): ?>
        <?php echo $__env->renderWhen(in_array($settings_two->chatbot_status, ['dashboard', 'both']) &&
                !activeRoute('dashboard.user.openai.chat.chat', 'dashboard.user.openai.webchat.workbook') &&
                !(route('dashboard.user.openai.generator.workbook', 'ai_vision') == url()->current()) &&
                !(route('dashboard.user.openai.generator.workbook', 'ai_chat_image') == url()->current()) &&
                !(route('dashboard.user.openai.generator.workbook', 'ai_pdf') == url()->current()),
            'panel.chatbot.widget', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>
    <?php endif; ?>

    <!--<script src="<?php echo e(custom_theme_url('/assets/libs/underscore/underscore-umd-min.js')); ?>"></script>-->
    <?php echo $__env->make('panel.layout.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!--<?php if(session()->has('message')): ?>-->
    <!--    <script>-->
    <!--        toastr.<?php echo e(session('type')); ?>('<?php echo e(session('message')); ?>');-->
    <!--    </script>-->
    <!--<?php endif; ?>-->

    <!--<?php if($errors->any()): ?>-->
    <!--    <script>-->
    <!--        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>-->
    <!--            toastr.error('<?php echo e($error); ?>');-->
    <!--        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>-->
    <!--    </script>-->
    <!--<?php endif; ?>-->

    <?php if(auth()->guard()->check()): ?>
        
        
        
        
        
        
        
        
        
        
        
        
        
        
    <?php endif; ?>

    <?php echo $__env->yieldPushContent('script'); ?>

    <script src="<?php echo e(custom_theme_url('/assets/js/frontend.js')); ?>"></script>

    <?php if($setting->dashboard_code_before_body != null): ?>
        <?php echo $setting->dashboard_code_before_body; ?>

    <?php endif; ?>

    <?php if(auth()->guard()->check()): ?>
        <?php if(auth()->user()->isAdmin()): ?>
            <script src="<?php echo e(custom_theme_url('/assets/js/panel/update-check.js')); ?>"></script>
        <?php endif; ?>
    <?php endif; ?>
<!--<script>-->
<!--    toastr.options = {-->
        <!--"positionClass": "toast-bottom-right", // 👈 change this-->
        <!--// "timeOut": "3",-->
<!--        "closeButton": true,-->
<!--        "progressBar": true,-->
<!--    };-->
<!--</script>-->

    <script src="<?php echo e(custom_theme_url('/assets/libs/introjs/intro.min.js')); ?>"></script>
    <script src="<?php echo e(custom_theme_url('assets/js/chatbot.js')); ?>"></script>

    <?php if ($__env->exists('panel.layout.before-body-close')) echo $__env->make('panel.layout.before-body-close', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php if ($__env->exists('seo-tool::particles.generate-seo-script')) echo $__env->make('seo-tool::particles.generate-seo-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scriptConfig(); ?>


    <?php echo $__env->make('panel.layout.includes.lazy-intercom', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php if(auth()->guard()->check()): ?>
        <?php echo $__env->make('panel.layout.includes.subscription-status', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    <template id="typing-template">
        <div class="lqd-typing relative inline-flex items-center gap-3 rounded-full bg-secondary !px-3 !py-2 text-xs font-medium leading-none text-secondary-foreground">
            <?php echo e(__('Typing')); ?>

            <div class="lqd-typing-dots flex h-5 items-center gap-1">
                <span class="lqd-typing-dot inline-block !h-1 !w-1 rounded-full !bg-current opacity-40 ![animation-delay:0.2s]"></span>
                <span class="lqd-typing-dot inline-block !h-1 !w-1 rounded-full !bg-current opacity-60 ![animation-delay:0.3s]"></span>
                <span class="lqd-typing-dot inline-block !h-1 !w-1 rounded-full !bg-current opacity-80 ![animation-delay:0.4s]"></span>
            </div>
        </div>
    </template>

    <template id="copy-btns-template">
        <div
            class="pointer-events-none invisible absolute bottom-full flex translate-y-1 flex-col gap-2 pb-2 opacity-0 transition-all group-[&.active]/copy-wrap:pointer-events-auto group-[&.active]/copy-wrap:visible group-[&.active]/copy-wrap:translate-y-0 group-[&.active]/copy-wrap:opacity-100">
            <button
                class="group/btn relative inline-flex size-9 items-center justify-center rounded-full bg-white p-0 text-[12px] text-black shadow-lg transition-all hover:scale-110"
                data-copy-type="md"
                type="button"
            >
                <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('tabler-markdown'); ?>
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
                <span
                    class="absolute end-full top-1/2 me-1 -translate-y-1/2 translate-x-1 whitespace-nowrap rounded-full bg-white px-3 py-1 font-medium opacity-0 shadow-lg transition-all group-hover/btn:translate-x-0 group-hover/btn:opacity-100"
                >
                    <?php echo app('translator')->get('Copy Markdown'); ?>
                </span>
            </button>
            <button
                class="group/btn relative inline-flex size-9 items-center justify-center rounded-full bg-white p-0 text-[12px] text-black shadow-lg transition-all hover:scale-110"
                data-copy-type="html"
                type="button"
            >
                <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('tabler-file-type-html'); ?>
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
                <span
                    class="absolute end-full top-1/2 me-1 -translate-y-1/2 translate-x-1 whitespace-nowrap rounded-full bg-white px-3 py-1 font-medium opacity-0 shadow-lg transition-all group-hover/btn:translate-x-0 group-hover/btn:opacity-100"
                >
                    <?php echo app('translator')->get('Copy HTML'); ?>
                </span>
            </button>
        </div>
    </template>
</body>

</html>
<?php /**PATH F:\DELL\Desktop\Novuk\resources\views/default/panel/layout/app.blade.php ENDPATH**/ ?>