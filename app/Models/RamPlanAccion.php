<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RamPlanAccion extends Model
{
    use HasFactory;

    protected $table = 'ram_planes_accion';

    protected $fillable = [
        'ram_reporte_id',
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

    public function ramReporte(): BelongsTo
    {
        return $this->belongsTo(RamReporte::class, 'ram_reporte_id');
    }
}