@extends('layouts.admin2.main')

@section('title')
    Bảng điều khiển
@endsection

@section('content')
    <!-- ./col -->
    <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                @if (\App\Song::all() !== null)
                    <h3>{{count(\App\Song::all())}}</h3>
                @endif
                <p>Số lượng bài hát</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{route('songs.home')}}" class="small-box-footer">Xem thêm <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                @if (\App\User::all() !== null)
                    <h3>{{count(\App\User::all())}}</h3>
                @endif
                <p>Số lượng thành viên</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="{{route('users.home')}}" class="small-box-footer">Xem thêm <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                @if (\App\Artist::all() !== null)
                    <h3>{{count(\App\Artist::all())}}</h3>
                @endif
                <p>Số lượng ca sĩ</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{route('artists.home')}}" class="small-box-footer">Xem thêm <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header border-transparent">
                <h3 class="card-title font-weight-bold text-uppercase">Bài hát được nghe nhiều nhất</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0" style="display: block;">
                <div class="table-responsive">
                    <table class="table m-0">
                        <thead>
                        <tr>
                            <th>Tên bài hát</th>
                            <th>Ca sĩ</th>
                            <th class="text-center">Số lượt nghe</th>
                            <th class="text-center">Số lượt yêu thích</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($songs as $song)
                            <tr>
                                <td><a href="{{route('singleSong', ['songid' => $song->id])}}">{{$song->name}}</a></td>
                                <td>
                                    @foreach($song->artists as $artist)
                                        <a href="{{route('singleArtist', ['artisId' => $artist->id])}}">{{$artist->nick_name}}</a> @if ($loop->last) @else
                                            , @endif
                                    @endforeach
                                </td>
                                <td class="text-center">
                                    <p>{{$song->view}}</p>
                                </td>
                                <td class="text-center">
                                    <p>{{$song->like}}</p>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix" style="display: block;">
                <a href="{{route('songs.add')}}" class="btn btn-sm btn-info float-left">Thêm bài hát mới</a>
                <a href="{{route('songs.home')}}" class="btn btn-sm btn-secondary float-right">Xem tất cả bài hát</a>
            </div>
            <!-- /.card-footer -->
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title font-weight-bold text-uppercase">Ca sĩ đang được quan tâm nhiều</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <ul class="users-list clearfix">
                    @foreach($artists as $artist)
                        <li class="text-center">
                            <div class="img-128">
                                <img src="{{url($artist->cover_image)}}" alt="{{$artist->nick_name}}">
                            </div>
                            <a class="users-list-name"
                               href="{{route('singleArtist', ['artisId' => $artist->id])}}">{{$artist->nick_name}}</a>
                            <span class="users-list-date">{{$artist->follow}} người quan tâm</span>
                        </li>
                    @endforeach
                </ul>
                <!-- /.users-list -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer text-center">
                <a href="{{route('artists.home')}}">Xem tất cả ca sĩ</a>
            </div>
            <!-- /.card-footer -->
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card">
            <div class="card-header border-transparent">
                <h3 class="card-title font-weight-bold text-uppercase">Bài hát Mới được thêm</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0" style="display: block;">
                <div class="table-responsive">
                    <table class="table m-0">
                        <thead>
                        <tr>
                            <th>Tên bài hát</th>
                            <th>Ca sĩ</th>
                            <th class="text-center">Số lượt nghe</th>
                            <th class="text-center">Số lượt yêu thích</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($songsNewAdd as $song)
                            <tr>
                                <td><a href="{{route('singleSong', ['songid' => $song->id])}}">{{$song->name}}</a></td>
                                <td>
                                    @foreach($song->artists as $artist)
                                        <a href="{{route('singleArtist', ['artisId' => $artist->id])}}">{{$artist->nick_name}}</a> @if ($loop->last) @else
                                            , @endif
                                    @endforeach
                                </td>
                                <td class="text-center">
                                    <p>{{$song->view}}</p>
                                </td>
                                <td class="text-center">
                                    <p>{{$song->like}}</p>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix" style="display: block;">
                <a href="{{route('songs.add')}}" class="btn btn-sm btn-info float-left">Thêm bài hát mới</a>
                <a href="{{route('songs.home')}}" class="btn btn-sm btn-secondary float-right">Xem tất cả bài hát</a>
            </div>
            <!-- /.card-footer -->
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title font-weight-bold text-uppercase">Bình luận mới</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <ul class="products-list product-list-in-card pl-2 pr-2">
                    @foreach($comment as $c)
                        <li class="item">
                            <div class="product-img">
                                <img src="{{url($c->user->avatar)}}" alt="{{$c->user->username}}" class="img-size-50">
                            </div>
                            <div class="product-info">
                                <span class="product-title">{{$c->user->username}}
                                    <span class="badge badge-warning float-right"></span>
                                </span>
                                <span class="product-description">{{$c->content}}</span>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
            <!-- /.card-body -->
            <div class="card-footer text-center">
                <a href="{{route('comments.home')}}" class="uppercase">Xem tất cả bình luận</a>
            </div>
            <!-- /.card-footer -->
        </div>
    </div>

    <style>
        .img-128 {
            width: 100px !important;
            height: 100px !important;
            margin: 0 auto;
        }

        .img-128 img {
            width: 128px !important;
            height: 100% !important;
            object-fit: cover !important;
        }
    </style>
@endsection
