@extends('layouts.app')

@section('title', 'Formulir Pemeriksaan Poli Umum')

@section('content')
<div class="data-pengguna-container">
    <div class="container">
        <div class="data-pengguna-header">
            <h2>FORMULIR PEMERIKSAAN POLI UMUM</h2>
        </div>

        <!-- Patient Information Section -->
        <div class="border border-primary rounded p-3 mb-3">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nomor RM</label>
                        <input type="text" class="form-control" value="{{ $no_rm }}" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Tanggal Kunjungan</label>
                        <input type="date" class="form-control" id="filter_tanggal" name="filter_tanggal" value="{{ $tanggal_kunjungan }}" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nama Lengkap Pasien</label>
                        <input type="text" class="form-control" value="{{ $nama_pasien }}" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nama Dokter</label>
                        <input type="text" class="form-control" value="{{ $name }}" readonly>
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
                        <input type="text" class="form-control" name="tekanan_darah" placeholder="mm/Hg" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Suhu Tubuh<span class="required">*</span></label>
                        <input type="text" class="form-control" name="suhu_tubuh" placeholder="C" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>BB<span class="required">*</span></label>
                        <input type="text" class="form-control" name="bb" placeholder="kg" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Nadi<span class="required">*</span></label>
                        <input type="text" class="form-control" name="nadi" placeholder="x/menit" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>RR<span class="required">*</span></label>
                        <select class="form-control" id="rr" name="rr" required>
                        <option value="">--Pilih--</option>
                        <option value="Normal">Normal</option>
                        <option value="Tidak Normal">Tidak Normal</option>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>KU<span class="required">*</span></label>
                        <select class="form-control" id="ku" name="ku" required>
                        <option value="">--Pilih--</option>
                        <option value="Sakit Ringan">Sakit Ringan</option>
                        <option value="Sakit Berat">Sakit Berat</option>
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
                            <div>
                            <label>Sakit pada bagian Kepala/Leher?</label>
                            </div>
                            <div>
                                <label class="radio-inline"><input type="radio" name="sakit_kepala_leher" value="Kepala"> Kepala</label>
                                <label class="radio-inline"><input type="radio" name="sakit_kepala_leher" value="Leher"> Leher</label>
                            </div>
                            <label>Apakah bagian leher terdapat limfadenopati?</label>
                            <div>
                                <label class="radio-inline"><input type="radio" name="limfadenopati_leher" value="Positive"> Positive</label>
                                <label class="radio-inline"><input type="radio" name="limfadenopati_leher" value="Negative"> Negative</label>
                            </div>
                    </div>
                    <div class="form-group">
                            <label>B. Mata</label>
                            <div>
                            <label>Anemis pada bagian mata?</label>
                            </div>
                            <div>
                                <label class="radio-inline"><input type="radio" name="anemis_mata" value="Positive"> Positive</label>
                                <label class="radio-inline"><input type="radio" name="anemis_mata" value="Negative"> Negative</label>
                            </div>
                            <label>Hiperemia pada bagian mata?</label>
                            <div>
                                <label class="radio-inline"><input type="radio" name="hiperemia_mata" value="Positive"> Positive</label>
                                <label class="radio-inline"><input type="radio" name="hiperemia_mata" value="Negative"> Negative</label>
                            </div>
                    </div>
                    <div class="form-group">
                        <label>C. Telinga</label>
                            <label>Apakah pendengaran berfungsi dengan baik?</label>
                            <div>
                                <label class="radio-inline"><input type="radio" name="fungsi_pendengaran" value="Normal"> Normal</label>
                                <label class="radio-inline"><input type="radio" name="fungsi_pendengaran" value="Tidak"> Tidak</label>
                            </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>D. Hidung</label>
                        <div>
                            <label>Apakah bagian hidung simetris?</label>
                            </div>
                            <div>
                                <label class="radio-inline"><input type="radio" name="simetris_hidung" value="Positive"> Positive</label>
                                <label class="radio-inline"><input type="radio" name="simetris_hidung" value="Negative"> Negative</label>
                            </div>
                            <label>Apakah bagian konka normal?</label>
                            <div>
                                <label class="radio-inline"><input type="radio" name="konka_hidung" value="Normal"> Normal</label>
                                <label class="radio-inline"><input type="radio" name="konka_hidung" value="Tidak"> Tidak</label>
                            </div>
                    </div>
                    <div class="form-group">
                        <label>E. Gigi dan Mulut</label>
                            <label>Apakah gigi dan mulut normal?</label>
                            <div>
                                <label class="radio-inline"><input type="radio" name="normal_gigi_mulut" value="Normal"> Normal</label>
                                <label class="radio-inline"><input type="radio" name="normal_gigi_mulut" value="Tidak"> Tidak</label>
                            </div>
                    </div>
                    <div class="form-group">
                        <label>F. Faring dan Orofaring</label>
                            <label>Hiperemia pada bagian faring/orofaring?</label>
                            <div>
                                <label class="radio-inline"><input type="radio" name="hiperemia_faring" value="Positive"> Positive</label>
                                <label class="radio-inline"><input type="radio" name="hiperemia_faring" value="Negative"> Negative</label>
                            </div>
                    </div>
                    <div class="form-group">
                             <label>G. Urogenital</label>
                            <label>Apakah pada bagian urogenital normal?</label>
                            <div>
                                <label class="radio-inline"><input type="radio" name="normal_urogenital" value="Normal"> Normal</label>
                                <label class="radio-inline"><input type="radio" name="normal_urogenital" value="Tidak"> Tidak</label>
                            </div>
                    </div>
                </div>
            </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>H. Pemeriksaan Penunjang (Upload jika perlu)</label>
                            <input type="file" class="form-control" id="pemeriksaan_penunjang" name="pemeriksaan_penunjang">
                        </div>
                    </div>
                </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>I. Lainnya</label>
                            <input type="text" class="form-control" name="lainnya">
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
        <div class="row">
        <div class="col-md-6">
        <div class="form-group">
            <label for="rencana_tindaklanjut">Rencana Tindaklanjut Pasien<span class="required">*</span></label>
            <textarea class="form-control" id="rencana_tindaklanjut" name="rencana_tindaklanjut" rows="3" required></textarea>
        </div>
        </div>
        <div class="col-md-6">
        <div class="form-group">
            <label for="tindakan">Tindakan</label>
            <input type="text" class="form-control" id="tindakan" name="tindakan">
        </div>
        </div>
        <div class="col-md-6">
        <div class="form-group">
            <label for="rujukan">Rujukan</label>
            <input type="text" class="form-control" id="rujukan" name="rujukan">
        </div>
        </div>
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
            <button type="submit" class="btn btn-tambah">Simpan</button>
            <a href="#" class="btn btn-batal">Batal</a>
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
