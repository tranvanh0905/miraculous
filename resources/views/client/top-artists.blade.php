@extends('layouts.client.main')

@section('title')
    Top ca sĩ
@endsection

@section('content')
    <div class="pt-4 pt-lg-5"></div>
    <div class="container">
        <main id="main">
            <div class="title-box">
                <h2 class="title h3-md">Bảng xếp hạng nghệ sĩ</h2>
            </div>
            <div class="library-artists">
                <div class="row auto-columns js-effect" data-animation="Sobek"
                     data-animation-item=".music-img-box"
                     data-responsive-width="0:100%|300:50%|560:33%|820:25%|980:20%|1240:16.66%|1500:14.2858%">
                    <div class="col-auto mb-4">
                        <div class="music-img-box">
                            <div class="img-box rounded-circle">
                                <img class="retina" src="client/images/new-releases/new-releases-3.jpg"
                                     data-2x="assets/images/new-releases/new-releases-3@2x.jpg" alt="">
                            </div>
                            <div class="desc top-sm text-center">
                                <h5 class="title fs-3"><a href="#" class="f-w-500 h-underline">The Ronettes</a>
                                </h5>
                                <h6 class="f-w-400"><a href="#">FOLLOWING</a></h6>
                                <p class="sub-title"><a href="#">3 Songs</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <div class="pt-e-20 pt-e-lg-40"></div>
    </div>
@endsection
