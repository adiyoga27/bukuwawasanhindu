@extends('layouts.admin')

@section('title', 'Google Analytics Dashboard')

@section('content')
<div class="container-fluid">
    <!-- Page title -->
    <div class="row mb-4">
        <div class="col">
            <h4 class="fw-bold">📊 Google Analytics Dashboard</h4>
            <p class="text-muted">Laporan dari properti GA4 ID: {{ $propertyId ?? '' }}</p>
        </div>
    </div>

    <!-- Report Summary -->
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h6 class="mb-0">Ringkasan Kunjungan</h6>
                </div>
                <div class="card-body">
                    @if(isset($report['rows']) && count($report['rows']) > 0)
                        <table class="table table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Users</th>
                                    <th>Sessions</th>
                                    <th>Pageviews</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($report['rows'] as $row)
                                    <tr>
                                        <td>{{ $row['dimensionValues'][0]['value'] ?? '-' }}</td>
                                        <td>{{ $row['metricValues'][0]['value'] ?? '0' }}</td>
                                        <td>{{ $row['metricValues'][1]['value'] ?? '0' }}</td>
                                        <td>{{ $row['metricValues'][2]['value'] ?? '0' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-muted">Belum ada data laporan.</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Traffic Sources -->
        <div class="col-md-6">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-success text-white">
                    <h6 class="mb-0">Sumber Traffic</h6>
                </div>
                <div class="card-body">
                    @if(isset($trafficSources['rows']) && count($trafficSources['rows']) > 0)
                        <table class="table table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th>Source</th>
                                    <th>Users</th>
                                    <th>Sessions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($trafficSources['rows'] as $row)
                                    <tr>
                                        <td>{{ $row['dimensionValues'][0]['value'] ?? '-' }}</td>
                                        <td>{{ $row['metricValues'][0]['value'] ?? '0' }}</td>
                                        <td>{{ $row['metricValues'][1]['value'] ?? '0' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-muted">Belum ada data sumber traffic.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Debug JSON -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">
                    <h6 class="mb-0">Debug JSON</h6>
                </div>
                <div class="card-body">
                    <pre class="bg-light p-3 rounded" style="max-height:300px; overflow:auto;">
{{ json_encode(['report' => $report, 'trafficSources' => $trafficSources], JSON_PRETTY_PRINT) }}
                    </pre>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
