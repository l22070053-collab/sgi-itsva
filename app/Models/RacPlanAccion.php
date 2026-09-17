<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RacPlanAccion extends Model
{
    use HasFactory;

    protected $table = 'rac_planes_accion';

    protected $fillable = [
        'rac_reporte_id',
        'accion',
        'responsable_implementacion',
        'fecha_programada',
        'evidencia',
    ];

    protected function casts(): array
    {
        return [
            'fecha_programada' => 'date',
        ];
    }

    public function racReporte(): BelongsTo
    {
        return $this->belongsTo(RacReporte::class, 'rac_reporte_id');
    }
}