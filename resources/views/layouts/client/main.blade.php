<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
@include('layouts.client.meta-header')

<!-- Bootstrap core CSS -->
    @include('layouts.client.style')
</head>
<body>

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

<!-- svg-->
    @include('layouts.client.svg')

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
