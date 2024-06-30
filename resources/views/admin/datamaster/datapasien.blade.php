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
                                <label for="no_rm">No RM Lama</label>
                                <input type="text" class="form-control" id="no_rm" name="no_rm">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_pengguna">Nama Lengkap Pasien</label>
                                <input type="text" class="form-control" id="nama_pengguna" name="nama_pengguna">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tanggal_lahir">Tanggal Lahir<span class="required">*</span></label>
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="alamat">Alamat<span class="required">*</span></label>
                                <textarea class="form-control" id="alamat" name="alamat"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Jenis Kelamin<span class="required">*</span></label><br>
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jenis_poli">Jenis Poli</label>
                                <select class="form-control" id="jenis_poli" name="jenis_poli">
                                    <option value="Poli Umum">Poli Umum</option>
                                    <option value="Poli Gigi">Poli Gigi</option>
                                    <option value="Poli KIA">Poli KIA</option>
                                </select>
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
                            <th>No RM</th>
                            <th>Nama Pengguna</th>
                            <th>Jenis Kelamin</th>
                            <th>Tanggal Lahir</th>
                            <th>Alamat</th>
                            <th>Jenis Kunjungan</th>
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


<script>
    const patients = [
        { no_rm: 'ID001', name: 'John Doe', gender: 'Laki-Laki', birthDate: '1990-01-01', address: 'Jakarta', visitType: 'Umum', poliType: 'Poli Umum', phone: '0123456789' },
        { no_rm: 'ID002', name: 'Jane Doe', gender: 'Perempuan', birthDate: '1992-02-02', address: 'Bandung', visitType: 'BPJS', poliType: 'Poli Gigi', phone: '0987654321' },
    ];

    function addPatient() {
        const no_rm = document.getElementById('no_rm').value;
        const name = document.getElementById('nama_pengguna').value;
        const birthDate = document.getElementById('tanggal_lahir').value;
        const address = document.getElementById('alamat').value;
        const gender = document.querySelector('input[name="jenis_kelamin"]:checked').value;
        const visitType = document.getElementById('jenis_kunjungan').value;
        const poliType = document.getElementById('jenis_poli').value;
        const phone = document.getElementById('no').value;

        const patient = { no_rm, name, gender, birthDate, address, visitType, poliType, phone };
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
                <td>${patient.visitType}</td>
                <td>${patient.poliType}</td>
                <td>${patient.phone}</td>
                <td>
                <div class="btn-group" role="group" aria-label="Aksi">
                    <button class="btn btn-warning btn-sm" onclick="editPatient(${index})"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-danger btn-sm" onclick="deleteRow(${index})"><i class="fas fa-trash-alt"></i></button>
                </div>
                </td>
            </tr>`;
            table.innerHTML += row;
        });
    }

    function editPatient(index) {
        const patient = patients[index];
        document.getElementById('no_rm').value = patient.no_rm;
        document.getElementById('nama_pengguna').value = patient.name;
        document.getElementById('tanggal_lahir').value = patient.birthDate;
        document.getElementById('alamat').value = patient.address;
        document.querySelector(`input[name="jenis_kelamin"][value="${patient.gender}"]`).checked = true;
        document.getElementById('jenis_kunjungan').value = patient.visitType;
        document.getElementById('jenis_poli').value = patient.poliType;
        document.getElementById('no').value = patient.phone;

        document.querySelector('.btn-tambah').setAttribute('onclick', `updatePatient(${index})`);
    }

    function updatePatient(index) {
        patients[index].no_rm = document.getElementById('no_rm').value;
        patients[index].name = document.getElementById('nama_pengguna').value;
        patients[index].birthDate = document.getElementById('tanggal_lahir').value;
        patients[index].address = document.getElementById('alamat').value;
        patients[index].gender = document.querySelector('input[name="jenis_kelamin"]:checked').value;
        patients[index].visitType = document.getElementById('jenis_kunjungan').value;
        patients[index].poliType = document.getElementById('jenis_poli').value;
        patients[index].phone = document.getElementById('no').value;

        renderTable();
        document.getElementById('addPatientForm').reset();
        document.querySelector('.btn-tambah').setAttribute('onclick', 'addPatient()');
    }

    function deleteRow(index) {
        patients.splice(index, 1);
        renderTable();
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
                <td>${patient.visitType}</td>
                <td>${patient.poliType}</td>
                <td>${patient.phone}</td>
                <td>
                    <button class="btn btn-warning btn-sm" onclick="editPatient(${index})">Edit</button>
                    <button class="btn btn-danger btn-sm" onclick="deleteRow(${index})">Hapus</button>
                </td>
            </tr>`;
            table.innerHTML += row;
        });
    }

    renderTable();
</script>
@endsection

