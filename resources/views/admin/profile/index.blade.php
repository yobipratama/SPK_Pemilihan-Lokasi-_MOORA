@extends('layouts.dashboard')

@section('content')
    <div class="card mx-4">
        <div class="card-header">
            <h4 class="card-title">Data Profile</h4>
            <a href="{{ route('admin.profile.edit') }}" class="btn btn-outline-primary">Edit</a>
        </div>
        <div class="card-body">
            <div class="basic-form">
                <form>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label text-dark">Nama</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" value="{{ $user->name }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label text-dark">Alamat</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" value="{{ $user->address }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label text-dark">Email</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" value="{{ $user->email }}" readonly>
                        </div>
                    </div>
                    {{-- <div class="form-group row">
                        <label class="col-sm-3 col-form-label text-dark">HP</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" value="{{ $user->phone }}" readonly>
                        </div>
                    </div> --}}
                </form>
            </div>
        </div>
    </div>
@endsection
