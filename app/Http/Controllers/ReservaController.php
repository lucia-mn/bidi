<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva;

class ReservaController extends Controller
{
    // solo se pueden listar/ ver en el panel de admin en index
    public function index()
    {
        $reservas = Reserva::with(['libro', 'user', 'ejemplar'])
            ->latest()
            ->paginate(10);

        return view('admin.reservas.index', compact('reservas'));
    }

    // solo se eliminan desde el panel del admin
    public function destroy(Reserva $reserva)
    {
        $reserva->delete();

        return back()->with('success', 'Reserva eliminada correctamente');
    }
}
