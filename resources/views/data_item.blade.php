<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Item List</title>
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

                <h2 class="mb-3">Daftar Item</h2>
                <p>Halo, <strong>{{ Auth::guard('admin')->user()->name }}</strong></p>

                <div class="d-flex justify-content-between mb-3">
                    <a href="items/export/" class="btn btn-success btn-lg">Download Excel</a>
                    <a href="{{ route('create.item') }}" class="btn btn-primary btn-lg">Input Item</a>
                </div>

                <div class="table-responsive">
                    <table id="tabelitem" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Stock</th>
                                <th>Category</th>
                                <th>Maker</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->id }}</td>
                                    <td>
                                        <img src="{{ asset('storage/' . $item->image) }}"
                                             alt="{{ $item->name }}"
                                             class="img-thumbnail">
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>{{ $item->stock }}</td>
                                    <td>{{ $item->category->name }}</td>
                                    <td>{{ $item->admin->name }}</td>
                                    <td>{{ $item->total }}</td>
                                    <td class="action-buttons">
                                        <a href="{{ route('itemshow.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('item.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm mt-1">Delete</button>
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
            $('#tabelitem').DataTable();
        });
    </script>

</body>

</html>
