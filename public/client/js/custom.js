//Log out
$(document).on('click', '#logout', function () {
    $.ajax({
        type: 'get',
        url: 'logout',
        success: function () {
            location.reload();
        }
    });
});

//Go admin
$(document).on('click', '#go-admin', function () {
    location.href = "/admin";
});

//Search
$(document).on('keyup', '.search-input', function () {
    let value = $(this).val();
    $.ajax({
        type: 'get',
        url: '/search',
        data: {
            'search': value
        },
        success: function (data) {
            $('#searchsong').html(data.songs);
            $('#searchalbum').html(data.albums);
            $('#searchartist').html(data.artists);
        }
    });
});

//Follow artist
$(document).on('click', '.btn-follow', function () {
    let artistId = $(this).attr('data-artist-id');
    let divTarget = $(this);
    let likeIcon = $('.like-icon');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'POST',
        url: '/follow-artist',
        data: {
            'artist_id': artistId
        },
        success: function (data) {
            $('.count-follow[data-artist-id="' + artistId + '"]').html(data.follow);

            if (data.type === 'follow') {
                divTarget.html('<i class="fas fa-user-minus"></i> Bỏ quan tâm').fadeIn();
                $.notify({
                    icon: 'fas fa-user-plus',
                    message: data.msg
                }, {
                    delay: 100,
                    timer: 1000,
                    z_index: 1300
                });
            } else {
                divTarget.html('<i class="fas fa-user-plus"></i> Quan tâm').fadeIn();

                $.notify({
                    icon: 'fas fa-user-minus',
                    message: data.msg
                }, {
                    delay: 1000,
                    timer: 1000,
                    z_index: 1300
                });
            }
        }
    });
});

//Tải bài hát gợi ý cho trang chi tiết playlist cá nhân khi ấn nút reload
$(document).on('click', '#reload-suggest', function () {
    let playlistId = $(document).find('.album-wrap').attr('data-playlist-id');
    $.ajax({
        type: "GET",
        url: "user/library/user-playlist/single-playlist/" + playlistId + "/suggest-song",
        success: function (data) {
            let getdata = $(data);
            $('#suggest-song').fadeOut().html(getdata).fadeIn();
        }
    });
});

//Thêm bài hát vào playlist cá nhân ở trang chi tiết playlist cá nhân
$(document).on('click', '.add-to-playlist', function () {
    let songId = parseInt($(this).attr('data-song-id'));
    let playlistId = parseInt($(this).attr('data-playlist-id'));

    $(this).removeClass('fa-plus').addClass('fa-times');
    $(this).removeClass('add-to-playlist').addClass('remove-from-playlist');
    let selectItem = $('.item-2[data-song-id=' + songId + ']');
    let item = selectItem.prop('outerHTML');

    selectItem.fadeOut(100, function () {
        this.remove();
    });
    $('#main-song').fadeOut().append(item).fadeIn();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'POST',
        url: 'add-song-user-playlist/' + songId + '/' + playlistId,
        success: function (data) {
            $.notify({
                icon: 'fas fa-check-circle',
                message: data.msg
            }, {
                delay: 100,
                timer: 1000,
                z_index: 1300
            });
        }
    });
});

//Xóa bài hát khỏi playlist cá nhân
$(document).on('click', '.remove-from-playlist', function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let id = $(this).attr('data-song-id');
    let playlistId = $(this).attr('data-playlist-id');
    let itemTarget = $('.item[data-song-id="' + id + '"]');

    $.ajax({
        type: "POST",
        url: "user/library/user-playlist/single-playlist/" + playlistId + "/remove-song/" + id,
        data: {playlistId: playlistId, songId: id},
        success: function (data) {
            itemTarget.fadeOut(300, function () {
                itemTarget.remove();
            });


            $.notify({
                icon: 'fas fa-check-circle',
                message: data.msg
            }, {
                delay: 100,
                timer: 1000,
                z_index: 1300
            });
        }
    });
});

