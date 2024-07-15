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
                            <p class="form-control-static">{{ $pemeriksaan->pasien->no_rm }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tanggal Kunjungan</label>
                            <p class="form-control-static">{{ $pemeriksaan->kunjungan->tanggal_kunjungan }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Lengkap Pasien</label>
                            <p class="form-control-static">{{ $pemeriksaan->pasien->nama }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Dokter</label>
                            <p class="form-control-static">{{ $pemeriksaan->user->name }}</p>
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
                            <p class="form-control-static">{{ $pemeriksaan->subject_keluhan }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="riwayat_alergi">Riwayat Alergi</label>
                            <p class="form-control-static">{{ $pemeriksaan->riwayat_alergi }}</p>
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
                            <p class="form-control-static">{{ $pemeriksaan->tekanan_darah }}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Suhu Tubuh<span class="required">*</span></label>
                            <p class="form-control-static">{{ $pemeriksaan->suhu_tubuh }}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>BB<span class="required">*</span></label>
                            <p class="form-control-static">{{ $pemeriksaan->berat_badan }}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Nadi<span class="required">*</span></label>
                            <p class="form-control-static">{{ $pemeriksaan->nadi }}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>RR<span class="required">*</span></label>
                            <p class="form-control-static">{{ $pemeriksaan->respiratory_rate }}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>KU<span class="required">*</span></label>
                            <p class="form-control-static">{{ $pemeriksaan->keadaan_umum }}</p>
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
                                <label class="radio-inline"><input type="radio" disabled name="sakit_kepala_leher"
                                        value="Kepala">
                                    {{ $pemeriksaan->sakit_kepala_leher }}</label>
                            </div>
                            <label>Apakah bagian leher terdapat limfadenopati?</label>
                            <div>
                                <label class="radio-inline"><input type="radio" disabled name="limfadenopati_leher"
                                        value="Positive"> {{ $pemeriksaan->limfadenopati_leher }}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>B. Mata</label>
                            <div>
                                <label>Anemis pada bagian mata?</label>
                            </div>
                            <div>
                                <label class="radio-inline"><input type="radio" disabled name="anemis_mata"
                                        value="Positive">
                                    {{ $pemeriksaan->anemis_mata }}</label>
                            </div>
                            <label>Hiperemia pada bagian mata?</label>
                            <div>
                                <label class="radio-inline"><input type="radio" disabled name="hiperemia_mata"
                                        value="Positive">
                                    {{ $pemeriksaan->hiperemia_mata }}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>C. Telinga</label>
                            <label>Apakah pendengaran berfungsi dengan baik?</label>
                            <div>
                                <label class="radio-inline"><input type="radio" disabled name="fungsi_pendengaran"
                                        value="Normal">
                                    {{ $pemeriksaan->fungsi_pendengaran }}</label>
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
                                <label class="radio-inline"><input type="radio" disabled name="simetris_hidung"
                                        value="Positive"> {{ $pemeriksaan->simetris_hidung }}</label>
                            </div>
                            <label>Apakah bagian konka normal?</label>
                            <div>
                                <label class="radio-inline"><input type="radio" disabled name="konka_hidung"
                                        value="Normal">
                                    {{ $pemeriksaan->konka_hidung }}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>E. Gigi dan Mulut</label>
                            <label>Apakah gigi dan mulut normal?</label>
                            <div>
                                <label class="radio-inline"><input type="radio" disabled name="normal_gigi_mulut"
                                        value="Normal"> {{ $pemeriksaan->normal_gigi_mulut }}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>F. Faring dan Orofaring</label>
                            <label>Hiperemia pada bagian faring/orofaring?</label>
                            <div>
                                <label class="radio-inline"><input type="radio" disabled name="hiperemia_faring"
                                        value="Positive"> {{ $pemeriksaan->hiperemia_faring }}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>G. Urogenital</label>
                            <label>Apakah pada bagian urogenital normal?</label>
                            <div>
                                <label class="radio-inline"><input type="radio" disabled name="normal_urogenital"
                                        value="Normal"> {{ $pemeriksaan->normal_urogenital }}</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>H. Pemeriksaan Penunjang</label>
                            @if ($pemeriksaan->pemeriksaan_penunjang)
                                <a href="{{ asset('storage/' . $pemeriksaan->pemeriksaan_penunjang) }}"
                                    class="btn btn-primary" download>Download Pemeriksaan Penunjang</a>
                            @else
                                <p class="form-control-static">No file uploaded</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>I. Lainnya</label>
                            <p class="form-control-static">{{ $pemeriksaan->lainnya }}</p>
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
                            <p class="form-control-static">{{ $pemeriksaan->diagnosa->kode_icd }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="diagnosa_icd10">Diagnosa ICD - 10</label>
                            <p class="form-control-static">{{ $pemeriksaan->diagnosa->diagnosis }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="catatan_assessment">Catatan Assesmen Pemeriksaan</label>
                            <p class="form-control-static">{{ $pemeriksaan->catatan_assessment }}</p>
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
                            <label for="rencana_tindaklanjut">Rencana Tindaklanjut Pasien<span
                                    class="required">*</span></label>
                            <p class="form-control-static">{{ $pemeriksaan->rencana_tindaklanjut }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tindakan">Tindakan</label>
                            <p class="form-control-static">{{ $pemeriksaan->tindakan }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="rujukan">Rujukan</label>
                            <p class="form-control-static">{{ $pemeriksaan->rujukan }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Medication Prescription -->
            <div class="border rounded p-3 mb-3">
                <h4>RESEP OBAT</h4>
                <div id="prescription-container">
                    @foreach ($obat as $obatItem)
                        <div class="row prescription-row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Nama Obat</label>
                                    <p class="form-control-static">{{ $obatItem->nama_obat }}</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Satuan</label>
                                    <p class="form-control-static">{{ $obatItem->satuan }}</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Jumlah Obat</label>
                                    <p class="form-control-static">{{ $obatItem->jumlah_obat }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="form-group">
                    <label>Catatan Resep</label>
                    <p class="form-control-static">{{ $pemeriksaan->catatan_resep }}</p>
                </div>
            </div>

            <!-- Authentication -->
            <div class="border rounded p-3 mb-3">
                <div class="row">
                    <div class="col-md-6">
                        <h4>AUTENTIFIKASI</h4>
                        <div class="form-group">
                            <label for="nama_dokter_search">Nama Dokter<span class="required">*</span></label>
                            <p class="form-control-static">{{ $pemeriksaan->user->name }}</p>
                            <div id="nama_dokter_suggestions" class="list-group"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h3>&nbsp;</h3>
                        <div class="form-group">
                            <label for="tanda_tangan">Tanda Tangan<span class="required">*</span></label>
                            <div id="signature-pad" class="signature-pad">
                                <img src="{{ $tanda_tangan }}" alt="Tanda Tangan" style="max-width: 300px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <a href="#" class="btn btn-batal">Kembali</a>
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
