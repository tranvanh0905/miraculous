<div class="adonis-player-wrap" data-sticky-offset="150">
    <div id="adonis_jp_container" class="master-container-holder" role="application" aria-label="media player">
        <div id="adonis_jplayer_main" class="jp-jplayer"></div>
        <div class="adonis-player-horizontal">
            <div class="master-container-fluid">
                <div class="row adonis-player pt-3 flex-nowrap justify-content-between">
                    <div class="col-sm-5 col-lg-4 col-xxl-3 d-none d-sm-block">
                        <div class="media current-item">
                            <div class="mr-3 song-poster sm">
                                <img class="box-rounded-sm" src="" alt="">
                            </div>
                            <div class="des">
                                <div class="jp-title h5 mb-1" aria-label="title"></div>
                                <div class="artist-name inactive-color">
                                    <a href="#" class="inactive-color"></a>
                                </div>
                            </div>
                            @if(\Illuminate\Support\Facades\Auth::check())
                                <div class="ml-auto mt-auto mb-auto align-items-center d-none d-xl-flex lh-0">
                                    <a id="like" class="pl-2 pr-2 d-inline-block fs-2 inactive-color"></a>
                                    <a class="pl-2 ml-3 pr-2 d-inline-block inactive-color dropdown-menu-toggle drop-player" data-songid="">
                                        <span class="icon-dot-nav-vertical adonis-icon icon-2x">
                                        </span>
                                    </a>
                                </div>
                            @endif
                        </div>
                        <div class="jp-details">
                            <div class="jp-title mt-2" aria-label="title"></div>
                        </div>
                    </div>
                    <div class="col-auto col-lg-4 col-xxl-6 d-flex align-items-center">
                        <div class="m-auto d-flex flex-row lh-0 player-controls align-items-center fs-3">
                            <div class="current-item d-block d-sm-none">
                                <div class="mr-3 song-poster sm">
                                    <img class="box-rounded-sm" src="" alt="">
                                </div>
                            </div>
                            <a class="jp-shuffle inactive-color mr-4 d-none d-md-block" role="button"
                               tabindex="0">
                                <span class="adonis-icon icon-2x">
                                    <i class="fas fa-random fs-14"></i>
                                </span>
                            </a>
                            <div class="control-primary d-flex align-items-center justify-content-between">
                                <a class="jp-previous" role="button" tabindex="0">
                                    <span class="adonis-icon icon-4x">
                                        <i class="fas fa-backward fs-21"></i>
                                    </span>
                                </a>

                                <a class="jp-play fs-6 ml-2 mr-2" role="button" tabindex="0">
                                    <span class="adonis-icon icon-play icon-3x">
                                        <i class="fas fa-play fs-29"></i>
                                    </span>
                                    <span class="adonis-icon icon-pause icon-3x">
                                        <i class="fas fa-pause fs-29"></i>
                                    </span>
                                </a>
                                <a class="jp-next" role="button" tabindex="0">
                                    <span class="adonis-icon icon-4x">
                                        <i class="fas fa-forward fs-21"></i>
                                    </span>
                                </a>
                            </div>
                            <a class="jp-repeat inactive-color ml-4 d-none d-md-block" role="button"
                               tabindex="0">
                                <span class="adonis-icon icon-3x">
                                    <i class="fas fa-sync-alt fs-14"></i>
                                </span>
                            </a>
                        </div>
                    </div>
                    <div
                        class="col-auto col-lg-4 col-xxl-3 d-flex align-items-center justify-content-end pl-0 pl-sm-3">
                        <div class="mr-e-30 d-none d-lg-block">
                            <div class="jp-current-time" role="timer" aria-label="time"></div>
                            <div class="jp-duration" role="timer" aria-label="duration"></div>
                        </div>
                        <div class="mr-e-30">
                            <a class="toggle-off-canvas" data-target="#adonis-playlist"
                               role="button" tabindex="0">
                                <span class="adonis-icon icon-4x">
                                    <i class="fas fa-sliders-h fs-19"></i>
                                </span>
                            </a>
                        </div>
                        <div class="jp-volume-controls flex-row align-items-center d-none d-xl-flex">
                            <a class="mr-e-30 adonis-mute-control" role="button" tabindex="0">
                                <span class="adonis-icon icon-volume icon-3x">
                                    <i class="fas fa-volume-up fs-19"></i>
                                </span>
                                <span class="adonis-icon icon-mute icon-3x">
                                    <i class="fas fa-volume-mute fs-19"></i>
                                </span>
                            </a>
                            <div class="jp-volume-bar d-flex align-items-center">
                                <div class="jp-volume-bar-value"></div>
                            </div>
                        </div>
                        <div class="align-items-center d-flex d-xl-none lh-0">
                            <a id="like2" class="pl-2 pr-2 d-inline-block fs-2 inactive-color"></a>
                        </div>
                    </div>
                </div>
            </div> <!--./ container-fluid-->
            <div class="jp-progress d-flex align-items-center jp-progress-pos-top">
                <div class="jp-seek-bar">
                    <div class="jp-play-bar"></div>
                </div>
            </div>
        </div>

        <div id="adonis-playlist" class="adonis-playlist off-canvas off-canvas-right d-flex flex-column">
            <div class="adonis-playlist-player adonis-player player-bg-yellow">
                <a class="close-offcanvas m-2" data-target="#adonis-playlist" href="#">
                    <span class="adonis-icon icon-3x">
                        <i class="fas fa-times fs-19"></i>
                    </span>
                </a>
                <div class="blurred-bg-wrap">
                    <div class="blurred-bg"></div>
                </div>
                <div class="media current-item">
                    <div class="song-poster mb-4 col-4 p-0">
                        <img class="box-rounded-sm" src="" alt="">
                    </div>
                    <div class="player-details col-8 pr-0 pl-20 pl-e-lg-30">
                        <h3 class="h2 mt-3 mb-3 jp-title"></h3>
                        <p class="artist-name"></p>
                        <div class="controls d-flex flex-row justify-content-between">
                            <div class="fs-3">
                                <a class="jp-shuffle inactive-color mr-3 ml-0" role="button" tabindex="0">
                                    <span class="adonis-icon icon-2x">
                                          <i class="fas fa-random fs-19"></i>
                                    </span>
                                </a>
                                <a class="jp-repeat inactive-color ml-1" role="button" tabindex="0" id="repeat-button">
                                    <span class="adonis-icon icon-3x">
                                        <i class="fas fa-sync-alt fs-19"></i>
                                    </span>
                                </a>
                            </div>
                            <div class="lh-0 align-items-center d-flex">
                                @if(\Illuminate\Support\Facades\Auth::check())
                                    <a id="like3" class="pl-2 pr-2 d-inline-block fs-2 inactive-color"></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex fs-1 mt-3 media align-items-center controls">
                    <div
                        class="lh-0 d-flex playlist-player-control justify-content-between align-items-center col-4 p-0 ">

                        <a class="jp-previous" role="button" tabindex="0">
                            <span class="adonis-icon icon-5x">
                                 <i class="fas fa-backward fs-21"></i>
                            </span>
                        </a>


                        <a class="jp-play fs-4" role="button" tabindex="0">
                            <span class="adonis-icon icon-play icon-3x">
                                <i class="fas fa-play fs-29"></i>
                            </span>
                            <span class="adonis-icon icon-pause icon-3x">
                                <i class="fas fa-pause fs-29"></i>
                            </span>
                        </a>


                        <a class="jp-next" role="button" tabindex="0">
                            <span class="adonis-icon icon-5x">
                                <i class="fas fa-forward fs-21"></i>
                            </span>
                        </a>

                    </div>
                    <div class="d-flex control-ext align-items-center col-8 pr-0 pl-20 pl-e-lg-30">
                        <div class="jp-current-time mr-1 jp-time" role="timer" aria-label="time"></div>
                        <div class="jp-progress d-flex ml-2 mr-2 jp-time d-flex align-items-center">
                            <div class="jp-seek-bar">
                                <div class="jp-play-bar"></div>
                            </div>
                        </div>
                        <div class="jp-duration mr-1" role="timer" aria-label="duration"></div>
                    </div>
                </div>
            </div>
            <p class="font-weight-bold text-uppercase pt-2 pl-3">Danh sách phát</p>
            <div class="jp-playlist scroll-y">
                <ul>
                    <li></li>
                </ul>
            </div>
            <div class="name-playing d-flex justify-content-between pr-3 pt-2">
               <p class="font-weight-bold text-uppercase pl-3">Gợi ý  <span><i class="fas fa-sync-alt ml-3 pointer reload-suggest"></i></span></p>
                <div class="toggle-button-demo">
                    <label class="switch">
                        <input type="checkbox" id="auto-play-suggest" checked>
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
            <div class="song-suggest-player scroll-y ps ps--active-y">
            </div>
        </div> <!-- / #adonis-playlist -->
        <div class="jp-no-solution">
            <span>Update Required</span>
            To play the media you will need to either update your browser to a recent version or update your <a
                href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
        </div>
    </div>
</div>
<div id="data-player-ajax"></div>
