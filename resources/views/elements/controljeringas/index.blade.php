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
                                @csrf
                                <form action="{{route('filterControlJeringas')}}" method="get">
                                    <div class="col-md-2">
                                        {{--<div class="input-group input-group-sm" style="width: 200px;">
                                            <input type="text" name="clienteSearch" id="clienteSearch" placeholder="Buscar Cliente" class="form-control">
                                            <div class="input-group-btn">
                                                <button type="button" class="btn btn-primary">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </div>
                                        </div>--}}
                                        <div class="form-group">
                                            <select name="clienteId" id="clienteId" class="form-control" style="height: 32px !important;">
                                                <option value="">Todos los clientes</option>
                                                @foreach($cboCliente as $k => $v)
                                                    <option value="{{$k}}">{{$v}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 text-left">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right" id="fechaIniFin" name="fechaIniFin" {{--style="width: 270px;"--}}>
                                            <div class="input-group-btn">
                                                <button type="submit" class="btn btn-primary" {{--style="margin-left: 11px;"--}}>
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </form>
                                <div class="col-md-3 text-right">
                                    <a href="{{route('exportarControlJeringas')}}" class="btn btn-primary" style="/*margin-left: 50px;*/ background-color: #14a684;">
                                        <i aria-hidden="true" class="fa fa-file-excel-o"></i> Descargar Ingreso/Salida Jeringas
                                    </a>
                                </div>
                                @if(auth()->user()->id_rol == 1)
                                    <div class="col-md-2 text-right">
                                        <a href="{{route('formControlJeringas', 1)}}" class="btn btn-primary" {{--style="margin-left: 170px;"--}}>
                                            <i aria-hidden="true" class="fa fa-eyedropper"></i> Agregar Ingreso Jeringas
                                        </a>
                                    </div>
                                    <div class="col-md-2 text-right">
                                        <a href="{{route('formControlJeringas', 2)}}" class="btn btn-primary" {{--style="margin-left: 135px;"--}}>
                                            <i aria-hidden="true" class="fa fa-eyedropper"></i> Agregar Salida Jeringas
                                        </a>
                                    </div>
                                @endif
                            </div>
                            <div class="clearfix">&nbsp;</div>
                                <div class="col-md-12 table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Cliente</th>
                                        <th>Codigo Jeringa</th>
                                        <th>Descripción</th>
                                        <th class="text-center">Fecha de Ingreso/Salida</th>
                                        <th class="text-center">Ingreso/Salida</th>
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
                                            <td>{{$jeringa->cliente}}</td>
                                            <td>{{$jeringa->codigo}}</td>
                                            <td>{{$jeringa->descripcion}}</td>
                                            <td class="text-center">{{\Carbon\Carbon::parse($jeringa->fecha_ing_sal)->format('d-m-Y')}}</td>
                                            @if($jeringa['est_jeringa']==1)
                                                <td>
                                                    <button class="btn dropdown-toggle center-block" style="background-color: rgb(28, 165, 15); color: white;">Ingreso</button>
                                                </td>
                                            @elseif($jeringa['est_jeringa']==2 || $jeringa['est_jeringa']==4)
                                                <td>
                                                    <button class="btn dropdown-toggle center-block" style="background-color: rgb(222, 68, 40); color: white;">Salida</button>
                                                </td>
                                            @endif
                                            @if($jeringa->estado == 1)
                                                <td><button class="btn dropdown-toggle center-block" style="background-color: rgb(28, 165, 15); color: white;">Activo</button></td>
                                            @else
                                                <td><button class="btn dropdown-toggle center-block" style="background-color: rgb(222, 68, 40); color: white;">Inactivo</button></td>
                                            @endif
                                            @if(auth()->user()->id_rol == 1)
                                                <td class="text-center">
                                                    <div class="btn-group">
                                                        <a href="{{route('formControlJeringasUpdate', $jeringa->id)}}" class="btn btn-default btn-xs"><i aria-hidden="true" class="fa fa-edit"></i></a>
                                                    </div>
                                                </td>
                                            @endif
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
            $('#clienteId').select2({
                placeholder: 'Todos los cliente'
            })
	        //Date range picker
	        $('#fechaIniFin').daterangepicker({
		        autoUpdateInput: false,
                locale: {
                	format: 'DD-MM-YYYY',
	                cancelLabel: 'Clear'
                    // locate: 'es'
                }
            })
	        $('#fechaIniFin').on('apply.daterangepicker', function(ev, picker) {
		        $(this).val(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY'));
	        });
	        $('#fechaIniFin').on('cancel.daterangepicker', function(ev, picker) {
		        $(this).val('');
	        });
        })
    </script>
@endsection