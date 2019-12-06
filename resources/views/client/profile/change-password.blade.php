@extends('layouts.client.main-account')

@section('title')
    Đổi mật khẩu
@endsection

@section('content')
    <h2>Đổi mật khẩu</h2>
    <hr>
    <div id="errors-password">
    </div>
    <form action="{{route('user-change-password')}}" method="post">
        @csrf
        <div class="form-group">
            <label for="current_password">Mật khẩu hiện tại</label>
            <input type="password" name="current_password" class="form-control" id="current_password">
        </div>
        <div class="form-group">
            <label for="new_password">Mật khẩu mới</label>
            <input type="password" name="new_password" class="form-control" id="new_password">
        </div>
        <div class="form-group">
            <label for="re_new_password">Nhập lại mật khẩu mới</label>
            <input type="password" name="re_new_password" id="re_new_password" class="form-control">
        </div>
        <div class="form-group">
            <div class="btn btn-primary btn-lg" id="edit-password">Đổi mật khẩu</div>
        </div>
    </form>
@endsection
