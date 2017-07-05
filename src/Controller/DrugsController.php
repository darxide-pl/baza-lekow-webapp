<?php

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

class DrugsController extends AppController
{

	public function beforeFilter(\Cake\Event\Event $event) {
		$this->Auth->allow();
	}

	public function index() {

		$config = [];
		$config['join'] = [];
		$config['conditions'] = [];
		$config['group'] = [];

		$substances = [];
		$specializations = [];
		$forms = [];
		$treatments = [];

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

		/**
		 *	FILTROWANIE WG SUBSTANCJI
		 * */
		if(is_array($f = $this->Filter->get('substances'))) {
			
			$this->loadModel('Substances');
			$config['group'] = ['Drugs.id'];

			/**
			 *	ZAWIERA WSZYSTKIE ZAZNACZONE SUBSTANCJE
			 * */
			if($this->Filter->get('substances_mode') == 'every') {
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
			}
			/**
			 *	ZAWIERA KTÓRĄKOLWIEK Z ZAZNACZONYCH SUBSTANCJI
			 * */
			if($this->Filter->get('substances_mode') == 'any') {
				$config['join'][] = [
					'table' => 'drug_substance', 
					'alias' => 'fs', 
					'type' => 'inner', 
					'conditions' => [
						'Drugs.id = fs.drug_id 
							AND fs.substance_id 
							IN ('.implode(',', array_map(function($item) {
								return (int)$item;
							}, $this->Filter->get('substances'))).')'
					]
				];				
			}

			/**
			 *	NIE ZAWIERA ŻADNEJ Z ZAZNACZONYCH SUBSTANCJI
			 * */
			if($this->Filter->get('substances_mode') == 'exclude') {
				$config['join'][] = [
					'table' => 'drug_substance', 
					'alias' => 'fs', 
					'type' => 'inner', 
					'conditions' => [
						'Drugs.id = fs.drug_id 
							AND fs.substance_id 
							NOT IN ('.implode(',', array_map(function($item) {
								return (int)$item;
							}, $this->Filter->get('substances'))).')'
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

		/**
		 *	FILTROWANIE LEKÓW WG SPECIALIZACJI
		 * */
		if(is_array($f = $this->Filter->get('specializations'))) {

			$this->loadModel('Specializations');
			$config['group'] = ['Drugs.id'];

			/**
			 *	ZAWIERAJĄ WSZYSTKIE ZAZNACZONE SPECJALIZACJE
			 * */
			if($this->Filter->get('specializations_mode') == 'every') {
				foreach($f as $k => $v) {
					$config['join'][] = [
						'table' => 'drug_specialization', 
						'alias' => 'fs1'.(int)$k, 
						'type' => 'inner', 
						'conditions' => [
							'Drugs.id = fs1'.(int)$k.'.drug_id 
								AND fs1'.(int)$k.'.specialization_id ='.(int)$v
						]
					];
				}
			}

			/**
			 *	ZAWIERA KTÓRĄKOLWIEK Z ZAZNACZONYCH SPECJALIZACJI
			 * */

			if($this->Filter->get('specializations_mode') == 'any') {
				$config['join'][] = [
					'table' => 'drug_specialization', 
					'alias' => 'fs1', 
					'type' => 'inner', 
					'conditions' => [
						'Drugs.id = fs1.drug_id 
							AND fs1.specialization_id 
							IN ('.implode(',', array_map(function($item) {
								return (int)$item;
							}, $f)).')'
					]
				];				
			}

