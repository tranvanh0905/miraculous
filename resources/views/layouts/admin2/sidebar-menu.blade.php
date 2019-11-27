<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-item">
            <a href="{{route('admin.home')}}" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Bảng điều khiển
                </p>
            </a>
        </li>

        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                    Ca sĩ
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item">
                    <a href="{{route('artists.home')}}" class="nav-link">
                        <i class="nav-icon fas fa-list"></i>
                        <p>Danh sách ca sĩ</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('artists.add')}}" class="nav-link">
                        <i class="nav-icon fas fa-plus"></i>
                        <p>Thêm mới</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-music"></i>
                <p>
                    Bài hát
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item">
                    <a href="{{route('songs.home')}}" class="nav-link">
                        <i class="nav-icon fas fa-list"></i>
                        <p>Danh sách bài hát</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('songs.add')}}" class="nav-link">
                        <i class="nav-icon fas fa-plus"></i>
                        <p>Thêm mới</p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-text-height"></i>
                        <p>
                            Thể loại
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="{{route('kinds.home')}}" class="nav-link">
                                <i class="nav-icon fas fa-list"></i>
                                <p>Danh sách thể loại</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('kinds.add')}}" class="nav-link">
                                <i class="nav-icon fas fa-plus"></i>
                                <p>Thêm mới</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>

        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-quran"></i>
                <p>
                    Album
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item">
                    <a href="{{route('albums.home')}}" class="nav-link">
                        <i class="nav-icon fas fa-list"></i>
                        <p>Danh sách album</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('albums.add')}}" class="nav-link">
                        <i class="nav-icon fas fa-plus"></i>
                        <p>Thêm mới</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-play-circle"></i>
                <p>
                    Danh sách phát
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item">
                    <a href="{{route('playlist.home')}}" class="nav-link">
                        <i class="nav-icon fas fa-list"></i>
                        <p>Danh sách phát</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('playlist.add')}}" class="nav-link">
                        <i class="nav-icon fas fa-plus"></i>
                        <p>Thêm mới</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-user-circle"></i>
                <p>
                    Tài khoản
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item">
                    <a href="{{route('users.home')}}" class="nav-link">
                        <i class="nav-icon fas fa-list"></i>
                        <p>Danh sách tài khoản</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('users.add')}}" class="nav-link">
                        <i class="nav-icon fas fa-plus"></i>
                        <p>Thêm mới</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-comments"></i>
                <p>
                    Bình luận
                </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{route('websetting.home')}}" class="nav-link">
                <i class="nav-icon fas fa-cogs"></i>
                <p>
                    Cài đặt
                </p>
            </a>
        </li>
    </ul>
</nav>


