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
                        <form action="{{ route('expends.store') }}" method="POST">
                            {{ csrf_field() }}

                            <input type="hidden" name="date">
                            <input type="hidden" name="time">

                            <div id="expends-container">
                                <div class="expend-form" data-index="0">
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <label for="expend_name_0">Nama Pengeluaran</label>
                                            <div class="form-group">
                                                <input type="text" name="expends[0][expend_name]" value="{{ old('expends.0.expend_name') }}" class="form-control" id="expend_name_0" placeholder="Nama Pengeluaran">
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <label for="expend_price_0">Harga Pengeluaran</label>
                                            <div class="form-group">
                                                <input type="text" name="expends[0][expend_price]" value="{{ old('expends.0.expend_price') }}" class="form-control" id="expend_price_0" placeholder="Harga Pengeluaran">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-xl-6">
                                    <button type="button" id="add-expend" class="btn btn-secondary w-100 mb-2">Add Expend</button>
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
    </div>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            var index = 1; // Start with the next index

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

            // Set date and time based on Jakarta time zone
            function setJakartaTime() {
                var now = new Date();
                var jakartaOffset = 7 * 60; // Jakarta is UTC +7
                var localOffset = now.getTimezoneOffset();
                var jakartaTime = new Date(now.getTime() + (jakartaOffset + localOffset) * 60 * 1000);

                var date = jakartaTime.toISOString().split('T')[0]; // Get date in YYYY-MM-DD format
                var time = jakartaTime.toTimeString().split(' ')[0]; // Get time in HH:MM:SS format

                $('#date').val(date);
                $('#time').val(time);
            }

            $('#submit-expends').on('click', function() {
                setJakartaTime();
            });
        });
    </script>
@endsection
