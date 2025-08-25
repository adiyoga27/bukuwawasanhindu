@extends('layouts.admin')
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Google Analytics Dashboard</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                        <li class="breadcrumb-item active">Analytics</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <!-- Users -->
        <div class="col-md-3">
            <div class="card mini-stats-wid">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted fw-medium">Users</p>
                        <h4 class="mb-0">{{ number_format($report['total_users']) }}</h4>
                    </div>
                    <div class="avatar-sm rounded-circle bg-primary">
                        <span class="avatar-title">
                            <i class="bx bx-user font-size-24"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sessions -->
        <div class="col-md-3">
            <div class="card mini-stats-wid">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted fw-medium">Sessions</p>
                        <h4 class="mb-0">{{ number_format($report['total_sessions']) }}</h4>
                    </div>
                    <div class="avatar-sm rounded-circle bg-success">
                        <span class="avatar-title">
                            <i class="bx bx-pie-chart-alt font-size-24"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Avg. Duration -->
        <div class="col-md-3">
            <div class="card mini-stats-wid">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted fw-medium">Avg. Duration</p>
                        <h4 class="mb-0">{{ gmdate("i:s", $report['avg_duration']) }}</h4>
                    </div>
                    <div class="avatar-sm rounded-circle bg-warning">
                        <span class="avatar-title">
                            <i class="bx bx-time-five font-size-24"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bounce Rate -->
        <div class="col-md-3">
            <div class="card mini-stats-wid">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted fw-medium">Bounce Rate</p>
                        <h4 class="mb-0">{{ $report['bounce_rate'] }}%</h4>
                    </div>
                    <div class="avatar-sm rounded-circle bg-danger">
                        <span class="avatar-title">
                            <i class="bx bx-exit font-size-24"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Daily Users Chart -->
    <div class="row">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Users & Sessions (Last 30 Days)</h4>
                    <canvas id="usersChart" height="100"></canvas>
                </div>
            </div>
        </div>

        <!-- Traffic Sources -->
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Traffic Sources</h4>
                    @if(count($trafficSources) > 0)
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th>Source</th>
                                    <th>Sessions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($trafficSources as $ts)
                                    <tr>
                                        <td>{{ $ts['source'] }}</td>
                                        <td>{{ number_format($ts['sessions']) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-muted">No traffic data available.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('usersChart').getContext('2d');
    const usersChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode(array_column($report['daily_data'], 'date')) !!},
            datasets: [
                {
                    label: 'Users',
                    data: {!! json_encode(array_column($report['daily_data'], 'users')) !!},
                    borderColor: 'rgba(54, 162, 235, 1)',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    fill: true,
                    tension: 0.3
                },
                {
                    label: 'Sessions',
                    data: {!! json_encode(array_column($report['daily_data'], 'sessions')) !!},
                    borderColor: 'rgba(255, 99, 132, 1)',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    fill: true,
                    tension: 0.3
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'top' },
            }
        }
    });
</script>
@endsection
