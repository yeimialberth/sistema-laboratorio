<?php

namespace App\Imports;

use App\Jeringas;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CargaJeringas implements ToModel, WithHeadingRow
{
    private $rows = 0;
    public function model(array $row)
    {
        $fecha = date('Y-m-d H:i:s');
        $userId = auth()->user()->id;

        $codigoJeringa = Jeringas::where('codigo', $row['codigo'])->get()->first();
//        dd($row['codigo']);
        if(!$codigoJeringa){

            ++$this->rows;
            return new Jeringas([
                'codigo'            => $row['codigo'],
                'propietario'       => $row['propietario'],
                'descripcion'       => $row['descripcion'] ? $row['descripcion'] : '',
                'jer_lav'           => 2,
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
