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
                <span class="relative"><?php echo __($setting->site_name); ?></span>
                <span class="dot relative"></span>
                <span class="relative"><?php echo __($fSetting->hero_subtitle); ?></span>
            </h6>
            <div class="banner-title-wrap relative">
                <h1 style="color:white;"
                    class="banner-title mb-7 translate-y-7 font-body font-bold -tracking-wide text-white opacity-0 transition-all ease-out group-[.page-loaded]/body:translate-y-0 group-[.page-loaded]/body:opacity-100"
                    id="dynamic-hero-text">
                    <!--<?php echo __($fSetting->hero_title); ?>-->
                    AI-Powered Human-Centered
                    <span class="inline-flex items-center gap-2 whitespace-nowrap sm:flex-nowrap flex-wrap justify-center">
                        <?php if($fSetting->hero_title_text_rotator != null): ?>
                            <span class="lqd-text-rotator inline-grid grid-cols-1 grid-rows-1 transition-[width] duration-200">
                                <?php
                                    $keywords = explode(',', __($fSetting->hero_title_text_rotator));
                                ?>
                                <?php $__currentLoopData = $keywords; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keyword): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <span
                                        class="lqd-text-rotator-item <?php echo e($loop->first ? 'lqd-is-active' : ''); ?> col-start-1 row-start-1 inline-flex translate-x-3 opacity-0 blur-sm transition-all duration-300 [&.lqd-is-active]:translate-x-0 [&.lqd-is-active]:opacity-100 [&.lqd-is-active]:blur-0"
                                    >
                                        <span class="whitespace-nowrap"><?php echo $keyword; ?></span>
                                    </span>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </span>
                        <?php endif; ?>
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
              <!--text="<?php echo __($fSetting->hero_description); ?>"-->
            <p
                class="mb-7 w-3/4 text-[20px] leading-[1.25em] text-white max-sm:w-full [&_.lqd-split-text-words]:translate-y-3 [&_.lqd-split-text-words]:opacity-0 [&_.lqd-split-text-words]:transition-all [&_.lqd-split-text-words]:ease-out group-[.page-loaded]/body:[&_.lqd-split-text-words]:translate-y-0 group-[.page-loaded]/body:[&_.lqd-split-text-words]:text-white group-[.page-loaded]/body:[&_.lqd-split-text-words]:opacity-100"
                id="dynamic-hero-subtitle">
                <?php if (isset($component)) { $__componentOriginal2b917688a5d8efb5c374dc180235cce6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2b917688a5d8efb5c374dc180235cce6 = $attributes; } ?>
<?php $component = App\View\Components\SplitWords::resolve(['text' => 'Run your business with one smart platform — from content and clients to billing and automation.','transitionDelayStart' => ''.e(0.15).'','transitionDelayStep' => ''.e(0.02).''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('split-words'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\SplitWords::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2b917688a5d8efb5c374dc180235cce6)): ?>
<?php $attributes = $__attributesOriginal2b917688a5d8efb5c374dc180235cce6; ?>
<?php unset($__attributesOriginal2b917688a5d8efb5c374dc180235cce6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2b917688a5d8efb5c374dc180235cce6)): ?>
<?php $component = $__componentOriginal2b917688a5d8efb5c374dc180235cce6; ?>
<?php unset($__componentOriginal2b917688a5d8efb5c374dc180235cce6); ?>
<?php endif; ?>
            </p>
     <div class="custom-hero-wrapper ">
    <?php if($fSetting->hero_button_type == 1): ?>
        <a
            class="custom-hero-button"
            href="<?php echo e(!empty($fSetting->hero_button_url) ? $fSetting->hero_button_url : '#'); ?>"
        >
            <span class="custom-hero-text">
                <?php echo __($fSetting->hero_button); ?>

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
    <?php else: ?>
        <a
            class="custom-video-button"
            href="<?php echo e(!empty($fSetting->hero_button_url) ? $fSetting->hero_button_url : '#'); ?>"
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
            <?php echo __($fSetting->hero_button); ?>

        </a>
    <?php endif; ?>
