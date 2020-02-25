<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8;IE=edge">
        <title>{{env('APP_NAME', 'Tjh2b')}}</title>
        <!-- CSRT Token -->
        <meta name="csrf-token" content="{{csrf_token()}}">
        <!-- Favicon -->
        <link rel="shortcut icon" href="{!! asset('img/favico.ico?version='.time()) !!}" type="imagen/x-icon">
        <!-- Tell me browser to be responsive to screen width -->
        <meta content="width=devide-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="{!! asset('bower_components/bootstrap/dist/css/bootstrap.min.css?version='.time()) !!}">
        <!-- font Awesome -->
        <link rel="stylesheet" href="{!! asset('bower_components/font-awesome/css/font-awesome.min.css?version='.time()) !!}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="{!! asset('bower_components/Ionicons/css/ionicons.min.css?version='.time()) !!}">
        <!-- DataTables -->
        <link rel="stylesheet" href="{!! asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css?version='.time()) !!}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{!! asset('css/AdminLTE.css?version='.time()) !!}">
        <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="{!! asset('css/skins/_all-skins.css?version='.time()) !!}">
        <!-- Morris chart -->
        <link rel="stylesheet" href="{!! asset('bower_components/morris.js/morris.css?version='.time()) !!}">
        <!-- jvectormap -->
        <link rel="stylesheet" href="{!! asset('bower_components/jvectormap/jquery-jvectormap.css?version='.time()) !!}">
        <!-- Date Picker -->
        <link rel="stylesheet" href="{!! asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css?version='.time()) !!}">
        <!-- Datarange picker -->
        <link rel="stylesheet" href="{!! asset('bower_components/bootstrap-daterangepicker/daterangepicker.css?version='.time()) !!}">
        <!-- bootstrap wysihtml5 - text editor -->
        <link rel="stylesheet" href="{!! asset('plugin/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css?version='.time()) !!}">
        <!-- Select2 -->
        <link rel="stylesheet" href="{!! asset('bower_components/select2/dist/css/select2.min.css?version='.time()) !!}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.5.1/flatpickr.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.5.1/plugins/confirmDate/confirmDate.css">
{{--        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">--}}
        <link rel="stylesheet" href="{!! asset('css/tjh2b.css?version='.time()) !!}">
        @yield('css')


        <!-- Google Foot -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    </head>
<body class="hold-transition skin-yellow sidebar-mini fixed sidebar-collapse">
    <div class="wrapper">
        @include('layouts.utils.header')
        @include('layouts.utils.sidebar')
        <div class="content-wrapper">
            @yield('content')
        </div>
        @include('layouts.utils.footer')
        @include('layouts.utils.control_sidebar')
        @include('layouts.utils.modals')
        <div class="control-sidebar-bg"></div>
    </div>

    <!-- jQuery 3 -->
    <script src="{!! asset('bower_components/jquery/dist/jquery.min.js?version='.time()) !!}"></script>
    <!-- Select2 -->
    <script src="{!! asset('bower_components/select2/dist/js/select2.full.min.js?version='.time()) !!}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{!! asset('bower_components/jquery-ui/jquery-ui.min.js?version='.time()) !!}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
	    $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{!! asset('bower_components/bootstrap/dist/js/bootstrap.min.js?version='.time()) !!}"></script>
    <!-- Morris.js charts -->
    <script src="{!! asset('bower_components/raphael/raphael.min.js?version='.time()) !!}"></script>
    <script src="{!! asset('bower_components/morris.js/morris.min.js?version='.time()) !!}"></script>
    <!-- Sparkline -->
    <script src="{!! asset('bower_components/jquery-sparkline/dist/jquery.sparkline.min.js?version='.time()) !!}"></script>
    <!-- jvectormap -->
    <script src="{!! asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js?version='.time()) !!}"></script>
    <script src="{!! asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js?version='.time()) !!}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{!! asset('bower_components/jquery-knob/dist/jquery.knob.min.js?version='.time()) !!}"></script>
    <!-- daterangepicker -->
    <script src="{!! asset('bower_components/moment/min/moment.min.js?version='.time()) !!}"></script>
    <script src="{!! asset('bower_components/bootstrap-daterangepicker/daterangepicker.js?version='.time()) !!}"></script>
    <!-- datepicker -->
    <script src="{!! asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js?version='.time()) !!}"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="{!! asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js?version='.time()) !!}"></script>
    <!-- Slimscroll -->
    <script src="{!! asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js?version='.time()) !!}"></script>
    <!-- FastClick -->
    <script src="{!! asset('bower_components/fastclick/lib/fastclick.js?version='.time()) !!}"></script>
    <!-- DataTables -->
    <script src="{!! asset('bower_components/datatables.net/js/jquery.dataTables.min.js?version='.time()) !!}"></script>
    <script src="{!! asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js?version='.time()) !!}"></script>
    <!-- ChartJS -->
    <script src="{!! asset('bower_components/chart.js/Chart.js?version='.time()) !!}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/i18n/defaults-es_ES.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.5.1/flatpickr.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.5.1/plugins/confirmDate/confirmDate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.5.1/l10n/es.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/locale/es.js"></script>

    {{--<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>--}}

    <script src="{!! asset('js/tinymce/tinymce.min.js?version='.time()) !!}"></script>
    <script src="{!! asset('js/tinymce/jquery.tinymce.min.js?version='.time()) !!}"></script>

    <!-- AdminLTE App -->
    <script src="{!! asset('js/adminlte.min.js?version='.time()) !!}"></script>
    <!-- AdminLTE for demo purposes -->
{{--    <script src="{!! asset('js/demo.js?version='.time()) !!}"></script>--}}
{{--    <script src="{!! asset('js/app.js?version='.time()) !!}"></script>--}}
    @yield('script')
</body>
</html>