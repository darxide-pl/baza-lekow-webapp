<?php

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

class DrugsController extends AppController
{

	public function index() {

		$this->loadModel('Drugs');
		
		$config = [];
		$config['join'] = [];

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

		$drugs = $this->paginate('Drugs', [
				'contain' => [
					'Categories'
				], 
				'join' => $config['join']
			]);

		$this->set(compact('drugs'));

	}

}