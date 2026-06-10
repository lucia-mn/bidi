<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resena;
use App\Models\Libro;

class ResenaController extends Controller
{
    public function index()
    {
        $resenas = Resena::with(['user', 'libro'])
            ->latest()
            ->paginate(10);

        return view('admin.resenas.index', compact('resenas'));
    }

    public function destroy(Resena $resena)
    {
        $resena->delete();

        return back()->with('success', 'Reseña eliminada');
    }

    public function store(Request $request, Libro $libro)
    {
        $request->validate([
            'puntuacion' => 'required|integer|min:1|max:5',
            'comentario' => 'required|string|max:1000',
        ]);

        // no dupicar reseñas
        $yaExiste = Resena::where('user_id', auth()->id())
            ->where('libro_id', $libro->id)
            ->exists();

        if ($yaExiste) {
            return back()->with('error', 'Ya has reseñado este libro');
        }

        Resena::create([
            'user_id' => auth()->id(),
            'libro_id' => $libro->id,
            'puntuacion' => $request->puntuacion,
            'comentario' => $request->comentario,
        ]);

        return back()->with('success', 'Reseña añadida');
    }
}


