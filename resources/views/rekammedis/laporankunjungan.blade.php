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
            @foreach ($dataPasien as $pasien)
                {
                    no_rm: '{{ $pasien->no_rm }}',
                    nama: '{{ $pasien->nama }}',
                    nik: '{{ $pasien->nik }}',
                    alamat: '{{ $pasien->alamat }}',
                    jk: '{{ $pasien->jenis_kelamin }}',
                    tgl_lahir: '{{ $pasien->tanggal_lahir }}',
                    jenis_pasien: '{{ $pasien->jenis_pasien }}',
                },
            @endforeach

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
            const {
                jsPDF
            } = window.jspdf;
            const doc = new jsPDF();

            let y = 10;
            doc.setFontSize(12);
            doc.text('Laporan Kunjungan', 10, y);
            y += 10;

            const tableColumn = ["No. RM", "Nama Pasien", "NIK", "Alamat", "Jenis Kelamin", "Tanggal Lahir",
            "Jenis Pasien"];
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

            doc.autoTable(tableColumn, tableRows, {
                startY: y
            });

            doc.save('laporan_kunjungan.pdf');
        }

        document.getElementById('cari_pasien').addEventListener('click', filterData);
        document.getElementById('cetak_laporan').addEventListener('click', cetakPDF);


        renderTable(data);
        updateEntriesInfo(data.length);
    </script>
@endsection
