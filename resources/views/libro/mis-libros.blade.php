@extends('layouts.app')

@section('title', 'Mis libros')

@section('content')

<div class="mis-libros">

    <h1>Mis libros</h1>

    @if($reservas->isEmpty())
        <p>No tienes libros reservados.</p>

    @else

        @foreach($reservas as $reserva)

            <div class="libro-card">

                <img
                    src="{{ asset('img/' . $reserva->libro->portada) }}"
                    alt="{{ $reserva->libro->titulo }}"
                    class="portada-libro">

                <div class="info-libro">
                    <h2>{{ $reserva->libro->titulo }}</h2>
                    <p>{{ $reserva->libro->autor }}</p>

                    <p>
                        Del {{ $reserva->fecha_inicio }}
                        al {{ $reserva->fecha_fin }}
                    </p>

                    <div class="btn-reservas">
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

            <p class="estado">
                Estado: {{ ucfirst($reserva->estado) }}
            </p>
        @endforeach

    @endif

</div>

@endsection