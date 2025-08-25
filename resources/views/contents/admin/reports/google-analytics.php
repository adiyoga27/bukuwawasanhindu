@extends('layouts.admin')
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Google Analytics Report</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Report</a></li>
                        <li class="breadcrumb-item active">Google Analytics</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Google Analytics Dashboard</h4>
                    <p class="card-title-desc">
                        Analytics for Property ID: {{ env('GA4_PROPERTY_ID') }}
                    </p>

                    <!-- Loading Indicator -->
                    <div id="loading-indicator" class="text-center py-5">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-2">Loading analytics data...</p>
                    </div>

                    <!-- Error Message -->
                    <div id="error-message" class="alert alert-danger d-none">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <span id="error-text">Failed to load analytics data.</span>
                    </div>

                    <!-- Analytics Content (initially hidden) -->
                    <div id="analytics-content" class="d-none">
                        <!-- Date Range Selector -->
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <label for="start-date" class="form-label">Start Date</label>
                                <input type="date" class="form-control" id="start-date" value="{{ date('Y-m-d', strtotime('-30 days')) }}">
                            </div>
                            <div class="col-md-3">
                                <label for="end-date" class="form-label">End Date</label>
                                <input type="date" class="form-control" id="end-date" value="{{ date('Y-m-d') }}">
                            </div>
                            <div class="col-md-2 align-self-end">
                                <button class="btn btn-primary" id="apply-date-range">
                                    <i class="fas fa-sync-alt me-1"></i> Apply
                                </button>
                            </div>
                        </div>

                        <!-- Analytics Cards -->
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stats-wid">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <p class="text-muted fw-medium">Users</p>
                                                <h4 class="mb-0" id="total-users">0</h4>
                                            </div>
                                            <div class="flex-shrink-0 align-self-center">
                                                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                                    <span class="avatar-title">
                                                        <i class="fas fa-users font-size-24"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-success" role="progressbar" id="user-growth-bar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <p class="mb-0 text-muted">Previous period: <span class="fw-medium" id="prev-period-users">0</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stats-wid">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <p class="text-muted fw-medium">Sessions</p>
                                                <h4 class="mb-0" id="total-sessions">0</h4>
                                            </div>
                                            <div class="flex-shrink-0 align-self-center">
                                                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                                    <span class="avatar-title">
                                                        <i class="fas fa-globe font-size-24"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-success" role="progressbar" id="session-growth-bar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <p class="mb-0 text-muted">Previous period: <span class="fw-medium" id="prev-period-sessions">0</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stats-wid">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <p class="text-muted fw-medium">Avg. Session Duration</p>
                                                <h4 class="mb-0" id="avg-session-duration">0s</h4>
                                            </div>
                                            <div class="flex-shrink-0 align-self-center">
                                                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                                    <span class="avatar-title">
                                                        <i class="fas fa-clock font-size-24"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-success" role="progressbar" id="duration-growth-bar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <p class="mb-0 text-muted">Previous period: <span class="fw-medium" id="prev-period-duration">0s</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stats-wid">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <p class="text-muted fw-medium">Bounce Rate</p>
                                                <h4 class="mb-0" id="bounce-rate">0%</h4>
                                            </div>
                                            <div class="flex-shrink-0 align-self-center">
                                                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                                    <span class="avatar-title">
                                                        <i class="fas fa-sign-out-alt font-size-24"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-danger" role="progressbar" id="bounce-rate-bar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <p class="mb-0 text-muted">Previous period: <span class="fw-medium" id="prev-period-bounce">0%</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Charts Row -->
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Users & Sessions</h4>
                                        <div id="users-sessions-chart" class="apex-charts" dir="ltr"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Traffic Sources</h4>
                                        <div id="traffic-sources-chart" class="apex-charts" dir="ltr"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Bottom Row -->
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Top Pages</h4>
                                        <div class="table-responsive">
                                            <table class="table table-centered table-nowrap mb-0">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Page</th>
                                                        <th>Views</th>
                                                        <th>% Change</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="top-pages-table">
                                                    <tr>
                                                        <td colspan="3" class="text-center">No data available</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Devices</h4>
                                        <div id="devices-chart" class="apex-charts" dir="ltr"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<!-- Apex Charts -->
