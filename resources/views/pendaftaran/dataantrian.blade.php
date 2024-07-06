@extends('layouts.app')

@section('title', 'Data Pasien')

@section('content')
    <div class="data-pengguna-container">
        <div class="container">
            <div class="data-pengguna-header">
                <h2>Data Pasien</h2>
            </div>

            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="filterNama">Cari Nama Pasien</label>
                    <div class="input-group">
                        <input type="text" id="filterNama" class="form-control" placeholder="Nama Pasien"
                            onkeydown="filterData(event)">
                    </div>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('formpendaftaran') }}" class="btn btn-success mt-4">Daftarkan Pasien Baru</a>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered" id="pasienTable">
                    <thead>
                        <tr>
                            <th>No. RM</th>
                            <th>Nama Pasien</th>
                            <th>NIK</th>
                            <th>Alamat</th>
                            <th>Jenis Kelamin</th>
                            <th>Tanggal Lahir</th>
                            <th>Jenis Pasien</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        @foreach ($pasien as $data)
                            <tr>
                                <td>{{ $data->no_rm }}</td>
                                <td>{{ $data->nama }}</td>
                                <td>{{ $data->nik }}</td>
                                <td>{{ $data->alamat }}</td>
                                <td>{{ $data->jenis_kelamin }}</td>
                                <td>{{ $data->tanggal_lahir }}</td>
                                <td>{{ $data->jenis_pasien }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Aksi">
                                    <button class="btn btn-warning" onclick="editPasien({{ $data->id }})"><i
                                            class="fas fa-edit"></i></button>
                                    <form action="{{ route('deletePasien', $data->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                    </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div id="noDataFound" style="display: none;" class="alert alert-info mt-3">
                    Data tidak ditemukan.
                </div>


            </div>
        </div>
    </div>

    <style>
        @media print {
            body * {
                visibility: hidden;
            }

            .table-responsive,
            .table-responsive * {
                visibility: visible;
            }

            .table-responsive {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }
        }
    </style>

    <script>
        function openFormPasienLama() {
            alert('Menampilkan formulir pendaftaran pasien lama');
        }

        function openFormPasienBaru() {
            alert('Menampilkan formulir pendaftaran pasien baru');
        }

        function editPasien(id) {
            window.location.href = `/editpasien/${id}`;
        }



        function filterData(event) {
            const filterNama = document.getElementById('filterNama').value.toLowerCase();
            const tableRows = document.getElementById('tableBody').getElementsByTagName('tr');
            let found = false;

            for (let i = 0; i < tableRows.length; i++) {
                const namaPasien = tableRows[i].getElementsByTagName('td')[1];
                if (namaPasien) {
                    const textValue = namaPasien.textContent || namaPasien.innerText;
                    if (textValue.toLowerCase().indexOf(filterNama) > -1) {
                        tableRows[i].style.display = '';
                        found = true;
                    } else {
                        tableRows[i].style.display = 'none';
                    }
                }
            }

            const noDataFound = document.getElementById('noDataFound');
            if (found) {
                noDataFound.style.display = 'none';
            } else {
                noDataFound.style.display = 'block';
            }
        }

        window.onload = function() {
            filterData();
        };
    </script>

@endsection
