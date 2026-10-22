<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGI - ITSVA</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 min-h-screen">

    <nav class="bg-white shadow-sm border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex flex-wrap items-center justify-between gap-4">
            <div class="flex items-center space-x-4">
                <a href="{{ route('dashboard') }}" class="text-lg font-bold text-slate-800 hover:text-indigo-600 transition">
                    Sistema de Gestión Integral
                </a>
            </div>
            
            <div class="flex items-center space-x-4">
                {{-- Solo se muestra si NO estamos en el dashboard --}}
                @unless(request()->routeIs('dashboard'))
                    <a href="{{ route('dashboard') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-800 transition">
                        ← Ir al Dashboard
                    </a>
                @endunless

                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="text-sm font-medium text-red-600 border border-red-200 px-3 py-1.5 rounded-lg transition hover:bg-red-50 hover:text-red-700">
                        Cerrar sesión
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

</body>
</html>