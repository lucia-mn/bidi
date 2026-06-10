@extends('layouts.app')

@section('content')

<div class="admin-layout">

    @include('layouts.partials.admin-sidebar')

    <main class="admin-content">

        <div class="header-section">
            <h1>Crear categoría</h1>
        </div>

        <div class="card">

            <form action="{{ route('admin.categorias.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text"
                           name="nombre"
                           value="{{ old('nombre') }}"
                           required>
                </div>

                <div class="form-group">
                    <label>Descripción</label>
                    <textarea name="descripcion">{{ old('descripcion') }}</textarea>
                </div>

                <button type="submit" class="btn-primary">
                    Crear categoría
                </button>

            </form>
        </div>
    </main>
</div>

@endsection