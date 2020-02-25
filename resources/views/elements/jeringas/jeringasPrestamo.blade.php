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
                                <form action="{{route('filterJeringasPrestamo')}}" method="get">
                                    @csrf
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
                                    {{--<div class="col-md-2">
                                        <div class="form-group">
                                            <select name="jeringaId" id="jeringaId" class="form-control" style="height: 32px !important;">
                                                <option value="">Todos las Jeringas</option>
                                                @foreach($cboJeringa as $k => $v)
                                                    <option value="{{$k}}">{{$v}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>--}}
                                    <div class="col-md-2 text-left">
                                        <div class="input-group-btn">
                                            <button type="submit" class="btn btn-primary" style="margin-left: 11px;">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <div class="col-md-6">
                                </div>
                            </div>
                            <div class="clearfix">&nbsp;</div>
                            <div class="col-md-12 table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Cliente</th>
                                        <th class="text-center">Total Jeringas</th>
{{--                                        <th class="text-center">Fecha de Prestamo</th>--}}
                                        <th class="text-center">Estado Jeringa</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i=0;?>
                                    @foreach($dataJeringas as $jeringa)
                                        <?php $i++;?>
                                        <tr>
                                            <td>{{$jeringa->cliente}}</td>
                                            <td class="text-center">
                                                <a href="{{route('listaCodigoJeringa', $jeringa->id)}}">{{$jeringa->total_ing_sal}}</a>
                                            </td>
{{--                                            <td class="text-center">{{\Carbon\Carbon::parse($jeringa->fecha_ing_sal)->format('d-m-Y')}}</td>--}}
                                            <td><button class="btn dropdown-toggle center-block" style="background-color: #f39c12; color: white;">Prestamo</button></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {!! $dataJeringas->render() !!}
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
			$('#clienteId').select2({
				placeholder: 'Todos los Clientes'
			})
		})
    </script>
@endsection