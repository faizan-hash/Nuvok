@extends('panel.layout.settings', ['layout' => 'fullwidth'])

@section('title', __('Clients Detail'))
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
    <link href="{{ asset('bussiness/custom.css') }}" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://kit.fontawesome.com/7692faf57e.js" crossorigin="anonymous"></script>
@endsection

@section('settings')
<div class="business-clients w-full">
    <div class="controls">
        <div class="flex items-center gap-8">
            <div class="left-controls" id="searchControls">
                <div class="bulk-actions">
                    <select name="bulk_action" class="select-company bulk-action-select">
                        <option value="">Bulk Actions</option>
                        <option value="delete">Delete Selected</option>
                    </select>
                </div>
                <input id="globalSearch" type="text" placeholder="Search by name or email" class="search">
            </div>
            <div class="right-controls">
                <x-button variant="ghost" class="btn-filter"><i class="fa-solid fa-filter"></i> Filter</x-button>
                <x-button href="{{ route('dashboard.business.clients.create') }}" class="btn-create">
                  <x-tabler-plus class="size-4 mr-1" />{{__('Create New') }} 
                </x-button>
            </div>
        </div>
    </div>
    
    <div class="filter-fields hidden" id="filterBox">
        <div class="form-row-inline">
            <div class="form-group">
                <label>Company Name</label>
                <select id="companyFilter">
                    <option value="">All Companies</option>
                    @foreach($companies as $company)
                        <option value="{{ $company }}">{{ $company }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>ID Number</label>
                <input type="text" id="idNumberFilter" placeholder="ID Number">
            </div>
        </div>

        <div class="form-row-inline">
            <div class="form-group">
                <label>Email</label>
                <input type="email" id="emailFilter" placeholder="Email">
            </div>
            <div class="form-group">
                <label>Phone Number</label>
                <input type="text" id="phoneFilter" placeholder="Phone Number">
            </div>
        </div>

        <div class="form-row-inline">
            <div class="form-group">
                <label>Industry</label>
                <select id="industryFilter">
                    <option value="">All Industries</option>
                    @foreach($industries as $industry)
                        <option value="{{ $industry }}">{{ $industry }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Country</label>
                <select id="countryFilter">
                    <option value="">All Countries</option>
                    @foreach($countries as $country)
                        <option value="{{ $country }}">{{ $country }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="filter-actions">
            <x-button type="button" id="applyFilters" class="btn-apply">Apply Filters</x-button>
            <x-button type="button" id="resetFilters" class="btn-reset">Reset</x-button>
        </div>
    </div>
     <div class="table-responsive"> <!-- 🔄 Added wrapper -->
        <table id="dataTable" class="display" style="width:100%">
            <thead>
                <tr>
                    <th><input type="checkbox" id="selectAll"></th>
                    <th>Name</th>
                    <th>Company</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Industry</th>
                    <th>Country</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

@section('additional_scripts')
<script>
$(document).ready(function() {
    // Initialize DataTable
    var table = $('#dataTable').DataTable({
        // responsive: true,
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('dashboard.business.clients.datatable') }}",
            type: "POST",
            data: function(d) {
                d._token = "{{ csrf_token() }}",
                d.company = $('#companyFilter').val(),
                d.id_number = $('#idNumberFilter').val(),
                d.email = $('#emailFilter').val(),
                d.phone = $('#phoneFilter').val(),
                d.industry = $('#industryFilter').val(),
                d.country = $('#countryFilter').val()
            },
        },
        columns: [
            { 
                data: 'checkbox', 
                name: 'checkbox', 
                orderable: true, 
                searchable: true,
                render: function(data, type, row) {
                    return '<input type="checkbox" class="client-checkbox" value="' + row.id + '">';
                }
            },
            { 
                data: 'name', 
                name: 'name',
                render: function(data, type, row) {
                    return `
                        <div>
                            <img src="${row.avatar ? '{{ asset("uploads") }}/' + row.avatar : '{{ asset("uploads/avatars/3WPXgJKcrxwU7qs1t0AMZppTt2aXAMhLlMC1D6ty.png") }}'}" 
                                class="avatar" alt="${row.full_name}">
                            ${row.first_name} ${row.last_name}
                        </div>
                    `;
                }
            },
            { data: 'company_name', name: 'company_name' },
            { data: 'email', name: 'email' },
            { data: 'mobile', name: 'mobile' },
            { data: 'industry', name: 'industry' },
            { data: 'country', name: 'country' },
            { 
                data: 'actions', 
                name: 'actions', 
                orderable: true, 
                searchable: true,
                render: function(data, type, row) {
                    return `
                        <div class="actions">
                            <x-button href="/dashboard/business/clients/${row.id}" class="action-btn">
                                <i class="fa-solid fa-eye fa-2xs"></i>
                            </x-button>
                            <x-button href="/dashboard/business/clients/${row.id}/edit" class="action-btn">
                                <i class="fa-solid fa-pencil fa-2xs"></i>
                            </x-button>
                            <form action="/dashboard/business/clients/${row.id}" method="POST" class="inline-form">
                                @csrf
                                @method('DELETE')
                                <x-button type="submit" class="action-btn" onclick="return confirm('Are you sure?')">
                                    <i class="fa-solid fa-trash-can fa-2xs"></i>
                                </x-button>
                            </form>
                        </div>
                    `;
                }
            }
        ],
        dom: '<"top"lf>rt<"bottom"ip>',
        pageLength: 10,
        lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
        order: [[1, 'asc']]
    });
   table.on('draw', function () {
    // Remove 'sorting_1' class
    $('#dataTable td.sorting_1').removeClass('sorting_1');

    // Remove 'even' and 'odd' classes from all rows
    $('#dataTable tbody tr').removeClass('even odd');
});

    // Global search
    $('#globalSearch').keyup(function() {
        table.search($(this).val()).draw();
    });

    // Filter controls
    $('#applyFilters').click(function() {
        table.draw();
    });

    $('#resetFilters').click(function() {
        $('#companyFilter').val('');
        $('#idNumberFilter').val('');
        $('#emailFilter').val('');
        $('#phoneFilter').val('');
        $('#industryFilter').val('');
        $('#countryFilter').val('');
        table.search('').draw();
    });

    // Toggle filter box
    $('.btn-filter').click(function() {
        $('#filterBox').toggleClass('hidden');
        if (!$('#filterBox').hasClass('hidden')) {
            $(this).html('<i class="fa-solid fa-xmark"></i> Close Filter');
        } else {
            $(this).html('<i class="fa-solid fa-filter"></i> Filter');
        }
    });

    // Bulk actions
    $('.bulk-action-select').change(function() {
        const action = $(this).val();
        const selectedIds = $('.client-checkbox:checked').map(function() {
            return $(this).val();
        }).get();

        if (action === 'delete' && selectedIds.length > 0) {
            if (confirm('Are you sure you want to delete the selected clients?')) {
                $.ajax({
                    url: "{{ route('dashboard.business.clients.bulkAction') }}",
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
                        alert('Error deleting clients');
                    }
                });
            }
        }
        $(this).val('');
    });

    // Select all functionality
    $('#selectAll').change(function() {
        $('.client-checkbox').prop('checked', $(this).prop('checked'));
    });
});
</script>
@endsection
@endsection