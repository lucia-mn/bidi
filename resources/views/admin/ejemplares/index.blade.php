@extends('layouts.app')

@section('content')

<div class="admin-layout">

    @include('layouts.partials.admin-sidebar')

    <main class="admin-content">

        <div class="header-section">
            <h1>Ejemplares</h1>
        </div>

        <div class="card">

            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Libro</th>
                        <th>Código</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($ejemplares as $ejemplar)
                        <tr>
                            <td>{{ $ejemplar->id }}</td>

                            <td>
                                <span class="badge-libro">
                                    {{ $ejemplar->libro->titulo }}
                                </span>
                            </td>

                            <td class="codigo-ejemplar">
                                {{ $ejemplar->codigo }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="paginacion-admin">
                {{ $ejemplares->links() }}
            </div>
        </div>
    </main>
</div>

@endsection