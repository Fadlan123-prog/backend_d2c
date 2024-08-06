<!DOCTYPE html>
<html>
<head>
    <title>Print Receipt</title>
    <style>
        .dashed-hr {
            border: none;
            border-top: 1px dashed #000;
            margin: 20px 0;
        }
        .receipt {
            max-width: 58mm;
            margin: auto;
            padding: 20px 10px;
            border: 1px solid #eee;
            border-radius: 10px;
            font-size: 12px;
        }
        .receipt-header {
            text-align: center;
            margin-bottom: 10px;
        }
        .receipt-header img {
            max-width: 100%;
            width: 100px;
        }
        .receipt-header h2 {
            font-size: 16px;
        }
        .receipt-header p {
            font-size: 10px;
        }
        .receipt-details {
            margin-bottom: 10px;
        }
        .receipt-details p {
            margin-bottom: 0;
            font-size: 10px;
        }
        .receipt-items span {
            font-size: 10px;
        }
        .receipt-items h5{
            margin: 0 !important;
        }
        .receipt-footer {
            text-align: center;
            margin-top: 20px;
            font-size: 10px;
        }
        .receipt-total span {
            font-size: 10px;
        }
        .table th, .table td {
            vertical-align: middle;
        }
    </style>
    </style>
</head>
<body>
    <div class="container">
        <div id="receipt" class="receipt">

                <div class="receipt-header">
                    <img src="{{ asset('assets/img/content/logo-receipt.png') }}" alt="logo">
                    <h2>Dirty 2 Clean Tanjung Barat</h2>
                    <p>Jl. Tanjung Barat No, 2B, Lenteng Agung, Jagakarsa, RT.5/RW.1, Jakarta Selatan</p>
                    <p>08521713106</p>
                </div>
                <div class="receipt-details">
                    <div class="row">
                        <div class="col-md-12">
                            <p>Tanggal : {{ $dateClosed }}</p>
                            <p>Jam : {{ $timeClosed }}</p>
                            <p>Kasir : {{ $cashierName }}</p>
                        </div>
                    </div>
                </div>

                <hr class="dashed-hr">



                <div class="receipt-items">
                    <h4>Total Qty Penjualan</h4>
                    @foreach ($salesByCategory as $categoryName => $items)
                        <div class="row">
                            <div class="col-md-12">
                                <h5>{{ $categoryName }}</h5>
                            </div>
                            <div class="col-md-12">
                                        @foreach ($items as $item)
                                            <div class="d-flex justify-content-between mb-0" style="display: flex; justify-content:space-between;">
                                                <span class="items-name mb-0">{{ $item->items_name }} {{$item->size_name ?? ''}}</span>
                                                <span class="items-price mb-0 text-right">{{ $item->items_sold }}</span>
                                            </div>
                                        @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

                <hr class="dashed-hr">



                <div class="receipt-items">
                    <h4>Total Penjualan</h4>
                    @foreach ($salesByCategory as $categoryName => $items)
                        <div class="row">
                            <div class="col-md-12">
                                <h5>{{ $categoryName }}</h5>
                            </div>
                            <div class="col-md-12">
                                        @foreach ($items as $item)
                                            <div class="d-flex justify-content-between mb-0" style="display: flex; justify-content:space-between;">
                                                <span class="items-name mb-0">{{ $item->items_name }}</span>
                                                <span class="items-price mb-0 text-right">{{ formatRupiah($item->total_amount) }}</span>
                                            </div>
                                        @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

                <hr class="dashed-hr">

                <div class="receipt-items">
                    <h4>Total Sales and Payment Methods</h4>
                    <div class="row">
                        <div class="col-md-12">
                            <span>Total Sales : {{ formatRupiah($totalSales) }}</span>
                        </div>
                        <div class="col-md-12">
                            <span>Total Cash : {{ formatRupiah($totalCash) }}</span>
                        </div>
                        <div class="col-md-12">
                            <span>Total Transfer : {{ formatRupiah($totalTransfer) }}</span>
                        </div>
                        <div class="col-md-12">
                            <span>Total Tokopedia : {{ formatRupiah($totalTokopedia) }}</span>
                        </div>
                        <div class="col-md-12">
                            <span>Total Payment Types : {{ formatRupiah($totalPaymentTypes) }}</span>
                        </div>
                    </div>
                </div>

                <hr class="dashed-hr">

                <div class="receipt-items">
                    <h4>Total Pengeluaran</h4>
                    @foreach ($expensesDetails as $expense)
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="d-flex justify-content-between mb-0" style="display: flex; justify-content:space-between;">
                                    <span class="items-name mb-0">{{ $expense['expend_name'] }}</span>
                                    <span class="items-price mb-0 text-right">{{ formatRupiah($expense['expend_price']) }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>

                <hr>

        <div class="receipt-items">
            <div class="d-flex justify-content-between mb-0">
                <span class="items-name mb-0">Sisa Penjualan Tunal :</span>
                <span class="items-price mb-0 text-right">{{ formatRupiah($remainingCash) }}</span>
            </div>
        </div>
    </div>
    {{--<div class="container">
        <div class="receipt-header">
            <img src="{{ asset('assets/img/content/logo-receipt.png') }}" alt="logo">
            <h2>Dirty 2 Clean Tanjung Barat</h2>
            <p>Jl. Tanjung Barat No, 2B, Lenteng Agung, Jagakarsa, RT.5/RW.1, Jakarta Selatan</p>
            <p>08521713106</p>
        </div>

        <div class="receipt-details">
            <div class="row">
                <div class="col-md-12">
                    <p>Tanggal : {{ $dateClosed }}</p>
                    <p>Jam : {{ $timeClosed }}</p>
                    <p>Kasir : {{ $cashierName }}</p>
                </div>
            </div>
        </div>

        <hr class="dashed-hr">

        <div class="receipt-items">
            @foreach ($salesByCategory as $sale)
                <div class="row">
                    <div class="col-md-12">
                        <p>{{ $sale->category_name }}</p>
                    </div>

                </div>
            @endforeach
        </div>

        <div class="section">
            <h2>Sales by Category</h2>
            <table class="table">
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
        <div class="section">
            <h2>Sales by Item</h2>
            <table class="table">
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
                        <td>{{ $sale->items_name }}</td>
                        <td>{{ $sale->items_sold }}</td>
                        <td>{{ formatRupiah($sale->total_amount) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="section">
            <h2>Total Sales and Payment Methods</h2>
            <table class="table">
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
        <div class="section">
            <h2>Expenses</h2>
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
            <p>Total Expenses: {{ formatRupiah($totalExpenses) }}</p>
        </div>
        <div class="section">
            <h2>Remaining Cash</h2>
            <p>{{ formatRupiah($remainingCash) }}</p>
        </div>
    </div> --}}

</body>

<script>
    function printReceipt() {
        var printWindow = window.open('', '', 'height=600,width=800');
        var receiptContent = document.getElementById('receipt').innerHTML;

        var cssStyles = `
            .dashed-hr {
                border: none;
                border-top: 1px dashed #000;
                margin: 20px 0;
            }
            .receipt {
                max-width: 58mm;
                margin: auto;
                padding: 20px 10px;
                border: 1px solid #eee;
                border-radius: 10px;
                font-size: 12px;
            }
            .receipt-header {
                text-align: center;
                margin-bottom: 10px;
            }
            .receipt-header img {
                max-width: 100%;
                width: 100px;
            }
            .receipt-header h2 {
                font-size: 16px;
            }
            .receipt-header p {
                font-size: 10px;
            }
            .receipt-details {
                margin-bottom: 10px;
            }
            .receipt-details p {
                margin-bottom: 0;
                font-size: 10px;
            }
            .receipt-items span {
                font-size: 10px;
            }
            .receipt-footer {
                text-align: center;
                margin-top: 20px;
                font-size: 10px;
            }
            .receipt-total span {
                font-size: 10px;
            }
            .table th, .table td {
                vertical-align: middle;
            }
        `;

        printWindow.document.write('<html><head><title>Receipt</title>');
        printWindow.document.write('<style>' + cssStyles + '</style>');
        printWindow.document.write('</head><body>');
        printWindow.document.write(receiptContent);
        printWindow.document.write('</body></html>');

        printWindow.document.close();
        printWindow.focus();
        printWindow.print();
    }
</script>
</html>
