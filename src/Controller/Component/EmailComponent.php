<?php 

namespace App\Controller\Component;
use Cake\Controller\Component;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;

class EmailComponent extends Component
{
	
	public $components = ['Flash'];

	/**
	 * Set email transport
	 * @return type
	 */
	private function server() {
        Email::configTransport('baza-lekow', [
            'host' => 'dariuszm.pl',
            'port' => '587',
            'username' => 'cake@dariuszm.pl',
            'password' => 'neutrino_root',
            'className' => 'Smtp',
            'tls' => FALSE
        ]);		
	}

	/**
	 * Send confirmation link to user
	 * @param object $user instance of User entity
	 * @return Exception|null
	 */
	public function userRegister($user) {
		
		try {
			$this->server();

	        $email = new Email();
	        $email->transport('baza-lekow');
	        $email->setViewVars(['user' => $user]);

			$email
				->setTemplate('register')
				->setLayout('default')
				->setEmailFormat('html')
				->setTo($user->email)
				->setSubject(__('Potwierdzenie rejestracji w serwisie baza-lekow.dariuszm.pl'))
				->setFrom([
	            		'admin@dariuszm.pl' => 'Administrator Baza Leków'
	            	]);

	        $email->send();
			
		} catch(\Exception $e) {
			$this->Flash->error($e->getMessage());
		}
	}

	/**
	 * Send reset link to user
	 * @param object $user instance of User entity
	 * @return Exception|null
	 */
	public function userResetPassword($user) {

		try {
			
			$this->server();	

	        $email = new Email();
	        $email->transport('baza-lekow');
	        $email->setViewVars(['user' => $user]);

			$email
				->setTemplate('reset')
				->setLayout('default')
				->setEmailFormat('html')
				->setTo($user->email)
				->setSubject(__('Resetowanie hasła'))
				->setFrom([
	            		'admin@dariuszm.pl' => 'Administrator Baza Leków'
	            	]);

	        $email->send();	        
	        
		} catch (\Exception $e) {
			$this->Flash->error($e->getMessage());
		}
	}
}