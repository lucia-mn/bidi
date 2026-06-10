<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ejemplar;

class EjemplarController extends Controller
{
    public function index()
    {
        $ejemplares = Ejemplar::with('libro')->paginate(10);

        return view('admin.ejemplares.index', compact('ejemplares'));
    }

    public function edit(Ejemplar $ejemplar)
    {
        return view('admin.ejemplares.edit', compact('ejemplares'));
    }

    public function update(Request $request, Ejemplar $ejemplar)
    {
        $request->validate([
            'codigo' => 'required|string|max:255',
        ]);

        $ejemplar->update([
            'codigo' => $request->codigo,
        ]);

        return redirect()->route('admin.ejemplares.index')
            ->with('success', 'Ejemplar actualizado');
    }
}
