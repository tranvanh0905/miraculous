<div id="search-box-4">
    <button id="btn-search-close" class="btn btn-blank btn--search-close" aria-label="Close search form">
        <span class="adonis-icon color-active"><svg id="icon-cross" viewBox="0 0 24 24" width="5vmin"> <path
                    d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"></path> </svg></span>
    </button>

    <div class="search-inner search-inner-up d-flex align-items-center">
        <div class="master-container-fluid d-flex align-items-center">
            <form class="search-form">
                <input class="search-input" name="search" type="search" placeholder="Start typing..." autocomplete="off"
                       spellcheck="false">
            </form>
        </div>
    </div>

    <div class="search-inner search-inner-down dark-theme">
        <div class="master-container-fluid pt-3 pt-md-4 d-flex flex-column">
            <div class="navbar-expand mb-2 mb-md-4 scroll-x">
                <ul class="nav moving-border flex-nowrap" role="tablist">
                    <li class="menu-item active">
                        <a class="nav-link active m-item fs-7 pr-3 pl-0" id="search-tab-songs" data-toggle="tab"
                           href="#search-content-songs" role="tab" aria-controls="search-content-songs"
                           aria-selected="true">Songs</a>
                    </li>
                    <li class="menu-item">
                        <a class="nav-link m-item fs-7 pr-3 pl-3" id="search-tab-albums" data-toggle="tab"
                           href="#search-content-albums" role="tab" aria-controls="search-content-albums"
                           aria-selected="true">Albums</a>
                    </li>
                    <li class="menu-item">
                        <a class="nav-link m-item fs-7 pr-3 pl-3" id="search-tab-playlists" data-toggle="tab"
                           href="#search-content-playlists" role="tab" aria-controls="search-content-playlists"
                           aria-selected="true">Playlists</a>
                    </li>
                    <li class="menu-item">
                        <a class="nav-link m-item fs-7 pr-3 pl-3" id="search-tab-artists" data-toggle="tab"
                           href="#search-content-artists" role="tab" aria-controls="search-content-artists"
                           aria-selected="true">Artists</a>
                    </li>
                </ul>
                <hr class="border-hr">
            </div>
            <div class="tab-content scroll-y">
                <div class="tab-pane fade show active" id="search-content-songs" role="tabpanel"
                     aria-labelledby="search-tab-songs">
                    <div class="row auto-cols-row" id="searchsong" data-item-width="330" data-item-max-width="630">
                    </div>
                </div>

                <div class="tab-pane fade" id="search-content-albums" role="tabpanel"
                     aria-labelledby="search-tab-albums">
                    <div class="row auto-cols-row" data-item-width="150" id="searchalbum" data-item-max-width="200">

                    </div>
                </div>
                <div class="tab-pane fade" id="search-content-artists" role="tabpanel"
                     aria-labelledby="search-tab-artists">
                    <div class="row auto-cols-row" data-item-width="150" id="searchartist" data-item-max-width="200">

                    </div>
                </div>
                <div class="tab-pane fade" id="search-content-playlists" role="tabpanel"
                     aria-labelledby="search-tab-playlists">
                </div>
                <div class="row auto-cols-row" data-item-width="150" id="searchplaylist" data-item-max-width="200">

                </div>
            </div>
        </div>
    </div>
</div>
