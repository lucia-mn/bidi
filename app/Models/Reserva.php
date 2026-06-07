<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $fillable = [
        'user_id',
        'libro_id',
        'ejemplar_id',
        'fecha_inicio',
        'fecha_fin',
        'estado'
    ];

    // ejemplares para el calenadario
    public function ejemplar()
    {
        return $this->belongsTo(Ejemplar::class);
    }


    // relaciones otras entiedades con reverva
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function libro()
    {
        return $this->belongsTo(Libro::class);
    }
}
