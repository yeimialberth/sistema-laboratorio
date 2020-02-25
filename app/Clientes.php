<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    protected $connection   = 'mysql';
    protected $table        = 'clientes';
    protected $primaryKey   = 'id';
    public $timestamps      = false;

    protected $fillable = [
        'id','cliente', 'num_id', 'telefono', 'direccion', 'correo', 'observaciones', 'user_reg', 'fecha_reg', 'user_act', 'fecha_act', 'estado'
    ];
}