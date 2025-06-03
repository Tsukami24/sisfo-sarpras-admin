<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dasbor</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    @include('sidebar')
    <div class="container-fluid">
        <div class="row">
            <main class="col-md-9 ml-sm-auto col-lg-10 px-4 content">
                <h2 class="mt-4">Dasbor</h2>
                <p>Selamat Datang, {{ Auth::guard('admin')->user()->name }}</p>

                <div class="row">
                    <!-- Statistik Kartu -->
                    <div class="col-md-4">
                        <div class="card card-stats bg-primary text-white">
                            <div class="card-body">
                                <h5 class="card-title">Total Pengguna</h5>
                                <p class="card-text">{{ $users }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-stats bg-primary text-white">
                            <div class="card-body">
                                <h5 class="card-title">Total Peminjaman</h5>
                                <p class="card-text">{{ $loans }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-stats bg-primary text-white">
                            <div class="card-body">
                                <h5 class="card-title">Total Pengembalian</h5>
                                <p class="card-text">{{ $returns }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Peminjaman per Bulan</h5>
                                <div style="position: relative; height: 300px;">
                                    <canvas id="loanBarChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Distribusi Data</h5>
                                <div style="position: relative; height: 300px;">
                                    <canvas id="dashboardPieChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


            </main>
        </div>
    </div>

    <script>
        var ctx = document.getElementById('dashboardPieChart').getContext('2d');
        var dashboardPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Pengguna', 'Peminjaman', 'Pengembalian'],
                datasets: [{
                    label: 'Distribusi',
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
                animation: {
                    animateRotate: true,
                    animateScale: true

                },
                plugins: {
                    legend: {
                        position: 'bottom',
                    }
                }
            }

        });

        var ctxBar = document.getElementById('loanBarChart').getContext('2d');
new Chart(ctxBar, {
    type: 'bar',
    data: {
        labels: ['Jumlah Pengguna', 'Jumlah Peminjaman', 'Jumlah Pengembalian'],
        datasets: [{
            label: 'Statistik Peminjaman',
            data: [{{ $users }}, {{ $loans }}, {{ $returns }}],
            backgroundColor: [
                'rgba(255, 99, 132, 0.7)',
                'rgba(54, 162, 235, 0.7)',
                'rgba(75, 192, 192, 0.7)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(75, 192, 192, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        animation: {
            duration: 400,
            easing: 'easeInOutBounce',
            loop: true
        },
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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
