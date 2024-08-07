<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="icon" href="{{ asset('img/camar.png') }}" type="image/png">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('welcome')}}">
                <img src="{{ asset('img/camar.png') }}" alt="Logo">
                <div class="brand-text">
                    <span class="brand-line1">KLINIK PRATAMA</span>
                    <span class="brand-line2">CAMAR MANDIRI</span>
                </div>
            </a>
        </div>
    </nav>
    <div class="container form-container d-flex justify-content-center align-items-center">
        <div class="card login-card p-4 glass-effect w-100">
            <div class="card-body">
                <h2 class="bold-text text-center">Masuk</h2>
                
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login.submit') }}">
                    @csrf
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="username" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-masuk btn-lg">Masuk</button>
                    <a href="{{ route('welcome') }}" class="btn btn-kembali btn-lg">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12F3j1jlrc10+U8I4Hj3RIBs62hpH4FZ5f5MoKlDapKPpmBx"
        crossorigin="anonymous"></script>
</body>
</html>
