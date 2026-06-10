@extends('layouts.app')

@section('content')

<div class="admin-layout">

    @include('layouts.partials.admin-sidebar')

    <main class="admin-content">

        <div class="header-section">
            <h1>Usuarios</h1>
        </div>

        <div class="card">

            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>

                            <td class="acciones">

                                <form action="{{ route('admin.usuarios.destroy', $user) }}"
                                      method="POST"
                                      onsubmit="return confirm('¿Eliminar usuario?')">

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
                {{ $users->links() }}
            </div>
        </div>
    </main>
</div>

@endsection