@use(\App\Domains\Entity\Enums\EntityEnum)
@extends('panel.layout.settings', ['layout' => 'fullwidth'])

@section('title', isset($invoice) ? __('Edit Invoice') : __('Create New Invoice'))
@section('titlebar_actions', '')

@section('additional_css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="{{ asset('bussiness/custom-create.css') }}" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<script src="https://kit.fontawesome.com/7692faf57e.js" crossorigin="anonymous"></script>
<style>
    .btn-container {
        margin-top: auto;
        padding-top: 1.5rem;
        /*background: white;*/
        z-index: 10;
        position: sticky;
        bottom: 0;
    }
    .invoice-form input, .invoice-form select, .invoice-form textarea {
        height: 40px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 6px;
        background: #fff;
        box-sizing: border-box;
        font-size: 14px;
        color:#767d88;
    }
    .invoice-form textarea {
        height: auto;
    }
    .invoice-form .select2-container .select2-selection--single,
    .invoice-form .select2-container .select2-selection--multiple {
        height: 40px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 6px;
        background: #fff;
        box-sizing: border-box;
    }
    .invoice-form .select2-container--default .select2-selection--multiple .select2-selection__choice {
        margin-top: 4px;
    }
    /*.add-item-btn {*/
    /*    display: inline-flex;*/
    /*    align-items: center;*/
    /*    padding: 10px 16px;*/
    /*    font-size: 14px;*/
    /*    font-weight: 500;*/
    /*    color: white;*/
        /*background-color: #4f46e5;*/
    /*    border: 1px solid white;*/
    /*    border-radius: 20px;*/
    /*    transition: background-color 0.2s;*/
    /*}*/
    /*.add-item-btn:hover {*/
    /*    background-color: #6EE7B7;*/
    /*}*/
    /*.add-item-btn:focus {*/
    /*    outline: none;*/
    /*    box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.5);*/
    /*}*/
    /* Default (light mode) */
.add-item-btn {
    background-color: #1C2A39;      /* navy background */
    color: #ffffff;                 /* white text */
    border: 1px solid #1C2A39;      /* navy border */
    border-radius: 8px;
    padding: 8px 16px;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
}

/* Hover in light mode */
.add-item-btn:hover {
    background-color: #6EE7B7;      /* mint hover background */
    color: #1C2A39;                 /* navy text */
    border-color: #6EE7B7;
}

/* Dark mode */
body.theme-dark .add-item-btn {
    background-color: #171B21;      /* mint background */
    color: #ffffff;                 /* navy text */
    border: 1px solid #6EE7B7;
}

/* Hover in dark mode */
body.theme-dark .add-item-btn:hover {
    background-color: #47D7A1;      /* darker mint */
    border-color: #47D7A1;
}

    .table-container {
        margin-top: 1.5rem;
        padding-bottom: 1rem;
    }
</style>
@endsection

@section('settings')
    <div class="business-invoices w-full">
        <form method="POST" 
              action="{{ isset($invoice) ? route('dashboard.business.invoices.update', $invoice->id) : route('dashboard.business.invoices.store') }}" 
              enctype="multipart/form-data" 
              class="invoice-form space-y-6">
            @csrf
            @if(isset($invoice))
                @method('PUT')
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Invoice Date Field --}}
                <div>
                    <label for="invoice_date" class="block text-sm dark:text-white font-medium text-gray-700 required">Invoice Date</label>
                    <input type="date" id="invoice_date" name="invoice_date"
                           value="{{ old('invoice_date', $invoice->invoice_date ?? date('Y-m-d')) }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                           required>
                           @error('invoice_date')
                           <span class="text-sm block mt-1 text-red-500">{{$message}}</span>
                           @enderror
                </div>

                {{-- Due Date Field --}}
                <div>
                    <label for="due_date" class="block text-sm dark:text-white font-medium text-gray-700">Due Date</label>
                    <input type="date" id="due_date" name="due_date"
                           value="{{ old('due_date', $invoice->due_date ?? '') }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('due_date')
                           <span class="text-sm block mt-1 text-red-500">{{$message}}</span>
                           @enderror
                </div>

                {{-- Client Field --}}
                <div>
                    <label for="client_id" class="block text-sm dark:text-white font-medium text-gray-700 required">Client</label>
                    <select id="client_id" name="client_id"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            required>
                        <option value="">Select Client</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}" {{ old('client_id', $invoice->client_id ?? '') == $client->id ? 'selected' : '' }}>
                                {{ $client->first_name }} {{ $client->last_name }}
                            </option>
                        @endforeach
                    </select>
                     @error('client_id')
                           <span class="text-sm block mt-1 text-red-500">{{$message}}</span>
                           @enderror
                </div>

                {{-- Project Field --}}
                <div>
                    <label for="project_id" class="block text-sm dark:text-white font-medium text-gray-700">Project</label>
                    <select id="project_id" name="project_id[]" multiple
                            class="select2 mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Select Project</option>
                        @foreach($projects as $project)
                            <option value="{{ $project->id }}" 
                                    {{ in_array($project->id, old('project_id', $selectedProjects ?? [])) ? 'selected' : '' }}>
                                {{ $project->title }}
                            </option>
                        @endforeach
                    </select>
                     @error('project_id')
                           <span class="text-sm block mt-1 text-red-500">{{$message}}</span>
                           @enderror
                </div>

                {{-- Tax Field --}}
                <div>
                    <label for="tax_id" class="block text-sm dark:text-white font-medium text-gray-700">Tax</label>
                    <select id="tax_id" name="tax_id[]" multiple
                            class="select2 mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Select Tax</option>
                        @foreach($taxes as $tax)
                            <option value="{{ $tax->id }}" 
                                    {{ in_array($tax->id, old('tax_id', $selectedTaxes ?? [])) ? 'selected' : '' }}>
                                {{ $tax->name }} ({{ $tax->rate }}%)
                            </option>
                        @endforeach
                    </select>
                     @error('tax_id')
                           <span class="text-sm block mt-1 text-red-500">{{$message}}</span>
                           @enderror
                </div>

                {{-- Status Field --}}
                <div>
                    <label for="status" class="block text-sm dark:text-white font-medium text-gray-700 required">Status</label>
                    <select id="status" name="status"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            required>
                        <option value="">Select Status</option>
                        <option value="draft" {{ old('status', $invoice->status ?? '') == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="sent" {{ old('status', $invoice->status ?? '') == 'sent' ? 'selected' : '' }}>Sent</option>
                        <option value="paid" {{ old('status', $invoice->status ?? '') == 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="cancelled" {{ old('status', $invoice->status ?? '') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                     @error('status')
                           <span class="text-sm block mt-1 text-red-500">{{$message}}</span>
                           @enderror
                </div>

                {{-- Description Field --}}
                <div class="md:col-span-2">
                    <label for="description" class="block text-sm dark:text-white font-medium text-gray-700">Description</label>
                    <textarea id="description" name="description"
                              placeholder="Enter Description"
                              rows="4"
                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $invoice->description ?? '') }}</textarea>
                               @error('description')
                           <span class="text-sm block mt-1 text-red-500">{{$message}}</span>
                           @enderror
                </div>
            </div>

            {{-- Invoice Items Section --}}
            <div class="table-container">
                <h3 class="text-lg font-medium text-gray-900">Invoice Items</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Item Name</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Unit Price</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subtotal</th>
                                <th scope="col" class="relative px-6 py-3"><span class="sr-only">Remove</span></th>
                            </tr>
                        </thead>
                        <tbody id="invoice-items-container" class=" divide-y divide-gray-200">
                            @if(isset($invoice) && $invoice->items->count() > 0)
                                @foreach($invoice->items as $item)
                                    <tr class="invoice-item-row">
                                        <input type="hidden" name="items[{{ $loop->index }}][id]" value="{{ $item->id }}">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <input type="text" name="items[{{ $loop->index }}][item_name]" id="item_name_{{ $loop->index }}"
                                                   value="{{ old('items.' . $loop->index . '.item_name', $item->item_name) }}"
                                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                                   required>
                                                    @error('items')
                           <span class="text-sm block mt-1 text-red-500">{{$message}}</span>
                           @enderror
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <input type="number" name="items[{{ $loop->index }}][quantity]" id="quantity_{{ $loop->index }}"
                                                   value="{{ old('items.' . $loop->index . '.quantity', $item->quantity) }}"
                                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 item-quantity"
                                                   min="1" required>
                                                    @error('items')
                           <span class="text-sm block mt-1 text-red-500">{{$message}}</span>
                           @enderror
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <input type="number" step="0.01" name="items[{{ $loop->index }}][unit_price]" id="unit_price_{{ $loop->index }}"
                                                   value="{{ old('items.' . $loop->index . '.unit_price', $item->unit_price) }}"
                                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 item-unit-price"
                                                   min="0" required>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <input type="text" id="subtotal_{{ $loop->index }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 item-subtotal" readonly>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <button type="button" class="remove-item-row text-red-600 hover:text-red-900">
                                                Remove
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="invoice-item-row">
                                    <input type="hidden" name="items[0][id]" value="">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <input type="text" name="items[0][item_name]" id="item_name_0"
                                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                               required>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <input type="number" name="items[0][quantity]" id="quantity_0"
                                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 item-quantity"
                                               min="1" required>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <input type="number" step="0.01" name="items[0][unit_price]" id="unit_price_0"
                                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 item-unit-price"
                                               min="0" required>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <input type="text" id="subtotal_0" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 item-subtotal" readonly>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <button type="button" class="remove-item-row text-red-600 hover:text-red-900">
                                            Remove
                                        </button>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    <button type="button" id="add-item-row" class="add-item-btn">
                        Add Item
                    </button>
                </div>

                <div class="flex justify-end mt-4">
                    <div class="text-lg font-bold text-gray-900">Total Amount: <span id="total-amount">0.00</span></div>
                </div>
            </div>

            {{-- Email and Notification Checkbox --}}
            <div class="flex items-center mt-4">
                <input id="send_notification" name="send_notification" type="checkbox" 
                       class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"
                       {{ old('send_notification') ? 'checked' : '' }}>
                <label for="send_notification" class="ml-2 block text-sm text-gray-700">
                    Send email and notification to client
                </label>
            </div>

            {{-- Submit Button --}}
            <div class="btn-container">
                <button type="submit" class="submit-btn">
                    {{ isset($invoice) ? 'Update' : 'Continue' }} 
                </button>
            </div>
        </form>
    </div>
@endsection

@section('additional_scripts')
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();

        // Pass tax data to JavaScript
        const taxesData = @json($taxes->mapWithKeys(fn($tax) => [$tax->id => $tax->rate]));

        let itemIndex = {{ isset($invoice) ? $invoice->items->count() : 1 }};

        function calculateRowSubtotal(row) {
            const quantity = parseFloat(row.find('.item-quantity').val()) || 0;
            const unitPrice = parseFloat(row.find('.item-unit-price').val()) || 0;
            const subtotal = quantity * unitPrice;
            row.find('.item-subtotal').val(subtotal.toFixed(2));
            return subtotal;
        }

        function calculateTotalAmount() {
            let totalAmount = 0;
            $('.invoice-item-row').each(function() {
                totalAmount += calculateRowSubtotal($(this));
            });

            let totalTaxAmount = 0;
            const selectedTaxIds = $('#tax_id').val();
            if (selectedTaxIds) {
                selectedTaxIds.forEach(function(taxId) {
                    const taxRate = taxesData[taxId];
                    if (taxRate) {
                        totalTaxAmount += (totalAmount * taxRate) / 100;
                    }
                });
            }

            totalAmount += totalTaxAmount;
            $('#total-amount').text(totalAmount.toFixed(2));
        }

        // Initial calculation for existing items on edit page load
        calculateTotalAmount();

        $('#add-item-row').on('click', function() {
            const newItemRow = `
                <tr class="invoice-item-row">
                    <input type="hidden" name="items[${itemIndex}][id]" value="">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <input type="text" name="items[${itemIndex}][item_name]" id="item_name_${itemIndex}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                               required>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <input type="number" name="items[${itemIndex}][quantity]" id="quantity_${itemIndex}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 item-quantity"
                               min="1" required>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <input type="number" step="0.01" name="items[${itemIndex}][unit_price]" id="unit_price_${itemIndex}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 item-unit-price"
                               min="0" required>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <input type="text" id="subtotal_${itemIndex}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 item-subtotal" readonly>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <button type="button" class="remove-item-row text-red-600 hover:text-red-900">
                            Remove
                        </button>
                    </td>
                </tr>
            `;
            $('#invoice-items-container').append(newItemRow);
            itemIndex++;
            calculateTotalAmount();
        });

        $('#invoice-items-container').on('input', '.item-quantity, .item-unit-price', function() {
            calculateTotalAmount();
        });

        $('#invoice-items-container').on('click', '.remove-item-row', function() {
            $(this).closest('.invoice-item-row').remove();
            calculateTotalAmount();
        });

        // Prevent double submission
        $('.invoice-form').on('submit', function() {
            const submitButton = $(this).find('.submit-btn');
            submitButton.prop('disabled', true);
            submitButton.text('Processing...'); // Optional: Change button text
        });
    });
</script>
@endsection