<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
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
@include('layouts.client.meta-header')

<!-- Bootstrap core CSS -->
    @include('layouts.client.style')
</head>
<body>
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
<div id="wrap" class="light main-wrap clearfix">

    <!-- menu mobile-->
@include('layouts.client.menu-mobile')

<!-- header+menu-->
@include('layouts.client.header')

<!-- player-->
@include('layouts.client.player')

<!--#site-content-->
    <div id="site-content">
        <div id="site-content-inner">
            @yield('content')
        </div><!--/#site-content-inner-->
    </div>

@include('layouts.client.footer')

<!--Spinner -->
    @include('layouts.client.spinner')

</div><!-- /#wrap -->

<!--search -->
@include('layouts.client.search')

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
@include('layouts.client.script')
@yield('script')
</body>

</html>
