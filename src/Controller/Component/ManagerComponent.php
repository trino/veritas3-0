<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;

class ManagerComponent extends Component {
    function init($Controller){
        $Controller->set("Manager", $this);
        $Controller->set("Me", $this->request->session()->read('Profile.id'));
        $this->Controller = $Controller;
    }


    //////////////////////////profile API//////////////////////////////////////////
    function profile_to_array($ID, $JSON = false, $Pretty = false){
        $Profile = $this->get_entry("profiles", $ID, "id");
        //if(!strpos($Profile->otherinfo, ":")) {$Profile->otherinfo = $this->AppName() . ":" . $ID;}
        $Sidebar = $this->get_entry("sidebar", $ID, "user_id");
        $Blocks = $this->get_entry("blocks", $ID, "user_id");
        $Type = $this->get_entry("profile_types", $Profile->profile_type, "id");
        $Data = array("Profile" => $this->properties_to_array($Profile), "Sidebar" => $this->properties_to_array($Sidebar), "Blocks" => $this->properties_to_array($Blocks), "Type" => $this->properties_to_array($Type));
        if ($JSON) {
            $JSON=false;
            if($Pretty){$JSON=JSON_PRETTY_PRINT;}
            return json_encode($Data, $JSON);
        }
        return $Data;
    }

    function json_to_profile($Data){
        if(!is_array($Data)) {$Data = json_decode($Data, true);}
        $Profile = $Data["Profile"];
        $Profile2 = $this->get_entry("profiles", $Profile["email"], "email");
        if ($Profile2) {return $Profile2->id;}//is a local profile that exists
        //is a remote profile that does not exist, create it
        unset($Profile["id"]);
        $Type = $Data["Type"];
        $Profile["profile_type"] = $this->json_to_profile_type($Type);
        $NewID = $this->new_entry("profiles", "id", $Profile);
        $Blocks = $Data["Blocks"];
        $Blocks["user_id"] = $NewID;//substitute with new id
        $Sidebar = $Data["Sidebar"];
        $Sidebar["user_id"] = $NewID;//substitute with new id
        $this->new_entry("blocks", "id", $Blocks);
        $this->new_entry("sidebar", "id", $Sidebar);
        return $NewID;
    }
    function json_to_profile_type($Data){
        if(!is_array($Data)) {$Data = json_decode($Data, true);}
        $Ptype = $this->get_entry("profile_types", $Data["title"], "title");
        if($Ptype){return $Ptype->id;}//profile type exists, use it
        unset($Data["id"]);
        $Data = $this->new_entry("profile_types", "id", $Data);
        return $Data["id"];
    }

    public function find_client($UserID=""){
        $table = TableRegistry::get("clients");
        return $table->find()->select('id')->where(['profile_id LIKE "'.$UserID.',%" OR profile_id LIKE "%,'.$UserID.',%" OR profile_id LIKE "%,'.$UserID.'" OR profile_id ="'.$UserID.'"'])->first();
    }



    //////////////////////////////////profile type API/////////////////////////////////
    function enum_porofile_types(){
        return $this->enum_table("profile_types");
    }


    /////////////////////////////////document/order API////////////////////////////////
    function load_document($ID, $ReturnSubDoc = false){
        $Doc = $this->get_entry("documents", $ID, "id");
        if($ReturnSubDoc && $Doc){
            $Table = $this->load_subdoc_type($Doc->sub_doc_id)->table_name;
            if($Doc->order_id){
                $Subdoc = $this->get_entry($Table, $Doc->order_id, "order_id");
            } else {
                $Subdoc = $this->get_entry($Table, $ID, "document_id");
            }
            return $Subdoc;
        }
        return $Doc;
    }

    function load_subdoc_type($ID){
        //title, display, form, table_name, orders, color_id, titleFrench, ProductID, icon
        if (is_numeric($ID)) {$Key = "id";} else {$Key = "table_name";}
        return $this->get_entry("subdocuments", $ID, $Key);
    }

