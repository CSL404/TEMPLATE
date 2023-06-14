@extends('layouts.errors')
@section('title')
    503
@endsection
@section('content')
    <div class="error">
        <div class="error-code">503</div>
        <div class="error-content">
            <div class="error-message">¡Nuestro sistema entro en modo error!</div>
            <div class="error-desc mb-3 mb-sm-4 mb-md-5">
                Ooops....! Parece que algo salió mal.<br>
                Perdona las molestias, contacta al administrador
            </div>
        </div>
    </div>
@endsection
