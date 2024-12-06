<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Carpeta extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nombre',
        'descripcion',
        'parent_id',
    ];

    public function parent()
    {
        return $this->belongsTo(Carpeta::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Carpeta::class, 'parent_id');
    }
}
