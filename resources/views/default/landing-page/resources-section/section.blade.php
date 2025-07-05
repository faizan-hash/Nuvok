<!-- Updated with brand colors -->
<section class="site-section py-10 relative transition-all duration-700 md:translate-y-8 md:opacity-0 [&.lqd-is-in-view]:translate-y-0 [&.lqd-is-in-view]:opacity-100" id="blog">
    <div class="absolute inset-x-0 top-0 -z-1 h-[150vh]" style="background: linear-gradient(to bottom, transparent, #F9FAFB, transparent)"></div>
    <div class="container mx-auto px-4 relative">
        <div class="rounded-[50px] border bg-contain bg-center bg-no-repeat p-11 max-sm:px-5" style="background-image: url('/assets/img/landing-page/world-map.png')">
            <div class="blog-header text-center mb-8">
                <h2 class="text-3xl font-bold" style="color: #1C2A39">NuvokAI Resources</h2>
                <p class="text-lg mt-2" style="color: #6b7280">Explore guides and tips to master NuvokAI and grow your business with AI-powered tools.</p>
            </div>
            <div class="blog-grid grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Blog Post 1 -->
                <div class="blog-card bg-white rounded-lg shadow-lg p-6 flex flex-col h-full transition-all hover:shadow-xl">
                    <h3 class="text-xl font-semibold mb-2" style="color: #1C2A39">Getting Started with NuvokAI</h3>
                    <p class="mb-4 flex-grow" style="color: #6b7280">Learn how to set up your NuvokAI workspace and streamline your business in minutes.</p>
                    <a href="/blog/getting-started" class="mt-auto inline-block text-sm font-medium px-4 py-2 rounded transition" style="background-color: #6EE7B7; color: #1C2A39; border: 1px solid #6EE7B7; hover:bg-opacity-90">
                        <i class="fas fa-book-open mr-2"></i>Read More
                    </a>
                </div>
                <!-- Blog Post 2 -->
                <div class="blog-card bg-white rounded-lg shadow-lg p-6 flex flex-col h-full transition-all hover:shadow-xl">
                    <h3 class="text-xl font-semibold mb-2" style="color: #1C2A39">Top AI Templates for Entrepreneurs</h3>
                    <p class="mb-4 flex-grow" style="color: #6b7280">Discover the best AI templates to boost productivity and grow your business.</p>
                    <a href="/blog/ai-templates" class="mt-auto inline-block text-sm font-medium px-4 py-2 rounded transition" style="background-color: #6EE7B7; color: #1C2A39; border: 1px solid #6EE7B7; hover:bg-opacity-90">
                        <i class="fas fa-book-open mr-2"></i>Read More
                    </a>
                </div>
                <!-- Blog Post 3 -->
                <div class="blog-card bg-white rounded-lg shadow-lg p-6 flex flex-col h-full transition-all hover:shadow-xl">
                    <h3 class="text-xl font-semibold mb-2" style="color: #1C2A39">How to Automate Client Invoicing</h3>
                    <p class="mb-4 flex-grow" style="color: #6b7280">Simplify billing with NuvokAI's automated invoicing and payment tracking features.</p>
                    <a href="/blog/automated-invoicing" class="mt-auto inline-block text-sm font-medium px-4 py-2 rounded transition" style="background-color: #6EE7B7; color: #1C2A39; border: 1px solid #6EE7B7; hover:bg-opacity-90">
                        <i class="fas fa-book-open mr-2"></i>Read More
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .blog-header h2 {
        font-size: 36px;
        font-weight: 700;
        color: #1C2A39; /* Primary text color */
        margin: 0;
    }
    .blog-header p {
        font-size: 18px;
        color: #6b7280; /* Secondary text */
        margin-top: 8px;
    }

    .blog-card {
        transition: transform 0.3s, box-shadow 0.3s;
        background-color: #F9FAFB; /* Light gray background */
        border: 1px solid #e5e7eb;
    }
    .blog-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }
    .blog-card h3 {
        font-size: 20px;
        font-weight: 600;
        color: #1C2A39; /* Primary text color */
    }
    .blog-card p {
        font-size: 16px;
        color: #6b7280; /* Secondary text */
    }

    /* Badges (using muted copper) */
    .blog-badge {
        background-color: #B06F49;
        color: white;
        padding: 2px 8px;
        border-radius: 12px;
        font-size: 12px;
        display: inline-block;
        margin-bottom: 8px;
    }

    @media (max-width: 767px) {
        .blog-header h2 {
            font-size: 28px;
        }
        .blog-header p {
            font-size: 16px;
        }
    }
