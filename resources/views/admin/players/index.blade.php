@extends('layouts.admin')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Lista de jugadores</h1>
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

                        <a href="{{ route('admin.players.create') }}" class="btn btn-primary mb-3">Nuevo jugador</a>

                        <table class="table table-bordered" id="player_table">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <th>Dorsal</th>
                                    <th>Apodo</th>
                                    <th>Nombre del club</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($players as $player)
                                <tr>
                                   <td>{{ $player->nombre }}</td> 
                                   <td>{{ $player->apellidos }}</td>
                                   <td>{{ $player->dorsal }}</td>
                                   <td>{{ $player->apodo }}</td>
                                   <td>{{ $player->club?->nombre ?? 'Sin club' }}</td>
                                   <td>
                                        <a href="{{ route('admin.players.edit', $player->id) }}" class="btn btn-success mb-3">
                                            Editar
                                        </a>

                                        <form action="{{ route('admin.players.destroy', $player->id) }}" id="delete_form" method="POST" onsubmit="return confirm('¿Seguro de que quieres eliminar este jugador? :(')" style="display: inline-block;">
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
        $('#player_table').DataTable();
    });
</script>
@endsection
