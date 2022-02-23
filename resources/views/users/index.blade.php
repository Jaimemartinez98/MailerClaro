@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.bootstrap4.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css" />


    <a href="{{ route('users.create') }}" class="btn btn-success">Crear Usuario</a>

    <div class="row">
        <table id="table_users" class="table dt-responsive nowrap" style="width:100%">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Celular</th>
                    <th scope="col">Documento Identificación</th>
                    <th scope="col">Edad</th>
                    <th scope="col">Email</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usuarios as $usuario)
                    <tr>

                        <th scope="row">{{ $usuario->id }}</th>
                        <td>{{ $usuario->name }}</td>
                        <td>{{ $usuario->phone }}</td>
                        <td>{{ $usuario->document_number }}</td>
                        <td>
                            @php
                                [$year, $month, $day] = explode('-', $usuario->birth_date);
                                $year_difference = date('Y') - $year;
                                $month_difference = date('m') - $month;
                                $day_difference = date('d') - $day;
                                if ($day_difference < 0 || $month_difference < 0) {
                                    $year_difference--;
                                }
                            @endphp

                            {{ $year_difference }} Años

                        </td>
                        <td>{{ $usuario->email }}</td>
                        <td>
                            <a href="{{ route('users.edit', $usuario->id) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('users.delete', $usuario->id) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>


                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>


    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.7/js/responsive.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>


    <script>
        $(document).ready(function() {

            $('#table_users').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                "processing": true,
                "info": true,
                "stateSave": true,
                "order": [
                    [1, "asc"]
                ],
                "language": {
                    "search": "Buscar:",
                    "lengthMenu": "Mostrar _MENU_ usuarios por página",
                    "zeroRecords": "No se encontro nada, lo siento",
                    "info": "Mostrando página  _PAGE_ de _PAGES_",
                    "infoEmpty": "Sin información disponible",
                    "infoFiltered": "(filtrado de _MAX_ registros totales)",
                    "paginate": {
                        "previous": "Anterior",
                        "next": "Siguiente",
                    },
                }
            });

        });
    </script>
@endsection
