<?php
    namespace App\Controller;

    use App\Controller\AppController;
    use Cake\Event\Event;
    use Cake\Controller\Controller;
    use Cake\ORM\TableRegistry;

    include(APP . '../webroot/subpages/soap/nusoap.php');
    if ($_SERVER['SERVER_NAME'] == "localhost" || $_SERVER['SERVER_NAME'] == "127.0.0.1") { include_once('/subpages/api.php'); } else { include_once('subpages/api.php'); }

    class DocumentsController extends AppController
    {

        public $paginate = [
            'limit' => 10,
            'order' => ['id' => 'DESC'],
        ];
        
        public function initialize()
        {
            parent::initialize();
            $this->loadComponent('Settings');
            $this->loadComponent('Document');
            $this->loadComponent('Mailer');
            if (!$this->request->session()->read('Profile.id')) {
                $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                $this->redirect('/login?url='.urlencode($url));
            }

        }

        public function index()
        {
            $cond = '';
            $this->set('doc_comp',$this->Document);
            $setting = $this->Settings->get_permission($this->request->session()->read('Profile.id'));
            $doc = $this->Document->getDocumentcount();
            $cn = $this->Document->getUserDocumentcount();
            if ($setting->document_list == 0 || count($doc) == 0 || $cn == 0) {
                $this->Flash->error('Sorry, you don\'t have the required permissions to view documents. Please enable them in your settings');
                return $this->redirect("/");

            }
            if (!$this->request->session()->read('Profile.super')) {
                $u = $this->request->session()->read('Profile.id');
                $setting = $this->Settings->get_permission($u);
                if ($setting && $setting->document_others == 0) {
                    
                    if ($cond == '')
                        $cond = $cond . ' user_id = ' . $u;
                    else
                        $cond = $cond . ' AND user_id = ' . $u;
                    
                }
                

            }
           
             $sess = $this->request->session()->read('Profile.id');      
            $docs = TableRegistry::get('Documents');
            $cls = TableRegistry::get('Clients');
            //$attachments = TableRegistry::get('attachments');

            $cl = $cls->find()->where(['(profile_id LIKE "'.$sess.',%" OR profile_id LIKE "%,'.$sess.',%" OR profile_id LIKE "%,'.$sess.'%")'])->all();
            $cli_id = '999999999';
            foreach($cl as $cc)
            {
                $cli_id = $cli_id.','.$cc->id;
            }
            $doc = $docs->find();
            $doc = $doc->select()->where(['(order_id = 0 OR (order_id <> 0 AND order_id IN (SELECT id FROM orders)))']);
            if (isset($_GET['draft'])) {
                $doc = $doc->select()->where(['draft' => 1, '(order_id = 0 OR (order_id <> 0 AND order_id IN (SELECT id FROM orders)))']);
            } /*else {
                $doc = $doc->select()->where(['draft' => 0, '(order_id = 0 OR (order_id <> 0 AND order_id IN (SELECT id FROM orders)))']);
                
            }*/
            $cond = '';

            if (isset($_GET['searchdoc']) && $_GET['searchdoc']) {
                $cond = $cond . ' (title LIKE "%' . $_GET['searchdoc'] . '%" OR document_type LIKE "%' . $_GET['searchdoc'] . '%" OR description LIKE "%' . $_GET['searchdoc'] . '%")';
            }
            if (!$this->request->session()->read('Profile.admin') && $setting->document_others == 0) {
                if ($cond == '')
                    $cond = $cond . ' user_id = ' . $this->request->session()->read('Profile.id');
                else
                    $cond = $cond . ' AND user_id = ' . $this->request->session()->read('Profile.id');
            }
            if (!$this->request->session()->read('Profile.admin') && $setting->document_others == 1) {
                if ($cond == '')
                    $cond = $cond . ' client_id IN ('.$cli_id.')';
                else
                    $cond = $cond . ' AND client_id IN ('.$cli_id.')';
            }
            
            if (isset($_GET['submitted_by_id']) && $_GET['submitted_by_id']) {
                if ($cond == '')
                    $cond = $cond . ' user_id = ' . $_GET['submitted_by_id'];
                else
                    $cond = $cond . ' AND user_id = ' . $_GET['submitted_by_id'];
            }
            
            if (isset($_GET['submitted_for_id']) && $_GET['submitted_for_id']) {
                if ($cond == '')
                    $cond = $cond . ' uploaded_for = ' . $_GET['submitted_for_id'];
                else
                    $cond = $cond . ' AND uploaded_for = ' . $_GET['submitted_for_id'];
            }
            
            if (isset($_GET['client_id']) && $_GET['client_id']) {
                if ($cond == '')
                    $cond = $cond . ' client_id = ' . $_GET['client_id'];
                else
                    $cond = $cond . ' AND client_id = ' . $_GET['client_id'];
            }
            /*if (isset($_GET['type']) && $_GET['type']) {
                if ($cond == '')
                    $cond = $cond . ' document_type = "' . $_GET['type'] . '"';
                else
                    $cond = $cond . ' AND document_type = "' . $_GET['type'] . '"';
            }*/
            if (isset($_GET['type']) && $_GET['type']) {
                if ($cond == '')
                    $cond = $cond . ' sub_doc_id = "' . $_GET['type'] . '"';
                else
                    $cond = $cond . ' AND sub_doc_id = "' . $_GET['type'] . '"';
            }

            if (isset($_GET['from']) && isset($_GET['to'])) {

                $f = date('Y-m-d h:i:s', strtotime($_GET['from']));
                $t = date('Y-m-d h:i:s', strtotime($_GET['to']));
                if ($cond == '')
                    $cond = $cond . ' (created >="' . $f . '" AND created <= "' . $t . '")';
                else
                    $cond = $cond . ' AND (created >="' . $f . '" AND created <= "' . $t . '")';
                // $this->set('start',$cond);

            }

            if($cond=='') {
                $cond = $cond . ' (order_id = 0 OR (order_id <> 0 AND order_id IN (SELECT id FROM orders)))';
            } else {
                $cond = $cond . ' AND (order_id = 0 OR (order_id <> 0 AND order_id IN (SELECT id FROM orders)))';
            }
            //$cond = $cond . " LEFT JOIN attachments ON attachments.document_id = Documents__id";
            // $attachments = TableRegistry::get('attachments');
            //$attachment = $attachments->find()->where(['document_id' => $did])->all();
            //$this->set('attachments', $attachment);

            if ($cond) {
                $doc = $doc->where([$cond]);
                //debug($doc);die();
            }

            if (isset($_GET['searchdoc'])) {
                $this->set('search_text', $_GET['searchdoc']);
            }
            if (isset($_GET['submitted_by_id'])) {
                $this->set('return_user_id', $_GET['submitted_by_id']);
            }
            if (isset($_GET['submitted_for_id'])) {
                $this->set('return_submitted_for_id', $_GET['submitted_for_id']);
            }
            if (isset($_GET['client_id'])) {
                $this->set('return_client_id', $_GET['client_id']);
            }
            if (isset($_GET['type'])) {
                $this->set('return_type', $_GET['type']);
            }
            $this->set('documents', $this->appendattachments($this->paginate($doc)));
            if (isset($_GET['flash'])) {
                $this->Flash->success('Document saved successfully.');
            }
        }

        public function view($cid = 0, $did = 0)
        {
            $this->set('doc_comp',$this->Document);
            if (!$this->request->session()->read('Profile.id')) {
                $this->redirect('/login');
            }
            else
            {
            $this->set('cid', $cid);
            $this->set('did', $did);
            $this->set('sid', '');
            if ($did) {
                $docs = TableRegistry::get('documents');
                $document = $docs->find()->where(['id' => $did])->first();
                $this->set('mod', $document);
                $att = TableRegistry::get('attach_docs');
                $query = $att->find();
                $attachments = $query->select()->where(['doc_id'=>$did])->all();
                $this->set('attachments',$attachments);
            }
            $doc = $this->Document->getDocumentcount();

                //debug($doc);
            $cn = $this->Document->getUserDocumentcount();
            $setting = $this->Settings->get_permission($this->request->session()->read('Profile.id'));
            $doc = $this->Document->getDocumentcount();
            $cn = $this->Document->getUserDocumentcount();
            if ($setting->document_list == 0 || count($doc) == 0 || $cn == 0) {
                $this->Flash->error('Sorry, you don\'t have the required permissions.');
                return $this->redirect("/");

            }
            /*$profile = $this->Clients->get($id);
            $this->set('profile', $profile);*/
            $this->set('disabled', 1);
            //$did=$id;
            if ($did) {
                $doc = TableRegistry::get('Documents');
                $query = $doc->find()->where(['id' => $did])->first();
                $query = $doc->find()->where(['id' => $did])->first();
                $sub_doc = TableRegistry::get('Subdocuments');
                $sd = $sub_doc->find()->all();
                
                foreach($sd as $s)
                {
                    if($s->id >12)
                    {
                        if ($query->sub_doc_id == $s->id) 
                        {
                            $mods = TableRegistry::get($s->table_name);
                            if(!isset($_GET['order_id']))                    
                                $mod = $mods->find()->where(['document_id' => $did])->first();
                            else
                                $mod = $mods->find()->where(['order_id' => $_GET['order_id']])->first();                                        
                            $this->set($s->table_name, $mod);
                        }
                    }   
                }
                if ($query->sub_doc_id == '6') {
                    $feeds = TableRegistry::get('feedbacks');
                    //$pre_at = TableRegistry::get('driver_application_accident');
                    if(!isset($_GET['order_id']))                    
                    $feed = $feeds->find()->where(['document_id' => $did])->first();
                    else
                    $feed = $feeds->find()->where(['order_id' => $_GET['order_id']])->first();                                        
                    $this->set('feeds', $feed);
                } elseif ($query->sub_doc_id == '5') {

                    $survey = TableRegistry::get('Survey');
                    //$pre_at = TableRegistry::get('driver_application_accident');
                    if(!isset($_GET['order_id']))                    
                    $sur = $survey->find()->where(['document_id' => $did])->first();
                    else
                    $sur = $survey->find()->where(['order_id' => $_GET['order_id']])->first();                                                            
                    
                                                                                
                    $this->set('survey', $sur);
                } elseif ($query->sub_doc_id == '7') {
                    $attachments = TableRegistry::get('attachments');
                    //$pre_at = TableRegistry::get('driver_application_accident');
                    if(!isset($_GET['order_id']))                    
                    $attachment = $attachments->find()->where(['document_id' => $did])->all();
                    else
                    $attachment = $attachments->find()->where(['order_id' => $_GET['order_id']])->all();                                        
                    $this->set('attach', $attachment);
                }
                elseif ($query->sub_doc_id == '8') {
                    $attachments = TableRegistry::get('audits');
                    //$pre_at = TableRegistry::get('driver_application_accident');
                    if(!isset($_GET['order_id']))                    
                    $audits = $attachments->find()->where(['document_id' => $did])->first();
                    else
                    $audits = $attachments->find()->where(['order_id' => $_GET['order_id']])->first();                                        
                    $this->set('audits', $audits);
                }
                elseif ($query->sub_doc_id == '11') {
                    $attachments = TableRegistry::get('generic_forms');
                    //$pre_at = TableRegistry::get('driver_application_accident');
                    if(!isset($_GET['order_id']))                    
                    $audits = $attachments->find()->where(['document_id' => $did])->first();
                    else
                    $audits = $attachments->find()->where(['order_id' => $_GET['order_id']])->first();                                        
                    $this->set('generic', $audits);
                }
                elseif ($query->sub_doc_id == '12') {
                    $attachments = TableRegistry::get('abstract_forms');
                    //$pre_at = TableRegistry::get('driver_application_accident');
                    if(!isset($_GET['order_id']))                    
                    $audits = $attachments->find()->where(['document_id' => $did])->first();
                    else
                    $audits = $attachments->find()->where(['order_id' => $_GET['order_id']])->first();                                        
                    $this->set('abstract', $audits);
                   
                }                     
 
                $pre = TableRegistry::get('doc_attachments');
                //$pre_at = TableRegistry::get('driver_application_accident');
                if(!isset($_GET['order_id']))
                $pre_at['attach_doc'] = $pre->find()->where(['document_id' => $did])->all();
                else
                $pre_at['attach_doc'] = $pre->find()->where(['order_id' => $_GET['order_id'],'sub_id'=>1])->all();
                $this->set('pre_at', $pre_at);

                $da = TableRegistry::get('driver_application');
                if(!isset($_GET['order_id']))
                $da_detail = $da->find()->where(['document_id' => $did])->first();
                else
                $da_detail = $da->find()->where(['order_id' => $_GET['order_id']])->first();
                if ($da_detail) {
                    $da_ac = TableRegistry::get('driver_application_accident');
                    $sub['da_ac_detail'] = $da_ac->find()->where(['driver_application_id' => $da_detail->id])->all();

                    $da_li = TableRegistry::get('driver_application_licenses');
                    $sub['da_li_detail'] = $da_li->find()->where(['driver_application_id' => $da_detail->id])->all();

                    $da_at = TableRegistry::get('doc_attachments');
                    if(!isset($_GET['order_id']))
                    $sub['da_at'] = $da_at->find()->where(['document_id' => $did])->all();
                    else
                    $sub['da_at'] = $da_at->find()->where(['order_id' => $_GET['order_id'],'sub_id'=>2])->all();

                    

                    $this->set('sub', $sub);
                }
                $de = TableRegistry::get('road_test');
                if(!isset($_GET['order_id']))
                $de_detail = $de->find()->where(['document_id' => $did])->first();
                else
                $de_detail = $de->find()->where(['order_id' => $_GET['order_id']])->first();
                if ($de_detail) {
                   $de_at = TableRegistry::get('doc_attachments');
                   if(!isset($_GET['order_id']))
                    $sub['de_at'] = $de_at->find()->where(['document_id' => $did])->all(); 
                    else
                    $sub['de_at'] = $de_at->find()->where(['order_id' => $_GET['order_id'],'sub_id'=>3])->all();
                    $this->set('sub', $sub);
                }
                
                
                $con = TableRegistry::get('consent_form');
                if(!isset($_GET['order_id']))
                $con_detail = $con->find()->where(['document_id' => $did])->first();
                else
                $con_detail = $con->find()->where(['order_id' => $_GET['order_id']])->first();
                if ($con_detail) {
                    //echo $con_detail->id;die();
                    $con_cri = TableRegistry::get('consent_form_criminal');
                    $sub2['con_cri'] = $con_cri->find()->where(['consent_form_id' => $con_detail->id])->all();

                    $con_at = TableRegistry::get('doc_attachments');
                    if(!isset($_GET['order_id']))
                    $sub2['con_at'] = $con_at->find()->where(['document_id' => $did])->all();
                    else
                    $sub2['con_at'] = $con_at->find()->where(['order_id' => $_GET['order_id'],'sub_id'=>4])->all();
                    $this->set('sub2', $sub2);
                    $this->set('consent_detail', $con_detail);

                }
                $emp = TableRegistry::get('employment_verification');
                if(!isset($_GET['order_id']))
                $sub3['emp'] = $emp->find()->where(['document_id' => $did])->all();
                else
                $sub3['emp'] = $emp->find()->where(['order_id' => $_GET['order_id']])->all();

                //echo $con_detail->id;die();
                $emp_att = TableRegistry::get('doc_attachments');
                if(!isset($_GET['order_id']))
                $sub3['att'] = $emp_att->find()->where(['document_id' => $did])->all();
                else
                $sub3['att'] = $emp_att->find()->where(['order_id' => $_GET['order_id'],'sub_id'=>41])->all();

                $this->set('sub3', $sub3);

                $edu = TableRegistry::get('education_verification');
                if(!isset($_GET['order_id']))
                $sub4['edu'] = $edu->find()->where(['document_id' => $did])->all();
                else
                $sub4['edu'] = $edu->find()->where(['order_id' => $_GET['order_id']])->all();
                //echo $con_detail->id;die();
                $edu_att = TableRegistry::get('doc_attachments');
                if(!isset($_GET['order_id']))
                $sub4['att'] = $edu_att->find()->where(['document_id' => $did])->all();
                else
                $sub4['att'] = $edu_att->find()->where(['order_id' => $_GET['order_id'],'sub_id'=>41])->all();
                $this->set('sub4', $sub4);
            }
            $this->render('add');
            }
        }
        
        public function savedoc($cid = 0, $did = 0)
        {
            $this->set('doc_comp',$this->Document);
            $this->Document->savedoc($cid,$did);
            die();
        }
        

        public function savePrescreening()
        {
            $this->Document->savePrescreening();
            die;
        }

        /**
         * saving driver application data
         */
        public function savedDriverApp($document_id = 0, $cid = 0)
        {
            $this->Document->savedDriverApp($document_id,$cid);

            die;
        }

        /**
         * saving driver application data
         */
        public function savedDriverEvaluation($document_id = 0, $cid = 0)
        {
           $this->Document->savedDriverEvaluation($document_id,$cid); 
           die();
        }

        /**
         * saving driver application data
         */
        public function savedMeeOrder($document_id = 0, $cid = 0)
        {
            $this->Document->savedMeeOrder($document_id,$cid); 
           die();
        }

        function saveEmployment($document_id = 0, $cid = 0)
        {
            $this->Document->saveEmployment($document_id,$cid); 
           die();
        }

        function saveEducation($document_id = 0, $cid = 0)
        {
            $this->Document->saveEducation($document_id,$cid); 
           die();
        }

        
       
        

        function add($cid = 0, $did = 0, $type = NULL)
        {
            $this->set('doc_comp',$this->Document);
            $this->set('cid', $cid);
            $this->set('did', $did);
            $this->set('sid', '');
            $clients = TableRegistry::get('Clients');
            $c = $clients->find()->all();
            $this->set('clients', $c);
            if ($did) {
                $docs = TableRegistry::get('documents');
                $document = $docs->find()->where(['id' => $did])->first();
                $this->set('mod', $document);
                
                $att = TableRegistry::get('doc_attachments');
                $query = $att->find();
                $attachments = $query->select()->where(['document_id'=>$did])->all();
               
                $this->set('attachments',$attachments);
            }
            $doc = $this->Document->getDocumentcount();
            $cn = $this->Document->getUserDocumentcount();
            $setting = $this->Settings->get_permission($this->request->session()->read('Profile.id'));
            //var_dump($setting);die();
            if (is_null($type)) {
                // docu

                if ($did != 0) {

                    $doc = TableRegistry::get('Documents');
                    $query = $doc->find()->where(['id' => $did])->first();
                    $this->set('document', $query);
                    if ($setting->document_edit == 0 || count($doc) == 0 || $cn == 0) {
                        $this->Flash->error('Sorry you don\'t have the required permissions to upload documents, please enable them in your settings.');
                        return $this->redirect("/");

                    }

                } else {
                    if ($setting->document_create == 0 || count($doc) == 0 || $cn == 0) {
                        $this->Flash->error('Sorry you don\'t have the required permissions to upload documents, please enable them in your settings.');
                        return $this->redirect("/");

                    }
                }
                if (isset($_POST['uploaded_for'])) {
                    $docs = TableRegistry::get('Documents');

                    $arr['uploaded_for'] = $_POST['uploaded_for'];
                    $arr['client_id'] = $cid;
                    if (isset($_POST['document_type']))
                        $arr['document_type'] = $_POST['document_type'];
                    $arr['created'] = date('Y-m-d H:i:s');

                    if (!$did || $did == '0') {
                        $arr['user_id'] = $this->request->session()->read('Profile.id');
                        $doc = $docs->newEntity($arr);
                        if ($docs->save($doc)) {
                            $this->Flash->success('The document has been saved.');
                            $this->redirect('/documents');
                        } else {
                            //$this->Flash->error('Client could not be saved. Please try again.');
                            //echo "e";
                        }

                    } else {
                        $query2 = $docs->query();
                        $query2->update()
                            ->set($arr)
                            ->where(['id' => $did])
                            ->execute();
                        $this->Flash->success('The document has been saved.');
                        $this->redirect('/documents');
                    }
                }
            } else {

                if ($did != 0) {

                    $doc = TableRegistry::get('orders');
                    $query = $doc->find()->where(['id' => $did])->first();
                    $this->set('document', $query);
                    if ($setting->document_edit == 0 || count($doc) == 0 || $cn == 0) {
                        $this->Flash->error('Sorry, you don\'t have the required permissions.');
                        return $this->redirect("/");

                    }

                } else {
                    if ($setting->document_create == 0 || count($doc) == 0 || $cn == 0) {
                        $this->Flash->error('Sorry, you don\'t have the required permissions.');
                        return $this->redirect("/");

                    }
                }
                if (isset($_POST['uploaded_for'])) {
                    $docs = TableRegistry::get('orders');

                    $arr['uploaded_for'] = $_POST['uploaded_for'];
                    $arr['client_id'] = $cid;
                    if (isset($_POST['order_type']))
                        $arr['order_type'] = $_POST['order_type'];
                    $arr['created'] = date('Y-m-d H:i:s');

                    if (!$did || $did == '0') {
                        $arr['user_id'] = $this->request->session()->read('Profile.id');
                        $doc = $docs->newEntity($arr);
                        if ($docs->save($doc)) {
                            $this->Flash->success('The document has been saved.');
                            $this->redirect('orders/orderslist');
                        } else {
                            //$this->Flash->error('Client could not be saved. Please try again.');
                            //echo "e";
                        }

                    } else {
                        $query2 = $docs->query();
                        $query2->update()
                            ->set($arr)
                            ->where(['id' => $did])
                            ->execute();
                        $this->Flash->success('The document has been saved.');
                        $this->redirect('/documents');
                    }
                }
            }

            if ($did) {
                /*$this->loadModel('AttachDocs');
                $this->AttachDocs->deleteAll(['doc_id'=>$did]);
                $client_docs = array_unique($_POST['attach_doc']);
                foreach($client_docs as $d)
                {
                    if($d != "")
                    {
                        $docs = TableRegistry::get('attach_docs');
                        $ds['doc_id']= $did;
                        $ds['file'] =$d;
                         $doc = $docs->newEntity($ds);
                         $docs->save($doc);
                        unset($doc);
                    }
                }*/
                
                
                $doc = TableRegistry::get('Documents');
                
                $query = $doc->find()->where(['id' => $did])->first();
                $sub_doc = TableRegistry::get('Subdocuments');
                $sd = $sub_doc->find()->all();
                
                foreach($sd as $s)
                {
                    if($s->id >12)
                    {
                        if ($query->sub_doc_id == $s->id) 
                        {
                            $mods = TableRegistry::get($s->table_name);
                            if(!isset($_GET['order_id']))                    
                                $mod = $mods->find()->where(['document_id' => $did])->first();
                            else
                                $mod = $mods->find()->where(['order_id' => $_GET['order_id']])->first();                                        
                            $this->set($s->table_name, $mod);
                        }
                    }   
                }
                
                if ($query->sub_doc_id == '6') {
                    $feeds = TableRegistry::get('feedbacks');
                    //$pre_at = TableRegistry::get('driver_application_accident');
                    if(!isset($_GET['order_id']))                    
                    $feed = $feeds->find()->where(['document_id' => $did])->first();
                    else
                    $feed = $feeds->find()->where(['order_id' => $_GET['order_id']])->first();                                        
                    $this->set('feeds', $feed);
                } elseif ($query->sub_doc_id == '5') {

                    $survey = TableRegistry::get('Survey');
                    //$pre_at = TableRegistry::get('driver_application_accident');
                    if(!isset($_GET['order_id']))                    
                    $sur = $survey->find()->where(['document_id' => $did])->first();
                    else
                    $sur = $survey->find()->where(['order_id' => $_GET['order_id']])->first();                                                            
                    
                                                                                
                    $this->set('survey', $sur);
                } elseif ($query->sub_doc_id == '7') {
                    $attachments = TableRegistry::get('attachments');
                    //$pre_at = TableRegistry::get('driver_application_accident');
                    if(!isset($_GET['order_id']))                    
                    $attachment = $attachments->find()->where(['document_id' => $did])->all();
                    else
                    $attachment = $attachments->find()->where(['order_id' => $_GET['order_id']])->all();                                        
                    $this->set('attach', $attachment);

                    $this->set('attach', $attachment);

                }
                elseif ($query->sub_doc_id == '8') {
                    $attachments = TableRegistry::get('audits');
                    //$pre_at = TableRegistry::get('driver_application_accident');
                    if(!isset($_GET['order_id']))                    
                    $audits = $attachments->find()->where(['document_id' => $did])->first();
                    else
                    $audits = $attachments->find()->where(['order_id' => $_GET['order_id']])->first();                                        
                    $this->set('audits', $audits);
                }
                 elseif ($query->sub_doc_id == '11') {
                    $attachments = TableRegistry::get('generic_forms');
                    //$pre_at = TableRegistry::get('driver_application_accident');
                    if(!isset($_GET['order_id']))                    
                    $audits = $attachments->find()->where(['document_id' => $did])->first();
                    else
                    $audits = $attachments->find()->where(['order_id' => $_GET['order_id']])->first();                                        
                    $this->set('generic', $audits);
                } elseif ($query->sub_doc_id == '12') {
                    $attachments = TableRegistry::get('abstract_forms');
                    //$pre_at = TableRegistry::get('driver_application_accident');
                    if(!isset($_GET['order_id']))                    
                    $audits = $attachments->find()->where(['document_id' => $did])->first();
                    else
                    $audits = $attachments->find()->where(['order_id' => $_GET['order_id']])->first();                                        
                    $this->set('abstract', $audits);
                  }                   

                $pre = TableRegistry::get('doc_attachments');
                //$pre_at = TableRegistry::get('driver_application_accident');
                if(!isset($_GET['order_id']))
                $pre_at['attach_doc'] = $pre->find()->where(['document_id' => $did])->all();
                else
                $pre_at['attach_doc'] = $pre->find()->where(['order_id' => $_GET['order_id'],'sub_id'=>1])->all();
                $this->set('pre_at', $pre_at);

                $da = TableRegistry::get('driver_application');
                if(!isset($_GET['order_id']))
                $da_detail = $da->find()->where(['document_id' => $did])->first();
                else
                $da_detail = $da->find()->where(['order_id' => $_GET['order_id']])->first();
                if ($da_detail) {
                    $da_ac = TableRegistry::get('driver_application_accident');
                    $sub['da_ac_detail'] = $da_ac->find()->where(['driver_application_id' => $da_detail->id])->all();

                    $da_li = TableRegistry::get('driver_application_licenses');
                    $sub['da_li_detail'] = $da_li->find()->where(['driver_application_id' => $da_detail->id])->all();

                    $da_at = TableRegistry::get('doc_attachments');
                    if(!isset($_GET['order_id']))
                    $sub['da_at'] = $da_at->find()->where(['document_id' => $did])->all();
                    else
                    $sub['da_at'] = $da_at->find()->where(['order_id' => $_GET['order_id'],'sub_id'=>2])->all();

                    

                    $this->set('sub', $sub);
                }
                $de = TableRegistry::get('road_test');
                if(!isset($_GET['order_id']))
                $de_detail = $de->find()->where(['document_id' => $did])->first();
                else
                $de_detail = $de->find()->where(['order_id' => $_GET['order_id']])->first();
                if ($de_detail) {
                   $de_at = TableRegistry::get('doc_attachments');
                   if(!isset($_GET['order_id']))
                    $sub['de_at'] = $de_at->find()->where(['document_id' => $did])->all(); 
                    else
                    $sub['de_at'] = $de_at->find()->where(['order_id' => $_GET['order_id'],'sub_id'=>3])->all();
                    $this->set('sub', $sub);
                }
                
                
                $con = TableRegistry::get('consent_form');
                if(!isset($_GET['order_id']))
                $con_detail = $con->find()->where(['document_id' => $did])->first();
                else
                $con_detail = $con->find()->where(['order_id' => $_GET['order_id']])->first();
                if ($con_detail) {
                    //echo $con_detail->id;die();
                    $con_cri = TableRegistry::get('consent_form_criminal');
                    $sub2['con_cri'] = $con_cri->find()->where(['consent_form_id' => $con_detail->id])->all();

                    $con_at = TableRegistry::get('doc_attachments');
                    if(!isset($_GET['order_id']))
                    $sub2['con_at'] = $con_at->find()->where(['document_id' => $did])->all();
                    else
                    $sub2['con_at'] = $con_at->find()->where(['order_id' => $_GET['order_id'],'sub_id'=>4])->all();
                    $this->set('sub2', $sub2);
                    $this->set('consent_detail', $con_detail);

                }
                $emp = TableRegistry::get('employment_verification');
                if(!isset($_GET['order_id']))
                $sub3['emp'] = $emp->find()->where(['document_id' => $did])->all();
                else
                $sub3['emp'] = $emp->find()->where(['order_id' => $_GET['order_id']])->all();

                //echo $con_detail->id;die();
                $emp_att = TableRegistry::get('doc_attachments');
                if(!isset($_GET['order_id']))
                $sub3['att'] = $emp_att->find()->where(['document_id' => $did])->all();
                else
                $sub3['att'] = $emp_att->find()->where(['order_id' => $_GET['order_id'],'sub_id'=>41])->all();

                $this->set('sub3', $sub3);

                $edu = TableRegistry::get('education_verification');
                if(!isset($_GET['order_id']))
                $sub4['edu'] = $edu->find()->where(['document_id' => $did])->all();
                else
                $sub4['edu'] = $edu->find()->where(['order_id' => $_GET['order_id']])->all();
                //echo $con_detail->id;die();
                $edu_att = TableRegistry::get('doc_attachments');
                if(!isset($_GET['order_id']))
                $sub4['att'] = $edu_att->find()->where(['document_id' => $did])->all();
                else
                $sub4['att'] = $edu_att->find()->where(['order_id' => $_GET['order_id'],'sub_id'=>42])->all();
                $this->set('sub4', $sub4);

            }
        }
        
        public function forMail()
        {
            
            $pro_query = TableRegistry::get('Profiles');
            $email_query = $pro_query->find()->where(['super' => 1])->first();
            $em = $email_query->email;
            $user_id = $this->request->session()->read('Profile.id');
            $uq = $pro_query->find('all')->where(['id' => $user_id])->first();
            if (isset($uq->profile_type))
              {
                $u = $uq->profile_type;
                if($u == 1)
                $ut = 'Admin';
                else if($u == 2)
                $ut = 'Recruiter';
                else if($u == 3)
                $ut = 'External';
                else if($u == 4)
                $ut = 'Safety';
                else if($u == 5)
                $ut = 'Driver';
                else if($u == 6)
                $ut = 'Contact';
                else if($u == 7)
                $ut = 'Owner Operator';
                else if($u == 8)
                $ut = 'Owner Driver';
              }
            $from = array('info@' . getHost("isbmee.com") => "ISB MEE");;// $emailaddress;//'info@isbmee.com';
            $to = $em;
             $sub = 'Client created';
            $msg = 'A client has been created<br />
            By a user with following details :<br/>
            Username : '.$uq->username.'<br/>Profile Type : '.$ut.'<br/> Dated on : '.$_POST['created'].'<br/>With client details<br /> Client Name: ' . $_POST['company_name'].'<br/><br /> Regards,<br />the ISB MEE team';
             $this->Mailer->sendEmail($from, $to, $sub, $msg);
        }


        public function delete($id = null, $type = ""){
            $settings = $this->Settings->get_settings();
            $setting = $this->Settings->get_permission($this->request->session()->read('Profile.id'));

            if ($setting->document_delete == 0) {
                $this->Flash->error('Sorry, you don\'t have the required permissions.');
                return $this->redirect("/");

            }
            if ($id != "") {
                $doc = TableRegistry::get('Subdocuments');
                $query = $doc->find();
                if ($type == 'orders') {
                    $query->select()->where(['display' => 1, 'orders' => 1])->all();
                } else
                    $query->select()->where(['display' => 1, 'orders' => 0])->all();
                foreach ($query as $q) {
                    //$sub = TableRegistry::get($q->table_name);
                    //$sub->query()->delete()->where(['document_id' => $id])->execute();

                }

                if ($this->Documents->deleteAll(array('id' => $id))) {

                    $this->Flash->success(ucfirst($settings->document) . ' has been deleted.');
                } else {
                    $this->Flash->error(ucfirst($settings->document) . ' could not be deleted. Please try again.');
                }
                if($type=='draft')
                {
                    return $this->redirect('/documents/index?draft');
                }
                else return $this->redirect('/documents/index');

            }
            /*$profile = $this->Clients->get($id);
            $this->request->allowMethod(['post', 'delete']);
            if ($this->Clients->delete($profile)) {
                $this->Flash->success('The user has been deleted.');
            } else {
                $this->Flash->error('User could not be deleted. Please try again.');
            }
            return $this->redirect(['action' => 'index']);*/
        }

        public function subpages($filename)
        {
            $this->set('doc_comp',$this->Document);
            $this->layout = "blank";
            $this->set("filename", $filename);
        }

        public function stats()
        {

        }

        public function drafts()
        {

        }

        function analytics1(){
            $this->layout = "blank";
        }

        function analytics(){
            $this->set('doc_comp',$this->Document);
            $orders = TableRegistry::get('orders');
            $order = $orders->find()->order(['orders.id' => 'DESC'])->where(['draft' => 0])->select();
            $this->set('orders', $order);

            $docs = TableRegistry::get('documents');
            $doc = $docs->find()->select()->where(['draft' => 0]);
            $this->set('documents',$doc);

            $clients = TableRegistry::get('Clients');
            $cli =  $clients->find()->select();
            $this->set('clients', $cli);

            $profiles = TableRegistry::get('Profiles');
            $pro =  $profiles->find()->select();
            $this->set('profiles', $pro);

            $quizzes = TableRegistry::get('training_list');
            $qui = $quizzes->find()->select();
            $this->set('courses', $qui);

            $answers = TableRegistry::get('training_answers');
            $ans =  $answers->find('all',array('group' => array('UserID', "QuizID")));
            $this->set('answers', $ans);
    }

            
        function removefiles($file)
        {
            if(isset($_POST['id']) && $_POST['id']!= 0)
            {
                $this->loadModel("AttachDocs");
                $this->AttachDocs->deleteAll(['id'=>$_POST['id']]);
                
            }
            @unlink(WWW_ROOT."img/jobs/".$file);
            die();
        }
        function get_documentcount($subdocid, $c_id = "")
        {
            $this->set('doc_comp',$this->Document);
            //$cond = $this->Settings->getprofilebyclient($this->request->session()->read('Profile.id'),0);
            //var_dump($cond);die();
            $u = $this->request->session()->read('Profile.id');

            if (!$this->request->session()->read('Profile.super')) {
                $setting = $this->Settings->get_permission($u);
                if ($setting->document_others == 0) {
                    $u_cond = "user_id=$u";
                }
                else
                    $u_cond = "";

            } else
                    $u_cond = "";

            $model = TableRegistry::get("Documents");
            if ($c_id != "") {
                $cnt = $model->find()->where(["sub_doc_id" => $subdocid, 'draft' => '0', $u_cond, 'client_id' => $c_id])->count();
            } else {
                $cond = $this->Settings->getclientids($u, $this->request->session()->read('Profile.super'));
                $cnt = $model->find()->where(["sub_doc_id" => $subdocid, 'draft' => '0', $u_cond, 'OR' => $cond])->count();
            }
            //debug($cnt); die();
            $this->response->body(($cnt));
            return $this->response;
            die();
        }

        function fileUpload($id = "")
        {
            // print_r($_POST);die;
            if (isset($_FILES['myfile']['name']) && $_FILES['myfile']['name']) {
                $arr = explode('.', $_FILES['myfile']['name']);
                $ext = end($arr);
                $rand = rand(100000, 999999) . '_' . rand(100000, 999999) . '.' . $ext;
                $allowed = array(
                    'jpg',
                    'jpeg',
                    'png',
                    'bmp',
                    'gif',
                    'pdf',
                    'doc',
                    'docx',
                    'txt',
                    'xlsx',
                    'xls',
                    'csv',
                    'mp4'
                );
                $check = strtolower($ext);
                if (in_array($check, $allowed)) {
                    if (isset($_POST['type']))
                        $doc_type = $_POST['type'];
                    $destination = WWW_ROOT . 'attachments';

                    if (!file_exists($destination)){
                        mkdir($destination, 0777, true);
                    }

                    $source = $_FILES['myfile']['tmp_name'];
                    move_uploaded_file($source, $destination . '/' . $rand);
                    $saveData = array();
                    if (isset($_POST['order_id']))
                        $saveData['order_id'] = $_POST['order_id'];
                    $saveData['path'] = $rand;


                    echo $rand;
                } else {
                    echo 'error';
                }
            }
            die();
        }

        

        function survey()
        {
            $this->render('survey');
        }

        

        function addattachment($cid, $did)
        {

            if (isset($_POST) && isset($_GET['draft'])) {

                if (isset($_GET['draft']) && $_GET['draft'])
                {
                    $arr['draft'] = 1;
                    $draft = '?draft';
                }
                else
                {
                    $arr['draft'] = 0;
                    $draft = '';    
                }
                $arr['sub_doc_id'] = $_POST['sub_doc_id'];
                $arr['client_id'] = $cid;
                $arr['document_type'] = $_POST['document_type'];
                $arr['title'] = $_POST['title'];
                $arr['created'] = date('Y-m-d H:i:s');
                if(!isset($_REQUEST['order_id'])){
                if (!$did || $did == '0') {

                    $arr['user_id'] = $this->request->session()->read('Profile.id');
                   
                    $docs = TableRegistry::get('Documents');
                    $doc = $docs->newEntity($arr);

                    if ($docs->save($doc)) {
                            
                        $doczs = TableRegistry::get('attachments');
                        $ds['document_id'] = $doc->id;
                        $ds['title'] = $_POST['title'];
                        $docz = $doczs->newEntity($ds);
                        $doczs->save($docz);
                        if(isset($_POST['attach_doc']))
                        {
                            $model = $this->loadModel('DocAttachments');
                            $model->deleteAll(['document_id'=> $doc->id]);
                            
                            $client_docs = $_POST['attach_doc'];
                            foreach($client_docs as $d)
                            {
                                if($d != "")
                                {
                                    $attach = TableRegistry::get('doc_attachments');
                                    $ds['document_id']= $doc->id;
                                    $ds['attachment'] =$d;
                                    $ds['sub_id'] = $arr['sub_doc_id'];
                                     $att = $attach->newEntity($ds);
                                     $attach->save($att);
                                    unset($att);
                                }
                            }
                        }
                        unset($doczs);
                        /*$client_docs = array_unique($_POST['client_doc']);
                        foreach ($client_docs as $d) {
                            if ($d != "") {
                                $doczs = TableRegistry::get('attachments');
                                $ds['document_id'] = $doc->id;
                                $ds['file'] = $d;
                                $docz = $doczs->newEntity($ds);
                                $doczs->save($docz);
                                unset($doczs);
                            }
                        }*/
                        //die('1');
                        $this->Flash->success('Document saved successfully.');
                        $this->redirect(array('action' => 'index'.$draft));
                    } else {
                        $this->Flash->error('Document could not be saved. Please try again.');
                        $this->redirect(array('action' => 'index'.$draft));
                    }

                } else {
                    $docs = TableRegistry::get('Documents');
                    $query2 = $docs->query();
                    $query2->update()
                        ->set($arr)
                        ->where(['id' => $did])
                        ->execute();
                    $this->loadModel('Attachments');
                    $this->Attachments->deleteAll(['document_id' => $did]);
                    $doczs = TableRegistry::get('attachments');
                    $ds['document_id'] = $did;
                    $ds['title'] = $_POST['title'];
                    $docz = $doczs->newEntity($ds);
                    $doczs->save($docz);
                    //var_dump($_POST); die();
                    if(isset($_POST['attach_doc']))
                    {
                        
                        $model = $this->loadModel('DocAttachments');
                        $model->deleteAll(['document_id'=> $did]);
                        $client_docs = $_POST['attach_doc'];
                        foreach($client_docs as $d)
                        {
                            if($d != "")
                            {
                                $attach = TableRegistry::get('doc_attachments');
                                $ds['document_id']= $did;
                                $ds['attachment'] =$d;
                                $ds['sub_id'] = $arr['sub_doc_id'];
                                 $att = $attach->newEntity($ds);
                                 $attach->save($att);
                                unset($att);
                            }
                        }
                    }
                    unset($doczs);
                    /*$this->loadModel('Attachments');
                    $attach = TableRegistry::get('attachments');
                    $at = $attach->find()->where(['document_id'=>$did])->all();
                    foreach($at as $a)
                    {
                         @unlink(WWW_ROOT."attachments/".$a->file);
                    }*/
                    /*
                    $this->Attachments->deleteAll(['document_id' => $did]);
                    $client_docs = array_unique($_POST['client_doc']);

                    foreach ($client_docs as $d) {
                        if ($d != "") {
                            $doczs = TableRegistry::get('attachments');
                            $ds['document_id'] = $did;
                            $ds['file'] = $d;
                            $docz = $doczs->newEntity($ds);
                            $doczs->save($docz);
                            unset($doczs);
                        }
                    }
                    */
                    $this->Flash->success('Document Updated successfully.');
                    $this->redirect(array('action' => 'index'.$draft));
                }
                }
                else
                {
                    $did = $_REQUEST['order_id'];
                    $doczs = TableRegistry::get('attachments');
                    $check = $doczs->find()->where(['order_id'=>$did]);
                    unset($doczs);
                    if (!$check) {
                            
                        }
                        else
                        {
                            $this->loadModel('Attachments');
                            $this->Attachments->deleteAll(['order_id' => $did]);
                            /*$client_docs = array_unique($_POST['client_doc']);*/
        
                           /* foreach ($client_docs as $d) {
                                $doczs = TableRegistry::get('attachments');
                                if ($d != "") {
                                    //$doczs = TableRegistry::get('attachments');
                                    $ds['order_id'] = $did;
                                    $ds['document_id'] = 0;
                                    $ds['file'] = $d;
                                    $docz = $doczs->newEntity($ds);
                                    $doczs->save($docz);
                                    unset($doczs);
                                }
                            }*/
                            $doczs = TableRegistry::get('attachments');
                                
                                    //$doczs = TableRegistry::get('attachments');
                                    $ds['order_id'] = $did;
                                    $ds['document_id'] = 0;
                                    $ds['title'] = $_POST['title'];
                                    $docz = $doczs->newEntity($ds);
                                    $doczs->save($docz);
                                    unset($doczs);
                                
                        }
                   //$arr['order_id'] = $did;
                   $arr['document_id'] = 0;
                   
                    if(!isset($_GET['order_id']))
                    $arr['order_id'] = $did;
                    else{
                    $arr['order_id'] = $_GET['order_id'];
                    $did = $_GET['order_id'];
                    }
                    $arr['document_id'] = 0;
                    if (isset($_POST['uploaded_for']))
                        $uploaded_for = $_POST['uploaded_for'];
                    else
                        $uploaded_for = '';
                    $for_doc = array('document_type'=>'Attachment','sub_doc_id'=>7,'order_id'=>$arr['order_id'],'user_id'=>'','uploaded_for'=>$uploaded_for);
                    $this->Document->saveDocForOrder($for_doc);
                    
                    if(isset($_POST['attach_doc']))
                            {
                                
                                $model = $this->loadModel('DocAttachments');
                                $model->deleteAll(['order_id'=> $arr['order_id'],'sub_id'=>7]);
                                $client_docs = $_POST['attach_doc'];
                                foreach($client_docs as $d)
                                {
                                    if($d != "")
                                    {
                                        $attach = TableRegistry::get('doc_attachments');
                                        $ds['order_id']= $arr['order_id'];
                                        $ds['attachment'] =$d;
                                        $ds['sub_id'] = 7;
                                        $att = $attach->newEntity($ds);
                                        $attach->save($att);
                                        unset($att);
                                    }
                                }
                            }
                    
                    die();
                 
                }

            }

        }
        function audits($cid, $did)
        {
            $this->set('doc_comp',$this->Document);
           
            if (isset($_POST)) {
                
                if (isset($_GET['draft']) && $_GET['draft'])
                {
                    $arr['draft'] = 1;
                    $draft = '?draft';
                }
                else
                {
                    $arr['draft'] = 0;
                    $draft = '';    
                }
                $arr['sub_doc_id'] = $_POST['sub_doc_id'];
                $arr['client_id'] = $cid;
                $arr['document_type'] = $_POST['document_type'];
               
                
                 if(!isset($_GET['order_id'])){
                if (!$did || $did == '0') {
                    
                    $arr['user_id'] = $this->request->session()->read('Profile.id');
                    $arr['created'] = date('Y-m-d H:i:s');
                    $docs = TableRegistry::get('Documents');
                    $doc = $docs->newEntity($arr);

                    if ($docs->save($doc)) {

                        $doczs = TableRegistry::get('audits');
                        $ds['document_id'] = $doc->id;
                        $ds['date'] = $_POST['year']."-".$_POST['month'];
                        foreach($_POST as $k=>$v)
                        {
                            $ds[$k]=$v;
                        }
                        $docz = $doczs->newEntity($ds);
                        $doczs->save($docz);
                        $did = $doc->id;
                        if(isset($_POST['attach_doc']))
                        {
                            //var_dump($_POST['attach_doc']);die();
                            $model = $this->loadModel('AttachDocs');
                            $model->deleteAll(['doc_id'=> $did]);
                            //$client_do = implode(',',$_POST['attach_doc']);
                            //$client_docs=explode(',',$client_do);
                            foreach($_POST['attach_doc'] as $d)
                            {
                                if($d != "")
                                {
                                    $attach = TableRegistry::get('attach_docs');
                                    $ds['doc_id']= $did;
                                    $ds['file'] =$d;
                                     $att = $attach->newEntity($ds);
                                     $attach->save($att);
                                    unset($att);
                                }
                            }
                            
                        }
                        unset($doczs);
                        $this->Flash->success('Document saved successfully.');
                        $this->redirect(array('action' => 'index'.$draft));
                    } else {
                        $this->Flash->error('Document could not be saved. Please try again.');
                        $this->redirect(array('action' => 'index'.$draft));
                    }

                } 
                else 
                {
                    $docs = TableRegistry::get('Documents');
                    $query2 = $docs->query();
                    $query2->update()
                        ->set($arr)
                        ->where(['id' => $did])
                        ->execute();
                        $this->loadModel('Audits');
                        $this->Audits->deleteAll(['document_id' => $did]);
                        $doczs = TableRegistry::get('audits');
                        $ds['document_id'] = $did;
                        $ds['date'] = $_POST['year']."-".$_POST['month'];
                        foreach($_POST as $k=>$v)
                        {
                            $ds[$k]=$v;
                        }
                        $docz = $doczs->newEntity($ds);
                        $doczs->save($docz);
                        if(isset($_POST['attach_doc']))
                        {
                            $did = $doc->id;
                            $model = $this->loadModel('AttachDocs');
                            $model->deleteAll(['doc_id'=> $did]);
                            $client_docs = explode(',',$_POST['attach_doc']);
                            foreach($client_docs as $d)
                            {
                                if($d != "")
                                {
                                    $attach = TableRegistry::get('attach_docs');
                                    $ds['doc_id']= $did;
                                    $ds['file'] =$d;
                                     $att = $attach->newEntity($ds);
                                     $attach->save($att);
                                    unset($att);
                                }
                            }
                        }
                        unset($doczs);
                    $this->Flash->success('Document Updated successfully.');
                    $this->redirect(array('action' => 'index'.$draft));
                }
                }
                else
                {
                    $arr['document_id'] = 0;                   
                    if(!isset($_GET['order_id']))
                    $arr['order_id'] = $did;
                    else{
                    $arr['order_id'] = $_GET['order_id'];
                    $did = $_GET['order_id'];
                    }
                    $arr['document_id'] = 0;
                    if (isset($_POST['uploaded_for']))
                        $uploaded_for = $_POST['uploaded_for'];
                    else
                        $uploaded_for = '';
                    $for_doc = array('document_type'=>'Audit','sub_doc_id'=>8,'order_id'=>$arr['order_id'],'user_id'=>'','uploaded_for'=>$uploaded_for);
                    $this->Document->saveDocForOrder($for_doc);
                    
                    $doczs = TableRegistry::get('audits');
                    $check = $doczs->find()->where(['order_id'=>$did])->first();
                    unset($doczs);
                    if (!$check) {
                        $ds['order_id'] = $did;
                        $ds['document_id'] = 0;
                        $ds['date'] = $_POST['year']."-".$_POST['month'];
                        $doczs = TableRegistry::get('audits');
                        foreach($_POST as $k=>$v)
                        {
                            $ds[$k]=$v;
                        }
                        $docz = $doczs->newEntity($ds);
                        $doczs->save($docz);
                        unset($doczs);
                        }
                        else
                        {
                            $this->loadModel('Audits');
                          $this->Audits->deleteAll(['order_id' => $did]);
                            $doczs = TableRegistry::get('audits');
                            $ds['order_id'] = $did;
                            $ds['date'] = $_POST['year']."-".$_POST['month'];
                            foreach($_POST as $k=>$v)
                            {
                                $ds[$k]=$v;
                            }
                            $docz = $doczs->newEntity($ds);
                            $doczs->save($docz);
                            unset($doczs);  
                        }
                    
                    die();
                }

            }

        }
        function basic($cid, $did)
        {
            $this->set('doc_comp',$this->Document);
           
            if (isset($_POST)) {
                
                if (isset($_GET['draft']) && $_GET['draft'])
                {
                    $arr['draft'] = 1;
                    $draft = '?draft';
                }
                else
                {
                    $arr['draft'] = 0;
                    $draft = '';    
                }
                $arr['sub_doc_id'] = $_POST['sub_doc_id'];
                $arr['client_id'] = $cid;
                $arr['document_type'] = $_POST['document_type'];
               
                
                 if(!isset($_GET['order_id'])){
                if (!$did || $did == '0') {
                    
                    $arr['user_id'] = $this->request->session()->read('Profile.id');
                    $arr['created'] = date('Y-m-d H:i:s');
                    $docs = TableRegistry::get('Documents');
                    $doc = $docs->newEntity($arr);

                    if ($docs->save($doc)) {

                        $doczs = TableRegistry::get('generic_forms');
                        $ds['document_id'] = $doc->id;
                        
                        foreach($_POST as $k=>$v)
                        {
                            $ds[$k]=$v;
                        }
                        $docz = $doczs->newEntity($ds);
                        $doczs->save($docz);
                        $did = $doc->id;
                        if(isset($_POST['attach_doc']))
                        {
                            //var_dump($_POST['attach_doc']);die();
                            $model = $this->loadModel('DocAttachments');
                            $model->deleteAll(['document_id'=> $did]);
                            //$client_do = implode(',',$_POST['attach_doc']);
                            //$client_docs=explode(',',$client_do);
                            foreach($_POST['attach_doc'] as $d)
                            {
                                if($d != "")
                                {
                                    $attach = TableRegistry::get('doc_attachments');
                                    $ds['document_id']= $did;
                                    $ds['attachment'] =$d;
                                    $ds['sub_id'] = $arr['sub_doc_id'];
                                    $att = $attach->newEntity($ds);
                                    $attach->save($att);
                                    unset($att);
                                }
                            }
                            
                        }
                        unset($doczs);
                        $this->Flash->success('Document saved successfully.');
                        $this->redirect(array('action' => 'index'.$draft));
                    } else {
                        $this->Flash->error('Document could not be saved. Please try again.');
                        $this->redirect(array('action' => 'index'.$draft));
                    }

                } 
                else 
                {
                    $docs = TableRegistry::get('Documents');
                    $query2 = $docs->query();
                    $query2->update()
                        ->set($arr)
                        ->where(['id' => $did])
                        ->execute();
                        $this->loadModel('GenericForms');
                        $this->GenericForms->deleteAll(['document_id' => $did]);
                        $doczs = TableRegistry::get('generic_forms');
                        $ds['document_id'] = $did;
                        
                        foreach($_POST as $k=>$v)
                        {
                            $ds[$k]=$v;
                        }
                        $docz = $doczs->newEntity($ds);
                        $doczs->save($docz);
                        if(isset($_POST['attach_doc']))
                        {
                            
                            $model = $this->loadModel('DocAttachments');
                            $model->deleteAll(['document_id'=> $did]);
                            $client_docs = $_POST['attach_doc'];
                            foreach($client_docs as $d)
                            {
                                if($d != "")
                                {
                                    $attach = TableRegistry::get('doc_attachments');
                                    $ds['document_id']= $did;
                                    $ds['attachment'] =$d;
                                    $ds['sub_id'] = $arr['sub_doc_id'];
                                    $att = $attach->newEntity($ds);
                                    $attach->save($att);
                                    unset($att);
                                }
                            }
                        }
                        unset($doczs);
                    $this->Flash->success('Document Updated successfully.');
                    $this->redirect(array('action' => 'index'.$draft));
                }
                }
                else
                {
                    $arr['document_id'] = 0;                   
                    if(!isset($_GET['order_id']))
                    $arr['order_id'] = $did;
                    else{
                    $arr['order_id'] = $_GET['order_id'];
                    $did = $_GET['order_id'];
                    }
                    $arr['document_id'] = 0;
                    if (isset($_POST['uploaded_for']))
                        $uploaded_for = $_POST['uploaded_for'];
                    else
                        $uploaded_for = '';
                    $for_doc = array('document_type'=>'Audit','sub_doc_id'=>8,'order_id'=>$arr['order_id'],'user_id'=>'','uploaded_for'=>$uploaded_for);
                    $this->Document->saveDocForOrder($for_doc);
                    
                    $doczs = TableRegistry::get('generic_forms');
                    $check = $doczs->find()->where(['order_id'=>$did])->first();
                    unset($doczs);
                    if (!$check) {
                        $ds['order_id'] = $did;
                        $ds['document_id'] = 0;
                        $doczs = TableRegistry::get('generic_forms');
                        foreach($_POST as $k=>$v)
                        {
                            $ds[$k]=$v;
                        }
                        $docz = $doczs->newEntity($ds);
                        $doczs->save($docz);
                        unset($doczs);
                        }
                        else
                        {
                            $this->loadModel('GenericForms');
                            $this->Audits->deleteAll(['order_id' => $did]);
                            $doczs = TableRegistry::get('generic_forms');
                            $ds['order_id'] = $did;
                            
                            foreach($_POST as $k=>$v)
                            {
                                $ds[$k]=$v;
                            }
                            $docz = $doczs->newEntity($ds);
                            $doczs->save($docz);
                            unset($doczs);  
                        }
                    
                    die();
                }

            }

        }
        
        function quebec($cid, $did)
        {
            $this->set('doc_comp',$this->Document);
           
            if (isset($_POST)) {
                
                if (isset($_GET['draft']) && $_GET['draft'])
                {
                    $arr['draft'] = 1;
                    $draft = '?draft';
                }
                else
                {
                    $arr['draft'] = 0;
                    $draft = '';    
                }
                $arr['sub_doc_id'] = $_POST['sub_doc_id'];
                $arr['client_id'] = $cid;
                $arr['document_type'] = $_POST['document_type'];
               
                
                 if(!isset($_GET['order_id'])){
                if (!$did || $did == '0') {
                    
                    $arr['user_id'] = $this->request->session()->read('Profile.id');
                    $arr['created'] = date('Y-m-d H:i:s');
                    $docs = TableRegistry::get('Documents');
                    $doc = $docs->newEntity($arr);

                    if ($docs->save($doc)) {

                        $doczs = TableRegistry::get('quebec_forms');
                        $ds['document_id'] = $doc->id;
                        
                        foreach($_POST as $k=>$v)
                        {
                            $ds[$k]=$v;
                        }
                        $docz = $doczs->newEntity($ds);
                        $doczs->save($docz);
                        $did = $doc->id;
                        if(isset($_POST['attach_doc']))
                        {
                            //var_dump($_POST['attach_doc']);die();
                            $model = $this->loadModel('DocAttachments');
                            $model->deleteAll(['document_id'=> $did]);
                            //$client_do = implode(',',$_POST['attach_doc']);
                            //$client_docs=explode(',',$client_do);
                            foreach($_POST['attach_doc'] as $d)
                            {
                                if($d != "")
                                {
                                    $attach = TableRegistry::get('doc_attachments');
                                    $ds['document_id']= $did;
                                    $ds['attachment'] =$d;
                                    $ds['sub_id'] = $arr['sub_doc_id'];
                                     $att = $attach->newEntity($ds);
                                     $attach->save($att);
                                    unset($att);
                                }
                            }
                            
                        }
                        unset($doczs);
                        $this->Flash->success('Document saved successfully.');
                        $this->redirect(array('action' => 'index'.$draft));
                    } else {
                        $this->Flash->error('Document could not be saved. Please try again.');
                        $this->redirect(array('action' => 'index'.$draft));
                    }

                } 
                else 
                {
                    $docs = TableRegistry::get('Documents');
                    $query2 = $docs->query();
                    $query2->update()
                        ->set($arr)
                        ->where(['id' => $did])
                        ->execute();
                        $this->loadModel('QuebecForms');
                        $this->QuebecForms->deleteAll(['document_id' => $did]);
                        $doczs = TableRegistry::get('quebec_forms');
                        $ds['document_id'] = $did;
                        
                        foreach($_POST as $k=>$v)
                        {
                            $ds[$k]=$v;
                        }
                        $docz = $doczs->newEntity($ds);
                        $doczs->save($docz);
                        if(isset($_POST['attach_doc']))
                        {
                            
                            $model = $this->loadModel('DocAttachments');
                            $model->deleteAll(['document_id'=> $did]);
                            $client_docs = $_POST['attach_doc'];
                            foreach($client_docs as $d)
                            {
                                if($d != "")
                                {
                                    $attach = TableRegistry::get('doc_attachments');
                                    $ds['document_id']= $did;
                                    $ds['attachment'] =$d;
                                    $ds['sub_id'] = $arr['sub_doc_id'];
                                    $att = $attach->newEntity($ds);
                                    $attach->save($att);
                                    unset($att);
                                }
                            }
                        }
                        unset($doczs);
                    $this->Flash->success('Document Updated successfully.');
                    $this->redirect(array('action' => 'index'.$draft));
                }
                }
                else
                {
                    $arr['document_id'] = 0;                   
                    if(!isset($_GET['order_id']))
                    $arr['order_id'] = $did;
                    else{
                    $arr['order_id'] = $_GET['order_id'];
                    $did = $_GET['order_id'];
                    }
                    $arr['document_id'] = 0;
                    if (isset($_POST['uploaded_for']))
                        $uploaded_for = $_POST['uploaded_for'];
                    else
                        $uploaded_for = '';
                    $for_doc = array('document_type'=>'Quebic','sub_doc_id'=>8,'order_id'=>$arr['order_id'],'user_id'=>'','uploaded_for'=>$uploaded_for);
                    $this->Document->saveDocForOrder($for_doc);
                    
                    $doczs = TableRegistry::get('quebec_forms');
                    $check = $doczs->find()->where(['order_id'=>$did])->first();
                    unset($doczs);
                    if (!$check) {
                        $ds['order_id'] = $did;
                        $ds['document_id'] = 0;
                        $doczs = TableRegistry::get('quebec_forms');
                        foreach($_POST as $k=>$v)
                        {
                            $ds[$k]=$v;
                        }
                        $docz = $doczs->newEntity($ds);
                        $doczs->save($docz);
                        unset($doczs);
                        }
                        else
                        {
                            $this->loadModel('QuebecForms');
                            $this->QuebecForms->deleteAll(['order_id' => $did]);
                            $doczs = TableRegistry::get('quebec_forms');
                            $ds['order_id'] = $did;
                            
                            foreach($_POST as $k=>$v)
                            {
                                $ds[$k]=$v;
                            }
                            $docz = $doczs->newEntity($ds);
                            $doczs->save($docz);
                            unset($doczs);  
                        }
                    
                    die();
                }

            }

        }
        function bc($cid, $did)
        {
            $this->set('doc_comp',$this->Document);
           
            if (isset($_POST)) {
                
                if (isset($_GET['draft']) && $_GET['draft'])
                {
                    $arr['draft'] = 1;
                    $draft = '?draft';
                }
                else
                {
                    $arr['draft'] = 0;
                    $draft = '';    
                }
                $arr['sub_doc_id'] = $_POST['sub_doc_id'];
                $arr['client_id'] = $cid;
                $arr['document_type'] = $_POST['document_type'];
               
                
                 if(!isset($_GET['order_id'])){
                if (!$did || $did == '0') {
                    
                    $arr['user_id'] = $this->request->session()->read('Profile.id');
                    $arr['created'] = date('Y-m-d H:i:s');
                    $docs = TableRegistry::get('Documents');
                    $doc = $docs->newEntity($arr);

                    if ($docs->save($doc)) {

                        $doczs = TableRegistry::get('bc_forms');
                        $ds['document_id'] = $doc->id;
                        
                        foreach($_POST as $k=>$v)
                        {
                            $ds[$k]=$v;
                        }
                        $docz = $doczs->newEntity($ds);
                        $doczs->save($docz);
                        $did = $doc->id;
                        if(isset($_POST['attach_doc']))
                        {
                            //var_dump($_POST['attach_doc']);die();
                            $model = $this->loadModel('DocAttachments');
                            $model->deleteAll(['document_id'=> $did]);
                            //$client_do = implode(',',$_POST['attach_doc']);
                            //$client_docs=explode(',',$client_do);
                            foreach($_POST['attach_doc'] as $d)
                            {
                                if($d != "")
                                {
                                    $attach = TableRegistry::get('doc_attachments');
                                    $ds['document_id']= $did;
                                    $ds['attachment'] =$d;
                                    $ds['sub_id'] = $arr['sub_doc_id'];
                                     $att = $attach->newEntity($ds);
                                     $attach->save($att);
                                    unset($att);
                                }
                            }
                            
                        }
                        unset($doczs);
                        $this->Flash->success('Document saved successfully.');
                        $this->redirect(array('action' => 'index'.$draft));
                    } else {
                        $this->Flash->error('Document could not be saved. Please try again.');
                        $this->redirect(array('action' => 'index'.$draft));
                    }

                } 
                else 
                {
                    $docs = TableRegistry::get('Documents');
                    $query2 = $docs->query();
                    $query2->update()
                        ->set($arr)
                        ->where(['id' => $did])
                        ->execute();
                        $this->loadModel('BcForms');
                        $this->BcForms->deleteAll(['document_id' => $did]);
                        $doczs = TableRegistry::get('bc_forms');
                        $ds['document_id'] = $did;
                        
                        foreach($_POST as $k=>$v)
                        {
                            $ds[$k]=$v;
                        }
                        $docz = $doczs->newEntity($ds);
                        $doczs->save($docz);
                        if(isset($_POST['attach_doc']))
                        {
                            
                            $model = $this->loadModel('DocAttachments');
                            $model->deleteAll(['document_id'=> $did]);
                            $client_docs = $_POST['attach_doc'];
                            foreach($client_docs as $d)
                            {
                                if($d != "")
                                {
                                    $attach = TableRegistry::get('doc_attachments');
                                    $ds['document_id']= $did;
                                    $ds['attachment'] =$d;
                                    $ds['sub_id'] = $arr['sub_doc_id'];
                                    $att = $attach->newEntity($ds);
                                    $attach->save($att);
                                    unset($att);
                                }
                            }
                        }
                        unset($doczs);
                    $this->Flash->success('Document Updated successfully.');
                    $this->redirect(array('action' => 'index'.$draft));
                }
                }
                else
                {
                    $arr['document_id'] = 0;                   
                    if(!isset($_GET['order_id']))
                    $arr['order_id'] = $did;
                    else{
                    $arr['order_id'] = $_GET['order_id'];
                    $did = $_GET['order_id'];
                    }
                    $arr['document_id'] = 0;
                    if (isset($_POST['uploaded_for']))
                        $uploaded_for = $_POST['uploaded_for'];
                    else
                        $uploaded_for = '';
                    $for_doc = array('document_type'=>'Quebic','sub_doc_id'=>8,'order_id'=>$arr['order_id'],'user_id'=>'','uploaded_for'=>$uploaded_for);
                    $this->Document->saveDocForOrder($for_doc);
                    
                    $doczs = TableRegistry::get('quebec_forms');
                    $check = $doczs->find()->where(['order_id'=>$did])->first();
                    unset($doczs);
                    if (!$check) {
                        $ds['order_id'] = $did;
                        $ds['document_id'] = 0;
                        $doczs = TableRegistry::get('quebec_forms');
                        foreach($_POST as $k=>$v)
                        {
                            $ds[$k]=$v;
                        }
                        $docz = $doczs->newEntity($ds);
                        $doczs->save($docz);
                        unset($doczs);
                        }
                        else
                        {
                            $this->loadModel('BcForms');
                            $this->BcForms->deleteAll(['order_id' => $did]);
                            $doczs = TableRegistry::get('bc_forms');
                            $ds['order_id'] = $did;
                            
                            foreach($_POST as $k=>$v)
                            {
                                $ds[$k]=$v;
                            }
                            $docz = $doczs->newEntity($ds);
                            $doczs->save($docz);
                            unset($doczs);  
                        }
                    
                    die();
                }

            }

        }              
        function absract($cid, $did)
        {
            $this->set('doc_comp',$this->Document);
           
            if (isset($_POST)) {
                
                if (isset($_GET['draft']) && $_GET['draft'])
                {
                    $arr['draft'] = 1;
                    $draft = '?draft';
                }
                else
                {
                    $arr['draft'] = 0;
                    $draft = '';    
                }
                $arr['sub_doc_id'] = $_POST['sub_doc_id'];
                $arr['client_id'] = $cid;
                $arr['document_type'] = $_POST['document_type'];
               
                
                 if(!isset($_GET['order_id'])){
                if (!$did || $did == '0') {
                    
                    $arr['user_id'] = $this->request->session()->read('Profile.id');
                    $arr['created'] = date('Y-m-d H:i:s');
                    $docs = TableRegistry::get('Documents');
                    $doc = $docs->newEntity($arr);

                    if ($docs->save($doc)) {

                        $doczs = TableRegistry::get('abstract_forms');
                        $ds['document_id'] = $doc->id;
                        
                        foreach($_POST as $k=>$v)
                        {
                            $ds[$k]=$v;
                        }
                        $docz = $doczs->newEntity($ds);
                        $doczs->save($docz);
                        $did = $doc->id;
                        if(isset($_POST['attach_doc']))
                        {
                            //var_dump($_POST['attach_doc']);die();
                            $model = $this->loadModel('DocAttachments');
                            $model->deleteAll(['document_id'=> $did]);
                            //$client_do = implode(',',$_POST['attach_doc']);
                            //$client_docs=explode(',',$client_do);
                            foreach($_POST['attach_doc'] as $d)
                            {
                                if($d != "")
                                {
                                    $attach = TableRegistry::get('doc_attachments');
                                    $ds['document_id']= $did;
                                    $ds['attachment'] =$d;
                                    $ds['sub_id'] = $arr['sub_doc_id'];
                                     $att = $attach->newEntity($ds);
                                     $attach->save($att);
                                    unset($att);
                                }
                            }
                            
                        }
                        unset($doczs);
                        $this->Flash->success('Document saved successfully.');
                        $this->redirect(array('action' => 'index'.$draft));
                    } else {
                        $this->Flash->error('Document could not be saved. Please try again.');
                        $this->redirect(array('action' => 'index'.$draft));
                    }

                } 
                else 
                {
                    $docs = TableRegistry::get('Documents');
                    $query2 = $docs->query();
                    $query2->update()
                        ->set($arr)
                        ->where(['id' => $did])
                        ->execute();
                        $this->loadModel('AbstractForms');
                        $this->AbstractForms->deleteAll(['document_id' => $did]);
                        $doczs = TableRegistry::get('abstract_forms');
                        $ds['document_id'] = $did;
                        
                        foreach($_POST as $k=>$v)
                        {
                            $ds[$k]=$v;
                        }
                        $docz = $doczs->newEntity($ds);
                        $doczs->save($docz);
                        if(isset($_POST['attach_doc']))
                        {
                            
                            $model = $this->loadModel('DocAttachments');
                            $model->deleteAll(['document_id'=> $did]);
                            $client_docs = $_POST['attach_doc'];
                            foreach($client_docs as $d)
                            {
                                if($d != "")
                                {
                                    $attach = TableRegistry::get('doc_attachments');
                                    $ds['document_id']= $did;
                                    $ds['attachment'] =$d;
                                    $ds['sub_id'] = $arr['sub_doc_id'];
                                    $att = $attach->newEntity($ds);
                                    $attach->save($att);
                                    unset($att);
                                }
                            }
                        }
                        unset($doczs);
                    $this->Flash->success('Document Updated successfully.');
                    $this->redirect(array('action' => 'index'.$draft));
                }
                }
                else
                {
                    $arr['document_id'] = 0;                   
                    if(!isset($_GET['order_id']))
                    $arr['order_id'] = $did;
                    else{
                    $arr['order_id'] = $_GET['order_id'];
                    $did = $_GET['order_id'];
                    }
                    $arr['document_id'] = 0;
                    if (isset($_POST['uploaded_for']))
                        $uploaded_for = $_POST['uploaded_for'];
                    else
                        $uploaded_for = '';
                    $for_doc = array('document_type'=>'Abstract','sub_doc_id'=>8,'order_id'=>$arr['order_id'],'user_id'=>'','uploaded_for'=>$uploaded_for);
                    $this->Document->saveDocForOrder($for_doc);
                    
                    $doczs = TableRegistry::get('abstract_forms');
                    $check = $doczs->find()->where(['order_id'=>$did])->first();
                    unset($doczs);
                    if (!$check) {
                        $ds['order_id'] = $did;
                        $ds['document_id'] = 0;
                        $doczs = TableRegistry::get('abstract_forms');
                        foreach($_POST as $k=>$v)
                        {
                            $ds[$k]=$v;
                        }
                        $docz = $doczs->newEntity($ds);
                        $doczs->save($docz);
                        unset($doczs);
                        }
                        else
                        {
                            $this->loadModel('AbstractForms');
                            $this->AbstractForms->deleteAll(['order_id' => $did]);
                            $doczs = TableRegistry::get('abstract_forms');
                            $ds['order_id'] = $did;
                            
                            foreach($_POST as $k=>$v)
                            {
                                $ds[$k]=$v;
                            }
                            $docz = $doczs->newEntity($ds);
                            $doczs->save($docz);
                            unset($doczs);  
                        }
                    
                    die();
                }

            }

        }
        
        
        public function saveAttachmentsPrescreen($data = NULL, $count = 0)
        {//count is to delete all while first insertion and no delete for following insertion

            $this->Document->saveAttachmentsPrescreen($data,$count); 
           die();
        }

        public function saveAttachmentsDriverApp($data = NULL, $count = 0)
        {
            $this->Document->saveAttachmentsDriverApp($data,$count); 
           die();
        }

        public function saveAttachmentsRoadTest($data = NULL, $count = 0)
        {
            $this->Document->saveAttachmentsRoadTest($data,$count); 
           die();
        }

        public function saveAttachmentsConsentForm($data = NULL, $count = 0)
        {
            $this->Document->saveAttachmentsConsentForm($data,$count); 
           die();
        }

        public function saveAttachmentsEmployment($data = NULL, $count = 0)
        {
            $this->Document->saveAttachmentsEmployment($data,$count); 
           die();
        }

        public function saveAttachmentsEducation($data = NULL, $count = 0)
        {
            $this->Document->saveAttachmentsEducation($data,$count); 
           die();
        }
        
        
        
        
        function download($file)
        {
            
            $this->response->file(WWW_ROOT.'attachments/'.$file,array('download' => true));
            // Return response object to prevent controller from trying to render
            // a view.
            return $this->response;
        }
        function download_order($oid,$file)
        {
            $folder = 'orders/order_'.$oid.'/'.$file;
            $this->response->file(WWW_ROOT.$folder,array('download' => true));
            // Return response object to prevent controller from trying to render
            // a view.
            return $this->response;
        }
        public function getOrderData($cid = 0, $order_id = 0)
        {
            $this->Document->getOrderData($cid,$order_id);
            die;

        }

        function attach_doc($did="",$view="",$id='addMore1',$sub=0)
        {
            $this->set('addmoreid',$id);
            if($view=='view')
                $this->set('disabled','1');
            if($did)
            {
                $att = TableRegistry::get('doc_attachments');
                $query = $att->find();
                if(!$sub)
                $attachments = $query->select()->where(['document_id'=>$did])->all();
                else{
                $attachments = $query->select()->where(['order_id'=>$did,'sub_id'=>$sub])->all();
                debug($attachments);
                }
                $this->set('attachments',$attachments);
            }
            $this->layout ='blank';
        }

        
        public function getColor($id = 0)
        {
            $query = TableRegistry::get('color_class');
            $q = $query->find()->where(['id'=>$id])->first();
            $this->response->body($q);
            return $this->response;
        }
        
        public function getColorId($id = 0)
        {
            $query = TableRegistry::get('subdocuments');
            $q = $query->find('all')->where(['id'=>$id])->first();
            if($q)
            {
                $query_col = TableRegistry::get('color_class');
                $q_col = $query_col->find('all')->where(['id'=>$q->color_id])->first();
                $this->response->body($q_col->color);
                return $this->response;
            }
            
            /*
            $query = TableRegistry::get('documents');
            $que = $query->find();
            $que = $que->select(['sub_doc_id'])->distinct(['sub_doc_id']);
            if($q)
            {
                foreach($que as $q)
                {
                    $query = TableRegistry::get('color_class');
                    $q = $query->find('all')->where(['id'=>$q])->first();
                }
            }*/
        }

        public function appendattachments($query){
            foreach($query as $client){
                $client->hasattachments = $this->hasattachments($client->order_id, $client->id);
            }
            return $query;
        }
        public function hasattachments($orderid, $documentid){
            $docs = TableRegistry::get('doc_attachments');
            $query = $docs->find();
            $client_docs = $query->select()->where(['order_id' => $orderid,'document_id'=>$documentid, 'attachment LIKE' => "%.%"])->first();
            if($client_docs) {return true;}
        }

    }