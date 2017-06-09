<div class="c-header">
    <h2><?= __('Lista leków') ?></h2>
</div>

<div class="card">
    <div class="action-header palette-Teal-400 bg clearfix">
        <div class="ah-label hidden-xs palette-White text">
            <?php if($this->Filter->get('category') || 
                    $this->Filter->get('substances') || 
                    $this->Filter->get('specializations') || 
                    $this->Filter->get('forms') || 
                    $this->Filter->get('treatments')): ?>
                <?= __('Aktywne filtry:') ?>

                <?php if($this->Filter->get('category')): ?>
                    <a class="btn btn-default btn-xs" href="<?= $this->Filter->link('category','') ?>">
                        <?= __('kategoria') ?>
                        <i class="zmdi zmdi-close"></i>
                    </a>
                <?php endif; ?>

                <?php if($this->Filter->get('substances')): ?>
                    <a class="btn btn-default btn-xs" href="<?= $this->Filter->link('substances','') ?>">
                        <?= __('substancje') ?>
                        <i class="zmdi zmdi-close"></i>
                    </a>
                <?php endif; ?>

                <?php if($this->Filter->get('specializations')): ?>
                    <a class="btn btn-default btn-xs" href="<?= $this->Filter->link('specializations','') ?>">
                        <?= __('specjalizacja leku') ?>
                        <i class="zmdi zmdi-close"></i>
                    </a>
                <?php endif; ?>

                <?php if($this->Filter->get('forms')): ?>
                    <a class="btn btn-default btn-xs" href="<?= $this->Filter->link('forms','') ?>">
                        <?= __('formy leku') ?>
                        <i class="zmdi zmdi-close"></i>
                    </a>
                <?php endif; ?>                

                <?php if($this->Filter->get('treatments')): ?>
                    <a class="btn btn-default btn-xs" href="<?= $this->Filter->link('treatments','') ?>">
                        <?= __('sposoby leczenia') ?>
                        <i class="zmdi zmdi-close"></i>
                    </a>
                <?php endif; ?>                   

            <?php endif; ?>
        </div>

        <form method="get">
            <div class="ah-search">
                <input name="filter[search] type="text" value="<?= h($this->Filter->get('search')) ?>" placeholder="<?= h(__('Szukaj wg nazwy')) ?>" class="ahs-input">

                <?= $this->Filter->input('category') ?>
                <?= $this->Filter->input('substances') ?>
                <?= $this->Filter->input('substances_mode') ?>
                <?= $this->Filter->input('specializations') ?>
                <?= $this->Filter->input('specializations_mode') ?>
                <?= $this->Filter->input('forms') ?>
                <?= $this->Filter->input('forms_mode') ?>
                <?= $this->Filter->input('treatments') ?>
                <?= $this->Filter->input('treatments_mode') ?>                

                <i class="ah-search-close zmdi zmdi-long-arrow-left" data-ma-action="ah-search-close"></i>
                <button type="submit" class="hidden"></button>
            </div>
        </form>

        <ul class="ah-actions actions a-alt">
            <li>
                <a href="#" class="ah-search-trigger" data-ma-action="ah-search-open">
                    <i class="zmdi zmdi-search"></i>
                </a>
            </li>
            <li class="dropdown">
                <a href="#" data-toggle="dropdown" aria-expanded="true">
                    <i class="zmdi zmdi-sort"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                    <li class="dropdown-header"><?= __('Sortowanie') ?></li>
                    <li>
                        <?= $this->Paginator->sort('last_modify' , __('Wg daty aktualizacji')) ?>
                    </li>
                    <li>
                        <?= $this->Paginator->sort('add_date' , __('Wg daty dodania')) ?>
                    </li>
                    <li>
                        <?= $this->Paginator->sort('name' , __('Wg nazwy')) ?>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#" data-toggle="modal" data-target="#filter">
                    <i class="zmdi zmdi-filter-list"></i>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="zmdi zmdi-info"></i>
                </a>
            </li>
            <li class="dropdown">
                <a href="#" data-toggle="dropdown" aria-expanded="true">
                    <i class="zmdi zmdi-more-vert"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                    <li>
                        <a href="#">Refresh</a>
                    </li>
                    <li>
                        <a href="#">Listview Settings</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>

    <div class="list-group lg-alt lg-even-black">

        <?php if(count($drugs)):foreach($drugs as $v): ?>
            <div class="list-group-item media">
                <div class="checkbox pull-left lgi-checkbox">
                    <label>
                        <input type="checkbox" value="">
                        <i class="input-helper"></i>
                    </label>
                </div>

                <div class="pull-left">
                    <div class="avatar-char palette-Light-Blue bg"><?= mb_substr($v->name[0], 0, 1) ?></div>
                </div>

                <div class="pull-right">
                    <ul class="actions">
                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown" aria-expanded="false">
                                <i class="zmdi zmdi-more-vert"></i>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-right">
                                <li>
                                    <a href="#"><?= __('Szczegóły') ?></a>
                                </li>
                                <li>
                                    <a href="#"><?= __('Komentarze') ?></a>
                                </li>
                                <li>
                                    <a href="#"><?= __('Powiadom o aktualizacji') ?></a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>

                <div class="media-body">
                    <div class="lgi-heading"><?= $v->name ?></div>
                    <small class="lgi-text">
                        <i class="zmdi zmdi-calendar-check"></i>
                        <?= $v->last_modify->i18nFormat('yLLLd') ?>
                        <?php if($v->has('categories')): ?>
                            <ul class="lgi-attrs">
                                <?php foreach($v->categories as $c): ?>
                                    <li>
                                        <a href="<?= $this->Filter->link('category' , $c->id) ?>">
                                            <?= __('Kategoria: {0}', [$c->name]) ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </small>
                </div>
            </div>
        <?php endforeach;endif; ?>
    </div>

    <ul class="pagination lg-pagination">
        <?= $this->Paginator->prev(' < '); ?>
        <?= $this->Paginator->numbers(); ?>
        <?= $this->Paginator->next(' > '); ?>
    </ul>

    <div class="p-b-25 text-center">
        <?= $this->Paginator->counter(
            'Strona {{page}} z {{pages}}, pokazuje {{current}} rekordów z {{count}}. Od {{start}} do {{end}}'
        ); ?>
    </div>
</div>

<?= $this->Element('Modal/drugs_filter') ?>