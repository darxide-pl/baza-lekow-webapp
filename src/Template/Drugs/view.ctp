<div class="c-header">
    <h2>
    	<?= $drug->name ?>
    	<?php if($drug->has('categories')): ?>
	    	<small><?= implode(',', array_map(function($item) {
	    			return $item->name;
	    		}, $drug->categories)) ?></small>		
	    <?php endif; ?>
    </h2>
</div>

<div class="card" id="profile-main">
    <div class="pm-overview c-overflow">
        <div class="pmo-block pmo-contact hidden-xs">
            <h2><?= __('Podsumowanie') ?></h2>
            <ul>
            	<li>
            		<i class="zmdi zmdi-calendar-check"></i> <?= __('Ostatnia aktualizacja:') ?><br>
            		<?= $drug->last_modify->i18nFormat('y/MM/dd') ?>
            	</li>
            	<li><i class="zmdi zmdi-eye"></i> <?= __('Wyświetlenia: {0}', $drug->views) ?></li>
            	<li><i class="fa fa-fw fa-flask"></i> <?= __('Substancje: {0}', $drug->has('substances') ? count($drug->substances) : 0) ?></li>
            </ul>
        </div>
    </div>

    <div class="pm-body clearfix">
        <ul class="tab-nav tn-justified">
            <li class="active waves-effect"><a href="profile-about.html"><?= __('Informacje') ?></a></li>
            <li class="waves-effect"><a href="profile-photos.html"><?= __('Komentarze') ?></a></li>
        </ul>

        <div class="pmb-block">
            <div class="pmbb-header">
                <h2><i class="zmdi zmdi-account m-r-5"></i> <?= __('Podstawowe informacje') ?></h2>

                <ul class="actions">
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown">
                            <i class="zmdi zmdi-more-vert"></i>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-right">
                            <li>
                                <a data-pmb-action="edit" href="#">Edit</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="pmbb-body p-l-30">
                <div class="pmbb-view">
                	<?php if($drug->has('categories')): ?>
	                    <dl class="dl-horizontal">
	                        <dt><?= __('Kategorie') ?></dt>
	                        <dd>
	                        	<?php foreach($drug->categories as $v): ?>
	                        		<a href="<?= $this->Url->build([
		                        		'controller' => 'Drugs', 
		                        		'action' => 'index', 
		                        		'?' => [
		                        			'filter[category]' => $v->id
		                        		]
	                        		]) ?>">
	                        			<?= $v->name ?>
	                        		</a>
	                        	<?php endforeach; ?>
	                        </dd>
	                    </dl>
	                <?php endif; ?>
	                <?php if($drug->has('substances')): ?>
	                    <dl class="dl-horizontal">
	                        <dt><?= __('Substancje') ?></dt>
	                        <dd>
	                        	<?= implode(', ', array_map(function($item) {
	                        			return $this->Html->link($item->name, [
	                        					'controller' => 'Drugs', 
	                        					'action' => 'index', 
	                        					'?' => [
	                        						'filter' => [
	                        							'substances' => [$item->id], 
	                        							'substances_mode' => 'every'
	                        						]
	                        					]
	                        				]);
	                        		}, $drug->substances)) ?>
	                        </dd>
	                    </dl>
	                <?php endif; ?>
	                <?php if($drug->has('forms')): ?>
	                	<dl class="dl-horizontal">
	                		<dt><?= __('Formy leku') ?></dt>
	                		<dd>
	                			<?= implode(', ', array_map(function($item) {
	                					return $this->Html->link($item->name , [
	                							'controller' => 'Drugs', 
	                							'action' => 'index', 
	                							'?' => [
	                								'filter' => [
	                									'forms' => [$item->id], 
	                									'forms_mode' => 'every'
	                								]
	                							]
	                						]);
	                				}, $drug->forms)) ?>
	                		</dd>
	                	</dl>
	                <?php endif; ?>
	                <?php if($drug->has('specializations')): ?>
	                	<dl class="dl-horizontal">
	                		<dt><?= __('Specjalizacje') ?></dt>
	                		<dd>
	                			<?= implode(', ', array_map(function($item) {
	                					return $this->Html->link($item->name , [
	                							'controller' => 'Drugs', 
	                							'action' => 'index', 
	                							'?' => [
	                								'filter' => [
	                									'specializations' => [$item->id], 
	                									'specializations_mode' => 'every'
	                								]
	                							]
	                						]);
	                				}, $drug->specializations)) ?>
	                		</dd>
	                	</dl>
	                <?php endif; ?>
	                <?php if($drug->has('treatments')): ?>
	                	<dl class="dl-horizontal">
	                		<dt><?= __('Działanie leku') ?></dt>
	                		<dd>
	                			<?= implode(', ', array_map(function($item) {
	                					return $this->Html->link($item->name , [
	                							'controller' => 'Drugs', 
	                							'action' => 'index', 
	                							'?' => [
	                								'filter' => [
	                									'treatments' => [$item->id], 
	                									'treatments_mode' => 'every'
	                								]
	                							]
	                						]);
	                				}, $drug->treatments)) ?>
	                		</dd>
	                	</dl>
	                <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="pmb-block">
            <div class="pmbb-header">
                <h2><i class="zmdi zmdi-equalizer m-r-5"></i> Summary</h2>
            </div>
            <div class="pmbb-body p-l-30">
                <div class="pmbb-view">
                    Sed eu est vulputate, fringilla ligula ac, maximus arcu. Donec sed felis vel magna mattis ornare ut non turpis. Sed id arcu elit. Sed nec sagittis tortor. Mauris ante urna, ornare sit amet mollis eu, aliquet ac ligula. Nullam dolor metus, suscipit ac imperdiet nec, consectetur sed ex. Sed cursus porttitor leo.
                </div>
            </div>
        </div>
    </div>
</div>