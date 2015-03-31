
<style>div {
        border: 0px solid green;
    }</style>

<?php
     if($_SERVER['SERVER_NAME'] =='localhost')
        echo "<span style ='color:red;'>info.php #INC117</span>";
    $getProfileType = $this->requestAction('profiles/getProfileType/' . $this->Session->read('Profile.id'));
    $sidebar = $this->requestAction("settings/all_settings/" . $this->request->session()->read('Profile.id') . "/sidebar");
    $settings = $this->requestAction('settings/get_settings');
    function printoption($option, $selected, $value = "")
    {
        $tempstr = "";
        if ($option == $selected) {
            $tempstr = " selected";
        }
        if (strlen($value) > 0) {
            $value = " value='" . $value . "'";
        }
        echo '<option' . $value . $tempstr . ">" . $option . "</option>";
    }

    function printoption2($value, $selected = "", $option)
    {
        $tempstr = "";
        if ($option == $selected or $value == $selected) {
            $tempstr = " selected";
        }
        echo '<OPTION VALUE="' . $value . '"' . $tempstr . ">" . $option . "</OPTION>";
    }

    function printoptions($name, $valuearray, $selected = "", $optionarray, $isdisabled = "", $isrequired = false)
    {
        if ($name == 'profile_type')
            echo '<SELECT ' . $isdisabled . ' name="' . $name . '" class="form-control member_type req_driver"';
        else
            echo '<SELECT ' . $isdisabled . ' name="' . $name . '" class="form-control req_driver"';
        echo '>';

        for ($temp = 0; $temp < count($valuearray); $temp += 1) {
            printoption2($valuearray[$temp], $selected, $optionarray[$temp]);
        }
        echo '</SELECT>';
    }

    function printprovinces($name, $selected = "", $isdisabled = "", $isrequired = false)
    {
        printoptions($name, array("", "AB", "BC", "MB", "NB", "NL", "NT", "NS", "NU", "ON", "PE", "QC", "SK", "YT"), $selected, array("Select Province", "Alberta", "British Columbia", "Manitoba", "New Brunswick", "Newfoundland and Labrador", "Northwest Territories", "Nova Scotia", "Nunavut", "Ontario", "Prince Edward Island", "Quebec", "Saskatchewan", "Yukon Territories"), $isdisabled, $isrequired);

    }

?>

