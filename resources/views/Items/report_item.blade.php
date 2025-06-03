<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Laporan Barang</title>
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

        .btn-success {
            background-color: #28a745;
            border: none;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .img-thumbnail {
            max-width: 80px;
            height: auto;
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

        div.dataTables_scrollBody {
            overflow-x: auto !important;
        }

        #tabelitem {
            min-width: 1200px;
        }
    </style>
</head>

<body>
    @include('sidebar')
    <div class="container-fluid">
        <div class="row">
            <main class="col-md-10 ml-sm-auto col-lg-10 content">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <h2 class="mb-3">Laporan Barang</h2>
                <p>Halo, <strong>{{ Auth::guard('admin')->user()->name }}</strong></p>

                <div class="d-flex justify-content-between mb-3">
                    <a href="items/export/" class="btn btn-success btn-lg">Unduh Excel</a>
                </div>

                <div class="table-responsive">
                    <table id="tabelitem" class="table table-bordered table-striped nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Id</th>
                                <th>Gambar</th>
                                <th>Nama</th>
                                <th>Deskripsi</th>
                                <th>Stok</th>
                                <th>Kategori</th>
                                <th>Pembuat</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ 'BRG' . str_pad($item->id, 3, '0', STR_PAD_LEFT) }}</td>
                                    <td>
                                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="img-thumbnail" />
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>{{ $item->stock }}</td>
                                    <td>{{ $item->category->name }}</td>
                                    <td>{{ $item->admin->name }}</td>
                                    <td>{{ $item->total }}</td>
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
            $('#tabelitem').DataTable({
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
                    emptyTable: "Tidak ada data barang"
                }
            });
        });
    </script>
</body>

</html>
