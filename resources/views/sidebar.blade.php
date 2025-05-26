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
            background-color: rgb(0, 97, 215);
            padding-top: 20px;
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

        .content {
            padding: 20px;
        }

        .card-stats {
            margin-bottom: 20px;
        }

        img {
            width: 100px;
            height: 100px;
            margin-left: 55px;
        }
    </style>
    <title>Dashboard</title>
</head>
<body>
    <nav class="col-md-2 d-none d-md-block sidebar">
        <div class="sidebar-sticky">
            <img src="https://smktarunabhakti.net/wp-content/uploads/2020/07/logotbvector-copy.png" alt="Logo" class="logo">

            <a href="{{ route('dashboard') }}"><i class="fas fa-home"></i> Dashboard</a>
            <a href="{{ route('users') }}"><i class="fas fa-users"></i> Users</a>
            <a href="{{ route('items') }}"><i class="fas fa-boxes"></i> Items</a>
            <a href="{{ route('categories') }}"><i class="fas fa-tags"></i> Categories</a>
            <a href="{{ route('loans') }}"><i class="fas fa-hand-holding"></i> Pinjaman</a>
            <a href="{{ route('returns') }}"><i class="fas fa-undo"></i> Pengembalian</a>

            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </nav>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
