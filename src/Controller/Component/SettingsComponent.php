<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;
    use Cake\Event\Event;

class SettingsComponent extends Component
{
    function get_permission($uid)   {
        $setting = TableRegistry::get('sidebar');
         $query = $setting->find()->where(['user_id'=>$uid]);
         $l = $query->first();
         return $l;
   }
   
   function get_settings()
   {
         $settings = TableRegistry::get('settings');
         $query = $settings->find();
                 
         $l = $query->first();
         return $l;
   }
   
   function getprofilebyclient($u,$super,$cid="")
   {
        $cond = [];
        $pro_id = [];
        $clients = TableRegistry::get('clients');
        if($cid != "")
        {
           $qs = $clients->find()->select('profile_id')->where(['id'=>$cid])->first();
           if(count($qs)>0)
           {
                $p = explode("," ,$qs->profile_id);
                foreach($p as $pro)
                {
                    array_push($pro_id,$pro);
                }
                $pro_id =array_unique($pro_id);
                   
                foreach($pro_id as $pid)
                {
                     array_push($cond,['id'=>$pid]);
                }
            }
            else
            {
                  $cond = ['id >'=>'0'];
            }
            
        }
        else
        {
             if(!$super)
            {
                
                
                
                $qs = $clients->find()->select('profile_id')->where(['profile_id LIKE "'.$u.',%" OR profile_id LIKE "%,'.$u.',%" OR profile_id LIKE "%,'.$u.'" OR profile_id ="'.$u.'"'])->all();
                if(count($qs)>0)
                {
                    foreach($qs as $q)
                    {
                        
                        $p = explode("," ,$q->profile_id);
                        foreach($p as $pro)
                        {
                            array_push($pro_id,$pro);
                        }
                    }
                    //var_dump($pro_id);
                    $pro_id =array_unique($pro_id);
                   
                    foreach($pro_id as $pid)
                    {
                         array_push($cond,['id'=>$pid]);
                    }
                }
                else
                {
                    $cond = ['id >'=>'0'];
                }                
               
            }
            else
                $cond = ['id >'=>'0'];
        }
            //var_dump($cond);
        return $cond;
   }
    function getclientids($u,$super,$model="")
   {
    
        if($model!="")
            $model =$model.".";
        $cond = [];
        $pro_id = [];
         if(!$super)
         {
            
            $clients = TableRegistry::get('clients');
            $qs = $clients->find()->select('id')->where(['profile_id LIKE "'.$u.',%" OR profile_id LIKE "%,'.$u.',%" OR profile_id LIKE "%,'.$u.'" OR profile_id ="'.$u.'"'])->all();
            $pro_id = [];
            $cond = [];
            if(count($qs)>0)
            {
                foreach($qs as $q)
                {
                    
                    $p = explode("," ,$q->id);
                    foreach($p as $pro)
                    {
                        array_push($pro_id,$pro);
                    }
                }
                //var_dump($pro_id);die();
                $pro_id =array_unique($pro_id);
               
                foreach($pro_id as $pid)
                {
                     array_push($cond,[$model.'client_id'=>$pid]);
                }
            }
            else
                $cond = [$model.'id >'=>'0'];
        }
        else
            $cond = [$model.'id >'=>'0'];
      return $cond;
        
    }
    
