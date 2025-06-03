<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Laporan Pengembalian</title>
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

        /* Sticky search dan pagination */
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

        #tabeluser {
            min-width: 1300px;
        }

        form.form-inline {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        form.form-inline select.form-control-sm,
        form.form-inline input.form-control-sm {
            width: auto;
            min-width: 100px;
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

                <h2 class="mb-3">Laporan Pengembalian</h2>
                <p>Halo, <strong>{{ Auth::guard('admin')->user()->name }}</strong></p>

                <div class="table-responsive mt-5">

                    <div class="d-flex justify-content-between mb-3">
                        <a href="returns/export/" class="btn btn-success btn-lg">Unduh Excel</a>
                    </div>
                    <table id="tabeluser" class="table table-bordered table-striped nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Id</th>
                                <th>Peminjaman ID</th>
                                <th>Pengguna</th>
                                <th>Admin</th>
                                <th>Barang</th>
                                <th>Jumlah</th>
                                <th>Tgl Pinjam</th>
                                <th>Tgl Kembali</th>
                                <th>Kondisi</th>
                                <th>Denda</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($return_items as $index => $return_item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ 'PMB' . str_pad($return_item->id, 3, '0', STR_PAD_LEFT) }}</td>
                                    <td>{{ 'PMJ' . str_pad($return_item->loan->id, 3, '0', STR_PAD_LEFT) }}</td>
                                    <td>{{ $return_item->loan->user->name ?? '-' }}</td>
                                    <td>{{ $return_item->admin->name ?? '-' }}</td>
                                    <td>{{ $return_item->item->name ?? 'Item telah dihapus' }}</td>
                                    <td>{{ $return_item->quantity }}</td>
                                    <td>{{ \Carbon\Carbon::parse($return_item->loan->loan_date)->translatedFormat('d M Y H:i') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($return_item->returned_date)->translatedFormat('d M Y H:i') }}</td>
                                    <td>{{ ucfirst($return_item->condition) }}</td>
                                    <td>Rp{{ number_format($return_item->fine, 0, ',', '.') }}</td>
                                    <td>
                                        @php
                                            $status = $return_item->loan->status;
                                            $statusClass = match($status) {
                                                'ditunda' => 'text-secondary',
                                                'disetujui' => 'text-warning',
                                                'ditolak' => 'text-danger',
                                                default => 'text-success'
                                            };
                                        @endphp
                                        <span class="{{ $statusClass }}">{{ ucfirst($status) }}</span>
                                    </td>
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
            $('#tabeluser').DataTable({
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
                    emptyTable: "Tidak ada data pengembalian",
                }
            });
        });
    </script>
</body>

</html>