</style>



<!-- Ensure this is in the <head> of your HTML -->
<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />-->

<!--<section class="site-section py-10 relative transition-all duration-700 md:translate-y-8 md:opacity-0 [&.lqd-is-in-view]:translate-y-0 [&.lqd-is-in-view]:opacity-100" id="blog">-->
<!--    <div class="absolute inset-x-0 top-0 -z-1 h-[150vh]" style="background: linear-gradient(to bottom, transparent, #F0EFFA, transparent)"></div>-->
<!--    <div class="container mx-auto px-4 relative">-->
<!--        <div class="rounded-[50px] border bg-contain bg-center bg-no-repeat p-11 max-sm:px-5" style="background-image: url('/assets/img/landing-page/world-map.png')">-->
<!--            <div class="blog-header text-center mb-8">-->
<!--                <h2 class="text-3xl font-bold">NuvokAI Resources</h2>-->
<!--                <p class="text-lg text-gray-600 mt-2">Explore guides and tips to master NuvokAI and grow your business with AI-powered tools.</p>-->
<!--            </div>-->
<!--            <div class="blog-grid grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">-->
                <!-- Blog Post 1 -->
<!--                <div class="blog-card bg-gray-100 rounded-lg shadow-lg p-6 flex flex-col h-full">-->
                    <!--<img src="/assets/images/blog/nuvokai-workspace-setup.jpg" alt="Getting Started with NuvokAI Guide" class="w-full h-32 object-cover rounded-md mb-4">-->
<!--                    <h3 class="text-xl font-semibold mb-2">Getting Started with NuvokAI</h3>-->
<!--                    <p class="text-gray-600 mb-4 flex-grow">Learn how to set up your NuvokAI workspace and streamline your business in minutes.</p>-->
<!--                    <a href="/blog/getting-started" class="mt-auto inline-block bg-purple-600 text-white text-sm font-medium px-4 py-2 rounded hover:bg-purple-700 transition">-->
<!--                        <i class="fas fa-book-open mr-2"></i>Read More-->
<!--                    </a>-->
<!--                </div>-->
                <!-- Blog Post 2 -->
<!--                <div class="blog-card bg-gray-100 rounded-lg shadow-lg p-6 flex flex-col h-full">-->
                    <!--<img src="/assets/images/blog/ai-template-guide.jpg" alt="Top AI Templates for Entrepreneurs" class="w-full h-32 object-cover rounded-md mb-4">-->
<!--                    <h3 class="text-xl font-semibold mb-2">Top AI Templates for Entrepreneurs</h3>-->
<!--                    <p class="text-gray-600 mb-4 flex-grow">Discover the best AI templates to boost productivity and grow your business.</p>-->
<!--                    <a href="/blog/ai-templates" class="mt-auto inline-block bg-purple-600 text-white text-sm font-medium px-4 py-2 rounded hover:bg-purple-700 transition">-->
<!--                        <i class="fas fa-book-open mr-2"></i>Read More-->
<!--                    </a>-->
<!--                </div>-->
                <!-- Blog Post 3 -->
<!--                <div class="blog-card bg-gray-100 rounded-lg shadow-lg p-6 flex flex-col h-full">-->
                    <!--<img src="/assets/images/blog/automated-invoicing-guide.jpg" alt="How to Automate Client Invoicing" class="w-full h-32 object-cover rounded-md mb-4">-->
