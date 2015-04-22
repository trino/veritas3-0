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
        if(!$this->request->session()->read('Profile.id')) {
            $this->redirect('/login');
        }
        
    }
	public function index() {
	   $this->loadComponent('Document');
       $this->set('doc_comp',$this->Document);
	   $this->loadModel('Clients');
        if(isset($_GET['orderflash']))
        $this->Flash->success('Order saved as draft');
        $userid=$this->request->session()->read('Profile.id');
		$setting = $this->Settings->get_permission($userid);
// debug($setting);die();
        if(isset($setting->client_list) && $setting->client_list==0) {
            $this->set('hideclient',1);
        }
        else
        $this->set('hideclient',0);
		$this->set('client', $this->paginate($this->Clients));
        $this->set('products',  TableRegistry::get('product_types')->find('all'));

        $this->set('forms',  TableRegistry::get('order_products')->find('all'));
        $this->getsubdocument_topblocks($userid);
	}

    function org_chart(){
    }
    
    function test(){
        $this->layout = 'blank';
    }
    
    function edit($slug){
        $con['title'] = $_POST['title'];
        $con['titleFrench'] = $_POST['titleFrench'];
        $con['`desc`'] = $_POST['editor1'];//die();
        $con['`descFrench`'] = $_POST['editor2'];//die();
        $pages = TableRegistry::get("contents");
        $query = $pages->query();
                    $query->update()
                    ->set($con)
                    ->where(['slug'=>$slug])
                    ->execute();
         $this->Flash->success('Page saved successfully.');
        $this->redirect('/profiles/edit/'.$this->request->session()->read('Profile.id'));
    }

    function get_content($slug){
        $content = TableRegistry::get("contents");
        //$query = $content->query();
        $l =  $content->find()->where(['slug'=>$slug])->first();
        $this->response->body(($l));
        return $this->response;
        die();

    }
    function cms($slug){
    }

    function getsubdocument_topblocks($UserID){
        $table = TableRegistry::get('order_products_topblocks');
        $query = $table->find()->select()->where(['UserID' => $UserID])->order(['ProductID' => 'asc']);
        $products = TableRegistry::get('order_products')->find('all');
        foreach($products as $product){
            $product->TopBlock = 0;
            if(is_object($this->FindIterator($query, "ProductID", $product->number))) {$product->TopBlock = 1;}
        }
        $this->set("theproductlist", $products);
    }

    function FindIterator($ObjectArray, $FieldName, $FieldValue){
        foreach($ObjectArray as $Object){
            if ($Object->$FieldName == $FieldValue){return $Object;}
        }
        return false;
    }

    function view($slug){
        $content = TableRegistry::get("contents");
        //$query = $content->query();
          $l =  $content->find()->where(['slug'=>$slug])->first();
          $this->set('content',$l);
    }
    function recent_more(){
        $this->layout = 'blank';
    }
    
    
    function test_email(){
        $this->sendEmail(array('justdoit2045@gmail.com'=>'Email tester'),array('reshma.alee@gmail.com','justdoit_2045@hotmail.com'),'Test email','<b>This is test emaikl</b>');
        die('here');
    }
    
}
