@extends('layouts.app')

@section('title', 'Data Pengguna')

@section('content')
    <div class="data-pengguna-container">
        <div class="container">
            <div class="data-pengguna-header">
                <h2>DATA PENGGUNA</h2>
            </div>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row mb-3">
                <div class="col-lg-12">
                    <form method="POST" action="{{ route('users.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_pengguna">ID Pengguna</label>
                                    <input type="text" class="form-control" id="id_pengguna" name="id_pengguna" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Jenis Kelamin *</label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki_laki"
                                            value="Laki-Laki" required>
                                        <label class="form-check-label" for="laki_laki">Laki-Laki</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan"
                                            value="Perempuan" required>
                                        <label class="form-check-label" for="perempuan">Perempuan</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama_pengguna">Nama Pengguna</label>
                                    <input type="text" class="form-control" id="nama_pengguna" name="nama_pengguna"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tanggal_lahir">Tanggal Lahir *</label>
                                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="alamat">Alamat *</label>
                                    <textarea class="form-control" id="alamat" name="alamat" required></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jabatan">Jabatan</label>
                                    <select class="form-control" id="jabatan" name="jabatan" required>
                                        <option value="Dokter Umum">Dokter Umum</option>
                                        <option value="Dokter Gigi">Dokter Gigi</option>
                                        <option value="Rekam Medis">Rekam Medis</option>
                                        <option value="Apoteker">Apoteker</option>
                                        <option value="Bidan">Bidan</option>
                                        <option value="Perawat">Perawat</option>
                                        <option value="Kepala Klinik">Kepala Klinik</option>
                                        <option value="Admin">Admin</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
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
                <input type="text" class="form-control form-control-sm ml-2 float-right"
                    placeholder="Cari Data Pengguna" id="search">
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
                                <th>Jabatan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->jenis_kelamin }}</td>
                                    <td>{{ $user->tanggal_lahir }}</td>
                                    <td>{{ $user->alamat }}</td>
                                    <td>{{ $user->jabatan }}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Aksi">
                                            <button class="btn btn-warning btn-sm"
                                                onclick="editUser('{{ $user->id }}','{{ $user->name }}','{{ $user->alamat }}','{{ $user->jabatan }}','{{ $user->username }}','{{ $user->tanggal_lahir }}','{{ $user->jenis_kelamin }}')">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-danger btn-sm"
                                                onclick="confirmDelete('{{ $user->id }}')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </div>
                                        <form id="deleteUserForm-{{ $user->id }}" method="POST"
                                            action="{{ route('users.destroy', $user->id) }}" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editUserForm" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" id="editUserId" name="id">
                        <div class="form-group">
                            <label for="editNamaPengguna">Nama Pengguna</label>
                            <input type="text" class="form-control" id="editNamaPengguna" name="nama_pengguna"
                                required>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Jenis Kelamin *</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki_laki"
                                        value="Laki-Laki" required>
                                    <label class="form-check-label" for="laki_laki">Laki-Laki</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan"
                                        value="Perempuan" required>
                                    <label class="form-check-label" for="perempuan">Perempuan</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="editAlamat">Alamat</label>
                            <textarea class="form-control" id="editAlamat" name="alamat" required></textarea>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="editTanggalLahir">Tanggal Lahir *</label>
                                <input type="date" class="form-control" id="editTanggalLahir" name="tanggal_lahir"
                                    required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="editJabatan">Jabatan</label>
                            <select class="form-control" id="editJabatan" name="jabatan" required>
                                <option value="Dokter Umum">Dokter Umum</option>
                                <option value="Dokter Gigi">Dokter Gigi</option>
                                <option value="Rekam Medis">Rekam Medis</option>
                                <option value="Apoteker">Apoteker</option>
                                <option value="Bidan">Bidan</option>
                                <option value="Perawat">Perawat</option>
                                <option value="Kepala Klinik">Kepala Klinik</option>
                                <option value="Admin">Admin</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="editUsername">Username</label>
                            <input type="text" class="form-control" id="editUsername" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="editPassword">Password (Optional)</label>
                            <input type="password" class="form-control" id="editPassword" name="password">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-batal" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-tambah">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function editUser(id, name, alamat, jabatan, username, tanggal_lahir, jenis_kelamin) {
            document.getElementById('editUserForm').action = '/users/' + id;
            document.getElementById('editUserId').value = id;
            document.getElementById('editNamaPengguna').value = name;
            document.getElementById('editAlamat').value = alamat;
            document.getElementById('editTanggalLahir').value = tanggal_lahir;
            document.getElementById('editJabatan').value = jabatan;
            // document.getElementById('editLaki_Laki').value = jenis_kelamin;
            document.getElementById('editUsername').value = username;

            var editUserModal = new bootstrap.Modal(document.getElementById('editUserModal'));
            editUserModal.show();
        }

        function confirmDelete(userId) {
            if (confirm("Are you sure you want to delete this user?")) {
                document.getElementById('deleteUserForm-' + userId).submit();
            }
        }
    </script>

@endsection
