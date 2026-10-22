@extends('layouts.app')

@section('content')
@php
    $gravedadActual = old('nivel_gravedad');
    $estadoActual = old('estado', 'Abierto');
@endphp
<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h1 class="text-2xl font-semibold text-gray-800">Registrar Nueva Incidencia</h1>
            <a href="{{ route('incidencia.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">
                Volver al listado
            </a>
        </div>

        @if ($errors->any())
            <div class="mb-6 rounded-md bg-red-50 border border-red-200 p-4" role="alert">
                <div class="flex items-start">
                    <svg class="h-5 w-5 text-red-500 mt-0.5 shrink-0" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                    <div class="ml-3">
                        <h3 class="text-sm font-semibold text-red-800">Se encontraron los siguientes errores:</h3>
                        <ul class="mt-2 list-disc list-inside space-y-1 text-sm text-red-700">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('incidencia.store') }}" class="space-y-6">
            @csrf

            <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                <div class="bg-gray-100 px-6 py-4 border-b border-gray-200">
                    <h2 class="text-base font-semibold text-gray-800">Datos generales</h2>
                </div>
                <div class="p-6 grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div>
                        <label for="folio" class="block text-sm font-medium text-gray-700">Folio <span class="text-red-500">*</span></label>
                        <input type="text" name="folio" id="folio" value="{{ old('folio') }}" required class="mt-1 block w-full rounded-md border px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 {{ $errors->has('folio') ? 'border-red-500' : 'border-gray-300' }}">
                        @error('folio')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="fecha_incidente" class="block text-sm font-medium text-gray-700">Fecha del incidente <span class="text-red-500">*</span></label>
                        <input type="date" name="fecha_incidente" id="fecha_incidente" value="{{ old('fecha_incidente') }}" required class="mt-1 block w-full rounded-md border px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 {{ $errors->has('fecha_incidente') ? 'border-red-500' : 'border-gray-300' }}">
                        @error('fecha_incidente')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="area_afectada" class="block text-sm font-medium text-gray-700">Área afectada <span class="text-red-500">*</span></label>
                        <input type="text" name="area_afectada" id="area_afectada" value="{{ old('area_afectada') }}" required class="mt-1 block w-full rounded-md border px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 {{ $errors->has('area_afectada') ? 'border-red-500' : 'border-gray-300' }}">
                        @error('area_afectada')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="responsable_reporte" class="block text-sm font-medium text-gray-700">Responsable del reporte <span class="text-red-500">*</span></label>
                        <input type="text" name="responsable_reporte" id="responsable_reporte" value="{{ old('responsable_reporte') }}" required class="mt-1 block w-full rounded-md border px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 {{ $errors->has('responsable_reporte') ? 'border-red-500' : 'border-gray-300' }}">
                        @error('responsable_reporte')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="nivel_gravedad" class="block text-sm font-medium text-gray-700">Nivel de gravedad <span class="text-red-500">*</span></label>
                        <select name="nivel_gravedad" id="nivel_gravedad" required class="mt-1 block w-full rounded-md border bg-white px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 {{ $errors->has('nivel_gravedad') ? 'border-red-500' : 'border-gray-300' }}">
                            <option value="">Seleccione un nivel</option>
                            <option value="Bajo" @selected($gravedadActual === 'Bajo')>Bajo</option>
                            <option value="Medio" @selected($gravedadActual === 'Medio')>Medio</option>
                            <option value="Alto" @selected($gravedadActual === 'Alto')>Alto</option>
                            <option value="Critico" @selected($gravedadActual === 'Critico')>Critico</option>
                        </select>
                        @error('nivel_gravedad')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="estado" class="block text-sm font-medium text-gray-700">Estado <span class="text-red-500">*</span></label>
                        <select name="estado" id="estado" required class="mt-1 block w-full rounded-md border bg-white px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 {{ $errors->has('estado') ? 'border-red-500' : 'border-gray-300' }}">
                            <option value="">Seleccione un estado</option>
                            <option value="Abierto" @selected($estadoActual === 'Abierto')>Abierto</option>
                            <option value="En proceso" @selected($estadoActual === 'En proceso')>En proceso</option>
                            <option value="Cerrado" @selected($estadoActual === 'Cerrado')>Cerrado</option>
                        </select>
                        @error('estado')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                <div class="bg-gray-100 px-6 py-4 border-b border-gray-200">
                    <h2 class="text-base font-semibold text-gray-800">Descripción del incidente</h2>
                </div>
                <div class="p-6">
                    <div>
                        <label for="descripcion_incidente" class="block text-sm font-medium text-gray-700">Descripción detallada <span class="text-red-500">*</span></label>
                        <textarea name="descripcion_incidente" id="descripcion_incidente" rows="4" required class="mt-1 block w-full rounded-md border px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 {{ $errors->has('descripcion_incidente') ? 'border-red-500' : 'border-gray-300' }}">{{ old('descripcion_incidente') }}</textarea>
                        @error('descripcion_incidente')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3">
                <a href="{{ route('incidencia.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">
                    Cancelar
                </a>
                <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">
                    Guardar incidencia
                </button>
            </div>
        </form>
    </div>
</div>
@endsection