// Ấn like dislike ở player
$(document).on('click', '#playerLike', function (e) {
    let type = $(this).attr('data-type');
    let id = parseInt($(this).attr('data-id'));
    let likeGlobal = $('#likeGlobal[data-type="song"][data-id="' + id + '"]');

    if (type === 'song') {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: 'player/like/song',
            data: {
                songId: id
            },
            success: function (data) {
                if (data.action === 'liked') {
                    //Thêm nút likeglobal
                    likeGlobal.removeClass('far');
                    likeGlobal.addClass('fas');

                    $('#like').html('<span class="adonis-icon icon-2x" id="playerLike" data-type="song" data-id="' + id + '"><i class="fas' +
                        ' fa-heart' +
                        ' fa-2x' +
                        ' font-14"></i></span>');

                    $('#like2').html('<span class="adonis-icon icon-2x" id="playerLike" data-type="song" data-id="' + id + '"><i class="fas' +
                        ' fa-heart' +
                        ' fa-2x' +
                        ' font-14"></i></span>');

                    $('#like3').html('<span class="adonis-icon icon-2x" id="playerLike" data-type="song" data-id="' + id + '"><i class="fas' +
                        ' fa-heart' +
                        ' fa-2x' +
                        ' font-14"></i></span>');

                    $.notify({
                        icon: 'fas fa-check-circle',
                        message: "Yêu thích bài hát thành công !"
                    }, {
                        delay: 100,
                        timer: 1000,
                        z_index: 1300
                    });
                } else {
                    //Thêm nút dislike
                    likeGlobal.removeClass('fas');
                    likeGlobal.addClass('far');

                    $('#like').html('<span class="adonis-icon icon-2x" id="playerLike" data-type="song" data-id="' + id + '"><i class="far' +
                        ' fa-heart' +
                        ' fa-2x' +
                        ' font-14"></i></span>');

                    $('#like2').html('<span class="adonis-icon icon-2x" id="playerLike" data-type="song" data-id="' + id + '"><i class="far' +
                        ' fa-heart' +
                        ' fa-2x' +
                        ' font-14"></i></span>');

                    $('#like3').html('<span class="adonis-icon icon-2x" id="playerLike" data-type="song" data-id="' + id + '"><i class="far' +
                        ' fa-heart' +
                        ' fa-2x' +
                        ' font-14"></i></span>');

                    $.notify({
                        icon: 'fas fa-check-circle',
                        message: "Bỏ yêu thích bài hát !"
                    }, {
                        delay: 100,
                        timer: 1000,
                        z_index: 1300
                    });
                }
            }
        });
    }
});

