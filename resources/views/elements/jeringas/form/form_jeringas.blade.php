@extends('layouts.layoutApp')
@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="modal-title">{{ $updateForm ? "Editar" : "Agregar" }} Jeringa</h4>
            {{--        <h4 class="modal-title">Agregar Cliente</h4>--}}
        </div>
        <div class="modal-body">
            <form action="{{route('saveformJeringas')}}" method="post">
                @csrf
                <div class="form-group">
                    <label>Codigo</label>
                    <input name="codigo" class="form-control" placeholder="Ingrese codigo de jeringa" value="{{ $updateForm ? $dataJeringa['codigo'] : '' }}" required>
                </div>
                <div class="form-group">
                    <label>Descripción</label>
                    <textarea name="descripcion" class="form-control" placeholder="Ingresar una descripción" >{{ $updateForm ? $dataJeringa['descripcion'] : '' }}</textarea>
                </div>
                <div class="form-group">
                    <label>Propietario</label>
                    <select name="propietario" id="propietario" class="form-control" style="height: 32px !important;">
                        <option value="1" {{$dataJeringa['propietario']==1 ? 'selected="selected"' : ''}}>Empresa</option>
                        <option value="2" {{$dataJeringa['propietario']==2 ? 'selected="selected"' : ''}}>Cliente</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Estado</label>
                    <select name="estadoJeringa" id="estadoJeringa" class="form-control" style="height: 32px !important;">
                        <option value="1" {{$dataJeringa['estado']==1 ? 'selected="selected"' : ''}}>Activo</option>
                        <option value="0" {{$dataJeringa['estado']==0 ? 'selected="selected"' : ''}}>Inactivo</option>
                    </select>
                </div>
                <div class="alert alert-danger formError" style="display: none"></div>
                <input type="hidden" name="jeringaID" value="{{ $updateForm ? $dataJeringa['id'] : '' }}">
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btnForm">{!! $updateForm ? "<i class='fa fa-edit'></i> Editar" : "<i class='fa fa-plus'></i> Agregar" !!}</button>
                    {{--                <button type="submit" class="btn btn-primary btnForm"><i class='fa fa-plus'></i> Agregar</button>--}}
                    <a href="{{route('jeringas')}}" class="btn btn-default"><i class="fa fa-close"></i> Cerrar</a>
                </div>
            </form>
        </div>
    </div>
@endsection