<!--                    <h3 class="text-xl font-semibold mb-2">How to Automate Client Invoicing</h3>-->
<!--                    <p class="text-gray-600 mb-4 flex-grow">Simplify billing with NuvokAI’s automated invoicing and payment tracking features.</p>-->
<!--                    <a href="/blog/automated-invoicing" class="mt-auto inline-block bg-purple-600 text-white text-sm font-medium px-4 py-2 rounded hover:bg-purple-700 transition">-->
<!--                        <i class="fas fa-book-open mr-2"></i>Read More-->
<!--                    </a>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</section>-->

<!-- Blog Post Content (Example for Static Pages) -->
<!-- /blog/getting-started -->
<!--<div class="blog-post-template hidden" id="blog-getting-started">-->
<!--    <article>-->
<!--        <script type="application/ld+json">-->
<!--        {-->
<!--            "@context": "https://schema.org",-->
<!--            "@type": "Article",-->
<!--            "headline": "Getting Started with NuvokAI: Your First Steps to Business Automation",-->
<!--            "description": "Learn how to set up your NuvokAI workspace and streamline your business operations with AI-powered tools. Perfect for beginners in AI for business.",-->
<!--            "datePublished": "2025-05-23",-->
<!--            "author": { "@type": "Organization", "name": "NuvokAI" },-->
<!--            "image": "/assets/images/blog/nuvokai-workspace-setup.jpg"-->
<!--        }-->
<!--        </script>-->
<!--        <meta name="description" content="Learn how to set up your NuvokAI workspace and streamline your business operations with AI-powered tools. Perfect for beginners in AI for business.">-->
<!--        <h1>Getting Started with NuvokAI: Your First Steps to Business Automation</h1>-->
<!--        <p><strong>Published: May 23, 2025</strong></p>-->
<!--        <img src="/assets/images/blog/nuvokai-workspace-setup.jpg" alt="NuvokAI Workspace Setup Guide" class="w-full h-64 object-cover rounded-md mb-4">-->
<!--        <h2>Why Choose NuvokAI?</h2>-->
<!--        <p>NuvokAI is an all-in-one platform designed to simplify your business tasks. From managing clients to automating invoicing, it’s built for entrepreneurs who want efficiency. This guide walks you through setting up your workspace to kickstart your journey with AI for business.</p>-->
<!--        <h2>Step 1: Create Your Workspace</h2>-->
<!--        <p>After signing up, you’ll land on the NuvokAI dashboard. Click "Setup Workspace" to customize your environment. Add your business name, logo, and preferences to personalize your space. This takes less than 5 minutes and sets the foundation for managing clients and projects.</p>-->
<!--        <h2>Step 2: Add Your First Client</h2>-->
<!--        <p>Navigate to the CRM section and select "Add Client." Enter details like name, email, and project notes. NuvokAI’s CRM keeps everything organized, so you can track interactions and build strong relationships.</p>-->
<!--        <h2>Step 3: Explore Key Features</h2>-->
<!--        <p>Try generating a proposal or invoice from the dashboard. Use templates to save time, and explore the Client Portal to share updates with clients. NuvokAI’s AI tools, like the Quote Generator, help you create professional documents instantly.</p>-->
<!--        <h2>Pro Tip</h2>-->
<!--        <p>Integrate NuvokAI with Zapier (available on Premium+ plans) to automate repetitive tasks. This saves time and lets you focus on growing your business.</p>-->
<!--        <p>Ready to get started? <a href="/signup">Sign up for NuvokAI</a> and streamline your workflow today!</p>-->
<!--    </article>-->
<!--</div>-->

