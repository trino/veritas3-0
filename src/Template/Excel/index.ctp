<?php
    function getID($ID){
        return substr($ID, 5, strpos($ID, "]") - 5);
    }

    if (isset($_POST["action"])){
        if(isset($_POST["id"])){
            $ID = getID($_POST["id"]);
        }

        switch($_POST["action"]){
            case "delete":
                $Manager->delete_all($_POST["table"], array($_POST["key"] => $ID));
                echo "Deleted from " . $_POST["table"] . " where " . $_POST["key"] . " = " . $ID;
                break;
            case "save":
                if (isset($_POST["Data"])) {
                    foreach ($_POST["Data"] as $Key => $Data) {
                        if($Key == "new"){
                            $ID = $Manager->edit_database($_POST["table"], $_POST["key"], false, $Data);
                            //echo 'Added: ' . $_POST["key"] . " = " . $ID[$_POST["key"]];
                        } else {
                            $Manager->update_database($_POST["table"], $_POST["key"], $Key, $Data);
                        }
                    }
                    echo "All changed data was saved";
                } else {
                    echo "No data was saved";
                }
                break;
            case "deletetable":
                echo "I'm not deleting " . $_POST["table"] . "...";
                break;
            case "newtable":
                if($Manager->new_table($_POST["table"])){
                    echo "Table made: " . $_POST["table"];
                } else {
                    echo "Unable to create table";
                }
                break;
            default:
                debug($_POST);
        }
        die();
    }

    $settings = $this->requestAction('settings/get_settings');
    include_once('subpages/api.php');
    $language = $this->request->session()->read('Profile.language');
    $controller =  $this->request->params['controller'];
    $strings = CacheTranslations($language, array("forms_%" , $controller  . "_%"),$settings);
    if($language == "Debug"){ $Trans = " [Translated]"; } else {$Trans = "";}

    function javascriptarray($Array){
        return '["' . implode('", "', $Array) . '"];';//var cars = ["Saab", "Volvo", "BMW"];
    }

    function ucfirst2($Text, $DoUnderscore = false){
        if($DoUnderscore){$Text = str_replace("_", " ", $Text);}
        $Text = explode(" ", $Text);
        foreach($Text as $Key => $Value){
            $Text[$Key] = ucfirst($Value);
        }
        return implode(" ", $Text);
    }

    $Columns="";
    $Table="";
    $PrimaryKey="";
    $Tables="";
    if(isset($_GET["table"])){
        $Table = $_GET["table"];
        $PrimaryKey = $Manager->get_primary_key($Table);
        $Columns = $Manager->getColumnNames($Table, "", false);
        $Conditions = "";
        if (isset($_GET["search"])){
            if (strpos($_GET["search"], "%") !== false){//is a pattern
                $Conditions[] = $_GET["column"] . " like '" . $_GET["search"] . "'";
            } else {
                $Conditions[$_GET["column"]] = $_GET["search"];
            }
        }
        $Data = $Manager->paginate($Manager->enum_all($Table,$Conditions));
        ?>
        <div class="form-actions" style="height:75px;">
            <div class="row">
                <div class="col-md-1" align="left">
                    <div id="sample_2_paginate" class="dataTables_paginate paging_simple_numbers" style="margin-top:-10px;">
                        <ul class="pagination sorting">
                            <LI><A HREF="<?= $this->request->webroot; ?>excel">Back</A></LI>
                            <LI><A ONCLICK="return save();">Save</A></LI>
                        </ul>
                    </div>
                </DIV>

                <div class="col-md-5" align="left" style="height: 32px; vertical-align:middle; display:table-cell;">
                    <FORM method="get" action="<?= $this->request->webroot; ?>excel">
                        <INPUT TYPE="hidden" name="table" value="<?= $Table; ?>">
                        <INPUT TYPE="text" name="search" placeholder="Search" value="<?php if(isset($_GET["search"])){echo $_GET["search"];} ?>">
                        <SELECT NAME="column" style="height:24px;">
                            <?php
                                foreach($Columns as $ColumnName => $ColumnData){
                                    echo '<OPTION value="' . $ColumnName . '"';
                                    if(isset($_GET["column"]) && $_GET["column"] == $ColumnName){echo ' SELECTED';}
                                    echo '>' . ucfirst2($ColumnName, true) . '</OPTION>';
                                }
                            ?>
                        </SELECT>
                        <input type="submit" value="Search">
                    </FORM>
                </DIV>

                <div class="col-md-6" align="right">
                    <div id="sample_2_paginate" class="dataTables_paginate paging_simple_numbers" style="margin-top:-10px;">
                        <ul class="pagination sorting">
                            <?= $this->Paginator->prev('< ' . __($strings["dashboard_previous"])); ?>
                            <?= $this->Paginator->numbers(); ?>
                            <?= $this->Paginator->next(__($strings["dashboard_next"]) . ' >'); ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    <?php } else {
        $Tables = $Manager->enum_tables();
    }?>
