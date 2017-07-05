<header id="header" class="media">
    <div class="pull-left h-logo">
        <a href="<?= $this->Url->build(['controller' => 'Drugs', 'action' => 'index']) ?>" class="hidden-xs">
            <i class="fa fa-fw fa-flask brand"></i>
            <small><?= __('Baza leków') ?></small>
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
        <li class="dropdown hidden-xs">
            <a data-toggle="dropdown" href="#"><i class="hm-icon zmdi zmdi-more-vert"></i></a>
            <ul class="dropdown-menu dm-icon pull-right">
                <?php if(!$this->User->isLoged()): ?>
                    <li>
                        <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'login']) ?>">
                            <?= __('Zaloguj') ?>
                        </a>
                    </li>
                <?php else: ?>
                    <li>
                        <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'followed']) ?>">
                            <?= __('Moje śledzone leki') ?>
                        </a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['controller' => 'Notifications', 'action' => 'index']) ?>">
                            <?= __('Powiadomienia') ?>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'logout']) ?>">
                            <?= __('Wyloguj') ?>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </li>
        <?php if(!$this->User->isLoged()): ?>
            <li>
                <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'login']) ?>">
                    <i class="hm-icon zmdi zmdi-account"></i>
                </a>
            </li>
        <?php endif; ?>
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
            <?= $this->Filter->input('tag') ?>
            <i class="zmdi zmdi-search hs-reset" data-ma-action="search-clear"></i>
        </form>
    </div>
</header>