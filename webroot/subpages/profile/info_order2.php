<?php
if($this->request->session()->read('debug')) {echo "<span style ='color:red;'>subpages/profile/info_order2.php #INC???</span>";}

$intable = true;
$cols = 8;
$_this = $this;
function getcheckboxes($name, $amount) {
    $tempstr = "";
    for ($temp = 0; $temp < $amount; $temp += 1) {
        if (strlen($tempstr) > 0) {
            $tempstr .= "+','";
        }
        $tempstr .= "+Number($('#" . $name . $temp . "').val())";
    }
    return $tempstr;
}

function alert($Text){
    echo "<SCRIPT>alert('$Text');</SCRIPT>";
}

$productcount=iterator_count($products);
$tempstr = getcheckboxes("form", $productcount);

$driver = 0;
if (isset($_GET['driver'])) { $driver = $_GET['driver'];}

$client = 0;
if (isset($_GET['client'])) {$client = $_GET['client'];}

$dr_cl = $doc_comp->getDriverClient($driver, $client);

$counting = 0;
$drcl_c = $dr_cl['client'];
foreach ($drcl_c as $drclc) {
    $counting++;
}

function GET($name, $default = ""){
    if (isset($_GET[$name])) {
        return $_GET[$name];
    }
    return $default;
}

$ordertype = substr(strtoupper(GET("ordertype")), 0, 3);

function makeform($ordertype, $cols, $color, $Title, $Description, $products, $Disabled, $counting, $settings, $client, $dr_cl, $driver, $_this, $Otype ="", $inforequired = false, $Blocked = ""){
    if (strlen($Otype)==0) { $Otype = $Title; }
    if (strlen($color)>0){ $color = "-" . $color;}
    $color=""; //color is disabled for now

    echo '<div class="col-xs-' . $cols . ' col-xs-offset-2">';
    echo '<div class="pricing' . $color . ' hover-effect">';
    echo '<div class="pricing' . $color . '-head pricing-head-active">';
    echo '<h3>' . $Title . '<span>' . $Description . '</span></h3>';
    echo '<h4><!--i>$</i>999<i>.99</i> <span> One Time Payment </span--></h4></div>';

    printform($counting, $settings, $client, $dr_cl, $driver, true,$_this);

    echo '<ul class="pricing' . $color . '-content list-unstyled">';
    productslist($ordertype, $products, "form", $Disabled, $Blocked);

    $productcount=iterator_count($products);
    $tempstr = getcheckboxes("form", $productcount);

    echo '</ul><div class="pricing-footer"><p><hr/></p>';
    printbutton($ordertype, $_this->request->webroot, 3, $tempstr,$_this, $Otype, $inforequired);

    echo '</div></div></div>';
    return $Otype;
}

function showproduct($ordertype, $product, $Blocked){
    $num = $product->number;//do not use the ID number or the name
    if(is_array($Blocked)){
        return !in_array($num, $Blocked);
    }
    /*
    switch ($ordertype) {
        case "MEE":
            if ($num == 72 || $num == 32) {return false;} //Hide "Check DL" and social media search for Order MEE
            break;
        case "GEM":
            if ($num == 72) {return false;} //hide road test for GFS employee
            break;
    }
    */
    return true;
}

function productslist($ordertype, $products, $ID, $Checked = false, $Blocked = ""){
    if ($Checked) { $Checked = ' checked disabled';} else { $Checked = "";}
    $index=0;
    if($Blocked){$Blocked = explode(",", $Blocked);}
    echo '<DIV CLASS="PRODUCTLIST">';
    foreach ($products as $p) {
        if(showproduct($ordertype, $p, $Blocked)) {
            echo '<li id="product_' . $p->number . '"><div class="col-xs-10"><i class="fa fa-file-text-o"></i> ' . $p->title . '</div>';
            echo '<div class="col-xs-2"><input type="checkbox" value="' . $p->number . '" id="' . $ID . $index . '"' . $Checked . '/></div>';
            echo '<div class="clearfix"></div></li>';
        }
    }
    echo "</DIV>";
}

