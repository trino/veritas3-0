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

class ProfilesController extends AppController{

    public $paginate = [
        'limit' => 20,
        'order' => ['id' => 'DESC'],
    ];

    public function initialize(){
        parent::initialize();
        $this->loadComponent('Settings');
        $this->loadComponent('Mailer');
        $this->loadComponent('Document');
        $this->loadComponent('Trans');
        if (!$this->request->session()->read('Profile.id')) {
            $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $this->redirect('/login?url=' . urlencode($url));
        }

    }

    function upload_img($id){
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

    function client_default()
    {
        if (isset($_FILES['myfile']['name']) && $_FILES['myfile']['name']) {
            $arr = explode('.', $_FILES['myfile']['name']);
            $ext = end($arr);
            $rand = rand(100000, 999999) . '_' . rand(100000, 999999) . '.' . $ext;
            $allowed = array('jpg', 'jpeg', 'png', 'bmp', 'gif');
            $check = strtolower($ext);
            if (in_array($check, $allowed)) {
                move_uploaded_file($_FILES['myfile']['tmp_name'], APP . '../webroot/img/clients/' . $rand);

                unset($_POST);
                $_POST['client_img'] = $rand;
                $img = TableRegistry::get('settings');
                $i = $img->find()->first();
                $old_image = $i->client_img;
                $query = $img->query();
                $query->update()
                    ->set($_POST)
                    ->where(['id' => 1])
                    ->execute();

                @unlink(WWW_ROOT . 'img/clients/' . $old_image);
                echo $rand;

            } else {
                echo "error";
            }
        }
        die();
    }

    function upload_all($id = ""){
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

    public function DeleteSubdocument($id){
        TableRegistry::get('subdocuments')->deleteAll(array('id' => $id));
    }
    public function settings(){
        if(isset($_GET["DeleteDoc"])){
            $this->DeleteSubdocument($_GET["DeleteDoc"]);
            $this->Flash->success('Subdocument created successfully.');
        }
        if(isset($_GET["toggledebug"])) {
            $filename = $_SERVER["DOCUMENT_ROOT"] . "debugmode.txt";
            if (file_exists($filename)) {
                unlink($filename);
                $this->Flash->success('Debug mode: Deactivated');
            } else {
                file_put_contents ($filename, "true");
                $this->Flash->success('Debug mode: Activated');
            }
        }

        $this->loadModel('Logos');
        $this->loadModel('OrderProducts');
        $this->loadModel('ProfileTypes');
        $this->loadModel("ClientTypes");
        $this->set('client_types', $this->ClientTypes->find()->all());
        $this->set('products', $this->OrderProducts->find()->all());

        $this->set('ptypes', $this->ProfileTypes->find()->all());//where(['secondary' => '0'])
        $this->set('logos', $this->paginate($this->Logos->find()->where(['secondary' => '0'])));
        $this->set('logos1', $this->paginate($this->Logos->find()->where(['secondary' => '1'])));
        $this->set('logos2', $this->paginate($this->Logos->find()->where(['secondary' => '2'])));
    }

    public function products(){
        if (isset($_POST["Type"])) {
            $Value = 0;
            $Language="English";
            if (isset($_POST['Value'])) {
                if (strtolower($_POST['Value']) == "true") {
                    $Value = 1;
                }
            }
            if (isset($_POST["Language"])){ $Language=$_POST["Language"];}

            if (isset($_POST['DocID'])) { $DocID = $_POST['DocID'];}
            switch ($_POST["Type"]) {
                case "makecolumn":
                    $this->createcolumn($_POST["table"], $_POST["column"], $_POST["type"], $_POST["length"]);
                    break;
                case "enabledocument":
                    $this->enabledisableproduct($DocID, $Value);
                    echo $DocID . " set to " . $Value;
                    break;
                case "selectproduct":
                    $this->generateproductHTML($DocID, $Language);
                    break;
                case "selectdocument"://Product, DocID, Province, Value
                    echo $this->setproductprovince($_POST["Product"], $DocID, $_POST["Province"], $Value);
                    break;
                case "rename":
                    $this->RenameProduct($DocID, $_POST["newname"], $Language);
                    echo $DocID . " (" . $Language . ") was renamed to '" . $_POST["newname"] . "'";
                    break;
                case "deletedocument":
                    $this->DeleteProduct($DocID);
                    echo "<FONT COLOR=RED>" . $DocID . " was deleted</FONT>";
                    break;
                case "createdocument":
                    if ($this->AddProduct($DocID, $_POST["Name"], $_POST["NameFrench"])) {
                        echo "<FONT COLOR='green'>" . $_POST["Name"] . "/" . $_POST["NameFrench"] . " was created</FONT>";
                    } else {
                        echo "<FONT COLOR='red'>" . $DocID . " is already in use</FONT>";
                    }
                    break;
                case "cleardocument":
                    $this->clearproduct($DocID);
                    $this->generateproductHTML($DocID, $Language);
                    break;
                default:
                    echo $_POST["Type"] . " is unhandled";
            }
            $this->layout = 'ajax';
            $this->render(false);
        } else {
            $this->set('products', TableRegistry::get('order_products')->find()->all());
        }
    }

    function createcolumn($Table, $Column, $Type, $Length="", $Default ="", $AutoIncrement=false, $Null = false){
        //$Table = TableRegistry::get($Table);
        //$Table->addColumn($Column, array("type" => $Type, "length" => $Length, "null", "default" => $Default));
        $Type=strtoupper($Type);
        $query="ALTER TABLE " . $Table . " ADD " . $Column . " " . $Type;
        if($Type=="VARCHAR" || $Type == "CHAR"){$query.="(" . $Length . ")";}
        if(!$Null){$query.=" NOT NULL";}
        if($AutoIncrement){$query.=" AUTO_INCREMENT";}
        if($Default){
            $query.=" DEFAULT";
            if (is_numeric($Default)){
                $query.=$Default;
            }else{
                $query.= "'" . $Default . "'";
            }
        }

        $conn = ConnectionManager::get('default');
        $conn->query($query);

        echo $query;
        //$this->clear_cache();
    }

    public function clear_cache() {
        Cache::clear();
        clearCache();
        $files = array();
        $files = array_merge($files, glob(CACHE . '*')); // remove cached css
        $files = array_merge($files, glob(CACHE . 'css' . DS . '*')); // remove cached css
        $files = array_merge($files, glob(CACHE . 'js' . DS . '*'));  // remove cached js
        $files = array_merge($files, glob(CACHE . 'models' . DS . '*'));  // remove cached models
        $files = array_merge($files, glob(CACHE . 'persistent' . DS . '*'));  // remove cached persistent

        foreach ($files as $f) {
            if (is_file($f)) {unlink($f);}
        }

        if(function_exists('apc_clear_cache')) {
            apc_clear_cache();
            apc_clear_cache('user');
        }
    }

    function enabledisableproduct($ID, $Value){
        $table = TableRegistry::get('order_products');
        $table->query()->update()->set(['enable' => $Value])->where(['number' => $ID])->execute();
    }

    function getenabledprovinces($ProductID, $Province = "ALL"){
        $forms = array();
        $items = TableRegistry::get('order_provinces')->find("all")->where(['ProductID' => $ProductID, "Province" => $Province]);
        foreach($items as $item){
            $forms[] = $item->ProductID;
        }
        return implode(",", $forms);
    }

    function isproductprovinceenabled($ProductID, $DocumentID, $Province){
        $item = TableRegistry::get('order_provinces')->find()->where(['ProductID' => $ProductID, 'FormID' => $DocumentID, "Province" => $Province])->first();
        if ($item) {
            return true;
        } else {
            return false;
        }
    }

    function setproductprovince($ProductID, $DocumentID, $Province, $Value){
        $table = TableRegistry::get('order_provinces');//ProductID, Province, FormID
        if ($Value == 1) {
            $color = "green";
            $item = $table->find()->where(['ProductID' => $ProductID, 'FormID' => $DocumentID, "Province" => $Province])->first();
            $message = " was already enabled for ";
            if (!$item) {
                $table->query()->insert(['ProductID', "FormID", "Province"])->values(['ProductID' => $ProductID, 'FormID' => $DocumentID, "Province" => $Province])->execute();
                $message = " was enabled for ";
            }
        } else {
            $color = "red";
            $table->deleteAll(array('ProductID' => $ProductID, 'FormID' => $DocumentID, "Province" => $Province), false);
            $message = " was disabled for ";
        }
        return "<FONT COLOR='" . $color . "'>" . $DocumentID . $message . $ProductID . "." . $Province . "</FONT>";
    }

    function generateproductHTML($Product, $Language){
        //TableRegistry::get('order_provinces')->find()->where(['ProductID' => $Product])->all();
        $Fieldname = "title";
        if($Language!="English"){$Fieldname.=$Language;}
        $provincelist = $this->enumProvinces();
        $subdocuments = TableRegistry::get('subdocuments')->find('all');//subdocument type list (id, title, display, form, table_name, orders, color_id)
        echo '<TABLE CLASS="table table-condensed  table-striped table-bordered table-hover dataTable no-footer">';
        echo '<thead><TR><TH WIDTH="1%">ID</TH><TH>Document</TH>';
        foreach ($provincelist as $acronym => $fullname) {
            echo '<th width="1%" TITLE="' . $fullname . '">' . $acronym . '</th>';
        }
        echo '</TR></thead>';
        $this->generateRowHTML(0, "All documents", $Product, $provincelist);
        foreach ($subdocuments as $doc) {
            $this->generateRowHTML($doc->id, $this->getDefault($doc->title, $doc->$Fieldname), $Product, $provincelist);
        }
        echo '</TABLE>';
    }
    function getDefault($Default, $Value){
        if($Value){return $Value;}
        return "[" . $Default . "]";
    }

    function generateRowHTML($ID, $Title, $Product, $provincelist){
        echo '<TR><TD>' . $ID . '</TD><TD><DIV ID="dn' . $ID . '">' . $this->ucfirst2($Title) . '</DIV></TD>';
        foreach ($provincelist as $acronym => $fullname) {
            if ($this->isproductprovinceenabled($Product, $ID, $acronym)) {
                $checked = " CHECKED";
            } else {
                $checked = "";
            }//$ProductID, $DocumentID, $Province
           /// $checkID = 'chk' . $ID . "." . $acronym;//ONCLICK="simulateClick(' . "'" . $checkID . "'" . ');"
            echo '<TD TITLE="' . $fullname . '"><INPUT TYPE="CHECKBOX" ONCLICK="setprov(' . $ID . ", '" . $acronym . "'" . ');" ID="' . $ID . "." . $acronym . '"' . $checked . ' STYLE="width:100%;height:100%;"></TD>';
        }
        echo "</TR>";
    }

    function enumProvinces(){
        return array("ALL" => "All Provinces", "AB" => "Alberta", "BC" => "British Columbia", "MB" => "Manitoba", "NB" => "New Brunswick", "NL" => "Newfoundland and Labrador", "NT" => "Northwest Territories", "NS" => "Nova Scotia", "NU" => "Nunavut", "ON" => "Ontario", "PE" => "Prince Edward Island", "QC" => "Quebec", "SK" => "Saskatchewan", "YT" => "Yukon Territories");
    }

    function ucfirst2($Text){
        $Words = explode(" ", $Text);
        $Words2 = array();//php forces me to make a copy
        foreach ($Words as $Word) {
            $Words2[] = ucfirst($Word);
        }
        return implode(" ", $Words2);
    }

    function ClearProduct($Number){
        TableRegistry::get("order_provinces")->deleteAll(array('ProductID' => $Number), false);
    }

    function RenameProduct($Number, $NewName, $Language){
        $Fieldname = "title";
        if ($Language!="English"){$Fieldname.=$Language;}
        TableRegistry::get("order_products")->query()->update()->set([$Fieldname => $NewName])->where(['number' => $Number])->execute();
    }

    function DeleteProduct($Number){
        $this->ClearProduct($Number);
        TableRegistry::get("order_products")->deleteAll(array('number' => $Number), false);
        //TableRegistry::get("order_provinces")->deleteAll(array('ProductID' => $Number), false);
    }

    function AddProduct($Number, $Name, $FrenchName){
        $table = TableRegistry::get("order_products");
        $item = $table->find()->where(['number' => $Number])->first();
        if ($item) {
            return false;
        }
        $table->query()->insert(['number', "title", "titleFrench", "enable"])->values(['number' => $Number, 'title' => $Name, "titleFrench"=> $FrenchName, "enable" => 0])->execute();
        return true;
    }

    public function index(){
        $u = $this->request->session()->read('Profile.id');
        $condition = TableRegistry::get("profiles")->find()->where(['id' => $u])->first()->ptypes;
        $this->set('cancreate', explode(",", $condition) ) ;

        $this->loadModel('ProfileTypes');
        $this->set('ptypes', $this->ProfileTypes->find()->where(['enable' => '1']));
        $this->set('doc_comp', $this->Document);

        $setting = $this->Settings->get_permission($u);
        $this->set('ProClients', $this->Settings);
        $super = $this->request->session()->read('Profile.super');
        $condition = $this->Settings->getprofilebyclient($u, $super);
        //var_dump($condition);die();
        if ($setting->profile_list == 0) {
            $this->Flash->error($this->Trans->getString("flash_permissions"));
            return $this->redirect("/");
        }
        if (isset($_GET['draft'])) {
            $draft = 1;
        } else {
            $draft = 0;
        }
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
            if ($cond){ $cond.= ' AND'; }
            $cond .= ' (LOWER(title) LIKE "%' . $searchs . '%" OR LOWER(fname) LIKE "%' . $searchs . '%" OR LOWER(lname) LIKE "%' . $searchs . '%" OR LOWER(username) LIKE "%' . $searchs . '%" OR LOWER(address) LIKE "%' . $searchs . '%")';
        }

        if (isset($_GET['filter_profile_type']) && $_GET['filter_profile_type']) {
            if ($cond){ $cond.= ' AND'; }
            if($_GET['filter_profile_type'] == "NULL") {
                $cond .= ' profile_type IS NULL';
            }else {
                $cond .= ' (profile_type = "' . $profile_type . '" OR admin = "' . $profile_type . '")';
            }
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
            if ($cond){ $cond.= ' AND'; }
            $cond .= ' (id IN (' . $profile_ids . '))';
        }
        if ($this->request->session()->read('Profile.profile_type') == '2') {
            if ($cond) {
                //$cond = $cond . ' AND (created_by = ' . $this->request->session()->read('Profile.id') . ')';
            } else {
                $condition['created_by'] = $this->request->session()->read('Profile.id');
            }

        }
        /*=================================================================================================== */
        if($setting->viewprofiles == 0){
            $query = $this->Profiles->find()->where(['id' => $u]);
        } elseif ($cond) {
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
        if (isset($_GET["all"])) {
            $this->set('profiles', $this->appendattachments($query));
        } else {
            $this->set('profiles', $this->appendattachments($this->paginate($query)));
        }
    }

    /*

    function search()
    {
        $setting = $this->Settings->get_permission($this->request->session()->read('Profile.id'));

        if($setting->profile_list==0)
        {
            $this->Flash->error($this->Trans->getString("flash_permissions"));
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

    public function view($id = null){
        if (isset($_GET['success'])) {
            $this->Flash->success('Order saved successfully');
        }
        if($id>0) {
            $this->getsidebar("Sidebar");//$sidebar->viewprofiles
            $userid=$this->request->session()->read('Profile.id');
            $this->set('products', TableRegistry::get('product_types')->find('all'));
            $this->getsubdocument_topblocks($id, false);
            $this->loadModel("ProfileTypes");
            $this->set("ptypes", $this->ProfileTypes->find()->where(['enable' => '1'])->all());
            $this->set('uid', $id);
            $this->set('doc_comp', $this->Document);
            $setting = $this->Settings->get_permission($userid);

            if ($setting->profile_list == 0 || ($userid != $id && $setting->viewprofiles ==0)) {
                $this->Flash->error($this->Trans->getString("flash_permissions"));
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
            $order = $orders->find()
                ->where(['orders.uploaded_for' => $id, 'orders.draft' => 0])->order('orders.id DESC')->contain(['Profiles', 'Clients', 'RoadTest']);

            /*
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
            */
            $profile->Ptype = $this->getprofiletypeData($profile->profile_type);
            $this->set('orders', $order);
            $this->set('profile', $profile);
            $this->set('disabled', 1);
            $this->set('id', $id);
        }
        $this->render("edit");
    }

