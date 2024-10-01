@extends('cashier.index')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4">
                <label for="exampleSelect2">Pilih Customer atau Masukkan Baru</label>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="input-group mb-3">
                            <select class="form-select" id="inputGroupSelect02">
                              <option selected>Choose...</option>
                              @foreach($customers as $data)
                                    <option value="{{ $data->plate_number }}" data-customer-id ="{{ $data->id }}">{{ $data->plate_number }}</option>
                              @endforeach
                            </select>
                            <button class="btn btn-primary" for="inputGroupSelect02" data-bs-toggle="modal" data-bs-target="#addCustomerModal">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3.99999 9.5C4.00005 8.64332 4.22022 7.80102 4.63939 7.05389C5.05856 6.30677 5.66266 5.67987 6.39376 5.23333C7.12485 4.78678 7.95842 4.53558 8.81451 4.5038C9.6706 4.47202 10.5205 4.66073 11.2827 5.05184C12.0449 5.44295 12.6938 6.02334 13.1672 6.73733C13.6406 7.45133 13.9226 8.27498 13.9862 9.1293C14.0498 9.98362 13.8928 10.8399 13.5303 11.6161C13.1678 12.3923 12.6119 13.0624 11.916 13.562C13.3601 14.137 14.6045 15.1218 15.4961 16.395C16.3876 17.6682 16.8875 19.1743 16.934 20.728C16.9391 20.8277 16.9242 20.9275 16.8903 21.0214C16.8563 21.1153 16.8039 21.2015 16.7362 21.2749C16.6685 21.3483 16.5868 21.4074 16.4959 21.4488C16.405 21.4902 16.3068 21.513 16.207 21.516C16.1072 21.5189 16.0078 21.5019 15.9146 21.4659C15.8215 21.4299 15.7364 21.3756 15.6645 21.3063C15.5926 21.237 15.5353 21.1541 15.4959 21.0623C15.4564 20.9706 15.4357 20.8719 15.435 20.772C15.3838 19.0912 14.6801 17.4964 13.4731 16.3256C12.2661 15.1548 10.6506 14.5 8.96899 14.5C7.28741 14.5 5.67192 15.1548 4.4649 16.3256C3.25788 17.4964 2.5542 19.0912 2.50299 20.772C2.49298 20.9678 2.40667 21.152 2.26255 21.2849C2.11843 21.4179 1.92797 21.4891 1.73196 21.4834C1.53596 21.4776 1.35 21.3953 1.21393 21.2541C1.07786 21.113 1.0025 20.9241 1.00399 20.728C1.05097 19.167 1.5555 17.6543 2.4549 16.3776C3.3543 15.101 4.60895 14.1167 6.06299 13.547C5.42402 13.0832 4.90396 12.4747 4.54538 11.7713C4.1868 11.0679 3.99991 10.2895 3.99999 9.5ZM8.99999 6C8.54036 6 8.08524 6.09053 7.6606 6.26642C7.23596 6.44231 6.85012 6.70012 6.52512 7.02513C6.20011 7.35013 5.9423 7.73597 5.76641 8.16061C5.59052 8.58525 5.49999 9.04037 5.49999 9.5C5.49999 9.95963 5.59052 10.4148 5.76641 10.8394C5.9423 11.264 6.20011 11.6499 6.52512 11.9749C6.85012 12.2999 7.23596 12.5577 7.6606 12.7336C8.08524 12.9095 8.54036 13 8.99999 13C9.92825 13 10.8185 12.6313 11.4749 11.9749C12.1312 11.3185 12.5 10.4283 12.5 9.5C12.5 8.57174 12.1312 7.6815 11.4749 7.02513C10.8185 6.36875 9.92825 6 8.99999 6ZM19.25 1C19.4489 1 19.6397 1.07902 19.7803 1.21967C19.921 1.36032 20 1.55109 20 1.75V4H22.25C22.4489 4 22.6397 4.07902 22.7803 4.21967C22.921 4.36032 23 4.55109 23 4.75C23 4.94891 22.921 5.13968 22.7803 5.28033C22.6397 5.42098 22.4489 5.5 22.25 5.5H20V7.75C20 7.94891 19.921 8.13968 19.7803 8.28033C19.6397 8.42098 19.4489 8.5 19.25 8.5C19.0511 8.5 18.8603 8.42098 18.7197 8.28033C18.579 8.13968 18.5 7.94891 18.5 7.75V5.5H16.25C16.0511 5.5 15.8603 5.42098 15.7197 5.28033C15.579 5.13968 15.5 4.94891 15.5 4.75C15.5 4.55109 15.579 4.36032 15.7197 4.21967C15.8603 4.07902 16.0511 4 16.25 4H18.5V1.75C18.5 1.55109 18.579 1.36032 18.7197 1.21967C18.8603 1.07902 19.0511 1 19.25 1Z" fill="white"/>
                                    </svg>
                            </button>
                          </div>
                        </div>

                    </div>

                </div>
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

                                                    <input type="hidden" name="customer_id" id="customer_id">
                                                    <input type="hidden" name="subtotal" id="subtotal_hidden">
                                                    <input type="hidden" name="payment_type" id="payment_type_hidden">
                                                    <input type="hidden" name="items_id" id="items_hidden">
                                                    <input type="hidden" name="sizes" id="sizes_hidden">
                                                    <input type="hidden" id="prices_hidden" name="prices"><!-- This will be populated dynamically -->
                                                    <input type="hidden" name="coupon_id" id="coupons_hidden">

                                                    <div id="receipt">

                                                        <div id="selected-items">
                                                            <!-- Selected items will be appended here -->
                                                        </div>

                                                        <div id="transaction-details">

                                                        </div>

                                                        <hr class="my-2">

                                                        <div class="d-flex justify-content-between">
                                                            <p class="mb-2">Subtotal</p>
                                                            <p class="mb-2" id="subtotal" data-subtotal="0">Rp 0</p>
                                                        </div>

                                                        <div class="d-flex justify-content-between">
                                                            <p class="mb-2">Diskon</p>
                                                            <p class="mb-2" id="coupons" data-coupons="0">Rp 0</p>
                                                        </div>

                                                        <div id="change">

                                                        </div>
                                                    </div>
                                                    <hr class="my-2">
                                                    <div class="form-outline form-white mb-2">
                                                        <select class="form-select" id="coupon-select" name="diskon">
                                                            <option value="">Select Diskon</option>
                                                            @foreach($coupons as $coupon)
                                                                <option value="{{ $coupon->id }}" {{ $coupon->coupon_id == $coupon->id ? 'selected' : '' }}>{{ $coupon->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <label class="form-label" for="coupon-select">Diskon</label>
                                                    </div>

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
                                                            <div class="btn-group" role="group" id="nominal-buttons">
                                                                <button type="button" class="btn btn-info btn-md nominal-btn" data-value="10000">10000</button>
                                                                <button type="button" class="btn btn-info btn-md nominal-btn" data-value="50000">50000</button>
                                                                <button type="button" class="btn btn-info btn-md nominal-btn" data-value="100000">100000</button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <hr class="my-3">

                                                    <div class="row d-flex justify-content-between">
                                                        <div class="col-lg-6 col-6">
                                                            <button type="submit" class="btn btn-info btn-block btn-md" data-form-action="{{ route('sales.store') }}">
                                                                <div class="d-flex justify-content-between">
                                                                    <span>Checkout</span>
                                                                </div>
                                                            </button>
                                                        </div>
                                                        <div class="col-lg-6 col-6">
                                                            <button type="submit" class="btn btn-success btn-block btn-md" data-form-action="{{ route('pending.transaction.store') }}">
                                                                <div class="d-flex justify-content-between">
                                                                    <span>Pending</span>
                                                                </div>
                                                            </button>
                                                        </div>
                                                    </div>
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

    <div class="modal fade" id="addCustomerModal" tabindex="-1" aria-labelledby="addCustomerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCustomerModalLabel">Add New Customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('cashier.addcustomer') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="plate_number" class="form-label">Plate Number</label>
                            <input type="text" class="form-control" id="plate_number" name="plate_number" value="{{ old('plate_number') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Name</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone_number" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
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

                    <div id="receipt-view" class="receipt">
                        <!-- Header with logo and store information -->
                        <div class="receipt-header">
                            <img id="print-logo" src="{{ asset('assets/img/content/logo-receipt.png') }}" alt="logo">
                            <p>Jl. Tanjung Barat No, 2B</p>
                            <p>Lenteng Agung, Jakarta Selatan</p>
                            <p>08521713106</p>
                        </div>

                        <hr class="dasher-hr">

                        <!-- Transaction details -->
                        <div class="receipt-details">
                            <p>Tanggal: <span id="receiptDate"></span></p>
                            <p>Jam: <span id="receiptTime"></span></p>
                            <p>Kasir: <span id="receiptCashier"></span></p>
                        </div>

                        <!-- Items -->
                        <hr class="dashed-hr">
                        <div id="receiptItems" class="receipt-items">
                            <!-- Items will be dynamically inserted here -->
                        </div>
                        <hr class="dashed-hr">

                        <!-- Total details -->
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

                        <!-- Footer -->
                        <hr class="dashed-hr">
                        <div class="receipt-footer">
                            <p>Powered by Dirty 2 Clean</p>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="printReceipt()">Print</button>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Include jQuery -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<!-- Include Owl Carousel JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(document).ready(function(){
        $(function(){
            $('#inputGroupSelect02').select2(   )
        })

        $('.owl-carousel').owlCarousel({
            loop: false,
            margin: 10,
            nav: false, // Set to false to hide navigation buttons
            dots: false, // Set to false to hide dots
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 1
                }
            }
        });


        var $nominalButtonsContainer = $('#nominal-buttons');

        $nominalButtonsContainer.on('click', '.nominal-btn', function() {
            var valueToAdd = parseInt($(this).data('value'), 10);
            var $nominalInput = $('#nominal');
            var currentNominal = parseInt($nominalInput.val().replace(/[^\d]/g, ''), 10) || 0; // Remove non-digit characters and parse as int
            var newNominal = currentNominal + valueToAdd;
            $nominalInput.val(formatRupiah(newNominal));
            $('#payment_type_hidden').val('Cash');
        });

    // Handle category button click
    $('.category-btn').click(function () {
        var categoryId = $(this).data('category-id');

        // Make AJAX request to fetch items for the selected category
        $.ajax({
            url: 'cashier/items/' + categoryId,
            method: 'GET',
            success: function (data) {
                // Clear previous items
                $('#items-container').empty();

                // Check if there are items to display
                if (data.length > 0) {
                    $('#items-section').show();
                    // Append items to the container
                    $.each(data, function (index, item) {
                        // Check if item has sizes
                        if (item.sizes && item.sizes.length > 0) {
                            $.each(item.sizes, function (sizeIndex, size) {
                                appendItemCard(item, size);
                            });
                        } else {
                            // Default case if no sizes are available
                            appendItemCard(item);
                        }
                    });
                } else {
                    $('#items-container').append('<p>No items found for this category.</p>');
                }
            },
            error: function (error) {
                console.log('Error fetching items:', error);
            }
        });
    });

    // Function to append an item card
    function appendItemCard(item, size = null) {
        let itemId = item.id;
        let itemName = item.items_name;
        let itemPrice = size ? size.pivot.price : item.harga_item;
        let sizeId = size ? size.id : null;
        let sizeName = size ? size.size : null;

        // Create the item card
        $('#items-container').append(
            '<div class="col-md-4 col-lg-6 item-card" data-size-name="' + (sizeName || '') + '" data-size-item="' + (sizeId || '') + '" data-item-id="' + itemId + '" data-item-name="' + itemName + '" data-item-price="' + itemPrice + '">' +
                '<div class="card mb-3 mb-lg-0">' +
                    '<div class="card-body">' +
                        '<span class="card-title">' + itemName + (sizeName ? ' (' + sizeName + ')' : '') + '</span>' +
                        '<p class="mb-0">' + formatRupiah(itemPrice) + '</p>' +
                    '</div>' +
                '</div>' +
            '</div>'
        );
    }

    // Handle item card click to add item to selected-items
    $('#items-container').on('click', '.item-card', function() {
        var itemId = $(this).data('item-id');
        var itemName = $(this).data('item-name');
        var itemPrice = parseFloat($(this).data('item-price'));
        var sizeItem = $(this).data('size-item');
        var sizeName = $(this).data('size-name');

        var existingItem = $('#selected-items').find('[data-item-id="' + itemId + '"][data-size-id="' + sizeItem + '"]');

        if (existingItem.length > 0) {
            // Update quantity if the item is already in the list
            var quantityInput = existingItem.closest('.item-row').find('.quantity-input');
            var newQuantity = parseInt(quantityInput.val()) + 1;
            quantityInput.val(newQuantity);

            updateSubtotal();
        } else {
            // Append the new item with quantity controls
            var itemHTML = '<div class="d-flex justify-content-between align-items-center mb-2 item-row">' +
                '<p class="items-name mb-0" data-item-id="' + itemId + '" data-size-id="' + sizeItem + '">' + itemName + (sizeName ? ' (' + sizeName + ')' : '') + '</p>' +
                '<div class="quantity-controls d-flex align-items-center">' +
                    '<button type="button" class="quantity-left-minus btn btn-danger btn-sm mx-1" data-type="minus">-</button>' +
                    '<input type="text" class="quantity-input form-control form-control-sm text-center" value="1" min="1">' +
                    '<button type="button" class="quantity-right-plus btn btn-success btn-sm mx-1" data-type="plus">+</button>' +
                '</div>' +
                '<p class="items-price mb-0" data-item-price="' + itemPrice + '">' + formatRupiah(itemPrice) + '</p>' +
            '</div>';

            $('#selected-items').append(itemHTML);

            updateSubtotal();
        }
    });

    // Function to update subtotal
    function updateSubtotal() {
        var subtotal = 0;
        $('#selected-items .item-row').each(function() {
            var itemPrice = parseFloat($(this).find('.items-price').data('item-price'));
            var quantity = parseInt($(this).find('.quantity-input').val());
            subtotal += itemPrice * quantity;
        });

        $('#subtotal').text(formatRupiah(subtotal));
        $('#subtotal').attr('data-subtotal', subtotal);
    }

    // Event listeners for quantity buttons
    $('#selected-items').on('click', '.quantity-right-plus', function(e) {
        e.preventDefault();
        var quantityInput = $(this).closest('.quantity-controls').find('.quantity-input');
        var currentVal = parseInt(quantityInput.val());
        quantityInput.val(currentVal + 1);
        updateSubtotal();
    });

    $('#selected-items').on('click', '.quantity-left-minus', function(e) {
        e.preventDefault();
        var quantityInput = $(this).closest('.quantity-controls').find('.quantity-input');
        var currentVal = parseInt(quantityInput.val());

        if (currentVal > 1) {
            quantityInput.val(currentVal - 1);
        } else {
            $(this).closest('.item-row').remove();
        }

        updateSubtotal();
    });

    // Handle numeric button click
        $('.btn-group button').click(function() {
            var paymentType = $(this).data('value'); // Get the value from data attribute
            $('#payment_type_hidden').val(paymentType); // Set the value of hidden input

            if (paymentType === 'Tokopedia' || paymentType === 'Transfer') {
                // Hide the nominal input field if Tokopedia or Transfer is selected
                $('#nominal').hide();
            } else {
                $('#nominal').show(); // Show the nominal input field otherwise
            }
        });

    // Handle input change for the nominal field
        $('#nominal').on('input', function() {
            var value = $(this).val().replace(/\D/g, ''); // Remove non-numeric characters
            $(this).val(formatRupiah(value));

            var nominalValue = parseFloat(value);
            var subtotal = parseFloat($('#subtotal').data('subtotal'));

            if (nominalValue >= 0) {
                $('#payment_type_hidden').val('Cash'); // Set payment type to Cash if nominal is filled
            }

            if (nominalValue >= subtotal) {
                var change = nominalValue - subtotal;
                $('#change').html(
                    '<div class="d-flex justify-content-between mb-2">' +
                        '<p class="mb-0">Change</p>' +
                        '<p class="mb-0">' + formatRupiah(change) + '</p>' +
                    '</div>'
                ); // Display change
            } else {
                $('#change').text(''); // Clear change if nominal is less than subtotal
            }
        });



    // Handle form submission for adding customer
    $('#inputGroupSelect02').on('change', function() {
        var customerId = $(this).find(':selected').data('customer-id'); // Get selected customer ID
        console.log('Selected Customer ID:', customerId);
        if (customerId) {
            $.ajax({
                url: 'cashier/get-customer/' + customerId, // URL to fetch customer data
                method: 'GET',
                success: function(response) {
                    console.log('Response:', response); // Log for debugging
                    // Replace the content of #selected-item with the new customer info
                    $('#selected-items').html(
                        '<div class="d-flex justify-content-between mb-2">' +
                            '<p class="mb-0">Plate Number</p>' +
                            '<p class="plate mb-0" data-customer-id="' + customerId + '">' + response.plate_number + '</p>' +
                        '</div>'
                    );
                },
                error: function(error) {
                    console.log('Error fetching customer details:', error);
                }
            });
        } else {
            $('#selected-item').empty(); // Clear #selected-item if no customer is selected
        }
    });

    $('#coupon-select').change(function() {
    var couponId = $(this).val();

    // Get the current subtotal from the data attribute or default to 0
    var currentSubtotal = parseFloat($('#subtotal').data('subtotal')) || 0;
    var totalDiscount = 0;

    if (couponId) {
        $.ajax({
            url: `cashier/coupons/${couponId}`,
            method: 'GET',
            success: function(coupon) {
                console.log('Coupon:', coupon);

                // Check if coupon items are defined and are an array
                var couponItems = coupon.items || [];
                if (!Array.isArray(couponItems)) {
                    console.error('Coupon items are not an array.');
                    return;
                }

                totalDiscount = 0; // Reset totalDiscount
                currentSubtotal = 0; // Reset currentSubtotal

                // Iterate over each selected item in the cart
                $('#selected-items .item-row').each(function() {
                    var selectedItemId = $(this).find('.items-name').data('item-id');
                    var originalPrice = parseFloat($(this).find('.items-price').data('item-price'));
                    var quantity = parseInt($(this).find('.quantity-input').val());

                    console.log('Selected Item ID:', selectedItemId);
                    console.log('Original Price:', originalPrice);

                    if (isNaN(originalPrice)) {
                        console.error('Original Price is NaN! Check the data-item-price attribute.');
                        return;
                    }

                    var discountedPrice = originalPrice; // Default to original price

                    // Find if this selected item matches any of the coupon items
                    var couponItem = couponItems.find(function(item) {
                        return item.id === selectedItemId;  // Match item ID
                    });

                    if (couponItem) {
                        // Apply discount based on coupon (either amount or percentage)
                        if (coupon.discount_amount) {
                            discountedPrice -= parseFloat(coupon.discount_amount);
                            totalDiscount += parseFloat(coupon.discount_amount) * quantity;
                            console.log('Discount Amount:', coupon.discount_amount);
                        } else if (coupon.discount_percentage) {
                            var discount = originalPrice * (parseFloat(coupon.discount_percentage) / 100);
                            discountedPrice -= discount;
                            totalDiscount += discount * quantity;
                            console.log('Discount Percentage:', coupon.discount_percentage);
                        }

                        discountedPrice = Math.round(discountedPrice); // Round off
                        console.log('Discounted Price:', discountedPrice);

                        if (isNaN(discountedPrice)) {
                            console.error('Discounted Price is NaN! Something went wrong with the calculation.');
                            return;
                        }

                    }

                    // Update the subtotal based on the new prices and quantity
                    currentSubtotal += discountedPrice * quantity;
                });

                // Update the total discount in the UI
                $('#coupons').data('coupons', Math.round(totalDiscount));
                $('#coupons').text(formatRupiah(totalDiscount));
                console.log('Total Discount:', totalDiscount);

                // Update the subtotal in the UI with discounted prices
                $('#subtotal').data('subtotal', currentSubtotal);
                $('#subtotal').text(formatRupiah(currentSubtotal));
                console.log('New Subtotal:', currentSubtotal);

                $('#receiptSubtotal').text(formatRupiah(currentSubtotal))
                $('#receiptDiscount').text(formatRupiah(totalDiscount));
            },
            error: function(error, xhr) {
                console.error('Error fetching coupon details:', error);
            }
        });
    } else {
        // If no coupon is selected, reset all prices to their original value
        currentSubtotal = 0;

        $('#selected-items .item-row').each(function() {
            var selectedItem = $(this);
            var originalPrice = parseFloat(selectedItem.find('.items-price').data('item-price'));
            var quantity = parseInt(selectedItem.find('.quantity-input').val());

            // Reset the price displayed to the original price
            selectedItem.find('.items-price').html(formatRupiah(originalPrice));

            // Update the subtotal without discounts
            currentSubtotal += originalPrice * quantity;
        });

        // Reset subtotal and coupons
        $('#subtotal').data('subtotal', currentSubtotal);
        $('#subtotal').text(formatRupiah(currentSubtotal));
        $('#coupons').data('coupons', 0);
        $('#coupons').text(formatRupiah(0));


    }
});




    // Handle form submission for transaction form
    $('#transactionForm').on('submit', function (event) {
        event.preventDefault(); // Prevent normal form submission

        // Collect selected items
        var selectedItems = [];
        var selectedCustomerId = $('#selected-items').find('p.plate').data('customer-id');
        var couponId = $('#coupon-select').val();
        console.log('Selected coupon:', couponId);

        // Iterate through selected items
        $('#selected-items .d-flex').each(function () {
            var itemId = $(this).find('p.items-name').data('item-id');
            var itemPrice = $(this).find('p.items-price').data('item-price');
            var sizeId = $(this).find('p.items-name').data('size-id');

            // Retrieve and parse quantity
            var quantityValue = $(this).find('.quantity-input').val();
            var quantity = parseInt(quantityValue);
            console.log('Parsed quantity:', quantity);

            // Ensure item details are valid before adding to the list
            if (itemId && itemPrice && quantity > 0) {
                var item = {
                    item_id: itemId,
                    prices: itemPrice,
                    quantity: quantity,
                    category_id: $(this).data('category-id') // Capture category ID
                };
                if (sizeId) {
                    item.size_id = sizeId;
                }
                selectedItems.push(item);
            }
        });

        // Check if items were selected
        if (selectedItems.length === 0) {
            alert('Please select at least one item to proceed.');
            return;
        }

        // Set hidden input values before submitting
        $('#customer_id').val(selectedCustomerId);
        $('#subtotal_hidden').val($('#subtotal').data('subtotal'));
        $('#items_hidden').val(JSON.stringify(selectedItems));
        $('#coupons_hidden').val(couponId);

        // Determine form action based on the button clicked
        var formAction = $('#transactionForm').data('form-action');

        // Create FormData object
        var formData = new FormData(this);
        formData.append('items_id', JSON.stringify(selectedItems));
        formData.append('customer_id', selectedCustomerId);
        formData.append('coupon_id', couponId);

        // AJAX submission
        $.ajax({
            url: formAction,  // Use the correct form action route
            method: 'POST',
            data: formData,
            processData: false,  // Ensure that jQuery does not process the data
            contentType: false,  // Do not set content type header automatically
            success: function (response) {
                console.log('Form submitted successfully:', response);

                if (response.success) {
                    // After successful submission, retrieve detailed sale data
                    fetchReceiptData(response.sale_id);
                } else {
                    alert('There was a problem processing the sale.');
                }
            },
            error: function (error) {
                console.log('Error submitting form:', error);
                alert('An error occurred while submitting the form. Please try again.');
            }
        });
    });

    // Set form action based on button click
        $('button[type="submit"]').click(function() {
            var formAction = $(this).data('form-action');
            $('#transactionForm').data('form-action', formAction);
        });
    });

    function fetchReceiptData(saleId) {
        $.ajax({
            url: '/admin/cashier/sales/' + saleId + '/receipt',  // URL matches the prefixed route
            method: 'GET',
            success: function (response) {
                // Populate the receipt modal with the data
                populateReceiptModal(response);

                // Show the receipt modal
                $('#receiptModal').modal('show');
            },
            error: function (error) {
                console.log('Error fetching receipt data:', error);
            }
        });
    }

    function populateReceiptModal(data) {
        // Set receipt details (like date, time, customer plate, cashier, etc.)
        $('#receiptDate').text(data.date);
        $('#receiptTime').text(data.time);
        $('#receiptPlateNumber').text(data.customer_plate);
        $('#receiptCashier').text(data.cashier);

        // Populate receipt items
        $('#receiptItems').empty();  // Clear previous items
        data.items.forEach(function (item) {
            var itemHTML = '<div class="d-flex justify-content-between mb-0">' +
                '<span class="items-name">' + item.name + ' ' + item.size + ' x' + item.quantity + '</span>' +
                '<span class="items-price text-right">' + formatRupiah(item.price) + '</span>' +
                '</div>';
            $('#receiptItems').append(itemHTML);
        });

        // Subtotal, discount, and total
        // $('#receiptSubtotal').text(formatRupiah(data.subtotal));
        // $('#receiptDiscount').data('coupon');
        $('#receiptTotal').text(formatRupiah(data.total));
    }


// Function to format number as Rupiah
function formatRupiah(amount) {
    if (!amount) return '';

    // Round the amount to remove any decimals
    amount = Math.round(amount);

    // Convert to string and format as Rupiah
    return 'Rp ' + amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}


$(document).ready(function() {
    $('#exampleSelect2').select2({
        tags: true,
        placeholder: "Pilih atau masukkan teks",
        allowClear: true
    });
});

function convertToUpper() {
    var selectElement = document.getElementById('exampleSelect2');
    selectElement.value = selectElement.value.toUpperCase();
}

    $('#printReceiptButton').on('click', function () {
        printReceipt();
    });

    // Function to print the receipt
    function printReceipt() {
        var printWindow = window.open('', '', 'height=600,width=800');
        var receiptContent = document.getElementById('receipt-view').innerHTML;

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

            .receipt-total .d-flex {
                display: flex;
                justify-content: space-between;
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

@endsection
