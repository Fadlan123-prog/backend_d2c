@extends('cashier.index')

@section('content')
<h1>Tutup Kasir</h1>

<h2>Penjualan Berdasarkan Kategori</h2>
<table>
    <thead>
        <tr>
            <th>Kategori</th>
            <th>Total Penjualan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($salesByCategory as $sale)
            <tr>
                <td>{{ $sale->category_name }}</td>
                <td>{{ number_format($sale->total_amount, 2) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<h2>Penjualan Berdasarkan Item</h2>
<table>
    <thead>
        <tr>
            <th>Item</th>
            <th>Total Penjualan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($salesByItem as $sale)
            <tr>
                <td>{{ $sale->items_name }}</td>
                <td>{{ number_format($sale->total_amount, 2) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<h2>Total Penjualan</h2>
<p>{{ number_format($totalSales, 2) }}</p>

<h2>Perincian Tipe Pembayaran</h2>
<p>Cash: {{ number_format($totalCash, 2) }}</p>
<p>Transfer: {{ number_format($totalTransfer, 2) }}</p>
<p>Tokopedia: {{ number_format($totalTokopedia, 2) }}</p>
<p>Total: {{ number_format($totalPaymentTypes, 2) }}</p>

<h2>Pengeluaran</h2>
<table>
    <thead>
        <tr>
            <th>Nama Item</th>
            <th>Jumlah</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($expensesDetails as $expense)
            <tr>
                <td>{{ $expense['item_name'] }}</td>
                <td>{{ number_format($expense['amount'], 2) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<h2>Sisa Penjualan Tunai</h2>
<p>{{ number_format($remainingCash, 2) }}</p>
@endsection
