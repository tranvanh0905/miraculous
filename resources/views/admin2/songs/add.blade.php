@extends('layouts.admin2.main')

@section('title')
    Thêm bài hát mới
@endsection

@section('content')

    <div class="col-md-8">
        <!-- general form elements disabled -->
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Thông tin bài hát</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="col-form-label">Tên bài hát : </label>
                        <input name="name" value="{{old('name')}}" type="text"
                               class="form-control">
                        @if($errors->first('name'))
                            <span class="text-danger">{{$errors->first('name')}}</span>
                        @endif
                        <div class="form-group">
                            <label class="col-form-label">Người thể hiện : </label>
                            <select class="js-example-basic-multiple form-control"
                                    name="person_song[]" multiple="multiple">
                                @foreach ($artists as $artist)
                                    <option
                                            value="{{$artist->id}}">{{$artist->nick_name}}</option>
                                @endforeach
                            </select>
                            @if($errors->first('person_song'))
                                <span
                                        class="text-danger">{{$errors->first('person_song')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Ngày phát hành : </label>
                            <input value="{{old('release_date')}}" name="release_date"
                                   type="date"
                                   class="form-control">
                            @if($errors->first('release_date'))
                                <span
                                        class="text-danger">{{$errors->first('release_date')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Giới thiệu bài hát : </label>
                            <textarea name="description" rows="5" cols="5" class="form-control"
                                      placeholder="Viết lời bài hát tại đây ...">{{old('description')}}</textarea>
                            @if($errors->first('description'))
                                <span
                                        class="text-danger">{{$errors->first('description')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Lời bài hát : </label>
                            <textarea name="lyric" rows="10" cols="5" class="form-control"
                                      placeholder="Viết lời bài hát tại đây ...">{{old('lyric')}}</textarea>
                            @if($errors->first('lyric'))
                                <span class="text-danger">{{$errors->first('lyric')}}</span>
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
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <div class="col-md-4">
        <!-- general form elements disabled -->
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Ảnh và tệp âm thanh</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputFile">Tệp tin âm thanh</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input id="mp3Input" type="file" name="mp3_url" class="custom-file-input">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                        </div>
                        @if($errors->first('mp3_url'))
                            <span class="text-danger">{{$errors->first('mp3_url')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <audio id="previewMp3" class="form-control" controls></audio>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Thể loại : </label>
                        <select name="genres_id" class="form-control">
                            <option value="">Lựa chọn thể loại</option>
                            @foreach ($genres as $list)
                                <option value="{{$list->id}}">{{$list->name}}</option>
                            @endforeach
                        </select>
                        @if($errors->first('genres_id'))
                            <span class="text-danger">{{$errors->first('genres_id')}}</span>
                        @endif
                    </div>
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
                        <label for="exampleInputFile">Ảnh bìa bài hát</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input id="fileInput" type="file" name="cover_image" class="custom-file-input">
                                <label class="custom-file-label" for="exampleInputFile">Chọn tập tin</label>
                            </div>
                        </div>
                        @if($errors->first('cover_image'))
                            <span class="text-danger">{{$errors->first('cover_image')}}</span>
                        @endif
                        <div class="mt-3 text-center w-100">
                            <img id="imgPreview" alt="" class="img-thumbnail">
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    </form>
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

        $("#mp3Input").on('change', function (e) {
            var sound = document.getElementById('previewMp3');
            sound.src = URL.createObjectURL(this.files[0]);
            // not really needed in this exact case, but since it is really important in other cases,
            // don't forget to revoke the blobURI when you don't need it
            sound.onend = function (e) {
                URL.revokeObjectURL(this.src);
            }
        });

        $(document).ready(function () {
            bsCustomFileInput.init();
        });
    </script>
@endsection