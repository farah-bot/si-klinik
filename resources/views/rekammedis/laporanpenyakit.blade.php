@extends('layouts.app')

@section('title', 'Laporan 10 Besar Penyakit')

@section('content')
<div class="data-pengguna-container">
    <div class="container">
        <div class="data-pengguna-header">
            <h2>Laporan 10 Besar Penyakit</h2>
        </div>

        <div class="row mb-3">
            <div class="col-md-3">
                <label for="filterPenyakit">Cari Nama Penyakit</label>
                <input type="text" id="filterPenyakit" class="form-control" placeholder="Nama Penyakit">
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
                        <th>No</th>
                        <th>Nama Penyakit</th>
                        <th>Kode ICD</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
               
                </tbody>
            </table>
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
        { no: 1, nama: 'Penyakit A', kode: 'A00', jumlah: 50 },
        { no: 2, nama: 'Penyakit B', kode: 'B00', jumlah: 45 },
        { no: 3, nama: 'Penyakit C', kode: 'C00', jumlah: 40 },
        { no: 4, nama: 'Penyakit D', kode: 'D00', jumlah: 35 },
        { no: 5, nama: 'Penyakit E', kode: 'E00', jumlah: 30 },
        { no: 6, nama: 'Penyakit F', kode: 'F00', jumlah: 25 },
        { no: 7, nama: 'Penyakit G', kode: 'G00', jumlah: 20 },
        { no: 8, nama: 'Penyakit H', kode: 'H00', jumlah: 15 },
        { no: 9, nama: 'Penyakit I', kode: 'I00', jumlah: 10 },
        { no: 10, nama: 'Penyakit J', kode: 'J00', jumlah: 5 },
    ];

    function renderTable(data) {
        const tableBody = document.getElementById('tableBody');
        tableBody.innerHTML = '';
        data.forEach(row => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>${row.no}</td>
                <td>${row.nama}</td>
                <td>${row.kode}</td>
                <td>${row.jumlah}</td>
            `;
            tableBody.appendChild(tr);
        });
    }

    function filterData() {
        const filterPenyakit = document.getElementById('filterPenyakit').value.toLowerCase();

        const filteredData = data.filter(row => {
            return row.nama.toLowerCase().includes(filterPenyakit);
        });

        renderTable(filteredData);
    }

    document.getElementById('btnCari').addEventListener('click', filterData);

    document.getElementById('btnCetakExcel').addEventListener('click', () => {
        const wb = XLSX.utils.book_new();
        const ws = XLSX.utils.table_to_sheet(document.getElementById('reportTable'));
        XLSX.utils.book_append_sheet(wb, ws, 'Laporan');
        XLSX.writeFile(wb, 'Laporan10BesarPenyakit.xlsx');
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
        doc.save('Laporan10BesarPenyakit.pdf');
    });

    window.onload = function() {
        renderTable(data);
    };
</script>
@endsection
