<?php

namespace App\Http\Controllers;


use App\User;
use App\Http\Requests\formClienteRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuariosController extends Controller
{
    public function index()
    {
        return view('elements/usuarios/index')->with(array(
            'titleModule'       =>      'Usuarios',
            'titleSubModule'    =>      'Listado',
            'titleBox'          =>      'Listado Usuarios',
            'dataUsuarios'      =>      $this->getAllUsuarios()
        ));
    }

    public function formUsuarios(){
        $estado = ['estado'=>1, 'id_rol'=>1];
//        $filtroUsuario = User::where('username', '=', 'yeimialberth')->get()->first();
//        $test = $filtroUsuario->username;
        return view('elements/usuarios/form/form_usuarios')->with(array(
            'dataUsuario'           => $estado,
            'updateForm'            => false,
            'valido'                => false
        ));

    }

    public function formUsuariosUpdate(Request $request){
//        $test = 1;
        if($request->id){
            $getUsuario = $this->getUsuario($request->id);
            return view('elements/usuarios/form/form_usuarios')->with(array(
                'dataUsuario'           => $getUsuario,
                'updateForm'            => true,
                'valido'                => false
            ));
        }
    }

    public function saveformUsuarios(Request $request){

        $userId = auth()->user()->id;
        $fecha = date("Y-m-d H:i:s" );
        $username = trim($request->username);

        if($request->usuarioID){

            $usuario = $this->getUsuario($request->usuarioID);
            $usuario->name = $request->nombreUsuario;
            $usuario->email = $request->emailUsuario;
            $usuario->username = $username;
            $usuario->celular = $request->celularUsuario;
            if($request->password){
                $usuario->password = Hash::make($request->password);
            }
            $usuario->id_rol = $request->tipoUsuario;
            $usuario->user_act = $userId;
            $usuario->updated_at = $fecha;
            $usuario->estado = $request->estadoUsuario;
            $usuario->save();
        }else{
            $filtroUsuario = User::where('username', $username)->get()->first();
            $estado = ['estado' => 1];
            if($filtroUsuario){
                return view('elements/usuarios/form/form_usuarios')->with(array(
                    'valido' => true,
                    'dataUsuario' => $estado,
                    'updateForm' => false
                ));
            }else{
                $userID = User::where('username', $username)->get()->first();
                $usuario = new User();
                $usuario->name = $request->nombreUsuario;
                $usuario->email = $request->emailUsuario;
                $usuario->username = $username;
                $usuario->celular = $request->celularUsuario;
                $usuario->password = Hash::make($request->password);
                $usuario->id_rol = $request->tipoUsuario;
                $usuario->user_reg = $userId;
                $usuario->created_at = $fecha;
                $usuario->user_act = $userId;
                $usuario->updated_at = $fecha;
                $usuario->estado = $request->estadoUsuario;
                $usuario->save();
            }
        }

        return redirect('usuarios');

    }

    public function getAllUsuarios()
    {
        $dataUsuarios = User::orderBy('name', 'ASC')->paginate(10);
        return $dataUsuarios;
    }

    protected function getUsuario($id){
        $dataUsuario = User::where('id', $id)
            ->get()->first();

        return $dataUsuario;
    }

}