<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MENÚ NAVEGACIÓN</li>
            <li>
                <a href="/home">
                    <i class="fa fa-list"></i> <span>Listado</span>
                </a>
            </li>
            <li>
                <a href="/controlJeringas">
                    <i class="fa fa-eyedropper"></i> <span>Ingreso/Salida Jeringas</span>
                </a>
            </li>
            <li>
                <a href="/clientes">
                    <i class="fa fa-users"></i> <span>Clientes</span>
                </a>
            </li>
            <li>
                <a href="/jeringas">
                    <i class="fa fa-eyedropper"></i> <span>Jeringas</span>
                </a>
            </li>
            @if(auth()->user()->id_rol == 1)
                <li>
                    <a href="/usuarios">
                        <i class="fa fa-user"></i> <span>Usuarios</span>
                    </a>
                </li>
            @endif
            <li>
                <a href="/jeringasPrestamo">
                    <i class="fa fa-sign-out"></i> <span>Jeringas Prestados</span>
                </a>
            </li>
            <li>
                <a href="/cargaDatos">
                    <i class="fa fa-cloud-upload"></i> <span>Procesos de Carga de datos</span>
                </a>
            </li>
            {{--@if(auth()->user()->id_rol == 1)
                <li class="{{ $module == 'Usuarios' ? 'active' : '' }}">
                    <a href="/usuarios">
                        <i class="fa fa-user-o"></i> <span>Usuarios</span>
                    </a>
                </li>
                <li class="{{ $module == 'Clientes' ? 'active' : '' }}">
                    <a href="/clientes">
                        <i class="fa fa-group"></i> <span>Clientes</span>
                    </a>
                </li>
                <li class="{{ $module == 'Tickets' ? 'active' : '' }}">
                    <a href="/tickets">
                        <i class="fa fa-ticket"></i> <span>Tickets</span>
                    </a>
                </li>
            @endif--}}
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
