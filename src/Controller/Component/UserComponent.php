<?php 

namespace App\Controller\Component;
use Cake\Controller\Component;
use Cake\ORM\TableRegistry;

class UserComponent extends Component
{

	private function session() {

		if(!isset($this->Auth)) {
			$this->Auth = $this->request->session()->read('Auth.User');		
		}

		return $this->Auth;
	}


	public function isLoged() {

		$this->session();

		if(!isset($this->Auth)) {
			return FALSE;
		}

		return !!$this->Auth['id'];
	}

	public function isAdmin() {

		$this->session();

		if(!isset($this->Auth)) {
			return FALSE;
		}

		return !!$this->Auth['roles_id'] === 1;
	}

	public function __get($name) {

		$this->session();
		return $this->Auth[$name] ?? NULL;
	}

}