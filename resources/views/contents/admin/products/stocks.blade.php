@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Product List with Stock</h3>
                </div>
                <div class="card-body">
                    <table id="productsTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Stock In</th>
                                <th>Stock Out</th>
                                <th>Current Stock</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                @php
                                    $currentStock = $product->total_in - $product->total_out;
                                @endphp
                                <tr>
                                    <td>{{ $product->title }}</td>
                                    <td class="text-success">{{ $product->total_in ?? 0 }}</td>
                                    <td class="text-danger">{{ $product->total_out ?? 0 }}</td>
                                    <td class="font-weight-bold @if($currentStock < 0) text-danger @elseif($currentStock > 0) text-success @endif">
                                        {{ $currentStock }}
                                    </td>
                                    <td>
                                        <a href="{{ url('admin/stocks') }}/{{ $product->id }}" 
                                           class="btn btn-sm btn-info" 
                                           title="View Stock History">
                                            <i class="fas fa-history"></i> Details
                                        </a>
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
@endsection

@section('scripts')
<script>
    $(function () {
        $('#productsTable').DataTable({
            "responsive": true,
            "autoWidth": false,
            "order": [[5, 'desc']],
            "columns": [
                null,
                null,
                null,
                null,
                null,
                null,
                { "orderable": false, "searchable": false }
            ]
        });
    });
</script>
@endsection