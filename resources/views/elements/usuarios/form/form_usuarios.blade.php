@extends('layouts.layoutApp')

@section('content')
        <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="modal-title">{{ $updateForm ? "Editar" : "Agregar" }} Usuario</h4>
        </div>
        <div class="modal-body">
            <form action="{{route('saveformUsuarios')}}" method="post">
                @csrf
                <div class="form-group">
                    <label>Nombre Usuario</label>
                    <input type="text" name="nombreUsuario" class="form-control" placeholder="Ingrese el nombre del usuario" value="{{ $updateForm ? $dataUsuario['name'] : '' }}" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="emailUsuario" class="form-control" placeholder="Ingrese el email" value="{{ $updateForm ? $dataUsuario['email'] : '' }}" required>
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" placeholder="Ingresar el username" value="{{ $updateForm ? $dataUsuario['username'] : '' }}" {{ $updateForm ? 'readonly' : '' }} required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Ingresar la contraseña" value="" {{$updateForm ? '' : 'required'}}>
                </div>
                <div class="form-group">
                    <label>Celular</label>
                    <input type="text" name="celularUsuario" class="form-control" placeholder="Ingrese nro de celular" value="{{ $updateForm ? $dataUsuario['celular'] : '' }}">
                </div>
                <div class="form-group">
                    <label>Tipo Usuario</label>
                    <select name="tipoUsuario" class="form-control" style="height: 32px !important;">
                        <option value="1" {{$dataUsuario['id_rol']==1 ? 'selected="selected"' : ''}}>Admin</option>
                        <option value="0" {{$dataUsuario['id_rol']==0 ? 'selected="selected"' : ''}}>Operario</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Estado</label>
                    <select name="estadoUsuario" class="form-control" style="height: 32px !important;">
                        <option value="1" {{$dataUsuario['estado']==1 ? 'selected="selected"' : ''}}>Activo</option>
                        <option value="0" {{$dataUsuario['estado']==0 ? 'selected="selected"' : ''}}>Inactivo</option>
                    </select>
                </div>
                @if($valido)
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-ban"></i> Aviso!</h4>
                        El Username ingresado ya existe!. Por favor ingresa otro Username.
                    </div>
                @else
                <input type="hidden" name="usuarioID" value="{{ $updateForm ? $dataUsuario['id'] : '' }}">
                @endif
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btnForm">{!! $updateForm ? "<i class='fa fa-edit'></i> Editar" : "<i class='fa fa-plus'></i> Agregar" !!}</button>
                    <a href="{{route('usuarios')}}" class="btn btn-default"><i class="fa fa-close"></i> Cerrar</a>
                </div>
            </form>
        </div>
    </div>
@endsection