			/**
			 *	NIE ZAWIERA ŻADNEJ Z ZAZNACZONYCH SPECJALIZACJI
			 * */
			if($this->Filter->get('specializations_mode') == 'exclude') {
				$config['join'][] = [
					'table' => 'drug_specialization', 
					'alias' => 'fs1', 
					'type' => 'inner', 
					'conditions' => [
						'Drugs.id = fs1.drug_id 
							AND fs1.specialization_id 
							NOT IN ('.implode(',', array_map(function($item) {
								return (int)$item;
							}, $f)).')'
					]
				];				
			}				

			$specializations = $this->Specializations->find('list' , [
						'conditions' => [
							'id IN' => $f
						]
					])
				->toArray();
		}

		/**
		 *	FILTROWANIE WG FORMY LEKU
		 * */
		if(is_array($f = $this->Filter->get('forms'))) {

			$this->loadModel('Forms');
			$config['group'] = ['Drugs.id'];

			/**
			 *	ZAWIERA WSZYSTKIE ZAZNACZONE FORMY LEKU
			 * */
			if($this->Filter->get('forms_mode') == 'every') {
				foreach($f as $k => $v) {
					$config['join'][] = [
						'table' => 'drug_form', 
						'alias' => 'fs2'.(int)$k, 
						'type' => 'inner', 
						'conditions' => [
							'Drugs.id = fs2'.(int)$k.'.drug_id 
								AND fs2'.(int)$k.'.form_id ='.(int)$v
						]
					];
				}
			}

			/**
			 *	ZAWIERA KTÓRĄKOLWIEK Z ZAZNACZONYCH FORM
			 * */
			if($this->Filter->get('forms_mode') == 'any') {
				$config['join'][] = [
					'table' => 'drug_form', 
					'alias' => 'fs2', 
					'type' => 'inner', 
					'conditions' => [
						'Drugs.id = fs2.drug_id 
							AND fs2.form_id 
							IN ('.implode(',', array_map(function($item) {
								return (int)$item;
							}, $f)).')'
					]
				];
			}

			/**
			 *	NIE ZAWIERA ŻADNEJ Z ZAZNACZONYCH FORM
			 * */
			if($this->Filter->get('forms_mode') == 'exclude') {
				$config['join'][] = [
					'table' => 'drug_form', 
					'alias' => 'fs2', 
					'type' => 'inner', 
					'conditions' => [
						'Drugs.id = fs2.drug_id 
							AND fs2.form_id 
							NOT IN ('.implode(',', array_map(function($item) {
								return (int)$item;
							}, $f)).')'
					]
				];					
			}

			$forms = $this->Forms->find('list' , [
					'conditions' => [
						'id IN' => $f
					]
				])
			->toArray();
		}

		/**
		 *	FILTROWANIE WG SPOSOBU DZIAŁANIA
		 * */
		if(is_array($f = $this->Filter->get('treatments'))) {

			$this->loadModel('Treatments');
			$config['group'] = ['Drugs.id'];

			/**
			 *	ZAWIERA WSZYSTKIE ZAZNACZONE SPOSOBY LECZENIA
			 * */
			if($this->Filter->get('treatments_mode') == 'every') {
				foreach($f as $k => $v) {
					$config['join'][] = [
						'table' => 'drug_treatment', 
						'alias' => 'fs3'.(int)$k, 
						'type' => 'inner', 
						'conditions' => [
							'Drugs.id = fs3'.(int)$k.'.drug_id 
								AND fs3'.(int)$k.'.treatment_id ='.(int)$v
						]
					];
				}
			}

			/**
			 *	ZAWEIERA KTÓRYKOLWIEK Z ZAZNACZONYCH SPOSOBÓW LECZENIA
			 * */
			if($this->Filter->get('treatments_mode') == 'any') {
				$config['join'][] = [
					'table' => 'drug_treatment', 
					'alias' => 'fs3', 
					'type' => 'inner', 
					'conditions' => [
						'Drugs.id = fs3.drug_id 
							AND fs3.treatment_id 
							IN ('.implode(',', array_map(function($item) {
								return (int)$item;
							}, $f)).')'
					]
				];
			}

			/**
			 *	NIE ZAWIERA ŻADNYCH Z ZAZNACZONYCH SPOSOBÓW LECZENIA
			 * */
			if($this->Filter->get('treatments_mode') == 'exclude') {
				$config['join'][] = [
					'table' => 'drug_treatment', 
					'alias' => 'fs3', 
					'type' => 'inner', 
					'conditions' => [
						'Drugs.id = fs3.drug_id 
							AND fs3.treatment_id 
							NOT IN ('.implode(',', array_map(function($item) {
								return (int)$item;
							}, $f)).')'
					]
				];					
			}			

			$treatments = $this->Treatments->find('list' , [
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

		if($this->Filter->get('tag')) {

			$config['join'][] = [
				'table' => 'drug_tag',
				'alias' => 'tag', 
				'conditions' => [
					'tag.drug_id = Drugs.id AND tag.tag_id = '.(int)$this->Filter->get('tag')
				]
			];

		}

		$this->loadComponent('User');
		$config['fields'] = [];

		if($this->User->isLoged()) {
			$config['join'][] = [
				'table' => 'drug_follow', 
				'alias' => 'follow',
				'type' => 'left', 
				'conditions' => [
					'follow.drug_id = Drugs.id AND follow.user_id = '.
					(int)$this->User->id
				]
			];

			$config['fields'] = array_merge(
					$this->Drugs->schema()->columns(), 
					['follow.user_id']
				);
		}

		$drugs = $this->paginate('Drugs', [
				'fields' => $config['fields'],
				'contain' => [
					'Categories'
				], 
				'join' => $config['join'], 
				'conditions' => $config['conditions'], 
				'group' => $config['group']
			]);

		$this->set(compact('drugs', 'substances', 'specializations', 'forms', 'treatments'));

	}

	public function view($id = NULL) {
		
		$drug = $this
			->Drugs
			->findById($id)
			->contain([
					'Substances', 
					'Categories',
					'Forms', 
					'Specializations', 
					'Treatments', 
					'Tags', 
					'Comments'
				])
			->first();

		if(is_null($drug)) {
			$this->Flash->error(__('Nie znaleziono leku'));
			return $this->redirect($this->referer());
		}

		$drug->views = $drug->views +1;
		$this->Drugs->save($drug);

		$info = TableRegistry::get('drug_description')
			->find('all' , [
					'conditions' => [
						'drug_id' => $id
					]
				])
			->toArray();

		$this->set(compact('drug', 'info'));

	}

	public function comment($id = NULL) {

		if($this->request->is(['post', 'patch', 'put'])) {
			
			$drug = $this->Drugs->findById($id)->first();

			if(is_null($drug)) {
				$this->Flash->error(__('Nie znaleziono leku'));
				return $this->redirect($this->referer());
			}

			$t = $this->request->getData();
			$this->loadModel('Comments');

			if(!strlen(trim($t['comment']))) {
				$this->Flash->error(__('Proszę podać komentarz'));
				return $this->redirect($this->referer());
			}

			if(!strlen(trim($t['name']))) {
				$this->Flash->error(__('Proszę podać imię/nick'));
				return $this->redirect($this->referer());
			}

			$comment = $this->Comments->newEntity();
			$comment->add_date = date('Y-m-d H:i:s');
			$comment->user_id = $this->Auth->user()['id'] ?? 0;
			$comment->comment = $t['comment'];
			$comment->name = $t['name'];
			$comment->drug_id = $drug->id;

			if(!$this->Comments->save($comment)) {
				$this->Flash->error(__('Nie udało się zapisać komentarza'));
			} else {
				$this->Flash->success(__('komentarz zapisano'));

				$this->loadComponent('Notification');
				$this->Notification->comment($comment);
			}

			return $this->redirect($this->referer());
		}

		return $this->redirect($this->referer());
	}

	public function follow() {
		
		$t = $this->request->getData();
		$this->loadComponent('User');

		if(!$this->User->isLoged()) {
			$this->error(__('Opcja tylko dla zarejestrowanych użytkowników'));
		}

		$this->loadModel('Follows');
		$e = $this->Follows->newEntity();
		$e->user_id = $this->User->id;
		$e->drug_id = $t['id'];

		if($this->Follows->save($e)) {
			$this->success(__('Będziesz powiadamiany o aktualizacjach tego leku'));
		}

		$this->error(__('Błąd serwera'));

	}

	public function unfollow() {
		
		$t = $this->request->getData();
		$this->loadComponent('User');

		if(!$this->User->isLoged()) {
			$this->error(__('Opcja tylko dla zarejestrowanych użytkowników'));
		}

		$this->loadModel('Follows');
		$this->Follows->deleteAll([
			'user_id' => $this->User->id,
			'drug_id' => $t['id']
		]);

		$this->success(__('Cofnięto powiadamianie o tym leku'));
	}

	public function removeFollow() {
		
		$t = $this->request->getData();
		$this->loadModel('Follows');
		$this->loadComponent('User');

		$this->Follows->deleteAll([
			'user_id' => $this->User->id, 
			'drug_id' => $t['id']
		]);

		$this->success(__('Subskrypcja została cofnięta'));

	}

}