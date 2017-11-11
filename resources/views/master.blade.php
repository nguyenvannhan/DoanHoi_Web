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
    <link href="{{ URL::asset('vendors/bootstrap-3.3.7/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ URL::asset('vendors/font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{ URL::asset('vendors/icheck/skins/flat/green.css') }}" rel="stylesheet">
    <!-- Datatables -->
    <link href="{{ URL::asset('vendors/datatable/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ URL::asset('css/common.css') }}" rel="stylesheet">

    @yield('css_area')
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
<script src="{{ URL::asset('js/jquery-3.2.1.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ URL::asset('vendors/bootstrap-3.3.7/js/bootstrap.min.js') }}"></script>
<!-- iCheck -->
<script src="{{ URL::asset('vendors/icheck/icheck.min.js') }}"></script>
<!-- Datatables -->
<script src="{{ URL::asset('vendors/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('vendors/datatables/js/dataTables.bootstrap.min.js') }}"></script>

<script type="text/javascript">
    var BASE_URL = '{{ URL::asset("/") }}';
</script>

<!-- Custom Theme Scripts -->
<script src="{{ URL::asset('js/common.js') }}"></script>

@yield('js_area');
</body>

</html>
