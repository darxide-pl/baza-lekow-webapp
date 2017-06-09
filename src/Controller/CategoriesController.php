<?php

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

class CategoriesController extends AppController
{

	public function index() {
		
		$categories = $this->Categories->find('all', [
				'fields' => [
					'Categories.id',
					'Categories.name', 
					'drugs' => '(
						SELECT COUNT(drug_id) 
						FROM drug_category 
						WHERE category_id = Categories.id 
					)'
				]
			])
		->toArray();

		$this->set(compact('categories'));

	}

}