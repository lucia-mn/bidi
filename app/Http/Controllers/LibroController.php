<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Libro;
use App\Models\Reserva;
use App\Models\Ejemplar;
use Carbon\Carbon;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use App\Models\Categoria;

class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    // public function index()
    // {
    //     $libros = Libro::with('categoria')->get();

    //     return view('libros.index', compact('libros'));
    // }

    // admin libro vista index
    public function index()
    {
        $libros = Libro::latest()->paginate(10);

        return view('admin.libros.index', compact('libros'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::orderBy('nombre')->get();

        return view('admin.libros.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validaciones
        $request->validate([
            'titulo' => 'required|string|max:255',
            'autor' => 'required|string|max:255',
            'isbn' => 'required|string|max:50|unique:libros,isbn',
            'descripcion' => 'nullable|string',
            'genero' => 'nullable|string|max:100',
            'idioma' => 'nullable|string|max:50',
            'anio_publicacion' => 'nullable|integer|min:0|max:2026',
            'clasificacion_edad' => 'required|in:infantil,juvenil,adulto',
            'max_prestamos' => 'required|integer|min:1',
            'categoria_id' => 'required|exists:categorias,id',
            'portada' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'archivo_pdf' => 'nullable|mimes:pdf|max:20000',
        ], [
            // Mensajes de error personalizados
            'isbn.unique' => 'Este número de ISBN ya se encuentra registrado en la biblioteca',
            'isbn.required' => 'El campo ISBN es obligatorio',
        ]);

        // portada cloudianry
        $portadaUrl = null;

        if ($request->hasFile('portada')) {
            $portadaUrl = Cloudinary::upload(
                $request->file('portada')->getRealPath(),
                [
                    'folder' => 'biblioteca/portadas'
                ]
            )->getSecurePath();
        }

        // pdf
        $pdfUrl = null;

        if ($request->hasFile('archivo_pdf')) {
            $pdfUrl = Cloudinary::uploadFile(
                $request->file('archivo_pdf')->getRealPath(),
                [
                    'folder' => 'biblioteca/pdfs',
                    'resource_type' => 'raw'
                ]
            )->getSecurePath();
        }

        // guardar bd
        $libro = Libro::create([
            'titulo' => $request->titulo,
            'autor' => $request->autor,
            'isbn' => $request->isbn,
            'descripcion' => $request->descripcion,
            'genero' => $request->genero,
            'idioma' => $request->idioma,
            'anio_publicacion' => $request->anio_publicacion,
            'portada' => $portadaUrl,
            'archivo_pdf' => $pdfUrl,
            'clasificacion_edad' => $request->clasificacion_edad,
            'max_prestamos' => $request->max_prestamos,
            'categoria_id' => $request->categoria_id,
        ]);

        // ejemplares
        for ($i = 1; $i <= $request->max_prestamos; $i++) {
            Ejemplar::create([
                'libro_id' => $libro->id,
                'codigo' => 'EJ-' . $libro->id . '-' . $i,
            ]);
        }

        // redireccion
        return redirect()
            ->route('admin.libros.index')
            ->with('success', 'Libro creado correctamente');
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

        // ver reseñas
        $resenas = $libro->resenas()->with('user')->latest()->get();
        $mediaPuntuacion = $libro->resenas()->avg('puntuacion');

        return view(
            'libro.show',
            compact(
                'libro',
                'disponibles',
                'proximaDisponibilidad',
                'resenas',
                'mediaPuntuacion'
            )
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Libro $libro)
    {
        $categorias = Categoria::orderBy('nombre')->get();

        return view('admin.libros.edit', compact('libro', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Libro $libro)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'autor' => 'required|string|max:255',
            'isbn' => 'required|string|max:50|unique:libros,isbn,' . $libro->id,
            'descripcion' => 'nullable|string',
            'genero' => 'nullable|string|max:100',
            'idioma' => 'nullable|string|max:50',
            'anio_publicacion' => 'nullable|integer',
            'clasificacion_edad' => 'required|in:infantil,juvenil,adulto',
            'max_prestamos' => 'required|integer|min:1',
            'categoria_id' => 'required|exists:categorias,id',
            'portada' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'archivo_pdf' => 'nullable|mimes:pdf|max:20000',
        ], [
            'isbn.unique' => 'Este número de ISBN ya está asignado a otro libro',
        ]);

        $portadaUrl = $libro->portada;
        $pdfUrl = $libro->archivo_pdf;

        if ($request->hasFile('portada')) {
            $portadaUrl = Cloudinary::upload(
                $request->file('portada')->getRealPath(),
                ['folder' => 'biblioteca/portadas']
            )->getSecurePath();
        }

        if ($request->hasFile('archivo_pdf')) {
            $pdfUrl = Cloudinary::uploadFile(
                $request->file('archivo_pdf')->getRealPath(),
                [
                    'folder' => 'biblioteca/pdfs',
                    'resource_type' => 'raw'
                ]
            )->getSecurePath();
        }

        // sincronizar ejemplares
        $actuales = $libro->ejemplares()->count();
        $deseados = $request->max_prestamos;

        if ($deseados > $actuales) {
            for ($i = $actuales + 1; $i <= $deseados; $i++) {
                Ejemplar::create([
                    'libro_id' => $libro->id,
                    'codigo' => 'EJ-' . $libro->id . '-' . $i,
                ]);
            }
        }

        $libro->update([
            'titulo' => $request->titulo,
            'autor' => $request->autor,
            'isbn' => $request->isbn,
            'descripcion' => $request->descripcion,
            'genero' => $request->genero,
            'idioma' => $request->idioma,
            'anio_publicacion' => $request->anio_publicacion,
            'portada' => $portadaUrl,
            'archivo_pdf' => $pdfUrl,
            'clasificacion_edad' => $request->clasificacion_edad,
            'max_prestamos' => $request->max_prestamos,
            'categoria_id' => $request->categoria_id,
        ]);

        return redirect()->route('admin.libros.index')
            ->with('success', 'Libro actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $libro = Libro::findOrFail($id);

        // libros landing que no se pueden borrar
        if ($libro->id <= 17) {
            return redirect()->back()->with('error', 'Este libro no se puede eliminar :)');
        }

        $libro->delete();

        return redirect()->route('admin.libros.index')
            ->with('success', 'Libro eliminado correctamente.');
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
        $hoy = Carbon::now()->startOfDay();

        $reservas = Reserva::with('libro')
            ->where('user_id', Auth::id())
            ->where('estado', 'activa')
            ->orderBy('fecha_inicio')
            ->get()
            ->map(function ($reserva) use ($hoy) {
                $inicio = Carbon::parse($reserva->fecha_inicio)->startOfDay();
                $fin = Carbon::parse($reserva->fecha_fin)->endOfDay();

                $reserva->esta_en_fecha = $hoy->between($inicio, $fin);
                $reserva->estado_usuario = $hoy->lt($inicio) ? 'pendiente' : 'activa';

                return $reserva;
            });

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


    // lector pdf
    public function lector(Libro $libro)
    {
        $hoy = Carbon::now()->startOfDay();

        $tieneAcceso = Reserva::where('user_id', Auth::id())
            ->where('libro_id', $libro->id)
            ->where('estado', 'activa')
            ->where('fecha_inicio', '<=', $hoy)
            ->where('fecha_fin', '>=', $hoy)
            ->exists();

        if (!$tieneAcceso) {
            return redirect()->route('libro.misLibros')->with('error', 'Aún no tienes acceso a la lectura de este libro');
        }

        return view('libro.lector', compact('libro'));
    }
}