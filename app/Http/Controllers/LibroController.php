<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Libro;
use App\Models\Reserva;
use App\Models\Ejemplar;
use Carbon\Carbon;

class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $libros = Libro::with('categoria')->get();

        return view('libros.index', compact('libros'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    // vistas paginas libros individuales
    public function show(Libro $libro)
    {
        $disponibles = Ejemplar::where('libro_id', $libro->id)
            ->whereDoesntHave('reservas', function ($q) {
                $q->where('estado', 'activa');
            })
            ->count();

        $proximaDisponibilidad = null;

        if ($disponibles <= 0) {

            $proximaDisponibilidad = Reserva::where('libro_id', $libro->id)
                ->where('estado', 'activa')
                ->orderBy('fecha_fin')
                ->first();
        }

        return view(
            'libro.show',
            compact(
                'libro',
                'disponibles',
                'proximaDisponibilidad'
            )
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    // catalogo, devuelve todos los libros
    public function catalogo()
    {
        $libros = Libro::with('categoria')->get();

        return view('catalogo', compact('libros'));
    }

    // guardar reserva
    public function reservar(Request $request, Libro $libro)
    {
        // iniciar sesion obligatorio
        if (!Auth::check()) {

            return redirect()
                ->route('login')
                ->with('error', 'Debes iniciar sesión para reservar');
        }

        $fechaInicio = Carbon::parse($request->fecha_inicio);
        $fechaFin = (clone $fechaInicio)->addDays(14);

        // evitar duplicado usuario-libro
        $yaTiene = Reserva::where('user_id', Auth::id())
            ->where('libro_id', $libro->id)
            ->where('estado', 'activa')
            ->exists();

        if ($yaTiene) {

            return back()->with(
                'error',
                'Ya tienes este libro reservado'
            );
        }

        // buscar ejemplar libre en ese rango
        $ejemplar = Ejemplar::where('libro_id', $libro->id)
            ->whereDoesntHave('reservas', function ($q) use ($fechaInicio, $fechaFin) {

                $q->where('estado', 'activa')
                    ->where(function ($q2) use ($fechaInicio, $fechaFin) {

                        $q2->whereBetween('fecha_inicio', [$fechaInicio, $fechaFin])
                            ->orWhereBetween('fecha_fin', [$fechaInicio, $fechaFin]);
                    });
            })
            ->first();

        if (!$ejemplar) {

            return back()->with(
                'error',
                'No hay ejemplares disponibles en esas fechas'
            );
        }

        Reserva::create([
            'user_id' => Auth::id(),
            'libro_id' => $libro->id,
            'ejemplar_id' => $ejemplar->id,
            'fecha_inicio' => $fechaInicio,
            'fecha_fin' => $fechaFin,
            'estado' => 'activa'
        ]);

        return redirect()
            ->route('libro.show', $libro)
            ->with(
                'success',
                'Reserva creada correctamente'
            );
    }

    // mostrar pag reserva
    public function formReserva(Libro $libro)
    {
        $reservas = Reserva::where('libro_id', $libro->id)
            ->where('estado', 'activa')
            ->get();

        $ejemplaresTotales = Ejemplar::where('libro_id', $libro->id)
            ->count();

        $disponibles = Ejemplar::where('libro_id', $libro->id)
            ->whereDoesntHave('reservas', function ($q) {
                $q->where('estado', 'activa');
            })
            ->count();

        return view(
            'libro.reservar',
            compact(
                'libro',
                'reservas',
                'disponibles',
                'ejemplaresTotales'
            )
        );
    }

    // menu pag mis libros
    // libros reservados por el usuario
    public function misLibros()
    {
        $reservas = Reserva::with('libro')
            ->where('user_id', Auth::id())
            ->where('estado', 'activa')
            ->orderBy('fecha_inicio')
            ->get();

        return view('libro.mis-libros', compact('reservas'));
    }

    // cancelar reservas en mis libros
    public function cancelarReserva(Reserva $reserva)
    {
        if ($reserva->user_id != Auth::id()) {
            abort(403);
        }

        $reserva->estado = 'cancelada';
        $reserva->save();

        return back()->with(
            'success',
            'Reserva cancelada correctamente'
        );
    }
}