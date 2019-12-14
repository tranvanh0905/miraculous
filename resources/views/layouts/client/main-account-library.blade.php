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
            <main id="main">
                <div class="pt-4"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-xl-3 col-lg-5 col-md-12">
                            <div class="height-100 pl-md-4 pr-md-4 flex-column-sidebar-md sidebar d-xl-block d-lg-block  d-none d-md-none">
                                <div class="sidebar-bg">
                                    <img src="{{url('client/images/sidebar-bg-1.jpg')}}" alt="sidebar">
                                </div>
                                <div class="d-flex flex-column height-100">
                                    <div class="sidenav-scroll scroll-y height-100 pt-5 ps">
                                        <div class="pb-3">
                                            <div class="d-flex flex-column align-items-center">
                                                <a href="{{route('user-library')}}"
                                                   class="lt-side-btn btn btn-120-60 mb-2 @if (\Request::is('user/library'))  btn-primary @else btn-transparent @endif">
                                                        <span class="adonis-icon pb-2">
                                                            <i class="fas fa-photo-video fa-2x"></i>
                                                        </span>
                                                    <p class="m-0">Thư viện của bạn</p>
                                                </a>
                                                <a href="{{route('user-library-song')}}"
                                                   class="lt-side-btn btn btn-120-60 mb-2 @if (\Request::is('user/library/song'))  btn-primary @else btn-transparent @endif">
                                                        <span class="adonis-icon pb-2">
                                                            <i class="fas fa-music fa-2x"></i>
                                                        </span>
                                                    <p class="m-0">Bài hát đã thích</p>
                                                </a>
                                                <a href="{{route('user-library-album')}}"
                                                   class="lt-side-btn btn btn-120-60 mb-2 @if (\Request::is('user/library/album'))  btn-primary @else btn-transparent @endif">
                                                        <span class="adonis-icon pb-2">
                                                            <i class="fas fa-compact-disc fa-2x"></i>
                                                        </span>
                                                    <p class="m-0">Album đã thích</p>
                                                </a>
                                                <a href="{{route('user-library-playlist')}}"
                                                   class="lt-side-btn btn btn-120-60 mb-2 @if (\Request::is('user/library/playlist'))  btn-primary @else btn-transparent @endif">
                                                        <span class="adonis-icon pb-2">
                                                            <i class="fas fa-play-circle fa-2x"></i>
                                                        </span>
                                                    <p class="m-0">Danh sách phát đã thích</p>
                                                </a>
                                                <a href="{{route('user-library-artist')}}"
                                                   class="lt-side-btn btn btn-120-60 mb-2 @if (\Request::is('user/library/artist'))  btn-primary @else btn-transparent @endif">
                                                        <span class="adonis-icon pb-2">
                                                            <i class="fas fa-user-plus fa-2x"></i>
                                                        </span>
                                                    <p class="m-0">Ca sĩ đã quan tâm</p>
                                                </a>
                                                <a id="user-playlist" href="{{route('user-library-personal-playlist')}}"
                                                   class="lt-side-btn btn btn-120-60 mb-2 @if (\Request::is('user/library/user-playlist'))  btn-primary @else btn-transparent @endif ">
                                                        <span class="adonis-icon pb-2">
                                                            <i class="fas fa-user-astronaut fa-2x"></i>
                                                        </span>
                                                    <p class="m-0">Danh sách phát cá nhân</p>
                                                </a>
                                                <a href="{{route('user.history')}}"
                                                   class="lt-side-btn btn btn-120-60 mb-2 @if (\Request::is('user/library/history'))  btn-primary @else btn-transparent @endif ">
                                                        <span class="adonis-icon pb-2">
                                                           <i class="fas fa-history fa-2x"></i>
                                                        </span>
                                                    <p class="m-0">Lịch sử nghe nhạc</p>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="menu-mobile d-xl-none d-lg-none  d-sm-block d-md-block">
                                <select name="forma" onchange="location = this.value;" class="form-control">
                                    <option value="#">Chọn menu</option>
                                    <option value="{{route('user-library')}}">Thư viện của bạn</option>
                                    <option value="{{route('user-library-song')}}">Bài hát đã thích</option>
                                    <option value="{{route('user-library-album')}}">Album đã thích</option>
                                    <option value="{{route('user-library-playlist')}}">Danh sách phát đã thích</option>
                                    <option value="{{route('user-library-artist')}}">Ca sĩ đã quan tâm</option>
                                    <option value="{{route('user-library-personal-playlist')}}">Danh sách phát cá nhân</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-9 pl-5 col-lg-7 col-md-12">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </main>
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
</body>

</html>
