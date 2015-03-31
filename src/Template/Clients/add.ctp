<!-- BEGIN PAGE LEVEL STYLES -->
<link href="../../assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/admin/pages/css/portfolio.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL STYLES -->

<?php
    include_once 'subpages/filelist.php';
    $delete = isset($disabled);
    $is_disabled = '';
    if (isset($disabled)) {
        $is_disabled = 'disabled="disabled"';
    }
    if (isset($client)) {
        $c = $client;
    }

    $settings = $this->requestAction('settings/get_settings');
    $sidebar = $this->requestAction("settings/all_settings/" . $this->request->session()->read('Profile.id') . "/sidebar");
    $getprofile = $this->requestAction('clients/getProfile/' . $id);
    $getcontact = $this->requestAction('clients/getContact/' . $id);
    $param = $this->request->params['action'];

    $action = ucfirst($param);
    if (isset($_GET["view"])) {
        $action = "View";
    }
    if ($action == "Add") {
        $action = "Create";
    }

?>

<h3 class="page-title">
    <?php echo $action . " " . ucfirst($settings->client); ?>
</h3>

<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="<?php echo $this->request->webroot; ?>">Dashboard</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href=""><?php echo $action . " " . ucfirst($settings->client); ?></a>
        </li>
    </ul>
    <!--a href="javascript:window.print();" class="floatright btn btn-info">Print</a-->
    <?php
        if (isset($disabled) || isset($_GET['view'])) { ?>
            <a href="javascript:window.print();" class="floatright btn btn-info">Print</a>
        <?php }

        if (isset($client) && $sidebar->client_delete == '1' && $param != 'add') { ?>
            <a href="<?php echo $this->request->webroot; ?>clients/delete/<?php echo $client->id; ?><?php echo (isset($_GET['draft'])) ? "?draft" : ""; ?>"
               onclick="return confirm('Are you sure you want to delete <?= h($client->company_name) ?>?');"
               class="floatright btn btn-danger btnspc">Delete</a>
        <?php }
        if (isset($client) && $sidebar->client_edit == '1' && isset($_GET['view'])) {
            echo $this->Html->link(__('Edit'), ['controller' => 'clients', 'action' => 'edit', $client->id], ['class' => 'floatright btn btn-primary btnspc']);
        } else if (isset($client) && $param == 'edit') {
            ?>
            <a href="<?php echo $this->request->webroot; ?>clients/edit/<?php echo $client->id; ?>?view"
               class='floatright btn btn-info btnspc'>View</a>
        <?php

        }

        echo "</div>";
    ?>

    <div class="row ">
        <div class="col-md-12">
            <!-- BEGIN SAMPLE FORM PORTLET-->

            <div class="row profile-account">
                <div class="col-md-3" align="center">
                    <?php
                        if (isset($client->image) && $client->image) {
                            ?>
                            <img class="img-responsive" id="clientpic" alt=""
                                 src="<?php echo $this->request->webroot; ?>img/jobs/<?php echo $client->image; ?>"/>
                        <?php
                        } else {
                            ?>
                            <img class="img-responsive" id="clientpic" alt=""
                                 src="<?php echo $this->request->webroot; ?>img/logos/MEELogo.png"/>
                        <?php
                        }
                    ?>

                    <div class="form-group">
                        <label class="sr-only" for="exampleInputEmail22">Add/Edit Image</label>

                        <div class="input-icon">
                            <a class="btn btn-xs btn-success" href="javascript:void(0)" id="clientimg">
                                <i class="fa fa-image"></i>
                                Add/Edit Image
                            </a>

                        </div>
                    </div>

                    <!--php  if (isset($client_docs)) { listfiles($client_docs, "img/jobs/",'client_doc',$delete,  2); } ?-->

                </div>

                <div class="col-md-9">


                    <div class="clearfix"></div>

                    <div class="portlet box grey-salsa">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-briefcase"></i><?php echo ucfirst($settings->client); ?> Manager
                            </div>
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#tab_1_1" data-toggle="tab">Info</a>
                                </li>
                                <?php if ($this->request['action'] != "add" && !isset($_GET['view'])) {
                                    ?>

                                    <li>
                                        <a href="#tab_1_2" data-toggle="tab">Display</a>
                                    </li>

                                <?php

                                } ?>
                                <li>
                                    <a href="#tab_1_3"
                                       data-toggle="tab"><?php echo (!isset($_GET['view'])) ? "Assign to Profile" : "Assigned To"; ?></a>
                                </li>

                            </UL>
                        </div>

                        <div class="portlet-body form">
                            <div class="form-body" style="padding-bottom: 0px;">
                                <div class="tab-content">
                                    <?php

                                        if (!isset($_GET['activedisplay']))
                                        {
                                    ?>
                                    <div class="tab-pane active" id="tab_1_1">
                                        <div id="tab_1_1" class="tab-pane active">
                                            <?php
                                                }
                                                else
                                                {
                                            ?>
                                            <div class="tab-pane" id="tab_1_1">
                                                <div id="tab_1_1" class="tab-pane">
                                                    <?php
                                                        }
                                                    ?>
                                                    <form role="form" action="" method="post" id="client_form"
                                                          class="save_client_all">
                                                        <input type="hidden" name="drafts" id="client_drafts"
                                                               value="0"/>

                                                        <div class="row">
                                                            <input type="hidden" name="image" id="client_img"/>
                                                            <?php if ($settings->client_option == 0) { ?>
                                                                <div class="form-group col-md-4">
                                                                    <label class="control-label">Customer Type</label>
                                                                    <select class="form-control" name="customer_type"
                                                                            id="customer_type">
                                                                        <option value="">Select</option>
                                                                        <?php
                                                                            $ctyp = $this->requestAction('profiles/gettypes/ctypes/' . $this->request->session()->read('Profile.id'));
                                                                            if ($ctyp != "")
                                                                                $cts = explode(",", $ctyp);
                                                                            foreach ($client_types as $ct) {
                                                                                if (isset($cts)) {
                                                                                    if (in_array($ct->id, $cts)) {
                                                                                        ?>
                                                                                        <option
                                                                                            value="<?php echo $ct->id;?>"
                                                                                            <?php if (isset($client->customer_type) && $client->customer_type == $ct->id) { ?>selected="selected"<?php } ?>>
                                                                                            <?php echo $ct->title; ?>
                                                                                        </option>
                                                                                    <?php
                                                                                    }
                                                                                } else {
                                                                                    ?>
                                                                                    <option
                                                                                        value="<?php echo $ct->id;?>"
                                                                                        <?php if (isset($client->customer_type) && $client->customer_type == $ct->id) { ?>selected="selected"<?php } ?>>
                                                                                        <?php echo $ct->title; ?>
                                                                                    </option>
                                                                                <?php
                                                                                }
                                                                            }
                                                                        ?>

                                                                        <!--
                                                        <option value="1"
                                                                <?php if (isset($client->customer_type) && $client->customer_type == 1) { ?>selected="selected"<?php } ?>>
                                                            Insurance
                                                        </option>
                                                        <option value="2"
                                                                <?php if (isset($client->customer_type) && $client->customer_type == 2) { ?>selected="selected"<?php } ?>>
                                                            Fleet
                                                        </option>
                                                        <option value="3"
                                                                <?php if (isset($client->customer_type) && $client->customer_type == 3) { ?>selected="selected"<?php } ?>>
                                                            Non Fleet
                                                        </option>-->
                                                                    </select>
                                                                </div>
                                                            <?php } ?>
                                                            <div class="form-group col-md-4">
                                                                <label
                                                                    class="control-label"> <?php echo ($settings->client_option == 0) ? "Company" : "Event"; ?>
                                                                    Name</label>
                                                                <input required="required" type="text"
                                                                       class="form-control"
                                                                       name="company_name" <?php if (isset($client->company_name)) { ?> value="<?php echo $client->company_name; ?>" <?php } ?>/>
                                                            </div>

                                                            <?php if ($settings->client_option == 0) { ?>
                                                                <div class="form-group col-md-4">
                                                                    <label class="control-label">Address</label>
                                                                    <input type="text" class="form-control"
                                                                           name="company_address" <?php if (isset($client->billing_address)) { ?> value="<?php echo $client->billing_address; ?>" <?php } ?>/>
                                                                </div>
                                                            <?php } ?>
                                                            <div class="form-group col-md-4">
                                                                <label class="control-label">City</label>
                                                                <input type="text" class="form-control"
                                                                       name="city" <?php if (isset($client->city)) { ?> value="<?php echo $client->city; ?>" <?php } ?>/>
                                                            </div>

                                                            <div class="form-group col-md-4">
                                                                <label class="control-label">Province/State</label>
                                                                <?php
                                                                    function printoption($value, $selected, $option)
                                                                    {
                                                                        $tempstr = "";
                                                                        if ($option == $selected or $value == $selected) {
                                                                            $tempstr = " selected";
                                                                        }
                                                                        echo '<OPTION VALUE="' . $value . '"' . $tempstr . ">" . $option . "</OPTION>";
                                                                    }

                                                                    function printoptions($name, $valuearray, $selected, $optionarray)
                                                                    {
                                                                        echo '<SELECT name="' . $name . '" class="form-control member_type" >';
                                                                        for ($temp = 0; $temp < count($valuearray); $temp += 1) {
                                                                            printoption($valuearray[$temp], $selected, $optionarray[$temp]);
                                                                        }
                                                                        echo '</SELECT>';
                                                                    }

                                                                    function printprovinces($name, $selected)
                                                                    {
                                                                        printoptions($name, array("", "AB", "BC", "MB", "NB", "NL", "NT", "NS", "NU", "ON", "PE", "QC", "SK", "YT", "AL", "AK", "AZ", "AR", "CA", "CO", "CT", "DE", "FL", "GA", "HI", "ID", "IL", "IN", "IA", "KS", "KY", "LA", "ME", "MD", "MA", "MI", "MN", "MS", "MO", "MT", "NE", "NV", "NH", "NJ", "NM", "NY", "NC", "ND", "OH", "OK", "OR", "PA", "RI", "SC", "SD", "TN", "TX", "UT", "VT", "VA", "WA", "WV", "WI", "WY"), $selected, array("Select Province", "Alberta", "British Columbia", "Manitoba", "New Brunswick", "Newfoundland and Labrador", "Northwest Territories", "Nova Scotia", "Nunavut", "Ontario", "Prince Edward Island", "Quebec", "Saskatchewan", "Yukon Territories", "Alabama", "Alaska", "Arizona", "Arkansas", "California", "Colorado", "Connecticut", "Delaware", "Florida", "Georgia", "Hawaii", "Idaho", "Illinois", "Indiana", "Iowa", "Kansas", "Kentucky", "Louisiana", "Maine", "Maryland", "Massachusetts", "Michigan", "Minnesota", "Mississippi", "Missouri", "Montana", "Nebraska", "Nevada", "New Hampshire", "New Jersey", "New Mexico", "New York", "North Carolina", "North Dakota", "Ohio", "Oklahoma", "Oregon", "Pennsylvania", "Rhode Island", "South Carolina", "South Dakota", "Tennessee", "Texas", "Utah", "Vermont", "Virginia", "Washington", "Virginia", "Wisconsin", "Wyoming"));

                                                                    }

                                                                    printprovinces("province", $client->province);
                                                                ?>

                                                            </div>
                                                            <?php if ($settings->client_option == 0) { ?>
                                                                <div class="form-group col-md-4">
                                                                    <label class="control-label">Postal Code</label>
                                                                    <input type="text" class="form-control"
                                                                           name="postal" <?php if (isset($client->postal)) { ?> value="<?php echo $client->postal; ?>" <?php } ?>/>
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label class="control-label">Company's Phone
                                                                        Number</label>
                                                                    <input type="text" class="form-control"
                                                                           name="company_phone"
                                                                        <?php if (isset($client->company_phone)) { ?> value="<?php echo $client->company_phone; ?>" <?php } ?>
                                                                        />
                                                                </div>
                                                            <?php } ?>
                                                            <div class="form-group col-md-4">
                                                                <label class="control-label">Website</label>
                                                                <input type="text" class="form-control"
                                                                       name="site" <?php if (isset($client->site)) { ?> value="<?php echo $client->site; ?>" <?php } ?>/>
                                                            </div>
                                                            <?php if ($settings->client_option == 0) { ?>
                                                                <div class="form-group col-md-4">
                                                                    <label class="control-label">Divisions </label>
                                                        <textarea name="division" id="division"
                                                                  placeholder="One division per line"
                                                                  class="form-control"><?php if (isset($client->division)) echo $client->division; ?></textarea>
                                                                </div>

                                                                <div class="form-group col-md-4">
                                                                    <label class="control-label">Signatory's First
                                                                        Name</label>
                                                                    <input type="text" class="form-control"
                                                                           name="sig_fname" <?php if (isset($client->sig_fname)) { ?> value="<?php echo $client->sig_fname; ?>" <?php } ?>/>
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label class="control-label">Signatory's Last
                                                                        Name</label>
                                                                    <input type="text" class="form-control"
                                                                           name="sig_lname" <?php if (isset($client->sig_lname)) { ?> value="<?php echo $client->sig_lname; ?>" <?php } ?>/>
                                                                </div>

                                                                <div class="form-group col-md-4">
                                                                    <label class="control-label">Signatory's Email
                                                                        Address</label>
                                                                    <input type="email" id="sig_email"
                                                                           class="form-control"
                                                                           name="sig_email" <?php if (isset($client->sig_email)) { ?> value="<?php echo $client->sig_email; ?>" <?php } ?>/>
                                                                </div>



                                                                <div class="form-group col-md-4">
                                                                    <label class="control-label">Contract Start
                                                                        Date</label>
                                                                    <input type="text" class="form-control date-picker"
                                                                           name="date_start" <?php if (isset($client->date_start)) { ?> value="<?php echo $client->date_start; ?>" <?php } ?>/>
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label class="control-label">Contract End
                                                                        Date</label>
                                                                    <input type="text" class="form-control date-picker"
                                                                           name="date_end" <?php if (isset($client->date_end)) { ?> value="<?php echo $client->date_end; ?>" <?php } ?>/>
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label class="control-label">Referred By</label>
                                                                    <select class="form-control" name="referred_by"
                                                                            id="referred_by">
                                                                        <option value="">Select</option>
                                                                        <option
                                                                            value="Transrep" <?php if (isset($client->referred_by) && $client->referred_by == "Transrep") { ?> selected="selected" <?php } ?> >
                                                                            Transrep
                                                                        </option>
                                                                        <option
                                                                            value="ISB" <?php if (isset($client->referred_by) && $client->referred_by == "ISB") { ?> selected="selected" <?php } ?> >
                                                                            ISB
                                                                        </option>
                                                                        <option
                                                                            value="AFIMAC" <?php if (isset($client->referred_by) && $client->referred_by == "AFIMAC") { ?> selected="selected" <?php } ?>>
                                                                            AFIMAC
                                                                        </option>
                                                                        <option
                                                                            value="Broker" <?php if (isset($client->referred_by) && $client->referred_by == "Broker") { ?> selected="selected" <?php } ?>>
                                                                            Broker
                                                                        </option>
                                                                        <option
                                                                            value="Online" <?php if (isset($client->referred_by) && $client->referred_by == "Online") { ?> selected="selected" <?php } ?>>
                                                                            Online
                                                                        </option>
                                                                        <option
                                                                            value="Tradeshow" <?php if (isset($client->referred_by) && $client->referred_by == "Tradeshow") { ?> selected="selected" <?php } ?>>
                                                                            Tradeshow
                                                                        </option>
                                                                    </select>
                                                                </div>

                                                                <div class="form-group col-md-4">
                                                                    <label class="control-label">ARIS Agreement
                                                                        #</label>
                                                                    <input type="text" class="form-control"
                                                                           name="agreement_number" <?php if (isset($client->agreement_number)) { ?> value="<?php echo $client->agreement_number; ?>" <?php } ?>/>
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label class="control-label">ARIS
                                                                        Re-verification</label>
                                                                    <input type="text"
                                                                           class="form-control form-control-inline date-picker"
                                                                           name="reverification" <?php if (isset($end_date)) { ?> value="<?php echo $end_date; ?>" <?php } ?>/>
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label class="control-label">SACC Number</label>
                                                                    <input type="text" class="form-control"
                                                                           name="sacc_number" <?php if (isset($client->sacc_number)) { ?> value="<?php echo $client->sacc_number; ?>" <?php } ?>/>
                                                                </div>

                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <h3 class="block">Billing</h3>
                                                                    </div>
                                                                </div>


                                                                <div class="form-group col-md-4">
                                                                    <label class="control-label">Billing Contact</label>
                                                                    <input type="text" class="form-control"
                                                                           name="billing_contact" <?php if (isset($client->billing_contact)) { ?> value="<?php echo $client->billing_contact; ?>" <?php } ?>/>
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label class="control-label">Billing Address</label>
                                                                    <input type="text" class="form-control"
                                                                           name="billing_address" <?php if (isset($client->billing_address)) { ?> value="<?php echo $client->billing_address; ?>" <?php } ?>/>
                                                                </div>

                                                                <div class="form-group col-md-4">
                                                                    <label class="control-label">Billing City</label>
                                                                    <input type="text" class="form-control"
                                                                           name="billing_city"
                                                                           value="<?php echo isset($client->billing_city) ? $client->billing_city : '' ?>"/>
                                                                </div>

                                                                <div class="form-group col-md-4">
                                                                    <label class="control-label">Billing
                                                                        Province/State</label>
                                                                    <?php printprovinces("billing_province", $client->billing_province); ?>


                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label class="control-label">Billing Postal
                                                                        Code</label>
                                                                    <input type="text" class="form-control"
                                                                           name="billing_postal_code"
                                                                           value="<?php echo isset($client->billing_postal_code) ? $client->billing_postal_code : '' ?>"/>
                                                                </div>


                                                                <div class="form-group col-md-4">
                                                                    <label class="control-label">Invoice Terms</label>
                                                                    <select class="form-control" name="invoice_terms"
                                                                            id="invoice_terms">
                                                                        <option value="">Select</option>
                                                                        <option
                                                                            value="weekly" <?php if (isset($client->invoice_terms) && $client->invoice_terms == 'weekly') { ?> selected="selected" <?php } ?>>
                                                                            Weekly
                                                                        </option>
                                                                        <option
                                                                            value="biweekly" <?php if (isset($client->invoice_terms) && $client->invoice_terms == 'biweekly') { ?> selected="selected" <?php } ?>>
                                                                            Bi-weekly
                                                                        </option>
                                                                        <option
                                                                            value="monthly" <?php if (isset($client->invoice_terms) && $client->invoice_terms == 'monthly') { ?> selected="selected" <?php } ?>>
                                                                            Monthly
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group col-md-12">
                                                                    <label class="control-label">Billing
                                                                        Instructions</label>
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <input type="radio"
                                                                           name="billing_instructions" <?php if (isset($client->billing_instructions) && $client->billing_instructions == "individual") { ?> checked="checked" <?php } ?>
                                                                           value="individual"/> Individual&nbsp;&nbsp;
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <input type="radio"
                                                                           name="billing_instructions" <?php if (isset($client->billing_instructions) && $client->billing_instructions == "centralized") { ?> checked="checked" <?php } ?>
                                                                           value="centralized"/> Centralized&nbsp;&nbsp;
                                                                </div>

                                                                <div class="form-group col-md-12">

                                                                    <label class="control-label">Description</label>
                                                        <textarea id="description" name="description"
                                                                  class="form-control"><?php if (isset($client->description)) {
                                                                echo $client->description;
                                                            } ?></textarea>

                                                                </div>

                                                            <?php }
                                                                $delete = isset($disabled);
                                                                if (isset($client_docs)) {
                                                                    listfiles($client_docs, "img/jobs/", 'client_doc', $delete);
                                                                }
                                                            ?>

                                                            <div class="form-group row"><!--<center>-->

                                                                <div class="docMore col-md-12" data-count="1">
                                                                    <div style="display:block;" class="col-md-12">
                                                                        <a href="javascript:void(0)" id="addMore1"
                                                                           class="btn btn-primary">Browse</a>
                                                                        <input type="hidden" name="client_doc[]"
                                                                               value="" class="addMore1_doc moredocs"/>
                                                                        <span></span>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                            <div class="form-group col-md-12"><!--<center>-->

                                                                <a href="javascript:void(0)" class="btn btn-info"
                                                                   id="addMoredoc">
                                                                    Add More
                                                                </a>

                                                            </div>
                                                            <div class="form-group col-md-12" align="right">
                                                                <!--<center>-->
                                                                <div
                                                                    class="margin-top-10 alert alert-success display-hide flash1"
                                                                    style="display: none;">
                                                                    <button class="close" data-close="alert"></button>
                                                                    Data saved successfully
                                                                </div>
                                                            </div>

                                                            <div class="clearfix"></div>


                                                            <div class="form-actions top chat-form"
                                                                 style="height:75px; margin-bottom:-1px;padding-right: 30px;margin-right: 5px;margin-left: 5px;"
                                                                 align="right">
                                                                <div class="row">
                                                                    <button type="submit" class="btn btn-primary"
                                                                            id="save_client_p1">Save Changes
                                                                    </button>
                                                                    <!--button type="submit" class="btn btn-info" onclick="$('#client_drafts').val('1',function(){$('#save_client_p1').click();});">Save As Draft</button-->
                                                                </div>
                                                            </div>


                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                            if ($this->request['action'] != "add" && !isset($_GET['view']))
                                            {
                                            if (isset($_GET['activedisplay']))
                                            {
                                        ?>
                                        <div class="tab-pane active" id="tab_1_2">
                                            <?php
                                                }
                                                else
                                                {
                                            ?>
                                            <div class="tab-pane" id="tab_1_2">
                                                <?php
                                                    }
                                                ?>
                                                <h4 class="col-md-6"> Enable <?php echo ucfirst($settings->document); ?>
                                                    s?</h4>

                                                <div class="clearfix"></div>

                                                <form action="" id="displayform1" method="post">
                                                    <table class="table table-light table-hover sortable">
                                                        <tr class="myclass">
                                                            <th></th>
                                                            <!--<th class="">System</th>-->
                                                            <th class=""><?php echo ucfirst($settings->document); ?> </th>
                                                            <th class="">Orders</th>
                                                            <th class="">Display Order</th>
                                                        </tr>
                                                        <?php
                                                            //$subdoc = $this->requestAction('/clients/getSub');
                                                            $subdoccli = $this->requestAction('/clients/getSubCli/' . $id);
                                                            $u = 0;
                                                            foreach ($subdoccli as $subcl) {
                                                                $u++;
                                                                $sub = $this->requestAction('/clients/getFirstSub/' . $subcl->sub_id);
                                                                ?>
                                                                <tr id="subd_<?php echo $sub->id; ?>"
                                                                    class="sublisting">
                                                                    <td>

                                                                        <span
                                                                            id="sub_<?php echo $sub['id']; ?>"><?php echo ucfirst($sub['title']); ?></span>
                                                                    </td>
                                                                    <!--<td class="">
                                                    <label class="uniform-inline">
                                                        <input <?php echo $is_disabled ?> type="radio"
                                                                                          name="<?php echo $sub->id; ?>"
                                                                                          value="1"
                                                                                          <?php if ($sub['display'] == 1) { ?>checked="checked" <?php } ?>
                                                                                          disabled="disabled"/>
                                                        Yes </label>
                                                    <label class="uniform-inline">
                                                        <input <?php echo $is_disabled ?> type="radio"
                                                                                          name="<?php echo $sub->id; ?>"
                                                                                          value="0"
                                                                                          <?php if ($sub['display'] == 0) { ?>checked="checked" <?php } ?>
                                                                                          disabled="disabled"/>
                                                        No </label>
                                                </td>-->
                                                                    <?php
                                                                        $csubdoc = $this->requestAction('/settings/all_settings/0/0/client/' . $id . '/' . $sub->id);
                                                                    ?>
                                                                    <td class="">
                                                                        <label class="uniform-inline">
                                                                            <input <?php echo $is_disabled ?>
                                                                                type="radio"
                                                                                name="clientC[<?php echo $sub->id; ?>]"
                                                                                value="1"  <?php if ($csubdoc['display'] == 1) { ?> checked="checked" <?php } ?> />
                                                                            Yes </label>
                                                                        <label class="uniform-inline">
                                                                            <input <?php echo $is_disabled ?>
                                                                                type="radio"
                                                                                name="clientC[<?php echo $sub->id; ?>]"
                                                                                value="0"  <?php if ($csubdoc['display'] == 0) { ?> checked="checked" <?php } ?> />
                                                                            No </label>
                                                                    </td>
                                                                    <td>
                                                                        <input <?php if ($csubdoc['display_order'] == 1) { ?> checked="checked" <?php } ?>
                                                                            type="checkbox" id="check<?= $u ?>"
                                                                            onclick="if($(this).is(':checked')){$(this).closest('td').find('.fororder').val('1');}else {$(this).closest('td').find('.fororder').val('0');}"/>
                                                                        <label for="check<?= $u ?>">Show</label>

                                                                        <input class="fororder" type="hidden"
                                                                                   value="<?php if ($csubdoc['display_order'] == 1) {
                                                                                       echo '1';
                                                                                   } else { ?>0<?php } ?>"
                                                                                   name="clientO[<?php echo $sub->id; ?>]"/>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $u; ?>
                                                                    </td>
                                                                </tr>

                                                            <?php
                                                            }
                                                        ?>

                                                    </table>

                                                    <!--end profile-settings-->

                                                    <?php
                                                        if (!isset($disabled)) {
                                                            ?>

                                                            <div
                                                                class="margin-top-10 alert alert-success display-hide flash"
                                                                style="display: none;">
                                                                <button class="close" data-close="alert"></button>
                                                                Data saved successfully
                                                            </div>

                                                            <div class="form-actions top chat-form"
                                                                 style="height:75px; margin-bottom:-1px;padding-right: 30px;margin-right: -10px;margin-left: -10px;"
                                                                 align="right">
                                                                <div class="row">
                                                                    <a href="javascript:void(0)" id="save_display1"
                                                                       class="btn btn-primary"  <?php echo $is_disabled ?>>
                                                                        Save Changes </a>

                                                                </div>
                                                            </div>



                                                        <?php
                                                        }
                                                    ?>

                                                </form>
                                            </div>
                                            <?php } ?>
                                            <div class="tab-pane" id="tab_1_3" style="min-height: 300px;;">
                                                <?php
                                                    include('subpages/clients/recruiter_contact_table.php');
                                                ?>
                                            </div>


                                            <!-- END SAMPLE FORM PORTLET-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                $(function () {
                    var tosend = '';
                    $('.sortable tbody').sortable({
                        items: "tr:not(.myclass)",
                        update: function (event, ui) {

                            $('.sublisting').each(function () {
                                var id = $(this).attr('id');
                                id = id.replace('subd_', '');
                                if (tosend == '') {
                                    tosend = id;
                                }
                                else
                                    tosend = tosend + ',' + id;
                            });
                            $.ajax({
                                url: '<?php echo $this->request->webroot;?>clients/updateOrder/<?php if(isset($id))echo $id;?>',
                                data: 'tosend=' + tosend,
                                type: 'post'
                            });
                            tosend = '';


                        }
                    });
                    <?php
                    if(isset($_GET['view']))
                    {
                        ?>
                    $('#client_form input').each(function () {
                        $(this).attr("disabled", 'disabled');
                    });
                    $('#client_form a').hide();
                    $('.uploaded').show();
                    $('#clientimg').hide();
                    $('#client_form textarea').each(function () {
                        $(this).attr("disabled", 'disabled');
                    });

                    $('#client_form select').each(function () {
                        $(this).attr("disabled", 'disabled');
                    });

                    $('.recruiters input').each(function () {
                        $(this).attr("disabled", 'disabled');
                    });
                    $('#searchProfile').hide();
                    $('#save_client_p1').hide();
                    $('#attach_label').hide();
                    <?php }?>
                    $('input [type="email"]').keyup(function () {
                        $(this).removeAttr('style');
                    });
                    initiate_ajax_upload('clientimg', 'asdas');
                    initiate_ajax_upload('addMore1', 'doc');
                    <?php
                    if(isset($id))
                    {
                    ?>

                    $('#save_display1').click(function () {
                        $('#save_display1').text('Saving..');
                        var str = $('#displayform1 input').serialize();
                        $.ajax({
                            url: '<?php echo $this->request->webroot;?>clients/displaySubdocs/<?php echo $id;?>',
                            data: str,
                            type: 'post',
                            success: function (res) {
                                $('.flash').show();
                                $('#save_display1').text(' Save Changes ');
                            }
                        })
                    });
                    <?php
                    }
                    ?>
                    $('.save_client_all').submit(function (event) {
                        event.preventDefault();
                        $('#save_client_p1').text('Saving..');
                        var str = '';
                        /*
                         $('.recruiters input').each(function () {
                         if ($(this).is(':checked')) {
                         if (str == '')
                         str = 'profile_id[]=' + $(this).val();
                         else
                         str = str + '&profile_id[]=' + $(this).val();
                         }
                         });
                         $('.contacts input').each(function () {
                         if ($(this).is(':checked')) {
                         if (str == '')
                         str = 'contact_id[]=' + $(this).val();
                         else
                         str = str + '&contact_id[]=' + $(this).val();
                         }
                         });*/
                        $('.moredocs').each(function () {
                            if ($(this).val() != "") {
                                if (str == '')
                                    str = 'client_doc[]=' + $(this).val();
                                else
                                    str = str + '&client_doc[]=' + $(this).val();
                            }

                        });
                        if (str == '') {
                            str = $('#tab_1_1 input').serialize();
                        }
                        else {
                            str = str + '&' + $('#tab_1_1 input').serialize();
                        }
                        if (str == '') {
                            str = $('#tab_1_1 select').serialize();
                        }
                        else {
                            str = str + '&' + $('#tab_1_1 select').serialize();
                        }
                        str = str + '&customer_type=' + $('#customer_type').val();
                        str = str + '&division=' + $('#division').val();
                        str = str + '&referred_by=' + $('#referred_by').val();
                        str = str + '&invoice_terms=' + $('#invoice_terms').val();
                        str = str + '&description=' + $('#description').val();


                        $.ajax({
                            url: '<?php echo $this->request->webroot;?>clients/saveClients/<?php echo $id?>',
                            data: str,
                            type: 'post',
                            success: function (res) {

                                if (res != 'e' && res != 'email' && res != 'Invalid Email') {
                                    window.location = '<?php echo $this->request->webroot;?>clients/edit/' + res + '?flash';
                                }
                                else if (res == 'email') {
                                    alert('Email Already Exist.');
                                }
                                else if (res == 'Invalid Email') {
                                    $('#tab_1_1 input[type="email"]').focus();
                                    $('#tab_1_1 input[type="email"]').attr('style', 'border-color:red');
                                    $('html,body').animate({
                                            scrollTop: $('#tab_1_1').offset().top
                                        },
                                        'slow');
                                }

                                else {
                                    alert('Couldn\'t save your data');
                                }
                                $('#save_client_p1').text(' Save ');
                            }
                        })
                    });
                });

                $('#addMoredoc').click(function () {
                    var total_count = $('.docMore').data('count');
                    $('.docMore').data('count', parseInt(total_count) + 1);
                    total_count = $('.docMore').data('count');
                    var input_field = '<div  class="form-group"><div class="col-md-12" style="margin-top:10px;"><a href="javascript:void(0);" id="addMore' + total_count + '" class="btn btn-primary">Browse</a><input type="hidden" name="client_doc[]" value="" class="addMore' + total_count + '_doc moredocs" /><a href="javascript:void(0);" class = "btn btn-danger img_delete" id="delete_addMore' + total_count + '" title ="">Delete</a><span></span></div></div>';
                    $('.docMore').append(input_field);
                    initiate_ajax_upload('addMore' + total_count, 'doc');

                });
                //delete image
                $('.img_delete').live('click', function () {
                    var file = $(this).attr('title');
                    if (file == file.replace("&", " ")) {
                        var id = 0;
                    }
                    else {
                        var f = file.split("&");
                        file = f[0];
                        var id = f[1];
                    }

                    var con = confirm('Are you sure you want to delete "' + file + '"?');
                    if (con == true) {
                        $.ajax({
                            type: "post",
                            data: 'id=' + id,
                            url: "<?php echo $this->request->webroot;?>clients/removefiles/" + file,
                            success: function (msg) {

                            }
                        });
                        $(this).parent().parent().remove();

                    }
                    else
                        return false;
                });
                var removeLink = 0;// this variable is for showing and removing links in a add document
                function addMore(e, obj) {
                    e.preventDefault();

                    var total_count = $('.docMore').data('count');
                    $('.docMore').data('count', parseInt(total_count) + 1);
                    total_count = $('.docMore').data('count');
                    var input_field = '<div style="display:block;margin:5px;"><a href="javascript;void(0);" id="addMore' + total_count + '" class="btn btn-primary">Browse</a><span></span><input type="hidden" name="client_doc[]" value="" class="addMore' + total_count + '_doc moredocs" /></div>';
                    $('.docMore').append(input_field);
                    if (parseInt(total_count) > 1 && removeLink == 0) {
                        removeLink = 1;
                        $('#addMoredoc').after('<a href="#" id="removeMore" class="btn btn-danger" onclick="removeMore(event,this)">Remove last</a>');
                        initiate_ajax_upload('addMore' + total_count, 'doc');
                    }
                }

                function removeMore(e, obj) {
                    e.preventDefault();
                    var total_count = $('.docMore').data('count');
//$('.docMore input[type="file"]:last').remove();
                    $('.docMore div:last-child').remove();
                    $('.docMore').data('count', parseInt(total_count) - 1);
                    total_count = $('.docMore').data('count');
                    if (parseInt(total_count) == 1) {
                        $('#removeMore').remove();
                        removeLink = 0;
                    }
                }
            </script>


            <script>

                function initiate_ajax_upload(button_id, doc) {
                    var button = $('#' + button_id), interval;
                    if (doc == 'doc')
                        var act = "<?php echo $this->request->webroot;?>clients/upload_all/<?php if(isset($id))echo $id;?>";
                    else
                        var act = "<?php echo $this->request->webroot;?>clients/upload_img/<?php if(isset($id))echo $id;?>";
                    new AjaxUpload(button, {
                        action: act,
                        name: 'myfile',
                        onSubmit: function (file, ext) {
                            button.text('Uploading');
                            this.disable();
                            interval = window.setInterval(function () {
                                var text = button.text();
                                if (text.length < 13) {
                                    button.text(text + '.');
                                } else {
                                    button.text('Uploading');
                                }
                            }, 200);
                        },
                        onComplete: function (file, response) {
                            if (doc == "doc")
                                button.html('Browse');
                            else
                                button.html('<i class="fa fa-image"></i> Add/Edit Image');

                            window.clearInterval(interval);
                            this.enable();
                            if (doc == "doc") {
                                $('#' + button_id).parent().find('span').text(" " + response);
                                $('.' + button_id + "_doc").val(response);
                                $('#delete_' + button_id).attr('title', response);
                            }
                            else {
                                $("#clientpic").attr("src", '<?php echo $this->request->webroot;?>img/jobs/' + response);
                                $('#client_img').val(response);
                            }
//$('.flashimg').show();
                        }
                    });
                }
            </script>


