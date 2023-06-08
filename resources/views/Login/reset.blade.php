@extends('Login.base')
@section('title') Recuperar Contraseña @endsection
@section('note') <small>Bienvenido al apartado para restablecer tu contraseña.</small> @endsection
@section('content')
	<!-- begin login-content -->
	<div class="login-content">
		<div class="row mb-2">
			<div class="col-md-12">
				@if (session('status'))
					<div class="alert alert-success" role="alert">
						{{ session('status') }}
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				@endif
			</div>
		</div>
		<form method="POST" action="{{ route('password.email') }}" class="margin-bottom-0">
			@csrf
			<div class="form-group m-b-15">
				<input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" placeholder="Correo" required />
				@error('email')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
				@enderror
			</div>
			<div class="checkbox checkbox-css m-b-30">
				<a href="{{route('return')}}">Regresar</a>
			</div>
			<div class="login-buttons">
				<button type="submit" class="btn btn-info btn-block btn-lg">Enviar Link <i class="far fa-envelope"></i></button>
			</div>
			<hr />
			<p class="text-center mb-0">
				&copy; Corporativo Nova Todos Los Derechos Reservados {{ date('Y') }}
			</p>
		</form>
	</div>
	<!-- end login-content -->
@endsection
