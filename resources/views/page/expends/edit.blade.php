@extends('cashier.index')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
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

                        <!-- Edit form for expends -->
                        <form action="{{ route('expends.update', $expend->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <input type="hidden" name="date" value="{{ old('date', $expend->date) }}">
                            <input type="hidden" name="time" value="{{ old('time', $expend->time) }}">

                            <div id="expends-container">
                                @foreach ($expends as $index => $expend)
                                    <div class="expend-form" data-index="{{ $index }}">
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <label for="expend_name_{{ $index }}">Nama Pengeluaran</label>
                                                <div class="form-group">
                                                    <input type="text" name="expends[{{ $index }}][expend_name]" value="{{ old('expends.'.$index.'.expend_name', $expend->expend_name) }}" class="form-control" id="expend_name_{{ $index }}" placeholder="Nama Pengeluaran">
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <label for="expend_price_{{ $index }}">Harga Pengeluaran</label>
                                                <div class="form-group">
                                                    <input type="text" name="expends[{{ $index }}][expend_price]" value="{{ old('expends.'.$index.'.expend_price', $expend->expend_price) }}" class="form-control" id="expend_price_{{ $index }}" placeholder="Harga Pengeluaran">
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <button type="button" class="btn btn-danger remove-expend" data-index="{{ $index }}">Remove</button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="row mt-4">
                                <div class="col-xl-6">
                                    <button type="button" id="add-expend" class="btn btn-secondary w-100 mb-2">Add Expend</button>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-xl-6">
                                    <button type="submit" class="btn bg-gradient-info w-100">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            var index = {{ count($expends) }}; // Start with the next index

            $('#add-expend').on('click', function() {
                var newExpendForm = `
                    <div class="expend-form" data-index="` + index + `">
                        <div class="row">
                            <div class="col-xl-6">
                                <label for="expend_name_` + index + `">Nama Pengeluaran</label>
                                <div class="form-group">
                                    <input type="text" name="expends[` + index + `][expend_name]" class="form-control" id="expend_name_` + index + `" placeholder="Nama Pengeluaran">
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <label for="expend_price_` + index + `">Harga Pengeluaran</label>
                                <div class="form-group">
                                    <input type="text" name="expends[` + index + `][expend_price]" class="form-control" id="expend_price_` + index + `" placeholder="Harga Pengeluaran">
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <button type="button" class="btn btn-danger remove-expend" data-index="` + index + `">Remove</button>
                            </div>
                        </div>
                    </div>
                `;

                $('#expends-container').append(newExpendForm);
                index++;
            });

            // Remove expend form
            $(document).on('click', '.remove-expend', function() {
                var expendIndex = $(this).data('index');
                $('.expend-form[data-index="' + expendIndex + '"]').remove();
            });
        });
    </script>
@endsection
