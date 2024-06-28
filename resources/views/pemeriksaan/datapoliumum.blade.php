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
                    <input type="text" id="filterNomorAntrian" class="form-control" placeholder="Nomor Antrian" onkeydown="filterData(event)">
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

<!-- Modal Panggil Antrian -->
<div class="modal fade" id="panggilAntrianModal" tabindex="-1" aria-labelledby="panggilAntrianModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="panggilAntrianModalLabel">Panggil Antrian</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <i class="fas fa-bullhorn fa-3x"></i>
                <p>Nomor Antrian: <span id="nomorAntrianPanggil"></span></p>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-success ms-2" onclick="panggilLagi()">Panggil Antrian</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Skip</button>
            </div>
        </div>
    </div>
</div>

<script>
    const dataAntrian = [
        {
            nomorAntrian: '004',
            tanggalPeriksa: '15/01/2023',
            namaPasien: 'Kiara Azzahra',
            noRM: '1500',
            jenisKelamin: 'Perempuan',
            jenisKunjungan: 'Baru',
            poli: 'Poli Umum',
            status: 'Belum Terlayani'
        },
        {
            nomorAntrian: '003',
            tanggalPeriksa: '15/01/2023',
            namaPasien: 'Ani Sulistyawati',
            noRM: '1600',
            jenisKelamin: 'Perempuan',
            jenisKunjungan: 'Lama',
            poli: 'Poli Umum',
            status: 'Belum Terlayani'
        },
        {
            nomorAntrian: '002',
            tanggalPeriksa: '15/01/2023',
            namaPasien: 'Matt Dickerson',
            noRM: '1502',
            jenisKelamin: 'Laki-laki',
            jenisKunjungan: 'Lama',
            poli: 'Poli Umum',
            status: 'Proses Pelayanan'
        },
        {
            nomorAntrian: '001',
            tanggalPeriksa: '15/01/2023',
            namaPasien: 'Aisyah Putri Wulandari',
            noRM: '1503',
            jenisKelamin: 'Perempuan',
            jenisKunjungan: 'Baru',
            poli: 'Poli Umum',
            status: 'Sudah Terlayani'
        }
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
                <tr>
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
                            <button class="btn btn-success btn-sm" onclick="openPanggilModal('${item.nomorAntrian}')"><i class="fas fa-volume-up"></i></button>
                            <button class="btn btn-primary btn-sm mx-1" onclick="editData('${item.nomorAntrian}')"><i class="fas fa-edit"></i></button>
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

    function playAudioAntrian(nomorAntrian) {
        const audioPath = '/audio/';
        const audioQueue = ['nomor-urut.wav'];
        const digits = nomorAntrian.split('').map(digit => `${digit}.wav`);

        if (nomorAntrian === '10') {
            audioQueue.push('sepuluh.wav');
        } else if (nomorAntrian === '11') {
            audioQueue.push('sebelas.wav');
        } else if (nomorAntrian > 11 && nomorAntrian < 20) {
            audioQueue.push(`${nomorAntrian[1]}.wav`, 'belas.wav');
        } else if (nomorAntrian >= 20 && nomorAntrian < 100) {
            audioQueue.push(`${nomorAntrian[0]}.wav`, 'puluh.wav');
            if (nomorAntrian[1] !== '0') {
                audioQueue.push(`${nomorAntrian[1]}.wav`);
            }
        } else if (nomorAntrian >= 100 && nomorAntrian < 200) {
            audioQueue.push('seratus.wav');
            if (nomorAntrian[1] !== '0') {
                if (nomorAntrian[1] === '1' && nomorAntrian[2] === '0') {
                    audioQueue.push('sepuluh.wav');
                } else if (nomorAntrian[1] === '1' && nomorAntrian[2] === '1') {
                    audioQueue.push('sebelas.wav');
                } else if (nomorAntrian[1] === '1') {
                    audioQueue.push(`${nomorAntrian[2]}.wav`, 'belas.wav');
                } else {
                    audioQueue.push(`${nomorAntrian[1]}.wav`, 'puluh.wav');
                    if (nomorAntrian[2] !== '0') {
                        audioQueue.push(`${nomorAntrian[2]}.wav`);
                    }
                }
            } else if (nomorAntrian[2] !== '0') {
                audioQueue.push(`${nomorAntrian[2]}.wav`);
            }
        } else if (nomorAntrian >= 200 && nomorAntrian < 1000) {
            audioQueue.push(`${nomorAntrian[0]}.wav`, 'ratus.wav');
            if (nomorAntrian[1] !== '0') {
                if (nomorAntrian[1] === '1' && nomorAntrian[2] === '0') {
                    audioQueue.push('sepuluh.wav');
                } else if (nomorAntrian[1] === '1' && nomorAntrian[2] === '1') {
                    audioQueue.push('sebelas.wav');
                } else if (nomorAntrian[1] === '1') {
                    audioQueue.push(`${nomorAntrian[2]}.wav`, 'belas.wav');
                } else {
                    audioQueue.push(`${nomorAntrian[1]}.wav`, 'puluh.wav');
                    if (nomorAntrian[2] !== '0') {
                        audioQueue.push(`${nomorAntrian[2]}.wav`);
                    }
                }
            } else if (nomorAntrian[2] !== '0') {
                audioQueue.push(`${nomorAntrian[2]}.wav`);
            }
        } else {
            audioQueue.push(...digits);
        }

        console.log('Audio Queue:', audioQueue);

        let delay = 0;
        audioQueue.forEach(file => {
            setTimeout(() => {
                const audio = new Audio(audioPath + file);
                audio.play().catch(error => console.error('Audio play error:', error));
            }, delay);
            delay += 500;  
        });
    }

    window.onload = function() {
        loadDataIntoTable(dataAntrian); 
    };
</script>

@endsection