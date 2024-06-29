@extends('layouts.app')

@section('title', 'Formulir Pemeriksaan Poli KIA')

@section('content')
<div class="data-pengguna-container">
    <div class="container">
        <div class="data-pengguna-header">
            <h2>FORMULIR PEMERIKSAAN POLI KIA</h2>
        </div>

        <!-- Patient Information Section -->
        <div class="border border-primary rounded p-3 mb-3">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label><strong>Nomor RM:</strong></label>
                        <p class="form-control-static">1512</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label><strong>Tanggal Kunjungan:</strong></label>
                        <p class="form-control-static">15/01/2023</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label><strong>Nama Lengkap Pasien:</strong></label>
                        <p class="form-control-static">Kiara Azzahra</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label><strong>Nama Dokter:</strong></label>
                        <p class="form-control-static">dr. Dania Eka Susila</p>
                    </div>
                </div>
            </div>
        </div>


        <!-- Subjective Complaints -->
        <div class="border rounded p-3 mb-3">
            <h4>SUBJECT (KELUHAN)</h4>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="keluhan_pasien">Subject (Keluhan Pasien)<span class="required">*</span></label>
                        <textarea class="form-control" id="keluhan_pasien" placeholder="Input keluhan pasien" name="keluhan_pasien" rows="3" required></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="riwayat_alergi">Riwayat Alergi</label>
                        <textarea class="form-control" id="riwayat_alergi" placeholder="Input riwayat alergi pasien" name="riwayat_alergi" rows="3"></textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Objective Examination -->
        <div class="border rounded p-3 mb-3">
            <h4>OBJECT (PEMERIKSAAN)</h4>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Tekanan Darah<span class="required">*</span></label>
                        <input type="text" class="form-control" name="tekanan_darah" placeholder="135 / 90 mm/Hg" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Suhu Tubuh<span class="required">*</span></label>
                        <input type="text" class="form-control" name="suhu_tubuh" placeholder="45 C" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>BB<span class="required">*</span></label>
                        <input type="text" class="form-control" name="bb" placeholder="65 kg" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Nadi<span class="required">*</span></label>
                        <input type="text" class="form-control" name="nadi" placeholder="60 x/menit" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>RR<span class="required">*</span></label>
                        <input type="text" class="form-control" name="rr" placeholder="Normal" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>KU<span class="required">*</span></label>
                        <input type="text" class="form-control" name="ku" placeholder="Sakit Ringan" required>
                    </div>
                </div>
            </div>
        </div>

        
        <!-- Detailed Objective Examination -->
        <div class="border rounded p-3 mb-3">
            <h4>PEMERIKSAAN DETIL</h4>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>A. Kepala dan Leher</label>
                        <label>Sakit pada bagian Kepala/Leher?</label>
                        <div>
                            <label class="radio-inline"><input type="radio" name="kepala_leher" value="Normal"> Kepala</label>
                            <label class="radio-inline"><input type="radio" name="kepala_leher" value="Abnormal"> Leher</label>
                        </div>
                        <label>Apakah bagian leher terdapat limfadenopati?</label>
                        <div>
                            <label class="radio-inline"><input type="radio" name="kepala_leher" value="Normal"> Kepala</label>
                            <label class="radio-inline"><input type="radio" name="kepala_leher" value="Abnormal"> Leher</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>B. Mata</label>
                        <div>
                            <label class="radio-inline"><input type="radio" name="mata" value="Normal"> Normal</label>
                            <label class="radio-inline"><input type="radio" name="mata" value="Abnormal"> Abnormal</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>C. Telinga</label>
                        <div>
                            <label class="radio-inline"><input type="radio" name="telinga" value="Normal"> Normal</label>
                            <label class="radio-inline"><input type="radio" name="telinga" value="Abnormal"> Abnormal</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>D. Hidung</label>
                        <div>
                            <label class="radio-inline"><input type="radio" name="hidung" value="Normal"> Normal</label>
                            <label class="radio-inline"><input type="radio" name="hidung" value="Abnormal"> Abnormal</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>E. Gigi dan Mulut</label>
                        <div>
                            <label class="radio-inline"><input type="radio" name="gigi_mulut" value="Normal"> Normal</label>
                            <label class="radio-inline"><input type="radio" name="gigi_mulut" value="Abnormal"> Abnormal</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>F. Faring dan Orofaring</label>
                        <div>
                            <label class="radio-inline"><input type="radio" name="faring_orofaring" value="Normal"> Normal</label>
                            <label class="radio-inline"><input type="radio" name="faring_orofaring" value="Abnormal"> Abnormal</label>
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>G. Pemeriksaan Penunjang (Upload jika perlu)</label>
                        <input type="file" class="form-control" id="pemeriksaan_penunjang" name="pemeriksaan_penunjang">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>H. Lainnya</label>
                        <input type="text" class="form-control" name="lainnya">
                    </div>
                </div>
            </div>
        </div>

        <!-- Assessment -->
        <div class="border rounded p-3 mb-3">
        <h4>ASSESMENT</h4>
        <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="kode_icd10">Kode ICD - 10<span class="required">*</span></label>
                <input type="text" class="form-control" id="kode_icd10" name="kode_icd10" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="diagnosa_icd10">Diagnosa ICD - 10</label>
                <input type="text" class="form-control" id="diagnosa_icd10" name="diagnosa_icd10" readonly>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="catatan_assessment">Catatan Assesmen Pemeriksaan</label>
                <textarea class="form-control" id="catatan_assessment" name="catatan_assessment" rows="3"></textarea>
            </div>
        </div>
        </div>
        </div>

        <!-- Plan -->
        <div class="border rounded p-3 mb-3">
        <h4>PLAN</h4>
        <div class="form-group">
            <label for="rencana_tindaklanjut">Rencana Tindaklanjut Pasien<span class="required">*</span></label>
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
        </div>

        <!-- Medication Prescription -->
        <div class="border rounded p-3 mb-3">
            <h4>RESEP OBAT</h4>
            <div id="prescription-container">
                <div class="row prescription-row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Nama Obat</label>
                            <input type="text" class="form-control" placeholder="Inputkan nama obat" name="nama_obat[]">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Satuan</label>
                            <input type="text" class="form-control" placeholder="Inputkan satuan" name="satuan[]">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Jumlah Obat</label>
                            <input type="text" class="form-control" placeholder="Inputkan jumlah obat" name="jumlah_obat[]">
                        </div>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="button" class="btn btn-success add-prescription-row">+</button>
                        <button type="button" class="btn btn-danger remove-prescription-row ml-2">-</button>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Catatan Resep</label>
                <textarea class="form-control" name="catatan_resep" placeholder="Inputkan catatan resep" rows="3"></textarea>
            </div>
        </div>

        <!-- Authentication -->
        <div class="border rounded p-3 mb-3">
        <div class="row">
            <div class="col-md-6">
                <h4>AUTENTIFIKASI</h4>
                    <div class="form-group">
                        <label for="nama_dokter_search">Nama Dokter<span class="required">*</span></label>
                        <input type="text" class="form-control" id="nama_dokter_search" placeholder="Cari nama dokter..." oninput="searchDoctor()">
                        <div id="nama_dokter_suggestions" class="list-group"></div>
                    </div>
            </div>  
            <div class="col-md-6">
                <h3>&nbsp;</h3> 
                <div class="form-group">
                    <label for="tanda_tangan">Tanda Tangan<span class="required">*</span></label>
                    <div id="signature-pad" class="signature-pad">
                        <div class="signature-pad-body">
                            <canvas></canvas>
                        </div>
                        <button type="button" class="btn btn-secondary" id="clear-signature">Hapus Tanda Tangan</button>
                        <input type="hidden" id="tanda_tangan" name="tanda_tangan">
                    </div>
                </div>
            </div>
        </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="#" class="btn btn-secondary">Batal</a>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
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

    function searchDoctor() {
        const input = document.getElementById('nama_dokter_search');
        const filter = input.value.toLowerCase();
        const suggestions = document.getElementById('nama_dokter_suggestions');

        const doctors = ['dr. Dania Eka Susila', 'dr. Budi Setiawan', 'dr. Siti Nurhaliza'];

        suggestions.innerHTML = '';

        if (filter.length > 0) {
            const filteredDoctors = doctors.filter(doctor => doctor.toLowerCase().includes(filter));
            filteredDoctors.forEach(doctor => {
                const suggestionItem = document.createElement('a');
                suggestionItem.className = 'list-group-item list-group-item-action';
                suggestionItem.innerText = doctor;
                suggestionItem.onclick = () => {
                    document.getElementById('nama_dokter_search').value = doctor;
                    suggestions.innerHTML = '';
                };
                suggestions.appendChild(suggestionItem);
            });
        }
    }

    $(document).ready(function() {
        function addPrescriptionRow() {
            var newRow = `
            <div class="row prescription-row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Nama Obat</label>
                        <input type="text" class="form-control" placeholder="Inputkan nama obat" name="nama_obat[]">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Satuan</label>
                        <input type="text" class="form-control" placeholder="Inputkan satuan" name="satuan[]">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Jumlah Obat</label>
                        <input type="text" class="form-control" placeholder="Inputkan jumlah obat" name="jumlah_obat[]">
                    </div>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button type="button" class="btn btn-success add-prescription-row">+</button>
                    <button type="button" class="btn btn-danger remove-prescription-row ml-2">-</button>
                </div>
            </div>`;
            $('#prescription-container').append(newRow);
        }
        
        function removePrescriptionRow(button) {
            $(button).closest('.prescription-row').remove();
        }
     
        $('#prescription-container').on('click', '.add-prescription-row', function() {
            addPrescriptionRow();
        });

      
        $('#prescription-container').on('click', '.remove-prescription-row', function() {
            removePrescriptionRow(this);
        });
    });
</script>
@endsection
