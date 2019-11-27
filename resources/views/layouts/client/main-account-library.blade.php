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
            <main id="main">
                <div class="pt-4 pt-lg-5"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="menu-library">
                                <ul class="wrap-menu-library">
                                    <li><a href="{{route('user-library')}}" class="@if (\Request::is('user/library')) menu-library-active @endif">Thư viện</a>
                                    </li>
                                    <li><a href="{{route('user-library-song')}}" class="@if (\Request::is('user/library/song')) menu-library-active
@endif">Bài hát</a></li>
                                    <li><a href="{{route('user-library-playlist')}}" class="@if (\Request::is('user/library/playlist'))
                                                menu-library-active
@endif">Danh sách phát</a></li>
                                    <li><a href="{{route('user-library-album')}}" class="@if (\Request::is('user/library/album')) menu-library-active
@endif">Album</a></li>
                                    <li><a href="{{route('user-library-artist')}}" class="@if (\Request::is('user/library/artist'))
                                                menu-library-active
@endif">Ca sĩ đã quan tâm</a></li>
                                    <li><a href="{{route('user-library-personal-playlist')}}" class="@if (\Request::is('user/library/user-playlist'))
                                                menu-library-active
@endif">Danh sách phát cá nhân</a></li>
                                    <li><a href="#">Đã phát gần đây</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-9 pl-4">
                            @yield('content')
                        </div>
                    </div>
                </div>

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
</body>

</html>
