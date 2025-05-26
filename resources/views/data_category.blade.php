<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Category</title>
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
                <h2 class="mt-4">Item List</h2>
                <p>Hallo, {{ Auth::guard('admin')->user()->name }}</p>

                <div class="container mt-5">
                    <div class="d-flex justify-content-between mb-3">
                        <a href="{{ route('create.category') }}" class="btn btn-primary btn-lg">Input Category</a>
                    </div>
                    <table id="tabelcategory" class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $index => $category)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        <a href="{{ route('categoryshow.edit', $category->id) }}">Edit</a> |
                                        <form action="{{ route('category.destroy', $category->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this Category?')">Delete</button>
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
        $(document).ready(function() {
            $('#tabelcategory').DataTable();
        });
    </script>

</body>

</html>
