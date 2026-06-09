@extends('layouts.app')

@section('content')

<div class="admin-layout">

    @include('layouts.partials.admin-sidebar')

    <main class="admin-content">

        <div class="header-section">
            <h1>Libros</h1>

            <a href="{{ route('admin.libros.create') }}" class="btn btn-primary">
                + Crear libro
            </a>
        </div>

        <div class="card">

            <table class="table">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Género</th>
                        <th>Edad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($libros as $libro)
                        <tr>
                            <td>{{ $libro->id }}</td>
                            <td>{{ $libro->titulo }}</td>
                            <td>{{ $libro->autor }}</td>
                            <td>{{ $libro->genero }}</td>
                            <td>{{ $libro->clasificacion_edad }}</td>

                            <td class="acciones">
                                <a href="{{ route('admin.libros.edit', $libro->id) }}"
                                class="btn-editar">
                                    Editar
                                </a>

                                @if($libro->id > 17)
                                    <form action="{{ route('admin.libros.destroy', $libro->id) }}"
                                        method="POST">

                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn-borrar">
                                            Borrar
                                        </button>
                                    </form>

                                @else
                                    <span class="bloqueado">
                                        Protegido
                                    </span>
                                @endif

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- paginacion --}}
            <div class="paginacion-admin">
                {{ $libros->links() }}
            </div>

        </div>
    </main>

</div>

@endsection