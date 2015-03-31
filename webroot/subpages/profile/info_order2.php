<?php
    if ($_GET['ordertype'] == 'MEE') {
        $o_type = 'Order MEE';
    } else
        if ($_GET['ordertype'] == 'CART') {
            $o_type = 'Order Products';
        } else
            $o_type = 'QUA';
    $intable = true;
    $cols = 8;
    $_this = $this;
    function getcheckboxes($name, $amount)
    {
        $tempstr = "";
        for ($temp = 0; $temp < $amount; $temp += 1) {
            if (strlen($tempstr) > 0) {
                $tempstr .= "+','";
            }
            $tempstr .= "+Number($('#" . $name . $temp . "').prop('checked'))";
        }
        return $tempstr;
    }

    $tempstr = getcheckboxes("form", 8);
    $tempstr2 = getcheckboxes("formb", 8);

    $driver = 0;
    if (isset($_GET['driver'])) {
        $driver = $_GET['driver'];
    }

    $client = 0;
    if (isset($_GET['client'])) {
        $client = $_GET['client'];
    }

    $dr_cl = $doc_comp->getDriverClient($driver, $client);

    $counting = 0;
    $drcl_c = $dr_cl['client'];
    foreach ($drcl_c as $drclc) {
        $counting++;
    }

    function GET($name, $default = "")
    {
        if (isset($_GET[$name])) {
            return $_GET[$name];
        }
        return $default;
    }

    $ordertype = strtoupper(GET("ordertype"));
    if (strlen($ordertype) == 0) {
        $intable = false;
        $cols = 6;
    } else {
        $ordertype = substr($ordertype, 0, 3);
    }

    function printbutton($type, $webroot, $index, $tempstr = "",$_this)
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
                if ($type == 'QUA') {
                    ?>
                    <a href="javascript:void(0);" id="qua_btn" class="btn btn-danger  btn-lg placenow">Continue <i
                            class="m-icon-swapright m-icon-white"></i></a>
                <?php
                } else {
                    if ($type == 'MEE') {
                        $o_type = 'Order MEE';
                    } else {
                        $o_type = 'Order Products';
                    }
                    ?>
                    <a href="javascript:void(0);" class="btn btn-danger btn-lg placenow"
                       onclick="if(!check_div())return false;var div = $('#divisionsel').val();if(!isNaN(parseFloat(div)) && isFinite(div)){var division = div;}else var division = '0';if($('.selecting_client').val()){if($('.selecting_driver').val()==''){alert('Please select driver');$('#s2id_selecting_driver .select2-choice').attr('style','border:1px solid red;');$('html,body').animate({scrollTop: $('#s2id_selecting_driver .select2-choice').offset().top},'slow');return false;}else window.location='<?php echo $webroot; ?>orders/addorder/'+$('.selecting_client').val()+'/?driver='+$('.selecting_driver').val()+'&division='+division+'&forms=<?php echo $_this->requestAction('orders/getProNum');?>&order_type=<?php echo urlencode($o_type); ?>';}else{$('#s2id_selecting_client .select2-choice').attr('style','border:1px solid red;');$('html,body').animate({scrollTop: $('#s2id_selecting_client .select2-choice').offset().top},'slow');}">Continue
                        <i class="m-icon-swapright m-icon-white"></i></a>

                <?php
                }
                break;
            case 2: ?>
                <a href="javascript:void(0);" class="btn btn-info"
                   onclick="$('.alacarte').show(200);$('.placenow').attr('disabled','');">A La Carte
                    <i class="m-icon-swapright m-icon-white"></i></a>
                <?php
                break;
            case 3:
                echo '<a href="#" class="btn red-flamingo"> Place Order <i class="m-icon-swapright m-icon-white"></i></a>';
                break;
            case 4:
                echo '<a href="#" class="btn yellow-crusta">Place Order <i class="m-icon-swapright m-icon-white"></i></a>';
                break;
            case 5:
                if ($type == 'MEE') {
                    $o_type = 'Order MEE';
                } else {
                    $o_type = 'Order Products';
                }
                ?>

                <a class=" btn btn-danger   btn-lg  button-next proceed" id="cart_btn"
                   href="javascript:void(0)">
                    Continue <i class="m-icon-swapright m-icon-white"></i>
                </a>

            <?php
        }
    }

    function printform($counting, $settings, $client, $dr_cl, $driver, $intable = false)
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

<input class="selecting_client" type="hidden"
       value="<?php if ($client) echo $client; else if ($counting == 1) echo $client_id; ?>"/>
</div></div>

<?php if ($intable) {
        echo '</div>';
    } ?>

<div class="divisionsel form-group">
    <?php if ($counting == 1) $cl_count = 1; else {
        $cl_count = 0;
    } ?>
</div>

<?php if ($intable) {
        echo '<div class="row" style="margin-top: 15px;margin-bottom: 15px;">';
    } ?>

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

        if ($settings->profile_create == '1') echo "<div class='col-xs-3 ' style='margin-left: -20px;'>or&nbsp;&nbsp;<a href='http://localhost/veritas3/profiles/add' class='btn grey-steel '>Add Driver</a></div>";?>

    </div>
    <?php
        if ($intable) {
            echo "</div>";
        }
    } ?>