// Ấn like dislike ở global
$(document).on('click', '#likeGlobal', function (e) {
    let type = $(this).attr('data-type');
    let id = parseInt($(this).attr('data-id'));
    let button = $(this);
    let countLikePlaylist = $('.count-like-playlist');
    let countLikeAlbum = $('.count-like-album');
    let playerLike = parseInt($('#playerLike[data-type="song"][data-id="' + id + '"]').attr('data-id'));
    let likeBox = $('#like');
    let likeBox2 = $('#like2');
    let likeBox3 = $('#like3');
    let likeSongId = $('#likeSong' + id);
    let likeIcon = $('.like-icon');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    if (type === 'song') {

        $.ajax({
            type: 'POST',
            url: 'player/like/song',
            data: {
                songId: id
            },
            success: function (data) {
                if (data.action === 'liked') {
                    button.removeClass('far');
                    button.addClass('fas');

                    likeIcon.removeClass('far');
                    likeIcon.addClass('fas');

                    if (id === playerLike) {
                        likeBox.html('<span class="adonis-icon icon-2x" id="playerLike" data-type="song" data-id="' + id + '"><i class="fas' +
                            ' fa-heart' +
                            ' fa-2x' +
                            ' font-14"></i></span>');

                        likeBox2.html('<span class="adonis-icon icon-2x" id="playerLike" data-type="song" data-id="' + id + '"><i class="fas' +
                            ' fa-heart' +
                            ' fa-2x' +
                            ' font-14"></i></span>');

                        likeBox3.html('<span class="adonis-icon icon-2x" id="playerLike" data-type="song" data-id="' + id + '"><i class="fas' +
                            ' fa-heart' +
                            ' fa-2x' +
                            ' font-14"></i></span>');
                    }

                    $.notify({
                        icon: 'fas fa-heart',
                        message: data.msg
                    }, {
                        delay: 100,
                        timer: 1000,
                        z_index: 1300
                    });
                } else {
                    button.removeClass('fas');
                    button.addClass('far');

                    if (id === playerLike) {
                        likeBox.html('<span class="adonis-icon icon-2x" id="playerLike" data-type="song" data-id="' + id + '"><i class="far' +
                            ' fa-heart' +
                            ' fa-2x' +
                            ' font-14"></i></span>');

                        likeBox2.html('<span class="adonis-icon icon-2x" id="playerLike" data-type="song" data-id="' + id + '"><i class="far' +
                            ' fa-heart' +
                            ' fa-2x' +
                            ' font-14"></i></span>');

                        likeBox3.html('<span class="adonis-icon icon-2x" id="playerLike" data-type="song" data-id="' + id + '"><i class="far' +
                            ' fa-heart' +
                            ' fa-2x' +
                            ' font-14"></i></span>');
                    }

                    $.notify({
                        icon: 'fas fa-heart-broken',
                        message: data.msg
                    }, {
                        delay: 100,
                        timer: 1000,
                        z_index: 1300
                    });
                }
            },
            complete: function () {
                $.ajax({
                    type: 'POST',
                    url: 'player/song',
                    data: {
                        songId: id
                    },
                    success: function (data) {
                        let getLike = data["data"][0].like;
                        likeSongId.html(getLike + ' <i class="fas fa-heart fa-1x"></i>');
                    }
                })
            }
        });
    }

    if (type === 'album') {

        $.ajax({
            type: 'POST',
            url: 'player/like/album',
            data: {
                albumId: id
            },
            success: function (data) {
                if (data.action === 'liked') {
                    $.notify({
                        icon: 'fas fa-heart',
                        message: data.msg
                    }, {
                        z_index: 1300
                    });

                    button.html('<i class="fas fa-heart-broken"></i> Bỏ yêu thích album');
                    countLikeAlbum.html(data.like);
                } else {
                    $.notify({
                        icon: 'fas fa-heart-broken',
                        message: data.msg
                    }, {
                        delay: 100,
                        timer: 1000,
                        z_index: 1300
                    });
                    button.html('<i class="fas fa-heart"></i> Yêu thích album');
                    countLikeAlbum.html(data.like);
                }
            }
        });

    }

    if (type === 'playlist') {
        $.ajax({
            type: 'POST',
            url: 'player/like/playlist',
            data: {
                playlistId: id
            },
            success: function (data) {
                if (data.action === 'liked') {
                    $.notify({
                        icon: 'fas fa-heart',
                        message: data.msg
                    }, {
                        delay: 100,
                        timer: 1000,
                        z_index: 1300
                    });
                    button.html('<i class="fas fa-heart-broken"></i> Bỏ yêu thích danh sách phát');
                    countLikePlaylist.html(data.like);
                } else {
                    $.notify({
                        icon: 'fas fa-heart-broken',
                        message: data.msg
                    }, {
                        delay: 100,
                        timer: 1000,
                        z_index: 1300
                    });
                    button.html('<i class="fas fa-heart"></i> Yêu thích danh sách phát');
                    countLikePlaylist.html(data.like);
                }
            }
        });
    }
});

//Thêm bài hát vào playlist dropdown menu
$(document).on('click', '.add-user-playlist', function (e) {
    let songId = parseInt($(this).attr('data-songid'));
    let playlistId = parseInt($(this).attr('data-playlistid'));

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'POST',
        url: 'add-song-user-playlist/' + songId + '/' + playlistId,
        success: function (data) {
            $.notify({
                icon: 'fas fa-check-circle',
                message: data.msg
            }, {
                delay: 100,
                timer: 1000,
                z_index: 1300
            });
        }
    });
});

//Xóa playlist ở trang danh sách playlist thư viện
$(document).on('click', '.delete-user-playlist', function (e) {
    let playlistId = parseInt($(this).attr('data-playlist-id'));

    swal({
        title: "Bạn có chắc chắn muốn xóa danh sách phát này ?",
        text: "Khi bạn xóa, dữ liệu sẽ không lấy lại được!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: 'user/library/user-playlist/delete-playlist',
                    data: {
                        id: playlistId
                    },
                    success: function (data) {
                        $("#userPlaylist" + playlistId).fadeOut(1000, function () {
                            $(this).remove();
                        });
                        $.notify({
                            icon: 'fas fa-check-circle',
                            message: data.msg
                        }, {
                            delay: 100,
                            timer: 1000,
                            z_index: 1300
                        });
                    }
                });
            }
        });
});

