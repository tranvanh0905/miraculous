@extends('layouts.client.main-account-library')

@section('title')
    Thư viện - Chỉnh sửa danh sách phát cá nhân
@endsection

@section('content')
    <section>
        <div class="pt-3"></div>
        <div class="d-flex">
            <div class="title-box">
                <h2 class="title h3-md">Chỉnh sử danh sách phát - {{$userPlaylist->name}}</h2>
            </div>
        </div>

        <div class="box-add-playlist">
            <div class="row">
                <div class="col-lg-12">
                    <form action="{{route('user-library-personal-playlist-edit', ['playlistId' => $userPlaylist->id])}}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Tên danh sách phát</label>
                            <input type="text" name="name"
                                   class="form-control text-dark @if($errors->first('name')) is-invalid @endif" id="name"
                                   value="{{old('name', $userPlaylist->name)}}">
                            @if($errors->first('name'))
                                <span class="text-danger">
                                    {{$errors->first('name')}}
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="description">Mô tả danh sách phát</label>
                            <textarea name="description" id="description" cols="30" rows="10" class="form-control @if($errors->first
                            ('description')) is-invalid @endif">{{old('description', $userPlaylist->description)
                            }}</textarea>
                            @if($errors->first('description'))
                                <span class="text-danger">
                                    {{$errors->first('description')}}
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="avatar">Ảnh danh sách phát</label>
                            <div class="tower-file mb-2">
                                <input type="file" id="cover_image" name="cover_image"/>

                                <label for="cover_image" class="btn btn-info">
                                    <span class="mdi mdi-upload"></span>Chọn ảnh
                                </label>
                                <button type="button" class="btn btn-danger tower-file-clear" title="Clear Selected Files">
                                    <span class="mdi mdi-cancel pr-1"></span>Xóa ảnh đã chọn
                                </button>
                            </div>
                            @if($errors->first('cover_image'))
                                <span class="text-danger">
                                {{$errors->first('cover_image')}}
                            </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg">Sửa danh sách phát</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script>
        $('#cover_image').fileInput({
            iconClass: 'mdi mdi-fw mdi-upload'
        });
    </script>
@endsection
