<aside class="admin-sidebar">

    <div class="sidebar-title">
        Panel Admin
    </div>

    <nav class="sidebar-nav">
        <a href="{{ route('admin.dashboard') }}"
            class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            Dashboard
        </a>

        <a href="{{ route('admin.libros.index') }}"
        class="{{ request()->routeIs('admin.libros.*') ? 'active' : '' }}">
            Libros
        </a>
        <a href="{{ route('admin.categorias.index') }}">
            Categorías
        </a>
        <a href="{{ route('admin.ejemplares.index') }}">
            Ejemplares
        </a>
        <a href="{{ route('admin.reservas.index') }}">
            Reservas
        </a>
        <a href="{{ route('admin.resenas.index') }}">
            Reseñas
        </a>
        <a href="{{ route('admin.usuarios.index') }}">
            Usuarios
        </a>

        {{-- <hr>
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
            Cerrar sesión
        </a> --}}
    </nav>

</aside>