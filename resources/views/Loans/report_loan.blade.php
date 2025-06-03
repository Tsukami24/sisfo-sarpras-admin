<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Laporan Peminjaman</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
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

        .action-buttons form {
            display: inline-block;
            margin: 0 2px;
        }

        @media (max-width: 768px) {
            .content {
                margin-left: 0;
                padding: 15px 10px;
            }
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

        #tabeluser {
            min-width: 1200px;
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

                <h2 class="mb-3">Laporan Peminjaman</h2>
                <p>Halo, {{ Auth::guard('admin')->user()->name }}</p>

                <div class="mt-5">
                    <div class="d-flex justify-content-between mb-3">
                        <a href="loans/export/" class="btn btn-success btn-lg">Unduh Excel</a>
                    </div>

                    <table id="tabeluser" class="table table-bordered table-striped nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Id</th>
                                <th>Pengguna</th>
                                <th>Admin</th>
                                <th>Barang</th>
                                <th>Jumlah</th>
                                <th>Alasan</th>
                                <th>Tanggal Peminjaman</th>
                                <th>Tanggal Pengembalian</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($loan_items as $index => $loan_item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ 'PMJ' . str_pad($loan_item->loan->id, 3, '0', STR_PAD_LEFT) }}</td>
                                    <td>{{ $loan_item->loan->user->name ?? '-' }}</td>
                                    <td>{{ $loan_item->loan->admin->name ?? '-' }}</td>
                                    <td>{{ $loan_item->item->name ?? 'Item telah dihapus' }}</td>
                                    <td>{{ $loan_item->quantity }}</td>
                                    <td>{{ $loan_item->loan->reason }}</td>
                                    <td>{{ \Carbon\Carbon::parse($loan_item->loan->loan_date)->translatedFormat('d F Y H:i') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($loan_item->loan->return_date)->translatedFormat('d F Y H:i') }}</td>
                                    <td>
                                        @php
                                            $status = $loan_item->loan->status;
                                            $statusClass = match($status) {
                                                'ditunda' => 'text-secondary',
                                                'disetujui' => 'text-warning',
                                                'ditolak' => 'text-danger',
                                                default => 'text-success'
                                            };
                                        @endphp
                                        <span class="{{ $statusClass }}">{{ ucfirst($status) }}</span>
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
                    emptyTable: "Tidak ada data peminjaman",
                }
            });
        });
    </script>
</body>

</html>
