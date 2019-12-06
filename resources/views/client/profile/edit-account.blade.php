@extends('layouts.client.main-account')

@section('title')
    Sửa hồ sơ
@endsection

@section('content')
    <h2>Sửa hồ sơ</h2>
    <hr>
    <div id="errors-account">
    </div>
    <form action="{{route('user-edit-profile')}}" method="post" enctype="multipart/form-data" id="edit-account-form">
        @csrf

        <div class="form-group">
            <label for="username">Tên tài khoản</label>
            <input type="text" name="username"
                   class="form-control text-dark" id="username"
                   value="{{ Auth::user()->username}}">
        </div>

        <div class="form-group">
            <label for="full_name">Họ và tên</label>
            <input type="text" name="full_name"
                   class="form-control text-dark" id="full_name"
                   value="{{ Auth::user()->full_name}}">
        </div>

        @if(\Illuminate\Support\Facades\Auth::user()->birthday == null)
            <div class="form-group">
                <label for="birthday">Ngày sinh</label>
                <input type="date" name="birthday"
                       class="form-control text-dark" id="birthday"
                       value="{{Auth::user()->birthday}}">
            </div>
        @else
            <input type="hidden" name="birthday"
                   class="form-control text-dark" id="birthday"
                   value="{{Auth::user()->birthday}}">
        @endif

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
                <input type="file" id="avatar" name="avatar"/>

                <label for="avatar" class="btn btn-info">
                    <span class="mdi mdi-upload"></span>Chọn ảnh đại diện
                </label>
                <button type="button" class="btn btn-danger tower-file-clear" title="Clear Selected Files">
                    <span class="mdi mdi-cancel pr-1"></span>Xóa file đã chọn
                </button>
            </div>
        </div>

        <div class="form-group">
            <div class="btn btn-primary btn-lg" id="edit-account">Lưu hồ sơ</div>
        </div>
    </form>
    <script>
        $('#avatar').fileInput({
            iconClass: 'mdi mdi-fw mdi-upload'
        });
    </script>
@endsection
