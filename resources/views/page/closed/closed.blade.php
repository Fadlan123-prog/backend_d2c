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
    <hr>
    <div class="card">
        <div class="card-body">
            <h1>Close Sales</h1>

            <div class="row">
                <div class="col-lg-6">
                    <form method="GET" action="{{ route('cashier.close') }}">
                        <div class="form-group">
                            <label for="date">Select Date</label>
                            <input type="date" id="date" name="date" class="form-control" value="{{ old('date', $date ?? now()->format('Y-m-d')) }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </form>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">

                            <h2 class="text-center">Sales by Category</h2>
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th>Category</th>
                                        <th>Items Sold</th>
                                        <th>Total Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($salesByCategory as $sale)
                                    <tr>
                                        <td>{{ $sale->category_name }}</td>
                                        <td>{{ $sale->items_sold }}</td>
                                        <td>{{ formatRupiah($sale->total_amount) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">

                            <h2 class="text-center">Sales by Item</h2>
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th>Items Sold</th>
                                        <th>Total Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($salesByItem as $sale)
                                    <tr>
                                        <td>{{ $sale->items_name }} - {{ $sale->size_name ? $sale->size_name : '' }}</td>
                                        <td>{{ $sale->items_sold }}</td>
                                        <td>{{ formatRupiah($sale->total_amount) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="text-center">Total Sales and Payment Methods</h2>
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th>Total Sales</th>
                                        <th>Total Cash</th>
                                        <th>Total Transfer</th>
                                        <th>Total Tokopedia</th>
                                        <th>Total Payment Types</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ formatRupiah($totalSales) }}</td>
                                        <td>{{ formatRupiah($totalCash) }}</td>
                                        <td>{{ formatRupiah($totalTransfer) }}</td>
                                        <td>{{ formatRupiah($totalTokopedia) }}</td>
                                        <td>{{ formatRupiah($totalPaymentTypes) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-lg-6">

                    <div class="card">
                        <div class="card-body">
                            <h2 class="text-center">Total Expenses</h2>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Expense Name</th>
                                        <th>Expense Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($expensesDetails as $expense)
                                    <tr>
                                        <td>{{ $expense['expend_name'] }}</td>
                                        <td>{{ formatRupiah($expense['expend_price']) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="text-center">Remaining Cash</h2>
                            <p>{{ formatRupiah($remainingCash) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <hr>

            <button class="btn bg-black" id="print-receipt-btn">Print Receipt</button>

        </div>
    </div>
</div>

<script>
    document.getElementById('print-receipt-btn').addEventListener('click', function() {
    var date = "{{ $date }}";
    window.open('{{ url("/cashier/closed/print/") }}/' + date, '_blank');
});
</script>
@endsection
