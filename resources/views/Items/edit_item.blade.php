<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Barang</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Edit Barang</h5>
            </div>
            <div class="card-body">
                <form action="{{ Route('item.edit', $item->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group row mb-3">
                        <label for="itemName" class="col-sm-2 col-form-label">Nama Barang</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Item Name" value="{{ $item->name }}" required>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="inputDescription" class="col-sm-2 col-form-label">Deskripsi</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="description" name="description"
                                placeholder="Description" value="{{ $item->description }}" required>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="inputStock" class="col-sm-2 col-form-label">Stok</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="stock" name="stock"
                                placeholder="stock" value="{{ $item->stock }}" required>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="inputTotal" class="col-sm-2 col-form-label">Total</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="total" name="total"
                                placeholder="total" value="{{ $item->total }}" required>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Admin</label>
                        <div class="col-sm-10">
                            <p class="form-control-plaintext">{{ Auth::guard('admin')->user()->name }}</p>
                            <input type="hidden" name="admin_id" value="{{ $item->admin_id }}" required">

                        </div>
                    </div>


                    <div class="form-group row mb-3">
                        <label for="Selectcategory" class="col-sm-2 col-form-label">Kategori</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="category_id" id="category_id" required>
                                <option selected>Kategori</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $item->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="inputGambar" class="col-sm-2 col-form-label">Gambar</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <input type="file" class="form-control" id="image" name="image">
                                <label class="input-group-text" for="inputGroupFile02">Pilih File</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-10 offset-sm-2">
                            <button type="submit" class="btn btn-primary">Edit</button>
                            <a href="{{ route('items') }}" class="btn btn-secondary ml-2">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
