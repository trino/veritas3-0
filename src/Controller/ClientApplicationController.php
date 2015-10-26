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
        $this->loadComponent('Manager');
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
        $this->set('Manager',$this->Manager);
        $this->set('did','0');
        $this->set('doc',TableRegistry::get('subdocuments')->find()->all());
        
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
    public function getSub($id)
    {
        //echo $id;
        $client = TableRegistry::get('subdocuments')->find()->where(['id'=>$id])->first();
        $q = $client;
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
    function saveDriver()
    {
        $model = TableRegistry::get('profiles');
        $profile = $model->newEntity($_POST);
        $model->save($profile);
        echo $profile->id;
        die();
    }
    public function savedoc($cid = 0, $did = 0) {
        $this->set('doc_comp',$this->Document);
        $this->loadComponent('Mailer');
        //$this->Mailer->handleevent("documentcreatedb", array("site" => "","email" => "roy", "company_name" => "", "username" => $this->request->session()->read('Profile.username'), "id" => $did, "path" => "", "profile_type" => ""));

        $ret = $this->Document->savedoc($this->Mailer, $cid,$did);
        //$this->Mailer->handleevent("documentcreated", $ret);
        die();
    }

    public function savePrescreening() {
        $this->Document->savePrescreening();
        die;
    }

    public function savedDriverApp($document_id = 0, $cid = 0){
        $this->Document->savedDriverApp($document_id,$cid);
        die;
    }


    public function savedDriverEvaluation($document_id = 0, $cid = 0){
        $this->Document->savedDriverEvaluation($document_id,$cid);
        die();
    }

    public function savedMeeOrder($document_id = 0, $cid = 0){
        $this->Document->savedMeeOrder($document_id,$cid);
        die();
    }

    function saveEmployment($document_id = 0, $cid = 0){
        $this->Document->saveEmployment($document_id,$cid);
        die();
    }

    function saveEducation($document_id = 0, $cid = 0){
        $this->Document->saveEducation($document_id,$cid);
        die();
    }

}