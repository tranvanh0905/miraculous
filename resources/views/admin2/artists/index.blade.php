@extends('layouts.admin2.main')

@section('title')
    Danh sách ca sĩ
@endsection

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <a href="{{route('artists.add')}}" class="btn btn-primary mr-auto"> <i class="nav-icon fas fa-plus"></i>
                    Thêm ca sĩ</a>
                <form action="">
                    <div class="card-tools ml-auto">
                        <div class="input-group input-group-sm">
                            <select name="status" id="status" class="form-control mr-3">
                                <option value="">--Chọn trạng thái--</option>
                                <option value="1">Hiển thị</option>
                                <option value="0">Ẩn</option>
                            </select>
                            <input type="text" name="searchs" class="form-control float-right" placeholder="Tìm kiếm">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="song_table" class="table table-bordered table-striped dataTable hover">
                                <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Nghệ danh</th>
                                    <th class="text-center">Ảnh đại diện</th>
                                    <th class="text-center">Tên đầy đủ</th>
                                    <th class="text-center">Lượt theo dõi</th>
                                    <th class="text-center">Số lượng bài hát</th>
                                    <th class="text-center">Trạng thái</th>
                                    <th class="text-center">Hành động</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
@endsection

@section('custom-js')
    <script>
        $(function () {
            let getUrlParameter = function getUrlParameter(sParam) {
                let sPageURL = window.location.search.substring(1),
                    sURLVariables = sPageURL.split('&'),
                    sParameterName,
                    i;

                for (i = 0; i < sURLVariables.length; i++) {
                    sParameterName = sURLVariables[i].split('=');

                    if (sParameterName[0] === sParam) {
                        return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
                    }
                }
            };

            let table = $('#song_table').DataTable({
                "ordering": true,
                "searching": false,
                "language": {
                    "lengthMenu": "_MENU_ ",
                    "zeroRecords": "Không có dữ liệu để hiển thị",
                    "info": "Trang _PAGE_/_PAGES_",
                    // "infoEmpty": "No records available",
                    "infoEmpty": "Không có dữ liệu để hiển thị",
                    // "infoFiltered": "(filtered from _MAX_ total records)",
                    "infoFiltered": "(_MAX_/tổng số)",
                    "search": false,
                    "paginate": {
                        "first": "Trang đầu",
                        "last": "Trang cuối",
                        "next": "Trang sau",
                        "previous": "Trang trước"
                    },
                },
                serverSide: true,
                processing: true,
                responsive: true,
                stateSave: true,
                ajax: {
                    url: "{{ route('artists.getData') }}",
                    "data": {
                        "searchs": getUrlParameter('searchs'),
                        "status": getUrlParameter('status')
                    }
                },
                contentType: "application/json",

                cache: false,
                async: false,
                lengthMenu: [20, 30, 50, 100],
                iDisplayLength: 20,
                columnDefs: [
                    {
                        "targets": [0],
                        "searchable": true,
                        "orderable": true,
                        "width": "5%",
                        "class": "text-center"
                    },
                    {
                        "targets": [1],
                        "searchable": true,
                        "orderable": true,
                        'width': '25%',
                        "class": "text-center"

                    },
                    {
                        "targets": [2],
                        "searchable": false,
                        "orderable": false,
                        "class": "text-center",
                        'width': '20%',
                    },
                    {
                        "targets": [3],
                        "searchable": true,
                        "orderable": false,
                        'width': '25%',
                        "class": "text-center"

                    },
                    {
                        "targets": [4],
                        "searchable": false,
                        "orderable": false,
                        "width": "10%",
                        "class": "text-center"
                    },
                    {
                        "targets": [5],
                        "searchable": false,
                        "orderable": false, "width": "8%",
                        "class": "text-center"
                    }, {
                        "targets": [6],
                        "searchable": false,
                        "orderable": false, "width": "8%",
                        "class": "text-center"
                    },
                ],
                columns: [
                    {
                        data: 'id',
                    },
                    {
                        data: 'nick_name',
                    },
                    {
                        data: 'avatar',
                        render: function (data) {
                            return "<img src='../" + data + "' width='50px' >";
                        }
                    },
                    {
                        data: 'full_name',
                    },
                    {
                        data: 'follow',
                    },
                    {
                        data: "songs",
                        render: function (data, type, row) {
                            if (data !== null) {
                                return data.length;
                            } else {
                                return "0";
                            }
                        }
                    },
                    {
                        data: 'status',
                        render: function (data, type, row) {
                            let str = '';
                            if (data === 1) {
                                return `<span class="badge bg-success">Hiển thị</span>`;
                            } else {
                                return `<span class="badge bg-danger">Ẩn</span>`;
                            }
                        },
                    },
                    {
                        data: 'id',
                        title: "Hành động",
                        autoWidth: true,
                        render: function (data, type, row) {
                            let html = `<a href="artists/update/${data}" data-edit="' + data + '" class="mr-3"><i class="nav-icon fas
                            fa-edit"></i></a><a
                            href="javascript:;" data-remove="${data}" class="btn-remove text-danger"><i class="fas fa-trash-alt"></i></a>`;
                            return html;
                        },
                    }

                ],

                initComplete: function () {
                    $('body').on('click', '.btn-remove', function () {
                        let id = $(this).data('remove');
                        Swal.fire({
                            title: 'Bạn có chắc chắn muốn xóa ca sĩ này',
                            text: "Bạn sẽ không lấy lại được dữ liệu đã xóa!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Có, xóa ca sĩ!'
                        }).then((result) => {
                            if (result.value) {
                                $.ajax({
                                    url: "artist/delete/" + id,
                                    method: 'GET',
                                }).done((result) => {
                                    if (result) {
                                        Swal.fire(
                                            'Xóa ca sĩ!',
                                            'Ca sĩ đã bị xóa',
                                            'success'
                                        )
                                    }
                                    setTimeout(function () {
                                        table.ajax.reload();
                                    }, 500);
                                })
                            }
                        })
                    })
                }
            })


        })
    </script>
    @if (session('status'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });

            Toast.fire({
                type: 'success',
                title: '{{ session('status') }}'
            })
        </script>
    @endif
@endsection
