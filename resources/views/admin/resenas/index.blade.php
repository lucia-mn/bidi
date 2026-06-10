@extends('layouts.app')

@section('content')

<div class="admin-layout">

    @include('layouts.partials.admin-sidebar')

    <main class="admin-content">

        <div class="header-section">
            <h1>Reseñas</h1>
        </div>

        <div class="card">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Libro</th>
                        <th>Comentario</th>
                        <th>Acción</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($resenas as $resena)
                        <tr>
                            <td>{{ $resena->id }}</td>
                            <td>{{ $resena->user->name }}</td>
                            <td>{{ $resena->libro->titulo }}</td>
                            <td>{{ $resena->comentario }}</td>

                            <td>
                                <form action="{{ route('admin.resenas.destroy', $resena) }}"
                                    method="POST"
                                    onsubmit="return confirm('¿Eliminar reseña?')">

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
                {{ $resenas->links() }}
            </div>
        </div>
    </main>
</div>

@endsection




    
</table>

{{ $resenas->links() }}