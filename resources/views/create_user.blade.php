<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create User</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Create User</h5>
            </div>
            <div class="card-body">
                <form action="{{ Route('create_user') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row mb-3">
                        <label for="userName" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Username">
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="className" class="col-sm-2 col-form-label">Class</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="class" name="class"
                                placeholder="Class">
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Password">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-10 offset-sm-2">
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
