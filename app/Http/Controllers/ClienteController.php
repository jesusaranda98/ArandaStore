<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::with('ventas.videojuego')->get();
        return view('clientes.index', compact('clientes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:150',
            'telefono' => 'required|string|max:20|unique:clientes,telefono',
            'email' => 'required|email|max:150|unique:clientes,email',
            'direccion' => 'required|string|max:300',
        ], [
            'email.unique' => 'El correo electrónico ya se encuentra registrado.',
            'telefono.unique' => 'El número de teléfono ya se encuentra registrado.'
        ]);

        Cliente::create($request->all());

        return back()->with('success', '¡Cliente registrado con éxito!');
    }

    public function destroy($id)
    {
        $cliente = Cliente::with('ventas')->findOrFail($id);

        if ($cliente->ventas()->count() > 0) {
            return back()->with('error', 'Acción denegada: No se puede eliminar un cliente con compras registradas.');
        }

        $cliente->delete();
        return back()->with('success', 'Cliente eliminado correctamente.');
    }
}