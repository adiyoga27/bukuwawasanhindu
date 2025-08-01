@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title">Stock History for {{ $product->title }}</h3>
                        <div>
                            <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#stockOpnameModal">
                                <i class="fas fa-plus"></i> Stock Opname
                            </button>
                            <a href="{{ url('admin/stocks') }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-arrow-left"></i> Back to Products
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="info-box bg-light">
                                <div class="info-box-content">
                                    <span class="info-box-text text-center">Total In</span>
                                    <span class="info-box-number text-center text-success mb-0">
                                        {{ $product->stocks->sum('in') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-box bg-light">
                                <div class="info-box-content">
                                    <span class="info-box-text text-center">Total Out</span>
                                    <span class="info-box-number text-center text-danger mb-0">
                                        {{ $product->stocks->sum('out') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-box bg-light">
                                <div class="info-box-content">
                                    <span class="info-box-text text-center">Current Stock</span>
                                    <span class="info-box-number text-center font-weight-bold mb-0 
                                        @if(($product->stocks->sum('in') - $product->stocks->sum('out')) < 0) text-danger 
                                        @elseif(($product->stocks->sum('in') - $product->stocks->sum('out')) > 0) text-success @endif">
                                        {{ $product->stocks->sum('in') - $product->stocks->sum('out') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <table id="stockHistoryTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Type</th>
                                <th>Quantity</th>
                                <th>Description</th>
                                <th>Reference</th>
                                <th>Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $runningBalance = 0;
                            @endphp
                            @foreach($stocks as $stock)
                                @php
                                    $runningBalance += $stock->in - $stock->out;
                                @endphp
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($stock->created_at)->format('d/m/Y H:i') }}</td>
                                    <td>
                                        @if($stock->in > 0)
                                            <span class="badge bg-success">IN</span>
                                        @else
                                            <span class="badge bg-danger">OUT</span>
                                        @endif
                                    </td>
                                    <td class="@if($stock->in > 0) text-success @else text-danger @endif">
                                        {{ $stock->in > 0 ? $stock->in : $stock->out }}
                                    </td>
                                    <td>{{ $stock->description }}</td>
                                    <td>{{ $stock->reference }}</td>
                                    <td class="font-weight-bold">{{ $runningBalance }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="bg-light">
                                <td colspan="2"><strong>Total:</strong></td>
                                <td class="text-success">{{ $stocks->sum('in') }}</td>
                                <td class="text-danger">{{ $stocks->sum('out') }}</td>
                                <td></td>
                                <td class="font-weight-bold">{{ $stocks->sum('in') - $stocks->sum('out') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Stock Opname Modal -->
<div class="modal fade" id="stockOpnameModal" tabindex="-1" role="dialog" aria-labelledby="stockOpnameModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="stockOpnameModalLabel">Stock Adjustment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('stocks.store') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Current Stock</label>
                        <input type="text" class="form-control" value="{{ $product->stocks->sum('in') - $product->stocks->sum('out') }}" readonly>
                    </div>
                    
                    <div class="form-group">
                        <label>Adjustment Type</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="adjustment_type" id="stockIn" value="in" checked>
                            <label class="form-check-label" for="stockIn">
                                Stock In
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="adjustment_type" id="stockOut" value="out">
                            <label class="form-check-label" for="stockOut">
                                Stock Out
                            </label>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" min="1" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" placeholder="Reason for adjustment"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="reference">Reference</label>
                        <input type="text" class="form-control" id="reference" name="reference" placeholder="Document reference (optional)">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Adjustment</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(function () {
        $('#stockHistoryTable').DataTable({
            "responsive": true,
            "autoWidth": false,
            "order": [[0, 'desc']],
            "dom": '<"top"f>rt<"bottom"lip><"clear">',
            "buttons": [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
        
        // Auto-focus quantity field when modal opens
        $('#stockOpnameModal').on('shown.bs.modal', function () {
            $('#quantity').focus();
        });
        
        // Validate that either in or out is selected (though radio buttons enforce this)
        $('form').submit(function(e) {
            if (!$('input[name="adjustment_type"]:checked').val()) {
                e.preventDefault();
                alert('Please select adjustment type (Stock In or Stock Out)');
            }
        });
    });
</script>
@endsection