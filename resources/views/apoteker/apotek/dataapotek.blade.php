<!-- Hak Akses Apoteker -->

@extends('layouts.app')

@section('title', 'Data Antrian Apotek')

@section('content')
    <div class="data-pengguna-container">
        <div class="container">
            <div class="data-pengguna-header">
                <h2>Data Antrian Apotek</h2>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="search_pasien">Cari Data Pasien</label>
                        <input type="text" class="form-control" id="search_pasien" name="search_pasien"
                            placeholder="Masukkan nama atau No. RM">
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

            <div class="row mt-3">
                <div class="col-md-12">
                    {{ $kunjungans->links('vendor.pagination.bootstrap-5') }}
                </div>
            </div>

        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">Detail Pasien</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>Nomor Antrian:</strong> <span id="modalNomorAntrian"></span></p>
                    <p><strong>Tanggal Periksa:</strong> <span id="modalTanggalPeriksa"></span></p>
                    <p><strong>Nama Pasien:</strong> <span id="modalNamaPasien"></span></p>
                    <p><strong>No. RM:</strong> <span id="modalNoRM"></span></p>
                    <p><strong>Jenis Kelamin:</strong> <span id="modalJK"></span></p>
                    <p><strong>Jenis Kunjungan:</strong> <span id="modalJenisKunjungan"></span></p>
                    <p><strong>Poli Tujuan:</strong> <span id="modalPoliTujuan"></span></p>
                    <p><strong>Status:</strong> <span id="modalStatus"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const data = [
            @foreach ($kunjungans as $kunjungan)
                {
                    id : '{{ $kunjungan->id }}',
                    nomor: '{{ $kunjungan->nomor_antrian }}',
                    tanggal_periksa: '{{ $kunjungan->tanggal_kunjungan }}',
                    nama: '{{ $kunjungan->pasien->nama }}',
                    no_rm: '{{ $kunjungan->pasien->no_rm }}',
                    jk: '{{ $kunjungan->pasien->jenis_kelamin }}',
                    jenis_kunjungan: '{{ $kunjungan->jenis_kunjungan }}',
                    poli: '{{ $kunjungan->poli_tujuan }}',
                    status: '{{ $kunjungan->status_antrian }}'
                },
            @endforeach
        ];

        let currentPage = 1;
        const entriesPerPage = 2;

        function renderTable(data) {
            const tableBody = document.getElementById('tableBody');
            tableBody.innerHTML = '';
            data.forEach(row => {
                const tr = document.createElement('tr');
                let statusClass = '';
                if (row.status === 'Sudah Terlayani') {
                    statusClass = 'bg-success text-white';
                } else {
                    statusClass = 'bg-secondary text-white';
                }
                tr.innerHTML = `
                <td>${row.nomor}</td>
                <td>${row.tanggal_periksa}</td>
                <td>${row.nama}</td>
                <td>${row.no_rm}</td>
                <td>${row.jk}</td>
                <td>${row.jenis_kunjungan}</td>
                <td>${row.poli}</td>
                <td class="${statusClass}">${row.status}</td>                
                <td>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-info btn-sm" onclick="viewPatient('${row.id}','${row.poli}')"><i class="fas fa-eye"></i></button>
                    </div>
                </td>
            `;
                tableBody.appendChild(tr);
            });
        }

        function updateEntriesInfo(count) {
            const entriesInfo = document.getElementById('entries-info');
            entriesInfo.textContent =
                `Showing ${Math.min((currentPage - 1) * entriesPerPage + 1, count)} to ${Math.min(currentPage * entriesPerPage, count)} of ${count} entries`;
        }

        function filterData() {
            const searchValue = document.getElementById('search_pasien').value.toLowerCase();

            const filteredData = data.filter(row => {
                return row.nama.toLowerCase().includes(searchValue) || row.no_rm.toLowerCase().includes(
                    searchValue);
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

        function viewPatient(id, poli) {
            let detailUrl = '';
            switch (poli) {
                case 'Poli Umum':
                    detailUrl = `/detailpoliumumapotek/${id}`;
                    break;
                case 'Poli Gigi':
                    detailUrl = `/detailpoligigiapotek/${id}`;
                    break;
                case 'Poli KIA':
                    detailUrl = `/detailpolikiaapotek/${id}`;
                    break;
                default:
                    detailUrl = `/detailpoliumumapotek/${id}`;
            }
            window.location.href = detailUrl;
        }


        function deletePatient(nomorAntrian) {
            if (confirm(`Apakah Anda yakin ingin menghapus pasien dengan nomor antrian ${nomorAntrian}?`)) {
                const index = data.findIndex(row => row.nomor === nomorAntrian);
                if (index !== -1) {
                    data.splice(index, 1);
                    filterData();
                    updatePaginationButtons();
                    updateEntriesInfo(data.length);
                }
            }
        }

        document.getElementById('search_pasien').addEventListener('input', filterData);
        // document.getElementById('prevPage').addEventListener('click', () => paginate('prev'));
        // document.getElementById('nextPage').addEventListener('click', () => paginate('next'));

        window.onload = function() {
            filterData();
            updatePaginationButtons();
            updateEntriesInfo(data.length);
        }
    </script>
@endsection
