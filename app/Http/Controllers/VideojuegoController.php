<?php

namespace App\Http\Controllers;

use App\Models\Videojuego;
use App\Models\Categoria;
use Illuminate\Http\Request;

class VideojuegoController extends Controller
{
    public function index()
    {
        $videojuegos = Videojuego::with(['categoria', 'ventas.cliente'])->get();
        $categorias = Categoria::all();
        return view('videojuegos.index', compact('videojuegos', 'categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:150|unique:videojuegos,nombre',
            'categoria_id' => 'required|exists:categorias,id',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'sinopsis' => 'required|string',
            'imagen_url' => 'required|url',
        ], [
            'nombre.unique' => 'No se permiten videojuegos con nombre duplicado.'
        ]);

        Videojuego::create($request->all());

        return back()->with('success', 'Videojuego agregado exitosamente al catálogo.');
    }

    public function destroy($id)
    {
        $juego = Videojuego::with('ventas')->findOrFail($id);

        if ($juego->ventas()->count() > 0) {
            return back()->with('error', 'Acción denegada: No se puede eliminar un videojuego con ventas registradas.');
        }

        $juego->delete();
        return back()->with('success', 'Videojuego eliminado del inventario.');
    }
}