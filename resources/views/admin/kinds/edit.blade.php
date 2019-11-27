@extends('layouts.admin.main')

@section('title')
    Thêm bài hát
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
                                        <h5>Thêm thể loại mới</h5>
                                    </div>
                                    <div class="card-block">
                                        <form method="post"
                                              enctype="multipart/form-data" novalidate>
                                            @csrf
                                            <div class="form-group">
                                                <label class="col-form-label">Tên thể loại : </label>
                                                <input type="text" value="{{$genres->name}}" name="name"
                                                       class="form-control">
                                                @if($errors->first('name'))
                                                    <span class="text-danger">{{$errors->first('name')}}</span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label class="col-form-label">Mô tả : </label>
                                                <textarea rows="10" cols="5" name="description" class="form-control"
                                                          placeholder="Viết mô tả tại đây ...">{{$genres->description}}</textarea>
                                                @if($errors->first('description'))
                                                    <span
                                                        class="text-danger">{{$errors->first('description')}}</span>
                                                @endif
                                            </div>
                                            <button type="submit"
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
                                        <h5>Thêm thể loại mới</h5>
                                    </div>
                                    <div class="card-block">
                                            <div class="form-group">
                                                <label class="col-form-label">Trạng thái : </label>
                                                <select name="status" class="form-control">
                                                    <option value="">Lựa chọn trạng thái</option>
                                                    <option @if ($genres->status == 0) {{"selected"}} @endif value="0">
                                                        Không hoạt động
                                                    </option>
                                                    <option @if ($genres->status == 1) {{"selected"}} @endif value="1">
                                                        Hoạt động
                                                    </option>
                                                </select>
                                                @if($errors->first('status'))
                                                    <span class="text-danger">{{$errors->first('status')}}</span>
                                                @endif
                                            </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Ảnh đại diện : </label>
                                            <input type="file" name="image"  id="fileInput" class="form-control">
                                            @if($errors->first('image'))
                                                <span class="text-danger">{{$errors->first('image')}}</span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <img id="imgPreview" src="{{url($genres->image)}}" width="100%" alt="">
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