//Bình luận bài hát
$(document).on('click', '.btn-submit', function () {
    let print_err = $(".print-error-msg");
    let _token = $("input[name='_token']").val();
    let content = $("textarea[name='content']").val();

    let username = $("input[name='user-name']").val();
    let useravatar = $("input[name='user-image']").val();

    let songId = $(this).attr('data-songid');

    $.ajax({
        url: "user/comment/song",
        type: 'POST',
        data: {
            _token: _token,
            content: content,
            song_id: songId,
        },
        success: function (data) {
            print_err.find('p').remove();
            let html = '<li class="list-group-item">' +
                '<div class="row">' +
                '<div class="col-3 col-md-3 col-xl-2">' +
                '<img src="' + useravatar + '" class="rounded-circle img-responsive" alt="' + username + '"/>' +
                '</div>' +
                '<div class="col-9 col-md-9 col-xl-10 ">' +
                '<div>' +
                '<div class="mic-info font-weight-bold">Đăng bởi: ' + username + ' - vừa xong </div>' +
                '</div>' +
                '<div class="comment-text">' + content + '</div>' +
                '</div>' +
                '</div>' +
                '</li>';
            $('.all-comment').prepend(html);
            $('.no-comment').remove();
        },
        error: function (request, status, error) {
            printErrorMsg(request.responseJSON.errors.content[0]);
        }
    });

    $('#comment_form')[0].reset();
});

function printErrorMsg(msg) {
    let print_err = $(".print-error-msg");
    print_err.find('p').remove();
    print_err.css('display', 'block');
    print_err.append('<p class="alert alert-danger">' + msg + '</p>');
}

//Tạo danh sách cá nhân mới
$(document).on('click', '#addUserPlaylist', function () {

    let errorHtml = '';
    var form_data = new FormData();
    let playlistId = $(this).attr('data-playlist-id');
    var name = $("input[name='name']").val();
    var description = $("textarea[name='description']").val();

    if ($("#add-user-playlist").find("input")[2].files[0] !== undefined) {
        var attachment_data = $("#add-user-playlist").find("input")[2].files[0];
    }

    form_data.append("name", name);
    form_data.append("description", description);

    if ($("#add-user-playlist").find("input")[2].files[0] !== undefined) {
        form_data.append("cover_image", attachment_data);
    }

    if (playlistId !== undefined) {
        form_data.append("id", playlistId);
    }


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    if (playlistId !== undefined) {
        $.ajax({
            url: "user/library/user-playlist/edit-playlist",
            method: "POST",
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            success: function () {

                $.notify({
                    icon: 'fas fa-check-circle',
                    message: 'Chỉnh sửa danh sách phát cá nhân thành công !'
                }, {
                    delay: 100,
                    timer: 1000,
                    z_index: 1300
                });
                setTimeout(function () {
                    $("#user-playlist").trigger("click");
                }, 1000);
            },
            error: function (data) {
                var errors = data.responseJSON;

                errorHtml += '<div class="alert alert-danger"><ul class="mb-0">';

                $.each(errors.errors, function (key, value) {
                    $.each(value, function (key, value) {
                        errorHtml += '<li>';
                        errorHtml += value;
                        errorHtml += '</li>';

                    });//showing only the first error.
                });
                errorHtml += '</ul></div>';

                $('.errorHtml-form').html(errorHtml); //appending to a <div id="form-errors"></div> inside form
            }
        })
    } else {
        $.ajax({
            url: "/user/library/user-playlist/add-playlist",
            method: "POST",
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            success: function () {
                $.notify({
                    icon: 'fas fa-check-circle',
                    message: 'Thêm danh sách phát cá nhân thành công !'
                }, {
                    delay: 100,
                    timer: 1000,
                    z_index: 1300
                });
                setTimeout(function () {
                    $("#user-playlist").trigger("click");
                }, 1000);
            },
            error: function (data) {
                var errors = data.responseJSON;

                errorHtml += '<div class="alert alert-danger"><ul class="mb-0">';

                $.each(errors.errors, function (key, value) {
                    $.each(value, function (key, value) {
                        errorHtml += '<li>';
                        errorHtml += value;
                        errorHtml += '</li>';
                    });//showing only the first error.
                });
                errorHtml += '</ul></div>';

                $('.errorHtml-form').html(errorHtml); //appending to a <div id="form-errors"></div> inside form
            }
        })
    }
});

