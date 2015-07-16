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
       include_once('subpages/api.php');
    */

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
                    /*$rec = TableRegistry::get('profiles')->find()->where(['id' => $pro->created_by])->first();
                    if ($rec->email) {
                        $rec_email = $rec->email;
                        $this->Mailer->sendEmail($from, $rec_email, "Survey form submitted", "" . $pro->username . " has submitted the " . $type . "days survey. Click <a href='" . LOGIN . "application/" . $type . "days.php?p_id=" . $_POST['profile_id'] . "&form_id=" . $data->id . "' target='_blank'>here</a> to view the form. <br /><br />Regards,<br /> The MEE Team");

                    }*/
                    $emails = $this->getallrecruiters('26');
                    $path = LOGIN . "application/" . $type . "days.php?p_id=" . $_POST['profile_id'] . "&form_id=" . $data->id ;
                    $site = TableRegistry::get('settings')->find()->first()->mee;//, "site" => $site

                    foreach($emails as $e) {
                        //$this->Mailer->sendEmail($from, $e, "Survey form submitted", "The profile '" . $pro->username . "' has submitted the " . $type . "days survey. Click <a href='" . LOGIN . "application/" . $type . "days.php?p_id=" . $_POST['profile_id'] . "&form_id=" . $data->id . "' target='_blank'>here</a> to view the form.");
                        $this->Mailer->handleevent("surveycomplete", array("email" => $e, "username" => $pro->username, "type" => $type, "path" => $path, "site" => $site));
                    }
                    $this->Mailer->handleevent("surveycomplete", array("email" => "super", "username" => $pro->username, "type" => $type, "path" => $path, "site" => $site));
                    return $this->redirect('/application/' . $type . "days.php?msg=success");
                } else
                    return $this->redirect('/application/' . $type . "days.php?msg=error");

            }
            die();
        }

        function getallrecruiters($cid) {
            $email = array();
            $modal = TableRegistry::get('clients')->find()->where(['id'=>$cid])->first();
            $pros = $modal->profile_id;
            $profiles = TableRegistry::get('profiles')->find('all')->where(['id in('.$pros.')']);
            foreach($profiles as $p) {
                if($p->profile_type == '2' && $p->email != "") {
                    array_push($email, $p->email);
                }
            }
            return $email;
        }

        public function emaileveryone($profilesToEmail, $ProfileID, $POST) {
            //   $settings = $this->Settings->get_settings();
            $emails = array();
            foreach ($profilesToEmail as $Profile) {
                $Profile = $this->getTableByAnyKey("sidebar", "user_id", $Profile);
                if (is_object($Profile) && $Profile->email_profile == 1) {
                    $emails[] = $Profile->email;
                }
            }
            $path = LOGIN . "profiles/view/" . $ProfileID;
            $this->Mailer->handleevent("profilecreated", array("username" => $_POST['username'],"email" => $emails, "path" =>$path, "createdby" => "Application", "type" => "Applicant", "password" => "[Blank]", "id" =>  $ProfileID ));
    /*
            $Subject = "A new user just registered!";
            $Message = 'A new user just registered on ' . LOGIN . '<br><br>Name: ' . $POST["fname"] . " " . $POST["mname"] . " " . $POST["lname"] .
                "<br><br>Username: " . $POST["username"] .
                "<br /><br />Click <a href='" . LOGIN . 'profiles/view/' . $ProfileID . "'>here</a> view the profile. <br /><br />Regards,<br /> The MEE Team";
            foreach ($profilesToEmail as $Profile) {
                $Profile = $this->getTableByAnyKey("sidebar", "user_id", $Profile);
                if (is_object($Profile) && $Profile->email_profile == 1) {
                    $Profile = $Profile->email;
                    $this->Mailer->sendEmail("", $Profile, $Subject, $Message);//sendemail should never be used!
                }
            }
    */
        }

        public function Update1Column($Table, $PrimaryKey, $PrimaryValue, $Key, $Value) {
            TableRegistry::get($Table)->query()->update()->set([$Key => $Value])->where([$PrimaryKey => $PrimaryValue])->execute();
        }

        public function getTableByAnyKey($Table, $Key, $Value) {
            return TableRegistry::get($Table)->find('all', array('conditions' => array($Key => $Value)))->first();
        }

        function cron() {

            $today = date('Y-m-d');
            $msg = "";
            $clients = TableRegistry::get('clients')->find('all')->where(['requalify' => '1']);
            $marr = array();
            $a = TableRegistry::get('profiles')->find()->where(['super' => '1'])->first();
            $admin_email = $a->email;
            $user_count = 0;

            foreach ($clients as $c) {
                $pro = '';
                $msg .= "<br/><br/><strong>Client:</strong><br/>";
                $msg .= $c->company_name;
                $msg .= "<br/>";
                $message = "Your drivers have been re-qualified." . "</br>";
                $message .= "Re-qualified Date:" . $today . "</br>";
                $em_names = '';
                $pronames = array();
                $em = array();

                if ($c->requalify_re == '0') {
                    $date = $c->requalify_date;
                }

                $frequency = $c->requalify_frequency;
                $forms = $c->requalify_product;
                $fname = explode(',',$forms);
                $new_form = "";
                foreach($fname as $n)
                {
                    if($n=='1')
                        $nam = '(MVR)';
                    elseif($n=='14')
                        $nam = '(CVOR)';
                    elseif($n=='72')
                        $nam = '(DL)';
                    $new_form .=$nam.",";

                }
                $new_form = substr($new_form,0,strlen($new_form)-1);
                $msg .= "Selected Forms:" . $new_form . "<br/>";
                //$nxt_sec = strtotime($today)+($frequency*24*60*60*30);
                //$nxt_date = date('Y-m-d', strtotime('+'.$frequency.' months'));
                $epired_profile = '';
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

                $crons = TableRegistry::get('client_crons');
                $profile = TableRegistry::get('profiles')->find('all')->where(['id IN(' . $c->profile_id . ')', 'profile_type IN(' . $p_types . ')', 'is_hired' => '1', 'requalify' => '1'])->order('created_by');
                //debug($profile);
                $temp = '';
                foreach ($profile as $p) {

                    if($p->expiry_date=='')
                        $p->expiry_date = '0000-00-00';
                    //echo $p->expiry_date."<br/>" ;
                    //echo strtotime($p->expiry_date)."<br/>".time();
                    if(($p->profile_type=='5'||$p->profile_type=='7'||$p->profile_type=='8'))
                    {
                        //echo $p->id."</br>";
                        //echo $p->created_by;
                        if(strtotime($p->expiry_date) > time())
                        {
                            $epired_profile .= $p->username.",";
                        }
                        else
                        {
                            if ($c->requalify_re == '1') {
                                $date = $p->hired_date;
                            }
                            //echo $date;
                            $nxt_date = $this->getnextdate($date, $frequency);

                            if ($today == $date || $today == $nxt_date ) {

                                $cron_p = $crons->find()->where(['profile_id' => $p->id, 'client_id' => $c->id, 'orders_sent' => '1', 'cron_date' => $today])->first();
                                if (count($cron_p) == 0) {
                                    $user_count++;
                                    $pro .= $p->id . ",";
                                    if ($temp == $p->created_by)
                                        $p_name .= $p->username . ",";
                                    else {
                                        if ($temp != "") {

                                            array_push($pronames, $p_name);
                                            $p_name = "";
                                        }
                                        $temp = $p->created_by;
                                        $p_name .= $p->username . ",";
                                        //echo "<br/>";
                                    }
                                }

                                $rec = TableRegistry::get('profiles')->find()->where(['id' => $p->created_by])->first();
                                if ($rec->email)
                                {
                                    $rec_email = $rec->email;
                                    array_push($em, $rec->email);

                                }

                            }
                        }
                    }
                }
                //die();
                array_push($pronames, $p_name);
                //var_dump($pronames);
                $em = array_unique($em);
                $i = 0;
                $username = substr($pronames[$i], 0, strlen($pronames[$i]) - 1);

                //$mesg = "Profile(s): '" . substr($pronames[$i], 0, strlen($pronames[$i]) - 1) . "' have been re-qualified on " . $today . " for client: " . $c->company_name . ".<br /><br />Click <a href='" . LOGIN . "'>here</a> to login to view the reports.<br /><br />Regards,<br />The MEE Team";
                $footer="";
                //if($epired_profile!="") {
                //    $mesg .= "<br/>Expired Profiles:" . $epired_profile;
                //}

                foreach ($em as $e) {
                    $this->Mailer->handleevent("requalification", array("email" => $e, "company_name" => $c->company_name, "username" => $username, "expired" => $epired_profile));
                    //$this->Mailer->sendEmail("", $e, "Driver Re-qualified (" . $c->company_name . ")", $mesg);
                    $emails .= $e . ",";
                    $i++;
                }
                unset($em);
                $epired_profile = "";
                $p_newname = '';
                foreach ($pronames as $p) {
                    $p_newname .= $p . ",";
                }
                //die();
                $em_names = substr($em_names, 0, strlen($em_names) - 1);
                $emails = substr($emails, 0, strlen($emails) - 1);
                $pro = substr($pro, 0, strlen($pro) - 1);
                $p_name = substr($p_newname, 0, strlen($p_newname) - 1);
                //$this->bulksubmit($pro,$forms,$c->id);
                $msg .= "Profiles:" . str_replace(',,', ',', $p_name) . "<br/>";
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

                        $s = $crons->newEntity($cron);
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
                $this->Mailer->sendEmail("", $admin_email, 'Driver Re-qualification Cron', "Cron date:" . $today . "</br>" . $msg);
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

        

        function application_employment() {
            if(isset($_POST)) {
                $Client_ID = 26;//GFS
                $profile['fname']=$_POST['fname'];
                $profile['lname']=$_POST['lname'];
                $profile['mname']=$_POST['mname'];
                $profile['email']=$_POST['email'];
                $profile['phone'] = $_POST['code']."-".$_POST['phone'];
                $profile['street'] = $_POST['street'];
                $profile['country'] = $_POST['country'];
                $profile['province'] = $_POST['province'];
                $profile['city'] = $_POST['city'];
                $profile['dob'] = $_POST['doby']."-".$_POST['dobm']."-".$_POST['dobd'];
                $profile['placeofbirth'] = $_POST['placeofbirth'];
                $profile['gender'] = $_POST['gender'];
                $profile['title'] = $_POST['title'];
                $profile['postal'] = $_POST['postal'];
                $profile['hear'] = $_POST['hear'];
                $profile["profile_type"] = 0;
                $profile["driver_license_no"] = $_POST["driver_license_no"];
                $profile["driver_province"] = $_POST["driver_province"];
                $profile["expiry_date"] = $_POST["expiry_date"];

                $modal = TableRegistry::get('profiles');
                $p = $modal->newEntity($profile);
                if ($modal->save($p)) {
                    $p_id = $p->id;
                    $client= TableRegistry::get('clients');
                    $c = $client->find()->where(['id'=>$Client_ID])->first();
                    $p_ids = $c->profile_id;
                    $_POST['profile_id'] = $p_id;
                    $profile_ids = $p_ids.",".$p_id;
                    $client->query()->update()->set(['profile_id'=>$profile_ids])->where(['id'=>$Client_ID])->execute();

                    //18  GFS Application for Employment  1   application_for_employment_gfs.php  application_for_employment_gfs  1   1   GFS Demande d'emploi    0
                    $docID = $this->Document->constructdocument(0, "GFS Application for Employment", 18, $p_id, $Client_ID, 0);
                    $_POST["document_id"] = $docID;
                    $_POST["address"] = $_POST["street"] . " " . $_POST["city"] . ", " . $_POST["province"] . " " . $_POST["country"];
                    $app = TableRegistry::get('application_for_employment_gfs');

                    $application = $app->newEntity($_POST);

                    $path = $this->Document->getUrl();
                    if($app->save($application)) {
                        $emails = $this->getallrecruiters($Client_ID);//GFS
                        $path = LOGIN . "documents/view/" . $Client_ID . "/" . $docID . "?type=18";//18=document type ID
                        $site = TableRegistry::get('settings')->find()->first()->mee;//, "site" => $site
                        $this->Mailer->handleevent("newapplicant", array("email" => $emails, "app_id" => $application->id, "profile_id" => $p_id, "path" => $path, "site" => $site));

                        //foreach($emails as $e){
                            //$this->Mailer->sendEmail($from, $e, "Application for Employment", "A new applicant has applied for employment.<br><br> Please click <a href='".LOGIN."application/apply.php?form_id=".$application->id."' target='_blank'>here</a> to view the form.<br><br>Regards,<br>The MEE Team");
                       // }
                    }
                    $this->redirect('/application/index.php?form=9&user_id=' .  $p_id);//msg=success&
                }
            }
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
        

        function getcron($date)
        {
            $cron = TableRegistry::get('client_crons')->find()->where(['cron_date'=>$date]);
        }
        
        function check_status($date,$client_id,$profile_id)
        {
            $crons = TableRegistry::get('client_crons');
            $cron_p = $crons->find()->where(['profile_id' => $profile_id, 'client_id' => $client_id, 'cron_date' => $date,'manual'=>'1'])->first();
            $this->response->body(count($cron_p));
            return $this->response;
            die();   
        }
        function cron_user($date,$client_id,$profile_id)
        {
            $user_count = 0;
            $client = TableRegistry::get('clients')->find()->where(['id'=> $client_id])->first();
            $forms = $client->requalify_product;
            $profile = TableRegistry::get('profiles')->find()->where(['id'=>$profile_id])->first();
            $crons = TableRegistry::get('client_crons');
            $cron_p = $crons->find()->where(['profile_id' => $profile_id, 'client_id' => $client_id, 'orders_sent' => '1', 'cron_date' => $date])->first();
            if (count($cron_p) == 0) {
                $user_count++;
                $pro = $profile_id;
                
           

            $rec = TableRegistry::get('profiles')->find()->where(['id' => $profile->created_by])->first();
            if ($rec->email) 
            {
                $e = $rec->email;
                

            }
                    if ($profile_id != "") {

                    $drivers = explode(',', $profile_id);
                    //$forms = $_POST['forms'];
                    $arr['forms'] = $forms;
                    $arr['order_type'] = 'REQ';
                    $arr['draft'] = 0;
                    $arr['title'] = 'order_' . date('Y-m-d H:i:s');

                    $arr['client_id'] = $client_id;
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
                        $cron['cron_date'] = $date;
                        $cron['client_id'] = $client->id;
                        $cron['manual'] = 1;

                        $s = $crons->newEntity($cron);
                        $crons->save($s);
                        unset($cron);

                    }
                    $this->set('arr', $arr);
                }
                 
                $i = 0;
                $setting = TableRegistry::get('settings')->find()->first();
                
                    //$mesg = "Profile: '".$profile->username."' have been re-qualified on " . $date . " for client: " . $client->company_name . ".<br /><br />Click <a href='" . LOGIN . "'>here</a> to login to view the reports.<br /><br />Regards,<br />The MEE Team";
                    //$this->Mailer->sendEmail("", $e, "Driver Re-qualified (" . $client->company_name . ")", $mesg);//do not use sendEmail, use handleevent instead
                $this->Mailer->handleevent("requalification", array("site" => $setting->mee,"email" => $e, "username" => $profile->username, "company_name" => $client->company_name));
              
                //$a = TableRegistry::get('profiles')->find()->where(['super' => '1'])->first();
                //$admin_email = $a->email;
                //$this->Mailer->sendEmail("", $admin_email, 'Driver Re-qualification Cron', "Cron date:" . $date . "</br>" . $msg);//do not use sendEmail, use handleevent instead
                //$this->Mailer->handleevent("cronordercomplete", array("site" => $setting->mee,"email" => "super"));
            }
            $this->set('profiles', 1);
        }
    }