@extends('layouts.app')

@section('title', 'Data Obat')

@section('content')
    <div class="data-pengguna-container">
        <div class="container">
            <div class="data-pengguna-header">
                <h2>DATA OBAT</h2>
            </div>
            <div class="row mb-3">
                <div class="col-lg-12">
                    <form id="addObatForm">
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
                                    <label for="stok">Jumlah Stok</label>
                                    <input type="number" class="form-control" id="stok" name="stok">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="harga">Harga/Satuan</label>
                                    <input type="number" class="form-control" id="harga" name="harga">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tanggal_masuk">Tanggal Masuk Obat</label>
                                    <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk">
                                </div>
                            </div>
                        </div>
                        <div class="float-right">
                            <button type="button" class="btn btn-tambah" onclick="addObat()">Tambah</button>
                            <button type="reset" class="btn btn-batal">Batal</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="d-flex mb-3">
                <span class="align-self-center">Show</span>
                <select class="custom-select custom-select-sm form-control form-control-sm mr-2" id="entries"
                    onchange="updateEntries()">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </select>
                <span class="align-self-center mr-2">entries</span>
                <input type="text" class="form-control form-control-sm ml-2 float-right" placeholder="Cari Data Obat"
                    id="search" onkeyup="searchObat()">
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
                        <tbody id="obatTable">
                            @foreach ($obat as $data_obat)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data_obat->kode_obat }}</td>
                                    <td>{{ $data_obat->nama_obat }}</td>
                                    <td>{{ $data_obat->stok }}</td>
                                    <td>{{ $data_obat->harga }}</td>
                                    <td>{{ $data_obat->tanggal_masuk }}</td>
                                    <td>
                                        <button class="btn btn-warning btn-sm"
                                            onclick="editObat('{{ $data_obat->id }}')">Edit</button>
                                        <button class="btn btn-danger btn-sm"
                                            onclick="deleteObat('{{ $data_obat->id }}')">Hapus</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function addObat() {
            const kode_obat = document.getElementById('kode_obat').value;
            const nama_obat = document.getElementById('nama_obat').value;
            const stok = document.getElementById('stok').value;
            const harga = document.getElementById('harga').value;
            const tanggal_masuk = document.getElementById('tanggal_masuk').value;

            fetch('/obat', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        kode_obat: kode_obat,
                        nama_obat: nama_obat,
                        stok: stok,
                        harga: harga,
                        tanggal_masuk: tanggal_masuk,
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Gagal menambahkan obat');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Sukses:', data);
                    location.reload();
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        function deleteObat(id) {
            fetch(`/obat/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Gagal menghapus obat');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Sukses:', data);
                    fetchData();
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        function updateEntries() {
            const entries = document.getElementById('entries').value;
        }

        function searchObat() {
            const searchInput = document.getElementById('search').value.toLowerCase();
            const table = document.getElementById('obatTable');
            const rows = table.getElementsByTagName('tr');

            for (let i = 0; i < rows.length; i++) {
                const cells = rows[i].getElementsByTagName('td');
                let match = false;
                for (let j = 0; j < cells.length - 1; j++) {
                    if (cells[j]) {
                        const cellContent = cells[j].textContent || cells[j].innerText;
                        if (cellContent.toLowerCase().indexOf(searchInput) > -1) {
                            match = true;
                            break;
                        }
                    }
                }
                rows[i].style.display = match ? '' : 'none';
            }
        }

        function editObat(id) {
            console.log('Edit obat with ID:', id);
        }
    </script>
@endsection
