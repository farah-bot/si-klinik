@extends('layouts.app')

@section('title', 'Data Antrian Pasien Poli Gigi')

@section('content')
    <div class="data-pengguna-container">
        <div class="container">
            <div class="data-pengguna-header">
                <h2>Data Antrian Pasien Poli</h2>
            </div>

            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="filterNomorAntrian">Cari Nomor Antrian</label>
                    <div class="input-group">
                        <input type="text" id="filterNomorAntrian" class="form-control" placeholder="Nomor Antrian"
                            onkeydown="filterData(event)">
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered" id="antrianTable">
                    <thead>
                        <tr>
                            <th>No. Antrian</th>
                            <th>No. RM</th>
                            <th>Nama Pasien</th>
                            <th>Tanggal Periksa</th>
                            <th>Jenis Kelamin</th>
                            <th>Jenis Kunjungan</th>
                            <th>Jenis Pasien</th>
                            <th>Poli</th>
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
                    {{ $kunjungans->links('vendor.pagination.bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>

    <script>
        const dataAntrian = [
            @foreach ($kunjungans as $kunjungan)
                {
                    nomorAntrian: '{{ $kunjungan->nomor_antrian }}',
                    noRM: '{{ $kunjungan->pasien->no_rm }}',
                    namaPasien: '{{ $kunjungan->pasien->nama }}',
                    tanggalPeriksa: '{{ $kunjungan->tanggal_kunjungan }}',
                    jenisKelamin: '{{ $kunjungan->pasien->jenis_kelamin }}',
                    jenisKunjungan: '{{ $kunjungan->jenis_kunjungan }}',
                    jenisPasien: '{{ $kunjungan->pasien->jenis_pasien }}',
                    poli: '{{ $kunjungan->poli_tujuan }}',
                },
            @endforeach
        ];

        function loadDataIntoTable(data) {
            const tableBody = document.getElementById('tableBody');
            let tableHTML = '';

            data.forEach(item => {
                tableHTML += `
                <tr>
                    <td>${item.nomorAntrian}</td>
                    <td>${item.noRM}</td>
                    <td>${item.namaPasien}</td>
                    <td>${item.tanggalPeriksa}</td>
                    <td>${item.jenisKelamin}</td>
                    <td>${item.jenisKunjungan}</td>
                    <td>${item.jenisPasien}</td>
                    <td>${item.poli}</td>
                </tr>
            `;
            });

            tableBody.innerHTML = tableHTML;
        }

        function filterData(event) {
            const filterNomorAntrian = document.getElementById('filterNomorAntrian').value.toLowerCase();
            const tableRows = document.getElementById('tableBody').getElementsByTagName('tr');
            let found = false;

            for (let i = 0; i < tableRows.length; i++) {
                const nomorAntrian = tableRows[i].getElementsByTagName('td')[0];
                if (nomorAntrian) {
                    const textValue = nomorAntrian.textContent || nomorAntrian.innerText;
                    if (textValue.toLowerCase().indexOf(filterNomorAntrian) > -1) {
                        tableRows[i].style.display = '';
                        found = true;
                    } else {
                        tableRows[i].style.display = 'none';
                    }
                }
            }

            const noDataFound = document.getElementById('noDataFound');
            if (found) {
                noDataFound.style.display = 'none';
            } else {
                noDataFound.style.display = 'block';
            }
        }

        function openPanggilModal(nomorAntrian) {
            document.getElementById('nomorAntrianPanggil').textContent = nomorAntrian;
            const panggilAntrianModal = new bootstrap.Modal(document.getElementById('panggilAntrianModal'), {
                keyboard: false
            });
            panggilAntrianModal.show();
            playAudioAntrian(nomorAntrian);
        }

        function panggilLagi() {
            const nomorAntrian = document.getElementById('nomorAntrianPanggil').textContent;
            playAudioAntrian(nomorAntrian);
        }

        function editData(nomorAntrian) {
            console.log(`Mengedit data untuk nomor antrian ${nomorAntrian}`);
        }

        function deleteData(nomorAntrian) {
            console.log(`Menghapus data untuk nomor antrian ${nomorAntrian}`);
        }

        window.onload = function() {
            loadDataIntoTable(dataAntrian);
        };
    </script>

@endsection
