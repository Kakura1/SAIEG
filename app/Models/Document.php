<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Document extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = ['nombre', 'archivo', 'fecha',];

    protected $casts = [
        'fecha' => 'date', // Cast para que sea tratado como una fecha
    ];

    protected static function boot()
    {
        parent::boot();

        // Evento para eliminar el archivo físico
        static::deleting(function ($document) {
            if ($document->archivo) {
                Storage::delete($document->archivo);
            }
        });
    }

    public function carpeta()
    {
        return $this->belongsTo(Carpeta::class);
    }

    public function delete()
    {
        if ($this->tipo === 'carpeta') {
            // Opcional: Marcar hijos como "huérfanos" si la carpeta es eliminada
            $this->children()->update(['parent_id' => null]);
        }

        // Realizar el soft delete
        return parent::delete();
    }
}
