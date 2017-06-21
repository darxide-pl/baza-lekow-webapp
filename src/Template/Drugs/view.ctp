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
            <li class="active waves-effect"><a href="#info" data-toggle="tab"><?= __('Informacje') ?></a></li>
            <li class="waves-effect"><a href="#comments" data-toggle="tab"><?= __('Komentarze') ?></a></li>
        </ul>

        <div class="tab-content">
        	<div id="info" class="tab-pane fade in active">
		        <div class="pmb-block">
		            <div class="pmbb-header">
		                <h2><i class="zmdi zmdi-account m-r-5"></i> <?= __('Podstawowe informacje') ?></h2>
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
			                <?php if($drug->has('tags')): ?>
			                	<dl class="dl-horizontal">
			                		<dt><?= __('Tagi') ?></dt>
			                		<dd>
			                			<?= implode(' ', array_map(function($item) {
			                					return $this->Html->link($item->name , [
			                							'controller' => 'Drugs', 
			                							'action' => 'index', 
			                							'?' => [
			                								'filter' => [
			                									'tag' => $item->id
			                								]
			                							]
			                						], [
			                							'class' => 'label label-primary'
			                						]);
			                				}, $drug->tags)) ?>
			                		</dd>
			                	</dl>
			                <?php endif; ?>
					        <?php if(count($info)):foreach($info as $v): ?>
						        <div class="pmb-block">
						            <div class="pmbb-header">
						                <h2><i class="zmdi zmdi-equalizer m-r-5"></i> <?= $v->title ?></h2>
						            </div>
						            <div class="pmbb-body p-l-30">
						                <div class="pmbb-view">
							                <?= h($v->content) ?>
						                </div>
						            </div>
						        </div>
					        <?php endforeach;endif; ?>			                
		                </div>
		            </div>
		        </div>
        	</div>
        	<div id="comments" class="tab-pane fade">
        		<div class="pmb-block">
		            <div class="pmbb-header">
		                <h2><i class="zmdi zmdi-comment-alert m-r-5"></i> <?= __('Komentarze') ?></h2>
		            </div>
		            <div class="pmbb-body p-l-30">
		                <div class="pmbb-view">
			                <?php if($drug->has('comments')):foreach($drug->comments as $v): ?>
			                	<div class="comment-item">
			                		<div class="comment-item__header">
				                		<i class="fa fa-fw fa-user"></i> <?= $v->name ?>
			                			<span class="pull-right comment-item__date">
			                				<?= $v->add_date->i18nFormat('y-MM-dd HH:mm:ss') ?>
			                			</span>
			                		</div>
			                		<div class="comment-item__text"><?= nl2br($v->comment) ?></div>
			                	</div>
			                <?php endforeach;endif; ?>
		                </div>
		            </div>        			
        		</div>
        	</div>
        </div>

    </div>
</div>