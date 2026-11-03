@extends('layouts.app')

@section('content')
<!-- Banner Principal -->
<div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-emerald-950/70 via-zinc-900 to-indigo-950/70 border border-zinc-800 p-8 mb-8 shadow-2xl">
    <div class="max-w-xl">
        <span class="text-xs uppercase tracking-widest text-emerald-400 font-bold bg-emerald-500/10 px-3 py-1 rounded-full border border-emerald-500/20">Catálogo Oficial</span>
        <h1 class="text-4xl font-extrabold text-white mt-4 tracking-tight">Tienda de Videojuegos</h1>
        <p class="text-zinc-400 mt-2 text-sm leading-relaxed">Filtra por categoría, consulta la sinopsis y realiza compras con actualización de inventario automática.</p>
    </div>
</div>

<!-- Filtros de Categorías -->
<div class="flex items-center gap-3 overflow-x-auto pb-4 mb-8">
    <a href="{{ route('tienda.index') }}" 
       class="px-5 py-2.5 rounded-xl text-sm font-semibold transition border {{ !request('categoria') ? 'bg-emerald-500 text-black border-emerald-400 shadow-lg shadow-emerald-500/20' : 'bg-zinc-900 text-zinc-400 border-zinc-800 hover:border-zinc-700' }}">
       Todos los Juegos
    </a>
    @foreach($categorias as $cat)
        <a href="{{ route('tienda.index', ['categoria' => $cat->id]) }}" 
           class="px-5 py-2.5 rounded-xl text-sm font-semibold transition border flex items-center gap-2 {{ request('categoria') == $cat->id ? 'bg-emerald-500 text-black border-emerald-400 shadow-lg shadow-emerald-500/20' : 'bg-zinc-900 text-zinc-400 border-zinc-800 hover:border-zinc-700' }}">
           @if($cat->icono)<i class="bi {{ $cat->icono }}"></i>@endif
           {{ $cat->nombre }}
        </a>
    @endforeach
</div>

<!-- Grid de Videojuegos -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
    @forelse($videojuegos as $juego)
        <div class="bg-zinc-900 rounded-2xl border border-zinc-800 overflow-hidden flex flex-col justify-between hover:border-emerald-500/50 transition-all duration-300 hover:shadow-xl hover:shadow-emerald-500/5 group">
            <div>
                <div class="relative h-48 overflow-hidden bg-zinc-950">
                    <img src="{{ $juego->imagen_url }}" alt="{{ $juego->nombre }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    <span class="absolute top-3 right-3 bg-zinc-950/80 backdrop-blur px-2.5 py-1 rounded-md text-xs font-semibold text-emerald-400 border border-zinc-700">
                        {{ $juego->categoria->nombre }}
                    </span>
                    <span class="absolute bottom-3 left-3 {{ $juego->stock > 0 ? 'bg-emerald-500 text-black font-bold' : 'bg-red-500 text-white font-bold' }} px-2.5 py-0.5 rounded text-xs">
                        Stock: {{ $juego->stock }}
                    </span>
                </div>

                <div class="p-5">
                    <h3 class="text-lg font-bold text-white group-hover:text-emerald-400 transition">{{ $juego->nombre }}</h3>
                    <p class="text-zinc-400 text-xs mt-2 line-clamp-3 leading-relaxed">{{ $juego->sinopsis }}</p>
                </div>
            </div>

            <div class="p-5 pt-0">
                <div class="flex items-center justify-between mb-4">
                    <span class="text-zinc-400 text-xs">Precio unitario</span>
                    <span class="text-xl font-black text-white">${{ number_format($juego->precio, 2) }}</span>
                </div>

                @if($juego->stock > 0)
                    <form action="{{ route('ventas.store') }}" method="POST" class="space-y-3">
                        @csrf
                        <input type="hidden" name="videojuego_id" value="{{ $juego->id }}">
                        <input type="hidden" name="cantidad" value="1">
                        <input type="hidden" name="fecha_venta" value="{{ \Carbon\Carbon::now('America/Monterrey')->format('Y-m-d') }}">

                        <div>
                            <select name="cliente_id" required class="w-full bg-zinc-950 text-xs border border-zinc-700 rounded-lg px-2.5 py-2 text-zinc-300 focus:outline-none focus:border-emerald-500">
                                <option value="">Seleccionar Cliente Comprador</option>
                                @foreach($clientes as $cliente)
                                    <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="w-full bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-400 hover:to-emerald-500 text-black font-bold py-2.5 rounded-xl text-sm transition flex items-center justify-center gap-2 shadow-md">
                            <i class="bi bi-bag-check-fill"></i> Comprar (Disminuye stock)
                        </button>
                    </form>
                @else
                    <button disabled class="w-full bg-zinc-800 text-zinc-500 font-bold py-2.5 rounded-xl text-sm cursor-not-allowed">
                        Agotado
                    </button>
                @endif
            </div>
        </div>
    @empty
        <div class="col-span-full py-16 text-center text-zinc-500">
            <i class="bi bi-controller text-5xl"></i>
            <p class="mt-4 text-base">No hay videojuegos registrados en esta categoría.</p>
        </div>
    @endforelse
</div>
@endsection