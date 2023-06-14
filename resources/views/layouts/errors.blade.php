<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <title>Titulo @yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="Nombre del Proyecto" name="description" />
    <meta content="Consorcio Nova" name="author" />
    <!-- ================== BEGIN FAVICON ================== -->
    {{-- Logo de la pestaña --}}
    <link rel="icon" type="image/png" href="{{ asset('public/assets/img/favicon/favicon.png') }}" sizes="64x64">
    <!-- ================== END FAVICON ================== -->
    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="{{ asset('public/assets/css/facebook/app.min.css') }}" rel="stylesheet" />
    <!-- ================== END BASE CSS STYLE ================== -->
</head>

<body class="pace-top">
    <!-- begin #page-loader -->
    <div id="page-loader" class="fade show">
        <span class="spinner"></span>
    </div>
    <!-- end #page-loader -->

    <!-- begin #page-container -->
    <div id="page-container" class="fade">
        <!-- begin error -->
        @yield('content')
        <!-- end error -->
        <!-- begin scroll to top btn -->
        <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade"
            data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
        <!-- end scroll to top btn -->
    </div>
    <!-- end page container -->

    <!-- ================== BEGIN BASE JS ================== -->
    <script src="{{ asset('public/assets/js/app.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/facebook.min.js') }}"></script>
    <!-- ================== END BASE JS ================== -->
</body>

</html>
