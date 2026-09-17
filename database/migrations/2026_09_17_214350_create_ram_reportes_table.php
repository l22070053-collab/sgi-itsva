<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ram_reportes', function (Blueprint $table) {
            $table->id();
            $table->string('folio')->unique();
            $table->date('fecha_elaboracion');
            $table->string('norma');
            $table->string('requisito');
            $table->string('proceso_estrategico');
            $table->string('proceso_operativo');
            $table->enum('origen_accion', [
                'Resultados de auditorias',
                'Quejas y/o sugerencias',
                'Percepcion estudiantes',
                'Evaluacion proceso',
                'Analisis riesgos',
                'Evaluacion docente',
                'Revision por direccion',
                'Clima laboral',
                'Revision indicadores',
            ]);
            $table->text('situacion_actual');
            $table->text('descripcion_recomendacion');
            $table->text('resultados_esperados');
            $table->string('responsable_definir_accion');
            $table->text('lecciones_aprendidas')->nullable();
            $table->date('fecha_verificacion')->nullable();
            $table->string('responsable_verificar_accion')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ram_reportes');
    }
};