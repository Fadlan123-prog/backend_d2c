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
                                                            <button type="submit" class="btn btn-info btn-block btn-md" data-form-action="{{ route('sales.store') }}" onclick="printReceipt()">
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
</section>
<!-- Include jQuery -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<!-- Include Owl Carousel JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(document).ready(function(){
        $(function(){
            $('#inputGroupSelect02').select2()
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
        $('.category-btn').click(function() {
            var categoryId = $(this).data('category-id');

            // Make AJAX request to fetch items for the selected category
            $.ajax({
    url: 'cashier/items/' + categoryId,
    method: 'GET',
    success: function(data) {
        // Clear previous items
        $('#items-container').empty();

        // Check if there are items to display
        if (data.length > 0) {
            $('#items-section').show();
            // Append items to the container
            $.each(data, function(index, item) {
                // Check if item has sizes
                if (item.sizes && item.sizes.length > 0) {
                    $.each(item.sizes, function(sizeIndex, size) {
                        $('#items-container').append(
                            '<div class="col-md-4 col-lg-6 item-card" data-size-name="' + size.size + '" data-size-item="' + size.id + '" data-item-id="' + item.id + '" data-item-name="' + item.items_name + '" data-item-price="' + size.pivot.price + '">' +
                                '<div class="card mb-3 mb-lg-0">' +
                                    '<div class="card-body">' +
                                        '<span class="card-title">' + item.items_name + ' (' + size.size + ')</span>' +
                                        '<p class="mb-0">' + formatRupiah(size.pivot.price) + '</p>' +
                                    '</div>' +
                                '</div>' +
                            '</div>'
                        );
                    });
                } else {
                    // Default case if no sizes are available
                    $('#items-container').append(
                        '<div class="col-md-4 col-lg-6 item-card" data-item-id="' + item.id + '" data-item-name="' + item.items_name + '" data-item-price="' + item.harga_item + '">' +
                            '<div class="card mb-3 mb-lg-0">' +
                                '<div class="card-body">' +
                                    '<span class="card-title">' + item.items_name + '</span>' +
                                    '<p class="mb-0">' + formatRupiah(item.harga_item) + '</p>' +
                                '</div>' +
                            '</div>' +
                        '</div>'
                    );
                }
            });
        } else {
            $('#items-container').append('<p>No items found for this category.</p>');
        }
    },
    error: function(error) {
        console.log('Error fetching items:', error);
    }
});
        });

    // Handle item card click
        $('#items-container').on('click', '.item-card', function() {
            // Check if item has already been clicked
            if ($(this).hasClass('selected')) {
                return;
            }

            var itemName = $(this).data('item-name');
            var itemPrice = parseFloat($(this).data('item-price'));
            var itemId = $(this).data('item-id');
            var sizeItem = $(this).data('size-item');
            var sizeName = $(this).data('size-name');

            // Append the selected item to the selected-items section
            if(sizeItem) {
                $('#selected-items').append(
                    '<div class="d-flex justify-content-between mb-2">' +
                        '<p class="items-name mb-0" data-item-id="' + itemId + '"  data-size-id="' + sizeItem + '">' + itemName + ' (' + sizeName + ')</p>' +
                        '<p class="items-price mb-0" data-item-price="' + itemPrice + '">' + formatRupiah(itemPrice) + '</p>' +
                    '</div>'
                );
            } else {
                $('#selected-items').append(
                    '<div class="d-flex justify-content-between mb-2">' +
                        '<p class="items-name mb-0" data-item-id="' + itemId + '">' + itemName + '</p>' +
                        '<p class="items-price mb-0" data-item-price="' + itemPrice + '">' + formatRupiah(itemPrice) + '</p>' +
                    '</div>'
                );
            }

            // Update the subtotal
            var currentSubtotal = parseFloat($('#subtotal').data('subtotal')) || 0;
            var newSubtotal = currentSubtotal + itemPrice;
            $('#subtotal').data('subtotal', newSubtotal);
            $('#subtotal').text(formatRupiah(newSubtotal));

            // Mark the item as selected
            $(this).addClass('selected');
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


    // Handle form submission for transaction form
    $('#transactionForm').on('submit', function(event) {
        event.preventDefault(); // Prevent normal form submission

        // Collect selected items
        var selectedItems = [];
        var selectedCustomerId = $('#selected-items').find('p.plate').data('customer-id');

        $('#selected-items .d-flex').each(function() {
            var itemId = $(this).find('p.items-name').data('item-id');
            var itemPrice = $(this).find('p.items-price').data('item-price');
            var sizeId = $(this).find('p.items-name').data('size-id');

            if (itemId && itemPrice) {
                var item = {
                    item_id: itemId,
                    prices: itemPrice
                };
                if (sizeId) {
                    item.size_id = sizeId;
                }
                selectedItems.push(item);
            }
        });

        // Set hidden input values
        $('#customer_id').val(selectedCustomerId);
        $('#subtotal_hidden').val($('#subtotal').data('subtotal'));
        $('#items_hidden').val(JSON.stringify(selectedItems));

        // Determine form action based on clicked button
        var formAction = $('#transactionForm').data('form-action');

        // Create a FormData object
        var formData = new FormData(this);
        formData.append('items_id', JSON.stringify(selectedItems));
        formData.append('customer_id', selectedCustomerId);

        // Submit form via AJAX
        $.ajax({
            url: formAction,
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                console.log('Form submitted successfully:', response);

                if (formAction === '{{ route("pending.transaction.store") }}') {
                    window.location.href = '{{ route("pending.transaction.index") }}';
                }

                if (formAction === '{{ route("sales.store") }}') {
                    // Call printReceipt function only for checkout
                    window.location.href = '{{ route("sales.index") }}';
                }
            },
            error: function(error) {
                console.log('Error submitting form:', error);
            }
        });
    });

    // Set form action based on button click
        $('button[type="submit"]').click(function() {
            var formAction = $(this).data('form-action');
            $('#transactionForm').data('form-action', formAction);
        });
    });

// Function to format number as Rupiah
function formatRupiah(amount) {
    if (!amount) return '';
    return 'Rp ' + amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}

function printReceipt() {
    var printContents = document.getElementById('receipt').innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = '<html><head><title>Receipt</title></head><body>' + printContents + '</body></html>';

    window.print();

    document.body.innerHTML = originalContents;
    location.reload();
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

function printReceipt() {
            var printWindow = window.open('', '_blank', 'width=800,height=600');
            var printContents = `
                <html>
        <head>
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
                    <p>{{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}</p>
                </div>

                <hr class="dashed-hr">

                <div class="receipt-body">
                    <h3>Items:</h3>
                    <div>` + $('#selected-items').html() + `</div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <p class="mb-2">Subtotal</p>
                        <p class="mb-2">` + $('#subtotal').html() + `</p>
                    </div>
                    ` + $('#change').html() + `
                </div>

                <hr class="dashed-hr">

                <div class="receipt-footer">
                    <p>Powered by Dirty 2 Clean</p>
                </div>
            </div>
        </body>
        </html>
            `;
            printWindow.document.write(printContents);
            printWindow.document.close();
            printWindow.focus();
            printWindow.print();
            printWindow.close();
        }

  </script>

@endsection
