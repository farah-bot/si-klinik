@extends('layouts.app')

@section('title', 'Data Antrian Pasien Poli Umum')

@section('content')
<div class="data-pengguna-container">
    <div class="container">
        <div class="data-pengguna-header">
            <h2>DATA ANTRIAN PASIEN POLI UMUM</h2>
        </div>

        <div class="d-flex mb-3">
            <input type="text" class="form-control form-control-sm ml-auto" placeholder="Cari Data Pasien" id="search">
        </div>

        <div class="row">
            <div class="col">
                <table class="table table-bordered mt-3">
                    <thead>
                        <tr>
                            <th>Nomor Antrian</th>
                            <th>No. RM</th>
                            <th>Nama Pasien</th>
                            <th>Nomor NIK</th>
                            <th>Alamat</th>
                            <th>Jenis Kelamin</th>
                            <th>Jenis Kunjungan</th>
                            <th>Tanggal Kunjungan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>013</td>
                            <td>1500</td>
                            <td>Aylivia Fudya Ningrum</td>
                            <td>3509218846903710</td>
                            <td>Banyuwangi</td>
                            <td>Perempuan</td>
                            <td>Baru</td>
                            <td>15/01/2023</td>
                            <td>
                                <button class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                <button class="btn btn-primary btn-sm"><i class="fas fa-bullhorn"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>012</td>
                            <td>1508</td>
                            <td>Dita Yusrilia Madini</td>
                            <td>3509012214317810</td>
                            <td>Kebonsari</td>
                            <td>Perempuan</td>
                            <td>Baru</td>
                            <td>15/01/2023</td>
                            <td>
                                <button class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                <button class="btn btn-primary btn-sm"><i class="fas fa-bullhorn"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>011</td>
                            <td>1502</td>
                            <td>Matt Dickerson</td>
                            <td>3509218541903712</td>
                            <td>Patrang</td>
                            <td>Laki - Laki</td>
                            <td>Lama</td>
                            <td>15/01/2023</td>
                            <td>
                                <button class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                <button class="btn btn-primary btn-sm"><i class="fas fa-bullhorn"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>010</td>
                            <td>1501</td>
                            <td>Shanice</td>
                            <td>350921884706600</td>
                            <td>Kaliwates</td>
                            <td>Laki - Laki</td>
                            <td>Lama</td>
                            <td>15/01/2023</td>
                            <td>
                                <button class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                <button class="btn btn-primary btn-sm"><i class="fas fa-bullhorn"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>009</td>
                            <td>1505</td>
                            <td>Brad Masson</td>
                            <td>3509217669037331</td>
                            <td>Jember Kidul</td>
                            <td>Laki - Laki</td>
                            <td>Lama</td>
                            <td>15/01/2023</td>
                            <td>
                                <button class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                <button class="btn btn-primary btn-sm"><i class="fas fa-bullhorn"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>008</td>
                            <td>1506</td>
                            <td>Zahra Putri Wulandari</td>
                            <td>3509217046812732</td>
                            <td>Tegal Besar</td>
                            <td>Perempuan</td>
                            <td>Lama</td>
                            <td>15/01/2023</td>
                            <td>
                                <button class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                <button class="btn btn-primary btn-sm"><i class="fas fa-bullhorn"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>007</td>
                            <td>1504</td>
                            <td>Eko Purnomo</td>
                            <td>3509218046903710</td>
                            <td>Kepatihan</td>
                            <td>Laki - Laki</td>
                            <td>Lama</td>
                            <td>15/01/2023</td>
                            <td>
                                <button class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                <button class="btn btn-primary btn-sm"><i class="fas fa-bullhorn"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>006</td>
                            <td>1507</td>
                            <td>Aditya Ashanka</td>
                            <td>3509118846903713</td>
                            <td>Sempusari</td>
                            <td>Laki - Laki</td>
                            <td>Baru</td>
                            <td>15/01/2023</td>
                            <td>
                                <button class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                <button class="btn btn-primary btn-sm"><i class="fas fa-bullhorn"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>005</td>
                            <td>1503</td>
                            <td>Aisyah Putri Wulandari</td>
                            <td>3509116646503700</td>
                            <td>Kebon Agung</td>
                            <td>Perempuan</td>
                            <td>Lama</td>
                            <td>15/01/2023</td>
                            <td>
                                <button class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                <button class="btn btn-primary btn-sm"><i class="fas fa-bullhorn"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>004</td>
                            <td>1509</td>
                            <td>Sutomo</td>
                            <td>3509113246502100</td>
                            <td>Karangrejo</td>
                            <td>Laki - Laki</td>
                            <td>Lama</td>
                            <td>15/01/2023</td>
                            <td>
                                <button class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                <button class="btn btn-primary btn-sm"><i class="fas fa-bullhorn"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>003</td>
                            <td>1512</td>
                            <td>Budi Susanto</td>
                            <td>3509313200552110</td>
                            <td>Tegal Gede</td>
                            <td>Laki - Laki</td>
                            <td>Lama</td>
                            <td>15/01/2023</td>
                            <td>
                                <button class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                <button class="btn btn-primary btn-sm"><i class="fas fa-bullhorn"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>002</td>
                            <td>1513</td>
                            <td>Wati Darwati</td>
                            <td>3509313200552100</td>
                            <td>Bangsal</td>
                            <td>Perempuan</td>
                            <td>Baru</td>
                            <td>15/01/2023</td>
                            <td>
                                <button class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                <button class="btn btn-primary btn-sm"><i class="fas fa-bullhorn"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>001</td>
                            <td>1514</td>
                            <td>Doni Sasono</td>
                            <td>3509313211553100</td>
                            <td>Kaliwates</td>
                            <td>Laki - Laki</td>
                            <td>Lama</td>
                            <td>15/01/2023</td>
                            <td>
                                <button class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                <button class="btn btn-primary btn-sm"><i class="fas fa-bullhorn"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="d-flex justify-content-between">
            <span>Showing 1 to 13 of 13 entries</span>
            <div>
                <button class="btn btn-secondary btn-sm">Previous</button>
                <button class="btn btn-secondary btn-sm">1</button>
                <button class="btn btn-secondary btn-sm">2</button>
                <button class="btn btn-secondary btn-sm">3</button>
                <button class="btn btn-secondary btn-sm">Next</button>
            </div>
        </div>
    </div>
</div>
@endsection
