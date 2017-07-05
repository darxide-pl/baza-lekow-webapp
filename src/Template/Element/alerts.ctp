<aside id="s-user-alerts" class="sidebar">
    <ul class="tab-nav tn-justified tn-icon m-t-10" data-tab-color="teal">
        <li>
            <a class="sua-messages" href="#sua-messages" data-toggle="tab">
                <i class="fa fa-fw fa-envelope"></i>
            </a>
        </li>
        <li>
            <a class="sua-notifications" href="#sua-notifications" data-toggle="tab">
                <i class="fa fa-fw fa-bell"></i>
            </a>
        </li>
        <li>
            <a class="sua-tasks" href="#sua-tasks" data-toggle="tab">
                <i class="fa fa-fw fa-bug"></i>
            </a>
        </li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane fade" id="sua-messages">
            <ul class="sua-menu list-inline list-unstyled palette-Light-Blue bg">
                <li>
                    <a href="#" class="btn-action" data-controller="comments" data-action="readAll">
                        <i class="zmdi zmdi-check-all"></i> 
                        <?= __('Przeczytane') ?>
                    </a>
                </li>
                <li><a href="#" data-ma-action="sidebar-close"><i class="zmdi zmdi-close"></i> <?= __('Zamknij') ?></a></li>
            </ul>

            <div class="list-group lg-alt c-overflow">

                <?php foreach((array) $newComments as $v): ?>
                    <a href="<?= $this->Url->build(['controller' => 'Drugs', 'action' => 'view', $v->drug_id]) ?>" class="list-group-item media notify-comment">
                        <div class="pull-left">
                            <i class="fa fa-fw fa-comment"></i>
                        </div>

                        <div class="media-body">
                            <span href="javascript:void(0)" class="btn-action pull-right" data-controller="comments" data-action="markAsRead" data-id="<?= $v->id ?>">
                                <i class="fa fa-fw fa-times"></i>
                            </span>
                            <div class="lgi-heading"><?= $v->Comments['name'] ?></div>
                            <small class="lgi-text"><?= mb_substr(h($v->Comments['comment']), 0, 30) ?>...</small>
                        </div>
                    </a>
                <?php endforeach; ?>

            </div>
        </div>
        <div class="tab-pane fade" id="sua-notifications">
            <ul class="sua-menu list-inline list-unstyled palette-Orange bg">
                <li>
                    <a href="#" class="btn-action" data-controller="news" data-action="readAll">
                        <i class="zmdi zmdi-check-all"></i> 
                        <?= __('Przeczytane') ?>
                    </a
                <li><a href="#" data-ma-action="sidebar-close"><i class="zmdi zmdi-close"></i> <?= __('Zamknij') ?></a></li>
            </ul>

            <div class="list-group lg-alt c-overflow">

                <?php foreach((array) $newDrugs as $v): ?>
                    <a href="<?= $this->Url->build(['controller' => 'Drugs', 'action' => 'view', $v->drug_id]) ?>" class="list-group-item media notify-drug">
                        <div class="pull-left">
                            <i class="fa fa-fw fa-flask"></i>
                        </div>
                        <div class="media-body">
                            <span href="javascript:void(0)" class="btn-action pull-right" data-controller="news" data-action="markAsRead" data-id="<?= $v->id ?>">
                                <i class="fa fa-fw fa-times"></i>
                            </span>                        
                            <div class="lgi-heading"><?= $v->Drugs['name'] ?></div>
                            <small class="lgi-text"><?= __('Data aktualizacji: {0}', [$v->add_date]) ?></small>
                        </div>
                    </a>
                <?php endforeach; ?>

            </div>
        </div>
        <div class="tab-pane fade" id="sua-tasks">
            <ul class="sua-menu list-inline list-unstyled palette-Green-400 bg">
                <li><a href="#"><i class="zmdi zmdi-time"></i> <?= __('Ostatnie aktualizacje bazy') ?></a></li>
                <li><a href="#" data-ma-action="sidebar-close"><i class="zmdi zmdi-close"></i> <?= __('Zamknij') ?></a></li>
            </ul>

            <div class="list-group lg-alt c-overflow">
                
                <?php if(count($robots)):foreach($robots as $v): ?>
                    <div class="list-group-item">
                        <?php if($v->end_date): ?>
                            <div class="lgi-heading m-b-5">
                                <i class="fa fa-fw fa-check"></i> <?= __('Skan zakończony') ?>
                            </div>
                            <small class="robot-info">
                                <?= __('{0} - {1} <br> Zaktualizowane leki: {2}', [
                                    $v->start_date->i18nFormat('y-MM-dd'),
                                    $v->end_date->i18nFormat('y-MM-dd'),
                                    $v->drugs
                                ]) ?>
                            </small>
                        <?php else: ?>
                            <div class="lgi-heading m-b-5">
                                <i class="fa fa-fw fa-clock-o"></i> <?= __('Trwa') ?>
                            </div>
                            <small class="robot-info">
                                <?= __('Zaktualizowane leki: {0}', [$v->drugs]) ?>
                            </small>
                        <?php endif; ?>
                        <div class="progress">
                            <div class="progress-bar <?= $v->end_date ? 'progress-bar-success' : 'progress-bar-warning' ?>" role="progressbar" style="width: <?= $v->end_date ? '100%' : $v->drugs / $robots_avg * 100 .'%'; ?>">
                            </div>
                        </div>
                    </div>
                <?php endforeach;endif; ?>
            </div>
        </div>
    </div>
</aside>