<div class=" portlet-body">

    <div class="createDriver">
        <div class="portlet box form-horizontal">

            <?php
                if ($driver && !$client && $counting == 0) {
                    echo '<div class="alert alert-danger"><strong>Error!</strong> This driver is not assigned to a client. <A href="' . $this->request->webroot . 'profiles/edit/' . $driver . '">Click here to assign them to one</A></div>';
                }
            ?>

            <?php if (!$intable) {
                printform($counting, $settings, $client, $dr_cl, $driver);
            } ?>

            <div class="">
                <div class="col-xs-offset-3 col-xs-9">
                    <?php
                        if ($ordertype == "") {
                            printbutton($ordertype, $this->request->webroot, 1, $tempstr,$_this);
                            echo "&nbsp;&nbsp; or &nbsp;&nbsp";
                            printbutton($ordertype, $this->request->webroot, 2, $tempstr,$_this);
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <?php
        $offset = $cols;
        if ($ordertype == "" || $ordertype == "MEE") {
            if ($ordertype != "") {
                $offset .= " col-xs-offset-2";
            }
            ?>
            <div class="col-xs-<?= $offset ?>">

                <div class="pricing-red  hover-effect">
                    <div class="pricing-red-head pricing-head-active">
                        <h3>Order MEE <span>
											The all in one package </span>
                        </h3>
                        <h4><!--i>$</i>999<i>.99</i> <span> One Time Payment </span-->
                        </h4>
                    </div>

                    <?php if ($intable) {
                        printform($counting, $settings, $client, $dr_cl, $driver, true);
                    } ?>

                    <ul class="pricing-red-content list-unstyled">
                        <?php
                            foreach ($products as $p) {
                                if ($p->id != 8) {
                                    ?>

                                    <li id="product_<?php echo $p->number; ?>">
                                        <div class="col-xs-10"><i
                                                class="fa fa-file-text-o"></i> <?php echo $p->title; ?>
                                        </div>
                                        <div class="col-xs-2"><input checked disabled="disabled" type="checkbox"
                                                                     value="<?php echo $p->number; ?>"/></div>
                                        <div class="clearfix"></div>
                                    </li>
                                <?php
                                }
                            }
                        ?>


                    </ul>
                    <div class="pricing-footer">
                        <p>
                        <hr/>
                        </p>
                        <?php printbutton($ordertype, $this->request->webroot, 3, $tempstr,$_this); ?>

                    </div>
                </div>
            </div>
        <?php }

        $offset = $cols;
        if ($ordertype == "" || $ordertype == "CAR") {
            if ($ordertype != "") {
                $offset .= " col-xs-offset-2";
            }

            ?>
            <div class="col-xs-<?= $offset; ?>">
                <div class="pricing hover-effect">
                    <div class="pricing-head">
                        <h3>Order Products <span>
											Place an Order A La Carte </span>
                        </h3>
                        <h4><!--i>$</i>999<i>.99+</i><span>	(Starting At) </span-->
                        </h4>
                    </div>

                    <?php if ($intable) {
                        printform($counting, $settings, $client, $dr_cl, $driver, true);
                    } ?>

                    <ul class="pricing-content list-unstyled" id="cartlist">
                        <?php
                            $index = 0;
                            foreach ($products as $p) {

                                ?>
                                <li id="product_<?php echo $p->number; ?>">

                                    <div class="col-xs-10"><i class="fa fa-file-text-o"></i> <?php echo $p->title; ?>
                                    </div>
                                    <div class="col-xs-2"><input checked type="checkbox" id="form<?= $index ?>"
                                                                 value="<?php echo $p->number; ?>"/></div>
                                    <div class="clearfix"></div>
                                </li>
                                <?php
                                $index += 1;
                            }
                        ?>

                    </ul>
                    <div class="pricing-footer">
                        <p>
                        <hr/>
                        </p>
                        <?php printbutton($ordertype, $this->request->webroot, 4, $tempstr,$_this); ?>
                    </div>
                </div>
            </div>
        <?php }

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $offset = $cols;
        if ($ordertype == "QUA") {
            if ($ordertype != "") {
                $offset .= " col-xs-offset-2";
            }
            ?>

            <div class="col-xs-<?= $offset ?>">
                <div class="pricing-blue hover-effect">
                    <div class="pricing-blue-head pricing-head-active">
                        <h3>Requalify <span>Requalify existing drivers </span>
                        </h3>
                        <h4><!--i>$</i>999<i>.99</i>
											<span>
											One Time Payment </span-->
                        </h4>
                    </div>

                    <?php if ($intable) {
                        printform($counting, $settings, $client, $dr_cl, $driver, true);
                    } ?>

                    <ul class="pricing-blue-content list-unstyled" id="qualist">
                        <?php
                            $b = 0;
                            foreach ($products as $p) {
                                ?>
                                <li id="product_<?php echo $p->number; ?>">

                                    <div class="col-xs-10"><i class="fa fa-file-text-o"></i> <?php echo $p->title; ?>
                                    </div>
                                    <div class="col-xs-2"><input checked type="checkbox" name="prem_nat"
                                                                 id="formb<?php echo $b; ?>"
                                                                 value="<?php echo $p->number; ?>"/></div>
                                    <div class="clearfix"></div>
                                </li>
                                <?php
                                $b++;
                            }
                        ?>
                    </ul>
                    <div class="pricing-footer">
                        <p>
                        <hr/>
                        </p>
                        <?php printbutton($ordertype, $this->request->webroot, 3, $tempstr2,$_this); ?>

                    </div>
                </div>
            </div>
        <?php }


        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    ?>
    <!--//End Pricing -->
</div>

<script>
    function check_driver_abstract(driver) {
        /*$.ajax({
         url:'
        <?php echo $this->request->webroot;?>orders/check_driver_abstract/'+driver,
         success:function(res)
         {
         if(res=='0')
         {
         if($('#product_2 input[type="checkbox"]').is(':checked'))
         {
         $('#product_2 input[type="checkbox"]').click();
         }
         $('#product_2').hide();
         }
         else
         {
         if(!$('#product_2 input[type="checkbox"]').is(':checked'))
         {
         $('#product_2 input[type="checkbox"]').click();
         }
         $('#product_2').show();
         }
         }
         });*/
    }
    function check_cvor(driver) {
        /*$.ajax({
         url:'
        <?php echo $this->request->webroot;?>orders/check_cvor/'+driver,
         success:function(res)
         {
         if(res=='0')
         {
         if($('#product_3 input[type="checkbox"]').is(':checked'))
         {
         $('#product_3 input[type="checkbox"]').click();
         }
         $('#product_3').hide();
         }
         else
         {
         if(!$('#product_3 input[type="checkbox"]').is(':checked'))
         {
         $('#product_3 input[type="checkbox"]').click();
         }
         $('#product_3').show();
         }
         }
         });*/
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
        $('#cart_btn').click(function () {
            if (!check_div())
                return false;

            var div = $('#divisionsel').val();
            if (!isNaN(parseFloat(div)) && isFinite(div)) {
                var division = div;
            }
            else
                var division = '0';
            if ($('.selecting_client').val()) {
                if ($('.selecting_driver').val() == '') {
                    alert('Please select driver');
                    $('#s2id_selecting_driver .select2-choice').attr('style', 'border:1px solid red;');
                    $('html,body').animate({scrollTop: $('#s2id_selecting_driver .select2-choice').offset().top}, 'slow');
                    return false;
                } else {
                    var tempstr = '';
                    $('#cartlist input[type="checkbox"]').each(function () {

                        if ($(this).is(':checked')) {
                            if (tempstr == '') {
                                tempstr = $(this).val();
                            }
                            else
                                tempstr = tempstr + ',' + $(this).val();
                        }
                    });
                    window.location = '<?php echo $this->request->webroot; ?>orders/addorder/' + $('.selecting_client').val() + '/?driver=' + $('.selecting_driver').val() + '&division=' + division + '&order_type=<?php echo urlencode($o_type);?>&forms=' + tempstr;
                }
            }
            else {
                $('#s2id_selecting_client .select2-choice').attr('style', 'border:1px solid red;');
                $('html,body').animate({scrollTop: $('#s2id_selecting_client .select2-choice').offset().top}, 'slow');
            }

        });

        $('#qua_btn').click(function () {
            if (!check_div())
                return false;

            var div = $('#divisionsel').val();
            if (!isNaN(parseFloat(div)) && isFinite(div)) {
                var division = div;
            }
            else
                var division = '0';
            if ($('.selecting_client').val()) {
                if ($('.selecting_driver').val() == '') {
                    alert('Please select driver.');
                    $('#s2id_selecting_driver .select2-choice').attr('style', 'border:1px solid red;');
                    $('html,body').animate({scrollTop: $('#s2id_selecting_driver .select2-choice').offset().top}, 'slow');
                    return false;
                }
                else {
                    var tempstr = '';
                    $('#qualist input[type="checkbox"]').each(function () {

                        if ($(this).is(':checked')) {
                            if (tempstr == '') {
                                tempstr = $(this).val();
                            }
                            else
                                tempstr = tempstr + ',' + $(this).val();
                        }
                    });
                    window.location = '<?php echo $this->request->webroot; ?>orders/addorder/' + $('.selecting_client').val() + '/?driver=' + $('.selecting_driver').val() + '&division=' + division + '&order_type=Requalification&forms=' + tempstr;
                }
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
            if(!isset($_GET['ordertype']) || (isset($_GET['ordertype']) && $_GET['ordertype']!='QUA'))
            {
                ?>

            $('#s2id_selecting_driver .select2-chosen').html('Select Driver');
            <?php
            }
            else
            {?>
            $('#s2id_selecting_driver .select2-chosen').html('Select Driver');
            <?php
            }
            ?>
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
