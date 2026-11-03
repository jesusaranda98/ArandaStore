<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Videojuego;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VentaController extends Controller
{
    public function index()
    {
        $ventas = Venta::with(['cliente', 'videojuego'])->latest()->get();
        return view('ventas.index', compact('ventas'));
    }

    public function store(Request $request)
    {
        // Obtenemos la fecha exacta local
        $hoy = Carbon::now('America/Monterrey')->toDateString();

        // Validaciones requeridas
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'videojuego_id' => 'required|exists:videojuegos,id',
            'cantidad' => 'required|integer|min:1',
            'fecha_venta' => 'required|date|after_or_equal:' . $hoy,
        ], [
            'fecha_venta.after_or_equal' => 'No se permiten ventas con fecha anterior al día de hoy.',
        ]);

        return DB::transaction(function () use ($request) {
            $juego = Videojuego::lockForUpdate()->findOrFail($request->videojuego_id);

            // Validar existencia suficiente
            if ($juego->stock < $request->cantidad) {
                return back()->with('error', 'Stock insuficiente para realizar la compra.');
            }

            // Disminuir stock
            $juego->decrement('stock', $request->cantidad);

            // Registrar venta
            Venta::create([
                'cliente_id' => $request->cliente_id,
                'videojuego_id' => $juego->id,
                'cantidad' => $request->cantidad,
                'total' => $juego->precio * $request->cantidad,
                'fecha_venta' => $request->fecha_venta,
                'estado' => 'completada'
            ]);

            return back()->with('success', '¡Venta realizada con éxito! El stock ha disminuido.');
        });
    }

    public function cancelar($id)
    {
        return DB::transaction(function () use ($id) {
            $venta = Venta::findOrFail($id);

            if ($venta->estado === 'cancelada') {
                return back()->with('error', 'Esta venta ya se encuentra cancelada.');
            }

            // Reintegrar stock según unidades vendidas
            $juego = Videojuego::findOrFail($venta->videojuego_id);
            $juego->increment('stock', $venta->cantidad);

            // Actualizar estado de la venta
            $venta->update(['estado' => 'cancelada']);

            return back()->with('success', 'Venta cancelada exitosamente. El stock fue devuelto al inventario.');
        });
    }
}