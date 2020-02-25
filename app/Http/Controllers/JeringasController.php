<?php

namespace App\Http\Controllers;


use App\Clientes;
use App\ClientesJeringas;
use App\Exports\ExportarCodigoJeringa;
use App\Jeringas;
use App\Http\Requests\formClienteRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class JeringasController extends Controller
{
    public function index(Request $request)
    {
//        var_dump($this->getAllJeringas());
        $jeringaId = Jeringas::pluck('codigo', 'id');
        return view('elements/jeringas/index')->with(array(
            'titleModule'       =>      'Jeringas',
            'titleSubModule'    =>      'Listado',
            'titleBox'          =>      'Listado Jeringas',
            'dataJeringas'      =>      $this->getAllJeringas($request->jeringaId, $request->jeringaLavado),
            'cboJeringa'        =>      $jeringaId
        ));
    }

    public function indexFilter(Request $request)
    {
        $jeringaId = Jeringas::pluck('codigo', 'id');
        return view('elements/jeringas/index')->with(array(
            'titleModule'       =>      'Jeringas',
            'titleSubModule'    =>      'Listado',
            'titleBox'          =>      'Listado Jeringas',
            'dataJeringas'      =>      $this->getAllJeringas($request->jeringaId, $request->jeringaLavado),
            'cboJeringa'        =>      $jeringaId
        ));
    }

    public function jeringasPrestamo(Request $request)
    {
        $jeringaId = Jeringas::where('estado', 1)->pluck('codigo', 'id');
        $clienteId = Clientes::where('estado', 1)->pluck('cliente', 'id');
        return view('elements/jeringas/jeringasPrestamo')->with(array(
            'titleModule'       =>      'Jeringas Prestadas',
            'titleSubModule'    =>      'Listado',
            'titleBox'          =>      'Listado Jeringas',
            'dataJeringas'      =>      $this->getFilterJeringaPrestamo($request->clienteId, $request->jeringaId),
            'cboJeringa'        =>      $jeringaId,
            'cboCliente'        =>      $clienteId
        ));
    }

    public function filterJeringasPrestamo(Request $request)
    {
        $jeringaId = Jeringas::where('estado', 1)->pluck('codigo', 'id');
        $clienteId = Clientes::where('estado', 1)->pluck('cliente', 'id');
        return view('elements/jeringas/jeringasPrestamo')->with(array(
            'titleModule'       =>      'Jeringas Prestadas',
            'titleSubModule'    =>      'Listado',
            'titleBox'          =>      'Listado Jeringas',
            'dataJeringas'      =>      $this->getFilterJeringaPrestamo($request->clienteId, $request->jeringaId),
            'cboJeringa'        =>      $jeringaId,
            'cboCliente'        =>      $clienteId
        ));
    }

    public function formJeringas(){
        $estado = ['estado'=>1, 'propietario' =>1];
        return view('elements/jeringas/form/form_jeringas')->with(array(
            'dataJeringa'           => $estado,
            'updateForm'            => false
        ));

    }

    public function formJeringasUpdate(Request $request){
//        $test = 1;
        if($request->id){
            $getJeringas = $this->getJeringas($request->id);
            return view('elements/jeringas/form/form_jeringas')->with(array(
                'dataJeringa'           => $getJeringas,
                'updateForm'            => true
            ));
        }
    }

    public function saveformJeringas(Request $request){

        $userId = auth()->user()->id;
        $fecha = date("Y-m-d H:i:s" );
        if($request->jeringaID){
            $jeringas = $this->getJeringas($request->jeringaID);
            $jeringas->codigo = $request->codigo;
            $jeringas->descripcion = $request->descripcion;
            $jeringas->propietario = $request->propietario;
            $jeringas->user_act = $userId;
            $jeringas->fecha_act = $fecha;
            $jeringas->estado = $request->estadoJeringa;
            $jeringas->save();
        }else{
            $jeringas = new Jeringas();
            $jeringas->codigo = $request->codigo;
            $jeringas->descripcion = $request->descripcion;
            $jeringas->propietario = $request->propietario;
            $jeringas->jer_lav = 2;
            $jeringas->user_reg = $userId;
            $jeringas->fecha_reg = $fecha;
            $jeringas->user_act = $userId;
            $jeringas->fecha_act = $fecha;
            $jeringas->estado = $request->estadoJeringa;
            $jeringas->save();
        }

        return redirect('jeringas');

    }

    public function getAllJeringas($jeringa, $lavJer)
    {
        $dataJeringas = Jeringas::select();
        if($jeringa)
            $dataJeringas = $dataJeringas->where('id', $jeringa);
        if($lavJer)
            $dataJeringas = $dataJeringas->where('jer_lav', $lavJer)->where('est_habilitado', 1);
        $dataJeringas = $dataJeringas->orderBy('id', 'ASC')->paginate(10);
        return $dataJeringas;
    }

    protected function getJeringas($idJeringa){
        $dataJeringas = Jeringas::where('id', $idJeringa)
            ->get()->first();

        return $dataJeringas;
    }

    public function getFilterJeringaPrestamo($cliente, $jeringa)
    {
        $dataJeringaPrestamo = ClientesJeringas::select('clientes.id', 'clientes.cliente'/*, 'jeringas.codigo'*/, 'jeringas.est_habilitado', DB::raw('COUNT(1) as total_ing_sal'))
            ->join('clientes', 'clientes.id', 'clientes_jeringas.id_cliente')
            ->join('jeringas', 'jeringas.id', 'clientes_jeringas.id_jeringa')
            ->where('jeringas.est_habilitado', '2')
            ->where('jeringas.estado', '1')
            ->where('clientes_jeringas.estado', '1')
            ->where('clientes.estado', '1');
        if($cliente)
            $dataJeringaPrestamo = $dataJeringaPrestamo->where('clientes_jeringas.id_cliente', $cliente);
        if($jeringa)
            $dataJeringaPrestamo = $dataJeringaPrestamo->where('clientes_jeringas.id_jeringa', $jeringa);
        $dataJeringaPrestamo = $dataJeringaPrestamo
            ->orderBy('clientes.cliente', 'ASC')
            ->groupBy('clientes.id', 'clientes.cliente'/*, 'jeringas.codigo'*/, 'jeringas.est_habilitado')
            ->paginate(10);
        return $dataJeringaPrestamo;
    }

    public function listaCodigoJeringa (Request $request)
    {
        $cliente = Clientes::select('cliente', 'id')
        ->where('id', $request->idCliente)->get()->first();
//        $cliente = $cliente->cliente;
//        var_dump($cliente);
        return view('elements/jeringas/listadoCodigoJeringas')->with(array(
            'dataJeringas'              => $this->getCodigoJeringas($request->idCliente),
            'cliente'                   => $cliente
        ));
    }

    public function getCodigoJeringas($cliente)
    {
        return ClientesJeringas::select('clientes.cliente', 'jeringas.codigo', 'jeringas.est_habilitado')
            ->join('clientes', 'clientes.id', 'clientes_jeringas.id_cliente')
            ->join('jeringas', 'jeringas.id', 'clientes_jeringas.id_jeringa')
            ->where('clientes.id', $cliente)
            ->where('jeringas.est_habilitado', '2')
            ->where('jeringas.estado', '1')
            ->where('clientes_jeringas.estado', '1')
            ->where('clientes.estado', '1')
            ->orderBy('jeringas.codigo', 'ASC')
            ->groupBy('clientes.cliente', 'jeringas.codigo', 'jeringas.est_habilitado')->get();
    }

    public function exportarCodigoJeringa(Request $request)
    {
        $fecha = date("d-m-Y H:i:s" );
//        return Excel::download(new ExportarCodigoJeringa($request->id), 'codigo_jeringas'.$fecha.'.xlsx');
        return (new ExportarCodigoJeringa($request->id))->download('codigo_jeringas'.$fecha.'.xlsx');
    }

}