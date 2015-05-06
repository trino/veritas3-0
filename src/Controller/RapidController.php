<?php
    namespace App\Controller;

    use App\Controller\AppController;
    use Cake\Event\Event;
    use Cake\Controller\Controller;
    use Cake\ORM\TableRegistry;
    use Cake\Network\Email\Email;
    use Cake\Controller\Component\CookieComponent;
    use Cake\Datasource\ConnectionManager;

    if ($_SERVER['SERVER_NAME'] == "localhost" || $_SERVER['SERVER_NAME'] == "127.0.0.1") {
        include_once('/subpages/api.php');
    } else {
        include_once('subpages/api.php');
    }

    class RapidController extends AppController{
        public function initialize(){
            parent::initialize();
            $this->loadComponent('Mailer');
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
                if($_POST['title'] == "Mr."){ $_POST["gender"] = "Male"; } else  { $_POST["gender"] = "Female"; }

                $profile = $profiles->newEntity($_POST);

                $profilesToEmail = array();

                if ($profiles->save($profile)) {
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
                                }else {
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
                    return $this->redirect('/application/makedriver.php?client='.$_POST['client_ids'].'&username='.$_POST['username']);
                } else {
                     return $this->redirect('/application/makedriver.php?client='.$_POST['client_ids'].'&error='.$_POST['username']);
                }
            }
            die();
        }

        public function emaileveryone($profilesToEmail, $ProfileID, $POST){
            $Subject = "A user was created with the rapid creation tool";
            $Message = '<A HREF="' . LOGIN . "profiles/view/" . $ProfileID . '">' . $POST["title"] . " " . $POST["fname"] . " " . $POST["mname"] . " " . $POST["lname"] . " (" . $POST["username"] . ") was created and can be viewed here</A>";

            foreach($profilesToEmail as $Profile){
                $Profile = $this->getTableByAnyKey("sidebar", "user_id", $Profile);
                if($Profile->email_profile == 1){
                    $Profile = $this->getTableByAnyKey("profiles", "id", $Profile->user_id)->email;
                    $this->Mailer->sendEmail("", $Profile, $Subject, $Message);
                }
            }
        }

        public function getTableByAnyKey($Table, $Key, $Value){
            return TableRegistry::get($Table)->find('all', array('conditions' => array($Key => $Value)))->first();
        }
    }