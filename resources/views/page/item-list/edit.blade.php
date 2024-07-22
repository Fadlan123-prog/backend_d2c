@extends('dashboard.index')

@section('page', 'Add Item')
@section('title', 'Add Item')

@section('content')
<div class="row">
    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">
                @if(session('success'))
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
                <form action="{{ route('items.update', $item->id)}}" method="POST">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-xl-6">
                            <label for="items_name">Nama Item</label>
                            <div class="form-group">
                                <input type="text" name="item[items_name]" value="{{ $item->items_name }}" class="form-control" id="items_name" placeholder="Nama Item">
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label for="Category">Category</label>
                                <select class="form-control" name="item[category_id]" id="Category">
                                    <option value="" disabled selected>Pilih Kategori</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ $category->id == $item->id ? 'selected' : '' }}>{{ $category->categories_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Harga Item Form Group -->
                    <div class="row" id="hargaItemContainer">
                        <div class="col-xl-6">
                            <label for="harga_item">Harga</label>
                            <div class="form-group">
                                <input type="text" name="item[harga_item]" value="{{ $item->harga_item }}" class="form-control" id="harga_item" placeholder="Harga Item">
                            </div>
                        </div>
                    </div>

                    <div id="sizesContainer">
                        @foreach($item->sizes as $size)
                            <div class="row size-row">
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label for="size">Size</label>
                                        <select class="form-control" name="sizes[{{ $loop->index }}][size_id]">
                                            <option value="" disabled selected>Pilih Ukuran</option>
                                            @foreach ($sizes as $availableSize)
                                                <option value="{{ $availableSize->id }}" {{ $availableSize->id == $size->id ? 'selected' : '' }}>{{ $availableSize->size }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label for="size_price">Harga</label>
                                        <input type="text" name="sizes[{{ $loop->index }}][price]" value="{{ formatRupiah(old('sizes.' . $loop->index . '.price', $size->pivot->price)) }}" class="form-control" placeholder="Harga Size">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="row mt-4">
                        <div class="col-xl-6">
                            <button type="button" class="btn btn-success" id="addSizeButton">Add Size</button>
                            <button type="button" class="btn btn-danger" id="removeSizeButton" style="display: none;">Remove Size</button>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-xl-6">
                            <button type="submit" class="btn bg-gradient-info w-100">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    let sizeIndex = 0;

    const hargaItemContainer = document.getElementById('hargaItemContainer');
    const sizesContainer = document.getElementById('sizesContainer');
    const addSizeButton = document.getElementById('addSizeButton');
    const removeSizeButton = document.getElementById('removeSizeButton');

    // Function to toggle the visibility of the harga item field
    function toggleHargaItemField() {
        if (sizesContainer.children.length > 0) {
            hargaItemContainer.style.display = 'none';
            removeSizeButton.style.display = 'inline-block';
        } else {
            hargaItemContainer.style.display = 'block';
            removeSizeButton.style.display = 'none';
        }
    }

    // Initial check
    toggleHargaItemField();

    // Function to add new size row
    addSizeButton.addEventListener('click', function () {
        const newSizeRow = document.createElement('div');
        newSizeRow.classList.add('row', 'size-row');
        newSizeRow.innerHTML = `
            <div class="col-xl-6">
                <div class="form-group">
                    <label for="size">Size</label>
                    <select class="form-control" name="sizes[${sizeIndex}][size_id]">
                        <option value="" disabled selected>Pilih Ukuran</option>
                        @foreach ($sizes as $size)
                            <option value="{{ $size->id }}">{{ $size->size }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label for="size_price">Harga</label>
                    <input type="text" name="sizes[${sizeIndex}][price]" class="form-control" placeholder="Harga Size">
                </div>
            </div>
        `;
        sizesContainer.appendChild(newSizeRow);
        sizeIndex++;
        toggleHargaItemField();
    });

    // Function to remove size row
    removeSizeButton.addEventListener('click', function () {
        if (sizesContainer.lastElementChild) {
            sizesContainer.removeChild(sizesContainer.lastElementChild);
            toggleHargaItemField();
        }
    });
});
</script>
@endsection
