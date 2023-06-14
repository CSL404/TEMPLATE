@extends('layouts.app')
@section('title', 'Usuarios')
@section('head')
    <link href="{{ asset('public/assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
        rel="stylesheet" />
    <link href="{{ asset('public/assets/plugins/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}"
        rel="stylesheet" />
@endsection
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
        <!-- begin row -->
        <div class="row">
            <!-- begin col-10 -->
            <div class="col-xl-12">
                <!-- begin panel -->
                <div class="panel panel-inverse">
                    <!-- begin panel-heading -->
                    <div class="panel-heading">
                        <h4 class="panel-title"></h4>
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
                        <a href="{{ route('users.create') }}" class="btn btn-primary float-right mb-3"><span
                                class="fas fa-plus"></span> Agregar</a>
                        <div class="table-responsive">
                            <table id="table_user" class="table table-hover table-bordered table-td-valign-middle">
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="text-nowrap">Número</th>
                                        <th class="text-nowrap">Nombre</th>
                                        <th class="text-nowrap">Correo</th>
                                        <th class="text-nowrap">Area</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $contador = 1;
                                    @endphp
                                    @foreach ($data as $item)
                                        <tr class="text-center">
                                            <td>{{ $contador }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->area }}</td>
                                            <td>
                                                <form action="{{ route('users.destroy', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    @if ($item->active == 1)
                                                        <button type="submit"
                                                            class="btn btn-success btn-icon btn-circle btn-lg"
                                                            data-toggle="tooltip" data-placement="top" title="Desactivar"><i
                                                                class="fa-solid fa-plug"></i></button>
                                                    @else
                                                        <button type="submit"
                                                            class="btn btn-danger btn-icon btn-circle btn-lg"
                                                            data-toggle="tooltip" data-placement="top" title="Activar"><i
                                                                class="fa-solid fa-plug-circle-xmark"></i></button>
                                                    @endif
                                                    <a href="{{ route('users.edit', Crypt::encryptString($item->id)) }}"
                                                        class="btn btn-primary btn-icon btn-circle btn-lg"
                                                        data-toggle="tooltip" data-placement="top" title="Actualizar"><span
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
            <!-- end col-10 -->
        </div>
        <!-- end row -->
    </div>
    <!-- end #content -->
@endsection
@section('script')
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $('#table_user').DataTable({
                dom: "<'row'<'col-md-6'l><'col-md-6'f>><'row'<'col-md-6'B><'col-md-6'p>><'row'<'col-md-12't>><'row'<'col-md-12'i>>",
                buttons: [{
                        extend: 'copy',
                        text: '<i class="fas fa-copy fa-lg"></i>',
                        titleAttr: 'Copiar'
                    },
                    {
                        extend: 'csv',
                        fieldSeparator: ';',
                        text: '<i class="fas fa-file fa-lg"></i>',
                        titleAttr: 'CSV'
                    },
                    {
                        extend: 'excel',
                        text: '<i class="fas fa-file-excel fa-lg"></i>',
                        titleAttr: 'Excel'
                    },
                    {
                        extend: 'pdf',
                        orientation: 'landscape',
                        text: '<i class="fas fa-file-pdf fa-lg"></i>',
                        titleAttr: 'PDF'
                    },
                    {
                        extend: 'print',
                        text: '<i class="fas fa-print fa-lg"></i>',
                        titleAttr: 'Imprimir'
                    }
                ],
                responsive: true,
                "autoWidth": false,
                "language": {
                    buttons: {
                        copySuccess: {
                            1: "Copió una fila al portapapeles",
                            _: "Se copiaron %d filas al portapapeles"
                        },
                        copyTitle: 'Datos Copiados'
                    },
                    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
                },
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ]
            });
        });
    </script>
@endsection
