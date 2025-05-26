<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Return List</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
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

                <h2 class="mb-3">Daftar Pengembalian</h2>
                <p>Halo, <strong>{{ Auth::guard('admin')->user()->name }}</strong></p>

                <div class="table-responsive mt-4">
                    <table id="tabeluser" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID</th>
                                <th>Peminjaman ID</th>
                                <th>User</th>
                                <th>Admin</th>
                                <th>Barang</th>
                                <th>Jumlah</th>
                                <th>Tgl Pinjam</th>
                                <th>Tgl Kembali</th>
                                <th>Kondisi</th>
                                <th>Denda</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($return_items as $index => $return_item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $return_item->id }}</td>
                                    <td>{{ $return_item->loan->id }}</td>
                                    <td>{{ $return_item->loan->user->name ?? '-' }}</td>
                                    <td>{{ $return_item->admin->name ?? '-' }}</td>
                                    <td>{{ $return_item->item->name }}</td>
                                    <td>{{ $return_item->quantity }}</td>
                                    <td>{{ \Carbon\Carbon::parse($return_item->loan->loan_date)->translatedFormat('d M Y H:i') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($return_item->returned_date)->translatedFormat('d M Y H:i') }}</td>
                                    <td>{{ ucfirst($return_item->condition) }}</td>
                                    <td>Rp{{ number_format($return_item->fine, 0, ',', '.') }}</td>
                                    <td>{{ ucfirst($return_item->loan->status ?? '-') }}</td>
                                    <td>
                                        @if ($return_item->admin_id === null)
                                            <form action="{{ route('admin.loans.return', $return_item->id) }}" method="POST" class="form-inline">
                                                @csrf
                                                <select name="condition" class="form-control form-control-sm mr-2" required>
                                                    <option value="">Kondisi</option>
                                                    <option value="good">Good</option>
                                                    <option value="damaged">Damaged</option>
                                                    <option value="lost">Lost</option>
                                                </select>
                                                <input type="number" name="fine" class="form-control form-control-sm mr-2" placeholder="Denda (Rp)" required>
                                                <button type="submit" class="btn btn-sm btn-primary">Konfirmasi</button>
                                            </form>
                                        @else
                                            <span class="text-success">Terkonfirmasi</span>
                                        @endif
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

    {{-- JS --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#tabeluser').DataTable();
        });
    </script>
</body>

</html>
