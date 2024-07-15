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
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form id="addPatientForm" action="{{ route('daftar_pasien_lama') }}" method="POST"
                        onsubmit="return showModal(event)">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_rm">No RM Lama</label>
                                    <input type="text" id="no_rm" name="no_rm" class="form-control"
                                        value="{{ old('no_rm') }}" required>
                                    @if ($errors->has('no_rm'))
                                        <span class="text-danger">{{ $errors->first('no_rm') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama">Nama Lengkap Pasien</label>
                                    <input type="text" class="form-control" id="nama" name="nama"
                                        value="{{ old('nama') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tanggal_lahir">Tanggal Lahir<span class="required">*</span></label>
                                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                                        value="{{ old('tanggal_lahir') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="alamat">Alamat<span class="required">*</span></label>
                                    <textarea class="form-control" id="alamat" name="alamat" required>{{ old('alamat') }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tanggal_kunjungan">Tanggal Kunjungan</label>
                                    <input type="date" id="tanggal_kunjungan" name="tanggal_kunjungan"
                                        class="form-control" value="{{ old('tanggal_kunjungan') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select id="jenis_kelamin" name="jenis_kelamin" class="form-control" required>
                                        <option value="Laki-Laki"
                                            {{ old('jenis_kelamin') == 'Laki-Laki' ? 'selected' : '' }}>
                                            Laki-Laki</option>
                                        <option value="Perempuan"
                                            {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                                            Perempuan</option>
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nik">NIK</label>
                                    <input type="text" id="nik" name="nik" class="form-control"
                                        value="{{ old('nik') }}" required>
                                    @if ($errors->has('nik'))
                                        <span class="text-danger">{{ $errors->first('nik') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex">
                                    <div class="form-group flex-grow-1 mr-2">
                                        <label for="jenis_pasien">Jenis Pasien</label>
                                        <select id="jenis_pasien" name="jenis_pasien" class="form-control"
                                            onchange="toggleBPJSInput()" required>
                                            <option value="">- Pilih -</option>
                                            <option value="Umum" {{ old('jenis_pasien') == 'Umum' ? 'selected' : '' }}>
                                                Umum
                                            </option>
                                            <option value="BPJS" {{ old('jenis_pasien') == 'BPJS' ? 'selected' : '' }}>
                                                BPJS
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group flex-grow-1">
                                        <label for="nomor_bpjs">Nomor BPJS</label>
                                        <input type="text" id="nomor_bpjs" name="nomor_bpjs" class="form-control"
                                            value="{{ old('nomor_bpjs') }}"
                                            {{ old('jenis_pasien') != 'BPJS' ? 'disabled' : '' }}>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nomor_telepon">Nomor Telepon</label>
                                    <input type="text" id="nomor_telepon" name="nomor_telepon" class="form-control"
                                        value="{{ old('nomor_telepon') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="poli_tujuan">Poli Tujuan</label>
                                    <select id="poli_tujuan" name="poli_tujuan" class="form-control" required>
                                        <option value="">- Pilih -</option>
                                        <option value="Poli Umum"
                                            {{ old('poli_tujuan') == 'Poli Umum' ? 'selected' : '' }}>Poli Umum
                                        </option>
                                        <option value="Poli Gigi"
                                            {{ old('poli_tujuan') == 'Poli Gigi' ? 'selected' : '' }}>Poli Gigi
                                        </option>
                                        <option value="Poli KIA" {{ old('poli_tujuan') == 'Poli KIA' ? 'selected' : '' }}>
                                            Poli KIA</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_dokter">Nama Dokter</label>
                                <input type="text" id="nama_dokter" name="nama_dokter" class="form-control">
                            </div>
                        </div>
                        <div class="float-right">
                            <button type="submit" class="btn btn-tambah">Tambah</button>
                            <button type="reset" class="btn btn-batal">Batal</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog"
                aria-labelledby="confirmationModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmationModalLabel">Konfirmasi</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Apakah Data yang anda isikan sudah sesuai?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-batal" data-bs-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-tambah" onclick="submitForm()">Ya, Daftar</button>
                        </div>
                    </div>
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
                <input type="text" class="form-control form-control-sm ml-2 float-right"
                    placeholder="Cari Data Pasien" id="search" onkeyup="searchPatient()">
            </div>

            <div class="row">
                <div class="col">
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No RM</th>
                                <th>Nama Pengguna</th>
                                <th>Jenis Kelamin</th>
                                <th>Tanggal Lahir</th>
                                <th>Alamat</th>
                                <th>Tanggal Kunjungan</th>
                                <th>Jenis Pasien</th>
                                <th>Jenis Poli</th>
                                <th>No. Telp</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="patientTable">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function toggleBPJSInput() {
            var jenis_pasien = document.getElementById('jenis_pasien').value;
            var nomor_bpjs_input = document.getElementById('nomor_bpjs');

            if (jenis_pasien === 'BPJS') {
                nomor_bpjs_input.disabled = false;
            } else {
                nomor_bpjs_input.disabled = true;
            }
        }

        const patients = [
            @foreach ($kunjungans as $kunjungan)
                {
                    id_patiens: '{{ $kunjungan->pasien_id }}',
                    id: '{{ $kunjungan->id }}',
                    no_rm: '{{ $kunjungan->pasien->no_rm }}',
                    name: '{{ $kunjungan->pasien->nama }}',
                    birthDate: '{{ $kunjungan->pasien->tanggal_lahir }}',
                    address: '{{ $kunjungan->pasien->alamat }}',
                    gender: '{{ $kunjungan->pasien->jenis_kelamin }}',
                    visitType: '{{ $kunjungan->pasien->jenis_pasien }}',
                    poliType: '{{ $kunjungan->poli_tujuan }}',
                    phone: '{{ $kunjungan->pasien->nomor_telepon }}',
                    visitDate: '{{ $kunjungan->tanggal_kunjungan }}',
                },
            @endforeach
        ];

        function showModal(event) {
            event.preventDefault();
            var confirmationModal = new bootstrap.Modal(document.getElementById('confirmationModal'));
            confirmationModal.show();
            return false;
        }

        function submitForm() {
            document.getElementById('addPatientForm').submit();
        }

        function addPatient() {
            const no_rm = document.getElementById('no_rm').value;
            const name = document.getElementById('nama').value;
            const birthDate = document.getElementById('tanggal_lahir').value;
            const address = document.getElementById('alamat').value;
            const gender = document.querySelector('input[name="jenis_kelamin"]:checked').value;
            const visitType = document.getElementById('jenis_pasien').value;
            const poliType = document.getElementById('jenis_poli').value;
            const phone = document.getElementById('no').value;
            const visitDate = document.getElementById('tanggal_kunjungan').value;

            const patient = {
                no_rm,
                name,
                gender,
                birthDate,
                address,
                visitType,
                poliType,
                phone,
                visitDate
            };
            patients.push(patient);
            renderTable();
        }

        function renderTable() {
            const table = document.getElementById('patientTable');
            table.innerHTML = '';
            patients.forEach((patient, index) => {
                const row = `<tr>
                <td>${index + 1}</td>
                <td>${patient.no_rm}</td>
                <td>${patient.name}</td>
                <td>${patient.gender}</td>
                <td>${patient.birthDate}</td>
                <td>${patient.address}</td>
                <td>${patient.visitDate}</td>
                <td>${patient.visitType}</td>
                <td>${patient.poliType}</td>
                <td>${patient.phone}</td>
                <td>
                    <div class="btn-group" role="group" aria-label="Aksi">
                        <button class="btn btn-warning" onclick="editPasien(${patient.id_patiens})"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-danger btn-sm" onclick="deletePasien(${patient.id_patiens})"><i class="fas fa-trash-alt"></i></button>
                    </div>
                </td>
            </tr>`;
                table.innerHTML += row;
            });
        }

        function editPasien(id) {
            window.location.href = `/editpasien/${id}`;
        }

        function deletePasien(id) {
            if (confirm('Apakah Anda yakin ingin menghapus pasien ini?')) {
                fetch(`/datapasien/delete/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        location.reload();
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }
        }

        function searchPatient() {
            const searchValue = document.getElementById('search').value.toLowerCase();
            const filteredPatients = patients.filter(patient =>
                patient.name.toLowerCase().includes(searchValue) ||
                patient.no_rm.toLowerCase().includes(searchValue)
            );
            renderFilteredTable(filteredPatients);
        }

        function renderFilteredTable(filteredPatients) {
            const table = document.getElementById('patientTable');
            table.innerHTML = '';
            filteredPatients.forEach((patient, index) => {
                const row = `<tr>
                <td>${index + 1}</td>
                <td>${patient.no_rm}</td>
                <td>${patient.name}</td>
                <td>${patient.gender}</td>
                <td>${patient.birthDate}</td>
                <td>${patient.address}</td>
                <td>${patient.visitDate}</td>
                <td>${patient.visitType}</td>
                <td>${patient.poliType}</td>
                <td>${patient.phone}</td>
                <td>
                    <button class="btn btn-warning" onclick="editPasien(${patient.id})"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-danger btn-sm" onclick="deletePasien(${patient.id})">Hapus</button>
                </td>
            </tr>`;
                table.innerHTML += row;
            });
        }

        renderTable();
    </script>
@endsection
