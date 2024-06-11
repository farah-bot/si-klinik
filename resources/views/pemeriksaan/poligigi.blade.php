@extends('layouts.app')

@section('title', 'Formulir Pemeriksaan Poli Gigi')

@section('content')
<div class="data-pengguna-container">
    <div class="container">
        <div class="data-pengguna-header">
            <h2>FORMULIR PEMERIKSAAN POLI GIGI</h2>
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
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="upload_lab">Upload Hasil Laboratorium</label>
                        <input type="file" class="form-control" id="upload_lab" name="upload_lab">
                    </div>
                </div>
            </div>

            <h3>ASSESMENT</h3>
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="kode_icd10">Kode ICD-10</label>
                        <input type="text" class="form-control" id="kode_icd10" name="kode_icd10">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="diagnosa_icd10">Diagnosa ICD-10</label>
                        <input type="text" class="form-control" id="diagnosa_icd10" name="diagnosa_icd10" readonly>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="catatan_assesmen">Catatan Assesmen Pemeriksaan</label>
                        <textarea class="form-control" id="catatan_assesmen" name="catatan_assesmen"></textarea>
                    </div>
                </div>
            </div>

            <h3>PLAN</h3>
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="rencana_tindaklanjut">Rencana Tindaklanjut Pasien</label>
                        <textarea class="form-control" id="rencana_tindaklanjut" name="rencana_tindaklanjut"></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tindakan">Tindakan</label>
                        <textarea class="form-control" id="tindakan" name="tindakan"></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="rujukan">Rujukan</label>
                        <textarea class="form-control" id="rujukan" name="rujukan"></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tempat_rujukan">Tempat Rujukan</label>
                        <textarea class="form-control" id="tempat_rujukan" name="tempat_rujukan"></textarea>
                    </div>
                </div>
            </div>

            <h3>RESEP</h3>
            <div id="resepContainer">
                <div class="resep-item row mb-3">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nama_obat">Nama Obat</label>
                            <input type="text" class="form-control" id="nama_obat" name="nama_obat[]">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="satuan">Satuan</label>
                            <select class="form-control" id="satuan" name="satuan[]">
                                <option value="tablet">Tablet</option>
                                <option value="syrup">Syrup</option>
                                <option value="capsule">Capsule</option>
                                <option value="others">Others</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="jumlah">Jumlah</label>
                            <input type="text" class="form-control" id="jumlah" name="jumlah[]">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="aturan_pakai">Catatan Aturan Pakai</label>
                            <textarea class="form-control" id="aturan_pakai" name="aturan_pakai[]"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <button type="button" class="btn btn-success" id="addResep">+</button>
                <button type="button" class="btn btn-danger" id="removeResep">-</button>
            </div>

            <div class="float-right mt-3">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="reset" class="btn btn-secondary">Batal</button>
            </div>
        </form>
    </div>
</div>

<script>
    function updateRemoveButtonState() {
        const resepItems = document.querySelectorAll('.resep-item');
        document.getElementById('removeResep').disabled = resepItems.length === 1;
    }

    document.getElementById('pemeriksaanForm').addEventListener('submit', function(e) {
        e.preventDefault();
       
    });

    document.getElementById('addResep').addEventListener('click', function() {
        var resepContainer = document.getElementById('resepContainer');
        var newResepItem = document.createElement('div');
        newResepItem.className = 'resep-item row mb-3';
        newResepItem.innerHTML = `
            <div class="col-md-4">
                <div class="form-group">
                    <label for="nama_obat">Nama Obat</label>
                    <input type="text" class="form-control" id="nama_obat" name="nama_obat[]">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="satuan">Satuan</label>
                    <select class="form-control" id="satuan" name="satuan[]">
                        <option value="tablet">Tablet</option>
                        <option value="syrup">Syrup</option>
                        <option value="capsule">Capsule</option>
                        <option value="others">Others</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="jumlah">Jumlah</label>
                    <input type="text" class="form-control" id="jumlah" name="jumlah[]">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="aturan_pakai">Catatan Aturan Pakai</label>
                    <textarea class="form-control" id="aturan_pakai" name="aturan_pakai[]"></textarea>
                </div>
            </div>
        `;
        resepContainer.appendChild(newResepItem);
        updateRemoveButtonState();
    });

    document.getElementById('removeResep').addEventListener('click', function() {
        var resepContainer = document.getElementById('resepContainer');
        var resepItems = resepContainer.querySelectorAll('.resep-item');
        if (resepItems.length > 1) {
            resepContainer.removeChild(resepItems[resepItems.length - 1]);
        }
        updateRemoveButtonState();
    });

    document.addEventListener('DOMContentLoaded', function() {
        updateRemoveButtonState();
    });
</script>
@endsection
