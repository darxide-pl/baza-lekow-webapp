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

		$drugs = $this->paginate('Drugs', [
				'contain' => [
					'Categories'
				], 
				'join' => $config['join'], 
				'conditions' => $config['conditions'], 
				'group' => $config['group']
			]);

		$this->set(compact('drugs', 'substances', 'specializations', 'forms', 'treatments'));

	}

}