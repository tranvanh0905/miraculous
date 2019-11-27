@extends('layouts.admin.main')

@section('title')
    Cập nhật danh sách phát
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
                                        <h5>Cập nhật danh sách phát</h5>
                                    </div>
                                    <div class="card-block">
                                        <form enctype="multipart/form-data" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label class="col-form-label">Tên danh sách phát : </label>
                                                <input type="text" value="{{$playlist->name}}" name="name" class="form-control">
                                                @if($errors->first('name'))
                                                    <span class="text-danger">{{$errors->first('name')}}</span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <select class="js-example-basic-multiple form-control"
                                                        name="song_playlist[]" multiple="multiple">
                                                    @if ($song !== null)
                                                        @foreach ($song as $list)
                                                            <option
                                                                value="{{$list->id}}">{{$list->name}}</option>
                                                        @endforeach
                                                    @endif

                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-form-label">Mô tả chi tiết : </label>
                                                <textarea type="text" name="description" rows="10"
                                                          class="form-control">{{$playlist->description}} </textarea>
                                                @if($errors->first('description'))
                                                    <span class="text-danger">{{$errors->first('description')}}</span>
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
                                        <h5>Thêm danh sách phát</h5>
                                    </div>
                                    <div class="card-block">
                                        <div class="form-group">
                                            <label class="col-form-label">Ảnh hiển thị: </label>
                                            <input name="cover_image"  id="fileInput" type="file" class="form-control">
                                            @if($errors->first('cover_image'))
                                                <span class="text-danger">{{$errors->first('cover_image')}}</span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Trạng thái</label>
                                            <select name="status" class="form-control">
                                                <option value="">Lựa chọn trạng thái</option>
                                                <option value="1">Hoạt động</option>
                                                <option value="-1">Không hoạt động</option>
                                            </select>
                                            @if($errors->first('status'))
                                                <span class="text-danger">{{$errors->first('status')}}</span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <img id="imgPreview" src="{{url($playlist->cover_image)}}" width="100%" alt="">
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
    </script>
@endsection
