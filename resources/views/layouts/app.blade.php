<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGI - ITSVA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Aumenta el tamaño base de toda la interfaz para mejor lectura */
        html {
            font-size: 18px;
        }
        /* Hace todos los recuadros de formularios muy visibles y fáciles de distinguir */
        input[type="text"],
        input[type="date"],
        input[type="number"],
        input[type="email"],
        input[type="password"],
        select,
        textarea {
            border: 2px solid #475569 !important; /* Borde gris oscuro sólido */
            background-color: #ffffff !important;
            color: #0f172a !important;
            font-size: 1rem !important;
            padding: 0.55rem 0.75rem !important;
            border-radius: 0.5rem !important;
        }
        input:focus,
        select:focus,
        textarea:focus {
            border-color: #4f46e5 !important; /* Borde azul intenso al seleccionar */
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.25) !important;
            outline: none !important;
        }
        label {
            font-size: 0.95rem !important;
            font-weight: 700 !important;
            color: #1e293b !important;
        }
    </style>
</head>
<body class="bg-slate-100 min-h-screen text-slate-900">

    <nav class="bg-white shadow-sm border-b-2 border-slate-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex flex-wrap items-center justify-between gap-4">
            <div class="flex items-center space-x-4">
                <a href="{{ route('dashboard') }}" class="text-xl font-bold text-slate-800 hover:text-indigo-600 transition">
                    Sistema de Gestión Integral
                </a>
            </div>
            
            <div class="flex items-center space-x-4">
                @unless(request()->routeIs('dashboard'))
                    <a href="{{ route('dashboard') }}" class="text-base font-semibold text-indigo-700 hover:text-indigo-900 transition">
                        ← Ir al Dashboard
                    </a>
                @endunless

                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="text-base font-semibold text-red-600 border-2 border-red-300 px-4 py-1.5 rounded-lg transition hover:bg-red-50 hover:text-red-700">
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