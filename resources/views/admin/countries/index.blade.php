@extends('layouts.admin.main')

@section('title')
    Quản lý quốc gia
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-4">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Thêm quốc gia mới</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form role="form">

                        <div class="form-group">
                            <label>Tên quốc gia</label>
                            <input type="text" class="form-control" placeholder="Nhập tên quốc gia ...">
                        </div>

                        <div class="form-group">
                            <label>Mã quốc gia</label>
                            <input type="text" class="form-control" placeholder="Nhập mã quốc gia ...">
                        </div>

                    </form>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Thêm quốc gia</button>
                </div>
            </div>
        </div>
        <div class="col-xs-8">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Tất cả các quốc gia</h3>

                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">Tên quốc gia</th>
                            <th class="text-center">Mã quốc gia</th>
                            <th class="text-center">Số ca sĩ</th>
                        </tr>
                        <tr class="text-center">
                            <td>183</td>
                            <td>John Doe</td>
                            <td>10</td>
                            <td>2</td>
                        </tr>
                        <tr class="text-center">
                            <td>219</td>
                            <td>Alexander Pierce</td>
                            <td>10</td>
                            <td>2</td>
                        </tr>
                        <tr class="text-center">
                            <td>657</td>
                            <td>Bob Doe</td>
                            <td>10</td>
                            <td>2</td>
                        </tr>
                        <tr class="text-center">
                            <td>175</td>
                            <td>Mike Doe</td>
                            <td>10</td>
                            <td>2</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <ul class="pagination pagination-sm no-margin pull-right">
                        <li><a href="#">«</a></li>
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">»</a></li>
                    </ul>
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection
