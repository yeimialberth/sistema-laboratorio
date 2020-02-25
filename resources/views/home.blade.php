@extends('layouts.layoutApp')

@section('content')
    <div class="container ">
        <div class="col-xs-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-blue text-center">
                <div class="inner">
                    <h3>{{$totalEmp}}<sup style="font-size: 20px"></sup></h3>

                    <h3><strong><p>Total de Jeringas TJH2B</p></strong></h3>
                </div>
                {{--<div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>--}}
                {{--<a href="#" class="small-box-footer">
                    Jeringas existentes en la empresa
                </a>--}}
            </div>
        </div>
        <div class="col-xs-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua text-center">
                <div class="inner">
                    <h3>{{$totalCli}}</h3>

                    <h3><strong><p>Total de Jeringas Clientes</p></strong></h3>
                </div>
                {{--<div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>--}}
                {{--<a href="#" class="small-box-footer">
                    Jeringas existentes de Clientes
                </a>--}}
            </div>
        </div>
        <div class="col-xs-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red text-center">
                <div class="inner">
                    <h3>{{$fueraUso}}</h3>

                    <h3><strong><p>Fuera de uso</p></strong></h3>
                </div>
                {{--<div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>--}}
                {{--<a href="#" class="small-box-footer">
                    Jeringas sin uso
                </a>--}}
            </div>
        </div>
        <div class="col-xs-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow text-center">
                <div class="inner">
                    <h3>{{$jeringaPrestamo}}</h3>

                    <h3><strong><p>Jeringas en prestamo</p></strong></h3>
                </div>
                {{--<div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>--}}
                {{--<a href="#" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>--}}
            </div>
        </div>
        <div class="col-xs-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green text-center">
                <div class="inner">
                    <h3>{{$jeringaLavado /*- $jeringaPrestamo*/}}<sup style="font-size: 20px"></sup></h3>

                    <h3><strong><p>Jeringas habilitadas</p></strong></h3>
                </div>
                {{--<div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>--}}
                {{--<a href="#" class="small-box-footer">
                    Jeringas existentes en la empresa
                </a>--}}
            </div>
        </div>
        <div class="col-xs-4 col-xs-6">
            <div class="small-box bg-light-blue-active color-palette text-center">
                <div class="inner">
                    <h3>{{$jeringasSinLavar}}<sup style="font-size: 20px"></sup></h3>

                    <h3><strong><p>Jeringas sin lavar</p></strong></h3>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="box ">
            <section class="content-header">
                <h1>
                    Historial de movimientos de Jeringas
                    <small>Listado</small>
                </h1>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-default">
                            <div class="box-body">
                                <div class="">
                                    <div class="col-md-12 table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Cliente</th>
                                                <th>Codigo</th>
{{--                                                <th>Descripción</th>--}}
                                                <th class="text-center">Fecha ingreso/salida</th>
                                                <th class="text-center">Estado</th>
                                                <th class="text-center">Total</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($ingSal as $v)
                                                    <tr>
                                                        <td>{{ $v['cliente'] }}</td>
                                                        <td>{{ $v['codigo'] }}</td>
{{--                                                        <td>{{ $v['descripcion'] }}</td>--}}
                                                        <td class="text-center">{{ \Carbon\Carbon::parse($v['fecha_ing_sal'])->format('d-m-Y') }}</td>
                                                        @if($v['est_jeringa']==1)
                                                            <td>
                                                                <button class="btn dropdown-toggle center-block" style="background-color: rgb(28, 165, 15); color: white;">Ingreso</button>
                                                            </td>
                                                        @elseif($v['est_jeringa']==2 || $v['est_jeringa']==4)
                                                            <td>
                                                                <button class="btn dropdown-toggle center-block" style="background-color: rgb(222, 68, 40); color: white;">Salida</button>
                                                            </td>
                                                        @endif
                                                        <td class="text-center">{{ $v['total_ing_sal'] }}</td>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
