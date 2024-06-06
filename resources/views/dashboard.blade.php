@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="dashboard-container">
    <div class="container">
        <div class="dashboard-header">
            <h2>DASHBOARD</h2>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-4 mb-3">
                <div class="card text-center rounded">
                    <div class="card-body rounded-top">
                        <h5 class="card-title font-weight-bold">{{ $poliUmumCount }} <span class="text-normal">pasien</span></h5>
                    </div>
                    <div class="card-body rounded-bottom" style="background-color: #F3CA52;">
                        <p class="card-text font-weight-semibold">Poli Umum</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-3">
                <div class="card text-center rounded">
                    <div class="card-body rounded-top">
                        <h5 class="card-title font-weight-bold">{{ $poliGigiCount }} <span class="text-normal">pasien</span></h5>
                    </div>
                    <div class="card-body rounded-bottom" style="background-color: #76BCBA;">
                        <p class="card-text font-weight-semibold">Poli Gigi</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-3">
                <div class="card text-center rounded">
                    <div class="card-body rounded-top">
                        <h5 class="card-title font-weight-bold">{{ $poliKIACount }} <span class="text-normal">pasien</span></h5>
                    </div>
                    <div class="card-body rounded-bottom" style="background-color: #FF9389;">
                        <p class="card-text font-weight-semibold">Poli KIA</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-3">
                <div class="card text-center rounded">
                    <div class="card-body rounded-top">
                        <h5 class="card-title font-weight-bold">{{ $kunjunganUmumCount }} <span class="text-normal">pasien</span></h5>
                    </div>
                    <div class="card-body rounded-bottom" style="background-color: #CBDEF9;">
                        <p class="card-text font-weight-semibold">Kunjungan Umum</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-3">
                <div class="card text-center rounded">
                    <div class="card-body rounded-top">
                        <h5 class="card-title font-weight-bold">{{ $kunjunganBPJSCount }} <span class="text-normal">pasien</span></h5>
                    </div>
                    <div class="card-body rounded-bottom" style="background-color: #B4CDB8;">
                        <p class="card-text font-weight-semibold">Kunjungan BPJS</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