    function remove_empties($Data){
        foreach($Data as $Key => $Value){
            if(!$Value){
                unset($Data[$Key]);
            }
        }
        return $Data;
    }


    function Signatures($sub_doc_id){
        switch ($sub_doc_id) {
            case 4: //consent form
                return array("signature_company_witness", "criminal_signature_applicant", "criminal_signature_applicant2", "signature_company_witness2");
                break;
        }
    }

    function load_order($ID, $GetFiles = false, $RemoveEmpties = true, $forms = ""){
        //loads an order in to a single variable, includes the documents, profiles, profile types, client, divisions
        //creating each of which if they do not exist already, except for document types which cannot be soft-created
        $Header = $this->get_entry("orders", $ID, "id");
        $Header = $this->getProtectedValue($Header, "_properties");
        if($forms){
            if (!is_array($forms)){$forms = explode(",", $forms);}
            $FormsToCheck = explode(",", $Header["forms"]);
            $DoIt = false;
            foreach($forms as $form){
                if (in_array($form, $FormsToCheck)){
                    $DoIt = true;
                    break;
                }
            }
        }
        if($GetFiles) {
            $Dir = "webroot/canvas";
            $Header["recruiter_signature"] = $this->base_64_file($Dir . "/" . $Header["recruiter_signature"]);
        }
        if($RemoveEmpties){$Header=$this->remove_empties($Header);}

        //profile type
        $Header["user_id"] = $this->profile_to_array($Header["user_id"]);
        $Header["uploaded_for"] = $this->profile_to_array($Header["uploaded_for"]);
        $Header["division"] = $this->get_division($Header["division"])->title;
        $Header["client_id"] = $this->client_to_array($Header["client_id"]);

        $Order = (object) array("Header" => $Header);
        $Forms = $this->enum_all("documents", array("order_id" => $ID));
        $Order->Forms = array();
        foreach($Forms as $Form){
            $Table = $this->load_subdoc_type($Form->sub_doc_id);
            if($Table) {
                $Form = (array) $Form;
                $Form = $this->getProtectedValue($Form, "_properties");
                $theForms = $this->enum_all($Table->table_name, array("order_id" => $ID));
                foreach($theForms as $Data) {
                    //$Data = $this->get_entry($Table->table_name, $ID, "order_id");
                    $Data = $this->getProtectedValue($Data, "_properties");
                    if ($RemoveEmpties) {
                        $Form = $this->remove_empties($Form);
                        $Data = $this->remove_empties($Data);
                    }
                    if ($GetFiles) {
                        $theFiles = $this->Signatures($Form["sub_doc_id"]);
                        if (is_array($theFiles)) {
                            foreach ($theFiles as $File) {
                                $Data[$File] = $this->base_64_file($Dir . "/" . $Data[$File]);
                            }
                        }
                    }
                    $Form["sub_doc_id"] = $this->load_subdoc_type($Form["sub_doc_id"])->table_name;

                    $Data = (object)array("Header" => $Form, "Data" => $Data);
                    $Order->Forms[] = $Data;
                    $Form["Duplicate"] = true;
                }
            }
        }
        return $Order;
    }

    function json_to_order($Data){
        if (is_object($Data)) {
            $Data = (array) $Data;
        }else{
            $Data = json_decode($Data, true);
        }

        $Header = $Data["Header"];
        $Forms = $Data["Forms"];
        $Dir = "webroot/canvas";

        $User_ID = $this->json_to_profile($Header["user_id"]);
        $Header["user_id"] = $User_ID;

        $Uploaded_for = $this->json_to_profile($Header["uploaded_for"]);
        $Header["uploaded_for"] = $Uploaded_for;

        $Client_ID = $this->json_to_client($Header["client_id"]);
        $Header["client_id"] = $Client_ID;

        $Header["division"] = $this->auto_division($Header["client_id"], $Header["division"]);
        if (isset($Header["recruiter_signature"])){$Header["recruiter_signature"] = $this->unbase_64_file($Header["recruiter_signature"], $Dir);}
        $Order_ID = $this->construct_order($Header);

        foreach($Forms as $Form){
            $this->construct_document($Form, $Order_ID, $User_ID, $Client_ID, $Uploaded_for, $Dir);
        }
    }

