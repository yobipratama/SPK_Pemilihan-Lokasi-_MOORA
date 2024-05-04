@extends('layouts.dashboard')
@section('content')
    <div class="card mx-4">
        <div class="card-header">
            <h4 class="card-title">Edit Profile</h4>
            <button type="button" onclick="updatePasswordAdmin()" class="btn btn-outline-primary">Simpan</button>
        </div>
        <div class="card-body">
            <div class="basic-form">
                <form id="form-change-password-admin" action="{{ route('admin.change.password') }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label text-dark">Password Lama</label>
                        <div class="col-sm-10">
                            <input name="old_password" type="text" class="form-control" placeholder="Password lama">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label text-dark">Password Baru</label>
                        <div class="col-sm-10">
                            <input name="new_password" type="text" class="form-control" placeholder="Password baru">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label text-dark">Ulangi Password Baru</label>
                        <div class="col-sm-10">
                            <input name="confirm_password" type="text" class="form-control" placeholder="Ulangi password baru">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        function updatePasswordAdmin() {
            const form = document.getElementById('form-change-password-admin');
            form.submit();
        }
    </script>
@endpush