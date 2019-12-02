@extends('layouts.admin2.main')

@section('title')

@endsection

@section('content')

    <div class="col-md-12">
        <!-- general form elements disabled -->
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Slider</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    @csrf
                    <table class="table table-bordered">
                        <tr>
                            <th>ID</th>
                            <th>Đường dẫn</th>
                            <th>Ảnh</th>
                        </tr>
                        <tbody class="row_position">
                        @if ($sliders !== null)
                            @foreach ($sliders as $slider)
                        <tr  id="{{$slider->id}}" data-sort="{{$slider->sort}}">
                            <td>{{$slider->id}}</td>
                            <td>{{$slider->url}}</td>
                            <td><img src="{{url($slider->image)}}" width="100%" alt=""></td>
                        </tr>
                        @endforeach
                            @endif
                        </tbody>
                    </table>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection
<?php
$url = url('admin');
?>
@section('custom-js')
    <script>
        $(".row_position").sortable({
            delay: 150,
            stop: function () {
                var selectedData = new Array();
                var selectedSort = new Array();
                $('.row_position>tr').each(function () {
                    selectedData.push($(this).attr("id"));
                    selectedSort.push($(this).attr("data-sort"));
                });
                updateOrder(selectedData, selectedSort);
            }
        });
        function updateOrder(data, sort) {
            $.ajax({
                url:'{{url()->current()}}',
                type:'post',
                data:{
                    "_token": "{{ csrf_token() }}",
                    data,
                    sort
                },
                success:function(){
                    alert('your change successfully saved');
                }
            })
        }
    </script>
@endsection
