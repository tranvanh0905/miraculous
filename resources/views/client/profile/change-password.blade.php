@extends('layouts.client.main-account')

@section('title')
    Đổi mật khẩu
@endsection

@section('content')
    <h2>Đổi mật khẩu</h2>
    <hr>
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('status') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <form action="{{route('user-change-password')}}" method="post">
        @csrf
        <div class="form-group">
            <label for="current_password">Mật khẩu hiện tại</label>
            <input type="password" name="current_password"
                   class="form-control @if($errors->first('current_password')) is-invalid @endif" id="current_password"
                   value="{{old('current_password')}}">
            @if($errors->first('current_password'))
                <span class="text-danger">
                    {{$errors->first('current_password')}}
                </span>
            @endif
        </div>
        <div class="form-group">
            <label for="new_password">Mật khẩu mới</label>
            <input type="password" name="new_password"
                   class="form-control @if($errors->first('new_password')) is-invalid @endif" id="new_password"
                   value="{{old('new_password')}}">
            @if($errors->first('new_password'))
                <span class="text-danger">
                    {{$errors->first('new_password')}}
                </span>
            @endif
        </div>
        <div class="form-group">
            <label for="re_new_password">Nhập lại mật khẩu mới</label>
            <input type="password" name="re_new_password"
                   id="re_new_password " class="form-control @if($errors->first('re_new_password')) is-invalid @endif"
                   value="{{old('re_new_password')}}">
            @if($errors->first('re_new_password'))
                <span class="text-danger">
                    {{$errors->first('re_new_password')}}
                </span>
            @endif
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-lg">Đổi mật khẩu</button>
        </div>
    </form>
@endsection
