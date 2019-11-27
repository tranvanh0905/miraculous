<nav class="pcoded-navbar" navbar-theme="theme1" active-item-theme="theme1" sub-item-theme="theme2"
     active-item-style="style0" pcoded-navbar-position="fixed">
    <div class="nav-list">
        <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: 100%; height: 100%;">
            <div class="pcoded-inner-navbar main-menu" style="overflow: hidden; width: 100%; height: 100%;">
                <div class="pcoded-navigation-label" menu-title-theme="theme1">Navigation</div>
                <ul class="pcoded-item pcoded-left-item" item-border="true" item-border-style="solid"
                    subitem-border="false">
                    <li class="">
                        <a href="{{url('admin')}}" class="waves-effect waves-dark">
                                <span class="pcoded-micon">
                                <i class="feather icon-menu"></i>
                                </span>
                            <span class="pcoded-mtext">Bảng điều khiển</span>
                        </a>
                    </li>
                </ul>
                <ul class="pcoded-item pcoded-left-item" item-border="true" item-border-style="solid"
                    subitem-border="false">
                    <li class="pcoded-hasmenu" dropdown-icon="style1" subitem-icon="style1">
                        <a href="javascript:void(0)" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                            <span class="pcoded-mtext">Bài hát</span>
                        </a>
                        <ul class="pcoded-submenu">
                            <li class="">
                                <a href="{{route('songs.home')}}" class="waves-effect waves-dark">
                                    <span class="pcoded-mtext">Danh sách bài hát</span>
                                </a>
                            </li>
                            <li class="">
                                <a href="{{route('songs.add')}}" class="waves-effect waves-dark">
                                    <span class="pcoded-mtext">Thêm mới</span>
                                </a>
                            </li>
                            <li class="">
                                <a href="{{route('kinds.home')}}" class="waves-effect waves-dark">
                                    <span class="pcoded-mtext">Danh sách thể loại</span>
                                </a>
                            </li>
                            <li class="">
                                <a href="{{route('kinds.add')}}" class="waves-effect waves-dark">
                                    <span class="pcoded-mtext">Thêm thể loại</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <ul class="pcoded-item pcoded-left-item" item-border="true" item-border-style="solid"
                    subitem-border="false">
                    <li class="pcoded-hasmenu" dropdown-icon="style1" subitem-icon="style1">
                        <a href="javascript:void(0)" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                            <span class="pcoded-mtext">Albums</span>
                        </a>
                        <ul class="pcoded-submenu">
                            <li class="">
                                <a href="{{route('albums.home')}}" class="waves-effect waves-dark">
                                    <span class="pcoded-mtext">Danh sách album</span>
                                </a>
                            </li>
                            <li class="">
                                <a href="{{route('albums.add')}}" class="waves-effect waves-dark">
                                    <span class="pcoded-mtext">Thêm mới</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <ul class="pcoded-item pcoded-left-item" item-border="true" item-border-style="solid"
                    subitem-border="false">
                    <li class="pcoded-hasmenu" dropdown-icon="style1" subitem-icon="style1">
                        <a href="javascript:void(0)" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                            <span class="pcoded-mtext">Danh sách phát</span>
                        </a>
                        <ul class="pcoded-submenu">
                            <li class="">
                                <a href="{{route('playlist.home')}}" class="waves-effect waves-dark">
                                    <span class="pcoded-mtext">Tất cả danh sách phát</span>
                                </a>
                            </li>
                            <li class="">
                                <a href="{{route('playlist.add')}}" class="waves-effect waves-dark">
                                    <span class="pcoded-mtext">Thêm mới</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <ul class="pcoded-item pcoded-left-item" item-border="true" item-border-style="solid"
                    subitem-border="false">
                    <li class="pcoded-hasmenu" dropdown-icon="style1" subitem-icon="style1">
                        <a href="javascript:void(0)" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                            <span class="pcoded-mtext">Ca sĩ</span>
                        </a>
                        <ul class="pcoded-submenu">
                            <li class="">
                                <a href="{{route('artists.home')}}" class="waves-effect waves-dark">
                                    <span class="pcoded-mtext">Danh sách ca sĩ</span>
                                </a>
                            </li>
                            <li class="">
                                <a href="{{route('artists.add')}}" class="waves-effect waves-dark">
                                    <span class="pcoded-mtext">Thêm mới</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <ul class="pcoded-item pcoded-left-item" item-border="true" item-border-style="solid"
                    subitem-border="false">
                    <li class="pcoded-hasmenu" dropdown-icon="style1" subitem-icon="style1">
                        <a href="javascript:void(0)" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                            <span class="pcoded-mtext">Tài khoản</span>
                        </a>
                        <ul class="pcoded-submenu">
                            <li class="">
                                <a href="{{route('users.home')}}" class="waves-effect waves-dark">
                                    <span class="pcoded-mtext">Danh sách tài khoản</span>
                                </a>
                            </li>
                            <li class="">
                                <a href="{{route('users.add')}}" class="waves-effect waves-dark">
                                    <span class="pcoded-mtext">Thêm mới</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <ul class="pcoded-item pcoded-left-item" item-border="true" item-border-style="solid"
                    subitem-border="false">
                    <li class="">
                        <a href="navbar-light.html" class="waves-effect waves-dark">
                                <span class="pcoded-micon">
                                <i class="feather icon-menu"></i>
                                </span>
                            <span class="pcoded-mtext">Bình luận</span>
                        </a>
                    </li>
                </ul>
                <ul class="pcoded-item pcoded-left-item" item-border="true" item-border-style="solid"
                    subitem-border="false">
                    <li class="">
                        <a href="navbar-light.html" class="waves-effect waves-dark">
                                <span class="pcoded-micon">
                                <i class="feather icon-menu"></i>
                                </span>
                            <span class="pcoded-mtext">Cài đặt</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="slimScrollBar"
                 style="background: rgb(0, 0, 0); width: 5px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px; height: 40.4288px;"></div>
            <div class="slimScrollRail"
                 style="width: 5px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div>
        </div>
    </div>
</nav>