<div class="portlet-body form">
    <input type="hidden" name="client_ids" value="" class="client_profile_id"/>

    <div class="form-body">
        <div class="tab-content">
            <div class="tab-pane active" id="subtab_4_1">


                <div class="portlet box" style="margin-bottom:0px;">


                    <form role="form" action="" method="post" id="save_clientz">
                        <input type="hidden" name="client_ids" value="" class="client_profile_id"/>
                        <input type="hidden" name="drafts" value="0" id="profile_drafts"/>

                        <div class="row">
                            <input type="hidden" name="created_by"
                                   value="<?php echo $this->request->session()->read('Profile.id') ?>"/>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label"><?php echo ucfirst($settings->profile); ?> Type
                                        : </label>
                                    <!--old code:  <input type="hidden" id="nProfileType" name="profile_type" value="<!php if(!isset($p) && isset($getProfileType->profile_type) && $getProfileType->profile_type == 2)echo "5"; else echo $p->profile_type;!>" <!php echo $is_disabled !> />-->
                                    <?php if (isset($p)) { ?>
                                        <input type="hidden" id="nProfileType" name="profile_type"
                                               value="<?php if (isset($p)) {
                                                   echo $p->profile_type;
                                               } ?>" <?php echo $is_disabled ?> />
                                    <?php } ?>
                                    
                                    
                                    
                                    
                                    
                                    
                                    <?php if($this->request->params['action']=='add' || ($this->request->params['action']=='edit' && $this->request->session()->read('Profile.id') != $id)){
                                        
                                        ?>
                                    <select  <?php echo $is_disabled ?>
                                        name="<?php if (!isset($p)) {
                                            echo 'profile_type';
                                        } ?>" <?php if ((isset($id) && $this->request->session()->read('Profile.id') == $id)/* || ($this->request->session()->read('Profile.profile_type') == '2')*/) echo "disabled='disabled'"; ?>
                                        class="form-control member_type" required='required'
                                        onchange="$('#nProfileType').val($(this).val());">
                                        <option value="">Select</option>

                                        <?php
                                            $isISB = (isset($sidebar) && $settings->client_option == 0);
                                            $ptyp = $this->requestAction('profiles/gettypes/ptypes/' . $this->request->session()->read('Profile.id'));
                                            if ($ptyp != "")
                                                $pts = explode(",", $ptyp);
                                            foreach ($ptypes as $k => $pt) {
                                                //var_dump($pt);
                                                if (isset($pts)) {
                                                    if (in_array($pt->id, $pts)) {
                                                        if ($pt->id == '1') {
                                                            //if($this->request->session()->read('Profile.super'))
                                                            //{
                                                            ?>
                                                            <option
                                                                value="<?php echo $pt->id;?>" <?php if (isset($p) && $p->profile_type == 1) { ?> selected="selected" <?php } ?>>
                                                                <?php echo $pt->title;?>
                                                            </option>
                                                            <?php

                                                            //}
                                                        } else {
                                                            /*if($isISB)
                                                            {
                                                                if ($pt->id<='8')
                                                                {
                                                                ?>
                                                                <option
                                                                        value="<?php echo $pt->id;?>" <?php if (isset($p) && $p->profile_type == $pt->id) { ?> selected="selected" <?php } ?>>
                                                                        <?php echo $pt->title;?>
                                                                </option>
                                                            <?php
                                                                }
                                                            }
                                                            else
                                                            {*/
                                                            ?>
                                                            <option
                                                                value="<?php echo $pt->id;?>" <?php if (isset($p) && $p->profile_type == $pt->id) { ?> selected="selected" <?php } ?>>
                                                                <?php echo $pt->title;?>
                                                            </option>
                                                            <?php
                                                            //}
                                                        }

                                                        ?>

                                                    <?php
                                                    }
                                                } else {
                                                    if ($pt->id == '1') {
                                                        //if($this->request->session()->read('Profile.super'))
                                                        //{
                                                        ?>
                                                        <option
                                                            value="<?php echo $pt->id;?>" <?php if (isset($p) && $p->profile_type == 1) { ?> selected="selected" <?php } ?>>
                                                            <?php echo $pt->title;?>
                                                        </option>
                                                        <?php

                                                        //}
                                                    } else {
                                                        /*if($isISB)
                                                        {
                                                            if ($pt->id<='8')
                                                            {
                                                            ?>
                                                            <option
                                                                    value="<?php echo $pt->id;?>" <?php if (isset($p) && $p->profile_type == $pt->id) { ?> selected="selected" <?php } ?>>
                                                                    <?php echo $pt->title;?>
                                                            </option>
                                                        <?php
                                                            }
                                                        }
                                                        else
                                                        {*/
                                                        ?>
                                                        <option
                                                            value="<?php echo $pt->id;?>" <?php if (isset($p) && $p->profile_type == $pt->id) { ?> selected="selected" <?php } ?>>
                                                            <?php echo $pt->title;?>
                                                        </option>
                                                        <?php
                                                        //}
                                                    }

                                                }
                                            }
                                        ?>
                                        <?php
                                            /*
                                            if ($this->request->session()->read('Profile.super')) {
                                                ?>
                                                <option
                                                    value="1" <?php if (isset($p) && $p->profile_type == 1) { ?> selected="selected" <?php } ?>>
                                                    Admin
                                                </option>
                                            <?php }


                                            if ($isISB) {
                                                ?>


                                                <option
                                                    value="2" <?php if (isset($p) && $p->profile_type == 2) { ?> selected="selected" <?php }
                                                    if (!$this->request->session()->read('Profile.super')) {
                                                        ?> disabled="disabled"
                                                    <?php } ?>>
                                                    Recruiter
                                                </option>

                                                <option
                                                    value="3" <?php if (isset($p) && $p->profile_type == 3) { ?> selected="selected" <?php }
                                                    if (!$this->request->session()->read('Profile.super')) { ?> disabled="disabled"
                                                    <?php } ?>>
                                                    External
                                                </option>

                                                <option
                                                    value="4" <?php if (isset($p) && $p->profile_type == 4) { ?> selected="selected" <?php }
                                                    if (!$this->request->session()->read('Profile.super')) { ?> disabled="disabled"
                                                    <?php } ?>>
                                                    Safety
                                                </option>

                                                <option
                                                    value="5" <?php if ((isset($p) && $p->profile_type == 5) || (!isset($p) && isset($getProfileType->profile_type) && $getProfileType->profile_type == 2)) { ?> selected="selected" <?php }
                                                    if (!$this->request->session()->read('Profile.super') && ($this->request->session()->read('Profile.profile_type') != '2')) {
                                                        ?>
                                                        disabled="disabled"
                                                    <?php
                                                    }
                                                ?>>
                                                    Driver
                                                </option>

                                                <option
                                                    value="6" <?php if (isset($p) && $p->profile_type == 6) { ?> selected="selected" <?php }
                                                    if (!$this->request->session()->read('Profile.super')) { ?> disabled="disabled"
                                                    <?php } ?>>
                                                    Contact
                                                </option>

                                                <option value="7" <?php if (isset($p) && $p->profile_type == 7) { ?> selected="selected" <?php }
                                                    if (!$this->request->session()->read('Profile.super') && $this->request->session()->read('Profile.profile_type')!='2') { ?> disabled="disabled"
                                                <?php }?>>
                                                    Owner Operator
                                                </option>

                                                <option value="8" <?php if (isset($p) && $p->profile_type == 8) { ?> selected="selected" <?php }
                                                                if (!$this->request->session()->read('Profile.super') && $this->request->session()->read('Profile.profile_type')!='2') { ?> disabled="disabled"
                                                <?php } ?>>
                                                    Owner Driver
                                                </option>

                                            <?php } else { ?>

                                                <option
                                                    value="9" <?php if (isset($p) && $p->profile_type == 9) { ?> selected="selected" <?php }
                                                    if (!$this->request->session()->read('Profile.super')) { ?> disabled="disabled" <?php } ?>>
                                                    Employee
                                                </option>
                                                <option
                                                    value="10" <?php if (isset($p) && $p->profile_type == 10) { ?> selected="selected" <?php }
                                                    if (!$this->request->session()->read('Profile.super')) { ?> disabled="disabled" <?php } ?>>
                                                    Guest
                                                </option>
                                                <option
                                                    value="11" <?php if (isset($p) && $p->profile_type == 11) { ?> selected="selected" <?php }
                                                    if (!$this->request->session()->read('Profile.super')) { ?> disabled="disabled" <?php } ?> >
                                                    Partner
                                                </option>

                                            <?php }*/ ?>


                                    </select>
                                    <?php }
                                    else{
                                        ?>
                                        <select  <?php echo $is_disabled ?>
                                        name="<?php if (!isset($p)) {
                                            echo 'profile_type';
                                        } ?>" <?php if ((isset($id) && $this->request->session()->read('Profile.id') == $id)/* || ($this->request->session()->read('Profile.profile_type') == '2')*/) echo "disabled='disabled'"; ?>
                                        class="form-control member_type" required='required'
                                        onchange="$('#nProfileType').val($(this).val());">
                                        
                                        <option selected="" value="$p->profile_type"><?php echo $this->requestAction('/profiles/getTypeTitle/'.$p->profile_type)?></option>
                                        
                                        </select>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>

                            <div class="col-md-6" id="isb_id"
                                 style="display:
                                 <?php
                                     /* as discussed on march 18, isb id only for recruiter and driver type for driver , owners etc
                                      if ((isset($p) && $p->profile_type != 5) && (isset($getProfileType->profile_type) && $getProfileType->profile_type == 1) || ($this->request->session()->read('Profile.profile_type') == 2 && (isset($p) && $p->id == ($this->request->session()->read('Profile.id')))) || ($this->request->session()->read('Profile.profile_type') == 2 && (isset($p) && $p->id != 5  ))) echo 'block'; else echo "none" */ ?>
                                 <?php
                                     if ((isset($p) && $p->profile_type == 2))
                                         echo 'block'; else echo "none" ?>
                                     ;">
                                <div class="form-group">
                                    <label class="control-label">ISB Id : </label>
                                    <input <?php echo $is_disabled ?>
                                        name="isb_id" type="text"
                                        placeholder=""
                                        class="form-control req_rec" <?php if (isset($p->isb_id)) { ?> value="<?php echo $p->isb_id; ?>" <?php }
                                        if (isset($p->isb_id) && !$this->request->session()->read('Profile.super')) {
                                            ?>
                                            disabled="disabled"
                                        <?php
                                        }
                                    ?>  />
                                </div>
                            </div>


                            <?php // if ($settings->client_option == 0) { ?>

                            <div class="col-md-6" id="driver_div"
                                 style="display:<?php if ((isset($p) && $p->profile_type == 5) || ($this->request->session()->read('Profile.profile_type') == 2 && (isset($p) && $p->id != ($this->request->session()->read('Profile.id'))))) echo 'block'; else echo "none" ?>;">
                                <div class="form-group">
                                    <label class="control-label">Driver Type : </label>
                                    <select  <?php echo $is_disabled ?> name="driver"
                                                                        class="form-control select_driver req_driver">
                                        <option value="">Select Driver Type</option>
                                        <option
                                            value="1" <?php if (isset($p) && $p->driver == 1) echo "selected='selected'"; ?>
                                            >BC - BC FTL AB/BC
                                        </option>
                                        <option value="2"
                                            <?php if (isset($p) && $p->driver == 2) echo "selected='selected'"; ?>>
                                            BCI5 - BC FTL I5
                                        </option>
                                        <option value="3"
                                            <?php if (isset($p) && $p->driver == 3) echo "selected='selected'"; ?>>
                                            BULK
                                        </option>
                                        <option value="4"
                                            <?php if (isset($p) && $p->driver == 4) echo "selected='selected'"; ?>>
                                            CLIMATE
                                        </option>
                                        <option value="5"
                                            <?php if (isset($p) && $p->driver == 5) echo "selected='selected'"; ?>>
                                            FTL - SINGLE DIVISION
                                        </option>
                                        <option value="6"
                                            <?php if (isset($p) && $p->driver == 6) echo "selected='selected'"; ?>>
                                            FTL - TOYOTA SINGLE HRLY
                                        </option>
                                        <option value="7"
                                            <?php if (isset($p) && $p->driver == 7) echo "selected='selected'"; ?>>
                                            FTL - TOYOTA SINGLE HWY
                                        </option>
                                        <option value="8"
                                            <?php if (isset($p) && $p->driver == 8) echo "selected='selected'"; ?>>
                                            LCV - LCV UNITS
                                        </option>
                                        <option value="9"
                                            <?php if (isset($p) && $p->driver == 9) echo "selected='selected'"; ?>>
                                            LOC - LOCAL
                                        </option>
                                        <option value="10"
                                            <?php if (isset($p) && $p->driver == 10) echo "selected='selected'"; ?>>
                                            OWNER - OPERATOR
                                        </option>
                                        <option value="11"
                                            <?php if (isset($p) && $p->driver == 11) echo "selected='selected'"; ?>>
                                            OWNER - DRIVER
                                        </option>
                                        <option value="12"
                                            <?php if (isset($p) && $p->driver == 12) echo "selected='selected'"; ?>>
                                            SCD - SPECIAL COMMODITIES
                                        </option>
                                        <option value="13"
                                            <?php if (isset($p) && $p->driver == 13) echo "selected='selected'"; ?>>
                                            SST-SANDRK- OPEN FUEL
                                        </option>
                                        <option value="14"
                                            <?php if (isset($p) && $p->driver == 14) echo "selected='selected'"; ?>>
                                            SWD-SANDRK
                                        </option>
                                        <option value="15"
                                            <?php if (isset($p) && $p->driver == 15) echo "selected='selected'"; ?>>
                                            TBL-TRANSBORDER
                                        </option>
                                        <option value="16"
                                            <?php if (isset($p) && $p->driver == 16) echo "selected='selected'"; ?>>
                                            TEM - TEAM DIVISION
                                        </option>
                                        <option value="17"
                                            <?php if (isset($p) && $p->driver == 17) echo "selected='selected'"; ?>>
                                            TEM - TOYOTA TEAM
                                        </option>
                                        <option value="18"
                                            <?php if (isset($p) && $p->driver == 18) echo "selected='selected'"; ?>>
                                            WD - Wind
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <?php //}?>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Username : </label>
                                    <input <?php echo $is_disabled ?> id="username_field" name="username" type="text"
                                                                      class="form-control req_driver req_rec uname" <?php if (isset($p->username)) { ?> value="<?php echo $p->username; ?>" <?php } ?>
                                        <?php if (($this->request->session()->read('Profile.super') != '1' && ($this->request->params['action'] == 'edit'))) {
                                            echo 'disabled="disabled"';
                                        } ?>/>
                            <span class="error passerror flashUser"
                                  style="display: none;">Username already exists</span>
                            <span class="error passerror flashUser1"
                                  style="display: none;">Username is required.</span>
                                </div>
                            </div>
                            


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Email Address : </label>
                                    <input <?php echo $is_disabled ?> name="email" type="email"
                                                                      placeholder=""
                                                                      class="form-control un email req_driver" <?php if (isset($p->email)) { ?> value="<?php echo $p->email; ?>" <?php } ?>/>
                            <span class="error passerror flashEmail"
                                  style="display: none;">Email already exists</span>
                                </div>
                            </div>
                            


                            <?php


                                if ($this->request->session()->read('Profile.profile_type') != '2') { ?>
                                    <?php if (strlen($is_disabled) == 0) {

                                        ?>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Password : </label>


                                                <!-- <input  <?php echo $is_disabled ?> type="password" name="password" id="password" class="form-control"
                                   <?php // if (isset($p->password)){ ?><?php //echo $p->password; ?> <?php //} ?>
                                   <?php if (isset($p->password) && $p->password) {//do nothing
                                                } else { ?>required="required"<?php } ?>  />-->


                                                <input  <?php echo $is_disabled ?> type="password" value=""
                                                                                   autocomplete="off"
                                                                                   name="password" id="password"
                                                                                   class="form-control" <?php if (isset($p->password) && $p->password) {//do nothing
                                                } ?>/>
                                            </div>
                                        </div>
                                        <?php if (isset($p->password)) { ?>
                                            <input type="hidden" value="<?php $p->password ?>" name="hid_pass"/>
                                        <?php } ?>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Re-type Password : </label>
                                                <input <?php if (isset($p->password) && $p->password){//do nothing
                                                }else{ ?>required="required"<?php } ?>  <?php echo $is_disabled ?>
                                                       type="password" class="form-control"
                                                       id="retype_password" <?php //if (isset($p->password)) { ?> <?php // echo $p->password; ?>  <?php // } ?>/>
                            <span class="error passerror flashPass1"
                                  style="display: none;">Please enter the same password in both boxes</span>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>

                                    <?php }
                                }


                                if ($settings->client_option == 0) { ?>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Title : </label><BR>
                                    <SELECT <?php echo $is_disabled ?> name="title" class="form-control "><?php

                                            if (isset($p->title)) {
                                                $title = $p->title;
                                            } else
                                                $title = "";
                                            printoption("Mr.", $title, "Mr.");
                                            printoption("Mrs.", $title, "Mrs.");
                                            printoption("Ms.", $title, "Ms.");
                                        ?></SELECT>

                                    <!--
                                                                        <input < php echo $is_disabled ?> name="title" type="text"
                                                                                                          placeholder="eg. Mr"
                                                                                                          class="form-control req_driver" < php if (isset($p->title)) { ?> value="< php echo $p->title; ?>" < php } ?> /> -->
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">

                                    <label class="control-label">First Name : </label>
                                    <input <?php echo $is_disabled ?> name="fname" type="text"
                                                                      placeholder=""
                                                                      class="form-control req_driver" <?php if (isset($p->fname)) { ?>
                                        value="<?php echo $p->fname; ?>" <?php } ?>/>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">

                                    <label class="control-label">Middle Name : </label>
                                    <input <?php echo $is_disabled ?> name="mname" type="text"
                                                                      placeholder=""
                                                                      class="form-control" <?php if (isset($p->mname)) { ?>
                                        value="<?php echo $p->mname; ?>" <?php } ?>/>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Last Name : </label>
                                    <input <?php echo $is_disabled ?> name="lname" type="text"
                                                                      placeholder=""
                                                                      class="form-control req_driver" <?php if (isset($p->lname)) { ?>
                                        value="<?php echo $p->lname; ?>" <?php } ?>/>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">

                                    <label class="control-label">Phone Number : </label>
                                    <input <?php echo $is_disabled ?> name="phone" type="text"
                                                                      placeholder=""
                                                                      class="form-control req_driver" <?php if (isset($p->phone)) { ?>
                                        value="<?php echo $p->phone; ?>" <?php } ?>/>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">

                                    <label class="control-label">Gender : </label>
                                    <SELECT <?php echo $is_disabled ?> name="gender"
                                                                       class="form-control req_driver"><?php
                                            $gender = "";
                                            if (isset($p->gender)) {
                                                $gender = $p->gender;
                                            }
                                            echo '<!-- selected option is ' . $gender . '-->';
                                            printoption("Select Gender", "");
                                            printoption("Male", $gender, "Male");
                                            printoption("Female", $gender, "Female");
                                        ?></SELECT>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">

                                    <label class="control-label">Place of Birth : </label>
                                    <input <?php echo $is_disabled ?> name="placeofbirth" type="text" placeholder=""
                                                                      class="form-control req_driver" <?php if (isset($p->placeofbirth)) { ?>
                                        value="<?php echo $p->placeofbirth; ?>" <?php } ?>/>
                                </div>
                            </div>

                            <div class="col-md-9">

                                <div class="form-group">
                                    <label class="control-label">Date of Birth (YYYY MM DD) : </label><BR>

                                    <div class="row">


                                        <div class="col-md-4 no-margin">
                                            <?php



                                                $currentyear = "0000";
                                                $currentmonth = 0;
                                                $currentday = 0;

                                                if (isset($p->dob)) {
                                                    $currentyear = substr($p->dob, 0, 4);
                                                    $currentmonth = substr($p->dob, 5, 2);
                                                    $currentday = substr($p->dob, -2);
                                                }


                                                echo '<select class="form-control req_driver " NAME="doby" ' . $is_disabled . '>';

                                                $now = date("Y");
                                                for ($temp = $now;
                                                     $temp > 1899;
                                                     $temp -= 1) {
                                                    printoption($temp, $currentyear, $temp);
                                                }
                                                echo '</select></div><div class="col-md-4">';


                                                echo '<select  class="form-control req_driver " NAME="dobm" ' . $is_disabled . '>';
                                                $monthnames = array("Jan", "Feb", "Mar", "Apr", "May", "June", "July", "Aug", "Sept", "Oct", "Nov", "Dec");
                                                for ($temp = 1;
                                                     $temp < 13;
                                                     $temp += 1) {
                                                    if ($temp < 10)
                                                        $temp = "0" . $temp;
                                                    printoption($temp, $currentmonth, $temp);
                                                }
                                                echo '</select></div><div class="col-md-4">';


                                                echo '<select class="form-control req_driver " name="dobd" ' . $is_disabled . '>';
                                                for ($temp = 1;
                                                     $temp < 32;
                                                     $temp++) {
                                                    if ($temp < 10)
                                                        $temp = "0" . $temp;
                                                    printoption($temp, $currentday, $temp);
                                                }

                                                echo '</select></div>';
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h3 class="">Address : </h3>
                                    </div>
                                </div>


                                <div class="col-md-8">
                                    <div class="form-group">
                                        <input <?php echo $is_disabled ?> name="street" type="text"
                                                                          placeholder="Address"
                                                                          class="form-control req_driver" <?php if (isset($p->street)) { ?>
                                            value="<?php echo $p->street; ?>" <?php } ?>/>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input <?php echo $is_disabled ?> name="city" type="text"
                                                                          placeholder="City"
                                                                          class="form-control req_driver" <?php if (isset($p->city)) { ?>
                                            value="<?php echo $p->city; ?>" <?php } ?>/>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php
                                            if (isset($p->province))
                                                printprovinces("province", $p->province, $is_disabled, false);
                                            else
                                                printprovinces("province", "", $is_disabled, false);
                                        ?>

                                        <!-- old
                                        <SELECT  < php echo $is_disabled ?> name="province" class="form-control ">< php
                                                $provinces = array("AB", "BC", "MB", "NB", "NL", "NT", "NS", "NU", "ON", "PE", "QC", "SK", "YT");
                                                $province = "";
                                                if (isset($p->province)) {
                                                    $province = $p->province;
                                                }
                                                for ($temp = 0; $temp < count($provinces); $temp += 1) {
                                                    printoption($provinces[$temp], $province, $provinces[$temp]);
                                                }
                                            ?></SELECT>
                                                <input < php echo $is_disabled ?> name="province" type="text"
                                                                                   placeholder="Province"
                                                                                   class="form-control req_driver" < php if (isset($p->province)) { ?> value="< php echo $p->province; ?>" < php } ?>/> -->
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input <?php echo $is_disabled ?>  type="text"
                                                                           placeholder="Postal code"
                                                                           class="form-control req_driver"
                                                                           name="postal"  <?php if (isset($p->postal)) { ?>
                                            value="<?php echo $p->postal; ?>" <?php } ?>/>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input <?php echo $is_disabled ?>  type="text"
                                                                           placeholder="Country" value="Canada"
                                                                           class="form-control req_driver"
                                                                           name="country" <?php if (isset($p->country)) { ?>
                                            value="<?php echo $p->country; ?>" <?php } ?>/>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h3 class="block">Driver's License : </h3></div>
                                </div>


                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Driver's License # : </label>
                                        <input <?php echo $is_disabled ?> name="driver_license_no" type="text"
                                                                          class="form-control req_driver" <?php if (isset($p->driver_license_no)) { ?>
                                            value="<?php echo $p->driver_license_no; ?>" <?php } ?> />
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Province issued : </label>

                                        <?php
                                            if (isset($p->driver_province))
                                                printprovinces("driver_province", $p->driver_province, $is_disabled, true);
                                            else
                                                printprovinces("driver_province", "", $is_disabled, true);
                                        ?>


                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Expiry Date : </label>
                                        <input <?php echo $is_disabled ?> name="expiry_date" type="text"
                                                                          class="form-control req_driver date-picker"
                                                                          value="<?php if (isset($p->expiry_date)) echo $p->expiry_date; ?>"/>


                                </div>
                            </div>
                            <?php }
                                else
                                { ?>
                                <input type="hidden" name="doby" value="0000"/>
                                <input type="hidden" name="dobm" value="00"/>
                                <input type="hidden" name="dobd" value="00"/>
                            <?php
                                }
                                $delete = isset($disabled);
                                if (isset($client_docs)) {
                                    include_once 'subpages/filelist.php';
                                    listfiles($client_docs, "img/jobs/",'profile_doc',$delete);
                                }
                            ?>

                           
                        <?php
                                //if (!isset($disabled)) { 
                            ?>
                             <div class="form-group col-md-12"><!--<center>-->

                                <div class="docMore col-md-12" data-count="1">
                                <div class="">
                                    <div style="display:block;">
                                        <a href="javascript:void(0)" id="addMore1" class="btn btn-primary" >Browse</a>
                                         <input type="hidden" name="profile_doc[]" value="" class="addMore1_doc moredocs"/>
                                         <a href="javascript:void(0);" class ="btn btn-danger img_delete" id="delete_addMore1" title ="" style="display: none;">Delete</a>
                                         <span></span>

                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group col-md-12"><!--<center>-->

                                    <a href="javascript:void(0)" class="btn btn-info" id="addMoredoc">
                                        Add More
                                    </a>
                                </div>


                                <div class="col-md-12" align="right">


                                    <a href="javascript:void(0)" class="btn btn-primary"
                                       onclick="return check_username();" id="savepro">
                                        Save Changes
                                    </a>
                                    <!--button class="btn btn-info"
                                            onclick="$('#profile_drafts').val('1'); $('#save_clientz').attr('novalidate','novalidate');$('#hiddensub').click();">
                                        Save As Draft
                                    </button-->
                                    <input type="submit" style="display: none;" id="hiddensub"/>
                                </div>

                                <div class="clearfix"></div>
                                <?php //} ?>


                    </form>

                    <div class="clearfix"></div>

                </div>

            </div>

        </div>
    </div>
    <?php
        if ($this->request->params['action'] == 'edit') {

        } else {
            ?>
            <!--div class="tab-pane" id="subtab_4_3">
                <p>Please save info first.</p>
            </div-->

        <?php
        }
    ?>


