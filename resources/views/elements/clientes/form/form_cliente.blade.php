@extends('layouts.layoutApp')

@section('content')
    <div class="panel panel-primary">
    <div class="panel-heading">
        <h4 class="modal-title">{{ $valida !=true && $updateForm? "Editar" : "Agregar" }} Cliente</h4>
{{--        <h4 class="modal-title">Agregar Cliente</h4>--}}
    </div>
    <div class="modal-body">
        <form action="{{route('saveformClientes')}}" method="post">
            @csrf
            <div class="form-group">
                <label>Nro RUC/DNI</label>
                <input type="text" name="numID" class="form-control" placeholder="Ingrese numero de RUC/DNI" value="{{ $updateForm ? $dataCliente['num_id'] : '' }}" required>
            </div>
            <div class="form-group">
                <label>Nombre Cliente</label>
                <input type="text" name="nombreCliente" class="form-control" placeholder="Ingresar el nombre del cliente" value="{{ $updateForm ? $dataCliente['cliente'] : '' }}" required>
            </div>
            <div class="form-group">
                <label>Telefono</label>
                <input type="text" name="telefonoContacto" class="form-control" placeholder="Ingrese el telefono a contactar" value="{{ $updateForm ? $dataCliente['telefono'] : '' }}">
            </div>
            <div class="form-group">
                <label>Dirección</label>
                <input type="text" name="direccionContacto" class="form-control" placeholder="Ingresar la dirección" value="{{ $updateForm ? $dataCliente['direccion'] : '' }}">
            </div>
            <div class="form-group">
                <label>Email Contacto</label>
                <input type="text" name="emailContacto" class="form-control" placeholder="Ingresar el correo a contactar" value="{{ $updateForm ? $dataCliente['correo'] : '' }}">
            </div>
            <div class="form-group">
                <label>Observaciones</label>
                <textarea type="text" name="observacionesContacto" class="form-control" placeholder="Ingresar una observación">{{ $updateForm ? $dataCliente['observaciones'] : '' }}</textarea>
            </div>
            <div class="form-group">
                <label>Estado</label>
                <select name="estadoCliente" id="estadoCliente" class="form-control" style="height: 32px !important;">
                    <option value="1" {{$dataCliente['estado']==1 ? 'selected="selected"' : ''}}>Activo</option>
                    <option value="0" {{$dataCliente['estado']==0 ? 'selected="selected"' : ''}}>Inactivo</option>
                </select>
            </div>
            @if($valida)
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-ban"></i> Aviso!</h4>
                    El RUC/DNI ingresado ya existe!. Por favor ingresa otro RUC/DNI.
                </div>
            @else
                @if($mensaje['mensaje']==1)
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-ban"></i> Aviso!</h4>
    {{--                    Ya existe otro cliente con el mismo RUC/DNI. Por favor ingresa otro RUC/DNI.--}}
                        El RUC/DNI que desea actualizar ya existe!. Por favor ingresa otro RUC/DNI.
                    </div>
                @endif
                <input type="hidden" name="clienteID" value="{{ $updateForm ? $dataCliente['id'] : '' }}">
            @endif
{{--            @if($valida!=true)--}}
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btnForm">{!! $valida !=true && $updateForm? "<i class='fa fa-edit'></i> Editar" : "<i class='fa fa-plus'></i> Agregar" !!}</button>
{{--                <button type="submit" class="btn btn-primary btnForm"><i class='fa fa-plus'></i> Agregar</button>--}}
                <a href="{{route('clientes')}}" class="btn btn-default"><i class="fa fa-close"></i> Cerrar</a>
            </div>
{{--            @endif--}}
        </form>
    </div>
</div>
@endsection
