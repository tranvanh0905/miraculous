@extends('layouts.admin2.main')

@section('title')
    Chỉnh sửa bài hát {{$song->name}}
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
                        <input name="name" value="{{$song->name}}" type="text"
                               class="form-control">
                        @if($errors->first('name'))
                            <span class="text-danger">{{$errors->first('name')}}</span>
                        @endif
                        <div class="form-group">
                            <label class="col-form-label">Người thể hiện : </label>
                            <select class="js-example-basic-multiple form-control"
                                    name="person_song[]" multiple="multiple">
                                @foreach ($artist_song_detail as $list)
                                    <option selected
                                            value="{{$list->artist_id}}">{{$list->artist->nick_name}}</option>
                                @endforeach
                                @foreach ($artists as $artist)
                                    <option value="{{$artist->id}}">{{$artist->nick_name}}</option>
                                @endforeach
                            </select>
                            @if($errors->first('person_song'))
                                <span
                                        class="text-danger">{{$errors->first('person_song')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Ngày phát hành : </label>
                            <input value="{{$song->release_date}}" name="release_date"
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
                                      placeholder="Viết lời bài hát tại đây ...">{{$song->description}}</textarea>
                            @if($errors->first('description'))
                                <span
                                        class="text-danger">{{$errors->first('description')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Lời bài hát : </label>
                            <textarea name="lyric" rows="10" cols="5" class="form-control"
                                      placeholder="Viết lời bài hát tại đây ...">{{$song->lyric}}</textarea>
                            @if($errors->first('lyric'))
                                <span class="text-danger">{{$errors->first('lyric')}}</span>
                            @endif
                        </div>
                        <button type="submit"
                                class="btn btn-success m-t-20 waves-effect waves-light js-programmatic-enable ">
                            Xác nhận
                        </button>
                        <a href="{{route('songs.home')}}"
                           class="btn btn-danger m-t-20 m-l-10 waves-effect waves-light js-programmatic-disable">
                            Quay lại
                        </a>
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
                    <audio src="{{url($song->mp3_url)}}" id="previewMp3" class="form-control" controls></audio>
                </div>
                <div class="form-group">
                    <label class="col-form-label">Thể loại : </label>
                    <select name="genres_id" class="form-control">
                        <option value="">Lựa chọn thể loại</option>
                        @foreach ($genres as $list)
                            <option @if ($list->id == $song->genres_id) {{'selected'}} @endif value="{{$list->id}}">{{$list->name}}</option>
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
                        <option @if($song->status == 0) {{'selected'}} @endif value="0">Ngừng hoạt động</option>
                        <option @if($song->status == 1) {{'selected'}} @endif value="1">Đang hoạt động</option>
                    </select>
                    @if($errors->first('status'))
                        <span class="text-danger">{{$errors->first('status')}}</span>
                    @endif
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-9">
                            <label for="exampleInputFile">Ảnh bìa bài hát</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input id="mp3Input" type="file" name="cover_image" class="custom-file-input">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                                @if($errors->first('cover_image'))
                                    <span class="text-danger">{{$errors->first('cover_image')}}</span>
                                @endif
                            </div>
                            @if($errors->first('mp3_url'))
                                <span class="text-danger">{{$errors->first('mp3_url')}}</span>
                            @endif
                        </div>
                        <div class="col-3">
                            <img src="{{url($song->cover_image)}}" id="imgPreview" width="100px" height="auto">
                        </div>
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
        })
        $(document).ready(function () {
            bsCustomFileInput.init();
        });
    </script>
@endsection