    function construct_order($Header){
        unset($Header["id"]);
        return $this->new_entry("orders", "id", $Header)["id"];
    }
    function construct_document($Form, $Order_ID, $User_ID, $Client_ID, $Uploaded_for, $Dir){
        $Header =  $Form->Header;
        $Data = $Form->Data;

        unset($Header["id"]);
        $Header["order_id"] = $Order_ID;
        $Header["user_id"] = $User_ID;
        $Header["client_id"] = $Client_ID;
        $Header["uploaded_for"] = $Uploaded_for;
        $sub_doc_type = $this->load_subdoc_type($Header["sub_doc_id"]);
        $Header["sub_doc_id"] = $sub_doc_type->id;

        $Signatures = $this->Signatures($Header["sub_doc_id"]);
        if (is_array($Signatures)){
            foreach($Signatures as $File){
                if (isset($Data[$File])){
                    $Data[$File] = $this->unbase_64_file($Data[$File], $Dir);
                }
            }
        }

        unset($Data["id"]);
        $Data["order_id"] = $Order_ID;
        $Data["client_id"] = $Client_ID;
        $Data["user_id"] = $User_ID;

        $DocumentID = $this->new_entry("documents", "id", $Header);
        $this->new_entry($sub_doc_type->table_name, "id", $Data);
        return $DocumentID;
    }

    function randomtext($Length=8) {
        $alphabet = "0123456789";
        $pass = "";
        $alphaLength = strlen($alphabet) - 1;
        for ($i = 0; $i < $Length; $i++) {
            $n = rand(0, $alphaLength);
            $pass .= $alphabet[$n];
        }
        return $pass;
    }
    function unbase_64_file($Data, $Path, $Filename = "", $DoWrite = false){//Set $DoWrite to true in production
        $Comma = strpos($Data, ",");//chop off "data:image/EXT;base64,"
        if($Comma) {
            $Header = $this->left($Data, $Comma);
            $Data = base64_decode($this->right($Data, strlen($Data) - $Comma - 1));
            $Path = str_replace('//', '/', $_SERVER['DOCUMENT_ROOT'] . $this->Controller->request->webroot . $Path);
            if (!$Filename) {
                $Type = str_replace(";base64", "", str_replace("data:image/", "", $Header));
                $Filename = $this->randomtext(10) . "_" . $this->randomtext(10) . "." . $Type;
                while (file_exists($Path . "/" . $Filename)) {
                    $Filename = $this->randomtext(10) . "_" . $this->randomtext(10) . "." . $Type;
                }
            }
            if($DoWrite) {file_put_contents($Path . "/" . $Filename, $Data);}
            return $Filename;
        }
        return $Data;
    }
    function base_64_file($path){
        $type = pathinfo($path, PATHINFO_EXTENSION);
        if($type == "jpeg"){$type = "jpg";}
        $path = str_replace('//', '/', $_SERVER['DOCUMENT_ROOT'] . $this->Controller->request->webroot . $path);
        if (file_exists($path) && !is_dir($path)) {
            $data = file_get_contents($path);
            return 'data:image/' . $type . ';base64,' . base64_encode($data);
        }
        return "";
    }


