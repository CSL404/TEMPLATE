@extends('layouts.app')
@section('title', 'Actualización Usuarios')
@section('content')
    <!-- begin #content -->
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:;">Inicio</a></li>
            <li class="breadcrumb-item"><a href="javascript:;">Usuarios</a></li>
            <li class="breadcrumb-item active">Actualización</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">Usuarios</h1>
        <!-- end page-header -->
        <!-- begin row -->
        <div class="row">
            <!-- begin col-6 -->
            <div class="col-md-12">
                <!-- begin panel -->
                <div class="panel panel-inverse" data-sortable-id="form-stuff-10">
                    <!-- begin panel-heading -->
                    <div class="panel-heading">
                        <h4 class="panel-title">Actualización De Usuarios</h4>
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default"
                                data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success"
                                data-click="panel-reload"><i class="fa fa-redo"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                                data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        </div>
                    </div>
                    <!-- end panel-heading -->
                    <!-- begin panel-body -->
                    <div class="panel-body">
                        <form action="{{ route('users.update', $data->id) }}" method="POST" role="form"
                            data-toggle="validator" id="formulario">
                            @csrf
                            {{ method_field('PUT') }}
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre"
                                        placeholder="Nombre Usuario" value="{{ $data->name }}" required />
                                    <div class="help-block with-errors text-danger"></div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="correo">Correo</label>
                                    <input type="email" class="form-control" id="correo" name="correo"
                                        placeholder="ejemplo@raloy.com.mx" value="{{ $data->email }}" required />
                                    <div class="help-block with-errors text-danger"></div>
                                </div>
                            </div>
                            <div class="form-row" id="completo_pass" style="display: none;">
                                <div class="form-group col-md-6">
                                    <label for="password">Contraseña <i class="fas fa-question-circle" data-toggle="tooltip"
                                            data-placement="top"
                                            title="Por seguridad te recomendamos la contraseña debe tener al entre 8 y 16 caracteres, al menos un dígito, al menos una minúscula y al menos una mayúscula."></i></label>
                                    <div class="input-group mb-2">
                                        <input class="form-control form-control-lg" type="password" name="password"
                                            id="password_us2" placeholder="Contraseña" data-minlength="8" maxlength="16"
                                            data-error="Longitud Minima De 8 Caracteres" />
                                        <span class="input-group-addon" onclick="mostrarPassword2()"><i
                                                class="fa fa-eye-slash icon"></i></span>
                                    </div>
                                    <div class="help-block with-errors text-danger" id="msj"></div>
                                    <div id="pwd-container_us">
                                        <div id="pwstrength-default-progress" class="pwstrength_viewport_progress_us"></div>
                                    </div>
                                    <div class="col-lg-12 text-danger" id="length-help-text_us"></div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="password_confirm">Confirmar Contraseña</label>
                                    <div class="input-group">
                                        <input class="form-control form-control-lg " type="password"
                                            name="password_confirmation" id="password-confirm_us2"
                                            placeholder="Confirmar Contraseña" data-match="#password_us2"
                                            data-match-error="No Coinciden Las Contraseñas" />
                                        <span class="input-group-addon" onclick="mostrarPassword2()"><i
                                                class="fa fa-eye-slash icon"></i></span>
                                    </div>
                                    <div class="help-block with-errors text-danger" id="msj2"></div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="area">Area</label>
                                    <select name="area_id" id="area_id" class="form-control" required>
                                        <option value="">Selecciona una opcion</option>
                                        @foreach ($areas as $item)
                                            @if ($item->id == $data->area_id)
                                                <option value="{{ $item->id }}" selected>{{ $item->description }}
                                                </option>
                                            @else
                                                <option value="{{ $item->id }}">{{ $item->description }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <div class="help-block with-errors text-danger"></div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="tipo">Tipo de usuario</label>
                                    <select name="tipo" id="tipo" class="form-control" required>
                                        <option value="">Selecciona una opcion</option>
                                        @if ($data->admin == 1)
                                            <option value="1" selected>Administrador</option>
                                            <option value="0">Usuario</option>
                                        @else
                                            <option value="1">Administrador</option>
                                            <option value="0" selected>Usuario</option>
                                        @endif
                                    </select>
                                    <div class="help-block with-errors text-danger"></div>
                                </div>
                                <div class="col-md-4 mt-4">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="customSwitch1"
                                            name="cambio">
                                        <label class="custom-control-label" for="customSwitch1">Cambiar Contraseña</label>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="reset" class="btn btn-danger"><span class="fas fa-eraser"></span>
                                    Limpiar</button>
                                <button type="submit" class="btn btn-success" id="enviar_us"><span
                                        class="fas fa-save"></span> Guardar</button>
                            </div>
                        </form>
                    </div>
                    <!-- end panel-body -->
                </div>
                <!-- end panel -->
            </div>
            <!-- end col-6 -->
        </div>
        <!-- end row -->
    </div>
    <!-- end #content -->
@endsection
@section('js')
    <!-- bootstrap-select  https://developer.snapappointments.com/bootstrap-select/-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <!-- Password Strength-Bootsrap-->
    <script>
        $(document).ready(function() {
            var options = {};
            options.ui = {
                container: "#pwd-container_us",
                viewports: {
                    progress: ".pwstrength_viewport_progress_us"
                },
                showVerdictsInsideProgressBar: true
            };
            options.common = {
                onKeyUp: function(evt, data) {
                    if (data.score <= 14) {
                        $("#length-help-text_us").text("Tu contraseña es insegura");
                        $('#enviar_us').prop("disabled", true);
                        $('#password-confirm_us2').prop("disabled", true);
                    } else if (typeof data.score == 'undefined') {
                        $('#password-confirm_us2').prop("disabled", true);
                    } else {
                        $("#length-help-text_us").empty();
                        $('#enviar_us').prop("disabled", false);
                        $('#password-confirm_us2').prop("disabled", false);
                    }
                }
            };
            $('#password_us2').pwstrength(options);
        });
    </script>
    <script type="text/javascript">
        function mostrarPassword2() {
            var cambio = document.getElementById("password_us2");
            var cambio2 = document.getElementById("password-confirm_us2");
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
    </script>
    <script>
        $('#completo_pass').hide(); //oculto mediante id
        $('#password_us2').prop("required", false);
        $('#password-confirm_us2').prop("required", false);
        $('#customSwitch1').change(function() {
            if (this.checked) {
                $('#completo_pass').show();
                $('#password_us2').prop("required", true);
                $('#password-confirm_us2').prop("required", true);
            } else {
                $('#completo_pass').hide();
                $('#password-confirm_us2').val('');
                $('#password_us2').val('');
                $('#msj').empty();
                $('#msj2').empty();
                $("#length-help-text_us").empty();
                $('#password_us2').prop("required", false);
                $('#password-confirm_us2').prop("required", false);
                $('#enviar_us').prop("disabled", false);
            }
        });
    </script>
@endsection
