@extends('layouts.app')
@section('title', 'Usuarios')
@section('content')
    <!-- begin #content -->
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="#">Usuarios</a></li>
            <li class="breadcrumb-item active">Buscar</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">Usuarios</h1>
        <!-- end page-header -->
        <div class="brand-panel"></div>
        <div class="panel panel-inverse">
            <!-- begin panel-body -->
            <div class="panel-body">
                <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm float-right mb-3"><span
                        class="fas fa-plus"></span> Agregar</a>
                <div class="table-responsive">
                    <table id="table_" class="table table-bordered table-hover table-sm" style="width:100%">
                        <thead>
                            <tr>
                                <th>Número</th>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Area</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $contador = 1;
                            @endphp
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $contador }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->area }}</td>
                                    <td>
                                        <form action="{{ route('users.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            @if ($item->active == 1)
                                                <button type="submit" class="btn btn-success btn-icon btn-circle btn-lg"
                                                    data-toggle="tooltip" data-placement="top" title="Desactivar"><i
                                                        class="fa-solid fa-plug"></i></button>
                                            @else
                                                <button type="submit" class="btn btn-danger btn-icon btn-circle btn-lg"
                                                    data-toggle="tooltip" data-placement="top" title="Activar"><i
                                                        class="fa-solid fa-plug-circle-xmark"></i></button>
                                            @endif
                                            <a href="{{ route('users.edit', Crypt::encryptString($item->id)) }}"
                                                class="btn btn-primary btn-icon btn-circle btn-lg" data-toggle="tooltip"
                                                data-placement="top" title="Actualizar"><span
                                                    class="fas fa-edit"></span></a>
                                        </form>
                                    </td>
                                </tr>
                                @php
                                    $contador++;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- end panel-body -->
        </div>
        <!-- end panel -->
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            var tabla = $('#table_').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'copy',
                        text: '<i class="fas fa-copy fa-lg"></i>',
                        titleAttr: 'Copiar'
                    },
                    {
                        extend: 'excel',
                        text: '<i class="fas fa-file-excel fa-lg"></i>',
                        titleAttr: 'Excel'
                    }
                ],
                responsive: true,
                "autoWidth": false,
                "paging": true,
                "pageLength": 10,
                "language": {
                    buttons: {
                        copySuccess: {
                            1: "Copió una fila al portapapeles",
                            _: "Se copiaron %d filas al portapapeles"
                        },
                        copyTitle: 'Datos Copiados'
                    },
                    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
                }
            });
        });
    </script>
@endsection