</div>
<script>
    function check_username() {
        if ($('#retype_password').val() == $('#password').val()) {

            var client_id = $('.client_profile_id').val();
            if (client_id == "") {

            }
            var un = $('.uname').val();

            $.ajax({
                url: '<?php echo $this->request->webroot;?>profiles/check_user/<?php echo $uid;?>',
                data: 'username=' + $('.uname').val(),
                type: 'post',
                success: function (res) {
                    res = res.trim();
                    if (res == '1') {
                        //alert(res);
                        alert('Username already exists');

                        $('.uname').focus();
                        $('html,body').animate({
                                scrollTop: $('.page-title').offset().top
                            },
                            'slow');

                        return false;
                    }
                    else {
                        $('.flashUser').hide();
                        if ($('.email').val() != '') {
                            var un = $('.email').val();
                            $.ajax({
                                url: '<?php echo $this->request->webroot;?>profiles/check_email/<?php echo $uid;?>',
                                data: 'email=' + $('.email').val(),
                                type: 'post',
                                success: function (res) {
                                    res = res.trim();
                                    if (res == '1') {
                                        $('.email').focus();
                                        alert('Email already exists');
                                        $('html,body').animate({
                                                scrollTop: $('.page-title').offset().top
                                            },
                                            'slow');

                                        return false;
                                    }
                                    else {
                                        $(this).attr('disabled', 'disabled');
                                        $('#hiddensub').click();
                                    }
                                }
                            });
                        }
                        else {
                            $('#hiddensub').click();
                        }
                    }
                }
            });


        }
        else {
            $('#retype_password').focus();
            $('html,body').animate({
                    scrollTop: $('.page-title').offset().top
                },
                'slow');
            $('.flashPass1').show();
            //$('.flashPass1').fadeOut(7000000);
            return false;
        }

    }
    $(function () {
        initiate_ajax_upload1('addMore1', 'doc');

         $('#addMoredoc').click(function () {
        var total_count = $('.docMore').data('count');
        $('.docMore').data('count', parseInt(total_count) + 1);
        total_count = $('.docMore').data('count');
        var input_field = '<div  class="form-group" ><div class="" style="margin-top:10px;"><a href="javascript:void(0);" id="addMore' + total_count + '" class="btn btn-primary">Browse</a><input type="hidden" name="profile_doc[]" value="" class="addMore' + total_count + '_doc moredocs" /><a href="javascript:void(0);" class = "btn btn-danger img_delete" id="delete_addMore' + total_count + '" title ="">Delete</a><span></span></div></div>';
        $('.docMore').append(input_field);
        initiate_ajax_upload1('addMore' + total_count, 'doc');

        });
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
                    url: "<?php echo $this->request->webroot;?>profiles/removefiles/" + file,
                    success: function (msg) {

                    }
                });
                $(this).parent().parent().remove();

            }
            else
                return false;
        });
        $('#save_clientz').submit(function (event) {
            event.preventDefault();
            $('#savepro').text("Saving...");
            var strs = $(this).serialize();
            $('#save_clientz').each(function () {
                strs = strs + '&' + $(this).attr('name') + '=' + $(this).val();
            });
            $(':disabled[name]').each(function () {
                strs = strs + '&' + $(this).attr('name') + '=' + $(this).val();
            });

            var adds = "<?php echo ($this->request['action']=='add')?'0':$this->request['pass'][0];?>";
            $.ajax({
                url: '<?php echo $this->request->webroot;?>profiles/saveprofile/' + adds,
                data: strs,
                type: 'post',
                success: function (res) {
                    res = res.replace(' ','');
                    if (res != 0) {
                        $('#savepro').text("Save Changes");
                        $('.flash').show();
                        $('.flash').fadeOut(3500);
                        window.location.href = '<?php echo $this->request->webroot;?>profiles/edit/' + res;
                    }
                }

            });

            return false;

        });
        $('#addmore_id').click(function () {
            $('#more_id_div').append('<div id="append_id"><div class="pad_bot"><a href="" class="btn btn-primary">Browse</a> <a href="javascript:void(0);" id="delete_id_div" class="btn btn-danger">Delete</a></div></div>')
        });

        $('#delete_id_div').live('click', function () {
            $(this).closest('#append_id').remove();
        })

        $('#addmore_trans').click(function () {
            $('#more_trans_div').append('<div id="append_trans"><div class="pad_bot"><a href="" class="btn btn-primary">Browse</a> <a href="javascript:void(0);" id="delete_trans_div" class="btn btn-danger">Delete</a></div></div>')
        });

        $('#delete_trans_div').live('click', function () {
            $(this).closest('#append_trans').remove();
        })

        $('.member_type').change(function () {
            if ($(this).val() == '5' || $(this).val() == '7' || $(this).val() == '8') {
                $('.req_driver').each(function () {
                    $(this).prop('required', "required");
                    //alert($(this).attr('name'));
                });
                //$('.nav-tabs li:not(.active)').each(function () {
                //  $(this).hide();
                //});
                $('#driver_div').show();
                $('#isb_id').hide();
                //$('.username_div').hide();
                //$('#username_field').attr('disabled','disabled');
                //$('.un').removeProp('required');
                $('#password').removeProp('required');
                $('#retype_password').removeProp('required');
                $('.req_rec').removeProp('required');

            }
            else {
                $('.nav-tabs li:not(.active)').each(function () {
                    $(this).show();
                });
                $('#driver_div').hide();
                $('#isb_id').hide();
                //$('.username_div').show();
                $('.req_driver').removeProp('required');
                $('.req_rec').removeProp('required');
                //$('#username_field').removeAttr('disabled');
                //$('.un').prop('required', "required");
                <?php
                if(isset($p->password) && $p->password)
                {
                    //do nth
                }
                else{
                    ?>

                $('#password').prop('required', "required");
                $('#retype_password').prop('required', "required");
                <?php
                }
                 ?>
            }

            if ($(this).val() == '2') {
                $('#isb_id').show();
                $('.req_driver').removeProp('required');
                //$('.un').removeProp('required');
                $('.req_rec').prop('required', "required");
            }

        });

        var mem_type = $('.member_type').val();
        if (!isNaN(parseFloat(mem_type)) && isFinite(mem_type)) {
            if (mem_type == '5' || mem_type == '7' || mem_type == '8') {
                $('.req_driver').each(function () {
                    $(this).prop('required', "required");
                    //alert($(this).attr('name'));
                    //});
                    //$('.nav-tabs li:not(.active)').each(function () {
                    //  $(this).hide();
                });
                $('#driver_div').show();
                $('#isb_id').hide();
                //$('.username_div').hide();
                //$('.un').removeProp('required');
                $('#password').removeProp('required');
                $('#retype_password').removeProp('required');
                //$('#username_field').attr('disabled','disabled');
                $('.req_rec').removeProp('required');

            }
            else {
                $('.nav-tabs li:not(.active)').each(function () {
                    $(this).show();
                });
                $('#driver_div').hide();
                //$('.username_div').show();
                $('#isb_id').hide();
                $('.req_driver').removeProp('required');
                $('.req_rec').removeProp('required');
                //$('#username_field').removeAttr('disabled');
                //$('.un').prop('required', "required");
                <?php
                if(isset($p->password) && $p->password)
                {
                    //do nth
                }
                else{
                    ?>

                $('#password').prop('required', "required");
                $('#retype_password').prop('required', "required");
                <?php
                }
                 ?>
            }

            if (mem_type == '2') {
                $('#isb_id').show();
                $('.req_driver').removeProp('required');
                //$('.un').removeProp('required');
                $('.req_rec').prop('required', "required");
            }
        }
    });


    function initiate_ajax_upload1(button_id, doc) {

        var button = $('#' + button_id), interval;
        if (doc == 'doc')
            var act = "<?php echo $this->request->webroot;?>profiles/upload_all/<?php if(isset($id))echo $id;?>";
        else
            var act = "<?php echo $this->request->webroot;?>profiles/upload_img/<?php if(isset($id))echo $id;?>";
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
                    if (button_id == 'addMore1')
                        $('#delete_' + button_id).show();
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

</div>

<!-- </div> END PORTLET-->