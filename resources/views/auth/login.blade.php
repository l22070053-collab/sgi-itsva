<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión · SGI</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 min-h-screen flex items-center justify-center px-4">

    <div class="w-full max-w-md">
        <div class="bg-white shadow-xl rounded-2xl p-8">

            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold text-slate-800">Sistema de Gestión Integral</h1>
                <p class="text-slate-500 text-sm mt-1">Ingresa tus credenciales para continuar</p>
            </div>

            {{-- Errores de validación o de la API externa (401 / 500 / timeout) --}}
            @error('nombre_usuario')
                <div class="mb-5 p-3 rounded-lg bg-red-50 border border-red-200 text-red-700 text-sm text-center">
                    {{ $message }}
                </div>
            @enderror

            <form method="POST" action="{{ route('login.store') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="nombre_usuario" class="block text-sm font-medium text-slate-700 mb-1">
                        Usuario
                    </label>
                    <input
                        type="text"
                        id="nombre_usuario"
                        name="nombre_usuario"
                        value="{{ old('nombre_usuario') }}"
                        autofocus
                        required
                        placeholder="Ingresa tu usuario"
                        class="w-full px-4 py-2.5 border rounded-lg outline-none transition focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('nombre_usuario') border-red-400 @else border-slate-300 @enderror"
                    >
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700 mb-1">
                        Contraseña
                    </label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        required
                        placeholder="••••••••"
                        class="w-full px-4 py-2.5 border rounded-lg outline-none transition focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('password') border-red-400 @else border-slate-300 @enderror"
                    >
                    @error('password')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <button
                    type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2.5 rounded-lg shadow-md transition hover:shadow-lg"
                >
                    Iniciar Sesión
                </button>
            </form>

        </div>
        <p class="text-center text-xs text-slate-400 mt-6">&copy; {{ date('Y') }} SGI</p>
    </div>

</body>
</html>