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
                            <div class="col-xl-12 col-md-6">
                                <div class="card table-card">
                                    <div class="card-header">
                                        <h5>Quản lý bình luận</h5>
                                        <div class="card-header-right">
                                        </div>
                                    </div>
                                    <div class="card-block">
                                        <div class="table-responsive">
                                            <table class="table table-hover m-b-0">
                                                <thead>
                                                <tr>
                                                    <th>Số thứ tự</th>
                                                    <th>Người bình luận</th>
                                                    <th>Nội dung bình luận</th>
                                                    <th>Trạng thái</th>
                                                    <th>Ngày bình luận</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>01</td>
                                                    <td>Người 01</td>
                                                    <td>Nội dung 01</td>
                                                    <td><label class="label label-success">Đang kích hoạt</label></td>
                                                    <td>22/10/2019</td>
                                                    <td>
                                                        <a href="#!"><i class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>01</td>
                                                    <td>Người 01</td>
                                                    <td>Nội dung 01</td>
                                                    <td><label class="label label-success">Đang kích hoạt</label></td>
                                                    <td>22/10/2019</td>
                                                    <td>
                                                        <a href="#!"><i class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>01</td>
                                                    <td>Người 01</td>
                                                    <td>Nội dung 01</td>
                                                    <td><label class="label label-success">Đang kích hoạt</label></td>
                                                    <td>22/10/2019</td>
                                                    <td>
                                                        <a href="#!"><i class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>01</td>
                                                    <td>Người 01</td>
                                                    <td>Nội dung 01</td>
                                                    <td><label class="label label-success">Đang kích hoạt</label></td>
                                                    <td>22/10/2019</td>
                                                    <td>
                                                        <a href="#!"><i class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>01</td>
                                                    <td>Người 01</td>
                                                    <td>Nội dung 01</td>
                                                    <td><label class="label label-success">Đang kích hoạt</label></td>
                                                    <td>22/10/2019</td>
                                                    <td>
                                                        <a href="#!"><i class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i></a>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="dataTables_paginate paging_simple_numbers" id="simpletable_paginate">
                            <ul class="pagination">
                                <li class="paginate_button page-item previous disabled" id="simpletable_previous">
                                    <a href="#" aria-controls="simpletable" data-dt-idx="0" tabindex="0" class="page-link">Quay lại</a>
                                </li>
                                <li class="paginate_button page-item active">
                                    <a href="#" aria-controls="simpletable" data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                                <li class="paginate_button page-item ">
                                    <a href="#" aria-controls="simpletable" data-dt-idx="2" tabindex="0" class="page-link">2</a></li>
                                <li class="paginate_button page-item next" id="simpletable_next">
                                    <a href="#" aria-controls="simpletable" data-dt-idx="3" tabindex="0" class="page-link">Tiếp theo</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
