<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::table('salidas_no_conformes', function (Blueprint $table) {
        $table->string('proceso_operativo')->nullable()->after('area_detectada');
    });
}

public function down(): void
{
    Schema::table('salidas_no_conformes', function (Blueprint $table) {
        $table->dropColumn('proceso_operativo');
    });
  }
};
