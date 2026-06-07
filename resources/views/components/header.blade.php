<div class="header">

    <div class="logo">
        <a href="{{ url('/') }}">
            <img src="{{ asset('img/logo-header.svg') }}" alt="logo-header">
        </a>
    </div>

    <div class="titulo">
        <span>bi</span>blioteca <span>di</span>gital
    </div>

    <div class="botones-header">

        {{-- no log --}}
        @guest
            <a href="{{ route('login') }}">Entrar</a>

            @if (Route::has('register'))
                <a href="{{ route('register') }}">Regístrate</a>
            @endif
        @endguest


        {{-- logueados --}}
        @auth

            @if(Auth::user()->rol === 'administrador')
                <a href="{{ url('/dashboard') }}">Dashboard</a>
            @endif

            @if(Auth::user()->rol === 'usuario')
                <a href="{{ route('mis.libros') }}">Mis libros</a>
            @endif

            <a href="{{ route('profile.edit') }}">Mi perfil</a>

            {{-- logout --}}
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="logout-btn">
                    Cerrar sesión
                </button>
            </form>

        @endauth

    </div>

</div>