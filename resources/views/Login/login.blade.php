@extends('Login.app')
@section('title')
    Nombre proyecto
@endsection
@section('note')
    <small class="mt-2">Pasión por la calidad y el servicio.</small>
@endsection
@section('content')
    <!-- begin login-content -->
    <div class="login-content">
        <form method="POST" action="{{ route('login') }}" class="margin-bottom-0">
            @csrf
            <div class="form-group m-b-15">
                <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email"
                    placeholder="Correo" required />
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-1">
                <input data-toggle="password" data-placement="after"
                    class="form-control form-control-lg @error('password') is-invalid @enderror" type="password"
                    name="password" placeholder="Contraseña" required />
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
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
                <div class="row mb-2">
                    <div class="col-md-12">
                        @if (Session::has('status'))
                            <div class="alert alert-success mt-2" role="alert">
                                <!-- Mensaje de correo en uso -->
                                {{ Session::get('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="checkbox checkbox-css mb-3">
                <a href="{{ route('user.restore') }}">¿Olvidaste tu contraseña?</a>
            </div>
            <div class="login-buttons">
                <button type="submit" class="btn btn-info btn-block btn-lg">Ingresar <i
                        class="fa fa-sign-in-alt"></i></button>
            </div>
            <div class="m-t-20 mb-2 p-b-24 text-inverse">
                No tienes un registro aún? Haz clic <a href="{{ route('user.register') }}"> aquí </a> para registrarse.
            </div>
            <hr />
            <p class="text-center mb-0">
                &copy; Corporativo Nova Todos Los Derechos Reservados {{ date('Y') }}
            </p>
        </form>
    </div>
    <!-- end login-content -->
@endsection
