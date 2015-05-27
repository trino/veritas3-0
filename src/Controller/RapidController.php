<?php
    namespace App\Controller;

    use App\Controller\AppController;
    use Cake\Event\Event;
    use Cake\Controller\Controller;
    use Cake\ORM\TableRegistry;
    use Cake\Network\Email\Email;
    use Cake\Controller\Component\CookieComponent;
    use Cake\Datasource\ConnectionManager;
    /*
    if ($_SERVER['SERVER_NAME'] == "localhost" || $_SERVER['SERVER_NAME'] == "127.0.0.1") {
        include_once('/subpages/api.php');
    } else {
        include_once('subpages/api.php');
    }*/

    class RapidController extends AppController
    {
        public function initialize()
        {
            parent::initialize();
            $this->loadComponent('Mailer');
            $this->loadComponent('Document');
        }

        public function index()
        {
            $this->set('uid', '0');
            $this->set('id', '0');

            $profiles = TableRegistry::get('Profiles');

            $_POST['created'] = date('Y-m-d');
            //var_dump($profile);die();

            if ($this->request->is('post')) {

                if (isset($_POST['profile_type']) && $_POST['profile_type'] == 1) {
                    $_POST['admin'] = 1;
                }

                $_POST['dob'] = $_POST['dob'];//what?
                if ($_POST['title'] == "Mr.") {
                    $_POST["gender"] = "Male";
                } else {
                    $_POST["gender"] = "Female";
                }

                $profile = $profiles->newEntity($_POST);

                $profilesToEmail = array();

                if ($profiles->save($profile)) {
                    if (!$_POST['username']) {//if no username, make one
                        $profile_id = $profile->id;
                        $_POST['username'] = "Driver_" . $profile_id;
                        $this->Update1Column("profiles", "email", $_POST['email'], "username", $_POST['username']);
                    }

                    if ($_POST['client_ids']) {
                        $client_id = explode(",", $_POST['client_ids']);
                        foreach ($client_id as $cid) {//asign to clients
                            $query = TableRegistry::get('clients');
                            $q = $query->find()->where(['id' => $cid])->first();
                            $profile_id = $q->profile_id;
                            $pros = explode(",", $profile_id);
                            $profilesToEmail = array_merge($profilesToEmail, $pros);

                            $p_ids = "";

                            array_push($pros, $profile->id);
                            $pro_id = array_unique($pros);

                            foreach ($pro_id as $k => $p) {
                                if (count($pro_id) == $k + 1) {
                                    $p_ids .= $p;
                                } else {
                                    $p_ids .= $p . ",";
                                }
                            }

                            $query->query()->update()->set(['profile_id' => $p_ids])
                                ->where(['id' => $cid])
                                ->execute();
                        }
                    }
                    //die();
                    $blocks = TableRegistry::get('Blocks');
                    $query2 = $blocks->query();
                    $query2->insert(['user_id'])
                        ->values(['user_id' => $profile->id])
                        ->execute();
                    $side = TableRegistry::get('Sidebar');
                    $query2 = $side->query();
                    $create_que = $query2->insert(['user_id'])
                        ->values(['user_id' => $profile->id])
                        ->execute();

                    $this->emaileveryone($profilesToEmail, $profile->id, $_POST);
                    return $this->redirect('/application/register.php?client=' . $_POST['client_ids'] . '&username=' . $_POST['username'] . '&userid=' . $profile->id);
                } else {
                    return $this->redirect('/application/register.php?client=' . $_POST['client_ids'] . '&error=' . $_POST['username']);
                }
            }
            die();
        }

        function days($type = "")
        {
            $train = "";
            if (isset($_POST)) {
                $_POST['created'] = date('Y-m-d');
                if ($type == '60') {
                    if (isset($_POST['train']))
                        foreach ($_POST['train'] as $k => $values) {
                            if (($k + 1) == count($_POST['train'])) {
                                $train .= $values;
                            } else
                                $train .= $values . ",";
                        }
                    $_POST['jst13'] = $train;
                }
                $path = $this->Document->getUrl();
                $modal = TableRegistry::get($type . 'days');
                $data = $modal->newEntity($_POST);
                $settings = TableRegistry::get('settings');
                $setting = $settings->find()->first();
                if ($modal->save($data)) {
                    $from = array('info@' . $path => $setting->mee);
                    $pro = TableRegistry::get('profiles')->find()->where(['id' => $_POST['profile_id']])->first();
                    $rec = TableRegistry::get('profiles')->find()->where(['id' => $pro->created_by])->first();
                    if ($rec->email) {
                        $rec_email = $rec->email;
                        $this->Mailer->sendEmail($from, $rec_email, "Survey form submitted", "The profile '" . $pro->username . "' has submitted the " . $type . "days survey. Click <a href='".LOGIN."application/".$type."days.php?p_id=".$_POST['profile_id']."&form_id=".$data->id."' target='_blank'>here</a> to view the form.");

                    }
                    return $this->redirect('/application/' . $type . "days.php?msg=success");
                } else
                    return $this->redirect('/application/' . $type . "days.php?msg=error");
                    

            }
            die();
        }

        public function emaileveryone($profilesToEmail, $ProfileID, $POST)
        {
            //   $settings = $this->Settings->get_settings();

            $Subject = "A new user just registered!";
            $Message = 'A new user just registered on ' . LOGIN . '<br><br>Name: ' . $POST["fname"] . " " . $POST["mname"] . " " . $POST["lname"] .
                "<br><br>Username: " . $POST["username"] .
                "<br /><br />Click <a href='" . LOGIN . 'profiles/view/' . $ProfileID . "'>here</a> view the profile. <br /><br /> Regards,<br /> The MEE Team";
            foreach ($profilesToEmail as $Profile) {
                $Profile = $this->getTableByAnyKey("sidebar", "user_id", $Profile);
                if (is_object($Profile) && $Profile->email_profile == 1) {
                    $Profile = $this->getTableByAnyKey("profiles", "id", $Profile->user_id)->email;
                    $this->Mailer->sendEmail("", $Profile, $Subject, $Message);
                }
            }
        }

        public function Update1Column($Table, $PrimaryKey, $PrimaryValue, $Key, $Value)
        {
            TableRegistry::get($Table)->query()->update()->set([$Key => $Value])->where([$PrimaryKey => $PrimaryValue])->execute();
        }

        public function getTableByAnyKey($Table, $Key, $Value)
        {
            return TableRegistry::get($Table)->find('all', array('conditions' => array($Key => $Value)))->first();
        }

        function cron()
        {

            $today = date('Y-m-d');
            $msg = "";
            $clients = TableRegistry::get('clients')->find('all')->where(['requalify' => '1']);
            $marr = array();
            $a = TableRegistry::get('profiles')->find()->where(['super' => '1'])->first();
            $admin_email = $a->email;
            $user_count = 0; 
            
            //debug($clients);
            //die();

            foreach ($clients as $c) {
                $pro = '';
                $msg .= "<br/><br/><strong>Client:</strong><br/>";
                $msg .= $c->company_name;
                $msg .= "<br/>";
                $message = "The users that u recruited have been re-qualified." . "</br>";
                $message .= "Re-qualified Date:" . $today . "</br>";
                $em_names = '';
                $pronames = array();
                if ($c->requalify_re == '0') {
                    $date = $c->requalify_date;
                }

                $frequency = $c->requalify_frequency;
                $forms = $c->requalify_product;
                $msg .= "Selected Forms:" . $forms . "<br/>";
                //$nxt_sec = strtotime($today)+($frequency*24*60*60*30);
                //$nxt_date = date('Y-m-d', strtotime('+'.$frequency.' months'));

                
                $p_type = '';
                $p_name = "";
                $emails = '';
                $profile_type = TableRegistry::get("profile_types")->find('all')->where(['placesorders' => 1]);
                foreach ($profile_type as $ty) {
                    $p_type .= $ty->id . ",";
                }
                $p_types = substr($p_type, 0, strlen($p_type) - 1);
                $users = explode(',', $c->profile_id);
                $rec1 = array();
                $em = array();
                $crons = TableRegistry::get('client_crons');
                $profile = TableRegistry::get('profiles')->find('all')->where(['id IN(' . $c->profile_id . ')', 'profile_type IN(' . $p_types . ')','is_hired'=>'1','requalify'=>'1'])->order('created_by');
               
                $temp ='';
                foreach ($profile as $p) {
                    //echo $p->created_by;
                    if ($c->requalify_re == '1') {
                        $date = $p->hired_date;
                    }
                    //echo $date;
                    $nxt_date = $this->getnextdate($date, $frequency);
                   
                    if ($today == $date || $today == $nxt_date) {
                            $cron_p = $crons->find()->where(['profile_id' => $p->id, 'client_id' => $c->id, 'orders_sent' => '1', 'cron_date' => $today])->first();
                            if (count($cron_p) == 0){
                                $user_count++;
                                $pro .= $p->id . ",";
                                if($temp == $p->created_by)
                                    $p_name .= $p->username . ",";
                                else
                                {
                                    if($temp!="")
                                    {
                                        
                                        array_push($pronames,$p_name);
                                        $p_name = "";
                                    }
                                     $temp = $p->created_by;
                                     $p_name .= $p->username . ",";
                                    //echo "<br/>";
                                }
                            }
                             
                         $rec = TableRegistry::get('profiles')->find()->where(['id' => $p->created_by])->first();
                         if ($rec->email) {
                            $rec_email = $rec->email;
                            array_push($em,$rec->email);
                            
                            
                        }
                        
                    }
                    

                }
                array_push($pronames,$p_name);
                //var_dump($pronames);
                $em = array_unique($em);
                $i =0;
                foreach($em as $e)
                {
                    
                    
                    $mesg =  "The profile '" . substr($pronames[$i], 0, strlen($pronames[$i]) - 1) . "' have been requalified on ".$today." .<br /><br />Click <a href='" . LOGIN ."'>here</a> to login.";
                    $this->Mailer->sendEmail("", $e, "Driver Re-qualified", $mesg);
                    $emails.= $e.",";
                    $i++;
                }
                
               //die();
                $em_names = substr($em_names, 0, strlen($em_names) - 1);
                $emails = substr($emails, 0, strlen($emails) - 1);
                $pro = substr($pro, 0, strlen($pro) - 1);
                $p_name = substr($p_name, 0, strlen($p_name) - 1);
                //$this->bulksubmit($pro,$forms,$c->id);
                $msg .= "Profiles:" . $p_name . "<br/>";
                $msg .= "Emails Sent to:" . $emails . "<br/>";
                $message .= "Recruited Profiles:" . $em_names . "</br>";
                
                if ($pro != "") {
                    
                   
                    $drivers = explode(',', $pro);
                    //$forms = $_POST['forms'];
                    $arr['forms'] = $forms;
                    $arr['order_type'] = 'REQ';
                    $arr['draft'] = 0;
                    $arr['title'] = 'order_' . date('Y-m-d H:i:s');

                    $arr['client_id'] = $c->id;
                    $arr['created'] = date('Y-m-d H:i:s');
                    //$arr['division'] = $_POST['division'];
                    //$arr['user_id'] = $this->request->session()->read('Profile.id');
                    $arr['driver'] = '';
                    $arr['order_id'] = '';

                    foreach ($drivers as $driver) {
                       
                        $arr['uploaded_for'] = $driver;
                        $ord = TableRegistry::get('orders');
                        $doc = $ord->newEntity($arr);
                        $ord->save($doc);

                        //$this->webservice('BUL', $arr['forms'], $arr['user_id'], $doc->id);
                        if ($arr['driver']) {
                            $arr['driver'] = $arr['driver'] . ',' . $driver;
                        } else {
                            $arr['driver'] = $driver;
                        }
                        if ($arr['order_id']) {
                            $arr['order_id'] = $arr['order_id'] . ',' . $doc->id;
                        } else {
                            $arr['order_id'] = $doc->id;
                        }

                        $cron['order_id'] = $doc->id;
                        $cron['profile_id'] = $driver;
                        $cron['orders_sent'] = '1';
                        $cron['cron_date'] = $today;
                        $cron['client_id'] = $c->id;

                        $s= $crons->newEntity($cron);
                        $crons->save($s);
                        unset($cron);

                    }
                    array_push($marr, $arr);
                    //var_dump($rec1); die();
                    /*foreach ($rec1 as $r) {
                        foreach($r as $user=>$email)
                            $this->Mailer->sendEmail("", $email, "Driver Re-qualified", "The profile '" . $user . "' has been requalified on ".$today." .<br /><br />Click <a href='" . LOGIN ."'>here</a> to login.");
                        //$this->Mailer->sendEmail("", $r, 'Driver(s) Re-qualified', $message);
                    }*/
                }

                unset($arr);
                unset($rec);

            }
            
            if ($user_count != 0) {
                $this->Mailer->sendEmail("", $admin_email, 'Driver Re-qualification Cron', "Cron date:".$today."</br>".$msg);
            }
           
            $this->set('profiles', $user_count);
            $this->set('arrs', $marr);
            $this->set('msg', $msg);
            $this->set('message', $message);

        }

        function getnextdate($date, $frequency)
        {
            $today = date('Y-m-d');
            $nxt_date = date('Y-m-d', strtotime($date . '+' . $frequency . ' months'));
            if (strtotime($nxt_date) < strtotime($today)) {
                $d = $this->getnextdate($nxt_date, $frequency);
            } else
                $d = $nxt_date;
            return $d;
        }

        function getcronProfiles($c_profile)
        {
            $p_type = "";
            $profile_type = TableRegistry::get("profile_types")->find('all')->where(['placesorders' => 1]);
            foreach ($profile_type as $ty) {
                $p_type .= $ty->id . ",";
            }
            $p_types = substr($p_type, 0, strlen($p_type) - 1);
            $profiles = TableRegistry::get('profiles')->find('all')->where(['id IN(' . $c_profile . ')', 'profile_type IN(' . $p_types . ')']);
            $this->response->body($profiles);
            return $this->response;
        }

        function cron_client($pid, $cid)
        {
            $r = "";
            $cronp = TableRegistry::get('client_crons')->find('all')->where(['profile_id' => $pid, 'client_id' => $cid, 'orders_sent' => '1']);
            foreach ($cronp as $c) {
                $r .= $c->cron_date . "&" . $c->order_id . ",";
            }
            $r = substr($r, 0, strlen($r) - 1);
            $this->response->body($r);
            return $this->response;
        }

    }