<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class ClientesJeringas extends Model
{
    protected $connection   = 'mysql';
    protected $table        = 'clientes_jeringas';
    protected $primaryKey   = 'id';
    public $timestamps      = false;

    protected $fillable = [
        'id','id_cliente', 'id_jeringa', 'fecha_ing_sal', 'descripcion', 'est_jeringa', 'user_reg', 'fecha_reg', 'user_act', 'fecha_act', 'estado'
    ];

    public function cliente(){
        return $this->hasOne('App\Clientes', 'id','id_cliente');
    }

    public function jeringa(){
        return $this->hasOne('App\Jeringas', 'id','id_jeringa');
    }
}