<!-- Ensure this is in the <head> of your HTML -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<section class="site-section py-10 relative transition-all duration-700 md:translate Y-8 md:opacity-0 [&.lqd-is-in-view]:translate-y-0 [&.lqd-is-in-view]:opacity-100" id="trust-security">
    <div class="absolute inset-x-0 top-0 -z-1 h-[150vh]" style="background: linear-gradient(to bottom, transparent, #F9FAFB, transparent)"></div>
    <div class="container mx-auto px-4 relative">
        <div class="rounded-[50px] border bg-contain bg-center bg-no-repeat p-11 max-sm:px-5" style="background-image: url('/assets/img/landing-page/world-map.png'); background-color: #F9FAFB;">
            <div class="trust-header text-center mb-8">
                <h2 class="text-3xl font-bold">Trust & Security at NuvokAI</h2>
                <p class="text-lg mt-2" style="color: #1C2A39;">Your data is safe with our industry-leading security and compliance standards.</p>
            </div>
            <div class="trust-grid grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Data Encryption -->
                <div class="trust-card rounded-lg shadow-lg p-6 flex flex-col h-full text-center" style="background-color: #F9FAFB;">
                    <i class="fas fa-lock text-4xl mb-4" style="color: #6EE7B7;"></i>
                    <h3 class="text-xl font-semibold mb-2" style="color: #1C2A39;">Data Encryption</h3>
                    <p class="mb-4 flex-grow" style="color: #1C2A39;">We use AES-256 encryption and SSL/TLS protocols to protect your data in transit and at rest, ensuring maximum security.</p>
                    <a href="/security" class="mt-auto inline-block text-sm font-medium px-4 py-2 rounded transition" style="background-color: #6EE7B7; color: #1C2A39;">
                        <i class="fas fa-shield-alt mr-2" style="color: #1C2A39;"></i>Learn More
                    </a>
                </div>
                <!-- GDPR Compliance -->
                <div class="trust-card rounded-lg shadow-lg p-6 flex flex-col h-full text-center" style="background-color: #F9FAFB;">
                    <i class="fas fa-check-circle text-4xl mb-4" style="color: #6EE7B7;"></i>
                    <h3 class="text-xl font-semibold mb-2" style="color: #1C2A39;">GDPR Compliance</h3>
                    <p class="mb-4 flex-grow" style="color: #1C2A39;">NuvokAI adheres to GDPR regulations, giving you control over your data and ensuring privacy compliance across all operations.</p>
                    <a href="/privacy" class="mt-auto inline-block text-sm font-medium px-4 py-2 rounded transition" style="background-color: #6EE7B7; color: #1C2A39;">
                        <i class="fas fa-shield-alt mr-2" style="color: #1C2A39;"></i>Learn More
                    </a>
                </div>
                <!-- Hosting & Backups -->
                <div class="trust-card rounded-lg shadow-lg p-6 flex flex-col h-full text-center" style="background-color: #F9FAFB;">
                    <i class="fas fa-cloud text-4xl mb-4" style="color: #6EE7B7;"></i>
                    <h3 class="text-xl font-semibold mb-2" style="color: #1C2A39;">Hosting & Backups</h3>
                    <p class="mb-4 flex-grow" style="color: #1C2A39;">Our secure cloud hosting and daily automated backups keep your data safe and accessible, with 99.9% uptime guaranteed.</p>
                    <a href="/infrastructure" class="mt-auto inline-block text-sm font-medium px-4 py-2 rounded transition" style="background-color: #6EE7B7; color: #1C2A39;">
                        <i class="fas fa-shield-alt mr-2" style="color: #1C2A39;"></i>Learn More
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Schema Markup for Trust & Security -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "NuvokAI",
        "url": "https://nuvokai.com",
        "description": "NuvokAI provides secure AI-powered business tools with industry-leading data encryption, GDPR compliance, and reliable cloud hosting.",
        "security": {
            "@type": "Service",
            "name": "Data Security",
            "description": "NuvokAI uses AES-256 encryption, GDPR compliance, and secure cloud hosting to protect user data."
        }
    }
    </script>
</section>

