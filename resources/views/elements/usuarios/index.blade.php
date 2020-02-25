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
                                <div class="col-md-9">
                                    {{--<div class="input-group input-group-sm" style="width: 200px;">
                                        <input type="text" name="table_search" id="searchCliente" placeholder="Buscar Cliente" class="form-control pull-right" onkeyup="doSearch()">
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-primary">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </div>--}}
                                </div>
                                <div class="col-md-3 text-right">
                                    <a href="{{route('formUsuarios')}}" class="btn btn-primary">
                                        <i aria-hidden="true" class="fa fa-group"></i> Agregar Usuario
                                    </a>
                                </div>
                            </div>
                            <div class="clearfix">&nbsp;</div>
                            <div class="col-md-12 table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
{{--                                        <th>#</th>--}}
                                        <th>Nombres</th>
                                        <th>Email</th>
                                        <th>Username</th>
                                        <th>Celular</th>
                                        <th class="text-center">Estado</th>
                                        <th class="text-center" width="100">Acción</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($dataUsuarios as $usuario)
                                        <tr>
{{--                                            <td>{{$usuario->id}}</td>--}}
                                            <td>{{$usuario->name}}</td>
                                            <td>{{$usuario->email}}</td>
                                            <td>{{$usuario->username}}</td>
                                            <td>{{$usuario->celular}}</td>
                                            @if($usuario->estado == 1)
                                                <td><button class="btn dropdown-toggle center-block" style="background-color: rgb(28, 165, 15); color: white;">Activo</button></td>
                                            @else
                                                <td><button class="btn dropdown-toggle center-block" style="background-color: rgb(222, 68, 40); color: white;">Inactivo</button></td>
                                            @endif
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <a href="{{route('formUsuariosUpdate', $usuario->id)}}" class="btn btn-default btn-xs"><i aria-hidden="true" class="fa fa-edit"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class='noSearch hide'>

                                            <td colspan="8"></td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {!! $dataUsuarios->render() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection