<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Controller\Controller;
use Cake\ORM\TableRegistry;
use Cake\Network\Email\Email;

class ClientApplicationController extends AppController {

    public $paginate = [
        'limit' => 10,
        'order' => ['id' => 'desc']
    ];

    public function initialize() {
        parent::initialize();
        $this->loadComponent('Settings');
        $this->loadComponent('Document');
        $this->loadComponent('Mailer');
        $this->loadComponent('Trans');
        $this->layout = 'application';
        $this->request->session()->write('Profile.language','English');

        //$this->Settings->verifylogin($this, "clients");
    }
    
    public function index()
    {
        $client = TableRegistry::get('clients')->find();
        $this->set('client',$client);
    }
    public function apply($id)
    {
        $sub = TableRegistry::get('client_application_sub_order')->find()->where(['sub_id IN (SELECT subdoc_id FROM clientssubdocument WHERE client_id = '.$id.' AND display_application = 1)','client_id'=>$id])->order(['display_order'=>'ASC']);
        $client = TableRegistry::get('clients')->find()->where(['id'=>$id])->first();
        $this->set('client',$client);
        $this->set('subd',$sub);
        $this->set('did','0');
        
    }
    public function getForm($id)
    {
        //echo $id;
        $client = TableRegistry::get('subdocuments')->find()->where(['id'=>$id])->first();
        $q = $client->form;
        $this->response->body($q);
            return $this->response;
            die();
    }
    function get_settings() {
            $settings = TableRegistry::get('settings');
            $query = $settings->find();

            $q = $query->first();
            $this->response->body($q);
            return $this->response;
            
        }
}