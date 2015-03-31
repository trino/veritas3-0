<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;



use Cake\Controller\Controller;
use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\Utility\Inflector;
use Cake\View\Exception\MissingTemplateException;
use Cake\ORM\TableRegistry;
use Cake\Network\Email\Email;

class PagesController extends AppController {
    public $paginate = [
            'limit' => 10,
            
        ];
     public function initialize() {
        parent::initialize();
        $this->loadComponent('Settings');
        if(!$this->request->session()->read('Profile.id'))
        {
            $this->redirect('/login');
        }
        
    }
	public function index() {
	   
	   $this->loadComponent('Document');
       $this->set('doc_comp',$this->Document);
	   $this->loadModel('Clients');
        if(isset($_GET['orderflash']))
        $this->Flash->success('Order saved as draft');
		$setting = $this->Settings->get_permission($this->request->session()->read('Profile.id'));
        
// debug($setting);die();
        if(isset($setting->client_list) && $setting->client_list==0)
        {
            $this->set('hideclient',1);
            
        }
        else
        $this->set('hideclient',0);
		$this->set('client', $this->paginate($this->Clients));
	}
    function org_chart()
    {
    }
    
    function test()
    {
        $this->layout = 'blank';
    }
    
    function edit($slug)
    {
        $con['title'] = $_POST['title'];
        $con['`desc`'] = $_POST['editor1'];//die();
        $pages = TableRegistry::get("contents");
        $query = $pages->query();
                    $query->update()
                    ->set($con)
                    ->where(['slug'=>$slug])
                    ->execute();
         $this->Flash->success('Page saved successfully.');
        $this->redirect('/profiles/edit/'.$this->request->session()->read('Profile.id'));
    }
    function get_content($slug)
    {
        $content = TableRegistry::get("contents");
        //$query = $content->query();
          $l =  $content->find()->where(['slug'=>$slug])->first(); 
         $this->response->body(($l));
            return $this->response;
         die();
        
    }
    function cms($slug)
    {
        
    }
    function view($slug)
    {
        $content = TableRegistry::get("contents");
        //$query = $content->query();
          $l =  $content->find()->where(['slug'=>$slug])->first();
          $this->set('content',$l);
    }
    function recent_more()
    {
        $this->layout = 'blank';
    }
    
    
    function test_email()
    {
        $this->sendEmail(array('justdoit2045@gmail.com'=>'Email tester'),array('reshma.alee@gmail.com','justdoit_2045@hotmail.com'),'Test email','<b>This is test emaikl</b>');
        die('here');
    }
    
}
