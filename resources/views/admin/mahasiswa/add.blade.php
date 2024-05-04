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
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Tambah</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Tambah Mahasiswa</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{ route('admin.mahasiswa.store') }}" method="post">
                            @csrf
                            <div class="form-row">
                                <input type="hidden" name="role_id" value="1">
                                <div class="form-group col-md-6">
                                    <label>Nama</label>
                                    <input name="name" type="text" class="form-control" placeholder="Siti Khasanah">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Nim</label>
                                    <input name="nim" type="text" class="form-control" placeholder="2023445888">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Prodi</label>
                                    <input name="study_program" type="text" class="form-control" placeholder="Informatika">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Jurusan</label>
                                    <input name="major" type="text" class="form-control" placeholder="Fakultas Teknik">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Kelas</label>
                                    <input name="class" type="text" class="form-control" placeholder="Informatika">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>email</label>
                                    <input name="email" type="text" class="form-control" placeholder="email">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Phone</label>
                                    <input name="phone" type="text" class="form-control" placeholder="Informatika">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>jenis kelamin</label>
                                    <select name="gender" class="form-control">
                                        <option value="">Choose your gender</option>
                                        <option value="Laki-laki">Laki Laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-12">
                                    <label>password</label>
                                    <input name="password" type="text" class="form-control" placeholder="Informatika">
                                </div>                            </div>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection