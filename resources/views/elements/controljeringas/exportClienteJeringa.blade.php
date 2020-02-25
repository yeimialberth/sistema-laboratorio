<table class="table table-bordered hidden" >
    <thead>
    <tr>
        <th>Cliente</th>
        <th>Codigo Jeringa</th>
        <th>Descripción</th>
        <th class="text-center">Fecha de Ingreso/Salida</th>
        <th class="text-center">Ingreso/Salida</th>
        <th class="text-center">Estado</th>
    </tr>
    </thead>
    <tbody>
    <?php $i=0;?>
{{--    @dd($dataJeringas1)--}}
    @foreach($dataJeringas1 as $jeringa)
        <?php $i++;?>
        <tr>
{{--            <td>{{$jeringa->cliente}}</td>--}}
{{--            <td>{{$jeringa->codigo}}</td>--}}
{{--            <td>{{$jeringa->descripcion}}</td>--}}
            <td>{{$jeringa['cliente']}}</td>
            <td>{{$jeringa['codigo']}}</td>
            <td>{{$jeringa['descripcion']}}</td>
            <td class="text-center">{{\Carbon\Carbon::parse($jeringa['fecha_ing_sal'])->format('d-m-Y')}}</td>
            @if($jeringa['est_jeringa']==1)
{{--            @if($jeringa->est_jeringa==1)--}}
                <td>
                    <button class="btn dropdown-toggle center-block" style="background-color: rgb(28, 165, 15); color: white;">Ingreso</button>
                </td>
            @elseif($jeringa['est_jeringa']==2 || $jeringa['est_jeringa']==4)
{{--            @elseif($jeringa->est_jeringa==2 || $jeringa->est_jeringa==4)--}}
                <td>
                    <button class="btn dropdown-toggle center-block" style="background-color: rgb(222, 68, 40); color: white;">Salida</button>
                </td>
            @endif
            @if($jeringa['estado'] == 1)
                <td><button class="btn dropdown-toggle center-block" style="background-color: rgb(28, 165, 15); color: white;">Activo</button></td>
            @else
                <td><button class="btn dropdown-toggle center-block" style="background-color: rgb(222, 68, 40); color: white;">Inactivo</button></td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>