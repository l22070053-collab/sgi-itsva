<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('salidas_no_conformes', function (Blueprint $table) {
            $table->id();
            $table->string('folio')->unique();
            $table->date('fecha_reporte');
            $table->string('area_detectada');
            $table->text('descripcion_falla');
            $table->text('accion_inmediata')->nullable();
            $table->string('responsable_reporte');
            $table->enum('estado', ['Abierto', 'En proceso', 'Cerrado']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('salidas_no_conformes');
    }
};