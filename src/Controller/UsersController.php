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
		$this->viewBuilder()->setLayout('login');

        if ($this->request->is('post')) {

        	$t = $this->request->getData();
        	$user = $this->Users->findByEmail($t['email'])->first();

        	if(is_null($user)) {
        		$this->Flash->error(__('Nie znaleziono takiego użytkownika'));
        		return $this->redirect($this->referer());
        	}

        	if(!$user->is_active) {
        		$this->Flash->error(__('To konto nie zostało aktywowane. Prosimy o kliknięcie linka aktywacyjnego, który został wysłany na twój adres email'));
        		return $this->redirect($this->referer());
        	}

        	$user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                $this->Flash->success(__('Zostałeś zalogowany'));
                return $this->redirect(['controller' => 'Drugs', 'action' => 'index']);
            }
            $this->Flash->error(__('Hasło niepoprawne'));
    		return $this->redirect($this->referer());

        }

		$__view = 'login';
		$this->set(compact('__view'));		
	}

	public function remind() {

		$this->viewBuilder()->setLayout('Login');

		if($this->request->is(['post'])) {

			$t = $this->request->getData();
			$user = $this->Users->findByEmail($t['email'])->first();

			if(is_null($user)) {
				$this->Flash->error(__('Użytkownik nie istnieje'));
	    		return $this->redirect($this->referer());			
			}

			$user->reset_hash = sha1(md5(microtime(TRUE)));

			if(!$this->Users->save($user)) {
				$this->Flash->error(__('Błąd serwera'));
	    		return $this->redirect($this->referer());			
			}

			$this->loadComponent('Email');
			$this->Email->userResetPassword($user);

			$this->Flash->success(__('Na podany adres email został wysłany link do formularza resetującego hasło'));
    		return $this->redirect($this->referer());			

		}

		$__view = 'remind';
		$this->set(compact('__view'));		
	}

	public function confirm($token = '') {

		if(!$token) {
			$this->Flash->error(__('Brak tokena'));
			return $this->redirect(['controller' => 'Users', 'action' => 'login']);
		}

		$user = $this->Users->findByActivator($token)->first();

		if(is_null($user)) {
			$this->Flash->error(__('Nieprawidłowy token'));
			return $this->redirect(['controller' => 'Users', 'action' => 'login']);
		}

		$user->is_active = 1;
		if($this->Users->save($user)) {
			$this->Flash->success(__('Twoje konto zostało aktywowane. Teraz możesz się zalogować'));
		} else {
			$this->Flash->error('Błąd serwera');
		}

		return $this->redirect(['controller' => 'Users', 'action' => 'login']);
	}

	public function reset($token = '') {
		
		$this->viewBuilder()->setLayout('reset');

		if(!$token) {
			$this->Flash->error(__('Brak tokena'));
			return $this->redirect($this->referer());
		}

		$user = $this->Users->findByResetHash($token)->first();

		if(is_null($user)) {
			$this->Flash->error(__('Nieprawidłowy token'));
			return $this->redirect($this->referer());
		}

		if($this->request->is(['post'])) {

			$t = $this->request->getData();
			if(!$t['password']) {
				$this->Flash->error(__('Proszę wprowadzić hasło'));
				return $this->redirect($this->referer());
			}

			if(!$t['passwd']) {
				$this->Flash->error(__('Proszę potwierdzić hasło'));
				return $this->redirect($this->referer());
			}

			if($t['passwd'] != $t['password']) {
				$this->Flash->error(__('Podane hasła nie są takie same'));
				return $this->redirect($this->referer());				
			}

			$user->password = $t['password'];

			if($this->Users->save($user)) {
				$this->Flash->success(__('Hasło zostało zmienione. Możesz się teraz zalogować'));
				return $this->redirect(['controller' => 'Users', 'action' => 'login']);
			}

			$this->Flash->error(__('Błąd serwera'));
			return $this->redirect($this->referer());	

		}

	}

	public function logout() {
        $this->Flash->success('Zostałeś pomyślnie wylogowany.');
        return $this->redirect(['controller' => 'Users', 'action' => 'login']);		
	}

	public function followed() {
		
		$this->loadComponent('User');

		if(!$this->User->isLoged()) {
			$this->Flash->error(__('Dostęp tylko dla zalogowanych'));
		}

		$this->loadModel('Follows');
		$follows = $this->Follows->find('all' , [
				'conditions' => [
					'user_id' => $this->User->id
				],
				'contain' => ['Drugs']
			])
		->toArray();

		$this->set(compact('follows'));

	}

}