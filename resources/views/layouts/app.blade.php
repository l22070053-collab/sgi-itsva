<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGI - ITSVA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        html {
            font-size: 18px;
        }
        input[type="text"],
        input[type="date"],
        input[type="number"],
        input[type="email"],
        input[type="password"],
        select,
        textarea {
            border: 2px solid #475569 !important;
            background-color: #ffffff !important;
            color: #0f172a !important;
            font-size: 1rem !important;
            padding: 0.55rem 0.75rem !important;
            border-radius: 0.5rem !important;
        }
        input:focus,
        select:focus,
        textarea:focus {
            border-color: #6E062D !important;
            box-shadow: 0 0 0 3px rgba(110, 6, 45, 0.25) !important;
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

    <nav class="bg-[#6E062D] text-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3 flex flex-wrap items-center justify-between gap-4">
            <div class="flex items-center space-x-3">
                <img src="{{ asset('images/logo-itsva.png') }}" alt="Logo ITSVA" class="h-12 w-auto bg-white rounded-md p-1 shadow-sm">
                <img src="{{ asset('images/logo-itsva1.png') }}" alt="Logo Institucional" class="h-12 w-auto bg-white rounded-md p-1 shadow-sm">
                <div class="pl-1">
                    <a href="{{ route('dashboard') }}" class="text-xl font-bold text-white hover:text-slate-200 transition block leading-tight">
                        Sistema de Gestión Integral
                    </a>
                    <span class="text-xs text-white/80 font-medium tracking-wide">TecNM Campus Valladolid</span>
                </div>
            </div>
            
            <div class="flex items-center space-x-3">
                @unless(request()->routeIs('dashboard'))
                    <a href="{{ route('dashboard') }}" class="text-sm font-semibold text-white bg-white/15 hover:bg-white/25 px-3 py-2 rounded-lg transition">
                        ← Ir al Dashboard
                    </a>
                @endunless

                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="text-sm font-semibold text-[#6E062D] bg-white hover:bg-slate-100 px-4 py-2 rounded-lg shadow-sm transition">
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