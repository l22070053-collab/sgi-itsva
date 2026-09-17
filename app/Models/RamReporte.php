<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RamReporte extends Model
{
    use HasFactory;

    protected $table = 'ram_reportes';

    protected $fillable = [
        'folio',
        'fecha_elaboracion',
        'norma',
        'requisito',
        'proceso_estrategico',
        'proceso_operativo',
        'origen_accion',
        'situacion_actual',
        'descripcion_recomendacion',
        'resultados_esperados',
        'responsable_definir_accion',
        'lecciones_aprendidas',
        'fecha_verificacion',
        'responsable_verificar_accion',
    ];

    protected function casts(): array
    {
        return [
            'fecha_elaboracion' => 'date',
            'fecha_verificacion' => 'date',
        ];
    }

    public function planesAccion(): HasMany
    {
        return $this->hasMany(RamPlanAccion::class, 'ram_reporte_id');
    }
}