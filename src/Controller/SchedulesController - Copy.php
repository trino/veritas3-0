<?php 
namespace App\Controller;


use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Controller\Controller;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;




class SchedulesController extends AppController {

    
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
	    $events = TableRegistry::get('Events');
        $event = $events->find()->where(['id'=>$id])->first();
        $this->set('event',$event);
        $this->set('isdisabled','1');
        $this->render('add');
	}


	public function add() {
	   if(isset($_POST['submit'])) {
        date_default_timezone_set('Canada/Central');
       
            foreach($_POST as $k=>$v) {
                if($k == 'date') {
                    $arr[$k] = date('Y-m-d H:i:s', strtotime(trim(str_replace("-", " ", $v)) . ":00"));
                }else {
                    $arr[$k] = $v;
                }
            }
            $events = TableRegistry::get('Events');
    	    $arr['user_id'] = $this->request->session()->read('Profile.id');
            $event = $events->newEntity($arr);
    
            if ($events->save($event)) {
                $this->Flash->success('Task saved successfully.');
            } else {
                $this->Flash->error('Error creating task. Please try again.');
            }
            return $this->redirect(['action' => 'calender']);
            
        }
	}


	public function edit($id = null) {
	    $events = TableRegistry::get('Events');
        $event = $events->find()->where(['id'=>$id])->first();
        $this->set('event',$event);
        if(isset($_POST['submit'])) {
            foreach($_POST as $k=>$v) {
                if($k!='submit') {
                    if ($k == 'date') {
                        $arr[$k] = date('Y-m-d H:i:s', strtotime(trim(str_replace("-", "", $v)) . ":00"));
                    } else {
                        $arr[$k] = $v;
                    }
                }
            }
            $events = TableRegistry::get('Events');
            
            $query2 = $events->query();
            $query2->update()
                ->set($arr)
                ->where(['id' => $id])
                ->execute();
    	        $this->Flash->success('Event saved successfully.');
                
            
            return $this->redirect(['action' => 'calender']);
            
        }
       $this->render('add');
	}


	public function delete($id = null) {
	  $event = TableRegistry::get('Events');
      $query = $event->query();
      if($query->delete()
        ->where(['id' => $id])
        ->execute())
         $this->Flash->success('Event deleted successfully.');
		return $this->redirect(['action' => 'calender']);
	}
    
    function logout() {
        $this->request->session()->delete('Profile.id');
        $this->redirect('/login');
    }
    
    function todo() {
        
    }

    function picker(){
        $this->layout= 'blank';
    }

    function calender1(){
        $this->layout= 'blank';
    }
    
    function date($date) {
        $events = TableRegistry::get('Events');
        $event = $events->find()->where(['user_id'=>$this->request->session()->read('Profile.id'),'date LIKE "'.$date.'%"'])->order(['date'])->all();
        //debug($event);
        $this->set('events', $event);
    }

    function calender() {
        $events = TableRegistry::get('Events');
        $event = $events->find()->where(['user_id'=>$this->request->session()->read('Profile.id')])->order(['date'=>'DESC'])->all();
        //debug($event);
        $this->set('events', $event);
    }
   


}
