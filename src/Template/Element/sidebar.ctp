<aside id="s-main-menu" class="sidebar">
    <div class="smm-header">
        <i class="zmdi zmdi-long-arrow-left" data-ma-action="sidebar-close"></i>
    </div>

    <ul class="smm-alerts">
        <li data-user-alert="sua-messages" data-ma-action="sidebar-open" data-ma-target="user-alerts">
            <i class="fa fa-fw fa-comments"></i>
        </li>
        <li data-user-alert="sua-notifications" data-ma-action="sidebar-open" data-ma-target="user-alerts">
            <i class="fa fa-fw fa-bell"></i>
        </li>
        <li data-user-alert="sua-tasks" data-ma-action="sidebar-open" data-ma-target="user-alerts">
            <i class="fa fa-fw fa-bug"></i>
        </li>
    </ul>

    <ul class="main-menu">
        <li>
            <a href="<?= $this->Url->build('/') ?>">
                <i class="fa fa-fw fa-flask"></i> <?= __('Leki') ?>
            </a>
        </li>
        <li>
            <a href="<?= $this->Url->build(['controller' => 'Categories', 'action' => 'index']) ?>">
                <i class="fa fa-fw fa-folder"></i> <?= __('Kategorie') ?>
            </a>
        </li>
        <li>
            <a href="<?= $this->Url->build(['controller' => 'Substances', 'action' => 'index']) ?>">
                <i class="fa fa-fw fa-flask"></i> <?= __('Substancje') ?>
            </a>
        </li>
        <li>
            <a href="<?= $this->Url->build(['controller' => 'Forms', 'action' => 'index']) ?>">
                <i class="fa fa-fw fa-medkit"></i> <?= __('Formy leków') ?>
            </a>
        </li>
        <li>
            <a href="<?= $this->Url->build(['controller' => 'Specializations', 'action' => 'index']) ?>">
                <i class="fa fa-fw fa-stethoscope"></i> <?= __('Specjalizacje') ?>
            </a>
        </li>
        <li>
            <a href="<?= $this->Url->build(['controller' => 'Treatments', 'action' => 'index']) ?>">
                <i class="fa fa-fw fa-heartbeat"></i> <?= __('Działania leków') ?>
            </a>
        </li>   
        <?php if($this->User->isAdmin()): ?>     
            <li>
                <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'index']) ?>">
                    <i class="fa fa-fw fa-users"></i>
                    <?= __('Użytkownicy') ?>
                </a>
            </li>
        <?php endif; ?>
    </ul>
</aside>