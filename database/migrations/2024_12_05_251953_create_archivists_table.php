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
        Schema::create('archivists', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); // Nombre de la carpeta o archivo
            $table->foreignId('carpeta_id')->nullable() // Relación con carpetas
            ->constrained('carpetas') // Hace referencia a la tabla carpetas
            ->nullOnDelete(); // Si se elimina la carpeta, el campo queda como null
            $table->foreignId('parent_id')->nullable()->constrained('archivists')->nullOnDelete(); // Relación consigo mismo
            $table->softDeletes(); // Agregar Soft Deletes
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('archivists');
    }
};
