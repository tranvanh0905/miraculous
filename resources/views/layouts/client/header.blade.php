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
                                <a class="nav-link" href="{{route('client.genres')}}">Thể loại</a>
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
                            <span class="adonis-icon mr-md-2 color-dark mr-1 icon-5x"><svg version="1.1"
                                                                                           xmlns="http://www.w3.org/2000/svg"
                                                                                           viewBox="0 0 27 32"><defs><linearGradient
                                            id="Gradient" x1="0" y1="0" x2="100%" y2="0"><stop offset="0%"
                                                                                               stop-color="#b08cf9"/><stop
                                                offset="100%" stop-color="#91a5f4"/></linearGradient></defs><path
                                        fill="url(#Gradient)"
                                        d="M2.594 0.275c-0.257-0.166-0.571-0.265-0.908-0.265-0.932 0-1.688 0.756-1.688 1.688 0 0.028 0.001 0.055 0.002 0.082l-0-0.004v13.246l16.702-6.219zM26.030 14.49l-4.184-2.541-21.846 8.102v10.154c-0.001 0.024-0.002 0.051-0.002 0.079 0 0.927 0.752 1.679 1.679 1.679 0.319 0 0.617-0.089 0.871-0.243l-0.007 0.004c1.501-0.888 22.21-13.433 23.489-14.214 0.52-0.316 0.863-0.88 0.863-1.524s-0.342-1.207-0.855-1.519l-0.008-0.004z"></path></svg></span>
                        <strong class="p-1 fs-6 fs-lg-8">Micralous</strong>
                    </a>
                </div>
            </div>
            <div
                class="col-auto col-xl-5 d-flex justify-content-end justify-content-lg-end align-items-center navbar-secondary ml-auto">
                <div>
                    <a id="btn-search-4" class="nav-link" href="#"><span class="adonis-icon icon-3x"><svg
                                version="1.1" xmlns="http://www.w3.org/2000/svg" height="32" viewBox="0 0 30 32"><path
                                    d="M30.046 29.806l-7.127-7.287c2.109-2.395 3.397-5.558 3.397-9.021 0-3.721-1.486-7.094-3.896-9.56l0.003 0.003c-2.361-2.432-5.661-3.942-9.313-3.942s-6.953 1.51-9.31 3.939l-0.003 0.003c-2.388 2.462-3.86 5.824-3.86 9.53s1.472 7.068 3.863 9.533l-0.003-0.003c2.35 2.441 5.645 3.958 9.295 3.958 2.992 0 5.747-1.020 7.935-2.73l-0.028 0.021 7.207 7.383c0.232 0.225 0.548 0.364 0.896 0.368h0.001c0.344-0.001 0.656-0.142 0.881-0.368l0-0c0.252-0.237 0.409-0.573 0.409-0.945 0-0.34-0.131-0.65-0.345-0.881l0.001 0.001zM20.709 21.189c-1.906 1.978-4.577 3.206-7.536 3.206s-5.63-1.228-7.532-3.203l-0.003-0.003c-1.932-1.992-3.123-4.713-3.123-7.712s1.191-5.719 3.126-7.715l-0.003 0.003c1.906-1.978 4.577-3.206 7.536-3.206s5.63 1.228 7.532 3.203l0.003 0.003c1.932 1.992 3.123 4.713 3.123 7.712s-1.191 5.719-3.126 7.715l0.003-0.003z"></path></svg></span></a>
                </div>
                @if(!\Illuminate\Support\Facades\Auth::check())
                    <div class="nav-item">
                        <a href="{{route('login')}}" class="nav-link w-nowrap pr-0">Đăng nhập</a>
                    </div>
                @else
                    <div class="nav-item d-none d-md-block">
                        <a class="nav-link notification-toggle has-notification" href="#" id="dropdownUsernotifications"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span
                                class="adonis-icon notification icon-4x"><svg version="1.1"
                                                                              xmlns="http://www.w3.org/2000/svg"
                                                                              height="24" viewBox="0 0 29 32"><path
                                        d="M19.286 25.607c-0.395 0-0.714 0.32-0.714 0.714v0 0c0 2.367-1.919 4.286-4.286 4.286s-4.286-1.919-4.286-4.286v0 0c0-0.395-0.32-0.714-0.714-0.714s-0.714 0.32-0.714 0.714v0 0c0 3.156 2.558 5.714 5.714 5.714s5.714-2.558 5.714-5.714v0 0c0-0.395-0.32-0.714-0.714-0.714v0zM27.857 23.464h-2.857v-9.179c0-5.917-4.797-10.714-10.714-10.714s-10.714 4.797-10.714 10.714v0 9.214h-2.857c-0.395 0-0.714 0.32-0.714 0.714s0.32 0.714 0.714 0.714v0h27.143c0.395 0 0.714-0.32 0.714-0.714s-0.32-0.714-0.714-0.714v0zM23.571 23.464h-18.571v-9.221c0.024-5.11 4.172-9.243 9.286-9.243 0 0 0 0 0 0v0c5.128 0 9.286 4.157 9.286 9.286v0zM14.286 2.857c0.789 0 1.429-0.64 1.429-1.429v0c0-0.789-0.64-1.429-1.429-1.429s-1.429 0.64-1.429 1.429v0c0 0.789 0.64 1.429 1.429 1.429v0z"></path></svg></span>
                            <!--<span class="icon-bell fs-8"></span>--></a>
                        <div class="dropdown-menu dropdown-menu-right p-4 notifications clearfix" role="menu">
                            <h5>Notification</h5>
                            <div class="media notification">
                                <div class="user-thumb mr-3 rounded-thumb">
                                    <img src="client/images/browse/browse-overview-6.jpg" alt="">
                                </div>
                                <div class="notification-desc">
                                    <p>New Album from <a href="#" class="active-color">Brenda Lee</a></p>
                                    <p><a href="#">Catch Me Outside</a></p>
                                    <em class="inactive-color">2 Hours ago</em>
                                    <span class="adonis-icon close-notification icon-1x"><svg
                                            xmlns="http://www.w3.org/2000/svg" version="1.1" height="12"
                                            viewBox="0 0 24 24"><path
                                                d="M13.4 12l5.3-5.3c0.4-0.4 0.4-1 0-1.4s-1-0.4-1.4 0l-5.3 5.3-5.3-5.3c-0.4-0.4-1-0.4-1.4 0s-0.4 1 0 1.4l5.3 5.3-5.3 5.3c-0.4 0.4-0.4 1 0 1.4 0.2 0.2 0.4 0.3 0.7 0.3s0.5-0.1 0.7-0.3l5.3-5.3 5.3 5.3c0.2 0.2 0.5 0.3 0.7 0.3s0.5-0.1 0.7-0.3c0.4-0.4 0.4-1 0-1.4l-5.3-5.3z"/></svg></span>
                                </div>
                            </div>
                            <div class="media notification">
                                <div class="user-thumb mr-3 rounded-thumb">
                                    <img src="client/images/playlists/playlist-15.jpg" alt="">
                                </div>
                                <div class="notification-desc">
                                    <p>New Album from <a href="#" class="active-color">Adm Smith</a></p>
                                    <p><a href="#">Catch Me Outside</a></p>
                                    <em class="inactive-color">3 Hours ago</em>
                                    <span class="adonis-icon close-notification icon-1x"><svg
                                            xmlns="http://www.w3.org/2000/svg" version="1.1" height="12"
                                            viewBox="0 0 24 24"><path
                                                d="M13.4 12l5.3-5.3c0.4-0.4 0.4-1 0-1.4s-1-0.4-1.4 0l-5.3 5.3-5.3-5.3c-0.4-0.4-1-0.4-1.4 0s-0.4 1 0 1.4l5.3 5.3-5.3 5.3c-0.4 0.4-0.4 1 0 1.4 0.2 0.2 0.4 0.3 0.7 0.3s0.5-0.1 0.7-0.3l5.3-5.3 5.3 5.3c0.2 0.2 0.5 0.3 0.7 0.3s0.5-0.1 0.7-0.3c0.4-0.4 0.4-1 0-1.4l-5.3-5.3z"/></svg></span>
                                </div>
                            </div>
                            <div class="media notification">
                                <div class="user-thumb mr-3 rounded-thumb">
                                    <img src="client/images/browse/browse-overview-5.jpg" alt="">
                                </div>
                                <div class="notification-desc">
                                    <p>New Album from <a href="#" class="active-color">Brenda Lee</a></p>
                                    <p><a href="#">Catch Me Outside</a></p>
                                    <em class="inactive-color">5 Hours ago</em>
                                    <span class="adonis-icon close-notification icon-1x"><svg
                                            xmlns="http://www.w3.org/2000/svg" version="1.1" height="12"
                                            viewBox="0 0 24 24"><path
                                                d="M13.4 12l5.3-5.3c0.4-0.4 0.4-1 0-1.4s-1-0.4-1.4 0l-5.3 5.3-5.3-5.3c-0.4-0.4-1-0.4-1.4 0s-0.4 1 0 1.4l5.3 5.3-5.3 5.3c-0.4 0.4-0.4 1 0 1.4 0.2 0.2 0.4 0.3 0.7 0.3s0.5-0.1 0.7-0.3l5.3-5.3 5.3 5.3c0.2 0.2 0.5 0.3 0.7 0.3s0.5-0.1 0.7-0.3c0.4-0.4 0.4-1 0-1.4l-5.3-5.3z"/></svg></span>
                                </div>
                            </div>
                        </div>
                    </div>

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
                            <div class="settings-top">
                                <div class="user-cover-image">
                                    <img src="client/images/user/cover.jpg" alt="">
                                </div>
                                <div class="user-profile-image rounded-circle">
                                    <img src="{{Auth::user()->avatar}}" alt="">
                                </div>
                            </div>
                            <div class="settings-bottom">
                                <h5 class="user-name text-center">{{Auth::user()->username}}</h5>
                                <ul class="user-settings-menu list-unstyled">
                                    <li><a href="{{route('user-profile')}}" class="inactive-color"><span
                                                class="adonis-icon notification mr-3 icon-3x"><svg version="1.1"
                                                                                                   xmlns="http://www.w3.org/2000/svg"
                                                                                                   viewBox="0 0 32 32"><path
                                                        d="M10 6c0-3.314 2.686-6 6-6s6 2.686 6 6c0 3.314-2.686 6-6 6s-6-2.686-6-6zM24.002 14h-1.107l-6.222 12.633 2.327-11.633-3-3-3 3 2.327 11.633-6.222-12.633h-1.107c-3.998 0-3.998 2.687-3.998 6v10h24v-10c0-3.313 0-6-3.998-6z"></path></svg></span>Hồ
                                            sơ của bạn</a></li>
                                    <li><a href="{{route('user-library')}}" class="inactive-color"><span
                                                class="adonis-icon mr-3 icon-2x"><svg xmlns="http://www.w3.org/2000/svg"
                                                                                      version="1.1" viewBox="0 0 34 32"><path
                                                        d="M32 30v-2h-2v-12h2v-2h-6v2h2v12h-6v-12h2v-2h-6v2h2v12h-6v-12h2v-2h-6v2h2v12h-6v-12h2v-2h-6v2h2v12h-2v2h-2v2h34v-2h-2z"></path><path
                                                        d="M16 0h2l16 10v2h-34v-2l16-10z"></path></svg></span>Thư viện
                                            của bạn</a>
                                    </li>
                                    <li><a href="javascript:;" class="inactive-color" id="logout"><span
                                                class="adonis-icon mr-3 icon-2x"><svg
                                                    version="1.1" xmlns="http://www.w3.org/2000/svg" height="32"
                                                    viewBox="0 0 32 32"><path
                                                        d="M24 20v-4h-10v-4h10v-4l6 6zM22 18v8h-10v6l-12-6v-26h22v10h-2v-8h-16l8 4v18h8v-6z"></path></svg></span>Logout</a>
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

