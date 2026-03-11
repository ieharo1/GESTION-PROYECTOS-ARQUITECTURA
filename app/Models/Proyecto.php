<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Proyecto extends Model
{
    protected $fillable = ['cliente_id', 'nombre', 'descripcion', 'presupuesto', 'fecha_inicio', 'fecha_fin', 'estado', 'ubicacion'];

    protected $casts = [
        'presupuesto' => 'decimal:2',
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
    ];

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }

    public function planos(): HasMany
    {
        return $this->hasMany(Plano::class);
    }

    public function presupuestos(): HasMany
    {
        return $this->hasMany(Presupuesto::class);
    }

    public function etapas(): HasMany
    {
        return $this->hasMany(Etapa::class);
    }

    public function materiales(): HasMany
    {
        return $this->belongsToMany(Material::class, 'proyecto_materiales')
            ->withPivot('cantidad')
            ->withTimestamps();
    }
}
