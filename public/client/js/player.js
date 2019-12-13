let adonisPlayer = {},
    adonisAllPlaylists = [],
    adonisPlayerID = 'adonis_jplayer_main',
    adonisPlayerContainer = 'adonis_jp_container',
    adonisPlaylist,
    currentPlaylistId,
    currentSongId,
    currentAlbumId,
    songId,
    countSeek,
    suggestSongPlayer = [],
    currentIdInPlayer = [],
    currentIdInPlayer2 = [],
    songinPlayerID;
jQuery(document).ready(function ($) {
    "use strict";

    adonisPlayer.init = function () {

        adonisPlaylist = new adonisJPlayerPlaylist(
            {
                jPlayer: '#' + adonisPlayerID,
                cssSelectorAncestor: "#" + adonisPlayerContainer
            },
            [
                {
                    title: "...",
                    artist: "",
                    artist_id: "",
                    mp3: "",
                    poster: "",
                    id: "",
                }
            ],
            {
                playlistOptions: {
                    enableRemoveControls: true
                },
                swfPath: "client/js",
                supplied: "oga, mp3",
                useStateClassSkin: true,
                autoBlur: true,
                smoothPlayBar: true,
                keyEnabled: false,
                audioFullScreen: true,
                display: false,
                autoPlay: false,
            });

        // player loaded event
        $("#" + adonisPlayerID).bind($.jPlayer.event.loadeddata, function (event) {
            let Poster = $(this).data("jPlayer").status.media.poster;
            songinPlayerID = $(this).data("jPlayer").status.media.id;
            $('#' + adonisPlayerContainer + ' .current-item .song-poster img').attr('src', Poster);
            $("#" + adonisPlayerID).find('img').attr('alt', '');
        });

        $(document).on('click', '#adonis-playlist .playlist-item .song-poster', function () {
            $(this).parent().find('.jp-playlist-item').trigger('click');
        });

        /**
         * event play
         */

        $("#" + adonisPlayerID).bind($.jPlayer.event.play + ".jp-repeat", function (event) {
            countSeek = 0;
            songId = $("#" + adonisPlayerID).data("jPlayer").status.media.id;

            setTimeout(function () {
                currentIdInPlayer = [];

                $.each(adonisPlaylist.playlist, function (key, value) {
                    currentIdInPlayer.push(value.id);
                });

                setTimeout(function () {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    // Lấy bài hát gợi ý
                    $.ajax({
                        type: 'POST',
                        url: '/player/song/suggest',
                        data: {
                            'idSugesst': songId,
                            'currentId': currentIdInPlayer
                        },
                        success: function (data) {
                            suggestSongPlayer = data;
                            let html = '';
                            $.each(data.data, function (key, value) {
                                var name_artits = value.artist;
                                var id_artists = value.artist_id;
                                var assoc = [];
                                for (let i = 0; i < name_artits.length; i++) {
                                    assoc[i] = {
                                        'name': name_artits[i],
                                        'id': id_artists[i]
                                    }
                                }
                                html += ' <div class="img-box-horizontal music-img-box h-g-bg h-d-shadow item-suggest-player" data-index="' + key + '">' +
                                    '<div class="img-box img-box-sm box-rounded-sm">' +
                                    '<img src="' + value.poster + '" alt="' + value.title + '">' +
                                    '</div>' +
                                    '<div class="des">' +
                                    '<h6 class="title fs-2">' +
                                    '<a href="/single-song/' + value.id + '">' + value.title + '</a>' +
                                    '</h6><p class="sub-title">';

                                $.each(assoc, function (key, value) {
                                    html += '<a href="/single-artist/' + value.id + '">' + value.name + '</a>';
                                    if (key !== assoc.length - 1) {
                                        html += ', ';
                                    }
                                });

                                html += '</p></div>' +
                                    '<div class="hover-state d-flex justify-content-between align-items-center">' +
                                    '<span class="pointer play-btn-dark box-rounded-sm player-button" data-index="' + key + '">' +
                                    '<i class="fas fa-play fs-19 text-light"></i>' +
                                    '</span>' +
                                    '<div class="d-flex align-items-center">' +
                                    '<span class="adonis-icon text-light pointer mr-2 icon-2x">' +
                                    '<span class="pointer" id="add-suggest-to-player" data-index="' + key + '">' +
                                    '<span class="fas fa-plus text-light"></span>' +
                                    '</span>' +
                                    '</span>' +
                                    '</div>' +
                                    '</div>' +
                                    '</div>';
                            });
                            $('.song-suggest-player').fadeOut().html(html).fadeIn();
                        }
                    });
                }, 500)
            }, 100);


            $('.drop-player').attr('data-songid', songId);

            let userId = $("input[name='id']").val();

            if (userId !== undefined) {
                //Thêm vào lịch sử nghe nhạc
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                //Kiểm tra bài hát đã được like chưa
                $.ajax({
                    type: 'POST',
                    url: '/song/check_like',
                    data: {
                        songId: songId
                    },
                    success: function (data) {
                        if (data.msg === 'dontLike') {
                            //Nếu chưa sẽ thêm nút like vào player
                            $('#like').html('<span class="adonis-icon icon-2x" id="playerLike" data-type="song" data-id="' + songId + '"><i' +
                                ' class="far' +
                                ' fa-heart' +
                                ' fa-2x' +
                                ' font-14"></i></span>');

                            $('#like2').html('<span class="adonis-icon icon-2x" id="playerLike" data-type="song" data-id="' + songId + '"><i' +
                                ' class="far' +
                                ' fa-heart' +
                                ' fa-2x' +
                                ' font-14"></i></span>');

                            $('#like3').html('<span class="adonis-icon icon-2x" id="playerLike" data-type="song" data-id="' + songId + '"><i' +
                                ' class="far' +
                                ' fa-heart' +
                                ' fa-2x' +
                                ' font-14"></i></span>');
                        } else {
                            //Nếu đã like thêm nút dislike vào player
                            $('#like').html('<span class="adonis-icon icon-2x" id="playerLike" data-type="song" data-id="' + songId + '"><i class="fas fa-heart fa-2x font-14"></i></span>');
                            $('#like2').html('<span class="adonis-icon icon-2x" id="playerLike" data-type="song" data-id="' + songId + '"><i class="fas fa-heart fa-2x font-14"></i></span>');
                            $('#like3').html('<span class="adonis-icon icon-2x" id="playerLike" data-type="song" data-id="' + songId + '"><i class="fas fa-heart fa-2x font-14"></i></span>');
                        }
                        //Thêm bài hát vào lịch sử nghe của user
                        $.ajax({
                            type: 'POST',
                            url: "user/add-history",
                            data: {
                                song_id: songId,
                            }
                        });
                    }
                });
            }

            // poster
            let poster = $(this).data("jPlayer").status.media.poster;

            $('#' + adonisPlayerContainer).find('.adonis-player .song-poster img').attr('src', poster);

            // blurred background
            $('#' + adonisPlayerContainer).find('.blurred-bg').css('background-image', 'url(' + poster + ')');

            let artists_html = '';

            var name = $(this).data("jPlayer").status.media.artist;
            var id = $(this).data("jPlayer").status.media.artist_id;
            var assoc = [];
            for (var i = 0; i < name.length; i++) {
                assoc[i] = {
                    'name': name[i],
                    'id': id[i]
                }
            }

            $.each(assoc, function (key, value) {
                artists_html += '<a href="single-artist/' + value.id + '" class="fix-a">' + value.name + '</a>';
                if (key !== assoc.length - 1) {
                    artists_html += ', ';
                }
            });

            $('#' + adonisPlayerContainer + ' .artist-name').html(artists_html);

            // activate album
            if (typeof currentPlaylistId !== 'undefined') {
                $("[data-album-id='" + currentPlaylistId + "']").addClass('jp-playing');
            }

            //Lưu bài hát vào localstore
            let media = $(this).data("jPlayer").status.media;

            if (typeof (Storage) !== "undefined") {
                localStorage.dataSong = JSON.stringify(media);
            } else {
                console.log('sorry');
            }
        });

        $('.adonis-mute-control').click(function () {
            let muteControl = $(this);

            if (muteControl.hasClass('muted')) {
                let volume = muteControl.attr('data-volume');
                $("#" + adonisPlayerID).jPlayer("unmute");
                muteControl.removeClass('muted');
                $("#" + adonisPlayerID).jPlayer("volume", volume);
            } else {
                let volume = $("#" + adonisPlayerID).data("jPlayer").options.volume;
                muteControl.attr('data-volume', volume);
                $("#" + adonisPlayerID).jPlayer("mute").addClass('muted');
                muteControl.addClass('muted');
            }
        });

        /**
         * event pause
         */
        $("#" + adonisPlayerID).bind($.jPlayer.event.pause + ".jp-repeat", function (event) {
            // deactivate album
            if (typeof currentPlaylistId !== 'undefined') {
                $("[data-album-id='" + currentPlaylistId + "']").removeClass('jp-playing');
            }
        });

        /* Modern Seeking */

        let timeDrag = false; /* Drag status */

        $('.jp-progress').mousedown(function (e) {
            timeDrag = true;
            let percentage = updatePercentage(e.pageX, $(this));
            $(this).addClass('dragActive');

            updatebar(percentage);
        });

        $(document).mouseup(function (e) {
            if (timeDrag) {
                timeDrag = false;
                let percentage = updatePercentage(e.pageX, $('.jp-progress.dragActive'));
                $('.jp-progress.dragActive');
                if (percentage) {
                    $('.jp-progress.dragActive').removeClass('dragActive');
                    updatebar(percentage);
                }
            }
        });

        $(document).mousemove(function (e) {
            if (timeDrag) {
                let percentage = updatePercentage(e.pageX, $('.jp-progress.dragActive'));
                updatebar(percentage);
            }
        });

        //update Progress Bar control
        let updatebar = function (percentage) {
            let maxduration = $("#" + adonisPlayerID).jPlayer.duration; //audio duration

            $('.jp-play-bar').css('width', percentage + '%');

            $("#" + adonisPlayerID).jPlayer("playHead", percentage);
            // Update progress bar and video currenttime

            $("#" + adonisPlayerID).jPlayer.currentTime = maxduration * percentage / 100;

            return false;
        };

        function updatePercentage(x, progressBar) {
            let progress = progressBar;
            let maxduration = $("#" + adonisPlayerID).jPlayer.duration; //audio duration
            let position = x - progress.offset().left; //Click pos
            let percentage = 100 * position / progress.width();
            //Check within range
            if (percentage > 100) {
                percentage = 100;
            }
            if (percentage < 0) {
                percentage = 0;
            }
            return percentage;
        }

        let volumeDrag = false;
        $(document).on('mousedown', '.jp-volume-bar', function (e) {
            volumeDrag = true;
            updateVolume(e.pageX);
        });

        $(document).mouseup(function (e) {
            if (volumeDrag) {
                volumeDrag = false;
                updateVolume(e.pageX);
            }
        });

        $(document).mousemove(function (e) {
            if (volumeDrag) {
                updateVolume(e.pageX);
            }
        });

        //update Progress Bar control
        let updateVolume = function (x) {
            let progress = $('.jp-volume-bar');
            let position = x - progress.offset().left; //Click pos
            let percentage = 100 * position / progress.width();

            //Check within range
            if (percentage > 100) {
                percentage = 100;
            }
            if (percentage < 0) {
                percentage = 0;
            }
            $("#" + adonisPlayerID).jPlayer("volume", (percentage / 100));
        };

        // remove track item
        $(document).on('click', '.remove-track-item-playlist', function () {
            let parentLi = openMenu.parents('li.item');
            adonisPlaylist.remove(parentLi.length - 1);
        });

        $(document).on('click', '.remove-track-item-current', function () {
            adonisPlaylist.remove(adonisPlaylist.current);
        });

        /**
         * Function to add track. add track if id not found and return index. If found it return the index
         * @param track track id
         * @returns index number of the track in the playlist
         */
        adonisPlayer.addTrack = function (track) {
            let _track = tracks[track]
            let foundTrack = false;
            let _return;
            adonisPlaylist.playlist.forEach(function (value, index) {
                if (value.id === track) {
                    foundTrack = true;
                    _return = index;
                }
            });

            if (foundTrack === false) {
                adonisPlaylist.add(_track);
                _return = adonisPlaylist.playlist.length - 1;
            }
            return _return;
        };

        /**
         * function to transfer song poster and play button to a larger view. eg. homepage 3 top album listener
         * @param selector
         */
        adonisPlayer.transferAlbum = function (selector) {
            $(document).on('click', selector, function (e) {
                e.preventDefault();
                let PosterTarget = $(this).attr('data-poster-target'),
                    PosterImage = $(this).attr('data-poster'),
                    track = $(this).attr('data-track');

                let PosterClone = $(PosterTarget).clone();
                PosterClone.css('background-image', 'url(' + PosterImage + ')').fadeOut(0);
                PosterClone.insertAfter($(PosterTarget));

                $(PosterTarget).fadeOut('slow', function () {
                    $(this).remove();
                });
                PosterClone.fadeIn('slow');
                let Index = adonisPlayer.addTrack(track);
                adonisPlaylist.play(Index)
            });
        };
        adonisPlayer.transferAlbum('.transfer-album');

        //Play button
        $(document).on('click', '.adonis-album-button', function (e) {
            let type = $(this).attr('data-type');
            let albumId = parseInt($(this).attr('data-album-id'));
            //Nếu là bài hát
            if (type === "song") {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                //Lấy data bài hát và truyền vào player
                $.ajax({
                    type: 'POST',
                    url: '/player/song',
                    data: {
                        songId: albumId
                    },
                    success: function (data) {
                        if (data.msgErrors !== undefined) {
                            $.notify({
                                icon: 'fas fa-exclamation-circle',
                                message: data.msgErrors
                            }, {
                                z_index: 1300
                            });
                        }

                        adonisAllPlaylists[albumId] = data["data"];

                        // set play list if not set yet
                        if (albumId && typeof adonisAllPlaylists[albumId] !== 'undefined' && currentSongId !== albumId) {
                            adonisPlaylist.setPlaylist(adonisAllPlaylists[albumId]);
                            currentSongId = albumId;

                            // play or pause
                            if ($('#' + adonisPlayerID).data().jPlayer.status.paused) {
                                setTimeout(function () {
                                    adonisPlaylist.play(0);
                                }, 700);
                            } else {
                                setTimeout(function () {
                                    adonisPlaylist.play(0);
                                }, 700);
                            }
                        } else {
                            // play or pause
                            if ($('#' + adonisPlayerID).data().jPlayer.status.paused) {
                                setTimeout(function () {
                                    adonisPlaylist.play();
                                }, 700);
                            } else {
                                adonisPlaylist.pause();
                            }
                        }
                    }
                });
            } else if (type === "album") {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                //Truyền data album vào player
                $.ajax({
                    type: 'POST',
                    url: '/player/album',
                    data: {
                        albumId: albumId
                    },
                    success: function (data) {
                        if (data.msgErrors !== undefined) {
                            $.notify({
                                icon: 'fas fa-exclamation-circle',
                                message: data.msgErrors
                            }, {
                                z_index: 1300
                            });
                        }

                        adonisAllPlaylists[albumId] = data["data"];

                        // set play list if not set yet
                        if (albumId && typeof adonisAllPlaylists[albumId] !== 'undefined' && currentAlbumId !== albumId) {
                            adonisPlaylist.setPlaylist(adonisAllPlaylists[albumId]);
                            currentAlbumId = albumId;

                            // play or pause
                            if ($('#' + adonisPlayerID).data().jPlayer.status.paused) {
                                setTimeout(function () {
                                    adonisPlaylist.play(0);
                                }, 700);
                            } else {
                                setTimeout(function () {
                                    adonisPlaylist.play(0);
                                }, 700);
                            }
                        } else {
                            // play or pause
                            if ($('#' + adonisPlayerID).data().jPlayer.status.paused) {
                                setTimeout(function () {
                                    adonisPlaylist.play();
                                }, 700);
                            } else {
                                adonisPlaylist.pause();
                            }
                        }
                    }
                });
            } else if (type === "playList") {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                //Truyền data playlist vào player
                $.ajax({
                    type: 'POST',
                    url: '/player/playlist',
                    data: {
                        playlistId: albumId
                    },
                    success: function (data) {
                        if (data.msgErrors !== undefined) {
                            $.notify({
                                icon: 'fas fa-exclamation-circle',
                                message: data.msgErrors
                            }, {
                                z_index: 1300
                            });
                        }

                        adonisAllPlaylists[albumId] = data["data"];

                        // set play list if not set yet
                        if (albumId && typeof adonisAllPlaylists[albumId] !== 'undefined' && currentPlaylistId !== albumId) {
                            adonisPlaylist.setPlaylist(adonisAllPlaylists[albumId]);
                            currentPlaylistId = albumId;

                            // play or pause
                            if ($('#' + adonisPlayerID).data().jPlayer.status.paused) {
                                setTimeout(function () {
                                    adonisPlaylist.play(0);
                                }, 700);
                            } else {
                                setTimeout(function () {
                                    adonisPlaylist.play(0);
                                }, 700);
                            }
                        } else {
                            // play or pause
                            if ($('#' + adonisPlayerID).data().jPlayer.status.paused) {
                                setTimeout(function () {
                                    adonisPlaylist.play();
                                }, 700);
                            } else {
                                adonisPlaylist.pause();
                            }
                        }
                    }
                });
            }
        });

        adonisPlayer.addPlaylist = function (albumId) {
            if (albumId && typeof adonisAllPlaylists[albumId] !== 'undefined') {
                adonisAllPlaylists[albumId].forEach(function (_value) {
                    adonisPlaylist.add(_value);
                });
            }
        };

        //Ấn phát bài hát ở suggest player
        $(document).on('click', '.player-button', function (e) {
            let index = $(this).attr('data-index');
            let song = suggestSongPlayer.data[index];
            song["typeInPlayer"] = "addNew";
            adonisPlaylist.add(suggestSongPlayer.data[index], true);
        });
    };

    $('#avatar').fileInput({
        iconClass: 'mdi mdi-fw mdi-upload'
    });

    $('#cover_image').fileInput({
        iconClass: 'mdi mdi-fw mdi-upload'
    });

    //Tăng view cho bài hát, không tua và nghe hết bài hát
    $("#" + adonisPlayerID).bind($.jPlayer.event.seeking, function (event) {
        countSeek = 1;
    });

    $("#" + adonisPlayerID).bind($.jPlayer.event.ended, function (event) {
        if (countSeek === 0) {
            let id = $(this).data("jPlayer").status.media.id;

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '/update-view',
                data: {songId: id},
                success: function (data) {
                    $.ajax({
                        type: 'POST',
                        url: '/update-view-daily',
                        data: {songId: id},
                    });
                }
            });
        } else {
            countSeek = 0;
        }

        if ($('#auto-play-suggest:checkbox:checked').length > 0) {
            let lastSongPlayer = adonisPlaylist.playlist[adonisPlaylist.playlist.length - 1].id;

            if ($(this).data("jPlayer").status.media.id === lastSongPlayer) {
                let song = suggestSongPlayer.data[0];
                song["typeInPlayer"] = "suggest";
                adonisPlaylist.add(suggestSongPlayer.data[0], true);
            }

            if ($(this).data("jPlayer").options.loop === true) {
                $('#repeat-button').trigger("click");
            }

        } else {
            if ($(this).data("jPlayer").options.loop === false) {
                $('#repeat-button').trigger("click");
            }
        }
    });

    $(document).on('click', '.add-next', function () {
        let songId = $(this).attr('data-id');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //Lấy data bài hát và truyền vào player
        $.ajax({
            type: 'POST',
            url: '/player/song',
            data: {
                songId: songId
            },
            success: function (data) {
                if (data.msgErrors !== undefined) {
                    $.notify({
                        icon: 'fas fa-exclamation-circle',
                        message: data.msgErrors
                    }, {
                        z_index: 1300,
                        delay: 100,
                        timer: 1000
                    });
                } else {
                    if (currentIdInPlayer2.includes(songId)) {
                        $.notify({
                            icon: 'fas fa-exclamation-triangle',
                            message: 'Bài hát đã có trong danh sách chờ !'
                        }, {
                            z_index: 1300,
                            delay: 100,
                            timer: 1000
                        });
                    } else {
                        currentIdInPlayer2.push(songId);
                        $.notify({
                            icon: 'fas fa-check-circle',
                            message: 'Thêm bài hát vào danh sách chờ'
                        }, {
                            z_index: 1300,
                            delay: 100,
                            timer: 1000
                        });

                        if (adonisPlaylist.playlist[0].title === '...') {
                            let song = data.data[0];
                            song["typeInPlayer"] = "addNew";
                            adonisPlaylist.remove(0);
                            adonisPlaylist.add(data.data[0], true);
                        } else {
                            let song = data.data[0];
                            song["typeInPlayer"] = "addNew";
                            adonisPlaylist.add(data.data[0]);
                        }
                    }
                }
            }
        });
    });

    $(document).on('click', '.reload-suggest', function () {
        setTimeout(function () {
            currentIdInPlayer = [];

            $.each(adonisPlaylist.playlist, function (key, value) {
                currentIdInPlayer.push(value.id);
            });

            setTimeout(function () {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                // Lấy bài hát gợi ý
                $.ajax({
                    type: 'POST',
                    url: '/player/song/suggest',
                    data: {
                        'idSugesst': songinPlayerID,
                        'currentId': currentIdInPlayer
                    },
                    success: function (data) {
                        suggestSongPlayer = data;
                        let html = '';
                        $.each(data.data, function (key, value) {
                            var name_artits = value.artist;
                            var id_artists = value.artist_id;
                            var assoc = [];
                            for (let i = 0; i < name_artits.length; i++) {
                                assoc[i] = {
                                    'name': name_artits[i],
                                    'id': id_artists[i]
                                }
                            }
                            html += ' <div class="img-box-horizontal music-img-box h-g-bg h-d-shadow item-suggest-player" data-index="' + key + '">' +
                                '<div class="img-box img-box-sm box-rounded-sm">' +
                                '<img src="' + value.poster + '" alt="' + value.title + '">' +
                                '</div>' +
                                '<div class="des">' +
                                '<h6 class="title fs-2">' +
                                '<a href="/single-song/' + value.id + '">' + value.title + '</a>' +
                                '</h6><p class="sub-title">';

                            $.each(assoc, function (key, value) {
                                html += '<a href="/single-artist/' + value.id + '">' + value.name + '</a>';
                                if (key !== assoc.length - 1) {
                                    html += ', ';
                                }
                            });

                            html += '</p></div>' +
                                '<div class="hover-state d-flex justify-content-between align-items-center">' +
                                '<span class="pointer play-btn-dark box-rounded-sm player-button" data-index="' + key + '">' +
                                '<i class="fas fa-play fs-19 text-light"></i>' +
                                '</span>' +
                                '<div class="d-flex align-items-center">' +
                                '<span class="adonis-icon text-light pointer mr-2 icon-2x">' +
                                '<span class="pointer" id="add-suggest-to-player" data-index="' + key + '">' +
                                '<span class="fas fa-plus text-light"></span>' +
                                '</span>' +
                                '</span>' +
                                '</div>' +
                                '</div>' +
                                '</div>';
                        });
                        $('.song-suggest-player').fadeOut().html(html).fadeIn();
                    }
                });
            }, 100);
        }, 100);
    });

    $(document).on('click', '#add-suggest-to-player', function () {
        let index = $(this).attr('data-index');
        let song = suggestSongPlayer.data[index];
        song["typeInPlayer"] = "addNew";
        adonisPlaylist.add(suggestSongPlayer.data[index]);
        let getItem = $('.item-suggest-player[data-index="' + index + '"]')
        getItem.remove().fadeOut();

        if ($('.item-suggest-player').length === 0) {
            $('.reload-suggest').trigger('click')
        }
    });

    $(window).imagesLoaded(function () {
        setTimeout(function () {
            adonisPlayer.init();
        }, 100);

        setTimeout(function () {
            if (localStorage.dataSong) {
                let oldData = JSON.parse("[" + localStorage.dataSong + "]");
                adonisPlaylist.setPlaylist(oldData);
            } else {
                $.ajax({
                    type: 'GET',
                    url: '/player/random-song',
                    success: function (data) {
                        adonisPlaylist.setPlaylist(data["data"]);
                    }
                });
            }
        }, 200);
    });
});
