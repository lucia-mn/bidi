@extends('layouts.app')

@section('content')

<div class="admin-layout">

    @include('layouts.partials.admin-sidebar')

    <main class="admin-content">

        <div class="header-section">
            <h1>Editar categoría</h1>
        </div>

        <div class="card">

            <form action="{{ route('admin.categorias.update', $categoria->id) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text"
                           name="nombre"
                           value="{{ old('nombre', $categoria->nombre) }}"
                           required>
                </div>

                <div class="form-group">
                    <label>Descripción</label>
                    <textarea name="descripcion">{{ old('descripcion', $categoria->descripcion) }}</textarea>
                </div>

                <button type="submit" class="btn-primary">
                    Guardar cambios
                </button>

            </form>

        </div>

    </main>

</div>

@endsection