<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ejemplar extends Model
{

    protected $table = 'ejemplares'; // habia un problema y es que laravel hacia el plural como ejemplars

    protected $fillable = [
        'libro_id',
        'codigo'
    ];

    public function libro()
    {
        return $this->belongsTo(Libro::class);
    }

    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }
}