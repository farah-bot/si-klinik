@extends('layouts.app')

@section('title', 'Data Pengguna')

@section('content')
<div class="data-pengguna-container">
    <div class="container">
        <div class="data-pengguna-header">
            <h2>DATA PASIEN</h2>
        </div>
        <div class="row mb-3">
            <div class="col-lg-12">
                <form id="addPatientForm">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id_pengguna">ID Pasien</label>
                                <input type="text" class="form-control" id="id_pengguna" name="id_pengguna">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_pengguna">Nama Pasien</label>
                                <input type="text" class="form-control" id="nama_pengguna" name="nama_pengguna">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tanggal_lahir">Tanggal Lahir *</label>
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="alamat">Alamat *</label>
                                <textarea class="form-control" id="alamat" name="alamat"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Jenis Kelamin *</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki_laki" value="Laki-Laki">
                                    <label class="form-check-label" for="laki_laki">Laki-Laki</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan" value="Perempuan">
                                    <label class="form-check-label" for="perempuan">Perempuan</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex">
                                <div class="form-group flex-grow-1 mr-2">
                                    <label for="jenis_kunjungan">Jenis Kunjungan</label>
                                    <select class="form-control" id="jenis_kunjungan" name="jenis_kunjungan">
                                        <option value="Umum">Umum</option>
                                        <option value="BPJS">BPJS</option>
                                    </select>
                                </div>
                                <div class="form-group flex-grow-1">
                                    <label for="bpjs">Nomor BPJS</label>
                                    <input type="text" class="form-control" id="bpjs" name="bpjs">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="no">No. Telp</label>
                                <input type="text" class="form-control" id="no" name="no">
                            </div>
                        </div>
                    </div>
                    <div class="float-right">
                        <button type="button" class="btn btn-tambah" onclick="addPatient()">Tambah</button> 
                        <button type="reset" class="btn btn-batal">Batal</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="d-flex mb-3">
            <span class="align-self-center">Show</span>
            <select class="custom-select custom-select-sm form-control form-control-sm mr-2" id="entries" onchange="updateEntries()">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
            </select>
            <span class="align-self-center mr-2">entries</span>
            <input type="text" class="form-control form-control-sm ml-2 float-right" placeholder="Cari Data Pasien" id="search" onkeyup="searchPatient()">
        </div>

        <div class="row">
            <div class="col">
                <table class="table table-bordered mt-3">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Pengguna</th>
                            <th>Nama Pengguna</th>
                            <th>Jenis Kelamin</th>
                            <th>Tanggal Lahir</th>
                            <th>Alamat</th>
                            <th>Jenis Kunjungan</th>
                            <th>No. Telp</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="patientTable">
                        
                        <tr>
                            <td>1</td>
                            <td>ID001</td>
                            <td>John Doe</td>
                            <td>Laki-Laki</td>
                            <td>1990-01-01</td>
                            <td>Jakarta</td>
                            <td>Umum</td>
                            <td>0123456789</td>
                            <td>
                                <button class="btn btn-warning btn-sm" onclick="editPatient(this)">Edit</button>
                                <button class="btn btn-danger btn-sm" onclick="deleteRow(this)">Hapus</button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>ID002</td>
                            <td>Jane Doe</td>
                            <td>Perempuan</td>
                            <td>1992-02-02</td>
                            <td>Bandung</td>
                            <td>BPJS</td>
                            <td>0987654321</td>
                            <td>
                                <button class="btn btn-warning btn-sm" onclick="editPatient(this)">Edit</button>
                                <button class="btn btn-danger btn-sm" onclick="deleteRow(this)">Hapus</button>
                            </td>
                        </tr>
                    
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
