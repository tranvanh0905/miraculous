@extends('layouts.admin.main')

@section('title')
    Bài hát
@endsection

@section('content')
    <div class="pcoded-content">
        <div class="pcoded-inner-content">
            <div class="main-body">
                <div class="page-wrapper">
                    <div class="page-body">
                        <div class="row">
                            <div class="col-xl-12 col-md-12">
                                <div class="card table-card">
                                    <div class="card-header">
                                        <h5>Danh sách ca sĩ</h5>
                                        <div class="card-header-right">
                                        </div>
                                    </div>
                                    <div class="card-block">
                                        <div class="table-responsive">
                                            <table class="table table-hover m-b-0">
                                                <thead>
                                                <tr>
                                                    <th>Nghệ danh</th>
                                                    <th>Ảnh đại diện</th>
                                                    <th>Tên đầy đủ</th>
                                                    <th>Lượt theo dõi</th>
                                                    <th>Trạng thái</th>
                                                    <th>Hành động</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach ($artists as $artist)
                                                    <tr>
                                                        <td>{{$artist->nick_name}}</td>
                                                        <td><img width="50px" src="{{url($artist->avatar)}}" alt="">
                                                        </td>
                                                        <td>{{$artist->full_name}}</td>
                                                        <td>{{$artist->follow}}</td>
                                                        <td><label
                                                                class="label label-success">{{$artist->status}}</label>
                                                        </td>
                                                        <td>
                                                            <a href="{{route('artists.update', ['id' => $artist->id])}}"><i
                                                                    class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i></a><a
                                                                href="{{route('artists.delete', ['id' => $artist->id])}}" onclick="return confirm('Are you sure you want to delete this item?');"><i
                                                                    class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <ul class="pagination">
                            {{ $artists->links() }}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
