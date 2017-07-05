<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Cache\Cache;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Filter');

        $this->loadComponent('Auth', [
            'authenticate' => [
                'Form' => [
                    'fields' => [
                        'username' => 'email',
                        'password' => 'password'
                    ]
                ]
            ],
            'loginAction' => [
                'controller' => 'Users',
                'action' => 'login'
            ],
            'unauthorizedRedirect' => $this->referer() // If unauthorized, return them to page they were just on
        ]);

        if (($robots_avg = Cache::read('robots_avg', 'halfhour')) === false) {

            $this->loadModel('Robots');
            $query = $this->Robots->find('all' , [
                    'fields' => [
                        'avg' => 'ROUND(SUM(drugs) / count(id), 2)'
                    ]
                ])
            ->first();

            $robots_avg = $query->avg;
            Cache::write('robots_avg', $query->avg, 'halfhour');
        }

        if(($robots = Cache::read('robots', 'halfhour')) === false) {

            $this->loadModel('Robots');
            $query = $this->Robots->find('all' , [
                    'order' => [
                        'id' => 'DESC'
                    ], 
                    'limit' => 5
                ])
            ->toArray();

            $robots = $query;
            Cache::write('robots' , $query, 'halfhour');
        }

        $this->loadModel('Notifications');

        $newComments = $this
            ->Notifications
            ->find('all')
            ->where([
                    'Notifications.user_id' => $this->Auth->user()['id'] ?? 0, 
                    'type' => 1, 
                    'is_read' => 0
                ])
            ->contain(['comments', 'drugs'])
            ->toArray();

        $newDrugs = $this
            ->Notifications
            ->find('all')
            ->where([
                    'Notifications.user_id' => $this->Auth->user()['id'] ?? 0, 
                    'type' => 2, 
                    'is_read' => 0
                ])
            ->contain(['drugs'])
            ->toArray();            

        $this->set(compact('robots_avg', 'robots', 'newComments', 'newDrugs'));

        /*
         * Enable the following components for recommended CakePHP security settings.
         * see http://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
        //$this->loadComponent('Csrf');
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return \Cake\Network\Response|null|void
     */
    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }

    public function error($msg = '', $data = []) {
        die(json_encode([
                'error' => $msg, 
                'data' => $data
            ]));
    }

    public function success($msg = '', $data = []) {
        die(json_encode([
                'success' => $msg,
                'data' => $data
            ]));
    }

    public function data($data = []) {
        die(json_encode([
                'data' => $data
            ]));
    }       
}
