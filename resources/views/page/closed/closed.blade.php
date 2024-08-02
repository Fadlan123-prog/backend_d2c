@extends('cashier.index')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <a href="{{ route('cashier.index')}}" class="btn bg-black">
                    Back
                </a>
            </div>
        </div>
        <div class="container mt-5">
            <h1 class="text-center">Cashier Closing Report</h1>
            <p class="text-center">Date and Time: {{ $dateTime->format('Y-m-d H:i:s') }}</p>

            <hr class="dashed-hr">

            <!-- Total Sales by Category -->
            <h3>Total Sales by Category</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Total Sales</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($salesByCategory as $sale)
                        <tr>
                            <td>{{ $sale->category_name }}</td>
                            <td>{{ number_format($sale->total_amount, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <hr class="dashed-hr">

            <!-- Total Sales by Item -->
            <h3>Total Sales by Item</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Item Name</th>
                        <th>Total Sales</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($salesByItem as $sale)
                        <tr>
                            <td>{{ $sale->items_name }}</td>
                            <td>{{ number_format($sale->total_amount, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <hr class="dashed-hr">

            <!-- Total Sales and Payment Types -->
            <h3>Total Sales and Payment Types</h3>
            <div class="d-flex justify-content-between">
                <strong>Total Sales:</strong>
                <span>{{ number_format($totalSales, 0, ',', '.') }}</span>
            </div>
            <div class="d-flex justify-content-between">
                <strong>Total Cash Sales:</strong>
                <span>{{ number_format($totalCash, 0, ',', '.') }}</span>
            </div>
            <div class="d-flex justify-content-between">
                <strong>Total Transfer Sales:</strong>
                <span>{{ number_format($totalTransfer, 0, ',', '.') }}</span>
            </div>
            <div class="d-flex justify-content-between">
                <strong>Total Tokopedia Sales:</strong>
                <span>{{ number_format($totalTokopedia, 0, ',', '.') }}</span>
            </div>
            <div class="d-flex justify-content-between">
                <strong>Total Payment Types:</strong>
                <span>{{ number_format($totalPaymentTypes, 0, ',', '.') }}</span>
            </div>

            <hr class="dashed-hr">

            <!-- Expenses -->
            <h3>Expenses</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Item Name</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($expensesDetails as $expense)
                        <tr>
                            <td>{{ $expense['item_name'] }}</td>
                            <td>{{ number_format($expense['amount'], 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <hr class="dashed-hr">

            <!-- Remaining Cash -->
            <h3>Remaining Cash</h3>
            <div class="d-flex justify-content-between">
                <strong>Remaining Cash:</strong>
                <span>{{ number_format($remainingCash, 0, ',', '.') }}</span>
            </div>
        </div>


    </div>
@endsection
