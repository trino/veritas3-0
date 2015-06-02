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
 
    public function intialize(){
        parent::intialize();
        if(!$this->request->session()->read('Profile.id')) {
                $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                $this->redirect('/login?url='.urlencode($url));
        }
    }

	public function index() {
        //GNDN
    }
    
   function get_settings(){
       $setting = TableRegistry::get('Settings');
       $query = $setting->find();
       $l = $query->first();
       $this->response->body(($l));
       return $this->response;
       die();
   }
   
   function get_blocks($uid){
       $setting = TableRegistry::get('blocks');
       $query = $setting->find()->where(['user_id'=>$uid]);
       $l = $query->first();
       $this->response->body(($l));
       return $this->response;
       die();
   }

    function get_side($uid){
        $setting = TableRegistry::get('sidebar');
        if($uid==0) {
            $uid = TableRegistry::get('profiles')->find()->where(['super' => 1])->first()->id;
        }
        $query = $setting->find()->where(['user_id' => $uid]);
        $l = $query->first();
        $this->response->body(($l));
        return $this->response;
        die();
   }

    function changebody(){
         $class = $_POST['class'];
         if(isset($_POST['box'])) {
             $box = $_POST['box'];
         }else {
             $box = 0;
         }
         $setting = TableRegistry::get('Settings');
         $query = $setting->query();
                $query->update()
                ->set(['body' => $class,'sidebar'=>$_POST['side'],'box'=>$box])
                ->where(['id' => 1])
                ->execute();
         die();
    }
    
    function display(){
         $display = $_POST['display'];
         $setting = TableRegistry::get('Settings');
         $query = $setting->query();
                $query->update()
                ->set(['display'=>$display])
                ->where(['id' => 1])
                ->execute();
         die();
    }
    
    function change_text(){
        $setting = TableRegistry::get('Settings');
         $query = $setting->query();
                $query->update()
                ->set([
                    'client'=>$_POST['client'],
                    'document'=>$_POST['document'],
                    'profile'=>$_POST['profile'],
                    'mee'=>$_POST['mee'],

                    'clientFrench'=>$_POST['clientFrench'],
                    'documentFrench'=>$_POST['documentFrench'],
                    'profileFrench'=>$_POST['profileFrench']
                ])
                ->where(['id' => 1])
                ->execute();
        echo "1";
        die();
        //$this->redirect(['controller'=>'profiles','action'=>'edit',$this->request->session()->read("Profile.id")]);
    }

    function change_clients(){
        $setting = TableRegistry::get('Settings');
         $query = $setting->query();
                $query->update()
                ->set(['client_option'=>$_POST['client_option']])
                ->where(['id' => 1])
                ->execute();
        echo "1";
        die();
    }

    function getProSubDoc($pro_id,$doc_id){
        $sub = TableRegistry::get('Profilessubdocument');
        $query = $sub->find();
        $query->select()->where(['profile_id'=>$pro_id, 'subdoc_id'=>$doc_id]);
        $q = $query->first();
        $this->response->body($q);
        return $this->response;
    }

    function getCSubDoc($c_id,$doc_id){
        $sub = TableRegistry::get('clientssubdocument');
        $query = $sub->find();
        $query->select()->where(['client_id'=>$c_id, 'subdoc_id'=>$doc_id]);
        $q = $query->first();
        $this->response->body($q);
        return $this->response;
    }

    function getCSubDocArray($cid_array,$doc_id){
        $cids = urldecode($cid_array);
        $c_arr = explode(",", $cids);
        $c_array = [];
        foreach($c_arr as $v) {
            array_push($c_array,['client_id'=>$v]);
        }
        //var_dump($c_array);die();
        $sub = TableRegistry::get('clientssubdocument');
        $query = $sub->find();
        $query->select()->where(['subdoc_id'=>$doc_id,'OR'=>$c_array]);
        
        $q = $query->all();
        $d = 0;
        foreach($q as $c) {
            if($c->display > $d)
            $d = $c->display;
            else
            $d =$d;
        }
        
        $this->response->body($d);
        return $this->response;
    }
    
    function all_settings($uid="", $type="", $scope="", $scope_id="", $doc_id=""){

        if($type != "" || $type !="0") {
            if($type =='sidebar') {
                return $this->get_side($uid);
                die("DIDIT!");
            }elseif($type =='blocks') {
                return $this->get_blocks($uid);
            }
        }
        if($scope != "") {
            if($scope == 'profile') {
                return $this->getProSubDoc($scope_id, $doc_id);
            }elseif($scope == 'client') {
                return $this->getCSubDoc($scope_id, $doc_id);
            }
        }
        die("");
    }

    function getproductlist(){//DO NOT REMOVE CODE!!!
        $this->set('products',  TableRegistry::get('product_types')->find('all'));
        die();
    }

    public function check_client_count(){
        //$this->loadModel('Clients');
    }

    function getclienturl($uid,$type){
        $setting = TableRegistry::get('clients');
        $u = $uid;
        $l ="";
        if(!$this->request->session()->read('Profile.super')){
            $query = $setting->find()->where(['profile_id LIKE "'.$u.',%" OR profile_id LIKE "%,'.$u.',%" OR profile_id LIKE "%,'.$u.'" OR profile_id ="'.$u.'"'])->count();
            if($query>1) {
                //$l = "clients?flash";
                $l = "documents/add";
             } else {
                if($query2 = $setting->find()->where(['profile_id LIKE "'.$u.',%" OR profile_id LIKE "%,'.$u.',%" OR profile_id LIKE "%,'.$u.'" OR profile_id ="'.$u.'"'])->first())
                    $l = "documents/addorder/".$query2->id;
             }
        } else {
             $q = $setting->find()->all();
             if(count($q)>1) {
                //$l = "clients?flash";
                 $l = "documents/add";
             } else {
                $query3 = $setting->find()->first();
                if (!is_null($query3)) {
                    $l = "documents/addorder/" . $query3->id;
                }
             }
        }
         if($type=='order') {
            $url = $l;
         } else {
             $url = str_replace('addorder', 'add', $l);
         }
         $this->response->body(($url));
    return $this->response;
    }

    function check_edit_permission($uid,$pid,$cby=""){ //uid is the user requesting the permission, id is the user that will be edited
        $user_profile = TableRegistry::get('profiles');
        $query = $user_profile->find()->where(['id'=>$uid]);
        $q1 = $query->first();
        if($q1) {
            $profile = $user_profile->find()->select('profile_type')->where(['id'=>$pid]);
            $q2 = $profile->first();
            $usertype = $q1->profile_type;
            
            $settings = TableRegistry::get('sidebar');
             $setting = $settings->find()->where(['user_id'=>$uid]); 
             $setting = $setting->first();

             if($setting->profile_edit=='1'){//can edit profiles
                if($q1->super == '1' || $uid == $pid){//is a super or the attempting to edit themselves{
                    $this->response->body('1');
                    return $this->response;
                    die();
                } else {

                    if($q1->profile_type == '1' || $cby =="") { //is an admin
                        $this->response->body('1');
                        return $this->response;
                        die();
                    } else {
                        if($uid==$cby) {
                            $this->response->body('1');
                            return $this->response;
                            die();
                        } else {
                            $this->response->body('0');
                            return $this->response;
                            die();
                        }
                    }
                }
             } else {
               $this->response->body('0');
                        return $this->response;
                        die(); 
             }  
        } else {
             $this->response->body('0');
                        return $this->response;
                        die(); 
        }
    }
    
    function getallclients($uid){
        $clients = TableRegistry::get('clients');
        $qs = $clients->find()->select('id')->where(['profile_id LIKE "'.$uid.',%" OR profile_id LIKE "%,'.$uid.',%" OR profile_id LIKE "%,'.$uid.'" OR profile_id ="'.$uid.'"'])->all();
       
        $client_ids ="";
        if(count($qs)>0) {
            foreach($qs as $k=>$q) {
                if(count($qs)==$k+1) {
                    $client_ids .= $q->id;
                }else {
                    $client_ids .= $q->id . ",";
                }
            }
        }
        $this->response->body($client_ids);
        return $this->response;
    }
    
    function get_webroot(){
         $this->response->body($this->request->webroot);
        return $this->response;
    }

    function getRegistry(){//not needed
        $reg = TableRegistry::get('strings');
        $this->response->body($reg);
        return $this->response;
    }

    function fixorders(){
        $products = TableRegistry::get('order_products')->find('all');
        $table =  TableRegistry::get('orders');
        $orders = $table->find('all');

        $Data="";
        foreach($orders as $order){
            if($order->forms) {
                $max = 0;
                $newforms = array();
                $forms = explode(",", $order->forms);
                foreach($forms as $number){
                    if($number>$max){$max=$number;}
                }
                if($max<9) {
                    $isboolean = $max < 2 && count($forms) == 8;
                    $index = 0;
                    foreach ($forms as $number) {
                        $index++;
                        if ($number > 0) {
                            if ($isboolean) {
                                $newforms[] = $this->FindIterator($products, "id", $index)->number;
                            } else {
                                $newforms[] = $this->FindIterator($products, "id", $number)->number;
                            }
                        }
                    }
                    $table->query()->update()->set(['forms' => implode(",", $newforms)])->where(['id' => $order->id])->execute();
                    $Data .= "<BR>" . $order->id . " = " . $order->forms . " isbool: " . $isboolean . " newforms: " . implode(",", $newforms);
                } else {
                    $Data .= "<BR>"  . $order->id . " is valid";
                }
            } else {
                $table->query()->update()->set(['forms' => "1603,1,14,77,78,1650,1627,72"])->where(['id' => $order->id])->execute();
            }
        }
        $this->set("data", $Data);
    }

    function FindIterator($ObjectArray, $FieldName, $FieldValue){
        foreach($ObjectArray as $Object){
            if ($Object->$FieldName == $FieldValue){return $Object;}
        }
        return false;
    }

    function translate(){
        if (isset($_GET["fixorders"])){
            $this->fixorders();
            return;
        }

        $Table = TableRegistry::get('strings');
        $Page = "";
        $Language="English";
        $Data = "";
        $CRLF = "\r\n";
        $ditit=0;
        if (isset($_POST["data"])){
            $variables = explode($CRLF, $_POST["data"]);
            $CRLF="<BR>";
            foreach($variables as $line){
                if(trim($line)) {
                    $columns = explode("=", $line);
                    switch (strtolower($columns[0])){
                        case "page":
                            $Page=$columns[1];
                            if (substr($Page,-1) != "_") { $Page.="_";}
                            $Data.=$CRLF . "Page set to: " . $Page;
                            break;
                        case "language":
                            $Language=$columns[1];
                            $Data.=$CRLF . "Language set to: " . $Language;
                            break;
                        default:
                            foreach($columns as $column){
                                $column = trim($column);
                            }
                            if(count($columns)==1) {
                                $columns[1]=$columns[0];
                            }
                            $columns[0] = strtolower(str_replace(" " , "", $columns[0]));
                            $ditit++;
                            if(count($columns)==2) {
                                if($this->tablehaskey($Table, 'Name', $Page . $columns[0])){
                                    $Table->query()->update()->set([$Language =>  $columns[1]])->where(['Name' => $Page . $columns[0]])->execute();
                                    $Data .= $CRLF . $ditit . ") update " . $Page . $columns[0] . "(" . $Language . ") = " . $columns[1];
                                } else {
                                    $Table->query()->insert(['Name', $Language])->values(['Name' => $Page . $columns[0], $Language => $columns[1]])->execute();
                                    $Data .= $CRLF . $ditit . ") insert " . $Page . $columns[0] . "(" . $Language . ") = " . $columns[1];
                                }
                            } else {
                                $Table->query()->insert(['Name', 'English', 'French'])->values(['Name' => $Page . $columns[0], 'English' => $columns[1], 'French' => $columns[2]])->execute();
                                $Data.=$CRLF . $ditit . ") insert " . $Page . $columns[0] . "(English) = '" . $columns[1] . "' (French) = '" . $columns[2] . "'";
                            }
                    }
                }
            }
            if($ditit==0){
                $Data.=$CRLF . "No strings added";
            }
        }
        $this->set('language', $Language);
        $this->set('page', $Page);
        $this->set("data", $Data);
    }

    public function tablehaskey($table, $Key, $Value){
        $results = $table->find('all', array('conditions' => array($Key=>$Value)))->first();
        if ($results) { return true; }
        return false;
    }
    
    function check_client($uid,$cid) {
        $client = TableRegistry::get('clients')->find()->where(['id'=>$cid])->first();
        if(is_object($client)) {
            $p_ids = explode(',', $client->profile_id);
            if (in_array($uid, $p_ids)) {
                $this->response->body('1');
            } else {
                $this->response->body('0');
            }
        } else {
            $this->response->body('0');
        }
        return $this->response;
    }
    
    function get_fedbacks($uid)
    {
        $profile = TableRegistry::get('profiles')->find()->where(['id'=>$uid])->first();
        //echo $profile->profile_type; die();
        if($profile->profile_type=='5')
        {
            //60day form for driver
            $feedback = TableRegistry::get("60days")->find()->where(['profile_id'=>$uid])->all();
        }
        elseif($profile->profile_type=='9'|| $profile->profile_type=='12')
        {
            //30day form for employee & sales
            $feedback = TableRegistry::get("30days")->find()->where(['profile_id'=>$uid])->all();
        }
        else
            $feedback = "";
        
         $this->response->body($feedback);
         return $this->response;
        
    }
    function getclient($cid)
    {
        $client = TableRegistry::get('clients')->find()->where(['id'=>$cid])->first();
        
             $this->response->body($client->company_name);
        
        return $this->response;
    }
    function getprofile($pid)
    {
        $profile = TableRegistry::get('profiles')->find()->where(['id'=>$pid])->first();
        
             $this->response->body($profile->username);
        
        return $this->response;
    }
    
 }