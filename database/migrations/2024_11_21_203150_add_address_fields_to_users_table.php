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
        Schema::table('users', function (Blueprint $table) {
            //
            $table->foreignId('estado_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('municipio_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('direccion')->nullable();
            $table->string('codigo_postal')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};