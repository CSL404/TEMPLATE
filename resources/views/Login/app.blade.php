<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <title>Nombre @yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="Nombre Proyecto" name="description" />
    <meta content="Consorcio Nova" name="author" />
     {{-- Logo de la pestaña --}}
    <link rel="icon" type="image/png" href="{{ asset('public/assets/img/favicon/favicon.png') }}" sizes="64x64">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@500&display=swap" rel="stylesheet">
    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="{{ asset('public/assets/css/facebook/app.min.css?v=') . rand() . date('d-m-Y H:i:s') }}"
        rel="stylesheet" />
    <!-- ================== END BASE CSS STYLE ================== -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @yield('head')

</head>

<body class="pace-top">
    <!-- begin #page-loader -->
    <div id="page-loader" class="fade show">
        <span class="spinner"></span>
    </div>
    <!-- end #page-loader -->

    <!-- begin #page-container -->
    <div id="page-container" class="fade">
        <!-- begin login -->
        <div class="login login-with-news-feed">
            <!-- begin news-feed -->
            <div class="news-feed">
                <div class="news-image" style="background-image: url({{ asset('public/assets/img/login/login.jpg') }})">
                </div>
            </div>
            <!-- end news-feed -->
            <!-- begin right-content -->
            <div class="right-content">
                <!-- begin login-header -->
                <div class="login-header">
                    <img src="{{ asset('public/assets/img/logo/logo.png') }}"
                        class="img-fluid mx-auto d-block" width="40%" alt="Gastos">
                    <div class="brand mt-1 text-center">
                        <b>Nombre </b> Proyecto
                        @yield('note')
                    </div>
                </div>
                <!-- end login-header -->
                @yield('content')
            </div>
            <!-- end right-container -->
        </div>
        <!-- end login -->
        <!-- begin scroll to top btn -->
        <a href="javascript:;" class="btn btn-icon btn-circle btn-primary btn-scroll-to-top fade"
            data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
        <!-- end scroll to top btn -->
    </div>
    <!-- end page container -->

    <!-- ================== BEGIN BASE JS ================== -->
    <script src="{{ asset('public/assets/js/app.min.js?v=') . rand() . date('d-m-Y H:i:s') }}"></script>
    <script src="{{ asset('public/assets/js/facebook.min.js?v=') . rand() . date('d-m-Y H:i:s') }}"></script>
    <script
        src="{{ asset('public/assets/plugins/bootstrap-show-password/dist/bootstrap-show-password.js?v=') . rand() . date('d-m-Y H:i:s') }}">
    </script>
    <script
        src="{{ asset('public/assets/plugins/pwstrength-bootstrap/dist/pwstrength-bootstrap.min.js?v=') . rand() . date('d-m-Y H:i:s') }}">
    </script>
    <!-- ================== END BASE JS ================== -->
    <!-- Sweeralert-->
    <script src="{{ asset('public/assets/plugins/sweetalert/dist/sweetalert.min.js?v=') . rand() . date('d-m-Y H:i:s') }}">
    </script>
    @yield('script')
    <script>
        $('.carousel').carousel({
            interval: 5000
        });
    </script>
</body>

</html>
