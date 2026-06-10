@extends('layouts.app')

@section('content')

<div class="admin-layout">

    @include('layouts.partials.admin-sidebar')

    <main class="admin-content">

        <div class="header-section">
            <h1>Categorías</h1>

            <a href="{{ route('admin.categorias.create') }}" class="btn-primary">
                + Nueva categoría
            </a>
        </div>

        <div class="card">

            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($categorias as $categoria)
                        <tr>
                            <td>{{ $categoria->id }}</td>
                            <td>{{ $categoria->nombre }}</td>
                            <td>{{ $categoria->descripcion }}</td>

                            <td class="acciones">
                                <a href="{{ route('admin.categorias.edit', $categoria->id) }}" class="btn-editar">
                                    Editar
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="paginacion-admin">
                {{ $categorias->links() }}
            </div>

        </div>

    </main>

</div>

@endsection