<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use App\Controller\AppController;



/**
 * Logos Controller
 *
 * @property App\Model\Table\LogosTable $Logos
 */
class SettingsController extends AppController {
/**
 * Index method
 *
 * @return void
 */
 
 public function intialize()
    {
        parent::intialize();
        if(!$this->request->session()->read('Profile.id'))
        {
                $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                $this->redirect('/login?url='.urlencode($url));
        }
        
    }
	public function index() {
        
     
    }
    
   function get_settings()
   {
        $setting = TableRegistry::get('Settings');
         $query = $setting->find();
                 
         $l = $query->first();
         
         $this->response->body(($l));
            return $this->response;
         die();
   }
   
   function get_blocks($uid)
   {
        $setting = TableRegistry::get('blocks');
         $query = $setting->find()->where(['user_id'=>$uid]);
                 
         $l = $query->first();
         
         $this->response->body(($l));
            return $this->response;
         die();
   }
    function get_side($uid)
   {
        $setting = TableRegistry::get('sidebar');
         $query = $setting->find()->where(['user_id'=>$uid]);
                 
         $l = $query->first();
         
         $this->response->body(($l));
            return $this->response;
         die();
   }
    function changebody()
    {
         $class = $_POST['class'];
         if(isset($_POST['box']))
            $box = $_POST['box'];
         else
            $box = 0;
         $setting = TableRegistry::get('Settings');
         $query = $setting->query();
                $query->update()
                ->set(['body' => $class,'sidebar'=>$_POST['side'],'box'=>$box])
                ->where(['id' => 1])
                ->execute();
         
         die();
    }
    
    function display()
    {
         $display = $_POST['display'];
         $setting = TableRegistry::get('Settings');
         $query = $setting->query();
                $query->update()
                ->set(['display'=>$display])
                ->where(['id' => 1])
                ->execute();
         
         die();
    }
    
    function change_text()
    {
        
        $setting = TableRegistry::get('Settings');
         $query = $setting->query();
                $query->update()
                ->set(['client'=>$_POST['client'],'document'=>$_POST['document'],'profile'=>$_POST['profile'],'mee'=>$_POST['mee']])
                ->where(['id' => 1])
                ->execute();
        echo "1";
        die();
        //$this->redirect(['controller'=>'profiles','action'=>'edit',$this->request->session()->read("Profile.id")]);
    }
    function change_clients()
    {
        $setting = TableRegistry::get('Settings');
         $query = $setting->query();
                $query->update()
                ->set(['client_option'=>$_POST['client_option']])
                ->where(['id' => 1])
                ->execute();
        echo "1";
        die();
    }
    function getProSubDoc($pro_id,$doc_id)
    {
        $sub = TableRegistry::get('Profilessubdocument');
        $query = $sub->find();
        $query->select()->where(['profile_id'=>$pro_id, 'subdoc_id'=>$doc_id]);
        $q = $query->first();
        $this->response->body($q);
        return $this->response;
    }
    function getCSubDoc($c_id,$doc_id)
    {
        $sub = TableRegistry::get('clientssubdocument');
        $query = $sub->find();
        $query->select()->where(['client_id'=>$c_id, 'subdoc_id'=>$doc_id]);
        $q = $query->first();
        $this->response->body($q);
        return $this->response;
    }
    function getCSubDocArray($cid_array,$doc_id)
    {
        $cids = urldecode($cid_array);
        $c_arr = explode(",", $cids);
        $c_array = [];
        foreach($c_arr as $v)
        {
            array_push($c_array,['client_id'=>$v]);
        }
        //var_dump($c_array);die();
        $sub = TableRegistry::get('clientssubdocument');
        $query = $sub->find();
        $query->select()->where(['subdoc_id'=>$doc_id,'OR'=>$c_array]);
        
        $q = $query->all();
        $d = 0;
        foreach($q as $c)
        {
            if($c->display > $d)
            $d = $c->display;
            else
            $d =$d;
        }
        
        $this->response->body($d);
        return $this->response;
    }
    
    function all_settings($uid="", $type="", $scope="", $scope_id="", $doc_id="")
    {

        if($type != "" || $type !="0")
        {
            if($type =='sidebar')
                return $this->get_side($uid);
            elseif($type =='blocks')
                return $this->get_blocks($uid);
        }
        if($scope != "")
        {
            if($scope == 'profile')
                return $this->getProSubDoc($scope_id,$doc_id);
            elseif($scope == 'client')
                return $this->getCSubDoc($scope_id,$doc_id);
            
        }
        die();
            
    }
    
