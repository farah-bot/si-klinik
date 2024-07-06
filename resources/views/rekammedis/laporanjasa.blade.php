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
                    <option value="Poli Umum">Umum</option>
                    <option value="Poli Gigi">Gigi</option>
                    <option value="Poli KIA">KIA</option>
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
                    @foreach($results as $result)
                        <tr>
                            <td>{{ $result['tanggal'] }}</td>
                            <td>{{ $result['waktu'] }}</td>
                            <td>{{ $result['poli'] }}</td>
                            <td>{{ $result['dokter'] }}</td>
                            <td>{{ $result['bpjs'] }}</td>
                            <td>{{ $result['umum'] }}</td>
                            <td>{{ $result['total'] }}</td>
                        </tr>
                    @endforeach
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
    document.getElementById('btnCari').addEventListener('click', function() {
        const filterTanggal = document.getElementById('filterTanggal').value;
        const filterPoli = document.getElementById('filterPoli').value;
        const filterWaktu = document.getElementById('filterWaktu').value;
        const filterDokter = document.getElementById('filterDokter').value;

        const url = new URL(window.location.href);
        url.searchParams.set('filterTanggal', filterTanggal);
        url.searchParams.set('filterPoli', filterPoli);
        url.searchParams.set('filterWaktu', filterWaktu);
        url.searchParams.set('filterDokter', filterDokter);
        window.location.href = url.toString();
    });

    document.getElementById('btnCetakExcel').addEventListener('click', () => {
        const wb = XLSX.utils.book_new();
        const ws = XLSX.utils.table_to_sheet(document.getElementById('reportTable'));
        XLSX.utils.book_append_sheet(wb, ws, 'Laporan');
        XLSX.writeFile(wb, 'LaporanJasaPelayanan.xlsx');
    });

    document.getElementById('btnCetakPDF').addEventListener('click', () => {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();
        doc.autoTable({ html: '#reportTable' });
        doc.save('LaporanJasaPelayanan.pdf');
    });
</script>
@endsection
