@extends('layouts.dashboard')
@section('content')
    <div class="card mx-4">
        <div class="card-header">
            <h4 class="card-title">Edit Profile</h4>
            <button type="button" onclick="updateProfileAdmin()" class="btn btn-outline-primary">Simpan</button>
        </div>
        <div class="card-body">
            <div class="basic-form">
                <form id="form-edit-profile-admin" action="{{ route('admin.profile.update') }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label text-dark">Nama</label>
                        <div class="col-sm-10">
                            <input name="name" type="text" class="form-control" value="{{ $user->name }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label text-dark">Alamat</label>
                        <div class="col-sm-10">
                            <input name="address" type="text" class="form-control" value="{{ $user->address }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label text-dark">Email</label>
                        <div class="col-sm-10">
                            <input name="email" type="email" class="form-control" value="{{ $user->email }}">
                        </div>
                    </div>
                    {{-- <div class="form-group row">
                        <label class="col-sm-2 col-form-label text-dark">HP</label>
                        <div class="col-sm-10">
                            <input name="phone" type="text" class="form-control" value="{{ $user->phone }}">
                        </div>
                    </div> --}}
                </form>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        function updateProfileAdmin() {
            const form = document.getElementById('form-edit-profile-admin');
            form.submit();
        }
    </script>
@endpush