<div id="primary-menu-offcanvas" class="off-canvas off-canvas-left d-flex flex-column">
    <div class="m-3">
        <a class="close-offcanvas-main-menu" href="#" data-target="#primary-menu-offcanvas">
                <span class="adonis-icon icon-5x">
                    <i class="fas fa-times fs-19"></i>
                </span>
        </a>
    </div>

    <div class="side-nav-container d-flex flex-column align-items-center ml-auto mr-auto position-relative">
        <ul class="side-nav adonis-animate" data-animation="menuTwo" id="site-side-nav" data-level="1"
            data-animation-item="> li > a">
            <li class="nav-item">
                <a class="nav-link active" href="{{route('client.home')}}">Trang chủ</a></li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('client.brower')}}">Khám phá</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('all', ['type' => 'genres'])}}">Thể loại</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('client.chart')}}">Bảng xếp hạng</a>
            </li>
        </ul>
    </div>

    <div class="p-3">
        <div class="social-icons">
            <ul class="list-inline horizon-list fs-3">
                <li>
                    <a href="{{getWebSetting()->url_facebook }}">
                        <i class="fab fa-facebook-square fa-2x"></i>
                    </a>
                </li>
                <li>
                    <a href="{{getWebSetting()->url_skype }}">
                        <i class="fab fa-skype fa-2x"></i>
                    </a>
                </li>
                <li>
                    <a href="{{getWebSetting()->url_google }}">
                        <i class="fab fa-google-plus fa-2x"></i>
                    </a>
                </li>
                <li>
                    <a href="{{getWebSetting()->url_instagram }}">
                        <i class="fab fa-instagram fa-2x"></i>
                    </a>
                </li>
            </ul>
        </div>
        <div class="copyright"> Copyright &copy; {{getWebSetting()->name_website }}</div>
    </div>

</div>