<STYLE>
    .nowrap{
        white-space: nowrap;
    }
</STYLE>
<SCRIPT>
    window.onbeforeunload = function (e) {
        if (changed.length > 0) {
            var message = "Are you sure you want to quit without saving?", e = e || window.event;
            if (e) {e.returnValue = message;}// For IE and Firefox
            return message;// For Safari
        }
    };

    var columns = <?php if (is_array($Columns)) { echo javascriptarray(array_keys($Columns));} else { echo "false;"; } ?>
    var tables = <?php if (is_array($Tables)) { echo javascriptarray($Tables);} else { echo "false;"; } ?>
    var changed = new Array();
    var changedNew = false;
    function mychangeevent(ID, DoPush){
        var RET = checktags(ID, "single");
        if(DoPush) {
            var Index = changed.indexOf(ID);
            if (RET["Status"]) {
                if (Index == -1) {
                    changed.push(ID);
                }
            } else if (Index > -1) {
                changed.splice(Index, 1);
            }
        }
    }

    function removeelement(id) {
        return (elem=document.getElementById(id)).parentNode.removeChild(elem);
    }

    function save(){
        var ID, Text = "";
        for (index = 0; index < changed.length; ++index) {
            ID = changed[index];
            if(Text){Text = Text + "&";}
            Text = Text + ID + "=" + encodeURIComponent(getinputvalue(ID));
        }
        $.ajax({
            url: window.location,
            type: "post",
            dataType: "HTML",
            data: "action=save&key=<?= $PrimaryKey; ?>&table=<?= $Table; ?>&" + Text,
            success: function (msg) {
                alert(msg);
            }
        })
        changed = new Array();
        return false;
    }

    function deleterow(ID){
        if (confirm("Are you sure you want to delete '" + ID + "'?")){
            $.ajax({
                url: window.location,
                type: "post",
                dataType: "HTML",
                data: "action=delete&table=<?= $Table; ?>&key=<?= $PrimaryKey; ?>&id=" + ID,
                success: function (msg) {
                    alert(msg);
                    removeelement(ID);
                }
            })
        }
        return false;
    }

    function deletetable(Name){
        if (confirm("Are you sure you want to delete '" + Name + "'?")){
            $.ajax({
                url: window.location,
                type: "post",
                dataType: "HTML",
                data: "action=deletetable&table=" + Name,
                success: function (msg) {
                    alert(msg);
                    removeelement("table" + Name);
                }
            })
        }
        return false;
    }

    function newtable(){
        var Name =  prompt("Please enter a table name", "New Table").toLowerCase();
        if(Name) {
            if(tables.indexOf(Name) >-1){
                alert("That table exists already");
                return false;
            }
            $.ajax({
                url: window.location,
                type: "post",
                dataType: "HTML",
                data: "action=newtable&table=" + Name,
                success: function (msg) {
                    tables.push(Name);
                    alert(msg);
                    window.open(window.location + "?table=" + Name ,"_self")
                }
            })
        }
        return false;
    }

    <?php loadreasons("edit", $strings); ?>
</SCRIPT>

