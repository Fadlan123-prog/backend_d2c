<div>
    <!-- Search Input -->
    <input type="text" wire:model="query" class="form-control" placeholder="Search by Plate Number...">

    <!-- Table of Receipts -->
    <table class="table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Customer</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $customer)
                @foreach($customer->sales as $sale)
                    <tr>
                        <td>{{ $sale->date }}</td>
                        <td>{{ $customer->plate_number }}</td>
                        <td>
                            <button wire:click="showReceipt({{ $sale->id }})" class="btn btn-info">Show Receipt</button>
                        </td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>

    <!-- Modal for Receipt -->
    <div class="modal fade" id="receiptModal" tabindex="-1" aria-labelledby="receiptModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Receipt</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <!-- Alfamart Style Receipt -->
                    <div class="receipt">
                        <div class="receipt-header">
                            <p>Date: {{ $sale->date ?? '' }}</p>
                            <p>Time: {{ $sale->time ?? '' }}</p>
                            <p>Cashier: {{ $sale->cashier_name ?? '' }}</p>
                        </div>
                        <hr class="dashed-hr">
                        <div id="receiptItems">
                            @foreach($items as $item)
                                <div class="d-flex justify-content-between">
                                    <span>{{ $item->item->items_name }}</span>
                                    <span>{{ $item->quantity }} x {{ $item->harga_items }}</span>
                                </div>
                            @endforeach
                        </div>
                        <hr class="dashed-hr">
                        <div class="receipt-total">
                            <div class="d-flex justify-content-between">
                                <span>Subtotal:</span>
                                <span>Rp {{ $subtotal }}</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span>Discount:</span>
                                <span>Rp {{ $discount }}</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span>Total:</span>
                                <span>Rp {{ $total }}</span>
                            </div>
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
</div>

<script>
    document.addEventListener('show-receipt-modal', function () {
        var myModal = new bootstrap.Modal(document.getElementById('receiptModal'));
        myModal.show();
    });

    document.getElementById('printReceiptButton').addEventListener('click', function () {
        var printContents = document.querySelector('.receipt').innerHTML;
        var printWindow = window.open('', '', 'width=800,height=600');
        printWindow.document.write(`
            <html>
            <head><title>Print Receipt</title></head>
            <body>${printContents}</body>
            </html>
        `);
        printWindow.document.close();
        printWindow.focus();
        printWindow.print();
        printWindow.close();
    });
</script>
