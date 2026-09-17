<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RacReporte extends Model
{
    use HasFactory;

    protected $table = 'rac_reportes';

    protected $fillable = [
        'folio',
        'fecha_elaboracion',
        'norma',
        'requisito',
        'proceso_estrategico',
        'proceso_operativo',
        'origen_accion',
        'descripcion_problema',
        'responsable_definir_accion',
        'herramienta_calidad',
        'proceso_causa_raiz',
        'causa_raiz_identificada',
        'existen_nc_similares',
        'descripcion_nc_similares',
        'consecuencias',
        'correccion_realizar',
        'lecciones_aprendidas',
        'fecha_verificacion',
        'responsable_verificar_accion',
    ];

    protected function casts(): array
    {
        return [
            'fecha_elaboracion' => 'date',
            'existen_nc_similares' => 'boolean',
            'fecha_verificacion' => 'date',
        ];
    }

    public function planesAccion(): HasMany
    {
        return $this->hasMany(RacPlanAccion::class, 'rac_reporte_id');
    }
}