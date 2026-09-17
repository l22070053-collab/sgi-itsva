<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalidaNoConforme extends Model
{
    use HasFactory;

    protected $table = 'salidas_no_conformes';

    protected $fillable = [
        'folio',
        'fecha_reporte',
        'area_detectada',
        'descripcion_falla',
        'accion_inmediata',
        'responsable_reporte',
        'estado',
    ];

    protected function casts(): array
    {
        return [
            'fecha_reporte' => 'date',
        ];
    }
}