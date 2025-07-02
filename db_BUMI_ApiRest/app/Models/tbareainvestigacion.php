<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tbareainvestigacion extends Model
{
    protected $table = 'tbareainvestigacion';

    // El nombre de la clave primaria
    protected $primaryKey = 'idAreaInvestigacion';

    // La clave primaria no es autoincrementable
    public $incrementing = false;

    // El tipo de la clave primaria es string
    protected $keyType = 'string';

    protected $fillable = [
        'idAreaInvestigacion',
        'nomb_Area',
       
    ];
}
