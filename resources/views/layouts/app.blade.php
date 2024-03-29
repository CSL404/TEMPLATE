<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <title>Titulo @yield('title') </title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="Nombre Proyecto" name="description" />
    <meta content="Consorcio Nova" name="author" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="{{ asset('public/assets/css/facebook/app.min.css?v=') . rand() . date('d-m-Y H:i:s') }}"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- ================== END BASE CSS STYLE ================== -->
    {{-- Logo de la pestaña --}}
    <link rel="icon" type="image/png" href="{{ asset('public/assets/img/favicon/favicon.png') }}" sizes="64x64">
    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@500&display=swap" rel="stylesheet">
    <link href="{{ asset('public/assets/plugins/gritter/css/jquery.gritter.css?v=') . rand() . date('d-m-Y H:i:s') }}"
        rel="stylesheet" />
    <link
        href="{{ asset('public/assets/plugins/flag-icon-css/css/flag-icon.min.css?v=') . rand() . date('d-m-Y H:i:s') }}"
        rel="stylesheet" />
    <link href="{{ asset('public/assets/plugins/tag-it/css/jquery.tagit.css') }}" rel="stylesheet" />
    <!-- ================== END PAGE LEVEL STYLE ================== -->
    <!-- Bootstrap validator-->
    <script
        src="{{ asset('public/assets/plugins/bootstrap-validator/jquery-3.1.0.js?v=') . rand() . date('d-m-Y H:i:s') }}">
    </script>
    <script
        src="{{ asset('public/assets/plugins/bootstrap-validator/validator.min.js?v=') . rand() . date('d-m-Y H:i:s') }}">
    </script>
    <script src="{{ asset('public/assets/css/style.css?v=') . rand() . date('d-m-Y H:i:s') }}"></script>
    {{-- Select2 --}}
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-css/1.4.6/select2-bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css">

    {{-- Bootstrap style --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    {{-- Datatables --}}
    <link href="{{ asset('public/assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}"
        rel="stylesheet" />
    <link href="{{ asset('public/assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
        rel="stylesheet" />
    <link href="{{ asset('public/assets/plugins/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}"
        rel="stylesheet" />
    <style>
        .dropdown-menu {
            max-height: 280px;
            overflow-y: auto;
        }
    </style>
    @yield('head')
</head>

<body>

    <!-- begin #page-loader -->
    <div id="page-loader" class="fade show">
        <span class="spinner"></span>
    </div>
    <!-- end #page-loader -->

    <!-- begin #page-container -->
    <div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
        <!-- begin #header -->
        <div id="header" class="header navbar-inverse">
            <!-- begin navbar-header -->
            <div class="navbar-header">
                <a href="{{ route('home') }}" class="navbar-brand"><b>Nombre</b>Proyecto</a>
                <button type="button" class="navbar-toggle" data-click="sidebar-toggled"
                    style="background-color: #324048">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <!-- end navbar-header -->
            <!-- begin header-nav -->
            <ul class="navbar-nav navbar-right">
                {{-- BUSCADOR --}}
                {{-- <li class="navbar-form">
					<form action="#" method="#" name="search">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Buscar ...." />
							<button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
						</div>
					</form>
				</li> --}}
                {{-- USUARIOS CONECTADOS --}}
                <li class="dropdown">
                    @php
                        $count_us = 0;
                    @endphp
                    @foreach ($users as $item)
                        @if (Cache::has('user-is-online-' . $item->id))
                            @php $count_us++; @endphp
                        @endif
                    @endforeach
                    <a href="#" data-toggle="dropdown" class="f-s-14">
                        <i class="fa fa-users"></i>
                        <span class="label">{{ $count_us }}</span>
                    </a>
                    <div class="dropdown-menu media-list dropdown-menu-right scrollable-menu">
                        <div class="dropdown-header">Usuarios Conectados ({{ $count_us }})</div>
                        @foreach ($users as $item)
                            @if (Cache::has('user-is-online-' . $item->id))
                                <a class="dropdown-item media">
                                    <div class="media-left">
                                        @if (auth()->user()->image_us == '/assets/img/user.png')
                                            <img src="{{ asset('public/assets/img/user.png') }}" width="20px"
                                                alt="Profile" />
                                        @else
                                            <img src="{{ asset('public') . Storage::url(auth()->user()->image_us) }}"
                                                width="20px" alt="Profile" />
                                        @endif
                                    </div>
                                    <div class="media-body">
                                        <h6 class="media-heading">{{ $item->name }}</h6>
                                    </div>
                                </a>
                            @endif
                        @endforeach
                    </div>
                </li>
                <li class="dropdown navbar-language">
                    <a href="#" class="pr-1 pl-1 pr-sm-3 pl-sm-3">
                        <span class="flag-icon flag-icon-mx" title="us"></span>
                        <span class="name d-none d-sm-inline">ES</span>
                    </a>
                </li>
                <li class="dropdown navbar-user">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        @if (auth()->user()->image_us == '/assets/img/user.png')
                            <img src="{{ asset('public/assets/img/user.png') }}" alt="Profile" />
                        @else
                            <img src="{{ asset('public') . Storage::url(auth()->user()->image_us) }}" alt="Profile" />
                        @endif
                        <span class="d-none d-md-inline">{{ auth()->user()->name }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="#change_image" data-toggle="modal" data-backdrop="static" data-keyboard="false"
                            class="dropdown-item">Editar Imagen</a>
                        <div class="dropdown-divider"></div>
                        <!-- formulario logout-form para salir-->
                        <a href="#" id="simple_confirm" class="dropdown-item">Salir</a>
                    </div>
                </li>
            </ul>
            <!-- end header-nav -->
        </div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        <!-- end #header -->
        <!-- begin #sidebar -->
        <div id="sidebar" class="sidebar head-sidebar">
            <!-- begin sidebar scrollbar -->
            <div data-scrollbar="true" data-height="100%">
                <!-- begin sidebar user -->
                <ul class="nav">
                    <li class="nav-profile">
                        <a href="javascript:;" data-toggle="nav-profile">
                            <div class="cover with-shadow"></div>
                            <div class="info text-center" style="background-color:white">
                                <img src="{{ asset('public/assets/img/empresa/imagen3.png') }}"
                                    class="img-fluid mt-3 mb-2">
                            </div>
                        </a>
                    </li>
                    <li>
                        <ul class="nav nav-profile expand" style="display: block;">
                            <li>
                                <a href="#modal-dialog" data-toggle="modal" data-backdrop="static"
                                    data-keyboard="false"><i class="fa-solid fa-gears"></i> Configuración</a>
                            </li>
                            @if (auth()->user()->admin == 1)
                                <li class="has-sub">
                                    <a href=""><i class="fa-regular fa-folder-open"></i> Formato de Accesos</a>
                                </li>
                                <li
                                    class="has-sub {{ request()->routeIS('users.index', 'users.create', 'users.edit') ? 'active' : '' }}">
                                    <a href="{{ route('users.index') }}">
                                        <i class="fas fa-user"></i>
                                        <span>Usuarios</span>
                                    </a>
                                </li>
                            @endif
                            <li class="has-sub">
                                <a href=""><i class="fa-solid fa-play"></i> Tutoriales</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- end sidebar user -->
                <!-- begin sidebar nav -->
                <ul class="nav">
                    <li class="nav-header">Menú</li>


                    <!-- begin sidebar minify button -->
                    <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i
                                class="fa fa-angle-double-left"></i></a></li>
                    <!-- end sidebar minify button -->
                </ul>
                <!-- end sidebar nav -->
            </div>
            <!-- end sidebar scrollbar -->
        </div>
        <!-- Modal Cambiar Contraseña-->
        <div class="modal fade" id="modal-dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Cambiar Contraseña</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <form action="{{ route('user.change', auth()->user()->id) }}" method="POST"
                                role="form" data-toggle="validator" id="formulario_pass">
                                @csrf
                                {{ method_field('PUT') }}
                                <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-12 col-form-label">Contraseña
                                        Actual</label>
                                    <div class="col-sm-12 input-group">
                                        <input type="password" class="form-control form-control-sm"
                                            name="password_act" id="password_act" placeholder="Contraseña" required>
                                        <span class="input-group-addon" onclick="Password()"><i
                                                class="fa fa-eye-slash icon2"></i></span>
                                        <div class="col-md-12 help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-12 col-form-label">Nueva Contraseña <i
                                            class="fas fa-question-circle" data-toggle="tooltip" data-placement="top"
                                            title="Por seguridad te recomendamos la contraseña debe tener al entre 8 y 16 caracteres, al menos un dígito, al menos una minúscula y al menos una mayúscula."></i></label>
                                    <div class="col-sm-12 input-group">
                                        <input type="password" class="form-control form-control-sm" name="password"
                                            id="password" placeholder="Contraseña" data-minlength="8"
                                            maxlength="16" data-error="Longitud Minima De 8 Caracteres" required>
                                        <span class="input-group-addon" onclick="mostrarPassword()"><i
                                                class="fa fa-eye-slash icon"></i></span>
                                        <div class="col-lg-12 help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <!-- Div para mostrar fortaleza de contraseña-->
                                <div class="form-group  mb-2" id="pwd-container">
                                    <div class="row align-items-center">
                                        <div class="col-md-12">
                                            <div id="pwstrength-default-progress"
                                                class="pwstrength_viewport_progress">
                                            </div>
                                        </div>
                                        <div class="col-md-12 text-danger" id="length-help-text"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-12 col-form-label">Confirmar</label>
                                    <div class="col-sm-12 input-group">
                                        <input type="password" class="form-control form-control-sm"
                                            id="password-confirm" placeholder="Contraseña" data-match="#password"
                                            data-match-error="No Coinciden Las Contraseñas" required>
                                        <span class="input-group-addon" onclick="mostrarPassword()"><i
                                                class="fa fa-eye-slash icon"></i></span>
                                        <div class="col-md-12 help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="reset" class="btn btn-danger btn-sm"><span
                                            class="fas fa-eraser"></span>
                                        Limpiar</button>
                                    <button type="submit" class="btn btn-primary btn-sm" id="enviar"><span
                                            class="fas fa-save"></span> Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Cambiar Imagen-->
        <div class="modal fade" id="change_image">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Configuración de la cuenta</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <form action="{{ route('user.image') }}" method="POST" role="form"
                                data-toggle="validator" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" value="{{ auth()->user()->id }}" name="id_user">
                                <div class="form-group row">
                                    <label class="col-sm-12 col-form-label">Selecciona
                                        un archivo: <i class="fas fa-question-circle" data-toggle="tooltip"
                                            data-placement="top"
                                            title="Extensiones permitidas JPEG, BMP, PNG, JPG con un peso máximo de 2 MB Extensión recomendada: PNG"></i></label>
                                    <div class="custom-file mb-2">
                                        <input type="file" class="form-control form-control-sm" id="imagen"
                                            name="imagen" accept="image/jpeg,image/png" required>
                                        <label for="imagen" id="inputImage" class="custom-file-label"
                                            data-browse="Buscar...">Elija
                                            el archivo</label>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary btn-sm"><span
                                            class="fas fa-save"></span>
                                        Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @yield('content')

        <!-- begin scroll to top btn -->
        <a href="javascript:;" class="btn btn-icon btn-circle btn-primary btn-scroll-to-top fade"
            data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
        <!-- end scroll to top btn -->
    </div>
    <!-- end page container -->

    {{-- Scrpts --}}
    <script
        src="{{ asset('public/assets/plugins/pwstrength-bootstrap/dist/pwstrength-bootstrap.min.js?v=') . rand() . date('d-m-Y H:i:s') }}">
    </script>
    <!-- ================== BEGIN BASE JS ================== -->
    <script src="{{ asset('public/assets/js/app.min.js?v=') . rand() . date('d-m-Y H:i:s') }}"></script>
    <script src="{{ asset('public/assets/js/facebook.min.js?v=') . rand() . date('d-m-Y H:i:s') }}"></script>
    <!-- ================== END BASE JS ================== -->
    <script src="{{ asset('public/assets/plugins/sweetalert/dist/sweetalert.min.js?v=') . rand() . date('d-m-Y H:i:s') }}">
    </script>
    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <script src="{{ asset('public/assets/plugins/gritter/js/jquery.gritter.js?v=') . rand() . date('d-m-Y H:i:s') }}">
    </script>
    <script src="{{ asset('public/assets/js/utils/utils.js?v=') . rand() . date('d-m-Y H:i:s') }}"></script>
    <!-- Setear input para cambiar imagen de usuario-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    {{-- SWEET ALERT --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @include('sweetalert::alert')

    <!--Datatables JQUERRY-->
    <script src="{{ asset('public/assets/plugins/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}">
    </script>
    <script src="{{ asset('public/assets/plugins/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/pdfmake/build/vfs_fonts.js') }}"></script>
    {{-- Funcion que bloquea la pantalla al usuario hasta que termina las peticiones AJAX --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.js"></script>
    <script>
        $(document).ready(function() {
            $.blockUI.defaults.message = "Cargado información ...";
            $.blockUI.defaults.css = {};
            $(document).ajaxStart($.blockUI).ajaxStop($.unblockUI);
        });
    </script>
    {{-- ACTUALIZAR IMAGEN DE PERFIL --}}
    <script>
        let uploadField = document.getElementById("imagen");
        uploadField.onchange = function() {
            if (this.files[0].size > 2000000) {
                $('#change_image').modal('hide');
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'El archivo es mayor a 2 MB, intenta de nuevo.'
                }).then((willDelete) => {
                    if (willDelete) {
                        $('#change_image').modal({
                            backdrop: 'static',
                            keyboard: false
                        });
                    }
                });
                this.value = "";
            };
        };

        document.getElementById('imagen').onchange = function() {
            document.getElementById('inputImage').innerHTML = document.getElementById('imagen').files[0].name;
        }
    </script>

    {{-- ACTUALIZAR CONTRASEÑA --}}
    <script type="text/javascript">
        function mostrarPassword() {
            var cambio = document.getElementById("password");
            var cambio2 = document.getElementById("password-confirm");
            if (cambio.type == "password") {
                cambio.type = "text";
                cambio2.type = "text";
                $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
            } else {
                cambio.type = "password";
                cambio2.type = "password";
                $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
            }
        }

        function Password() {
            var cambio = document.getElementById("password_act");
            if (cambio.type == "password") {
                cambio.type = "text";
                $('.icon2').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
            } else {
                cambio.type = "password";
                $('.icon2').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
            }
        }
    </script>

    <!-- Notificacion de inicio Gritter-->
    <script>
        $(document).ready(function() {
            var ruta = "{{ request()->routeIS('home') }}";
            if (ruta == 1) {
                var nombre = "{{ auth()->user()->name }}";
                setTimeout(function() {
                    $.gritter.add({
                        title: 'Bienvenido, ' + nombre + '!',
                        text: 'Nombre Proyecto.',
                        image: ("{{ auth()->user()->image_us }}" == '/assets/img/user.png') ?
                            "{{ asset('public/assets/img/user.png') }}" :
                            "{{ asset('public/') . Storage::url(auth()->user()->image_us) }}",
                        fade_out_speed: 1000
                    });
                }, 1000);
            }
        });
    </script>

    <!--Script Para Salir -->
    <script>
        $(document).ready(function() {
            $("#simple_confirm").click(function() {
                Swal.fire({
                    title: "¿Deseas salir del sistema?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('logout-form').submit();
                    }
                })
            });
        });
    </script>
    <!-- Password Strength-Bootsrap-->
    <script
        src="{{ asset('public/assets/plugins/pwstrength-bootstrap/dist/pwstrength-bootstrap.min.js?v=') . rand() . date('d-m-Y H:i:s') }}">
    </script>
    <script>
        $(document).ready(function() {
            var options = {};
            options.ui = {
                container: "#pwd-container",
                viewports: {
                    progress: ".pwstrength_viewport_progress"
                },
                showVerdictsInsideProgressBar: true
            };
            options.common = {
                onKeyUp: function(evt, data) {
                    if (data.score <= 14) {
                        $("#length-help-text").text("Tu contraseña es insegura");
                        $('#enviar').prop("disabled", true);
                        $('#password-confirm').prop("disabled", true);
                    } else if (typeof data.score == 'undefined') {
                        $('#password-confirm').prop("disabled", true);
                    } else {
                        $("#length-help-text").empty();
                        $('#enviar').prop("disabled", false);
                        $('#password-confirm').prop("disabled", false);
                    }
                }
            };
            $('#password').pwstrength(options);
        });
    </script>

    @yield('js')
</body>

</html>
