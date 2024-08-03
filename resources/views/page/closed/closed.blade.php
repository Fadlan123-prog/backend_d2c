@extends('cashier.index')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <a href="{{ route('cashier.index')}}" class="btn bg-black">
                Back
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h3>Sales Summary</h3>
            <h4>Total Sales: {{ $totalSales }}</h4>
            <h4>Total Cash: {{ $totalCash }}</h4>
            <h4>Total Transfer: {{ $totalTransfer }}</h4>
            <h4>Total Tokopedia: {{ $totalTokopedia }}</h4>
            <h4>Total Expenses: {{ $totalExpenses }}</h4>
            <h4>Remaining Cash: {{ $remainingCash }}</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <h3>Sales by Category</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Category Name</th>
                        <th>Items Sold</th>
                        <th>Total Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($salesByCategory as $categorySale)
                        <tr>
                            <td>{{ $categorySale->category_name }}</td>
                            <td>{{ $categorySale->items_sold }}</td>
                            <td>{{ $categorySale->total_amount }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="col-md-6">
            <h3>Sales by Item</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Item Name</th>
                        <th>Items Sold</th>
                        <th>Total Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($salesByItem as $itemSale)
                        <tr>
                            <td>{{ $itemSale->items_name }}</td>
                            <td>{{ $itemSale->items_sold }}</td>
                            <td>{{ $itemSale->total_amount }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
