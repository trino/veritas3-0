<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;

class ManagerComponent extends Component {
    function init($Controller){
        $Controller->set("Manager", $this);
        $this->Controller = $Controller;
    }

    function enum_porofile_types(){
        return $this->enum_table("profile_types");
    }

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
        return $this->get_entry("subdocuments", $ID, "id");
    }

    function remove_empties($Data){
        foreach($Data as $Key => $Value){
            if(!$Value){
                unset($Data[$Key]);
            }
        }
        return $Data;
    }
    function load_order($ID, $GetFiles = false, $RemoveEmpties = true, $forms = ""){
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
                        switch ($Form["sub_doc_id"]) {
                            case 4: //consent form
                                $GetFiles = array("signature_company_witness", "criminal_signature_applicant", "criminal_signature_applicant2", "signature_company_witness2");
                                break;
                        }
                        if (is_array($GetFiles)) {
                            foreach ($GetFiles as $File) {
                                $Data[$File] = $this->base_64_file($Dir . "/" . $Data[$File]);
                            }
                        }
                    }
                    $Data = (object)array("Header" => $Form, "Data" => $Data);
                    $Order->Forms[] = $Data;
                }
            }
        }
        return $Order;
    }

    function base_64_file($path){
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $path = str_replace('//', '/', $_SERVER['DOCUMENT_ROOT'] . $this->Controller->request->webroot . $path);
        if (file_exists($path) && !is_dir($path)) {
            $data = file_get_contents($path);
            return 'data:image/' . $type . ';base64,' . base64_encode($data);
        }
        return "";
    }








    ///////////////////////////////////////JSON API//////////////////////////////
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

    public function get_entry($Table, $Value, $PrimaryKey = "ID"){
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

}
?>