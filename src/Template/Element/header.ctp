<header id="header" class="media">
    <div class="pull-left h-logo">
        <a href="index-2.html" class="hidden-xs">
            Material
            <small>admin extended</small>
        </a>

        <div class="menu-collapse" data-ma-action="sidebar-open" data-ma-target="main-menu">
            <div class="mc-wrap">
                <div class="mcw-line top palette-White bg"></div>
                <div class="mcw-line center palette-White bg"></div>
                <div class="mcw-line bottom palette-White bg"></div>
            </div>
        </div>
    </div>

    <ul class="pull-right h-menu">
        <li class="hm-search-trigger">
            <a href="#" data-ma-action="search-open">
                <i class="hm-icon zmdi zmdi-search"></i>
            </a>
        </li>

        <li class="dropdown hidden-xs hidden-sm h-apps">
            <a data-toggle="dropdown" href="#">
                <i class="hm-icon zmdi zmdi-apps"></i>
            </a>
            <ul class="dropdown-menu pull-right">
                <li>
                    <a href="#">
                        <i class="palette-Red-400 bg zmdi zmdi-calendar"></i>
                        <small>Calendar</small>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <i class="palette-Green-400 bg zmdi zmdi-file-text"></i>
                        <small>Files</small>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="palette-Light-Blue bg zmdi zmdi-email"></i>
                        <small>Mail</small>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="palette-Orange-400 bg zmdi zmdi-trending-up"></i>
                        <small>Analytics</small>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="palette-Purple-300 bg zmdi zmdi-view-headline"></i>
                        <small>News</small>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="palette-Blue-Grey bg zmdi zmdi-image"></i>
                        <small>Gallery</small>
                    </a>
                </li>
            </ul>
        </li>
        <li class="dropdown hidden-xs">
            <a data-toggle="dropdown" href="#"><i class="hm-icon zmdi zmdi-more-vert"></i></a>
            <ul class="dropdown-menu dm-icon pull-right">
                <li class="hidden-xs">
                    <a data-action="fullscreen" href="#"><i class="zmdi zmdi-fullscreen"></i> Toggle Fullscreen</a>
                </li>
                <li>
                    <a data-action="clear-localstorage" href="#"><i class="zmdi zmdi-delete"></i> Clear Local Storage</a>
                </li>
                <li>
                    <a href="#"><i class="zmdi zmdi-face"></i> Privacy Settings</a>
                </li>
                <li>
                    <a href="#"><i class="zmdi zmdi-settings"></i> Other Settings</a>
                </li>
            </ul>
        </li>
        <li class="hm-alerts" data-user-alert="sua-messages" data-ma-action="sidebar-open" data-ma-target="user-alerts">
            <a href="#"><i class="hm-icon zmdi zmdi-notifications"></i></a>
        </li>
        <li class="dropdown hm-profile">
            <a data-toggle="dropdown" href="#">
                <img src="img/profile-pics/1.jpg" alt="">
            </a>

            <ul class="dropdown-menu pull-right dm-icon">
                <li>
                    <a href="profile-about.html"><i class="zmdi zmdi-account"></i> View Profile</a>
                </li>
                <li>
                    <a href="#"><i class="zmdi zmdi-input-antenna"></i> Privacy Settings</a>
                </li>
                <li>
                    <a href="#"><i class="zmdi zmdi-settings"></i> Settings</a>
                </li>
                <li>
                    <a href="#"><i class="zmdi zmdi-time-restore"></i> Logout</a>
                </li>
            </ul>
        </li>
    </ul>

    <div class="media-body h-search">
        <form class="p-relative" method="get" action="<?= $this->Url->build(['controller' => 'Drugs', 'action' => 'index']) ?>">
            <input type="text" value="<?= h($this->Filter->get('search')) ?>" name="filter[search]" class="hs-input" placeholder="<?= h(__('Szukaj leku wg nazwy')) ?>">
            <?= $this->Filter->input('category') ?>
            <?= $this->Filter->input('substances') ?>
            <?= $this->Filter->input('substances_mode') ?>            
            <?= $this->Filter->input('specializations') ?>
            <?= $this->Filter->input('specializations_mode') ?>
            <?= $this->Filter->input('forms') ?>
            <?= $this->Filter->input('forms_mode') ?>            
            <?= $this->Filter->input('treatments') ?>
            <?= $this->Filter->input('treatments_mode') ?>
            <i class="zmdi zmdi-search hs-reset" data-ma-action="search-clear"></i>
        </form>
    </div>
</header>