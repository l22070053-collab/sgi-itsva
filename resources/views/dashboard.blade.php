@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        
        <div class="bg-white shadow-sm rounded-xl p-6 border border-slate-200">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pb-6 border-b border-slate-100">
                <h2 class="text-xl font-bold text-slate-800">
                    Bienvenido, {{ $username ?? 'Usuario' }}
                </h2>
                <div class="flex flex-wrap items-center gap-2">
    @php
        $permisoBitacora = collect($permissions)->filter(function ($role, $app) {
            return str_contains(strtolower($app), 'bitacora') || str_contains(strtolower($app), 'correctivas');
        });
    @endphp

    @forelse($permisoBitacora as $app => $role)
        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-indigo-50 text-indigo-700 border border-indigo-100">
            {{ $app }}: {{ is_array($role) ? implode(', ', $role) : $role }}
        </span>
    @empty
        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-600">
            Bitacora de Acciones Correctivas: ADMIN
        </span>
    @endforelse
</div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-6">
                <div>
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">ID de usuario</p>
                    <p class="mt-1 text-base font-semibold text-slate-900">{{ $id ?? 'N/A' }}</p>
                </div>
                <div>
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Usuario</p>
                    <p class="mt-1 text-base font-semibold text-slate-900">{{ $username ?? 'N/A' }}</p>
                </div>
            </div>
        </div>

        <div>
            <h3 class="text-lg font-semibold text-slate-800 mb-4">Módulos de la Bitácora SGI</h3>
            
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex flex-col justify-between hover:shadow-md transition">
                    <div>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 mb-3">
                            Módulo RAC
                        </span>
                        <h4 class="text-lg font-bold text-slate-800">Reporte de Acciones Correctivas</h4>
                        <p class="mt-2 text-sm text-slate-600">Registro de análisis de causa raíz, herramientas de calidad y planes de acción correctiva.</p>
                    </div>
                    <div class="mt-6 flex items-center gap-3">
                        <a href="{{ route('rac.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 transition">
                            Entrar al módulo
                        </a>
                        <a href="{{ route('rac.create') }}" class="inline-flex items-center justify-center px-4 py-2 bg-white border border-slate-300 rounded-lg font-semibold text-xs text-slate-700 uppercase tracking-widest hover:bg-slate-50 transition">
                            + Nuevo RAC
                        </a>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex flex-col justify-between hover:shadow-md transition">
                    <div>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800 mb-3">
                            Módulo RAM
                        </span>
                        <h4 class="text-lg font-bold text-slate-800">Reporte de Acciones de Mejora</h4>
                        <p class="mt-2 text-sm text-slate-600">Seguimiento de recomendaciones, situación actual, resultados esperados y planes de mejora.</p>
                    </div>
                    <div class="mt-6 flex items-center gap-3">
                        <a href="{{ route('ram.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 transition">
                            Entrar al módulo
                        </a>
                        <a href="{{ route('ram.create') }}" class="inline-flex items-center justify-center px-4 py-2 bg-white border border-slate-300 rounded-lg font-semibold text-xs text-slate-700 uppercase tracking-widest hover:bg-slate-50 transition">
                            + Nuevo RAM
                        </a>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex flex-col justify-between hover:shadow-md transition">
                    <div>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800 mb-3">
                            Salidas NC
                        </span>
                        <h4 class="text-lg font-bold text-slate-800">Control de Salidas No Conformes</h4>
                        <p class="mt-2 text-sm text-slate-600">Reporte de fallas detectadas en áreas operativas y registro de acciones inmediatas.</p>
                    </div>
                    <div class="mt-6 flex items-center gap-3">
                        <a href="{{ route('salida-no-conforme.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 transition">
                            Entrar al módulo
                        </a>
                        <a href="{{ route('salida-no-conforme.create') }}" class="inline-flex items-center justify-center px-4 py-2 bg-white border border-slate-300 rounded-lg font-semibold text-xs text-slate-700 uppercase tracking-widest hover:bg-slate-50 transition">
                            + Nuevo registro
                        </a>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex flex-col justify-between hover:shadow-md transition">
                    <div>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 mb-3">
                            Incidencias
                        </span>
                        <h4 class="text-lg font-bold text-slate-800">Control de Incidencias</h4>
                        <p class="mt-2 text-sm text-slate-600">Registro de incidentes por área afectada, nivel de gravedad y estado de seguimiento.</p>
                    </div>
                    <div class="mt-6 flex items-center gap-3">
                        <a href="{{ route('incidencia.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 transition">
                            Entrar al módulo
                        </a>
                        <a href="{{ route('incidencia.create') }}" class="inline-flex items-center justify-center px-4 py-2 bg-white border border-slate-300 rounded-lg font-semibold text-xs text-slate-700 uppercase tracking-widest hover:bg-slate-50 transition">
                            + Nueva incidencia
                        </a>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection