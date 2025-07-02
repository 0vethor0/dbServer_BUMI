<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tbcarrera extends Model
{
    protected $table = 'tbcarrera';

    // El nombre de la clave primaria
    protected $primaryKey = 'idcarrera';

    // La clave primaria no es autoincrementable
    public $incrementing = false;

    // El tipo de la clave primaria es string
    protected $keyType = 'string';

    protected $fillable = [
        'idcarrera',
        'nombreCarrera',
    ];
}