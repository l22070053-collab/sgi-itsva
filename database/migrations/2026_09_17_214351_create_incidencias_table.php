<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('incidencias', function (Blueprint $table) {
            $table->id();
            $table->string('folio')->unique();
            $table->date('fecha_incidente');
            $table->string('area_afectada');
            $table->text('descripcion_incidente');
            $table->enum('nivel_gravedad', ['Bajo', 'Medio', 'Alto', 'Critico']);
            $table->string('responsable_reporte');
            $table->enum('estado', ['Abierto', 'En proceso', 'Cerrado']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('incidencias');
    }
};