<!-- /blog/ai-templates -->
<!--<div class="blog-post-template hidden" id="blog-ai-templates">-->
<!--    <article>-->
<!--        <script type="application/ld+json">-->
<!--        {-->
<!--            "@context": "https://schema.org",-->
<!--            "@type": "Article",-->
<!--            "headline": "Top AI Templates for Entrepreneurs: Boost Your Productivity",-->
<!--            "description": "Discover the best AI templates in NuvokAI for entrepreneurs. From proposals to client emails, these templates save time and enhance efficiency.",-->
<!--            "datePublished": "2025-05-23",-->
<!--            "author": { "@type": "Organization", "name": "NuvokAI" },-->
<!--            "image": "/assets/images/blog/ai-template-guide.jpg"-->
<!--        }-->
<!--        </script>-->
<!--        <meta name="description" content="Discover the best AI templates in NuvokAI for entrepreneurs. From proposals to client emails, these templates save time and enhance efficiency.">-->
<!--        <h1>Top AI Templates for Entrepreneurs: Boost Your Productivity</h1>-->
<!--        <p><strong>Published: May 23, 2025</strong></p>-->
<!--        <img src="/assets/images/blog/ai-template-guide.jpg" alt="AI Templates for Entrepreneurs" class="w-full h-64 object-cover rounded-md mb-4">-->
<!--        <h2>Why AI Templates Matter</h2>-->
<!--        <p>Entrepreneurs juggle multiple tasks daily. NuvokAI’s AI templates simplify creating professional documents, letting you focus on your core business. Here are the top templates to try.</p>-->
<!--        <h2>1. Proposal Templates</h2>-->
<!--        <p>Create stunning proposals in minutes. Choose from customizable templates in the Proposal Builder, tailored for industries like consulting, design, or tech. Add your branding and impress clients.</p>-->
<!--        <h2>2. Email Templates</h2>-->
<!--        <p>Engage clients with pre-built email templates for follow-ups, onboarding, or thank-yous. Available in the CRM (Pro and Enterprise plans), these save time and maintain professionalism.</p>-->
<!--        <h2>3. Invoice Templates</h2>-->
<!--        <p>Generate professional invoices with NuvokAI’s invoicing tool. Customize layouts, add payment links, and automate reminders to get paid faster.</p>-->
<!--        <h2>Pro Tip</h2>-->
<!--        <p>Use the Enterprise plan’s eSignature feature to close deals directly from proposals. It’s a game-changer for fast-moving entrepreneurs.</p>-->
<!--        <p>Explore NuvokAI’s templates today and take your productivity to the next level!</p>-->
<!--    </article>-->
<!--</div>-->

<!-- /blog/automated-invoicing -->
<!--<div class="blog-post-template hidden" id="blog-automated-invoicing">-->
<!--    <article>-->
<!--        <script type="application/ld+json">-->
<!--        {-->
<!--            "@context": "https://schema.org",-->
<!--            "@type": "Article",-->
<!--            "headline": "How to Automate Client Invoicing with NuvokAI",-->
<!--            "description": "Learn how NuvokAI’s automated invoicing features simplify billing, track payments, and save time for your business.",-->
<!--            "datePublished": "2025-05-23",-->
<!--            "author": { "@type": "Organization", "name": "NuvokAI" },-->
<!--            "image": "/assets/images/blog/automated-invoicing-guide.jpg"-->
<!--        }-->
<!--        </script>-->
<!--        <meta name="description" content="Learn how NuvokAI’s automated invoicing features simplify billing, track payments, and save time for your business.">-->
<!--        <h1>How to Automate Client Invoicing with NuvokAI</h1>-->
<!--        <p><strong>Published: May 23, 2025</strong></p>-->
<!--        <img src="/assets/images/blog/automated-invoicing-guide.jpg" alt="Automated Invoicing with NuvokAI" class="w-full h-64 object-cover rounded-md mb-4">-->
<!--        <h2>The Power of Automated Invoicing</h2>-->
<!--        <p>Manual invoicing is time-consuming and error-prone. NuvokAI’s invoicing tools automate the process, ensuring you get paid faster. Here’s how to use them.</p>-->
<!--        <h2>Step 1: Create an Invoice</h2>-->
<!--        <p>From the dashboard, select "Send Invoice." Choose a template, add client details, and customize with your branding. NuvokAI auto-calculates totals and taxes.</p>-->
<!--        <h2>Step 2: Automate Delivery</h2>-->
<!--        <p>Send invoices directly via email or share them through the Client Portal (Pro and Enterprise plans). Set up recurring invoices for regular clients to save time.</p>-->
<!--        <h2>Step 3: Track Payments</h2>-->
<!--        <p>Monitor payment statuses in real-time with the Track Payment feature. Get notified when clients view or pay invoices, keeping you in control.</p>-->
<!--        <h2>Pro Tip</h2>-->
<!--        <p>Integrate with Zapier (Premium+ plans) to connect invoicing with your accounting software, streamlining your financial workflow.</p>-->
<!--        <p>Start automating your invoicing with <a href="/signup">NuvokAI</a> and focus on what matters most.</p>-->
<!--    </article>-->
<!--</div>-->

