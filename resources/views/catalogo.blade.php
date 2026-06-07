@extends('layouts.app')

@section('title', 'Catálogo de libros')

@section('content')

    @include('components.subheader')

    <h1 class="catalogo-titulo">Catálogo</h1>

    <!-- buscador -->
    <div class="cat-buscar">
        <form action="{{ route('catalogo') }}" method="GET" class="formulario-buscar2">
            <input type="text" name="buscar" placeholder="Buscar libros..."
                value="{{ request('buscar') }}">

            <button type="submit" class="lupa">Buscar</button>
        </form>
    </div>

    <div class="catalogo">
        @forelse($libros as $libro)

            <div class="libro-card">
                <a href="{{ route('libro.show', $libro) }}">

                    <img src="{{ asset('img/' . $libro->portada) }}"
                        alt="{{ $libro->titulo }}"
                        style="width:120px">

                    <h3>{{ $libro->titulo }}</h3>
                    <p>{{ $libro->autor }}</p>
                    <p>{{ $libro->categoria->nombre ?? 'Sin categoría' }}</p>
                </a>
            </div>

        @empty
            <p>No hay libros en esta categoría</p>
        @endforelse

    </div>

@endsection