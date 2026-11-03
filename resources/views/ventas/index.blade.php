@extends('layouts.app')

@section('content')
<div class="bg-zinc-900 border border-zinc-800 p-6 rounded-2xl">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-white flex items-center gap-2">
                <i class="bi bi-receipt-cutoff text-emerald-400"></i> Historial de Ventas
            </h2>
            <p class="text-zinc-400 text-xs mt-1">Control de transacciones y cancelación con devolución automática de inventario.</p>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-zinc-300">
            <thead class="bg-zinc-950 text-zinc-400 uppercase text-xs">
                <tr>
                    <th class="p-3">ID Venta</th>
                    <th class="p-3">Fecha</th>
                    <th class="p-3">Cliente</th>
                    <th class="p-3">Videojuego</th>
                    <th class="p-3">Cantidad</th>
                    <th class="p-3">Total</th>
                    <th class="p-3">Estado</th>
                    <th class="p-3 text-center">Opciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-zinc-800">
                @forelse($ventas as $v)
                    <tr>
                        <td class="p-3 font-mono text-xs text-zinc-500">#ORD-{{ str_pad($v->id, 4, '0', STR_PAD_LEFT) }}</td>
                        <td class="p-3 text-xs">{{ $v->fecha_venta }}</td>
                        <td class="p-3 font-medium text-white">{{ $v->cliente->nombre }}</td>
                        <td class="p-3 text-emerald-400 font-semibold">{{ $v->videojuego->nombre }}</td>
                        <td class="p-3 text-xs">{{ $v->cantidad }}</td>
                        <td class="p-3 font-bold text-white">${{ number_format($v->total, 2) }}</td>
                        <td class="p-3 text-xs">
                            @if($v->estado === 'completada')
                                <span class="bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 px-2.5 py-0.5 rounded-full font-bold uppercase text-[10px]">
                                    Completada
                                </span>
                            @else
                                <span class="bg-red-500/20 text-red-400 border border-red-500/30 px-2.5 py-0.5 rounded-full font-bold uppercase text-[10px]">
                                    Cancelada (Stock Reintegrado)
                                </span>
                            @endif
                        </td>
                        <td class="p-3 text-center">
                            @if($v->estado === 'completada')
                                <form action="{{ route('ventas.cancelar', $v->id) }}" method="POST" onsubmit="return confirm('¿Cancelar esta compra? El stock volverá al inventario.');">
                                    @csrf
                                    <button type="submit" class="bg-red-500/10 hover:bg-red-500/20 text-red-400 border border-red-500/30 text-xs px-3 py-1.5 rounded-lg transition font-medium">
                                        Cancelar Compra
                                    </button>
                                </form>
                            @else
                                <span class="text-zinc-600 text-xs italic">Sin acciones</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="p-6 text-center text-zinc-500">No se han registrado transacciones todavía.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection