<div class="c-header">
    <h2><?= __('Lista substancji') ?></h2>
</div>

<div class="card">
    <div class="action-header palette-Teal-400 bg clearfix">
        <div class="ah-label hidden-xs palette-White text"></div>

        <form method="get">
            <div class="ah-search">
            <input name="filter[search]" type="text" value="<?= h($this->Filter->get('search')) ?>" placeholder="<?= h(__('Szukaj wg nazwy')) ?>" class="ahs-input">            

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
                        <?= $this->Paginator->sort('name' , __('Wg nazwy')) ?>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" data-toggle="dropdown" aria-expanded="true">
                    <i class="zmdi zmdi-more-vert"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                    <li>
                        <a href="#" class="btn-action" data-controller="substances" data-action="filter_every">
                            <?= __('Pokaż leki zawierające wszystkie zaznaczone substancje') ?>    
                        </a>
                    </li>
                    <li>
                        <a href="#" class="btn-action" data-controller="substances" data-action="filter_any">
                            <?= __('Pokaż leki zawierające dowolną z zaznaczonych substancji') ?>        
                        </a>
                    </li>
                    <li>
                        <a href="#" class="btn-action" data-controller="substances" data-action="filter_exclude">
                            <?= __('Pokaż leki nie zawierające żadnej z zaznaczonych substancji') ?>    
                        </a>
                    </li>                    
                </ul>
            </li>
        </ul>
    </div>

    <div class="list-group lg-alt lg-even-black">

        <?php if(count($substances)):foreach($substances as $v): ?>
            <div class="list-group-item media">
                <div class="checkbox pull-left lgi-checkbox">
                    <label>
                        <input type="checkbox" class="__check" value="<?= $v->id ?>" />
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
                                    <a href="<?= $this->Url->build(['controller' => 'Drugs', 'action' => 'index', '?' => [
	                                	'filter[substances][]' => $v->id, 
	                                	'filter[substances_mode]' => 'every'
	                                ]]) ?>">
                                    	<?= __('Pokaż wszystkie leki z tą substancją') ?>	
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>

                <div class="media-body">
                    <div class="lgi-heading"><?= $v->name ?></div>
                    <small class="lgi-text">
                        <ul class="lgi-attrs">
                            <li>
                                <a href="<?= $this->Url->build(['controller' => 'Drugs', 'action' => 'index', '?' => [
                                	'filter[substances][]' => $v->id, 
                                	'filter[substances_mode]' => 'every'
                                ]]) ?>">
                                    <?= __('Liczba leków z tą substancją: {0}', [$v->drugs]) ?>
                                </a>
                            </li>
                        </ul>
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