@extends('layouts.app')

@section('title', 'Formulir Pemeriksaan Poli Umum')

@section('content')
    <div class="data-pengguna-container">
        <div class="container">
            <div class="data-pengguna-header">
                <h2>FORMULIR PEMERIKSAAN POLI UMUM</h2>
            </div>
            <form action="{{ route('pemeriksaan.storePoliUmum') }}" method="POST" id="form-pemeriksaan" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="kunjungan_id" value="{{ $kunjungan->id }}">
                <!-- Patient Information Section -->
                <div class="border border-primary rounded p-3 mb-3">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nomor RM</label>
                                <input type="text" class="form-control" name="no_rm" value="{{ $no_rm }}"
                                    readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal Kunjungan</label>
                                <input type="date" class="form-control" id="filter_tanggal" name="tanggal_kunjungan"
                                    value="{{ $tanggal_kunjungan }}" readonly>
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
                                <input type="text" class="form-control" name="name" value="{{ $name }}"
                                    readonly>
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
                                <textarea class="form-control" id="keluhan_pasien" placeholder="Input keluhan pasien" name="keluhan_pasien"
                                    rows="3" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="riwayat_alergi">Riwayat Alergi</label>
                                <textarea class="form-control" id="riwayat_alergi" placeholder="Input riwayat alergi pasien" name="riwayat_alergi"
                                    rows="3"></textarea>
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
                                <input type="text" class="form-control" id="tekanan_darah" name="tekanan_darah"
                                    placeholder="mm/Hg" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Suhu Tubuh<span class="required">*</span></label>
                                <input type="text" class="form-control" id="suhu_tubuh" name="suhu_tubuh" placeholder="C"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>BB<span class="required">*</span></label>
                                <input type="text" class="form-control" id="bb" name="bb" placeholder="kg"
                                    required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nadi<span class="required">*</span></label>
                                <input type="text" class="form-control" id="nadi" name="nadi"
                                    placeholder="x/menit" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>RR<span class="required">*</span></label>
                                <select class="form-control" id="rr" name="rr" required>
                                    <option value="">--Pilih--</option>
                                    <option value="Normal">Normal</option>
                                    <option value="Tidak Normal">Tidak Normal</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>KU<span class="required">*</span></label>
                                <select class="form-control" id="ku" name="ku" required>
                                    <option value="">--Pilih--</option>
                                    <option value="Sakit Ringan">Sakit Ringan</option>
                                    <option value="Sakit Berat">Sakit Berat</option>
                                </select>
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
                                    <label class="radio-inline"><input type="radio" id="sakit_kepala_leher"
                                            name="sakit_kepala_leher" value="Kepala"> Kepala</label>
                                    <label class="radio-inline"><input type="radio" id="sakit_kepala_leher"
                                            name="sakit_kepala_leher" value="Leher"> Leher</label>
                                </div>
                                <label>Apakah bagian leher terdapat limfadenopati?</label>
                                <div>
                                    <label class="radio-inline"><input type="radio" id="limfadenopati_leher"
                                            name="limfadenopati_leher" value="Positive"> Positive</label>
                                    <label class="radio-inline"><input type="radio" id="limfadenopati_leher"
                                            name="limfadenopati_leher" value="Negative"> Negative</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>B. Mata</label>
                                <div>
                                    <label>Anemis pada bagian mata?</label>
                                </div>
                                <div>
                                    <label class="radio-inline"><input type="radio" id="anemis_mata"
                                            name="anemis_mata" value="Positive">
                                        Positive</label>
                                    <label class="radio-inline"><input type="radio" id="anemis_mata"
                                            name="anemis_mata" value="Negative">
                                        Negative</label>
                                </div>
                                <label>Hiperemia pada bagian mata?</label>
                                <div>
                                    <label class="radio-inline"><input type="radio" id="hiperemia_mata"
                                            name="hiperemia_mata" value="Positive"> Positive</label>
                                    <label class="radio-inline"><input type="radio" id="hiperemia_mata"
                                            name="hiperemia_mata" value="Negative"> Negative</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>C. Telinga</label>
                                <label>Apakah pendengaran berfungsi dengan baik?</label>
                                <div>
                                    <label class="radio-inline"><input type="radio" id="fungsi_pendengaran"
                                            name="fungsi_pendengaran" value="Normal"> Normal</label>
                                    <label class="radio-inline"><input type="radio" id="fungsi_pendengaran"
                                            name="fungsi_pendengaran" value="Tidak"> Tidak</label>
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
                                    <label class="radio-inline"><input type="radio" id="simetris_hidung"
                                            name="simetris_hidung" value="Positive"> Positive</label>
                                    <label class="radio-inline"><input type="radio" id="simetris_hidung"
                                            name="simetris_hidung" value="Negative"> Negative</label>
                                </div>
                                <label>Apakah bagian konka normal?</label>
                                <div>
                                    <label class="radio-inline"><input type="radio" id="konka_hidung"
                                            name="konka_hidung" value="Normal">
                                        Normal</label>
                                    <label class="radio-inline"><input type="radio" id="konka_hidung"
                                            name="konka_hidung" value="Tidak">
                                        Tidak</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>E. Gigi dan Mulut</label>
                                <label>Apakah gigi dan mulut normal?</label>
                                <div>
                                    <label class="radio-inline"><input type="radio" id="normal_gigi_mulut"
                                            name="normal_gigi_mulut" value="Normal"> Normal</label>
                                    <label class="radio-inline"><input type="radio" id="normal_gigi_mulut"
                                            name="normal_gigi_mulut" value="Tidak"> Tidak</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>F. Faring dan Orofaring</label>
                                <label>Hiperemia pada bagian faring/orofaring?</label>
                                <div>
                                    <label class="radio-inline"><input type="radio" id="hiperemia_faring"
                                            name="hiperemia_faring" value="Positive"> Positive</label>
                                    <label class="radio-inline"><input type="radio" id="hiperemia_faring"
                                            name="hiperemia_faring" value="Negative"> Negative</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>G. Urogenital</label>
                                <label>Apakah pada bagian urogenital normal?</label>
                                <div>
                                    <label class="radio-inline"><input type="radio" id="normal_urogenital"
                                            name="normal_urogenital" value="Normal"> Normal</label>
                                    <label class="radio-inline"><input type="radio" id="normal_urogenital"
                                            name="normal_urogenital" value="Tidak"> Tidak</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>H. Pemeriksaan Penunjang (Upload jika perlu)</label>
                                <input type="file" class="form-control" id="pemeriksaan_penunjang"
                                    name="pemeriksaan_penunjang">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>I. Lainnya</label>
                            <input type="text" class="form-control" id="lainnya" name="lainnya">
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
                                <input type="text" class="form-control" id="diagnosa_icd10" name="diagnosa_icd10"
                                    readonly>
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
                        <label for="rencana_tindaklanjut">Rencana Tindaklanjut Pasien<span
                                class="required">*</span></label>
                        <select class="form-control" id="rencana_tindaklanjut" name="rencana_tindaklanjut" required>
                            <option value="">--Pilih--</option>
                            <option value="Medikamentosa">Medikamentosa</option>
                            <option value="Tindakan">Tindakan</option>
                            <option value="Rujukan">Rujukan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tindakan">Tindakan</label>
                        <textarea class="form-control" id="tindakan" placeholder="Tindakan" name="tindakan" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="rujukan">Rujukan</label>
                        <textarea class="form-control" id="rujukan" placeholder="Rujukan" name="rujukan" rows="3"></textarea>
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
                                    <input type="text" class="form-control" placeholder="Inputkan nama obat"
                                        name="nama_obat[]">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Satuan</label>
                                    <input type="text" class="form-control" placeholder="Inputkan satuan"
                                        name="satuan[]">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Jumlah Obat</label>
                                    <input type="text" class="form-control" placeholder="Inputkan jumlah obat"
                                        name="jumlah_obat[]">
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
                                <input type="text" class="form-control" id="nama_dokter_search"
                                    placeholder="Cari nama dokter..." oninput="searchDoctor()">
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
                                    <button type="button" class="btn btn-secondary" id="clear-signature">Hapus Tanda
                                        Tangan</button>
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
            </form>
        </div>
    @endsection

    @section('scripts')
        <script>
            $(document).ready(function() {
                $('#kode_icd10').on('input', function() {
                    var kodeIcd = $(this).val();
                    if (kodeIcd.length > 0) {
                        $.ajax({
                            url: '/fetch-diagnosa',
                            method: 'GET',
                            data: {
                                kode_icd10: kodeIcd
                            },
                            success: function(response) {
                                $('#diagnosa_icd10').val(response);
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                            }
                        });
                    }
                });

                $('#form-pemeriksaan').submit(function(event) {
                    event.preventDefault();

                    $.ajax({
                        url: '{{ route('updateStatusUmum', $kunjungan->id) }}',
                        type: 'PUT',
                        data: {
                            _token: '{{ csrf_token() }}',
                            status: 'Sudah Terlayani'
                        },
                        success: function(response) {
                            console.log('Status Kunjungan berhasil diupdate.');
                            $('#form-pemeriksaan').unbind('submit').submit();
                        },
                        error: function(xhr, status, error) {
                            console.error('Error updating status Kunjungan:', error);
                        }
                    });
                });

                var canvas = document.querySelector("canvas");
                var signaturePad = new SignaturePad(canvas);

                $('#clear-signature').click(function() {
                    signaturePad.clear();
                    $('#tanda_tangan').val('');
                });

                $('#form-pemeriksaan').submit(function() {
                    if (!signaturePad.isEmpty()) {
                        $('#tanda_tangan').val(signaturePad.toDataURL('image/png'));
                    }
                });
            });
            
            document.addEventListener('DOMContentLoaded', function() {
                const prescriptionContainer = document.getElementById('prescription-container');
                const addPrescriptionRow = document.querySelector('.add-prescription-row');

                addPrescriptionRow.addEventListener('click', function() {
                    const newPrescriptionRow = document.createElement('div');
                    newPrescriptionRow.classList.add('row', 'prescription-row');
                    newPrescriptionRow.innerHTML = `
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="nama_obat">Nama Obat<span class="required">*</span></label>
                            <input type="text" class="form-control" name="nama_obat[]" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Satuan</label>
                            <input type="text" class="form-control" placeholder="Inputkan satuan" name="satuan[]" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Jumlah Obat</label>
                            <input type="text" class="form-control" placeholder="Inputkan jumlah obat" name="jumlah_obat[]" required>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="button" class="btn btn-success add-prescription-row">+</button>
                        <button type="button" class="btn btn-danger remove-prescription-row ml-2">-</button>
                    </div>
                `;
                    prescriptionContainer.appendChild(newPrescriptionRow);

                    newPrescriptionRow.querySelector('.remove-prescription-row').addEventListener('click',
                        function() {
                            newPrescriptionRow.remove();
                        });
                });

                prescriptionContainer.addEventListener('click', function(event) {
                    if (event.target.classList.contains('remove-prescription-row')) {
                        const row = event.target.closest('.prescription-row');
                        row.remove();
                    }
                });
            });
        </script>
    @endsection
