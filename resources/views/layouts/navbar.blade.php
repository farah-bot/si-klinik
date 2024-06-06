<nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('img/camar.png') }}" alt="Logo">
                <div class="brand-text">
                    <span class="brand-line1">KLINIK PRATAMA</span>
                    <span class="brand-line2">CAMAR MANDIRI</span>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Dashboard</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dataMasterDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Data Master
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dataMasterDropdown">
                            <li><a class="dropdown-item" href="#">Submenu 1</a></li>
                            <li><a class="dropdown-item" href="#">Submenu 2</a></li>
                            <li><a class="dropdown-item" href="#">Submenu 3</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="pendaftaranDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Pendaftaran
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="pendaftaranDropdown">
                            <li><a class="dropdown-item" href="#">Submenu 1</a></li>
                            <li><a class="dropdown-item" href="#">Submenu 2</a></li>
                            <li><a class="dropdown-item" href="#">Submenu 3</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="pemeriksaanDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Pemeriksaan
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="pemeriksaanDropdown">
                            <li><a class="dropdown-item" href="#">Submenu 1</a></li>
                            <li><a class="dropdown-item" href="#">Submenu 2</a></li>
                            <li><a class="dropdown-item" href="#">Submenu 3</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="rekamMedisDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Rekam Medis
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="rekamMedisDropdown">
                            <li><a class="dropdown-item" href="#">Submenu 1</a></li>
                            <li><a class="dropdown-item" href="#">Submenu 2</a></li>
                            <li><a class="dropdown-item" href="#">Submenu 3</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="apotekDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Apotek
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="apotekDropdown">
                            <li><a class="dropdown-item" href="#">Submenu 1</a></li>
                            <li><a class="dropdown-item" href="#">Submenu 2</a></li>
                            <li><a class="dropdown-item" href="#">Submenu 3</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            User
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="userDropdown">
                            <!-- <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li> -->
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

