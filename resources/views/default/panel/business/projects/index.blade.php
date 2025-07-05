<<<<<<< HEAD
@use(\App\Domains\Entity\Enums\EntityEnum)
@extends('panel.layout.settings', ['layout' => 'fullwidth'])

@section('title', __('Projects Detail'))
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
<style>
    #dataTable tbody tr.even {
        background-color: #f9f9f9 !important; /* Light gray for even rows */
    }
    #dataTable tbody tr.odd {
        background-color: #ffffff !important; /* White for odd rows */
    }
    #dataTable_filter{
        display: none;
    }
    #dataTable_length{
        display: none;
    }
</style>
@endsection
@section('additional_css')
   
    <link href="{{ custom_theme_url('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('bussiness/custom.css') }}" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7692faf57e.js" crossorigin="anonymous"></script>
@endsection

@section('settings')
<div class="business-clients w-full">
<div class="controls">
    <form method="GET" action="{{ route('dashboard.business.projects.index') }}" class="flex items-center gap-8">
        <div class="left-controls" id="searchControls">
            <div class="bulk-actions">
                <select name="bulk_action" class="select-company bulk-action-select">
                    <option value="">Bulk Actions</option>
                    <option value="delete">Delete Selected</option>
                </select>
            </div>
            <input id="globalSearch" name="search" class="search" type="text" placeholder="Search by project title" 
                   value="{{ request('search') }}" onchange="this.form.submit()">
        </div>
        <div class="right-controls">
            <x-button variant="ghost" class="btn-filter"><i class="fa-solid fa-filter"></i> Filter</x-button>
            <x-button href="{{ route('dashboard.business.projects.create') }}" class="btn-create">
                <x-tabler-plus class="size-4 mr-1" />{{__('Create New') }} 
            </x-button>
        </div>
    </form>
