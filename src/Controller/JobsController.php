<?php 
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Controller\Controller;


class JobsController extends AppController {


    public $paginate = [
            'limit' => 10,
            
        ];
     public function initialize() {
        parent::initialize();
        if(!$this->request->session()->read('User.id'))
        {
                $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                $this->redirect('/login?url='.urlencode($url));
        }
        
    }
    
	public function index() {
	   
		$this->set('job', $this->paginate($this->Jobs));
	}



	public function view($id = null) {
		$this->set('disabled',1);
        $this->render('add');
	}

/**
 * Add method
 *
 * @return void
 */
	public function add() {
		$user = $this->Jobs->newEntity($this->request->data);
		if ($this->request->is('post')) {
			if ($this->Jobs->save($user)) {
				$this->Flash->success('User saved successfully.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The user could not be saved. Please try again.');
			}
		}
		$this->set(compact('user'));
        //$this->render('edit');
	}

/**
 * Edit method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function edit($id = null) {
		$user = $this->Jobs->get($id, [
			'contain' => []
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$user = $this->Jobs->patchEntity($user, $this->request->data);
			if ($this->Jobs->save($user)) {
				$this->Flash->success('User saved successfully.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The user could not be saved. Please try again.');
			}
		}
		$this->set(compact('user'));
        $this->render('add');
	}

/**
 * Delete method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function delete($id = null) {
		$user = $this->Jobs->get($id);
		$this->request->allowMethod(['post', 'delete']);
		if ($this->Jobs->delete($user)) {
			$this->Flash->success('The Job has been deleted.');
		} else {
			$this->Flash->error('Job could not be deleted. Please try again.');
		}
		return $this->redirect(['action' => 'index']);
	}
    
    function quickcontact()
    {
        
    }
    
}
