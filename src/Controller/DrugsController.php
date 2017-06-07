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
		$config['conditions'] = [];
		$config['group'] = [];

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

		$this->set(compact('drugs'));

	}

}