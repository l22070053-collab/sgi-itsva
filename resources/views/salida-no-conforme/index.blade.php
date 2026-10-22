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
                    <h1 class="text-lg font-semibold text-gray-800">Control de Salidas No Conformes</h1>
                    <p class="mt-1 text-sm text-gray-500">Registros de salidas no conformes en el Sistema de Gestión Integral.</p>
                </div>
                <a href="{{ route('salida-no-conforme.create') }}" class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">
                    Nuevo registro
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Folio</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha de reporte</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Área detectada</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Responsable</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($salidasNoConformes as $salida)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $salida->folio }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ \Carbon\Carbon::parse($salida->fecha_reporte)->format('d/m/Y') }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $salida->area_detectada }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $salida->responsable_reporte }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    @php
                                        $badgeColor = match($salida->estado) {
                                            'Abierto' => 'bg-amber-100 text-amber-800',
                                            'En proceso' => 'bg-blue-100 text-blue-800',
                                            'Cerrado' => 'bg-green-100 text-green-800',
                                            default => 'bg-gray-100 text-gray-800',
                                        };
                                    @endphp
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $badgeColor }}">
                                        {{ $salida->estado }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="inline-flex items-center gap-4">
                                        <a href="{{ route('salida-no-conforme.show', $salida) }}" class="text-indigo-600 hover:text-indigo-900">Ver</a>
                                        <a href="{{ route('salida-no-conforme.edit', $salida) }}" class="text-gray-600 hover:text-gray-900">Editar</a>
                                        <form method="POST" action="{{ route('salida-no-conforme.destroy', $salida) }}" onsubmit="return confirm('¿Desea eliminar este registro? Esta acción no se puede deshacer.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">Eliminar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-10 text-center text-sm text-gray-500">No hay salidas no conformes registradas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($salidasNoConformes->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $salidasNoConformes->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection