@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if (session('success'))
            <div class="mb-6 rounded-md bg-green-50 border border-green-200 p-4" role="alert">
                <div class="flex items-start">
                    <svg class="h-5 w-5 text-green-500 mt-0.5 shrink-0" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <p class="ml-3 text-sm font-medium text-green-800">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
            <div class="bg-gray-100 px-6 py-4 border-b border-gray-200 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-lg font-semibold text-gray-800">Reporte de Acciones de Mejora (RAM)</h1>
                    <p class="mt-1 text-sm text-gray-500">Reportes registrados en el Sistema de Gestión Integral.</p>
                </div>
                <a href="{{ route('ram.create') }}" class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 transition">
                    Nuevo reporte
                </a>
            </div>

            <!-- BARRA DE BÚSQUEDA RÁPIDA -->
            <div class="p-6 bg-white border-b border-gray-200 flex flex-col sm:flex-row gap-4 items-center justify-between">
                <div class="w-full sm:w-96">
                    <input type="text" id="buscador-tabla" placeholder="Buscar por folio, norma, responsable..." class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div class="text-xs text-gray-500">
                    Filtrado instantáneo en pantalla.
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Folio</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha de elaboración</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Norma</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Origen de la acción</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Responsable</th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($ramReportes as $ram)
                            <tr class="hover:bg-gray-50 fila-dato">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $ram->folio }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ \Carbon\Carbon::parse($ram->fecha_elaboracion)->format('d/m/Y') }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $ram->norma }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">{{ $ram->origen_accion }}</span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $ram->responsable_definir_accion }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="inline-flex items-center gap-4">
                                        <a href="{{ route('ram.show', $ram) }}" class="text-indigo-600 hover:text-indigo-900">Ver</a>
                                        <a href="{{ route('ram.edit', $ram) }}" class="text-gray-600 hover:text-gray-900">Editar</a>
                                        <form method="POST" action="{{ route('ram.destroy', $ram) }}" onsubmit="return confirm('¿Desea eliminar este reporte?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">Eliminar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-10 text-center text-sm text-gray-500">No hay reportes de acciones de mejora registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($ramReportes->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $ramReportes->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

<script>
    document.getElementById('buscador-tabla').addEventListener('keyup', function() {
        let texto = this.value.toLowerCase();
        let filas = document.querySelectorAll('.fila-dato');

        filas.forEach(function(fila) {
            let contenido = fila.textContent.toLowerCase();
            if (contenido.includes(texto)) {
                fila.style.display = '';
            } else {
                fila.style.display = 'none';
            }
        });
    });
</script>
@endsection