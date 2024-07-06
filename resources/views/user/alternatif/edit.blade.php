@extends('layouts.dashboard')

@section('content')
    <div class="container-fluid">
        <div class="row page-titles mx-0" style="background: transparent">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Lokasi</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Lokasi</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Tambah</a></li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Lokasi</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form action="{{ route('user.alternatif.update') }}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $alternatif->id }}">
                                <div class="form-row">
                                    <div class="form-group col">
                                        <label>Kode</label>
                                        <input name="code" type="text" class="form-control"
                                            value="{{ $alternatif->code }}" readonly>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col">
                                        <label>Alternatif</label>
                                        <input name="alternatif" type="text" class="form-control"
                                            value="{{ $alternatif->alternatif }}">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
