<?php

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

class SelectController extends AppController
{

	public function substances() {

        $config = [];
        $config['conditions'] = [];
        $this->loadModel('Substances');

        if(isset($_GET['term']) && isset($_GET['term']['term'])) {

            $config['conditions'][] = [
            	'name LIKE' => '%'.$_GET['term']['term'].'%' 
            ];
        }

        $list = $this->Substances->find('list' , [
                    'keyField' => 'id',
                    'valueField' => 'name',
                    'conditions' => $config['conditions'],
                    'limit' => 20
                ])
            ->toArray();

        $this->_response($list);

	}

	private function _response($list = []) {
		
        $options = [];
        if(count($list)) {
            foreach($list as $k => $v) {
                $options['results'][] = [
                    'text' => $v,
                    'id' => $k
                ];
            }
        }

        die(json_encode($options));		
	}

}