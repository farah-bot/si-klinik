@extends('layouts.app')

@section('title', 'Formulir Pemeriksaan Poli Umum')

@section('content')
<div class="data-pengguna-container">
    <div class="container">
        <div class="data-pengguna-header">
            <h2>FORMULIR PEMERIKSAAN POLI UMUM</h2>
        </div>
        <form id="pemeriksaanForm">
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="no_rm">No RM *</label>
                        <input type="text" class="form-control" id="no_rm" name="no_rm" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tanggal_kunjungan">Tanggal Kunjungan *</label>
                        <input type="date" class="form-control" id="tanggal_kunjungan" name="tanggal_kunjungan" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nama_pasien">Nama Lengkap Pasien *</label>
                        <input type="text" class="form-control" id="nama_pasien" name="nama_pasien" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nama_dokter">Nama Dokter *</label>
                        <input type="text" class="form-control" id="nama_dokter" name="nama_dokter" required>
                    </div>
                </div>
            </div>

            <h3>SUBJECT (KELUHAN)</h3>
            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="keluhan_pasien">Subject (Keluhan Pasien) *</label>
                        <textarea class="form-control" id="keluhan_pasien" name="keluhan_pasien" required></textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="riwayat_alergi">Riwayat Alergi</label>
                        <textarea class="form-control" id="riwayat_alergi" name="riwayat_alergi"></textarea>
                    </div>
                </div>
            </div>

            <h3>OBJECT (PEMERIKSAAN)</h3>
            <div class="row mb-3">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="tekanan_darah">Tekanan Darah</label>
                        <input type="text" class="form-control" id="tekanan_darah" name="tekanan_darah" placeholder="mm/Hg">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="suhu_tubuh">Suhu Tubuh</label>
                        <input type="text" class="form-control" id="suhu_tubuh" name="suhu_tubuh" placeholder="°C">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="bb">Berat Badan</label>
                        <input type="text" class="form-control" id="bb" name="bb" placeholder="kg">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="nadi">Nadi</label>
                        <input type="text" class="form-control" id="nadi" name="nadi" placeholder="x/menit">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="rr">RR</label>
                        <input type="text" class="form-control" id="rr" name="rr" placeholder="x/menit">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="ku">KU</label>
                        <input type="text" class="form-control" id="ku" name="ku">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="hasil_pemeriksaan_umum">Hasil Pemeriksaan Umum</label>
                        <textarea class="form-control" id="hasil_pemeriksaan_umum" name="hasil_pemeriksaan_umum"></textarea>
                    </div>
                </div>
            </div>

            <h3>ASSESMENT</h3>
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="diagnosa_utama">Diagnosa Utama</label>
                        <input type="text" class="form-control" id="diagnosa_utama" name="diagnosa_utama">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="diagnosa_sekunder">Diagnosa Sekunder</label>
                        <input type="text" class="form-control" id="diagnosa_sekunder" name="diagnosa_sekunder">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="tindakan_assessment">Tindakan</label>
                        <textarea class="form-control" id="tindakan_assessment" name="tindakan_assessment"></textarea>
                    </div>
                </div>
            </div>

            <h3>PLAN</h3>
            <div class="row mb-3">
                <div class="col-md-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="edukasi" value="Edukasi">
                        <label class="form-check-label" for="edukasi">Edukasi</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="tindakan" value="Tindakan">
                        <label class="form-check-label" for="tindakan">Tindakan</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="medikamentosa" value="Medikamentosa">
                        <label class="form-check-label" for="medikamentosa">Medikamentosa</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="rujuk" value="Rujuk">
                        <label class="form-check-label" for="rujuk">Rujuk</label>
                    </div>
                </div>
                <div class="col-md-12 mt-3">
                    <div class="form-group">
                        <label for="keterangan_tambahan">Keterangan Tambahan</label>
                        <textarea class="form-control" id="keterangan_tambahan" name="keterangan_tambahan"></textarea>
                    </div>
                </div>
            </div>

            <div class="float-right">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="reset" class="btn btn-secondary">Batal</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('pemeriksaanForm').addEventListener('submit', function(e) {
        e.preventDefault();
       
    });
</script>
@endsection
