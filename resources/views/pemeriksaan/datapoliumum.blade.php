@extends('layouts.app')

@section('title', 'Data Antrian Pasien Poli Umum')

@section('content')
    <div class="data-pengguna-container">
        <div class="container">
            <div class="data-pengguna-header">
                <h2>Data Antrian Pasien Poli Umum</h2>
            </div>

            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="filterNomorAntrian">Cari Nomor Antrian</label>
                    <div class="input-group">
                        <input type="text" id="filterNomorAntrian" class="form-control" placeholder="Nomor Antrian"
                            oninput="filterData(event)">
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered" id="antrianTable">
                    <thead>
                        <tr>
                            <th>Nomor Antrian</th>
                            <th>Tanggal Periksa</th>
                            <th>Nama Pasien</th>
                            <th>No. RM</th>
                            <th>Jenis Kelamin</th>
                            <th>Jenis Kunjungan</th>
                            <th>Poli</th>
                            <th>Status</th>
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

        </div>
    </div>


    <div class="modal fade" id="panggilAntrianModal" tabindex="-1" aria-labelledby="panggilAntrianModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="panggilAntrianModalLabel">Panggil Antrian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <i class="fas fa-bullhorn fa-3x"></i>
                    <p>Nomor Antrian: <span id="nomorAntrianPanggil"></span></p>
                    <input type="hidden" id="tanggalPeriksaPanggil">
                    <input type="hidden" id="pasienIdPanggil">
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn btn-success ms-2" onclick="updateStatus('Proses Pelayanan')"
                        data-bs-dismiss="modal">Selesai</button>
                    <button type="button" class="btn btn-secondary" onclick="skipAntrian()"
                        data-bs-dismiss="modal">Skip</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        const dataAntrian = [
            @foreach ($kunjungans as $kunjungan)
                {
                    id: '{{ $kunjungan->id }}',
                    pasien_id: '{{ $kunjungan->pasien_id }}',
                    nomorAntrian: '{{ $kunjungan->nomor_antrian }}',
                    tanggalPeriksa: '{{ $kunjungan->tanggal_kunjungan }}',
                    namaPasien: '{{ $kunjungan->pasien->nama }}',
                    noRM: '{{ $kunjungan->pasien->no_rm }}',
                    jenisKelamin: '{{ $kunjungan->pasien->jenis_kelamin }}',
                    jenisKunjungan: '{{ $kunjungan->jenis_kunjungan }}',
                    poli: '{{ $kunjungan->poli_tujuan }}',
                    status: '{{ $kunjungan->status }}'
                },
            @endforeach
        ];

        function loadDataIntoTable(data) {
            const tableBody = document.getElementById('tableBody');
            let tableHTML = '';

            data.forEach(item => {
                let statusClass = '';
                if (item.status === 'Sudah Terlayani') {
                    statusClass = 'bg-success text-white';
                } else if (item.status === 'Proses Pelayanan') {
                    statusClass = 'bg-primary text-white';
                } else {
                    statusClass = 'bg-secondary text-white';
                }
                tableHTML += `
                <tr data-id="${item.id}" data-nomor-antrian="${item.nomorAntrian}" data-tanggal-periksa="${item.tanggalPeriksa}" data-pasien-id="${item.pasien_id}">
                    <td>${item.nomorAntrian}</td>
                    <td>${item.tanggalPeriksa}</td>
                    <td>${item.namaPasien}</td>
                    <td>${item.noRM}</td>
                    <td>${item.jenisKelamin}</td>
                    <td>${item.jenisKunjungan}</td>
                    <td>${item.poli}</td>
                    <td class="${statusClass}">${item.status}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Aksi">
                            <button class="btn btn-success btn-sm" onclick="openPanggilModal('${item.nomorAntrian}', '${item.tanggalPeriksa}', '${item.pasien_id}')"><i class="fas fa-volume-up"></i></button>
                            <button class="btn btn-primary btn-sm mx-1" onclick="editData('${item.nomorAntrian}', '${item.tanggalPeriksa}', '${item.pasien_id}')"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-danger btn-sm" onclick="deleteData('${item.nomorAntrian}')"><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </td>
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

        function openPanggilModal(nomorAntrian, tanggalPeriksa, pasien_id) {
            document.getElementById('nomorAntrianPanggil').textContent = nomorAntrian;
            document.getElementById('tanggalPeriksaPanggil').textContent = tanggalPeriksa;
            document.getElementById('pasienIdPanggil').textContent = pasien_id;

            const panggilAntrianModal = new bootstrap.Modal(document.getElementById('panggilAntrianModal'), {
                keyboard: false
            });
            panggilAntrianModal.show();
            playAudioAntrian(nomorAntrian);
        }


        function editData(nomorAntrian, tanggalPeriksa, pasien_id) {
            const data = dataAntrian.find(item => item.nomorAntrian === nomorAntrian & item.tanggalPeriksa ===
                tanggalPeriksa & item.pasien_id === pasien_id);

            let editUrl;
            switch (data.poli) {
                case 'Poli Gigi':
                    editUrl = '/formpoligigi/' + nomorAntrian + '/' + tanggalPeriksa + '/' + pasien_id;
                    break;
                case 'Poli Umum':
                    editUrl = '/formpoliumum/' + nomorAntrian + '/' + tanggalPeriksa + '/' + pasien_id;
                    break;
                case 'Poli KIA':
                    editUrl = '/formpolikia/' + nomorAntrian + '/' + tanggalPeriksa + '/' + pasien_id;
                    break;
                default:
                    console.error('Poli tidak dikenali:', data.poli);
                    return;
            }

            window.location.href = editUrl;
        }

        function playAudioAntrian(nomorAntrian, poli) {
            const audioPath = '/audio/';
            const audioQueue = ['poliumum.wav', 'nomor-urut.wav'];
            const nomor = parseInt(nomorAntrian, 10);
            const digits = nomorAntrian.split('').map(digit => `${digit}.wav`);

            if (nomor === 10) {
                audioQueue.push('sepuluh.wav');
            } else if (nomor === 11) {
                audioQueue.push('sebelas.wav');
            } else if (nomor > 11 && nomor < 20) {
                audioQueue.push(`${nomorAntrian[1]}.wav`, 'belas.wav');
            } else if (nomor >= 20 && nomor < 100) {
                audioQueue.push(`${nomorAntrian[0]}.wav`, 'puluh.wav');
                if (nomorAntrian[1] !== '0') {
                    audioQueue.push(`${nomorAntrian[1]}.wav`);
                }
            } else if (nomor >= 100 && nomor < 200) {
                audioQueue.push('seratus.wav');
                if (nomorAntrian[1] !== '0' || nomorAntrian[2] !== '0') {
                    if (nomorAntrian[1] === '1' && nomorAntrian[2] === '0') {
                        audioQueue.push('sepuluh.wav');
                    } else if (nomorAntrian[1] === '1' && nomorAntrian[2] === '1') {
                        audioQueue.push('sebelas.wav');
                    } else if (nomorAntrian[1] === '1') {
                        audioQueue.push(`${nomorAntrian[2]}.wav`, 'belas.wav');
                    } else {
                        if (nomorAntrian[1] !== '0') {
                            audioQueue.push(`${nomorAntrian[1]}.wav`, 'puluh.wav');
                        }
                        if (nomorAntrian[2] !== '0') {
                            audioQueue.push(`${nomorAntrian[2]}.wav`);
                        }
                    }
                }
            } else if (nomor >= 200 && nomor < 1000) {
                audioQueue.push(`${nomorAntrian[0]}.wav`, 'ratus.wav');
                if (nomorAntrian[1] !== '0' || nomorAntrian[2] !== '0') {
                    if (nomorAntrian[1] === '1' && nomorAntrian[2] === '0') {
                        audioQueue.push('sepuluh.wav');
                    } else if (nomorAntrian[1] === '1' && nomorAntrian[2] === '1') {
                        audioQueue.push('sebelas.wav');
                    } else if (nomorAntrian[1] === '1') {
                        audioQueue.push(`${nomorAntrian[2]}.wav`, 'belas.wav');
                    } else {
                        if (nomorAntrian[1] !== '0') {
                            audioQueue.push(`${nomorAntrian[1]}.wav`, 'puluh.wav');
                        }
                        if (nomorAntrian[2] !== '0') {
                            audioQueue.push(`${nomorAntrian[2]}.wav`);
                        }
                    }
                }
            } else {
                audioQueue.push(...digits);
            }

            console.log('Audio Queue:', audioQueue);

            let delay = 500;
            const delayIncrement = 2000;

            audioQueue.forEach(file => {
                setTimeout(() => {
                    const audio = new Audio(audioPath + file);
                    audio.play().catch(error => console.error('Audio play error:', error));
                }, delay);
                delay += delayIncrement;
            });
        }

        window.onload = function() {
            loadDataIntoTable(dataAntrian);
        };

        function skipAntrian() {
            const nomorAntrian = document.getElementById('nomorAntrianPanggil').textContent;
            const pasien_id = document.getElementById('pasienIdPanggil').textContent;
            const tanggalPeriksa = document.getElementById('tanggalPeriksaPanggil')
                .textContent;
            const rows = document.querySelectorAll(
                `tr[data-nomor-antrian="${nomorAntrian}"][data-tanggal-periksa="${tanggalPeriksa}"][data-pasien-id="${pasien_id}"]`
                );
            if (rows.length > 0) {
                const row = rows[0];

                const statusCell = row.querySelector('td:nth-child(8)');
                const kunjunganId = row.getAttribute('data-id');

                fetch(`/skipstatusumum/${kunjunganId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            status: 'Belum Terlayani'
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            statusCell.textContent = 'Belum Terlayani';
                            statusCell.className = 'bg-secondary text-white';
                        } else {
                            alert('Gagal skip antrian');
                        }
                    });
            } else {
                alert('Data tidak ditemukan untuk nomor antrian ' + nomorAntrian + ' dan tanggal periksa ' +
                    tanggalPeriksa);
            }
        }

        function updateStatus(status) {
            const nomorAntrian = document.getElementById('nomorAntrianPanggil').textContent;
            const pasien_id = document.getElementById('pasienIdPanggil').textContent;
            const tanggalPeriksa = document.getElementById('tanggalPeriksaPanggil')
                .textContent;

            const rows = document.querySelectorAll(
                `tr[data-nomor-antrian="${nomorAntrian}"][data-tanggal-periksa="${tanggalPeriksa}"][data-pasien-id="${pasien_id}"]`
                );
            if (rows.length > 0) {
                const row = rows[0];

                const statusCell = row.querySelector('td:nth-child(8)');
                const kunjunganId = row.getAttribute('data-id');

                fetch(`/updatestatusumum/${kunjunganId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            status
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            statusCell.textContent = status;
                            switch (status) {
                                case 'Proses Pelayanan':
                                    statusCell.className = 'bg-primary text-white';
                                    break;
                                case 'Belum Terlayani':
                                    statusCell.className = 'bg-secondary text-white';
                                    break;
                                default:
                                    statusCell.className = '';
                            }
                        } else {
                            alert('Gagal memperbarui status');
                        }
                    });
            } else {
                alert('Data tidak ditemukan untuk nomor antrian ' + nomorAntrian + ' dan tanggal periksa ' +
                    tanggalPeriksa);
            }
        }

        function deleteData(nomorAntrian) {
            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                const rows = document.querySelectorAll(
                    `tr[data-nomor-antrian="${nomorAntrian}"][data-tanggal-periksa="${tanggalPeriksa}"][data-pasien-id="${pasien_id}"]`
                    );
                if (rows.length > 0) {
                    const row = rows[0];

                    const statusCell = row.querySelector('td:nth-child(8)');
                    const kunjunganId = row.getAttribute('data-id');

                    fetch(`/deletekunjunganumum/${kunjunganId}`, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                row.remove();
                                alert('Data dengan nomor antrian ' + nomorAntrian + ' telah dihapus.');
                            } else {
                                alert('Gagal menghapus data');
                            }
                        });
                } else {
                    alert('Data tidak ditemukan untuk nomor antrian ' + nomorAntrian + ' dan tanggal periksa ' +
                        tanggalPeriksa);
                }
            }
        }
    </script>

@endsection
