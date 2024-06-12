@extends('layouts.app')

@section('title', 'Data Antrian Pasien Poli Umum')

@section('content')
<div class="data-pengguna-container">
    <div class="container">
        <div class="data-pengguna-header">
            <h2>Data Antrian Pasien Poli Umum</h2>
        </div>
        
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="search_pasien">Cari Data Pasien</label>
                    <input type="text" class="form-control" id="search_pasien" name="search_pasien" placeholder="Masukkan nama atau No. RM">
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nomor Antrian</th>
                        <th>Tanggal Periksa</th>
                        <th>Nama Pasien</th>
                        <th>No. RM</th>
                        <th>Jenis Kelamin</th>
                        <th>Jenis Kunjungan</th>
                        <th>Poli Tujuan</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between">
            <div id="entries-info">
                Showing 1 to 2 of 2 entries
            </div>
            <div>
                <button class="btn btn-primary" id="prevPage">Previous</button>
                <button class="btn btn-primary" id="nextPage">Next</button>
            </div>
        </div>
    </div>
</div>

<script>
    const data = [
        { nomor: '004', tanggal_periksa: '15/01/2023', nama: 'Kiara Azzahra', no_rm: '1500', jk: 'Perempuan', jenis_kunjungan: 'Baru', poli: 'Poli Umum', status: 'Belum Terlayani' },
        { nomor: '003', tanggal_periksa: '15/01/2023', nama: 'Ani Sulistyawati', no_rm: '1600', jk: 'Perempuan', jenis_kunjungan: 'Lama', poli: 'Poli Umum', status: 'Belum Terlayani' },
        { nomor: '002', tanggal_periksa: '15/01/2023', nama: 'Matt Dickerson', no_rm: '1502', jk: 'Laki - Laki', jenis_kunjungan: 'Lama', poli: 'Poli Umum', status: 'Belum Terlayani' },
        { nomor: '001', tanggal_periksa: '15/01/2023', nama: 'Aisyah Putri Wulandari', no_rm: '1503', jk: 'Perempuan', jenis_kunjungan: 'Baru', poli: 'Poli Umum', status: 'Sudah Terlayani' }
    ];

    let currentPage = 1;
    const entriesPerPage = 2;

    function renderTable(data) {
        const tableBody = document.getElementById('tableBody');
        tableBody.innerHTML = '';
        data.forEach(row => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>${row.nomor}</td>
                <td>${row.tanggal_periksa}</td>
                <td>${row.nama}</td>
                <td>${row.no_rm}</td>
                <td>${row.jk}</td>
                <td>${row.jenis_kunjungan}</td>
                <td>${row.poli}</td>
                <td>${row.status}</td>
                <td>
                    <button class="btn btn-info btn-sm">Detail</button>
                    <button class="btn btn-warning btn-sm">Edit</button>
                </td>
            `;
            tableBody.appendChild(tr);
        });
    }

    function updateEntriesInfo(count) {
        const entriesInfo = document.getElementById('entries-info');
        entriesInfo.textContent = `Showing ${count} entries`;
    }

    function filterData() {
        const searchValue = document.getElementById('search_pasien').value.toLowerCase();

        const filteredData = data.filter(row => {
            return row.nama.toLowerCase().includes(searchValue) || row.no_rm.toLowerCase().includes(searchValue);
        });

        renderTable(filteredData.slice((currentPage - 1) * entriesPerPage, currentPage * entriesPerPage));
        updateEntriesInfo(filteredData.length);
    }

    function paginate(direction) {
        if (direction === 'next') {
            currentPage++;
        } else {
            currentPage--;
        }

        filterData();
        updatePaginationButtons();
    }

    function updatePaginationButtons() {
        const prevPageButton = document.getElementById('prevPage');
        const nextPageButton = document.getElementById('nextPage');

        prevPageButton.disabled = currentPage === 1;
        nextPageButton.disabled = currentPage * entriesPerPage >= data.length;
    }

    document.getElementById('search_pasien').addEventListener('input', filterData);
    document.getElementById('prevPage').addEventListener('click', () => paginate('prev'));
    document.getElementById('nextPage').addEventListener('click', () => paginate('next'));

    renderTable(data.slice(0, entriesPerPage));
    updateEntriesInfo(data.length);
    updatePaginationButtons();
</script>
@endsection
