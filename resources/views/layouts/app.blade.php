<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ArandaStore - Videojuegos & Gaming</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body class="bg-zinc-950 text-zinc-100 min-h-screen flex flex-col font-sans selection:bg-emerald-500 selection:text-black">

    <!-- Topbar Gamer -->
    <nav class="border-b border-zinc-800 bg-zinc-900/90 backdrop-blur sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="bg-gradient-to-tr from-emerald-500 to-indigo-600 p-2 rounded-xl text-black">
                    <i class="bi bi-controller text-2xl font-bold"></i>
                </div>
                <a href="{{ route('tienda.index') }}" class="text-2xl font-black tracking-wider bg-clip-text text-transparent bg-gradient-to-r from-emerald-400 via-teal-300 to-indigo-400">
                    ARANDA<span class="text-white">STORE</span>
                </a>
            </div>

            <div class="flex items-center gap-6 text-sm font-semibold">
                <a href="{{ route('tienda.index') }}" class="hover:text-emerald-400 transition flex items-center gap-1.5"><i class="bi bi-grid-fill"></i> Catálogo</a>
                <a href="{{ route('clientes.index') }}" class="hover:text-emerald-400 transition flex items-center gap-1.5"><i class="bi bi-people-fill"></i> Clientes</a>
                <a href="{{ route('videojuegos.index') }}" class="hover:text-emerald-400 transition flex items-center gap-1.5"><i class="bi bi-box-seam-fill"></i> Inventario</a>
                <a href="{{ route('ventas.index') }}" class="hover:text-emerald-400 transition flex items-center gap-1.5"><i class="bi bi-receipt"></i> Ventas & Cancelar</a>
            </div>
        </div>
    </nav>

    <!-- Notificaciones Flash -->
    <div class="max-w-7xl mx-auto px-4 mt-4 w-full">
        @if(session('success'))
            <div class="bg-emerald-500/10 border border-emerald-500/40 text-emerald-400 p-4 rounded-xl flex items-center gap-3">
                <i class="bi bi-check-circle-fill text-xl"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-500/10 border border-red-500/40 text-red-400 p-4 rounded-xl flex items-center gap-3">
                <i class="bi bi-exclamation-triangle-fill text-xl"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif
        @if ($errors->any())
            <div class="bg-amber-500/10 border border-amber-500/40 text-amber-400 p-4 rounded-xl">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <!-- Contenedor -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 flex-1 w-full">
        @yield('content')
    </main>

    <footer class="border-t border-zinc-800 text-center py-6 text-zinc-500 text-xs">
        &copy; {{ date('Y') }} ArandaStore - Panel Administrativo y Tienda Online.
    </footer>
</body>
</html>