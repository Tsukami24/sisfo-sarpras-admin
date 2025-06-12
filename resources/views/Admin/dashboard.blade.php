<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dasbor</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        .bg-blue-custom {
            background-color: #36A2EB !important;
        }

        .bg-yellow-custom {
            background-color: #FFCE56 !important;
            color: #000 !important;
        }

        .bg-teal-custom {
            background-color: #4BC0C0 !important;
        }
    </style>

</head>

<body>
    @include('sidebar')
    <div class="container-fluid">
        <div class="row">
            <main class="col-md-9 ms-sm-auto col-lg-10 px-4 content">
                <h2 class="mt-4">Dasbor</h2>
                <p>Selamat Datang, {{ Auth::guard('admin')->user()->name }}</p>

                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-stats text-white bg-blue-custom">
                            <div class="card-body">
                                <h5 class="card-title">Total Pengguna</h5>
                                <p class="card-text">{{ $users }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-stats text-white bg-yellow-custom">
                            <div class="card-body">
                                <h5 class="card-title">Total Peminjaman</h5>
                                <p class="card-text">{{ $loans }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-stats text-white bg-teal-custom">
                            <div class="card-body">
                                <h5 class="card-title">Total Pengembalian</h5>
                                <p class="card-text">{{ $returns }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Peminjaman per Bulan</h5>
                                <div style="position: relative; height: 300px;">
                                    <canvas id="loanBarChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title">Log Aktivitas</h5>
                                <ul class="list-group list-group-flush" style="max-height: 250px; overflow-y: auto;">
                                    @foreach ($logs as $log)
                                        <li class="list-group-item">
                                            <small class="text-muted">{{ $log->waktu_log }}</small><br>
                                            <strong>{{ $log->action }}</strong><br>
                                            <span>{{ $log->reason }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>

    <script>
        var ctxBar = document.getElementById('loanBarChart').getContext('2d');
        new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: ['Jumlah Pengguna', 'Jumlah Peminjaman', 'Jumlah Pengembalian'],
                datasets: [{
                    label: 'Statistik Peminjaman',
                    data: [{{ $users }}, {{ $loans }}, {{ $returns }}],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `${context.label}: ${context.parsed.y}`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        min: 0,
                        max: 20,
                        title: {
                            display: true,
                            text: 'Jumlah'
                        }
                    }
                }
            }
        });
    </script>

    <!-- Script Bootstrap & jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>
