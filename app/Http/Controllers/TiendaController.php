<?php

namespace App\Http\Controllers;

use App\Models\Videojuego;
use App\Models\Categoria;
use App\Models\Cliente;
use Illuminate\Http\Request;

class TiendaController extends Controller
{
    public function index(Request $request)
    {
        $categoriaId = $request->get('categoria');
        $query = Videojuego::with('categoria');

        if ($categoriaId) {
            $query->where('categoria_id', $categoriaId);
        }

        $videojuegos = $query->latest()->get();
        $categorias = Categoria::all();
        $clientes = Cliente::all();

        return view('tienda.index', compact('videojuegos', 'categorias', 'clientes'));
    }
}