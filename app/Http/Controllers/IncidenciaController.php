<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Incidencia;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class IncidenciaController extends Controller
{
    public function index(): View
    {
        $incidencias = Incidencia::latest()->paginate(15);
        return view('incidencia.index', compact('incidencias'));
    }

    public function create(): View
    {
        return view('incidencia.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'folio' => ['required', 'string', 'max:255', Rule::unique('incidencias', 'folio')],
            'fecha_incidente' => ['required', 'date'],
            'area_afectada' => ['required', 'string', 'max:255'],
            'descripcion_incidente' => ['required', 'string'],
            'nivel_gravedad' => ['required', 'string', Rule::in(['Bajo', 'Medio', 'Alto', 'Critico'])],
            'responsable_reporte' => ['required', 'string', 'max:255'],
            'estado' => ['required', 'string', Rule::in(['Abierto', 'En proceso', 'Cerrado'])],
        ]);

        Incidencia::create($validated);
        return redirect()->route('incidencia.index')->with('success', 'Incidencia registrada correctamente.');
    }

    public function show(Incidencia $incidencia): View
    {
        return view('incidencia.show', compact('incidencia'));
    }

    public function edit(Incidencia $incidencia): View
    {
        return view('incidencia.edit', compact('incidencia'));
    }

    public function update(Request $request, Incidencia $incidencia): RedirectResponse
    {
        $validated = $request->validate([
            'folio' => ['required', 'string', 'max:255', Rule::unique('incidencias', 'folio')->ignore($incidencia->id)],
            'fecha_incidente' => ['required', 'date'],
            'area_afectada' => ['required', 'string', 'max:255'],
            'descripcion_incidente' => ['required', 'string'],
            'nivel_gravedad' => ['required', 'string', Rule::in(['Bajo', 'Medio', 'Alto', 'Critico'])],
            'responsable_reporte' => ['required', 'string', 'max:255'],
            'estado' => ['required', 'string', Rule::in(['Abierto', 'En proceso', 'Cerrado'])],
        ]);

        $incidencia->update($validated);
        return redirect()->route('incidencia.index')->with('success', 'Incidencia actualizada correctamente.');
    }

    public function destroy(Incidencia $incidencia): RedirectResponse
    {
        $incidencia->delete();
        return redirect()->route('incidencia.index')->with('success', 'Incidencia eliminada correctamente.');
    }
}