@extends('layouts.app')

@section('content')

<div class="admin-layout">

    @include('layouts.partials.admin-sidebar')

    <main class="admin-content">

        <div class="header-section">
            <h1>Editar libro</h1>
        </div>

        <div class="card">

            <form action="{{ route('admin.libros.update', $libro->id) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Título</label>
                    <input type="text" name="titulo" value="{{ $libro->titulo }}">
                </div>

                <div class="form-group">
                    <label>Autor</label>
                    <input type="text" name="autor" value="{{ $libro->autor }}">
                </div>

                <div class="form-group">
                    <label>ISBN</label>
                    <input type="text" name="isbn" value="{{ $libro->isbn }}">
                </div>

                <div class="form-group">
                    <label>Descripción</label>
                    <textarea name="descripcion">{{ $libro->descripcion }}</textarea>
                </div>

                <div class="form-group">
                    <label>Género</label>
                    <input type="text" name="genero" value="{{ $libro->genero }}">
                </div>

                <div class="form-group">
                    <label>Idioma</label>
                    <input type="text" name="idioma" value="{{ $libro->idioma }}">
                </div>

                <div class="form-group">
                    <label>Año publicación</label>
                    <input type="number" name="anio_publicacion" value="{{ $libro->anio_publicacion }}">
                </div>

                <div class="form-group">
                    <label>Categoría</label>
                    <select name="categoria_id">

                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id }}"
                                {{ $libro->categoria_id == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->nombre }}
                            </option>
                        @endforeach

                    </select>
                </div>

                <div class="form-group">
                    <label>Portada actual</label>
                    @if($libro->portada)
                        <img src="{{ $libro->portada }}" style="width:80px;">
                    @endif
                    <input type="file" name="portada">
                </div>

                <div class="form-group">
                    <label>PDF actual</label>
                    @if($libro->archivo_pdf)
                        <a href="{{ $libro->archivo_pdf }}" target="_blank">Ver PDF</a>
                    @endif
                    <input type="file" name="archivo_pdf">
                </div>

                <div class="form-group">
                    <label>Edad</label>
                    <select name="clasificacion_edad">
                        <option value="infantil" {{ $libro->clasificacion_edad == 'infantil' ? 'selected' : '' }}>Infantil</option>
                        <option value="juvenil" {{ $libro->clasificacion_edad == 'juvenil' ? 'selected' : '' }}>Juvenil</option>
                        <option value="adulto" {{ $libro->clasificacion_edad == 'adulto' ? 'selected' : '' }}>Adulto</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Máx préstamos. Nota: no poner menos de los que ya hay, solo añadir</label>
                    <input type="number" name="max_prestamos" value="{{ $libro->max_prestamos }}">
                </div>

                <button type="submit" class="btn-primary">
                    Actualizar libro
                </button>

            </form>

            {{-- no eliminar los libros de id del 1 al 17 --}}
            @if($libro->id > 17)
                <form action="{{ route('admin.libros.destroy', $libro->id) }}"
                      method="POST"
                      onsubmit="return confirm('¿Seguro que quieres borrar este libro?')">

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn-borrar">
                        Eliminar libro
                    </button>
                </form>
            @else
                <p class="bloqueado">Este libro está protegido, no se puede eliminar</p>
            @endif

        </div>
    </main>

</div>

@endsection