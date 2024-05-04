@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row page-titles mx-0" style="background: transparent">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Dashboard</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Dashboard</a></li>
            </ol>
        </div>
    </div>
    <div class="row page-titles mx-0" style="background: transparent">
        <div class="col-sm-12 p-md-0">
            <div class="welcome-text">
                <h4 class="text-center">Temukan Lokasi Cabang Terbaik</h4>
                <p class="mb-0">Selamat Datang, Admin</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 col-sm-6">
            <div class="card">
                <a href="{{ route('admin.alternatif.index') }}" class="stat-widget-two card-body rounded bg-primary">
                    <div class="stat-content">
                        <div class="stat-digit text-white">{{ $alternatif }}</div>
                        <div class="stat-text text-white">Lokasi</div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="card">
                <a href="{{ route('admin.kriteria.index') }}" class="stat-widget-two card-body rounded bg-danger">
                    <div class="stat-content">
                        <div class="stat-digit text-white">{{ $kriteria }}</div>
                        <div class="stat-text text-white">Kriteria</div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="card">
                <a href="{{ route('admin.penilaian.history') }}" class="stat-widget-two card-body rounded bg-success">
                    <div class="stat-content">
                        <div class="stat-digit text-white">{{ $penilaian }}</div>
                        <div class="stat-text text-white">Penilaian</div>
                    </div>
                </a>
            </div>
        </div>
        <!-- /# column -->
    </div>
</div>
@endsection