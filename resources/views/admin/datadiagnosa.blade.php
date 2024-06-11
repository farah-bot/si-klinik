@extends('layouts.app')

@section('title', 'Data Diagnosis')

@section('content')
<div class="data-pengguna-container">
    <div class="container">
        <div class="data-pengguna-header">
            <h2>DATA DIAGNOSIS</h2>
        </div>
        <div class="row mb-3">
            <div class="col-lg-12">
                <form id="addDiagnosisForm">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kodeICD">Kode ICD X</label>
                                <input type="text" class="form-control" id="kodeICD" name="kodeICD">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="diagnosis">Diagnosis</label>
                                <input type="text" class="form-control" id="diagnosis" name="diagnosis">
                            </div>
                        </div>
                    </div>
                    <div class="float-right">
                        <button type="button" class="btn btn-tambah" onclick="addDiagnosis()">Tambah</button> 
                        <button type="reset" class="btn btn-batal">Batal</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="d-flex mb-3">
            <span class="align-self-center">Show</span>
            <select class="custom-select custom-select-sm form-control form-control-sm mr-2" id="entries" onchange="updateEntries()">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
            </select>
            <span class="align-self-center mr-2">entries</span>
            <input type="text" class="form-control form-control-sm ml-2 float-right" placeholder="Cari Data Diagnosis" id="search" onkeyup="searchDiagnosis()">
        </div>

        <div class="row">
            <div class="col">
                <table class="table table-bordered mt-3">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode ICD X</th>
                            <th>Diagnosis</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="diagnosisTable">
                        
                        <tr>
                            <td>1</td>
                            <td>ICD001</td>
                            <td>Diagnosis 1</td>
                            <td>
                                <button class="btn btn-warning btn-sm" onclick="editDiagnosis(this)">Edit</button>
                                <button class="btn btn-danger btn-sm" onclick="deleteRow(this)">Hapus</button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>ICD002</td>
                            <td>Diagnosis 2</td>
                            <td>
                                <button class="btn btn-warning btn-sm" onclick="editDiagnosis(this)">Edit</button>
                                <button class="btn btn-danger btn-sm" onclick="deleteRow(this)">Hapus</button>
                            </td>
                        </tr>
                    
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    function addDiagnosis() {
        const kodeICD = document.getElementById('kodeICD').value;
        const diagnosis = document.getElementById('diagnosis').value;
        const table = document.getElementById('diagnosisTable');
        const rowCount = table.rows.length;
        const row = table.insertRow(rowCount);
        row.insertCell(0).innerHTML = rowCount + 1;
        row.insertCell(1).innerHTML = kodeICD;
        row.insertCell(2).innerHTML = diagnosis;
        row.insertCell(3).innerHTML = '<button class="btn btn-warning btn-sm" onclick="editDiagnosis(this)">Edit</button><button class="btn btn-danger btn-sm" onclick="deleteRow(this)">Hapus</button>';
        document.getElementById('addDiagnosisForm').reset();
    }

    function deleteRow(button) {
        const row = button.parentNode.parentNode;
        row.parentNode.removeChild(row);
        updateRowNumbers();
    }

    function updateRowNumbers() {
        const table = document.getElementById('diagnosisTable');
        for (let i = 0; i < table.rows.length; i++) {
            table.rows[i].cells[0].innerHTML = i + 1;
        }
    }

    function searchDiagnosis() {
        const searchInput = document.getElementById('search').value.toLowerCase();
        const table = document.getElementById('diagnosisTable');
        const rows = table.getElementsByTagName('tr');

        for (let i = 0; i < rows.length; i++) {
            const cells = rows[i].getElementsByTagName('td');
            let match = false;
            for (let j = 0; j < cells.length - 1; j++) {  
                if (cells[j]) {
                    const cellContent = cells[j].textContent || cells[j].innerText;
                    if (cellContent.toLowerCase().indexOf(searchInput) > -1) {
                        match = true;
                        break;
                    }
                }
            }
            rows[i].style.display = match ? '' : 'none';
        }
    }

    function updateEntries() {
        const entries = document.getElementById('entries').value;
      
    }

    function editDiagnosis(button) {
        
    }
</script>
@endsection
