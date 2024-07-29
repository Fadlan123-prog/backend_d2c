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
                <p>Tanggal : {{ $sale->date }}</p>
                <p>Jam : {{ $sale->time }}</p>
                <p>Nomor Plat : {{ $sale->plate_number }}</p>
                <p>Kasir : {{ $sale->cashier_name }}</p>
            </div>
        </div>
    </div>

    <hr class="dashed-hr">

    <div class="receipt-items">
        <div class="row">
            <div class="col-md-12">
                <div id="selected-item"></div>
            </div>
            <!-- Items will be injected here by JavaScript -->
        </div>
    </div>

    <hr class="dashed-hr">

    <div class="receipt-total">
        <div class="d-flex justify-content-between">
            <span>Total :</span>
            <span>{{ formatRupiah($sale->total_price) }}</span>
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
    $(document).ready(function() {
        // Get item names and prices from Blade variables and process them
        var itemNamesString = "{{ $sale->item_name }}";
        var itemPricesString = "{{ $sale->item_price }}";

        // Handle escaping manually if needed
        var itemNames = itemNamesString.split(',')
            .map(function(item) { return item.replace(/^\s*"\s*|\s*"\s*$/g, '').trim(); });
        var itemPrices = itemPricesString.split(',')
            .map(function(price) { return price.replace(/^\s*"\s*|\s*"\s*$/g, '').trim(); });

        var $transactionDetails = $('#selected-item');
        if ($transactionDetails.length) {
            var itemsListHtml = '';
            if (itemNames.length > 0) {
                $.each(itemNames, function(index, name) {
                    var price = itemPrices[index] || '';
                    itemsListHtml += `
                        <div class="d-flex justify-content-between mb-0">
                            <span class="items-name mb-0">${name}</span>
                            <span class="items-price mb-0 text-right">${price}</span>
                        </div>
                    `;
                });
            } else {
                itemsListHtml = '<p>No items found.</p>';
            }
            $transactionDetails.html(itemsListHtml);
        }
    });

    function printReceipt() {
        var printWindow = window.open('', '', 'height=600,width=800');
        var receiptContent = document.getElementById('receipt').innerHTML;

        // Inject CSS into the print window
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
