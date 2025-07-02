<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tbproyecto extends Model
{
    protected $table = 'tbproyecto';
    protected $primaryKey = 'idproyecto';
    // El nombre de la clave primaria
    

    // La clave primaria no es autoincrementable
    public $incrementing = false;

    // El tipo de la clave primaria es string
    protected $keyType = 'string';

    protected $fillable = [
        
        'idproyecto',
        'Titulo',
        'objetivo_general',
        'objetivos_especificos',
        'resumen',
        'tipoInvestigacion',
        'idAreaInvestigacion',    

    ];
}
