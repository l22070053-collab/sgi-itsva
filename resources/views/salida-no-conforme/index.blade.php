@extends('layouts.app')

@section('content')
<div class="py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if (session('success'))
            <div class="mb-6 rounded-md bg-green-50 border-2 border-green-400 p-4" role="alert">
                <p class="text-base font-semibold text-green-800">{{ session('success') }}</p>
            </div>
        @endif

        <div class="bg-white shadow-md rounded-lg overflow-hidden border border-slate-300">
            <div class="bg-slate-100 px-6 py-4 border-b border-slate-300 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-xl font-bold text-slate-800">Control de Salidas No Conformes</h1>
                    <p class="mt-1 text-base text-slate-600">Búsqueda rápida por matrícula de estudiante, nombre, folio o área.</p>
                </div>
                <a href="{{ route('salida-no-conforme.create') }}" class="inline-flex items-center justify-center px-5 py-2.5 bg-indigo-600 border border-transparent rounded-md font-bold text-sm text-white uppercase tracking-widest hover:bg-indigo-700 transition">
                    + Nuevo registro
                </a>
            </div>

            <!-- BARRA DE BÚSQUEDA POR MATRÍCULA -->
            <div class="p-6 bg-white border-b border-slate-300 flex flex-col sm:flex-row gap-4 items-center justify-between">
                <div class="w-full sm:w-2/3">
                    <label for="buscador-tabla" class="block mb-1">Buscar por Matrícula de Alumno, Nombre, Folio o Área:</label>
                    <input type="text" id="buscador-tabla" placeholder="Ejemplo: 23020035, nombre del estudiante, folio o área..." class="w-full">
                </div>
                <div class="text-sm font-medium text-slate-600">
                    Escribe la matrícula para filtrar al instante.
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-300">
                    <thead class="bg-slate-100">
                        <tr>
                            <th scope="col" class="px-4 py-3 text-left text-sm font-bold text-slate-700 uppercase">Folio</th>
                            <th scope="col" class="px-4 py-3 text-left text-sm font-bold text-slate-700 uppercase">Fecha</th>
                            <th scope="col" class="px-4 py-3 text-left text-sm font-bold text-slate-700 uppercase">Área detectada</th>
                            <th scope="col" class="px-4 py-3 text-left text-sm font-bold text-slate-700 uppercase">Descripción / Alumno (Matrícula)</th>
                            <th scope="col" class="px-4 py-3 text-left text-sm font-bold text-slate-700 uppercase">Responsable</th>
                            <th scope="col" class="px-4 py-3 text-left text-sm font-bold text-slate-700 uppercase">Estado</th>
                            <th scope="col" class="px-4 py-3 text-right text-sm font-bold text-slate-700 uppercase">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-200">
                        @forelse ($salidasNoConformes as $salida)
                            <tr class="hover:bg-slate-50 fila-dato">
                                <td class="px-4 py-4 whitespace-nowrap text-base font-bold text-slate-900">{{ $salida->folio }}</td>
                                <td class="px-4 py-4 whitespace-nowrap text-base text-slate-700">{{ \Carbon\Carbon::parse($salida->fecha_reporte)->format('d/m/Y') }}</td>
                                <td class="px-4 py-4 text-base text-slate-700">{{ $salida->area_detectada }}</td>
                                <td class="px-4 py-4 text-base text-slate-800 max-w-md">{{ $salida->descripcion_falla }}</td>
                                <td class="px-4 py-4 text-base text-slate-700">{{ $salida->responsable_reporte }}</td>
                                <td class="px-4 py-4 whitespace-nowrap text-base">
                                    @php
                                        $badgeColor = match($salida->estado) {
                                            'Abierto' => 'bg-amber-100 text-amber-900 border border-amber-400',
                                            'En proceso' => 'bg-blue-100 text-blue-900 border border-blue-400',
                                            'Cerrado' => 'bg-green-100 text-green-900 border border-green-400',
                                            default => 'bg-gray-100 text-gray-800',
                                        };
                                    @endphp
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold {{ $badgeColor }}">
                                        {{ $salida->estado }}
                                    </span>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-right text-base font-semibold">
                                    <div class="inline-flex items-center gap-4">
                                        <a href="{{ route('salida-no-conforme.show', $salida) }}" class="text-indigo-700 hover:underline">Ver</a>
                                        <a href="{{ route('salida-no-conforme.edit', $salida) }}" class="text-slate-700 hover:underline">Editar</a>
                                        <form method="POST" action="{{ route('salida-no-conforme.destroy', $salida) }}" onsubmit="return confirm('¿Desea eliminar este registro?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-700 hover:underline font-semibold">Eliminar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-10 text-center text-base text-slate-600">No hay salidas no conformes registradas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($salidasNoConformes->hasPages())
                <div class="px-6 py-4 border-t border-slate-300">
                    {{ $salidasNoConformes->links() }}
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