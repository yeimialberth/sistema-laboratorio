@extends('layouts.layoutApp')
@section('content')
    <section>
        <h1>
            Cliente -
            <small class="bg-yellow-active" style="border-radius: 8px">{{$cliente->cliente}}</small>
        </h1>
    </section>
    <section>
        <div class="row">
            <div class="col-md-12 text-left">
                <div class="box box-default">
                    <div class="box-body">
                        <div class="">
                            <div class="col-md-9"></div>
                            <div class="col-md-3 text-right">
{{--                                @dd($cliente->id)--}}
                                <a href="{{route('exportarCodigoJeringa', $cliente->id)}}" class="btn btn-primary" style="/*margin-left: 50px;*/ background-color: #14a684;">
                                    <i aria-hidden="true" class="fa fa-file-excel-o"></i> Descargar Jeringas Prestados
                                </a>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-6 table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Cliente</th>
                                        <th class="text-center">Codigo Jeringas</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i=0;?>
{{--                                    @dd($dataJeringas)--}}
                                    @foreach($dataJeringas as $jeringa)
                                        <?php $i++;?>
                                        <tr>
                                            <td>{{$jeringa->cliente}}</td>
                                            <td class="text-center">
                                                {{$jeringa->codigo}}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
{{--                                {!! $dataJeringas->render() !!}--}}
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-10"></div>
                            <div class="col-md-2 text-right">
                                <a href="{{route('jeringasPrestamo')}}" class="btn btn-primary btn-block">
                                    Salir
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection