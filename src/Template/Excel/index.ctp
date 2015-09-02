<?php
    $settings = $this->requestAction('settings/get_settings');
    include_once('subpages/api.php');
    $language = $this->request->session()->read('Profile.language');
    $controller =  $this->request->params['controller'];
    $strings = CacheTranslations($language, array("forms_%" , $controller  . "_%"),$settings);
    if($language == "Debug"){ $Trans = " [Translated]"; } else {$Trans = "";}
    if(isset($_GET["table"])){
        $Table = $_GET["table"];
        $Columns = $Manager->getColumnNames($Table, "", false);
        $PrimaryKey = $Manager->get_primary_key($Table);
        $Data = $Manager->paginate($Manager->enum_table($Table));
        ?>
        <div class="form-actions" style="height:75px;">
            <div class="row">
                <div class="col-md-6" align="left">
                    <div id="sample_2_paginate" class="dataTables_paginate paging_simple_numbers" style="margin-top:-10px;">
                        <ul class="pagination sorting">
                            <LI><A HREF="<?= $this->request->webroot; ?>excel">Back</A></LI>
                            <LI><A ONCLICK="return save();">Save</A></LI>
                        </ul>
                    </div>
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
    <?php } ?>
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

    var changed = new Array();
    function mychangeevent(ID){
        var RET = checktags(ID, "single");
        var Index = changed.indexOf(ID);
        if (RET["Status"]) {
            if (Index == -1) {
                changed.push(ID);
            }
        } else if (Index > -1) {
            changed.splice(Index, 1 );
        }
    }

    function checkifchanged(){
        if (changed.length == 0){return true;}
        return confirm("Are you sure you want to leave without saving?");
    }

    function save(){
        var ID;
        for (index = 0; index < changed.length; ++index) {
            ID = changed[index];
            alert("Saving: " + ID + " = " + getinputvalue(ID) );
        }

        changed = new Array();
        return false;
    }

    <?php loadreasons("edit", $strings); ?>
</SCRIPT>

<DIV width="100%" height="100%" style="overflow: auto;">
    <table class="table table-hover  table-striped table-bordered table-hover dataTable no-footer">
        <THEAD><TR>
        <?php
            if(isset($_GET["table"])){
                foreach($Columns as $ColumnName => $ColumnData){
                    echo '<TH class="nowrap">';
                    if($ColumnName == $PrimaryKey){echo '<i class="fa fa-key"></i>';}
                    echo $this->Paginator->sort($ColumnName) . '</TH>';
                }
                echo '</TR></THEAD><TBODY>';
                foreach($Data as $Row){
                    echo '<TR>';
                    $ID = "Data[" . $Row->$PrimaryKey . "]";
                    foreach($Columns as $ColumnName => $ColumnData) {
                        $Me = $ID . '[' . $ColumnName . ']';
                        $Type = "text";
                        echo '<TD style="padding: 0;" align="center">';
                        echo '<INPUT NAME="' . $Me . '" ID="' . $Me . '" VALUE="' . $Row->$ColumnName . '" CLASS="textinput" onchange="mychangeevent(' . "'" . $Me . "'" . ');"';
                        echo ' PLACEHOLDER="' . $ColumnName . "." . $Row->$PrimaryKey .'"';
                        switch($ColumnData["type"]){
                            case "string": break;
                            case "text": break;
                            case "boolean":
                                $Type="checkbox";
                                echo ' VALUE="True"';
                                if($Row->$ColumnName){ echo ' CHECKED';}
                            case "integer":
                                echo ' role="number"';
                                break;

                            default:
                                debug($ColumnData);
                                die();
                        }
                        echo 'TYPE="' . $Type . '"></TD>';
                    }
                    echo '</TR>';
                }
            } else {
                $Tables = $Manager->enum_tables();
                echo '<TH>Table</TH></TR></THEAD><TBODY>';
                foreach($Tables as $Table){
                    echo '<TR><TD><A HREF="?table=' . $Table . '">' . $Table . '</A></TD></TR>';
                }
            }
        ?>
        </TBODY>
    </table>
</DIV>