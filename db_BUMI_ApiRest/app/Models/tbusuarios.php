<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tbusuarios extends Model
{
    protected $table = 'tbusuarios';

    // El nombre de la clave primaria
    protected $primaryKey = 'id_usuario';

    // La clave primaria no es autoincrementable
    public $incrementing = false;

    // El tipo de la clave primaria es string
    protected $keyType = 'string';
    
    protected $fillable = [
        'id_usuario',
        '1er_NombreUser',
        '1er_ApellidoUser',
        'contraseña',
        'idTipoUsuario ',
        'correo',
    ];
}
