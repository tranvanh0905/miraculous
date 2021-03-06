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
            <main id="main" class="bg-user">
                <div class="container container-content">
                    <div class="row">
                        <div class="col-12">
                            <div class="adonis-carousel mt-3" data-items="1" data-stagePadding="0"
                                 data-loop="yes" data-dots="yes">
                                <div class="owl-carousel owl-theme-adonis">
                                    @foreach(getSlider() as $slider)
                                        <a href="{{url($slider->url)}}" class="box-img-slider">
                                            <img src="{{url($slider->image)}}" alt="{{url($slider->url)}}"
                                                 class="img-slider">
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-3 pr-md-0">
                            <div class="sidebar-account">
                                <div class="avatar-account">
                                    <img src="{{url(Auth::user()->avatar)}}" alt="user"
                                         class="image-user rounded-circle">
                                </div>
                                <p class="text-center text-white font-weight-bold">{{Auth::user()->username}}</p>
                                <ul class="menu-account">
                                    <li class="@if (\Request::is('user')) active @endif"><a id="user-index"
                                                                                            href="{{route('user-profile')}}"><i
                                                class="fab fa-windows fs-19"></i> Tổng quan về tài khoản</a></li>
                                    <li class="@if (\Request::is('user/edit-account')) active @endif"><a
                                            href="{{route('user-edit-profile')}}"><i class="fas fa-user-edit fs-19"></i>
                                            Sửa hồ sơ</a></li>
                                    <li class="@if (\Request::is('user/change-password')) active @endif"><a
                                            href="{{route('user-change-password')}}"><i class="fas fa-key fs-19"></i>
                                            Đổi mật khẩu</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xl-9 col-md-9 pl-md-0">
                            <div class="content-account">
                                @yield('content')
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mt-5"></div>
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
