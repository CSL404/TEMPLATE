@extends('layouts.errors')
@section('title')
    404
@endsection
@section('content')
    <div class="error">
        <div class="error-code">404</div>
        <div class="error-content">
            <div class="error-message">¡UH OH! Estas perdido.</div>
            <div class="error-desc mb-3 mb-sm-4 mb-md-5">
                La página que busca no existe. Cómo llegaste aquí es un misterio. <br>
                Pero puede hacer clic en el botón de abajo para volver a la página de inicio.
            </div>
            <div>
                <a href="{{ route('home') }}" class="btn btn-success p-l-20 p-r-20">Ir al inicio</a>
            </div>
        </div>
    </div>
@endsection
