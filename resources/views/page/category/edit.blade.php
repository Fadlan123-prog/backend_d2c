@extends('dashboard.index')

@section('page', 'Add Categories')
@section('title', 'Add Categories')

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
                <form action="{{ route('items.category.update', $categories->id ) }}" method="POST">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-xl-6">
                            <label for="categories_name">Nama Category</label>
                            <div class="form-group">
                                <input type="text" name="categories[categories_name]" value="{{ $categories->categories_name }}" class="form-control" id="categories_name" placeholder="Nama Category">
                            </div>
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
@endsection