    /////////////////////////////////////client API///////////////////////////
    function get_division($DivisionID){
        return $this->get_entry("client_divison", $DivisionID, "id");
    }
    function get_client_division($ClientID, $DivisionName){
        return $this->enum_all("client_divison", array("client_id" => $ClientID, "title" => $DivisionName))->first();
    }
    function get_divisions($ClientID){
        return $this->table_to_array("client_divison", array("client_id" => $ClientID), "id", "title");
    }
    function client_to_array($ClientID){
        $Client = $this->properties_to_array($this->get_entry("clients", $ClientID));
        $Products = $this->table_to_array("client_products", array("ClientID" => $ClientID), "ID", "ProductNumber");
        return array("Client" => $Client, "Products" => $Products);
    }
    function json_to_client($Data){
        if(!is_array($Data)) {$Data = json_decode($Data, true);}
        $Client = $Data["Client"];
        $Products = $Data["Products"];

        $Client2 = $this->get_entry("clients", $Client["company_name"], "company_name");
        if($Client2){return $Client2->id;}//is a local company, return the ID

        //is not a local company, create it from the data
        $Client= $this->unset_multi($Client, array("id", "profile_id", "image", "requalify_product"));
        $ID = $this->new_entry("clients", "id", $Client);
        $Divisions = explode("\r\n", $Client["division"]);
        $this->new_division($ID, $Divisions, false);
        foreach($Products as $Product){
            $this->new_entry("client_products", "ID", array("ClientID" => $ID, "ProductNumber" => $Product));
        }
        return $ID;
    }

    function unset_multi($Array, $Unsets){
        foreach($Unsets as $Name){
            unset($Array[$Name]);
        }
        return $Array;
    }
    function auto_division($ClientID, $DivisionName){
        $Division = $this->get_client_division($ClientID, $DivisionName);
        if($Division){return $Division->id;}
        return $this->new_division($ClientID, $DivisionName);
    }
    function new_division($ClientID, $DivisionName, $AppendToClient = true){
        if(is_array($DivisionName)){
            foreach($DivisionName as $Division){
                $this->new_division($ClientID, $Division, $AppendToClient);
            }
        } else {
            if($AppendToClient) {
                $Client = $this->get_client($ClientID);
                $Divisions = $this->appendstring($Client->division, $DivisionName, "\r\n");
                $this->edit_database("clients", "id", $ClientID, array("division" => $Divisions));
            }
            return $this->new_entry("client_divison", "id", array("client_id" => $ClientID, "title" => $DivisionName));
        }
    }

    ///////////////////////////////////////JSON API//////////////////////////////
    function table_to_array($Table, $Conditions, $KeyColumn, $ValueColumn){
        return $this->iterator_to_array($this->enum_all($Table, $Conditions), $KeyColumn, $ValueColumn);
    }

    function table_to_json($table, $conditions, $Pretty = false){
        $columns = $this->getColumnNames($table, "", false);
        $Data = $this->enum_all($table, $conditions)->first();
        if($Data) {
            foreach ($columns as $Name => $Value) {
                $columns[$Name] = $Data->$Name;
            }
        }
        if ($Pretty) {return json_encode($columns, JSON_PRETTY_PRINT);}
        return json_encode($columns);
    }

    function table_to_schema($table, $Pretty = false){
        $dataCols = array();
        $dataCols['title'] = $_GET["table"];
        $dataCols['description'] = "Automated table schema";
        $dataCols['type'] = "object";
        $columns = $this->getColumnNames($table, "", false);
        $dataProps = array();
        $required_fields = $this->required_fields($table);
        foreach($columns as $Name => $Data){
            $dataProps[$Name] = $Data;
        }
        $dataCols['items'] = $dataProps;
        if($required_fields){$dataCols['required'] = $required_fields;}
        if ($Pretty) {return json_encode($dataCols, JSON_PRETTY_PRINT);}
        return json_encode($dataCols);
    }

    function required_fields($table){
        $required = "";
        switch($table){
            case "profiles":
                $required = array("username");
        }
        return $required;
    }

    function object_to_array($object){
        return (array) $object;
    }
    function properties_to_array($object){
        return $this->getProtectedValue($object, "_properties");
    }

