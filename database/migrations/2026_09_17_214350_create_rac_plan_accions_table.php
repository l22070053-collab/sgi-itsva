<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rac_planes_accion', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rac_reporte_id')->constrained('rac_reportes')->cascadeOnDelete();
            $table->string('accion');
            $table->string('responsable_implementacion');
            $table->date('fecha_programada');
            $table->text('evidencia')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rac_planes_accion');
    }
};