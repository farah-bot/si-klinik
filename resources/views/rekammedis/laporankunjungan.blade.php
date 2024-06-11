@extends('layouts.app')

@section('title', 'Laporan Kunjungan')

@section('content')
<div class="data-pengguna-container">
    <div class="container">
        <div class="data-pengguna-header">
            <h2>Laporan Kunjungan</h2>
        </div>
        
        <div class="row mb-3">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="filter_tanggal">Filter Tanggal Kunjungan</label>
                    <input type="date" class="form-control" id="filter_tanggal" name="filter_tanggal">
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <label for="filter_poli">Filter Poli</label>
                    <select class="form-control" id="filter_poli" name="filter_poli">
                        <option value="">Semua</option>
                        <option value="Umum">Umum</option>
                        <option value="Gigi">Gigi</option>
                        <option value="KIA">KIA</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <button class="btn btn-primary mt-4" id="cari_pasien">Cari</button>
                    <button class="btn btn-secondary mt-4" id="cetak_laporan">Cetak</button>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No. RM</th>
                        <th>Nama Pasien</th>
                        <th>NIK</th>
                        <th>Alamat</th>
                        <th>Jenis Kelamin</th>
                        <th>Tanggal Lahir</th>
                        <th>Jenis Pasien</th>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<script>
    const data = [
        { no_rm: '1500', nama: 'Kiara Azzahra', nik: '3509218846903710', alamat: 'Kaliwates', jk: 'Perempuan', tgl_lahir: '22/05/2002', jenis_pasien: 'Umum' },
        { no_rm: '1508', nama: 'Dina Oktaviani', nik: '3509012214317810', alamat: 'Kebonsari', jk: 'Perempuan', tgl_lahir: '16/05/2002', jenis_pasien: 'BPJS' },
        { no_rm: '1502', nama: 'Matt Dickerson', nik: '3509218541903712', alamat: 'Patrang', jk: 'Laki - Laki', tgl_lahir: '19/09/1995', jenis_pasien: 'BPJS' },
        { no_rm: '1501', nama: 'Shanice', nik: '350921884706600', alamat: 'Kaliwates', jk: 'Laki - Laki', tgl_lahir: '14/02/1999', jenis_pasien: 'BPJS' },
        { no_rm: '1505', nama: 'Brad Masson', nik: '3509217669037331', alamat: 'Jember Kidul', jk: 'Laki - Laki', tgl_lahir: '31/12/1972', jenis_pasien: 'BPJS' },
        { no_rm: '1506', nama: 'Zahra Putri Wulandari', nik: '3509217046812732', alamat: 'Tegal Besar', jk: 'Perempuan', tgl_lahir: '28/07/2004', jenis_pasien: 'BPJS' },
        { no_rm: '1504', nama: 'Eko Purnomo', nik: '3509218046903710', alamat: 'Kepatihan', jk: 'Laki - Laki', tgl_lahir: '03/01/1968', jenis_pasien: 'Umum' },
        { no_rm: '1507', nama: 'Aditya Ashanka', nik: '3509118846903713', alamat: 'Sempusari', jk: 'Laki - Laki', tgl_lahir: '10/10/1990', jenis_pasien: 'BPJS' },
        { no_rm: '1503', nama: 'Aisyah Putri Wulandari', nik: '3509116646503700', alamat: 'Kebon Agung', jk: 'Perempuan', tgl_lahir: '11/08/2001', jenis_pasien: 'BPJS' },
        { no_rm: '1509', nama: 'Sutomo', nik: '3509113246502100', alamat: 'Karangrejo', jk: 'Laki - Laki', tgl_lahir: '09/01/1978', jenis_pasien: 'BPJS' },
        { no_rm: '1510', nama: 'Ani Sulistyawati', nik: '3509013104206210', alamat: 'Sumbersari', jk: 'Perempuan', tgl_lahir: '21/11/1969', jenis_pasien: 'BPJS' },
        { no_rm: '1511', nama: 'Heny Purwanti', nik: '3509313200552110', alamat: 'Kepatihan', jk: 'Perempuan', tgl_lahir: '18/03/1970', jenis_pasien: 'Umum' }
    ];

    function renderTable(data) {
        const tableBody = document.getElementById('tableBody');
        tableBody.innerHTML = '';
        data.forEach(row => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>${row.no_rm}</td>
                <td>${row.nama}</td>
                <td>${row.nik}</td>
                <td>${row.alamat}</td>
                <td>${row.jk}</td>
                <td>${row.tgl_lahir}</td>
                <td>${row.jenis_pasien}</td>
            `;
            tableBody.appendChild(tr);
        });
    }

    function filterData() {
        const filterDate = document.getElementById('filter_tanggal').value;
        const filterPoli = document.getElementById('filter_poli').value.toLowerCase();

        const filteredData = data.filter(row => {
            const matchDate = !filterDate || row.tgl_lahir.split('-').reverse().join('-') === filterDate;
            const matchPoli = !filterPoli || row.jenis_pasien.toLowerCase() === filterPoli;
            return matchDate && matchPoli;
        });

        renderTable(filteredData);
        updateEntriesInfo(filteredData.length);
    }

    function updateEntriesInfo(count) {
        const entriesInfo = document.getElementById('entries-info');
        entriesInfo.textContent = `Showing 1 to ${count} of ${count} entries`;
    }

    function cetakPDF() {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        let y = 10;
        doc.setFontSize(12);
        doc.text('Laporan Kunjungan', 10, y);
        y += 10;

        const tableColumn = ["No. RM", "Nama Pasien", "NIK", "Alamat", "Jenis Kelamin", "Tanggal Lahir", "Jenis Pasien"];
        const tableRows = [];

        data.forEach(row => {
            const rowData = [
                row.no_rm,
                row.nama,
                row.nik,
                row.alamat,
                row.jk,
                row.tgl_lahir,
                row.jenis_pasien
            ];
            tableRows.push(rowData);
        });

        doc.autoTable(tableColumn, tableRows, { startY: y });

        doc.save('laporan_kunjungan.pdf');
    }

    document.getElementById('cari_pasien').addEventListener('click', filterData);
    document.getElementById('cetak_laporan').addEventListener('click', cetakPDF);

    
    renderTable(data);
    updateEntriesInfo(data.length);
</script>
@endsection
