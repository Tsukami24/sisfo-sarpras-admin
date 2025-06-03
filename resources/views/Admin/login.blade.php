<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Masuk</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .gradient-custom {
            background: #0061d7;
            background: linear-gradient(to right, rgb(0, 97, 215), rgba(0, 97, 215));
        }

        .logo {
            max-width: 120px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

    <form action="{{ route('login') }}" method="POST">
        @csrf
        <section class="vh-100 gradient-custom">
            <div class="container py-2 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-light text-black" style="border-radius: 1rem;">
                            <div class="card-body p-5 text-center">
                                <img src="https://smktarunabhakti.net/wp-content/uploads/2020/07/logotbvector-copy.png"
                                    alt="Logo" class="logo">

                                <h2 class="fw-bold mb-2 text-uppercase">Masuk</h2>
                                <p class="text-black-50 mb-3">Silakan masukkan nama pengguna dan kata sandi Anda!</p>

                                <div class="form-outline form-white mb-4">
                                    <input type="text" id="name" name="name"
                                        class="form-control form-control-lg" placeholder="Nama" required />
                                </div>

                                <div class="form-outline form-white mb-4">
                                    <input type="password" id="password" name="password"
                                        class="form-control form-control-lg" placeholder="Kata Sandi" required />
                                </div>

                                <button class="btn btn-outline-primary btn-lg px-5" type="submit">Masuk</button>

                                <div class="mt-3" id="message">
                                    @if(session('error'))
                                        <div class="alert alert-danger">{{ session('error') }}</div>
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>

</body>

</html>
