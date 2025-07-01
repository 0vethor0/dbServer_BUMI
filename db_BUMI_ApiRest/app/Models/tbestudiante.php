<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tbestudiante extends Model
{
    protected $table = 'tbestudiante';

    // El nombre de la clave primaria
    protected $primaryKey = 'cedulaEstudiante';

    // La clave primaria no es autoincrementable
    public $incrementing = false;

    // El tipo de la clave primaria es string
    protected $keyType = 'string';

    protected $fillable = [
        '1er_nombre',
        '2do_nombre',
        '1er_ape',
        '2do_ape',
        'idcarrera',
        'cedulaTutor'
    ];
}
