@extends('layouts.app')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="bg-zinc-900 border border-zinc-800 p-6 rounded-2xl h-fit">
        <h2 class="text-xl font-bold text-white mb-4 flex items-center gap-2">
            <i class="bi bi-plus-circle-fill text-emerald-400"></i> Registrar Videojuego
        </h2>

        <form action="{{ route('videojuegos.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-zinc-400 mb-1">Título del Videojuego (Único)</label>
                <input type="text" name="nombre" required value="{{ old('nombre') }}" class="w-full bg-zinc-950 border border-zinc-700 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:border-emerald-500">
            </div>

            <div>
                <label class="block text-xs font-semibold text-zinc-400 mb-1">Categoría</label>
                <select name="categoria_id" required class="w-full bg-zinc-950 border border-zinc-700 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:border-emerald-500">
                    @foreach($categorias as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-zinc-400 mb-1">Precio ($ MXN)</label>
                    <input type="number" step="0.01" name="precio" required value="{{ old('precio') }}" class="w-full bg-zinc-950 border border-zinc-700 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:border-emerald-500">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-zinc-400 mb-1">Stock Inicial</label>
                    <input type="number" name="stock" required value="{{ old('stock') }}" class="w-full bg-zinc-950 border border-zinc-700 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:border-emerald-500">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-zinc-400 mb-1">URL de la Imagen</label>
                <input type="url" name="imagen_url" required value="{{ old('imagen_url') }}" placeholder="https://..." class="w-full bg-zinc-950 border border-zinc-700 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:border-emerald-500">
            </div>

            <div>
                <label class="block text-xs font-semibold text-zinc-400 mb-1">Sinopsis / Resumen</label>
                <textarea name="sinopsis" rows="3" required class="w-full bg-zinc-950 border border-zinc-700 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:border-emerald-500">{{ old('sinopsis') }}</textarea>
            </div>

            <button type="submit" class="w-full bg-emerald-500 hover:bg-emerald-400 text-black font-bold py-2.5 rounded-xl text-sm transition">
                Guardar en Inventario
            </button>
        </form>
    </div>

    <div class="lg:col-span-2 bg-zinc-900 border border-zinc-800 p-6 rounded-2xl">
        <h2 class="text-xl font-bold text-white mb-4 flex items-center gap-2">
            <i class="bi bi-box-seam-fill text-indigo-400"></i> Inventario de Videojuegos
        </h2>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-zinc-300">
                <thead class="bg-zinc-950 text-zinc-400 uppercase text-xs">
                    <tr>
                        <th class="p-3">Juego</th>
                        <th class="p-3">Categoría</th>
                        <th class="p-3">Precio</th>
                        <th class="p-3">Stock</th>
                        <th class="p-3">Ventas</th>
                        <th class="p-3 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-800">
                    @forelse($videojuegos as $j)
                        <tr>
                            <td class="p-3 font-semibold text-white flex items-center gap-3">
                                <img src="{{ $j->imagen_url }}" class="w-10 h-10 object-cover rounded-lg border border-zinc-700">
                                <span>{{ $j->nombre }}</span>
                            </td>
                            <td class="p-3 text-xs">{{ $j->categoria->nombre }}</td>
                            <td class="p-3 text-xs font-bold text-emerald-400">${{ number_format($j->precio, 2) }}</td>
                            <td class="p-3 text-xs">
                                <span class="{{ $j->stock <= 3 ? 'text-amber-400 font-bold' : 'text-zinc-300' }}">
                                    {{ $j->stock }} unids.
                                </span>
                            </td>
                            <td class="p-3 text-xs">
                                <span class="bg-indigo-500/20 text-indigo-300 px-2 py-0.5 rounded-full font-bold">
                                    {{ $j->ventas->count() }} ventas
                                </span>
                            </td>
                            <td class="p-3 text-center">
                                <form action="{{ route('videojuegos.destroy', $j->id) }}" method="POST" onsubmit="return confirm('¿Deseas eliminar este videojuego?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-300 text-sm p-1 rounded transition" title="Eliminar">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-4 text-center text-zinc-500">No hay videojuegos registrados en el inventario.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection