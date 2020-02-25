@extends('layouts.layoutApp')
@section('content')
    <section class="content-header">
        <h1>
            {{$titleModule}}
            <small>{{$titleSubModule}}</small>
        </h1>
    </section>
    <section>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default">
                    <div class="box-body">
                        <div class="">
                            <div>

                                <form action="{{route('filterClientes')}}" method="get">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <select name="clienteId" id="clienteId" class="form-control" style="height: 32px !important;">
                                                <option value="">Todos los clientes</option>
                                                @foreach($cboCliente as $k => $v)
                                                    <option value="{{$k}}">{{$v}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="input-group-btn">
                                            <button type="submit" class="btn btn-primary" style="margin-left: 11px;">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <div class="col-md-5">
                                    {{--<div class="input-group input-group-sm" style="width: 200px;">
                                        <input type="text" name="table_search" id="searchCliente" placeholder="Buscar Cliente" class="form-control pull-right" onkeyup="doSearch()">
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-primary">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </div>--}}
                                </div>
                                @if(auth()->user()->id_rol == 1)
                                    <div class="col-md-3 text-right">
                                        <a href="{{route('formClientes')}}" class="btn btn-primary">
                                            <i aria-hidden="true" class="fa fa-group"></i> Agregar Cliente
                                        </a>
                                    </div>
                                @endif
                            </div>
                            <div class="clearfix">&nbsp;</div>
                            <div class="col-md-12 table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>RUC/DNI</th>
                                        <th>Nombre/Compañia</th>
                                        <th>Telefono</th>
                                        <th>Dirección</th>
                                        <th>Observaciones</th>
                                        <th class="text-center">Estado</th>
                                        @if(auth()->user()->id_rol == 1)
                                            <th class="text-center" width="100">Acción</th>
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($dataClientes as $cliente)
                                        <tr>
                                            <td>{{$cliente->id}}</td>
                                            <td>{{$cliente->num_id}}</td>
                                            <td>{{$cliente->cliente}}</td>
                                            <td>{{$cliente->telefono}}</td>
                                            <td>{{$cliente->direccion}}</td>
                                            <td>{{$cliente->observaciones}}</td>
                                            @if($cliente->estado == 1)
                                            <td><button class="btn dropdown-toggle center-block" style="background-color: rgb(28, 165, 15); color: white;">Activo</button></td>
                                            @else
                                            <td><button class="btn dropdown-toggle center-block" style="background-color: rgb(222, 68, 40); color: white;">Inactivo</button></td>
                                            @endif
                                            @if(auth()->user()->id_rol == 1)
                                                <td class="text-center">
                                                    <div class="btn-group">
                                                        <a href="{{route('formClientesUpdate', $cliente->id)}}" class="btn btn-default btn-xs"><i aria-hidden="true" class="fa fa-edit"></i></a>
                                                    </div>
                                                </td>
                                            @endif
                                        </tr>
                                        <tr class='noSearch hide'>

                                            <td colspan="8"></td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {!! $dataClientes->render() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        $(function(){
	        $('#clienteId').select2({
		        placeholder: 'Todos los cliente'
	        })
        })
    </script>
@endsection