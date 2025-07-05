@auth
    @if (auth()->user()->isAdmin())
        <x-alert
            class="top-notice-bar top-notice-bar-hidden items-center rounded-none py-1 text-xs shadow-none lg:h-[--top-notice-bar-height]"
            id="top-notice-bar"
            variant="warn-fill"
            icon="tabler-info-circle"
            size="xs"
            x-data="{ noticeBarHidden: true }" 
            ::class="{ 'hidden': noticeBarHidden, 'top-notice-bar-hidden': noticeBarHidden, 'top-notice-bar-visible': !noticeBarHidden }"
        >
            <script>
                // Initially hide the notice bar by setting it to 'hidden' in localStorage
                localStorage.setItem('lqdTopBarNotice', 'hidden');
                document.getElementById('top-notice-bar').classList.add('top-notice-bar-hidden');
                document.getElementById('top-notice-bar').classList.remove('top-notice-bar-visible');
                document.getElementById('top-notice-bar').style.display = 'none';
            </script>
            <!-- Bar content removed for visibility -->
        </x-alert>
    @endif
@endauth
