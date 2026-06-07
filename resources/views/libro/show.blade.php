@extends('layouts.app')

@section('title', $libro->titulo)

@section('content')

     @include('components.subheader')

     <div class="detalle-libro">
          <div class="detalle-portada">
               <img src="{{ asset('img/' . $libro->portada) }}" alt="{{ $libro->titulo }}">
          </div>

          <div class="detalle-info">
               <h1>{{ $libro->titulo }}</h1>

               <div class="estrellas">
                    ★★★★★
               </div>

               <p><strong>Autor:</strong> {{ $libro->autor }}</p>
               <p><strong>Categoría:</strong> {{ $libro->categoria->nombre }}</p>
               <p><strong>Año:</strong> {{ $libro->anio_publicacion }}</p>
               <p><strong>Idioma:</strong> {{ $libro->idioma }}</p>
               <p><strong>ISBN:</strong> {{ $libro->isbn }}</p>
               <p><strong>Clasificación:</strong> {{ $libro->clasificacion_edad }}</p>

               <!-- disponibilidad -->
               @if($disponibles > 0)
                    <p class="disponible">
                         Disponibles: {{ $disponibles }} de {{ $libro->max_prestamos }}
                    </p>

                    <!-- boton reservar -->
                    <a href="{{ route('libros.reservar.form', $libro) }}" class="btn-reservar">
                         Reservar libro
                    </a>

               @else

                    <p class="no-disponible">
                         No hay ejemplares disponibles actualmente.
                    </p>
                    @if($proximaDisponibilidad)
                         <p class="proxima-fecha">
                              Próxima disponibilidad:
                              {{ \Carbon\Carbon::parse($proximaDisponibilidad->fecha_fin)->format('d/m/Y') }}
                         </p>
                    @endif
               @endif
          </div>
     </div>

     <div class="descripcion-libro">
          <h2>Descripción</h2>
          <p>{{ $libro->descripcion }}</p>
     </div>

     <div class="reseñas-libro">
          <h2>Reseñas</h2
          <p>Todavía no hay reseñas para este libro.</p>
     </div>

@endsection