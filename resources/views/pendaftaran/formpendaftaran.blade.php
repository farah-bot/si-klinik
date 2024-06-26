@extends('layouts.app')

@section('title', 'Pendaftaran Pasien Baru')

@section('content')
<div class="data-pengguna-container">
    <div class="container">
        <div class="data-pengguna-header">
            <h2>Pendaftaran Pasien Baru</h2>
        </div>
        <div class="card-body">
            <form action="#" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="no_rm">No RM</label>
                            <input type="text" id="no_rm" name="no_rm" class="form-control" value="" required>
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
                        <option value="Poli A">Poli A</option>
                        <option value="Poli B">Poli B</option>
                        <option value="Poli C">Poli C</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="jenis_kunjungan">Jenis Kunjungan</label>
                    <select id="jenis_kunjungan" name="jenis_kunjungan" class="form-control">
                        <option value="Baru">Baru</option>
                        <option value="Lama">Lama</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Daftar</button>
                <a href="#" class="btn btn-secondary">Batal</a>
            </form>
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
</script>
@endsection
