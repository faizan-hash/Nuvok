<h4 class="mt-4 mb-2">{{ __('AI Credits') }}</h4>

<table class="mb-4 w-full table-auto border-collapse border">
    <thead>
        <tr class="bg-foreground/10">
            <th class="border p-2 text-start">{{ __('Model') }}</th>
            <th class="border p-2 text-end">{{ __('Credits') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $key => $model)
            @php
                $drivers = $plan->exists ? $model->forPlan($plan)->list() : $model->forUser(auth()->user())->list();
                $groupName = $drivers->isNotEmpty() ? $drivers->first()->enum()->subLabel() : '';
                $isUnlimited = $model->checkIfThereUnlimited();
                $credits = $model->totalCredits();
                $tooltip_anchor = $loop->index < 4 ? 'top' : 'bottom';
            @endphp
            @if (!$isUnlimited && $credits <= 0)
                @continue
            @endif
            <tr>
                <td class="flex justify-between border p-2">
                    {{ $groupName }}
                    <x-info-tooltip
                        class:content="max-h-48 overflow-y-auto"
                        :drivers="$drivers"
                        :anchor="$tooltip_anchor"
                    />
                </td>
                <td class="border p-2 text-end">
                    {{ $isUnlimited ? __('Unlimited') : $credits }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<h4 class="mt-4 mb-2">{{ __('Business Credits') }}</h4>
<table class="mb-4 w-full table-auto border-collapse border">
    <thead>
        <tr class="bg-foreground/10">
            <th class="border p-2 text-start">{{ __('Category') }}</th>
            <th class="border p-2 text-end">{{ __('Credits') }}</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="border p-2">{{ __('Invoices') }}</td>
            <td class="border p-2 text-end">{{ $businessCredits->invoices ?? 0 }}</td>
        </tr>
        <tr>
            <td class="border p-2">{{ __('Clients') }}</td>
            <td class="border p-2 text-end">{{ $businessCredits->clients ?? 0 }}</td>
        </tr>
        <tr>
            <td class="border p-2">{{ __('Projects') }}</td>
            <td class="border p-2 text-end">{{ $businessCredits->projects ?? 0 }}</td>
        </tr>
        <tr>
            <td class="border p-2">{{ __('Tasks') }}</td>
            <td class="border p-2 text-end">{{ $businessCredits->tasks ?? 0 }}</td>
        </tr>
    </tbody>
</table>
