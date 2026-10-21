@extends('layouts.app')

@section('content')
@php
    $planes = old('planes_accion');
    if (empty($planes)) {
        $planes = $ram->planesAccion->map(function ($item) {
            return [
                'id' => $item->id,
                'accion' => $item->accion,
                'responsable_implementacion' => $item->responsable_implementacion,
                'fecha_programada' => $item->fecha_programada ? \Carbon\Carbon::parse($item->fecha_programada)->format('Y-m-d') : '',
                'evidencia' => $item->evidencia,
            ];
        })->values()->all();
    }
    if (empty($planes)) {
        $planes = [
            ['accion' => '', 'responsable_implementacion' => '', 'fecha_programada' => '', 'evidencia' => ''],
        ];
    }
    $origenActual = old('origen_accion', $ram->origen_accion);
    $fechaElaboracion = $ram->fecha_elaboracion ? \Carbon\Carbon::parse($ram->fecha_elaboracion)->format('Y-m-d') : '';
    $fechaVerificacion = $ram->fecha_verificacion ? \Carbon\Carbon::parse($ram->fecha_verificacion)->format('Y-m-d') : '';
@endphp
<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800">Editar Reporte de Acciones de Mejora</h1>
                <p class="mt-1 text-sm text-gray-500">Folio {{ $ram->folio }}</p>
            </div>
            <a href="{{ route('ram.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">
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

        <form method="POST" action="{{ route('ram.update', $ram) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                <div class="bg-gray-100 px-6 py-4 border-b border-gray-200">
                    <h2 class="text-base font-semibold text-gray-800">Datos generales</h2>
                </div>
                <div class="p-6 grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div>
                        <label for="folio" class="block text-sm font-medium text-gray-700">Folio <span class="text-red-500">*</span></label>
                        <input type="text" name="folio" id="folio" value="{{ old('folio', $ram->folio) }}" required class="mt-1 block w-full rounded-md border px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 {{ $errors->has('folio') ? 'border-red-500' : 'border-gray-300' }}">
                        @error('folio')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="fecha_elaboracion" class="block text-sm font-medium text-gray-700">Fecha de elaboración <span class="text-red-500">*</span></label>
                        <input type="date" name="fecha_elaboracion" id="fecha_elaboracion" value="{{ old('fecha_elaboracion', $fechaElaboracion) }}" required class="mt-1 block w-full rounded-md border px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 {{ $errors->has('fecha_elaboracion') ? 'border-red-500' : 'border-gray-300' }}">
                        @error('fecha_elaboracion')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="norma" class="block text-sm font-medium text-gray-700">Norma <span class="text-red-500">*</span></label>
                        <input type="text" name="norma" id="norma" value="{{ old('norma', $ram->norma) }}" required class="mt-1 block w-full rounded-md border px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 {{ $errors->has('norma') ? 'border-red-500' : 'border-gray-300' }}">
                        @error('norma')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="requisito" class="block text-sm font-medium text-gray-700">Requisito <span class="text-red-500">*</span></label>
                        <input type="text" name="requisito" id="requisito" value="{{ old('requisito', $ram->requisito) }}" required class="mt-1 block w-full rounded-md border px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 {{ $errors->has('requisito') ? 'border-red-500' : 'border-gray-300' }}">
                        @error('requisito')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="proceso_estrategico" class="block text-sm font-medium text-gray-700">Proceso estratégico <span class="text-red-500">*</span></label>
                        <input type="text" name="proceso_estrategico" id="proceso_estrategico" value="{{ old('proceso_estrategico', $ram->proceso_estrategico) }}" required class="mt-1 block w-full rounded-md border px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 {{ $errors->has('proceso_estrategico') ? 'border-red-500' : 'border-gray-300' }}">
                        @error('proceso_estrategico')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="proceso_operativo" class="block text-sm font-medium text-gray-700">Proceso operativo <span class="text-red-500">*</span></label>
                        <input type="text" name="proceso_operativo" id="proceso_operativo" value="{{ old('proceso_operativo', $ram->proceso_operativo) }}" required class="mt-1 block w-full rounded-md border px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 {{ $errors->has('proceso_operativo') ? 'border-red-500' : 'border-gray-300' }}">
                        @error('proceso_operativo')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="origen_accion" class="block text-sm font-medium text-gray-700">Origen de la acción <span class="text-red-500">*</span></label>
                        <select name="origen_accion" id="origen_accion" required class="mt-1 block w-full rounded-md border bg-white px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 {{ $errors->has('origen_accion') ? 'border-red-500' : 'border-gray-300' }}">
                            <option value="">Seleccione una opción</option>
                            <option value="Resultados de auditorias" @selected($origenActual === 'Resultados de auditorias')>Resultados de auditorias</option>
                            <option value="Quejas y/o sugerencias" @selected($origenActual === 'Quejas y/o sugerencias')>Quejas y/o sugerencias</option>
                            <option value="Percepcion estudiantes" @selected($origenActual === 'Percepcion estudiantes')>Percepcion estudiantes</option>
                            <option value="Evaluacion proceso" @selected($origenActual === 'Evaluacion proceso')>Evaluacion proceso</option>
                            <option value="Analisis riesgos" @selected($origenActual === 'Analisis riesgos')>Analisis riesgos</option>
                            <option value="Evaluacion docente" @selected($origenActual === 'Evaluacion docente')>Evaluacion docente</option>
                            <option value="Revision por direccion" @selected($origenActual === 'Revision por direccion')>Revision por direccion</option>
                            <option value="Clima laboral" @selected($origenActual === 'Clima laboral')>Clima laboral</option>
                            <option value="Revision indicadores" @selected($origenActual === 'Revision indicadores')>Revision indicadores</option>
                        </select>
                        @error('origen_accion')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="responsable_definir_accion" class="block text-sm font-medium text-gray-700">Responsable de definir la acción <span class="text-red-500">*</span></label>
                        <input type="text" name="responsable_definir_accion" id="responsable_definir_accion" value="{{ old('responsable_definir_accion', $ram->responsable_definir_accion) }}" required class="mt-1 block w-full rounded-md border px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 {{ $errors->has('responsable_definir_accion') ? 'border-red-500' : 'border-gray-300' }}">
                        @error('responsable_definir_accion')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                <div class="bg-gray-100 px-6 py-4 border-b border-gray-200">
                    <h2 class="text-base font-semibold text-gray-800">Descripción de la acción de mejora</h2>
                </div>
                <div class="p-6 space-y-6">
                    <div>
                        <label for="situacion_actual" class="block text-sm font-medium text-gray-700">Situación actual <span class="text-red-500">*</span></label>
                        <textarea name="situacion_actual" id="situacion_actual" rows="4" required class="mt-1 block w-full rounded-md border px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 {{ $errors->has('situacion_actual') ? 'border-red-500' : 'border-gray-300' }}">{{ old('situacion_actual', $ram->situacion_actual) }}</textarea>
                        @error('situacion_actual')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="descripcion_recomendacion" class="block text-sm font-medium text-gray-700">Descripción de la recomendación <span class="text-red-500">*</span></label>
                        <textarea name="descripcion_recomendacion" id="descripcion_recomendacion" rows="4" required class="mt-1 block w-full rounded-md border px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 {{ $errors->has('descripcion_recomendacion') ? 'border-red-500' : 'border-gray-300' }}">{{ old('descripcion_recomendacion', $ram->descripcion_recomendacion) }}</textarea>
                        @error('descripcion_recomendacion')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="resultados_esperados" class="block text-sm font-medium text-gray-700">Resultados esperados <span class="text-red-500">*</span></label>
                        <textarea name="resultados_esperados" id="resultados_esperados" rows="4" required class="mt-1 block w-full rounded-md border px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 {{ $errors->has('resultados_esperados') ? 'border-red-500' : 'border-gray-300' }}">{{ old('resultados_esperados', $ram->resultados_esperados) }}</textarea>
                        @error('resultados_esperados')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                <div class="bg-gray-100 px-6 py-4 border-b border-gray-200 flex items-center justify-between gap-3">
                    <h2 class="text-base font-semibold text-gray-800">Planes de acción</h2>
                    <button type="button" id="agregar-plan" class="inline-flex items-center px-3 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">
                        Agregar plan
                    </button>
                </div>
                @error('planes_accion')
                    <p class="px-6 pt-4 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acción <span class="text-red-500">*</span></th>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Responsable de implementación <span class="text-red-500">*</span></th>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha programada <span class="text-red-500">*</span></th>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Evidencia</th>
                                <th scope="col" class="px-4 py-3"><span class="sr-only">Quitar</span></th>
                            </tr>
                        </thead>
                        <tbody id="planes-body" class="bg-white divide-y divide-gray-200">
                            @foreach ($planes as $i => $plan)
                                <tr data-plan-row>
                                    <td class="px-4 py-3 align-top text-sm text-gray-500"><span data-row-number>{{ $loop->iteration }}</span></td>
                                    <td class="px-4 py-3 align-top">
                                        @if (! empty($plan['id']))
                                            <input type="hidden" name="planes_accion[{{ $i }}][id]" data-field="id" value="{{ $plan['id'] }}">
                                        @endif
                                        <input type="text" name="planes_accion[{{ $i }}][accion]" data-field="accion" value="{{ $plan['accion'] ?? '' }}" required class="block w-full rounded-md border px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 {{ $errors->has('planes_accion.' . $i . '.accion') ? 'border-red-500' : 'border-gray-300' }}">
                                        @error('planes_accion.' . $i . '.accion')
                                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                        @enderror
                                    </td>
                                    <td class="px-4 py-3 align-top">
                                        <input type="text" name="planes_accion[{{ $i }}][responsable_implementacion]" data-field="responsable_implementacion" value="{{ $plan['responsable_implementacion'] ?? '' }}" required class="block w-full rounded-md border px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 {{ $errors->has('planes_accion.' . $i . '.responsable_implementacion') ? 'border-red-500' : 'border-gray-300' }}">
                                        @error('planes_accion.' . $i . '.responsable_implementacion')
                                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                        @enderror
                                    </td>
                                    <td class="px-4 py-3 align-top">
                                        <input type="date" name="planes_accion[{{ $i }}][fecha_programada]" data-field="fecha_programada" value="{{ $plan['fecha_programada'] ?? '' }}" required class="block w-full rounded-md border px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 {{ $errors->has('planes_accion.' . $i . '.fecha_programada') ? 'border-red-500' : 'border-gray-300' }}">
                                        @error('planes_accion.' . $i . '.fecha_programada')
                                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                        @enderror
                                    </td>
                                    <td class="px-4 py-3 align-top">
                                        <input type="text" name="planes_accion[{{ $i }}][evidencia]" data-field="evidencia" value="{{ $plan['evidencia'] ?? '' }}" class="block w-full rounded-md border px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 {{ $errors->has('planes_accion.' . $i . '.evidencia') ? 'border-red-500' : 'border-gray-300' }}">
                                        @error('planes_accion.' . $i . '.evidencia')
                                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                        @enderror
                                    </td>
                                    <td class="px-4 py-3 align-top text-right">
                                        <button type="button" data-remove-row aria-label="Eliminar plan de acción" class="inline-flex items-center px-2 py-2 text-sm font-medium text-red-600 hover:text-red-800 disabled:opacity-40 disabled:cursor-not-allowed disabled:hover:text-red-600">
                                            Eliminar
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                <div class="bg-gray-100 px-6 py-4 border-b border-gray-200">
                    <h2 class="text-base font-semibold text-gray-800">Verificación y cierre</h2>
                </div>
                <div class="p-6 grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div>
                        <label for="fecha_verificacion" class="block text-sm font-medium text-gray-700">Fecha de verificación <span class="font-normal text-gray-400">(opcional)</span></label>
                        <input type="date" name="fecha_verificacion" id="fecha_verificacion" value="{{ old('fecha_verificacion', $fechaVerificacion) }}" class="mt-1 block w-full rounded-md border px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 {{ $errors->has('fecha_verificacion') ? 'border-red-500' : 'border-gray-300' }}">
                        @error('fecha_verificacion')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="responsable_verificar_accion" class="block text-sm font-medium text-gray-700">Responsable de verificar la acción <span class="font-normal text-gray-400">(opcional)</span></label>
                        <input type="text" name="responsable_verificar_accion" id="responsable_verificar_accion" value="{{ old('responsable_verificar_accion', $ram->responsable_verificar_accion) }}" class="mt-1 block w-full rounded-md border px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 {{ $errors->has('responsable_verificar_accion') ? 'border-red-500' : 'border-gray-300' }}">
                        @error('responsable_verificar_accion')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="lecciones_aprendidas" class="block text-sm font-medium text-gray-700">Lecciones aprendidas <span class="font-normal text-gray-400">(opcional)</span></label>
                        <textarea name="lecciones_aprendidas" id="lecciones_aprendidas" rows="4" class="mt-1 block w-full rounded-md border px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 {{ $errors->has('lecciones_aprendidas') ? 'border-red-500' : 'border-gray-300' }}">{{ old('lecciones_aprendidas', $ram->lecciones_aprendidas) }}</textarea>
                        @error('lecciones_aprendidas')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3">
                <a href="{{ route('ram.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">
                    Cancelar
                </a>
                <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">
                    Actualizar reporte
                </button>
            </div>
        </form>

        <template id="plan-template">
            <tr data-plan-row>
                <td class="px-4 py-3 align-top text-sm text-gray-500"><span data-row-number></span></td>
                <td class="px-4 py-3 align-top">
                    <input type="text" data-field="accion" required class="block w-full rounded-md border border-gray-300 px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                </td>
                <td class="px-4 py-3 align-top">
                    <input type="text" data-field="responsable_implementacion" required class="block w-full rounded-md border border-gray-300 px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                </td>
                <td class="px-4 py-3 align-top">
                    <input type="date" data-field="fecha_programada" required class="block w-full rounded-md border border-gray-300 px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                </td>
                <td class="px-4 py-3 align-top">
                    <input type="text" data-field="evidencia" class="block w-full rounded-md border border-gray-300 px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                </td>
                <td class="px-4 py-3 align-top text-right">
                    <button type="button" data-remove-row aria-label="Eliminar plan de acción" class="inline-flex items-center px-2 py-2 text-sm font-medium text-red-600 hover:text-red-800 disabled:opacity-40 disabled:cursor-not-allowed disabled:hover:text-red-600">
                        Eliminar
                    </button>
                </td>
            </tr>
        </template>
    </div>
