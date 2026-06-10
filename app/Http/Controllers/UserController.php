<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Reserva;
use App\Models\Resena;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);

        return view('admin.usuarios.index', compact('users'));
    }

    public function destroy(User $user)
    {
        // para no borra al admin
        if ($user->id === 1) {
            return back()->with('error', 'No puedes eliminar al admin (a ti mismo)');
        }

        // cancelar reservas activas
        Reserva::where('user_id', $user->id)
            ->where('estado', 'activa')
            ->update(['estado' => 'cancelada']);

        // borrar reservas restantes
        Reserva::where('user_id', $user->id)->delete();

        // borrar resena
        Resena::where('user_id', $user->id)->delete();

        // eliminar user
        $user->delete();

        return back()->with('success', 'Usuario eliminado correctamente');
    }
}
