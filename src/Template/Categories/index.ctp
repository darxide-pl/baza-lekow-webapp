<div class="c-header">
    <h2><?= __('Kategorie leków') ?></h2>
</div>

<div class="row">
	<?php if(count($categories)):foreach($categories as $v): ?>
		<div class="col-md-4 col-sm-6">
		    <div class="category-item z-depth-1">
		    	<a class="category-item__folder" href="<?= $this->Url->build(['controller' => 'Drugs', 'action' => 'index', '?' => [
		    		'filter[category]' => $v->id
		    	]]) ?>">
		    		<i class="fa fa-fw fa-folder-o"></i>
		    		<span class="label label-warning category-item__counter">
		    			<?= $v->drugs ?>
		    		</span>
		    	</a>
		    	<a href="<?= $this->Url->build(['controller' => 'Drugs', 'action' => 'index', '?' => [
		    		'filter[category]' => $v->id
		    	]]) ?>">
		        	<?= $v->name ?>
		        </a>
		    </div>
		</div>
	<?php endforeach;endif; ?>
</div>