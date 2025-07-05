@use(\App\Domains\Entity\Enums\EntityEnum)
@extends('panel.layout.settings', ['layout' => 'fullwidth'])

@section('title', __('Business Bookings'))
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
         #dataTable_length{

            display:none;
        }
        #dataTable_filter{

            display:none;
        }
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
        .badge-paid { background-color: #e0f2fe; color: #0369a1; }
        .badge-unpaid { background-color: #fef3c7; color: #92400e; }
        
        .calendly-badge {
            background-color: #f5f5f5;
            color: #666;
        }
    </style>
@endsection

@section('settings')
<div class="business-clients w-full">
    <div class="controls">
        <form method="GET" action="{{ route('dashboard.business.calendly.index') }}" class="flex items-center gap-8">
            <div class="left-controls" id="searchControls">
               <div class="bulk-actions">
                    <select name="bulk_action" class="select-company bulk-action-select">
                        <option value="">Bulk Actions</option>
                        <option value="delete">Delete Selected</option>
                    </select>
                </div>
                <input id="globalSearch" name="search" class="search" type="text" placeholder="Search by client name or booking ID" 
                     >
            </div>
            <div class="right-controls">
                <x-button variant="ghost" class="btn-filter"><i class="fa-solid fa-filter"></i> Filter</x-button>
                <x-button href="{{ route('dashboard.business.calendly.embed') }}" class="btn-create">
                <x-tabler-plus class="size-4 mr-1" />{{__('Create New') }}
             </x-button>
            </div>
        </form>
        {{-- <form method="GET" action="{{ route('dashboard.business.calendly.index') }}" class="flex items-center gap-8">
            <div class="left-controls" id="searchControls">
                <select name="status" class="select-company" onchange="this.form.submit()">
                </select>
                <input name="search" class="search" type="text" placeholder="Search by client name or booking ID" 
                       value="{{ request('search') }}" onchange="this.form.submit()">
            </div>
            <div class="right-controls">
                <x-button variant="ghost" class="btn-filter" id="toggleFilter"><i class="fa-solid fa-filter"></i> Filter</x-button>
                <x-button class="btn-create" href="{{ route('dashboard.business.calendly.embed') }}">
                   <x-tabler-plus class="size-4 mr-1" />{{__('New Booking') }} 
                </x-button>
            </div>
        </form> --}}
    </div>
<div class="filter-fields hidden"  id="filterBox">
    <div class="form-row-inline">
        <div class="form-group">
            <label>Client</label>
            <select name="client_id" id="client_id">
                <option value="">All Clients</option>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}" {{ request('client_id') == $client->id ? 'selected' : '' }}>
                        {{ $client->first_name }} {{ $client->last_name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Date From</label>
            <input type="date" id="date_from" name="date_from" value="{{ request('date_from') }}">
        </div>
    </div>
    <div class="form-row-inline">
        <div class="form-group">
            <label>Date To</label>
            <input type="date" id="date_to" name="date_to" value="{{ request('date_to') }}">
        </div>
        <div class="form-group">
            <label>Payment Status</label>
            <select id="payment_status" name="payment_status">
                <option value="">All</option>
                <option value="paid" {{ request('payment_status') == 'paid' ? 'selected' : '' }}>Paid</option>
                <option value="unpaid" {{ request('payment_status') == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
            </select>
        </div>
    </div>
    <div class="filter-actions">
        <button id="applyFilters" type="button" class="btn-apply">Apply Filters</button>
        <button id="resetFilters" type="button" class="btn-reset">Reset</button>
    </div>
</div>
    <!--<div class="filter-fields hidden" id="filterBox">-->
    <!--    <form method="GET" action="{{ route('dashboard.business.calendly.index') }}">-->
    <!--        <div class="form-row-inline">-->
    <!--            <div class="form-group">-->
    <!--                <label>Client</label>-->
    <!--                <select name="client_id">-->
    <!--                    <option value="">All Clients</option>-->
    <!--                    @foreach($clients as $client)-->
    <!--                        <option value="{{ $client->id }}" {{ request('client_id') == $client->id ? 'selected' : '' }}>-->
    <!--                            {{ $client->name }}-->
    <!--                        </option>-->
    <!--                    @endforeach-->
    <!--                </select>-->
    <!--            </div>-->
    <!--            <div class="form-group">-->
    <!--                <label>Date From</label>-->
    <!--                <input type="date" name="date_from" value="{{ request('date_from') }}">-->
    <!--            </div>-->
    <!--        </div>-->
    <!--        <div class="form-row-inline">-->
    <!--            <div class="form-group">-->
    <!--                <label>Date To</label>-->
    <!--                <input type="date" name="date_to" value="{{ request('date_to') }}">-->
    <!--            </div>-->
    <!--            <div class="form-group">-->
    <!--                <label>Payment Status</label>-->
    <!--                <select name="payment_status">-->
    <!--                    <option value="">All</option>-->
    <!--                    <option value="paid" {{ request('payment_status') == 'paid' ? 'selected' : '' }}>Paid</option>-->
    <!--                    <option value="unpaid" {{ request('payment_status') == 'unpaid' ? 'selected' : '' }}>Unpaid</option>-->
    <!--                </select>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--        <div class="filter-actions">-->
    <!--            <x-button type="submit" class="btn-apply">Apply Filters</x-button>-->
    <!--            <x-button href="{{ route('dashboard.business.calendly.index') }}" class="btn-reset">Reset</x-button>-->
    <!--        </div>-->
    <!--    </form>-->
    <!--</div>-->

    <div class="table-responsive">
        <table id="dataTable" class="w-full">
            <thead>
                <tr>
                    <th><input type="checkbox" class="select-all"></th>
                    <th>Booking #</th>
                    <th>Client</th>
                    <th>Event Type</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status</th>
                    <th>Payment</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
               
            </tbody>
        </table>
    </div>

    <div class="center-pagination mt-4">
        {{ $bookings->links('default.panel.business.pagination.custom') }}
    </div>
</div>

@section('additional_scripts')


<script src="{{ custom_theme_url('/assets/libs/select2/select2.min.js') }}"></script>
<script>
    $(document).ready(function () {
    // Initialize Select2
    $('.select2-client').select2({
        placeholder: "Select a client",
        allowClear: true
    });
 
    // Toggle filter box
    $('.btn-filter').click(function () {
        $('#filterBox').toggleClass('hidden');
    });
 
    // Initialize DataTable with filters and server-side
    var table = $('#dataTable').DataTable({
       
        processing: true,
        serverSide: true,
        paging: true,
        ajax: {
            url: "{{ route('dashboard.business.calendly.getcalendlydata') }}",
            type: "POST",
            data: function (d) {
               
                d._token = "{{ csrf_token() }}";
                d.client = $('#client_id').val();
                d.status = $('#payment_status').val();
                d.date_to = $('#date_to').val();
                d.date_from = $('#date_from').val();
                // console.log('Email:',  d.status);
            }
        },
      columns: [
            { data: 'checkbox', orderable: true, searchable: true },
            { data: 'id', name: 'id' },
            { data: 'client_info', orderable: true, searchable: true },
            { data: 'event_type', name: 'event_type' },
            { data: 'date', name: 'start_time' },
            { data: 'time', orderable: true, searchable: true },
            { data: 'status', orderable: true, searchable: true },
            { data: 'payment', orderable: true, searchable: true },
            { data: 'actions', orderable: true, searchable: true }
        ],
        columnDefs: [
            { targets: 0, className: 'text-center' },
            { targets: -1, className: 'text-center' }
        ],
        initComplete: function () {
            $('#dataTable thead tr th:first').removeClass();
        }
    });
    table.on('draw', function() {
        $('#dataTable td.sorting_1').removeClass('sorting_1');
    });
    // Global search
    $('#globalSearch').keyup(function () {
        table.search($(this).val()).draw();
    });
 
    // Apply filters
    $('#applyFilters').click(function () {
        table.draw();
    });
 
    // Reset filters
    $('#resetFilters').click(function () {
         $('#client_id').val('');
         $('#payment_status').val('');
         $('#date_to').val('');
         $('#date_from').val('');
        table.search('').draw();
    });
 
    // Select all checkboxes
    $('#selectAll').change(function () {
        $('.booking-checkbox').prop('checked', $(this).prop('checked'));
    });
     $('.bulk-action-select').change(function() {
         console.log("changed");
            const action = $(this).val();
            const selectedIds = $('.booking-checkbox:checked').map(function() {
                return $(this).val();
            }).get();
console.log(selectedIds);
            if (action === 'delete' && selectedIds.length > 0) {
                if (confirm('Are you sure you want to delete the selected ?')) {
                    $.ajax({
                        url: "{{ route('dashboard.business.calendly.bulkAction') }}",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            ids: selectedIds,
                            _method: "DELETE"
                        },
                        success: function(response) {
                            if (response.success) {
                                table.draw();
                            } else {
                                alert('Error: ' + response.message);
                            }
                        },
                        error: function(xhr) {
                            alert('Error deleting taxes');
                        }
                    });
                }
            }
            $(this).val('');
        });
 
   
});
//     $(document).ready(function() {
//         // Initialize Select2
//         $('.select2-client').select2({
//             placeholder: "Select a client",
//             allowClear: true
//         });

//         // Toggle filter box
//         $('#toggleFilter').click(function() {
//             $('#filterBox').toggleClass('hidden');
//         });

//         // DataTable initialization
//         $('#dataTable').DataTable({
//             responsive: true,
//             paging: false, // We're using Laravel pagination
//             searching: false, // We have our own search
//             info: false,
//             columnDefs: [
//                 { orderable: false, targets: [0, -1] } // Disable sorting for checkbox and actions columns
//             ],
//             initComplete: function() {
//                 // Remove class from first th in thead
//                 $('#dataTable thead tr th:first').removeClass();
//             }
//         });

//         // Select All Checkboxes
//         $('.select-all').on('click', function() {
//             $('.booking-checkbox').prop('checked', this.checked);
//         });
//     });
// 
</script>
@endsection
@endsection