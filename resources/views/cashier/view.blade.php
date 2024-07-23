@extends('cashier.index')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4">
                    <form class="mt-4" method="POST">
                        {{ csrf_field() }}
                        <div class="form-outline form-white">
                            <div class="input-group">
                                <select class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon" for="customer">
                                  <option selected>Choose...</option>
                                  <option value="1">One</option>
                                  <option value="2">Two</option>
                                  <option value="3">Three</option>
                                </select>
                                <button class="btn btn-outline-secondary" type="button">Submit</button>
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
                                                <div id="selected-items">
                                                    <!-- Selected items will be appended here -->
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <p class="mb-2">Subtotal</p>
                                                    <p class="mb-2" id="subtotal" data-subtotal="0">Rp 0</p>
                                                </div>
                                                <form class="mt-4">
                                                    <div class="form-outline form-white mb-4">
                                                      <input type="text" id="nominal" class="form-control form-control-lg" size="17"
                                                        placeholder="Input Nominal" />
                                                      <label class="form-label" for="nominal">Input Nominal</label>
                                                    </div>
                                                </form>
                                                  <div class="row mb-3">
                                                    <div class="col-12">
                                                        <div class="btn-group" role="group">
                                                            <button type="button" class="btn btn-info btn-md" id="btn-transfer" data-value="">Transfer</button>
                                                            <button type="button" class="btn btn-info btn-md" id="btn-tokopedia" data-value="">Tokopedia</button>
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

                                                  <button type="button" class="btn btn-info btn-block btn-lg" onclick="printReceipt()">
                                                    <div class="d-flex justify-content-between">
                                                        <span>Checkout</span>
                                                    </div>
                                                </button>
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

<section id="items-section" class="mt-5" style="display:none;">
    <div class="container">
        <div class="row" id="items-container">
            <!-- Items will be dynamically loaded here -->
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

    // Handle category button click
    $('.category-btn').click(function() {
      var categoryId = $(this).data('category-id');

      // Make AJAX request to fetch items for the selected category
      $.ajax({
        url: '/items/' + categoryId,
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

    // Handle item card click
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
          '<p class="mb-0">' + itemName + '</p>' +
          '<p class="mb-0">' + formatRupiah(itemPrice) + '</p>' +
        '</div>'
      );

      // Update the subtotal
      var currentSubtotal = parseFloat($('#subtotal').data('subtotal')) || 0;
      var newSubtotal = currentSubtotal + itemPrice;
      $('#subtotal').data('subtotal', newSubtotal);
      $('#subtotal').text(formatRupiah(newSubtotal));

      // Update button values
      $('#btn-transfer').attr('data-value', newSubtotal);
      $('#btn-tokopedia').attr('data-value', newSubtotal);

      // Mark the item as selected
      $(this).addClass('selected');
    });

    // Handle numeric button click
    $('.btn-group').on('click', 'button', function() {
      var value = $(this).data('value');
      $('#nominal').val(formatRupiah(value));
    });

    // Handle input change for the nominal field
    $('#nominal').on('input', function() {
      var value = $(this).val().replace(/\D/g, ''); // Remove non-numeric characters
      $(this).val(formatRupiah(value));
    });
  });

  // Function to format number as Rupiah
  function formatRupiah(amount) {
    if (!amount) return '';
    return 'Rp ' + amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
  }

  function printReceipt() {
    var printContents = document.getElementById('selected-items').innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = '<html><head><title>Receipt</title></head><body>' + printContents + '</body></html>';

    window.print();

    document.body.innerHTML = originalContents;
    location.reload();
  }
</script>
@endsection
