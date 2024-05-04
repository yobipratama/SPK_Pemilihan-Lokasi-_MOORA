@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>kriteria</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Kriteria</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Edit</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">kriteria</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{ route('admin.kriteria.update') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $kriteria->id }}">
                            <div class="form-row">
                                <div class="form-group col">
                                    <label>Code</label>
                                    <input name="code" type="text" class="form-control"
                                        placeholder="code" value="{{ $kriteria->code }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col">
                                    <label>Kriteria</label>
                                    <input name="name" type="text" class="form-control"
                                        placeholder="kriteria" value="{{ $kriteria->name }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col">
                                    <label>Type</label>
                                    <input name="type" type="text" class="form-control"
                                        placeholder="type" value="{{ $kriteria->type }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col">
                                    <label>Bobot</label>
                                    <input name="value" type="number" class="form-control"
                                        placeholder="2" value="{{ $kriteria->value }}">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">edit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection