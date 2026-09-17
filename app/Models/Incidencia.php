<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incidencia extends Model
{
    use HasFactory;

    protected $table = 'incidencias';

    protected $fillable = [
        'folio',
        'fecha_incidente',
        'area_afectada',
        'descripcion_incidente',
        'nivel_gravedad',
        'responsable_reporte',
        'estado',
    ];

    protected function casts(): array
    {
        return [
            'fecha_incidente' => 'date',
        ];
    }
}