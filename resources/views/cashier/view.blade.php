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
                                <option value="" selected disable></option>
                                @foreach($customers as $data)
                                    <option value="{{ $data->plate_number }}" data-customer-id ="{{ $data->id }}">{{ $data->plate_number }}</option>
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
<!-- Include jQuery -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<!-- Include Owl Carousel JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(document).ready(function(){
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
        $('#addCustomerForm').on('submit', function(event) {
            event.preventDefault(); // Prevent the form from submitting normally



            var selectElement = $('#exampleSelect2');
            var selectedOption = selectElement.find('option:selected');
            var customerId = selectedOption.data('customer-id');
            var plateNumber = selectedOption.val().toUpperCase();

            // Debug statements
            console.log('Selected Option:', selectedOption);
            console.log('Customer ID:', customerId);
            console.log('Plate Number:', plateNumber);



            var isAlreadyAdded = false;
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
                        '<p class="mb-0 plate" data-customer-id="' + customerId + '">' + plateNumber + '</p>' +
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
                    window.location.href = '{{ route("cashier.index") }}';
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
  </script>

@endsection
