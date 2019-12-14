<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.admin2.header')
    <noscript>
        <style>
            noscript div {
                top: 0;
                left: 0;
                position: absolute;
                z-index: 99999999;
            }
        </style>
    </noscript>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Navbar -->
@include('layouts.admin2.navbar')
<!-- /.navbar -->

    <!-- Main Sidebar Container -->
@include('layouts.admin2.main-sidebar')
    <noscript>
        <div class="alert alert-warning text-center">
            <h2>Bạn đã tắt Javascript !!! Vui lòng kích hoạt lại Javascript để có thể sử dụng website!!!</h2>
            <h3>
                <a href="https://www.wikihow.vn/B%E1%BA%ADt-JavaScript-tr%C3%AAn-%C4%91i%E1%BB%87n-tho%E1%BA%A1i-Android"
                   target="_blank"> Hướng dẫn cho Điện thoại</a></h3>
            <h3><a href="https://support.google.com/adsense/answer/12654?hl=vi" target="_blank"> Hướng dẫn cho Máy
                    tính</a></h3>
        </div>
    </noscript>
<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">@yield('title')</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">

                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    @yield('content')
                </div>
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
@include('layouts.admin2.control-sidebar')
<!-- /.control-sidebar -->

    <!-- Main Footer -->
    @include('layouts.admin2.footer')
</div>
<!-- ./wrapper -->
@include('layouts.admin2.script')

<!-- REQUIRED SCRIPTS -->


@yield('custom-js')
</body>
</html>
