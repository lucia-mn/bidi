<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dibi - Biblioteca Digital')</title>

    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>

<body>

    {{-- header --}}
    @include('components.header')

    {{-- paginas con diferente contenido --}}
    <main>
        @yield('content')
    </main>

    {{-- footer --}}
    @include('components.footer')

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const boton = document.getElementById('menuToggle');
            const menu = document.querySelector('.botones-header');

            if (!boton || !menu) return;

            boton.addEventListener('click', function () {
                menu.classList.toggle('active');
            });

        });
    </script>

    {{-- js en public/js menu --}}
    <script src="{{ asset('js/menu.js') }}" defer></script>

    @yield('scripts')

</body>
</html>