@extends('panel.layout.settings', ['layout' => 'fullwidth'])

@section('title', __('Analytics'))
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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.css">
    <script src="https://kit.fontawesome.com/7692faf57e.js" crossorigin="anonymous"></script>
    <style>
        .financial-card {
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .income-card {
            background-color: #f0fdf4;
            border-left: 4px solid #10b981;
        }
        .expense-card {
            background-color: #fff1f2;
            border-left: 4px solid #ef4444;
        }
        .balance-card {
            background-color: #eff6ff;
            border-left: 4px solid #3b82f6;
        }
        .financial-value {
            font-size: 24px;
            font-weight: 700;
            margin: 10px 0;
        }
        .chart-container {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .transaction-table {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .month-selector {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .month-title {
            font-size: 20px;
            font-weight: 600;
        }
        .transaction-row {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #eee;
        }
        .transaction-row:last-child {
            border-bottom: none;
        }
        .transaction-amount.income {
            color: #10b981;
            font-weight: 600;
        }
        .transaction-amount.expense {
            color: #ef4444;
            font-weight: 600;
        }
        .transaction-badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
        }
        .badge-income {
            background-color: #dcfce7;
            color: #166534;
        }
        .badge-expense {
            background-color: #fee2e2;
            color: #991b1b;
        }
    </style>
@endsection

@section('settings')
    <div class="business-bookkeeping w-full">
        <div class="month-selector">
            <h2 class="month-title">{{ now()->format('F Y') }}</h2>
            <div>
                <select id="month-select" class="form-select" disabled>
                    <option selected>{{ now()->format('F Y') }}</option>
                    <option>{{ now()->subMonth()->format('F Y') }}</option>
                    <option>{{ now()->subMonths(2)->format('F Y') }}</option>
                </select>
            </div>
        </div>

        <div class="row">
             @php
                 $userId = auth()->user()->id;
            @endphp
            
            @if (isset($analytics) && $analytics->user_id === $userId)

                <div class="col-md-4">
                    <div class="financial-card income-card">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-money-bill-wave text-success me-2"></i>
                            <h5 class="mb-0">{{ __('Income') }}</h5>
                        </div>
                        <div class="financial-value">
                            ${{ number_format($analytics->income ?? 0, 2) }}
                        </div>
                        <small class="text-muted">{{ __('Total income this month') }}</small>
                    </div>
                </div>
            @endif

            <div class="col-md-4">
                <div class="financial-card expense-card">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-shopping-cart text-danger me-2"></i>
                        <h5 class="mb-0">{{ __('Expenses') }}</h5>
                    </div>
                    <div class="financial-value">$0</div>
                    <small class="text-muted">{{ __('Total expenses this month') }}</small>
                </div>
            </div>
            <div class="col-md-4">
                <div class="financial-card balance-card">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-wallet text-primary me-2"></i>
                        <h5 class="mb-0">{{ __('Balance') }}</h5>
                    </div>
                    <div class="financial-value">$0</div>
                    <small class="text-muted">{{ __('Net balance this month') }}</small>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="chart-container">
                    <h5 class="mb-3">{{ __('Income vs Expenses - Last 6 Months') }}</h5>
                    <canvas id="financialChart" height="300"></canvas>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="transaction-table">
                    <h5 class="mb-3">{{ __('Recent Transactions') }}</h5>
                    <div class="transactions-list">
                        <div class="transaction-row">
                            <div>
                                <div class="fw-bold">Website Design Project</div>
                                <small class="text-muted">15 {{ now()->format('M Y') }} • Client Payment</small>
                            </div>
                            <div>
                                <span class="transaction-badge badge-income">Income</span>
                                <div class="transaction-amount income">+$2,500.00</div>
                            </div>
                        </div>
                        <div class="transaction-row">
                            <div>
                                <div class="fw-bold">Office Rent</div>
                                <small class="text-muted">10 {{ now()->format('M Y') }} • Rent</small>
                            </div>
                            <div>
                                <span class="transaction-badge badge-expense">Expense</span>
                                <div class="transaction-amount expense">-$1,200.00</div>
                            </div>
                        </div>
                        <div class="transaction-row">
                            <div>
                                <div class="fw-bold">Marketing Campaign</div>
                                <small class="text-muted">05 {{ now()->format('M Y') }} • Advertising</small>
                            </div>
                            <div>
                                <span class="transaction-badge badge-expense">Expense</span>
                                <div class="transaction-amount expense">-$850.50</div>
                            </div>
                        </div>
                        <div class="transaction-row">
                            <div>
                                <div class="fw-bold">SEO Services</div>
                                <small class="text-muted">01 {{ now()->format('M Y') }} • Client Payment</small>
                            </div>
                            <div>
                                <span class="transaction-badge badge-income">Income</span>
                                <div class="transaction-amount income">+$1,750.00</div>
                            </div>
                        </div>
                        <div class="transaction-row">
                            <div>
                                <div class="fw-bold">Software Subscription</div>
                                <small class="text-muted">28 {{ now()->subMonth()->format('M Y') }} • Tools</small>
                            </div>
                            <div>
                                <span class="transaction-badge badge-expense">Expense</span>
                                <div class="transaction-amount expense">-$730.00</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('additional_scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Static chart data
            const months = [
                '{{ now()->subMonths(5)->format("M") }}',
                '{{ now()->subMonths(4)->format("M") }}',
                '{{ now()->subMonths(3)->format("M") }}',
                '{{ now()->subMonths(2)->format("M") }}',
                '{{ now()->subMonth()->format("M") }}',
                '{{ now()->format("M") }}'
            ];
            
            const incomeData = [3200, 2900, 4100, 3800, 3950, 4250];
            const expenseData = [2100, 2400, 2950, 2700, 3100, 2780];
            
            // Initialize Chart
            const ctx = document.getElementById('financialChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: months,
                    datasets: [
                        {
                            label: 'Income',
                            data: incomeData,
                            backgroundColor: '#10b981',
                            borderRadius: 4
                        },
                        {
                            label: 'Expenses',
                            data: expenseData,
                            backgroundColor: '#ef4444',
                            borderRadius: 4
                        }
                    ]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return context.dataset.label + ': $' + context.raw.toLocaleString();
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return '$' + value.toLocaleString();
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection