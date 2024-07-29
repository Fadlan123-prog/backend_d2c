@extends('cashier.index')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4">
            <form id="addCustomerForm" method="POST" action="{{ route('cashier.addcustomer') }}">
                {{ csrf_field() }}
                <label for="exampleSelect2">Pilih Customer atau Masukkan Baru</label>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="form-group">
                            <select class="form-control" id="exampleSelect2" name="plate_number" style="width: 100%;">
                                @foreach($customers as $data)
                                    <option value="{{ $data->plate_number }}">{{ $data->plate_number }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="owl-carousel owl-theme">
        @foreach($categories->chunk(4) as $chunkedCategories)
        <div class="item">
            <div class="row">
                @foreach($chunkedCategories as $category)
                <div class="col-md-3">
                    <div class="card">
                        <button class="btn bg-black category-btn" data-category-id="{{ $category->id }}">
                            {{ $category->categories_name }}
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>
</div>

<section class="mt-5">
    <div class="row">
        <div class="col-12">
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col">
                        <div class="card">
                            <div class="card-body p-4">
                                <div class="row">
                                    <div class="col-lg-7">
                                        <div class="d-flex justify-content-between align-items-center mb-4">
                                            <div>
                                                <p class="mb-1">PRODUCT</p>
                                            </div>
                                        </div>
                                        <div id="items-section" style="display: none;">
                                            <div class="row" id="items-container">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="card bg-black text-white rounded-3">
                                            <div class="card-body">
                                                <form id="transactionForm" class="mt-4" method="POST">
                                                    {{ csrf_field() }}

                                                    <input type="hidden" name="plate_number" id="plate_number">
                                                    <input type="hidden" name="subtotal" id="subtotal_hidden">
                                                    <input type="hidden" name="payment_type" id="payment_type_hidden">
                                                    <input type="hidden" name="items" id="items_hidden">
                                                    <input type="hidden" name="prices" id="prices_hidden"> <!-- This will be populated dynamically -->

                                                    <div id="receipt">

                                                        <div id="selected-items">
                                                            <!-- Selected items will be appended here -->
                                                        </div>

                                                        <div id="transaction-details">

                                                        </div>

                                                        <hr class="my-2">

                                                        <div id="change">

                                                        </div>
                                                    </div>
                                                    <hr class="my-2">
                                                    <div class="form-outline form-white mb-4">
                                                        <input type="text" id="nominal" class="form-control form-control-lg" size="17" placeholder="Input Nominal" />
                                                        <label class="form-label" for="nominal">Input Nominal</label>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <div class="col-12">
                                                            <div class="btn-group" role="group">
                                                                <button type="button" class="btn btn-info btn-md" id="btn-transfer" data-value="Transfer">Transfer</button>
                                                                <button type="button" class="btn btn-info btn-md" id="btn-tokopedia" data-value="Tokopedia">Tokopedia</button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <div class="col-12">
                                                            <div class="btn-group" role="group">
                                                                <button type="button" class="btn btn-info btn-md" data-value="10000">10000</button>
                                                                <button type="button" class="btn btn-info btn-md" data-value="50000">50000</button>
                                                                <button type="button" class="btn btn-info btn-md" data-value="100000">100000</button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <hr class="my-3">

                                                    <button type="submit" class="btn btn-info btn-block btn-lg" data-form-action="{{ route('sales.store') }}">
                                                        <div class="d-flex justify-content-between">
                                                            <span>Checkout</span>
                                                        </div>
                                                    </button>
                                                    <button type="submit" class="btn btn-success btn-block btn-lg" data-form-action="{{ route('pending.transaction.store') }}">
                                                        <div class="d-flex justify-content-between">
                                                            <span>Pending</span>
                                                        </div>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal for Receipt -->
<div class="modal fade" id="receiptModal" tabindex="-1" aria-labelledby="receiptModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="receiptModalLabel">Receipt</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalReceiptContent">
                <!-- Receipt content will be inserted here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="printButton">Print</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<!-- Include Owl Carousel JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- Include Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBaApj8PXinV4StF5ZZEEXa6zA5sJojq4u/2DxRmGyL7Sk9I" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuHe66pY6oP5ywB8B9HoH0bBaL6pF2UeZ8bh/fehVcm6HZj6/zR1CrzRBp4VX0aX" crossorigin="anonymous"></script>

<script>
$(document).ready(function () {
    // Retrieve data from localStorage
    var data = localStorage.getItem('pendingTransaction');
    console.log('Retrieved data:', data); // Log data to ensure it's retrieved

    if (data) {
        data = JSON.parse(data);
        console.log('Parsed data:', data); // Log parsed data

        var $transactionDetails = $('#selected-items');
        if ($transactionDetails.length) {
            // Split item names and prices by comma, trim each item, remove quotes, and filter out empty strings
            var itemNames = data.item_name.split(',')
                .map(function(item) { return item.trim().replace(/"/g, ''); }) // Trim whitespace and remove quotes
                .filter(function(item) { return item.length > 0; }); // Filter out empty strings

            var itemPrices = data.item_price.split(',')
                .map(function(price) { return price.trim().replace(/"/g, ''); }) // Trim whitespace and remove quotes
                .filter(function(price) { return price.length > 0; }); // Filter out empty strings

            var itemsListHtml = '';
            $.each(itemNames, function(index, item) {
                if (item !== '' && itemPrices[index] !== undefined) { // Check if item and corresponding price are defined and non-empty
                    itemsListHtml += '<div class="d-flex justify-content-between"><p class="items-name">' + item + '</p><p class="items-price">' + itemPrices[index] + '</p></div>';
                }
            });

            $transactionDetails.html(itemsListHtml);
        } else {
            console.log('Element with id "transaction-details" not found.');
        }

        // Update subtotal
        var $subtotal = $('#subtotal');
        if ($subtotal.length) {
            $subtotal.text(data.subtotal);
            $subtotal.data('subtotal', data.subtotal); // Update data-subtotal attribute
        } else {
            console.log('Element with id "subtotal" not found.');
        }
    } else {
        console.log('No data found in localStorage.');
    }

    // Carousel settings
    var $owlCarousel = $('.owl-carousel');
    if ($owlCarousel.length) {
        $owlCarousel.owlCarousel({
            loop: false,
            margin: 10,
            nav: true,
            dots: true,
            autoplay: false,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 3
                }
            }
        });
    } else {
        console.log('Element with class "owl-carousel" not found.');
    }

    $('.category-btn').on('click', function() {
        var categoryId = $(this).data('category-id');
        $.ajax({
            url: '/cashier/get-items/' + categoryId,
            method: 'GET',
            success: function(response) {
                var $itemsContainer = $('#items-container');
                var $itemsSection = $('#items-section');
                if ($itemsContainer.length && $itemsSection.length) {
                    $itemsContainer.empty(); // Clear existing items
                    $.each(response.items, function(index, item) {
                        var itemHtml = '<div class="col-md-4 mb-4">' +
                            '<div class="card h-100">' +
                            '<div class="card-body d-flex flex-column">' +
                            '<h5 class="card-title">' + item.name + '</h5>' +
                            '<p class="card-text mt-auto">' + item.price + '</p>' +
                            '<button class="btn btn-primary mt-3 add-item-btn" data-item-id="' + item.id + '" data-item-name="' + item.name + '" data-item-price="' + item.price + '">Add Item</button>' +
                            '</div>' +
                            '</div>' +
                            '</div>';
                        $itemsContainer.append(itemHtml);
                    });
                    $itemsSection.show();
                } else {
                    console.log('Element with id "items-container" or "items-section" not found.');
                }
            },
            error: function(error) {
                console.log('Error retrieving items:', error);
            }
        });
    });

    $('#items-container').on('click', '.add-item-btn', function() {
        var itemId = $(this).data('item-id');
        var itemName = $(this).data('item-name');
        var itemPrice = $(this).data('item-price');

        var $selectedItems = $('#selected-items');
        if ($selectedItems.length) {
            var itemHtml = '<div class="d-flex justify-content-between"><p class="items-name">' + itemName + '</p><p class="items-price">' + itemPrice + '</p></div>';
            $selectedItems.append(itemHtml);

            // Update subtotal
            var $subtotal = $('#subtotal');
            if ($subtotal.length) {
                var currentSubtotal = parseInt($subtotal.data('subtotal')) || 0;
                var newSubtotal = currentSubtotal + parseInt(itemPrice);
                $subtotal.text(newSubtotal);
                $subtotal.data('subtotal', newSubtotal); // Update data-subtotal attribute
            } else {
                console.log('Element with id "subtotal" not found.');
            }
        } else {
            console.log('Element with id "selected-items" not found.');
        }
    });

    $('#transactionForm').on('submit', function(event) {
        event.preventDefault(); // Prevent normal form submission

        // Collect selected items
        var selectedItems = [];
        var itemNames = [];
        var itemPrices = [];
        $('#selected-items .d-flex').each(function() {
            var itemName = $(this).find('p.items-name').text();
            var itemPrice = $(this).find('p.items-price').text();

            if (itemName && itemPrice) { // Ensure both values are present
                selectedItems.push({ name: itemName, price: itemPrice });
                itemNames.push(itemName); // Add to itemNames array
                itemPrices.push(itemPrice); // Add to itemPrices array
            }
        });

        // Set hidden input values
        $('#plate_number').val($('#exampleSelect2').val());
        $('#subtotal_hidden').val($('#subtotal').data('subtotal'));
        $('#items_hidden').val(itemNames.join(', '));
        $('#prices_hidden').val(itemPrices.join(', '));

        // Determine form action based on clicked button
        var formAction = $('#transactionForm').data('form-action');

        // Update form action
        $('#transactionForm').attr('action', formAction);

        // Submit form via AJAX
        $.ajax({
            url: formAction,
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                console.log('Form submitted successfully:', response);

                if (formAction === '{{ route("pending.transaction.store") }}') {
                    window.location.href = '{{ route("pending.transaction.index") }}';
                }

                if (formAction === '{{ route("sales.store") }}') {
                    // Call printReceipt function only for checkout
                    printReceipt();
                }
            },
            error: function(error) {
                console.log('Error submitting form:', error);
            }
        });
    });

    $('button[type="submit"]').click(function() {
        var formAction = $(this).data('form-action');
        $('#transactionForm').data('form-action', formAction);
    });

    $('#btn-transfer, #btn-tokopedia').on('click', function() {
        var paymentType = $(this).data('value');
        $('#payment_type_hidden').val(paymentType);

        var $transactionDetails = $('#transaction-details');
        if ($transactionDetails.length) {
            var subtotal = parseInt($('#subtotal').data('subtotal')) || 0;
            var nominal = parseInt($('#nominal').val()) || 0;
            var kembalian = nominal - subtotal;
            if (nominal > 0) {
                var paymentDetailsHtml = '<div class="d-flex justify-content-between"><p>Payment Type:</p><p>' + paymentType + '</p></div>' +
                    '<div class="d-flex justify-content-between"><p>Nominal:</p><p>' + nominal + '</p></div>' +
                    '<div class="d-flex justify-content-between"><p>Kembalian:</p><p>' + kembalian + '</p></div>';
                $transactionDetails.html(paymentDetailsHtml);

                var changeHtml = '<div class="d-flex justify-content-between"><p>Kembalian:</p><p>' + kembalian + '</p></div>';
                $('#change').html(changeHtml);
            }
        }
    });

    $('button[data-value]').on('click', function() {
        var value = $(this).data('value');
        var currentNominal = parseInt($('#nominal').val()) || 0;
        var newNominal = currentNominal + value;
        $('#nominal').val(newNominal);

        // Update kembalian
        var subtotal = parseInt($('#subtotal').data('subtotal')) || 0;
        var kembalian = newNominal - subtotal;
        var $transactionDetails = $('#transaction-details');
        if ($transactionDetails.length) {
            var paymentDetailsHtml = $transactionDetails.html() +
                '<div class="d-flex justify-content-between"><p>Kembalian:</p><p>' + kembalian + '</p></div>';
            $transactionDetails.html(paymentDetailsHtml);

            var changeHtml = '<div class="d-flex justify-content-between"><p>Kembalian:</p><p>' + kembalian + '</p></div>';
            $('#change').html(changeHtml);
        }
    });
});

function printReceipt() {
    var printContents = document.getElementById('receipt').innerHTML;
    document.getElementById('modalReceiptContent').innerHTML = printContents;
    var receiptModal = new bootstrap.Modal(document.getElementById('receiptModal'), {
        keyboard: false
    });
    receiptModal.show();
}

document.getElementById('printButton').addEventListener('click', function() {
    var printContents = document.getElementById('modalReceiptContent').innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = '<html><head><title>Receipt</title></head><body>' + printContents + '</body></html>';

    window.print();

    document.body.innerHTML = originalContents;
    location.reload();
});
</script>
@endsection
