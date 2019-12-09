@extends('layouts.admin2.main')

@section('title')
    Cập nhật tài khoản
@endsection

@section('content')

    <div class="col-md-8">
        <!-- general form elements disabled -->
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Thông tin tài khoản</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label class="col-form-label">Email: </label>
                        <input name="email" value="{{$model->email}}" type="text"
                               class="form-control">
                        @if($errors->first('email'))
                            <span class="text-danger">{{$errors->first('email')}}</span>
                        @endif
                        <div class="form-group">
                            <label class="col-form-label">Mật khẩu : </label>
                            <input name="password" type="password" class="form-control">
                            @if($errors->first('password'))
                                <span class="text-danger">{{$errors->first('password')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class=" col-form-label">Ngày sinh : </label>
                            <input type="date" name="birthday" value="{{$model->birthday}}" class="form-control">
                            @if($errors->first('birthday'))
                                <span class="text-danger">{{$errors->first('birthday')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Tên đầy đủ : </label>
                            <input name="full_name" type="text" value="{{$model->full_name}}" class="form-control">
                            @if($errors->first('full_name'))
                                <span class="text-danger">{{$errors->first('full_name')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Username : </label>
                            <input name="username" type="text" value="{{$model->username}}" class="form-control">
                            @if($errors->first('username'))
                                <span class="text-danger">{{$errors->first('username')}}</span>
                            @endif
                        </div>
                        <button
                            class="btn btn-success m-t-20 waves-effect waves-light js-programmatic-enable ">
                            Xác nhận
                        </button>
                        <a href="{{route('users.home')}}">
                            <button type="button"
                                    class="btn btn-danger m-t-20 m-l-10 waves-effect waves-light js-programmatic-disable">
                                Quay lại
                            </button>
                        </a>
                    </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <!-- general form elements disabled -->
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Thông tin tài khoản</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="form-group">
                    <label class="col-form-label">Trạng thái : </label>
                    <select name="status" class="form-control">
                        <option value="">Lựa chọn trạng thái</option>
                        <option value="0">Ngừng hoạt động</option>
                        <option value="1" selected>Đang hoạt động</option>
                    </select>
                    @if($errors->first('status'))
                        <span class="text-danger">{{$errors->first('status')}}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label class="col-form-label">Trạng thái : </label>
                    <select name="gender" class="form-control">
                        <option value="">Lựa chọn trạng thái</option>
                        <option @if ($model->gender == 0) {{"selected"}} @endif value="0">Nam</option>
                        <option @if ($model->gender == 1) {{"seleceted"}} @endif value="1" selected>Nữ</option>
                    </select>
                    @if($errors->first('gender'))
                        <span class="text-danger">{{$errors->first('gender')}}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label class="col-form-label">Phân quyền : </label>
                    <select name="role" class="form-control">
                        <option value="">Lựa chọn trạng thái</option>
                        <option @if ($model->role == 900) {{"selected"}} @endif value="900">Admin</option>
                        <option @if ($model->role == 600) {{"selected"}} @endif value="600">Cộng tác viên</option>
                        <option @if ($model->role == 100) {{"selected"}} @endif value="100">Thành viên</option>
                    </select>
                    @if($errors->first('role'))
                        <span class="text-danger">{{$errors->first('role')}}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Ảnh đại diện</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input id="fileInput" type="file" name="avatar" class="custom-file-input">
                            <label class="custom-file-label" for="exampleInputFile">Chọn ảnh đại diện</label>
                        </div>
                    </div>
                    @if($errors->first('avatar'))
                        <span class="text-danger">{{$errors->first('avatar')}}</span>
                    @endif
                </div>
                <div class="form-group">
                    <img id="imgPreview" src="{{url($model->avatar)}}" width="100%" alt="">
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('custom-js')
    <script>
        $(document).ready(function () {
            $('.js-example-basic-multiple').select2();
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#imgPreview').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#fileInput").change(function () {
            readURL(this);
        });

        $(document).ready(function () {
            bsCustomFileInput.init();
        });
    </script>
@endsection
