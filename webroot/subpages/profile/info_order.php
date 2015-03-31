 <?php
 if($_SERVER['SERVER_NAME'] =='localhost')
        echo "<span style ='color:red;'>info_order.php #INC152</span>";
 ?>
<style>div {
        border: 0px solid green;
    }</style>

<?php
    $getProfileType = $this->requestAction('profiles/getProfileType/' . $this->Session->read('Profile.id'));
    $sidebar = $this->requestAction("settings/all_settings/" . $this->request->session()->read('Profile.id') . "/sidebar");

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

    function printoptions($name, $valuearray, $selected = "", $optionarray, $isdisabled = "")
    {
        echo '<SELECT ' . $isdisabled . ' name="' . $name . '" class="form-control member_type required" >';
        for ($temp = 0; $temp < count($valuearray); $temp += 1) {
            printoption2($valuearray[$temp], $selected, $optionarray[$temp]);
        }
        echo '</SELECT>';
    }

    function printprovinces($name, $selected = "", $isdisabled = "")
    {
        printoptions($name, array("", "AB", "BC", "MB", "NB", "NL", "NT", "NS", "NU", "ON", "PE", "QC", "SK", "YT"), $selected, array("Select Province", "Alberta", "British Columbia", "Manitoba", "New Brunswick", "Newfoundland and Labrador", "Northwest Territories", "Nova Scotia", "Nunavut", "Ontario", "Prince Edward Island", "Quebec", "Saskatchewan", "Yukon Territories"), $isdisabled);
    }

?>