</div>


            <br>
            <div class="translate-y-3 opacity-0 transition-all delay-[500ms] group-[.page-loaded]/body:translate-y-0 group-[.page-loaded]/body:opacity-100">
                <a style="color: white;"
                    class="transition-opacity hover:opacity-100"
                    href="#features"
                >Discover NuvokAI</a>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Location-specific messaging configuration (ONLY for mobile devices)
    const locationMessages = {
        'Florida': {
            mobile: {
                subtitle: 'Florida contractors trust our mobile-first platform to manage jobs, create quotes, and get paid—even while working under the sun.'
            }
        },
        'Virginia': {
            mobile: {
                subtitle: 'Whether you\'re in Richmond or Virginia Beach, handle quotes, scheduling, and payments right from your phone.'
            }
        },
        'Texas': {
            mobile: {
                subtitle: 'From Houston to Dallas, manage your entire operation from your phone with AI-powered tools built for the trades.'
            }
        },
        'California': {
            mobile: {
                subtitle: 'From LA to San Francisco, streamline your business operations with mobile-first tools designed for busy tradespeople.'
            }
        },
        'New York': {
            mobile: {
                subtitle: 'Manage jobs across the five boroughs with our mobile platform built for fast-paced New York contractors.'
            }
        },
        'Illinois': {
            mobile: {
                subtitle: 'Chicago contractors and beyond—manage your entire business from your phone with AI-powered tools.'
            }
        },
        'Pennsylvania': {
            mobile: {
                subtitle: 'From Philadelphia to Pittsburgh, Pennsylvania contractors choose our mobile-first platform for job management.'
            }
        },
        'Ohio': {
            mobile: {
                subtitle: 'Ohio contractors from Cleveland to Columbus trust our mobile platform to streamline their operations.'
            }
        },
        'Georgia': {
            mobile: {
                subtitle: 'Atlanta contractors and across Georgia—manage quotes, scheduling, and payments right from your phone.'
            }
        },
        'North Carolina': {
            mobile: {
                subtitle: 'From Charlotte to Raleigh, North Carolina contractors use our mobile-first business platform.'
            }
        },
        'Michigan': {
            mobile: {
                subtitle: 'Detroit contractors and throughout Michigan—handle your entire business from your mobile device.'
            }
        },
        'New Jersey': {
            mobile: {
                subtitle: 'New Jersey contractors from Newark to Jersey City manage their business on-the-go with our platform.'
            }
        },
        'Washington': {
            mobile: {
                subtitle: 'Seattle contractors and across Washington state—streamline your business with our mobile platform.'
            }
        },
        'Arizona': {
            mobile: {
                subtitle: 'Phoenix contractors and throughout Arizona—manage jobs, quotes, and payments from your phone.'
            }
        },
        'Massachusetts': {
            mobile: {
                subtitle: 'Boston contractors and across Massachusetts—handle your contracting business from anywhere.'
            }
        },
        'Tennessee': {
            mobile: {
                subtitle: 'Nashville contractors and throughout Tennessee—manage your business operations from your mobile device.'
            }
        },
        'Indiana': {
            mobile: {
                subtitle: 'Indianapolis contractors and across Indiana—streamline your business with mobile-first tools.'
            }
        },
        'Missouri': {
            mobile: {
                subtitle: 'Kansas City and St. Louis contractors—manage your entire operation from your phone.'
            }
        },
        'Maryland': {
            mobile: {
                subtitle: 'Baltimore contractors and across Maryland—handle quotes, scheduling, and billing from your phone.'
            }
        },
        'Wisconsin': {
            mobile: {
                subtitle: 'Milwaukee contractors and throughout Wisconsin—manage your business on-the-go with our platform.'
            }
        },
        'Colorado': {
            mobile: {
                subtitle: 'Denver contractors and across Colorado—manage your contracting business from your phone.'
            }
        },
        'Minnesota': {
            mobile: {
                subtitle: 'Minneapolis contractors and throughout Minnesota—handle your business operations from your mobile device.'
            }
        },
        'South Carolina': {
            mobile: {
                subtitle: 'Charleston contractors and across South Carolina—streamline your business with our mobile platform.'
            }
        },
        'Alabama': {
            mobile: {
                subtitle: 'Birmingham contractors and throughout Alabama—manage jobs, quotes, and payments from your phone.'
            }
        },
        'Louisiana': {
            mobile: {
                subtitle: 'New Orleans contractors and across Louisiana—handle your contracting business from anywhere.'
            }
        },
        'Kentucky': {
            mobile: {
                subtitle: 'Louisville contractors and throughout Kentucky—manage your business operations from your mobile device.'
            }
        },
        'Oregon': {
            mobile: {
                subtitle: 'Portland contractors and across Oregon—streamline your business with mobile-first tools.'
            }
        },
        'Oklahoma': {
            mobile: {
                subtitle: 'Oklahoma City contractors and throughout Oklahoma—manage your entire operation from your phone.'
            }
        },
        'Connecticut': {
            mobile: {
                subtitle: 'Hartford contractors and across Connecticut—handle quotes, scheduling, and billing from your phone.'
            }
        },
        'Utah': {
            mobile: {
                subtitle: 'Salt Lake City contractors and throughout Utah—manage your business on-the-go with our platform.'
            }
        },
        'Nevada': {
            mobile: {
                subtitle: 'Las Vegas contractors and across Nevada—manage your contracting business from your phone.'
            }
        },
        'Arkansas': {
            mobile: {
                subtitle: 'Little Rock contractors and throughout Arkansas—handle your business operations from your mobile device.'
            }
        },
        'Mississippi': {
            mobile: {
                subtitle: 'Jackson contractors and across Mississippi—streamline your business with our mobile platform.'
            }
        },
        'Kansas': {
            mobile: {
                subtitle: 'Wichita contractors and throughout Kansas—manage jobs, quotes, and payments from your phone.'
            }
        },
        'New Mexico': {
            mobile: {
                subtitle: 'Albuquerque contractors and across New Mexico—handle your contracting business from anywhere.'
            }
        },
        'Nebraska': {
            mobile: {
                subtitle: 'Omaha contractors and throughout Nebraska—manage your business operations from your mobile device.'
            }
        },
        'West Virginia': {
            mobile: {
                subtitle: 'Charleston contractors and across West Virginia—streamline your business with mobile-first tools.'
            }
        },
        'Idaho': {
            mobile: {
                subtitle: 'Boise contractors and throughout Idaho—manage your entire operation from your phone.'
            }
        },
        'Hawaii': {
            mobile: {
                subtitle: 'Honolulu contractors and across Hawaii—handle quotes, scheduling, and billing from your phone.'
            }
        },
        'New Hampshire': {
            mobile: {
                subtitle: 'Manchester contractors and throughout New Hampshire—manage your business on-the-go with our platform.'
            }
        },
        'Maine': {
            mobile: {
                subtitle: 'Portland contractors and across Maine—manage your contracting business from your phone.'
            }
        },
        'Montana': {
            mobile: {
                subtitle: 'Billings contractors and throughout Montana—handle your business operations from your mobile device.'
            }
        },
        'Rhode Island': {
            mobile: {
                subtitle: 'Providence contractors and across Rhode Island—streamline your business with our mobile platform.'
            }
        },
        'Delaware': {
            mobile: {
                subtitle: 'Wilmington contractors and throughout Delaware—manage jobs, quotes, and payments from your phone.'
            }
        },
        'South Dakota': {
            mobile: {
                subtitle: 'Sioux Falls contractors and across South Dakota—handle your contracting business from anywhere.'
            }
        },
        'North Dakota': {
            mobile: {
                subtitle: 'Fargo contractors and throughout North Dakota—manage your business operations from your mobile device.'
            }
        },
        'Alaska': {
            mobile: {
                subtitle: 'Anchorage contractors and across Alaska—streamline your business with mobile-first tools.'
            }
        },
        'Vermont': {
            mobile: {
                subtitle: 'Burlington contractors and throughout Vermont—manage your entire operation from your phone.'
            }
        },
        'Wyoming': {
            mobile: {
                subtitle: 'Cheyenne contractors and across Wyoming—handle quotes, scheduling, and billing from your phone.'
            }
        }
    };

    // Check if user is on mobile device
    function isMobileDevice() {
        if (window.debugDevice) {
            return window.debugDevice === 'mobile';
        }
        return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) || window.innerWidth < 768;
    }

    // Get user's location using IP geolocation API
    function getUserLocation() {
        // Try multiple free APIs for better reliability
        const apis = [
            'https://ipapi.co/json/',
            'https://freegeoip.app/json/',
            'https://ipwhois.app/json/'
        ];

        function tryAPI(apiIndex = 0) {
            if (apiIndex >= apis.length) {
                // All APIs failed, don't change anything - keep original content
                console.log('All geolocation APIs failed, keeping original content');
                return;
            }

            fetch(apis[apiIndex])
                .then(response => response.json())
                .then(data => {
                    let state = data.region || data.region_name || data.state || '';
                    
                    // Handle different API response formats
                    if (state && data.country === 'US') {
                        updateHeroContent(state);
                    }
                })
                .catch(error => {
                    console.log(`API ${apiIndex + 1} failed, trying next...`);
                    tryAPI(apiIndex + 1);
                });
        }

        tryAPI();
    }

    // Update hero content based on location and device (ONLY for mobile)
    function updateHeroContent(state) {
        const heroSubtitle = document.getElementById('dynamic-hero-subtitle');
        
        if (!heroSubtitle) return;

        // Only update content for mobile devices
        if (!isMobileDevice()) {
            console.log('Desktop device detected, keeping original content');
            return;
        }

        const messages = locationMessages[state];
        if (!messages || !messages.mobile) {
            console.log(`No mobile message for state: ${state}, keeping original content`);
            return;
        }

        const content = messages.mobile;

        // Smooth transition effect
        heroSubtitle.style.opacity = '0.5';
        
        setTimeout(() => {
            // Update subtitle - replace the x-split-words component content
            const splitWordsComponent = heroSubtitle.querySelector('x-split-words');
            if (splitWordsComponent) {
                splitWordsComponent.setAttribute('text', content.subtitle);
                // Force re-render of the split words component
                splitWordsComponent.innerHTML = content.subtitle;
            } else {
                heroSubtitle.innerHTML = content.subtitle;
            }
            
            // Fade back in
            heroSubtitle.style.opacity = '1';
            heroSubtitle.style.transition = 'opacity 0.5s ease';
        }, 300);

        // Log for debugging
        console.log(`Updated content for ${state} mobile users`);
    }

    // Initialize the location detection
    getUserLocation();

    // Debug panel for testing (remove in production)
    if (window.location.search.includes('debug=true')) {
        createDebugPanel();
    }

    function createDebugPanel() {
        const debugPanel = document.createElement('div');
        debugPanel.id = 'location-debug-panel';
        debugPanel.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: white;
            border: 1px solid #ccc;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            z-index: 9999;
            font-family: Arial, sans-serif;
            font-size: 14px;
            max-width: 300px;
        `;

        const stateOptions = Object.keys(locationMessages).map(state => 
            `<option value="${state}">${state}</option>`
        ).join('');

        debugPanel.innerHTML = `
            <h3 style="margin: 0 0 10px 0; font-size: 16px;">Location Debug Panel</h3>
            <div style="margin-bottom: 10px;">
                <label style="display: block; margin-bottom: 5px;">Test Location:</label>
                <select id="debug-location" style="width: 100%; padding: 5px;">
                    <option value="">No Location</option>
                    ${stateOptions}
                </select>
            </div>
            <div style="margin-bottom: 10px;">
                <label style="display: block; margin-bottom: 5px;">Test Device:</label>
                <select id="debug-device" style="width: 100%; padding: 5px;">
                    <option value="desktop">Desktop</option>
                    <option value="mobile">Mobile</option>
                </select>
            </div>
            <button id="debug-apply" style="width: 100%; padding: 8px; background: #007cba; color: white; border: none; border-radius: 4px; cursor: pointer;">Apply Test</button>
            <button id="debug-reset" style="width: 100%; padding: 8px; background: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer; margin-top: 5px;">Reset to Original</button>
            <button id="debug-close" style="width: 100%; padding: 8px; background: #666; color: white; border: none; border-radius: 4px; cursor: pointer; margin-top: 5px;">Close</button>
        `;

        document.body.appendChild(debugPanel);

        // Debug panel event listeners
        document.getElementById('debug-apply').addEventListener('click', function() {
            const location = document.getElementById('debug-location').value;
            const device = document.getElementById('debug-device').value;
            
            // Override device detection for testing
            window.debugDevice = device;
            if (location) {
                updateHeroContent(location);
            }
        });

        document.getElementById('debug-reset').addEventListener('click', function() {
            location.reload();
        });

        document.getElementById('debug-close').addEventListener('click', function() {
            debugPanel.remove();
        });
    }
});
</script>
<?php /**PATH F:\DELL\Desktop\Novuk\resources\views/default/landing-page/banner/section.blade.php ENDPATH**/ ?>