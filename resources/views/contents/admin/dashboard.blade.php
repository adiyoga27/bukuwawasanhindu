@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <h4 class="mb-4">Dashboard</h4>


        {{-- Statistik Utama --}}
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h6>Total Pengguna</h6>
                        <h3>{{ number_format($totalUsers) }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h6>Total Sesi</h6>
                        <h3>{{ number_format($totalSessions) }}</h3>
                    </div>
                </div>
            </div>
        </div>
        {{-- Grafik Pengguna Harian --}}
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <h5>👥 Pengguna Harian</h5>
                <canvas id="usersChart" height="100"></canvas>
            </div>
        </div>

        {{-- Sumber Trafik --}}
        <div class="row">
           

            <div class="col-lg-9">
                {{-- Halaman Terpopuler --}}
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5>📑 Halaman Terpopuler</h5>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Halaman</th>
                                    <th class="text-center">Jumlah Kunjungan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($topPages as $row)
                                    <tr>
                                        <td>{{ $row['title'] }}</td>
                                        <td class="text-center">{{ number_format($row['views']) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="text-center text-muted">Tidak ada data halaman</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
             <div class="col-lg-3">
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <h5>🌍 Sumber Trafik</h5>
                        <canvas id="trafficChart" height="20"></canvas>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('js')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            // Grafik pengguna harian
            const usersCtx = document.getElementById('usersChart').getContext('2d');
            new Chart(document.getElementById('usersChart').getContext('2d'), {
                type: 'line',
                data: {
                    labels: @json($dailyDates),
                    datasets: [{
                        label: 'Pengguna',
                        data: @json($dailyUsers),
                        borderColor: '#007bff',
                        backgroundColor: 'rgba(0,123,255,0.2)',
                        fill: true,
                        tension: 0.3
                    }]
                }
            });

            // Grafik sumber trafik
            const trafficCtx = document.getElementById('trafficChart').getContext('2d');
            new Chart(document.getElementById('trafficChart').getContext('2d'), {
                type: 'pie',
                data: {
                    labels: @json(array_column($trafficSources, 'source')),
                    datasets: [{
                        data: @json(array_column($trafficSources, 'sessions')),
                        backgroundColor: ['#007bff', '#28a745', '#ffc107', '#dc3545', '#6f42c1']
                    }]
                }
            });
        </script>
    @endsection
