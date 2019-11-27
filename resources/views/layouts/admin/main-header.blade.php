<nav class="navbar header-navbar pcoded-header iscollapsed" header-theme="themelight1" pcoded-header-position="fixed">
    <div class="navbar-wrapper">
        <div class="navbar-logo" logo-theme="theme6">
            <a href="{{url('admin')}}">
                <strong>Miraculous</strong>
            </a>
            <a class="mobile-menu" id="mobile-collapse" href="#!">
                <i class="feather icon-menu icon-toggle-left"></i>
            </a>
        </div>
        <div class="navbar-container container-fluid">
            <ul class="nav-left">
            </ul>
            <ul class="nav-right">
                <li class="user-profile header-notification">
                    <div class="dropdown-primary dropdown">
                        <div class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{url(\Illuminate\Support\Facades\Auth::user()->avatar)}}"
                                 class="img-radius" alt="User-Profile-Image">
                            <span>{{\Illuminate\Support\Facades\Auth::user()->username}}</span>
                            <i class="feather icon-chevron-down"></i>
                        </div>
                        <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn"
                            data-dropdown-out="fadeOut">
                            <li>
                                <a href="">
                                    <i class="feather icon-settings"></i> Settings
                                </a>
                            </li>
                            <li>
                                <a href="auth-sign-in-social.html">
                                    <i class="feather icon-log-out"></i> Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div id="sidebar" class="users p-chat-user showChat">
    <div class="had-container">
        <div class="p-fixed users-main">
            <div class="user-box">
                <div class="chat-search-box">
                    <a class="back_friendlist">
                        <i class="feather icon-x"></i>
                    </a>
                    <div class="right-icon-control">
                        <div class="input-group input-group-button">
                            <input type="text" id="search-friends" name="footer-email" class="form-control"
                                   placeholder="Search Friend">
                            <div class="input-group-append">
                                <button class="btn btn-primary waves-effect waves-light" type="button"><i
                                        class="feather icon-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 577px;">
                    <div class="main-friend-list" style="overflow: hidden; width: auto; height: 577px;">
                        <div class="media userlist-box waves-effect waves-light" data-id="1" data-status="online"
                             data-username="Josephin Doe">
                            <a class="media-left" href="#!">
                                <img class="media-object img-radius img-radius"
                                     src="../files/assets/images/avatar-3.jpg" alt="Generic placeholder image ">
                                <div class="live-status bg-success"></div>
                            </a>
                            <div class="media-body">
                                <div class="chat-header">Josephin Doe</div>
                            </div>
                        </div>
                        <div class="media userlist-box waves-effect waves-light" data-id="2" data-status="online"
                             data-username="Lary Doe">
                            <a class="media-left" href="#!">
                                <img class="media-object img-radius" src="../files/assets/images/avatar-2.jpg"
                                     alt="Generic placeholder image">
                                <div class="live-status bg-success"></div>
                            </a>
                            <div class="media-body">
                                <div class="f-13 chat-header">Lary Doe</div>
                            </div>
                        </div>
                        <div class="media userlist-box waves-effect waves-light" data-id="3" data-status="online"
                             data-username="Alice">
                            <a class="media-left" href="#!">
                                <img class="media-object img-radius" src="../files/assets/images/avatar-4.jpg"
                                     alt="Generic placeholder image">
                                <div class="live-status bg-success"></div>
                            </a>
                            <div class="media-body">
                                <div class="f-13 chat-header">Alice</div>
                            </div>
                        </div>
                        <div class="media userlist-box waves-effect waves-light" data-id="4" data-status="offline"
                             data-username="Alia">
                            <a class="media-left" href="#!">
                                <img class="media-object img-radius" src="../files/assets/images/avatar-3.jpg"
                                     alt="Generic placeholder image">
                                <div class="live-status bg-default"></div>
                            </a>
                            <div class="media-body">
                                <div class="f-13 chat-header">Alia
                                    <small class="d-block text-muted">10 min ago</small>
                                </div>
                            </div>
                        </div>
                        <div class="media userlist-box waves-effect waves-light" data-id="5" data-status="offline"
                             data-username="Suzen">
                            <a class="media-left" href="#!">
                                <img class="media-object img-radius" src="../files/assets/images/avatar-2.jpg"
                                     alt="Generic placeholder image">
                                <div class="live-status bg-default"></div>
                            </a>
                            <div class="media-body">
                                <div class="f-13 chat-header">Suzen
                                    <small class="d-block text-muted">15 min ago</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="slimScrollBar"
                         style="background: rgb(0, 0, 0); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px;"></div>
                    <div class="slimScrollRail"
                         style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="showChat_inner">
    <div class="media chat-inner-header">
        <a class="back_chatBox">
            <i class="feather icon-x"></i> Josephin Doe
        </a>
    </div>
    <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 502px;">
        <div class="main-friend-chat" style="overflow: hidden; width: auto; height: 502px;">
            <div class="media chat-messages">
                <a class="media-left photo-table" href="#!">
                    <img class="media-object img-radius img-radius m-t-5" src="../files/assets/images/avatar-2.jpg"
                         alt="Generic placeholder image">
                </a>
                <div class="media-body chat-menu-content">
                    <div class="">
                        <p class="chat-cont">I'm just looking around. Will you tell me something about yourself?</p>
                    </div>
                    <p class="chat-time">8:20 a.m.</p>
                </div>
            </div>
            <div class="media chat-messages">
                <div class="media-body chat-menu-reply">
                    <div class="">
                        <p class="chat-cont">Ohh! very nice</p>
                    </div>
                    <p class="chat-time">8:22 a.m.</p>
                </div>
            </div>
            <div class="media chat-messages">
                <a class="media-left photo-table" href="#!">
                    <img class="media-object img-radius img-radius m-t-5" src="../files/assets/images/avatar-2.jpg"
                         alt="Generic placeholder image">
                </a>
                <div class="media-body chat-menu-content">
                    <div class="">
                        <p class="chat-cont">can you come with me?</p>
                    </div>
                    <p class="chat-time">8:20 a.m.</p>
                </div>
            </div>
        </div>
        <div class="slimScrollBar"
             style="background: rgb(0, 0, 0); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px;"></div>
        <div class="slimScrollRail"
             style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div>
    </div>
    <div class="chat-reply-box">
        <div class="right-icon-control">
            <div class="input-group input-group-button">
                <input type="text" class="form-control" placeholder="Write hear . . ">
                <div class="input-group-append">
                    <button class="btn btn-primary waves-effect waves-light" type="button"><i
                            class="feather icon-message-circle"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>
