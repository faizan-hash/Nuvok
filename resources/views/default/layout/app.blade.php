<!DOCTYPE html>
<html
    class="max-sm:overflow-x-hidden"
    lang="{{ LaravelLocalization::getCurrentLocale() }}"
    dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}"
>

<head>
    <meta charset="UTF-8" />
    <meta
        http-equiv="X-UA-Compatible"
        content="IE=edge"
    />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    />
    <meta
        name="description"
        content="{{ getMetaDesc($setting, $settings_two) }}"
    >
    @if (isset($setting->meta_keywords))
        <meta
            name="keywords"
            content="{{ $setting->meta_keywords }}"
        >
    @endif
    <link
        rel="icon"
        href="{{ custom_theme_url($setting->favicon_path ?? 'assets/favicon.ico') }}"
    >
    <title>NuvokAI</title>

    <!--<title>{{ getMetaTitle($setting, $settings_two) }}</title>-->

    @if (filled($google_fonts_string = \App\Helpers\Classes\ThemeHelper::googleFontsString()))
        <link
            rel="preconnect"
            href="https://fonts.googleapis.com"
        >
        <link
            rel="preconnect"
            href="https://fonts.gstatic.com"
            crossorigin
        >
        <link
            href="https://fonts.googleapis.com/css2?{{ $google_fonts_string }}&display=swap"
            rel="stylesheet"
        >
    @endif

    <link
        rel="stylesheet"
        href="{{ custom_theme_url('assets/css/frontend/flickity.min.css') }}"
    >
    <link
        href="{{ custom_theme_url('assets/libs/toastr/toastr.min.css') }}"
        rel="stylesheet"
    />

    @php
        $link = 'resources/views/' . get_theme() . '/scss/landing-page.scss';
    @endphp
    @vite($link)

    @if ($setting->frontend_custom_css != null)
        <link
            rel="stylesheet"
            href="{{ $setting->frontend_custom_css }}"
        />
    @endif
    @if ($setting->frontend_code_before_head != null)
        {!! $setting->frontend_code_before_head !!}
    @endif

    <script>
        window.liquid = {
            isLandingPage: true
        };
    </script>

    <style>
 .custom-footer-button {
    display: inline-flex;
    align-items: center;
    position: relative;
    overflow: hidden;
    border-radius: 12px;
    border: 2px solid rgba(255, 255, 255, 0);
    background-color: rgba(255, 255, 255, 0.1);
    padding: 1rem 1.75rem;
    font-weight: 600;
    color: white;
    text-decoration: none;
    transition: all 0.3s ease;
}

.custom-footer-button:hover {
    transform: scale(1.05);
    border-color: white;
    background-color: white;
    color: black;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.25);
}
/* Slide-in animation without using opacity */
.custom-hero-wrapper {
    transform: translateY(20px);
    transition: transform 0.5s ease 0.45s;
}

body.page-loaded .custom-hero-wrapper {
    transform: translateY(0);
}

/* First Hero Button */
.custom-hero-button {
    display: inline-flex;
    align-items: center;
    background-color: rgba(255, 255, 255, 0.1);
    color: white;
    font-weight: 600;
    padding: 1rem 1.75rem;
    border: 2px solid transparent;
    border-radius: 12px;
    text-decoration: none;
    transition: all 0.3s ease;
}

.custom-hero-button:hover {
    background-color: white;
    color: black;
    border-color: white;
    transform: scale(1.05);
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
}

.custom-hero-text {
    display: inline-flex;
    align-items: center;
    color: white;
}

.custom-hero-button:hover .custom-hero-text {
    color: black;
}

.custom-hero-icon {
    margin-left: 0.5rem;
    fill: currentColor;
}

/* Video Button */
.custom-video-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background-color: rgba(0, 0, 0, 0.1);
    color: white;
    font-size: 1.125rem;
    font-weight: 600;
    padding: 0.75rem 1.25rem;
    border-radius: 3rem;
    text-decoration: none;
    transition: background-color 0.3s ease;
    width: 100%;
}

.custom-video-button:hover {
    background-color: rgba(0, 0, 0, 0.2);
}

