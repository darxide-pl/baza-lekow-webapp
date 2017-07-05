<div class="c-header">
    <h2><?= __('Powiadomienia') ?></h2>
</div>

<div class="row">
	<?php if(count($notifications)):foreach($notifications as $v): ?>
		<div class="col-md-4 col-sm-6">
		    <div class="category-item z-depth-1">
		    	<a class="category-item__folder" href="<?= $this->Url->build(['controller' => 'Drugs', 'action' => 'view', $v->drug_id]) ?>" data-id="<?= $v->id ?>">
			    	<?php if($v->type == '1'): ?>
			    		<i class="fa fa-fw fa-comments"></i>
			    	<?php elseif($v->type == '2'): ?>
			    		<i class="fa fa-fw fa-flask"></i>
			    	<?php endif; ?>
		    	</a>
		    	<a href="<?= $this->Url->build(['controller' => 'Drugs', 'action' => 'view', $v->drug_id]) ?>">
		    		<?php if($v->type == '1'): ?>
		    			<span class="text-overflow">
			    			<?= $v->comment->name ?>: <?= h($v->comment->comment) ?>
		    			</span>
			        	<span class="category-item__description"><?= __('Data dodania: {0}', [$v->add_date]) ?></span >
		    		<?php elseif($v->type == '2'): ?>
			        	<?= $v->drug->name ?>
			        	<span class="category-item__description"><?= __('Aktualizacja: {0}', [$v->add_date]) ?></span >
		    		<?php endif; ?>
		    		<a data-toggle="dropdown" href="javascript:void(0)" class="category-item__menu">
		    			<i class="zmdi zmdi-more-vert"></i>
		    		</a>
		    		<ul class="dropdown-menu pull-right">
		    			<li>
		    				<a href="javascript:void(0)" class="btn-action" data-controller="notifications" data-action="delete" data-id="<?= $v->id ?>">
		    					<?= __('Usuń') ?>	
		    				</a>
		    			</li>
		    			<li>
		    				<a href="javascript:void(0)"><?= __('Usuń wszystkie') ?></a>
		    			</li>
                    </ul>
		        </a>
		    </div>
		</div>
	<?php endforeach;endif; ?>
</div>