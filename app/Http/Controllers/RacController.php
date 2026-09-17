<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\RacReporte;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class RacController extends Controller
{
    public function index(): View
    {
        $racReportes = RacReporte::with('planesAccion')->latest()->paginate(15);
        return view('rac.index', compact('racReportes'));
    }

    public function create(): View
    {
        return view('rac.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'folio' => ['required', 'string', 'max:255', Rule::unique('rac_reportes', 'folio')],
            'fecha_elaboracion' => ['required', 'date'],
            'norma' => ['required', 'string', 'max:255'],
            'requisito' => ['required', 'string', 'max:255'],
            'proceso_estrategico' => ['required', 'string', 'max:255'],
            'proceso_operativo' => ['required', 'string', 'max:255'],
            'origen_accion' => ['required', 'string', Rule::in(['Salida no conforme', 'No conformidad', 'Incidente', 'Queja'])],
            'descripcion_problema' => ['required', 'string'],
            'responsable_definir_accion' => ['required', 'string', 'max:255'],
            'herramienta_calidad' => ['required', 'string', 'max:255'],
            'proceso_causa_raiz' => ['required', 'string'],
            'causa_raiz_identificada' => ['required', 'string'],
            'existen_nc_similares' => ['required', 'boolean'],
            'descripcion_nc_similares' => ['nullable', 'string'],
            'consecuencias' => ['required', 'string'],
            'correccion_realizar' => ['required', 'string'],
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
            $racReporte = RacReporte::create(collect($validated)->except('planes_accion')->all());
            foreach ($validated['planes_accion'] as $plan) {
                $racReporte->planesAccion()->create($plan);
            }
        });

        return redirect()->route('rac.index')->with('success', 'Reporte RAC creado correctamente.');
    }

    public function show(RacReporte $rac): View
    {
        $rac->load('planesAccion');
        return view('rac.show', compact('rac'));
    }

    public function edit(RacReporte $rac): View
    {
        $rac->load('planesAccion');
        return view('rac.edit', compact('rac'));
    }

    public function update(Request $request, RacReporte $rac): RedirectResponse
    {
        $validated = $request->validate([
            'folio' => ['required', 'string', 'max:255', Rule::unique('rac_reportes', 'folio')->ignore($rac->id)],
            'fecha_elaboracion' => ['required', 'date'],
            'norma' => ['required', 'string', 'max:255'],
            'requisito' => ['required', 'string', 'max:255'],
            'proceso_estrategico' => ['required', 'string', 'max:255'],
            'proceso_operativo' => ['required', 'string', 'max:255'],
            'origen_accion' => ['required', 'string', Rule::in(['Salida no conforme', 'No conformidad', 'Incidente', 'Queja'])],
            'descripcion_problema' => ['required', 'string'],
            'responsable_definir_accion' => ['required', 'string', 'max:255'],
            'herramienta_calidad' => ['required', 'string', 'max:255'],
            'proceso_causa_raiz' => ['required', 'string'],
            'causa_raiz_identificada' => ['required', 'string'],
            'existen_nc_similares' => ['required', 'boolean'],
            'descripcion_nc_similares' => ['nullable', 'string'],
            'consecuencias' => ['required', 'string'],
            'correccion_realizar' => ['required', 'string'],
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

        DB::transaction(function () use ($validated, $rac) {
            $rac->update(collect($validated)->except('planes_accion')->all());
            $idsEnviados = collect($validated['planes_accion'])->pluck('id')->filter()->all();
            $rac->planesAccion()->whereNotIn('id', $idsEnviados)->delete();

            foreach ($validated['planes_accion'] as $plan) {
                $datosPlan = collect($plan)->except('id')->all();
                if (!empty($plan['id'])) {
                    $rac->planesAccion()->whereKey($plan['id'])->update($datosPlan);
                } else {
                    $rac->planesAccion()->create($datosPlan);
                }
            }
        });

        return redirect()->route('rac.index')->with('success', 'Reporte RAC actualizado correctamente.');
    }

    public function destroy(RacReporte $rac): RedirectResponse
    {
        DB::transaction(function () use ($rac) {
            $rac->planesAccion()->delete();
            $rac->delete();
        });

        return redirect()->route('rac.index')->with('success', 'Reporte RAC eliminado correctamente.');
    }
}