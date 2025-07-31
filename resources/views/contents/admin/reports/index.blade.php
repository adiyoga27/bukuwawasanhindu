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
                        Real-time analytics for Stream ID: 11614497153 | Measurement ID: G-R8F2CPYZ6L
                    </p>

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
                            <button class="btn btn-primary" id="apply-date-range">Apply</button>
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
                                                <!-- Will be populated by JavaScript -->
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

@endsection

@section('scripts')
<!-- Apex Charts -->
<script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

<!-- Google Analytics API -->
   <script>
document.addEventListener('DOMContentLoaded', async function () {
    const data = await fetchAnalyticsData();
    updateSummaryCards(data);
    initUsersSessionsChart(data.usersSessionsData);
    initTrafficSourcesChart(data.trafficSources);
    initDevicesChart(data.devices);
    populateTopPagesTable(data.topPages);

    document.getElementById('apply-date-range').addEventListener('click', function () {
        alert('Date range change. Implement date-based fetching here.');
    });
});

async function fetchAnalyticsData() {
    const res = await fetch('/admin/report/google-analytics/data');
    return await res.json();
}

function updateSummaryCards(data) {
    document.getElementById('total-users').textContent = data.users.toLocaleString();
    document.getElementById('prev-period-users').textContent = data.prevUsers?.toLocaleString() ?? '0';
    const userGrowth = growthPercent(data.users, data.prevUsers);
    document.getElementById('user-growth-bar').style.width = userGrowth + '%';
    document.getElementById('user-growth-bar').setAttribute('aria-valuenow', userGrowth);

    document.getElementById('total-sessions').textContent = data.sessions.toLocaleString();
    document.getElementById('prev-period-sessions').textContent = data.prevSessions?.toLocaleString() ?? '0';
    const sessionGrowth = growthPercent(data.sessions, data.prevSessions);
    document.getElementById('session-growth-bar').style.width = sessionGrowth + '%';
    document.getElementById('session-growth-bar').setAttribute('aria-valuenow', sessionGrowth);

    document.getElementById('avg-session-duration').textContent = data.avgDuration ?? '0s';
    document.getElementById('prev-period-duration').textContent = data.prevAvgDuration ?? '0s';

    document.getElementById('bounce-rate').textContent = data.bounceRate + '%';
    document.getElementById('prev-period-bounce').textContent = data.prevBounceRate + '%';
    document.getElementById('bounce-rate-bar').style.width = data.bounceRate + '%';
    document.getElementById('bounce-rate-bar').setAttribute('aria-valuenow', data.bounceRate);
}

function growthPercent(current, previous) {
    if (!previous || previous === 0) return 100;
    return Math.abs(((current - previous) / previous) * 100).toFixed(1);
}

function initUsersSessionsChart(chartData) {
    const options = {
        series: [
            { name: 'Users', data: chartData.users },
            { name: 'Sessions', data: chartData.sessions }
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
        xaxis: { categories: chartData.dates },
        tooltip: { shared: true }
    };
    new ApexCharts(document.querySelector("#users-sessions-chart"), options).render();
}

function initTrafficSourcesChart(data) {
    const options = {
        series: data.series,
        chart: { height: 350, type: 'donut' },
        labels: data.labels,
        colors: ['#4f6cec', '#2c3e50', '#e74c3c', '#3498db', '#2ecc71'],
        legend: { position: 'bottom' },
        responsive: [{
            breakpoint: 480,
            options: {
                chart: { width: 200 },
                legend: { position: 'bottom' }
            }
        }]
    };
    new ApexCharts(document.querySelector("#traffic-sources-chart"), options).render();
}

function initDevicesChart(data) {
    const options = {
        series: data.series,
        chart: { height: 350, type: 'radialBar' },
        plotOptions: {
            radialBar: {
                dataLabels: {
                    name: { fontSize: '22px' },
                    value: { fontSize: '16px' },
                    total: {
                        show: true,
                        label: 'Devices',
                        formatter: () => '100%'
                    }
                }
            }
        },
        labels: data.labels,
        colors: ['#4f6cec', '#ffd166', '#2ecc71'],
    };
    new ApexCharts(document.querySelector("#devices-chart"), options).render();
}

function populateTopPagesTable(pages) {
    const table = document.getElementById('top-pages-table');
    table.innerHTML = '';
    pages.forEach(p => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${p.page}</td>
            <td>${p.views.toLocaleString()}</td>
            <td><span class="${p.change >= 0 ? 'text-success' : 'text-danger'}">
                ${p.change >= 0 ? '+' : ''}${p.change}% <i class="fas fa-arrow-${p.change >= 0 ? 'up' : 'down'} ms-1"></i>
            </span></td>`;
        table.appendChild(row);
    });
}

</script>
@endsection