function printbutton($type, $webroot, $index, $tempstr = "",$_this, $o_type, $inforequired = true)
{
    if (strlen($type) > 0) {
        switch ($index) {
            case 3:
                $index = 1;
                break;
            case 4:
                $index = 5;
                break;
        }
    }
    switch ($index) {
        case 1:
            if (!$inforequired) {
                echo '<a href="javascript:void(0);" id="qua_btn" class="btn btn-danger  btn-lg placenow">Continue <i class="m-icon-swapright m-icon-white"></i></a>';
            } else {
                ?>
                

            <?php
            }
            break;
        case 2: ?>
            <a href="javascript:void(0);" class="btn btn-info" onclick="$('.alacarte').show(200);$('.placenow').attr('disabled','');">A La Carte<i class="m-icon-swapright m-icon-white"></i></a>
            <?php
            break;
        case 3:
            echo '<a href="#" class="btn red-flamingo"> Place Order <i class="m-icon-swapright m-icon-white"></i></a>';
            break;
        case 4:
            echo '<a href="#" class="btn yellow-crusta">Place Order <i class="m-icon-swapright m-icon-white"></i></a>';
            break;
        case 5:
            echo '<a class=" btn btn-danger btn-lg  button-next proceed" id="cart_btn" href="javascript:void(0)">';
            echo 'Continue <i class="m-icon-swapright m-icon-white"></i></a>';
            break;
    }
}

function printform($counting, $settings, $client, $dr_cl, $driver, $intable = false,$_this)
{//pass the variables exactly as given, then specifiy if it's in a table or not
    echo '<input type="hidden" name="document_type" value="add_driver"/>';
    echo '<div class="form-group clientsel">';
    $dodiv = false;
    if ($intable) {
        echo '<div class="row" style="margin-top: 15px;">';
        $size = "large";
    } else {
        $size = "xlarge";
    }
    $size = "ignore";

    echo '<div class="col-xs-3 control-label" align="right" style="margin-top: 6px;">Client</div><div class="col-xs-6">';

    $dodiv = true;?>

<script type="text/javascript">
    function reload(value) {
        var container = document.getElementById("selecting_driver");
        var was = container.value;
        container.value = value;  //THIS IS NOT WORKING!!!
        //this should set the select dropdown to "Create a Driver"
    }
</script>

<?php

    if ($counting > 1) { ?>
        <select id="selecting_client" class="form-control input-<?= $size ?> select2me"
        onoldchange="reload(-1);"
        data-placeholder="Select <?php echo ucfirst($settings->client) . '" ';
        if ($client) { ?><?php } ?>>
                        <option>None Selected</option><?php
    } else { ?>

                    <select id="selecting_client" class="form-control input-<?= $size; ?> select2me"
                            data-placeholder="Select <?php echo ucfirst($settings->client); ?>">
                        <?php
    }
    foreach ($dr_cl['client'] as $dr) {
        $client_id = $dr->id;
        ?>
        <option value="<?php echo $dr->id; ?>"
                <?php if ($dr->id == $client || $counting == 1){ ?>selected="selected"<?php } ?>><?php echo $dr->company_name; ?></option>
    <?php
    }
    ?>
</select>

<input class="selecting_client" type="hidden" value="<?php
    $printedclient="";
    if ($client) {$printedclient = $client;} else if ($counting == 1) {$printedclient = $client_id;}
    echo $printedclient . '"/></div></div>';

    if ($printedclient){
        //changelist("' . $_GET["ordertype"] . '", ' . $client_id . ');
        echo '<body onload="changelist(' . "'" . $_GET["ordertype"] . "', " .  $client_id . ');">';
    }

    if ($intable) {
        echo '</div>';
    }
?>

<div class="divisionsel form-group">
    <?php if ($counting == 1) $cl_count = 1; else {
    $cl_count = 0;
} ?>
</div>

<?php if ($intable) {
    echo '<div class="row" style="margin-top: 15px;margin-bottom: 15px;">';
} ?>
    <?php if(!isset($_GET['profiles'])){?>
<div class="form-group ">

    <?php
    echo '<div class="col-xs-3 control-label"  align="right" style="margin-top: 6px;">Driver</div><div class="col-xs-6" >';
    ?>

    <select class="form-control input-<?= $size ?> select2me"
            <?php if (!isset($_GET['ordertype']) || (isset($_GET['ordertype']) && $_GET['ordertype'] != "QUA")) { ?>data-placeholder="Create New Driver"<?php }?>
            id="selecting_driver" <?php if ($driver) { ?>disabled="disabled"<?php } ?>>
        <?php if (!isset($_GET['ordertype']) || (isset($_GET['ordertype']) && $_GET['ordertype'] != "QUA")) { ?>
    <option <? if ($driver == '0') {
        echo 'selected';
    } ?>>Select Driver
        </option><?php } else {
        ?>
        <option <? if ($driver == '0') {
            echo 'selected';
        } ?>>Select Driver
        </option>
    <?php
    }
    ?>
    <?php
    $counting = 0;
    $drcl_d = $dr_cl['driver'];
    foreach ($drcl_d as $drcld) {

        $counting++;
    }

    foreach ($dr_cl['driver'] as $dr) {

        $driver_id = $dr->id;
        ?>
        <option value="<?php echo $dr->id; ?>"
                <?php if ($dr->id == $driver || $counting == 1 && $driver != '0'){ ?>selected="selected"<?php } ?>><?php echo $dr->fname . ' ' . $dr->mname . ' ' . $dr->lname ?></option>
    <?php
    }
    ?>
    </select>
    
    <input class="selecting_driver" type="hidden" value="<?php if ($driver) {
        echo $driver;
    }?>"/>
    </div>
    <?php

    if ($settings->profile_create == '1') echo "<div class='col-xs-3 ' style='margin-left: -20px;'>or&nbsp;&nbsp;<a href='" . $_this->request->webroot . "profiles/add' class='btn grey-steel '>Add Driver</a></div>";?>

    </div>
    <?php
    if ($intable) {
        echo "</div>";
    }
}
} ?>



