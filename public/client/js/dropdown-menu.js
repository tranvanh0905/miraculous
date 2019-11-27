(function ($, undefined) {
    openMenu = '';
    adonisPopup = function (options) {
        var settings = $.extend({
            // These are the defaults.
            menu: {},
            parent: '.has-drop',
            selector: '',
            direction: 'left',
            width: 206,
            dropdownContainer: "body",
        }, options);

        var el = this;
        var dropdownOpen = false;
        var style, position, html = '', elTarget, htmlCont, oldTarget;
        var _container = '#adonis-popup-menu';

        if (settings.menu.length > 0) {
            html += '<ul class="list-unstyled">';
            settings.menu.forEach(function (element) {
                var Class = element.class ? ' ' + element.class : '';
                if (typeof element.submenu != 'undefined') {
                    html += '<li class="has-dropdown"><a class="dropdown-item' + Class + '" href="#">' + element.icon + element.text + '</a>';
                    html += '<ul class="dropdown-menu">';
                    element.submenu.forEach(function (element) {
                        html += '<li class="item-playlist"><a class="add-user-playlist dropdown-item' + Class + '" data-songid=""' +
                            ' data-playlistId="' + element.id + '" href="javascript:' +
                            ' void(0)"><i' +
                            ' class="fas' +
                            ' fa-headset mr-2"></i>' +
                            ' ' + element.name + '</a>';
                    });
                    html += '<li class="item-playlist"><a href="/user/library/user-playlist/add-playlist" class="dropdown-item"><i class="fas' +
                        ' fa-plus mr-2"></i> Tạo danh sách phát mới</a></li>';
                    html += '</ul>';
                } else if (typeof element.withlink != 'undefined') {
                    html += '<li><a class="dropdown-item' + Class + '" href="javascript:">' + element.icon + element.text + '</a>';
                } else {
                    html += '<li><a class="dropdown-item' + Class + '" href="javascript:">' + element.icon + element.text + '</a>';
                }
                html += '</li>';
            });
            html += '</ul>';
        }

        var e = null;

        $(document).on('click', settings.selector, function (event) {
            e = event;
            settings.direction = typeof $(this).attr('data-direction') != 'undefined' ? $(this).attr('data-direction') : 'left';
            clickEvent($(this));

            let songid = $(this).attr('data-songid');

            $('.add-user-playlist').attr('data-songid', songid);

            let userPlaylistId = $(this).attr('data-user-playlist-id');

            $('.edit-user-playlist').attr('href', '/user/library/user-playlist/edit-playlist/' + userPlaylistId);

            $('.delete-user-playlist').attr('data-playlist-id', userPlaylistId);
        });

        function clickEvent(el) {
            e.preventDefault();
            elTarget = el;
            position = elTarget.offset();
            var Left = _left(settings.direction);
            var Top = _top();
            var _class = '';
            if (Math.floor($(settings.dropdownContainer).width() - (Left + settings.width * 2)) < 0) {
                _class += ' dropdown-reverse';
            }
            style = 'top:' + (Top) + 'px;Left:' + Left + 'px;width:' + settings.width + 'px';
            htmlCont = '<div id="adonis-popup-menu" style="' + style + '" class="dropdown-show dropdown-menu dropdown-menu-right' + _class + '">' + html + '</div>';

            if (!elTarget.hasClass('dropdown-show')) {
                add();
            }
        }

        function _left(direction) {
            position = elTarget.offset();
            var Left;

            if (direction === 'left') {
                Left = Math.round(position.left - settings.width + elTarget.outerWidth());
                if (Left < 0) {
                    Left = _left('right')
                }
            } else {
                Left = Math.round(position.left);
                if (Left + settings.width > $(window).innerWidth()) {
                    Left = _left('left')
                }
            }
            return Left
        }

        function _top() {
            position = elTarget.offset();
            var Height = settings.menu.length * 30 + 30,
                top = Height + position.top + elTarget.height() > $(document).outerHeight() ? position.top - (Height + elTarget.height()) : position.top + elTarget.outerHeight();
            return Math.round(top);
        }

        function outside(e) {
            var target = e.target;
            elTarget = $('.dropdown-show.adonisToggle');
            if (jQuery(target).hasClass('dropdown-menu-toggle') === false && jQuery(e.target).parents('.dropdown-menu-toggle').length < 1) {
                if (!jQuery(target).is(_container) && typeof elTarget !== 'undefined' && !jQuery(target).is(elTarget.find('*'))) {
                    remove();
                    jQuery(document).off("click", 'body', outside);
                }
            }
        }

        adonisPopup.outside = outside;

        function add() {
            if (remove() == true) {
                openMenu = elTarget;
                elTarget.addClass('dropdown-show adonisToggle').parents(settings.parent).addClass('dropdown-show');
                jQuery(htmlCont).appendTo(settings.dropdownContainer);
            }
            jQuery(document).on('click', 'body', outside);
        }

        function remove() {
            elTarget.removeClass('dropdown-show').parents('.dropdown-show:first').removeClass('dropdown-show');
            jQuery(_container).remove();
            jQuery('.adonisToggle').removeClass('dropdown-show adonisToggle').parents(settings.parent).removeClass('dropdown-show');
            openMenu = '';
            return true;
        }
    }
})(jQuery);

