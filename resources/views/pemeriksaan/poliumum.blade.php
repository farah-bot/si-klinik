@extends('layouts.app')

@section('title', 'Formulir Pemeriksaan Poli Umum')

@section('content')
<div class="data-pengguna-container">
    <div class="container">
        <div class="data-pengguna-header">
            <h2>FORMULIR PEMERIKSAAN POLI UMUM</h2>
        </div>

            <div class="form-group">
                <label>Nomor RM</label>
                <input type="text" class="form-control" value="1512" readonly>
            </div>
            <div class="form-group">
                <label>Tanggal Kunjungan</label>
                <input type="text" class="form-control" value="15/01/2023" readonly>
            </div>
            <div class="form-group">
                <label>Nama Lengkap Pasien</label>
                <input type="text" class="form-control" value="Kiara Azzahra" readonly>
            </div>
            <div class="form-group">
                <label>Nama Dokter</label>
                <input type="text" class="form-control" value="dr. Dania Eka Susila" readonly>
            </div>

            <!-- Subjective Complaints -->
            <h3>SUBJECT (KELUHAN)</h3>
            <div class="form-group">
                <label for="keluhan_pasien">Subject (Keluhan Pasien)</label>
                <textarea class="form-control" id="keluhan_pasien" name="keluhan_pasien" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="riwayat_alergi">Riwayat Alergi</label>
                <textarea class="form-control" id="riwayat_alergi" name="riwayat_alergi" rows="3"></textarea>
            </div>

            <!-- Objective Examination -->
            <h3>OBJECT (PEMERIKSAAN)</h3>
            <div class="form-group">
                <label>Tekanan Darah</label>
                <input type="text" class="form-control" name="tekanan_darah" required>
            </div>
            <div class="form-group">
                <label>Suhu Tubuh</label>
                <input type="text" class="form-control" name="suhu_tubuh" required>
            </div>
            <div class="form-group">
                <label>BB</label>
                <input type="text" class="form-control" name="bb" required>
            </div>
            <div class="form-group">
                <label>Nadi</label>
                <input type="text" class="form-control" name="nadi" required>
            </div>
            <div class="form-group">
                <label>RR</label>
                <input type="text" class="form-control" name="rr" required>
            </div>
            <div class="form-group">
                <label>KU</label>
                <input type="text" class="form-control" name="ku" required>
            </div>

            <!-- Assessment -->
            <h3>ASSESMENT</h3>
            <div class="form-group">
                <label for="kode_icd10">Kode ICD - 10 *</label>
                <input type="text" class="form-control" id="kode_icd10" name="kode_icd10" required>
            </div>
            <div class="form-group">
                <label for="diagnosa_icd10">Diagnosa ICD - 10 *</label>
                <input type="text" class="form-control" id="diagnosa_icd10" name="diagnosa_icd10" readonly>
            </div>
            <div class="form-group">
                <label for="catatan_assessment">Catatan Assesmen Pemeriksaan</label>
                <textarea class="form-control" id="catatan_assessment" name="catatan_assessment" rows="3"></textarea>
            </div>

            <!-- Plan -->
            <h3>PLAN</h3>
            <div class="form-group">
                <label for="rencana_tindaklanjut">Rencana Tindaklanjut Pasien *</label>
                <textarea class="form-control" id="rencana_tindaklanjut" name="rencana_tindaklanjut" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="tindakan">Tindakan</label>
                <input type="text" class="form-control" id="tindakan" name="tindakan">
            </div>
            <div class="form-group">
                <label for="rujukan">Rujukan</label>
                <input type="text" class="form-control" id="rujukan" name="rujukan">
            </div>

            <!-- Medication Prescription -->
            <h3>RESEP OBAT</h3>
            <div class="form-group">
                <label>Nama Obat</label>
                <input type="text" class="form-control" name="nama_obat">
            </div>
            <div class="form-group">
                <label>Satuan</label>
                <input type="text" class="form-control" name="satuan">
            </div>
            <div class="form-group">
                <label>Jumlah Obat</label>
                <input type="text" class="form-control" name="jumlah_obat">
            </div>
        </div>

        <!-- Authentication -->
        <div class="col-md-6">
            <h3>AUTENTIFIKASI</h3>
            <div class="form-group">
                <label for="nama_dokter">Nama Dokter *</label>
                <input type="text" class="form-control" id="nama_dokter" name="nama_dokter" required>
            </div>
            <div class="form-group">
                <label for="tanda_tangan">Tanda Tangan *</label>
                <div id="signature-pad" class="signature-pad">
                    <div class="signature-pad-body">
                        <canvas></canvas>
                    </div>
                    <button type="button" class="btn btn-secondary" id="clear-signature">Hapus Tanda Tangan</button>
                    <input type="hidden" id="tanda_tangan" name="tanda_tangan">
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="#" class="btn btn-secondary">Batal</a>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        var canvas = document.querySelector('canvas');
        var signaturePad = new SignaturePad(canvas, {
            backgroundColor: 'rgb(255, 255, 255)'
        });

        
        document.getElementById('clear-signature').addEventListener('click', function() {
            signaturePad.clear();
        });

  
        var form = document.getElementById('form-pemeriksaan');

        form.addEventListener('submit', function(e) {
            
            e.preventDefault();

            var signatureData = signaturePad.toDataURL();

            document.getElementById('tanda_tangan').value = signatureData;

        });
    });
</script>
@endsection

