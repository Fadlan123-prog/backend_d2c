@extends('dashboard.index')

@section('content')
<div class="container">
    <h2>Create Coupon</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('coupons.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Coupon Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select class="form-select" id="category_id" name="category_id" required>
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->categories_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="item_id" class="form-label">Item</label>
            <select class="form-select" id="item_id" name="item_id" required>
                <option value="">Select Item</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="expired_date" class="form-label">Expiration Date</label>
            <input type="date" class="form-control" id="expired_date" name="expired_date" value="{{ old('expired_date') }}" required>
        </div>

        <div class="mb-3">
            <label for="discount_amount" class="form-label">Discount Amount (Fixed)</label>
            <input type="number" class="form-control" id="discount_amount" name="discount_amount" value="{{ old('discount_amount') }}" step="0.01">
        </div>

        <div class="mb-3">
            <label for="discount_percentage" class="form-label">Discount Percentage</label>
            <input type="number" class="form-control" id="discount_percentage" name="discount_percentage" value="{{ old('discount_percentage') }}" step="0.01" max="100">
        </div>

        <button type="submit" class="btn btn-primary">Create Coupon</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#category_id').change(function() {
        var categoryId = $(this).val();
        $.ajax({
            url: 'coupons/get-items-by-category/' + categoryId,
            method: 'GET',
            success: function(response) {
                var itemSelect = $('#item_id');
                itemSelect.empty();
                itemSelect.append('<option value="">Select Item</option>');
                $.each(response.items, function(index, item) {
                    itemSelect.append('<option value="' + item.id + '">' + item.name + '</option>');
                });
            },
            error: function(xhr) {
                console.log('Error fetching items:', xhr);
            }
        });
    });
});
</script>
@endsection
