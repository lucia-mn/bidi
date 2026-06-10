@extends('layouts.app')

@section('content')

<div class="admin-layout">

    @include('layouts.partials.admin-sidebar')

    <main class="admin-content">

        <div class="header-section">
            <h1>Reservas</h1>
        </div>

        <div class="card">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Libro</th>
                        <th>Ejemplar</th>
                        <th>Inicio</th>
                        <th>Fin</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($reservas as $reserva)
                        <tr>
                            <td>{{ $reserva->id }}</td>
                            <td>{{ $reserva->user->name ?? '—' }}</td>
                            <td>{{ $reserva->libro->titulo ?? '—' }}</td>
                            <td>{{ $reserva->ejemplar->codigo ?? '—' }}</td>
                            <td>{{ $reserva->fecha_inicio }}</td>
                            <td>{{ $reserva->fecha_fin }}</td>
                            <td>{{ $reserva->estado }}</td>

                            <td class="acciones">

                                <form action="{{ route('admin.reservas.destroy', $reserva) }}"
                                      method="POST"
                                      onsubmit="return confirm('¿Eliminar reserva?')">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn-borrar">
                                        Eliminar
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="paginacion-admin">
                {{ $reservas->links() }}
            </div>
        </div>
    </main>
</div>

@endsection