    public function check_client_count(){
        //$this->loadModel('Clients');
        
    }
    function getclienturl($uid,$type)
    {
        $setting = TableRegistry::get('clients');
        $u = $uid;
        $l ="";
        if(!$this->request->session()->read('Profile.super')){
           
            $query = $setting->find()->where(['profile_id LIKE "'.$u.',%" OR profile_id LIKE "%,'.$u.',%" OR profile_id LIKE "%,'.$u.'" OR profile_id ="'.$u.'"'])->count();
            
            if($query>1)
             {
                //$l = "clients?flash";
                $l = "documents/add";
             }
             else
             {
                if($query2 = $setting->find()->where(['profile_id LIKE "'.$u.',%" OR profile_id LIKE "%,'.$u.',%" OR profile_id LIKE "%,'.$u.'" OR profile_id ="'.$u.'"'])->first())
                    $l = "documents/addorder/".$query2->id;
             }
        }
        else
        {
             $q = $setting->find()->all();
             if(count($q)>1)
             {
                //$l = "clients?flash";
                 $l = "documents/add";
             }
             else
             {
                $query3 = $setting->find()->first();
                if (!is_null($query3)) {
                    $l = "documents/addorder/" . $query3->id;
                }
             }
        }
         if($type=='order')
         {
            $url = $l;
         }
         else
            $url = str_replace('addorder','add',$l);
         $this->response->body(($url));
            return $this->response;
    }
    function check_edit_permission($uid,$pid,$cby=""){ //uid is the user requesting the permission, id is the user that will be edited
        $user_profile = TableRegistry::get('profiles');
        $query = $user_profile->find()->where(['id'=>$uid]);
        $q1 = $query->first();
        if($q1)
        {
            $profile = $user_profile->find()->select('profile_type')->where(['id'=>$pid]);
            $q2 = $profile->first();
            $usertype = $q1->profile_type;
            
            $settings = TableRegistry::get('sidebar');
             $setting = $settings->find()->where(['user_id'=>$uid]); 
             $setting = $setting->first();
             /*=================================================================================*/
             /*
             if($setting->profile_edit=='1')
             {
                if($q1->super == '1' || $uid == $pid)
                {
                    $this->response->body('1');
                    return $this->response;
                    die();
                }
                else if($q1->profile_type == '1' || $q1->admin == '1')
                {
                    if($uid == $pid)
                    {
                        $this->response->body('1');
                        return $this->response;
                        die();
                    }
                   else if($q2->profile_type!='1' && $q2->super!='1' && $q2->admin!='1')
                    {
                        $this->response->body('1');
                    return $this->response;
                    die();
                    }
                    else $this->response->body('0');
                    return $this->response;
                    die();;
                }
                else
                {
                    if($q2->profile_type == '5' || $uid == $pid)
                    {
                        $this->response->body('1');
                    return $this->response;
                    die();
                    }    
                    else $this->response->body('0');
                    return $this->response;
                    die();
                }
             }*/
             /*=================================================================================*/ 
             
             if($setting->profile_edit=='1')//can edit profiles
             {
                if($q1->super == '1' || $uid == $pid)//is a super or the attempting to edit themselves
                {
                    $this->response->body('1');
                    return $this->response;
                    die();
                }
                else
                {
                    /*if($q1->profile_type == '2')
                    {
                        if($q2->profile_type == '5' || $q2->profile_type == '7' || $q2->profile_type == '8' || $uid == $pid)
                        {
                            $this->response->body('1');
                            return $this->response;
                            die();
                        }    
                        else 
                        {$this->response->body('0');
                        return $this->response;
                        die();}
                    } else*/
                    
                    if($q1->profile_type == '1') { //is an admin
                        $this->response->body('1');
                        return $this->response;
                        die();
                    } 
                    else 
                    {
                        if($uid==$cby)
                        {
                            $this->response->body('1');
                            return $this->response;
                            die();
                        }
                        else
                        {   
                            $this->response->body('0');
                            return $this->response;
                            die();
                        }
                    }
                }
             }
             else
             {
               $this->response->body('0');
                        return $this->response;
                        die(); 
             }  
        }
        else
        {
             $this->response->body('0');
                        return $this->response;
                        die(); 
        }
       
        
    }
    
    function getallclients($uid)
    {
        $clients = TableRegistry::get('clients');
        $qs = $clients->find()->select('id')->where(['profile_id LIKE "'.$uid.',%" OR profile_id LIKE "%,'.$uid.',%" OR profile_id LIKE "%,'.$uid.'" OR profile_id ="'.$uid.'"'])->all();
       
        $client_ids ="";
        if(count($qs)>0)
        {
            foreach($qs as $k=>$q)
            {
                if(count($qs)==$k+1)
                    $client_ids .= $q->id;
                else
                    $client_ids .= $q->id.",";
            }
        }
             
        $this->response->body($client_ids);
        return $this->response;
    }
    
    function get_webroot()
    {
         $this->response->body($this->request->webroot);
        return $this->response;
    }
    
    
 }