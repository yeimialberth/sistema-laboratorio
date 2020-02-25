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
                                <form action="{{route('filterJeringas')}}" method="get">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <select name="jeringaId" id="jeringaId" class="form-control" style="height: 32px !important;">
                                                <option value="">Todos las Jeringas</option>
                                                @foreach($cboJeringa as $k => $v)
                                                    <option value="{{$k}}">{{$v}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <select name="jeringaLavado" id="jeringaLavado" class="form-control" style="height: 32px !important;">
                                                <option value="">Todos los lavados/sin lavar</option>
                                                <option value="2">Lavados</option>
                                                <option value="1">Sin lavar</option>
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
                                <div class="col-md-3">
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
                                        <a href="{{route('formJeringas')}}" class="btn btn-primary">
                                            <i aria-hidden="true" class="fa fa-group"></i> Agregar Jeringas
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
                                        <th>Codigo</th>
                                        <th>Descripción</th>
                                        <th class="text-center">Propietario</th>
                                        <th class="text-center">Jeringas Lavadas/Sin Lavar</th>
                                        <th class="text-center">Fecha de Ingreso</th>
                                        <th class="text-center">Estado</th>
                                        @if(auth()->user()->id_rol == 1)
                                            <th class="text-center" width="100">Acción</th>
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i=0;?>
                                    @foreach($dataJeringas as $jeringa)
                                        <?php $i++;?>
                                        <tr>
                                            <td>{{$jeringa->id}}</td>
                                            <td>{{$jeringa->codigo}}</td>
                                            <td>{{$jeringa->descripcion}}</td>
                                            @if($jeringa->propietario == 1)
                                                <td><button class="btn dropdown-toggle center-block" style="background-color: rgb(222, 134, 40); color: white;">Empresa</button></td>
                                            @elseif($jeringa->propietario == 2)
                                                <td><button class="btn dropdown-toggle center-block" style="background-color: rgb(40, 120, 222); color: white;">Cliente</button></td>
                                            @endif
                                            @if($jeringa->jer_lav == 1)
                                                <td><button class="btn dropdown-toggle center-block" style="background-color: #0061c6; color: white;">Sin Lavar</button></td>
                                            @elseif($jeringa->jer_lav == 2)
                                                <td><button class="btn dropdown-toggle center-block" style="background-color: #e2bd00; color: white;">Lavado</button></td>
                                            @endif
                                            <td class="text-center">{{\Carbon\Carbon::parse($jeringa->fecha_reg)->format('d-m-Y')}}</td>
                                            @if($jeringa->estado == 1)
                                                <td><button class="btn dropdown-toggle center-block" style="background-color: rgb(28, 165, 15); color: white;">Activo</button></td>
                                            @else
                                                <td><button class="btn dropdown-toggle center-block" style="background-color: rgb(222, 68, 40); color: white;">Inactivo</button></td>
                                            @endif
                                            @if(auth()->user()->id_rol == 1)
                                                <td class="text-center">
                                                    <div class="btn-group">
                                                        <a href="{{route('formJeringasUpdate', $jeringa->id)}}" class="btn btn-default btn-xs"><i aria-hidden="true" class="fa fa-edit"></i></a>
                                                    </div>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {!! $dataJeringas->appends(Request::only(['jeringaId', 'jeringaLavado']))->render() !!}
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
			$('#jeringaId').select2({
				placeholder: 'Todos los Jeringas'
			})
		})
    </script>
@endsection