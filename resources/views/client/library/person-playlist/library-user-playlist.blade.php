@extends('layouts.client.main-account-library')

@section('title')
    Thư viện - Danh sách phát cá nhân
@endsection

@section('content')
    <section>
        <div class="pt-3"></div>
        <div class="d-flex">
            <div class="title-box">
                <h2 class="title h3-md">Danh sách phát cá nhân</h2>
            </div>
        </div>
       <div class="row">
           <div class="col-12 mb-3">
               <a href="{{route('user.playlistAdd')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Tạo danh sách phát cá nhân mới</a>
           </div>
       </div>

        @if(count($userPlaylists) == 0)
            <div class="row">
                <div class="col-12">
                    <div class="no-content-block text-center p-5 rounded">
                        <img src="{{url('client/images/audio_default.png')}}" alt="no-song" class="d-block mx-auto"
                             width="100px" height="auto">
                        <h3 class="m-3">Bạn chưa có danh sách phát cá nhân</h3>
                    </div>
                </div>
            </div>
        @else
            <div class="row auto-fit-columns adonis-animate" data-animation="slideUp"
                 data-animation-item=".music-img-box" data-item-width="230" data-item-max-width="260">
                @foreach($userPlaylists as $playlist)
                    <div class="col-auto">
                        <div class="music-img-box mb-e-30 mb-e-lg-40 playlist-user" id="userPlaylist{{$playlist->id}}">
                            <div class="img-box box-rounded-sm">
                                <img class="retina" src="{{url($playlist->cover_image)}}"
                                     data-2x="{{url($playlist->cover_image)}}" alt="{{$playlist->name}}">
                                <div class="hover-state">
                                    <div class="absolute-bottom-left pl-e-20 pb-e-20">
                                            <span class="pointer play-btn-dark round-btn adonis-album-button" data-type="playList"
                                                  data-album-id="{{$playlist->id}}"><i
                                                        class="play-icon"></i></span>
                                    </div>
                                    <div class="absolute-top-right pr-e-20 pt-e-20">
                                            <span class="pointer drop-2" data-user-playlist-id="{{$playlist->id}}"><span
                                                        class="adonis-icon icon-4x"><svg xmlns="http://www.w3.org/2000/svg"
                                                                                         version="1.1"><use
                                                                xlink:href="#icon-horizontal-dots"></use></svg></span></span>
                                    </div>
                                </div>
                            </div>
                            <h6 class="title"><a href="{{route('user-library-personal-playlist-detail', ['playlistId' => $playlist->id])}}">{{$playlist->name}}</a></h6>
                            <p class="sub-title category">
                                <p>Đăng bởi {{$playlist->user->username}}</p>
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-12 pt-3">
                    {{ $userPlaylists->links() }}
                </div>
            </div>
        @endif

    </section>

    @if (session('status'))
        <script>
            setTimeout(function () {
                $.notify({
                    icon: 'glyphicon glyphicon-ok',
                    message: "{{session('status')}}"
                })
            }, 1000)
        </script>
    @endif

@endsection