    function verify_data($Schema, $Data, $TestMode = false){
        $Schema = json_decode($Schema);
        $Data = json_decode($Data);
        $required_fields = "";
        if (isset($Schema->required)) {$required_fields = $Schema->required;}
        $items = (array) $Schema->items;
        foreach ($items as $ColName => $ColData){
            $required=false;
            if($required_fields) {$required = in_array($ColName, $required_fields);}
            $Value = $Data->$ColName;
            if($required && !$Value){
                if($TestMode) {return $ColName . " failed required field";}
                return false;
            }
            switch ($ColData->type){
                case "integer":
                    if(!is_numeric($Value)){$Fail = true;}
                    break;
                case "text":
                    if(!is_string($Value)){$Fail = true;}
                    break;
                case "boolean":
                    if (!is_bool($Value)) {$Fail = true;}
                    break;
                case "string":
                    if(!is_string($Value)){$Fail = true;}
                    if(!strlen($Value) > $ColData->length) {$Fail = true;}
                    break;
            }
            if (isset($Fail)){
                if($TestMode) {return $ColName . " failed " . $ColData->type . " (" . $Value . ")";}
                return false;
            }
        }
        return true;
    }


    /////////////////////////////////DATABASE API///////////////////////////////////
    function enum_tables(){
        $db = ConnectionManager::get('default');
        $collection = $db->schemaCollection();// Create a schema collection.
        return $collection->listTables();// Get the table names
    }

    function delete_all($Table, $data){
        $table = TableRegistry::get($Table);
        $table->deleteAll($data, false);
    }
    function enum_table($Table){
        return TableRegistry::get($Table)->find('all');
    }
    function enum_all($Table, $conditions = ""){
        if (is_array($conditions)) {
            return TableRegistry::get($Table)->find('all')->where($conditions);
        }
        return $this->enum_table($Table);
    }

    function iterator_to_array($entries, $PrimaryKey, $Key){
        $data = array();
        foreach($entries as $profiletype){
            $data[$profiletype->$PrimaryKey] = $profiletype->$Key;
        }
        return $data;
    }

    function enum_anything($Table, $Key, $Value){
        return TableRegistry::get($Table)->find('all')->where([$Key=>$Value]);
    }
    function new_anything($Table, $Name){
        $Name = $this->new_entry($Table, "ID", array("Name" => $Name));
        return $Name["ID"];
    }

    function get_entry($Table, $Value, $PrimaryKey = "id"){
        $table = TableRegistry::get($Table);
        return $table->find()->where([$PrimaryKey=>$Value])->first();
    }

    //only use when you know the primary key value exists
    function update_database($Table, $PrimaryKey, $Value, $Data){
        TableRegistry::get($Table)->query()->update()->set($Data)->where([$PrimaryKey => $Value])->execute();
        $Data[$PrimaryKey] = $Value;
        return $Data;
    }

    function get_row_count($Table, $Conditions = ""){
        $Table = TableRegistry::get($Table);
        if($Conditions) {
            return $Table->find('all')->where($Conditions)->count();
        } else {
            return $Table->find('all')->count();
        }
    }

    function edit_database($Table, $PrimaryKey, $Value, $Data){
        $table = TableRegistry::get($Table);
        $entry = false;
        if($PrimaryKey && $Value) {
            $entry = $table->find()->where([$PrimaryKey => $Value])->first();
        }
        if($entry){
            $table->query()->update()->set($Data)->where([$PrimaryKey => $Value])->execute();
            $Data[$PrimaryKey] = $Value;
        } else {
            //$table->query()->insert(array_keys($Data))->values($Data)->execute();
            $Data2 = $table->newEntity($Data);
            $table->save($Data2);
            if($PrimaryKey){
                $Data[$PrimaryKey] = $Data2->$PrimaryKey;
            }
        }
        return $Data;
    }

    function new_entry($Table, $PrimaryKey, $Data){
        return $this->edit_database($Table, $PrimaryKey, "", $Data);
    }

