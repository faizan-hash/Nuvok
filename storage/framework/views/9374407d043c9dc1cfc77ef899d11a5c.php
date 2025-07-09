<header class="site-header fixed inset-x-0 top-0 z-50 transition-all duration-300 backdrop-blur-md">
    <nav style="color:white;"
        class="site-header-nav relative flex items-center justify-between border-b border-white/10 px-7 py-4 text-sm bg-transparent text-white transition-all duration-500 js-nav max-sm:px-2"
        id="frontend-local-navbar"
    >
        <a class="site-logo relative basis-1/3 max-lg:basis-1/3" href="<?php echo e(route('index')); ?>">
            <img 
            style="width: 200px;height: 50px;"
                class="h-8 absolute start-0 top-1/2 -translate-y-1/2 translate-x-3 transition-all"
                src="<?php echo e(asset('images/Asset 8@3x transparent.png')); ?>"
                alt="Logo"
            />
        </a>
        <div class="site-nav-container basis-1/3 transition-all max-lg:absolute max-lg:right-0 max-lg:top-full max-lg:max-h-0 max-lg:w-full max-lg:overflow-hidden max-lg:bg-[#343C57] max-lg:text-white [&.lqd-is-active]:max-lg:max-h-[calc(100vh-150px)]">
            <div class="max-lg:max-h-[inherit] max-lg:overflow-y-scroll">
                <ul class="flex items-center justify-center gap-14 whitespace-nowrap text-center max-xl:gap-10 max-lg:flex-col max-lg:items-start max-lg:gap-5 max-lg:p-10">
                    <?php
                        $menu_options = json_decode($setting->menu_options ?? '[{"title": "Home","url": "#banner","target": false},{"title": "Features","url": "#features","target": false},{"title": "How it Works","url": "#how-it-works","target": false},{"title": "Testimonials","url": "#testimonials","target": false},{"title": "Pricing","url": "#pricing","target": false},{"title": "FAQ","url": "#faq","target": false}]', true);
                        foreach ($menu_options as $menu_item) {
                            printf(
                                '<li><a href="%1$s" target="%3$s" class="text-white relative before:absolute before:-inset-x-4 before:-inset-y-2 before:scale-75 before:rounded-lg before:bg-current before:opacity-0 before:transition-all hover:before:scale-100 hover:before:opacity-10 [&.active]:before:scale-100 [&.active]:before:opacity-10">%2$s</a></li>',
                                Route::currentRouteName() != 'index' ? url('/') . $menu_item['url'] : $menu_item['url'],
                                __($menu_item['title']),
                                $menu_item['target'] === false ? '_self' : '_blank'
                            );
                        }
                    ?>
                </ul>
            </div>
        </div>
        <div class="flex basis-1/3 justify-end gap-2 max-lg:basis-2/3">
            <?php if(auth()->guard()->check()): ?>
                <div class="mx-3">
                    <a
                        class="relative inline-flex items-center overflow-hidden rounded-lg border-[2px] border-white !border-opacity-0 bg-white !bg-opacity-10 px-4 py-2 font-medium text-white transition-all duration-300 hover:scale-105 hover:border-black hover:bg-black hover:!bg-opacity-100 hover:text-white hover:shadow-lg js-nav-button"
                        href="<?php echo e(LaravelLocalization::localizeUrl(route('dashboard.index'))); ?>"
                    >
                        <?php echo __('Dashboard'); ?>

                    </a>
                </div>
            <?php else: ?>
                <a
                    class="relative inline-flex items-center overflow-hidden rounded-lg border-[2px] border-white !border-opacity-10 px-4 py-2 font-medium text-white transition-all duration-300 hover:scale-105 hover:border-black hover:bg-black hover:text-white hover:shadow-lg js-nav-button"
                    href="<?php echo e(LaravelLocalization::localizeUrl(route('login'))); ?>"
                >
                    <?php echo __($fSetting->sign_in); ?>

                </a>
                <a
                    class="relative inline-flex items-center overflow-hidden rounded-lg border-[2px] border-white !border-opacity-0 bg-white !bg-opacity-10 px-4 py-2 font-medium text-white transition-all duration-300 hover:scale-105 hover:border-black hover:bg-black hover:!bg-opacity-100 hover:text-white hover:shadow-lg js-nav-button"
                    href="<?php echo e(LaravelLocalization::localizeUrl(route('register'))); ?>"
                >
                    <?php echo __($fSetting->join_hub); ?>

                </a>
            <?php endif; ?>
            <!--<button-->
            <!--    class="mobile-nav-trigger size-10 group flex shrink-0 items-center justify-center rounded-full bg-white !bg-opacity-10 js-nav-button"-->
            
            <!--    <span class="flex w-4 flex-col gap-1">-->
            <!--        <?php for($i = 0; $i <= 1; $i++): ?>-->
            <!--            <span-->
            <!--                class="inline-flex h-[2px] w-full bg-white transition-transform first:origin-left last:origin-right [&.lqd-is-active]:first:-translate-y-[2px] [&.lqd-is-active]:first:translate-x-[3px] [&.lqd-is-active]:first:rotate-45 [&.lqd-is-active]:last:-translate-x-[2px] [&.lqd-is-active]:last:-translate-y-[8px] [&.lqd-is-active]:last:-rotate-45"-->
            <!--            ></span>-->
            <!--        <?php endfor; ?>-->
            <!--    </span>-->
            <!--</button>-->
        </div>
    </nav>
</header>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const nav = document.querySelector('.js-nav');
    const navButtons = document.querySelectorAll('.js-nav-button');

    const updateNav = () => {
        // if (window.scrollY > 550) {
        //     nav.classList.add('lqd-is-sticky', 'bg-black', 'text-white', 'shadow-md');
        //     nav.classList.remove('bg-transparent');
        //     navButtons.forEach(button => {
        //         button.classList.add('text-white');
        //         if (button.tagName === 'BUTTON') {
        //             button.classList.add('bg-black');
        //             button.classList.remove('bg-white');
        //         }
        //     });
        // } else {
        //     nav.classList.remove('lqd-is-sticky', 'bg-black', 'text-white', 'shadow-md');
        //     nav.classList.add('bg-transparent');
        //     navButtons.forEach(button => {
        //         button.classList.add('text-white');
        //         if (button.tagName === 'BUTTON') {
        //             button.classList.remove('bg-black');
        //             button.classList.add('bg-white');
        //         }
        //     });
        // }
        if (window.scrollY > 550) {
    nav.classList.add('lqd-is-sticky', 'text-white', 'shadow-md');
    nav.classList.remove('bg-transparent', 'bg-black');
    nav.style.backgroundColor = '#1C2A39';
    navButtons.forEach(button => {
        button.classList.add('text-white');
        if (button.tagName === 'BUTTON') {
            button.style.backgroundColor = '#1C2A39';
            button.classList.remove('bg-white', 'bg-black');
        }
    });
} else {
    nav.classList.remove('lqd-is-sticky', 'text-white', 'shadow-md');
    nav.classList.add('bg-transparent');
    nav.style.backgroundColor = ''; // reset
    navButtons.forEach(button => {
        button.classList.add('text-white');
        if (button.tagName === 'BUTTON') {
            button.style.backgroundColor = '';
            button.classList.remove('bg-black');
            button.classList.add('bg-white');
        }
    });
}

    };

    window.addEventListener('scroll', updateNav);
    updateNav(); // Initial check
});
</script><?php /**PATH /var/www/Novuk/resources/views/default/layout/header.blade.php ENDPATH**/ ?>