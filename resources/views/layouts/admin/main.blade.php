<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <base href="/">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title', 'PT13313-WEB-PHP3')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    @include('layouts.admin.style')
    @include('layouts.admin.script')

</head>
<body themebg-pattern="theme1">

<div id="pcoded" class="pcoded iscollapsed" nav-type="st2" theme-layout="vertical" vertical-placement="left" vertical-layout="wide" pcoded-device-type="desktop" vertical-nav-type="expanded" vertical-effect="shrink" vnavigation-view="view1" fream-type="theme1" layout-type="light">
    <div class="pcoded-overlay-box"></div>
    <div class="pcoded-container navbar-wrapper">
        @include('layouts.admin.main-header')
        <div class="pcoded-main-container">
            <div class="pcoded-wrapper">
                @include('layouts.admin.sidebar')
                <div style="margin-top:70px;">
                @yield('content')
                </div>
            </div>
        </div>
    </div>

    <!-- ./wrapper -->
</div>

</body>
</html>