<!--<style>-->
<!--    .blog-header h2 {-->
<!--        font-size: 36px;-->
<!--        font-weight: 700;-->
<!--        color: #1f2937;-->
<!--        margin: 0;-->
<!--    }-->
<!--    .blog-header p {-->
<!--        font-size: 18px;-->
<!--        color: #6b7280;-->
<!--        margin-top: 8px;-->
<!--    }-->

<!--    .blog-card {-->
<!--        transition: transform 0.3s;-->
<!--    }-->
<!--    .blog-card:hover {-->
<!--        transform: translateY(-4px);-->
<!--    }-->
<!--    .blog-card a {-->
<!--    color: #66707F;-->
<!--    }-->
<!--    .blog-card a:hover {-->
    <!--background-color: #66707f0f; /* Slightly darker shade for hover */-->
<!--    }-->
<!--    .blog-card h3 {-->
<!--        font-size: 20px;-->
<!--        font-weight: 600;-->
<!--        color: #1f2937;-->
<!--    }-->
<!--    .blog-card p {-->
<!--        font-size: 16px;-->
<!--        color: #6b7280;-->
<!--    }-->

<!--    .blog-post-template {-->
        <!--display: none; /* Hidden by default, to be rendered on separate pages */-->
<!--    }-->
<!--    .blog-post-template article {-->
<!--        max-width: 800px;-->
<!--        margin: 0 auto;-->
<!--        padding: 20px;-->
<!--    }-->
<!--    .blog-post-template h1 {-->
<!--        font-size: 28px;-->
<!--        font-weight: 700;-->
<!--        color: #1f2937;-->
<!--        margin-bottom: 16px;-->
<!--    }-->
<!--    .blog-post-template h2 {-->
<!--        font-size: 22px;-->
<!--        font-weight: 600;-->
<!--        color: #1f2937;-->
<!--        margin-top: 24px;-->
<!--        margin-bottom: 8px;-->
<!--    }-->
<!--    .blog-post-template p {-->
<!--        font-size: 16px;-->
<!--        color: #4b5563;-->
<!--        margin-bottom: 16px;-->
<!--    }-->
<!--    .blog-post-template a {-->
<!--        color: #7c3aed;-->
<!--        text-decoration: underline;-->
<!--    }-->
<!--    .blog-post-template a:hover {-->
<!--        color: #6d28d9;-->
<!--    }-->
<!--    .blog-post-template img {-->
<!--        max-width: 100%;-->
<!--    }-->

<!--    @media (max-width: 767px) {-->
<!--        .blog-header h2 {-->
<!--            font-size: 28px;-->
<!--        }-->
<!--        .blog-header p {-->
<!--            font-size: 16px;-->
<!--        }-->
<!--        .blog-card img {-->
<!--            height: 120px;-->
<!--        }-->
<!--        .blog-post-template img {-->
<!--            height: 200px;-->
<!--        }-->
<!--    }-->
<!--</style>-->

<!--<script>-->
<!--    document.addEventListener('DOMContentLoaded', function () {-->
<!--        const blogSection = document.getElementById('blog');-->
<!--        if (blogSection) {-->
<!--            const observer = new IntersectionObserver((entries) => {-->
<!--                entries.forEach(entry => {-->
<!--                    if (entry.isIntersecting) {-->
<!--                        console.log('Blog section is in viewport.');-->
<!--                        blogSection.classList.add('lqd-is-in-view');-->
<!--                    }-->
<!--                });-->
<!--            }, { threshold: 0.1 });-->
<!--            observer.observe(blogSection);-->
<!--        }-->
<!--    });-->
<!--</script>-->