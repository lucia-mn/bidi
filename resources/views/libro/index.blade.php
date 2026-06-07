<h1>Listado de Libros</h1>

@foreach($libros as $libro)
    <p>
        {{ $libro->titulo }} - {{ $libro->autor }}
    </p>
@endforeach