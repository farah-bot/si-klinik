@extends('layouts.app')

@section('title', 'Edit Pasien')

@section('content')
    <div class="data-pengguna-container">
        <div class="container">
            <div class="data-pengguna-header">
                <h2>Edit Pasien</h2>
            </div>
            <div class="card-body">
                <form id="pendaftaranForm" action="{{ route('updatepasien', $pasien->id) }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="no_rm">No RM</label>
                                <input type="text" id="no_rm" name="no_rm" class="form-control"
                                    value="{{ $pasien->no_rm }}" required>
                            </div>
                            <div class="form-group">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select id="jenis_kelamin" name="jenis_kelamin" class="form-control" required>
                                    <option value="Laki-Laki" {{ $pasien->jenis_kelamin == 'Laki-Laki' ? 'selected' : '' }}>
                                        Laki-Laki</option>
                                    <option value="Perempuan" {{ $pasien->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>
                                        Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama Lengkap Pasien</label>
                                <input type="text" id="nama" name="nama" class="form-control"
                                    value="{{ $pasien->nama }}" required>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control"
                                    value="{{ $pasien->tanggal_lahir }}" required>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea id="alamat" name="alamat" class="form-control" rows="3" required>{{ $pasien->alamat }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="nomor_telepon">Nomor Telepon</label>
                                <input type="text" id="nomor_telepon" name="nomor_telepon" class="form-control"
                                    value="{{ $pasien->nomor_telepon }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nik">NIK</label>
                                <input type="text" id="nik" name="nik" class="form-control"
                                    value="{{ $pasien->nik }}" required>
                            </div>
                            <div class="form-group">
                                <label for="jenis_pasien">Jenis Pasien</label>
                                <select id="jenis_pasien" name="jenis_pasien" class="form-control"
                                    onchange="toggleBPJSInput()" required>
                                    <option value="">- Pilih -</option>
                                    <option value="Umum" {{ $pasien->jenis_pasien == 'Umum' ? 'selected' : '' }}>Umum
                                    </option>
                                    <option value="BPJS" {{ $pasien->jenis_pasien == 'BPJS' ? 'selected' : '' }}>BPJS
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="nomor_bpjs">Nomor BPJS</label>
                                <input type="text" id="nomor_bpjs" name="nomor_bpjs" class="form-control"
                                    value="{{ $pasien->nomor_bpjs }}"
                                    {{ $pasien->jenis_pasien == 'BPJS' ? '' : 'disabled' }}>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h4>Data Kunjungan Pasien</h4>
                    <div id="kunjungan-container">
                        @foreach ($pasien->kunjungans as $kunjungan)
                            <div class="form-group kunjungan-group">
                                <input type="hidden" name="kunjungans[{{ $loop->index }}][id]"
                                    value="{{ $kunjungan->id }}">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="kunjungans[{{ $loop->index }}][tanggal_kunjungan]">Tanggal
                                            Kunjungan</label>
                                        <input type="date" id="kunjungans[{{ $loop->index }}][tanggal_kunjungan]"
                                            name="kunjungans[{{ $loop->index }}][tanggal_kunjungan]" class="form-control"
                                            value="{{ $kunjungan->tanggal_kunjungan }}" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="kunjungans[{{ $loop->index }}][poli_tujuan]">Poli Tujuan</label>
                                        <select id="kunjungans[{{ $loop->index }}][poli_tujuan]"
                                            name="kunjungans[{{ $loop->index }}][poli_tujuan]" class="form-control"
                                            required>
                                            <option value="Poli Umum"
                                                {{ $kunjungan->poli_tujuan == 'Poli Umum' ? 'selected' : '' }}>Poli Umum
                                            </option>
                                            <option value="Poli Gigi"
                                                {{ $kunjungan->poli_tujuan == 'Poli Gigi' ? 'selected' : '' }}>Poli Gigi
                                            </option>
                                            <option value="Poli KIA"
                                                {{ $kunjungan->poli_tujuan == 'Poli KIA' ? 'selected' : '' }}>Poli KIA
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="kunjungans[{{ $loop->index }}][jenis_kunjungan]">Jenis
                                            Kunjungan</label>
                                        <select id="kunjungans[{{ $loop->index }}][jenis_kunjungan]"
                                            name="kunjungans[{{ $loop->index }}][jenis_kunjungan]" class="form-control"
                                            required>
                                            <option value="Baru"
                                                {{ $kunjungan->jenis_kunjungan == 'Baru' ? 'selected' : '' }}>Baru</option>
                                            <option value="Lama"
                                                {{ $kunjungan->jenis_kunjungan == 'Lama' ? 'selected' : '' }}>Lama</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="kunjungans[{{ $loop->index }}][user_id]">Nama Dokter</label>
                                        <select id="kunjungans[{{ $loop->index }}][user_id]"
                                            name="kunjungans[{{ $loop->index }}][user_id]" class="form-control"
                                            required>
                                            @foreach ($dokters as $dokter)
                                                <option value="{{ $dokter->id }}"
                                                    {{ $kunjungan->user_id == $dokter->id ? 'selected' : '' }}>
                                                    {{ $dokter->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button type="submit" class="btn btn-primary">Update Pasien</button>
                </form>
            </div>
        </div>
    </div>
@endsection

<script>
    function toggleBPJSInput() {
        var jenisPasien = document.getElementById('jenis_pasien').value;
        var nomorBPJS = document.getElementById('nomor_bpjs');
        nomorBPJS.disabled = jenisPasien !== 'BPJS';
    }
</script>