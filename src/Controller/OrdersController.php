<?php
    namespace App\Controller;

    use App\Controller\AppController;
    use Cake\Event\Event;
    use Cake\Controller\Controller;
    use Cake\ORM\TableRegistry;

    include(APP . '../webroot/subpages/soap/nusoap.php');

    class OrdersController extends AppController
    {

        public $paginate = [
            'limit' => 10,
            'order' => ['id' => 'DESC'],
        ];

        public function intact(){

        }

        public function productSelection()
        {
            $this->set('doc_comp', $this->Document);
             $this->loadMOdel('OrderProducts');
            $settings = $this->Settings->get_settings();
            $this->set('products', $this->OrderProducts->find()->where(['enable'=>'1'])->all());
            $this->set('settings', $settings);
        }

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

        public function vieworder($cid = null, $did = null, $table = null)
        {
            $this->set('provinces',  $this->LoadSubDocs());
            
            $this->set('doc_comp', $this->Document);
            $this->set('table', $table);
            $setting = $this->Settings->get_permission($this->request->session()->read('Profile.id'));
            $doc = $this->Document->getDocumentcount();
            $cn = $this->Document->getUserDocumentcount();
            if ($setting->orders_list == 0 || count($doc) == 0 || $cn == 0) {
                $this->Flash->error('Sorry, you don\'t have the required permissions.');
                return $this->redirect("/");

            }
            $orders = TableRegistry::get('orders');
            if ($did) {
                $order_id = $orders->find()->where(['id' => $did])->first();
                $this->set('ooo',$order_id);
                $this->loadModel('Profiles');
                $profiles = $this->Profiles->find()->where(['id' => $order_id->uploaded_for])->first();
                $this->set('p', $profiles);
            }
            //$did= $document_id->id;
            if (isset($order_id))
                $this->set('modal', $order_id);
            $this->set('cid', $cid);
            $this->set('did', $did);
            /*$profile = $this->Clients->get($id);
            $this->set('profile', $profile);*/
            $this->set('disabled', 1);
            if ($did) {

                $feeds = TableRegistry::get('feedbacks');
                //$pre_at = TableRegistry::get('driver_application_accident');

                $feed = $feeds->find()->where(['order_id' => $did])->first();
                $this->set('feeds', $feed);

                $survey = TableRegistry::get('Survey');
                //$pre_at = TableRegistry::get('driver_application_accident');
                $sur = $survey->find()->where(['order_id' => $did])->first();
                $this->set('survey', $sur);

                $attachments = TableRegistry::get('attachments');
                //$pre_at = TableRegistry::get('driver_application_accident');
                $attachment = $attachments->find()->where(['order_id' => $did])->all();
                $this->set('attachments', $attachment);

                $attachments = TableRegistry::get('audits');
                //$pre_at = TableRegistry::get('driver_application_accident');
                $audits = $attachments->find()->where(['order_id' => $did])->first();
                $this->set('audits', $audits);

                $pre = TableRegistry::get('doc_attachments');
                //$pre_at = TableRegistry::get('driver_application_accident');
                $pre_at['attach_doc'] = $pre->find()->where(['order_id' => $did, 'sub_id' => 1])->all();
                $this->set('pre_at', $pre_at);

                $da = TableRegistry::get('driver_application');
                $da_detail = $da->find()->where(['order_id' => $did])->first();
                if ($da_detail) {
                    $da_ac = TableRegistry::get('driver_application_accident');
                    $sub['da_ac_detail'] = $da_ac->find()->where(['driver_application_id' => $da_detail->id])->all();

                    $da_li = TableRegistry::get('driver_application_licenses');
                    $sub['da_li_detail'] = $da_li->find()->where(['driver_application_id' => $da_detail->id])->all();

                    $da_at = TableRegistry::get('doc_attachments');
                    $sub['da_at'] = $da_at->find()->where(['order_id' => $did, 'sub_id' => 2])->all();

                    $de_at = TableRegistry::get('doc_attachments');
                    $sub['de_at'] = $de_at->find()->where(['order_id' => $did, 'sub_id' => 3])->all();

                    $this->set('sub', $sub);
                }
                $con = TableRegistry::get('consent_form');
                $con_detail = $con->find()->where(['order_id' => $did])->first();
                if ($con_detail) {
                    //echo $con_detail->id;die();
                    $con_cri = TableRegistry::get('consent_form_criminal');
                    $sub2['con_cri'] = $con_cri->find()->where(['consent_form_id' => $con_detail->id])->all();

                    $con_at = TableRegistry::get('doc_attachments');
                    $sub2['con_at'] = $con_at->find()->where(['order_id' => $did, 'sub_id' => 4])->all();
                    $this->set('sub2', $sub2);
                    $this->set('consent_detail', $con_detail);

                }
                $emp = TableRegistry::get('employment_verification');
                $sub3['emp'] = $emp->find()->where(['order_id' => $did])->all();

                //echo $con_detail->id;die();
                $emp_att = TableRegistry::get('doc_attachments');
                $sub3['att'] = $emp_att->find()->where(['order_id' => $did, 'sub_id' => 41])->all();

                $this->set('sub3', $sub3);

                $edu = TableRegistry::get('education_verification');
                $sub4['edu'] = $edu->find()->where(['order_id' => $did])->all();
                //echo $con_detail->id;die();
                $edu_att = TableRegistry::get('doc_attachments');
                $sub4['att'] = $edu_att->find()->where(['order_id' => $did, 'sub_id' => 42])->all();
                $this->set('sub4', $sub4);
                
                $sur_att = TableRegistry::get('doc_attachments');
                $sub6['att'] = $sur_att->find()->where(['order_id' => $did, 'sub_id' => 6])->all();
                $this->set('sub6', $sub6);
            }
            $this->render('addorder');
        }

        public function addorder($cid = 0, $did = 0, $table = null)
        {
            $this->set('doc_comp', $this->Document);
            $this->set('uid', '');
            $this->set('table', $table);
            $setting = $this->Settings->get_permission($this->request->session()->read('Profile.id'));
            $doc = $this->Document->getDocumentcount();
            $cn = $this->Document->getUserDocumentcount();

            //die(count($doc));
            if ($setting->orders_create == 0 || count($doc) == 0 || $cn == 0) {
                $this->Flash->error('Sorry, you don\'t have the required permissions.');
                return $this->redirect("/");

            }
            $orders = TableRegistry::get('orders');
            if ($did) {
                $order_id = $orders->find()->where(['id' => $did])->first();
                $this->set('ooo',$order_id);
                $this->loadModel('Profiles');
                $profiles = $this->Profiles->find()->where(['id' => $order_id->uploaded_for])->first();
                $this->set('p', $profiles);
            } else {
                if (isset($_GET['driver']) && is_numeric($_GET['driver']) && $_GET['driver']) {
                    $this->loadModel('Profiles');
                    $profiles = $this->Profiles->find()->where(['id' => $_GET['driver']])->first();
                    $this->set('p', $profiles);
                }
            }

            if ($did) {
                $o_model = TableRegistry::get('Orders');
                $orde = $o_model->find()->where(['id' => $did])->first();
                if ($orde) {
                    $dr = $orde->draft;
                    if ($dr == '0' || !$dr) {
                        $dr = 0;
                        $this->Flash->success('Your order has been submitted');
                        //die();
                    } else
                        $dr = 1;
                } else
                    $dr = 1;
            } else
                $dr = 1;
            $this->set('dr', $dr);
            //$did= $document_id->id;
            if (isset($order_id))
                $this->set('modal', $order_id);
            $this->set('cid', $cid);
            $this->set('did', $did);
            if ($did) {

                $feeds = TableRegistry::get('feedbacks');
                //$pre_at = TableRegistry::get('driver_application_accident');

                $feed = $feeds->find()->where(['order_id' => $did])->first();
                $this->set('feeds', $feed);

                $survey = TableRegistry::get('Survey');
                //$pre_at = TableRegistry::get('driver_application_accident');
                $sur = $survey->find()->where(['order_id' => $did])->first();
                $this->set('survey', $sur);

                $attachments = TableRegistry::get('attachments');
                //$pre_at = TableRegistry::get('driver_application_accident');
                $attachment = $attachments->find()->where(['order_id' => $did])->all();
                $this->set('attachments', $attachment);

                $attachments = TableRegistry::get('audits');
                //$pre_at = TableRegistry::get('driver_application_accident');
                $audits = $attachments->find()->where(['order_id' => $did])->first();
                $this->set('audits', $audits);

                $pre = TableRegistry::get('doc_attachments');
                //$pre_at = TableRegistry::get('driver_application_accident');
                $pre_at['attach_doc'] = $pre->find()->where(['order_id' => $did, 'sub_id' => 1])->all();
                $this->set('pre_at', $pre_at);

                $da = TableRegistry::get('driver_application');
                $da_detail = $da->find()->where(['order_id' => $did])->first();
                if ($da_detail) {
                    $da_ac = TableRegistry::get('driver_application_accident');
                    $sub['da_ac_detail'] = $da_ac->find()->where(['driver_application_id' => $da_detail->id])->all();

                    $da_li = TableRegistry::get('driver_application_licenses');
                    $sub['da_li_detail'] = $da_li->find()->where(['driver_application_id' => $da_detail->id])->all();

                    $da_at = TableRegistry::get('doc_attachments');
                    $sub['da_at'] = $da_at->find()->where(['order_id' => $did, 'sub_id' => 2])->all();

                    $de_at = TableRegistry::get('doc_attachments');
                    $sub['de_at'] = $de_at->find()->where(['order_id' => $did, 'sub_id' => 3])->all();

                    $this->set('sub', $sub);
                }
                $con = TableRegistry::get('consent_form');
                $con_detail = $con->find()->where(['order_id' => $did])->first();
                if ($con_detail) {
                    //echo $con_detail->id;die();
                    $con_cri = TableRegistry::get('consent_form_criminal');
                    $sub2['con_cri'] = $con_cri->find()->where(['consent_form_id' => $con_detail->id])->all();

                    $con_at = TableRegistry::get('doc_attachments');
                    $sub2['con_at'] = $con_at->find()->where(['order_id' => $did, 'sub_id' => 4])->all();
                    $this->set('sub2', $sub2);
                    $this->set('consent_detail', $con_detail);

                }
                $emp = TableRegistry::get('employment_verification');
                $sub3['emp'] = $emp->find()->where(['order_id' => $did])->all();

                //echo $con_detail->id;die();
                $emp_att = TableRegistry::get('doc_attachments');
                $sub3['att'] = $emp_att->find()->where(['order_id' => $did, 'sub_id' => 41])->all();

                $this->set('sub3', $sub3);

                $edu = TableRegistry::get('education_verification');
                $sub4['edu'] = $edu->find()->where(['order_id' => $did])->all();
                //echo $con_detail->id;die();
                $edu_att = TableRegistry::get('doc_attachments');
                $sub4['att'] = $edu_att->find()->where(['order_id' => $did, 'sub_id' => 42])->all();
                $this->set('sub4', $sub4);
            }

            $this->set('provinces',  $this->LoadSubDocs());
        }

        public function savedoc($cid = 0, $did = 0)
        {
            //$this->set('doc_comp',$this->Document);
            $this->Document->savedoc($cid, $did);
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
            $this->Document->savedDriverApp($document_id, $cid);

            die;
        }

        /**
         * saving driver application data
         */
        public function savedDriverEvaluation($document_id = 0, $cid = 0)
        {
            $this->Document->savedDriverEvaluation($document_id, $cid);
            die();
        }

        /**
         * saving driver application data
         */
        public function savedMeeOrder($document_id = 0, $cid = 0)
        {
            $this->Document->savedMeeOrder($document_id, $cid);
            die();
        }

        function saveEmployment($document_id = 0, $cid = 0)
        {
            $this->Document->saveEmployment($document_id, $cid);
            die();
        }

        function saveEducation($document_id = 0, $cid = 0)
        {
            $this->Document->saveEducation($document_id, $cid);
            die();
        }

        public function deleteOrder($id, $draft = '')
        {
            if (isset($_GET['draft']))
                $draft = 1;

            $setting = $this->Settings->get_permission($this->request->session()->read('Profile.id'));
            if ($setting->orders_delete == 0) {
                $this->Flash->error('Sorry, you don\'t have the required permissions.');
                return $this->redirect("/");
            }

            $this->loadModel('Orders');
            $this->Orders->deleteAll(array('id' => $id));

            $this->loadModel('Documents');
            $this->Documents->deleteAll(array('order_id' => $id));
            $this->Flash->success('The order has been deleted.');
            if ($draft)
                $this->redirect('/orders/orderslist?draft');
            else
                $this->redirect('/orders/orderslist');
        }

        public function subpages($filename)
        {
            $this->set('doc_comp', $this->Document);
            $this->layout = "blank";
            $this->set("filename", $filename);
        }

        public function index()
        {
            $this->redirect(array('controller'=>'orders','action'=>'orderslist'));
            
            $this->set('doc_comp', $this->Document);
            if (isset($_GET['draft']) && isset($_GET['flash'])) {
                $this->Flash->success('Order saved as draft');
            } else
                if (isset($_GET['flash'])) {
                    $this->Flash->success('Order submitted successfully.');
                }
            $setting = $this->Settings->get_permission($this->request->session()->read('Profile.id'));
            $doc = $this->Document->getDocumentcount();
            $cn = $this->Document->getUserDocumentcount();

            if ($setting->orders_list == 0 || count($doc) == 0 || $cn == 0) {
                $this->Flash->error('Sorry, you don\'t have the required permissions.');
                return $this->redirect("/");

            }
            $orders = TableRegistry::get('orders');
            $order = $orders->find();
            //$order = $order->order(['orders.id' => 'DESC']);
            $order = $order->select();
            $cond = '';
            if (!$this->request->session()->read('Profile.super')) {
                $u = $this->request->session()->read('Profile.id');

                $setting = $this->Settings->get_permission($u);
                if ($setting->document_others == 0) {
                    if ($cond == '')
                        $cond = $cond . ' user_id = ' . $u;
                    else
                        $cond = $cond . ' AND user_id = ' . $u;

                }

            }
            if (isset($_GET['searchdoc']) && $_GET['searchdoc']) {
                $cond = $cond . ' (orders.title LIKE "%' . $_GET['searchdoc'] . '%" OR orders.description LIKE "%' . $_GET['searchdoc'] . '%")';
            }
            if (isset($_GET['table']) && $_GET['table']) {
                if ($cond == '')
                    $cond = $cond . ' orders.id IN (SELECT order_id FROM ' . $_GET['table'] . ')';
                else
                    $cond = $cond . ' AND orders.id IN (SELECT order_id FROM ' . $_GET['table'] . ')';
            }
            if (!$this->request->session()->read('Profile.admin') && $setting->orders_others == 0) {
                if ($cond == '')
                    $cond = $cond . ' orders.user_id = ' . $this->request->session()->read('Profile.id');
                else
                    $cond = $cond . ' AND orders.user_id = ' . $this->request->session()->read('Profile.id');
            }
            if (isset($_GET['submitted_by_id']) && $_GET['submitted_by_id']) {
                if ($cond == '')
                    $cond = $cond . ' orders.user_id = ' . $_GET['submitted_by_id'];
                else
                    $cond = $cond . ' AND orders.user_id = ' . $_GET['submitted_by_id'];
            }
            if (isset($_GET['client_id']) && $_GET['client_id']) {
                if ($cond == '')
                    $cond = $cond . ' orders.client_id = ' . $_GET['client_id'];
                else
                    $cond = $cond . ' AND orders.client_id = ' . $_GET['client_id'];
            }
            if (isset($_GET['division']) && $_GET['division']) {
                if ($cond == '')
                    $cond = $cond . ' division = "' . $_GET['division'] . '"';
                else
                    $cond = $cond . ' AND division = "' . $_GET['division'] . '"';
            }
            /*if (isset($_GET['draft'])) {
                if ($cond == '')
                    $cond = $cond . ' orders.draft = 1';
                else
                    $cond = $cond . ' AND orders.draft = 1';
            } else {
                if ($cond == '')
                    $cond = $cond . ' orders.draft = 0';
                else
                    $cond = $cond . ' AND orders.draft = 0';
            }*/
            if ($cond) {
                $order = $order->where([$cond])->contain(['Profiles']);
            } else {
                $order = $order->contain(['Profiles']);
            }
            if (isset($_GET['searchdoc'])) {
                $this->set('search_text', $_GET['searchdoc']);
            }
            if (isset($_GET['submitted_by_id'])) {
                $this->set('return_user_id', $_GET['submitted_by_id']);
            }
            if (isset($_GET['client_id'])) {
                $this->set('return_client_id', $_GET['client_id']);
            }
            if (isset($_GET['type'])) {
                $this->set('return_type', $_GET['type']);
            }
            $this->set('orders', $this->paginate($order));

        }

        function get_orderscount($type, $c_id = "")
        {

            $u = $this->request->session()->read('Profile.id');

            if (!$this->request->session()->read('Profile.super')) {
                $setting = $this->Settings->get_permission($u);
                //var_dump($setting);
                if ($setting->document_others == 0) {
                    $u_cond = "Orders.user_id=$u";
                } else
                    $u_cond = "";

            } else
                $u_cond = "";

            $model = TableRegistry::get($type);

            if ($c_id != "") {

                $cnt = $model->find()->where(['((document_id IN (SELECT id FROM documents WHERE draft = 0)) OR (order_id IN (SELECT id FROM orders WHERE draft = 0)))', $u_cond, $type . '.client_id' => $c_id])->contain(['Orders'])->count();
            } else {

                $cond = $this->Settings->getclientids($u, $this->request->session()->read('Profile.super'), $type);
                //var_dump($u_cond);die();
                //var_dump($cond);die();
                $cnt = $model->find()->where(['((document_id IN (SELECT id FROM documents WHERE draft = 0)) OR (order_id IN (SELECT id FROM orders WHERE draft = 0)))', $u_cond, 'OR' => $cond])->contain(['Orders'])->count();
            }
            //debug($cnt); die();
            $this->response->body(($cnt));
            return $this->response;
            die();
        }

        public function StartOrderSave($orderid = null, $response = null)
        {
            $this->set('doc_comp', $this->Document);
            echo '!!!!!!';
            echo $response;
            echo $arr['response'] = $_GET['response'];

            echo 'AAAAAAAAAAA';

            die();
            $querys = TableRegistry::get('orders');
            $query2 = $querys->query();
            $query2->update()
                ->set($arr)
                ->where(['id' => $orderid])
                ->execute();
            die();
        }

        public function save_ebs_pdi($orderid, $pdi)
        {
            $this->set('doc_comp', $this->Document);
            $query2 = TableRegistry::get('orders');
            $arr['ebs_pdi'] = $pdi;
            $query2 = $query2->query();
            $query2->update()
                ->set($arr)
                ->where(['id' => $orderid])
                ->execute();
            $this->response->body($query2);
            return $this->response;
        }

        public function save_webservice_ids($orderid, $ins_id, $ebs_id)
        {
            $this->set('doc_comp', $this->Document);
            $query2 = TableRegistry::get('orders');
            $arr['ins_id'] = $ins_id;
            $arr['ebs_id'] = $ebs_id;
            $query2 = $query2->query();
            $query2->update()
                ->set($arr)
                ->where(['id' => $orderid])
                ->execute();
            $this->response->body($query2);
            return $this->response;
        }

        public function save_pdi($orderid, $id, $pdi)
        {

       //    echo  $orderid . ' ' .  $id . ' ' . $pdi;
            $this->set('doc_comp', $this->Document);
            $query2 = TableRegistry::get('orders');
            switch ($pdi) {

                case "ins_79":
                    $arr['ins_79'] = $id;
                    break;

                case "ins_1":
                    $arr['ins_1'] = $id;
                    break;

                case "ins_14":
                    $arr['ins_14'] = $id;
                    break;

                case "ins_77":
                    $arr['ins_77'] = $id;
                    break;

                case "ins_78":
                    $arr['ins_78'] = $id;
                    break;

                case "ebs_1603":
                    $arr['ebs_1603'] = $id;
                    break;

                case "ebs_1627":
                    $arr['ebs_1627'] = $id;
                    break;

                case "ebs_1650":
                    $arr['ebs_1650'] = $id;
                    break;

                case "ins_72":
                    $arr['ins_72'] = $id;
                    break;

                default:
                    $nothing = '111';
            }

            /*
                       echo $pdi;
                       echo $orderid;
                       echo "<br><br>";

                       var_dump($arr);

                        */
                       $query2 = $query2->query();
                       $query2->update()
                           ->set($arr)
                           ->where(['id' => $orderid])
                           ->execute();
                       $this->response->body($query2);

            return $this->response;
        }

        public function webservice($order_type = null, $forms = null, $orderid = null, $driverid = null)
        {
            $all_attachments = TableRegistry::get('doc_attachments');
            $subdocument = TableRegistry::get('subdocuments');

            $this->layout = "blank";
            echo '<br><br>order id '.$orderid . '<br><br>';

            $model = TableRegistry::get('profiles');
            $driverinfo = $model->find()->where(['id' => $driverid])->first();

            $this->set('orderid', $orderid);
            $this->set('driverinfo', $driverinfo);

            if ($order_type == "Requalification") {
                $ordertype1 = "MEE-REQ";
            } else if ($order_type == "Order Products") {
                $ordertype1 = "MEE-IND";
            } else {
                $ordertype1 = "MEE";
            }
            $this->set('ordertype', $ordertype1);

            $orders = TableRegistry::get('orders');
            $order_info = $orders->find()->where(['id' => $orderid])->first();
            $this->set('order_info', $order_info);

            $order_attach = $all_attachments->find()->where(['order_id'=>$orderid]);

            foreach($order_attach as $oa)
            {
                echo "Attachment: " . $oa->attachment;
                $sd = $subdocument->find()->where(['id'=>$oa->sub_id])->first();

                if($sd){
                    echo "<br/>";

                    echo "Sub Document: " . $sd->title;}
                echo "<br/>";
                echo "<br/>";
            }

            $this->set('order_attach', $order_attach);
            $this->set('subdocument', TableRegistry::get('subdocuments'));

        }
        public function createPdfBg()
        {            
            //die();
        }
        public function createPdf($oid)
        {
            $this->set('doc_comp', $this->Document);
            $this->set('oid', $oid);
            $this->layout = 'blank';

            $this->layout = 'blank';

            $consent = TableRegistry::get('consent_form');
            $arr['consent'] = $consent
                ->find()
                ->where(['order_id' => $oid])->first();
            $this->set('detail', $arr);
            $criminal = TableRegistry::get('consent_form_criminal');
            $cri = $criminal
                ->find()
                ->where(['consent_form_id' => $arr['consent']->id]);
            $this->set('detail', $arr);
            $this->set(compact('cri'));
            $attach = TableRegistry::get('doc_attachments');
            $att = $attach
                ->find()
                ->where(['order_id' => $oid, 'sub_id' => 4, 'attachment <> ""']);
            $this->set('detail', $arr);
            $this->set(compact('att'));

        }

        public function createPdfEmployment($id)
        {
            $this->set('doc_comp', $this->Document);
            $this->layout = 'blank';
            $consent = TableRegistry::get('employment_verification');
            $arr['consent'] = $consent
                ->find()
                ->where(['order_id' => $id])->all();

            $this->set('detail', $arr);
            $attach = TableRegistry::get('doc_attachments');
            $att = $attach
                ->find()
                ->where(['order_id' => $id, 'sub_id' => 41, 'attachment <> ""'])->all();

            $this->set('order_id', $id);
            $this->set(compact('att'));
        }

        public function createPdfEducation($oid)
        {
            $this->set('doc_comp', $this->Document);
            $this->set('oid', $oid);
            $this->layout = 'blank';
            $consent = TableRegistry::get('education_verification');
            $education = $consent
                ->find()
                ->where(['order_id' => $oid]);

            $attach = TableRegistry::get('doc_attachments');
            $att = $attach
                ->find()
                ->where(['order_id' => $oid, 'sub_id' => 42, 'attachment <> ""']);

            $this->set(compact('education'));

            $this->set(compact('att'));
        }

        public function viewReport($client_id, $order_id)
        {
            $this->set('doc_comp', $this->Document);
            $orders = TableRegistry::get('orders');
            $order = $orders
                ->find()
                ->where(['orders.id' => $order_id])->contain(['Profiles', 'Clients', 'RoadTest'])->first();

            $this->set('order', $order);
            //  debug($order);
        }

        function savedriver($oid)
        {
            $this->set('doc_comp', $this->Document);
            $arr['is_hired'] = $_POST['is_hired'];
            $orders = TableRegistry::get('profiles');
            $order = $orders
                ->query()->update()
                ->set($arr)
                ->where(['profiles.id' => $oid])->execute();

            die();
        }

        public function saveAttachmentsPrescreen($data = NULL, $count = 0)
        {//count is to delete all while first insertion and no delete for following insertion

            $this->Document->saveAttachmentsPrescreen($data, $count);
            die();
        }

        public function saveAttachmentsDriverApp($data = NULL, $count = 0)
        {
            $this->Document->saveAttachmentsDriverApp($data, $count);
            die();
        }

        public function saveAttachmentsRoadTest($data = NULL, $count = 0)
        {
            $this->Document->saveAttachmentsRoadTest($data, $count);
            die();
        }

        public function saveAttachmentsConsentForm($data = NULL, $count = 0)
        {
            $this->Document->saveAttachmentsConsentForm($data, $count);
            die();
        }

        public function saveAttachmentsEmployment($data = NULL, $count = 0)
        {
            $this->Document->saveAttachmentsEmployment($data, $count);
            die();
        }

        public function saveAttachmentsEducation($data = NULL, $count = 0)
        {
            $this->Document->saveAttachmentsEducation($data, $count);
            die();
        }

        function getprocessed($table, $oid)
        {
            $model = TableRegistry::get($table);
            $q = $model->find()->where(['order_id' => $oid])->count();
            $this->response->body($q);
            return $this->response;
        }

        public function drafts()
        {

        }

        function getDriverByClient($client)
        {
            //$logged_id = $this->request->session()->read('Profile.id');
            if (!is_numeric($client)) {
                $logged_id = $this->request->session()->read('Profile.id');
                //echo "<br/>";

                $cmodel = TableRegistry::get('Clients');
                if (!$this->request->session()->read('Profile.admin') && !$this->request->session()->read('Profile.super'))
                    $clients = $cmodel->find()->where(['(profile_id LIKE "' . $logged_id . ',%" OR profile_id LIKE "%,' . $logged_id . ',%" OR profile_id LIKE "%,' . $logged_id . '")']);
                else
                    $clients = $cmodel->find();

                $profile_ids = '';
                foreach ($clients as $c) {

                    if ($profile_ids) {
                        $profile_ids = $profile_ids . ',' . $c->profile_id;
                    } else {
                        $profile_ids = $c->profile_id;
                    }
                }
                if (!$profile_ids)
                    $profile_ids = '9999999';

                $profile_ids = str_replace(',', ' ', $profile_ids);
                $profile_ids = trim($profile_ids);
                $profile_ids = str_replace(' ', ',', $profile_ids);
                $profile_ids = str_replace(',,', ',', $profile_ids);
                $profile_ids = str_replace(',,', ',', $profile_ids);

                $model = TableRegistry::get('Profiles');
                $profile = $model->find()->where(['id IN (' . $profile_ids . ')', '(profile_type = 5 OR profile_type = 7 OR profile_type = 8)']);
            } else {
                $cmodel = TableRegistry::get('Clients');
                $clients = $cmodel->find()->where(['id' => $client])->first();
                $profile_ids = $clients->profile_id;

                $profile_ids = str_replace(',', ' ', $profile_ids);
                $profile_ids = trim($profile_ids);
                $profile_ids = str_replace(' ', ',', $profile_ids);
                $profile_ids = str_replace(',,', ',', $profile_ids);
                $profile_ids = str_replace(',,', ',', $profile_ids);

                $model = TableRegistry::get('Profiles');
                $profile = $model->find()->where(['id IN (' . $profile_ids . ')', '(profile_type = 5 OR profile_type = 7 OR profile_type = 8)']);
            }
            if ($_GET['ordertype'] != 'QUA')
                echo "<option value=''>Select Driver</option>";
            else
                echo "<option value=''>Select Driver</option>";
            if ($profile) {

                foreach ($profile as $p) {
                    echo "<option value='" . $p->id . "'>" . $p->fname . ' ' . $p->mname . ' ' . $p->lname . "</option>";
                }
            }

            die();
        }

        function testing()
        {
            $this->set('doc_comp', $this->Document);
        }

        public function orderslist()
        {
            $this->set('doc_comp', $this->Document);
            if (isset($_GET['draft']) && isset($_GET['flash'])) {
                $this->Flash->success('Order saved as draft');
            } else
                if (isset($_GET['flash'])) {
                    $this->Flash->success('Order saved successfully');
                }
            $setting = $this->Settings->get_permission($this->request->session()->read('Profile.id'));
            $doc = $this->Document->getDocumentcount();
            $cn = $this->Document->getUserDocumentcount();

            if ($setting->orders_list == 0 || count($doc) == 0 || $cn == 0) {
                $this->Flash->error('Sorry, you don\'t have the required permissions.');
                return $this->redirect("/");

            }
            $orders = TableRegistry::get('orders');
            $order = $orders->find();
            //$order = $order->order(['orders.id' => 'DESC']);
            $order = $order->select();
            $cond = '';
            $sess = $this->request->session()->read('Profile.id');
            $cls = TableRegistry::get('Clients');
            $cl = $cls->find()->where(['(profile_id LIKE "' . $sess . ',%" OR profile_id LIKE "%,' . $sess . ',%" OR profile_id LIKE "%,' . $sess . '%")'])->all();
            $cli_id = '999999999';
            foreach ($cl as $cc) {
                $cli_id = $cli_id . ',' . $cc->id;
            }

            if (!$this->request->session()->read('Profile.super')) {
                $u = $this->request->session()->read('Profile.id');

                $setting = $this->Settings->get_permission($u);
                /*if ($setting->document_others == 0) {
                    if ($cond == '')
                        $cond = $cond . ' user_id = ' . $u;
                    else
                        $cond = $cond . ' AND user_id = ' . $u;

                }*/

            }
            if (isset($_GET['searchdoc']) && $_GET['searchdoc']) {
                $cond = $cond . ' (orders.title LIKE "%' . $_GET['searchdoc'] . '%" OR orders.description LIKE "%' . $_GET['searchdoc'] . '%")';
            }
            if (isset($_GET['table']) && $_GET['table']) {
                if ($cond == '')
                    $cond = $cond . ' orders.id IN (SELECT order_id FROM ' . $_GET['table'] . ')';
                else
                    $cond = $cond . ' AND orders.id IN (SELECT order_id FROM ' . $_GET['table'] . ')';
            }
            if (!$this->request->session()->read('Profile.admin') && $setting->orders_others == 0) {
                if ($cond == '')
                    $cond = $cond . ' orders.user_id = ' . $this->request->session()->read('Profile.id');
                else
                    $cond = $cond . ' AND orders.user_id = ' . $this->request->session()->read('Profile.id');
            }
            if (!$this->request->session()->read('Profile.admin') && $setting->orders_others == 1) {
                if ($cond == '')
                    $cond = $cond . ' orders.client_id IN (' . $cli_id . ')';
                else
                    $cond = $cond . ' AND orders.client_id IN (' . $cli_id . ')';
            }
            if (isset($_GET['submitted_by_id']) && $_GET['submitted_by_id']) {
                if ($cond == '')
                    $cond = $cond . ' orders.user_id = ' . $_GET['submitted_by_id'];
                else
                    $cond = $cond . ' AND orders.user_id = ' . $_GET['submitted_by_id'];
            }
            if (isset($_GET['uploaded_for']) && $_GET['uploaded_for']) {
                if ($cond == '')
                    $cond = $cond . ' orders.uploaded_for = ' . $_GET['uploaded_for'];
                else
                    $cond = $cond . ' AND orders.uploaded_for = ' . $_GET['uploaded_for'];
            }
            if (isset($_GET['client_id']) && $_GET['client_id']) {
                if ($cond == '')
                    $cond = $cond . ' orders.client_id = ' . $_GET['client_id'];
                else
                    $cond = $cond . ' AND orders.client_id = ' . $_GET['client_id'];
            }
            if (isset($_GET['division']) && $_GET['division']) {
                if ($cond == '')
                    $cond = $cond . ' division = "' . $_GET['division'] . '"';
                else
                    $cond = $cond . ' AND division = "' . $_GET['division'] . '"';
            }
            if (isset($_GET['draft'])) {
                if ($cond == '')
                    $cond = $cond . ' orders.draft = 1';
                else
                    $cond = $cond . ' AND orders.draft = 1';
            }/* else {
                if ($cond == '')
                    $cond = $cond . ' orders.draft = 0';
                else
                    $cond = $cond . ' AND orders.draft = 0';
            }*/
            if ($cond) {
                $order = $order->where([$cond])->contain(['Profiles']);
            } else {
                $order = $order->contain(['Profiles']);
            }
            if (isset($_GET['searchdoc'])) {
                $this->set('search_text', $_GET['searchdoc']);
            }
            if (isset($_GET['submitted_by_id'])) {
                $this->set('return_user_id', $_GET['submitted_by_id']);
            }
            if (isset($_GET['client_id'])) {
                $this->set('return_client_id', $_GET['client_id']);
            }
            if (isset($_GET['type'])) {
                $this->set('return_type', $_GET['type']);
            }

            //debug($order);

            $this->set('orders', $this->appendattachments($this->paginate($order)));

        }

        function getClientByDriver($driver)
        {
            //$controller = $this->_registry->getController();
            $settings = $this->Settings->get_settings();
            $logged_id = $this->request->session()->read('Profile.id');
            $cmodel = TableRegistry::get('Clients');
            if (!$this->request->session()->read('Profile.admin') && !$this->request->session()->read('Profile.super'))
                $clients = $cmodel->find()->where(['(profile_id LIKE "' . $logged_id . ',%" OR profile_id LIKE "%,' . $logged_id . ',%" OR profile_id LIKE "%,' . $logged_id . '") AND (profile_id LIKE "' . $driver . ',%" OR profile_id LIKE "%,' . $driver . ',%" OR profile_id LIKE "%,' . $driver . '")']);//Selecting client with respect to both loggedin user and driver
            else
                $clients = $cmodel->find()->where(['(profile_id LIKE "' . $driver . ',%" OR profile_id LIKE "%,' . $driver . ',%" OR profile_id LIKE "%,' . $driver . '")']);

            if (!is_numeric($driver)) {
                if (!$this->request->session()->read('Profile.admin') && !$this->request->session()->read('Profile.super'))
                    $clients = $cmodel->find()->where(['(profile_id LIKE "' . $logged_id . ',%" OR profile_id LIKE "%,' . $logged_id . ',%" OR profile_id LIKE "%,' . $logged_id . '")']);
                else
                    $clients = $cmodel->find();
            }
            //debug($clients);

            if ($clients->count() > 0) {
                echo "<option value=''>Select " . ucfirst($settings->client) . "s</option>";
                foreach ($clients as $c) {
                    echo "<option value='" . $c->id . "'>" . $c->company_name . "</option>";
                }
            } else {
                echo "Error";
            }

            die();
        }

        public function getOrderData($cid = 0, $order_id = 0)
        {
            $this->Document->getOrderData($cid, $order_id);
            die;

        }
        
         public function getSubDocs()
        {
            $docs = TableRegistry::get('subdocuments');
            $doc = $docs->find()->all();
            //$do = $doc->select('all');
            $this->response->body($doc);
            return $this->response;  
            die; 
        }
        
        public function getdocid($sub_doc_id, $order_id)
        {
            $doc = TableRegistry::get('documents');
            $doc = $doc->find()->where(['sub_doc_id' => $sub_doc_id, 'order_id' => $order_id])->first();
            $this->response->body($doc);
            return $this->response;
            die;
        }
        public function getProductTitle($id='')
        {
           $doc = TableRegistry::get('order_products'); 
           $doc = $doc->find()->where(['number' => $id])->first();
           $this->response->body($doc);
            return $this->response;
            die;
        }
        function check_driver_abstract2($id)
        {
           $doc = TableRegistry::get('profiles'); 
           $doc = $doc->find()->where(['id' => $id])->first();
           $this->response->body($doc);
            return $this->response;
            die;
          
        }
        function check_cvor2($id)
        {
           $doc = TableRegistry::get('profiles'); 
           $doc = $doc->find()->where(['id' => $id])->first();
           $this->response->body($doc);
            return $this->response;
            die;
          
        }
        function check_driver_abstract($id)
        {
           $doc = TableRegistry::get('profiles'); 
           $doc = $doc->find()->where(['id' => $id])->first();
           $province = $doc->driver_province;
           $arr = array('BC','MB','NU','NT','QC','SK','YT');
           //$arr = array('BC','SK','MB');
           if(in_array($province,$arr)) {
               echo '1';
           } else {
               echo '0';
           }
           die();
          
        }
        function check_cvor($id)
        {
           $doc = TableRegistry::get('profiles'); 
           $doc = $doc->find()->where(['id' => $id])->first();
           $province = $doc->driver_province;
           //$arr = array('BC','MB','NU','NT','QC','SK','YT');
           $arr = array('BC','SK','MB');
           if(in_array($province,$arr)) {
               echo '1';
           } else {
               echo '0';
           }
           die();
          
        }


        public function appendattachments($query){
            foreach($query as $client){
                $client->hasattachments = $this->hasattachments($client->id);
            }
            return $query;
        }
        public function hasattachments($orderid){
            $docs = TableRegistry::get('doc_attachments');
            $query = $docs->find();
            $client_docs = $query->select()->where(['order_id' => $orderid, 'attachment LIKE' => "%.%"])->first();
            if($client_docs) {return true;}
            return false;
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
                    $quiz = $table2->find()->where(['ID' => $province->ID, "DocID" => $document->id])->first();
                    if ($quiz) { $province->subdocuments[$document->id] = strtolower(trim($document->title)); }
                }
                $provinces2[] = $province;
            }
            $this->set('subdocuments',  $subdocuments);
            return $provinces2;
        }
        function getProNum()
        {
            $products =  TableRegistry::get('order_products');
            $pro = $products->find()->where(['enable'=>1,'id <>'=>8]);
            $prod = '';
            foreach($pro as $p)
            {
                if($prod == '')
                {
                    $prod = $p->number;
                }
                else
                $prod = $prod.','.$p->number;
                
            }
            $this->response->body($prod);
            return $this->response;
            die;
            
        }
    }

