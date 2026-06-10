@extends('layouts.app')

@section('title', 'Mis libros')

@section('content')

<div class="mis-libros">

    <h1>Mis libros</h1>

    @if($reservas->isEmpty())
        <p>No tienes libros reservados</p>

    @else

        @foreach($reservas as $reserva)

            <div class="libro-card">

                <img 
                    src="{{ str_starts_with($reserva->libro->portada, 'http') ? 
                        $reserva->libro->portada : asset('img/' . $reserva->libro->portada) }}" 
                        alt="{{ $reserva->libro->titulo }}" 
                        class="portada-libro">

                {{-- info del libro --}}
                <div class="info-libro">
                    <h2>{{ $reserva->libro->titulo }}</h2>
                    <p>{{ $reserva->libro->autor }}</p>

                    <p>
                        Del {{ $reserva->fecha_inicio }}
                        al {{ $reserva->fecha_fin }}
                    </p>

                    {{-- formulario de reseñas --}}
                    <form action="{{ route('resenas.store', $reserva->libro) }}" method="POST" class="reseña-form">
                        @csrf

                        <label>Valoración (1-5)</label>
                        <input type="number" name="puntuacion" min="1" max="5" required>

                        <label>Comentario</label>
                        <textarea name="comentario" required></textarea>

                        <button type="submit">Enviar reseña</button>
                    </form>

                    {{-- botones --}}
                    <div class="btn-reservas">
                        {{-- boton leer --}}
                        <a href="{{ $reserva->libro->archivo_pdf }}" target="_blank">
                            Leer libro
                        </a>

                        {{-- cancelar reserva --}}
                        <form
                            action="{{ route('reservas.cancelar', $reserva) }}"
                            method="POST">

                            @csrf
                            @method('DELETE')

                            <button type="submit">
                                Cancelar reserva
                            </button>
                        </form>
                    </div>
                </div>

            </div>

            {{-- estado del libro, ¿hay ejemplares disponibles? --}}
            <p class="estado">
                Estado: {{ ucfirst($reserva->estado) }}
            </p>
        @endforeach

    @endif

</div>

@endsection