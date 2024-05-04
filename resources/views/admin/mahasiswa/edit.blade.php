@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Mahasiswa</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Mahasiswa</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Edit</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Mahasiswa</h4>
                    @session('success')
                        <span class="alert alert-success">Data mahasiswa berhasil ditambah</span>
                    @endsession

                    @session('error')
                        <span class="alert alert-danger">Oops, Something was wrong!</span>
                    @endsession
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{ route('admin.mahasiswa.update') }}" method="post">
                            @csrf
                            <div class="form-row">
                                <input type="hidden" name="id" value="{{ $student->id }}">
                                <input type="hidden" name="role_id" value="1">
                                <div class="form-group col-md-6">
                                    <label>Nama</label>
                                    <input name="name" value="{{ $student->name }}" type="text" class="form-control" placeholder="Siti Khasanah">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Nim</label>
                                    <input name="nim" value="{{ $student->nim }}" type="text" class="form-control" placeholder="2023445888">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Prodi</label>
                                    <input name="study_program" value="{{ $student->study_program }}" type="text" class="form-control" placeholder="Informatika">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Jurusan</label>
                                    <input name="major" value="{{ $student->major }}" type="text" class="form-control" placeholder="Fakultas Teknik">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Kelas</label>
                                    <input name="class" value="{{ $student->class }}" type="text" class="form-control" placeholder="Informatika">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>email</label>
                                    <input name="email" value="{{ $student->email }}" type="text" class="form-control" placeholder="email">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Phone</label>
                                    <input name="phone" value="{{ $student->phone }}" type="text" class="form-control" placeholder="Informatika">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>jenis kelamin</label>
                                    <select name="gender" class="form-control">
                                        <option value="">Choose your gender</option>
                                        <option value="Laki-laki" {{ $student->gender == 'Laki-laki' ? 'selected' : '' }}>Laki Laki</option>
                                        <option value="Perempuan" {{ $student->gender == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-12">
                                    <label>password</label>
                                    <input name="password" type="password" disabled class="form-control" placeholder="*******">
                                </div>                            </div>
                            <button type="submit" class="btn btn-primary">Edit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection