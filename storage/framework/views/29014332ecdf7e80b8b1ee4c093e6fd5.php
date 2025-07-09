<!-- Ensure this is in the <head> of your HTML -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<section class="site-section py-10 relative transition-all duration-700 md:translate-y-8 md:opacity-0 [&.lqd-is-in-view]:translate-y-0 [&.lqd-is-in-view]:opacity-100">
    <div class="absolute inset-x-0 top-0 -z-1 h-[150vh]" style="background: linear-gradient(to bottom, transparent, #F9FAFB, transparent)"></div>
    <div class="container mx-auto px-4 relative">
        <div class="rounded-[50px] border bg-contain bg-center bg-no-repeat p-11 max-sm:px-5" style="background-image: url('/assets/img/landing-page/world-map.png'); background-color: #F9FAFB;">
            <h2 class="text-3xl font-bold text-center mb-8" style="color: #1C2A39;">More Than Content Full Business Control</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- CRM Card -->
                <div class="rounded-lg shadow-lg p-6 text-center flex flex-col h-full" style="background-color: #F9FAFB;">
                    <div class="flex-grow">
                        <i class="fas fa-users text-4xl mb-4" style="color: #6EE7B7;"></i>
                        <h3 class="text-xl font-semibold mb-2" style="color: #1C2A39;">CRM (Lite / Full)</h3>
                        <p class="mb-4" style="color: #1C2A39;">Manage client relationships with ease. Lite for basic contact tracking, Full for advanced lead nurturing and automation.</p>
                        <img src="<?php echo e(asset('businesstoolsImages/crm.jpg')); ?>" alt="CRM Screenshot" class="w-full h-32 object-cover rounded-md mb-4">
                    </div>
                    <div class="mt-auto pt-4">
                        <div class="flex justify-center gap-2">
                            <span class="inline-block text-sm font-medium px-3 py-1 rounded" style="background-color: #6EE7B7; color: #1C2A39;">Pro</span>
                            <span class="inline-block text-sm font-medium px-3 py-1 rounded" style="background-color: #B06F49; color: #F9FAFB;">Enterprise</span>
                        </div>
                    </div>
                </div>

                <!-- Invoicing -->
                <div class="rounded-lg shadow-lg p-6 text-center flex flex-col h-full" style="background-color: #F9FAFB;">
                    <div class="flex-grow">
                        <i class="fas fa-file-invoice-dollar text-4xl mb-4" style="color: #6EE7B7;"></i>
                        <h3 class="text-xl font-semibold mb-2" style="color: #1C2A39;">Invoicing</h3>
                        <p class="mb-4" style="color: #1C2A39;">Send branded invoices for plumbing, landscaping, HVAC, and more — all from your phone.</p>
                        <img src="<?php echo e(asset('businesstoolsImages/contractor-phone.jpg')); ?>" alt="Contractor using phone for invoicing" class="w-full h-32 object-cover rounded-md mb-4">
                    </div>
                    <div class="mt-auto pt-4">
                        <div class="flex justify-center gap-2">
                            <span class="inline-block text-sm font-medium px-3 py-1 rounded" style="background-color: #6EE7B7; color: #1C2A39;">Pro</span>
                            <span class="inline-block text-sm font-medium px-3 py-1 rounded" style="background-color: #B06F49; color: #F9FAFB;">Enterprise</span>
                        </div>
                    </div>
                </div>

                <!-- Bookkeeping & Finance Tracker -->
                <div class="rounded-lg shadow-lg p-6 text-center flex flex-col h-full" style="background-color: #F9FAFB;">
                    <div class="flex-grow">
                        <i class="fas fa-calculator text-4xl mb-4" style="color: #6EE7B7;"></i>
                        <h3 class="text-xl font-semibold mb-2" style="color: #1C2A39;">Bookkeeping & Finance Tracker</h3>
                        <p class="mb-4" style="color: #1C2A39;">Track expenses, revenue, and financial reports in one centralized dashboard.</p>
                        <img src="<?php echo e(asset('businesstoolsImages/finance.jpg')); ?>" alt="Bookkeeping Screenshot" class="w-full h-32 object-cover rounded-md mb-4">
                    </div>
                    <div class="mt-auto pt-4">
                        <div class="flex justify-center">
                            <span class="inline-block text-sm font-medium px-3 py-1 rounded" style="background-color: #B06F49; color: #F9FAFB;">Enterprise</span>
                        </div>
                    </div>
                </div>

                <!-- Proposal + eSignature Builder -->
                <div class="rounded-lg shadow-lg p-6 text-center flex flex-col h-full" style="background-color: #F9FAFB;">
                    <div class="flex-grow">
                        <i class="fas fa-file-signature text-4xl mb-4" style="color: #6EE7B7;"></i>
                        <h3 class="text-xl font-semibold mb-2" style="color: #1C2A39;">Proposal + eSignature Builder</h3>
                        <p class="mb-4" style="color: #1C2A39;">Craft proposals and collect secure eSignatures to close deals faster.</p>
                        <img src="<?php echo e(asset('businesstoolsImages/proposal.jpg')); ?>" alt="Proposal Screenshot" class="w-full h-32 object-cover rounded-md mb-4">
                    </div>
                    <div class="mt-auto pt-4">
                        <div class="flex justify-center gap-2">
                            <span class="inline-block text-sm font-medium px-3 py-1 rounded" style="background-color: #6EE7B7; color: #1C2A39;">Pro</span>
                            <span class="inline-block text-sm font-medium px-3 py-1 rounded" style="background-color: #B06F49; color: #F9FAFB;">Enterprise</span>
                        </div>
                    </div>
                </div>

                <!-- Client Portal -->
                <div class="rounded-lg shadow-lg p-6 text-center flex flex-col h-full" style="background-color: #F9FAFB;">
                    <div class="flex-grow">
                        <i class="fas fa-door-open text-4xl mb-4" style="color: #6EE7B7;"></i>
                        <h3 class="text-xl font-semibold mb-2" style="color: #1C2A39;">Client Portal</h3>
                        <p class="mb-4" style="color: #1C2A39;">Share project statuses and enable clients to upload files securely.</p>
                        <img src="<?php echo e(asset('businesstoolsImages/clientportal.jpg')); ?>" alt="Client Portal Screenshot" class="w-full h-32 object-cover rounded-md mb-4">
                    </div>
                    <div class="mt-auto pt-4">
                        <div class="flex justify-center gap-2">
                            <span class="inline-block text-sm font-medium px-3 py-1 rounded" style="background-color: #6EE7B7; color: #1C2A39;">Pro</span>
                            <span class="inline-block text-sm font-medium px-3 py-1 rounded" style="background-color: #B06F49; color: #F9FAFB;">Enterprise</span>
                        </div>
                    </div>
                </div>

                <!-- Project Management (Kanban) -->
                <div class="rounded-lg shadow-lg p-6 text-center flex flex-col h-full" style="background-color: #F9FAFB;">
                    <div class="flex-grow">
                        <i class="fas fa-tasks text-4xl mb-4" style="color: #6EE7B7;"></i>
                        <h3 class="text-xl font-semibold mb-2" style="color: #1C2A39;">Project Management (Kanban)</h3>
                        <p class="mb-4" style="color: #1C2A39;">Organize tasks with a visual Kanban board for efficient project tracking.</p>
                        <img src="<?php echo e(asset('businesstoolsImages/projectmanagement.jpg')); ?>" alt="Kanban Screenshot" class="w-full h-32 object-cover rounded-md mb-4">
                    </div>
                    <div class="mt-auto pt-4">
                        <div class="flex justify-center">
                            <span class="inline-block text-sm font-medium px-3 py-1 rounded" style="background-color: #B06F49; color: #F9FAFB;">Enterprise</span>
                        </div>
                    </div>
                </div>

                <!-- AI Quote Generator -->
                <div class="rounded-lg shadow-lg p-6 text-center flex flex-col h-full" style="background-color: #F9FAFB;">
                    <div class="flex-grow">
                        <i class="fas fa-clipboard-check text-4xl mb-4" style="color: #6EE7B7;"></i>
                        <h3 class="text-xl font-semibold mb-2" style="color: #1C2A39;">AI Quote Generator</h3>
                        <p class="mb-4" style="color: #1C2A39;">
                            <strong>Quote for Pressure Washing — $225.00</strong><br>
                            <small>Generate professional quotes in 10 seconds</small>
                        </p>
                        <img src="<?php echo e(asset('businesstoolsImages/contractor-form.jpg')); ?>" alt="Contractor writing on form" class="w-full h-32 object-cover rounded-md mb-4">
                    </div>
                    <div class="mt-auto pt-4">
                        <div class="flex justify-center">
                            <span class="inline-block text-sm font-medium px-3 py-1 rounded" style="background-color: #B06F49; color: #F9FAFB;">Enterprise</span>
                        </div>
                    </div>
                </div>

                <!-- Zapier Automation -->
                <div class="rounded-lg shadow-lg p-6 text-center flex flex-col h-full" style="background-color: #F9FAFB;">
                    <div class="flex-grow">
                        <i class="fas fa-plug text-4xl mb-4" style="color: #6EE7B7;"></i>
                        <h3 class="text-xl font-semibold mb-2" style="color: #1C2A39;">Zapier Automation</h3>
                        <p class="mb-4" style="color: #1C2A39;">Connect your tools with Zapier for seamless workflow automation.</p>
                        <img src="<?php echo e(asset('businesstoolsImages/zapier.jpg')); ?>" alt="Zapier Screenshot" class="w-full h-32 object-cover rounded-md mb-4">
                    </div>
                    <div class="mt-auto pt-4">
                        <div class="flex justify-center">
                            <span class="inline-block text-sm font-medium px-3 py-1 rounded" style="background-color: #6EE7B7; color: #1C2A39;">Premium+</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php /**PATH /var/www/Novuk/resources/views/default/landing-page/businesstools/section.blade.php ENDPATH**/ ?>