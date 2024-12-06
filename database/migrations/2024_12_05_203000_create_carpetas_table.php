<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarpetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carpetas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); // Campo para el nombre de la carpeta
            $table->text('descripcion')->nullable(); // Campo para la descripción (opcional)
            $table->foreignId('parent_id')->nullable() // Relación consigo misma
                  ->constrained('carpetas') 
                  ->nullOnDelete(); // Si se elimina la carpeta padre, los hijos quedan con parent_id = null
            $table->timestamps(); // Campos created_at y updated_at
            $table->softDeletes(); // Campo deleted_at para softDeletes
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carpetas');
    }
}