    function lastQuery(){
        $dbo = $this->getDatasource();
        $logs = $dbo->_queriesLog;
        // return the first element of the last array (i.e. the last query)
        return current(end($logs));
    }

    function getColumnNames($Table, $ignore = "", $keysonly = true){
        $Columns = TableRegistry::get($Table)->schema();
        $Data = $this->getProtectedValue($Columns, "_columns");
        if ($Data) {
            if (is_array($ignore)) {
                foreach ($ignore as $value) {
                    unset($Data[$value]);
                }
            } elseif ($ignore) {
                unset($Data[$ignore]);
            }
            if ($keysonly){
                $Data = array_keys($Data);
            }
            return $Data;
        }
    }

    function appendstring($Current, $Append, $delimeter = ","){
        if($Current){return $Current . $delimeter . $Append;}
        return $Append;
    }

    function getProtectedValue($obj,$name) {
        $array = (array)$obj;
        $prefix = chr(0).'*'.chr(0);
        if (isset($array[$prefix.$name])) {
            return $array[$prefix . $name];
        }
    }

    function debugall($iteratable){
        //debug($iteratable);
        foreach($iteratable as $item){
            debug($item);
        }
    }

    function kill_non_numeric($text, $allowmore = ""){
        return preg_replace("/[^0-9" . $allowmore . "]/", "", $text);
    }
    function left($text, $length){
        return substr($text,0,$length);
    }
    function right($text, $length){
        return substr($text, -$length);
    }

    function getside($text, $delimeter, $Left = true){
        $text = explode($delimeter, $text);
        if ($Left) { return $text[0];}
        return $text[1];
    }

    function getIterator($Objects, $Fieldname, $Value){
        foreach($Objects as $Object){
            if ($Object->$Fieldname == $Value){
                return $Object;
            }
        }
        return false;
    }

    function array_to_object($Array){
        $object = (object) $Array;
        return $object;
    }

    //accepts a table name, or the pure (false) column names array
    function get_primary_key($Table){
        if (is_string($Table)){
            $Table = $this->getColumnNames($Table, "", false);
        }
        if (is_array($Table)){
            foreach($Table as $Key => $Value){
                if(isset($Value['autoIncrement'])){
                    return $Key;
                }
            }
        }
    }

    function get($Key, $Default = ""){
        if (isset($_POST[$Key])){ return $_POST[$Key]; }
        if (isset($_GET[$Key])){ return $_GET[$Key]; }
        return $Default;
    }


    ////////////////////////////////////////////COMMS//////////////////////////////////////////////////
    function AppName(){
        return  $_SERVER["SERVER_NAME"];
    }

    function isJson($string) {
        if($string && !is_array($string)){
            json_decode($string);
            return (json_last_error() == JSON_ERROR_NONE);
        }
    }

    function cURL($URL, $data = "", $username = "", $password = ""){
        $session = curl_init($URL);
        curl_setopt($session, CURLOPT_HEADER, false);
        curl_setopt($session, CURLOPT_SSL_VERIFYPEER, false);//not in post production
        curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($session, CURLOPT_POST, true);
        if($data) { curl_setopt ($session, CURLOPT_POSTFIELDS, $data);}

        $datatype = "x-www-form-urlencoded;charset=UTF-8";
        if($this->isJson($data)){$datatype  = "json";}
        $header = array('Content-type: application/' . $datatype, "User-Agent: " . $this->AppName());
        if ($username && $password){
            $header[] =	"Authorization: Basic " . base64_encode($username . ":" . $password);
        } else if ($username) {
            $header[] =	"Authorization: Bearer " .  $username;
            $header[] =	"Accept-Encoding: gzip";
        } else if ($password) {
            $header[] =	"Authorization: AccessKey " .  $password;
        }
        curl_setopt($session, CURLOPT_HTTPHEADER, $header);

        $response = curl_exec($session);
        if(curl_errno($session)){
            $response = "Error: " . curl_error($session);
        }
        curl_close($session);
        return $response;
    }
}
?>