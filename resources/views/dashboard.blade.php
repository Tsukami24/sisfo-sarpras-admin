<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>

<body>
    @include('sidebar')
    <div class="container-fluid">
        <div class="row">
            <main class="col-md-9 ml-sm-auto col-lg-10 px-4 content">
                <h2 class="mt-4">Dashboard</h2>
                <p>Welcome back, {{ Auth::guard('admin')->user()->name }}</p>

                <div class="row">
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
            </main>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>
