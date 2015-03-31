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

    class ProfilesController extends AppController
    {

        public $paginate = [
            'limit' => 20,
            'order' => ['id' => 'DESC'],

        ];

        public function initialize()
        {

            parent::initialize();
            $this->loadComponent('Settings');
            $this->loadComponent('Mailer');
            $this->loadComponent('Document');
            if (!$this->request->session()->read('Profile.id')) {
                $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                $this->redirect('/login?url=' . urlencode($url));
            }

        }

        function upload_img($id)
        {
            if (isset($_FILES['myfile']['name']) && $_FILES['myfile']['name']) {
                $arr = explode('.', $_FILES['myfile']['name']);
                $ext = end($arr);
                $rand = rand(100000, 999999) . '_' . rand(100000, 999999) . '.' . $ext;
                $allowed = array('jpg', 'jpeg', 'png', 'bmp', 'gif');
                $check = strtolower($ext);
                if (in_array($check, $allowed)) {
                    move_uploaded_file($_FILES['myfile']['tmp_name'], APP . '../webroot/img/profile/' . $rand);

                    unset($_POST);
                    $_POST['image'] = $rand;
                    $img = TableRegistry::get('profiles');

                    //echo $s;die();
                    $query = $img->query();
                    $query->update()
                        ->set($_POST)
                        ->where(['id' => $id])
                        ->execute();
                    echo $rand;

                } else {
                    echo "error";
                }
            }
            die();
        }

        function upload_all($id = "")
        {
            if (isset($_FILES['myfile']['name']) && $_FILES['myfile']['name']) {
                $arr = explode('.', $_FILES['myfile']['name']);
                $ext = end($arr);
                $rand = rand(100000, 999999) . '_' . rand(100000, 999999) . '.' . $ext;
                $allowed = array('jpg', 'jpeg', 'png', 'bmp', 'gif', 'pdf', 'doc', 'docx', 'csv', 'xlsx', 'xls');
                $check = strtolower($ext);
                if (in_array($check, $allowed)) {
                    move_uploaded_file($_FILES['myfile']['tmp_name'], APP . '../webroot/img/jobs/' . $rand);
                    unset($_POST);
                    /*if(isset($id)){
                   $_POST['image'] = $rand;
                   $img = TableRegistry::get('clients');

                   //echo $s;die();
                   $query = $img->query();
                           $query->update()
                           ->set($_POST)
                           ->where(['id' => $id])
                           ->execute();
                   }*/

                    echo $rand;

                } else {
                    echo "error";
                }
            }
            die();
        }

        public function settings()
        {
            $this->loadModel('Logos');
            $this->loadModel('OrderProducts');
            $this->loadModel('ProfileTypes');
            $this->loadModel("ClientTypes");
            $this->set('client_types', $this->ClientTypes->find()->all());
            $this->set('products', $this->OrderProducts->find()->all());

            $this->set('ptypes', $this->ProfileTypes->find()->all());
            $this->set('logos', $this->paginate($this->Logos->find()->where(['secondary' => '0'])));
            $this->set('logos1', $this->paginate($this->Logos->find()->where(['secondary' => '1'])));
            $this->set('logos2', $this->paginate($this->Logos->find()->where(['secondary' => '2'])));

            $this->set('provinces',  $this->LoadSubDocs());
        }


        public function products(){
            $this->set('products', TableRegistry::get('order_products')->find()->all());
            
        }


        function getdocID($ID){
            return TableRegistry::get('order_products')->find()->where(['id' => $ID])->first()->number;
        }

        public function LoadSubDocs(){
            $provinces =  TableRegistry::get('doc_provinces')->find('all');//gets me ID#s and which provinces are enabled
            //$provincelist = array("AB","BC","MB","NB","NFL","NWT","NS","NUN","ONT","PEI","QC","SK","YT");
            $subdocuments = TableRegistry::get('subdocuments')->find('all');//subdocument type list (id, title, display, form, table_name, orders, color_id)
            $table2 = TableRegistry::get('doc_provincedocs');//subdocument type and province (if found, it is enabled)

            $provinces2 = array();//needs to make a copy...
            foreach($provinces as $province){
                $province->subdocuments = array();
                foreach($subdocuments as $document){
                    $newdocid = $document->id;
                    //$province->Number = $this->getdocID($newdocid);
                    $quiz = $table2->find()->where(['ID' => $province->ID, "DocID" =>$newdocid])->first();
                    if ($quiz) { $province->subdocuments[$newdocid] = $document->title; }
                }
                $provinces2[] = $province;
            }
            $this->set('subdocuments',  $subdocuments);
            return $provinces2;
        }

        public function province(){
            if (isset($_POST['Value'])) { if (strtolower($_POST['Value']) == "true") { $Value = 1; } else { $Value = 0;}}
            $DocID = $_POST['DocID'];

            switch ($_POST["Type"]) {
                case "Province":
                    $table = TableRegistry::get("doc_provinces");
                    $Province = $_POST['Province'];
                    $quiz = $table->find()->where(['ID' => $DocID])->first();
                    if ($quiz) {//item exists, update it
                        $table->query()->update()->set([$Province => $Value])->where(['ID' => $DocID])->execute();
                    } else {//item doesn't exist, insert it
                        $table->query()->insert(['ID', $Province])->values(['ID' => $DocID, $Province => $Value])->execute();
                    }
                    echo "Success! " . $DocID . "." . $Province . " was set to " . $Value;
                    break;

                case "Document":
                    $table = TableRegistry::get("doc_provinces");
                    $quiz = $table->find()->where(['ID' => $DocID])->first();
                    if (!$quiz) {$table->query()->insert(['ID'])->values(['ID' => $DocID])->execute();}
                    $table = TableRegistry::get("doc_provincedocs");
                    if ($Value == 1) {
                        $table->query()->insert(['ID', "DocID"])->values(['ID' => $DocID, "DocID" => $_POST["SubDoc"]])->execute();
                        echo $_POST["SubDoc"] . " was enabled for " . $DocID;
                    } else {
                        $table->deleteAll(array('ID' => $DocID, 'DocID' => $_POST["SubDoc"]), false);
                        echo $_POST["SubDoc"] . " was disabled for " . $DocID;
                    }
                    break;

                case "Delete":
                    if ($this->Delete_order_products($DocID)) {
                        echo "Deleted document type: '" . $DocID . "'";
                    } else {
                        echo "Unable to delete DocIDs below 9";
                    }
                    break;
            }
            die();
        }

        public function Delete_order_products($DocID){
            if ($DocID >= 9){
                TableRegistry::get("order_products")->deleteAll(array('id' => $DocID), false);
                TableRegistry::get("doc_provinces")->deleteAll(array('ID' => $DocID), false);
                TableRegistry::get("doc_provincedocs")->deleteAll(array('DocID' => $DocID), false);
                return true;
            }
        }

        public function index()
        {
            $this->set('doc_comp', $this->Document);
            $setting = $this->Settings->get_permission($this->request->session()->read('Profile.id'));
            $u = $this->request->session()->read('Profile.id');
            $this->set('ProClients', $this->Settings);
            $super = $this->request->session()->read('Profile.super');
            $condition = $this->Settings->getprofilebyclient($u, $super);
            //var_dump($condition);die();
            if ($setting->profile_list == 0) {
                $this->Flash->error('Sorry, you don\'t have the required permissions.');
                return $this->redirect("/");
            }
            if (isset($_GET['draft']))
                $draft = 1;
            else
                $draft = 0;
            $cond = '';
            $cond = 'drafts = ' . $draft;
            if (isset($_GET['searchprofile'])) {
                $search = $_GET['searchprofile'];
                $searchs = strtolower($search);
            }

            if (isset($_GET['filter_profile_type'])) {
                $profile_type = $_GET['filter_profile_type'];
            }
            if (isset($_GET['filter_by_client'])) {
                $client = $_GET['filter_by_client'];
            }
            $querys = TableRegistry::get('Profiles');

            if (isset($_GET['searchprofile']) && $_GET['searchprofile']) {
                if ($cond == '')
                    $cond = $cond . ' (LOWER(title) LIKE "%' . $searchs . '%" OR LOWER(fname) LIKE "%' . $searchs . '%" OR LOWER(lname) LIKE "%' . $searchs . '%" OR LOWER(username) LIKE "%' . $searchs . '%" OR LOWER(address) LIKE "%' . $searchs . '%")';
                else
                    $cond = $cond . ' AND (LOWER(title) LIKE "%' . $searchs . '%" OR LOWER(fname) LIKE "%' . $searchs . '%" OR LOWER(lname) LIKE "%' . $searchs . '%" OR LOWER(username) LIKE "%' . $searchs . '%" OR LOWER(address) LIKE "%' . $searchs . '%")';
            }

            if (isset($_GET['filter_profile_type']) && $_GET['filter_profile_type']) {
                if ($cond == '')
                    $cond = $cond . ' (profile_type = "' . $profile_type . '" OR admin = "' . $profile_type . '")';

                else
                    $cond = $cond . ' AND (profile_type = "' . $profile_type . '" OR admin = "' . $profile_type . '")';
            }

            if (isset($_GET['filter_by_client']) && $_GET['filter_by_client']) {

                $sub = TableRegistry::get('Clients');
                $que = $sub->find();
                $que->select()->where(['id' => $_GET['filter_by_client']]);
                $q = $que->first();
                $profile_ids = $q->profile_id;
                if (!$profile_ids) {
                    $profile_ids = '99999999999';
                }
                if ($cond == '')
                    $cond = $cond . ' (id IN (' . $profile_ids . '))';
                else
                    $cond = $cond . ' AND (id IN (' . $profile_ids . '))';
            }
            if ($this->request->session()->read('Profile.profile_type') == '2') {
                if ($cond) {
                    //$cond = $cond . ' AND (created_by = ' . $this->request->session()->read('Profile.id') . ')';
                } else {
                    $condition['created_by'] = $this->request->session()->read('Profile.id');
                }

            }
            /*=================================================================================================== */
            if ($cond) {
                //echo $cond;die();
                $query = $querys->find();
                $query = $query->where([$cond, 'OR' => $condition, 'AND' => 'super = 0']);
            } else {
                $query = $this->Profiles->find()->where(['OR' => $condition, 'AND' => 'super = 0']);
            }
            //$this->set('profiles', $this->paginate($this->Profiles));
            //$this->set('profiles',$query);
            if (isset($search)) {
                $this->set('search_text', $search);
            }
            if (isset($profile_type)) {
                $this->set('return_profile_type', $profile_type);
            }
            if (isset($client)) {
                $this->set('return_client', $client);
            }
            //$this->render('index');

            /*old code*/

            //debug($query);die();
            $this->set('profiles', $this->appendattachments($this->paginate($query)));
        }

        /*

        function search()
        {
            $setting = $this->Settings->get_permission($this->request->session()->read('Profile.id'));

            if($setting->profile_list==0)
            {
                $this->Flash->error('Sorry, you don\'t have the required permissions.');
                    return $this->redirect("/");

            }

            $cond = '';
            if(isset($_GET['searchprofile']))
            {
                $search = $_GET['searchprofile'];
                $searchs = strtolower($search);
            }

            if(isset($_GET['filter_profile_type']))
            {
               $profile_type = $_GET['filter_profile_type'];
            }
            if(isset($_GET['filter_by_client']))
            {
               $client = $_GET['filter_by_client'];
            }
            $querys = TableRegistry::get('Profiles');

            if(isset($_GET['searchprofile']) && $_GET['searchprofile'])
            {
                if($cond == '')
                    $cond = $cond.' (LOWER(title) LIKE "%'.$searchs.'%" OR LOWER(fname) LIKE "%'.$searchs.'%" OR LOWER(lname) LIKE "%'.$searchs.'%" OR LOWER(username) LIKE "%'.$searchs.'%" OR LOWER(address) LIKE "%'.$searchs.'%")';
                else
                    $cond = $cond.' AND (LOWER(title) LIKE "%'.$searchs.'%" OR LOWER(fname) LIKE "%'.$searchs.'%" OR LOWER(lname) LIKE "%'.$searchs.'%" OR LOWER(username) LIKE "%'.$searchs.'%" OR LOWER(address) LIKE "%'.$searchs.'%")';
            }

            if(isset($_GET['filter_profile_type']) && $_GET['filter_profile_type'])
            {
                if($cond == '')
                    $cond = $cond.' (profile_type = "'.$profile_type.'" OR admin = "'.$profile_type.'")';

                else
                    $cond = $cond.' AND (profile_type = "'.$profile_type.'" OR admin = "'.$profile_type.'")';
            }

            if(isset($_GET['filter_by_client']) && $_GET['filter_by_client'])
            {

            $sub = TableRegistry::get('Clients');
            $que = $sub->find();
            $que->select()->where(['id'=>$_GET['filter_by_client']]);
            $q = $que->first();
            $profile_ids = $q->profile_id;
            if(!$profile_ids)
            {
                $profile_ids = '99999999999';
            }
                if($cond == '')
                    $cond = $cond.' (id IN ('.$profile_ids.'))';
                else
                    $cond = $cond.' AND (id IN ('.$profile_ids.'))';
            }

            /*===================================================================================================
           if($cond)
            {
                $query = $querys->find();
                $query = $query->where([$cond]);
            }
            $this->set('profiles', $this->paginate($this->Profiles));
            $this->set('profiles',$query);
            if(isset($search))
            {
                $this->set('search_text',$search);
            }
            if(isset($profile_type))
            {
                $this->set('return_profile_type',$profile_type);
            }
            if(isset($client))
            {
                $this->set('return_client',$client);
            }
            $this->render('index');
        }

        */
        function removefiles($file)
        {
            if (isset($_POST['id']) && $_POST['id'] != 0) {
                $this->loadModel("ProfileDocs");
                $this->ProfileDocs->deleteAll(['id' => $_POST['id']]);

            }
            @unlink(WWW_ROOT . "img/jobs/" . $file);
            die();
        }

        public function view($id = null)
        {
            if (isset($_GET['success'])) {
                $this->Flash->success('Order saved successfully');
            }
            $this->loadModel("ProfileTypes");
            $this->set("ptypes", $this->ProfileTypes->find()->where(['enable' => '1'])->all());
            $this->set('uid', $id);
            $this->set('doc_comp', $this->Document);
            $setting = $this->Settings->get_permission($this->request->session()->read('Profile.id'));

            if ($setting->profile_list == 0) {
                $this->Flash->error('Sorry, you don\'t have the required permissions.');
                return $this->redirect("/");

            }
            $docs = TableRegistry::get('profile_docs');
            $query = $docs->find();
            $client_docs = $query->select()->where(['profile_id' => $id])->all();
            $this->set('client_docs', $client_docs);
            $this->loadModel('Logos');

            $this->set('logos', $this->paginate($this->Logos->find()->where(['secondary' => '0'])));
            $this->set('logos1', $this->paginate($this->Logos->find()->where(['secondary' => '1'])));
            $profile = $this->Profiles->get($id, ['contain' => []]);
            
            $this->set('doc_comp', $this->Document);
            $orders = TableRegistry::get('orders');
            $order = $orders
                ->find()
                ->where(['orders.uploaded_for' => $id, 'orders.draft' => 0])->order('orders.id DESC')->contain(['Profiles', 'Clients', 'RoadTest']);
            if($profile->profile_type==5 || $profile->profile_type==7 || $profile->profile_type==8)
            {
                $ord = $order;
                foreach($ord as $o)
                {
                    if($o->ins_1 || $o->ins_14 || $o->ins_77 || $o->ins_78 || $o->ins_78 || $o->ebs_1627 || $o->ebs_1650)
                    {
                        $complete = 1;
                        if($o->ins_1)
                        {
                            if(!$o->ins_1_binary)
                            {
                               $complete = 0; 
                            }
                        }
                        if($o->ins_14)
                        {
                            if(!$o->ins_14_binary)
                            {
                               $complete = 0; 
                            }
                        }
                        if($o->ins_77)
                        {
                            if(!$o->ins_77_binary)
                            {
                               $complete = 0; 
                            }
                        }
                        if($o->ins_78)
                        {
                            if(!$o->ins_78_binary)
                            {
                               $complete = 0; 
                            }
                        }
                        if($o->ebs_1627)
                        {
                            if(!$o->ebs_1627_binary)
                            {
                               $complete = 0; 
                            }
                        }
                        if($o->ebs_1650)
                        {
                            if(!$o->ebs_1650_binary)
                            {
                               $complete = 0; 
                            }
                        }
                        if($complete == 1 && $o->complete == 0)
                        {
                            $or = TableRegistry::get('orders');
                            $quer = $or->query();
                            $quer->update()
                            ->set(['complete'=>1])
                            ->where(['id' => $o->id])
                            ->execute();
                        }
                    }
                }
            }
            $this->set('orders', $order);
            $this->set('profile', $profile);
            $this->set('disabled', 1);
            $this->set('id', $id);
            $this->render("edit");
        }

        public function viewReport($profile, $profile_edit_view = 0)
        {
            $this->set('doc_comp', $this->Document);
            $orders = TableRegistry::get('orders');
            $order = $orders
                ->find()
                ->where(['orders.uploaded_for' => $profile])->contain(['Profiles', 'Clients', 'RoadTest']);

            if (isset($profile_edit_view) && $profile_edit_view == 1) {
                $this->response->body(($order));
                return $this->response;
                die();
                //$this->set('profile_edit_view', $profile_edit_view);
            } else $this->set('orders', $order);
            //  debug($order);
        }

        /**
         * Add method
         * Gets the current user profile for editnote.ctp
         * Used to get the user type (ie: admin) for editing permissions
         * @return void
         */

        /**
         * function changenote($noteid, $text){
         * //$setting = $this->Settings->get_permission($userid);
         *
         * $q = TableRegistry::get('recruiter_notes');
         * $note = $q->find()->where(['id'=>$noteid])->first();
         * if (strlen($text) == 0) {//Delete note
         * $query2 = $q->query();
         * $query2->delete($noteid)->first();
         * } else { //edit note text
         * $arr = array("description" => $text);
         * $query2 = $q->query();
         * $query2->update()->set($arr)->where(['id' => $noteid])->execute();
         * }
         * }
         */
        //debug($profile);

        public function editnote()
        {
            $userid = $this->request->session()->read('Profile.id');
            $profile = $this->Profiles->get($userid);
            $this->set('profile', $profile);
        }

        /**
         * public function changenote(){
         * $noteid = $_GET["id"];
         * $text = $_GET["text"];
         *
         * $userid=$this->request->session()->read('Profile.id');
         * $setting = $this->Settings->get_permission($userid);
         *
         * echo 'Note: ' . $noteid . '<BR>Text: ' & $text;
         * return;
         * $q = TableRegistry::get('recruiter_notes');
         * $note = $q->find()->where(['id'=>$noteid])->first();
         * if (strlen($text) == 0) {//Delete note
         * if($note->profile_delete==0){
         * $this->Flash->error('Sorry, you don\'t have the required permissions.');
         * return $this->redirect("/");
         * }
         * //if ($this->Profiles->delete($profile)) {
         * $q->delete($noteid);
         * } else { //edit note text
         * $arr = array("description" => $text);
         * $query2 = $q->query();
         * $query2->update()->set($arr)->where(['id' => $noteid])->execute();
         * }
         * }
         */

        /**
         * Add method
         *
         * @return void
         */
        public function add()
        {
            $this->set('uid', '0');
            $this->set('id', '0');
            $this->loadModel("ProfileTypes");
            $this->set("ptypes", $this->ProfileTypes->find()->where(['enable' => '1'])->all());
            $setting = $this->Settings->get_permission($this->request->session()->read('Profile.id'));

            // Only super admin and recruiter are allowed to create profiles as discussed on feb 19
            /*if (!$this->request->session()->read('Profile.super')) {
                if ($this->request->session()->read('Profile.profile_type') != '2') {
                    $this->Flash->error('Sorry, you don\'t have the required permissions.');
                    return $this->redirect("/profiles");
                }
            }*/

            if ($setting->profile_create == 0 && !$this->request->session()->read('Profile.super')) {
                $this->Flash->error('Sorry, you don\'t have the required permissions.');
                return $this->redirect("/");

            }
            $this->loadModel('Logos');

            $this->set('logos', $this->paginate($this->Logos->find()->where(['secondary' => '0'])));
            $this->set('logos1', $this->paginate($this->Logos->find()->where(['secondary' => '1'])));
            $this->set('logos2', $this->paginate($this->Logos->find()->where(['secondary' => '2'])));
            $profiles = TableRegistry::get('Profiles');

            $_POST['created'] = date('Y-m-d');
            //var_dump($profile);die();
            if (isset($_POST['password']) && $_POST['password'] == '') {
                unset($_POST['password']);
            }
            if ($this->request->is('post')) {

                if (isset($_POST['profile_type']) && $_POST['profile_type'] == 1)
                    $_POST['admin'] = 1;

                $_POST['dob'] = $_POST['doby'] . "-" . $_POST['dobm'] . "-" . $_POST['dobd'];
                //debug($_POST);die();
                $profile = $profiles->newEntity($_POST);
                if ($profiles->save($profile)) {

                    if ($_POST['client_ids'] != "") {
                        $client_id = explode(",", $_POST['client_ids']);
                        foreach ($client_id as $cid) {
                            $query = TableRegistry::get('clients');
                            $q = $query->find()->where(['id' => $cid])->first();
                            $profile_id = $q->profile_id;
                            $pros = explode(",", $profile_id);

                            $p_ids = "";

                            array_push($pros, $profile->id);
                            $pro_id = array_unique($pros);

                            foreach ($pro_id as $k => $p) {
                                if (count($pro_id) == $k + 1)
                                    $p_ids .= $p;
                                else
                                    $p_ids .= $p . ",";
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
                    if (isset($_POST['email']) && $_POST['email']) {

                        //    $from = 'info@isbmee.com';
                        //  $to = $_POST['email'];
                        //     $sub = 'Profile created successfully';
                        //    $msg = 'Hi,<br />An account has been created for you in https://isbmeereports.com<br /> Your login details are:<br /> Username: ' . $_POST['username'] . '<br /> Password: ';
                        //      if (isset($_POST['password'])) echo $_POST['password']; else echo 'Password not entered <br /> Please <a href="' . LOGIN . '">click here</a> to login.<br /> Regards,<br />The ISB Team';
                        //     $this->sendEmail($from, $to, $sub, $msg);
                    }

                    $this->Flash->success('Profile created successfully.');
                    return $this->redirect(['action' => 'edit', $profile->id]);
                } else {
                    $this->Flash->error('The user could not be saved. Please try again.');
                }
            }
            $this->set(compact('profile'));

            $this->render("edit");
        }

        function saveprofile($add = "")
        {
            $settings = $this->Settings->get_settings();
            $profiles = TableRegistry::get('Profiles');
            $path = $this->Document->getUrl();

            if ($add == '0') {
                $profile_type = $this->request->session()->read('Profile.profile_type');

                $_POST['created'] = date('Y-m-d');

                if (isset($_POST['password']) && $_POST['password'] == '') {
                    $password = '';
                    unset($_POST['password']);
                } else {
                    if(isset($_POST['password']) && $_POST['password'] != ''){
                    $password = $_POST['password'];
                    $_POST['password'] = md5($_POST['password']);}
                }
                if ($this->request->is('post')) {

                    if (isset($_POST['profile_type']) && $_POST['profile_type'] == 1)
                        $_POST['admin'] = 1;

                    $_POST['dob'] = $_POST['doby'] . "-" . $_POST['dobm'] . "-" . $_POST['dobd'];

                    $profile = $profiles->newEntity($_POST);
                    if ($profiles->save($profile)) {
                        $this->loadModel('ProfileDocs');
                        $this->ProfileDocs->deleteAll(['profile_id' => $profile->id]);
                        $profile_docs = array_unique($_POST['profile_doc']);
                        foreach ($profile_docs as $d) {
                            if ($d != "") {
                                $docs = TableRegistry::get('profile_docs');
                                $ds['profile_id'] = $profile->id;
                                $ds['file'] = $d;
                                $doc = $docs->newEntity($ds);
                                $docs->save($doc);
                                unset($doc);
                            }
                        }

                        /* if (isset($_POST['profile_type']) && $_POST['profile_type'] == 5) {
                             $username = 'driver_' . $profile->id;
                             $queries = TableRegistry::get('Profiles');
                             $queries->query()->update()->set(['username' => $username])
                                 ->where(['id' => $profile->id])
                                 ->execute();
                         } else { /*do nth
                         }*/
                        if ($profile_type == 2) {
                            //save profiles to clients if recruiter
                            $clients_id = $this->Settings->getAllClientsId($this->request->session()->read('Profile.id'));

                            if ($clients_id != "") {
                                $client_id = explode(",", $clients_id);
                                foreach ($client_id as $cid) {
                                    $query = TableRegistry::get('clients');
                                    $q = $query->find()->where(['id' => $cid])->first();
                                    $profile_id = $q->profile_id;
                                    $pros = explode(",", $profile_id);

                                    $p_ids = "";

                                    array_push($pros, $profile->id);
                                    $pro_id = array_unique($pros);

                                    foreach ($pro_id as $k => $p) {
                                        if (count($pro_id) == $k + 1)
                                            $p_ids .= $p;
                                        else
                                            $p_ids .= $p . ",";
                                    }

                                    $query->query()->update()->set(['profile_id' => $p_ids])
                                        ->where(['id' => $cid])
                                        ->execute();
                                }
                            }
                        }
                        if ($_POST['client_ids'] != "") {
                            $client_id = explode(",", $_POST['client_ids']);
                            foreach ($client_id as $cid) {
                                $query = TableRegistry::get('clients');
                                $q = $query->find()->where(['id' => $cid])->first();
                                $profile_id = $q->profile_id;
                                $pros = explode(",", $profile_id);

                                $p_ids = "";

                                array_push($pros, $profile->id);
                                $pro_id = array_unique($pros);

                                foreach ($pro_id as $k => $p) {
                                    if (count($pro_id) == $k + 1)
                                        $p_ids .= $p;
                                    else
                                        $p_ids .= $p . ",";
                                }

                                $query->query()->update()->set(['profile_id' => $p_ids])
                                    ->where(['id' => $cid])
                                    ->execute();
                            }
                        }

                        $blocks = TableRegistry::get('Blocks');
                        $query2 = $blocks->query();
                        $query2->insert(['user_id'])
                            ->values(['user_id' => $profile->id])
                            ->execute();
                        $side = TableRegistry::get('Sidebar');
                        $query2 = $side->query();
                        $query2->insert(['user_id'])
                            ->values(['user_id' => $profile->id])
                            ->execute();
                        if (isset($_POST['email']) && $_POST['email']) {

                            //     $com = "ISBMEE";
                            //     $from = 'info@isbmee.com';

                            //     $to = $_POST['email'];

                            //      $sub = 'Profile created successfully';
                            //      $msg = 'Hi,<br />An account has been created for you in https://isbmeereports.com<br /> Your login details are:<br /> Username: ' . $_POST['username'] . '<br /> Password: ';
                            //     if (isset($_POST['password'])) echo $_POST['password']; else echo 'Password not specified';

                            //        echo '<br /> Please <a href = "'.LOGIN.'" > click here </a > to login .<br /> Regards,<br />The ISB Team';

                            //          $this->sendEmail($from,$to,$sub,$msg);
                        }
                        if (isset($_POST['drafts']) && ($_POST['drafts'] == '1')) {
                            $this->Flash->success('Profile Saved as draft Successfully . ');
                        } else {
                            $pro_query = TableRegistry::get('Profiles');
                            $email_query = $pro_query->find()->where(['super' => 1])->first();
                            $em = $email_query->email;
                            $user_id = $this->request->session()->read('Profile.id');
                            $uq = $pro_query->find('all')->where(['id' => $user_id])->first();
                            if ($uq->profile_type) {
                                $u = $uq->profile_type;
                                $type_query = TableRegistry::get('profile_types');
                                $type_q = $type_query->find()->where(['id' => $u])->first();
                                if($type_q)
                                $ut = $type_q->title;
                                else
                                $ut = '';
                            }
                            else
                            $ut = '';
                            if ($_POST['profile_type']) {
                                $pt = $_POST['profile_type'];
                                $u = $pt;
                                $type_query = TableRegistry::get('profile_types');
                                $type_q = $type_query->find()->where(['id' => $u])->first();
                                if($type_q)
                                $protype = $type_q->title;
                                else
                                $protype = '';
                            }
                            else
                            $protype = '';
                            $from = array('info@'.$path => "ISB MEE");
                            $to = $em;

                            $sub = 'Profile Created: ' . $_POST['username'];
                            $msg = 'Domain:' . $path . '<br />
                            <br/>Profile Created: ' . $_POST['username'] . ' (Profile Type: ' . $protype . ')
                            <br/>By: ' . $uq->username . '
                            <br/>On: ' . date('Y-m-d')
                           ;

                            $this->Mailer->sendEmail($from, $to, $sub, $msg);
                            $this->Flash->success('Profile saved Successfully . ');

                        }
                        echo $profile->id;

                    } else
                        echo "0";
                }
            } else {
                $profile = $this->Profiles->get($add, [
                    'contain' => []
                ]);
                if ($this->request->is(['patch', 'post', 'put'])) {
                    if (isset($_POST['password']) && $_POST['password'] == '') {
                        //die('here');
                        $this->request->data['password'] = $profile->password;
                    } else {
                        if(isset($_POST['password']))
                        $this->request->data['password'] = md5($_POST['password']);
                    }
                    if (isset($_POST['profile_type']) && $_POST['profile_type'] == 1)
                        $this->request->data['admin'] = 1;
                    else
                        $this->request->data['admin'] = 0;
                    $this->request->data['dob'] = $_POST['doby'] . "-" . $_POST['dobm'] . "-" . $_POST['dobd'];
                    if (isset($this->request->data['username']) && $this->request->data['username'] == 5) {
                        unset($this->request->data['username']);
                    }
                    //var_dump($this->request->data); die();//echo $_POST['admin'];die();
                    $profile = $this->Profiles->patchEntity($profile, $this->request->data);
                    if ($this->Profiles->save($profile)) {
                        $this->loadModel('ProfileDocs');
                        $this->ProfileDocs->deleteAll(['profile_id' => $profile->id]);
                        $profile_docs = array_unique($_POST['profile_doc']);
                        foreach ($profile_docs as $d) {
                            if ($d != "") {
                                $docs = TableRegistry::get('profile_docs');
                                $ds['profile_id'] = $profile->id;
                                $ds['file'] = $d;
                                $doc = $docs->newEntity($ds);
                                $docs->save($doc);
                                unset($doc);
                            }
                        }
                        echo $profile->id;
                        if (isset($_POST['drafts']) && ($_POST['drafts'] == '1')) {
                            $this->Flash->success('Profile Saved as draft . ');
                        } else {
                            $this->Flash->success('Profile saved Successfully . ');
                        }
                    } else {
                        echo "0";
                    }
                }

            }
            die();
        }

        public function saveDriver()
        {
            //echo $client_id = $_POST['cid'];die() ; 
            $arr_post = explode('&', $_POST['inputs']);
            //var_dump($arr_post);die();
            foreach ($arr_post as $ap) {
                $arr_ap = explode('=', $ap);
                if (isset($arr_ap[1])) {
                    $post[$arr_ap[0]] = urldecode($arr_ap[1]);
                    $post[$arr_ap[0]] = str_replace('Select Gender', '', urldecode($arr_ap[1]));
                }
            }
           //var_dump($post);die();
            $que = $this->Profiles->find()->where(['email' => $post['email'], 'id <> ' => $post['id']])->first();

            if ($que) {
                //echo count($que);
                echo 'exist';
                die();
            }
            //$post = $_POST['inputs'];
            // var_dump($post);die();
            $profiles = TableRegistry::get('Profiles');

            if ($this->request->is('post')) {

                //var_dump($_POST['inputs']);die();
                $post['dob'] = $post['doby'] . "-" . $post['dobm'] . "-" . $post['dobd'];
                //debug($_POST);die();
                if ($post['id'] == 0 || $post['id'] == '0') {
                    $post['created'] = date('Y - m - d');
                    unset($post['id']);
                    $profile = $profiles->newEntity($post);
                    if ($profiles->save($profile)) {
                        if ($profile->profile_type == '5')
                            $username = 'driver_' . $profile->id;
                        else
                            if ($profile->profile_type == '7')
                                $username = 'owner_operator_' . $profile->id;
                            else
                                if ($profile->profile_type == '8')
                                    $username = 'owner_driver_' . $profile->id;
                        $queries = TableRegistry::get('Profiles');
                        $queries->query()->update()->set(['username' => $username])
                            ->where(['id' => $profile->id])
                            ->execute();
                        if ($post['client_ids'] != "") {
                            $client_id = explode(",", $post['client_ids']);
                            foreach ($client_id as $cid) {
                                $query = TableRegistry::get('clients');
                                $q = $query->find()->where(['id' => $cid])->first();
                                $profile_id = $q->profile_id;
                                $pros = explode(",", $profile_id);

                                $p_ids = "";

                                array_push($pros, $profile->id);
                                $pro_id = array_unique($pros);

                                foreach ($pro_id as $k => $p) {
                                    if (count($pro_id) == $k + 1)
                                        $p_ids .= $p;
                                    else
                                        $p_ids .= $p . ",";
                                }

                                $query->query()->update()->set(['profile_id' => $p_ids])
                                    ->where(['id' => $cid])
                                    ->execute();
                            }
                        }
                        echo $profile->id;
                        die();

                    }
                } else {

                    //var_dump($post);
                    $id = $post['id'];
                    unset($post['id']);
                    unset($post['profile_type']);

                    $pro = $this->Profiles->get($id, [
                        'contain' => []
                    ]);
                    $pros = $this->Profiles->patchEntity($pro, $post);
                    $this->Profiles->save($pros);

                    echo $id;
                    $username = 'driver_' . $id;
                    $queries = TableRegistry::get('Profiles');
                    $queries->query()->update()->set(['username' => $username])
                        ->where(['id' => $id])
                        ->execute();
                    die();

                }
            }
            die();
        }

        /**
         * Edit method
         *
         * @param string $id
         * @return void
         * @throws \Cake\Network\Exception\NotFoundException
         */
        public function edit($id = null)
        {

            $this->set('doc_comp', $this->Document);
            $check_pro_id = $this->Settings->check_pro_id($id);
            if ($check_pro_id == 1) {
                $this->Flash->error('The record does not exist . ');
                return $this->redirect("/profiles/index");
                //die();
            }

            $clientcount = $this->Settings->getClientCountByProfile($id);
            $this->set('Clientcount', $clientcount);
            if (isset($_GET['clientflash']) || $clientcount == 0) {
                $this->Flash->success('Profile created successfully! Please assign profile to at least one client to start placing orders.');
            }
            
            $pr = TableRegistry::get('profiles');
            $query = $pr->find();
            $aa = $query->select()->where(['id' => $id])->first();
            $checker = $this->Settings->check_edit_permission($this->request->session()->read('Profile . id'), $id, $aa->created_by);
            if ($checker == 0) {
              //  $this->Flash->error('Sorry, you don\'t have the required permissions6.');
              //  return $this->redirect("/profiles/index");

            }

            $setting = $this->Settings->get_permission($this->request->session()->read('Profile.id'));
            if ($setting->profile_edit == 0 && $id != $this->request->session()->read('Profile.id')) {
                $this->Flash->error('Sorry, you don\'t have the required permissions.');
                return $this->redirect("/");

            } else {
                $this->set('myuser', '1');
            }
            $this->loadModel("ProfileTypes");
            $this->set("ptypes", $this->ProfileTypes->find()->where(['enable' => '1'])->all());
            $this->loadModel("ClientTypes");
            $this->set('client_types', $this->ClientTypes->find()->where(['enable' => '1'])->all());
            $docs = TableRegistry::get('profile_docs');
            $query = $docs->find();
            $client_docs = $query->select()->where(['profile_id' => $id])->all();
            $this->set('client_docs', $client_docs);
            $this->loadModel('Logos');

            $this->set('logos', $this->paginate($this->Logos->find()->where(['secondary' => '0'])));
            $this->set('logos1', $this->paginate($this->Logos->find()->where(['secondary' => '1'])));
            $this->set('logos2', $this->paginate($this->Logos->find()->where(['secondary' => '2'])));
            $profile = $this->Profiles->get($id, [
                'contain' => []
            ]);
            //echo $profile->password;die();

            if ($this->request->is(['patch', 'post', 'put'])) {
                if (isset($_POST['password']) && $_POST['password'] == '') {
                    //die('here');
                    $this->request->data['password'] = $profile->password;
                }
                if (isset($_POST['profile_type']) && $_POST['profile_type'] == 1)
                    $this->request->data['admin'] = 1;
                else
                    $this->request->data['admin'] = 0;
                $this->request->data['dob'] = $_POST['doby'] . "-" . $_POST['dobm'] . "-" . $_POST['dobd'];
                //var_dump($this->request->data); die();//echo $_POST['admin'];die();
                $profile = $this->Profiles->patchEntity($profile, $this->request->data);
                if ($this->Profiles->save($profile)) {
                    $this->Flash->success('User saved successfully.');
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error('The user could not be saved. Please try again.');
                }
            }

            $this->set('doc_comp', $this->Document);
            $orders = TableRegistry::get('orders');
            $order = $orders
                ->find()
                ->where(['orders.uploaded_for' => $id])->contain(['Profiles', 'Clients', 'RoadTest']);

            $this->set('orders', $order);
            $this->set(compact('profile'));
            $this->set('id', $id);
            $this->set('uid', $id);
        }

        function changePass($id)
        {
            $profile = $this->Profiles->get($id, [
                'contain' => []
            ]);
            if ($this->request->is(['patch', 'post', 'put'])) {
                $profiles = $this->Profiles->patchEntity($profile, $this->request->data);
                if ($this->Profiles->save($profiles)) {

                    echo "1";
                } else {
                    echo "0";
                }
            }
            die();
        }

        /**
         * Delete method
         *
         * @param string $id
         * @return void
         * @throws \Cake\Network\Exception\NotFoundException
         */
        public
        function delete($id = null)
        {
            $check_pro_id = $this->Settings->check_pro_id($id);
            if ($check_pro_id == 1) {
                $this->Flash->error('Sorry, the record does not exist.');
                return $this->redirect("/profiles/index");
                die();
            }

            $checker = $this->Settings->check_permission($this->request->session()->read('Profile.id'), $id);
            if ($checker == 0) {
                $this->Flash->error('Sorry, you don\'t have the required permissions4.');
                return $this->redirect("/profiles/index");
                die();
            }

            $setting = $this->Settings->get_permission($this->request->session()->read('Profile.id'));

            if ($setting->profile_delete == 0) {
                $this->Flash->error('Sorry, you don\'t have the required permissions3.');
                return $this->redirect("/");

            }
            if (isset($_GET['draft']))
                $draft = "?draft";
            else
                $draft = "";
            $profile = $this->Profiles->get($id);
            // $this->request->allowMethod(['post', 'delete']);
            if ($this->Profiles->delete($profile)) {
                $this->Flash->success('The user has been deleted.');
            } else {
                $this->Flash->error('User could not be deleted. Please try again.');
            }
            return $this->redirect(['action' => 'index' . $draft]);
        }

        function logout()
        {
            $this->loadComponent('Cookie');
            $this->Cookie->delete('Profile.username');
            $this->Cookie->delete('Profile.password');
            $this->Cookie->delete('bar');
            $this->request->session()->destroy();

            if ($_SERVER['SERVER_NAME'] == 'localhost') {
                $this->redirect('/login');
            } else if ($_SERVER['SERVER_NAME'] == 'isbmeereports.com') {
                $this->redirect('http://' . getHost()); //isbmee.com');
            } else {
                $this->redirect('/login');

            }
        }

        function todo()
        {

        }

        function todos()
        {
            $this->layout = 'blank';
        }

        function blocks($client = "")
        {

            $user_id = $_POST['form'];
            if ($user_id != 0) {
                //$block['user_id'] = $_POST['block']['user_id'];
                $side['user_id'] = $_POST['side']['user_id'];
            }

            foreach ($_POST['side'] as $k => $v) {
                //echo $k."=>".$v."<br/>";
                $side[$k] = $v;
            }
            //die();
            if ($client == "") {
                $sides = array('profile_list', 'profile_create', 'client_list', 'client_create', 'document_list', 'document_create', 'profile_edit', 'profile_delete', 'client_edit', 'client_delete', 'document_edit', 'document_delete', 'document_others', 'document_requalify', 'orders_list', 'orders_create', 'orders_delete', 'orders_requalify', 'orders_edit', 'orders_others', 'order_requalify', 'orders_mee', 'orders_products','order_intact','email_document','email_orders','email_profile');
                foreach ($sides as $s) {
                    if (!isset($_POST['side'][$s]))
                        $side[$s] = 0;
                }
            }

            $sidebar = TableRegistry::get('sidebar');
            $s1 = $sidebar->find()->where(['user_id' => $user_id])->count();
            if ($user_id != 0 && $s1 != 0) {
                $query1 = $sidebar->query();
                $query1->update()
                    ->set($side)
                    ->where(['user_id' => $user_id])
                    ->execute();
            } else {
                $article = $sidebar->newEntity($_POST['side']);
                $sidebar->save($article);
            }
            die();
            //$this->redirect(['controller'=>'profiles','action'=>'add']);

        }

        function homeblocks()
        {
            $user_id = $_POST['form'];
            if ($user_id != 0) {
                $block['user_id'] = $_POST['block']['user_id'];
                //$side['user_id'] = $_POST['side']['user_id'];
            }
            foreach ($_POST['block'] as $k => $v) {

                $block[$k] = $v;
            }
            $blocks = TableRegistry::get('blocks');
            $s = $blocks->find()->where(['user_id' => $user_id])->count();
            //echo $s;die();
            if ($user_id != 0 && $s != 0) {

                $query = $blocks->query();
                $query->update()
                    ->set($block)
                    ->where(['user_id' => $user_id])
                    ->execute();
            } else {
                $article = $blocks->newEntity($_POST['block']);
                $blocks->save($article);
            }
            die();
        }

        function getSub()
        {
            $sub = TableRegistry::get('Subdocuments');
            $query = $sub->find();
            $q = $query->select();

            $this->response->body($q);
            return $this->response;

        }

        function getProSubDoc($pro_id, $doc_id)
        {
            $sub = TableRegistry::get('Profilessubdocument');
            $query = $sub->find();
            $query->select()->where(['profile_id' => $pro_id, 'subdoc_id' => $doc_id]);
            $q = $query->first();
            $this->response->body($q);
            return $this->response;
        }

        function displaySubdocs($id)
        {
            //var_dump($_POST);die();
            $user['profile_id'] = $id;
            $display = $_POST; //defining new variable for system base below upcoming foreach

            //for user base
            $this->loadModel('Profilessubdocument');
            $this->Profilessubdocument->deleteAll(['profile_id' => $id]);
            foreach ($_POST['profile'] as $k2 => $v) {
                $subp = TableRegistry::get('Profilessubdocument');
                $query2 = $subp->query();
                $query2->insert(['profile_id', 'subdoc_id', 'display'])
                    ->values(['profile_id' => $id, 'subdoc_id' => $k2, 'display' => $_POST['profile'][$k2]])
                    ->execute();
                unset($subp);
            }
            foreach ($_POST as $k => $v) {
                if ($k != 'profile') {

                    $subd = TableRegistry::get('Subdocuments');
                    $query3 = $subd->query();
                    $query3->update()
                        ->set(['display' => $v])
                        ->where(['id' => $k])
                        ->execute();
                }

            }
            die();
        }

        /*}
        unset($display['profileP']);
        unset($display['profile']);

        //For System base
        foreach($display as $k=>$v)
    =======
            unset($display['profileP']);
            unset($display['profile']);

            //For System base
            foreach($display as $k=>$v)
            {
                $subd = TableRegistry::get('Subdocuments');
                $query3 = $subd->query();
                $query3->update()
                    ->set(['display'=>$v])
                    ->where(['id' => $k])
                    ->execute();
            }


            //var_dump($str);
            die('here');
        }



        function getRecruiter()

        {
            $rec = TableRegistry::get('Profiles');
            $query = $rec->find()->where(['profile_type'=>2]);
            //$q = $query->select();

            $this->response->body($query);
            return $this->response;

            die();
        }



        //var_dump($str);
        die('here');
    }*/

        function getRecruiter()
        {
            $rec = TableRegistry::get('Profiles');
            $query = $rec->find()->where(['profile_type' => 2]);
            //$q = $query->select();

            $this->response->body($query);
            return $this->response;

            die();
        }

        function getProfile()
        {
            $rec = TableRegistry::get('Profiles');
            $query = $rec->find();
            $u = $this->request->session()->read('Profile.id');
            $super = $this->request->session()->read('Profile.super');

            if ($super) {
                $query = $rec->find()->where(['super <>' => 1, 'drafts' => 0])->order('fname');
            } else {
                $query = $rec->find()->where(['super <>' => 1, 'drafts' => 0, 'created_by' => $u])->order('fname');
            }

            /*$cond = $this->Settings->getprofilebyclient($u,$super);

           //$query = $query->select()->where(['super'=>0]);
           $query = $query->select()->where(['profile_type NOT IN (6,5)','OR'=>$cond])
               ->andWhere(['super'=>0]);
           if(!$super)
             $query = $query->orWhere(['created_by'=>$u]);
           */
            $this->response->body($query);
            return $this->response;
            die();
        }

        function getAjaxProfile($id = 0)
        {
            $this->layout = 'blank';
            if ($id) {
                $this->loadModel('Clients');
                $profile = $this->Clients->get($id, [
                    'contain' => []
                ]);
                $arr = explode(',', $profile->profile_id);
                $this->set('profile', $arr);
            } else {
                $this->set('profile', array());
            }
            $key = $_GET['key'];
            $rec = TableRegistry::get('Profiles');
            $query = $rec->find();
            $u = $this->request->session()->read('Profile.id');
            $super = $this->request->session()->read('Profile.admin');
            $cond = $this->Settings->getprofilebyclient($u, $super);

            if ($super) {
                $query = $rec->find()->where(['super <>' => 1, 'drafts' => 0, '(fname LIKE "%' . $key . '%" OR lname LIKE "%' . $key . '%" OR username LIKE "%' . $key . '%")'])->order('fname');
            } else {
                $query = $rec->find()->where(['super <>' => 1, 'drafts' => 0, 'created_by' => $u, '(fname LIKE "%' . $key . '%" OR lname LIKE "%' . $key . '%" OR username LIKE "%' . $key . '%")'])->order('fname');
            }

            //$query = $query->select()->where(['super'=>0]);

            /*$query = $query->select()->where(['profile_type NOT IN'=>'(5,6)','OR'=>$cond])
                ->andWhere(['super'=>0,'(fname LIKE "%'.$key.'%" OR lname LIKE "%'.$key.'%" OR username LIKE "%'.$key.'%")']);
             if(!$super)
              $query = $query->orWhere(['created_by'=>$u]);*/
            $this->set('profiles', $query);
            $this->set('cid', $id);

        }

        function getAjaxContact($id = 0)
        {
            $this->layout = 'blank';
            if ($id) {
                $this->loadModel('Clients');
                $profile = $this->Clients->get($id, [
                    'contain' => []
                ]);
                $arr = explode(',', $profile->contact_id);
                $this->set('contact', $arr);
            } else {
                $this->set('contact', array());
            }
            $key = $_GET['key'];
            $rec = TableRegistry::get('Profiles');
            $query = $rec->find();
            $u = $this->request->session()->read('Profile.id');
            $super = $this->request->session()->read('Profile.super');
            $cond = $this->Settings->getprofilebyclient($u, $super);
            //$query = $query->select()->where(['super'=>0]);
            $query = $query->select()->where(['profile_type NOT IN' => '(6)', 'OR' => $cond])
                ->andWhere(['super' => 0, 'profile_type' => 6, '(fname LIKE "%' . $key . '%" OR lname LIKE "%' . $key . '%" OR username LIKE "%' . $key . '%")']);
            $this->set('contacts', $query);
            $this->set('cid', $id);
        }

        function getContact()
        {
            $con = TableRegistry::get('Profiles');
            $query = $con->find()->where(['profile_type' => 6]);
            $this->response->body($query);
            return $this->response;
            die();
        }

        function filterBy()
        {
            $setting = $this->Settings->get_permission($this->request->session()->read('Profile.id'));

            if ($setting->profile_list == 0) {
                $this->Flash->error('Sorry, you don\'t have the required permissions2.');
                return $this->redirect("/");

            }

            $profile_type = $_GET['filter_profile_type'];
            $querys = TableRegistry::get('Profiles');
            $query = $querys->find()->where(['profile_type' => $profile_type]);
            $this->set('profiles', $this->paginate($this->Profiles));
            $this->set('profiles', $query);
            $this->set('return_profile_type', $profile_type);
            $this->render('index');
        }

        function getuser()
        {
            if ($id = $this->request->session()->read('Profile.id')) {
                $profile = TableRegistry::get('profiles');
                $query = $profile->find()->where(['id' => $id]);

                $l = $query->first();
                $this->response->body($l);
                return $this->response;
                //return $l;

            } else return $this->response->body(null);
            die();

        }

        function getallusers($profile_type = "", $client_id = "")
        {
            $u = $this->request->session()->read('Profile.id');
            $super = $this->request->session()->read('Profile.super');
            $cond = $this->Settings->getprofilebyclient($u, $super, $client_id);
            $profile = TableRegistry::get('profiles');
            if ($profile_type != "")
                $query = $profile->find()->where(['super' => 0, 'profile_type' => $profile_type, 'OR' => $cond]);
            else
                $query = $profile->find()->where(['super' => 0, 'OR' => $cond]);
            //debug($query);
            $l = $query->all();
            $this->response->body($l);
            return $this->response;

        }

        function getusers()
        {
            $title = $_POST['v'];

            if ($title != "") {
                $u = $this->request->session()->read('Profile.id');
                $super = $this->request->session()->read('Profile.super');
                $cond = $this->Settings->getprofilebyclient($u, $super);

                //var_dump($cond);
                $profile = TableRegistry::get('profiles');
                $query = $profile->find()->where(['username LIKE' => '%' . $title . "%", 'OR' => $cond]);

                $l = $query->all();
                //debug($l);
                if (count($l) > 0) {
                    /*echo "<select onchange='$(\".madmin\").val(this.value); $(\".loadusers\").hide()' class='form-control'>";
                    echo "<option> Select User</option>";*/
                    //echo "<ul>";
                    foreach ($l as $user) {
                        //echo "<option value='".$user->username."'>".$user->username."</option>";
                        echo "<a style='display:block; padding:5px 0; text-decoration:none;' onclick='$(\".madmin\").val(\"$user->username\"); $(\".loadusers\").hide()'>" . $user->username . "</a>";
                    }
                    //"</ul>";
                    //echo "<select/>";
                } else {
                    echo "1";
                }
            } else
                echo "0";
            //return $l;

            die();

        }

        function getOrder($id)
        {
            $con = TableRegistry::get('Documents');
            $query = $con->find()->where(['uploaded_for' => $id, 'document_type' => 'order']);
            $this->response->body($query);
            return $this->response;
            die();
        }

        function getClient()
        {
            $query = TableRegistry::get('Clients');
            $q = $query->find();
            $que = $q->select();
            $this->response->body($que);
            return $this->response;
            die();
        }

        function getProfileType($id = null)
        {
            $q = TableRegistry::get('Profiles');
            $que = $q->find();
            $que->select(['profile_type'])->where(['id' => $id]);
            $query = $que->first();
            $this->response->body($query);
            return $this->response;
            die();
        }

        function getProfileById($id, $sub)
        {
            $q = TableRegistry::get('Profiles');
            $query = $q->find();
            $que = $query->select()->where(['id' => $id])->first();

            if ($sub == 1) {
                $arr['applicant_phone_number'] = $que->phone;
                $arr['aplicant_name'] = $que->fname . ' ' . $que->lname;
                $arr['applicant_email'] = $que->email;
            }
            if ($sub == 2) {
                $arr['street_address'] = $que->street;
                $arr['city'] = $que->city;
                $arr['state_province'] = $que->province;
                $arr['postal_code'] = $que->postal;
                $arr['last_name'] = $que->lname;
                $arr['first_name'] = $que->fname;
                $arr['phone'] = $que->phone;
                $arr['email'] = $que->email;
            }
            if ($sub == 3) {
                $arr['driver_name'] = $que->fname . ' ' . $que->lname;
                $arr['d_l'] = $que->driver_license_no;
            }
            if ($sub == 4) {
                $arr['last_name'] = $que->lname;
                $arr['first_name'] = $que->fname;
                $arr['mid_name'] = $que->mname;
                $arr['sex'] = $que->gender;
                $arr['birth_date'] = $que->dob;
                $arr['phone'] = $que->phone;
                $arr['current_city'] = $que->city;
                $arr['current_province'] = $que->province;
                $arr['current_postal_code'] = $que->postal;
                $arr['driver_license_number'] = $que->driver_license_no;
                $arr['driver_license_issued'] = $que->driver_province;
                $arr['current_street_address'] = $que->street;
                $arr['applicants_email'] = $que->email;
            }

            echo json_encode($arr);
            die;
        }

        public
        function getNotes($driver_id)
        {
            $q = TableRegistry::get('recruiter_notes');
            $que = $q->find();
            $query = $que->select()->where(['driver_id' => $driver_id])->order(['id' => 'desc']);
            //$query = $que->first();
            $this->response->body($query);
            return $this->response;
            die();
        }

        public
        function getRecruiterById($id)
        {
            $q = TableRegistry::get('Profiles');
            $que = $q->find();
            $query = $que->select()->where(['id' => $id])->first();
            //$query = $que->first();
            $this->response->body($query);
            return $this->response;
            die();
        }

        public
        function deleteNote($id)
        {
            $this->loadModel('recruiter_notes');
            $note = $this->recruiter_notes->get($id);
            $this->recruiter_notes->delete($note);
            die();
        }

        public
        function saveNote($id, $rid)
        {
            $note = TableRegistry::get('recruiter_notes');
            $_POST['driver_id'] = $id;
            if (!$rid) {
                $_POST['recruiter_id'] = $this->request->session()->read('Profile.id');

                $_POST['created'] = date('Y-m-d');
            }
            if (!$rid) {
                $save = $note->newEntity($_POST);

                if ($note->save($save))
                    echo '<div class="item">
            <div class="item-head">
                <div class="item-details">
                    <a href="" class="item-name primary-link">' . $this->request->session()->read('Profile.fname') . ' ' . $this->request->session()->read('Profile.mname') . ' ' . $this->request->session()->read('Profile.lname') . '</a>
                    <span class="item-label">' . date('m') . '/' . date('d') . '/' . (date('Y') - 2000) . '</span>
                </div>
                
            </div>
            <div class="item-body">
                <span id="desc' . $save->id . '">' . $_POST['description'] . '</span><br/><a href="javascript:void(0);" class="btn btn-small btn-primary editnote" style="padding: 0 8px;" id="note_' . $save->id . '">Edit</a> <a href="javascript:void(0);" class="btn btn-small btn-danger deletenote" style="padding: 0 8px;" id="dnote_' . $save->id . '" onclick="return confirm(\'Are you sure you want to delete &quot;' . $_POST['description'] . '&quot; ?\');">Delete</a><br/><br/>
            </div>
        </div>';
                else
                    echo 'error';
                die();
            } else {
                $note->query()->update()
                    ->set($_POST)
                    ->where(['id' => $rid])
                    ->execute();
                //$q = TableRegistry::get('Profiles');
                $que = $note->find();
                $query = $que->select()->where(['id' => $id])->first();
                $arr_cr = explode(',', $query->created);

                $q = TableRegistry::get('Profiles');
                $query2 = $q->find();
                $que2 = $query->select()->where(['id' => $query->recruiter_id])->first();
                echo '<div class="item">
            <div class="item-head">
                <div class="item-details">
                    <a href="" class="item-name primary-link">' . $que2->fname . ' ' . $que2->mname . ' ' . $que2->lname . '</a>
                    <span class="item-label">' . $arr_cr[0] . '</span>
                </div>
                
            </div>
            <div class="item-body">
                <span id="desc' . $rid . '">' . $_POST['description'] . '</span><br/><a href="javascript:void(0);" class="btn btn-small btn-primary editnote" style="padding: 0 8px;" id="note_' . $rid . '">Edit</a> <a href="javascript:void(0);" class="btn btn-small btn-danger deletenote" style="padding: 0 8px;" id="dnote_' . $rid . '" onclick="return confirm(\'Are you sure you want to delete &quot;' . $_POST['description'] . '&quot; ?\');">Delete</a><br/><br/>
            </div>
        </div>';
            }
        }

        public
        function check_user($uid = '')
        {
            if (isset($_POST['username']) && $_POST['username'])
                $user = $_POST['username'];
            $q = TableRegistry::get('profiles');
            $que = $q->find();
            if ($uid != "")
                $query = $que->select()->where(['id !=' => $uid, 'username' => $user])->first();
            else
                $query = $que->select()->where(['username' => $user])->first();
            //var_dump($query);
            //$query = $que->first();
            if ($query)
                echo '1';
            else
                echo '0';
            die();
        }

        public function check_email($uid = '')
        {

            $email = $_POST['email'];
            $q = TableRegistry::get('profiles');
            $que = $q->find();
            if ($uid != "")
                $query = $que->select()->where(['id !=' => $uid, 'email' => $email])->first();
            else $query = $que->select()->where(['email' => $email])->first();
            //var_dump($query);
            //$query = $que->first();
            if ($query)
                echo '1';
            else
                echo '0';
            die();
        }

        function cron()
        {
            $path = $this->Document->getUrl();

            $q = TableRegistry::get('events');
            $que = $q->find();
            //$query = $que->select()->where(['(date LIKE "%' . $date . '%" OR date LIKE "%' . $date2 . '%")', 'sent' => 0])->limit(200);

            $datetime = date('Y-m-d H:i:s');
            echo "Checking for events before " . $datetime;
            $query = $que->select()->where(['(date <= "' . $datetime . '")', 'sent' => 0])->limit(200);
            echo "<BR>" . iterator_count($query) . " emails to send";
            //VAR_Dump($query);die();
            foreach ($query as $todo) {
                if ($todo->email_self == '1') {
                    $query2 = $this->loadprofile($todo->user_id);
                    $email = $query2->email;
                    if ($email) {  $this->sendtaskreminder($email, $todo, $path, "(Account holder)"); }
                }
                if (strlen($todo->others_email) >0) {
                    $emails = explode(",", $todo->others_email);
                    foreach ($emails as $em) {
                        $this->sendtaskreminder($em, $todo, $path, "(Added by account holder)");
                    }
                }
                $q->query()->update()->set(['sent' => 1, 'email_self' => 0])->where(['id' => $todo->id])->execute();
            }

            die();
        }

        public function loadprofile($UserID, $fieldname = "id"){
            $table = TableRegistry::get("profiles");
            $results = $table->find('all', array('conditions' => array($fieldname => $UserID)))->first();
            if(is_object($results)){ return $results;}
            return false;
        }
        function sendtaskreminder($email, $todo, $path, $name){
            $from = array('info@'.$path => "ISB MEE");
            $to = trim($email);
            $sub = 'ISBMEE Tasks - Reminder';
            $msg = 'Domain: ' . getHost("isbmee.com") . ' <br /><br />Reminder, you have following task due:<br/><br/>Title : ' . $todo->title . '<br />Description : ' . $todo->description . '<br />Due By : ' . $todo->date . '<br /><br /> Regards,<br />the ISB MEE team';
            echo "<hR>From: " . $from . "<BR>To: " . $to . " " . $name . "<BR>Subject: " . $sub . "<BR>Message: " . $msg;
            $this->Mailer->sendEmail($from, $to, $sub, $msg);
        }

        function getDriverById($id){
            $q2 = TableRegistry::get('profiles');
            $que2 = $q2->find();
            $query2 = $que2->select()->where(['id' => $id])->first();
            $this->response->body($query2);
            return $this->response;
        }

        function getOrders($id){
            $order = TableRegistry::get('orders');
            $order = $order->find()->where(['uploaded_for' => $id]);
            $this->response->body($order);
            return $this->response;
        }

        function forgetpassword(){
            $path = $this->Document->getUrl();
            $email = str_replace(" ", "+", trim($_POST['email']));
            $profiles = TableRegistry::get('profiles');
            if ($profile = $profiles->find()->where(['LOWER(email)' => strtolower($email)])->first()) {
                //debug($profile);
                $new_pwd = $this->generateRandomString(6);
                $p = TableRegistry::get('profiles');
                if ($p->query()->update()->set(['password' => md5($new_pwd)])->where(['id' => $profile->id])->execute()) {
                    $from = array('info@'.$path => "ISB MEE");
                    $to = $profile->email;
                    $sub = 'New Password created successfully';
                    $msg = 'Your new password has been created.<br /> Your login details are:<br /> Username: ' . $profile->username . '<br /> Password: ' . $new_pwd . '<br /> Please <a href="' . LOGIN . '">click here</a> to login.<br /> Regards';
                    $this->Mailer->sendEmail($from, $to, $sub, $msg);
                    echo "Password has been reset succesfully. Please check your email for the new password.";
                }
            } else {
                echo "Sorry, the email address does not exist.";
            }
            die();
        }

        function generateRandomString($length = 10){
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }
















        function cleardb(){
            if ($this->request->session()->read('Profile.super') == 1) {

                //$query = $conn->query("show tables");

                //WHITELIST//
                $this->DeleteAttachment(-1, "attachments", "/attachments/");
                $this->DeleteAttachment(-1, "client_docs", "/img/jobs/");
                $this->DeleteAttachment(-1, "profiles", "/img/profile/");
                $this->DeleteAttachment(-1, "doc_attachments", "/attachments/");
                $this->DeleteUser(-1);//deletes all users
                $this->DeleteTables(array("clients", "clientssubdocument", "client_divison", "client_sub_order"));//deletes clients
                //deletes documents
                $this->DeleteTables(array("audits", "consent_form", "consent_form_criminal", "documents", "driver_application", "road_test", "survey", "driver_application_accident", "driver_application_licenses"));
                $this->DeleteTables(array("abstract_forms", "bc_forms", "quebec_forms", "education_verification", "employment_verification", "feedbacks", "orders", "pre_screening", "generic_forms"));
                //do not delete settings, contents, logos, subdocuments, order_products, color_class, client_types, profile_types, training_quiz, training_list,

                $this->DeleteDir(getcwd() . "/canvas", ".png");//deletes all signatures
                $this->DeleteDir(getcwd() . "/attachments");//deletes all document attachments
                $this->DeleteDir(getcwd() . "/img/jobs");//deletes all client pictures
                $this->DeleteDir(getcwd() . "/img/certificates", ".pdf", "certificate.jpg");//deletes pdf certificates, leaves the jpg
                $this->DeleteDir(getcwd() . "/img/profile", "", array("female.png", "male.png", "default.png"), "image" );//deletes profile pics
                $this->DeleteDir(getcwd() . "/orders", "", "", "", true);//deletes the pdfs and their sub-directories
                $this->DeleteDir(getcwd() . "/pdfs");//deletes the pdfs

                //die();
                $this->layout = "blank";
            }
        }

        function DeleteTables($Table){
            if (is_array($Table)){
                foreach($Table as $table){
                    $this->DeleteTables($table);
                }
            } else {
                switch ($Table){
                    case "clients":
                        $table = TableRegistry::get("clients")->find('all');
                        foreach($table as $client){
                            unlink(getcwd() . "/img/jobs/" . $client->image); //delete image
                        }
                        break;
                    case "settings":
                        echo "<BR> Cannot delete settings";
                        return false;
                        break;
                }
                $conn = ConnectionManager::get('default');
                $conn->query("TRUNCATE TABLE " . $Table);
                echo "<BR>Deleted table: " . $Table;
            }
        }

        function DeleteUser($ID){
            $table = TableRegistry::get("profiles");
            if($ID==-1) {
                $users = $table->find('all', array('conditions' => array(['super' => 0])));
                foreach ($users as $user) {
                    $this->DeleteUser($user->id);
                }
                //clean up any nonexistent users still in the database
                $this->CleanUsers("blocks");
                $this->CleanUsers("sidebar");
                $this->CleanUsers("events");
                $this->CleanUsers("profilessubdocument", "profile_id");
                $this->CleanUsers("profile_docs", "profile_id");
                $this->CleanUsers("recruiter_notes", "driver_id");
                $this->CleanUsers("recruiter_notes", "recruiter_id");
                $this->CleanUsers("training_answers", "UserID");
                $this->CleanUsers("training_enrollments", "UserID");
                $this->CleanUsers("training_enrollments", "EnrolledBy");

                if(!$this->loadprofile(0)){ $this->DeleteUser(0);}
            } else if(is_numeric($ID)>0) {
                $user = $this->loadprofile($ID);
                if($user){
                    if ($user->super == 1){return false; }//cannot delete supers
                    unlink(getcwd() . "/img/profile/" . $user-image);
                }//delete image
                $attachments = TableRegistry::get("profile_docs")->find('all', array('conditions' => array(['profile_id' => $ID])));
                foreach($attachments as $attachment){
                    $this->DeleteAttachment($attachment->id, "profile_docs", "/img/jobs/");
                }

                TableRegistry::get("blocks")->deleteAll(array('user_id' => $ID), false);
                TableRegistry::get("sidebar")->deleteAll(array('user_id' => $ID), false);
                TableRegistry::get("events")->deleteAll(array('user_id' => $ID), false);
                TableRegistry::get("profilessubdocument")->deleteAll(array('profile_id' => $ID), false);
                TableRegistry::get("recruiter_notes")->deleteAll(array('driver_id' => $ID), false);
                TableRegistry::get("recruiter_notes")->deleteAll(array('recruiter_id' => $ID), false);
                TableRegistry::get("training_answers")->deleteAll(array('UserID' => $ID), false);
                TableRegistry::get("training_enrollments")->deleteAll(array('UserID' => $ID), false);

                $table->deleteAll(array('id' => $ID), false);
                echo "<BR>Deleted User: " . $ID;
            }
        }
        function CleanUsers($tablename, $fieldname = "user_id"){
            $table = TableRegistry::get($tablename);
            $users = $table->find('all');
            foreach ($users as $user) {
                $user2 = $this->loadprofile($user->$fieldname);
                if (!is_object($user2)){//delete any non-existent profile
                    $this->DeleteUser($user->$fieldname);
                }
            }
        }

        function DeleteDir($path, $like = "", $notlike = "", $fieldname = "", $recursive = false){
            if (is_dir($path)) {
                $files = scandir($path);
                echo "<BR>Deleting Directory: " . $path;
                foreach ($files as $file) { // iterate files
                    $doit = true;
                    if ($file != "." && $file != "..") {
                        if ($fieldname) {//blocks the delete of any file that can be found in profiles.$fieldname
                            if ($this->loadprofile($file, $fieldname)) {
                                $doit = false;
                            }
                        }
                        if ($like) {//only allows the delete of any file containing $like
                            if (is_array($like)) {
                                $doit = false;
                                foreach ($like as $pattern) {
                                    if ($file == $pattern || stripos($file, $pattern)) {
                                        $doit = true;
                                    }
                                }
                            } else {
                                $doit = $file == $like || stripos($file, $like);
                            }
                        }
                        if ($notlike) {//blocks the delete of any file containing $notlike
                            if (is_array($notlike)) {
                                foreach ($notlike as $pattern) {
                                    if ($file == $pattern || stripos($file, $pattern)) {
                                        $doit = false;
                                    }
                                }
                            } else {
                                if ($file == $notlike || stripos($file, $notlike)) {
                                    $doit = false;
                                }
                            }
                        }
                        if ($doit) {//if approved, delete the file
                            $file = $path . "/" . $file;
                            if (is_file($file)) {// delete file}
                                unlink($file);
                                echo "<BR>Deleting file: " . $file;
                            } else if ($recursive && is_dir($file)) {//deletes sub directories
                                $this->DeleteDir($file, $like, $notlike, $fieldname, $recursive);
                                rmdir($file);
                            }
                        }
                    }
                }
            } else {
                echo "<BR>"  . $path . " Was not a directory";
            }
        }
        function DeleteAttachment($ID, $TableName = 'attachments', $Path = "/attachments/"){//$ID=-1 deletes all attachments
            $table = TableRegistry::get($TableName);
            if($ID==-1){
                echo "<BR>Deleting all attachments from " . $TableName;
                $table = $table->find('all');
                foreach($table as $attachment){
                    $this->DeleteAttachment($attachment->id, $TableName, $Path);
                }
            } else {
                $attachment =  $table->find()->where(['id'=> $ID])->first();
                $filename="";
                if ( isset($attachment->title)) { $filename = $attachment->title; }
                if ( isset($attachment->file)) { $filename = $attachment->file; }
                if ( isset($attachment->attachment)) { $filename = $attachment->attachment; }
                if ($filename) {
                    if (file_exists(getcwd() . $Path . $filename) && is_file(getcwd() . $Path . $filename)) {
                        echo "<BR>Deleted file " . $Path . $filename;
                        unlink(getcwd() . $Path . $filename);
                    }
                } else {
                    echo "<BR>No file to delete " .$ID . " in " . $TableName;
                }
                if($TableName != "profiles") $table->deleteAll(array('id' => $ID), false);
            }
        }












        function sproduct($id = '0')
        {
            if (isset($_POST)) {
                $p = TableRegistry::get('order_products');
                $title = $_POST['title'];
                if ($id != 0) {

                    if ($p->query()->update()->set(['title' => $title])->where(['id' => $id])->execute()) {
                        echo $title;
                    }
                } else {
                    $profile = $p->newEntity($_POST);
                    if ($p->save($profile)) {

                        echo '<tr>
                            <!--td>' . $profile->id . '</td-->
                            <td class="title_' . $profile->id . '">' . $title . '</td>
                            <td><input type="checkbox" id="chk_' . $profile->id . '" class="enable"/></td>
                            <td><span  class="btn btn-info editpro" id="edit_' . $profile->id . '">Edit</span></td>
                        </tr>';
                    }
                }
            }
            die();
        }

        function ptypes($id = '0')
        {
            if (isset($_POST)) {
                $p = TableRegistry::get('profile_types');
                $title = $_POST['title'];
                if ($id != 0) {

                    if ($p->query()->update()->set(['title' => $title])->where(['id' => $id])->execute()) {
                        echo $title;
                    }
                } else {
                    $profile = $p->newEntity($_POST);
                    if ($p->save($profile)) {

                        echo '<tr>
                            <td>' . $profile->id . '</td>
                            <td class="titleptype_' . $profile->id . '">' . $title . '</td>
                            <td><input type="checkbox" id="pchk_' . $profile->id . '" class="penable"/><span class="span_' . $profile->id . '"></span></td>
                            <td><span  class="btn btn-info editptype" id="editptype_' . $profile->id . '">Edit</span></td>
                        </tr>';
                    }
                }
            }
            die();
        }

        function ctypes($id = '0')
        {
            if (isset($_POST)) {
                $p = TableRegistry::get('client_types');
                $title = $_POST['title'];
                if ($id != 0) {

                    if ($p->query()->update()->set(['title' => $title])->where(['id' => $id])->execute()) {
                        echo $title;
                    }
                } else {
                    $profile = $p->newEntity($_POST);
                    if ($p->save($profile)) {

                        echo '<tr>
                            <td>' . $profile->id . '</td>
                            <td class="titlectype_' . $profile->id . '">' . $title . '</td>
                            <td><input type="checkbox" id="cchk_' . $profile->id . '" class="cenable"/><span class="span_' . $profile->id . '"></span></td>
                            <td><span  class="btn btn-info editctype" id="editctype_' . $profile->id . '">Edit</span></td>
                        </tr>';
                    }
                }
            }
            die();
        }

        function enableproduct($id)
        {
            $p = TableRegistry::get('order_products');
            $enable = $_POST['enable'];
            if ($p->query()->update()->set(['enable' => $enable])->where(['id' => $id])->execute()) {
                echo $enable;
            }

            die();
        }

        function ptypesenable($id)
        {
            $p = TableRegistry::get('profile_types');
            $enable = $_POST['enable'];
            if ($p->query()->update()->set(['enable' => $enable])->where(['id' => $id])->execute()) {
                if ($enable == '1')
                    echo "Added";
                else
                    echo "Removed";
            }

            die();
        }

        function ctypesenable($id)
        {
            $p = TableRegistry::get('client_types');
            $enable = $_POST['enable'];
            if ($p->query()->update()->set(['enable' => $enable])->where(['id' => $id])->execute()) {
                if ($enable == '1')
                    echo "Added";
                else
                    echo "Removed";
            }

            die();
        }

        function ctypesenb($id)
        {
            $ctype = "";
            foreach ($_POST['ctypes'] as $k => $v) {
                if (count($_POST['ctypes']) == $k + 1)
                    $ctype .= $v;
                else
                    $ctype .= $v . ",";
            }
            $p = TableRegistry::get('profiles');
            $p->query()->update()->set(['ctypes' => $ctype])->where(['id' => $id])->execute();
            die();
        }

        function ptypesenb($id)
        {
            $ptype = "";
            foreach ($_POST['ptypes'] as $k => $v) {
                if (count($_POST['ptypes']) == $k + 1)
                    $ptype .= $v;
                else
                    $ptype .= $v . ",";
            }
            $p = TableRegistry::get('profiles');
            $p->query()->update()->set(['ptypes' => $ptype])->where(['id' => $id])->execute();
            die();
        }

        function gettypes($type, $uid)
        {
            $p = TableRegistry::get('profiles');
            $profile = $p->find()
                ->where(['id' => $uid])->first();

            if ($type == 'ptypes')
                $this->response->body(($profile->ptypes));
            elseif ($type == "ctypes")
                $this->response->body(($profile->ctypes));
            return $this->response;
        }

        /*  getDocumentcountz()
          {
              $doc = TableRegistry::get('Subdocuments');
              $query = $doc->find();
              $query = $query->where(['display' => 1]);
              $q = $query->all();
              $q = count($q);
              $this->response->body($q);
              return $this->response;
          }

          getuserDocumentcountz($id)
         {
              $doc = TableRegistry::get('Subdocuments');
              $query = $doc->find();
              $query = $query->where(['display' => 1])->all();
              $cnt = 0;
              foreach ($query as $q) {
                  $subdoc = TableRegistry::get('profilessubdocument');
                  if ($query1 = $subdoc->find()->where(['profile_id' => $id, 'subdoc_id' => $q->id, 'display <>' => 0])->first())
                      $cnt++;
              }

              $this->response->body($cnt);
              return $this->response;
         } */
        public function appendattachments($query){
            foreach ($query as $client) {
                $client->hasattachments = $this->hasattachments($client->id);
            }
            return $query;
        }

        public
        function hasattachments($id)
        {
            $docs = TableRegistry::get('profile_docs');
            $query = $docs->find();
            $client_docs = $query->select()->where(['profile_id' => $id])->first();
            if ($client_docs) {
                return true;
            }
        }
        
        public function getTypeTitle($id)
        {
            $docs = TableRegistry::get('profile_types');
            $query = $docs->find()->where(['id'=>$id])->first();
            if($query)
            $q = $query->title;
            else
            $q = '';
            $this->response->body($q);
              return $this->response;
            
        }
    }

?>
