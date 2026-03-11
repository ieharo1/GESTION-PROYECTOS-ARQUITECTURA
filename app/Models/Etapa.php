<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Etapa extends Model
{
    protected $fillable = ['proyecto_id', 'nombre', 'estado', 'fecha_inicio', 'fecha_fin', 'progreso'];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
        'progreso' => 'integer',
    ];

    public function proyecto(): BelongsTo
    {
        return $this->belongsTo(Proyecto::class);
    }
}
