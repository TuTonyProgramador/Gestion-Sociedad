<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Canario extends Model
{
    use HasFactory;

    // Definición de los atributos 
    protected $fillable = ['nombreRaza', 'anioNacimiento', 'sexo', 'numeroAnilla', 'descripcion', 'vaConcurso', 'criador_id'];

    /*
    Funcion para la relación con el modelo Criador
    Recibe: nada
    Devuelve: la relación belongsTo con el modelo Criador
    */
    public function criador(): BelongsTo {
        return $this->belongsTo(Criador::class);
    }

    /*
    Funcion para la relación con el modelo Concurso
    Recibe: nada
    Devuelve: la relación belongsToMany con el modelo Concurso
    */
    public function concursos(): BelongsToMany {
        return $this->belongsToMany(Concurso::class);
    }
}
