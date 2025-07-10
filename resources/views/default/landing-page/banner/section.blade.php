<section
    class="site-section relative flex min-h-screen items-center justify-center overflow-hidden py-52 text-center text-white max-md:pb-16 max-md:pt-48"
    id="banner"
>
    <div class="absolute start-0 top-0 h-full w-full transform-gpu overflow-hidden [backface-visibility:hidden]">
        <div class=" absolute left-0 top-0 h-full w-full" style="background-color: #1C2A39;"></div>
    </div>
    <div class="container relative"  style="background-color: #1C2A39;">
        <div style="margin-top:50px" class=" mx-auto flex w-1/2 flex-col items-center max-lg:w-2/3 max-md:w-full">
            <h6 style="color:white;"
                class="relative mb-8 rounded-2xl bg-white bg-opacity-10 px-3 py-1">
                <span class="relative">{!! __($setting->site_name) !!}</span>
                <span class="dot relative"></span>
                <span class="relative">{!! __($fSetting->hero_subtitle) !!}</span>
            </h6>
            <div class="banner-title-wrap relative">
                <h1 style="color:white;"
                    class="banner-title mb-7 translate-y-7 font-body font-bold -tracking-wide text-white opacity-0 transition-all ease-out group-[.page-loaded]/body:translate-y-0 group-[.page-loaded]/body:opacity-100"
                    id="dynamic-hero-text">
                    <!--{!! __($fSetting->hero_title) !!}-->
                    AI-Powered Human-Centered
                    <span class="inline-flex items-center gap-2 whitespace-nowrap sm:flex-nowrap flex-wrap justify-center">
                        @if ($fSetting->hero_title_text_rotator != null)
                            <span class="lqd-text-rotator inline-grid grid-cols-1 grid-rows-1 transition-[width] duration-200">
                                @php
                                    $keywords = explode(',', __($fSetting->hero_title_text_rotator));
                                @endphp
                                @foreach ($keywords as $keyword)
                                    <span
                                        class="lqd-text-rotator-item {{ $loop->first ? 'lqd-is-active' : '' }} col-start-1 row-start-1 inline-flex translate-x-3 opacity-0 blur-sm transition-all duration-300 [&.lqd-is-active]:translate-x-0 [&.lqd-is-active]:opacity-100 [&.lqd-is-active]:blur-0"
                                    >
                                        <span class="whitespace-nowrap">{!! $keyword !!}</span>
                                    </span>
                                @endforeach
                            </span>
                        @endif
                        <svg
                            class="lqd-split-text-words transition-all duration-[2850ms] max-sm:!w-5 max-sm:!h-7 shrink-0"
                            width="47"
                            height="62"
                            viewBox="0 0 47 62"
                            fill="currentColor"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path d="M27.95 0L0 38.213H18.633V61.141L46.583 22.928H27.95V0Z" />
                        </svg>
                    </span>
                </h1>
            </div>
              <!--text="{!! __($fSetting->hero_description) !!}"-->
            <p
                class="mb-7 w-3/4 text-[20px] leading-[1.25em] text-white max-sm:w-full [&_.lqd-split-text-words]:translate-y-3 [&_.lqd-split-text-words]:opacity-0 [&_.lqd-split-text-words]:transition-all [&_.lqd-split-text-words]:ease-out group-[.page-loaded]/body:[&_.lqd-split-text-words]:translate-y-0 group-[.page-loaded]/body:[&_.lqd-split-text-words]:text-white group-[.page-loaded]/body:[&_.lqd-split-text-words]:opacity-100"
                id="dynamic-hero-subtitle">
                <x-split-words
                 text="Run your business with one smart platform — from content and clients to billing and automation."
                  
                    transitionDelayStart="{{ 0.15 }}"
                    transitionDelayStep="{{ 0.02 }}"
                />
            </p>
     <div class="custom-hero-wrapper ">
    @if ($fSetting->hero_button_type == 1)
        <a
            class="custom-hero-button"
            href="{{ !empty($fSetting->hero_button_url) ? $fSetting->hero_button_url : '#' }}"
        >
            <span class="custom-hero-text">
                {!! __($fSetting->hero_button) !!}
                <svg
                    class="custom-hero-icon"
                    width="11"
                    height="14"
                    viewBox="0 0 47 62"
                    fill="currentColor"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path d="M27.95 0L0 38.213H18.633V61.141L46.583 22.928H27.95V0Z" />
                </svg>
            </span>
        </a>
    @else
        <a
            class="custom-video-button"
            href="{{ !empty($fSetting->hero_button_url) ? $fSetting->hero_button_url : '#' }}"
            data-fslightbox="video-gallery"
        >
            <svg
                class="custom-video-icon"
                xmlns="http://www.w3.org/2000/svg"
                width="40"
                height="40"
                viewBox="0 0 24 24"
                fill="none"
            >
                <path d="M0 0h24v24H0z" fill="none" />
                <path d="M6 4v16a1 1 0 0 0 1.524.852l13-8a1 1 0 0 0 0-1.704l-13-8a1 1 0 0 0-1.524.852z" fill="#37393d" />
            </svg>
            {!! __($fSetting->hero_button) !!}
        </a>
    @endif
</div>


            <br>
            <div class="translate-y-3 opacity-0 transition-all delay-[500ms] group-[.page-loaded]/body:translate-y-0 group-[.page-loaded]/body:opacity-100">
                <a style="color: white;"
                    class="transition-opacity hover:opacity-100"
                    href="#features"
                >Explore Features</a>
            </div>
        </div>
    </div>
    <div class="banner-divider absolute inset-x-0 -bottom-[2px]">
        <svg
            class="h-auto w-full fill-background"
            width="1440"
            height="105"
            viewBox="0 0 1440 105"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
            preserveAspectRatio="none"
        >
            <path d="M0 0C240 68.7147 480 103.072 720 103.072C960 103.072 1200 68.7147 1440 0V104.113H0V0Z" />
        </svg>
    </div>
</section>

<script src="{{ custom_theme_url('/assets/js/geolocation.js') }}" defer></script>
