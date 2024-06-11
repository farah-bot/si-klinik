@extends('layouts.app')

@section('title', 'Data Obat')

@section('content')
<div class="data-obat-container">
    <div class="container">
        <div class="data-obat-header">
            <h2>DATA OBAT</h2>
        </div>
        <div class="row mb-3">
            <div class="col-lg-12">
                <form>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="kode_obat">Kode Obat</label>
                                <input type="text" class="form-control" id="kode_obat" name="kode_obat">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nama_obat">Nama Obat</label>
                                <input type="text" class="form-control" id="nama_obat" name="nama_obat">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="jumlah_stok">Jumlah Stok</label>
                                <input type="number" class="form-control" id="jumlah_stok" name="jumlah_stok">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="harga_satuan">Harga/Satuan</label>
                                <input type="number" class="form-control" id="harga_satuan" name="harga_satuan">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tanggal_masuk_obat">Tanggal Masuk Obat</label>
                                <input type="date" class="form-control" id="tanggal_masuk_obat" name="tanggal_masuk_obat">
                            </div>
                        </div>
                    </div>
                    <div class="float-right">
                        <button type="submit" class="btn btn-tambah">Tambah</button> 
                        <button type="reset" class="btn btn-batal">Batal</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="d-flex">
            <span class="align-self-center">Show</span>
            <select class="custom-select custom-select-sm form-control form-control-sm mr-2" id="entries">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
            </select>
            <span class="align-self-center mr-2">entries</span>
            <input type="text" class="form-control form-control-sm ml-2 float-right" placeholder="Cari Data Obat" id="search">
        </div>

        <div class="row">
            <div class="col">
                <table class="table table-bordered mt-3">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Obat</th>
                            <th>Nama Obat</th>
                            <th>Jumlah Stok</th>
                            <th>Harga/Satuan</th>
                            <th>Tanggal Masuk Obat</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       
                        <tr>
                            <td>1</td>
                            <td>OBT001</td>
                            <td>Paracetamol</td>
                            <td>100</td>
                            <td>5000</td>
                            <td>2024-06-01</td>
                            <td>
                                <button class="btn btn-warning btn-sm">Edit</button>
                                <button class="btn btn-danger btn-sm">Hapus</button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>OBT002</td>
                            <td>Ibuprofen</td>
                            <td>150</td>
                            <td>7500</td>
                            <td>2024-06-05</td>
                            <td>
                                <button class="btn btn-warning btn-sm">Edit</button>
                                <button class="btn btn-danger btn-sm">Hapus</button>
                            </td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
