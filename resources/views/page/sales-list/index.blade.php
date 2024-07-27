@extends('cashier.index')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif
            <!-- Rest of the content -->
        </div>
    </div>
</div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Sales List</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Plate Number</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Hour</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Cashier</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Item</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total payment</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Payment Type</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sales as $sale)
                                        <tr>
                                            <td>{{ $sale->plate_number }}</td>
                                            <td>{{ $sale->date }}</td>
                                            <td>{{ $sale->time }}</td>
                                            <td>{{ $sale->cashier_name }}</td>
                                            <td>{{ $sale->item_name }}</td>
                                            <td>{{ $sale->total_price }}</td>
                                            <td>{{ $sale->payment_method }}</td>
                                            <td>
                                                <form action="{{ route('sales.void') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="sale_id" value="{{ $sale->id }}">
                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#voidSaleModal{{ $sale->id }}">
                                                        Void
                                                    </button>
                                                </form>

                                                <!-- Void Sale Modal -->
                                                <div class="modal fade" id="voidSaleModal{{ $sale->id }}" tabindex="-1" aria-labelledby="voidSaleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="voidSaleModalLabel">Confirm Void Sale</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('sales.void') }}" method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="sale_id" value="{{ $sale->id }}">
                                                                    <div class="mb-3">
                                                                        <label for="adminName" class="form-label">Admin Name</label>
                                                                        <input type="text" class="form-control" id="adminName" name="name" required>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="adminPassword" class="form-label">Admin Password</label>
                                                                        <input type="password" class="form-control" id="adminPassword" name="password" required>
                                                                    </div>
                                                                    <button type="submit" class="btn btn-primary">Confirm</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
