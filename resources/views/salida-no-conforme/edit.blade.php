@extends('layouts.app')

@section('content')
@php
    $estadoActual = old('estado', $salida_no_conforme->estado);
    $fechaReporte = $salida_no_conforme->fecha_reporte ? \Carbon\Carbon::parse($salida_no_conforme->fecha_reporte)->format('Y-m-d') : '';
@endphp
<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800">Editar Salida No Conforme</h1>
                <p class="mt-1 text-sm text-gray-500">Folio {{ $salida_no_conforme->folio }}</p>
            </div>
            <a href="{{ route('salida-no-conforme.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">
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

        <form method="POST" action="{{ route('salida-no-conforme.update', $salida_no_conforme) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                <div class="bg-gray-100 px-6 py-4 border-b border-gray-200">
                    <h2 class="text-base font-semibold text-gray-800">Datos del reporte</h2>
                </div>
                <div class="p-6 grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div>
                        <label for="folio" class="block text-sm font-medium text-gray-700">Folio <span class="text-red-500">*</span></label>
                        <input type="text" name="folio" id="folio" value="{{ old('folio', $salida_no_conforme->folio) }}" required class="mt-1 block w-full rounded-md border px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 {{ $errors->has('folio') ? 'border-red-500' : 'border-gray-300' }}">
                        @error('folio')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="fecha_reporte" class="block text-sm font-medium text-gray-700">Fecha de reporte <span class="text-red-500">*</span></label>
                        <input type="date" name="fecha_reporte" id="fecha_reporte" value="{{ old('fecha_reporte', $fechaReporte) }}" required class="mt-1 block w-full rounded-md border px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 {{ $errors->has('fecha_reporte') ? 'border-red-500' : 'border-gray-300' }}">
                        @error('fecha_reporte')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="area_detectada" class="block text-sm font-medium text-gray-700">Área donde se detectó <span class="text-red-500">*</span></label>
                        <input type="text" name="area_detectada" id="area_detectada" value="{{ old('area_detectada', $salida_no_conforme->area_detectada) }}" required class="mt-1 block w-full rounded-md border px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 {{ $errors->has('area_detectada') ? 'border-red-500' : 'border-gray-300' }}">
                        @error('area_detectada')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="responsable_reporte" class="block text-sm font-medium text-gray-700">Responsable del reporte <span class="text-red-500">*</span></label>
                        <input type="text" name="responsable_reporte" id="responsable_reporte" value="{{ old('responsable_reporte', $salida_no_conforme->responsable_reporte) }}" required class="mt-1 block w-full rounded-md border px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 {{ $errors->has('responsable_reporte') ? 'border-red-500' : 'border-gray-300' }}">
                        @error('responsable_reporte')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
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
                    <h2 class="text-base font-semibold text-gray-800">Detalle de la no conformidad</h2>
                </div>
                <div class="p-6 space-y-6">
                    <div>
                        <label for="descripcion_falla" class="block text-sm font-medium text-gray-700">Descripción de la falla o no conformidad <span class="text-red-500">*</span></label>
                        <textarea name="descripcion_falla" id="descripcion_falla" rows="4" required class="mt-1 block w-full rounded-md border px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 {{ $errors->has('descripcion_falla') ? 'border-red-500' : 'border-gray-300' }}">{{ old('descripcion_falla', $salida_no_conforme->descripcion_falla) }}</textarea>
                        @error('descripcion_falla')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="accion_inmediata" class="block text-sm font-medium text-gray-700">Acción inmediata tomada <span class="font-normal text-gray-400">(opcional)</span></label>
                        <textarea name="accion_inmediata" id="accion_inmediata" rows="4" class="mt-1 block w-full rounded-md border px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 {{ $errors->has('accion_inmediata') ? 'border-red-500' : 'border-gray-300' }}">{{ old('accion_inmediata', $salida_no_conforme->accion_inmediata) }}</textarea>
                        @error('accion_inmediata')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3">
                <a href="{{ route('salida-no-conforme.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">
                    Cancelar
                </a>
                <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">
                    Actualizar registro
                </button>
            </div>
        </form>
    </div>
</div>
@endsection