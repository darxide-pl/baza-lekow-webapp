<div class="card">
    <div class="card-header">
        <h2><?= __('Lista śledzonych aktualizacji') ?></h2>
    </div>

    <div class="card-body card-padding">
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3">
                <ul class="list-group">
                    <?php if(count($follows)): ?>
                        <?php foreach($follows as $v): ?>
                            <li class="list-group-item">
                                <a href="<?= $this->Url->build(['controller' => 'Drugs', 'action' => 'view', $v->drug_id]) ?>">
                                    <?= $v->drug->name ?>
                                </a>
                                <a href="javascript:void(0)" class="close confirm" data-controller="drugs" data-action="removeFollow" data-confirm="<?= h(__('Czy na pewno chcesz cofnąć subskrypcję tego leku?')) ?>" data-id="<?= $v->drug_id ?>">
                                    <i class="fa fa-fw fa-times"></i>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li class="list-group-item text-center"><?= __('Brak śledzonych aktualizacji') ?></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div>