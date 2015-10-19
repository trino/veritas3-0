<?php
    $CRLF = "\r\n";
    $Clients = $Manager->enum_all("clients");//, array("requalify" => 1));
    $products = $Manager->enum_all("order_products");
    $settings = $this->requestAction('settings/get_settings');
    $sidebar =$this->requestAction("settings/all_settings/".$this->Session->read('Profile.id')."/sidebar");
    include_once('subpages/api.php');
    $language = $this->request->session()->read('Profile.language');
    $strings = CacheTranslations($language, $this->request->params['controller'] . "_%",$settings);

    function pluralize($Quantity, $Word, $Append = "s"){
        if($Quantity == 1){ return $Word;}
        return $Word . $Append;
    }

    function productname($products, $number, $language){
        $product = getIterator($products, "number", $number);
        $title = getFieldname("title", $language);
        $title = $product->$title;
        if ($language == "Debug"){ $title.= " [Trans]";}
        return $title . " #" . $number;
    }
    function printproducts($Client, $r, $products, $numbers, $language){
        $hasprinted=false;
        if(!is_array($r)){$r = explode(',',$r);}
        foreach($numbers as $number){
            if($hasprinted) { echo "&nbsp;&nbsp;"; }
            echo '<label><input type="checkbox" id="p' . $number . '"';
            if(in_array($number,$r)) {echo " checked";}
            echo ' name="requalify_product[' . $Client . '][' . $number. ']" value="1">';
            echo productname($products, $number, $language) . "</label>";
            $hasprinted=true;
        }
    }

    if($_POST){
        foreach($_POST["requalify_product"] as $Key => $Product){
            $_POST["requalify_product"][$Key] = implode(",", array_keys($Product));
        }
        foreach($_POST as $Key => $TheClients){
            foreach($TheClients as $ID => $Value){
                //echo "SET " . $Key . " to " . $Value . " WHERE id = " . $ID . '<BR>';
                $Manager->update_database("clients", "id", $ID, array($Key => $Value));
            }
        }
        //debug($_POST);
    }
?>
<h3 class="page-title">
    CRON
</h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="<?= $this->request->webroot . '">' . $strings["dashboard_dashboard"] ?></a>
						<i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="">CRON</a>
        </li>
    </ul>
    <a href="javascript:window.print();" class="floatright btn btn-info"><?= $strings["dashboard_print"]; ?></a>
    <a class="floatright btn btn-warning btnspc" href="<?= $this->request->webroot; ?>profiles/cron/true">Run the CRON </a>
</div>

<FORM METHOD="post">
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box yellow">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-clipboard"></i>
                        Clients
                    </div>
                </div>
                <div class="portlet-body form">
                    <div class="form-actions top chat-form" style="margin-bottom:0;" align="right">
                        <div class="btn-set pull-left">

                        </div>
                        <div class="btn-set pull-right">
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="form-body">
                        <div class="table-scrollable">
                            <table class="table table-condensed table-striped table-bordered table-hover dataTable no-footer">
                                <thead>
                                    <tr class="sorting">
                                        <th><?= $this->Paginator->sort('id', "ID"); ?></th>
                                        <th><?= $this->Paginator->sort('company_name', "Name"); ?></th>
                                        <th><?= $this->Paginator->sort('requalify', "On"); ?></th>
                                        <th><?= $this->Paginator->sort('requalify_frequency', "Frequency"); ?></th>
                                        <th>When</th>
                                        <th>Products</th>
                                        <TH title="Number of profiles with requalify enabled / total number of profiles in this client">Profiles</TH>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $Frequencies = array(1,3,6,12);
                                        foreach($Clients as $Client){
                                            $Users = $Manager->enum_all("profiles", array('id IN('.$Client->profile_id.')', "requalify" => 1));
                                            echo '<TR>' . $CRLF;
                                            echo '<TD>' . $Client->id . '</TD>' . $CRLF;
                                            echo '<TD><A HREF="' . $this->request->webroot . 'profiles/index?&filter_by_client=' . $Client->id . '" TARGET="_blank">' . $Client->company_name . '</A></TD>' . $CRLF;
                                            echo '<TD><LABEL><INPUT TYPE="checkbox" name="requalify[' . $Client->id . ']" value="1"';
                                            if($Client->requalify){echo ' CHECKED';}
                                            echo '></LABEL></TD>';
                                            echo '<TD><SELECT ID="freq' . $Client->id . '" NAME="requalify_frequency[' . $Client->id . ']">';
                                            foreach($Frequencies as $Frequency){
                                                echo '<OPTION VALUE="' . $Frequency . '"';
                                                if ($Frequency==$Client->requalify_frequency){ echo ' SELECTED';}
                                                echo '>' . $Frequency .  pluralize($Frequency, ' Month') . '</OPTION>';
                                            }
                                            echo '</SELECT></TD><TD><LABEL><INPUT TYPE="CHECKBOX" value="1" id="check_when' . $Client->id . '" ONCLICK="when(' . $Client->id . ');" NAME="requalify_re[' . $Client->id . ']"';
                                                if($Client->requalify_re){ echo " CHECKED";}
                                                echo '>&nbsp;<SPAN ID="span_when' . $Client->id . '"';
                                                if(!$Client->requalify_re){ echo ' STYLE="display: none;"';}
                                                if(!$Client->requalify_date){$Client->requalify_date = date("Y-m-d");}
                                                echo '>Anniversary</SPAN></LABEL><INPUT TYPE="TEXT" NAME="requalify_date[' . $Client->id . ']" ID="text_when' . $Client->id . '" class="datepicker date-picker" value="' .  $Client->requalify_date . '"';
                                                if($Client->requalify_re){ echo ' STYLE="display: none;"';}
                                            echo '></TD><TD>';
                                            printproducts($Client->id, $Client->requalify_product, $products, array(1, 14, 72), $language);
                                            echo '</TD><TD align="RIGHT">';
                                            echo iterator_count($Users) . '/' . count(explode(",", $Client->profile_id));
                                            echo '</TD></TR>';
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="form-actions" style="height:75px;">
                        <div class="row">
                            <div class="col-md-12" align="right">
                                <button type="submit" class="btn btn-primary" >
                                    Save Changes <i class="m-icon-swapright m-icon-white"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</FORM>
<SCRIPT>
    function when(ClientID){
        var checked = getinputvalue("check_when" + ClientID);
        visible("span_when" + ClientID, checked);
        visible("text_when" + ClientID, !checked);
    }

    function visible(ID, Status){
        var element = document.getElementById(ID);
        if(Status){
            element.style.display = '';
        } else {
            element.style.display = 'none';
        }
    }
</SCRIPT>