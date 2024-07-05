@extends('layouts.app')

@section('title', 'Laporan Jasa Pelayanan')

@section('content')
<div class="data-pengguna-container">
    <div class="container">
        <div class="data-pengguna-header">
            <h2>Laporan Jasa Pelayanan</h2>
        </div>

        <div class="row mb-3">
            <div class="col-md-3">
                <label for="filterTanggal">Filter Tanggal Kunjungan</label>
                <input type="date" id="filterTanggal" class="form-control">
            </div>
            <div class="col-md-3">
                <label for="filterPoli">Filter Poli</label>
                <select id="filterPoli" class="form-control">
                    <option value="">Semua</option>
                    <option value="Umum">Umum</option>
                    <option value="Gigi">Gigi</option>
                    <option value="KIA">KIA</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="filterWaktu">Filter Waktu Pelayanan</label>
                <select id="filterWaktu" class="form-control">
                    <option value="">Semua</option>
                    <option value="Pagi">Pagi</option>
                    <option value="Sore">Sore</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="filterDokter">Filter Nama Dokter/Bidan</label>
                <input type="text" id="filterDokter" class="form-control" placeholder="Nama Dokter/Bidan">
            </div>
            <div class="col-md-3">
                <button id="btnCari" class="btn btn-cari mt-4">Cari</button>
            </div>
        </div>

        <div class="row mb-3 justify-content-end">
            <div class="col-auto">
                <button id="btnCetakExcel" class="btn-icon" style="color: green;">
                    <i class="fas fa-file-excel"></i>
                </button>
                <button id="btnCetakPDF" class="btn-icon" style="color: red;">
                    <i class="fas fa-file-pdf"></i>
                </button>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered" id="reportTable">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Waktu Pelayanan</th>
                        <th>Poli</th>
                        <th>Nama Dokter/Bidan</th>
                        <th>Jumlah Pasien BPJS</th>
                        <th>Jumlah Pasien Umum</th>
                        <th>Total Pasien</th>
                    </tr>
                </thead>
                <tbody id="tableBody">

                </tbody>
            </table>
        </div>

        <div class="row mt-3">
            <div class="col-md-12">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-end">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<style>
    @media print {
        body * {
            visibility: hidden;
        }
        .table-responsive, .table-responsive * {
            visibility: visible;
        }
        .table-responsive {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }
    }
</style>

<script>
    const data = [
        { tanggal: '12/12/2023', waktu: 'Pagi', poli: 'Umum', dokter: 'dr. Dina', bpjs: 60, umum: 10, total: 70 },
        { tanggal: '12/12/2023', waktu: 'Sore', poli: 'Umum', dokter: 'dr. Tiara', bpjs: 30, umum: 5, total: 35 },
        { tanggal: '12/12/2023', waktu: 'Pagi', poli: 'Gigi', dokter: 'drg. Yuni', bpjs: 40, umum: 5, total: 45 },
        { tanggal: '12/12/2023', waktu: 'Sore', poli: 'Gigi', dokter: 'drg. Lala', bpjs: 20, umum: 10, total: 30 },
        { tanggal: '12/12/2023', waktu: 'Pagi', poli: 'KIA', dokter: 'Aisyah., S.Keb', bpjs: 20, umum: 0, total: 20 },
        { tanggal: '12/12/2023', waktu: 'Sore', poli: 'KIA', dokter: 'Sinta., S.Keb', bpjs: 10, umum: 5, total: 15 },
    ];

    let currentPage = 1;
    const entriesPerPage = 5;

    function renderTable(data) {
        const tableBody = document.getElementById('tableBody');
        tableBody.innerHTML = '';
        data.forEach(row => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>${row.tanggal}</td>
                <td>${row.waktu}</td>
                <td>${row.poli}</td>
                <td>${row.dokter}</td>
                <td>${row.bpjs}</td>
                <td>${row.umum}</td>
                <td>${row.total}</td>
            `;
            tableBody.appendChild(tr);
        });
    }

    function updateEntriesInfo(count) {
        const entriesInfo = document.getElementById('entries-info');
        entriesInfo.textContent = `Showing ${Math.min((currentPage - 1) * entriesPerPage + 1, count)} to ${Math.min(currentPage * entriesPerPage, count)} of ${count} entries`;
    }

    function filterData() {
        const filterTanggal = document.getElementById('filterTanggal').value;
        const filterPoli = document.getElementById('filterPoli').value;
        const filterWaktu = document.getElementById('filterWaktu').value;
        const filterDokter = document.getElementById('filterDokter').value.toLowerCase();

        const filteredData = data.filter(row => {
            return (
                (filterTanggal === '' || row.tanggal === filterTanggal.split('-').reverse().join('/')) &&
                (filterPoli === '' || row.poli === filterPoli) &&
                (filterWaktu === '' || row.waktu === filterWaktu) &&
                (filterDokter === '' || row.dokter.toLowerCase().includes(filterDokter))
            );
        });

        renderTable(filteredData.slice((currentPage - 1) * entriesPerPage, currentPage * entriesPerPage));
        updateEntriesInfo(filteredData.length);
        updatePaginationButtons(filteredData.length);
    }

    function paginate(direction) {
        if (direction === 'next') {
            currentPage++;
        } else {
            currentPage--;
        }

        filterData();
    }

    function updatePaginationButtons(totalEntries) {
        const prevPageButton = document.getElementById('prevPage');
        const nextPageButton = document.getElementById('nextPage');

        prevPageButton.disabled = currentPage === 1;
        nextPageButton.disabled = currentPage * entriesPerPage >= totalEntries;
    }

    document.getElementById('btnCari').addEventListener('click', filterData);
    document.getElementById('prevPage').addEventListener('click', () => paginate('prev'));
    document.getElementById('nextPage').addEventListener('click', () => paginate('next'));


    document.getElementById('btnCetakExcel').addEventListener('click', () => {
        const wb = XLSX.utils.book_new();
        const ws = XLSX.utils.table_to_sheet(document.getElementById('reportTable'));
        XLSX.utils.book_append_sheet(wb, ws, 'Laporan');
        XLSX.writeFile(wb, 'LaporanJasaPelayanan.xlsx');
    });

    
    document.getElementById('btnCetakPDF').addEventListener('click', () => {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();
        doc.autoTable({
            html: '#reportTable',
            startY: 10,
            theme: 'grid',
            headStyles: { fillColor: [22, 160, 133] },
        });
        doc.save('LaporanJasaPelayanan.pdf');
    });

    window.onload = function() {
        filterData();
    };
</script>
@endsection
