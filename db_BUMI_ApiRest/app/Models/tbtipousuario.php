<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tbtipousuario extends Model
{
    protected $table = 'tbtipousuario';

    // El nombre de la clave primaria
    protected $primaryKey = 'idTipoUsuario';

    // La clave primaria no es autoincrementable
    public $incrementing = false;

    // El tipo de la clave primaria es string
    protected $keyType = 'string';
    
    protected $fillable = [
        'idTipoUsuario',
        'tipo',
        'rol_Usuario'
    ];
}
