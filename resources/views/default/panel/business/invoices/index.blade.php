@use(\App\Domains\Entity\Enums\EntityEnum)
@extends('panel.layout.settings', ['layout' => 'fullwidth'])

@section('title', __('Invoices'))
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>
  
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
        .badge-draft { background-color: #e5e7eb; color: #374151; }
        .badge-sent { background-color: #dbeafe; color: #1e40af; }
        .badge-paid { background-color: #dcfce7; color: #166534; }
        .badge-cancelled { background-color: #fee2e2; color: #991b1b; }
        .badge-project { background-color: #ede9fe; color: #5b21b6; }
        .badge-tax { background-color: #fef3c7; color: #92400e; }
    </style>
@endsection

@section('settings')
<div class="business-clients w-full">
    <div class="controls">
        <form method="GET" action="{{ route('dashboard.business.invoices.index') }}" class="flex items-center gap-8">
            <div class="left-controls" id="searchControls">
               <div class="bulk-actions">
                    <select name="bulk_action" class="select-company bulk-action-select">
                        <option value="">Bulk Actions</option>
                        <option value="delete">Delete Selected</option>
                    </select>
                </div>
                <input name="search" class="search" type="text" placeholder="Search by name" 
                       value="{{ request('search') }}" onchange="this.form.submit()">
            </div>
            <div class="right-controls">
                <!--<x-button type="button" variant="ghost" class="btn-container" style="border: 1px solid #1C2A39;" id="btn-pdf">-->
                <!--    <i class="fa-solid fa-file-pdf mr-1"></i> PDF-->
                <!--</x-button>-->

                <x-button variant="ghost" class="btn-filter"><i class="fa-solid fa-filter"></i> Filter</x-button>
                <x-button href="{{ route('dashboard.business.invoices.create') }}" class="btn-create">
                <x-tabler-plus class="size-4 mr-1" />{{__('Create New') }}
             </x-button>
            </div>
        </form>
    </div>
    <div class="filter-fields hidden" id="filterBox">
    <form method="GET" action="{{ route('dashboard.business.invoices.index') }}">
        <div class="form-row-inline">
            <div class="form-group">
                <label>Company Name</label>
                <select name="user_id">
                    <option value="">All Client</option>
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}" {{ request('user_id') ==  $client->id ? 'selected' : '' }}>{{ $client->first_name }} {{ $client->last_name }}</option>
                    @endforeach
                </select>
            </div>
              <div class="form-group">
                <label>Company Name</label>
                <select name="status">
                        <option value="">Select Status</option>
                        <option value="draft" {{ request('status')  == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="sent" {{ request('status') == 'sent' ? 'selected' : '' }}>Sent</option>
                        <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>
        </div>
         <div class="form-row-inline">
            <div class="form-group">
                <label for="invoice_date">Invoice Date</label>
                <input type="date" id="invoice_date" name="invoice_date"
                    value="{{ request('invoice_date') }}">
            </div>
            <div class="form-group">
                <label for="due_date">Due Date</label>
                <input type="date" id="due_date" name="due_date"
                    value="{{ request('due_date') }}">
            </div>
        </div>
        <div class="filter-actions">
            <x-button type="submit" class="btn-apply">Apply Filters</x-button>
            <x-button href="{{ route('dashboard.business.invoices.index') }}" class="btn-reset">Reset</x-button>
        </div>
    </form>
</div>
     <div class="table-responsive"> <!-- 🔄 Added wrapper -->
        <table id="dataTable">
            <thead>
                <tr>
                    <th><input type="checkbox" class="select-all"></th>
                    <th>Invoice #</th>
                    <th>Client</th>
                    <th>Date</th>
                    <th>Due Date</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
               
            </tbody>
        </table>
        <!--<div class="center-pagination">-->
    </div>
</div>
@section('additional_scripts')


<script>
    async function generatePDF(invoiceId) {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        try {
            const response = await fetch(`/dashboard/business/invoices/${invoiceId}/data`);
            const data = await response.json();

            const invoice = data.invoice;
            const items = data.items;

            doc.setFontSize(16);
            doc.text(`Invoice #${invoice.id}`, 14, 20);

            // ===== Invoice Info Table =====
            doc.autoTable({
                startY: 28,
                head: [['Field', 'Value']],
                body: [
                    ['Client ID', invoice.client_id],
                    ['Invoice Date', invoice.invoice_date],
                    ['Due Date', invoice.due_date],
                    ['Status', invoice.status],
                    ['Amount', `$${invoice.amount}`],
                    ['Description', invoice.description || ''],
                    // ['Note', invoice.note || ''],
                ],
                styles: { halign: 'left' },
                theme: 'grid',
            });

            // ===== Items Table =====
            const finalY = doc.lastAutoTable.finalY + 10;

            doc.autoTable({
                startY: finalY,
                head: [['Item Name', 'Quantity', 'Unit Price', 'Subtotal']],
                body: items.map(item => [
                    item.item_name,
                    item.quantity,
                    `$${item.unit_price}`,
                    `$${item.subtotal}`
                ]),
                theme: 'striped',
            });

            doc.save(`invoice_${invoice.id}.pdf`);
        } catch (error) {
            console.error("PDF generation error:", error);
            alert("Failed to generate PDF. Try again.");
        }
    }
</script>


<script>
    $(document).ready(function () {
    var table = $('#dataTable').DataTable({
        responsive:true,
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('dashboard.business.invoices.getinvoicesdata') }}",
            type: "POST",
            data: function (d) {
                d._token = "{{ csrf_token() }}";
                d.client = $('#clientFilter').val();
                d.status = $('#statusFilter').val();
            }
        },
        columns: [
            {
                data: 'checkbox',
                name: 'checkbox',
                orderable: true,
                searchable: true,
                render: function(data, type, row) {
                    return '<input type="checkbox" class="invoice-checkbox" value="' + row.id + '">';
                }
            },
          { data:'client_id', name: 'id' },
            { data: 'client_name', name: 'client_name' },// <-- show client name here
            { data: 'invoice_date', name: 'invoice_date' },
            { data: 'due_date', name: 'due_date' },
            { data: 'amount', name: 'amount' },
            { data: 'status', name: 'status' },
            // { data: 'note', name: 'note' },
            {
                data: 'actions',
                name: 'actions',
                orderable: true,
                searchable: true,
                render: function(data, type, row) {
                    return `
                        <div class="actions">
                           <x-button type="button" variant="ghost" class="btn-container" style="border: 1px solid #1C2A39;" onclick="generatePDF(${row.id})">
                                <i class="fa-solid fa-file-pdf mr-1"></i> PDF
                           </x-button>
                           
                            <x-button href="/dashboard/business/invoices/${row.id}/edit" class="action-btn">
                                <i class="fa-solid fa-pencil fa-2xs"></i>
                            </x-button>
                            <form action="/dashboard/business/invoices/${row.id}" method="POST" class="inline-form">
                                @csrf
                                @method('DELETE')
                                <x-button type="submit" class="action-btn" onclick="return confirm('Are you sure?')">
                                    <i class="fa-solid fa-trash-can fa-2xs"></i>
                                </x-button>
                            </form>
                        </div>`;
                }
            }
        ],
        order: [[3, 'desc']]
    });
    table.on('draw', function() {
        $('#dataTable td.sorting_1').removeClass('sorting_1');
    });
    // Global search
    $('#globalSearch').keyup(function () {
        table.search($(this).val()).draw();
    });
 
    // Filter
    $('#applyFilters').click(function () {
        table.draw();
    });
 
    $('#resetFilters').click(function () {
        $('#clientFilter').val('');
        $('#statusFilter').val('');
        table.search('').draw();
    });
 
    // Select All
    $('#selectAll').change(function () {
        $('.invoice-checkbox').prop('checked', $(this).prop('checked'));
    });
 
    // Bulk delete
    $('.bulk-action-select').change(function () {
        const action = $(this).val();
        const selectedIds = $('.invoice-checkbox:checked').map(function () {
            return $(this).val();
        }).get();
 
        if (action === 'delete' && selectedIds.length > 0) {
            if (confirm('Are you sure you want to delete selected invoices?')) {
                $.ajax({
                    url: "{{ route('dashboard.business.invoices.bulkAction') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        ids: selectedIds,
                        _method: "DELETE"
                    },
                    success: function (response) {
                        if (response.success) {
                            table.draw();
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function () {
                        alert('Error deleting invoices');
                    }
                });
            }
        }
 
        $(this).val('');
    });
});
    // $(document).ready(function() {
    //     $('#dataTable').DataTable({
    //         responsive: true,
    //         columnDefs: [
    //             { orderable: false, targets: [0, -1] } // 0 = checkbox column, -1 = last column (usually actions)
    //         ],
    //         drawCallback: function(settings) {
    //             $('#dataTable tbody tr').each(function() {
    //                 if (!$(this).next().hasClass('extra-row')) {
    //                     $('<tr class="extra-row"><td colspan="100%"><hr></td></tr>').insertAfter(this);
    //                 }
    //             });
    //         },
    //         initComplete: function() {
    //             // Remove class from first th in thead
    //             $('#dataTable thead tr th:first').removeClass();
    //         }
    //     });

    //     // Select All Checkboxes
    //     $('.select-all').on('click', function() {
    //         $('.client-checkbox').prop('checked', this.checked);
    //     });
    // });
</script>
<script>
    $('#btn-pdf').on('click', function () {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    // Extract table headers and rows manually, excluding "Actions"
    const headers = [];
    $('#dataTable thead th').each(function(index) {
        if (index !== 7) { // Skip the 8th column (Actions)
            headers.push($(this).text().trim());
        }
    });

    const data = [];
    $('#dataTable tbody tr').each(function () {
        const row = [];
        $(this).find('td').each(function (index) {
            if (index !== 7) { // Skip the Actions column
                row.push($(this).text().trim());
            }
        });
        data.push(row);
    });

    doc.setFontSize(18);
    doc.setFont(undefined, 'bold'); // Make it bold
    doc.text('Invoice Report', 80, 10); // Center-ish title

    doc.autoTable({
        head: [headers],
        body: data,
        startY: 20, // Leave space for title
        theme: 'grid',
        headStyles: { fillColor: [22, 160, 133] }
    });

    doc.save('invoices.pdf');
});

</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterButton = document.querySelector('.btn-filter');
    const filterBox = document.getElementById('filterBox');
    const form = filterBox.querySelector('form');
    const inputs = form.querySelectorAll('input, select');

    filterButton.addEventListener('click', function() {
        filterBox.classList.toggle('hidden');
        if (!filterBox.classList.contains('hidden')) {
            filterButton.innerHTML = '<i class="fa-solid fa-xmark"></i> Close Filter';
        } else {
            filterButton.innerHTML = '<i class="fa-solid fa-filter"></i> Filter';
        }
    });

    form.addEventListener('submit', function() {
        // Check if all inputs are empty
        let allEmpty = true;
        inputs.forEach(input => {
            if (input.value.trim() !== '') {
                allEmpty = false;
            }
        });

        // If all inputs are empty, add hidden class after form submission
        if (allEmpty) {
            filterBox.classList.add('hidden');
        }
    });

    // Reset button handling
    const resetButton = form.querySelector('.btn-reset');
    resetButton.addEventListener('click', function() {
        filterBox.classList.add('hidden');
    });
});
 </script>
 <script>
document.addEventListener('DOMContentLoaded', function() {
    // Select all checkbox functionality
    const selectAll = document.querySelector('.select-all');
    const clientCheckboxes = document.querySelectorAll('.client-checkbox');
    const bulkActionSelect = document.querySelector('.bulk-action-select');
    
    selectAll.addEventListener('change', function() {
        clientCheckboxes.forEach(checkbox => {
            checkbox.checked = selectAll.checked;
        });
    });
    
    // Individual checkbox functionality
    clientCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            // If all checkboxes are checked, check the select-all checkbox
            const allChecked = Array.from(clientCheckboxes).every(cb => cb.checked);
            selectAll.checked = allChecked;
        });
    });
    
    // Bulk action handler - immediate action on select
    bulkActionSelect.addEventListener('change', function() {
        const action = this.value;
        const checkedBoxes = document.querySelectorAll('.client-checkbox:checked');
        const clientIds = Array.from(checkedBoxes).map(cb => cb.value);
        
        if (action === 'delete' && clientIds.length > 0) {
            if (confirm('Are you sure you want to delete the selected Invoice?')) {
                // Send AJAX request to delete multiple clients
                fetch('{{ route("dashboard.business.invoices.bulkAction") }}', {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ ids: clientIds })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.reload();
                    } else {
                        alert('Error deleting Invoice');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error deleting Invoice');
                });
            }
        }
        
        // Reset the dropdown after action
        this.value = '';
    });
});
</script>
@endsection
@endsection
