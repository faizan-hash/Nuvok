// Start geolocation immediately when script loads (before DOM ready)
let locationDetected = false;
let detectedState = null;

// Immediately start location detection
getUserLocation();

document.addEventListener('DOMContentLoaded', function() {
    // If location was already detected, update content immediately
    if (locationDetected && detectedState) {
        updateHeroContent(detectedState);
    }
});

// Location-specific messaging configuration (ONLY for mobile devices)
const locationMessages = {
    'Florida': {
        mobile: {
            subtitle: 'Run your handyman business from anywhere with just your phone.'
        }
    },
    'Virginia': {
        mobile: {
            subtitle: 'Run your electrical business from anywhere with just your phone.'
        }
    },
    'Texas': {
        mobile: {
            subtitle: 'Run your plumbing business from anywhere with just your phone.'
        }
    },
    'California': {
        mobile: {
            subtitle: 'Run your landscaping business from anywhere with just your phone.'
        }
    },
    'New York': {
        mobile: {
            subtitle: 'Run your cleaning business from anywhere with just your phone.'
        }
    },
    'Illinois': {
        mobile: {
            subtitle: 'Run your HVAC business from anywhere with just your phone.'
        }
    },
    'Pennsylvania': {
        mobile: {
            subtitle: 'Run your contracting business from anywhere with just your phone.'
        }
    },
    'Ohio': {
        mobile: {
            subtitle: 'Run your roofing business from anywhere with just your phone.'
        }
    },
    'Georgia': {
        mobile: {
            subtitle: 'Run your painting business from anywhere with just your phone.'
        }
    },
    'North Carolina': {
        mobile: {
            subtitle: 'Run your flooring business from anywhere with just your phone.'
        }
    },
    'Michigan': {
        mobile: {
            subtitle: 'Run your carpentry business from anywhere with just your phone.'
        }
    },
    'New Jersey': {
        mobile: {
            subtitle: 'Run your electrical business from anywhere with just your phone.'
        }
    },
    'Washington': {
        mobile: {
            subtitle: 'Run your landscaping business from anywhere with just your phone.'
        }
    },
    'Arizona': {
        mobile: {
            subtitle: 'Run your HVAC business from anywhere with just your phone.'
        }
    },
    'Massachusetts': {
        mobile: {
            subtitle: 'Run your plumbing business from anywhere with just your phone.'
        }
    },
    'Tennessee': {
        mobile: {
            subtitle: 'Run your handyman business from anywhere with just your phone.'
        }
    },
    'Indiana': {
        mobile: {
            subtitle: 'Run your cleaning business from anywhere with just your phone.'
        }
    },
    'Missouri': {
        mobile: {
            subtitle: 'Run your contracting business from anywhere with just your phone.'
        }
    },
    'Maryland': {
        mobile: {
            subtitle: 'Run your roofing business from anywhere with just your phone.'
        }
    },
    'Wisconsin': {
        mobile: {
            subtitle: 'Run your painting business from anywhere with just your phone.'
        }
    },
    'Colorado': {
        mobile: {
            subtitle: 'Run your flooring business from anywhere with just your phone.'
        }
    },
    'Minnesota': {
        mobile: {
            subtitle: 'Run your carpentry business from anywhere with just your phone.'
        }
    },
    'South Carolina': {
        mobile: {
            subtitle: 'Run your electrical business from anywhere with just your phone.'
        }
    },
    'Alabama': {
        mobile: {
            subtitle: 'Run your landscaping business from anywhere with just your phone.'
        }
    },
    'Louisiana': {
        mobile: {
            subtitle: 'Run your HVAC business from anywhere with just your phone.'
        }
    },
    'Kentucky': {
        mobile: {
            subtitle: 'Run your plumbing business from anywhere with just your phone.'
        }
    },
    'Oregon': {
        mobile: {
            subtitle: 'Run your handyman business from anywhere with just your phone.'
        }
    },
    'Oklahoma': {
        mobile: {
            subtitle: 'Run your cleaning business from anywhere with just your phone.'
        }
    },
    'Connecticut': {
        mobile: {
            subtitle: 'Run your contracting business from anywhere with just your phone.'
        }
    },
    'Utah': {
        mobile: {
            subtitle: 'Run your roofing business from anywhere with just your phone.'
        }
    },
    'Nevada': {
        mobile: {
            subtitle: 'Run your painting business from anywhere with just your phone.'
        }
    },
    'Arkansas': {
        mobile: {
            subtitle: 'Run your flooring business from anywhere with just your phone.'
        }
    },
    'Mississippi': {
        mobile: {
            subtitle: 'Run your carpentry business from anywhere with just your phone.'
        }
    },
    'Kansas': {
        mobile: {
            subtitle: 'Run your electrical business from anywhere with just your phone.'
        }
    },
    'New Mexico': {
        mobile: {
            subtitle: 'Run your landscaping business from anywhere with just your phone.'
        }
    },
    'Nebraska': {
        mobile: {
            subtitle: 'Run your HVAC business from anywhere with just your phone.'
        }
    },
    'West Virginia': {
        mobile: {
            subtitle: 'Run your plumbing business from anywhere with just your phone.'
        }
    },
    'Idaho': {
        mobile: {
            subtitle: 'Run your handyman business from anywhere with just your phone.'
        }
    },
    'Hawaii': {
        mobile: {
            subtitle: 'Run your cleaning business from anywhere with just your phone.'
        }
    },
    'New Hampshire': {
        mobile: {
            subtitle: 'Run your contracting business from anywhere with just your phone.'
        }
    },
    'Maine': {
        mobile: {
            subtitle: 'Run your roofing business from anywhere with just your phone.'
        }
    },
    'Montana': {
        mobile: {
            subtitle: 'Run your painting business from anywhere with just your phone.'
        }
    },
    'Rhode Island': {
        mobile: {
            subtitle: 'Run your flooring business from anywhere with just your phone.'
        }
    },
    'Delaware': {
        mobile: {
            subtitle: 'Run your carpentry business from anywhere with just your phone.'
        }
    },
    'South Dakota': {
        mobile: {
            subtitle: 'Run your electrical business from anywhere with just your phone.'
        }
    },
    'North Dakota': {
        mobile: {
            subtitle: 'Run your landscaping business from anywhere with just your phone.'
        }
    },
    'Alaska': {
        mobile: {
            subtitle: 'Run your HVAC business from anywhere with just your phone.'
        }
    },
    'Vermont': {
        mobile: {
            subtitle: 'Run your plumbing business from anywhere with just your phone.'
        }
    },
    'Wyoming': {
        mobile: {
            subtitle: 'Run your handyman business from anywhere with just your phone.'
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

// Get user's location using IP geolocation API (optimized for speed)
function getUserLocation() {
    // Use faster API with shorter timeout
    const apis = [
        'https://ipapi.co/json/',
        'https://freegeoip.app/json/'
    ];

    function tryAPI(apiIndex = 0) {
        if (apiIndex >= apis.length) {
            console.log('All geolocation APIs failed, keeping original content');
            return;
        }

        // Add timeout for faster fallback
        const controller = new AbortController();
        const timeoutId = setTimeout(() => controller.abort(), 2000); // 2 second timeout

        fetch(apis[apiIndex], { 
            signal: controller.signal,
            cache: 'force-cache' // Use cache if available
        })
            .then(response => {
                clearTimeout(timeoutId);
                return response.json();
            })
            .then(data => {
                let state = data.region || data.region_name || data.state || '';
                
                if (state && data.country === 'US') {
                    detectedState = state;
                    locationDetected = true;
                    
                    // If DOM is ready, update immediately, otherwise wait for DOM ready
                    if (document.readyState === 'loading') {
                        // DOM not ready yet, will be handled in DOMContentLoaded
                        return;
                    } else {
                        // DOM is ready, update immediately
                        updateHeroContent(state);
                    }
                }
            })
            .catch(error => {
                clearTimeout(timeoutId);
                console.log(`API ${apiIndex + 1} failed, trying next...`);
                tryAPI(apiIndex + 1);
            });
    }

    tryAPI();
}

// Update hero content based on location and device (ONLY for mobile) - optimized
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

    // Much faster transition - reduced from 300ms to 100ms
    heroSubtitle.style.opacity = '0.7';
    heroSubtitle.style.transition = 'opacity 0.1s ease';
    
    setTimeout(() => {
        // Update subtitle - replace the x-split-words component content
        const splitWordsComponent = heroSubtitle.querySelector('x-split-words');
        if (splitWordsComponent) {
            splitWordsComponent.setAttribute('text', content.subtitle);
            splitWordsComponent.innerHTML = content.subtitle;
        } else {
            heroSubtitle.innerHTML = content.subtitle;
        }
        
        // Fade back in quickly
        heroSubtitle.style.opacity = '1';
    }, 100); // Reduced from 300ms to 100ms

    console.log(`Updated content for ${state} mobile users`);
} 