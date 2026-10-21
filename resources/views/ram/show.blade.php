@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800">Reporte de Acciones de Mejora</h1>
                <p class="mt-1 text-sm text-gray-500">Folio {{ $ram->folio }}</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('ram.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">
                    Volver al listado
                </a>
                <a href="{{ route('ram.edit', $ram) }}" class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">
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
                    <dd class="mt-1 text-sm text-gray-900">{{ $ram->folio }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha de elaboración</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ \Carbon\Carbon::parse($ram->fecha_elaboracion)->format('d/m/Y') }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Norma</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $ram->norma }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Requisito</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $ram->requisito }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Proceso estratégico</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $ram->proceso_estrategico }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Proceso operativo</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $ram->proceso_operativo }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Origen de la acción</dt>
                    <dd class="mt-1 text-sm">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">{{ $ram->origen_accion }}</span>
                    </dd>
                </div>
                <div>
                    <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Responsable de definir la acción</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $ram->responsable_definir_accion }}</dd>
                </div>
            </dl>
        </div>

        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
            <div class="bg-gray-100 px-6 py-4 border-b border-gray-200">
                <h2 class="text-base font-semibold text-gray-800">Descripción de la acción de mejora</h2>
            </div>
            <dl class="p-6 space-y-6">
                <div>
                    <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Situación actual</dt>
                    <dd class="mt-1 text-sm text-gray-900 whitespace-pre-line break-words">{{ $ram->situacion_actual }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Descripción de la recomendación</dt>
                    <dd class="mt-1 text-sm text-gray-900 whitespace-pre-line break-words">{{ $ram->descripcion_recomendacion }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Resultados esperados</dt>
                    <dd class="mt-1 text-sm text-gray-900 whitespace-pre-line break-words">{{ $ram->resultados_esperados }}</dd>
                </div>
            </dl>
        </div>

        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
            <div class="bg-gray-100 px-6 py-4 border-b border-gray-200">
                <h2 class="text-base font-semibold text-gray-800">Planes de acción</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acción</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Responsable de implementación</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha programada</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Evidencia</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($ram->planesAccion as $plan)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900 break-words">{{ $plan->accion }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $plan->responsable_implementacion }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ \Carbon\Carbon::parse($plan->fecha_programada)->format('d/m/Y') }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600 break-words">{{ $plan->evidencia ?: 'Sin registrar' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-10 text-center text-sm text-gray-500">Este reporte no tiene planes de acción registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
            <div class="bg-gray-100 px-6 py-4 border-b border-gray-200">
                <h2 class="text-base font-semibold text-gray-800">Verificación y cierre</h2>
            </div>
            <dl class="p-6 grid grid-cols-1 gap-6 md:grid-cols-2">
                <div>
                    <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha de verificación</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $ram->fecha_verificacion ? \Carbon\Carbon::parse($ram->fecha_verificacion)->format('d/m/Y') : 'Sin registrar' }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Responsable de verificar la acción</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $ram->responsable_verificar_accion ?: 'Sin registrar' }}</dd>
                </div>
                <div class="md:col-span-2">
                    <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Lecciones aprendidas</dt>
                    <dd class="mt-1 text-sm text-gray-900 whitespace-pre-line break-words">{{ $ram->lecciones_aprendidas ?: 'Sin registrar' }}</dd>
                </div>
            </dl>
        </div>
    </div>
</div>
@endsection