@extends('layouts.app')

@section('title', 'Riwayat Pelayanan Pasien')

@section('content')
    <div class="data-pengguna-container">
        <div class="container">
            <div class="data-pengguna-header">
                <h2>RIWAYAT PELAYANAN PASIEN</h2>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="cari_pasien">Cari Data Pasien</label>
                        <input type="text" class="form-control" id="cari_pasien" name="cari_pasien"
                            placeholder="Masukkan nama atau nomor rekam medis" oninput="filterData()">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="filter_tanggal">Filter Tanggal Kunjungan</label>
                        <input type="date" class="form-control" id="filter_tanggal" name="filter_tanggal"
                            onchange="filterData()">
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Tanggal Kunjungan</th>
                            <th>Nomor Rekam Medis</th>
                            <th>Nama Pasien</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat</th>
                            <th>Jenis Kunjungan</th>
                            <th>Poli Tujuan</th>
                            <th>Nama Dokter</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                    </tbody>
                </table>
                <div id="noDataFound" style="display: none;" class="alert alert-info mt-3">
                    Data tidak ditemukan.
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-12">
                    {{ $riwayatPelayanan->links('vendor.pagination.bootstrap-5') }}
                </div>
            </div>


        </div>
    </div>

    <script>
        const Patientdata = [

            @foreach ($riwayatPelayanan as $riwayat)
                {
                    
                    id: '{{ $riwayat->id }}',
                    tanggal: '{{ $riwayat->tanggal_kunjungan }}',
                    no_rm: '{{ $riwayat->pasien->no_rm }}',
                    nama: '{{ $riwayat->pasien->nama }}',
                    jk: '{{ $riwayat->pasien->jenis_kelamin }}',
                    alamat: '{{ $riwayat->pasien->alamat }}',
                    jenis_kunjungan: '{{ $riwayat->jenis_kunjungan }}',
                    poli: '{{ $riwayat->poli_tujuan }}',
                    dokter: '{{ $riwayat->user->name }}',
                },
            @endforeach
        ];

        function renderTable(Patientdata) {
            const tableBody = document.getElementById('tableBody');
            tableBody.innerHTML = '';
            Patientdata.forEach(row => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                <td>${row.tanggal}</td>
                <td>${row.no_rm}</td>
                <td>${row.nama}</td>
                <td>${row.jk}</td>
                <td>${row.alamat}</td>
                <td>${row.jenis_kunjungan}</td>
                <td>${row.poli}</td>
                <td>${row.dokter}</td>
                <td>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-info btn-sm" onclick="viewPatient('${row.id}','${row.poli}')">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </td>
            `;
                tableBody.appendChild(tr);
            });

            updateDataInfo(Patientdata.length);
        }

        function viewPatient(id,poli) {
            const data = Patientdata.find(row => row.id === id & row.poli ===
                poli);

            let editUrl;
            switch (data.poli) {
                case 'Poli Gigi':
                    editUrl = '/detailpoligigi/' + id + '/' + poli;
                    break;
                case 'Poli Umum':
                    editUrl = '/detailpoliumum/' + id + '/' + poli;
                    break;
                case 'Poli KIA':
                    editUrl = '/detailpolikia/' + id + '/' + poli;
                    break;
                default:
                    console.error('Poli tidak dikenali:', data.poli);
                    return;
            }

            window.location.href = editUrl;
        }

        function filterData() {
            const filterPasien = document.getElementById('cari_pasien').value.toLowerCase();
            const filterRm = document.getElementById('cari_pasien').value;
            const filterTanggal = document.getElementById('filter_tanggal').value;
            const filteredData = data.filter(row => {
                const namaMatch = row.nama.toLowerCase().includes(filterPasien);
                const rmMatch = row.no_rm.includes(filterPasien);
                const tanggalMatch = filterTanggal ? row.tanggal === filterTanggal : true;
                return namaMatch && tanggalMatch || rmMatch && tanggalMatch;
            });

            renderTable(filteredData);

            const noDataFound = document.getElementById('noDataFound');
            if (filteredData.length > 0) {
                noDataFound.style.display = 'none';
            } else {
                noDataFound.style.display = 'block';
            }
        }

        function updateDataInfo(totalEntries) {
            const dataInfo = document.getElementById('dataInfo');
            const startEntry = 1;
            const endEntry = totalEntries;
            dataInfo.textContent = `Showing ${startEntry} to ${endEntry} of ${totalEntries} entries`;
        }

        renderTable(Patientdata);
    </script>
@endsection
