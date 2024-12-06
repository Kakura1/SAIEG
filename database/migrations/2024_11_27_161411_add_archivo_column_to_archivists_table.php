<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('archivists', function (Blueprint $table) {
            $table->string('archivo')->nullable()->after('parent_id'); // Campo para la ruta del archivo
            $table->date('fecha')->nullable()->after('archivo');
        });
    }

    public function down(): void
    {
        Schema::table('archivists', function (Blueprint $table) {
            $table->dropColumn('archivo');
            $table->dropColumn('fecha');
        });
    }
};
