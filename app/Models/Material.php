<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Material extends Model
{
    protected $fillable = ['nombre', 'unidad', 'costo_unitario'];

    protected $casts = [
        'costo_unitario' => 'decimal:2',
    ];

    public function proyectos(): BelongsToMany
    {
        return $this->belongsToMany(Proyecto::class, 'proyecto_materiales')
            ->withPivot('cantidad')
            ->withTimestamps();
    }
}
