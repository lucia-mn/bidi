<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Libro extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'titulo',
        'autor',
        'isbn',
        'descripcion',
        'genero',
        'idioma',
        'anio_publicacion',
        'portada',
        'archivo_pdf',
        'clasificacion_edad',
        'max_prestamos',
        'categoria_id',
    ];

    // relaciones de otars entiedades con libro
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }

    public function resenas()
    {
        return $this->hasMany(Resena::class);
    }

    public function ejemplares()
    {
        return $this->hasMany(Ejemplar::class);
    }

}