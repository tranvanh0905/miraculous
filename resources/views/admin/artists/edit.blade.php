@extends('layouts.admin.main')

@section('title')
    Thêm ca sĩ mới
@endsection

@section('content')
    <div class="pcoded-content">
        <div class="pcoded-inner-content">
            <div class="main-body">
                <div class="page-wrapper">
                    <div class="page-body">
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Thêm ca sĩ mới</h5>
                                    </div>
                                    <div class="card-block">
                                        <form enctype="multipart/form-data" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label class="col-form-label">Nghệ danh : </label>
                                                <input value="{{$model->nick_name}}" name="nick_name" type="text"
                                                       class="form-control">
                                                @if($errors->first('nick_name'))
                                                    <span class="text-danger">{{$errors->first('nick_name')}}</span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label class="col-form-label">Họ và tên đầy đủ : </label>
                                                <input value="{{$model->full_name}}" name="full_name" type="text"
                                                       class="form-control">
                                                @if($errors->first('full_name'))
                                                    <span class="text-danger">{{$errors->first('full_name')}}</span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label class=" col-form-label">Ngày sinh : </label>
                                                <input type="date" value="{{$model->birthday}}" name="birthday"
                                                       class="form-control">
                                                @if($errors->first('birthday'))
                                                    <span class="text-danger">{{$errors->first('birthday')}}</span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label class=" col-form-label">Giới thiệu : </label>
                                                <textarea row="10" cols="5" name="about" class="form-control"
                                                          placeholder="">{{$model->about}}</textarea>
                                                @if($errors->first('about'))
                                                    <span class="text-danger">{{$errors->first('about')}}</span>
                                                @endif
                                            </div>

                                            <button
                                                class="btn btn-success m-t-20 waves-effect waves-light js-programmatic-enable ">
                                                Xác nhận
                                            </button>
                                            <button
                                                class="btn btn-danger m-t-20 m-l-10 waves-effect waves-light js-programmatic-disable">
                                                Quay lại
                                            </button>

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Thêm ca sĩ mới</h5>
                                    </div>
                                    <div class="card-block">
                                        <div class="form-group">
                                            <label class=" col-form-label">Ảnh đại diện : </label>
                                            <input type="file" name="avatar" class="form-control">
                                            @if($errors->first('avatar'))
                                                <span class="text-danger">{{$errors->first('avatar')}}</span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <img src="{{url($model->avatar)}}" style="width:100%" alt="">
                                        </div>
                                        <div class="form-group">
                                            <label class=" col-form-label">Ảnh bìa : </label>
                                            <input type="file" name="cover_image" class="form-control">
                                            @if($errors->first('cover_image'))
                                                <span class="text-danger">{{$errors->first('cover_image')}}</span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <img src="{{url($model->cover_image)}}" style="width:100%;" alt="">
                                        </div>
                                        <div class="form-group">
                                            <label class=" col-form-label">Trạng thái : </label>
                                            <select name="status" class="form-control">
                                                <option value="">Lựa chọn trạng thái</option>
                                                <option @if ($model->status == 1) {{'selected'}} @endif  value="1">Hoạt
                                                    động
                                                </option>
                                                <option @if ($model->status == 0) {{'selected'}} @endif value="0">Không
                                                    hoạt động
                                                </option>
                                            </select>
                                            @if($errors->first('status'))
                                                <span class="text-danger">{{$errors->first('status')}}</span>
                                            @endif
                                        </div>
                                        </form>
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