<DIV width="100%" height="100%" style="overflow: auto;">
    <table class="table table-hover  table-striped table-bordered table-hover dataTable no-footer">
        <THEAD><TR>
        <?php
            if(isset($_GET["table"])) {
                if($PrimaryKey){
                    foreach ($Columns as $ColumnName => $ColumnData) {
                        echo '<TH class="nowrap">';
                        if ($ColumnName == $PrimaryKey) {
                            echo '<i class="fa fa-key"></i>';
                        }
                        echo $this->Paginator->sort($ColumnName) . '</TH>';
                    }
                    echo '</TR></THEAD><TBODY>';
                    foreach ($Data as $Row) {
                        $ID = "Data[" . $Row->$PrimaryKey . "]";
                        echo '<TR ID="' . $ID . '">';
                        $First = true;
                        foreach ($Columns as $ColumnName => $ColumnData) {
                            $Me = $ID . '[' . $ColumnName . ']';
                            $Type = "text";
                            echo '<TD style="padding: 0;" align="center">';
                            if ($ColumnName == $PrimaryKey) {
                                echo '<A ONCLICK="return deleterow(' . "'" . $ID . "'" . ');"<i class="fa fa-times"></i>' . $Row->$PrimaryKey . '</A>';
                            } else {
                                echo '<INPUT NAME="' . $Me . '" ID="' . $Me . '" VALUE="' . $Row->$ColumnName . '" CLASS="textinput" onchange="mychangeevent(' . "'" . $Me . "'" . ', true);"';
                                echo ' PLACEHOLDER="' . $ColumnName . "." . $Row->$PrimaryKey . '"';
                                switch ($ColumnData["type"]) {
                                    case "string":
                                        break;
                                    case "text":
                                        break;
                                    case "boolean":
                                        $Type = "checkbox";
                                        echo ' VALUE="True"';
                                        if ($Row->$ColumnName) {
                                            echo ' CHECKED';
                                        }
                                    case "integer":
                                        echo ' role="number"';
                                        break;

                                    default:
                                        debug($ColumnData);
                                        die();
                                }
                                echo 'TYPE="' . $Type . '">';
                            }
                            echo '</TD>';
                        }
                        echo '</TR>';
                    }

                    echo '<TR>';
                    foreach ($Columns as $ColumnName => $ColumnData) {
                        echo '<TD style="padding: 0;" align="center" class="nowrap">';
                        $ID = "Data[new]";
                        if ($ColumnName == $PrimaryKey) {
                            echo '<A onclick="return save();"><i class="fa fa-floppy-o"></i>New</A>';
                        } else {
                            $Me = $ID . '[' . $ColumnName . ']';
                            $Type = "text";
                            echo '<INPUT NAME="' . $Me . '" ID="' . $Me . '" " CLASS="textinput" onchange="mychangeevent(' . "'" . $Me . "'" . ', true);"';
                            echo ' PLACEHOLDER="' . $ColumnName . '.new"';
                            switch ($ColumnData["type"]) {
                                case "boolean":
                                    $Type = "checkbox";
                                    echo ' VALUE="True"';
                                    break;
                                case "integer":
                                    echo ' role="number"';
                                    break;
                            }
                            echo 'TYPE="' . $Type . '">';
                        }
                        echo '</TD>';
                    }
                    echo '</TR>';
                } else {
                    echo '<TH>This table has no primary key and cannot be edited</TH></TR></THEAD><TBODY>';
                }
            } else {
                echo '<TH>Table</TH></TR></THEAD><TBODY>';
                foreach($Tables as $Table){
                    echo '<TR ID="table' . $Table . '"><TD><A onclick="return deletetable(' . "'" . $Table . "'" . ');"><i class="fa fa-times"></i></A> <A HREF="?table=' . $Table . '">' . $Table . '</A></TD></TR>';
                }
                echo '<TR><TD><A onclick="return newtable();"><i class="fa fa-floppy-o"></i> New Table</A>';
            }
        ?>
        </TBODY>
    </table>
</DIV>