@extends('dashboard.index')

@section('title', 'Sales')
@section('page', 'Sales')

@section('content')
<div class="container">

    <!-- Icon Filter -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- Dropdown icon for category filter -->
                <div class="d-flex justify-content-between p-3">
                    <form id="filter-form" method="GET" action="{{ route('sales.summary.getCategories') }}" class="mb-3">
                        <div class="btn-group">
                            <input type="text" id="date-range" name="date_range"
       value="{{ request('date_range', $startDate . ' - ' . $endDate) }}"
       style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%" />

                            <button class="btn btn-primary" type="submit">Filter</button>
                        </div>
                        <button class="btn btn-dark" id="export-btn">Export to Excel</button>
                    </form>
                    <div class="dropdown">
                        <a class="btn" href="#" id="categoryDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-filter"></i> <!-- Icon for filter -->
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="categoryDropdown">
                            <li><a class="dropdown-item" href="{{ route('sales.summary.getCategories', ['category_id' => '']) }}">All Categories</a></li>
                            @foreach($categories as $category)
                                <li><a class="dropdown-item" href="{{ route('sales.summary.getCategories', ['category_id' => $category->id, 'start_date' => $startDate, 'end_date' => $endDate]) }}">{{ $category->categories_name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table align-items-center mb-0" id="sales-table">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Customer</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" >Item</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" >Quantity</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" >Category</th>
                            </tr>
                        </thead>
                        <tbody id="sales-data">
                            @foreach($salesData as $sale)
                                <tr>
                                    <td class="text-xs font-weight-bold mb-0">{{ $sale->date }}</td>
                                    <td class="text-xs font-weight-bold mb-0">{{ $sale->customer ? $sale->customer->plate_number : 'N/A' }}</td>
                                    <td class="text-xs font-weight-bold mb-0">{{ $sale->salesItems[0]->item->items_name }}</td>
                                    <td class="text-xs font-weight-bold mb-0">{{ $sale->salesItems[0]->quantity }}</td>
                                    <td class="text-xs font-weight-bold mb-0">{{ $sale->salesItems[0]->item->category->categories_name }}</td>
                                </tr>

                                @foreach($sale->salesItems->slice(1) as $salesItem)
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td class="text-xs font-weight-bold mb-0">{{ $salesItem->item->items_name }}</td>
                                        <td class="text-xs font-weight-bold mb-0">{{ $salesItem->quantity }}</td>
                                        <td class="text-xs font-weight-bold mb-0">{{ $salesItem->item->category->categories_name }}</td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Bootstrap Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $salesData->appends(['start_date' => $startDate, 'end_date' => $endDate, 'category_id' => $categoryId])->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
    $(document).ready(function() {
        $('#date-range').daterangepicker({
            locale: {
                format: 'YYYY-MM-DD'
            },
            startDate: '{{ $startDate }}', // Gunakan nilai yang dikirim dari controller
            endDate: '{{ $endDate }}'      // Gunakan nilai yang dikirim dari controller
        });
    });
</script>
@endsection
