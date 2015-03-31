<?php 
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Controller\Controller;


class QuickcontactsController extends AppController {


    public $paginate = [
            'limit' => 10,
            
        ];
     public function initialize() {
        parent::initialize();
        if(!$this->request->session()->read('Profile.id'))
        {
                $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                $this->redirect('/login?url='.urlencode($url));
        }
        
    }
    
	public function index() {
	   
	}



	public function view($id = null) {
		
		$this->set('disabled', 1);
        $this->render('add');
	}

/**
 * Add method
 *
 * @return void
 */
	public function add() {
	   
        
	}

/**
 * Edit method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function edit($id = null) {
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
	
	}
    
    function quickcontact()
    {
        
    }
    
}
