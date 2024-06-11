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
                    <input type="text" class="form-control" id="cari_pasien" name="cari_pasien" placeholder="Masukkan nama atau nomor rekam medis">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="filter_tanggal">Filter Tanggal Kunjungan</label>
                    <input type="date" class="form-control" id="filter_tanggal" name="filter_tanggal">
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
                    </tr>
                </thead>
                <tbody id="tableBody">
                 
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between">
            <div id="entries-info">
                Showing 1 to 5 of 5 entries
            </div>
            <div>
                <button class="btn btn-primary" id="prevPage" disabled>Previous</button>
                <button class="btn btn-primary" id="nextPage" disabled>Next</button>
            </div>
        </div>
    </div>
</div>

<script>
    const data = [
        { tanggal: '16/05/2023', no_rm: '1512', nama: 'Budi', jk: 'Laki - Laki', alamat: 'Tegal Gede', jenis_kunjungan: 'Lama', poli: 'Umum', dokter: 'dr. Dania Eka Susila' },
        { tanggal: '22/04/2023', no_rm: '1512', nama: 'Budi Susanto', jk: 'Laki - Laki', alamat: 'Tegal Gede', jenis_kunjungan: 'Lama', poli: 'Umum', dokter: 'dr. Dania Eka Susila' },
        { tanggal: '01/03/2023', no_rm: '1512', nama: 'Budi Susanto', jk: 'Laki - Laki', alamat: 'Tegal Gede', jenis_kunjungan: 'Lama', poli: 'Umum', dokter: 'dr. Dania Eka Susila' },
        { tanggal: '28/02/2023', no_rm: '1512', nama: 'Budi Susanto', jk: 'Laki - Laki', alamat: 'Tegal Gede', jenis_kunjungan: 'Lama', poli: 'Umum', dokter: 'dr. Dania Eka Susila' },
        { tanggal: '15/01/2023', no_rm: '1512', nama: 'Budi Susanto', jk: 'Laki - Laki', alamat: 'Tegal Gede', jenis_kunjungan: 'Lama', poli: 'Umum', dokter: 'dr. Dania Eka Susila' }
    ];

    function renderTable(data) {
        const tableBody = document.getElementById('tableBody');
        tableBody.innerHTML = '';
        data.forEach(row => {
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
            `;
            tableBody.appendChild(tr);
        });
    }

    function filterData() {
        const query = document.getElementById('cari_pasien').value.toLowerCase();
        const filterDate = document.getElementById('filter_tanggal').value;

        const filteredData = data.filter(row => {
            const matchQuery = row.nama.toLowerCase().includes(query) || row.no_rm.includes(query);
            const matchDate = !filterDate || row.tanggal === filterDate.split('-').reverse().join('/');
            return matchQuery && matchDate;
        });

        renderTable(filteredData);
        updateEntriesInfo(filteredData.length);
    }

    function updateEntriesInfo(count) {
        const entriesInfo = document.getElementById('entries-info');
        entriesInfo.textContent = `Showing 1 to ${count} of ${count} entries`;
    }

    document.getElementById('cari_pasien').addEventListener('input', filterData);
    document.getElementById('filter_tanggal').addEventListener('change', filterData);

    
    renderTable(data);
    updateEntriesInfo(data.length);
</script>
@endsection
