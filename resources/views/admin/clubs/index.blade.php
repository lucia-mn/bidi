@extends('layouts.admin')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Lista de clubs</h1>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">

        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        <a href="{{ route('admin.clubs.create') }}" class="btn btn-primary mb-3">Nuevo club</a>

                        <table class="table table-bordered" id="club_table">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Estadio</th>
                                    <th>Año de fundación</th>
                                    <th>Presidente</th>
                                    <th>Entrenador</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clubs as $club)
                                <tr>
                                   <td>{{ $club->nombre }}</td> 
                                   <td>{{ $club->estadio }}</td>
                                   <td>{{ $club->anio_fundacion }}</td>
                                   <td>{{ $club->presidente }}</td>
                                   <td>{{ $club->entrenador }}</td>
                                   <td>
                                        <a href="{{ route('admin.clubs.edit', $club->id) }}" class="btn btn-success mb-3">
                                            Editar
                                        </a>

                                        <form action="{{ route('admin.clubs.destroy', $club->id) }}" id="delete_form" method="POST" onsubmit="return confirm('¿Seguro de que quieres eliminar el club? :(')" style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn btn-danger mb-3" value="Eliminar">
                                        </form>
                                   </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#club_table').DataTable();
    });
</script>
@endsection
