<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Login</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

</head>

<body>
    @if (Session::has('message'))
    <div class="alert alert-primary alert-dismissible fade show position-absolute m-3">
        <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
        </button>
        {{ session('message') }}
    </div>
    @endif
    @if($errors->any())
    <div class="alert alert-primary alert-dismissible fade show position-absolute m-3">
        <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
        </button>
        {!! implode('', $errors->all('<div>:message</div>')) !!}
    </div>
    @endif
    <h4 class="m-3" style="width: 300px">SISTEM REKOMENDASI LOKASI TERBAIK UNTUK MENDIRIKAN CABANG RUMAH MAKAN</h4>
    <div class="authincation h-100">
        <div class="container-fluid h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-3">
                    <div class="text-center">
                        <p>Halo, Selamat Datang</p>
                        <h4>Temukan Lokasi Cabang Terbaik</h4>
                    </div>
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <h4 class="text-center mb-4">Login</h4>
                                    <form action="{{ route('login.process') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label><strong>Email</strong></label>
                                            <input type="email" name="email" class="form-control" placeholder="hello@example.com">
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Password</strong></label>
                                            <input type="password" name="password" class="form-control" placeholder="Password">
                                        </div>
                                        <div class="form-row d-flex justify-content-between align-items-center mt-4 mb-2">
                                            <div class="form-group">
                                                <div class="form-check ml-2">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="basic_checkbox_1">
                                                    <label class="form-check-label" for="basic_checkbox_1">Remember
                                                        me</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <a href="#">Lupa Password</a>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="authincation h-100">
        <div class="container-fluid h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-sm-4">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="auth-form">
                                <h4 class="text-center mb-4">Login</h4>
                                <form action="{{ route('login.process') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label><strong>Email</strong></label>
                                        <input type="email" name="email" class="form-control" placeholder="hello@example.com">
                                    </div>
                                    <div class="form-group">
                                        <label><strong>Password</strong></label>
                                        <input type="password" name="password" class="form-control" placeholder="Password">
                                    </div>
                                    <div class="form-row d-flex justify-content-between align-items-center mt-4 mb-2">
                                        <div class="form-group">
                                            <div class="form-check ml-2">
                                                <input class="form-check-input" type="checkbox"
                                                    id="basic_checkbox_1">
                                                <label class="form-check-label" for="basic_checkbox_1">Remember
                                                    me</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <a href="#">Lupa Password</a>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{ asset('vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('js/quixnav-init.js') }}"></script>
    <script src="{{ asset('js/custom.min.js') }}"></script>

</body>

</html>
