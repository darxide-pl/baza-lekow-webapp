<?php

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

class NotificationsController extends AppController
{

	public function index() {
		
		$this->loadComponent('User');

		if(!$this->User->isLoged()) {
			$this->Flash->error(__('Tylko dla zalogowanych'));
			return $this->redirect($this->referer());
		}

		$notifications = $this->Notifications->find('all' , [
				'conditions' => [
					'Notifications.user_id' => $this->Auth->user()['id']
				], 
				'contain' => ['Drugs', 'Comments']
			])
		->toArray();

		$this->set(compact('notifications'));

	}

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

		$this->data($result);

	}

	public function readAllDrugs() {
		
		$result = $this->Notifications->updateAll([
				'is_read' => 1
			], [
				'user_id' => $this->Auth->user()['id'], 
				'type' => 2
			]);

		$this->data($result);

	}	

	public function delete($id = NULL) {
		
		if(is_null($id)) {
			$this->error(__('Nie znaleziono powiadomienia'));
		}

		$e = $this->Notifications->findById($id)->first();

		if(is_null($e)) {
			$this->error(__('Nie znaleziono powiadomienia'));
		}

		if($e->user_id != $this->Auth->user()['id']) {
			$this->error(__('Brak uprawnień'));
		}

		$this->Notifications->delete($e);
		$this->data(['ok' => 1]);

	}

	public function deleteAll() {
		
		$result = $this->Notifications->deleteAll([
				'user_id' => $this->Auth->user()['id']
			]);

		$this->data(['ok' => 1]);

	}

}