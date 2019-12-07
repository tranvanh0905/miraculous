<footer class="site-footer" id="site-footer">
    <div class="master-container-fluid">
        <hr>
    </div>
    <div class="master-container-fluid">
        <div class="row">
            <div class="col-md-12 col-lg-4 col-xl-3 order-1 order-md-1 order-lg-1 mb-md-3">
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
            <div class="col-md-12 col-lg-8 col-xl-9 order-2 order-md-2 pl-e-lg-70 ">
                <div class="row">
                    <div class="col-md-4 col-xl-4">
                        <div class="footer-manage widget">
                            <h5 class="widget-title text-uppercase font-weight-bold">Liên kết hữu ích</h5>
                            <ul class="list-inline vertical-list">
                                <li><a href="{{route('client.home')}}">Trang chủ</a></li>
                                <li><a href="{{route('user-profile')}}">Tài khoản</a></li>
                                <li><a href="#">Lấy lại mật khẩu</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4 col-xl-4">
                        <div class="widget">
                            <h5 class="widget-title text-uppercase font-weight-bold">Bài hát ngẫu nhiên</h5>
                            <div class="footer-album-list music-img-box-cont-sm">
                                @foreach(get3songBottom() as $song)
                                    <div class="img-box-horizontal music-img-box h-g-bg h-d-shadow">
                                        <div class="img-box img-box-sm box-rounded-sm">
                                            <img src="{{$song->cover_image}}" alt="{{$song->name}}">
                                        </div>
                                        <div class="des">
                                            <h6 class="title fs-2"><a
                                                    href="{{route('singleSong', ['songId' => $song->id])}}">{{$song->name}}</a>
                                            </h6>
                                            <p class="sub-title">
                                                @foreach($song->artists as $artist)
                                                    <a href="{{route('singleArtist', ['artistId' => $artist->id])
                                                            }}">{{$artist->nick_name}}</a>
                                                @endforeach
                                            </p>
                                        </div>
                                        <div
                                            class="hover-state d-flex justify-content-between align-items-center">
                                                    <span
                                                        class="pointer play-btn-dark box-rounded-sm adonis-album-button"
                                                        data-type="song"
                                                        data-album-id="{{$song->id}}">
                                                         <i class="fas fa-play fs-19 text-light"></i>
                                                    </span>
                                            <div class="d-flex align-items-center">
                                                        <span class="adonis-icon text-light pointer mr-2 icon-2x">
                                                        @if(\Illuminate\Support\Facades\Auth::check())
                                                                @if(!\App\Model_client\UserLikedSong::where('user_id', '=',\Illuminate\Support\Facades\Auth::user()->id)->where('song_id', '=', $song->id)->exists())
                                                                    <span class="adonis-icon icon-2x box-like-global">
                                                                    <i class="far fa-heart fa-2x font-14"
                                                                       id="likeGlobal" data-type="song"
                                                                       data-id="{{$song->id}}"
                                                                    ></i>
                                                                  </span>
                                                                @else
                                                                    <span
                                                                        class="adonis-icon icon-2x box-dis-like-global">
                                                                <i class="fas fa-heart fa-2x font-14" id="likeGlobal"
                                                                   data-type="song"
                                                                   data-id="{{$song->id}}"></i>
                                                                </span>
                                                                @endif
                                                                <span class="pointer dropdown-menu-toggle"
                                                                      data-songid="{{$song->id}}" data-link="123">
                                                                    <span
                                                                        class="icon-dot-nav-horizontal text-light"></span>
                                                                </span>
                                                            @endif
                                                        </span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-xl-4 text-right">
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
    @if(\Illuminate\Support\Facades\Auth::check())
        <input type="hidden" name="id" value="{{url(\Illuminate\Support\Facades\Auth::user()->id)}}">
        <input type="hidden" name="user-image" value="{{url(\Illuminate\Support\Facades\Auth::user()->avatar)}}">
        <input type="hidden" name="user-name" value="{{\Illuminate\Support\Facades\Auth::user()->username}}">
    @endif
</footer>
<!-- Modal -->
<div class="modal fade custom-modal" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" id="exampleModalLongTitle"><i class="fas fa-share-alt-square"></i> Chia sẻ bài hát</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group mb-3">
                    <input type="text" class="link-share form-control" id="linkShare" aria-describedby="basic-addon2" value="123">
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2">
                            <button class="btn" data-clipboard-target="#linkShare">
                                <i class="fas fa-copy"></i>
                            </button>
                        </span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
