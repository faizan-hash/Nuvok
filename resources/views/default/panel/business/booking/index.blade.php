<<<<<<< HEAD
@use(\App\Domains\Entity\Enums\EntityEnum)
@extends('panel.layout.settings', ['layout' => 'fullwidth'])

@section('title', __('Bookings'))
@section('titlebar_actions')
 <x-button
    class="text-inherit hover:text-foreground"
    variant="link"
    href="{{ LaravelLocalization::localizeUrl(route('dashboard.index')) }}"
>
    <x-tabler-chevron-left
        class="size-4"
        stroke-width="1.5"
    />
    {{ __('Back to dashboard') }}
</x-button>
@endsection
@section('additional_css')
    <link href="{{ custom_theme_url('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('bussiness/custom.css') }}" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7692faf57e.js" crossorigin="anonymous"></script>
    <style>
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.5rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        .badge-scheduled { background-color: #dbeafe; color: #1e40af; }
        .badge-confirmed { background-color: #dcfce7; color: #166534; }
        .badge-cancelled { background-color: #fee2e2; color: #991b1b; }
        .badge-completed { background-color: #ede9fe; color: #5b21b6; }
    </style>
@endsection

@section('settings')
<div class="business-clients w-full">
    <div class="controls">
        <form method="GET" action="{{ route('dashboard.business.bookings.index') }}" class="flex items-center gap-8">
            <div class="left-controls" id="searchControls">
                <select name="status" class="select-company" onchange="this.form.submit()">
                    <option value="">All Status</option>
                    <option value="scheduled" {{ request('status') == 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                    <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
                <input name="search" class="search" type="text" placeholder="Search by client name or booking ID" 
                       value="{{ request('search') }}" onchange="this.form.submit()">
            </div>
            <div class="right-controls">
                <button type="button" class="btn-filter"><i class="fa-solid fa-filter"></i> Filter</button>
                <a href="{{ route('dashboard.business.bookings.create') }}" class="btn-create">
                  Create Booking
                </a>
            </div>
        </form>
    </div>

    <div class="filter-fields hidden" id="filterBox">
        <form method="GET" action="{{ route('dashboard.business.bookings.index') }}">
            <div class="filter-grid">
                <div class="filter-group">
                    <label>Client</label>
                    <select name="client_id" class="select2-client">
                        <option value="">All Clients</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}" {{ request('client_id') == $client->id ? 'selected' : '' }}>
                                {{ $client->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="filter-group">
                    <label>Date From</label>
                    <input type="date" name="date_from" value="{{ request('date_from') }}">
                </div>
                <div class="filter-group">
                    <label>Date To</label>
                    <input type="date" name="date_to" value="{{ request('date_to') }}">
                </div>
                <div class="filter-actions">
                    <button type="submit" class="btn-apply">Apply Filters</button>
                    <a href="{{ route('dashboard.business.bookings.index') }}" class="btn-reset">Reset</a>
                </div>
            </div>
        </form>
    </div>

    <table id="dataTable">
        <thead>
            <tr>
                <th><input type="checkbox" class="select-all"></th>
                <th>Booking #</th>
                <th>Organizer</th>
                <!-- <th>Participants</th> -->
                <th>Title</th>
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
            <tr>
                <td><input type="checkbox" class="booking-checkbox" value="{{ $booking->id }}"></td>
                <td>#{{ $booking->id }}</td>
                <td>
                    <div class="flex items-center">
                        <div>
                            <div class="font-medium">{{ $booking->user->name }}</div>
                            <div class="text-xs text-gray-500">{{ $booking->user->email }}</div>
                        </div>
                    </div>
                </td>
                <!-- <td>
                    @if($booking->clients->count() > 0)
                        @foreach($booking->clients->take(2) as $client)
                            <span class="badge">{{ $client->name }}</span>
                        @endforeach
                        @if($booking->clients->count() > 2)
                            <span class="badge">+{{ $booking->clients->count() - 2 }} more</span>
                        @endif
                    @else
                        <span class="text-gray-400">-</span>
                    @endif
                </td> -->
                <td>{{ $booking->title }}</td>
                <td>{{ \Carbon\Carbon::parse($booking->start_time)->format('M d, Y') }}</td>
                <td>
                    {{ \Carbon\Carbon::parse($booking->start_time)->format('h:i A') }} - 
                    {{ \Carbon\Carbon::parse($booking->end_time)->format('h:i A') }}
                </td>
                <td>
                    @switch($booking->status)
                        @case('scheduled')
                            <span class="badge badge-scheduled">Scheduled</span>
                            @break
                        @case('confirmed')
                            <span class="badge badge-confirmed">Confirmed</span>
                            @break
                        @case('completed')
                            <span class="badge badge-completed">Completed</span>
                            @break
                        @case('cancelled')
                            <span class="badge badge-cancelled">Cancelled</span>
                            @break
                    @endswitch
                </td>
                <td>
                    <div class="actions">
                        <a href="{{ route('dashboard.business.bookings.show', $booking->id) }}" class="action-btn">
                            <i class="fa-solid fa-eye fa-2xs"></i>
                        </a>
                        <a href="{{ route('dashboard.business.bookings.edit', $booking->id) }}" class="action-btn">
                            <i class="fa-solid fa-pencil fa-2xs"></i>
                        </a>
                        <form action="{{ route('dashboard.business.bookings.destroy', $booking->id) }}" method="POST" class="inline-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-btn" onclick="return confirm('Are you sure?')">
                                <i class="fa-solid fa-trash-can fa-2xs"></i>
                            </button>
                        </form>
                        @if($booking->status !== 'completed' && $booking->status !== 'cancelled')
                        <a href="{{ route('dashboard.business.bookings.mark-as-completed', $booking->id) }}" class="action-btn">
                            <i class="fa-solid fa-check-circle fa-2xs"></i>
                        </a>
                        @endif
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="center-pagination">
    {{ $bookings->links('default.panel.business.pagination.custom') }}
</div>
</div>
@section('additional_scripts')
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            responsive: true,
            columnDefs: [
                { orderable: false, targets: [0, -1] } // 0 = checkbox column, -1 = last column (usually actions)
            ],
            drawCallback: function(settings) {
                $('#dataTable tbody tr').each(function() {
                    if (!$(this).next().hasClass('extra-row')) {
                        $('<tr class="extra-row"><td colspan="100%"><hr></td></tr>').insertAfter(this);
                    }
                });
            },
            initComplete: function() {
                // Remove class from first th in thead
                $('#dataTable thead tr th:first').removeClass();
            }
        });

        // Select All Checkboxes
        $('.select-all').on('click', function() {
            $('.client-checkbox').prop('checked', this.checked);
        });
    });
</script>

@endsection
=======
@use(\App\Domains\Entity\Enums\EntityEnum)
@extends('panel.layout.settings', ['layout' => 'fullwidth'])

@section('title', __('Bookings'))
@section('titlebar_actions')
 <x-button
    class="text-inherit hover:text-foreground"
    variant="link"
    href="{{ LaravelLocalization::localizeUrl(route('dashboard.index')) }}"
>
    <x-tabler-chevron-left
        class="size-4"
        stroke-width="1.5"
    />
    {{ __('Back to dashboard') }}
</x-button>
@endsection
@section('additional_css')
    <link href="{{ custom_theme_url('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('bussiness/custom.css') }}" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7692faf57e.js" crossorigin="anonymous"></script>
    <style>
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.5rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        .badge-scheduled { background-color: #dbeafe; color: #1e40af; }
        .badge-confirmed { background-color: #dcfce7; color: #166534; }
        .badge-cancelled { background-color: #fee2e2; color: #991b1b; }
        .badge-completed { background-color: #ede9fe; color: #5b21b6; }
    </style>
@endsection

@section('settings')
<div class="business-clients w-full">
    <div class="controls">
        <form method="GET" action="{{ route('dashboard.business.bookings.index') }}" class="flex items-center gap-8">
            <div class="left-controls" id="searchControls">
                <select name="status" class="select-company" onchange="this.form.submit()">
                    <option value="">All Status</option>
                    <option value="scheduled" {{ request('status') == 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                    <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
                <input name="search" class="search" type="text" placeholder="Search by client name or booking ID" 
                       value="{{ request('search') }}" onchange="this.form.submit()">
            </div>
            <div class="right-controls">
                <button type="button" class="btn-filter"><i class="fa-solid fa-filter"></i> Filter</button>
                <a href="{{ route('dashboard.business.bookings.create') }}" class="btn-create">
                  Create Booking
                </a>
            </div>
        </form>
    </div>

    <div class="filter-fields hidden" id="filterBox">
        <form method="GET" action="{{ route('dashboard.business.bookings.index') }}">
            <div class="filter-grid">
                <div class="filter-group">
                    <label>Client</label>
                    <select name="client_id" class="select2-client">
                        <option value="">All Clients</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}" {{ request('client_id') == $client->id ? 'selected' : '' }}>
                                {{ $client->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="filter-group">
                    <label>Date From</label>
                    <input type="date" name="date_from" value="{{ request('date_from') }}">
                </div>
                <div class="filter-group">
                    <label>Date To</label>
                    <input type="date" name="date_to" value="{{ request('date_to') }}">
                </div>
                <div class="filter-actions">
                    <button type="submit" class="btn-apply">Apply Filters</button>
                    <a href="{{ route('dashboard.business.bookings.index') }}" class="btn-reset">Reset</a>
                </div>
            </div>
        </form>
    </div>

    <table id="dataTable">
        <thead>
            <tr>
                <th><input type="checkbox" class="select-all"></th>
                <th>Booking #</th>
                <th>Organizer</th>
                <!-- <th>Participants</th> -->
                <th>Title</th>
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
            <tr>
                <td><input type="checkbox" class="booking-checkbox" value="{{ $booking->id }}"></td>
                <td>#{{ $booking->id }}</td>
                <td>
                    <div class="flex items-center">
                        <div>
                            <div class="font-medium">{{ $booking->user->name }}</div>
                            <div class="text-xs text-gray-500">{{ $booking->user->email }}</div>
                        </div>
                    </div>
                </td>
                <!-- <td>
                    @if($booking->clients->count() > 0)
                        @foreach($booking->clients->take(2) as $client)
                            <span class="badge">{{ $client->name }}</span>
                        @endforeach
                        @if($booking->clients->count() > 2)
                            <span class="badge">+{{ $booking->clients->count() - 2 }} more</span>
                        @endif
                    @else
                        <span class="text-gray-400">-</span>
                    @endif
                </td> -->
                <td>{{ $booking->title }}</td>
                <td>{{ \Carbon\Carbon::parse($booking->start_time)->format('M d, Y') }}</td>
                <td>
                    {{ \Carbon\Carbon::parse($booking->start_time)->format('h:i A') }} - 
                    {{ \Carbon\Carbon::parse($booking->end_time)->format('h:i A') }}
                </td>
                <td>
                    @switch($booking->status)
                        @case('scheduled')
                            <span class="badge badge-scheduled">Scheduled</span>
                            @break
                        @case('confirmed')
                            <span class="badge badge-confirmed">Confirmed</span>
                            @break
                        @case('completed')
                            <span class="badge badge-completed">Completed</span>
                            @break
                        @case('cancelled')
                            <span class="badge badge-cancelled">Cancelled</span>
                            @break
                    @endswitch
                </td>
                <td>
                    <div class="actions">
                        <a href="{{ route('dashboard.business.bookings.show', $booking->id) }}" class="action-btn">
                            <i class="fa-solid fa-eye fa-2xs"></i>
                        </a>
                        <a href="{{ route('dashboard.business.bookings.edit', $booking->id) }}" class="action-btn">
                            <i class="fa-solid fa-pencil fa-2xs"></i>
                        </a>
                        <form action="{{ route('dashboard.business.bookings.destroy', $booking->id) }}" method="POST" class="inline-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-btn" onclick="return confirm('Are you sure?')">
                                <i class="fa-solid fa-trash-can fa-2xs"></i>
                            </button>
                        </form>
                        @if($booking->status !== 'completed' && $booking->status !== 'cancelled')
                        <a href="{{ route('dashboard.business.bookings.mark-as-completed', $booking->id) }}" class="action-btn">
                            <i class="fa-solid fa-check-circle fa-2xs"></i>
                        </a>
                        @endif
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="center-pagination">
    {{ $bookings->links('default.panel.business.pagination.custom') }}
</div>
</div>
@section('additional_scripts')
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            responsive: true,
            columnDefs: [
                { orderable: false, targets: [0, -1] } // 0 = checkbox column, -1 = last column (usually actions)
            ],
            drawCallback: function(settings) {
                $('#dataTable tbody tr').each(function() {
                    if (!$(this).next().hasClass('extra-row')) {
                        $('<tr class="extra-row"><td colspan="100%"><hr></td></tr>').insertAfter(this);
                    }
                });
            },
            initComplete: function() {
                // Remove class from first th in thead
                $('#dataTable thead tr th:first').removeClass();
            }
        });

        // Select All Checkboxes
        $('.select-all').on('click', function() {
            $('.client-checkbox').prop('checked', this.checked);
        });
    });
</script>

@endsection
>>>>>>> f4799b86f474e344473c5131907406fc349bf0dc
@endsection