<?php

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

class TreatmentsController extends AppController
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
		
		$treatments = $this->paginate('Treatments' , [
				'fields' => [
					'Treatments.name', 
					'Treatments.id', 
					'drugs' => '(
						SELECT COUNT(drug_id) 
						FROM drug_treatment 
						WHERE treatment_id = Treatments.id
					)'
				],
				'conditions' => $config['conditions']
			]);
		$this->set(compact('treatments'));
	}		

}