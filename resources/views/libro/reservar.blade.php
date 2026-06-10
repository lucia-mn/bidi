@extends('layouts.app')

@section('title', 'Reservar libro')

@section('content')

    {{-- mensaje de error --}}
    @if(session('error'))
        <div class="alert-error">
            <strong>Aviso:</strong> {{ session('error') }}
        </div>
    @endif

{{-- empieza el bloque --}}
<div class="pagina-reserva">

    <h1>Reservar libro</h1>

    <h2>{{ $libro->titulo }}</h2>
    <p>{{ $libro->autor }}</p>

    <form action="{{ route('libros.reservar', $libro) }}" method="POST">
        @csrf

        <label>Fecha de inicio:</label>

        <div class="cal-nav">
            <select id="mesSelect"></select>
            <select id="anioSelect"></select>
        </div>

        <div class="calendario">
            <table>
                <thead>
                    <tr>
                        <th>L</th><th>M</th><th>X</th><th>J</th><th>V</th><th>S</th><th>D</th>
                    </tr>
                </thead>
                <tbody id="calBody"></tbody>
            </table>
        </div>

        <input type="hidden" name="fecha_inicio" id="fecha_inicio">

        <p>
            Fecha seleccionada:
            <span id="fechaVista">-</span>
        </p>

        <p>
            Fecha devolución:
            <span id="fecha_fin">-</span>
        </p>

        <p>
            Ejemplares libres:
            <span id="ejemplaresLibres">-</span>
        </p>

        <br><br>

        @if($disponibles > 0)
            <button type="submit" id="btnReservar">
                Confirmar reserva
            </button>
        @else
            <p>No puedes reservar este libro</p>
        @endif

    </form>
</div>
@endsection


@section('scripts')
<script>
window.cerrarPopup = function() {
    const popup = document.getElementById("popupReserva");
    if (popup) {
        popup.style.display = "none";
    }
}

document.addEventListener("DOMContentLoaded", function () {

    const reservas = @json($reservas);

    let hoy = new Date();
    hoy.setHours(0, 0, 0, 0);

    let mes = hoy.getMonth();
    let anio = hoy.getFullYear();

    const calBody = document.getElementById("calBody");
    const fechaInput = document.getElementById("fecha_inicio");
    const fechaVista = document.getElementById("fechaVista");
    const fechaFin = document.getElementById("fecha_fin");

    const mesSelect = document.getElementById("mesSelect");
    const anioSelect = document.getElementById("anioSelect");

    const meses = [
        "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
        "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
    ];

    /* selects */
    meses.forEach((m, i) => {
        let opt = document.createElement("option");
        opt.value = i;
        opt.text = m;
        mesSelect.appendChild(opt);
    });

    for (let a = anio - 5; a <= anio + 5; a++) {
        let opt = document.createElement("option");
        opt.value = a;
        opt.text = a;
        anioSelect.appendChild(opt);
    }

    /* funciones */
    function normalizar(fecha) {
        const f = new Date(fecha);
        f.setHours(0, 0, 0, 0);
        return f.getTime();
    }

    function esPasado(fecha) {
        return normalizar(fecha) < hoy.getTime();
    }

    function ejemplaresOcupadosEnFecha(fecha) {
        let ocupados = 0;
        const dia = normalizar(fecha);

        for (let r of reservas) {
            let inicio = normalizar(r.fecha_inicio);
            let fin = normalizar(r.fecha_fin);

            if (dia >= inicio && dia <= fin) {
                ocupados++;
            }
        }

        return ocupados;
    }

    function hayDisponibilidad(fecha) {
        let ocupados = ejemplaresOcupadosEnFecha(fecha);
        return ocupados < {{ $ejemplaresTotales }};
    }

    /* calendario */
    function pintarCalendario() {
        calBody.innerHTML = "";

        mesSelect.value = mes;
        anioSelect.value = anio;

        let primerDia = new Date(anio, mes, 1).getDay();
        let diasMes = new Date(anio, mes + 1, 0).getDate();

        let fila = document.createElement("tr");

        let inicio = primerDia === 0 ? 7 : primerDia;
        let posicion = 0;

        for (let i = 1; i < inicio; i++) {
            fila.appendChild(document.createElement("td"));
            posicion++;
        }

        for (let dia = 1; dia <= diasMes; dia++) {
            let fecha = new Date(anio, mes, dia);
            fecha.setHours(0, 0, 0, 0);

            let td = document.createElement("td");
            td.textContent = dia;

            const disponible = hayDisponibilidad(fecha);
            const pasado = esPasado(fecha);

            if (!disponible || pasado) {
                td.classList.add("bloqueado");
            } else {
                td.classList.add("disponible");

                td.onclick = () => {
                    document.querySelectorAll(".seleccionado")
                        .forEach(el => el.classList.remove("seleccionado"));

                    td.classList.add("seleccionado");

                    let yyyy = fecha.getFullYear();
                    let mm = String(fecha.getMonth() + 1).padStart(2, '0');
                    let dd = String(fecha.getDate()).padStart(2, '0');
                    
                    let str = `${yyyy}-${mm}-${dd}`;

                    fechaInput.value = str;
                    fechaVista.textContent = str;

                    let fin = new Date(fecha);
                    fin.setDate(fin.getDate() + 14);

                    let finYyyy = fin.getFullYear();
                    let finMm = String(fin.getMonth() + 1).padStart(2, '0');
                    let finDd = String(fin.getDate()).padStart(2, '0');
                    
                    fechaFin.textContent = `${finYyyy}-${finMm}-${finDd}`;

                    let ocupados = ejemplaresOcupadosEnFecha(fecha);

                    const elLibres = document.getElementById("ejemplaresLibres");
                    if (elLibres) {
                        elLibres.textContent = ({{ $ejemplaresTotales }} - ocupados) + " / " + {{ $ejemplaresTotales }};
                    }
                };
            }

            fila.appendChild(td);
            posicion++;

            if (posicion % 7 === 0) {
                calBody.appendChild(fila);
                fila = document.createElement("tr");
            }
        }

        if (fila.children.length > 0) {
            calBody.appendChild(fila);
        }
    }

   /* inputs mes y dia */
    mesSelect.addEventListener("change", e => {
        mes = parseInt(e.target.value);
        pintarCalendario();
    });

    anioSelect.addEventListener("change", e => {
        anio = parseInt(e.target.value);
        pintarCalendario();
    });

    pintarCalendario();

});
</script>
@endsection