<?php

namespace App\Exports;

use App\Clientes;
use App\ClientesJeringas;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportarCodigoJeringa implements FromQuery, WithHeadings
//class ExportarCodigoJeringa implements FromView
{
    use Exportable;

    public function __construct(int $idCli)
    {
        $this->idCli = $idCli;
    }

    public function headings(): array
    {
        return [
            'Cliente',
            'Codigo Jeringas'
        ];
    }

    public function query()
    {
        return ClientesJeringas::query()->select('clientes.cliente', 'jeringas.codigo'/*, 'jeringas.est_habilitado'*/)
            ->join('clientes', 'clientes.id', 'clientes_jeringas.id_cliente')
            ->join('jeringas', 'jeringas.id', 'clientes_jeringas.id_jeringa')
            ->where('clientes.id', $this->idCli)
            ->where('jeringas.est_habilitado', '2')
            ->where('jeringas.estado', '1')
            ->where('clientes_jeringas.estado', '1')
            ->where('clientes.estado', '1')
            ->orderBy('jeringas.codigo', 'ASC')
            ->groupBy('clientes.cliente', 'jeringas.codigo'/*, 'jeringas.est_habilitado'*/);
    }

//    public function view(): View
//    {
//        $cliente = Clientes::select('cliente', 'id')
//            ->where('id', $this->idCli)->get()->first();
//        return view('elements/jeringas/listadoCodigoJeringas')->with(array(
//            'dataJeringas'              => $this->getCodigoJeringas($this->idCli),
//            'cliente'                   => $cliente
//        ));
//
//    }
//
//    public function getCodigoJeringas($cliente)
//    {
//        return ClientesJeringas::select('clientes.cliente', 'jeringas.codigo', 'jeringas.est_habilitado')
//            ->join('clientes', 'clientes.id', 'clientes_jeringas.id_cliente')
//            ->join('jeringas', 'jeringas.id', 'clientes_jeringas.id_jeringa')
//            ->where('clientes.id', $cliente)
//            ->where('jeringas.est_habilitado', '2')
//            ->where('jeringas.estado', '1')
//            ->where('clientes_jeringas.estado', '1')
//            ->where('clientes.estado', '1')
//            ->orderBy('jeringas.codigo', 'ASC')
//            ->groupBy('clientes.cliente', 'jeringas.codigo', 'jeringas.est_habilitado')->get();
//    }
}
