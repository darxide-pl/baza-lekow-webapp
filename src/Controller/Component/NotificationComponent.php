<?php 

namespace App\Controller\Component;
use Cake\Controller\Component;
use Cake\ORM\TableRegistry;

class NotificationComponent extends Component
{

	public function comment(\App\Model\Entity\Comment $comment) {
		
		if(!$this->Comments) {
			$this->Comments = TableRegistry::get('comments');
		}

		if(!$this->Notifications) {
			$this->Notifications = TableRegistry::get('notifications');
		}

		$users = $this->Comments->find('all' , [
				'conditions' => [
					'user_id !='.(int)$comment->user_id, 
					'user_id != 0', 
					'drug_id' => $comment->drug_id
				], 
				'group' => ['user_id']
			])
		->toArray();

		foreach((array) $users as $v) {
			$e = $this->Notifications->newEntity();
			$e->add_date = date('Y-m-d H:i:s'); 
			$e->user_id = $v->user_id; 
			$e->drug_id = $comment->drug_id; 
			$e->type = 1;
			$e->is_read = 0;
			$e->comment_id = $comment->id;

			$this->Notifications->save($e);
		}
	}

}