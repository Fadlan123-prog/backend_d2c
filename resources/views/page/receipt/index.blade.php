<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Receipt</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
</head>
<body>

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
                <p>Tanggal : {{ $dateTime->format('Y-m-d') }}</p>
                <p>Jam : {{ $dateTime->format('H:i:s') }}</p>
                <p>Nomor Plat : {{ $sales->customer->plate_number }}</p>
                <p>Kasir : {{ Auth::user()->name }}</p>
            </div>
        </div>
    </div>

    <hr class="dashed-hr">

    <div class="receipt-items">
        <div class="row">
            <div class="col-md-12">
                @foreach ($sales->salesItems as $salesItem)
                    <div class="d-flex justify-content-between mb-0">
                        <span class="items-name mb-0">{{ $salesItem->item->items_name }} {{ $salesItem->size->size_name ?? '' }}</span>
                        <span class="items-price mb-0 text-right">{{ formatRupiah($salesItem->harga_items) }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <hr class="dashed-hr">

    <div class="receipt-total">
        <div class="d-flex justify-content-between">
            <span>Total :</span>
            <span>{{ formatRupiah($sales->total_price) }}</span>
        </div>
    </div>

    <hr class="dashed-hr">

    <div class="receipt-footer">
        <p>Powered by Dirty 2 Clean</p>
    </div>
</div>

<button onclick="printReceipt()">Print Receipt</button>

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

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

</body>
</html>
