@extends('layouts.app')

@section('title', 'Pendaftaran Pasien Lama')

@section('content')
<div class="data-pengguna-container">
    <div class="container">
        <div class="data-pengguna-header">
            <h2>Pendaftaran Pasien Lama</h2>
        </div>
        <div class="card-body">
            <form id="pendaftaranForm" action="#" onsubmit="return showModal(event)">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="no_rm">No RM</label>
                            <input type="text" id="no_rm" name="no_rm" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <select id="jenis_kelamin" name="jenis_kelamin" class="form-control" required>
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama Lengkap Pasien</label>
                            <input type="text" id="nama" name="nama" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_lahir">Tanggal Lahir</label>
                            <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea id="alamat" name="alamat" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="nomor_telepon">Nomor Telepon</label>
                            <input type="text" id="nomor_telepon" name="nomor_telepon" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nik">NIK</label>
                            <input type="text" id="nik" name="nik" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="jenis_pasien">Jenis Pasien</label>
                            <select id="jenis_pasien" name="jenis_pasien" class="form-control" onchange="toggleBPJSInput()" required>
                                <option value="">- Pilih -</option>
                                <option value="Umum">Umum</option>
                                <option value="BPJS">BPJS</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nomor_bpjs">Nomor BPJS</label>
                            <input type="text" id="nomor_bpjs" name="nomor_bpjs" class="form-control" disabled>
                        </div>
                    </div>
                </div>
                <hr>
                <h4>Data Kunjungan Pasien</h4>
                <div class="form-group">
                    <label for="tanggal_kunjungan">Tanggal Kunjungan</label>
                    <input type="date" id="tanggal_kunjungan" name="tanggal_kunjungan" class="form-control">
                </div>
                <div class="form-group">
                    <label for="poli_tujuan">Poli Tujuan</label>
                    <select id="poli_tujuan" name="poli_tujuan" class="form-control">
                        <option value="">- Pilih -</option>
                        <option value="Poli A">Poli Umum</option>
                        <option value="Poli B">Poli Gigi</option>
                        <option value="Poli C">Poli KIA</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Jenis Kunjungan</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jenis_kunjungan" id="jenis_kunjungan_baru" value="Baru" checked>
                        <label class="form-check-label" for="jenis_kunjungan_baru">Baru</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jenis_kunjungan" id="jenis_kunjungan_lama" value="Lama">
                        <label class="form-check-label" for="jenis_kunjungan_lama">Lama</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="nama_dokter">Nama Dokter</label>
                    <input type="text" id="nama_dokter" name="nama_dokter" class="form-control">
                </div>
                <button class="btn btn-primary">Daftar</button>
                <a href="#" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmationModalLabel">Konfirmasi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Apakah Data yang anda isikan sudah sesuai?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary" onclick="submitForm()">Ya, Daftar</button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script>
const data = {
    no_rm: '123456',
    jenis_kelamin: 'Perempuan',
    nama: 'Farah',
    tanggal_lahir: '2000-01-01',
    alamat: 'Jl. Kalimantan No. 123',
    nomor_telepon: '081234567890',
    nik: '1234567890123456',
    jenis_pasien: 'Umum',
    nomor_bpjs: '1234567890',
    tanggal_kunjungan: '2024-07-01',
    poli_tujuan: 'Poli Gigi',
    nama_dokter: 'Dr. Strange',
    jenis_kunjungan: 'Baru'
};

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('no_rm').value = data.no_rm;
    document.getElementById('jenis_kelamin').value = data.jenis_kelamin;
    document.getElementById('nama').value = data.nama;
    document.getElementById('tanggal_lahir').value = data.tanggal_lahir;
    document.getElementById('alamat').value = data.alamat;
    document.getElementById('nomor_telepon').value = data.nomor_telepon;
    document.getElementById('nik').value = data.nik;
    document.getElementById('jenis_pasien').value = data.jenis_pasien;
    document.getElementById('nomor_bpjs').value = data.nomor_bpjs;
    document.getElementById('tanggal_kunjungan').value = data.tanggal_kunjungan;
    document.getElementById('poli_tujuan').value = data.poli_tujuan;
    document.getElementById('nama_dokter').value = data.nama_dokter;
    document.querySelector('input[name="jenis_kunjungan"][value="' + data.jenis_kunjungan + '"]').checked = true;
});

function toggleBPJSInput() {
    var jenis_pasien = document.getElementById('jenis_pasien').value;
    var nomor_bpjs_input = document.getElementById('nomor_bpjs');

    if (jenis_pasien === 'BPJS') {
        nomor_bpjs_input.disabled = false;
    } else {
        nomor_bpjs_input.disabled = true;
    }
}

function showModal(event) {
    event.preventDefault();
    var confirmationModal = new bootstrap.Modal(document.getElementById('confirmationModal'));
    confirmationModal.show();
    return false;
}

function submitForm() {
    document.getElementById('pendaftaranForm').submit();
}
</script>
@endsection
