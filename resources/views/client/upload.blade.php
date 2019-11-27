@extends('layouts.client.main')

@section('title')
    Tải lên
@endsection

@section('content')
    <div class="pt-4 pt-lg-5"></div>
    <div class="master-container-fluid">
        <section>
            <div class="title-box">
                <h4 class="title h3 text-uppercase">Tải nhạc lên</h4>
            </div>
            <div class="upload-box">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="upload-img">
                            <img src="client/images/single/single-1.jpg" alt="avatar-song" class="img-fluid">
                        </div>
                        <form action="">
                            <div class="form-group">
                                <label for="exampleFormControlFile1">Chọn ảnh bài hát</label>
                                <input type="file" class="form-control-file" id="exampleFormControlFile1">
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-9">
                        <form>
                            <div class="form-group">
                                <label for="exampleFormControlFile1">Chọn file nhạc tải lên</label>
                                <input type="file" class="form-control-file" id="exampleFormControlFile1">
                            </div>
                            <div class="form-group">
                                <label for="nameSong">Tên bài hát</label>
                                <input type="text" class="form-control" name="nameSong" id="nameSong"
                                       placeholder="Điền tên bài hát">
                            </div>
                            <div class="form-group">
                                <label for="genres">Thể loại</label>
                                <select class="form-control" id="genres" name="genres">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputAddress2">Lời bài hát</label>
                                <textarea type="text" class="form-control" id="lyric"
                                          placeholder="Nhập lời bài hát"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg">Tải lên</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