<style>
    .trust-header h2 {
        font-size: 36px;
        font-weight: 700;
        color: #1C2A39; /* Deep Navy */
        margin: 0;
    }
    .trust-header p {
        font-size: 18px;
        color: #1C2A39; /* Deep Navy */
        margin-top: 8px;
    }

    .trust-card {
        transition: transform 0.3s;
        border: 1px solid #6EE7B7; /* Mint Green for subtle border */
    }
    .trust-card:hover {
        transform: translateY(-4px);
        background-color: #6EE7B7; /* Mint Green on hover */
    }
    .trust-card h3 {
        font-size: 20px;
        font-weight: 600;
        color: #1C2A39; /* Deep Navy */
    }
    .trust-card a {
        color: #1C2A39; /* Deep Navy */
        background-color: #6EE7B7; /* Mint Green */
    }
    .trust-card a:hover {
        background-color: #B06F49; /* Muted Copper for hover */
        color: #F9FAFB; /* Light Gray for text */
    }
    .trust-card p {
        font-size: 16px;
        color: #1C2A39; /* Deep Navy */
    }

    @media (max-width: 767px) {
        .trust-header h2 {
            font-size: 28px;
            color: #1C2A39; /* Deep Navy */
        }
        .trust-header p {
            font-size: 16px;
            color: #1C2A39; /* Deep Navy */
        }
        .trust-card img {
            height: 120px;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const trustSection = document.getElementById('trust-security');
        if (trustSection) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        console.log('Trust & Security section is in viewport.');
                        trustSection.classList.add('lqd-is-in-view');
                    }
                });
            }, { threshold: 0.1 });
            observer.observe(trustSection);
        }
    });
</script>



<!-- Ensure this is in the <head> of your HTML -->
<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />-->

<!--<section class="site-section py-10 relative transition-all duration-700 md:translate-y-8 md:opacity-0 [&.lqd-is-in-view]:translate-y-0 [&.lqd-is-in-view]:opacity-100" id="trust-security">-->
<!--    <div class="absolute inset-x-0 top-0 -z-1 h-[150vh]" style="background: linear-gradient(to bottom, transparent, #F0EFFA, transparent)"></div>-->
<!--    <div class="container mx-auto px-4 relative">-->
<!--        <div class="rounded-[50px] border bg-contain bg-center bg-no-repeat p-11 max-sm:px-5" style="background-image: url('/assets/img/landing-page/world-map.png')">-->
<!--            <div class="trust-header text-center mb-8">-->
<!--                <h2 class="text-3xl font-bold">Trust & Security at NuvokAI</h2>-->
<!--                <p class="text-lg text-gray-600 mt-2">Your data is safe with our industry-leading security and compliance standards.</p>-->
<!--            </div>-->
<!--            <div class="trust-grid grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">-->
                <!-- Data Encryption -->
<!--                <div class="trust-card bg-gray-100 rounded-lg shadow-lg p-6 flex flex-col h-full text-center">-->
<!--                    <i class="fas fa-lock text-4xl text-purple-600 mb-4"></i>-->
<!--                    <h3 class="text-xl font-semibold mb-2">Data Encryption</h3>-->
<!--                    <p class="text-gray-600 mb-4 flex-grow">We use AES-256 encryption and SSL/TLS protocols to protect your data in transit and at rest, ensuring maximum security.</p>-->
<!--                    <a href="/security" class="mt-auto inline-block bg-[#66707F] text-white text-sm font-medium px-4 py-2 rounded hover:bg-[#5a6372] transition">-->
<!--                        <i class="fas fa-shield-alt mr-2"></i>Learn More-->
<!--                    </a>-->
<!--                </div>-->
                <!-- GDPR Compliance -->
<!--                <div class="trust-card bg-gray-100 rounded-lg shadow-lg p-6 flex flex-col h-full text-center">-->
<!--                    <i class="fas fa-check-circle text-4xl text-purple-600 mb-4"></i>-->
<!--                    <h3 class="text-xl font-semibold mb-2">GDPR Compliance</h3>-->
<!--                    <p class="text-gray-600 mb-4 flex-grow">NuvokAI adheres to GDPR regulations, giving you control over your data and ensuring privacy compliance across all operations.</p>-->
<!--                    <a href="/privacy" class="mt-auto inline-block bg-[#66707F] text-white text-sm font-medium px-4 py-2 rounded hover:bg-[#5a6372] transition">-->
<!--                        <i class="fas fa-shield-alt mr-2"></i>Learn More-->
<!--                    </a>-->
<!--                </div>-->
                <!-- Hosting & Backups -->
