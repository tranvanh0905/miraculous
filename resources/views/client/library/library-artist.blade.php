@extends('layouts.client.main-account-library')

@section('title')
    Thư viện - Ca sĩ
@endsection

@section('content')
    <section>
        <div class="pt-3"></div>
        <div class="d-flex">
            <div class="title-box">
                <h2 class="title h3-md">Ca sĩ</h2>
            </div>
        </div>

        <div class="row">
            @if(count($artistFollow) == 0)
                <div class="col-12">
                    <div class="no-content-block text-center p-5 rounded">
                        <img src="{{url('client/images/audio_default.png')}}" alt="no-song" class="d-block mx-auto"
                             width="100px" height="auto">
                        <h3 class="m-3">Bạn chưa quan tâm ca sĩ!!!</h3>
                        <a href="{{route('all', ['type' => 'artists'])}}">Nhấn để khám phá</a>
                    </div>
                </div>
            @else
                <div class="col-lg-12">
                    <div class="row auto-columns adonis-animate" data-animation="slideRightSkew"
                         data-animation-item=".music-img-box"
                         data-responsive-width="0:100%|300:50%|560:33%|820:25%|980:20%|1240:16.66%|1500:14.2858%">
                        @foreach($artistFollow as $artist)
                            <div class="col-auto">
                                <div class="music-img-box mb-e-30 mb-e-md-40 text-center">
                                    <div class="img-box rounded-circle img-artist-index">
                                        <img class="retina" src="{{url($artist->avatar)}}"
                                             data-2x="{{url($artist->avatar)}}" alt="{{$artist->name}}">
                                    </div>
                                    <div class="desc top-sm text-center">
                                        <h5 class="title fs-3">
                                            <a href="{{route('singleArtist', ['artistId' => $artist->id])}}" class="f-w-500
                                        h-underline">{{$artist->nick_name}}</a>
                                        </h5>
                                        <p class="sub-title"><span class="count-follow" data-artist-id="{{$artist->id}}">{{$artist->follow}}</span>
                                            người quan tâm</p>
                                    </div>
                                    @if(\Illuminate\Support\Facades\Auth::check())
                                        <a href="javascript:;" class="btn btn-primary btn-follow" data-artist-id="{{$artist->id}}">

                                            @if(!\App\Model_client\UserFollowDetail::where('user_id', '=',
                                            \Illuminate\Support\Facades\Auth::user()->id)
                                            ->where
                                            ('artist_id', '=', $artist->id)->exists())
                                                <i class="fas fa-user-plus"></i> Quan tâm
                                            @else
                                                <i class="fas fa-user-minus"></i> Bỏ quan tâm
                                            @endif
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
