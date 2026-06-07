<div class="sub-header">
    <!-- <a href="#">Romance</a>
    <a href="#">Poesía</a>
    <a href="#">Clásicos</a>
    <a href="#">Cuentos</a>
    <a href="#">Historia</a>
    <a href="#">Ciencia ficción</a>
    <a href="#">Terror</a>
    <a href="#">Aventura</a>
    <a href="#">Comedia</a>
    <a href="#">Misterio</a> -->

    @foreach($categorias as $categoria)
        <a href="{{ route('catalogo', ['categoria' => $categoria->id]) }}">
            {{ $categoria->nombre }}
        </a>
    @endforeach
</div>