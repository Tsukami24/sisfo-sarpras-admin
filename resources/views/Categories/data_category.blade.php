<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Kategori</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet" />

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .content {
            margin-left: 220px;
            padding: 30px 20px;
        }

        .table thead {
            background-color: #0061d7;
            color: white;
        }

        .table tbody tr:hover {
            background-color: #f1f1f1;
        }

        .btn-primary {
            background-color: #0061d7;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0051ba;
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
        }

        .btn-danger:hover {
            background-color: #bd2130;
        }

        .alert {
            margin-top: 20px;
        }

        .action-buttons a,
        .action-buttons form {
            display: inline-block;
        }

        div.dataTables_wrapper div.dataTables_filter {
            position: sticky;
            top: 0;
            background: white;
            z-index: 11;
            padding: 10px 0;
        }

        div.dataTables_wrapper div.dataTables_paginate {
            position: sticky;
            bottom: 0;
            background: white;
            z-index: 11;
            padding: 10px 0;
        }
    </style>
</head>

<body>
    @include('sidebar')
    <div class="container-fluid">
        <div class="row">
            <main class="col-md-9 ml-sm-auto col-lg-10 px-4 content">
                @if (session('success'))
                    <div class="alert alert-success mt-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <h2 class="mt-4">Daftar Kategori</h2>
                <p>Halo, {{ Auth::guard('admin')->user()->name }}</p>

                <div class="container mt-5">
                    <div class="d-flex justify-content-between mb-3">
                        <a href="{{ route('create.category') }}" class="btn btn-primary btn-lg">Tambah Kategori</a>
                    </div>
                    <table id="tabelcategory" class="table table-bordered table-striped nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Id</th>
                                <th>Nama</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $index => $category)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ 'KTG' . str_pad($category->id, 3, '0', STR_PAD_LEFT) }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td class="action-buttons">
                                        <a href="{{ route('categoryshow.edit', $category->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('category.destroy', $category->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this Category?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#tabelcategory').DataTable({
                scrollX: true,
                ordering: true,
                pageLength: 10,
                lengthChange: false,
                language: {
                    search: "Cari:",
                    paginate: {
                        previous: "Sebelumnya",
                        next: "Berikutnya"
                    },
                    emptyTable: "Tidak ada data kategori"
                }
            });
        });
    </script>
</body>

</html>
