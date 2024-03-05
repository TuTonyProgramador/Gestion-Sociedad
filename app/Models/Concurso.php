<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Concurso extends Model
{
    use HasFactory;

    // Definición de los atributos 
    protected $fillable = ['fechaConcurso', 'sede', 'ubicacion', 'criador_id'];

    /*
    Funcion para la relación con el modelo Criador
    Recibe: nada
    Devuelve: la relación belongsTo con el modelo Criador
    */
    public function criador(): BelongsTo {
        return $this->belongsTo(Criador::class);
    }

    /*
    Funcion para la relación con el modelo Canario
    Recibe: nada
    Devuelve: la relación belongsToMany con el modelo Canario
    */
    public function canarios(): BelongsToMany {
        return $this->belongsToMany(Canario::class);
    }
}
