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
                            <table class="table align-items center mb-0">
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
                                        <tr class="{{ $sale->status == 'voided' ? 'bg-danger text-white' : '' }}">
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $sale->plate_number }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $sale->date }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $sale->time }}</p>

                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $sale->cashier_name }}</p>

                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $sale->item_name }}</p>

                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $sale->total_price }}</p>

                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $sale->payment_method }}</p>

                                            </td>
                                            <td>
                                                @if ($sale->status != 'voided')
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#voidSaleModal{{ $sale->id }}">
                                                    Void
                                                </button>
                                                @else
                                                <button type="button" class="btn btn-secondary" disabled>
                                                    Voided
                                                </button>
                                                @endif
                                                <a href="{{ route('receipt.show', $sale->id) }}" target="_blank" class="btn btn-success">Print Receipt</a>

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
