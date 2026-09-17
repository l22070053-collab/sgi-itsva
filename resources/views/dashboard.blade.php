<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard · SGI</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 min-h-screen">

    <nav class="bg-white shadow-sm border-b border-slate-200">
        <div class="max-w-5xl mx-auto px-6 py-4 flex items-center justify-between">
            <h1 class="text-lg font-bold text-slate-800">Sistema de Gestión Integral</h1>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button
                    type="submit"
                    class="text-sm font-medium text-red-600 border border-red-200 px-4 py-2 rounded-lg transition hover:bg-red-50 hover:text-red-700"
                >
                    Cerrar sesión
                </button>
            </form>
        </div>
    </nav>

    <main class="max-w-5xl mx-auto px-6 py-10">

        <div class="bg-white rounded-2xl shadow p-6 mb-8">
            <h2 class="text-xl font-semibold text-slate-800 mb-4">Bienvenido, {{ $username }}</h2>
            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                <div>
                    <dt class="text-slate-500">ID de usuario</dt>
                    <dd class="text-slate-800 font-medium">{{ $id }}</dd>
                </div>
                <div>
                    <dt class="text-slate-500">Usuario</dt>
                    <dd class="text-slate-800 font-medium">{{ $username }}</dd>
                </div>
            </dl>
        </div>

        <div class="bg-white rounded-2xl shadow p-6">
            <h3 class="text-lg font-semibold text-slate-800 mb-4">Permisos por aplicación</h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @forelse ($permissions as $permiso)
                    @if ($permiso['app'] === 'Bitacora-acciones-correctivas')
                        <div class="border border-slate-200 rounded-xl p-4 flex items-center justify-between">
                            <span class="text-slate-700 font-medium">{{ $permiso['app'] }}</span>
                            <span class="text-xs font-semibold uppercase tracking-wide bg-indigo-100 text-indigo-700 px-2.5 py-1 rounded-full">
                                {{ $permiso['permission'] }}
                            </span>
                        </div>
                    @endif
                @empty
                    <p class="text-slate-500 text-sm">No tienes permisos asignados.</p>
                @endforelse
            </div>
        </div>

    </main>

</body>
</html>