    function getAllClientsId($uid)
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
                return $client_ids;
                
    }
    
    function getAllClientsname($uid)
    {
        $controller = $this->_registry->getController();
        $clients = TableRegistry::get('clients');
            $qs = $clients->find()->select(['company_name','id'])->where(['profile_id LIKE "'.$uid.',%" OR profile_id LIKE "%,'.$uid.',%" OR profile_id LIKE "%,'.$uid.'" OR profile_id ="'.$uid.'"'])->all();
           //debug($qs);die();
            $client_ids ="";
            if(count($qs)>0)
            {
                foreach($qs as $k=>$q)
                {
                    //var_dump($q); die();
                    if(count($qs)==$k+1)
                        $client_ids .= "<a href='".$controller->request->webroot."clients/edit/".$q->id."?view' target ='_blank'>".ucfirst($q->company_name)."</a>";
                    else
                        $client_ids .= "<a href='".$controller->request->webroot."clients/edit/".$q->id."?view' target ='_blank'>".ucfirst($q->company_name) . "</a>, ";
                }
            }
                return $client_ids;
                
    }
    
    
    function check_pro_id($id)
    {
        $profile = TableRegistry::get('profiles');
        $query = $profile->find()->select('id')->where(['id'=>$id]);
                 
         $l = $query->first();
        if(!$l)
        {
            return 1;
        }
    }
    
    function check_client_id($id)
    {
        $profile = TableRegistry::get('clients');
        $query = $profile->find()->select('id')->where(['id'=>$id]);
                 
         $l = $query->first();
        if(!$l)
        {
            return 1;
        }
    }
    
    
    function check_permission($uid,$pid)
    {
        $user_profile = TableRegistry::get('profiles');
        $query = $user_profile->find()->where(['id'=>$uid]);
        $q1 = $query->first();
        if($q1)
        {
            $profile = $user_profile->find()->where(['id'=>$pid]);
            $q2 = $profile->first();
            $usertype = $q1->profile_type;
            
            $setting = TableRegistry::get('sidebar');
             $setting = $setting->find()->where(['user_id'=>$uid]); 
             $setting = $setting->first();
             /*=================================================================================*/
             /*
             if($setting->profile_delete == '1')
             {
                if($q1->profile_type  == '1' && $q1->super == '1' && $q1->admin == '1')
                {
                    if($uid != $pid)
                    {
                        return 1;
                    }
                    else return 0;
                }
                else if(($q1->profile_type == '1' || $q1->admin == '1'))
                {
                    if($q2->profile_type!='1' && $q2->super!='1' && $q2->admin!='1')
                    {
                        if($uid != $pid)
                        {
                            return 1;
                        }
                        else return 0;
                    }
                }
                else
                {
                    if($q2->profile_type == '5')
                    {
                        return 1;
                    }
                    else return 0;
                }
             } */
             
             if($setting->profile_delete == '1')
             {
                if($q1->super == '1')
                {
                    if($uid != $pid)
                    {
                        return 1;
                    }
                    else return 0;
                }
                else if(($q1->profile_type == '2' && $q2->profile_type == '5'))
                {
                        if($uid != $pid)
                        {
                            return 1;
                        }
                        else return 0;
                }
             }
        }
        
    }
    
    function check_edit_permission($uid,$pid,$cby="")
    {
        if($uid == $pid)
        return 1;
        $user_profile = TableRegistry::get('profiles');
        $query = $user_profile->find()->where(['id'=>$uid]);
        $q1 = $query->first();
        if($q1)
        {
            $profile = $user_profile->find()->select('profile_type')->where(['id'=>$pid]);
            $q2 = $profile->first();
            $usertype = $q1->profile_type;
            
            $setting = TableRegistry::get('sidebar');
             $setting = $setting->find()->where(['user_id'=>$uid]); 
             $setting = $setting->first();
            //echo $q1->profile_type;
            //echo $q2->profile_type;die();
             /*=================================================================================*/
             
             /* only admin super admin
             if($setting->profile_edit=='1')
             {
                if($q1->super == '1' || $uid == $pid)
                {
                    return 1;
                }
                else if($q1->profile_type == '1' || $q1->admin == '1')
                {
                    if($uid == $pid)
                    {
                        return 1;
                    }
                   else if($q2->profile_type!='1' && $q2->super!='1' && $q2->admin!='1')
                    {
                        return 1;
                    }
                    else return 0;
                }
                else
                {
                    if($q2->profile_type == '5' || $uid == $pid)
                    {
                        return 1;
                    }    
                    else return 0;
                }
             } */
             
             if($setting->profile_edit=='1')
             {
                if($q1->super == '1' || $uid == $pid)
                 {
                    return 1;
                }
                else
                {
                     if($uid==$cby)
                     {
                        return 1;
                     }
                     else return 0;
                    /*if($q1->profile_type == '2')
                    {
                        if($q2->profile_type == '5' || $q2->profile_type == '7' || $q2->profile_type == '8' || $uid == $pid)
                        {
                            return 1;
                        }    
                        else return 0;
                    }*/
                } 
                
                
             }
             /*=================================================================================*/   
        }
        
    }
    
    function check_client_permission($uid,$cid)
    {
        $client_profile = TableRegistry::get('clients');
        $user_profile = TableRegistry::get('profiles');
        $query = $user_profile->find()->where(['id'=>$uid]);
        $q1 = $query->first();
        if($q1)
        {
            $profile = $user_profile->find()->where(['id'=>$uid]);
            $q2 = $profile->first();
            $usertype = $q1->profile_type;
            //$createdby = ($q1->created_by == $uid)?"1":"0";
            $client = $client_profile->find()->select('profile_id')->where(['id'=>$cid]);
            $q2 = $client->first();
            //var_dump($q2); echo $uid; die();
            $arr = explode(',',$q2->profile_id);
            if(in_array($uid,$arr) || $usertype== 1 || $q1->super == 1 || $q1->admin == 1 )
            {
                return 1;
             }
            else return 0;
            }
    }
    
        function getClientCountByProfile($uid)
       {
        $query = TableRegistry::get('Clients');
        $q = $query->find();
        $u = trim($uid);
        $q =$q->select()->where(['profile_id LIKE "'.$u.',%" OR profile_id LIKE "%,'.$u.',%" OR profile_id LIKE "%,'.$u.'" OR profile_id LIKE "'.$u.'" '])->count();
    
        return $q;
       }
    
    

}