//Chỉnh sửa thông tin tài khoản
$(document).on('click', '#edit-account', function () {

    let errorHtml = '';
    var form_data = new FormData();

    var username = $("input[name='username']").val();
    var full_name = $("input[name='full_name']").val();
    var birthday = $("input[name='birthday']").val();
    var gender = $("select[name='gender']").val();

    if ($("#edit-account-form").find("input")[4].files[0] !== undefined) {
        var attachment_data = $("#edit-account-form").find("input")[4].files[0];
    }

    form_data.append("username", username);
    form_data.append("full_name", full_name);
    if (birthday !== undefined) {
        form_data.append("birthday", birthday);
    }
    form_data.append("gender", gender);
    if ($("#edit-account-form").find("input")[4].files[0] !== undefined) {
        form_data.append("avatar", attachment_data);
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: "user/edit-account",
        method: "POST",
        data: form_data,
        contentType: false,
        cache: false,
        processData: false,
        success: function () {
            $.notify({
                icon: 'fas fa-check-circle',
                message: 'Chỉnh sửa hồ sơ cá nhân thành công !'
            }, {
                delay: 100,
                timer: 1000,
                z_index: 1300
            });

            setTimeout(function () {
                $("#user-index").trigger("click");
            }, 1000);
        },
        error: function (data) {
            var errors = data.responseJSON;

            errorHtml += '<div class="alert alert-danger"><ul class="mb-0">';

            $.each(errors.errors, function (key, value) {
                errorHtml += '<li>' + value + '</li>';
            });
            errorHtml += '</ul></div>';

            $('#errors-account').html(errorHtml);
        }
    });
});

//Đổi mật khẩu tài khoản
$(document).on('click', '#edit-password', function () {

    let errorHtml = '';
    var form_data = new FormData();

    var current_password = $("input[name='current_password']").val();
    var new_password = $("input[name='new_password']").val();
    var re_new_password = $("input[name='re_new_password']").val();

    form_data.append("current_password", current_password);
    form_data.append("new_password", new_password);
    form_data.append("re_new_password", re_new_password);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: "user/change-password",
        method: "POST",
        data: form_data,
        contentType: false,
        cache: false,
        processData: false,
        success: function () {
            $.notify({
                icon: 'fas fa-check-circle',
                message: 'Thay đổi mật khẩu thành công !'
            }, {
                delay: 100,
                timer: 1000,
                z_index: 1300
            });

            setTimeout(function () {
                $("#user-index").trigger("click");
            }, 1000);
        },
        error: function (data) {
            var errors = data.responseJSON;

            errorHtml += '<div class="alert alert-danger"><ul class="mb-0">';

            $.each(errors.errors, function (key, value) {
                errorHtml += '<li>' + value + '</li>';
            });
            errorHtml += '</ul></div>';

            $('#errors-password').html(errorHtml);
        }
    });
});

$('#cover_image').fileInput({
    iconClass: 'mdi mdi-fw mdi-upload'
});

var clipboard = new ClipboardJS('.btn');

clipboard.on('success', function (e) {
    $.notify({
        icon: 'fas fa-check-circle',
        message: 'Sao chép đường dẫn thành công !'
    }, {
        delay: 100,
        timer: 1000,
        z_index: 9999999
    });

    e.clearSelection();
});

clipboard.on('error', function (e) {
    console.error('Action:', e.action);
    console.error('Trigger:', e.trigger);
});

$(document).ready(function () {
    let user = $("input[name='user-name']").val();
    setInterval(function () {
        if (user === undefined) {
            $('.check-user-submenu').css("display", "none");
        }
    }, 5000);
});

$(document).on('click', '.share-album', function () {
    let albumId = $(this).attr('data-id');
    $(".link-share-album").val('');
    $('.link-share-album').val(window.location.origin + '/single-album/' + albumId);
});

$(document).on('click', '.share-playlist', function () {
    let playlistId = $(this).attr('data-id');
    $(".link-share-playlist").val('');
    $('.link-share-playlist').val(window.location.origin + '/single-playlist/' + playlistId);
});

$(document).on('click', '.reload-suggest', function () {
    $(this).toggleClass('rotate');
});