<div>

    <div class="portlet-body">
        <div class="createDriver">
            <div class="portlet box form">
                <input type="hidden" name="document_type" value="add_driver"/>

                <form role="form" action="" method="post" id="createDriver">

                    <input type="hidden" name="client_ids" value="<?php echo $cid; ?>" class="client_profile_id"/>
                    <input type="hidden" name="id" value="<?php if (isset($p->id)) echo $p->id; else echo 0; ?>"
                           class="driver_id"/>

                    <div class="row">
                        <div class="col-md-3">

                            <div style="display:inline-block;border-radius:30px;"><img id="clientpic"
                                                                                       class="img-responsive"
                                                                                       style="height: auto;width: 150px;margin-left:15px;"
                                                                                       alt=""
                                                                                       src="<?php echo $this->request->webroot; ?>img/profile/default.png"/>
                            </div>
                        </div>
                        <div class="col-md-9">

                            <div class="clearfix"></div>
                            <input type="hidden" name="created_by"
                                   value="<?php echo $this->request->session()->read('Profile.id') ?>"/>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Profile Type</label>

                                    <select name="profile_type" class="form-control member_type required">
                                        <option
                                            value="5" <?php if (isset($p) && $p->profile_type == 5) { ?> selected="selected" <?php }  ?>>
                                            Driver
                                        </option>
                                        <option
                                            value="7" <?php if (isset($p) && $p->profile_type == 7) { ?> selected="selected" <?php }  ?>>
                                            Owner Operator
                                        </option>
                                        <option
                                            value="8" <?php if (isset($p) && $p->profile_type == 8) { ?> selected="selected" <?php }  ?>>
                                            Owner Driver
                                        </option>

                                    </select>

                                </div>
                            </div>
                            <?php if ($sidebar->client_option == 0 /*&& (isset($p) && $p->profile_type == 5)*/) { ?>

                                <div class="col-md-4" id="driver_div"
                                     style="">
                                    <div class="form-group">
                                        <label class="control-label">Driver Type</label>
                                        <select name="driver" class="form-control select_driver required">
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
                            <?php } ?>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Email</label>
                                    <input <?php echo $is_disabled ?> name="email" id="driverEm" type="email"
                                                                      placeholder="eg. test@domain.com"
                                                                      class="form-control un email required" <?php if (isset($p->email)) { ?> value="<?php echo $p->email; ?>" <?php } ?>/>
                            <span class="error passerror flashEmail"
                                  style="display: none;">Email already exists</span>
                                </div>
                            </div>
                            <div class="clearfix flashEmail" style="display: none;">
                            </div>


                            <div class="clearfix">
                            </div>
                            <?php if ($sidebar->client_option == 0) { ?>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Title</label><BR>
                                    <SELECT <?php echo $is_disabled ?> name="title" class="form-control "><?php
                                            $title = "";
                                            if (isset($p->title)) {
                                                $title = $p->title;
                                            }
                                            printoption("Mr.", $title, "Mr");
                                            printoption("Mrs.", $title, "Mrs");
                                            printoption("Ms.", $title, "Ms");
                                        ?></SELECT>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">

                                    <label class="control-label">First Name</label>
                                    <input <?php echo $is_disabled ?> name="fname" type="text"
                                                                      placeholder="eg. John"
                                                                      class="form-control req_driver required" <?php if (isset($p->fname)) { ?> value="<?php echo $p->fname; ?>" <?php } ?>/>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">

                                    <label class="control-label">Middle Name</label>
                                    <input <?php echo $is_disabled ?> name="mname" type="text"
                                                                      placeholder=""
                                                                      class="form-control" <?php if (isset($p->mname)) { ?> value="<?php echo $p->mname; ?>" <?php } ?>/>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Last Name</label>
                                    <input <?php echo $is_disabled ?> name="lname" type="text"
                                                                      placeholder="eg. Doe"
                                                                      class="form-control req_driver required" <?php if (isset($p->lname)) { ?> value="<?php echo $p->lname; ?>" <?php } ?>/>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">

                                    <label class="control-label">Phone Number</label>
                                    <input <?php echo $is_disabled ?> name="phone" type="text"
                                                                      placeholder="eg. +1 646 580 6284"
                                                                      class="form-control req_driver required" <?php if (isset($p->phone)) { ?> value="<?php echo $p->phone; ?>" <?php } ?>/>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">

                                    <label class="control-label">Gender</label>
                                    <SELECT <?php echo $is_disabled ?> name="gender" class="form-control "><?php
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


                            <div class="col-md-4">
                                <div class="form-group">

                                    <label class="control-label">Place of Birth</label>
                                    <input <?php echo $is_disabled ?> name="placeofbirth" type="text"
                                                                      placeholder=""
                                                                      class="form-control" <?php if (isset($p->placeofbirth)) { ?> value="<?php echo $p->placeofbirth; ?>" <?php } ?>/>
                                </div>
                            </div>

                            <div class="col-md-8">

                                <div class="form-group">
                                    <label class="control-label">Date of Birth (YYYY MM DD)</label><BR>

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


                                                echo '<select class="form-control req_driver required" NAME="doby" ' . $is_disabled . '>';

                                                $now = date("Y");
                                                for ($temp = $now; $temp > 1899; $temp -= 1) {
                                                    printoption($temp, $currentyear, $temp);
                                                }
                                                echo '</select></div><div class="col-md-4">';


                                                echo '<select  class="form-control req_driver required" NAME="dobm" ' . $is_disabled . '>';
                                                $monthnames = array("Jan", "Feb", "Mar", "Apr", "May", "June", "July", "Aug", "Sept", "Oct", "Nov", "Dec");
                                                for ($temp = 1; $temp < 13; $temp += 1) {
                                                    if ($temp < 10)
                                                        $temp = "0" . $temp;
                                                    printoption($temp, $currentmonth, $temp);
                                                }
                                                echo '</select></div><div class="col-md-4">';


                                                echo '<select class="form-control req_driver required" name="dobd" ' . $is_disabled . '>';
                                                for ($temp = 1; $temp < 32; $temp++) {
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
                                        <h3 class="block">Address</h3>
                                    </div>
                                </div>


                                <div class="col-md-8">
                                    <div class="form-group">
                                        <input <?php echo $is_disabled ?> name="street" type="text"
                                                                          placeholder="Street"
                                                                          class="form-control req_driver required" <?php if (isset($p->street)) { ?> value="<?php echo $p->street; ?>" <?php } ?>/>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input <?php echo $is_disabled ?> name="city" type="text"
                                                                          placeholder="City"
                                                                          class="form-control req_driver required" <?php if (isset($p->city)) { ?> value="<?php echo $p->city; ?>" <?php } ?>/>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php
                                            if (isset($p->province))
                                                printprovinces("province", $p->province, $is_disabled);
                                            else
                                                printprovinces("province", "", $is_disabled);
                                        ?>


                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input <?php echo $is_disabled ?>  type="text"
                                                                           placeholder="Postal code"
                                                                           class="form-control req_driver required"
                                                                           name="postal"  <?php if (isset($p->postal)) { ?> value="<?php echo $p->postal; ?>" <?php } ?>/>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input <?php echo $is_disabled ?>  type="text"
                                                                           placeholder="Country" value="Canada"
                                                                           class="form-control req_driver required"
                                                                           name="country" <?php if (isset($p->country)) { ?> value="<?php echo $p->country; ?>" <?php } ?>/>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h3 class="block">Driver's License</h3></div>
                                </div>


                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Driver License #</label>
                                        <input <?php echo $is_disabled ?> name="driver_license_no" type="text"
                                                                          class="form-control req_driver required" <?php if (isset($p->driver_license_no)) { ?> value="<?php echo $p->driver_license_no; ?>" <?php } ?> />
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Province issued</label>

                                        <?php
                                            if (isset($p->driver_province))
                                                printprovinces("driver_province", $p->driver_province, $is_disabled);
                                            else
                                                printprovinces("driver_province", "", $is_disabled);
                                        ?>


                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Expiry Date</label>
                                        <input <?php echo $is_disabled ?> name="expiry_date" type="text"
                                                                          class="form-control req_driver date-picker required" <?php if (isset($p->expiry_date)) { ?> value="<?php echo $p->expiry_date; ?>" <?php } ?> />

                                    </div>
                                </div>
                                <?php }
                                    else {
                                        ?>
                                        <input type="hidden" name="doby" value="0000"/>
                                        <input type="hidden" name="dobm" value="00"/>
                                        <input type="hidden" name="dobd" value="00"/>
                                    <?php
                                    }
                                ?>


                </form>

                <div class="clearfix"></div>


            </div>
        </div>


    </div>


</div>


</div>
</div>

<script>

    $(function () {

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
                $('.nav-tabs li:not(.active)').each(function () {
                    $(this).hide();
                });
                $('#driver_div').show();
                $('#driver_div select').addClass('required');
                $('.un').removeProp('required');
                $('#password').removeProp('required');
                $('#retype_password').removeProp('required');
                $('.req_rec').removeProp('required');
                $('.req_driver').prop('required', "required");
            }
            else {
                $('#driver_div select').removeClass('required');
                $('.nav-tabs li:not(.active)').each(function () {
                    $(this).show();
                });
                $('#driver_div').hide();
                $('.req_driver').removeProp('required');
                $('.req_rec').removeProp('required');
                $('.un').prop('required', "required");
            }

            if ($(this).val() == '2') {
                $('.req_driver').removeProp('required');
                $('.un').removeProp('required');
                $('.req_rec').prop('required', "required");
            }

        });
    });
</script>


<!-- END PORTLET-->