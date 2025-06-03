<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h5 {
            color: white;
        }

        .sidebar {
            height: 100vh;
            position: fixed;
            background-color: #0061d7;
            padding-top: 20px;
            overflow-y: auto;
            width: 220px;
        }

        .sidebar a {
            color: white;
            display: block;
            padding: 10px;
            text-decoration: none;
        }

        .sidebar a i {
            margin-right: 10px;
        }

        .sidebar a:hover {
            background-color: rgb(19, 115, 232);
        }

        .sidebar a.text-center {
            font-size: 14px;
        }

        .content {
            padding: 20px;
        }

        .card-stats {
            margin-bottom: 20px;
        }

        img {
            width: 100px;
            height: 100px;
        }

    </style>
    <title>Dashboard</title>
</head>

<body>
    <nav class="col-md-2 d-none d-md-block sidebar">
        <div class="sidebar-sticky">

            <div class="text-center">
                <img src="https://smktarunabhakti.net/wp-content/uploads/2020/07/logotbvector-copy.png" alt="Logo"
                    class="logo">
                <h5 class="mt-1">Sisfo Sarpras</h5>
            </div>


            <a href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dasbor</a>

            <a href="#manajemenSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="fas fa-database"></i> Manajemen Data
            </a>
            <div class="collapse" id="manajemenSubmenu">
                <a href="{{ route('users') }}" class="pl-4"><i class="fas fa-user"></i> Pengguna</a>
                <a href="{{ route('items') }}" class="pl-4"><i class="fas fa-box"></i> Barang</a>
                <a href="{{ route('categories') }}" class="pl-4"><i class="fas fa-tags"></i> Kategori</a>
            </div>

            <a href="#transaksiSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="fas fa-exchange-alt"></i> Transaksi
            </a>
            <div class="collapse" id="transaksiSubmenu">
                <a href="{{ route('loans') }}" class="pl-4"><i class="fas fa-hand-holding"></i> Peminjaman</a>
                <a href="{{ route('returns') }}" class="pl-4"><i class="fas fa-undo-alt"></i> Pengembalian</a>
            </div>

            <a href="#laporanSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="fas fa-chart-line"></i> Laporan
            </a>
            <div class="collapse" id="laporanSubmenu">
                <a href="{{ route('users.report') }}" class="pl-4"><i class="fas fa-file-alt"></i> Laporan
                    Pengguna</a>
                <a href="{{ route('items.report') }}" class="pl-4"><i class="fas fa-file-invoice"></i> Laporan
                    Barang</a>
                <a href="{{ route('loans.report') }}" class="pl-4"><i class="fas fa-file-signature"></i> Laporan
                    Peminjaman</a>
                <a href="{{ route('returns.report') }}" class="pl-4"><i class="fas fa-file-export"></i> Laporan
                    Pengembalian</a>
            </div>

            <a href="#" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt"></i> Keluar
            </a>


            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>


        </div>
    </nav>

    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f5f6fa;
    margin: 0;
    padding: 0;
}

.sidebar {
    height: 100vh;
    position: fixed;
    background-color: #0061d7;
    padding-top: 20px;
    overflow-y: auto;
    width: 220px;
    box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
}

.sidebar .logo {
    width: 80px;
    height: 80px;
    border-radius: 10px;
}

.sidebar h5 {
    color: #ffffff;
    font-size: 18px;
    font-weight: bold;
}

.sidebar a {
    color: #ffffff;
    display: block;
    padding: 12px 20px;
    text-decoration: none;
    font-size: 15px;
    transition: background-color 0.3s ease, padding-left 0.3s ease;
}

.sidebar a i {
    margin-right: 10px;
}

.sidebar a:hover {
    background-color: rgba(255, 255, 255, 0.1);
    padding-left: 25px;
    text-decoration: none;
}

.sidebar .font-weight-bold {
    font-size: 13px;
    opacity: 0.8;
    text-transform: uppercase;
    margin-top: 10px;
}

.content {
    margin-left: 230px;
    padding: 30px;
    min-height: 100vh;
}

img.logo {
    width: 90px;
    height: 90px;
    object-fit: contain;
}

.modal-content {
    border-radius: 10px;
}

.modal-header {
    background-color: #0061d7;
    color: white;
    border-bottom: none;
}

.modal-footer .btn-danger {
    background-color: #d63031;
    border: none;
}

@media (max-width: 768px) {
    .sidebar {
        position: relative;
        width: 100%;
        height: auto;
    }

    .content {
        margin-left: 0;
    }
}


    </style>
    <title>Dashboard</title>
</head>

<body>
    <nav class="col-md-2 d-none d-md-block sidebar">
        <div class="sidebar-sticky">
            <div class="text-center">
                <img src="https://smktarunabhakti.net/wp-content/uploads/2020/07/logotbvector-copy.png" alt="Logo" class="logo">
                <h5 class="mt-1">Sisfo Sarpras</h5>
            </div>



            <!-- Grup: Manajemen Data -->
            <div class="mt-3 pl-3 text-white font-weight-bold">Menu Utama</div>
            <a href="{{ route('dashboard') }}" class="pl-4"><i class="fas fa-tachometer-alt"></i> Dasbor</a>
            <a href="{{ route('loans') }}" class="pl-4"><i class="fas fa-hand-holding"></i> Peminjaman</a>
            <a href="{{ route('returns') }}" class="pl-4"><i class="fas fa-undo-alt"></i> Pengembalian</a>

            <!-- Grup: Transaksi -->
            <div class="mt-3 pl-3 text-white font-weight-bold">Manajemen Data</div>
            <a href="{{ route('users') }}" class="pl-4"><i class="fas fa-user"></i> Pengguna</a>
            <a href="{{ route('items') }}" class="pl-4"><i class="fas fa-box"></i> Barang</a>
            <a href="{{ route('categories') }}" class="pl-4"><i class="fas fa-tags"></i> Kategori</a>

            <!-- Grup: Laporan -->
            <div class="mt-3 pl-3 text-white font-weight-bold">Laporan</div>
            <a href="{{ route('users.report') }}" class="pl-4"><i class="fas fa-file-alt"></i> Laporan Pengguna</a>
            <a href="{{ route('items.report') }}" class="pl-4"><i class="fas fa-file-invoice"></i> Laporan Barang</a>
            <a href="{{ route('loans.report') }}" class="pl-4"><i class="fas fa-file-signature"></i> Laporan Peminjaman</a>
            <a href="{{ route('returns.report') }}" class="pl-4"><i class="fas fa-file-export"></i> Laporan Pengembalian</a>

            <!-- Logout -->
            <div class="mt-3 pl-3 text-white font-weight-bold">Akun</div>
            <a href="#" data-toggle="modal" data-target="#logoutModal" class="pl-4">
                <i class="fas fa-sign-out-alt"></i> Keluar
            </a>

            <form id="logout-form" action="{{ route('logout') }}"  method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </nav>

<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Keluar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin keluar dari web ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" onclick="document.getElementById('logout-form').submit();">Keluar</button>
            </div>
        </div>
    </div>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
