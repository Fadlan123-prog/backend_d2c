<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Receipt</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .receipt {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            border: 1px solid #eee;
            border-radius: 10px;
        }
        .receipt-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .receipt-details {
            margin-bottom: 20px;
        }
        .receipt-footer {
            text-align: center;
            margin-top: 20px;
        }
        .table th, .table td {
            vertical-align: middle;
        }
    </style>
</head>
<body>

<div class="receipt">
    <div class="receipt-header">
        <h2>Company Name</h2>
        <p>1234 Street Address, City, State 56789</p>
        <p>Phone: (123) 456-7890</p>
        <p>Email: info@company.com</p>
    </div>

    <div class="receipt-details">
        <div class="row">
            <div class="col-md-6">
                <h5>Customer Details</h5>
                <p><strong>Plate Number:</strong> {{ $customer->plate_number }}</p>
                <p><strong>Email:</strong> {{ $customer->email }}</p>
                <p><strong>Phone:</strong> {{ $customer->phone }}</p>
                <p><strong>Address:</strong> {{ $customer->address }}</p>
            </div>
            <div class="col-md-6 text-right">
                <h5>Receipt</h5>
                <p><strong>Receipt No:</strong> {{ $receipt->id }}</p>
                <p><strong>Date:</strong> {{ $receipt->date }}</p>
                <p><strong>Payment Method:</strong> {{ $receipt->payment_method }}</p>
            </div>
        </div>
    </div>

    <div class="receipt-items">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($receipt->items as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($item->unit_price, 2) }}</td>
                        <td>{{ number_format($item->total_price, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="receipt-total text-right">
        <h5><strong>Total Payment: ${{ number_format($receipt->total_payment, 2) }}</strong></h5>
    </div>

    <div class="receipt-footer">
        <p>Thank you for your business!</p>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