jQuery(document).ready(function ($) {
    let dataUserPlaylist = []
    //Lấy danh sách phát cá nhân
    $.ajax({
        type: 'GET',
        url: '/get-user-playlist/',
        async: false,
        success: function (data) {
            dataUserPlaylist = data['data'];
        }
    });

    $('.nav-item').on('show.bs.dropdown', function (e) {
        adonisPopup.outside(e);
    });
    // dropdown menu any where
    var albumMenu = [
        {
            text: 'Thêm vào danh sách phát',
            icon: '<i class="fas fa-plus fa-1x mr-2"></i>',
            linkShare: '',
            submenu: dataUserPlaylist
        },
        {
            text: 'Thêm vào tiếp theo',
            icon: '<i class="fas fa-caret-square-right fa-1x mr-2"></i>'
        },
        {
            text: 'Chia sẻ',
            icon: '<i class="fas fa-share-square fa-1x mr-2"></i>'
        },
    ];


    new adonisPopup({
        selector: '.dropdown-menu-toggle',
        menu: albumMenu,
        parent: '.music-img-box'
    });

    var playlistUserMenu = [
        {
            text: 'Chỉnh sửa danh sách phát',
            icon: '<i class="fas fa-edit mr-2"></i>',
            class: 'edit-user-playlist'
        }, {
            text: 'Xóa danh sách phát',
            icon: '<i class="fas fa-minus-circle mr-2"></i>',
            class: 'delete-user-playlist'
        }, {
            text: 'Chia sẻ',
            icon: '<i class="fas fa-share-square mr-2"></i>'
        }
    ];

    new adonisPopup({
        selector: '.drop-2',
        menu: playlistUserMenu,
        parent: '.music-img-box'
    });


    var playlistTrackMenu = [{
        text: 'Yêu thích',
    }, {
        text: 'Chia sẻ',
    }, {
        class: 'remove-track-item-playlist',
        text: 'Xóa khỏi danh sách phát',
    }, {
        text: 'Thêm vào danh sách phát',
    }];

    new adonisPopup({
        selector: '.track-menu-playlist',
        menu: playlistTrackMenu,
        parent: '.song-poster',
    });


    var trackMenuCurrent = [{
        text: 'Yêu thích',
    }, {
        text: 'Chia sẻ',
    }, {
        class: 'remove-track-item-current',
        text: 'Xóa khỏi danh sáchs',
    }, {
        text: 'Thêm vào danh sách',
    }];

    new adonisPopup({
        selector: '.current-track-menu',
        menu: trackMenuCurrent,
        parent: '.song-poster',
    });

});

