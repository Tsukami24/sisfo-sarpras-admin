<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Loan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

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

                <h2 class="mt-4">Loan List</h2>
                <p>Hallo, {{ Auth::guard('admin')->user()->name }}</p>

                <div class="container mt-5">
                    <div class="d-flex justify-content-between mb-3">
                        <a href="loans/export/" class="btn btn-success btn-lg">Download Excel</a>
                    </div>
                    <table id="tabeluser" class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID</th>
                                <th>Peminjaman_id</th>
                                <th>User</th>
                                <th>Admin</th>
                                <th>Barang</th>
                                <th>Jumlah</th>
                                <th>Tanggal Peminjaman</th>
                                <th>Tanggal Pengembalian</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($loan_items as $index => $loan_item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $loan_item->id }}</td>
                                    <td>{{ $loan_item->loan->id }}</td>
                                    <td>{{ $loan_item->loan->user->name ?? '-' }}</td>
                                    <td>{{ $loan_item->loan->admin->name ?? '-' }}</td>
                                    <td>{{ $loan_item->item->name }}</td>
                                    <td>{{ $loan_item->quantity }}</td>
                                    <td>{{ \Carbon\Carbon::parse($loan_item->loan->loan_date)->translatedFormat('d F Y H:i') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($loan_item->loan->return_date)->translatedFormat('d F Y H:i') }}</td>
                                    <td>
                                        @if ($loan_item->loan->status === 'pending')
                                            <form action="{{ route('admin.loans.approve', $loan_item->loan->id) }}"
                                                method="POST" style="display:inline;">
                                                @csrf
                                                <button class="btn btn-success btn-sm">Approve</button>
                                            </form>
                                            <form action="{{ route('admin.loans.reject', $loan_item->loan->id) }}"
                                                method="POST" style="display:inline;">
                                                @csrf
                                                <button class="btn btn-danger btn-sm">Reject</button>
                                            </form>
                                        @elseif ($loan_item->loan->status === 'approved' && !$loan_item->loan->return_date)
                                            <form
                                                action="{{ route('admin.loans.updateReturnDate', $loan_item->loan->id) }}"
                                                method="POST">
                                                @csrf
                                                <input type="datetime-local" name="return_date"
                                                    class="form-control form-control-sm mb-1" required>
                                                <button class="btn btn-primary btn-sm btn-block">Set Return
                                                    Date</button>
                                            </form>
                                        @else
                                            {{ ucfirst($loan_item->loan->status) }}
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




    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#tabeluser').DataTable();
        });
    </script>
</body>

</html>
