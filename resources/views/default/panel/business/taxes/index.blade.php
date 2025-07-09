@extends('panel.layout.settings', ['layout' => 'fullwidth'])

@section('title', __('Taxes'))
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <script src="https://kit.fontawesome.com/7692faf57e.js" crossorigin="anonymous"></script>
@endsection

@section('settings')
<div class="business-taxes w-full">
    <div class="controls mt-8">
         <div class="flex items-center gap-8">
        <div class="left-controls" id="searchControls">
            <div class="bulk-actions">
                <select name="bulk_action" class="select-company bulk-action-select">
                    <option value="">Bulk Actions</option>
                    <option value="delete">Delete Selected</option>
                </select>
            </div>
            <input id="globalSearch" type="text" placeholder="Search by project title" class="search">
        </div>
        <div class="right-controls">
            <x-button variant="ghost" class="btn-filter"><i class="fa-solid fa-filter"></i> Filter</x-button>
            <x-button href="{{ route('dashboard.business.taxes.create') }}" class="btn-create">
              <x-tabler-plus class="size-4 mr-1" />{{__('Create New') }}
            </x-button>
        </div>
        </div>
    </div>
    
    <div class="filter-fields hidden" id="filterBox">
        <div class="form-row-inline">
            <div class="form-group">
                <label>Name</label>
                <input type="text" id="nameFilter" placeholder="e.g. VAT, GST, Sales Tax">
            </div>
            <div class="form-group">
                <label>Rate</label>
                <input type="number" id="rateFilter" min="0" max="100" step="0.01" placeholder="e.g. 18.5">
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
                    <th>Rate (%)</th>
                    <th>Created At</th>
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
            responsive:true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('dashboard.business.taxes.gettaxesdata') }}",
                type: "POST",
                data: function(d) {
                    d._token = "{{ csrf_token() }}",
                    d.name = $('#nameFilter').val(),
                    d.rate = $('#rateFilter').val()
                }
            },
            columns: [
                { 
                    data: 'checkbox', 
                    name: 'checkbox', 
                    orderable: true, 
                    searchable: true,
                    render: function(data, type, row) {
                        return '<input type="checkbox" class="tax-checkbox" value="' + row.id + '">';
                    }
                },
                { data: 'name', name: 'name' },
                { data: 'rate', name: 'rate' },
                { 
                    data: 'created_at', 
                    name: 'created_at',
                    render: function(data) {
                        return new Date(data).toLocaleDateString('en-GB', {
                            day: '2-digit',
                            month: 'short',
                            year: 'numeric'
                        });
                    }
                },
                { 
                    data: 'actions', 
                    name: 'actions', 
                    orderable: true, 
                    searchable: true,
                    render: function(data, type, row) {
                        return `
                            <div class="actions">
                                <x-button href="/dashboard/business/taxes/${row.id}/edit" class="action-btn">
                                    <i class="fa-solid fa-pencil fa-2xs"></i>
                                </x-button>
                               <a href="/dashboard/business/taxes/destroy/${row.id}" class="action-btn" onclick="return confirm('Are you sure?')">
                                    <i class="fa-solid fa-trash-can fa-2xs" style="margin-bottom: 10px;"></i>
                                </a>
                            </div>
                        `;
                    }
                }
            ],
            dom: '<"top"lf>rt<"bottom"ip>',
            pageLength: 10,
            lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
            order: [[3, 'desc']] // Default sort by created_at desc
        });
        table.on('draw', function() {
            $('#dataTable td.sorting_1').removeClass('sorting_1');
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
            $('#nameFilter').val('');
            $('#rateFilter').val('');
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
            const selectedIds = $('.tax-checkbox:checked').map(function() {
                return $(this).val();
            }).get();

            if (action === 'delete' && selectedIds.length > 0) {
                if (confirm('Are you sure you want to delete the selected taxes?')) {
                    $.ajax({
                        url: "{{ route('dashboard.business.taxes.bulkAction') }}",
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

        // Select all functionality
        $('#selectAll').change(function() {
            $('.tax-checkbox').prop('checked', $(this).prop('checked'));
        });
    });
    </script>
@endsection
@endsection