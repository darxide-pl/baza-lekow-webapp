<?php 

namespace App\Controller\Component;
use Cake\Controller\Component;
use Cake\ORM\TableRegistry;

class UserComponent extends Component
{

	public $components = ['Auth'];

	public function isLoged() {
		return !!$this->Auth->user()['id'];
	}

	public function isAdmin() {
		return !!$this->Auth->user()['roles_id'] === 1;
	}

}