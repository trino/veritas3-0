<?php 
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Controller\Controller;


class UsersController extends AppController {

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
	   
		$this->set('users', $this->paginate($this->Users));
	}
    public function check_client_count(){
        //$this->loadModel('Clients');
        $setting = TableRegistry::get('clients');
        $u = $this->request->session()->read('Profile.id');
        $query = $setting->find()->where(['profile_id LIKE "'.$u.'%" OR profile_id LIKE "%,'.$u.',%" OR profile_id LIKE "%,'.$u.'"']);
                 
         var_dump($query);die();
         
         $this->response->body(($l));
            return $this->response;
    }


	public function view($id = null) {
		$user = $this->Users->get($id, [ 'contain' => []]);
		$this->set('user', $user);
        $this->set('disabled', 1);
        $this->render("edit");
	}

/**
 * Add method
 *
 * @return void
 */
	public function add() {
	    $this->loadModel('Logos');
	    
        $this->set('logos', $this->paginate($this->Logos->find()->where(['secondary'=>'0'])));
        $this->set('logos1', $this->paginate($this->Logos->find()->where(['secondary'=>'1'])));
		$user = $this->Users->newEntity($this->request->data);
		if ($this->request->is('post')) {
			if ($this->Users->save($user)) {
				$this->Flash->success('User saved successfully.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The user could not be saved. Please try again.');
			}
		}
		$this->set(compact('user'));
        $this->render("edit");
	}

/**
 * Edit method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function edit($id = null) {
		$user = $this->Users->get($id, [
			'contain' => []
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$user = $this->Users->patchEntity($user, $this->request->data);
			if ($this->Users->save($user)) {
				$this->Flash->success('User saved successfully.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The user could not be saved. Please try again.');
			}
		}
		$this->set(compact('user'));
	}

/**
 * Delete method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function delete($id = null) {
		$user = $this->Users->get($id);
		$this->request->allowMethod(['post', 'delete']);
		if ($this->Users->delete($user)) {
			$this->Flash->success('The user has been deleted.');
		} else {
			$this->Flash->error('User could not be deleted. Please try again.');
		}
		return $this->redirect(['action' => 'index']);
	}
    
    function logout()
    {
        $this->request->session()->delete('User.id');
        $this->redirect('/login');
    }
    
   
    
    

}