<div class="row">
    <?php

    $o_type = makeform($product->Acronym, $cols, '', $product->Name, $product->Description, $products, $product->Checked == 1, $counting, $settings, $client, $dr_cl, $driver, $_this, $product->Alias, false, $product->Blocked);

    /*
    if ($ordertype == "MEE") {
        $o_type = makeform("MEE", $cols, "red", "Order MEE", "The all in one package", $products, true, $counting, $settings, $client, $dr_cl, $driver, $_this);
    }
    if ($ordertype == "CAR") {
        $o_type = makeform("CAR", $cols, "", "Order Products", "Place an Order A La Carte", $products, false, $counting, $settings, $client, $dr_cl, $driver, $_this);
    }
    if ($ordertype == "QUA") {
        $o_type = makeform("QUA", $cols, "blue", "Requalify", "Requalify existing drivers", $products, false, $counting, $settings, $client, $dr_cl, $driver, $_this, "Requalification", false);
    }
    */

    ?>
</div>

<script>
    function changelist(Ordertype, ClientID){
        //PRODUCTLIST
        $.ajax({
            url: "<?php echo $this->request->webroot;?>clients/quickcontact",
            type: "post",
            dataType: "HTML",
            data: "Type=generateHTML&ClientID=" + ClientID + "&Ordertype=" + Ordertype,
            success: function (msg) {
                $('.PRODUCTLIST').html(msg);
            }
        })
    }

    function getcheckboxes(){
        var tempstr = '';
        $('input[type="checkbox"]').each(function () {
            if ($(this).is(':checked')){
                if (tempstr.length==0) { tempstr = $(this).val();} else {tempstr = tempstr + "," + $(this).val();}
            }
        });
        return tempstr;
    }

    function check_driver_abstract(driver) {
        
    }
    function check_cvor(driver) {
        
    }
    function check_div() {
        //alert('test');
        var checkerbox = 0;
        $('input[type="checkbox"]').each(function () {
            if ($(this).is(':checked'))
                checkerbox = 1;
        });
        if (checkerbox == 0) {
            alert('Please select at least one product');
            return false;
        }
        var checker = 0;
        $('.divisionsel select').each(function () {
            checker++;
        });
        if (checker > 0) {

            if (!$('.divisionsel select').val()) {
                $('.divisionsel select').attr('style', 'border:1px solid red;');
                return false;
            }
            return true;
        }
        else
            return true;

    }
    $(function () {
        <?php
        if($driver)
        {
            ?>
        check_driver_abstract(<?php echo $driver;?>);
        check_cvor(<?php echo $driver;?>);
        <?php
    }
    ?>

        $('#qua_btn').click(function () {
            if (!check_div()){ return false;}

            var div = $('#divisionsel').val();
            if (!isNaN(parseFloat(div)) && isFinite(div)) {
                var division = div;
            } else {
                var division = '0';
            }
            if ($('.selecting_client').val()) {
                <?php if(!isset($_GET['profiles'])){?>
                    if ($('.selecting_driver').val() == '') {
                        alert('Please select driver.');
                        $('#s2id_selecting_driver .select2-choice').attr('style', 'border:1px solid red;');
                        $('html,body').animate({scrollTop: $('#s2id_selecting_driver .select2-choice').offset().top}, 'slow');
                        return false;
                    } else {
                        var tempstr = getcheckboxes();
                        window.location = '<?php echo $this->request->webroot; ?>orders/addorder/' + $('.selecting_client').val() + '/?driver=' + $('.selecting_driver').val() + '&division=' + division + '&order_type=<?php echo urlencode($o_type);?>&forms=' + tempstr;
                    }
                <?php } else {?>
                var tempstr = getcheckboxes();
                window.location = '<?php echo $this->request->webroot; ?>orders/addorder/' + $('.selecting_client').val() + '/?driver=<?php echo $_GET['profiles'];?>&division=' + division + '&order_type=<?php echo urlencode($o_type);?>&forms=' + tempstr;
                <?php
                }?>
            }
            else {
                $('#s2id_selecting_client .select2-choice').attr('style', 'border:1px solid red;');
                $('html,body').animate({scrollTop: $('#s2id_selecting_client .select2-choice').offset().top}, 'slow');
            }


        });

        $('#divisionsel').live('change', function () {
            $(this).removeAttr('style');
        });
        if ($('.selecting_client').val()) {
            var client = $('#selecting_client').val();
            if (!isNaN(parseFloat(client)) && isFinite(client)) {
                $('.selecting_client').val(client);
                //alert(client);
                $.ajax({
                    url: '<?php echo $this->request->webroot;?>clients/divisionDropDown/' + client,
                    data: {istable: '<?= $intable; ?>'},
                    success: function (response) {
                        $('.divisionsel').html(response);
                    }
                });
            }
        }
        $('#selecting_driver').change(function () {
            $('#s2id_selecting_driver .select2-chosen-2').removeAttr('style');
            var driver = $('#selecting_driver').val();
            //alert(driver);
            if (!isNaN(parseFloat(driver)) && isFinite(driver)) {
                $('.selecting_driver').val(driver);
                check_driver_abstract(driver);
                check_cvor(driver);
            }
            else {
                $('.selecting_driver').val('');
                return false;
            }
        });

        $('#selecting_client').change(function () {
            $('s2id_selecting_client.select2-choice').removeAttr('style');
            <?php
                echo 'var ordertype = "' . $_GET['ordertype']. '";';
                if(!$_GET['driver']){
                    if(!isset($_GET['ordertype']) || (isset($_GET['ordertype']) && $_GET['ordertype']!='QUA')){
                        ?>
            $('#s2id_selecting_driver .select2-chosen').html('Select Driver');
            <?php }else { ?>
            $('#s2id_selecting_driver .select2-chosen').html('Select Driver');
            <?php
            }}
            ?>
            var client = $('#selecting_client').val();
            if (!isNaN(parseFloat(client)) && isFinite(client)) {
                $('.selecting_client').val(client);
                changelist(ordertype, client);
                <?php
                if(!$_GET['driver'])
                {
                ?>
                $.ajax({
                    url: '<?php echo $this->request->webroot;?>clients/divisionDropDown/' + client,
                    data: {istable: '<?= $intable; ?>'},
                    success: function (response) {
                        $('.divisionsel').html(response);
                    }
                });
                <?php }?>
            }
            else {
                $('.selecting_client').val('');
                return false;
            }

            <?php

        if(!$driver)
        {
            ?>
            $.ajax({
                url: '<?php echo $this->request->webroot;?>orders/getDriverByClient/' + client + '?ordertype=<?php if(isset($_GET['ordertype']))echo $_GET['ordertype']?>',
                success: function (res) {
                    var div = $('#divisionsel').val();
                    if (!isNaN(parseFloat(div)) && isFinite(div)) {
                        var division = div;
                    }
                    else
                        var division = '0';
                    $('#selecting_driver').html(res);
                    $('.selecting_client').val($('#selecting_client').val());
                }
            });
            <?php
       }
       ?>
            $('#s2id_selecting_driver .select2-chosen-2').removeAttr('style');
        });
    });
</script>
