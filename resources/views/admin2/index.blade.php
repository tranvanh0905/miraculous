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
    <div class="col-md-12">
        <div class="card table-card">
            <div class="card-header">
                <h5>Những bài hát mới nhất</h5>
                <div class="card-header-right">
                    <ul class="list-unstyled card-option">
                        <li class="first-opt"><i
                                class="feather icon-chevron-left open-card-option"></i></li>
                        <li><i class="feather icon-maximize full-card"></i></li>
                        <li><i class="feather icon-minus minimize-card"></i></li>
                        <li><i class="feather icon-refresh-cw reload-card"></i></li>
                        <li><i class="feather icon-trash close-card"></i></li>
                        <li><i class="feather icon-chevron-left open-card-option"></i></li>
                    </ul>
                </div>
            </div>
            <div class="card-block p-b-0">
                <div class="table-responsive">
                    <table class="table table-hover m-b-0">
                        <thead>
                        <tr>
                            <th>Tên bài hát</th>
                            <th>Người thể hiện</th>
                            <th>Số lượt xem</th>
                            <th>Số lượt yêu thích</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if ($songs !== null)
                            @foreach ($songs as $song)
                                <tr>
                                    <td>{{$song->name}}</td>
                                    @if ($song->artists !== null)

                                        <td> @foreach ($song->artists as $key => $value){{$song->artists[$key]->nick_name}} {!! "<br>"  !!} @endforeach</td>

                                    @endif
                                    <td>{{$song->view}}</td>
                                    <td>{{$song->like}}</td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
