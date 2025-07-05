<<<<<<< HEAD
<x-box
    style="3"
    title="{!! __($item->title) !!}"
    desc="{!! __($item->description) !!}"
>
    <x-slot name="image">
        <figure class="group-hover:scale-105 relative z-0 inline-block transition-all duration-300">
            <div style="height: 100px; width: 64px; margin: 0 auto; display: flex; align-items: center; justify-content: center; color: #60027C;">
                @if (str_starts_with($item->image, '<svg'))
                    {!! $item->image !!}
                @else
                    <img
                        class="-mx-8 max-w-[calc(100%+4rem)]"
                        src="{{ custom_theme_url($item->image, true) }}"
                        alt="{!! __($item->title) !!}"
                        style="margin-top: 20px;"
                    >
                @endif
            </div>
        </figure>
    </x-slot>
</x-box>
=======
<x-box
    style="3"
    title="{!! __($item->title) !!}"
    desc="{!! __($item->description) !!}"
>
    <x-slot name="image">
        <figure class="group-hover:scale-105 relative z-0 inline-block transition-all duration-300">
            <div style="height: 100px;">
                <img
                    class="-mx-8 max-w-[calc(100%+4rem)]"
                    src="{{ custom_theme_url($item->image, true) }}"
                    alt="{!! __($item->title) !!}"
                    style="margin-top: 20px;"
                >
            </div>
        </figure>
    </x-slot>
</x-box>
>>>>>>> f4799b86f474e344473c5131907406fc349bf0dc
