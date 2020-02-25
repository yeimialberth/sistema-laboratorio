<?php

namespace App\Http\Controllers;



use App\Imports\CargaClientes;
use App\Imports\CargaIngresoJeringa;
use App\Imports\CargaJeringas;
use App\Imports\CargaJeringasLavados;
use App\Imports\CargaSalidaJeringa;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CargaDatosController extends Controller
{
    public function index()
    {
        return view('elements/cargadatos/index')->with(array(
            'titleModule'              => 'Importaciones de datos',
            'titleSubModule'           => '',
            'test'                      => 'hola mundo desde carga datos'
        ));
    }

    public function cargaIngresoJeringa(Request $request)
    {
        $file = $request->file('impIngreso');
        if($file)
        {
            $import = new CargaIngresoJeringa;
            Excel::import($import, $file);
            $count = $import->getRowCount();
            if($count == 0){
                return back()->with('messageIngresoJeringa', 'No se agrego ningun ingreso de jeringa.');
            }else{
                return back()->with('message1', 'La Importacion de ingreso de jeringas fue exitoso!. Se agregaron '.$count.' Ingresos de Jeringas');
            }

        }else{
            return back()->with('message11', 'No selecciono ningun archivo. Favor debe seleccionar un archivo.');
        }
    }

    public function cargaSalidaJeringa(Request $request)
    {
        $file = $request->file('ImpSalida');
        if($file)
        {
            $import = new CargaSalidaJeringa;
            Excel::import($import, $file);
            $count = $import->getRowCount();

            if($count == 0){
                return back()->with('messageSalidaJeringa', 'No se agrego ninguna salida de jeringas.');
            }else{
                return back()->with('message2', 'La Importacion de salida de jeringas fue exitoso!. Se agregaron '.$count.' Salidas de Jeringas');
            }
        }else{
            return back()->with('message22', 'No selecciono ningun archivo. Favor debe seleccionar un archivo.');
        }
    }

    public function cargaJeringas(Request $request)
    {
        $file = $request->file('impJeringas');
        if($file)
        {
            $import = new CargaJeringas;
            Excel::import($import, $file);

//            dd('Row count: ' . $import->getRowCount());
            $count = $import->getRowCount();
            if($count == 0)
            {
                return back()->with('messageCountJeringa', 'No se agrego ninguna jeringa.');
            }else{
                return back()->with('message3', 'La Importacion de jeringas fue exitoso!. Se agregaron '.$count.' Jeringas');
            }

        }else{
            return back()->with('message33', 'No selecciono ningun archivo. Favor debe seleccionar un archivo.');
        }
    }

    public function cargaClientes(Request $request)
    {
        $file = $request->file('impClientes');
        if($file)
        {
            $import = new  CargaClientes;
            Excel::import($import, $file);
            $count = $import->getRowCount();
            if($count == 0)
            {
                return back()->with('messageCountCliente', 'No se agrego ningun cliente.');
            }else{
                return back()->with('message4', 'La Importacion de clientes fue exitoso!. Se agregaron '.$count.' Clientes');
            }
        }else{
            return back()->with('message44', 'No selecciono ningun archivo. Favor debe seleccionar un archivo.');
        }
    }

    public function cargaJeringasLavado(Request $request)
    {
        $file = $request->file('impJeringaLavado');
        if($file)
        {
        Excel::import(new CargaJeringasLavados, $file);

        return back()->with('message5', 'La Importacion de jeringas lavados fue exitoso!');
        }else{
            return back()->with('message55', 'No selecciono ningun archivo. Favor debe seleccionar un archivo.');
        }
    }

}