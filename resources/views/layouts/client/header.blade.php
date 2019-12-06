<header id="site-header" class="site-header mb-1">
    <div class="master-container-fluid header-inner">
        <div class="row">
            <div class="col-auto col-md-5 col-xl-5 d-flex align-items-center">
                <div class="d-block d-lg-none">
                    <a href="#" class="navbar-toggler toggle-off-canvas-main-menu"
                       data-target="#primary-menu-offcanvas">
                        <span class="navbar-toggler-icon"></span>
                        <span class="navbar-toggler-icon"></span>
                        <span class="navbar-toggler-icon"></span>
                    </a>
                </div>
                <nav class="navbar navbar-expand-lg d-none d-md-block">
                    <div class="collapse navbar-collapse">
                        <ul class="navbar-nav mr-auto">
                            <li class="menu-item">
                                <a class="nav-link" id="home" href="{{route('client.home')}}">Trang chủ</a>
                            </li>
                            <li class="menu-item">
                                <a class="nav-link" href="{{route('client.brower')}}">Khám phá</a>
                            </li>
                            <li class="menu-item">
                                <a class="nav-link" href="{{route('all', ['type' => 'genres'])}}">Thể loại</a>
                            </li>
                            <li class="menu-item">
                                <a class="nav-link" href="{{route('client.chart')}}">#MicraChart</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
            <div class="col-auto col-md-2 col-xl-2 d-flex align-items-center justify-content-center p-0">
                <div class="brand">
                    <a class="brand d-flex align-items-center" href="{{route('client.home')}}">
                            <span class="adonis-icon mr-md-2 color-dark mr-1 icon-5x">
                                 <img src="{{ url(getWebSetting()->logo) }}" alt="{{getWebSetting()->name_website}}">
                            </span>
                        <strong class="p-1 fs-6 fs-lg-8">{{ getWebSetting()->name_website }}</strong>
                    </a>
                </div>
            </div>
            <div
                class="col-auto col-xl-5 d-flex justify-content-end justify-content-lg-end align-items-center navbar-secondary ml-auto">
                <div>
                    <a id="btn-search-4" class="nav-link" href="#">
                        <span class="adonis-icon">
                            <i class="fas fa-search fs-19"></i>
                        </span>
                    </a>
                </div>
                @if(!\Illuminate\Support\Facades\Auth::check())
                    <div class="nav-item">
                        <a href="{{route('login')}}" class="nav-link w-nowrap pr-0">Đăng nhập</a>
                    </div>
                @else
                    <div class="nav-item position-relative">

                        <a class="nav-link dropdown-toggle w-nowrap pr-0" href="#" id="dropdownUserSettings"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="flex-row d-inline-flex">
                                <div class="user"><img class="rounded-circle" src="{{Auth::user()->avatar}}"
                                                       alt=""></div>
                                <span
                                    class="ml-2 mt-2 fs-1 d-none d-lg-block">{{Auth::user()->username}}</span>
                            </div>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right user-settings-dropdown clearfix"
                             aria-labelledby="dropdownUserSettings">
                            <div class="settings-bottom">
                                <div class="user-profile-image rounded-circle">
                                    <img src="{{Auth::user()->avatar}}" alt="">
                                </div>
                                <h5 class="user-name text-center">{{Auth::user()->username}}</h5>
                                <ul class="user-settings-menu list-unstyled">
                                    <li><a href="{{route('user-profile')}}" class="inactive-color"><span
                                                class="adonis-icon notification mr-3 icon-3x">
                                                    <i class="fas fa-id-badge fs-19"></i>
                                            </span>Hồ sơ của bạn</a></li>
                                    <li><a href="{{route('user-library')}}" class="inactive-color"><span
                                                class="adonis-icon mr-3 icon-2x">
                                                <i class="fas fa-book fs-19"></i>
                                            </span>Thư viện của bạn</a>
                                    </li>
                                    @if(\Illuminate\Support\Facades\Auth::user()->role > 400)
                                        <li>
                                            <a href="javascript:;" class="inactive-color" id="go-admin"><span
                                                    class="adonis-icon mr-3 icon-2x">
                                                <i class="fas fa-tools fs-19"></i>
                                            </span>Quản lý website</a>
                                        </li>
                                    @endif
                                    <li><a href="javascript:;" class="inactive-color" id="logout"><span
                                                class="adonis-icon mr-3 icon-2x">
                                                <i class="fas fa-sign-in-alt fs-19"></i>
                                            </span>Đăng xuất</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</header>

