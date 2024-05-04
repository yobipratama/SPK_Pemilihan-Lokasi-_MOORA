@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Kriteria</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Kriteria</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Tambah</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Tambah Kriteria</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{ route('admin.kriteria.store') }}" method="post">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col">
                                    <label>Code</label>
                                    <input name="code" type="text" class="form-control"
                                        placeholder="example: C1">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col">
                                    <label>Kriteria</label>
                                    <input name="name" type="text" class="form-control"
                                        placeholder="kriteria">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col">
                                    <label>Bobot</label>
                                    <input name="value" type="number" class="form-control"
                                        placeholder="1" min="1">
                                </div>
                            </div>
                            <div class="">
                                <label>Jenis</label>
                                <div class="form-group col p-0">
                                    <label class="radio-inline">
                                        <input type="radio" name="type" value="Benefit"> Benefit</label>
                                    <label class="radio-inline">
                                        <input type="radio" name="type" value="Cost"> Cost</label>
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