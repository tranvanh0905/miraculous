//Log out
$(document).on('click', '#logout', function () {
    $.ajax({
        type: 'get',
        url: '/logout',
        success: function () {
            location.reload();
        }
    });
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
            $('#searchsong').html(data);
        }
    });
});

//Follow artist
$(document).on('click', '.btn-follow', function () {
    let artistId = $(this).attr('data-artist-id');
    let divTarget = $(this);
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
                    delay: 1000,
                    timer: 1000
                });
            } else {
                divTarget.html('<i class="fas fa-user-plus"></i> Quan tâm').fadeIn();
                $.notify({
                    icon: 'fas fa-user-plus',
                    message: data.msg
                }, {
                    delay: 1000,
                    timer: 1000
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
            url: 'like/song/' + id,
            success: function (data) {
                if (data.msg === 'liked') {
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
                        icon: 'glyphicon glyphicon-ok',
                        message: "Yêu thích bài hát thành công !"
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
                        icon: 'glyphicon glyphicon-ok',
                        message: "Bỏ yêu thích bài hát !"
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

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    if (type === 'song') {

        $.ajax({
            type: 'POST',
            url: 'like/song/' + id,
            success: function (data) {
                if (data.action === 'liked') {
                    button.removeClass('far');
                    button.addClass('fas');

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
                        icon: 'fas fa-check-circle',
                        message: data.msg
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
                        icon: 'fas fa-check-circle',
                        message: data.msg
                    });
                }
            },
            complete: function () {
                $.ajax({
                    type: 'GET',
                    url: 'song/' + id,
                    success: function (data) {
                        let getLike = data["data"][0].like;
                        likeSongId.text(getLike);
                    }
                })
            }
        });
    }

    if (type === 'album') {

        $.ajax({
            type: 'POST',
            url: 'like/album/' + id,
            success: function (data) {
                if (data.action === 'liked') {
                    $.notify({
                        icon: 'fas fa-heart',
                        message: data.msg
                    });

                    button.html('<i class="fas fa-heart-broken"></i> Bỏ yêu thích album');
                    countLikeAlbum.html(data.like);
                } else {
                    $.notify({
                        icon: 'fas fa-heart-broken',
                        message: data.msg
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
            url: 'like/playlist/' + id,
            success: function (data) {
                if (data.action === 'liked') {
                    $.notify({
                        icon: 'fas fa-heart',
                        message: data.msg
                    }, {
                        timer: 1000,
                        delay: 1000
                    });
                    button.html('<i class="fas fa-heart-broken"></i> Bỏ yêu thích danh sách phát');
                    countLikePlaylist.html(data.like);
                } else {
                    $.notify({
                        icon: 'fas fa-heart-broken',
                        message: data.msg
                    }, {
                        timer: 1000,
                        delay: 1000
                    });
                    button.html('<i class="fas fa-heart"></i> Yêu thích');
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
                icon: 'glyphicon glyphicon-ok',
                message: data.msg
            });
        }
    });
});

//Xóa playlist ở trang danh sách playlist thư viện
$(document).on('click', '.delete-user-playlist', function (e) {
    let playlistId = parseInt($(this).attr('data-playlist-id'));

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
                icon: 'glyphicon glyphicon-ok',
                message: data.msg
            });
        }
    });
});

//Bỏ yêu thích bài hát ở thư viện
$(document).on('click', '.like-library', function () {
    let songId = $(this).attr('data-id');
    $('.song-in-library[data-song-id="' + songId + '"]').remove().fadeOut();
});