.custom-video-icon {
    margin-right: 1rem;
    background-color: white;
    padding: 13px;
    border-radius: 2rem;
}

 
 
 
        .google-ads-728 {
            width: 100%;
            max-width: 728px;
            height: auto;
        }
        /* resources/css/app.css */
        
        
        
        
         /*Common button base style */
        .right-controls .btn-filter,
        .right-controls .btn-create,
        .filter-actions .btn-apply,
        .filter-actions .btn-reset {
            background-color: transparent;
            color: #1C2A39; 
            border: 1px solid #1C2A39;
            transition: all 0.3s ease;
            padding: 8px 16px;  
            border-radius: 6px;  
        }
         Pretitle, title, subtitle all navy 
        .lqd-titlebar-pretitle,
        .lqd-titlebar-title,
        .lqd-titlebar-subtitle {
            color: #1C2A39; 
        }
        
         Hover state 
        .right-controls .btn-filter:hover,
        .right-controls .btn-create:hover,
        .filter-actions .btn-apply:hover,
        .filter-actions .btn-reset:hover {
            background-color: #6EE7B7; 
            color: #1C2A39;
            border-color: #6EE7B7;
        }
    </style>

    <!--Google AdSense-->
    {!! adsense_header() !!}
    <!--Google AdSense End-->

    {{-- Rewordfull start --}}
    {{-- <script>(function(w,r){w._rwq=r;w[r]=w[r]||function(){(w[r].q=w[r].q||[]).push(arguments)}})(window,'rewardful');</script> --}}
    {{-- <script async src='https://r.wdfl.co/rw.js' data-rewardful='API_KEY'></script> --}}
    {{-- Rewordfull end --}}

    @vite(\App\Helpers\Classes\ThemeHelper::appJsPath())

    @stack('css')

    @if (setting('additional_custom_css') != null)
        {!! setting('additional_custom_css') !!}
    @endif

    @livewireStyles
</head>

<body class="group/body bg-background font-body text-foreground">
    <div
        class="pointer-events-none invisible fixed left-0 right-0 top-0 z-[99] opacity-0 transition-opacity"
        id="app-loading-indicator"
        x-data
        :class="{ 'opacity-0': !$store.appLoadingIndicator.showing, 'invisible': !$store.appLoadingIndicator.showing }"
    >
        <div class="lqd-progress relative h-[3px] w-full bg-foreground/10">
            <div class="lqd-progress-bar lqd-progress-bar-indeterminate lqd-app-loading-indicator-progress-bar absolute inset-0 bg-primary dark:bg-heading-foreground">
            </div>
        </div>
    </div>

    @include('layout.header')

    @yield('content')

    @include('layout.footer')

    @if ($setting->frontend_custom_js != null)
        <script src="{{ $setting->frontend_custom_js }}"></script>
    @endif

    @if ($setting->frontend_code_before_body != null)
        {!! $setting->frontend_code_before_body !!}
    @endif

    <script src="{{ custom_theme_url('assets/libs/jquery/jquery.min.js') }}"></script>

    @if (in_array($settings_two->chatbot_status, ['frontend', 'both']))
        <script src="{{ custom_theme_url('assets/js/panel/openai_chatbot.js') }}"></script>
    @endif

    <script src="{{ custom_theme_url('assets/libs/vanillajs-scrollspy.min.js') }}"></script>
    <script src="{{ custom_theme_url('assets/libs/flickity.pkgd.min.js') }}"></script>
    <script src="{{ custom_theme_url('assets/js/frontend.js') }}"></script>
    <script src="{{ custom_theme_url('assets/js/frontend/frontend-animations.js') }}"></script>
    <script src="{{ custom_theme_url('assets/libs/vanillajs-scrollspy.min.js') }}"></script>
    <script src="{{ custom_theme_url('assets/libs/flickity.pkgd.min.js') }}"></script>
    <script src="{{ custom_theme_url('assets/js/frontend/frontend-animations.js') }}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const cardsContainer = document.querySelector('.templates-cards');
        const showMoreBtn = document.getElementById('templates-show-more-btn');
        const showLessBtn = document.getElementById('templates-show-less-btn');

        const maxHeight = '28rem'; // default height
        const fullHeight = 'none';

        showMoreBtn.addEventListener('click', function () {
            cardsContainer.style.maxHeight = fullHeight;
            document.querySelector('.templates-cards-overlay')?.classList.add('hidden');
            showMoreBtn.classList.add('hidden');
            showLessBtn.classList.remove('hidden');
        });

        showLessBtn.addEventListener('click', function () {
            cardsContainer.style.maxHeight = maxHeight;
            document.querySelector('.templates-cards-overlay')?.classList.remove('hidden');
            showLessBtn.classList.add('hidden');
            showMoreBtn.classList.remove('hidden');
            const section = document.getElementById('templates');
            if (section) {
                section.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
                });
    });
</script>

    @if ($setting->gdpr_status == 1)
        <script src="{{ custom_theme_url('assets/js/gdpr.js') }}"></script>
    @endif

    <script src="{{ custom_theme_url('assets/libs/fslightbox/fslightbox.js') }}"></script>
    <script src="{{ custom_theme_url('assets/libs/toastr/toastr.min.js') }}"></script>

    @if (\Session::has('message'))
        <script>
            toastr.{{ \Session::get('type') }}('{{ \Session::get('message') }}')
        </script>
    @endif

    @livewireScriptConfig()

    @stack('script')
</body>

</html>
