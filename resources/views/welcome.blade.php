<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    <link rel="icon" href="{{ asset('img/camar.png') }}" type="image/png">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('img/camar.png') }}" alt="Logo"> 
                <div class="brand-text">
                    <span class="brand-line1">KLINIK PRATAMA</span>
                    <span class="brand-line2">CAMAR MANDIRI</span>
                </div>
            </a>
        </div>
    </nav>
    <div class="container-welcome">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-8 col-sm-10">
                    <div class="welcome-header">
                    <h1><span class="bold-text">SI - KLINIK PRATAMA CAMAR MANDIRI JEMBER</span></h1>
                    </div>
                    <p>Menjadikan Klinik Pratama terdepan yang memberi pelayanan kesehatan prima bagi masyarakat Jember dan sekitarnya</p>
                    <a href="{{ route('login') }}" class="btn btn-masuk btn-lg rounded-pill">Masuk</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" 
    integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>