</div>

<script>
    (function () {
        const tbody = document.getElementById('planes-body');
        const plantilla = document.getElementById('plan-template');
        const botonAgregar = document.getElementById('agregar-plan');

        if (!tbody || !plantilla || !botonAgregar) {
            return;
        }

        const obtenerFilas = () => tbody.querySelectorAll('tr[data-plan-row]');

        const reindexar = () => {
            const filas = obtenerFilas();
            filas.forEach((fila, indice) => {
                fila.querySelectorAll('[data-field]').forEach((campo) => {
                    campo.name = 'planes_accion[' + indice + '][' + campo.dataset.field + ']';
                });
                const numero = fila.querySelector('[data-row-number]');
                if (numero) {
                    numero.textContent = indice + 1;
                }
                const botonEliminar = fila.querySelector('[data-remove-row]');
                if (botonEliminar) {
                    botonEliminar.disabled = filas.length === 1;
                }
            });
        };

        botonAgregar.addEventListener('click', () => {
            tbody.appendChild(plantilla.content.cloneNode(true));
            reindexar();
            const filas = obtenerFilas();
            const primerCampo = filas[filas.length - 1].querySelector('[data-field="accion"]');
            if (primerCampo) {
                primerCampo.focus();
            }
        });

        tbody.addEventListener('click', (evento) => {
            const boton = evento.target.closest('[data-remove-row]');
            if (!boton || obtenerFilas().length <= 1) {
                return;
            }
            boton.closest('tr').remove();
            reindexar();
        });

        reindexar();
    })();
</script>
@endsection