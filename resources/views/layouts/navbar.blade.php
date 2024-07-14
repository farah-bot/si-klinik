<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            <img src="{{ asset('img/camar.png') }}" alt="Logo">
            <div class="brand-text">
                <span class="brand-line1">KLINIK PRATAMA</span>
                <span class="brand-line2">CAMAR MANDIRI</span>
            </div>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="dataMasterDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Data Master
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dataMasterDropdown">
                        <li><a class="dropdown-item" href="{{ route('datapengguna') }}">Data Pengguna</a></li>
                        <li><a class="dropdown-item" href="{{ route('datapasien') }}">Data Pasien</a></li>
                        <li><a class="dropdown-item" href="{{ route('datadiagnosa') }}">Data Diagnosa</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="pendaftaranDropdown"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Pendaftaran
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="pendaftaranDropdown">
                        <li><a class="dropdown-item" href="{{ route('dataantrianpoli') }}">Data Antrian Poli</a></li>
                        <li><a class="dropdown-item" href="{{ route('dataantrian') }}">Form Pendaftaran</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="pemeriksaanDropdown"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Pemeriksaan
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="pemeriksaanDropdown">
                        <li><a class="dropdown-item" href="{{ route('datapoliumum') }}">Poli Umum</a></li>
                        <li><a class="dropdown-item" href="{{ route('datapoligigi') }}">Poli Gigi</a></li>
                        <li><a class="dropdown-item" href="{{ route('datapolikia') }}">Poli KIA</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="rekamMedisDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Rekam Medis
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="rekamMedisDropdown">
                        <li><a class="dropdown-item" href="{{ route('riwayatpelayananpasien') }}">Riwayat Pelayanan
                                Pasien</a></li>
                        <li><a class="dropdown-item" href="{{ route('laporankunjungan') }}">Laporan Kunjungan</a></li>
                        <li><a class="dropdown-item" href="{{ route('laporan10besarpenyakit') }}">Laporan 10 Besar Penyakit</a></li>
                        <li><a class="dropdown-item" href="{{ route('laporanjumlahjasapelayanandokter') }}">Laporan
                                Jumlah Jasa Pelayanan Dokter</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown" style="margin-right: 100px;">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="apotekDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Apotek
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="apotekDropdown">
                        <li><a class="dropdown-item" href="{{ route('dataapotek') }}">Data Antrian Apotek</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle text-white d-flex align-items-center" href="#"
                        id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user"></i>
                        <span class="ml-2">{{ auth()->user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="userDropdown">
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
