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
		$specializations = [];

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

			$specializations = $this->Specializations->find('list' , [
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

		$this->set(compact('drugs', 'substances', 'specializations'));

	}

}