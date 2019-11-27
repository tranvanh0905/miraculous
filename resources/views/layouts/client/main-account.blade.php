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
            <main id="main" class="bg-user">
                <div class="container container-content">
                    <div class="row">
                        <div class="col-12">
                            <div class="adonis-carousel" data-items="1" data-stagePadding="0"
                                 data-loop="no">
                                <div class="owl-carousel owl-theme-adonis">
                                    <img src="https://photo-zmp3.zadn.vn/banner/e/1/8/1/e181d0a10cd0e354d6c60723e8c0d374.jpg" alt=""
                                         class="img-fluid">
                                    <img src="https://photo-zmp3.zadn.vn/banner/5/9/3/c/593c1fdb62e63c32e1b9da240ba663e4.jpg" alt=""
                                         class="img-fluid">
                                    <img src="https://photo-zmp3.zadn.vn/banner/b/e/0/8/be08de5a9a48c60ae7d58a897a75eecf.jpg" alt=""
                                         class="img-fluid">
                                </div>
                                <style>
                                    .owl-theme-adonis .owl-stage-outer{
                                        margin-bottom: 0;
                                    }
                                </style>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-3 pr-md-0">
                            <div class="sidebar-account">
                                <div class="avatar-account">
                                    <img src="{{url(Auth::user()->avatar)}}" alt="user" class="image-user rounded-circle">
                                </div>
                                <p class="text-center text-white font-weight-bold">{{Auth::user()->username}}</p>
                                <ul class="menu-account">
                                    <li class="@if (\Request::is('user')) active @endif"><a href="{{route('user-profile')}}">Tổng quan về tài khoản</a></li>
                                    <li class="@if (\Request::is('user/upgrade-account')) active @endif"><a href="{{route('user-upgrade-profile')}}">Nâng cấp tài khoản</a></li>
                                    <li class="@if (\Request::is('user/edit-account')) active @endif"><a href="{{route('user-edit-profile')}}">Sửa hồ sơ</a></li>
                                    <li class="@if (\Request::is('user/change-password')) active @endif"><a href="{{route('user-change-password')}}">Đổi mật khẩu</a></li>
                                    <li class="@if (\Request::is('user/invoice')) active @endif"><a href="{{route('user-invoice-profile')}}">Hóa đơn</a></li>
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
