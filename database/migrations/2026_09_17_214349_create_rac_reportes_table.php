<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rac_reportes', function (Blueprint $table) {
            $table->id();
            $table->string('folio')->unique();
            $table->date('fecha_elaboracion');
            $table->string('norma');
            $table->string('requisito');
            $table->string('proceso_estrategico');
            $table->string('proceso_operativo');
            $table->enum('origen_accion', ['Salida no conforme', 'No conformidad', 'Incidente', 'Queja']);
            $table->text('descripcion_problema');
            $table->string('responsable_definir_accion');
            $table->string('herramienta_calidad');
            $table->text('proceso_causa_raiz');
            $table->text('causa_raiz_identificada');
            $table->boolean('existen_nc_similares');
            $table->text('descripcion_nc_similares')->nullable();
            $table->text('consecuencias');
            $table->text('correccion_realizar');
            $table->text('lecciones_aprendidas')->nullable();
            $table->date('fecha_verificacion')->nullable();
            $table->string('responsable_verificar_accion')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rac_reportes');
    }
};