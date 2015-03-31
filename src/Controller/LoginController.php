<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\View\Helper\FlashHelper;
use Cake\Controller\Component\FlashComponent;
use Cake\Controller\Component\CookieComponent;
class LoginController extends AppController{
    public function initialize() {
        parent::initialize();
        $this->loadComponent('Settings');
        if($this->request->session()->read('Profile.id'))
        {
            //$this->redirect($this->referer());
            $this->redirect('/pages');
        }
        //if($this->Cookie->read('name'))
        
    }
    function index()
    {
        
        $this->loadComponent('Cookie');
        $this->Cookie->config([
    'expires' => '+10000 days',
    'httpOnly' => true
]);
        $this->layout = 'login';
       
        if($this->Cookie->read('Profile.username') && $this->Cookie->read('Profile.password'))
        {
            
            $_POST['username'] = $this->Cookie->read('Profile.username');
            $_POST['password'] = $this->Cookie->read('Profile.password');
            $_POST['name'] = $_POST['username'];
        }
        
        if(isset($_POST['name'])){
        $this->loadModel('Profiles');
        unset($_POST['submit']);
        $_POST['username'] = $_POST['name'];
        $arr['password'] = $_POST['password'];
        $_POST['password'] = md5($_POST['password']);
        unset($_POST['name']);
        if(isset($_POST['remember']))
        $arr['remember'] = 1;
        else
        $arr['remember'] = 0;
        unset($_POST['remember']);
        //die('here');
        $q = $this->Profiles->find()->where($_POST)->first();
        
        if($q)
        {
            if($arr['remember']){
            $this->Cookie->write('Profile.username', $q->username);
            $this->Cookie->write('Profile.password', $arr['password']);
            }
            
            $this->request->session()->write('Profile.id',$q->id);
            $this->request->session()->write('Profile.username',$q->username);
            $this->request->session()->write('Profile.fname',$q->fname);
            $this->request->session()->write('Profile.lname',$q->lname);
            $this->request->session()->write('Profile.isb_id',$q->isb_id);
            $this->request->session()->write('Profile.mname',$q->mname);
            $this->request->session()->write('Profile.profile_type',$q->profile_type);
            
            if(($q->admin ==1) || ($q->super==1))
            {
                $this->request->session()->write('Profile.admin',1);
                if($q->super == 1)
                $this->request->session()->write('Profile.super',1);
            }
            //$this->redirect($this->referer());

            if(isset($_GET['url']))
            $this->redirect(urldecode($_GET['url']));
            else
            $this->redirect('/pages');
        }
        else{
            $this->Flash->error('Invalid username or password.');
            $this->redirect('/login');

        }
        }else
        {
           // die();
        }
    }
} 