<script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const loadingIndicator = document.getElementById('loading-indicator');
    const errorMessage = document.getElementById('error-message');
    const analyticsContent = document.getElementById('analytics-content');
    const errorText = document.getElementById('error-text');

    // Initialize charts with empty data first
    initEmptyCharts();

    // Fetch data on page load
    fetchAnalyticsData();

    // Date range change handler
    document.getElementById('apply-date-range').addEventListener('click', function () {
        fetchAnalyticsData();
    });

    async function fetchAnalyticsData() {
        const startDate = document.getElementById('start-date').value;
        const endDate = document.getElementById('end-date').value;
        
        loadingIndicator.classList.remove('d-none');
        errorMessage.classList.add('d-none');
        analyticsContent.classList.add('d-none');

        try {
            const response = await fetch(`/admin/report/google-analytics/data?start_date=${startDate}&end_date=${endDate}`);
            const data = await response.json();

            if (data.success) {
                updateSummaryCards(data.data);
                initUsersSessionsChart(data.data.daily_data || []);
                analyticsContent.classList.remove('d-none');
            } else {
                throw new Error(data.message || 'Failed to fetch data');
            }
        } catch (error) {
            errorText.textContent = error.message;
            errorMessage.classList.remove('d-none');
        } finally {
            loadingIndicator.classList.add('d-none');
        }
    }

    function initEmptyCharts() {
        // Initialize empty charts
        const emptyOptions = {
            series: [],
            chart: { height: 350, type: 'line' },
            xaxis: { categories: [] }
        };
        
        new ApexCharts(document.querySelector("#users-sessions-chart"), emptyOptions).render();
        new ApexCharts(document.querySelector("#traffic-sources-chart"), {
            series: [],
            chart: { height: 350, type: 'donut' }
        }).render();
        new ApexCharts(document.querySelector("#devices-chart"), {
            series: [],
            chart: { height: 350, type: 'radialBar' }
        }).render();
    }

    function updateSummaryCards(data) {
        document.getElementById('total-users').textContent = data.total_users?.toLocaleString() || '0';
        document.getElementById('prev-period-users').textContent = data.prev_users?.toLocaleString() || '0';
        
        document.getElementById('total-sessions').textContent = data.total_views?.toLocaleString() || '0';
        document.getElementById('prev-period-sessions').textContent = data.prev_views?.toLocaleString() || '0';
        
        document.getElementById('avg-session-duration').textContent = formatDuration(data.avg_duration || 0);
        document.getElementById('prev-period-duration').textContent = formatDuration(data.prev_avg_duration || 0);
        
        document.getElementById('bounce-rate').textContent = (data.bounce_rate || 0) + '%';
        document.getElementById('prev-period-bounce').textContent = (data.prev_bounce_rate || 0) + '%';
    }

    function formatDuration(seconds) {
        if (!seconds) return '0s';
        const mins = Math.floor(seconds / 60);
        const secs = Math.floor(seconds % 60);
        return mins > 0 ? `${mins}m ${secs}s` : `${secs}s`;
    }

    function initUsersSessionsChart(dailyData) {
        const dates = dailyData.map(item => {
            const date = new Date(item.date);
            return `${date.getDate()}/${date.getMonth() + 1}`;
        });
        
        const users = dailyData.map(item => parseInt(item.users || 0));
        const sessions = dailyData.map(item => parseInt(item.views || 0));

        const options = {
            series: [
                { name: 'Users', data: users },
                { name: 'Sessions', data: sessions }
            ],
            chart: {
                height: 350,
                type: 'area',
                toolbar: { show: false }
            },
            colors: ['#4f6cec', '#ffd166'],
            stroke: { curve: 'smooth', width: 2 },
            dataLabels: { enabled: false },
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.45,
                    opacityTo: 0.05,
                    stops: [20, 100, 100, 100]
                }
            },
            xaxis: { categories: dates },
            tooltip: { shared: true }
        };

        // Destroy existing chart and create new one
        const chartElement = document.querySelector("#users-sessions-chart");
        chartElement.innerHTML = '';
        new ApexCharts(chartElement, options).render();
    }
});
</script>
@endsection