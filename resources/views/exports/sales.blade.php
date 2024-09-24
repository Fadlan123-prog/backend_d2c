<table>
    <thead>
        <tr>
            <th>Date</th>
            <th>Customer</th>
            <th>Item</th>
            <th>Quantity</th>
            <th>Category</th>
        </tr>
    </thead>
    <tbody>
        @foreach($salesData as $sale)
            @foreach($sale->salesItems as $index => $salesItem)
                <tr>
                    {{-- Tampilkan customer hanya untuk item pertama --}}
                    @if ($loop->first)
                        <td>{{ $sale->date }}</td>
                        <td>{{ $sale->customer ? $sale->customer->plate_number : 'N/A' }}</td>
                    @else
                        <td></td>
                        <td></td>
                    @endif

                    {{-- Tampilkan item, quantity, dan category --}}
                    <td>{{ $salesItem->item->items_name }}</td>
                    <td>{{ $salesItem->quantity }}</td>
                    <td>{{ $salesItem->item->category->categories_name }}</td>
                </tr>
            @endforeach
        @endforeach
    </tbody>
</table>
