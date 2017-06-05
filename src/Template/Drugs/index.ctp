<div class="c-header">
    <h2><?= __('Lista leków') ?></h2>
</div>

<div class="card">
    <div class="action-header palette-Teal-400 bg clearfix">
        <div class="ah-label hidden-xs palette-White text"></div>

        <div class="ah-search">
            <input type="text" placeholder="Start typing..." class="ahs-input">

            <i class="ah-search-close zmdi zmdi-long-arrow-left" data-ma-action="ah-search-close"></i>
        </div>

        <ul class="ah-actions actions a-alt">
            <li>
                <a href="#" class="ah-search-trigger" data-ma-action="ah-search-open">
                    <i class="zmdi zmdi-search"></i>
                </a>
            </li>

            <li>
                <a href="#">
                    <i class="zmdi zmdi-time"></i>
                </a>
            </li>
            <li class="dropdown">
                <a href="#" data-toggle="dropdown" aria-expanded="true">
                    <i class="zmdi zmdi-sort"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                    <li>
                        <a href="#">Last Modified</a>
                    </li>
                    <li>
                        <a href="#">Last Edited</a>
                    </li>
                    <li>
                        <a href="#">Name</a>
                    </li>
                    <li>
                        <a href="#">Date</a>
                    </li>
                </ul>
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
                    <div class="avatar-char palette-Light-Blue bg"><?= $v->name[0] ?></div>
                </div>

                <div class="pull-right">
                    <ul class="actions">
                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown" aria-expanded="false">
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

<?php debug($v) ?>