</div>
<!--<div class="filter-fields {{ request()->has('client_id') || request()->has('status_id') || request()->has('title') ? '' : 'hidden' }}" id="filterBox">-->
<!--<div class="filter-fields hidden" id="filterBox">-->
<!--    <form method="GET" action="{{ route('dashboard.business.projects.index') }}">-->
<!--        <div class="form-row-inline">-->
<!--            <div class="form-group">-->
<!--                <label>Client</label>-->
<!--                <select name="client_id">-->
<!--                    <option value="">All Clients</option>-->
<!--                    @foreach($clients as $client)-->
<!--                    <option value="{{ $client->id }}" {{ request('client_id') == $client->id ? 'selected' : '' }}>-->
<!--                        {{ $client->first_name }} {{ $client->last_name }}-->
<!--                    </option>-->
<!--                    @endforeach-->
<!--                </select>-->
<!--            </div>-->
<!--            <div class="form-group">-->
<!--                <label>Status</label>-->
<!--                <select name="status_id">-->
<!--                    <option value="">All Statuses</option>-->
<!--                    <option value="1" {{ request('status_id') == '1' ? 'selected' : '' }}>Pending</option>-->
<!--                    <option value="2" {{ request('status_id') == '2' ? 'selected' : '' }}>In Progress</option>-->
<!--                    <option value="3" {{ request('status_id') == '3' ? 'selected' : '' }}>Completed</option>-->
<!--                </select>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="form-row-inline">-->
<!--            <div class="form-group">-->
<!--                <label>Project Title</label>-->
<!--                <input type="text" name="title" placeholder="Project Title" value="{{ request('title') }}">-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="filter-actions">-->
<!--            <x-button type="submit" class="btn-apply">Apply Filters</x-button>-->
<!--            <x-button href="{{ route('dashboard.business.projects.index') }}" class="btn-reset">Reset</x-button>-->
<!--        </div>-->
<!--    </form>-->
<!--</div>-->
<div class="filter-fields hidden" id="filterBox">
    <div class="form-row-inline">
        <div class="form-group">
            <label>Client</label>
            <select id="clientFilter">
                <option value="">All Clients</option>
                @foreach($clients as $client)
                <option value="{{ $client->id }}">
                    {{ $client->first_name }} {{ $client->last_name }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Status</label>
            <select id="statusFilter">
                <option value="">All Statuses</option>
                <option value="1">Pending</option>
                <option value="2">In Progress</option>
                <option value="3">Completed</option>
            </select>
        </div>
    </div>
    <div class="form-row-inline">
        <div class="form-group">
            <label>Project Title</label>
            <input type="text" id="titleFilter" placeholder="Project Title">
        </div>
    </div>
    <div class="filter-actions">
        <x-button type="button" id="applyFilters" class="btn-apply">Apply Filters</x-button>
        <x-button type="button" id="resetFilters" class="btn-reset">Reset</x-button>
    </div>
</div>
     <div class="table-responsive"> <!-- 🔄 Added wrapper -->
        <table id="dataTable">
            <thead>
                <tr>
                    <th><input type="checkbox" class="select-all"></th>
                    <th>Title</th>
                    <th>Client</th>
                    <th>Status</th>
                    <th>Budget</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
              
            </tbody>
        </table>
        <!--<div class="center-pagination">-->
        <!--{{ $projects->links('default.panel.business.pagination.custom') }}-->
        <!--</div>-->
    </div>
</div>
@section('additional_scripts')


<script>
  $(document).ready(function() {
    // Initialize DataTable
    var table = $('#dataTable').DataTable({
         
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('dashboard.business.projects.getProjectdata') }}",
            type: "POST",
            data: function(d) {
                // Add your filter parameters to the request
                d.title = $('#titleFilter').val();
                d.status = $('#statusFilter').val();
                d.client = $('#clientFilter').val();
                d._token = "{{ csrf_token() }}";
            }
        },
        columns: [
            {
                data: 'checkbox',
                name: 'checkbox',
                orderable: false,
                searchable: false,
                render: function(data, type, row) {
                    return `<input type="checkbox" class="project-checkbox" value="${row.id}">`;
                }
            },
            { data: 'title', name: 'title' },
            { data: 'client_name', name: 'client_name' },
            { data: 'status_id', name: 'status_id' },
            { data: 'budget', name: 'budget' },
            {
                data: 'actions',
                name: 'actions',
                orderable: false,
                searchable: false,
                render: function(data, type, row) {
                    return `
                        <div class="actions">
                            <a href="/dashboard/business/projects/${row.id}/edit" class="action-btn">
                                <i class="fa-solid fa-pencil fa-2xs"></i>
                            </a>
                            <form action="/dashboard/business/projects/${row.id}" method="POST" class="inline-form" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-btn">
                                    <i class="fa-solid fa-trash-can fa-2xs"></i>
                                </button>
                            </form>
                        </div>
                    `;
                }
            }
        ],
        // dom: '<"top"lf>rt<"bottom"ip>',
        // pageLength: 10,
        // lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
        // order: [[1, 'asc']], // Default order by title
        // stripeClasses: ['even', 'odd'] 
    });
    
    // Remove sorting class from first column (checkbox column)
    table.on('draw', function() {
        $('#dataTable td.sorting_1').removeClass('sorting_1');
    });
     // Remove 'even' and 'odd' classes from all rows
    $('#dataTable tbody tr').removeClass('even odd');
    
    // Global search
    $('#globalSearch').keyup(function() {
        table.search($(this).val()).draw();
    });
 
    // Filter controls
    $('#applyFilters').click(function() {
        table.ajax.reload(); // This will resend the request with updated filters
    });
 
    $('#resetFilters').click(function() {
        $('#titleFilter').val('');
        $('#statusFilter').val('');
        $('#clientFilter').val('');
        table.search('').draw();
        table.ajax.reload(); // Reload without filters
    });
    
    $('.btn-filter').click(function() {
        $('#filterBox').toggleClass('hidden');
    });
  });
    
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle filter box
    // const filterButton = document.querySelector('.btn-filter');
    // const filterBox = document.getElementById('filterBox');
    
    // if (filterButton && filterBox) {
    //     filterButton.addEventListener('click', function() {
    //         filterBox.classList.toggle('hidden');
    //         if (!filterBox.classList.contains('hidden')) {
    //             filterButton.innerHTML = '<i class="fa-solid fa-xmark"></i> Close Filter';
    //         } else {
    //             filterButton.innerHTML = '<i class="fa-solid fa-filter"></i> Filter';
    //         }
    //     });
    // }

    // Bulk actions
    const bulkActionSelect = document.querySelector('.bulk-action-select');
    if (bulkActionSelect) {
        bulkActionSelect.addEventListener('change', function() {
            const action = this.value;
            const checkedBoxes = document.querySelectorAll('.project-checkbox:checked');
            const projectIds = Array.from(checkedBoxes).map(cb => cb.value);
            
            if (action === 'delete' && projectIds.length > 0) {
                if (confirm('Are you sure you want to delete the selected projects?')) {
                    fetch('{{ route("dashboard.business.projects.bulkAction") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'X-HTTP-Method-Override': 'DELETE'
                        },
                        body: JSON.stringify({ ids: projectIds })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            window.location.reload();
                        } else {
                            alert('Error deleting projects: ' + (data.message || 'Unknown error'));
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error deleting projects');
                    });
                }
            }
            
            this.value = '';
        });
    }
});
</script>
@endsection
@endsection
=======
@use(\App\Domains\Entity\Enums\EntityEnum)
@extends('panel.layout.settings', ['layout' => 'fullwidth'])

