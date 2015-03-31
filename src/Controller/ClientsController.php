<?php
    namespace App\Controller;

    use App\Controller\AppController;
    use Cake\Event\Event;
    use Cake\Controller\Controller;
    use Cake\ORM\TableRegistry;
    use Cake\Network\Email\Email;

    class ClientsController extends AppController
    {

        public $paginate = [
            'limit' => 10,
            'order' => ['id' => 'desc']

        ];

        public function initialize()
        {
            parent::initialize();
            $this->loadComponent('Settings');
            $this->loadComponent('Document');
            $this->loadComponent('Mailer');

            if (!$this->request->session()->read('Profile.id')) {
                $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                $this->redirect('/login?url=' . urlencode($url));
            }

        }

        function upload_img($id = "")
        {
            if (isset($_FILES['myfile']['name']) && $_FILES['myfile']['name']) {
                $arr = explode('.', $_FILES['myfile']['name']);
                $ext = end($arr);
                $rand = rand(100000, 999999) . '_' . rand(100000, 999999) . '.' . $ext;
                $allowed = array('jpg', 'jpeg', 'png', 'bmp', 'gif');
                $check = strtolower($ext);
                if (in_array($check, $allowed)) {
                    move_uploaded_file($_FILES['myfile']['tmp_name'], APP . '../webroot/img/jobs/' . $rand);
                    unset($_POST);
                    if (isset($id)) {
                        $_POST['image'] = $rand;
                        $img = TableRegistry::get('clients');

                        //echo $s;die();
                        $query = $img->query();
                        $query->update()
                            ->set($_POST)
                            ->where(['id' => $id])
                            ->execute();
                    }
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

        function removefiles($file)
        {
            if (isset($_POST['id']) && $_POST['id'] != 0) {
                $this->loadModel("ClientDocs");
                $this->ClientDocs->deleteAll(['id' => $_POST['id']]);

            }
            @unlink(WWW_ROOT . "img/jobs/" . $file);
            die();
        }

        public function index()
        {
            if (isset($_GET['flash'])) {
                $setting = $this->Settings->get_permission($this->request->session()->read('Profile.id'));
//           debug($setting);

                $this->Flash->success('Select a client to upload.');
            }
            $setting = $this->Settings->get_permission($this->request->session()->read('Profile.id'));
            if ($setting->client_list == 0) {
                $this->Flash->error('Sorry, you don\'t have the required permissions.');
                return $this->redirect("/");

            }
            if (isset($_GET['draft']))
                $draft = 1;
            else
                $draft = 0;
            $querys = TableRegistry::get('Clients');
            $query = $querys->find()->where(['drafts'=>$draft]);
            $query = $querys->find();
            $this->set('client', $this->appendattachments($this->paginate($query)));
        }

        function search()
        {
            $setting = $this->Settings->get_permission($this->request->session()->read('Profile.id'));

            if ($setting->client_list == 0) {
                $this->Flash->error('Sorry, you don\'t have the required permissions.');
                return $this->redirect("/");

            }
            if (isset($_GET['draft']))
                $draft = 1;
            else
                $draft = 0;

            if (isset($_GET['search']))
                $search = $_GET['search'];
            else
                $search = "";
            $searchs = strtolower($search);
            $querys = TableRegistry::get('Clients');
            $query = $querys->find()
                ->where(['drafts' => $draft, 'OR' =>
                    [
                        //['LOWER(title) LIKE' => '%'.$searchs.'%'],
                        //['LOWER(description) LIKE' => '%'.$searchs.'%'],
                        ['LOWER(company_name) LIKE' => '%' . $searchs . '%']
                        //['LOWER(company_address) LIKE' => '%'.$searchs.'%']
                    ]
                ]);
            /*->orWhere(['LOWER(title) LIKE' => '%'.$searchs.'%'])
            ->orWhere(['LOWER(description) LIKE' => '%'.$searchs.'%'])
            ->orWhere(['LOWER(company_name) LIKE' => '%'.$searchs.'%'])
            ->orWhere(['LOWER(company_address) LIKE' => '%'.$searchs.'%']);*/
            $this->set('client', $this->paginate($query));
            //$this->set('client',$query);
            $this->set('search_text', $search);
            $this->render('index');
        }

        public function view($id = null)
        {
            $setting = $this->Settings->get_permission($this->request->session()->read('Profile.id'));

            if ($setting->client_list == 0) {
                $this->Flash->error('Sorry, you don\'t have the required permissions.');
                return $this->redirect("/");

            }
            $this->loadModel("ClientTypes");
            $this->set('client_types', $this->ClientTypes->find()->where(['enable' => '1'])->all());
            $querys = TableRegistry::get('Clients');
            $query = $querys->find()->where(['id' => $id]);
            $this->set('client', $query->first());
            $this->set('id', $id);
            //$this->set('disabled',1);
            //$this->render('add');
        }

        /**
         * Add method
         *
         * @return void
         */
        public function assignContact($contact, $id, $status)
        {
            $querys = TableRegistry::get('Clients');
            $query = $querys->find()->where(['id' => $id])->first();
            if ($status == 'yes') {
                if ($query->contact_id == '') {
                    $arr['contact_id'] = $contact;
                } else
                    $arr['contact_id'] = $query->contact_id . ',' . $contact;
            } else {
                $arr['contact_id'] = '';
                if ($query->contact_id == '')
                    die();
                else {
                    $array = explode(',', $query->contact_id);
                    if ($array) {
                        foreach ($array as $a) {
                            if ($a == $contact) {
                                continue;
                            } else {
                                if ($arr['contact_id'] == '')
                                    $arr['contact_id'] = $a;
                                else
                                    $arr['contact_id'] = $arr['contact_id'] . ',' . $a;
                            }
                        }
                    }

                }
            }
            $arr['contact_id'] = str_replace(',', ' ', $arr['contact_id']);
            $arr['contact_id'] = trim($arr['contact_id']);
            $arr['contact_id'] = str_replace(' ', ',', $arr['contact_id']);
            $query2 = $querys->query();
            $query2->update()
                ->set($arr)
                ->where(['id' => $id])
                ->execute();
            die();
        }

        public function assignProfile($profile, $id, $status)
        {
            $querys = TableRegistry::get('Clients');
            $query = $querys->find()->where(['id' => $id])->first();

            if ($status == 'yes') {
                if ($query->profile_id == '') {
                    $arr['profile_id'] = $profile;
                } else
                    $arr['profile_id'] = $query->profile_id . ',' . $profile;
            } else {
                $arr['profile_id'] = '';
                if ($query->profile_id == '')
                    die();
                else {
                    $array = explode(',', $query->profile_id);
                    if ($array) {
                        foreach ($array as $a) {
                            if ($a == $profile) {
                                continue;
                            } else {
                                if ($arr['profile_id'] == '')
                                    $arr['profile_id'] = $a;
                                else
                                    $arr['profile_id'] = $arr['profile_id'] . ',' . $a;
                            }
                        }
                    }

                }
            }
            $arr['profile_id'] = str_replace(',', ' ', $arr['profile_id']);
            $arr['profile_id'] = trim($arr['profile_id']);
            $arr['profile_id'] = str_replace(' ', ',', $arr['profile_id']);
            $query2 = $querys->query();
            $query2->update()
                ->set($arr)
                ->where(['id' => $id])
                ->execute();
            die();
        }

        public function add()
        {
            $setting = $this->Settings->get_permission($this->request->session()->read('Profile.id'));
            $settings = $this->Settings->get_settings();
            $this->set('settings', $settings);

            $this->loadModel("ClientTypes");
            $this->set('client_types', $this->ClientTypes->find()->where(['enable' => '1'])->all());
            if ($setting->client_create == 0) {
                $this->Flash->error('Sorry, you don\'t have the required permissions.');
                return $this->redirect("/");

            }
            $rec = '';
            $con = '';
            $count = 1;
            if (isset($_POST['recruiter_id'])) {
                foreach ($_POST['recruiter_id'] as $ri) {
                    if ($count == 1)
                        $rec = $ri;
                    else
                        $rec = $rec . ',' . $ri;
                    $count++;

                }
            }
            unset($_POST['recruiter_id']);
            $_POST['recruiter_id'] = $rec;

            if (isset($_POST['contact_id'])) {
                foreach ($_POST['contact_id'] as $ri) {
                    if ($count == 1)
                        $rec = $ri;
                    else
                        $rec = $rec . ',' . $ri;
                    $count++;

                }
            }
            unset($_POST['contact_id']);
            $_POST['contact_id'] = $rec;
            $clients = TableRegistry::get('Clients');
            $client = $clients->newEntity($_POST);
            if ($this->request->is('post')) {

                if ($clients->save($client)) {

                    if (isset($_POST['division'])) {

                    }
                    $this->Flash->success('User saved successfully.');
                    return $this->redirect(['action' => 'edit', $client->id]);

                } else {
                    $this->Flash->error('The user could not be saved. Please try again.');
                }
            }
            $this->set(compact('client'));
            $this->set('profile', array());
            $this->set('contacts', array());
            $this->set('id', '');
            $this->render('add');
        }

        public function saveClients($id = 0)
        {
            $sub_sup = TableRegistry::get('subdocuments');
            $sub_sup_count = $sub_sup->find()->count();
            $counter = $sub_sup_count;
            $settings = $this->Settings->get_settings();

            $rec = '';
            $con = '';
            $count = 1;
            /*if(isset($_POST['profile_id'])){

            foreach($_POST['profile_id'] as $ri)
            {
                if($count==1)
                   $rec = $ri;
                else
                   $rec = $rec.','.$ri;
                $count++;

            }
            }
            unset($_POST['profile_id']);
            $_POST['profile_id'] = $rec;*/
            $rec = "";
            $count = 1;
            if (isset($_POST['contact_id'])) {
                foreach ($_POST['contact_id'] as $ri) {
                    if ($count == 1)
                        $rec = $ri;
                    else
                        $rec = $rec . ',' . $ri;
                    $count++;

                }
            }

            unset($_POST['contact_id']);
            $_POST['contact_id'] = $rec;
            $_POST['created'] = date('Y-m-d');
            $clients = TableRegistry::get('Clients');
            if (!$id) {

                $cnt = 0;
                if (isset($_POST['sig_email']) && $_POST['sig_email'] != "") {
                    $cnt = $clients->find()->where(['sig_email' => $_POST['sig_email']])->count();
                }
                if ($cnt > 0) {
                    echo "email";
                    die();
                }
                /*if(isset($_POST['sig_email']) && $_POST['sig_email']!="")
                {
                        $from = 'info@isbmee.com';
                        $to = $_POST['sig_email'];
                        $sub = ucfirst($settings->client) . ' created successfully';
                        $msg = 'Hi,<br />Your account has been created for ISBMEE as a ' . strtolower($settings->client) . '<br /> Regards';
                        $this->Mailer->sendEmail($from,$to,$sub,$msg);
                        }*/
                if (isset($_POST['sig_email']) && ((str_replace(array('@', '.'), array('', ''), $_POST['sig_email']) == $_POST['sig_email'] || strlen($_POST['sig_email']) < 5) && $_POST['sig_email'] != '')) {
                    echo "Invalid Email";
                    die();
                } else {
                    $_POST['profile_id'] = $this->request->session()->read('Profile.id');
                    $client = $clients->newEntity($_POST);
                    if ($this->request->is('post')) {
                        if ($clients->save($client)) {
                            $arr_s['client_id'] = $client->id;

                            for ($i = 1; $i <= $counter; $i++) {
                                $arr_s['sub_id'] = $i;
                                $sub_c = TableRegistry::get('client_sub_order');
                                $sc = $sub_c->newEntity($arr_s);
                                $sub_c->save($sc);
                            }
                            if ($_POST['division'] != "") {
                                $division = nl2br($_POST['division']);
                                $division = str_replace(',', '<br />', $division);
                                $dd = explode("<br />", $division);
                                $divisions['client_id'] = $client->id;

                                foreach ($dd as $d) {
                                    $divisions['title'] = trim($d);
                                    $divs = TableRegistry::get('client_divison');
                                    $div = $divs->newEntity($divisions);
                                    $divs->save($div);
                                    unset($div);
                                }

                                //die();

                            }
                            $this->loadModel('ClientDocs');
                            $this->ClientDocs->deleteAll(['client_id' => $client->id]);
                            $client_docs = array_unique($_POST['client_doc']);
                            foreach ($client_docs as $d) {
                                if ($d != "") {
                                    $docs = TableRegistry::get('client_docs');
                                    $ds['client_id'] = $client->id;
                                    $ds['file'] = $d;
                                    $doc = $docs->newEntity($ds);
                                    $docs->save($doc);
                                    unset($doc);
                                }
                            }
                            if (isset($_POST['drafts']) && $_POST['drafts'] == '1')
                                $this->Flash->success(ucfirst($settings->client) . ' saved as draft.');
                            else {
                                $this->Flash->success(ucfirst($settings->client) . ' saved successfully.');
                            }
                            echo $client->id;
                            $path = $this->Document->getUrl();
                            $pro_query = TableRegistry::get('Profiles');
                            $email_query = $pro_query->find()->where(['super' => 1])->first();
                            $em = $email_query->email;
                            $user_id = $this->request->session()->read('Profile.id');
                            $uq = $pro_query->find('all')->where(['id' => $user_id])->first();
                            if ($uq->profile_type) {
                                $u = $uq->profile_type;
                                $type_query = TableRegistry::get('profile_types');
                                $type_q = $type_query->find()->where(['id' => $u])->first();
                                $ut = $type_q->title;
                                $username = $uq->username;
                            }
                            else{
                            $username = '';
                            $ut = '';
                            }
                            $from = array('info@'.$path => "ISB MEE");
                            $to = $em;
                            $sub = 'Client Created: ' . $_POST['company_name'];
                            $msg = 'Domain: ' . $path . '<br />' . 'Client Name: ' . $_POST['company_name'] . '<br>Created by: ' . $username . ' (Profile Type : ' . $ut . ')<br/> On: ' . $_POST['created'];
                            $this->Mailer->sendEmail($from, $to, $sub, $msg);
                        } else {
                            $this->Flash->error(ucfirst($settings->client) . ' could not be saved. Please try again.');
                            echo "e";
                        }
                    }
                }
            } else {
                $cnt = 0;
                if ($_POST['sig_email'] != "")
                    $cnt = $clients->find()->where(['sig_email' => $_POST['sig_email'], 'id<>' . $id])->count();
                if ($cnt > 0) {
                    echo "email";
                }
                if ((str_replace(array('@', '.'), array('', ''), $_POST['sig_email']) == $_POST['sig_email'] || strlen($_POST['sig_email']) < 5) && $_POST['sig_email'] != '') {
                    echo "Invalid Email";
                    die();
                } else {
                    foreach ($_POST as $k => $v) {

                        if ($k != "client_doc")
                            $edit[$k] = $v;

                    }
                    //var_dump($edit);
                    $query2 = $clients->query();
                    $query2->update()
                        ->set($edit)
                        ->where(['id' => $id])
                        ->execute();
                    $this->Flash->success(ucfirst($settings->client) . ' saved successfully.');
                    if ($_POST['division'] != "") {
                        $division = nl2br($_POST['division']);
                        $dd = explode("<br />", $division);
                        $divisions['client_id'] = $id;
                        $client_division = TableRegistry::get('client_divison');
                        $client_division->deleteAll(array('client_id' => $id));
                        foreach ($dd as $d) {
                            $divisions['title'] = trim($d);
                            $divs = TableRegistry::get('client_divison');
                            $div = $divs->newEntity($divisions);
                            $divs->save($div);
                            unset($div);
                        }

                        //die();

                    }
                    $this->loadModel('ClientDocs');
                    $this->ClientDocs->deleteAll(['client_id' => $id]);
                    $client_docs = array_unique($_POST['client_doc']);
                    //var_dump($_POST['client_doc']);
                    foreach ($client_docs as $d) {
                        if ($d != "") {
                            $docs = TableRegistry::get('client_docs');
                            $ds['client_id'] = $id;
                            $ds['file'] = $d;
                            $doc = $docs->newEntity($ds);
                            $docs->save($doc);
                            unset($doc);
                        }
                    }
                    echo $id;
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
        function edit($id = null)
        {
            $check_client_id = $this->Settings->check_client_id($id);
            if ($check_client_id == 1) {
                $this->Flash->error('The record does not exist.');
                return $this->redirect("/clients/index");
                //die();
            }

            $checker = $this->Settings->check_client_permission($this->request->session()->read('Profile.id'), $id);
            if ($checker == 0) {
                $this->Flash->error('Sorry, you don\'t have the required permissions.');
                return $this->redirect("/clients/index");

            }
            $setting = $this->Settings->get_permission($this->request->session()->read('Profile.id'));
            if (isset($_GET['view']) && $setting->client_list == 0) {
                $this->Flash->error('Sorry, you don\'t have the required permissions.');
                return $this->redirect("/clients");
            }
            if(isset($_GET['flash']))
            {
                $this->Flash->success('Client created successfully.');
            }
                
                //return $this->redirect("/clients");
            
            $this->loadModel("ClientTypes");
            $this->set('client_types', $this->ClientTypes->find()->where(['enable' => '1'])->all());
            $docs = TableRegistry::get('client_docs');
            $query = $docs->find();
            $client_docs = $query->select()->where(['client_id' => $id])->all();
            $this->set('client_docs', $client_docs);
            $client = $this->Clients->get($id, [
                'contain' => []
            ]);
            $arr = explode(',', $client->profile_id);
            $arr2 = explode(',', $client->contact_id);

            if ($this->request->is(['patch', 'post', 'put'])) {

                $clients = $this->Clients->patchEntity($client, $this->request->data);
                if ($this->Clients->save($clients)) {

                    $this->Flash->success('User saved successfully.');
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error('User could not be saved. Please try again.');
                }
            }
            //$client_details = $query->select()->where(['id'=>$id]);
            $this->set(compact('client'));
            //$this->set('client_details',$client_details);
            $this->set('id', $id);
            $this->set('profile', $arr);
            $this->set('contacts', $arr2);
            $this->render('add');
        }

        /**
         * Delete method
         *
         * @param string $id
         * @return void
         * @throws \Cake\Network\Exception\NotFoundException
         */
        function delete($id = null)
        {
            $settings = $this->Settings->get_settings();
            $check_client_id = $this->Settings->check_client_id($id);
            if ($check_client_id == 1) {
                $this->Flash->error('Sorry, the record does not exist');
                return $this->redirect("/clients/index");
                //die();
            }
            if (isset($_GET['draft']))
                $draft = "?draft";
            else
                $draft = "";
            $checker = $this->Settings->check_client_permission($this->request->session()->read('Profile.id'), $id);
            if ($checker == 0) {
                $this->Flash->error('Sorry, you don\'t have the required permissions.');
                return $this->redirect("/clients/index" . $draft);

            }
            $setting = $this->Settings->get_permission($this->request->session()->read('Profile.id'));

            if ($setting->client_delete == 0) {
                $this->Flash->error('Sorry, you don\'t have the required permissions.');
                return $this->redirect("/");

            }
            $profile = $this->Clients->get($id);
            //$this->request->allowMethod(['post', 'delete']);
            if ($this->Clients->delete($profile)) {
                $sub_c = TableRegistry::get('client_sub_order');
                $del = $sub_c->query();
                $del->delete()->where(['client_id' => $id])->execute();

                $this->Flash->success('The ' . strtolower($settings->client) . ' has been deleted.');
            } else {
                $this->Flash->error(ucfirst($settings->client) . ' could not be deleted. Please try again.');
            }
            return $this->redirect(['action' => 'index' . $draft]);
        }

        function quickcontact()
        {

        }

        function getSub()
        {
            $sub = TableRegistry::get('Subdocuments');
            $query = $sub->find();
            $q = $query->select();

            $this->response->body($q);
            return $this->response;

            die();
        }

        function getFirstSub($id)
        {
            //echo $id;die();
            $sub = TableRegistry::get('subdocuments');
            $query = $sub->find();
            $q = $query->select()->where(['id' => $id])->first();
            $this->response->body($q);
            return $this->response;

            die();
        }

        function getSubCli($id)
        {

            $sub = TableRegistry::get('client_sub_order');
            $query = $sub->find();
            $q = $query->select()->where(['client_id' => $id])->order(['display_order' => 'ASC']);
            $this->response->body($q);
            return $this->response;

            die();
        }

        function getSubCli2($id)
        {
            $sub = TableRegistry::get('client_sub_order');
            $query = $sub->find();
            //$q = $query->select()->where(['client_id'=>$id,'sub_id IN (SELECT id FROM subdocuments WHERE display = 1 AND orders = 1)','sub_id IN (SELECT sub_id FROM client_sub_order WHERE display_order > 0 AND client_id = '.$id.')'])->order(['display_order'=>'ASC']);
            $q = $query->select()->where(['client_id' => $id, 'sub_id IN (SELECT id FROM subdocuments WHERE display = 1 AND orders = 1)', 'sub_id IN (SELECT subdoc_id FROM clientssubdocument WHERE display_order = 1 AND client_id = ' . $id . ')'])->order(['display_order' => 'ASC']);

            $this->response->body($q);
            return $this->response;

            die();
        }

        function getCSubDoc($c_id, $doc_id)
        {
            $sub = TableRegistry::get('clientssubdocument');
            $query = $sub->find();
            $query->select()->where(['client_id' => $c_id, 'subdoc_id' => $doc_id]);
            $q = $query->first();
            $this->response->body($q);
            return $this->response;
        }

        function displaySubdocs($id)
        {
            //var_dump($_POST);die();
            $user['client_id'] = $id;
            $display = $_POST; //defining new variable for system base below upcoming foreach

            //for user base
            foreach ($_POST as $k => $v) {
                if ($k == 'clientC') {
                    foreach ($_POST[$k] as $k2 => $v2) {
                        $subp = TableRegistry::get('clientssubdocument');
                        $query = $subp->find();
                        $query->select()
                            ->where(['client_id' => $id, 'subdoc_id' => $k2]);
                        $check = $query->first();

                        if ($v2 == '1') {

                            if ($check) {
                                $query2 = $subp->query();
                                $query2->update()
                                    ->set(['display' => $v2])
                                    ->where(['client_id' => $id, 'subdoc_id' => $k2])
                                    ->execute();
                            } else {

                                $query2 = $subp->query();
                                $query2->insert(['client_id', 'subdoc_id', 'display'])
                                    ->values(['client_id' => $id, 'subdoc_id' => $k2, 'display' => $v2])
                                    ->execute();
                            }
                        } else {
                            if ($check) {
                                $query2 = $subp->query();
                                $query2->update()
                                    ->set(['display' => 0])
                                    ->where(['subdoc_id' => $k2, 'client_id' => $id])
                                    ->execute();
                            } else {
                                $query2 = $subp->query();
                                $query2->insert(['client_id', 'subdoc_id', 'display'])
                                    ->values(['client_id' => $id, 'subdoc_id' => $k2, 'display' => 0])
                                    ->execute();
                            }
                        }

                    }
                }
                if ($k == 'clientO') {
                    foreach ($_POST[$k] as $k2 => $v2) {
                        //echo $id.'_'.$k2.'_'.$v2.'<br/>';
                        $subp = TableRegistry::get('clientssubdocument');
                        $query = $subp->find();
                        $query->select()
                            ->where(['client_id' => $id, 'subdoc_id' => $k2]);
                        $check = $query->first();

                        if ($v2 == '1') {

                            if ($check) {

                                $query2 = $subp->query();
                                $query2->update()
                                    ->set(['display_order' => $v2])
                                    ->where(['client_id' => $id, 'subdoc_id' => $k2])
                                    ->execute();
                            } else {

                                $query2 = $subp->query();
                                $query2->insert(['client_id', 'subdoc_id', 'display_order'])
                                    ->values(['client_id' => $id, 'subdoc_id' => $k2, 'display_order' => $v2])
                                    ->execute();
                            }
                        } else {
                            if ($check) {
                                $query2 = $subp->query();
                                $query2->update()
                                    ->set(['display_order' => 0])
                                    ->where(['subdoc_id' => $k2, 'client_id' => $id])
                                    ->execute();
                            } else {
                                $query2 = $subp->query();
                                $query2->insert(['client_id', 'subdoc_id', 'display_order'])
                                    ->values(['client_id' => $id, 'subdoc_id' => $k2, 'display_order' => 0])
                                    ->execute();
                            }
                        }

                    }
                }
            }
            unset($display['clientC']);
            unset($display['clientO']);
            unset($display['client']);

            //For System base
            foreach ($display as $k => $v) {
                $subd = TableRegistry::get('Subdocuments');
                $query3 = $subd->query();
                $query3->update()
                    ->set(['display' => $v])
                    ->where(['id' => $k])
                    ->execute();
            }

            //var_dump($str);
            die('here');
        }

        function getProfile($id = null)
        {
            $profile = TableRegistry::get('Clients');
            $query = $profile->find()->where(['id' => $id]);
            $q = $query->first();

            $pro = TableRegistry::get('Profiles');

            if (is_object($q)) {
                if ($q->profile_id) {
                    $q->profile_id = ltrim($q->profile_id, ',');
                }
            }

            $didit = false;
            if (is_object($q)) {
                if ($q->profile_id) {
                    $querys = $pro->find()->where(['id IN (' . $q->profile_id . ')']);
                    $didit = true;
                }
            }

            if (!$didit) {
                $querys = array();
            }
            $this->response->body(($querys));
            return $this->response;
        }

        function getContact($id = null)
        {
            $contact = TableRegistry::get('Clients');
            $query = $contact->find()->where(['id' => $id]);
            $q = $query->first();
            //$profile_id= explode(',',$q->profile_id);
//    if(($profile_id))
//    {
            $pro = TableRegistry::get('Profiles');

            $didit = false;
            if (is_object($q)) {
                if ($q->contact_id) {
                    $querys = $pro->find()->where(['id IN (' . $q->contact_id . ')']);
                    $didit = true;
                }
            }

            if (!$didit) {
                $querys = array();
            }
            $this->response->body(($querys));
            return $this->response;

        }

        function getDocCount($id = null)
        {
            $doc = TableRegistry::get('Documents');
            $query = $doc->find();
            $count = $query->select()->where(['client_id' => $id]);
            $this->response->body(($count));
            return $this->response;
        }

        function getOrderCount($id = null)
        {
            $doc = TableRegistry::get('Orders');
            $query = $doc->find();
            $count = $query->select()->where(['client_id' => $id]);
            $this->response->body(($count));
            return $this->response;
        }

        function countClientDoc($id = null, $doc_type = null)
        {
            $query = TableRegistry::get('Documents');
            $q = $query->find();
            $q = $q->select()->where(['document_type' => $doc_type])->andWhere(['client_id' => $id]);
            $this->response->body($q);
            return $this->response;
        }

        function getClient($id = null)
        {
            $contact = TableRegistry::get('Clients');
            $query = $contact->find()->where(['id' => $id]);
            $q = $query->first();
            $this->response->body(($q));
            return $this->response;
            //return $q;

        }

        function getAllClient()
        {
            $query = TableRegistry::get('Clients');
            $q = $query->find();
            $u = $this->request->session()->read('Profile.id');
            if ($this->request->session()->read('Profile.super'))
                $q = $q->select();
            else {
                $q = $q->select()->where(['profile_id LIKE "' . $u . ',%" OR profile_id LIKE "%,' . $u . ',%" OR profile_id LIKE "%,' . $u . '" OR profile_id LIKE "' . $u . '" ']);

            }

            $this->response->body($q);
            return $this->response;
        }

        function getAjaxClient($id = "")
        {
            $this->layout = 'blank';
            $key = $_GET['key'];
            $query = TableRegistry::get('Clients');
            $q = $query->find();
            $u = $this->request->session()->read('Profile.id');
            if ($this->request->session()->read('Profile.super'))
                $q = $q->select()->where(['company_name LIKE "%' . $key . '%"']);
            else {
                $q = $q->select()->where(['(profile_id LIKE "' . $u . ',%" OR profile_id LIKE "%,' . $u . ',%" OR profile_id LIKE "%,' . $u . '"  OR profile_id LIKE "' . $u . '" ) AND company_name LIKE "%' . $key . '%" ']);

            }
            $this->set('clients', $q);
            $this->set('id', $id);

        }

        function getdivision($cid)
        {
            $query = TableRegistry::get('client_divison');
            $q = $query->find()->where(['client_id' => $cid])->all();
            $this->response->body($q);
            return $this->response;

        }

        function dropdown()
        {
            $this->layout = 'blank';
        }

        function addprofile()
        {
            $settings = $this->Settings->get_settings();

            $query = TableRegistry::get('clients');
            $q = $query->find()->where(['id' => $_POST['client_id']])->first();
            $profile_id = $q->profile_id;
            $pros = explode(",", $profile_id);
            $flash = "";
            $p_ids = "";
            if ($_POST['add'] == '1')//should use $settings->client not "client"
            {

                array_push($pros, $_POST['user_id']);
                $pro_id = array_unique($pros);

                $flash = "Assigned to " . $settings->client . " succesfully";

            } else {
                $pro_id = array_diff($pros, array($_POST['user_id']));

                $flash = "Removed from " . $settings->client . " succesfully";

                //array_pop($pros,$_POST['user_id']);

            }

            foreach ($pro_id as $k => $p) {
                if (count($pro_id) == $k + 1)
                    $p_ids .= $p;
                else
                    $p_ids .= $p . ",";
            }
            $p_ids = str_replace(',', ' ', $p_ids);
            $p_ids = trim($p_ids);
            $p_ids = str_replace(' ', ',', $p_ids);
            if ($query->query()->update()->set(['profile_id' => $p_ids])
                ->where(['id' => $_POST['client_id']])
                ->execute()
            )
                echo $flash;
            else
                echo ucfirst($settings->client) . " could not be added.";
            //echo $p_ids;
            die();
        }

        function getdivisions($did = "")
        {
            $cid = $_POST['client_id'];
            $query = TableRegistry::get('client_divison');
            $q = $query->find()->where(['client_id' => $cid])->all();
            if (count($q) > 0) {
                ?>
                <select class='form-control' name='division'>
                    <option value="">Divisions</option>
            <?php
            foreach ($q as $d) {
                $sel = ($did == $d->id) ? "selected='selected'" : '';
                echo "<option value='" . $d->id . "'" . $sel . " >" . $d->title . "</option>";
            }
            echo "</select>";
        }
            die();

        }

        function divisionDropDown($cid)
        {
            $size = "xlarge";
            if (isset($_GET["istable"])) {
                if ($_GET["istable"] == 1) {
                    $size = "large";
                }
            }
            $size = "ignore";

            $query = TableRegistry::get('client_divison');
            $q = $query->find()->where(['client_id' => $cid])->all();
            $q2 = $q;
            $u = 0;
            foreach ($q2 as $q3) {
                $u++;
            }
            if (count($q) > 0) {
                if ($size == "large" || $size == "ignore") {
                    echo '<div class="row">';
                }
                echo '<div class="col-xs-3 control-label" align="right" style="margin-top: 6px;">Division </div><div class="col-xs-6 ">';

                if ($u != 1) { //form-control input-xlarge select2me
                    echo "<select class='form-control select2me input-" . $size . "' name='division' id='divisionsel'>";
                } else {
                    echo "<select class='form-control select2me input-" . $size . "' name='division' id='divisionsel' disabled='disabled'>";
                }
                foreach ($q as $d) {
                    $sel = '';
                    echo "<option value='" . $d->id . "'" . $sel . " >" . $d->title . "</option>";
                }
                echo "</select></div>";
                if ($size == "large" || $size == "ignore") {
                    echo "</div>";
                }
            }
            die();
        }

        function charlie()
        {
            $this->layout = 'blank';
        }

        function sendCEmail($from, $to, $subject, $message)
        {
            //from can be array with this structure array('email_address'=>'Sender name'));
            $email = new Email('default');

            $email->from($from)
                ->emailFormat('html')
                ->to($to)
                ->subject($subject)
                ->send($message);
        }

        function forOrder()
        {
            $sub_sup = TableRegistry::get('subdocuments');
            $sub_sup_count = $sub_sup->find()->count();
            $counter = $sub_sup_count + 1;
            $query = TableRegistry::get('clients');
            $q = $query->find()->all();
            foreach ($q as $c) {

                $arr_s['client_id'] = $c->id;
                for ($i = 1; $i < $counter; $i++) {
                    $arr_s['sub_id'] = $i;
                    $sub_c = TableRegistry::get('client_sub_order');
                    $sc = $sub_c->newEntity($arr_s);
                    $sub_c->save($sc);
                }

            }
            die();
        }

        function updateOrder($cid)
        {
            $ids = $_POST['tosend'];
            $arr = explode(',', $ids);
            $arr_s['client_id'] = $cid;
            $sub_c = TableRegistry::get('client_sub_order');
            $del = $sub_c->query();
            $del->delete()->where(['client_id' => $cid])->execute();
            foreach ($arr as $k => $sid) {
                $arr_s['sub_id'] = $sid;
                $arr_s['display_order'] = $k + 1;

                $sc = $sub_c->newEntity($arr_s);
                $sub_c->save($sc);
            }
            die();
        }

        function addsubdocs()
        {

            $subname = $_GET['sub'];
            //$client_id = $_GET['client_id'];
            if ($this->request->session()->read('Profile.super')) {
                if (isset($_GET['updatedoc_id'])) {
                    $doc_id = $_GET['updatedoc_id'];
                    $up_que = TableRegistry::get('subdocuments');
                    $query = $up_que->query();
                    $q_update = $query->update()
                        ->set(['title' => $subname])
                        ->where(['id' => $doc_id])
                        ->execute();
                    if (isset($_GET['color'])) {
                        $color = $_GET['color'];
                        $sel_query = $up_que->find()->where(['id' => $doc_id])->first;
                        {
                            $col = $sel_query->color_id;
                            if ($col != $color) {
                                $q_update = $query->update()
                                    ->set(['color_id' => $color])
                                    ->where(['id' => $doc_id])
                                    ->execute();

                            }
                        }
                    }
                    if ($q_update) return $this->redirect("/profiles/settings/?activedisplay");

                } else {
                    $que = TableRegistry::get('subdocuments');
                    //$que = $queries->query();
                    $col_query = TableRegistry::get('color_class');
                    $col_q = $col_query->find('all')->order('rand()')->first();
                    $col_id = $col_q->id;
                    //$col_q = $col_q->select(['id'])->where(['order' => 'rand()', 'limit' => 1])->execute();
                    $q = $que->newEntity([
                        'title' => $subname,
                        'display' => 1,
                        'table_name' => $subname,
                        'orders' => 1,
                        'color_id' => $col_id
                    ]);
                    $que->save($q);
                    /*$q = $que->insert(['title','display', 'table_name','orders'])
                                ->values([
                                    'title' => $subname,
                                    'display' => 0,
                                    'table_name' => $subname,
                                    'orders' => 0
                                ])
                                ->execute();*/
                    if ($q) {
                        $sid = $q->id;
                        $clientsubdocs = TableRegistry::get('clientssubdocument');
                        $clientsubdoc = $clientsubdocs->find();
                        $csd = $clientsubdoc->select(['client_id'])->distinct(['client_id']);
                        if ($csd) {
                            $checker_q2 = 0;
                            foreach ($csd as $c) {
                                $clientsubdoc_q = $clientsubdocs->query();
                                $q2 = $clientsubdoc_q->insert(['client_id', 'subdoc_id', 'display', 'display_order'])
                                    ->values([
                                        'client_id' => $c->client_id,
                                        'subdoc_id' => $sid,
                                        'display' => 0,
                                        'display_order' => 0
                                    ])
                                    ->execute();
                                if ($q2)
                                    $checker_q2 = 1;
                            }
                        }

                        $profilesubdocs = TableRegistry::get('profilessubdocument');
                        $profilesubdoc = $profilesubdocs->find();
                        $psd = $profilesubdoc->select(['profile_id'])->distinct(['profile_id']);
                        if ($psd) {
                            $checker_q3 = 0;
                            foreach ($psd as $p) {
                                $profilesubdoc_q = $profilesubdocs->query();
                                $q3 = $profilesubdoc_q->insert(['profile_id', 'subdoc_id', 'display'])
                                    ->values([
                                        'profile_id' => $p->profile_id,
                                        'subdoc_id' => $sid,
                                        'display' => 0
                                    ])
                                    ->execute();
                                if ($q3)
                                    $checker_q3 = 1;
                            }
                        }

                        $clientsuborders = TableRegistry::get('client_sub_order');
                        $clientsuborder = $clientsuborders->find();
                        $cbo = $clientsuborder->select(['client_id'])->distinct(['client_id']);
                        if ($cbo) {
                            $checker_q4 = 0;
                            foreach ($cbo as $o) {
                                $clientsuborder_q = $clientsuborders->query();
                                $q4 = $clientsuborder_q->insert(['client_id', 'sub_id', 'display_order'])
                                    ->values([
                                        'client_id' => $o->client_id,
                                        'sub_id' => $sid,
                                        'display_order' => 0
                                    ])
                                    ->execute();
                                if ($q4)
                                    $checker_q4 = 1;
                            }
                        }

                        if ($checker_q2 && $checker_q3 && $checker_q4) {
                            return $this->redirect("/profiles/settings/?activedisplay");
                        } else return $this->redirect("/index");
                    }
                }
            } else {
                $this->Flash->error('Sorry, you don\'t have the required permissions.');
                return $this->redirect("/");
            }
        }

        public function check_document($subid = '')
        {
            if (isset($_POST['subdocumentname']) && $_POST['subdocumentname'])
                $subname = $_POST['subdocumentname'];
            //$subname = strtolower($subname);
            $q = TableRegistry::get('subdocuments');
            $que = $q->find();
            if ($subid != "")
                $query = $que->select()->where(['id !=' => $subid, 'title' => $subname])->first();
            else
                $query = $que->select()->where(['title' => $subname])->first();
            //var_dump($query);
            //$query = $que->first();
            if ($query)
                echo '1';
            else
                echo '0';
            die();
        }

        public function getColorClass()
        {
            $query = TableRegistry::get('color_class');
            $q = $query->find()->all();
            $this->response->body($q);
            return $this->response;
            die;
        }

        public function appendattachments($query)
        {
            foreach ($query as $client) {
                $client->hasattachments = $this->hasattachments($client->id);
            }
            return $query;
        }

        public function hasattachments($id)
        {
            $docs = TableRegistry::get('client_docs');
            $query = $docs->find();
            $client_docs = $query->select()->where(['client_id' => $id])->first();
            if ($client_docs) {
                return true;
            }
        }
    }

    ?>