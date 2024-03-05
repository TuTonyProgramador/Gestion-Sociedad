<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;

class Criador extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // Nombre de la tabla en la base de datos
    protected $table = 'criadors';

    // Definición de los atributos 
    protected $fillable = ['numeroCriador', 'nombre', 'apellidos', 'fechaNacimiento', 'localidad', 'password', 'email', 'telefono', 'esAdmin'];

    // Atributos predeterminados
    // Para que 'esAdmin' se ponga automáticamente en false si no se especifica
    protected $attributes = [
        'esAdmin' => false,
    ];
    
    // Atributos ocultos
    protected $hidden = ['password', 'remember_token']; 

    // Conversión de tipos de datos
    protected $casts = ['email_verified_at' => 'datetime', 'password' => 'hashed'];

    /*
    Funcion para la relación con el modelo Canario
    Recibe: nada
    Devuelve: la relación hasMany con el modelo Canario
    */
    public function canarios(): HasMany {
        return $this->hasMany(Canario::class);
    }

    /*
    Funcion para la relación con el modelo Concurso
    Recibe: nada
    Devuelve: la relación hasMany con el modelo Concurso
    */
    public function concursos(): HasMany {
        return $this->hasMany(Concurso::class);
    }
}

