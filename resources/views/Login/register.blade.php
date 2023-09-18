@extends('Login.app')
@section('title')
    Registro
@endsection
@section('head')
    <script
        src="{{ asset('public/assets/plugins/bootstrap-validator/jquery-3.1.0.js?v=') . rand() . date('d-m-Y H:i:s') }}">
    </script>
    <script
        src="{{ asset('public/assets/plugins/bootstrap-validator/validator.min.js?v=') . rand() . date('d-m-Y H:i:s') }}">
    </script>
@endsection
@section('content')
    <!-- begin register-content -->
    <div class="register-content">
        <form method="POST" action="{{ route('user.save') }}" id="formulario" role="form" data-toggle="validator"
            class="margin-bottom-0" autocomplete="off">
            @csrf
            <div class="row mb-2">
                <div class="col-md-12">
                    @if (Session::has('error'))
                        <div class="alert alert-danger mt-2" role="alert">
                            <!-- Mensaje de correo en uso -->
                            {{ Session::get('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                </div>
            </div>
            <div class="form-group row mb-2">
                <div class="col-md-12">
                    <label class="control-label">Nombre</label>
                </div>
                <div class="col-md-12">
                    <input type="text" class="form-control" placeholder="Nombre/s" id="nombre" name="nombre"
                        value="{{ old('nombre') }}" required />
                </div>
                <div class="col-md-12 help-block with-errors text-danger mb-1"></div>
            </div>

            <div class="form-group row mb-2">
                <div class="col-md-12">
                    <label class="control-label">Apellidos</label>
                </div>
                <div class="col-md-12">
                    <input type="text" class="form-control" placeholder="Apellidos" id="apellido" name="apellido"
                        value="{{ old('apellido') }}" required />
                </div>
                <div class="col-md-12 help-block with-errors text-danger mb-1"></div>
            </div>
            <div class="form-group row mb-2">
                <div class="col-md-12">
                    <label class="control-label">Correo</label>
                </div>
                <div class="col-md-12">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                        id="email" value="{{ old('email') }}" required placeholder="ejemplo@raloy.com.mx">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-12 help-block with-errors text-danger mb-1"></div>
            </div>
            <div class="form-group row mb-2">
                <div class="col-md-12">
                    <label class="control-label">Área</label>
                </div>
                <div class="col-md-12">
                    <select name="area" id="area" class="form-control" required>
                        <option value="">Selecciona una opción</option>
                        @foreach ($areas as $item)
                            <option value="{{ $item->id }}" {{ old('area') == $item->id ? 'selected' : '' }}>
                                {{ $item->description }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-12 help-block with-errors text-danger mb-1"></div>
            </div>
            <div class="form-group row mb-2">
                <div class="col-md-12">
                    <label class="control-label">Contraseña <i class="fas fa-question-circle" data-toggle="tooltip"
                            data-placement="top"
                            title="Por seguridad te recomendamos la contraseña debe tener al entre 8 y 16 caracteres, al menos un dígito, al menos una minúscula y al menos una mayúscula."></i></label>
                </div>
                <div class="col-md-12 input-group">
                    <input type="password" class="form-control" placeholder="Contraseña" name="password" id="password"
                        data-minlength="8" maxlength="16" data-error="Longitud Minima De 8 Caracteres" required />
                    <span class="input-group-addon" onclick="mostrarPassword()"><i class="fa fa-eye-slash icon"></i></span>
                </div>
                <div class="col-md-12 help-block with-errors text-danger mb-1"></div>
            </div>
            <div class="form-group  mb-2" id="pwd-container">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div id="pwstrength-default-progress" class="pwstrength_viewport_progress"></div>
                    </div>
                    <div class="col-md-12 text-danger" id="length-help-text"></div>
                </div>
            </div>
            <div class="form-group row mb-2">
                <div class="col-md-12">
                    <label class="control-label">Confirmar Contraseña</label>
                </div>
                <div class="col-md-12 input-group">
                    <input type="password" class="form-control" placeholder="Confirmar Contraseña" name="password-confirm"
                        id="password-confirm" data-match="#password" data-match-error="No Coinciden Las Contraseñas"
                        required />
                    <span class="input-group-addon" onclick="mostrarPassword()"><i
                            class="fa fa-eye-slash icon"></i></span>
                </div>
                <div class="col-md-12 help-block with-errors text-danger mb-1"></div>

            </div>

            <div class="register-buttons">
                <button type="submit" class="btn btn-info btn-block btn-lg" id="enviar">Registrar <i
                        class="fa fa-save"></i></button>
            </div>
            <div class="m-t-15 m-b-15 p-b-15">
                ¿Ya eres usuario? Haga clic <a href="{{ route('return') }}"> aquí </a> para iniciar sesión.
            </div>
            <hr />
            <p class="text-center mb-0">
                &copy; Corporativo Nova Todos Los Derechos Reservados {{ date('Y') }}
            </p>
        </form>
    </div>
    <!-- end register-content -->
@endsection
@section('script')
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
    </script>
@endsection
