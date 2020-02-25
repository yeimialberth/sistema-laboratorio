<header class="main-header">
    <!-- Logo -->
    <a href="javascript:void(0)" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><img src="{!! asset('img/logo60x60.jpg?version='.time()) !!}"></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><img src="{!! asset('img/logo-tjh.jpg?version='.time()) !!}"></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="user user-menu border-left">
                    <a href="javascript:void(0);">
                        <span class="hidden-xs"><i class="glyphicon glyphicon-user"></i> {{ auth()->user()->username }}</span>
                    </a>
                </li>
                <li class="border-left">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="glyphicon glyphicon-log-out"></i> {{ __('Logout') }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
        </div>
    </nav>
</header>
