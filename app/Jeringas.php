<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Jeringas extends Model
{
    protected $connection   = 'mysql';
    protected $table        = 'jeringas';
    protected $primaryKey   = 'id';
    public $timestamps      = false;

    protected $fillable = [
        'id','codigo', 'descripcion', 'propietario', 'est_habilitado', 'jer_lav', 'user_reg', 'fecha_reg', 'user_act', 'fecha_act', 'estado'
    ];
}