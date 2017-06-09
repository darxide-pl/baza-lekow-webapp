<?php

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

class SubstancesController extends AppController
{

	public function index() {

		$config = [];
		$config['conditions'] = [];

		if($this->Filter->get('search')) {
			$config['conditions'][] = [
				'name LIKE' => '%'.$this->Filter->get('search').'%'
			];
		}
		
		$substances = $this->paginate('Substances' , [
				'fields' => [
					'Substances.name', 
					'Substances.id', 
					'drugs' => '(
						SELECT COUNT(drug_id) 
						FROM drug_substance 
						WHERE substance_id = Substances.id
					)'
				],
				'conditions' => $config['conditions']
			]);
		$this->set(compact('substances'));
	}

}