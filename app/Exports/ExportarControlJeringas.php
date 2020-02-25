<?php

namespace App\Exports;

use App\Clientes;
use App\ClientesJeringas;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class ExportarControlJeringas implements FromView
{
    use Exportable;

//    public function __construct($data1, $data2, $data3)
//    {
//        $this->data1 = $data1;
//        $this->data2 = $data2;
//        $this->data3 = $data3;
//    }

    public function view(): View
    {
//        return view('elements/controljeringas/exportClienteJeringa')->with(array(
//            'dataJeringas1'     =>      $this->getAllControlJeringas(/*$clienteId, $fecha_ini, $fecha_fin*/),
//        ));

        return view('elements/controljeringas/exportClienteJeringa')->with(array(
            'dataJeringas1'     =>      $this->getAllControlJeringas(),
        ));

    }

//    public function collection(/*$cliente, $fecha_ini, $fecha_fin*/)
//    {
//        return ClientesJeringas::all();
//    }

    public function getAllControlJeringas()
    {
        return ClientesJeringas::select('clientes.cliente', 'jeringas.codigo', 'clientes_jeringas.fecha_ing_sal', 'clientes_jeringas.descripcion', 'clientes_jeringas.est_jeringa', 'clientes_jeringas.estado', 'clientes_jeringas.id')
            ->join('clientes', 'clientes.id', 'clientes_jeringas.id_cliente')
            ->join('jeringas', 'jeringas.id', 'clientes_jeringas.id_jeringa')
            ->orderBy('clientes.cliente', 'ASC')
            ->orderBy('clientes_jeringas.est_jeringa', 'ASC')
            ->orderBy('clientes_jeringas.fecha_ing_sal', 'DESC')
            ->get()->toArray();
    }
}
