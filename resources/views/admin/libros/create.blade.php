@extends('layouts.app')

@section('content')

<div class="admin-layout">

    @include('layouts.partials.admin-sidebar')

    <main class="admin-content">

        <div class="header-section">
            <h1>Crear libro</h1>
        </div>

        <div class="card">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.libros.store') }}" method="POST" enctype="multipart/form-data">

                @csrf

                <div class="form-group">
                    <label>Título</label>
                    <input type="text" name="titulo" required>
                </div>
                @error('titulo')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

                <div class="form-group">
                    <label>Autor</label>
                    <input type="text" name="autor" required>
                </div>
                @error('titulo')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

                <div class="form-group">
                    <label>ISBN</label>
                    <input type="text" name="isbn" required>
                </div>

                <div class="form-group">
                    <label>Descripción</label>
                    <textarea name="descripcion"></textarea>
                </div>

                <div class="form-group">
                    <label>Género</label>
                    <input type="text" name="genero">
                </div>

                <div class="form-group">
                    <label>Idioma</label>
                    <input type="text" name="idioma">
                </div>

                <div class="form-group">
                    <label>Año publicación</label>
                    <input type="number" name="anio_publicacion">
                </div>

                <div class="form-group">
                    <label>Portada</label>
                    <input type="file" name="portada">
                </div>

                <div class="form-group">
                    <label>PDF</label>
                    <input type="file" name="archivo_pdf">
                </div>

                <div class="form-group">
                    <label>Clasificación edad</label>

                    <select name="clasificacion_edad">

                        <option value="infantil">
                            Infantil
                        </option>

                        <option value="juvenil">
                            Juvenil
                        </option>

                        <option value="adulto">
                            Adulto
                        </option>

                    </select>
                </div>

                <div class="form-group">
                    <label>Máx préstamos</label>
                    <input type="number"
                           name="max_prestamos"
                           value="3">
                </div>

                <div class="form-group">
                    <label>Categoría</label>

                    <select name="categoria_id" required>
                        <option value="">
                            Selecciona una categoría
                        </option>

                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id }}">
                                {{ $categoria->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn-primary">
                    Crear libro
                </button>
            </form>

        </div>
    </main>
</div>

@endsection