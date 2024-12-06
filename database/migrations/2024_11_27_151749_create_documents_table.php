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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); // Nombre de la carpeta o archivo
            $table->enum('tipo', ['carpeta', 'archivo']);
            $table->foreignId('parent_id')->nullable()->constrained('archivists')->nullOnDelete(); // Relación consigo mismo
            $table->softDeletes();
            $table->string('archivo')->nullable()->after('parent_id');
            $table->date('fecha')->nullable()->after('archivo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
