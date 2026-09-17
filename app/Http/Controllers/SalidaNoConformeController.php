<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\SalidaNoConforme;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class SalidaNoConformeController extends Controller
{
    public function index(): View
    {
        $salidasNoConformes = SalidaNoConforme::latest()->paginate(15);
        return view('salida-no-conforme.index', compact('salidasNoConformes'));
    }

    public function create(): View
    {
        return view('salida-no-conforme.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'folio' => ['required', 'string', 'max:255', Rule::unique('salidas_no_conformes', 'folio')],
            'fecha_reporte' => ['required', 'date'],
            'area_detectada' => ['required', 'string', 'max:255'],
            'descripcion_falla' => ['required', 'string'],
            'accion_inmediata' => ['nullable', 'string'],
            'responsable_reporte' => ['required', 'string', 'max:255'],
            'estado' => ['required', 'string', Rule::in(['Abierto', 'En proceso', 'Cerrado'])],
        ]);

        SalidaNoConforme::create($validated);
        return redirect()->route('salida-no-conforme.index')->with('success', 'Salida no conforme registrada correctamente.');
    }

    public function show(SalidaNoConforme $salida_no_conforme): View
    {
        return view('salida-no-conforme.show', compact('salida_no_conforme'));
    }

    public function edit(SalidaNoConforme $salida_no_conforme): View
    {
        return view('salida-no-conforme.edit', compact('salida_no_conforme'));
    }

    public function update(Request $request, SalidaNoConforme $salida_no_conforme): RedirectResponse
    {
        $validated = $request->validate([
            'folio' => ['required', 'string', 'max:255', Rule::unique('salidas_no_conformes', 'folio')->ignore($salida_no_conforme->id)],
            'fecha_reporte' => ['required', 'date'],
            'area_detectada' => ['required', 'string', 'max:255'],
            'descripcion_falla' => ['required', 'string'],
            'accion_inmediata' => ['nullable', 'string'],
            'responsable_reporte' => ['required', 'string', 'max:255'],
            'estado' => ['required', 'string', Rule::in(['Abierto', 'En proceso', 'Cerrado'])],
        ]);

        $salida_no_conforme->update($validated);
        return redirect()->route('salida-no-conforme.index')->with('success', 'Salida no conforme actualizada correctamente.');
    }

    public function destroy(SalidaNoConforme $salida_no_conforme): RedirectResponse
    {
        $salida_no_conforme->delete();
        return redirect()->route('salida-no-conforme.index')->with('success', 'Salida no conforme eliminada correctamente.');
    }
}