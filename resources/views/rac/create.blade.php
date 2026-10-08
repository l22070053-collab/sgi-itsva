@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="bg-white shadow sm:rounded-lg mb-6">
        <div class="px-4 py-5 border-b border-gray-200 sm:px-6 flex justify-between items-center">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Crear Nuevo Reporte de Acción Correctiva</h3>
            <a href="{{ route('rac.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">Volver a la lista</a>
        </div>
        
        <form action="{{ route('rac.store') }}" method="POST" class="px-4 py-5 sm:p-6">
            @csrf

            <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6 mb-8">
                <div class="sm:col-span-2">
                    <label for="folio" class="block text-sm font-medium text-gray-700">Folio</label>
                    <input type="text" name="folio" id="folio" value="{{ old('folio') }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('folio') border-red-300 @enderror">
                    @error('folio') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div class="sm:col-span-2">
                    <label for="fecha_elaboracion" class="block text-sm font-medium text-gray-700">Fecha de Elaboración</label>
                    <input type="date" name="fecha_elaboracion" id="fecha_elaboracion" value="{{ old('fecha_elaboracion') }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    @error('fecha_elaboracion') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div class="sm:col-span-2">
                    <label for="norma" class="block text-sm font-medium text-gray-700">Norma</label>
                    <input type="text" name="norma" id="norma" value="{{ old('norma') }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    @error('norma') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="sm:col-span-2">
                    <label for="requisito" class="block text-sm font-medium text-gray-700">Requisito</label>
                    <input type="text" name="requisito" id="requisito" value="{{ old('requisito') }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div class="sm:col-span-2">
                    <label for="proceso_estrategico" class="block text-sm font-medium text-gray-700">Proceso Estratégico</label>
                    <input type="text" name="proceso_estrategico" id="proceso_estrategico" value="{{ old('proceso_estrategico') }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div class="sm:col-span-2">
                    <label for="proceso_operativo" class="block text-sm font-medium text-gray-700">Proceso Operativo</label>
                    <input type="text" name="proceso_operativo" id="proceso_operativo" value="{{ old('proceso_operativo') }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>

                <div class="sm:col-span-6">
                    <label for="origen_accion" class="block text-sm font-medium text-gray-700">Origen de la Acción</label>
                    <select name="origen_accion" id="origen_accion" required class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Seleccione una opción</option>
                        <option value="Salida no conforme" {{ old('origen_accion') == 'Salida no conforme' ? 'selected' : '' }}>Salida no conforme</option>
                        <option value="No conformidad" {{ old('origen_accion') == 'No conformidad' ? 'selected' : '' }}>No conformidad</option>
                        <option value="Incidente" {{ old('origen_accion') == 'Incidente' ? 'selected' : '' }}>Incidente</option>
                        <option value="Queja" {{ old('origen_accion') == 'Queja' ? 'selected' : '' }}>Queja</option>
                    </select>
                    @error('origen_accion') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div class="sm:col-span-6">
                    <label for="descripcion_problema" class="block text-sm font-medium text-gray-700">Descripción del Problema</label>
                    <textarea name="descripcion_problema" id="descripcion_problema" rows="3" class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">{{ old('descripcion_problema') }}</textarea>
                </div>

                <div class="sm:col-span-3">
                    <label for="responsable_definir_accion" class="block text-sm font-medium text-gray-700">Responsable de Definir Acción</label>
                    <input type="text" name="responsable_definir_accion" id="responsable_definir_accion" value="{{ old('responsable_definir_accion') }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div class="sm:col-span-3">
                    <label for="herramienta_calidad" class="block text-sm font-medium text-gray-700">Herramienta de Calidad Utilizada</label>
                    <input type="text" name="herramienta_calidad" id="herramienta_calidad" value="{{ old('herramienta_calidad') }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>

                <div class="sm:col-span-3">
                    <label for="proceso_causa_raiz" class="block text-sm font-medium text-gray-700">Proceso Causa Raíz</label>
                    <input type="text" name="proceso_causa_raiz" id="proceso_causa_raiz" value="{{ old('proceso_causa_raiz') }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div class="sm:col-span-3">
                    <label for="causa_raiz_identificada" class="block text-sm font-medium text-gray-700">Causa Raíz Identificada</label>
                    <input type="text" name="causa_raiz_identificada" id="causa_raiz_identificada" value="{{ old('causa_raiz_identificada') }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>

                <div class="sm:col-span-6 flex items-start">
                    <div class="flex items-center h-5">
                        <input type="hidden" name="existen_nc_similares" value="0">
                        <input id="existen_nc_similares" name="existen_nc_similares" type="checkbox" value="1" {{ old('existen_nc_similares') ? 'checked' : '' }} class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="existen_nc_similares" class="font-medium text-gray-700">¿Existen No Conformidades similares?</label>
                    </div>
                </div>

                <div class="sm:col-span-6">
                    <label for="descripcion_nc_similares" class="block text-sm font-medium text-gray-700">Descripción de NC Similares</label>
                    <textarea name="descripcion_nc_similares" id="descripcion_nc_similares" rows="2" class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">{{ old('descripcion_nc_similares') }}</textarea>
                </div>

                <div class="sm:col-span-6">
                    <label for="consecuencias" class="block text-sm font-medium text-gray-700">Consecuencias</label>
                    <textarea name="consecuencias" id="consecuencias" rows="2" class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">{{ old('consecuencias') }}</textarea>
                </div>
                <div class="sm:col-span-6">
                    <label for="correccion_realizar" class="block text-sm font-medium text-gray-700">Corrección a Realizar</label>
                    <textarea name="correccion_realizar" id="correccion_realizar" rows="2" class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">{{ old('correccion_realizar') }}</textarea>
                </div>
                <div class="sm:col-span-6">
                    <label for="lecciones_aprendidas" class="block text-sm font-medium text-gray-700">Lecciones Aprendidas</label>
                    <textarea name="lecciones_aprendidas" id="lecciones_aprendidas" rows="2" class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">{{ old('lecciones_aprendidas') }}</textarea>
                </div>

                <div class="sm:col-span-3">
                    <label for="fecha_verificacion" class="block text-sm font-medium text-gray-700">Fecha de Verificación</label>
                    <input type="date" name="fecha_verificacion" id="fecha_verificacion" value="{{ old('fecha_verificacion') }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div class="sm:col-span-3">
                    <label for="responsable_verificar_accion" class="block text-sm font-medium text-gray-700">Responsable de Verificar Acción</label>
                    <input type="text" name="responsable_verificar_accion" id="responsable_verificar_accion" value="{{ old('responsable_verificar_accion') }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
            </div>

            <div class="border-t border-gray-200 pt-8 pb-4">
                <div class="flex justify-between items-center mb-4">
                    <h4 class="text-lg leading-6 font-medium text-gray-900">Planes de Acción</h4>
                    <button type="button" id="btn-add-plan" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        + Agregar Fila
                    </button>
                </div>
                
                <div class="overflow-x-auto shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900">Acción</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Responsable</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Fecha Programada</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Evidencia</th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6"><span class="sr-only">Quitar</span></th>
                            </tr>
                        </thead>
                        <tbody id="planes-tbody" class="divide-y divide-gray-200 bg-white">
                            <tr>
                                <td class="whitespace-nowrap py-2 pl-4 pr-3 text-sm text-gray-500">
                                    <input type="text" name="planes_accion[0][accion]" required class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                </td>
                                <td class="whitespace-nowrap px-3 py-2 text-sm text-gray-500">
                                    <input type="text" name="planes_accion[0][responsable_implementacion]" required class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                </td>
                                <td class="whitespace-nowrap px-3 py-2 text-sm text-gray-500">
                                    <input type="date" name="planes_accion[0][fecha_programada]" required class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                </td>
                                <td class="whitespace-nowrap px-3 py-2 text-sm text-gray-500">
                                    <input type="text" name="planes_accion[0][evidencia]" required class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                </td>
                                <td class="relative whitespace-nowrap py-2 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                    <button type="button" class="btn-remove-plan text-red-600 hover:text-red-900 font-bold px-2 py-1">X</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="pt-5 border-t border-gray-200 flex justify-end space-x-3">
                <a href="{{ route('rac.index') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Cancelar</a>
                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Guardar Reporte</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let planIndex = 1;
        const tbody = document.getElementById('planes-tbody');
        const btnAdd = document.getElementById('btn-add-plan');

        btnAdd.addEventListener('click', function () {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td class="whitespace-nowrap py-2 pl-4 pr-3 text-sm text-gray-500">
                    <input type="text" name="planes_accion[${planIndex}][accion]" required class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </td>
                <td class="whitespace-nowrap px-3 py-2 text-sm text-gray-500">
                    <input type="text" name="planes_accion[${planIndex}][responsable_implementacion]" required class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </td>
                <td class="whitespace-nowrap px-3 py-2 text-sm text-gray-500">
                    <input type="date" name="planes_accion[${planIndex}][fecha_programada]" required class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </td>
                <td class="whitespace-nowrap px-3 py-2 text-sm text-gray-500">
                    <input type="text" name="planes_accion[${planIndex}][evidencia]" required class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </td>
                <td class="relative whitespace-nowrap py-2 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                    <button type="button" class="btn-remove-plan text-red-600 hover:text-red-900 font-bold px-2 py-1">X</button>
                </td>
            `;
            tbody.appendChild(tr);
            planIndex++;
        });

        tbody.addEventListener('click', function (e) {
            if (e.target.classList.contains('btn-remove-plan')) {
                if(tbody.children.length > 1) {
                    e.target.closest('tr').remove();
                } else {
                    alert('Debe existir al menos un plan de acción.');
                }
            }
        });
    });
</script>
@endsection