@extends('layouts.dashboard')

@section('content')
    <div class="container-fluid">
        <div class="row page-titles mx-0" style="background: transparent">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Alternatif</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Alternatif</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Tambah</a></li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tambah Alternatif</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form action="{{ route('admin.alternatif.store') }}" method="post">
                                @csrf
                                {{-- <div class="form-row">
                                    <div class="form-group col">
                                        <label>Kode</label>
                                        <input name="code" type="text" class="form-control"
                                        placeholder="Kode alternatif">
                                    </div>
                                </div> --}}
                                <div class="form-row">
                                    <div class="form-group col">
                                        <label>Alternatif</label>
                                        <input name="alternatif" type="text" class="form-control"
                                        placeholder="Alternatif">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
