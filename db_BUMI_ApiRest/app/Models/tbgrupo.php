<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tbgrupo extends Model
{
    protected $table = 'tbgrupo';

    // El nombre de la clave primaria
    protected $primaryKey = 'cedulaEstudiante, idproyecto, periodoAcademico';

    // La clave primaria no es autoincrementable
    public $incrementing = false;

    // El tipo de la clave primaria es string
    protected $keyType = 'string';

    protected $fillable = [
        'idproyecto',
        'periodoAcademico',
        'cedulaEstudiante',
        'nombreGrupo',
    ];
}
