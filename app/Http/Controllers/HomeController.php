<?php

namespace App\Http\Controllers;

use App\ClientesJeringas;
use App\Jeringas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $totalJeringaEmp = Jeringas::select('id')->where('estado', '=', 1)->where('propietario', '=', 1)->count();
        $totalJeringaCli = Jeringas::select('id')->where('estado', '=', 1)->where('propietario', '=', 2)->count();
        $fueraUso = Jeringas::select('id')->where('estado', '=', 0)->where('propietario', '=', 1)->count();
        $jeringaPrestamo = Jeringas::select('id')
            ->where('est_habilitado', '=', 2)
            ->where('propietario', '=', 1)
            ->where('jer_lav', '=', 1)
            ->where('estado', 1)->count();
        $jeringaLavado = Jeringas::select('id')
            ->where('est_habilitado', '=', 1)
            ->where('propietario', '=', 1)
            ->where('jer_lav', '=', 2)
            ->where('estado', 1)->count();
        $jeringasSinLavar = Jeringas::select('id')
            ->where('est_habilitado', '=', 1)
            ->where('propietario', '=', 1)
            ->where('jer_lav', '=', 1)
            ->where('estado', 1)->count();

        $ingreso_salida = ClientesJeringas::select('clientes.cliente', 'jeringas.codigo', 'clientes_jeringas.fecha_ing_sal'/*, 'clientes_jeringas.descripcion'*/, 'clientes_jeringas.est_jeringa', 'clientes_jeringas.estado', DB::raw('COUNT(1) as total_ing_sal'))
            ->join('clientes', 'clientes.id', 'clientes_jeringas.id_cliente')
            ->join('jeringas', 'jeringas.id', 'clientes_jeringas.id_jeringa')
            ->where('clientes_jeringas.estado', 1)
            ->groupBy('clientes.cliente', 'jeringas.codigo', 'clientes_jeringas.fecha_ing_sal'/*, 'clientes_jeringas.descripcion'*/, 'clientes_jeringas.est_jeringa', 'clientes_jeringas.estado')
            ->orderBy('clientes_jeringas.fecha_ing_sal', 'DESC')
            ->orderBy('clientes.cliente', 'ASC')
//            ->orderBy('clientes_jeringas.fecha_ing_sal', 'DESC')
            ->limit(20)
            ->get()->toArray();
//        var_dump($ingreso_salida);
        return view('home')->with(array(
            'totalEmp'              => $totalJeringaEmp,
            'totalCli'              => $totalJeringaCli,
            'fueraUso'              => $fueraUso,
            'ingSal'                => $ingreso_salida,
            'jeringaPrestamo'       => $jeringaPrestamo,
            'jeringaLavado'         => $jeringaLavado,
            'jeringasSinLavar'      => $jeringasSinLavar
        ));
    }
}
