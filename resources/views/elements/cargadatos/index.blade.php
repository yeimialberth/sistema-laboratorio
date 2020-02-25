@extends('layouts.layoutApp')
@section('content')
    <section class="content-header">
        <h1>
            Importaciones de datos
{{--            <small>{{$titleSubModule}}</small>--}}
        </h1>
        <div class="clearfix">&nbsp;</div>
    </section>
    <section>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default">
                    <div class="box-body">
                        <div class="">
                            @if(auth()->user()->id_rol == 1)
                                <div>
                                    <form action="{{route('cargaIngresoJeringa')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="col-md-12">
                                            <div class="box box-warning box-solid" style="border: 1px solid #12a9f3;">
                                                <div class="box-header with-border" style="background-color: #12a9f3;">
                                                    <h3 class="box-title">Importar Ingreso de Jeringas</h3>
                                                </div>
                                                <div class="box-body" style="">
                                                    <input type="file" name="impIngreso">
                                                    <div class="clearfix">&nbsp;</div>
                                                    <button style="width: 100px;">Importar</button>
                                                </div>
                                                @if(Session::has('message1'))
                                                    <p class="alert alert-success">{{Session::get('message1')}}</p>
                                                @elseif(Session::has('messageIngresoJeringa'))
                                                    <p class="alert alert-warning"><strong>{{Session::get('messageIngresoJeringa')}}</strong></p>
                                                @elseif(Session::has('message11'))
                                                    <p class="alert alert-error">{{Session::get('message11')}}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div>
                                    <form action="{{route('cargaSalidaJeringa')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="col-md-12">
                                            <div class="box box-warning box-solid" style="border: 1px solid #2b9722;">
                                                <div class="box-header with-border" style="background-color: #2b9722;">
                                                    <h3 class="box-title">Importar Salida de Jeringas</h3>
                                                </div>
                                                <div class="box-body" style="">
                                                    <input type="file" name="ImpSalida">
                                                    <div class="clearfix">&nbsp;</div>
                                                    <button style="width: 100px;">Importar</button>
                                                </div>
                                                @if(Session::has('message2'))
                                                    <p class="alert alert-success">{{Session::get('message2')}}</p>
                                                @elseif(Session::has('messageSalidaJeringa'))
                                                    <p class="alert alert-warning"><strong>{{Session::get('messageSalidaJeringa')}}</strong></p>
                                                @elseif(Session::has('message22'))
                                                    <p class="alert alert-error">{{Session::get('message22')}}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div>
                                    <form action="{{route('cargaJeringas')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="col-md-12">
                                            <div class="box box-warning box-solid" style="border: 1px solid #39CCCC;">
                                                <div class="box-header with-border" style="background-color: #39CCCC;">
                                                    <h3 class="box-title">Importar Jeringas</h3>
                                                </div>
                                                <div class="box-body" style="">
                                                    <input type="file" name="impJeringas">
                                                    <div class="clearfix">&nbsp;</div>
                                                    <button style="width: 100px;">Importar</button>
                                                </div>
                                                @if(Session::has('message3'))
                                                    <p class="alert alert-success"><strong>{{Session::get('message3')}}</strong></p>
                                                @elseif(Session::has('messageCountJeringa'))
                                                    <p class="alert alert-warning"><strong>{{Session::get('messageCountJeringa')}}</strong></p>
                                                @elseif(Session::has('message33'))
                                                    <p class="alert alert-error"><strong>{{Session::get('message33')}}</strong></p>
                                                @endif
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div>
                                <form action="{{route('cargaClientes')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-md-12">
                                        <div class="box box-warning box-solid" style="border: 1px solid #3c8dbc;">
                                            <div class="box-header with-border" style="background-color: #3c8dbc">
                                                <h3 class="box-title">Importar Clientes</h3>
                                            </div>
                                            <div class="box-body" style="">
                                                <input type="file" name="impClientes">
                                                <div class="clearfix">&nbsp;</div>
                                                <button style="width: 100px;">Importar</button>
                                            </div>
                                            @if(Session::has('message4'))
                                                <p class="alert alert-success">{{Session::get('message4')}}</p>
                                            @elseif(Session::has('messageCountCliente'))
                                                <p class="alert alert-warning"><strong>{{Session::get('messageCountCliente')}}</strong></p>
                                            @elseif(Session::has('message44'))
                                                <p class="alert alert-error">{{Session::get('message44')}}</p>
                                            @endif
                                        </div>
                                    </div>
                                </form>
                            </div>
                            @endif
                            <div>
                                <form action="{{route('cargaJeringasLavado')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-md-12">
                                        <div class="box box-warning box-solid" style="border: 1px solid #f56954;">
                                            <div class="box-header with-border" style="background-color: #f56954;">
                                                <h3 class="box-title">Importar Jeringas Lavados</h3>
                                            </div>
                                            <div class="box-body" style="">
                                                <input type="file" name="impJeringaLavado">
                                                <div class="clearfix">&nbsp;</div>
                                                <button style="width: 100px;">Importar</button>
                                            </div>
                                            @if(Session::has('message5'))
                                                <p class="alert alert-success"><strong>{{Session::get('message5')}}</strong></p>
{{--                                            @elseif(Session::has('messageCount'))--}}
{{--                                                <p class="alert alert-warning"><strong>{{Session::get('messageCount')}}</strong></p>--}}
                                            @elseif(Session::has('message55'))
                                                <p class="alert alert-error"><strong>{{Session::get('message55')}}</strong></p>
                                            @endif
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection