@extends('dashboard.index')

@section('page', 'Edit Coupon')

@section('title', 'Edit Coupon')

@section('content')
<div class="container">
    <a href="{{ route('coupons.index') }}" class="btn btn-secondary mb-3">Back</a>
    <h2>Edit Coupon</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <hr>

    <div class="row">
        <div class="card">
            <div class="card-body">

                <form action="{{ route('coupons.update', $coupon->id) }}" method="POST">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="final_price" id="final_price" value="{{ old('final_price', $coupon->items->first()->pivot->final_price ?? '') }}">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Coupon Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $coupon->name) }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="category_id" class="form-label">Category</label>
                                        <select class="form-select" id="category_id" name="category_id" required>
                                            <option value="">Select Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ $coupon->category_id == $category->id ? 'selected' : '' }}>{{ $category->categories_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="item_id" class="form-label">Item</label>
                                        <select class="form-select" id="item_id" name="items[]" required>
                                            <option value="">Select Item</option>
                                            @foreach($items as $item)
                                                <option value="{{ $item->id }}" {{ in_array($item->id, $coupon->items->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $item->items_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3" id="size-container" style="{{ $coupon->items->first()->sizes->count() > 0 ? '' : 'display: none;' }}">
                                            <label for="size_id" class="form-label">Size</label>
                                            <select class="form-select" id="size_id" name="size_id">
                                                <option value="">Select Size</option>
                                                @foreach($sizes as $size)
                                                    <option value="{{ $size->id }}" {{ $coupon->items->first()->pivot->size_id == $size->id ? 'selected' : '' }}>{{ $size->size }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description">{{ old('description', $coupon->description) }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="expired_date" class="form-label">Expiration Date</label>
                                <input type="date" class="form-control" id="expired_date" name="expired_date" value="{{ old('expired_date', $coupon->expired_date) }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="discount_amount" class="form-label">Discount Amount (Fixed)</label>
                                        <input type="number" class="form-control" id="discount_amount" name="discount_amount" value="{{ old('discount_amount', $coupon->discount_amount) }}" step="0.01">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="discount_percentage" class="form-label">Discount Percentage</label>
                                        <input type="number" class="form-control" id="discount_percentage" name="discount_percentage" value="{{ old('discount_percentage', $coupon->discount_percentage) }}" step="0.01" max="100">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="" class="form-label">Discount Item</label>
                                <div id="discount-items"></div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Coupon</button>
                </form>
            </div>
        </div>
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    var itemsData = @json($items);

    $('#category_id').change(function() {
        var categoryId = $(this).val();
        $.ajax({
            url: '/admin/coupons/get-items-by-category/' + categoryId,
            method: 'GET',
            success: function(response) {
                var itemSelect = $('#item_id');
                itemSelect.empty();
                itemSelect.append('<option value="">Select Item</option>');
                $.each(response.items, function(index, item) {
                    itemSelect.append('<option value="' + item.id + '">' + item.items_name + '</option>');
                });

                itemsData = response.items || [];
            },
            error: function(xhr) {
                console.log('Error fetching items:', xhr);
            }
        });
    });

    $('#item_id').change(function() {
        var itemId = $(this).val();
        var item = itemsData.find(i => i.id == parseInt(itemId));

        if (item && item.sizes && item.sizes.length > 0) {
            var sizeSelect = $('#size_id');
            sizeSelect.empty();
            sizeSelect.append('<option value="">Select Size</option>');
            $.each(item.sizes, function(index, size) {
                sizeSelect.append('<option value="' + size.id + '">' + size.size + '</option>');
            });
            $('#size-container').show();
        } else {
            $('#size-container').hide();
            $('#size_id').empty();
        }
    });

    // Trigger the item change event to populate size options
    $('#item_id').trigger('change');

    $('#discount_amount, #discount_percentage, #item_id, #size_id').on('input change', function() {
        var discountAmount = parseFloat($('#discount_amount').val()) || 0;
        var discountPercentage = parseFloat($('#discount_percentage').val()) || 0;
        var itemId = $('#item_id').val();
        var sizeId = $('#size_id').val();
        var sizeName = $('#size_id option:selected').text();

        if (!itemId) return;

        var item = itemsData.find(i => i.id == parseInt(itemId));
        if (!item) {
            $('#discount-items').html('<p class="text-danger">Item not found.</p>');
            return;
        }

        var originalPrice = parseFloat(item.harga_item) || 0;
        var sizePrice = 0;
        var selectedSizeName = '';

        if (item.sizes && item.sizes.length > 0 && sizeId) {
            var selectedSize = item.sizes.find(s => s.id == parseInt(sizeId));
            if (selectedSize) {
                sizePrice = parseFloat(selectedSize.pivot.price) || 0;
                originalPrice = sizePrice;
                selectedSizeName = selectedSize.size;
            }
        }

        var discountedPrice = originalPrice;

        if (discountAmount > 0) {
            discountedPrice = Math.max(originalPrice - discountAmount, 0);
        }

        if (discountPercentage > 0) {
            discountedPrice = Math.max(originalPrice - (originalPrice * discountPercentage / 100), 0);
        }

        $('#final_price').val(discountedPrice.toFixed(2));

        $('#discount-items').html(
            '<div class="mb-3">' +
                '<div class="card">' +
                    '<div class="card-body">' +
                        '<h5 class="card-title">' + item.items_name + ' ' + selectedSizeName + '</h5>' +
                        '<p class="card-text">Original Price: ' + formatRupiah(originalPrice.toFixed(2)) + '</p>' +
                        '<p class="card-text">Discounted Price: ' + formatRupiah(discountedPrice.toFixed(2)) + '</p>' +
                    '</div>' +
                '</div>' +
            '</div>'
        );
    });

    // Trigger the discount calculation on page load
    $('#discount_amount').trigger('input');

    function formatRupiah(amount) {
        if (!amount) return '';
        return 'Rp ' + amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }

});
</script>
@endsection
