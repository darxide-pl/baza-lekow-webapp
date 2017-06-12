<?php

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

class UsersController extends AppController
{

	public function beforeFilter(\Cake\Event\Event $event) {
		$this->Auth->allow();
	}	

	public function register() {
		$this->viewBuilder()->setLayout('Login');

		if($this->request->is(['post'])) {
			$t = $this->request->getData();

			if(!$t['email']) {
				$this->Flash->error(__('Proszę podać email'));
				return $this->redirect($this->referer());
			}

			if(!$t['password']) {
				$this->Flash->error(__('Proszę podać hasło'));
				return $this->redirect($this->referer());				
			}

			if(filter_var($t['email'], FILTER_VALIDATE_EMAIL) === FALSE) {
				$this->Flash->error(__('Proszę podać prawidłowy email'));
				return $this->redirect($this->referer());
			}

			$user = $this->Users->findByEmail($t['email'])->first();

			if(!is_null($user)) {
				$this->Flash->error(__('Istnieje już użytkownik o takim adresie email'));
				return $this->redirect($this->referer());				
			}

			$user = $this->Users->newEntity();
			$user->add_date = date('Y-m-d H:i:s');
			$user->email = $t['email'];
			$user->password = $t['password'];
			$user->is_active = 0;
			$user->activator = sha1(md5(microtime(TRUE)));
			$user->roles_id = 2;


			if($this->Users->save($user)) {

				$this->loadComponent('Email');
				$this->Email->userRegister($user);

				$this->Flash->success(__('Zostałeś zarejestrowany. Na twój adres email został wysłany link aktywacyjny.'));
			} else {
				$this->Flash->error(__('Błąd zapisu do bazy'));
			}

			return $this->redirect($this->referer());
		}

		$__view = 'register';
		$this->set(compact('__view'));
	}

	public function login() {
		$this->viewBuilder()->setLayout('Login');
		$__view = 'login';
		$this->set(compact('__view'));		
	}

	public function remind() {
		$__view = 'remind';
		$this->set(compact('__view'));		
	}

	public function confirm() {
		
	}

	public function reset() {
		
	}

	public function activate() {
		
	}

	public function logout() {
		
	}

}