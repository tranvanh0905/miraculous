@extends('layouts.admin.main')

@section('title')
    Danh sách album
@endsection

@section('content')
    <div class="pcoded-content">
        <div class="pcoded-inner-content">
            <div class="main-body">
                <div class="page-wrapper">
                    <div class="page-body">
                        <div class="row">
                            <div class="col-xl-12 col-md-6">
                                <div class="card table-card">
                                    <div class="card-header">
                                        <h5>Danh sách album</h5>
                                        <a href="{{route('albums.add')}}">
                                            <button class="btn btn-primary">+ Thêm album</button>
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
                                                                thị {{ $albums->firstItem() }}
                                                                - {{ $albums->lastItem() }} của {{ $albums->total() }}
                                                                tổng số album
                                                            </p>
                                                        </form>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                                        <form method="get">
                                                            <div id="dom-jqry_filter" class="dataTables_filter">
                                                                <label><input
                                                                        type="search" class="form-control input-sm"
                                                                        placeholder="Nhập tên album ..."
                                                                        name="search"
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
                                                                <th>Tên Album</th>
                                                                <th>Người thể hiện</th>
                                                                <th>Ngày phát hành</th>
                                                                <th>Trạng thái</th>
                                                                <th>Hành động</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach ($albums as $album)
                                                                <tr>
                                                                    <td>{{$album->id}}</td>
                                                                    <td>{{$album->title}}</td>
                                                                    <td>{{$album->artist->nick_name}}</td>
                                                                    <td>{{$album->release_date}}</td>
                                                                    <td>
                                                                        @if ($album->status == 1)
                                                                            <label
                                                                                class="label label-success">Đang hoạt
                                                                                động</label>
                                                                        @endif
                                                                        @if ($album->status == 0)
                                                                            <label class="label label-danger">Ngừng hoạt
                                                                                động</label>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <a href="{{route('albums.update', ['id' => $album->id])}}"><i
                                                                                class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"
                                                                                ></i></a><a
                                                                            href="{{route('albums.delete', ['id' => $album->id])}}" onclick="return confirm('Are you sure you want to delete this item?');"><i
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
                                        {{ $albums->links() }}
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
