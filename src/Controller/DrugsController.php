<?php

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

class DrugsController extends AppController
{

	public function index() {
		
		$config = [];
		$config['join'] = [];
		$config['conditions'] = [];
		$config['group'] = [];

		$substances = [];

		if($this->Filter->get('category')) {
			$config['join'][] = [
				'table' => 'drug_category', 
				'alias' => 't1', 
				'type' => 'inner', 
				'conditions' => [
					't1.drug_id = Drugs.id 
					AND t1.category_id = '.(int)$this->Filter->get('category')
				]
			];
		}


		if(is_array($f = $this->Filter->get('substances'))) {
			$this->loadModel('Substances');
			foreach($f as $k => $v) {
				$config['join'][] = [
					'table' => 'drug_substance', 
					'alias' => 'fs'.(int)$k, 
					'type' => 'inner', 
					'conditions' => [
						'Drugs.id = fs'.(int)$k.'.drug_id 
							AND fs'.(int)$k.'.substance_id ='.(int)$v
					]
				];
			}

			$substances = $this->Substances->find('list' , [
					'conditions' => [
						'id IN' => $f
					]
				])
			->toArray();
		}

		if($this->Filter->get('search')) {

			$config['conditions'][] = [
				'Drugs.name LIKE' => '%'.$this->Filter->get('search').'%'
			];

			$config['group'] = ['Drugs.id'];
		}

		$drugs = $this->paginate('Drugs', [
				'contain' => [
					'Categories'
				], 
				'join' => $config['join'], 
				'conditions' => $config['conditions'], 
				'group' => $config['group']
			]);

		$this->set(compact('drugs', 'substances'));

	}

}