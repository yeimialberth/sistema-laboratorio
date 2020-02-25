<?php

namespace App\Imports;

use App\Clientes;
use App\ClientesJeringas;
use App\Jeringas;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CargaIngresoJeringa implements ToModel, WithHeadingRow
{
    private $rows = 0;
    public function model(array $row)
    {
        $fecha = date('Y-m-d H:i:s');
        $userId = auth()->user()->id;
        $hora = date(' H:i:s');
        $conver_fecha = str_replace('/', '-', $row['fecha']);
        $fecha_sal = date('Y-m-d', strtotime($conver_fecha));
        $fecha_sal = $fecha_sal.$hora;

        $estadoHabilitado = Jeringas::where('id', $row['idcodigojeringa'])
            ->where('estado', 1)
            ->where('est_habilitado', 2)
            ->get()->first();
        $cliente = Clientes::where('id', $row['idcliente'])
            ->where('estado', 1)
            ->get()->first();

        if($estadoHabilitado && $cliente){
            ++$this->rows;
            $estadoHabilitado->est_habilitado = 1;
            $estadoHabilitado->save();

            return new ClientesJeringas([
                'id_cliente'        => $row['idcliente'],
                'id_jeringa'        => $row['idcodigojeringa'],
                'fecha_ing_sal'     => $fecha_sal,
                'descripcion'       => $row['descripcion'] ? $row['descripcion'] : '',
                'est_jeringa'       => 1,
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
