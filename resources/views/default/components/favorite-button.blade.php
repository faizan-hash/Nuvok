@php
    $base_class = 'lqd-fav-btn z-10 size-9 flex items-center justify-center rounded-full transition-colors duration-300';
@endphp

<x-button
    id="fav-btn-{{ $id }}"
    {{ $attributes->withoutTwMergeClasses()->twMerge($base_class, $attributes->get('class')) }}
    size="none"
    variant="ghost-shadow"
    x-data="{
        isFavorite: {{ $isFavorite ? 'true' : 'false' }},
        get bgClass() {
            return this.isFavorite ? 'bg-green-500 text-white' : 'bg-white text-gray-600';
        }
    }"
    x-bind:class="bgClass"
    @click.prevent="
        fetch('{{ $updateUrl }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ id: {{ $id }} })
        }).then(() => {
            isFavorite = !isFavorite;
            toastr.success(isFavorite ? 'Added to favorites' : 'Removed from favorites');
        });
    "
    href="#"
    title="{{ __('Favorite') }}"
>
    {{-- Heart icon (when favorited) --}}
    <template x-if="isFavorite">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition-all duration-300 fill-white" viewBox="0 0 24 24">
            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 
                     2 8.5 2 6.5 3.5 5 5.5 5 
                     7.04 5 8.54 5.99 9.07 7.36h1.87C13.46 5.99 
                     14.96 5 16.5 5 18.5 5 20 6.5 
                     20 8.5c0 3.78-3.4 6.86-8.55 
                     11.54L12 21.35z"/>
        </svg>
    </template>

    {{-- Star icon (when not favorited) --}}
    <template x-if="!isFavorite">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition-all duration-300 fill-yellow-500" viewBox="0 0 24 24">
            <path d="M12 17.27L18.18 21l-1.64-7.03L22 
                     9.24l-7.19-.61L12 2 9.19 
                     8.63 2 9.24l5.46 4.73L5.82 
                     21z"/>
        </svg>
    </template>
</x-button>