<!--                <div class="trust-card bg-gray-100 rounded-lg shadow-lg p-6 flex flex-col h-full text-center">-->
<!--                    <i class="fas fa-cloud text-4xl text-purple-600 mb-4"></i>-->
<!--                    <h3 class="text-xl font-semibold mb-2">Hosting & Backups</h3>-->
<!--                    <p class="text-gray-600 mb-4 flex-grow">Our secure cloud hosting and daily automated backups keep your data safe and accessible, with 99.9% uptime guaranteed.</p>-->
<!--                    <a href="/infrastructure" class="mt-auto inline-block bg-[#66707F] text-white text-sm font-medium px-4 py-2 rounded hover:bg-[#5a6372] transition">-->
<!--                        <i class="fas fa-shield-alt mr-2"></i>Learn More-->
<!--                    </a>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
    <!-- Schema Markup for Trust & Security -->
<!--    <script type="application/ld+json">-->
<!--    {-->
<!--        "@context": "https://schema.org",-->
<!--        "@type": "Organization",-->
<!--        "name": "NuvokAI",-->
<!--        "url": "https://nuvokai.com",-->
<!--        "description": "NuvokAI provides secure AI-powered business tools with industry-leading data encryption, GDPR compliance, and reliable cloud hosting.",-->
<!--        "security": {-->
<!--            "@type": "Service",-->
<!--            "name": "Data Security",-->
<!--            "description": "NuvokAI uses AES-256 encryption, GDPR compliance, and secure cloud hosting to protect user data."-->
<!--        }-->
<!--    }-->
<!--    </script>-->
<!--</section>-->

<!--<style>-->
<!--    .trust-header h2 {-->
<!--        font-size: 36px;-->
<!--        font-weight: 700;-->
<!--        color: #1f2937;-->
<!--        margin: 0;-->
<!--    }-->
<!--    .trust-header p {-->
<!--        font-size: 18px;-->
<!--        color: #6b7280;-->
<!--        margin-top: 8px;-->
<!--    }-->

<!--    .trust-card {-->
<!--        transition: transform 0.3s;-->
<!--    }-->
<!--    .trust-card:hover {-->
<!--        transform: translateY(-4px);-->
<!--    }-->
<!--    .trust-card h3 {-->
<!--        font-size: 20px;-->
<!--        font-weight: 600;-->
<!--        color: #1f2937;-->
<!--    }-->
<!--    .trust-card a {-->
       
<!--        color: #66707F;-->
<!--    }-->
<!--    .trust-card a:hover {-->
       
<!--        background-color: #66707f0f;-->
<!--    }-->
<!--    .trust-card p {-->
<!--        font-size: 16px;-->
<!--        color: #6b7280;-->
<!--    }-->

<!--    @media (max-width: 767px) {-->
<!--        .trust-header h2 {-->
<!--            font-size: 28px;-->
<!--        }-->
<!--        .trust-header p {-->
<!--            font-size: 16px;-->
<!--        }-->
<!--        .trust-card img {-->
<!--            height: 120px;-->
<!--        }-->
<!--    }-->
<!--</style>-->

<!--<script>-->
<!--    document.addEventListener('DOMContentLoaded', function () {-->
<!--        const trustSection = document.getElementById('trust-security');-->
<!--        if (trustSection) {-->
<!--            const observer = new IntersectionObserver((entries) => {-->
<!--                entries.forEach(entry => {-->
<!--                    if (entry.isIntersecting) {-->
<!--                        console.log('Trust & Security section is in viewport.');-->
<!--                        trustSection.classList.add('lqd-is-in-view');-->
<!--                    }-->
<!--                });-->
<!--            }, { threshold: 0.1 });-->
<!--            observer.observe(trustSection);-->
<!--        }-->
<!--    });-->
<!--</script>--><?php /**PATH /home/u832531023/domains/nuvokai.com/public_html/resources/views/default/landing-page/security-section/section.blade.php ENDPATH**/ ?>