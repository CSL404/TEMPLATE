@extends('layouts.errors')
@section('title')
    403
@endsection
@section('content')
    <div class="error">
        <div class="error-code">403</div>
        <div class="error-content">
            <div class="error-message">¡Lo sentimos este enlace es prohibido!</div>
            <div class="error-desc mb-3 mb-sm-4 mb-md-5">
                Si crees que existe un error comunicate con el administrador del sistema.
            </div>
        </div>
    </div>
@endsection
