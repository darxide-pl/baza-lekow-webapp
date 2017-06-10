<?php

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

class SpecializationsController extends AppController
{

	public function beforeFilter(\Cake\Event\Event $event) {
		$this->Auth->allow();
	}

	public function index() {
		
		$config = [];
		$config['conditions'] = [];

		if($this->Filter->get('search')) {
			$config['conditions'][] = [
				'name LIKE' => '%'.$this->Filter->get('search').'%'
			];
		}
		
		$specializations = $this->paginate('Specializations' , [
				'fields' => [
					'Specializations.name', 
					'Specializations.id', 
					'drugs' => '(
						SELECT COUNT(drug_id) 
						FROM drug_specialization 
						WHERE specialization_id = Specializations.id
					)'
				],
				'conditions' => $config['conditions']
			]);
		$this->set(compact('specializations'));
	}		

}