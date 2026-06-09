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
        <a href="#">
            Categorías
        </a>
        <a href="#">
            Ejemplares
        </a>
        <a href="#">
            Reservas
        </a>
        <a href="#">
            Reseñas
        </a>
        <a href="#">
            Usuarios
        </a>

        {{-- <hr>
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
            Cerrar sesión
        </a> --}}
    </nav>

</aside>