@extends('dashboard.index')

@section('title', 'Receipts')
@section('page', 'Receipts')

@section('content')
<div class="container">
    <!-- Search Form -->
    <div class="row mb-3">
        <div class="col-12">
            <div class="input-group">
                <input type="text" id="search" class="form-control" placeholder="Search Customer by Plate Number">
            </div>
        </div>
    </div>

    <!-- Receipts Table -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Customer Plate Number</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                            </tr>
                        </thead>
                        <tbody id="receipts-data">
                            @foreach($sales as $sale)
                                <tr>
                                    <td class="text-xs font-weight-bold mb-0">{{ $sale->date }}</td>
                                    <td class="text-xs font-weight-bold mb-0">{{ $sale->customer->plate_number ?? 'N/A' }}</td>
                                    <td class="text-xs font-weight-bold mb-0">
                                        <button class="btn btn-info btn-sm show-receipt" data-sale-id="{{ $sale->id }}">Show Receipt</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4" id="pagination-container">
                    {{ $sales->links('pagination::bootstrap-4') }} <!-- Render pagination links here -->
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="receiptModal" tabindex="-1" aria-labelledby="receiptModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="receiptModalLabel">Receipt</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Alfamart Style Receipt -->
                <style>
                    .dashed-hr {
                        border: none;
                        border-top: 1px dashed #000 !important;
                        margin: 10px 0;
                    }
                    .receipt {
                        max-width: 58mm;
                        margin: auto;
                        padding: 15px 10px;
                        border: 1px solid #eee;
                        border-radius: 5px;
                        font-size: 10px;
                        line-height: 1.4;
                    }
                    .receipt-header {
                        text-align: center;
                        margin-bottom: 10px;
                    }
                    .receipt-header img {
                        max-width: 100px;
                        margin-bottom: 5px;
                    }
                    .receipt-header p {
                        font-size: 10px;
                        margin: 2px 0;
                    }
                    .receipt-items {
                        width: 100%;
                    }
                    .receipt-items span {
                        font-size: 10px;
                        display: block;
                    }
                    .receipt-total {
                        margin-top: 10px;
                    }
                    .receipt-footer {
                        text-align: center;
                        font-size: 10px;
                        margin-top: 10px;
                    }
                </style>

                <div id="receipt-view" class="receipt">
                    <div class="receipt-header">
                        <img id="print-logo" src="{{ asset('assets/img/content/logo-receipt.png') }}" alt="logo">
                        <p>Jl. Tanjung Barat No, 2B</p>
                        <p>Lenteng Agung, Jakarta Selatan</p>
                        <p>08521713106</p>
                    </div>

                    <hr class="dashed-hr">

                    <div class="receipt-details">
                        <p>Tanggal: <span id="receiptDate"></span></p>
                        <p>Jam: <span id="receiptTime"></span></p>
                        <p>Kasir: <span id="receiptCashier"></span></p>
                    </div>

                    <hr class="dashed-hr">

                    <div id="receiptItems" class="receipt-items">
                        <!-- Items will be dynamically inserted here -->
                    </div>

                    <hr class="dashed-hr">

                    <div class="receipt-total">
                        <div class="d-flex justify-content-between">
                            <span>Subtotal:</span>
                            <span id="receiptSubtotal">Rp 0</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>Diskon:</span>
                            <span id="receiptDiscount">Rp 0</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>Total:</span>
                            <span id="receiptTotal">Rp 0</span>
                        </div>
                    </div>

                    <hr class="dashed-hr">

                    <div class="receipt-footer">
                        <p>Powered by Dirty 2 Clean</p>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="printReceiptButton">Print</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
    function fetchSales(query = '', page = 1) {
        // AJAX request for searching customers by plate_number and handling pagination
        $.ajax({
            url: "{{ route('sales.receipts.search') }}",
            method: 'GET',
            data: { query: query, page: page }, // Send the page number along with the query
            success: function(response) {
                $('#receipts-data').empty(); // Clear the existing data

                // Append the new rows
                $.each(response.data, function(index, sale) {
                    var row = '<tr>' +
                        '<td class="text-xs font-weight-bold mb-0">' + sale.date + '</td>' +
                        '<td class="text-xs font-weight-bold mb-0">' + sale.customer.plate_number + '</td>' +
                        '<td class="text-xs font-weight-bold mb-0"><button class="btn btn-info btn-sm show-receipt" data-sale-id="' + sale.id + '">Show Receipt</button></td>' +
                    '</tr>';
                    $('#receipts-data').append(row);
                });

                // Update the pagination links
                $('#pagination-container').html(response.links);
            },
            error: function(xhr, status, error) {
                console.log('Error:', error);
            }
        });
    }

    // Live search functionality
    $('#search').on('keyup', function() {
        var query = $(this).val();
        fetchSales(query); // Call the fetchSales function with the search query
    });

    // Pagination functionality
    $(document).on('click', '#pagination-container a', function(e) {
        e.preventDefault(); // Prevent default page load
        var page = $(this).attr('href').split('page=')[1]; // Get the page number from the link
        var query = $('#search').val(); // Get the current search query
        fetchSales(query, page); // Fetch the sales data for the clicked page
    });

    // Show receipt in modal when clicking the button
    $(document).on('click', '.show-receipt', function() {
        var saleId = $(this).data('sale-id');
        console.log('Sale ID:', saleId);

        // Proceed with AJAX request only if saleId is valid
        $.ajax({
            url: '/admin/receipts/' + saleId,
            method: 'GET',
            success: function(data) {
                // Populate modal with receipt data
                $('#receiptDate').text(data.date);
                $('#receiptTime').text(data.time);
                $('#receiptCashier').text(data.cashier_name);
                $('#receiptSubtotal').text(formatRupiah(data.subtotal));
                $('#receiptDiscount').text(formatRupiah(data.discount));
                $('#receiptTotal').text(formatRupiah(data.total));

                // Clear old items
                $('#receiptItems').empty();
                $.each(data.items, function(index, item) {
                    $('#receiptItems').append('<div class="d-flex justify-content-between"><span>' + item.name + '</span><span>' + item.quantity + ' x ' + formatRupiah(item.price) + '</span></div>');
                });

                // Show the modal
                $('#receiptModal').modal('show');
            },
            error: function(xhr) {
                console.log('Error:', xhr);
            }
        });
    });


    // Print receipt
    function formatRupiah(amount) {
        if (!amount) return '';

        // Round the amount to remove any decimals
        amount = Math.round(amount);

        // Convert to string and format as Rupiah
        return 'Rp ' + amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }

    $('#printReceiptButton').click(function() {
            var logoUrl = '{{ url('assets/img/content/logo-receipt.png') }}' + '?t=' + new Date().getTime();

            console.log("Logo URL:", logoUrl);
            var printContents = document.getElementById('receipt-view').innerHTML;
            var printWindow = window.open('', '_blank', 'width=800,height=600');
            printWindow.document.write(`
                <html>
                <head>
                    <title>Print Receipt</title>
                    <style>
                        .dashed-hr {
                            border: none;
                            border-top: 1px dashed #000;
                            margin: 10px 0;
                        }
                        .receipt {
                            max-width: 58mm;
                            margin: auto;
                            padding: 15px 10px;
                            border: 1px solid #eee;
                            border-radius: 5px;
                            font-size: 10px;
                            line-height: 1.4;
                        }
                        .receipt-header {
                            text-align: center;
                            margin-bottom: 10px;
                        }
                        .receipt-header img {
                            max-width: 100px;
                            margin-bottom: 5px;
                        }
                        .receipt-header h2 {
                            font-size: 16px;
                            margin: 0;
                        }
                        .receipt-header p {
                            font-size: 10px;
                            margin: 2px 0;
                        }
                        .receipt-details p {
                            font-size: 10px;
                            margin: 2px 0;
                        }
                        .receipt-items {
                            width: 100%;
                        }
                        .receipt-items span {
                            font-size: 10px;
                            display: block;
                        }
                        .receipt-items .d-flex {
                            display: flex;
                            justify-content: space-between;
                        }
                        .receipt-total {
                            margin-top: 10px;
                        }
                        .receipt-total .d-flex {
                            display: flex;
                            justify-content: space-between;
                        }
                        .receipt-footer {
                            text-align: center;
                            font-size: 10px;
                            margin-top: 10px;
                        }
                    </style>
                </head>
                <body>
                    <div class="receipt">
                        ${printContents}
                    </div>
                </body>
                </html>
            `);

            printWindow.document.getElementById('print-logo').onload = function() {
            printWindow.focus(); // Ensure the window is focused
            printWindow.print(); // Trigger the print dialog
            printWindow.close(); // Close the window after printing
        };
        });
});
</script>
@endsection
