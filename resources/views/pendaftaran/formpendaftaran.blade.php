@extends('layouts.app')

@section('title', 'Pendaftaran Pasien Baru')

@section('content')
    <div class="data-pengguna-container">
        <div class="container">
            <div class="data-pengguna-header">
                <h2>Pendaftaran Pasien Baru</h2>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form id="pendaftaranForm" action="{{ route('daftar_pasien') }}" method="POST"
                    onsubmit="return showModal(event)">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="no_rm">No RM</label>
                                <input type="text" id="no_rm" name="no_rm" class="form-control"
                                    value="{{ old('no_rm') }}" required>
                                @if ($errors->has('no_rm'))
                                    <span class="text-danger">{{ $errors->first('no_rm') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select id="jenis_kelamin" name="jenis_kelamin" class="form-control" required>
                                    <option value="Laki-Laki" {{ old('jenis_kelamin') == 'Laki-Laki' ? 'selected' : '' }}>
                                        Laki-Laki</option>
                                    <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                                        Perempuan</option>
                                </select>
                                @if ($errors->has('jenis_kelamin'))
                                    <span class="text-danger">{{ $errors->first('jenis_kelamin') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama Lengkap Pasien</label>
                                <input type="text" id="nama" name="nama" class="form-control"
                                    value="{{ old('nama') }}" required>
                                @if ($errors->has('nama'))
                                    <span class="text-danger">{{ $errors->first('nama') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control"
                                    value="{{ old('tanggal_lahir') }}" required>
                                @if ($errors->has('tanggal_lahir'))
                                    <span class="text-danger">{{ $errors->first('tanggal_lahir') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea id="alamat" name="alamat" class="form-control" rows="3" required>{{ old('alamat') }}</textarea>
                                @if ($errors->has('alamat'))
                                    <span class="text-danger">{{ $errors->first('alamat') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="nomor_telepon">Nomor Telepon</label>
                                <input type="text" id="nomor_telepon" name="nomor_telepon" class="form-control"
                                    value="{{ old('nomor_telepon') }}" required>
                                @if ($errors->has('nomor_telepon'))
                                    <span class="text-danger">{{ $errors->first('nomor_telepon') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nik">NIK</label>
                                <input type="text" id="nik" name="nik" class="form-control"
                                    value="{{ old('nik') }}" required>
                                @if ($errors->has('nik'))
                                    <span class="text-danger">{{ $errors->first('nik') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="jenis_pasien">Jenis Pasien</label>
                                <select id="jenis_pasien" name="jenis_pasien" class="form-control"
                                    onchange="toggleBPJSInput()" required>
                                    <option value="">- Pilih -</option>
                                    <option value="Umum" {{ old('jenis_pasien') == 'Umum' ? 'selected' : '' }}>Umum
                                    </option>
                                    <option value="BPJS" {{ old('jenis_pasien') == 'BPJS' ? 'selected' : '' }}>BPJS
                                    </option>
                                </select>
                                @if ($errors->has('jenis_pasien'))
                                    <span class="text-danger">{{ $errors->first('jenis_pasien') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="nomor_bpjs">Nomor BPJS</label>
                                <input type="text" id="nomor_bpjs" name="nomor_bpjs" class="form-control"
                                    value="{{ old('nomor_bpjs') }}" {{ old('jenis_pasien') != 'BPJS' ? 'disabled' : '' }}>
                                @if ($errors->has('nomor_bpjs'))
                                    <span class="text-danger">{{ $errors->first('nomor_bpjs') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h4>Data Kunjungan Pasien</h4>
                    <div class="form-group">
                        <label for="tanggal_kunjungan">Tanggal Kunjungan</label>
                        <input type="date" id="tanggal_kunjungan" name="tanggal_kunjungan" class="form-control"
                            value="{{ old('tanggal_kunjungan') }}">
                        @if ($errors->has('tanggal_kunjungan'))
                            <span class="text-danger">{{ $errors->first('tanggal_kunjungan') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="poli_tujuan">Poli Tujuan</label>
                        <select id="poli_tujuan" name="poli_tujuan" class="form-control" required>
                            <option value="">- Pilih -</option>
                            <option value="Poli Umum" {{ old('poli_tujuan') == 'Poli Umum' ? 'selected' : '' }}>Poli Umum
                            </option>
                            <option value="Poli Gigi" {{ old('poli_tujuan') == 'Poli Gigi' ? 'selected' : '' }}>Poli Gigi
                            </option>
                            <option value="Poli KIA" {{ old('poli_tujuan') == 'Poli KIA' ? 'selected' : '' }}>Poli KIA
                            </option>
                        </select>
                        @if ($errors->has('poli_tujuan'))
                            <span class="text-danger">{{ $errors->first('poli_tujuan') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Jenis Kunjungan</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kunjungan" id="jenis_kunjungan_baru"
                                value="Baru" {{ old('jenis_kunjungan') == 'Baru' ? 'checked' : '' }}>
                            <label class="form-check-label" for="jenis_kunjungan_baru">Baru</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kunjungan"
                                id="jenis_kunjungan_lama" value="Lama"
                                {{ old('jenis_kunjungan') == 'Lama' ? 'checked' : '' }}>
                            <label class="form-check-label" for="jenis_kunjungan_lama">Lama</label>
                        </div>
                        @if ($errors->has('jenis_kunjungan'))
                            <span class="text-danger">{{ $errors->first('jenis_kunjungan') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="nama_dokter">Nama Dokter</label>
                        <input type="text" id="nama_dokter" name="nama_dokter" class="form-control">
                        @if ($errors->has('nama_dokter'))
                            <span class="text-danger">{{ $errors->first('nama_dokter') }}</span>
                        @endif
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-tambah">Daftar</button>
                    <a href="#" class="btn btn-batal">Batal</a>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog"
        aria-labelledby="confirmationModalLabel" aria-hidden="true">
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
                    <button type="button" class="btn btn-batal" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-tambah" onclick="submitForm()">Ya, Daftar</button>
                </div>
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
