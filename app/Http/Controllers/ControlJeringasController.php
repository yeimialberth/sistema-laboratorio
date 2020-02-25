<?php

namespace App\Http\Controllers;


use App\Clientes;
use App\ClientesJeringas;
use App\Exports\exportarControlJeringas;
use App\Jeringas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ControlJeringasController extends Controller
{
    public function index(Request $request)
    {
        $clienteId = Clientes::where('estado', 1)->pluck('cliente', 'id');
        $fecha_ini = '';
        $fecha_fin = '';
        return view('elements/controljeringas/index')->with(array(
            'titleModule'       =>      'Ingreso y Salida de Jeringas',
            'titleSubModule'    =>      'Listado',
            'titleBox'          =>      'Listado Jeringas',
            'dataJeringas'      =>      $this->getAllControlJeringas($request->clienteId, $fecha_ini, $fecha_fin),
            'cboCliente'        =>      $clienteId
        ));
    }
    public function indexFilter(Request $request)
    {
        $clienteId = Clientes::where('estado', 1)->pluck('cliente', 'id');
//        19-01-2020+-+23-01-2020 el formato como esta llegando la fecha
//        var_dump($request->fechaIniFin);
        if($request->fechaIniFin)
        {
            $fecha_1 = substr($request->fechaIniFin, 0, 10);
            $fecha_2 = substr($request->fechaIniFin, 13, 21);
            $fecha_ini = date('Y-m-d', strtotime($fecha_1));
            $fecha_fin = date('Y-m-d', strtotime($fecha_2));
            $fecha_ini = $fecha_ini.' 00:00:00';
            $fecha_fin = $fecha_fin.' 23:59:59';
        } else {
            $fecha_ini = '';
            $fecha_fin = '';
        }
        return view('elements/controljeringas/index')->with(array(
            'titleModule'       =>      'Ingreso y Salida de Jeringas',
            'titleSubModule'    =>      'Listado',
            'titleBox'          =>      'Listado Jeringas',
            'dataJeringas'      =>      $this->getAllControlJeringas($request->clienteId, $fecha_ini, $fecha_fin),
            'cboCliente'        =>      $clienteId
        ));
    }

    public function formControlJeringas(Request $request)
    {
        $estado = ['estado'=>1, 'est_jeringa'=>$request->ingsal];
        $clienteId = Clientes::where('estado', 1)->pluck('cliente', 'id');
        return view('elements/controljeringas/form/form_control_jeringas')->with(array(
            'dataJeringa'           => $estado,
            'cboCliente'            => $clienteId,
            'selectCliente'         => '',
            'updateForm'            => false,
            'errorCodigoId'         => false
        ));
    }

    public function formControlJeringasUpdate(Request $request)
    {
//        $test = 1;
        if($request->id){
            $getClientesJeringas = $this->getClientesJeringas($request->id);
            $clienteId = Clientes::where('estado', 1)->pluck('cliente', 'id');
            $selectCliente = Clientes::where('id', $getClientesJeringas['id_cliente'])->get()->first();
            $jeringaId = Jeringas::where('id', $getClientesJeringas['id_jeringa'])->get()->first();
            return view('elements/controljeringas/form/form_control_jeringas')->with(array(
                'dataJeringa'           => $getClientesJeringas,
                'cboCliente'            => $clienteId,
                'selectCliente'         => $selectCliente['id'],
                'jeringaId'             => $jeringaId,
                'updateForm'            => true,
                'errorCodigoId'         => false
            ));
        }
    }

    public function saveformControlJeringas(Request $request)
    {

        $userId = auth()->user()->id;
        $fecha = date("Y-m-d H:i:s" );
        $fechaIniSal = date("Y-m-d", strtotime($request->fechaIniFin));
        $hora = date(' H:i:s');
        $fechaIniSal = $fechaIniSal.$hora;
        if($request->jeringaID){
            if($this->getJeringaId($request->jeringaId))
            {
                $clienteJeringas = $this->getClientesJeringas($request->jeringaID);
                $clienteJeringas->id_cliente = $request->clienteId;
                $clienteJeringas->id_jeringa = $this->getJeringaId($request->jeringaId);
                $clienteJeringas->descripcion = $request->descripcion;
                $clienteJeringas->fecha_ing_sal = $fechaIniSal;
                $clienteJeringas->user_act = $userId;
                $clienteJeringas->fecha_act = $fecha;
                $clienteJeringas->estado = $request->estadoJeringa;
                $clienteJeringas->save();
            }else{
                $getClientesJeringas = $this->getClientesJeringas($request->jeringaID);
                $clienteId = Clientes::where('estado', 1)->pluck('cliente', 'id');
                $selectCliente = Clientes::where('id', $getClientesJeringas['id_cliente'])->get()->first();
                $jeringaId = Jeringas::where('id', $getClientesJeringas['id_jeringa'])->get()->first();
                return view('elements/controljeringas/form/form_control_jeringas')->with(array(
                    'dataJeringa'           => $getClientesJeringas,
                    'cboCliente'            => $clienteId,
                    'selectCliente'         => $selectCliente['id'],
                    'jeringaId'             => $jeringaId,
                    'updateForm'            => true,
                    'errorCodigoId'         => true
                ));
            }
        }else{
//            if($request->estJeringa == 1)
//            {
//                $clienteJeringas->est_habilitado = 1;
//            } elseif($request->estJeringa == 2){
//                $clienteJeringas->est_habilitado = 2;
//            }
//            $codigoJeringa = Jeringas::where('codigo', $request->jeringaId)->get()->first();
//            $test1 = $codigoJeringa[''];
            $validaEntrada = '';
            $validaSalida = '';
//          logica por estado de la tabla clienteJeringas
            /*if($request->estJeringa == 1){
                $validaEntrada = Jeringas::where('est_jeringa', 2)
                    ->where('id_jeringa', $this->getJeringaId($request->jeringaId))->get()->first();
                if($validaEntrada){
                    $clienteJeringas = $this->getClientesJeringas($validaEntrada['id']);
                    $clienteJeringas->est_jeringa = 4;
                    $clienteJeringas->save();
                }

            }elseif($request->estJeringa == 2){
                $validaSalida = Jeringas::where('est_jeringa', 2)
                    ->where('id_jeringa', $this->getJeringaId($request->jeringaId))->get()->first();
//                if($validaSalida){
//                    $clienteJeringas = $this->getClientesJeringas($validaSalida['id']);
//                    $clienteJeringas->est_jeringa = 3;
//                    $clienteJeringas->save();
//                }
            }*/

            if($request->estJeringa == 1){
                $validaEntrada = Jeringas::where('est_habilitado', 2)
                    ->where('estado', 1)
                    ->where('id', $this->getJeringaId($request->jeringaId))->get()->first();
                if($validaEntrada){
                    $jeringa = $this->getJeringas($validaEntrada['id']);
                    $jeringa->est_habilitado = 1;
                    $jeringa->save();
                }

            }elseif($request->estJeringa == 2){
                $validaSalida = Jeringas::where('est_habilitado', 1)
                    ->where('estado', 1)
                    ->where('jer_lav', 2)
                    ->where('id', $this->getJeringaId($request->jeringaId))->get()->first();
                if($validaSalida){
                    $jeringa = $this->getJeringas($validaSalida['id']);
                    $jeringa->est_habilitado = 2;
                    $jeringa->jer_lav = 1;
                    $jeringa->save();
                }
            }

            if($this->getJeringaId($request->jeringaId) && $validaEntrada){

                $clienteJeringas = new ClientesJeringas();
                $clienteJeringas->id_cliente = $request->clienteId;
                $clienteJeringas->id_jeringa = $this->getJeringaId($request->jeringaId);
                $clienteJeringas->descripcion = $request->descripcion;
                $clienteJeringas->fecha_ing_sal = $fechaIniSal;
//                $clienteJeringas->fecha_ing_sal = $fecha;
                $clienteJeringas->est_jeringa = $request->estJeringa;
                $clienteJeringas->user_reg = $userId;
                $clienteJeringas->fecha_reg = $fecha;
                $clienteJeringas->user_act = $userId;
                $clienteJeringas->fecha_act = $fecha;
                $clienteJeringas->estado = $request->estadoJeringa;
                $clienteJeringas->save();
//            }elseif(($validaEntrada != '' && !$validaEntrada && $validaSalida) || ($validaEntrada != '' && !$validaEntrada && !$validaSalida) /*&& $validaSalida != ''*/){
            }elseif($this->getJeringaId($request->jeringaId) && $validaSalida){

                $clienteJeringas = new ClientesJeringas();
                $clienteJeringas->id_cliente = $request->clienteId;
                $clienteJeringas->id_jeringa = $this->getJeringaId($request->jeringaId);
                $clienteJeringas->descripcion = $request->descripcion;
                $clienteJeringas->fecha_ing_sal = $fechaIniSal;
//                $clienteJeringas->fecha_ing_sal = $fecha;
                $clienteJeringas->est_jeringa = $request->estJeringa;
                $clienteJeringas->user_reg = $userId;
                $clienteJeringas->fecha_reg = $fecha;
                $clienteJeringas->user_act = $userId;
                $clienteJeringas->fecha_act = $fecha;
                $clienteJeringas->estado = $request->estadoJeringa;
                $clienteJeringas->save();
            }else{
                $estado = ['estado'=>1, 'est_jeringa'=>$request->estJeringa];
                $clienteId = Clientes::where('estado', 1)->pluck('cliente', 'id');
                return view('elements/controljeringas/form/form_control_jeringas')->with(array(
                    'dataJeringa'           => $estado,
                    'cboCliente'            => $clienteId,
                    'selectCliente'         => '',
                    'updateForm'            => false,
                    'errorCodigoId'         => true
                ));
            }
        }

        return redirect('controlJeringas');
    }

    public function getAllControlJeringas($cliente, $fecha_ini, $fecha_fin)
    {
        $dataControlJeringas = ClientesJeringas::select('clientes.cliente', 'jeringas.codigo', 'clientes_jeringas.fecha_ing_sal', 'clientes_jeringas.descripcion', 'clientes_jeringas.est_jeringa', 'clientes_jeringas.estado', 'clientes_jeringas.id')
            ->join('clientes', 'clientes.id', 'clientes_jeringas.id_cliente')
            ->join('jeringas', 'jeringas.id', 'clientes_jeringas.id_jeringa');
        if($cliente)
            $dataControlJeringas = $dataControlJeringas->where('clientes_jeringas.id_cliente', $cliente);
        if($fecha_ini  && $fecha_fin)
            $dataControlJeringas = $dataControlJeringas->whereBetween('clientes_jeringas.fecha_ing_sal', [$fecha_ini, $fecha_fin]);

            $dataControlJeringas = $dataControlJeringas->orderBy('clientes_jeringas.fecha_ing_sal', 'DESC')
           // ->orderBy('clientes_jeringas.est_jeringa', 'ASC')
           ->orderBy('clientes.cliente', 'ASC')
            ->orderBy('jeringas.id', 'ASC')
            ->paginate(10);
        return $dataControlJeringas;
    }

    protected function getClientesJeringas($idClienteJeringa)
    {
        $dataControlJeringas = ClientesJeringas::where('id', $idClienteJeringa)
            ->get()->first();

        return $dataControlJeringas;
    }

    protected function getJeringas($idJeringa){
        $dataJeringas = Jeringas::where('id', $idJeringa)
            ->get()->first();

        return $dataJeringas;
    }

    public function getJeringaId($codigo)
    {
        $codigoJeringa = Jeringas::where('codigo', $codigo)->where('estado', 1)->get()->first();

        return $codigoJeringa['id'];
    }

    public  function descargarControlJeringas()
    {
        $fecha = date("d-m-Y H:i:s" );
        return Excel::download(new ExportarControlJeringas, 'Ingreso_salida_jeringas'.$fecha.'.xlsx');
    }

}