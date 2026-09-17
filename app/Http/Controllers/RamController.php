<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\RamReporte;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class RamController extends Controller
{
    public function index(): View
    {
        $ramReportes = RamReporte::with('planesAccion')->latest()->paginate(15);
        return view('ram.index', compact('ramReportes'));
    }

    public function create(): View
    {
        return view('ram.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'folio' => ['required', 'string', 'max:255', Rule::unique('ram_reportes', 'folio')],
            'fecha_elaboracion' => ['required', 'date'],
            'norma' => ['required', 'string', 'max:255'],
            'requisito' => ['required', 'string', 'max:255'],
            'proceso_estrategico' => ['required', 'string', 'max:255'],
            'proceso_operativo' => ['required', 'string', 'max:255'],
            'origen_accion' => ['required', 'string', Rule::in(['Resultados de auditorias', 'Quejas y/o sugerencias', 'Percepcion estudiantes', 'Evaluacion proceso', 'Analisis riesgos', 'Evaluacion docente', 'Revision por direccion', 'Clima laboral', 'Revision indicadores'])],
            'situacion_actual' => ['required', 'string'],
            'descripcion_recomendacion' => ['required', 'string'],
            'resultados_esperados' => ['required', 'string'],
            'responsable_definir_accion' => ['required', 'string', 'max:255'],
            'lecciones_aprendidas' => ['nullable', 'string'],
            'fecha_verificacion' => ['nullable', 'date'],
            'responsable_verificar_accion' => ['nullable', 'string', 'max:255'],
            'planes_accion' => ['required', 'array', 'min:1'],
            'planes_accion.*.accion' => ['required', 'string'],
            'planes_accion.*.responsable_implementacion' => ['required', 'string', 'max:255'],
            'planes_accion.*.fecha_programada' => ['required', 'date'],
            'planes_accion.*.evidencia' => ['nullable', 'string'],
        ]);

        DB::transaction(function () use ($validated) {
            $ramReporte = RamReporte::create(collect($validated)->except('planes_accion')->all());
            foreach ($validated['planes_accion'] as $plan) {
                $ramReporte->planesAccion()->create($plan);
            }
        });

        return redirect()->route('ram.index')->with('success', 'Reporte RAM creado correctamente.');
    }

    public function show(RamReporte $ram): View
    {
        $ram->load('planesAccion');
        return view('ram.show', compact('ram'));
    }

    public function edit(RamReporte $ram): View
    {
        $ram->load('planesAccion');
        return view('ram.edit', compact('ram'));
    }

    public function update(Request $request, RamReporte $ram): RedirectResponse
    {
        $validated = $request->validate([
            'folio' => ['required', 'string', 'max:255', Rule::unique('ram_reportes', 'folio')->ignore($ram->id)],
            'fecha_elaboracion' => ['required', 'date'],
            'norma' => ['required', 'string', 'max:255'],
            'requisito' => ['required', 'string', 'max:255'],
            'proceso_estrategico' => ['required', 'string', 'max:255'],
            'proceso_operativo' => ['required', 'string', 'max:255'],
            'origen_accion' => ['required', 'string', Rule::in(['Resultados de auditorias', 'Quejas y/o sugerencias', 'Percepcion estudiantes', 'Evaluacion proceso', 'Analisis riesgos', 'Evaluacion docente', 'Revision por direccion', 'Clima laboral', 'Revision indicadores'])],
            'situacion_actual' => ['required', 'string'],
            'descripcion_recomendacion' => ['required', 'string'],
            'resultados_esperados' => ['required', 'string'],
            'responsable_definir_accion' => ['required', 'string', 'max:255'],
            'lecciones_aprendidas' => ['nullable', 'string'],
            'fecha_verificacion' => ['nullable', 'date'],
            'responsable_verificar_accion' => ['nullable', 'string', 'max:255'],
            'planes_accion' => ['required', 'array', 'min:1'],
            'planes_accion.*.id' => ['nullable', 'integer'],
            'planes_accion.*.accion' => ['required', 'string'],
            'planes_accion.*.responsable_implementacion' => ['required', 'string', 'max:255'],
            'planes_accion.*.fecha_programada' => ['required', 'date'],
            'planes_accion.*.evidencia' => ['nullable', 'string'],
        ]);

        DB::transaction(function () use ($validated, $ram) {
            $ram->update(collect($validated)->except('planes_accion')->all());
            $idsEnviados = collect($validated['planes_accion'])->pluck('id')->filter()->all();
            $ram->planesAccion()->whereNotIn('id', $idsEnviados)->delete();

            foreach ($validated['planes_accion'] as $plan) {
                $datosPlan = collect($plan)->except('id')->all();
                if (!empty($plan['id'])) {
                    $ram->planesAccion()->whereKey($plan['id'])->update($datosPlan);
                } else {
                    $ram->planesAccion()->create($datosPlan);
                }
            }
        });

        return redirect()->route('ram.index')->with('success', 'Reporte RAM actualizado correctamente.');
    }

    public function destroy(RamReporte $ram): RedirectResponse
    {
        DB::transaction(function () use ($ram) {
            $ram->planesAccion()->delete();
            $ram->delete();
        });

        return redirect()->route('ram.index')->with('success', 'Reporte RAM eliminado correctamente.');
    }
}