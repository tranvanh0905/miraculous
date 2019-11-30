<footer class="site-footer pb-5" id="site-footer">
    <div class="master-container-fluid">
        <div class="p-2"></div>
        <hr>
    </div>
    <div class="master-container-fluid">
        <div class="pt-e-40"></div>
        <div class="row">
            <div class="col-lg-4 col-xl-3 order-2 order-lg-1">
                <div class="footer-widget-1">
                    <div class="footer-logo mb-2">
                        <a class="brand d-flex align-items-center" href="{{route('client.home')}}">
                                <span class="adonis-icon mr-md-2 mr-1 icon-5x">
                                    <img src="{{ url(getWebSetting()->logo) }}" alt="{{getWebSetting()->name_website}}">
                                </span>
                            <strong class="p-1 fs-8">{{ getWebSetting()->name_website }}</strong>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-xl-9 pl-e-lg-70 order-1">
                <div class="row">
                    <div class="col-md-6 col-xl-4">
                        <div class="footer-manage widget">
                            <h5 class="widget-title text-uppercase">Liên kết hữu ích</h5>
                            <ul class="list-inline vertical-list">
                                <li><a href="{{route('client.home')}}">Trang chủ</a></li>
                                <li><a href="{{route('user-profile')}}">Tài khoản</a></li>
                                <li><a href="#">Lấy lại mật khẩu</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-4">
                        <div class="widget">
                            <h5 class="widget-title text-uppercase">Bài hát nổi bật</h5>
                            <div class="footer-album-list music-img-box-cont-sm">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-4 text-right">
                        <div class="widget">
                            <div class="social-icons">
                                <ul class="list-inline horizon-list fs-3">
                                    <li>
                                        <a href="{{getWebSetting()->url_facebook }}">
                                            <i class="fab fa-facebook-square fs-19"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{getWebSetting()->url_skype }}">
                                            <i class="fab fa-skype fs-19"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{getWebSetting()->url_google }}">
                                            <i class="fab fa-google-plus fs-19"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{getWebSetting()->url_instagram }}">
                                            <i class="fab fa-instagram fs-19"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="widget">
                            {!! getWebSetting()->about_website  !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

