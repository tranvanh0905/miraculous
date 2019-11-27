@extends('layouts.client.main-account')

@section('title')
    Sửa hồ sơ
@endsection

@section('content')
    <h2>Sửa hồ sơ</h2>
    <hr>
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('status') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <form action="{{route('user-edit-profile')}}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="username">Tên tài khoản</label>
            <input type="text" name="username"
                   class="form-control text-dark @if($errors->first('username')) is-invalid @endif" id="username"
                   value="{{old('username', Auth::user()->username)}}">
            @if($errors->first('username'))
                <span class="text-danger">
                    {{$errors->first('username')}}
                </span>
            @endif
        </div>

        <div class="form-group">
            <label for="full_name">Họ và tên</label>
            <input type="text" name="full_name"
                   class="form-control text-dark @if($errors->first('full_name')) is-invalid @endif" id="full_name"
                   value="{{old('full_name', Auth::user()->full_name)}}">
            @if($errors->first('full_name'))
                <span class="text-danger">
                    {{$errors->first('full_name')}}
                </span>
            @endif
        </div>

        <div class="form-group">
            <label for="birthday">Ngày sinh</label>
            <input type="date" name="birthday"
                   class="form-control text-dark @if($errors->first('birthday')) is-invalid @endif" id="birthday"
                   value="{{old('birthday', Auth::user()->birthday)}}">
            @if($errors->first('birthday'))
                <span class="text-danger">
                    {{$errors->first('birthday')}}
                </span>
            @endif
        </div>

        <div class="form-group">
            <label for="gender">Giới tính</label>
            <select name="gender" id="gender" class="form-control text-dark">
                <option value="0" @if(Auth::user()->gender == 0) selected @endif>Nam</option>
                <option value="1" @if(Auth::user()->gender == 1) selected @endif>Nữ</option>
            </select>
        </div>

        <div class="form-group">
            <label for="avatar">Tải lên ảnh đại diện</label>
            <div class="tower-file mb-2">
                <input type="file" id="avatar" name="avatar" />

                <label for="avatar" class="btn btn-info">
                    <span class="mdi mdi-upload"></span>Chọn ảnh đại diện
                </label>
                <button type="button" class="btn btn-danger tower-file-clear" title="Clear Selected Files">
                    <span class="mdi mdi-cancel pr-1"></span>Xóa file đã chọn
                </button>
            </div>
            @if($errors->first('avatar'))
                <span class="text-danger">
                    {{$errors->first('avatar')}}
                </span>
            @endif
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-lg">Lưu hồ sơ</button>
        </div>
    </form>
    <script>
        $('#avatar').fileInput({
            iconClass: 'mdi mdi-fw mdi-upload'
        });
    </script>
@endsection
