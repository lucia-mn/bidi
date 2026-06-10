<div class="header">

    <div class="logo">
        <a href="{{ url('/') }}">
            <img src="{{ asset('img/logo-header.svg') }}" alt="logo">
        </a>
    </div>

    <div class="titulo">
        <span>bi</span>blioteca <span>di</span>gital
    </div>

    <button class="menu-toggle" id="menuToggle">
        ☰
    </button>

    <div class="botones-header">

        {{-- visible --}}
        <a href="{{ route('catalogo') }}">Catálogo</a>

        @auth

            {{-- admin --}}
            @if(auth()->user()->rol === 'administrador')

                <a href="{{ route('admin.dashboard') }}">Dashboard</a>

            @else

                {{-- user --}}
                <a href="{{ route('mis-libros') }}">Mis libros</a>
                {{-- <a href="{{ route('reservas.index') }}">Reservas</a> --}}

            @endif

            {{-- perfiles --}}
            <a href="{{ route('profile.edit') }}">Perfil</a>

            {{-- logouts --}}
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit">Salir</button>
            </form>

        @else

            {{-- invitado --}}
            <a href="{{ route('login') }}">Entrar</a>

            @if (Route::has('register'))
                <a href="{{ route('register') }}">Registro</a>
            @endif

        @endauth

    </div>
</div>