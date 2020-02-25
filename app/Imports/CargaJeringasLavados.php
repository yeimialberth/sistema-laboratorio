<?php

namespace App\Imports;

use App\Jeringas;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CargaJeringasLavados implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $codigoJeringa = Jeringas::where('id', $row['idcodigojeringa'])
            ->where('estado', 1)
            ->where('jer_lav', 1)
            ->get()->first();

        if($codigoJeringa){
            $codigoJeringa->jer_lav = 2;
            $codigoJeringa->save();
        }

//        return new Jeringas([
//            'jer_lav'           => 2
//        ]);
    }

    public function headingRow(): int
    {
        return 1;
    }
}
