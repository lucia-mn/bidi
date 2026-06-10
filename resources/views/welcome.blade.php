@extends('layouts.app')

@section('title', 'Inicio - Bidi')

@section('content')

    @include('components.subheader')

    <script>
        document.addEventListener('DOMContentLoaded', () => {

            const boton = document.getElementById('menuToggle');
            const menu = document.querySelector('.botones-header');

            boton.addEventListener('click', () => {
                menu.classList.toggle('active');
            });

        });
    </script>

    <!-- seccion hero -->
    <div class="hero">
        <div class="hero-texto">
            <div class="hero-s1">
                <h1>BUSCA TU LIBRO</h1>
                <h2>Leer es viajar sin moverse del sitio</h2>
            </div>

            <div class="hero-s2">
                <!-- buscador -->
                <form action="{{ route('catalogo') }}" method="GET" class="formulario-buscar">
                    <input type="text" name="buscar" placeholder="Buscar...">

                    <button type="submit" class="lupa">
                        <img src="{{ asset('img/buscar.svg') }}" alt="buscar">
                    </button>
                </form>
            </div>

            <div class="hero-s3">
                <a href="{{ route('catalogo') }}" class="btn-catalogo">
                    Ver el catálogo
                </a>
                <!-- <button>Ver el catálogo</button>
                <h3>¿Ya tienes una cuenta? Inicia sesión</h3> -->
            </div>
        </div>
    </div>


    <!-- seccion libros hero-->
    <div class="hero-libros">
        <button class="flecha-izq">❮</button>

        @foreach($librosDestacados as $libro)
            <div class="libro">
                <a href="{{ route('libro.show', $libro) }}">
                    <img src="{{ asset('img/' . $libro->portada) }}"
                        alt="{{ $libro->titulo }}"
                        class="libro-img">

                    <p class="libro-titulo">{{ $libro->titulo }}</p>
                    <p class="libro-autor">{{ $libro->autor }}</p>

                <div class="libro-estrellas">★★★★★</div>
                </a>
            </div>
        @endforeach

        <button class="flecha-der">❯</button>
    </div>

    
    <!-- seccion novedades -->
    <div class="bg-novedades">
    <h2 class="titulo-novedades">Novedades</h2>

    <div class="novedades">
        <button class="flecha-izq2">❮</button>

        @foreach($novedades as $libro)
            <div class="libro2">
                <a href="{{ route('libro.show', $libro) }}">
                    <img src="{{ asset('img/' . $libro->portada) }}"
                        alt="{{ $libro->titulo }}"
                        class="libro2-img">

                    <p class="libro-titulo">{{ $libro->titulo }}</p>
                    <p class="libro-autor">{{ $libro->autor }}</p>

                    <div class="libro-estrellas">★★★★★</div>
                </a>
            </div>
        @endforeach

        <button class="flecha-der2">❯</button>
    </div>


    <!-- seccion mas-leidos -->
    <div class="bg-mas-leidos">
    <h2 class="titulo-mas-leidos">Más leidos</h2>

    <div class="mas-leidos">
        <button class="flecha-izq2">❮</button>

        @foreach($masLeidos as $libro)
            <div class="libro2">
                <a href="{{ route('libro.show', $libro) }}">
                    <img src="{{ asset('img/' . $libro->portada) }}"
                        alt="{{ $libro->titulo }}"
                        class="libro2-img">

                    <p class="libro-titulo">{{ $libro->titulo }}</p>
                    <p class="libro-autor">{{ $libro->autor }}</p>

                    <div class="libro-estrellas">★★★★★</div>
                </a>
            </div>
        @endforeach

        <button class="flecha-der2">❯</button>
    </div>


    <!-- seccion descubre -->
    <div class="descubre">
        <div class="descubre-texto">
            <h2>Descubre nuestras <span>novedades</span><br>
            Ahora puedes valorar tus <br>lecturas:</h2>
            <p>¡deja tu comentario y tu puntuación <br>en cada libro!</p>
        </div>
        <div class="bg-libro-descubre"> 
            <div class="libro-descubre-texto">
            <p>Una historia intensa y elegante.  Me encantó cómo Anne Rice humaniza 
            a los vampiros y les da emociones 
            tan reales.</p>
        </div>
            <img src="{{ asset('img/entrevista-vampiro.jpg') }}" alt="Entrevista con el Vampiro" class="libro-descubre">
            <!-- <img src="img/entrevista-vampiro.jpg" alt="Entrevista con el Vampiro" class="libro-descubre"> -->
        </div>
    </div>


    <!-- seccion recomendados -->
    <div class="bg-recomendados">
    <h2 class="titulo-recomendados">Recomendaciones</h2>

    <div class="recomendados">
        <button class="flecha-izq">❮</button>

        @foreach($recomendados as $libro)
            <div class="libro2">
                <a href="{{ route('libro.show', $libro) }}">
                    <img src="{{ asset('img/' . $libro->portada) }}"
                        alt="{{ $libro->titulo }}"
                        class="libro2-img">

                    <p class="libro-titulo">{{ $libro->titulo }}</p>
                    <p class="libro-autor">{{ $libro->autor }}</p>

                    <div class="libro-estrellas">★★★★★</div>
                </a>
            </div>
        @endforeach

        <button class="flecha-der">❯</button>
    </div>

@endsection
