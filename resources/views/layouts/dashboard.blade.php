
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>SPK Roc Moora</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/images/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/owl-carousel/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/owl-carousel/css/owl.theme.default.min.css') }}">
    <link href="{{ asset('/vendor/jqvmap/css/jqvmap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
    <!-- Datatable -->
    <link href="{{ asset('/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('/vendor/toastr/css/toastr.min.css')}}">
</head>

<body>
    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">
        @if($errors->any())
        <div class="alert alert-primary alert-dismissible fade show position-absolute m-3" style="z-index: 10; right: 10px; top: 10px;">
            <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
            </button>
            {!! implode('', $errors->all('<div>:message</div>')) !!}
        </div>
        @endif
        @include('partials.navbar')
        @include('partials.header')
        @include('partials.sidebar')
        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
            @yield('content')
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
        @include('partials.footer')
    </div>

    <!-- Required vendors -->
    <script src="{{ asset('/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('/js/quixnav-init.js') }}"></script>
    <script src="{{ asset('/js/custom.min.js') }}"></script>


    <!-- Vectormap -->
    <script src="{{ asset('/vendor/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('/vendor/morris/morris.min.js') }}"></script>


    <script src="{{ asset('/vendor/circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{ asset('/vendor/chart.js/Chart.bundle.min.js') }}"></script>

    <script src="{{ asset('/vendor/gaugeJS/dist/gauge.min.js') }}"></script>

    <!--  flot-chart js -->
    <script src="{{ asset('/vendor/flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('/vendor/flot/jquery.flot.resize.js') }}"></script>

    <!-- Owl Carousel -->
    <script src="{{ asset('/vendor/owl-carousel/js/owl.carousel.min.js') }}"></script>

    <!-- Counter Up -->
    <script src="{{ asset('/vendor/jqvmap/js/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('/vendor/jqvmap/js/jquery.vmap.usa.js') }}"></script>
    <script src="{{ asset('/vendor/jquery.counterup/jquery.counterup.min.js') }}"></script>


    <script src="{{ asset('/js/dashboard/dashboard-1.js') }}"></script>

       <!-- Datatable -->
    <script src="{{ asset('/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/js/plugins-init/datatables.init.js') }}"></script>

        <!-- Toastr -->
        <script src="{{ asset('/vendor/toastr/js/toastr.min.js') }}"></script>

        <!-- All init script -->
        <script src="{{ asset('/js/plugins-init/toastr-init.js') }}"></script>

    @stack('script')

    <script>
        var isMessage = {{ Session::has('error') ? 1 : 0 }};
        if(isMessage){
            toastr.error('{{ session('error') }}',{
                timeOut: 5000,
                "closeButton": true,
                "debug": false,
                "newestOnTop": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": true,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut",
                "tapToDismiss": false
            });
        }

        var isSuccess = {{ Session::has('success') ? 1 : 0 }};
        if(isSuccess){
            toastr.success('{{ session('success') }}',{
                timeOut: 5000,
                "closeButton": true,
                "debug": false,
                "newestOnTop": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": true,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut",
                "tapToDismiss": false
            });
        }
    </script>
</body>

</html>