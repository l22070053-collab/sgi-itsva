@extends('layouts.app')

@section('content')
@php
    $gravedadColor = match($incidencia->nivel_gravedad) {
        'Bajo' => 'bg-gray-100 text-gray-800',
        'Medio' => 'bg-blue-100 text-blue-800',
        'Alto' => 'bg-amber-100 text-amber-800',
        'Critico' => 'bg-red-100 text-red-800',
        default => 'bg-gray-100 text-gray-800',
    };
    $estadoColor = match($incidencia->estado) {
        'Abierto' => 'bg-amber-100 text-amber-800',
        'En proceso' => 'bg-blue-100 text-blue-800',
        'Cerrado' => 'bg-green-100 text-green-800',
        default => 'bg-gray-100 text-gray-800',
    };
@endphp
<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800">Detalle de Incidencia</h1>
                <p class="mt-1 text-sm text-gray-500">Folio {{ $incidencia->folio }}</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('incidencia.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">
                    Volver al listado
                </a>
                <a href="{{ route('incidencia.edit', $incidencia) }}" class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">
                    Editar
                </a>
            </div>
        </div>

        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
            <div class="bg-gray-100 px-6 py-4 border-b border-gray-200">
                <h2 class="text-base font-semibold text-gray-800">Datos generales</h2>
            </div>
            <dl class="p-6 grid grid-cols-1 gap-6 md:grid-cols-2">
                <div>
                    <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Folio</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $incidencia->folio }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha del incidente</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ \Carbon\Carbon::parse($incidencia->fecha_incidente)->format('d/m/Y') }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Área afectada</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $incidencia->area_afectada }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Responsable del reporte</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $incidencia->responsable_reporte }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Nivel de gravedad</dt>
                    <dd class="mt-1 text-sm">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $gravedadColor }}">
                            {{ $incidencia->nivel_gravedad }}
                        </span>
                    </dd>
                </div>
                <div>
                    <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</dt>
                    <dd class="mt-1 text-sm">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $estadoColor }}">
                            {{ $incidencia->estado }}
                        </span>
                    </dd>
                </div>
            </dl>
        </div>

        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
            <div class="bg-gray-100 px-6 py-4 border-b border-gray-200">
                <h2 class="text-base font-semibold text-gray-800">Descripción del incidente</h2>
            </div>
            <dl class="p-6">
                <div>
                    <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Descripción detallada</dt>
                    <dd class="mt-1 text-sm text-gray-900 whitespace-pre-line break-words">{{ $incidencia->descripcion_incidente }}</dd>
                </div>
            </dl>
        </div>
    </div>
</div>
@endsection