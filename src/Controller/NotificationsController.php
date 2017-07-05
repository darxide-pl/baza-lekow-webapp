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

		if($e->user_id != $this->Auth->user()['id']) {
			$this->error(__('Nie możesz oznaczyć cudzego powiadomienia jako przeczytane'));
		}

		$e->is_read = 1;

		if($this->Notifications->save($e)) {
			$this->data([
					'ok' => 1
				]);
		}

		$this->error(__('Błąd serwera'));

	}

	public function readAllComments() {
		
		$result = $this->Notifications->updateAll([
				'is_read' => 1
			], [
				'user_id' => $this->Auth->user()['id'], 
				'type' => 1
			]);

		if($result) {
			$this->data($result);
		}

		$this->error(__('Błąd serwera'));

	}

}