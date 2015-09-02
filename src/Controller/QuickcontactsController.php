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
         $this->loadComponent('Settings');
         $this->Settings->verifylogin($this, "quickcontacts");
    }
    
	public function index() {
	   
	}



	public function view($id = null) {
		$this->set('disabled', 1);
        $this->render('add');
	}


	public function add() {
	}

	public function edit($id = null) {
		$this->render('add');
	}

	public function delete($id = null) {
	}
    
    function quickcontact()
    {
        
    }
    
}
