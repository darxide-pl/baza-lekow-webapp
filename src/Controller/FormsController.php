<?php

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

class FormsController extends AppController
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
		
		$forms = $this->paginate('Forms' , [
				'fields' => [
					'Forms.name', 
					'Forms.id', 
					'drugs' => '(
						SELECT COUNT(drug_id) 
						FROM drug_form 
						WHERE form_id = Forms.id
					)'
				],
				'conditions' => $config['conditions']
			]);
		$this->set(compact('forms'));
	}		


}