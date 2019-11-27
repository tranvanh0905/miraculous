@foreach($suggestSong as $song)
    <li class="item hover-bg-item item-2" data-song-id="{{$song->id}}">
        <div class="item-number">
            <span class="hover-hide">
                 <img src="{{url($song->cover_image)}}" alt="{{$song->name}}"
                      width="50px" height="50px" class="rounded">
            </span>
            <span class="hover-show adonis-icon icon-1x adonis-album-button" data-type="song"
                  data-album-id="{{$song->id}}"><svg
                        xmlns="http://www.w3.org/2000/svg" version="1.1"><use
                            xlink:href="#icon-brand-play"></use></svg> </span>
        </div>
        <a href="{{route('singleSong', ['songId' => $song->id])}}" class="item-title font-weight-bold">{{$song->name}}</a>
        <div class="item-genre"><a href="{{route('singleGenres', ['genresId' => $song->genres->id])}}"
                                   class="hover-hide hover-lg-show">{{$song->genres->name}}</a>
        </div>
        <div class="item-tools">
            <span class="hover-hide">{{$song->view}} <i class="fas fa-headphones-alt fa-1x"></i></span>
            <div class="hover-show d-flex flex-nowrap hover-tools">
                @if(\Illuminate\Support\Facades\Auth::check())
                    @if(count(\App\Model_client\UserLikedSong::where
                    ('user_id', '=',
\Illuminate\Support\Facades\Auth::id())->where('song_id', '=', $song->id)->get()) == 1)
                        <span class="adonis-icon icon-2x pointer  box-dis-like-global d-flex ">
                            <i class="fas fa-heart fa-2x font-14" id="likeGlobal" data-type="song"
                               data-id="{{$song->id}}"
                            ></i><i class="fas fa-plus fa-2x font-14 ml-2 add-to-playlist"
                                    data-song-id="{{$song->id}}" data-playlist-id="{{$singlePlaylist->id}}"></i>
                        </span>
                    @else
                        <span class=" adonis-icon icon-2x pointer box-like-global d-flex ">
                            <i class="far fa-heart fa-2x font-14" id="likeGlobal" data-type="song"
                               data-id="{{$song->id}}"></i>
                            <i class="fas fa-plus fa-2x font-14 ml-2 add-to-playlist"
                               data-song-id="{{$song->id}}" data-playlist-id="{{$singlePlaylist->id}}"></i>
                        </span>
                    @endif

                @endif
            </div>
        </div>
        <div class="hover-bg gradient-adonis"></div>
    </li>
@endforeach
