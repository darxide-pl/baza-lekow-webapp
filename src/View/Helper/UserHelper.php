<?php 

namespace App\View\Helper;
use Cake\View\Helper;

class UserHelper extends Helper
{

	public function isLoged() {
		return !!$this->request->session()->read('Auth.User.id');
	}

	public function isAdmin() {
		return $this->request->session()->read('Auth.User.roles_id') === 1;
	}

}