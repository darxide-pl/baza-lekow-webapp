<?php

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

class DrugsController extends AppController
{

	public function index() {

		$this->loadModel('Drugs');
		$drugs = $this->paginate('Drugs', [
				'contain' => [
					'Categories'
				]
			]);

		$this->set(compact('drugs'));

	}

}