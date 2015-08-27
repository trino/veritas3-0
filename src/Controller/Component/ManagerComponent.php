<?php
    namespace App\Controller\Component;

    use Cake\Controller\Component;
    use Cake\ORM\TableRegistry;

    class ManagerComponent extends Component {
        function init($Controller){
            $Controller->set("Manager", $this);
            $this->Controller = $Controller;
        }

        function enum_porofile_types(){
            return $this->enum_table("profile_types");
        }






















        /////////////////////////////////DATABASE API///////////////////////////////////
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