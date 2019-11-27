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
                                        <h5>Danh sách bài hát</h5>
                                        <a href="{{route('songs.add')}}">
                                            <button class="btn btn-primary">+ Thêm bài hát</button>
                                        </a>
                                        <div class="card-header-right">
                                        </div>
                                    </div>
                                    <div class="card-block">
                                        <div class="table-responsive dt-responsive">
                                            <div id="dom-jqry_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-12 col-sm-12 col-md-6">
                                                        <form method="get">
                                                            <div class="dataTables_length" id="dom-jqry_length"><label>
                                                                    <select name="show_more"
                                                                            aria-controls="dom-jqry"
                                                                            class="form-control input-sm"
                                                                            style="margin-left:10px">
                                                                        <option value="20">20</option>
                                                                        <option value="50">50</option>
                                                                        <option value="100">100</option>
                                                                    </select></label>
                                                                <button class="btn btn-success btn-sm">Hiển thị danh
                                                                    sách
                                                                </button>
                                                            </div>
                                                            <p style="margin-left: 10px;color:#868e96">Hiển
                                                                thị {{ $songs->firstItem() }} - {{ $songs->lastItem() }}
                                                                của {{ $songs->total() }} tổng số bài
                                                            </p>
                                                        </form>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                                        <form method="get">
                                                            <div id="dom-jqry_filter" class="dataTables_filter">
                                                                <label><input
                                                                            type="search" class="form-control input-sm"
                                                                            placeholder="Nhập tên bài hát ..." name="search"
                                                                            aria-controls="dom-jqry"></label>
                                                                <button type="submit" class="btn btn-success btn-sm">Tìm
                                                                    kiếm
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="card-block">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover m-b-0">
                                                            <thead>
                                                            <tr>
                                                                <th>ID</th>
                                                                <th>Tên bài hát</th>
                                                                <th>Thể loại</th>
                                                                <th>Ảnh nền</th>
                                                                <th>Người thể hiện</th>
                                                                <th>Ngày phát hành</th>
                                                                <th>Lượt xem</th>
                                                                <th>Lượt yêu thích</th>
                                                                <th>Trạng thái</th>
                                                                <th>Hành động</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach ($songs as $song)
                                                                <tr>
                                                                    <td>{{$song->id}}</td>
                                                                    <td>{{$song->name}}</td>
                                                                    @if ($song->genres !== null)
                                                                        <td>
                                                                            <a href="{{$song->genres->id}}">{{$song->genres->name}}</a>
                                                                        </td>
                                                                    @endif
                                                                    <td><img src="{{url($song->cover_image)}}"
                                                                             width="50px"></td>
                                                                    <td>
                                                                        @for($i = 0; $i < count($song->artists); $i++)
                                                                            {!! $song->artists[$i]->nick_name  . "<br>"!!}
                                                                        @endfor
                                                                    </td>
                                                                    <td>{{$song->created_at}}</td>
                                                                    <td>{{$song->view}}</td>
                                                                    <td></td>
                                                                    <td>
                                                                        @if ($song->status == 1)
                                                                            <label
                                                                                    class="label label-success">Đang hoạt
                                                                                động</label>
                                                                        @endif
                                                                        @if ($song->status == 0)
                                                                            <label class="label label-danger">Ngừng hoạt
                                                                                động</label>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <a href="{{route('songs.update', ['song_id' => $song->id])}}"><i
                                                                                    class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i></a><a
                                                                                href="{{route('songs.delete', ['song_id' => $song->id])}}"
                                                                                onclick="return confirm('Are you sure you want to delete this item?');"><i
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
                                        <ul class="pagination">
                                            {{ $songs->links() }}
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
