@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-md-6 col-lg-4 mb-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Poli Umum</h5>
                <p class="card-text">Jumlah: {{ $poliUmumCount }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4 mb-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Poli Gigi</h5>
                <p class="card-text">Jumlah: {{ $poliGigiCount }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4 mb-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Poli KIA</h5>
                <p class="card-text">Jumlah: {{ $poliKIACount }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4 mb-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Kunjungan Umum</h5>
                <p class="card-text">Jumlah: {{ $kunjunganUmumCount }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4 mb-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Kunjungan BPJS</h5>
                <p class="card-text">Jumlah: {{ $kunjunganBPJSCount }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
