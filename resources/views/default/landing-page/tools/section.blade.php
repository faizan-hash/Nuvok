{!! adsense_tools_728x90() !!}
<section class="site-section py-10 transition-all duration-700 md:translate-y-8 md:opacity-0 [&.lqd-is-in-view]:translate-y-0 [&.lqd-is-in-view]:opacity-100">
    <div class="container">
        <div class="rounded-[50px] border p-10 max-sm:px-5">
            <x-section-header
                mb="7"
                width="w-3/5"
                title="Smart Tools. Built by NuvokAI."
                subtitle="Everything you need to run your service business — quotes, invoices, content, and more — all powered by NuvokAI."
            >
                <h6 class="mb-6 inline-block rounded-md bg-[#083D91] bg-opacity-15 px-3 py-1 text-[13px] font-medium text-[#083D91]">
                    <span class="text-sm font-medium text-gray-800">
                        {{ __('NuvokAI') }}
                    </span>
                </h6>
            </x-section-header>
            <div class="grid grid-cols-3 gap-3 max-lg:grid-cols-2 max-md:grid-cols-1">
                @foreach ($tools as $item)
                    @include('landing-page.tools.item')
                @endforeach
            </div>
        </div>
    </div>
</section>
