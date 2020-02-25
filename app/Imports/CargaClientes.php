<?php

namespace App\Imports;

use App\Clientes;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CargaClientes implements ToModel, WithHeadingRow
{
    private $rows = 0;
    public function model(array $row)
    {
        $fecha = date('Y-m-d H:i:s');
        $userId = auth()->user()->id;

        $dniCliente = Clientes::where('num_id', $row['ruc'])->get()->first();
        if(!$dniCliente){
            ++$this->rows;
            return new Clientes([
                'cliente'           => $row['razonsocial'],
                'num_id'            => $row['ruc'],
                'telefono'          => $row['telefono'] ? $row['telefono'] : '',
                'direccion'         => $row['direccion'] ? $row['direccion'] : '',
                'correo'            => $row['email'] ? $row['email'] : '' ,
                'user_reg'          => $userId,
                'fecha_reg'         => $fecha,
                'user_act'          => $userId,
                'fecha_act'         => $fecha,
                'estado'            => 1
            ]);
        }
    }

    public function headingRow(): int
    {
        return 1;
    }

    public function getRowCount(): int
    {
        return $this->rows;
    }
}
