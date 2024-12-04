<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;


class archivist extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = ['nombre', 'tipo', 'parent_id', 'archivo'];

    protected static function boot()
    {
        parent::boot();

        // Evento para eliminar el archivo físico
        static::deleting(function ($archivist) {
            if ($archivist->archivo) {
                Storage::delete($archivist->archivo);
            }
        });
    }
    /**
     * Relación con el padre (la carpeta que contiene este elemento).
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Archivist::class, 'parent_id');
    }

    /**
     * Relación con los hijos (elementos dentro de esta carpeta).
     */
    public function children(): HasMany
    {
        return $this->hasMany(Archivist::class, 'parent_id');
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
