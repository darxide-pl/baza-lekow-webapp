<?php

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

class NotificationsController extends AppController
{

	public function markAsRead($id = NULL) {
		
		if(is_null($id)) {
			$this->error(__('Nie znaleziono powiadomienia'));
		}

		$e = $this->Notifications->findById($id)->first();

		if(is_null($e)) {
			$this->error(__('Nie znaleziono powiadomienia'));
		}

		$e->is_read = 1;

		if($this->Notifications->save($e)) {
			$this->data([
					'ok' => 1
				]);
		}

		$this->error(__('Błąd serwera'));

	}

}