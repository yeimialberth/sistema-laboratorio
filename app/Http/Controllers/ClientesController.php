<?php

namespace App\Http\Controllers;

use App\Clientes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\formClienteRequest;
use Illuminate\Support\Facades\DB;

class ClientesController extends Controller
{

    public function index(Request $request)
    {
        $clienteId = Clientes::where('estado', 1)->pluck('cliente', 'id');
        return view('elements/clientes/index')->with(array(
            'titleModule'       =>      'Clientes',
            'titleSubModule'    =>      'Listado',
            'titleBox'          =>      'Listado Clientes',
            'dataClientes'      =>      $this->getAllClientes($request->clienteId),
            'cboCliente'        =>      $clienteId
        ));
    }

    public function indexFilter(Request $request)
    {
        $clienteId = Clientes::where('estado', 1)->pluck('cliente', 'id');
        return view('elements/clientes/index')->with(array(
            'titleModule'       =>      'Clientes',
            'titleSubModule'    =>      'Listado',
            'titleBox'          =>      'Listado Clientes',
            'dataClientes'      =>      $this->getAllClientes($request->clienteId),
            'cboCliente'        =>      $clienteId
        ));
    }

    public function formClientes(){
        $estado = ['estado'=>1];
        $mensaje = ['mensaje'=>0];
        return view('elements/clientes/form/form_cliente')->with(array(
            'dataCliente'           => $estado,
            'updateForm'            => false,
            'valida'                => false,
            'mensaje'               => $mensaje,
        ));

    }

    public function formClientesUpdate(Request $request){
//        $test = 1;
        if($request->id){
            $getCliente = $this->getCliente($request->id);
            $mensaje = ['mensaje'=>0];
            return view('elements/clientes/form/form_cliente')->with(array(
                'dataCliente'           => $getCliente,
                'updateForm'            => true,
                'valida'                => false,
                'mensaje'               => $mensaje,
            ));
        }
    }

    public function saveformClientes(formClienteRequest $request){

        $userId = auth()->user()->id;
        $fecha = date("Y-m-d H:i:s" );
        if($request->clienteID){
            $idCliente = $this->getCliente($request->clienteID);
            $verificaCliente = Clientes::where('num_id', $request->numID)->get()->first();
            if($verificaCliente['id'] != $idCliente['id'] && $verificaCliente['num_id'] == $request->numID){
                $estado = ['id'=>$idCliente['id'], 'estado'=>1, 'num_id'=>$request->numID,'cliente'=>$request->nombreCliente, 'telefono'=>$request->telefonoContacto, 'direccion'=>$request->direccionContacto, 'correo'=>$request->emailContacto];
                $mensaje = ['mensaje'=>1];
                return view('elements/clientes/form/form_cliente')->with(array(
                    'dataCliente'           => $estado,
                    'updateForm'            => true,
                    'valida'                => false,
                    'mensaje'               => $mensaje,
                ));
            }else{
                $cliente = $this->getCliente($request->clienteID);
                $cliente->cliente = $request->nombreCliente;
                $cliente->num_id = $request->numID;
                $cliente->telefono = $request->telefonoContacto;
                $cliente->direccion = $request->direccionContacto;
                $cliente->correo = $request->emailContacto;
                $cliente->observaciones = $request->observacionesContacto;
                $cliente->user_act = $userId;
                $cliente->fecha_act = $fecha;
                $cliente->estado = $request->estadoCliente;
                $cliente->save();
            }
        }else{
            $verificaCliente = Clientes::where('num_id', $request->numID)->get()->first();
            if($verificaCliente){
                $estado = ['estado'=>1, 'num_id'=>$request->numID,'cliente'=>$request->nombreCliente, 'telefono'=>$request->telefonoContacto, 'direccion'=>$request->direccionContacto, 'correo'=>$request->emailContacto];
                $mensaje = ['mensaje'=>0];
                return view('elements/clientes/form/form_cliente')->with(array(
                    'dataCliente'           => $estado,
                    'updateForm'            => true,
                    'valida'                => true,
                    'mensaje'               => $mensaje,
                ));
            }else{
                $cliente = new Clientes();
                $cliente->cliente = $request->nombreCliente;
                $cliente->num_id = $request->numID;
                $cliente->telefono = $request->telefonoContacto;
                $cliente->direccion = $request->direccionContacto;
                $cliente->correo = $request->emailContacto;
                $cliente->observaciones = $request->observacionesContacto;
                $cliente->user_reg = $userId;
                $cliente->fecha_reg = $fecha;
                $cliente->user_act = $userId;
                $cliente->fecha_act = $fecha;
                $cliente->estado = $request->estadoCliente;
                $cliente->save();
            }
        }

        return redirect('clientes');

    }

    public function getAllClientes($cliente)
    {
        $dataClientes = Clientes::select();
        if($cliente)
            $dataClientes = $dataClientes->where('id', $cliente);
        $dataClientes = $dataClientes->orderBy('id', 'ASC')->paginate(10);
        return $dataClientes;
    }

    protected function getCliente($idCliente){
        $dataCliente = Clientes::where('id', $idCliente)
            ->get()->first();

        return $dataCliente;
    }

}