@section('title', __('Projects Detail'))
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
<style>
    #dataTable tbody tr.even {
        background-color: #f9f9f9 !important; /* Light gray for even rows */
    }
    #dataTable tbody tr.odd {
        background-color: #ffffff !important; /* White for odd rows */
    }
    #dataTable_filter{
        display: none;
    }
    #dataTable_length{
        display: none;
    }
</style>
@endsection
@section('additional_css')
   
    <link href="{{ custom_theme_url('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('bussiness/custom.css') }}" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7692faf57e.js" crossorigin="anonymous"></script>
@endsection

@section('settings')
<div class="business-clients w-full">
<div class="controls">
    <form method="GET" action="{{ route('dashboard.business.projects.index') }}" class="flex items-center gap-8">
        <div class="left-controls" id="searchControls">
            <div class="bulk-actions">
                <select name="bulk_action" class="select-company bulk-action-select">
                    <option value="">Bulk Actions</option>
                    <option value="delete">Delete Selected</option>
                </select>
            </div>
            <input id="globalSearch" name="search" class="search" type="text" placeholder="Search by project title" 
                   value="{{ request('search') }}" onchange="this.form.submit()">
        </div>
        <div class="right-controls">
            <x-button variant="ghost" class="btn-filter"><i class="fa-solid fa-filter"></i> Filter</x-button>
            <x-button href="{{ route('dashboard.business.projects.create') }}" class="btn-create">
                <x-tabler-plus class="size-4 mr-1" />{{__('Create New') }} 
            </x-button>
        </div>
    </form>
