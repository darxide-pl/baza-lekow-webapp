<?php

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

class UsersController extends AppController
{

	public function register() {
		$this->viewBuilder()->setLayout('Login');
	}

	public function login() {
		$this->viewBuilder()->setLayout('Login');
		
	}

	public function remind() {
		
	}

	public function confirm() {
		
	}

	public function reset() {
		
	}

}