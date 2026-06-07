<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Models\Categoria;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // (lading) a la misma página welcome, le paso 4 listas de libros
    public function index()
    {
        // $librosDestacados = Libro::latest()->take(4)->get();
        $librosDestacados = Libro::whereIn('id', [1,2,3,4])->get();

        // $novedades = Libro::orderBy('created_at', 'desc')->take(5)->get();
        $novedades = Libro::whereIn('id', [5,6,7,8,9])->get();

        // $masLeidos = Libro::inRandomOrder()->take(4)->get();
        $masLeidos = Libro::whereIn('id', [10,11,12,13])->get();

        $descubre = Libro::whereIn('id', [14])->get();

        // $recomendados = Libro::inRandomOrder()->take(5)->get();
        $recomendados = Libro::whereIn('id', [15,11,16,8,17])->get();

        // categorias
        $categorias = Categoria::all();


        return view('welcome', compact(
            'librosDestacados',
            'novedades',
            'descubre',
            'masLeidos',
            'recomendados',
            'categorias'
        ));  
    }


    // pagina del catalogo
    public function catalogo(Request $request)
    {
        $categorias = Categoria::all();

        $libros = Libro::with('categoria');

        // filtro categoria
        if ($request->has('categoria')) {
            $libros->where('categoria_id', $request->categoria);
        }

        // buscador
        if ($request->has('buscar')) {
            $libros->where(function ($q) use ($request) {
                $q->where('titulo', 'like', '%' . $request->buscar . '%')
                ->orWhere('autor', 'like', '%' . $request->buscar . '%');
            });
        }

        $libros = $libros->get();


        return view('catalogo', compact('libros', 'categorias'));
    }

}
