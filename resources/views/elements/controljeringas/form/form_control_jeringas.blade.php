@extends('layouts.layoutApp')
@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
{{--            @dd($dataJeringa)--}}
            <h4 class="modal-title {{$dataJeringa['est_jeringa'] == 2 ? 'hide' : ''}} ">{{ $updateForm && $dataJeringa['est_jeringa'] == 1 ? "Editar Ingreso" : "Agregar Ingreso" }} Jeringa</h4>
            <h4 class="modal-title {{$dataJeringa['est_jeringa'] == 1 ? 'hide' : ''}} ">{{ $updateForm && $dataJeringa['est_jeringa'] == 2 ? "Editar Salida" : "Agregar Salida" }} Jeringa</h4>
            {{--        <h4 class="modal-title">Agregar Cliente</h4>--}}
        </div>
        <div class="modal-body">
            <form action="{{route('saveformControlJeringas')}}" method="post">
                @csrf
                <div class="form-group"></div>
                <div class="form-group">
                    <label>Cliente</label>
                    <select name="clienteId" id="clienteId" class="form-control" style="height: 32px !important;">
                        @foreach($cboCliente as $k => $v)
                            <option value="{{$k}}" {{$k == $selectCliente ? 'selected' : ''}}>{{$v}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Codigo</label>
                    <input name="jeringaId" class="form-control" placeholder="Ingrese codigo de jeringa" value="{{ $updateForm ? $jeringaId['codigo'] : '' }}" required>
                </div>
                <div class="form-group">
                    <label>Fecha Ingreso/Salida</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="fechaIniFin" name="fechaIniFin" value="{{$updateForm ? \Carbon\Carbon::parse($dataJeringa['fecha_ing_sal'])->format('d-m-Y') : '' }}">
                    </div>
                </div>
                <div class="form-group">
                    <label>Descripción</label>
                    <textarea name="descripcion" class="form-control" placeholder="Ingresar una descripción" >{{ $updateForm ? $dataJeringa['descripcion'] : '' }}</textarea>
                </div>
                {{--<div class="form-group">
                    <label>Estado</label>
                    <select name="estadoJeringa" id="estadoJeringa" class="form-control" style="height: 32px !important;">
                        <option value="1" {{$dataJeringa['estado']==1 ? 'selected="selected"' : ''}}>Activo</option>
                        <option value="2" {{$dataJeringa['estado']==2 ? 'selected="selected"' : ''}}>Inactivo</option>
                    </select>
                </div>--}}
                @if($errorCodigoId)
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-ban"></i> Aviso!</h4>
                        @if($dataJeringa['est_jeringa'] == 1)
                            El codigo de jeringa ingresado se encuentra
                            <strong>En la empresa</strong> no se puede agregar una jeringa que no fue prestado a un cliente.
                        @elseif($dataJeringa['est_jeringa'] == 2)
                            El codigo de jeringa ingresado se encuentra
                            <strong>En Prestamo ó Falta lavar</strong> no se puede agregar una jeringa que no este habilitado para su prestamo a un cliente.
                        @endif
                        ó no existe en nuestra base de datos!. Por favor ingresa otro codigo de jeringa.
                    </div>
                @endif
                <div class="alert alert-danger formError" style="display: none"></div>
                <input type="hidden" name="estJeringa" value="{{ $dataJeringa['est_jeringa'] }}">
                <input type="hidden" name="jeringaID" value="{{ $updateForm ? $dataJeringa['id'] : '' }}">
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btnForm">{!! $updateForm ? "<i class='fa fa-edit'></i> Editar" : "<i class='fa fa-plus'></i> Agregar" !!}</button>
                    {{--                <button type="submit" class="btn btn-primary btnForm"><i class='fa fa-plus'></i> Agregar</button>--}}
                    <a href="{{route('controlJeringas')}}" class="btn btn-default"><i class="fa fa-close"></i> Cerrar</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
	    $(function (){
		    $('#clienteId').select2();
		    // {
                // placeholder: 'Seleccione un cliente',
            // });
		    // $('#clienteId').select2()
		    $('#fechaIniFin').datepicker({
			    autoclose: true,
			    format: "dd-mm-yyyy",
			    beforeShow: function(){ $(".ui-datepicker").css('font-size', 12) }
		    })
		    console.log('hola mundo de la vista jeringas')
	    });
    </script>
@endsection