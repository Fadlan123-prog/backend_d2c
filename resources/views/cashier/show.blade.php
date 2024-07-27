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

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<!-- Include Owl Carousel JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>



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
                var price = itemPrices[index] || ''; // Get the corresponding price, if available
                itemsListHtml += `
                    <div class="d-flex justify-content-between mb-2">
                        <p class="items-name mb-0">${item}</p>
                        <p class="items-price mb-0">${price}</p>
                    </div>
                `;
            });

            // Add the items and then the subtotal separately
            $transactionDetails.html(`
                <div class="d-flex justify-content-between mb-2">
                    <p class="mb-0">Plate Number</p>
                    <p class="mb-0">${data.plate_number}</p>
                </div>
                ${itemsListHtml}
            `);

            // Add the subtotal element after the items
            $('#transaction-details').html(`
                <div class="d-flex justify-content-between">
                    <p class="mb-2">Subtotal</p>
                    <p class="mb-2" id="subtotal" data-subtotal="${data.total_price}">Rp ${data.total_price}</p>
                </div>
            `);
        } else {
            console.error('Element with ID #selected-items not found.');
        }
    } else {
        console.error('No pending transaction data found in localStorage.');
    }

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

    $('.category-btn').click(function() {
        var categoryId = $(this).data('category-id');

        // Make AJAX request to fetch items for the selected category
        $.ajax({
            url: '/cashier/items/' + categoryId,
            method: 'GET',
            success: function(data) {
                // Clear previous items
                $('#items-container').empty();

                // Check if there are items to display
                if (data.length > 0) {
                    $('#items-section').show();
                    // Append items to the container
                    $.each(data, function(index, item) {
                        $('#items-container').append(
                            '<div class="col-md-4 col-lg-6 item-card" data-item-name="' + item.items_name + '" data-item-price="' + item.harga_item + '">' +
                                '<div class="card mb-3 mb-lg-0">' +
                                    '<div class="card-body">' +
                                        '<span class="card-title">' + item.items_name + '</span>' +
                                        '<p class="mb-0">' + formatRupiah(item.harga_item) + '</p>' +
                                    '</div>' +
                                '</div>' +
                            '</div>'
                        );
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

    $('#items-container').on('click', '.item-card', function() {
        // Check if item has already been clicked
        if ($(this).hasClass('selected')) {
            return;
        }

        var itemName = $(this).data('item-name');
        var itemPrice = parseFloat($(this).data('item-price'));

        // Append the selected item to the selected-items section
        $('#selected-items').append(
            '<div class="d-flex justify-content-between mb-2">' +
                '<p class="items-name mb-0">' + itemName + '</p>' +
                '<p class="items-price mb-0">' + formatRupiah(itemPrice) + '</p>' +
            '</div>'
        );

        // Update the subtotal
        var currentSubtotal = parseFloat($('#subtotal').data('subtotal')) || 0;
        var newSubtotal = currentSubtotal + itemPrice;
        $('#subtotal').data('subtotal', newSubtotal);
        $('#subtotal').text(formatRupiah(newSubtotal));

        // Mark the item as selected
        $(this).addClass('selected');

        // Re-add the subtotal element to ensure it stays at the bottom
        $('#transaction-details').append($('#subtotal').parent().detach());
    });

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

    $('#addCustomerForm').on('submit', function(event) {
        event.preventDefault(); // Prevent the form from submitting normally

        var selectElement = document.getElementById('exampleSelect2');
        selectElement.value = selectElement.value.toUpperCase();

        var isAlreadyAdded = false;
        // Append the selected plate number to the selected-items section
        var plateNumber = selectElement.value;
        $('#selected-items .d-flex').each(function() {
            var existingPlateNumber = $(this).find('p.mb-0').eq(1).text();
            if (existingPlateNumber === plateNumber) {
                isAlreadyAdded = true;
                return false; // Break out of the each loop
            }
        });

        if (!isAlreadyAdded) {
            $('#selected-items').append(
                '<div class="d-flex justify-content-between mb-2">' +
                    '<p class="mb-0">Plate Number</p>' +
                    '<p class="mb-0">' + plateNumber + '</p>' +
                '</div>'
            );
        } else {
            alert('This plate number has already been added.');
        }

        // Make AJAX request to submit the form data
        $.ajax({
            url: '{{ route("cashier.addcustomer") }}',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                console.log('Customer added successfully:', response);
                // Optionally, handle the response if needed
                var newOption = new Option(selectElement.value, selectElement.value, true, true);
                $('#exampleSelect2').append(newOption).trigger('change');
            },
            error: function(error) {
                console.log('Error adding customer:', error);
            }
        });
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
});


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
</script>

@endsection
