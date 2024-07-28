@extends('cashier.index')

@section('content')
<div class="container">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-3 col-sm-3">
                <a href="{{ route('expends.create') }}">
                    <button type="button" class="btn bg-black">Add Expends Item</button>
                </a>
            </div>
        </div>
        <div class="row mt-4">
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
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Item</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Hour</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($expends as $expend)
                                        <tr>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $expend->expend_name }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $expend->date }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $expend->time }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ formatRupiah($expend->expend_price) }}</p>
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
</div>
@endsection