    function getprofiletypeData($ID){
        return TableRegistry::get('profile_types') ->find()->where(['id' => $ID])->first();
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
     * $this->Flash->error($this->Trans->getString("flash_permissions"));
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

    public function getsidebar($Set = "", $UserID =""){
        if(!$UserID) {$UserID = $this->request->session()->read('Profile.id');}
        $UserID = TableRegistry::get('Sidebar')->find()->where(['user_id' => $UserID])->first();
        if($Set){$this->set($Set, $UserID);}
        return $UserID;
    }

    /**
     * Add method
     *
     * @return void
     */
    public function add()
    {
        $this->getsidebar("Sidebar");

        $this->set('uid', '0');
        $this->set('id', '0');
        $this->loadModel("ProfileTypes");
        $this->set("ptypes", $this->ProfileTypes->find()->where(['enable' => '1'])->all());
        $setting = $this->Settings->get_permission($this->request->session()->read('Profile.id'));

        // Only super admin and recruiter are allowed to create profiles as discussed on feb 19
        /*if (!$this->request->session()->read('Profile.super')) {
            if ($this->request->session()->read('Profile.profile_type') != '2') {
                $this->Flash->error($this->Trans->getString("flash_permissions"));
                return $this->redirect("/profiles");
            }
        }*/

        if ($setting->profile_create == 0 && !$this->request->session()->read('Profile.super')) {
            $this->Flash->error($this->Trans->getString("flash_permissions"));
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

            if (isset($_POST['profile_type']) && $_POST['profile_type'] == 1) {
                $_POST['admin'] = 1;
            }

            $_POST['dob'] = $_POST['doby'] . "-" . $_POST['dobm'] . "-" . $_POST['dobd'];
            //debug($_POST);die();
            $profile = $profiles->newEntity($_POST);
            if ($profiles->save($profile)) {
                $this->checkusername($profile->id, $_POST);
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

    function checkusername($profile, $post){

        $username = trim($post["username"]);
        if(!$username) {
            $username = str_replace(" ", "_", TableRegistry::get('profile_types')->find()->where(['id' => $profile->profile_type])->first()->title . "_" . $profile->id);
            $queries = TableRegistry::get('Profiles');
            $queries->query()->update()->set(['username' => $username])
                ->where(['id' => $profile->id])
                ->execute();
        }
    }

    public function getprofileByAnyKey($Key, $Value){
        $table = TableRegistry::get("profiles");
        $results = $table->find('all', array('conditions' => array($Key => $Value)))->first();
        return $results;
    }
    public function Update1Column($Table, $PrimaryKey, $PrimaryValue, $Key, $Value){
        TableRegistry::get($Table)->query()->update()->set([$Key => $Value])->where([$PrimaryKey=>$PrimaryValue])->execute();
    }

    function csv() {
        $profile = TableRegistry::get('profiles');
        $arr = explode('.', $_FILES['csv']['name']);
        $ext = end($arr);

        $allowed = array( 'csv');
        $check = strtolower($ext);
        if (in_array($check, $allowed)) {
            if ($_FILES['csv']['size'] > 0) {
                $handle = fopen($_FILES['csv']['tmp_name'], "r");
                $i=0;
                $flash ="";
                $line = 0;
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    if($i!=0){
                        $line++;
                        $em =0;
                        $un =0;
                        if($data[19]!="") {$em = $this->check_email('', $data[19]);}
                        if($data[2]!="") {$un = $this->check_user('', $data[2]);}
                        if($un == 1 && $data[19]) {//ignore if username is blank, fix that later
                            $flash .= "Failed: Username '" . $data[2] . "' already exists(Line no ".$line."), ";
                        }elseif($em == 1) {
                            $flash .= "Failed: Email '" . $data[19] . "' already exists(Line no ".$line."), ";
                        } else {
                            
                            foreach($data as $KEY => $VALUE){//clean all values
                                $data[$KEY] =  trim(ucfirst(addslashes($VALUE)));
                            }
                            
                            $pro = (['profile_type' =>  $data[0],
                                'driver'            =>  $data[1],
                                'username'          =>  $data[2],
                                'title'             =>  $data[3] . ".",
                                'fname'             =>  $data[4],
                                'mname'             =>  $data[5],
                                'lname'             =>  $data[6],
                                'phone'             =>  $data[7],
                                'gender'            =>  $data[8],
                                'placeofbirth'      =>  $data[9],
                                'dob'               =>  date('Y-m-d',strtotime($data[10])),
                                'street'            =>  $data[11],
                                'city'              =>  $data[12],
                                'province'          =>  strtoupper($data[13]),
                                'postal'            =>  $data[14],
                                'country'           =>  "Canada",
                                'driver_license_no' =>  $data[16],
                                'driver_province'   =>  $data[17],
                                'expiry_date'       =>  date("Y-m-d",strtotime($data[18])),
                                'email'             =>  $data[19]]);

                            $pros = $profile->newEntity($pro);
                            if($profile->save($pros)) {
                                $username = $data[2];
                                if(!$username){//if username is blank, substitute for "Driver_" . $userid;
                                    $userid=$this->getprofileByAnyKey("email", $data[19])->id;
                                    $username = "Driver_" . $userid;
                                    $this->Update1Column("profiles", "id", $userid, "username", $username);
                                }
                                
                               $flash .= "Success (Line no ".$line."), ";

                                /*$query2 = $profile->query();
                                $user = $query2->insert(['profile_type','driver','username','title','fname','mname','lname','phone','gender','placeofbirth','dob','street',
                                                    'city','province','postal','country','driver_license_no','driver_province','expiry_date','email'])
                                    ->values(['profile_type'=>addslashes($data[0]),'driver'=>addslashes($data[1]),
                                    'username'=>addslashes($data[2]),'title'=>addslashes($data[3]),'fname'=>addslashes($data[4]),'mname'=>addslashes($data[5]),
                                    'lname'=>addslashes($data[6]),'phone'=>addslashes($data[7]),'gender'=>addslashes($data[8]),'placeofbirth'=>date("Y-m-d",strtotime(addslashes($data[9]))),
                                    'dob'=>date('Y-m-d',strtotime(addslashes($data[10]))),'street'=>addslashes($data[11]),'city'=>addslashes($data[12]),'province'=>addslashes($data[13]),
                                    'postal'=>addslashes($data[14]),'country'=>addslashes($data[15]),'driver_license_no'=>addslashes($data[16]),'driver_province'=>addslashes($data[17]),
                                    'expiry_date'=>date("Y-m-d",strtotime(addslashes($data[18]))),'email'=>addslashes($data[19])])
                                    ->execute();
                                    if($user)
                                */
                                $uid = $pros->id;
                                $jid = $data[20];

                                $client =  TableRegistry::get('clients');
                                $query = $client->find()->where(['id'=>$jid])->first();
                                if($query){
                                    $profile_id = $query->profile_id;
                                    $new_ids = $profile_id.",".$uid;
                                    $client->query()->update()->set(['profile_id'=>$new_ids])
                                        ->where(['id' => $query->id])
                                        ->execute();

                                }
                                $blocks = TableRegistry::get('Blocks');
                                $query3 = $blocks->query();
                                $query3->insert(['user_id'])
                                    ->values(['user_id' => $uid])
                                    ->execute();
                                $side = TableRegistry::get('Sidebar');
                                $query4 = $side->query();
                                $create_que = $query4->insert(['user_id'])
                                    ->values(['user_id' => $uid])
                                    ->execute();
                                unset($query2);
                            }
                        }
                    }
                    $i++;

                }
                fclose($handle);
                /*$file = $_FILES['csv']['tmp_name'];
                $handle = fopen($file,"r");
                do {
                    if ($data[0]) {
                        $query2 = $profile->query();
                        $query2->insert(['profile_type','driver','username','title','fname','mname','lname','phone','gender','placeofbirth','dob','address','city','province','postal','country','driver_license_no','driver_province','expiry_date'])
                            ->values([addslashes($data[0]),addslashes($data[1]),addslashes($data[2]),addslashes($data[3]),addslashes($data[4]),addslashes($data[5]),addslashes($data[6]),addslashes($data[7]),addslashes($data[8]),addslashes($data[9]),addslashes($data[10]),addslashes($data[11]),addslashes($data[12]),addslashes($data[13]),addslashes($data[14]),addslashes($data[15]),addslashes($data[16]),addslashes($data[17]),addslashes($data[18])])
                            ->execute();
                        unset($query2);


                    }
                } while ($data = fgetcsv($handle,1000,",","'"));*/
            }


            $this->Flash->success('Profiles Successfully Imported. '.$flash);
            $this->redirect('/profiles');
        } else {
            $this->Flash->error('Invaild CSV file.');
            $this->redirect('/profiles/settings');
        }
    }


    function sendEmail($To, $Subject, $Message)
    {
        $settings = TableRegistry::get('settings');
        $setting = $settings->find()->first();
        $path = $this->Document->getUrl();
        $replace = array("%PATH%" => $path, "%CRLF%" => "\r\n");//auto-replace these terms
        foreach ($replace as $key => $value) {
            $Subject = str_replace($key, $value, $Subject);
            $Message = str_replace($key, $value, $Message);
        }

        //method 1
        //$email = new Email('default');
        //$res = $email->from(['info@'. $path => "ISB MEE"])->to($To)->subject($Subject)->send($Message);

        //method 2, needs a transport set up
        //Email::deliver($To,$Subject, $Message, ['info@'. $path => "ISB MEE"]);

        //method 3 actually uses method 1
        $from = array('info@' . $path => $setting->mee);
        $this->Mailer->sendEmail($from, $To, $Subject, $Message);
        file_put_contents("royslog.txt", "To: " . $To . " Subject: " . $Subject . " Mesage: " . $Message, FILE_APPEND);
    }

    function updatelanguage($post){
        $language = "English";
        if(isset($post["language"])){
            $language=ucfirst($post["language"]);
            $this->request->session()->write("Profile.language", $language);
        }
        return $language;
    }

    function saveprofile($add = "")
    {
        $settings = $this->Settings->get_settings();
        $profiles = TableRegistry::get('Profiles');
        $path = $this->Document->getUrl();

        $this->updatelanguage($_POST);

        if ($add == '0') {
            $profile_type = $this->request->session()->read('Profile.profile_type');
            $_POST['created'] = date('Y-m-d');

            if (isset($_POST['password']) && $_POST['password'] == '') {
                $password = '';
                unset($_POST['password']);
            } else {
                if (isset($_POST['password']) && $_POST['password'] != '') {
                    $password = $_POST['password'];
                    $_POST['password'] = md5($_POST['password']);
                }
            }

            if ($this->request->is('post')) {
                if (isset($_POST['profile_type']) && $_POST['profile_type'] == 1) {
                    $_POST['admin'] = 1;
                }
                $_POST['dob'] = $_POST['doby'] . "-" . $_POST['dobm'] . "-" . $_POST['dobd'];

                $profile = $profiles->newEntity($_POST);
                if ($profiles->save($profile)) {
                    $this->checkusername($profile,$_POST);
                    $this->loadModel('ProfileDocs');
                    $this->ProfileDocs->deleteAll(['profile_id' => $profile->id]);
                    if (isset($_POST['profile_doc'])) {
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
                    }
                    if (isset($_POST['profile_type']) && $_POST['profile_type'] == 5) {
                        $username = 'driver_' . $profile->id;
                        $queries = TableRegistry::get('Profiles');
                        $queries->query()->update()->set(['username' => $username])
                            ->where(['id' => $profile->id])
                            ->execute();
                    } else {
                        if(isset($_POST['profile_type']))
                        {

                            if ($_POST['profile_type'] == '7'){
                                $username = 'owner_operator_' . $profile->id;
                                $queries = TableRegistry::get('Profiles');
                                $queries->query()->update()->set(['username' => $username])
                                    ->where(['id' => $profile->id])
                                    ->execute();
                            }
                            else
                                if ($_POST['profile_type'] == '8'){
                                    $username = 'owner_driver_' . $profile->id;
                                    $queries = TableRegistry::get('Profiles');
                                    $queries->query()->update()->set(['username' => $username])
                                        ->where(['id' => $profile->id])
                                        ->execute();
                                }
                                else
                                    if ($_POST['profile_type'] == '11'){
                                        $username = 'employee_' . $profile->id;
                                        $queries = TableRegistry::get('Profiles');
                                        $queries->query()->update()->set(['username' => $username])
                                            ->where(['id' => $profile->id])
                                            ->execute();
                                    }
                        }
                    }
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
                        $this->Flash->success('Profile Saved as draft Successfully. ');
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
                            if ($type_q)
                                $ut = $type_q->title;
                            else
                                $ut = '';
                        } else
                            $ut = '';
                        if ($_POST['profile_type']) {
                            $pt = $_POST['profile_type'];
                            $u = $pt;
                            $type_query = TableRegistry::get('profile_types');
                            $type_q = $type_query->find()->where(['id' => $u])->first();
                            if ($type_q)
                                $protype = $type_q->title;
                            else
                                $protype = '';
                        } else
                            $protype = '';
                        $from = 'info@' . $path;// 'array('info@' . $path => "ISB MEE");
                        $to = $em;

                        $sub = 'Profile Created: ' . $_POST['username'];
                        $msg = 'Domain: ' . $path .
                            '<br/>Created By: ' . $uq->username .
                            '<br/>On: ' . date('Y-m-d') .
                            '<br>Profile Type: ' . $protype .
                            '<br/>Username: ' . $_POST['username'];
                        $this->Mailer->sendEmail($from, $to, $sub, $msg);
                        //$this->sendEmail($to, $sub, $msg);
                        if (isset($_POST["emailcreds"]) && $_POST["emailcreds"] == "on" && strlen(trim($_POST["email"])) > 0) {

                            if ($password) {
                                $msg .= "<br/>Password: " . $password;
                                $msg .= "<br />Click <a href='" . LOGIN . "'>here</a> to login<br /><br /> Regards,<br /> The " . $settings->mee . " Team";
                            }

                            $this->Mailer->sendEmail($from, $_POST["email"], $sub, $msg);

                            // $this->sendEmail($_POST["email"], $sub, $msg);
                            //file_put_contents("royslog.txt",$to . " " .  $_POST["email"] . ": " .  $sub . " - " . $msg, FILE_APPEND);
                        }
                        $this->Flash->success('Profile Saved Successfully. ');

                    }
                    echo $profile->id;

                } else
                    echo "0";
            }
        } else {
            $profile = $this->Profiles->get($add, ['contain' => []]);
            if ($this->request->is(['patch', 'post', 'put'])) {
                if (isset($_POST['password']) && $_POST['password'] == '') {
                    $this->request->data['password'] = $profile->password;
                } else {
                    if (isset($_POST['password'])) {
                        $this->request->data['password'] = md5($_POST['password']);
                    }
                }
                if (isset($_POST['profile_type']) && $_POST['profile_type'] == 1) {
                    $this->request->data['admin'] = 1;
                } else {
                    $this->request->data['admin'] = 0;
                }
                $this->request->data['dob'] = $_POST['doby'] . "-" . $_POST['dobm'] . "-" . $_POST['dobd'];
                if (isset($this->request->data['username']) && $this->request->data['username'] == 5) {
                    unset($this->request->data['username']);
                }
                //var_dump($this->request->data); die();//echo $_POST['admin'];die();
                $profile = $this->Profiles->patchEntity($profile, $this->request->data);
                if ($this->Profiles->save($profile)) {
                    $this->loadModel('ProfileDocs');
                    $this->ProfileDocs->deleteAll(['profile_id' => $profile->id]);
                    if (isset($_POST['profile_doc'])) {
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
                    }
                    echo $profile->id;
                    if (isset($_POST['profile_type']) && $_POST['profile_type'] == 5) {
                        $username = 'driver_' . $profile->id;
                        $queries = TableRegistry::get('Profiles');
                        $queries->query()->update()->set(['username' => $username])
                            ->where(['id' => $profile->id])
                            ->execute();
                    } else {
                        if(isset($_POST['profile_type']))
                        {

                            if ($_POST['profile_type'] == '7'){
                                $username = 'owner_operator_' . $profile->id;
                                $queries = TableRegistry::get('Profiles');
                                $queries->query()->update()->set(['username' => $username])
                                    ->where(['id' => $profile->id])
                                    ->execute();
                            }
                            else
                                if ($_POST['profile_type'] == '8'){
                                    $username = 'owner_driver_' . $profile->id;
                                    $queries = TableRegistry::get('Profiles');
                                    $queries->query()->update()->set(['username' => $username])
                                        ->where(['id' => $profile->id])
                                        ->execute();
                                }
                                else
                                    if ($_POST['profile_type'] == '11'){
                                        $username = 'employee_' . $profile->id;
                                        $queries = TableRegistry::get('Profiles');
                                        $queries->query()->update()->set(['username' => $username])
                                            ->where(['id' => $profile->id])
                                            ->execute();
                                    }
                        }
                    }
                    if (isset($_POST['drafts']) && ($_POST['drafts'] == '1')) {
                        $this->Flash->success('Profile Saved as draft. ');
                    } else {
                        $this->Flash->success('Profile Saved Successfully. ');
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
                    $this->checkusername( $profile->id, $post);

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
                /*$username = 'driver_' . $id;
                $queries = TableRegistry::get('Profiles');
                $queries->query()->update()->set(['username' => $username])
                    ->where(['id' => $id])
                    ->execute();*/
                die();

            }
        }
        die();
    }

    public function langswitch($id = null) {
        $id = $this->request->session()->read('Profile.id');
        $language = $this->request->session()->read('Profile.language');
        $acceptablelanguages = array("English", "French");
        if (!in_array($language, $acceptablelanguages)) {
            $language = $acceptablelanguages[0];
        }//default to english
        $index = array_search($language, $acceptablelanguages) + 1;
        if ($index >= count($acceptablelanguages)) {
            $index = 0;
        }
        $language = $acceptablelanguages[$index];
        $this->request->session()->write('Profile.language', $language);
        TableRegistry::get('profiles')->query()->update()->set(['language' => $language])->where(['id' => $id])->execute();
    }

    /**
     * Edit method
     *
     * @param string $id
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException
     */
    public function edit($id = null) {
        $this->set('doc_comp', $this->Document);
        $check_pro_id = $this->Settings->check_pro_id($id);
        if ($check_pro_id == 1) {
            $this->Flash->error('The record does not exist. ');
            return $this->redirect("/profiles/index");
            //die();
        }

        $clientcount = $this->Settings->getClientCountByProfile($id);
        $this->set('Clientcount', $clientcount);
        if (isset($_GET['clientflash']) || $clientcount == 0) {
            $this->Flash->success('Profile created successfully! Please assign profile to at least one client.');
        }

        $userid=$this->request->session()->read('Profile.id');
        $pr = TableRegistry::get('profiles');
        $query = $pr->find();
        $aa = $query->select()->where(['id' => $id])->first();
        $checker = $this->Settings->check_edit_permission($userid, $id, $aa->created_by);
        if ($checker == 0) {
            //  $this->Flash->error('Sorry, you don\'t have the required permissions6.');
            //  return $this->redirect("/profiles/index");
        }

        $setting = $this->Settings->get_permission($userid);
        if (($setting->profile_edit == 0 || $setting->viewprofiles ==0) && $id != $userid) {
            $this->Flash->error($this->Trans->getString("flash_permissions"));
            return $this->redirect("/");
        } else {
            $this->set('myuser', '1');
        }

        $this->getsubdocument_topblocks($id, false);//subdocument_topblocks
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
            if (isset($_POST['profile_type']) && $_POST['profile_type'] == 1) {
                $this->request->data['admin'] = 1;
            } else {
                $this->request->data['admin'] = 0;
            }
            $this->request->data['dob'] = $_POST['doby'] . "-" . $_POST['dobm'] . "-" . $_POST['dobd'];
            $this->request->data['language'] = $this->updatelanguage($_POST);

            //var_dump($this->request->data); die();//echo $_POST['admin'];die();
            $profile = $this->Profiles->patchEntity($profile, $this->request->data);
            if ($this->Profiles->save($profile)) {
                $this->Flash->success('User saved successfully.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The user could not be saved. Please try again.');
            }
        }
        $profile->Ptype = $this->getprofiletypeData($profile->profile_type);

        $this->set('doc_comp', $this->Document);
        $orders = TableRegistry::get('orders');
        $order = $orders->find()->where(['orders.uploaded_for' => $id])->contain(['Profiles', 'Clients', 'RoadTest']);

        $this->set('orders', $order);
        $this->set(compact('profile'));
        $this->set('id', $id);
        $this->set('uid', $id);

        $this->set('products', TableRegistry::get('product_types')->find()->where(['id <>' => 7]));
    }

    function changePass($id) {
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
    public function delete($id = null) {
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
        if (isset($_GET['draft'])) {
            $draft = "?draft";
        } else {
            $draft = "";
        }
        $profile = $this->Profiles->get($id);
        // $this->request->allowMethod(['post', 'delete']);
        if ($this->Profiles->delete($profile)) {
            $this->Flash->success('The user has been deleted.');
        } else {
            $this->Flash->error('User could not be deleted. Please try again.');
        }
        return $this->redirect(['action' => 'index' . $draft]);
    }

    function logout() {
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

    function todo() {

    }

    function todos() {
        $this->layout = 'blank';
    }

    function blocks($client = "") {

        $user_id = $_POST['form'];
        if ($user_id != 0) {
            //$block['user_id'] = $_POST['block']['user_id'];
            $side['user_id'] = $_POST['side']['user_id'];
        }

        foreach ($_POST['side'] as $k => $v) {
            //echo $k."=>".$v."<br/>";
            $side[$k] = $v;
        }
        //var_dump($side);die();
        //die();
        if ($client == "") {
            $sides = $this->getColumnNames("sidebar", "id");//why does this use sidebar columns instead of block?
            //array('profile_list', 'profile_create', 'client_list', 'client_create', 'document_list', 'document_create', 'profile_edit', 'profile_delete', 'client_edit', 'client_delete', 'document_edit', 'document_delete', 'document_others', 'document_requalify', 'orders_list', 'orders_create', 'orders_delete', 'orders_requalify', 'orders_edit', 'orders_others', 'order_requalify', 'orders_mee', 'orders_products', 'order_intact', 'email_document', 'email_orders', 'email_profile', 'orders_emp', 'orders_GEM', 'orders_GDR', 'aggregate', 'bulk', 'invoice');//this should not be hardcoded
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

    function homeblocks() {
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

        //$this->getsubdocument_topblocks($user_id, true); //not used anymore
        die();
    }

    function getsubdocument_topblocks($UserID, $getpost = false) {
        $table = TableRegistry::get('order_products_topblocks');
        if ($getpost) {//save
            $table->deleteAll(array('UserID' => $UserID), false);
            foreach ($_POST['topblocks'] as $Key => $Value) {
                if ($Value == 1) {
                    $table->query()->insert(['UserID', 'ProductID'])->values(['UserID' => $UserID, 'ProductID' => $Key])->execute();
                }
            }
        } else {//load
            $query = $table->find()->select()->where(['UserID' => $UserID])->order(['ProductID' => 'asc']);
            $products = TableRegistry::get('order_products')->find('all');
            foreach ($products as $product) {
                $product->TopBlock = 0;
                if (is_object($this->FindIterator($query, "ProductID", $product->number))) {
                    $product->TopBlock = 1;
                }
            }
            $this->set("theproductlist", $products);
        }
    }

    function FindIterator($ObjectArray, $FieldName, $FieldValue) {
        foreach ($ObjectArray as $Object) {
            if ($Object->$FieldName == $FieldValue) {
                return $Object;
            }
        }
        return false;
    }

    function getProAllSubDoc($pro_id){
        $sub = TableRegistry::get('Profilessubdocument')->find()->select()->where(['profile_id'=>$pro_id]);
        return $sub;
    }

    function getSub($UserID = false, $sortByTitle=false){
        $sub = TableRegistry::get('Subdocuments');
        $query = $sub->find();
        $q = $query->select();
        if ($UserID){
            $table = TableRegistry::get('Profilessubdocument');
            if($sortByTitle){$subdoc2=array();}
            foreach($q as $subdoc){
                $subdoc->forms = $subdoc->ProductID;// $this->getenabledprovinces($subdoc->ProductID);
                //if ($subdoc->ProductID>0) {//}                THIS DOESN'T LOOK RIGHT!!!
                $subdoc->subdoc = $table->find()->select()->where(['profile_id'=>$UserID, 'subdoc_id'=>$subdoc->id])->first();
                if($sortByTitle){$subdoc2[]=$subdoc;}
            }
            $q->Subdocs = $this->getProAllSubDoc($UserID);
        }
        if($sortByTitle){
            usort($subdoc2, array($this,'sortByOrder'));
            $this->response->body($subdoc2);
        }else {
            $this->response->body($q);
        }
        return $this->response;
    }

    function sortByOrder($a, $b) {
        return strcmp($a['title'], $b['title']);
    }

    function getProSubDoc($pro_id, $doc_id){
        $sub = TableRegistry::get('Profilessubdocument');
        $query = $sub->find();
        $query->select()->where(['profile_id' => $pro_id, 'subdoc_id' => $doc_id]);
        $q = $query->first();
        $this->response->body($q);
        return $this->response;
    }

    function displaySubdocs($id) {
        //var_dump($_POST);die();
        $user['profile_id'] = $id;
        $display = $_POST; //defining new variable for system base below upcoming foreach

        //for user base
        $this->loadModel('Profilessubdocument');
        $this->Profilessubdocument->deleteAll(['profile_id' => $id]);
        foreach ($_POST['profile'] as $k2 => $v) {
            $subp = TableRegistry::get('Profilessubdocument');
            $query2 = $subp->query();
            $TopBlock = 0;
            if (isset($_POST['topblock'][$k2])) {
                $TopBlock = $_POST['topblock'][$k2];
            }
            $query2->insert(['profile_id', 'subdoc_id', 'display', 'Topblock'])
                ->values(['profile_id' => $id, 'subdoc_id' => $k2, 'display' => $_POST['profile'][$k2], 'Topblock' => $TopBlock])
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

    function getRecruiter() {
        $rec = TableRegistry::get('Profiles');
        $query = $rec->find()->where(['profile_type' => 2]);
        //$q = $query->select();
        $this->response->body($query);
        return $this->response;
        die();
    }

    function getProfile($ClientID = 0) {
        $rec = TableRegistry::get('Profiles');
        $query = $rec->find();
        $u = $this->request->session()->read('Profile.id');
        $super = $this->request->session()->read('Profile.super');

        $conditions = array('super <>' => 1, 'drafts' => 0);

        if($ClientID>0) {//SET @profiles = (
            $conditions2 = '(SELECT profile_id FROM clients WHERE id = ' . $ClientID . ")";
            $conditions[] = 'find_in_set(id, ' . $conditions2 . ')';
        } else if (!$super) {
            $conditions['created_by'] = $u;
        }
        $query = $rec->find()->where($conditions)->order('fname');

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


    function getProfileTypes($Language = "English") {
        $rec = TableRegistry::get('profile_types')->find();
        $query = array();
        $column="title";
        if($Language != "English"){$column.=$Language;}
        foreach($rec as $Ptype){//id title enable ISB titleFrench placesorders
            $name= $Ptype->$column;
            if(!$name){$name=$Ptype->title . " (MISSING: " . $Language . ")";}
            $query[$Ptype->id] = $name;
            $query[$Ptype->id . ".canorder"] = $Ptype->placesorders;
        }
        $this->response->body($query);
        return $this->response;
        die();
    }

    function getAjaxProfile($id = 0, $mode = 0) {
        $this->layout = 'blank';
        if($mode==0) {
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
        }

        $key = $_GET['key'];
        $rec = TableRegistry::get('Profiles');
        $query = $rec->find();
        $u = $this->request->session()->read('Profile.id');
        $super = $this->request->session()->read('Profile.admin');
        $cond = $this->Settings->getprofilebyclient($u, $super);

        $conditions=array('super <>' => 1, 'drafts' => 0, '(fname LIKE "%' . $key . '%" OR lname LIKE "%' . $key . '%" OR username LIKE "%' . $key . '%")');
        if($mode==1 && $id>0) {//search by client
            $conditions[] = 'find_in_set(id, (SELECT profile_id FROM clients WHERE id = ' . $id . '))';
        } else if (!$super) {
            $conditions['created_by'] = $u;
        }

        $query = $rec->find()->where($conditions)->order('fname');

        //$query = $query->select()->where(['super'=>0]);

        /*$query = $query->select()->where(['profile_type NOT IN'=>'(5,6)','OR'=>$cond])
            ->andWhere(['super'=>0,'(fname LIKE "%'.$key.'%" OR lname LIKE "%'.$key.'%" OR username LIKE "%'.$key.'%")']);
         if(!$super)
          $query = $query->orWhere(['created_by'=>$u]);*/
        $query->mode = $mode;
        if($mode==1) {
            foreach($_GET as $Key => $Value) {
                $query->$Key = $Value;
            }
        }
        $this->set('profiles', $query);
        $this->set('cid', $id);
    }

    function getProfileNames($IDs = ""){
        $names='';
        if($IDs) {
            $query = TableRegistry::get('profiles')->find()->where(array("find_in_set(id, '" . $IDs . "')"))->order('fname');
            foreach ($query as $profile) {
                $name = $profile->fname . " " . $profile->lname . " (" . $profile->username . ")";
                if ($names) {
                    $names .= ", " . $name;
                } else {
                    $names = $name;
                }
            }
        }
        $this->response->body($names);
        return $this->response;
        die();
    }

    function getAjaxContact($id = 0) {
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

    function getContact() {
        $con = TableRegistry::get('Profiles');
        $query = $con->find()->where(['profile_type' => 6]);
        $this->response->body($query);
        return $this->response;
        die();
    }

    function filterBy() {
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

    function getuser() {
        if ($id = $this->request->session()->read('Profile.id')) {
            $profile = TableRegistry::get('profiles');
            $query = $profile->find()->where(['id' => $id]);

            $l = $query->first();
            $this->response->body($l);
            return $this->response;
            //return $l;

        } else {
            return $this->response->body(null);
        }
        die();
    }

    function getallusers($profile_type = "", $client_id = "") {
        $u = $this->request->session()->read('Profile.id');
        $super = $this->request->session()->read('Profile.super');
        $cond = $this->Settings->getprofilebyclient($u, $super, $client_id);
        $profile = TableRegistry::get('profiles');
        if ($profile_type != "") {
            $query = $profile->find()->where(['super' => 0, 'profile_type' => $profile_type, 'OR' => $cond]);
        }else {
            $query = $profile->find()->where(['super' => 0, 'OR' => $cond]);
        }
        //debug($query);
        $l = $query->all();
        $this->response->body($l);
        return $this->response;

    }

    function getusers() {
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

    function getOrder($id) {
        $con = TableRegistry::get('Documents');
        $query = $con->find()->where(['uploaded_for' => $id, 'document_type' => 'order']);
        $this->response->body($query);
        return $this->response;
        die();
    }

    function getClient() {
        $query = TableRegistry::get('Clients');
        $q = $query->find();
        $que = $q->select();
        $this->response->body($que);
        return $this->response;
        die();
    }

    function getProfileType($id = null) {
        $q = TableRegistry::get('Profiles');
        $que = $q->find();
        $que->select(['profile_type'])->where(['id' => $id]);
        $query = $que->first();
        $this->response->body($query);
        return $this->response;
        die();
    }

    function getProfileById($id, $sub) {
        if($id) {
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
        }else{die();}
    }

    public function getNotes($driver_id) {
        $q = TableRegistry::get('recruiter_notes');
        $que = $q->find();
        $query = $que->select()->where(['driver_id' => $driver_id])->order(['id' => 'desc']);
        //$query = $que->first();
        $this->response->body($query);
        return $this->response;
        die();
    }

    public function getRecruiterById($id) {
        $q = TableRegistry::get('Profiles');
        $que = $q->find();
        $query = $que->select()->where(['id' => $id])->first();
        //$query = $que->first();
        $this->response->body($query);
        return $this->response;
        die();
    }

    public function deleteNote($id) {
        $this->loadModel('recruiter_notes');
        $note = $this->recruiter_notes->get($id);
        $this->recruiter_notes->delete($note);
        die();
    }

    public function saveNote($id, $rid) {
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

    public function check_user($uid = '',$user1="") {
        $r = '';
        if (isset($_POST['username']) && $_POST['username'] && $user1=="")
            $user = $_POST['username'];
        else
            if($user1)
            $user = $user1;
            else
            {echo '0';die();}
        $q = TableRegistry::get('profiles');
        $que = $q->find();

        if ($uid != "")
            $query = $que->select()->where(['id !=' => $uid, 'username' => $user])->first();
        else
            $query = $que->select()->where(['username' => $user])->first();
        //var_dump($query);
        //$query = $que->first();
        if ($query)
            $r= '1';
        else
            $r= '0';
        if($user1!="")
            return $r;
        else
        {
            echo $r;
            die();
        }
    }

    public function check_email($uid = '', $email1="") {
        $r ='';
        if($email1 == "")
            $email = $_POST['email'];
        else
            $email = $email1;
        $q = TableRegistry::get('profiles');
        $que = $q->find();
        if ($uid != "")
            $query = $que->select()->where(['id !=' => $uid, 'email' => $email])->first();
        else $query = $que->select()->where(['email' => $email])->first();
        //var_dump($query);
        //$query = $que->first();
        if ($query)
            $r= '1';
        else
            $r= '0';
        if($email1!="")
            return $r;
        else
        {
            echo $r;
            die();
        }
    }









/////////////////////////////////////////////////////////////////////////////////////process order
/////////////////////////////////////////////////////////////////////////////////////process order
/////////////////////////////////////////////////////////////////////////////////////process order
/////////////////////////////////////////////////////////////////////////////////////process order

    function get_string_between($string, $start, $end) {
        $string = " " . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return "";
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }

    function get_mee_results_binary($bright_planet_html_binary, $document_type) {
        return ($this->get_string_between(base64_decode($bright_planet_html_binary), $document_type, '</tr>'));
    }

    function create_files_from_binary($order_id, $pdi, $binary) {
        $createfile_pdf = "orders/order_" . $order_id . '/' . $pdi . '.pdf';
        $createfile_html = "orders/order_" . $order_id . '/' . $pdi . 'html';
        $createfile_text = "orders/order_" . $order_id . '/' . $pdi . 'txt';

        if (!file_exists($createfile_pdf) && !file_exists($createfile_text) && !file_exists($createfile_html)) {

            if (isset($binary) && $binary != "") {
                file_put_contents('unknown_file', base64_decode($binary));
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mime = finfo_file($finfo, 'unknown_file');

                if ($mime == "application/pdf") {
                    rename("unknown_file", "orders/order_" . $order_id . '/' . $pdi . '.pdf');
                } elseif ($mime == "text/html") {
                    rename("unknown_file", "orders/order_" . $order_id . '/' . $pdi . '.html');
                } elseif ($mime == "text/plain") {
                    rename("unknown_file", "orders/order_" . $order_id . '/' . $pdi . '.html');
                } else {
                    rename("unknown_file", "orders/order_" . $order_id . '/' . $pdi . '.html');
                }
            }
        }
    }

    public function save_bright_planet_grade($orderid = null, $product_id = null, $grade = null) {
        $querys = TableRegistry::get('orders');
        $arr[$product_id] = $grade;
        $query2 = $querys->query();
        $query2->update()
            ->set($arr)
            ->where(['id' => $orderid])
            ->execute();
        $this->response->body($query2);
        return $this->response;
    }

/////////////////////////////////////////////////////////////////////////////////////process order
    function cron() {//////////////////////////////////send out emails
        if (isset($_GET["testemail"])) {
            $email = $this->request->session()->read('Profile.email');
            echo "Test email sent<BR>" . $this->Mailer->sendEmail("", $email, "TEST EMAIL", "THIS IS A TEST AT: " . date_timestamp_get(date_create()));
            die();
        }

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
                if ($email) {
                    $this->sendtaskreminder($email, $todo, $path, "(Account holder)");
                }
            }
            if (strlen($todo->others_email) > 0) {
                $emails = explode(",", $todo->others_email);
                foreach ($emails as $em) {
                    $this->sendtaskreminder($em, $todo, $path, "(Added by account holder)");
                }
            }
            $q->query()->update()->set(['sent' => 1, 'email_self' => 0])->where(['id' => $todo->id])->execute();
        }

//////////////////////////////////send out emails

////////////////////////////////////////////////////
////////////////////////////////////////////////////
////////////////////////////////////////////////////
////////////////////////////////////////////////////

        $orders = TableRegistry::get('orders');
        $order = $orders
            ->find()
            ->where(['orders.draft' => 0])->order('orders.id DESC')->limit(15);

        foreach ($order as $o) {

            if ($o->complete == 0) {

                $complete = 1;

                if ($o->ins_1 && $o->ins_1_binary == null) {
                    $complete = 0;
                    echo "ins 1 not complete<br>";
                } else if ($o->ins_1 && $o->ins_1_binary != "done") {
                    $this->create_files_from_binary($o->id, "1", $o->ins_1_binary);
                    $this->save_bright_planet_grade($o->id, 'ins_1_binary', 'done');
                    echo "ins 1 complete<br>";
                }

                if ($o->ins_14 && $o->ins_14_binary == null) {
                    $complete = 0;
                    echo "ins 14 not complete<br>";
                } else if ($o->ins_14 && $o->ins_14_binary != "done") {
                    $this->create_files_from_binary($o->id, "14", $o->ins_14_binary);
                    $this->save_bright_planet_grade($o->id, 'ins_14_binary', 'done');
                    echo "ins 14 complete<br>";
                }


                if ($o->ins_72 && $o->ins_72_binary == null) {
                    $complete = 0;
                    echo "ins 72 not complete<br>";
                } else if ($o->ins_72 && $o->ins_72_binary != "done") {
                    $this->create_files_from_binary($o->id, "72", $o->ins_72_binary);
                    $this->save_bright_planet_grade($o->id, 'ins_72_binary', 'done');
                    echo "ins 72 complete<br>";
                }

                if ($o->ins_77 && $o->ins_77_binary == null) {
                    $complete = 0;
                    echo "ins 77 not complete<br>";
                } else if ($o->ins_77 && $o->ins_77_binary != "done") {
                    $this->create_files_from_binary($o->id, "77", $o->ins_77_binary);
                    $this->save_bright_planet_grade($o->id, 'ins_77_binary', 'done');
                    echo "ins 77 complete<br>";
                }


                if ($o->ins_78 && $o->ins_78_binary == null) {
                    $complete = 0;
                    echo "ins 78 not complete<br>";
                } else if ($o->ins_78 && $o->ins_78_binary != "done") {
                    $this->create_files_from_binary($o->id, "78", $o->ins_78_binary);
                    $this->save_bright_planet_grade($o->id, 'ins_78_binary', 'done');
                    echo "ins 78 complete<br>";
                }

                if ($o->ebs_1603 && $o->ebs_1603_binary == null) {
                    $complete = 0;
                    echo "ebs 1603 not complete<br>";
                } else if ($o->ebs_1603 && $o->ebs_1603_binary != "done") {
                    $this->create_files_from_binary($o->id, "1603", $o->ebs_1603_binary);
                    $this->save_bright_planet_grade($o->id, 'ebs_1603_binary', 'done');
                    echo "ebs 1603 complete<br>";
                }


                if ($o->ebs_1627 && $o->ebs_1627_binary == null) {
                    $complete = 0;
                    echo "ebs 1627 not complete<br>";
                } else if ($o->ebs_1627 && $o->ebs_1627_binary != "done") {
                    $this->create_files_from_binary($o->id, "1627", $o->ebs_1627_binary);
                    $this->save_bright_planet_grade($o->id, 'ebs_1627_binary', 'done');
                    echo "ebs 1627 complete<br>";
                }


                if ($o->ebs_1650 && $o->ebs_1650_binary == null) {
                    $complete = 0;
                    echo "ebs 1650 not complete<br>";
                } else if ($o->ebs_1650 && $o->ebs_1650_binary != "done") {
                    $this->create_files_from_binary($o->id, "1650", $o->ebs_1650_binary);
                    $this->save_bright_planet_grade($o->id, 'ebs_1650_binary', 'done');
                    echo "ebs 1650 complete<br>";
                }

                if ($o->bright_planet_html_binary) {
                    $this->create_files_from_binary($o->id, "bright_planet_html_binary", $o->bright_planet_html_binary);

                    $sendit = strip_tags(trim($this->get_mee_results_binary($o->bright_planet_html_binary, "Driver's Record Abstract")));
                    if ($sendit) {
                        $this->save_bright_planet_grade($o->id, 'ins_1', $sendit);
                    }

                    $sendit = strip_tags(trim($this->get_mee_results_binary($o->bright_planet_html_binary, "Pre-employment Screening Program Report")));
                    if ($sendit) {
                        $this->save_bright_planet_grade($o->id, 'ins_77', $sendit);
                    }

                    $sendit = strip_tags(trim($this->get_mee_results_binary($o->bright_planet_html_binary, "CVOR")));
                    if ($sendit) {
                        $this->save_bright_planet_grade($o->id, 'ins_14', $sendit);
                    }
                    $sendit = strip_tags(trim($this->get_mee_results_binary($o->bright_planet_html_binary, "Premium National Criminal Record Check")));
                    if ($sendit) {
                        $this->save_bright_planet_grade($o->id, 'ebs_1603', $sendit);
                    }

                    $sendit = strip_tags(trim($this->get_mee_results_binary($o->bright_planet_html_binary, "Certifications")));
                    if ($sendit) {
                        $this->save_bright_planet_grade($o->id, 'ebs_1650', $sendit);
                    }

                    $sendit = strip_tags(trim($this->get_mee_results_binary($o->bright_planet_html_binary, "TransClick")));
                    if ($sendit) {
                        $this->save_bright_planet_grade($o->id, 'ins_78', $sendit);
                    }

                    $sendit = strip_tags(trim($this->get_mee_results_binary($o->bright_planet_html_binary, "Letter Of Experience")));
                    if ($sendit) {
                        $this->save_bright_planet_grade($o->id, 'ebs_1627', $sendit);
                    }

                    $this->save_bright_planet_grade($o->id, 'bright_planet_html_binary', null);
                }

                if ($complete == 1 && $o->complete == 0) {
                    $or = TableRegistry::get('orders');
                    $quer = $or->query();
                    $quer->update()
                        ->set(['complete' => 1])
                        ->where(['id' => $o->id])
                        ->execute();

                    $table = TableRegistry::get('profiles');
                    $profile1 = $table->find()->where(['id' => $o->user_id])->first();

                    if ($profile1->email) {
                        $settings = TableRegistry::get('settings');
                        $setting = $settings->find()->first();
                        $from = array('info@' . $path => $setting->mee);
                        $to = $profile1->email;
                        $sub = 'Order Completed';
                        $msg = 'Your order has been processed and   ready to download.<br /><br /> Please login <a href="' . LOGIN . '">here</a> to retrieve your score card.<br /><br /> Regards,<br /> The ISB MEE Team';
                        $this->Mailer->sendEmail($from, $to, $sub, $msg);
                    }
                }
            }
        }
        /* for automatic survey email */
        $table = TableRegistry::get('profiles');
        $automatic = $table->find()->where(['is_hired'=>'1','automatic_sent'=>'0','hired_date <>'=>'']);
        if($automatic)
        {
            foreach($automatic as $auto)
            {
                $today = date('Y-m-d');
                $thirty = date('Y-m-d', strtotime($auto->hired_date.'+30 days'));
                $sixty = date('Y-m-d', strtotime($auto->hired_date.'+60 days'));
                if($auto->profile_type == '9' || $auto->profile_type == '12' && $today==$thirty && $auto->email){
                    $from = array('info@' . $path => $setting->mee);
                    $to = $auto->email;
                    $sub = 'Complete your survey';
                    $msg = 'Click <a href="' . LOGIN . 'application/30days.php?p_id='.$auto->id.'">here</a> to complete your survey.<br /><br /> Regards';
                    $this->Mailer->sendEmail($from, $to, $sub, $msg);
                   
                    $queries = TableRegistry::get('Profiles');
                    $queries->query()->update()->set(['automatic_sent' => '1'])
                        ->where(['id' => $auto->id])
                        ->execute();
                }
                if($auto->profile_type == '5' && $today==$sixty && $auto->email){
                    $from = array('info@' . $path => $setting->mee);
                    $to = $auto->email;
                    $sub = 'Complete your survey';
                    $msg = 'Click <a href="' . LOGIN . 'documents/60days.php?p_id='.$auto->id.'">here</a> to complete your survey.<br /><br /> Regards';
                    $this->Mailer->sendEmail($from, $to, $sub, $msg);
                    $queries = TableRegistry::get('Profiles');
                    $queries->query()->update()->set(['automatic_sent' => '1'])
                        ->where(['id' => $auto->id])
                        ->execute();
                }
            }
        }

        die();
    }

    public function loadprofile($UserID, $fieldname = "id")
    {
        $table = TableRegistry::get("profiles");
        $results = $table->find('all', array('conditions' => array($fieldname => $UserID)))->first();
        if (is_object($results)) {
            return $results;
        }
        return false;
    }

    function sendtaskreminder($email, $todo, $path, $name)
    {
        $settings = TableRegistry::get('settings');
        $setting = $settings->find()->first();
        $from = array('info@' . $path => $setting->mee);
        $to = trim($email);
        $sub = 'Tasks Reminder';
        $msg = 'Domain: ' . getHost("isbmee.com") . ' <br /><br />Reminder, you have following task due:<br/><br/>Title: ' . $todo->title . '<br />Description: ' . $todo->description . '<br />Due By: ' . $todo->date . '<br /><br /> Regards,<br />The ' . $setting->mee . ' team';
        echo "<hR>From: " . $from . "<BR>To: " . $to . " " . $name . "<BR>Subject: " . $sub . "<BR>Message: " . $msg;
        $this->Mailer->sendEmail($from, $to, $sub, $msg);
    }

    function getDriverById($id)
    {
        $q2 = TableRegistry::get('profiles');
        $que2 = $q2->find();
        $query2 = $que2->select()->where(['id' => $id])->first();
        $this->response->body($query2);
        return $this->response;
    }

    function getOrders($id)
    {
        $order = TableRegistry::get('orders');
        $order = $order->find()->where(['uploaded_for' => $id]);
        $this->response->body($order);
        return $this->response;
    }

    function forgetpassword()
    {
        $settings = TableRegistry::get('settings');
        $setting = $settings->find()->first();
        $path = $this->Document->getUrl();
        $email = str_replace(" ", "+", trim($_POST['email']));
        $profiles = TableRegistry::get('profiles');
        if ($profile = $profiles->find()->where(['LOWER(email)' => strtolower($email)])->first()) {
            //debug($profile);
            $new_pwd = $this->generateRandomString(6);
            $p = TableRegistry::get('profiles');
            if ($p->query()->update()->set(['password' => md5($new_pwd)])->where(['id' => $profile->id])->execute()) {
                $from = array('info@' . $path => $setting->mee);
                $to = $profile->email;
                $sub = 'Password reset successful';
                $msg = 'Your password has been reset.<br /> Your login details are:<br /> Username: ' . $profile->username . '<br /> Password: ' . $new_pwd . '<br /> Please <a href="' . LOGIN . '">click here</a> to login.<br /> Regards,<br /> The ' . $setting->mee . ' Team';
                $this->Mailer->sendEmail($from, $to, $sub, $msg);
                echo "Password has been reset succesfully. Please check your email for the new password.";
            }
        } else {
            echo "Sorry, the email address does not exist.";
        }
        die();
    }

    function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    function cleardb()
    {
        if ($this->request->session()->read('Profile.super') == 1) {

            //$query = $conn->query("show tables");

            //WHITELIST//
            $this->DeleteAttachment(-1, "attachments", "/attachments/");
            $this->DeleteAttachment(-1, "client_docs", "/img/jobs/");
            $this->DeleteAttachment(-1, "profiles", "/img/profile/");
            $this->DeleteAttachment(-1, "doc_attachments", "/attachments/");
            $this->DeleteUser(-1);//deletes all users
            $this->DeleteTables(array("clients", "clientssubdocument", "client_divison", "client_sub_order", "client_products"));//deletes clients
            //deletes documents
            $this->DeleteTables(array("audits", "consent_form", "consent_form_criminal", "documents", "driver_application", "road_test", "survey"));
            $this->DeleteTables(array("abstract_forms", "bc_forms", "quebec_forms", "education_verification", "employment_verification", "feedbacks", "orders"));
            $this->DeleteTables(array("driver_application_accident", "driver_application_licenses", "clientssubdocument", "mee_attachments"));
            $this->DeleteTables(array("pre_screening", "generic_forms", "pre_employment_road_test", "past_employment_survey", "application_for_employment_gfs"));
            $this->DeleteTables(array("basic_mee_platform"));

            //do not delete settings, contents, logos, subdocuments, order_products, color_class, client_types, profile_types, training_quiz, training_list,

            $this->DeleteDir(getcwd() . "/canvas", ".png");//deletes all signatures
            $this->DeleteDir(getcwd() . "/attachments");//deletes all document attachments
            $this->DeleteDir(getcwd() . "/img/jobs");//deletes all client pictures
            $this->DeleteDir(getcwd() . "/img/certificates", ".pdf", "certificate.jpg");//deletes pdf certificates, leaves the jpg
            $this->DeleteDir(getcwd() . "/img/profile", "", array("female.png", "male.png", "default.png"), "image");//deletes profile pics
            $this->DeleteDir(getcwd() . "/orders", "", "", "", true);//deletes the pdfs and their sub-directories
            $this->DeleteDir(getcwd() . "/pdfs");//deletes the pdfs

            //die();
            $this->layout = "blank";
        }
    }

    function DeleteTables($Table)
    {
        if (is_array($Table)) {
            foreach ($Table as $table) {
                $this->DeleteTables($table);
            }
        } else {
            switch ($Table) {
                case "clients":
                    $table = TableRegistry::get("clients")->find('all');
                    foreach ($table as $client) {
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

    function DeleteUser($ID)
    {
        $table = TableRegistry::get("profiles");
        if ($ID == -1) {
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

            if (!$this->loadprofile(0)) {
                $this->DeleteUser(0);
            }
        } else if (is_numeric($ID) > 0) {
            $user = $this->loadprofile($ID);
            if ($user) {
                if ($user->super == 1) {
                    return false;
                }//cannot delete supers
                unlink(getcwd() . "/img/profile/" . $user - image);
            }//delete image
            $attachments = TableRegistry::get("profile_docs")->find('all', array('conditions' => array(['profile_id' => $ID])));
            foreach ($attachments as $attachment) {
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

    function CleanUsers($tablename, $fieldname = "user_id")
    {
        $table = TableRegistry::get($tablename);
        $users = $table->find('all');
        foreach ($users as $user) {
            $user2 = $this->loadprofile($user->$fieldname);
            if (!is_object($user2)) {//delete any non-existent profile
                $this->DeleteUser($user->$fieldname);
            }
        }
    }

    function DeleteDir($path, $like = "", $notlike = "", $fieldname = "", $recursive = false)
    {
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
            echo "<BR>" . $path . " Was not a directory";
        }
    }

    function DeleteAttachment($ID, $TableName = 'attachments', $Path = "/attachments/")
    {//$ID=-1 deletes all attachments
        $table = TableRegistry::get($TableName);
        if ($ID == -1) {
            echo "<BR>Deleting all attachments from " . $TableName;
            $table = $table->find('all');
            foreach ($table as $attachment) {
                $this->DeleteAttachment($attachment->id, $TableName, $Path);
            }
        } else {
            $attachment = $table->find()->where(['id' => $ID])->first();
            $filename = "";
            if (isset($attachment->title)) {
                $filename = $attachment->title;
            }
            if (isset($attachment->file)) {
                $filename = $attachment->file;
            }
            if (isset($attachment->attachment)) {
                $filename = $attachment->attachment;
            }
            if ($filename) {
                if (file_exists(getcwd() . $Path . $filename) && is_file(getcwd() . $Path . $filename)) {
                    echo "<BR>Deleted file " . $Path . $filename;
                    unlink(getcwd() . $Path . $filename);
                }
            } else {
                echo "<BR>No file to delete " . $ID . " in " . $TableName;
            }
            if ($TableName != "profiles") $table->deleteAll(array('id' => $ID), false);
        }
    }

    function sproduct($id = '0'){
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

    function ptypes($id = '0'){
        if (isset($_POST)) {
            $p = TableRegistry::get('profile_types');
            $title = $_POST['title'];
            $titleFrench = $_POST['titleFrench'];
            if ($id != 0) {
                if ($p->query()->update()->set(['title' => $title, 'titleFrench' => $titleFrench])->where(['id' => $id])->execute()) {
                    echo $title;
                }
            } else {
                $profile = $p->newEntity($_POST);
                if ($p->save($profile)) {
                    echo '<tr>
                            <td>' . $profile->id . '</td>
                            <td class="titleptype_' . $profile->id . '">' . $title . '</td>
                            <td class="titleptypeFrench_' . $profile->id . '">' . $titleFrench . '</td>
                            <td><input type="checkbox" id="pchk_' . $profile->id . '" class="penable"/><span class="span_' . $profile->id . '"></span></td>
                            <td><span  class="btn btn-info editptype" id="editptype_' . $profile->id . '">Edit</span></td>
                        </tr>';
                }
            }
        }
        die();
    }

    function ctypes($id = '0'){
        if (isset($_POST)) {
            $p = TableRegistry::get('client_types');
            $title = $_POST['title'];
            $titleFrench = $_POST['titleFrench'];
            if ($id != 0) {
                if ($p->query()->update()->set(['title' => $title, 'titleFrench' => $titleFrench])->where(['id' => $id])->execute()) {
                    echo $title;
                }
            } else {
                $profile = $p->newEntity($_POST);
                if ($p->save($profile)) {
                    echo '<tr>
                            <td>' . $profile->id . '</td>
                            <td class="titlectype_' . $profile->id . '">' . $title . '</td>
                            <td class="titlectypeFrench_' . $profile->id . '">' . $titleFrench . '</td>
                            <td><input type="checkbox" id="cchk_' . $profile->id . '" class="cenable"/><span class="span_' . $profile->id . '"></span></td>
                            <td><span  class="btn btn-info editctype" id="editctype_' . $profile->id . '">Edit</span></td>
                        </tr>';
                }
            }
        }
        die();
    }

    function enableproduct($id) {
        $p = TableRegistry::get('order_products');
        $enable = $_POST['enable'];
        if ($p->query()->update()->set(['enable' => $enable])->where(['id' => $id])->execute()) {
            echo $enable;
        }
        die();
    }

    function ptypesenable($id, $field = "enable")
    {
        $p = TableRegistry::get('profile_types');
        $enable = $_POST['enable'];
        if ($p->query()->update()->set([$field => $enable])->where(['id' => $id])->execute()) {
            if ($enable == '1')
                echo "Added";
            else
                echo "Removed";
        }

        die();
    }

    function ctypesenable($id){
        $p = TableRegistry::get('client_types');
        $enable = $_POST['enable'];
        if ($p->query()->update()->set(['enable' => $enable])->where(['id' => $id])->execute()) {
            if ($enable == '1') {
                echo "Added";
            }else {
                echo "Removed";
            }
        }
        die();
    }

    function ctypesenb($id){
        $ctype = "";
        foreach ($_POST['ctypes'] as $k => $v) {
            if (count($_POST['ctypes']) == $k + 1) {
                $ctype .= $v;
            }else {
                $ctype .= $v . ",";
            }
        }
        $p = TableRegistry::get('profiles');
        $p->query()->update()->set(['ctypes' => $ctype])->where(['id' => $id])->execute();
        die();
    }

    function ptypesenb($id){
        $ptype = "";
        foreach ($_POST['ptypes'] as $k => $v) {
            if (count($_POST['ptypes']) == $k + 1) {
                $ptype .= $v;
            }else {
                $ptype .= $v . ",";
            }
        }
        $p = TableRegistry::get('profiles');
        $p->query()->update()->set(['ptypes' => $ptype])->where(['id' => $id])->execute();
        die();
    }

    function gettypes($type, $uid){
        $p = TableRegistry::get('profiles');
        $profile = $p->find()->where(['id' => $uid])->first();

        if ($type == 'ptypes') {
            $this->response->body(($profile->ptypes));
        } elseif ($type == "ctypes") {
            $this->response->body(($profile->ctypes));
        }
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

    public function hasattachments($id){
        $docs = TableRegistry::get('profile_docs');
        $query = $docs->find();
        $client_docs = $query->select()->where(['profile_id' => $id])->first();
        if ($client_docs) {
            return true;
        }
    }

    public function getTypeTitle($id, $language = "English"){
        $docs = TableRegistry::get('profile_types');
        $query = $docs->find()->where(['id' => $id])->first();
        if ($query) {
            $fieldname = $this->getFieldname("title",$language);
            $q = $query->$fieldname;
        }else {
            $q = '';
        }
        $this->response->body($q);
        return $this->response;
    }

    function getFieldname($Fieldname, $Language){
        if($Language == "English" || $Language == "Debug"){ return $Fieldname; }
        return $Fieldname . $Language;
    }

    function producteditor(){
        if(isset($_GET["test"])){
            $this->Mailer->sendEmail("", "roy@trinoweb.com", "Test Email", $_GET["test"]);
        }
        if(isset($_GET["Delete"])){
            TableRegistry::get('product_types')->deleteAll(array('Acronym'=>$_GET["Delete"]), false);
            $this->Flash->success($_GET["Delete"] . ' has been deleted.');
        }
        if(isset($_GET["Name"])){
            $this->SaveFields('product_types', $_GET, "Acronym");
        }

        $this->set("producttypes",  TableRegistry::get('product_types')->find('all') );
        $this->set("colors", TableRegistry::get('color_class')->find('all') );

        $this->set("blockscols", $this->getColumnNames('blocks'));
        $this->set("sidebarcols", $this->getColumnNames('sidebar'));

        $this->set("order_products",  TableRegistry::get('order_products')->find('all') );
        $this->set("subdocuments", TableRegistry::get('subdocuments')->find('all') );
    }

    function SaveFields($Table, $Data, $PrimaryKey, $Default = "0", $Ignore = "ID"){
        //detect unchecked checkboxes
        $Columns = $this->getColumnNames($Table, $Ignore);
        foreach($Columns as $Column){
            if (!isset($Data[$Column])){
                $Data[$Column] = $Default;
            }
        }
        $Table = TableRegistry::get($Table);
        $exists =  $Table->find('all', array('conditions' => array([$PrimaryKey => $Data[$PrimaryKey]])))->first();
        unset($Data['submit']);

        if($exists){
            $Table->query()->update()->set($Data)->where([$PrimaryKey => $Data[$PrimaryKey]])->execute();
            $this->Flash->success($Data[$PrimaryKey] . ' has been updated.');
        } else {
            $Table->query()->insert(array_keys($Data))->values($Data)->execute();
            $this->Flash->success($Data[$PrimaryKey] . ' has been created.');
        }
    }

    function getColumnNames($Table, $ignore = ""){
        $Columns = TableRegistry::get($Table)->find('all')->first();
        $Data = $this->getProtectedValue($Columns, "_properties");
        if($ignore){unset($Data[$ignore]);}
        return array_keys($Data);
    }
    function getProtectedValue($obj,$name) {
        $array = (array)$obj;
        $prefix = chr(0).'*'.chr(0);
        return $array[$prefix.$name];
    }
    function getDriverProv($driver)
    {
        $dri = TableRegistry::get('profiles')->find()->where(['id'=>$driver])->first();
        $pro = $dri->driver_province;
        $this->response->body($pro);
        return $this->response;
        
    }


}
?>