</div>
<!--<div class="filter-fields {{ request()->has('client_id') || request()->has('status_id') || request()->has('title') ? '' : 'hidden' }}" id="filterBox">-->
<!--<div class="filter-fields hidden" id="filterBox">-->
<!--    <form method="GET" action="{{ route('dashboard.business.projects.index') }}">-->
<!--        <div class="form-row-inline">-->
<!--            <div class="form-group">-->
<!--                <label>Client</label>-->
<!--                <select name="client_id">-->
<!--                    <option value="">All Clients</option>-->
<!--                    @foreach($clients as $client)-->
<!--                    <option value="{{ $client->id }}" {{ request('client_id') == $client->id ? 'selected' : '' }}>-->
<!--                        {{ $client->first_name }} {{ $client->last_name }}-->
<!--                    </option>-->
<!--                    @endforeach-->
<!--                </select>-->
<!--            </div>-->
<!--            <div class="form-group">-->
<!--                <label>Status</label>-->
<!--                <select name="status_id">-->
<!--                    <option value="">All Statuses</option>-->
<!--                    <option value="1" {{ request('status_id') == '1' ? 'selected' : '' }}>Pending</option>-->
<!--                    <option value="2" {{ request('status_id') == '2' ? 'selected' : '' }}>In Progress</option>-->
<!--                    <option value="3" {{ request('status_id') == '3' ? 'selected' : '' }}>Completed</option>-->
<!--                </select>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="form-row-inline">-->
<!--            <div class="form-group">-->
<!--                <label>Project Title</label>-->
<!--                <input type="text" name="title" placeholder="Project Title" value="{{ request('title') }}">-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="filter-actions">-->
<!--            <x-button type="submit" class="btn-apply">Apply Filters</x-button>-->
<!--            <x-button href="{{ route('dashboard.business.projects.index') }}" class="btn-reset">Reset</x-button>-->
<!--        </div>-->
<!--    </form>-->
<!--</div>-->
<div class="filter-fields hidden" id="filterBox">
    <div class="form-row-inline">
        <div class="form-group">
            <label>Client</label>
            <select id="clientFilter">
                <option value="">All Clients</option>
                @foreach($clients as $client)
                <option value="{{ $client->id }}">
                    {{ $client->first_name }} {{ $client->last_name }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Status</label>
            <select id="statusFilter">
                <option value="">All Statuses</option>
                <option value="1">Pending</option>
                <option value="2">In Progress</option>
                <option value="3">Completed</option>
            </select>
        </div>
    </div>
    <div class="form-row-inline">
        <div class="form-group">
            <label>Project Title</label>
            <input type="text" id="titleFilter" placeholder="Project Title">
        </div>
    </div>
    <div class="filter-actions">
        <x-button type="button" id="applyFilters" class="btn-apply">Apply Filters</x-button>
        <x-button type="button" id="resetFilters" class="btn-reset">Reset</x-button>
    </div>
</div>
     <div class="table-responsive"> <!-- 🔄 Added wrapper -->
        <table id="dataTable">
            <thead>
                <tr>
                    <th><input type="checkbox" class="select-all"></th>
                    <th>Title</th>
                    <th>Client</th>
                    <th>Status</th>
                    <th>Budget</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
              
            </tbody>
        </table>
        <!--<div class="center-pagination">-->
        <!--{{ $projects->links('default.panel.business.pagination.custom') }}-->
        <!--</div>-->
    </div>
</div>
@section('additional_scripts')


<script>
  $(document).ready(function() {
    // Initialize DataTable
    var table = $('#dataTable').DataTable({
         
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('dashboard.business.projects.getProjectdata') }}",
            type: "POST",
            data: function(d) {
                // Add your filter parameters to the request
                d.title = $('#titleFilter').val();
                d.status = $('#statusFilter').val();
                d.client = $('#clientFilter').val();
                d._token = "{{ csrf_token() }}";
            }
        },
        columns: [
            {
                data: 'checkbox',
                name: 'checkbox',
                orderable: false,
                searchable: false,
                render: function(data, type, row) {
                    return `<input type="checkbox" class="project-checkbox" value="${row.id}">`;
                }
            },
            { data: 'title', name: 'title' },
            { data: 'client_name', name: 'client_name' },
            { data: 'status_id', name: 'status_id' },
            { data: 'budget', name: 'budget' },
            {
                data: 'actions',
                name: 'actions',
                orderable: false,
                searchable: false,
                render: function(data, type, row) {
                    return `
                        <div class="actions">
                            <a href="/dashboard/business/projects/${row.id}/edit" class="action-btn">
                                <i class="fa-solid fa-pencil fa-2xs"></i>
                            </a>
                            <form action="/dashboard/business/projects/${row.id}" method="POST" class="inline-form" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-btn">
                                    <i class="fa-solid fa-trash-can fa-2xs"></i>
                                </button>
                            </form>
                        </div>
                    `;
                }
            }
        ],
        // dom: '<"top"lf>rt<"bottom"ip>',
        // pageLength: 10,
        // lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
        // order: [[1, 'asc']], // Default order by title
        // stripeClasses: ['even', 'odd'] 
    });
    
    // Remove sorting class from first column (checkbox column)
    table.on('draw', function() {
        $('#dataTable td.sorting_1').removeClass('sorting_1');
    });
     // Remove 'even' and 'odd' classes from all rows
    $('#dataTable tbody tr').removeClass('even odd');
    
    // Global search
    $('#globalSearch').keyup(function() {
        table.search($(this).val()).draw();
    });
 
    // Filter controls
    $('#applyFilters').click(function() {
        table.ajax.reload(); // This will resend the request with updated filters
    });
 
    $('#resetFilters').click(function() {
        $('#titleFilter').val('');
        $('#statusFilter').val('');
        $('#clientFilter').val('');
        table.search('').draw();
        table.ajax.reload(); // Reload without filters
    });
    
    $('.btn-filter').click(function() {
        $('#filterBox').toggleClass('hidden');
    });
  });
    
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle filter box
    // const filterButton = document.querySelector('.btn-filter');
    // const filterBox = document.getElementById('filterBox');
    
    // if (filterButton && filterBox) {
    //     filterButton.addEventListener('click', function() {
    //         filterBox.classList.toggle('hidden');
    //         if (!filterBox.classList.contains('hidden')) {
    //             filterButton.innerHTML = '<i class="fa-solid fa-xmark"></i> Close Filter';
    //         } else {
    //             filterButton.innerHTML = '<i class="fa-solid fa-filter"></i> Filter';
    //         }
    //     });
    // }

    // Bulk actions
    const bulkActionSelect = document.querySelector('.bulk-action-select');
    if (bulkActionSelect) {
        bulkActionSelect.addEventListener('change', function() {
            const action = this.value;
            const checkedBoxes = document.querySelectorAll('.project-checkbox:checked');
            const projectIds = Array.from(checkedBoxes).map(cb => cb.value);
            
            if (action === 'delete' && projectIds.length > 0) {
                if (confirm('Are you sure you want to delete the selected projects?')) {
                    fetch('{{ route("dashboard.business.projects.bulkAction") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'X-HTTP-Method-Override': 'DELETE'
                        },
                        body: JSON.stringify({ ids: projectIds })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            window.location.reload();
                        } else {
                            alert('Error deleting projects: ' + (data.message || 'Unknown error'));
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error deleting projects');
                    });
                }
            }
            
            this.value = '';
        });
    }
});
</script>
@endsection
@endsection
>>>>>>> f4799b86f474e344473c5131907406fc349bf0dc
