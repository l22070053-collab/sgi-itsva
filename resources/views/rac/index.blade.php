@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <h2 class="text-2xl font-bold leading-tight text-gray-900">
            Reportes de Acciones Correctivas (RAC)
        </h2>
        <a href="{{ route('rac.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 transition ease-in-out duration-150">
            Nuevo Registro
        </a>
    </div>

    <!-- BARRA DE BÚSQUEDA RÁPIDA -->
    <div class="mb-4 bg-white p-4 shadow-sm sm:rounded-lg flex flex-col sm:flex-row justify-between items-center gap-4">
        <div class="w-full sm:w-96">
            <input type="text" id="buscador-tabla" placeholder="Buscar por folio, norma, origen..." class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        <div class="text-xs text-gray-500">
            Filtrado instantáneo en pantalla.
        </div>
    </div>

    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Folio</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Norma</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Origen</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($racReportes as $reporte)
                <tr class="hover:bg-gray-50 transition duration-150 fila-dato">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $reporte->folio }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $reporte->fecha_elaboracion }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $reporte->norma }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $reporte->origen_accion }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-3">
                            <a href="{{ route('rac.show', $reporte->id) }}" class="text-blue-600 hover:text-blue-900">Ver</a>
                            <a href="{{ route('rac.edit', $reporte->id) }}" class="text-indigo-600 hover:text-indigo-900">Editar</a>
                            <form action="{{ route('rac.destroy', $reporte->id) }}" method="POST" class="inline" onsubmit="return confirm('¿Eliminar este reporte?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Eliminar</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr class="fila-vacia">
                    <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">No hay registros de RAC.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        @if($racReportes->hasPages())
        <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
            {{ $racReportes->links() }}
        </div>
        @endif
    </div>
</div>

<!-- SCRIPT DE BÚSQUEDA EN TIEMPO REAL -->
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