<h1>Mis libros</h1>

@if($reservas->count() == 0)
    <p>No tienes libros reservados</p>
@else
    @foreach($reservas as $reserva)
        <div>
            <h3>{{ $reserva->libro->titulo }}</h3>
            <p>Hasta: {{ $reserva->fecha_fin }}</p>
        </div>
    @endforeach
@endif