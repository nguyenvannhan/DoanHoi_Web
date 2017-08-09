<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title> @yield('title_site') </title>

    <!-- Bootstrap -->
    <link href="{{ URL::asset('vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ URL::asset('vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ URL::asset('vendors/nprogress/nprogress.css') }}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{ URL::asset('vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">
    <!-- Datatables -->
    <link href="{{ URL::asset('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') }}" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="{{ URL::asset('vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') }}"
          rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{ URL::asset('vendors/jqvmap/dist/jqvmap.min.css') }}" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="{{ URL::asset('vendors/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    <!-- Jquery UI -->
    <link href="{{ URL::asset('vendors/jquery-ui/jquery-ui.min.css') }}" rel="stylesheet">
    <!-- Select2 -->
    <link href="{{ URL::asset('vendors/select2/dist/css/select2.css') }}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ URL::asset('css/custom.css') }}" rel="stylesheet">
</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            @include('common_components.sidebar')
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            @include('common_components.top_nav')
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
            @yield('header_page')

            @yield('main_content')
        </div>
        <!-- page content -->

        <!-- footer content -->
    @include('common_components.footer_page')
    <!-- /footer content -->

        @yield('modals')

    </div>
</div>


<!-- jQuery -->
<script src="{{ URL::asset('vendors/jquery/dist/jquery.min.js') }}"></script>
<!--JQuery UI -->
<script src="{{ URL::asset('vendors/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ URL::asset('vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ URL::asset('vendors/fastclick/lib/fastclick.js') }}"></script>
<!-- NProgress -->
<script src="{{ URL::asset('vendors/nprogress/nprogress.js') }}"></script>
<!-- Chart.js -->
<script src="{{ URL::asset('vendors/Chart.js/dist/Chart.min.js') }}"></script>
<!-- gauge.js -->
<script src="{{ URL::asset('vendors/gauge.js/dist/gauge.min.js') }}"></script>
<!-- bootstrap-progressbar -->
<script src="{{ URL::asset('vendors/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
<!-- iCheck -->
<script src="{{ URL::asset('vendors/iCheck/icheck.min.js') }}"></script>
<!-- Datatables -->
<script src="{{ URL::asset('vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('vendors/datatables.net-scroller/js/dataTables.scroller.min.js') }}"></script>
<!-- Skycons -->
<script src="{{ URL::asset('vendors/skycons/skycons.js') }}"></script>
<!-- Flot -->
<script src="{{ URL::asset('vendors/Flot/jquery.flot.js') }}"></script>
<script src="{{ URL::asset('vendors/Flot/jquery.flot.pie.js') }}"></script>
<script src="{{ URL::asset('vendors/Flot/jquery.flot.time.js') }}"></script>
<script src="{{ URL::asset('vendors/Flot/jquery.flot.stack.js') }}"></script>
<script src="{{ URL::asset('vendors/Flot/jquery.flot.resize.js') }}"></script>
<!-- Flot plugins -->
<script src="{{ URL::asset('vendors/flot.orderbars/js/jquery.flot.orderBars.js') }}"></script>
<script src="{{ URL::asset('vendors/flot-spline/js/jquery.flot.spline.min.js') }}"></script>
<script src="{{ URL::asset('vendors/flot.curvedlines/curvedLines.js') }}"></script>
<!-- DateJS -->
<script src="{{ URL::asset('vendors/DateJS/build/date.js') }}"></script>
<!-- JQVMap -->
<script src="{{ URL::asset('vendors/jqvmap/dist/jquery.vmap.js') }}"></script>
<script src="{{ URL::asset('vendors/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
<script src="{{ URL::asset('vendors/jqvmap/examples/js/jquery.vmap.sampledata.js') }}"></script>
<!-- bootstrap-daterangepicker -->
<script src="{{ URL::asset('vendors/moment/min/moment.min.js') }}"></script>
<script src="{{ URL::asset('vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<!-- Select2 -->
<script src="{{ URL::asset('vendors/select2/dist/js/select2.js') }}"></script>

<!-- Custom Theme Scripts -->
<script src="{{ URL::asset('js/custom.js') }}"></script>
</body>

</html>
