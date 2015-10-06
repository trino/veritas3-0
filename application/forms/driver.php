<?php $strings2 = CacheTranslations($language, array("verifs_%", "tasks_date", "file_attachfile", "file_download"), $settings, False); ?>
<div class="form-group row col-md-12 splitcols" ID="GNDN">
    <input type="hidden" name="MAX_FILE_SIZE" value="6553600" title="50 megabytes" />
    <div class="col-md-4"><label class="control-label">Your Username: </label>
        <input type="text" class="form-control required" required name="username" />
    </div>
    <div class="col-md-4"><label class="control-label">Your <?= $strings["forms_password"]; ?>: </label>
        <input type="password" class="form-control required" required name="password" />
    </div>
    <!--div class="col-md-4"><label class="control-label"><?= $strings["forms_retypepassword"]; ?>: </label>
        <input type="text" class="form-control required" required name="password2" />
    </div-->
    <div class="col-md-4"><label class="control-label required"><?= $strings["forms_firstname"]; ?>: </label>
        <input type="text" class="form-control required" required name="fname" />
    </div>
    <div class="col-md-4"><label class="control-label required"><?= $strings["forms_middlename"]; ?>: </label>
        <input type="text" class="form-control required" required name="mname" />
    </div>
    <div class="col-md-4"><label class="control-label required"><?= $strings["forms_lastname"]; ?>: </label>
        <input type="text" class="form-control required" required name="lname" />
    </div>
    <div class="col-md-4"><label class="control-label required"><?= $strings["forms_gender"]; ?>: </label>
        <SELECT class="form-control required" name="gender" />
            <OPTION>Male</OPTION>
            <OPTION>Female</OPTION>
        </SELECT>
    </div>
    <div class="col-md-4"><label class="control-label required"><?= $strings["forms_title"]; ?>: </label>
        <SELECT class="form-control required" name="title" />
            <OPTION>Mr.</OPTION>
            <OPTION>Ms.</OPTION>
            <OPTION>Mrs.</OPTION>
        </SELECT>
    </div>

    <div class="col-md-4"><label class="control-label required"><?= $strings["forms_email"]; ?>: </label>
        <input type="text" class="form-control required" required name="email" role="email" />
    </div>

    <div class="col-md-4"><label class="control-label required"><?= $strings["forms_phone"]; ?>: </label>
        <input type="text" class="form-control required" required name="phone" role="phone" />
    </div>
    <div class="col-md-4"><label class="control-label required"><?= $strings["forms_address"]; ?>: </label>
        <input type="text" class="form-control required" required name="street" />
    </div>
    <div class="col-md-4"><label class="control-label required"><?= $strings["forms_city"]; ?>: </label>
        <input type="text" class="form-control required" required name="city" />
    </div>
    <div class="col-md-4"><label class="control-label required"><?= $strings["forms_provincestate"]; ?>: </label>
        <?php provinces("province"); ?>
    </div>
    <div class="col-md-4"><label class="control-label required"><?= $strings["forms_postalcode"]; ?>: </label>
        <input type="text" class="form-control required" required name="postal" role="postalcode" />
    </div>
    <div class="col-md-4"><label class="control-label required"><?= $strings["forms_country"]; ?>: </label>
        <input type="text" class="form-control required" required name="country" value="Canada"/>
    </div>
    <div class="col-md-4"><label class="control-label required"><?= $strings["forms_dateofbirth"]; ?>: </label>
        <input type="text" class="form-control required datepicker date-picker" required name="dob" />
    </div>
    <div class="col-md-4"><label class="control-label required"><?= $strings["forms_driverslicense"]; ?>: </label>
        <input type="text" class="form-control required" required name="driver_license_no" />
    </div>
    <div class="col-md-4"><label class="control-label required"><?= $strings["forms_provinceissued"]; ?>: </label>
        <?php provinces("driver_province"); ?>
    </div>
    <div class="col-md-4"><label class="control-label required">Client: </label>
        <SELECT class="form-control required" name="clientid" />
            <?php
                $result = Query("SELECT * FROM clients");
                while ($Data = mysqli_fetch_array($result)) {
                      echo '<OPTION VALUE="' . $Data["id"] . '"';
                      if (left(strtolower($Data["company_name"]), 5) == "huron"){echo " SELECTED";}
                      echo '>' . $Data["company_name"] . '</OPTION>';
                }
            ?>
        </SELECT>
    </div>

    <div class="col-md-12"><label class="control-label required">Products: </label>
        <input type="text" class="form-control" required name="forms" id="forms" READONLY/>
        <TABLE WIDTH="100%">
            <TR>
                <?php
                    $result = Query("SELECT * FROM order_products");
                    $Index = 0;
                    $Products = array();
                    while ($Data = mysqli_fetch_array($result)) {
                        if($Index==4){
                            echo '</TR><TR>';
                            $Index=0;
                        }
                        $Products[] = $Data["number"];
                        echo '<TD><LABEL><INPUT TYPE="CHECKBOX" ONCLICK="product(' . $Data["number"] . ');" ID="CHK' . $Data["number"] . '" CHECKED>' . $Data["title"] .  '</LABEL></TD>';
                        $Index++;
                    }
                    $Products = implode(",", $Products);
                ?>
            </TR>
        </TABLE>
    </DIV>
    <div class="col-md-4"><label class="control-label required">Order type: </label>
        <SELECT class="form-control required" name="ordertype" disabled/>
            <?php
                $result = Query("SELECT * FROM product_types");
                while ($Data = mysqli_fetch_array($result)) {
                    echo '<OPTION VALUE="' . $Data["Acronym"] . '"';
                    if($Data["Acronym"] == "CAR"){ echo ' SELECTED';}
                    echo '>(' . $Data["Acronym"] . ') ' . $Data["Name"] . '</OPTION>';
                }
            ?>
        </SELECT>
    </div>

    <div class="col-md-4" style="display: none"><label class="control-label required">Base64-encoded Driver ID file: </label>
        <TEXTAREA NAME="driverphotoBASE" class="form-control" title="Leave 'Upload Driver ID file' blank"></TEXTAREA>
    </DIV>
    <div class="col-md-4"><label class="control-label required">Upload Driver ID file: </label>
        <INPUT TYPE="file" name="driverphotoFILE" class="form-control" title="Will over-write 'Base64-encoded Driver ID file'" />
    </div>

    <div class="col-md-4" style="display: none"><label class="control-label required">Base64-encoded signature file: </label>
        <TEXTAREA NAME="signatureBASE" class="form-control" title="Leave 'Upload signature file' blank"></TEXTAREA>
    </DIV>
    <div class="col-md-4" style="display: none"><label class="control-label required">Upload signature file: </label>
        <INPUT TYPE="file" name="signatureFILE" class="form-control" title="Will over-write 'Base64-encoded signature file'" />
    </div>

    <div class="col-md-4" style="display: none"><label class="control-label required">Base64-encoded Consent form file: </label>
        <TEXTAREA NAME="consentBASE" class="form-control" title="Leave 'Upload Consent form file' blank"></TEXTAREA>
    </DIV>
    <div class="col-md-4"><label class="control-label required">Upload Consent form file: </label>
        <INPUT TYPE="file" name="consentFILE" class="form-control" title="Will over-write  'Base64-encoded Consent form file'" />
    </div>
</div>
<div class="clearfix"></div>
<div class="form-group row">
    <label class="control-label col-md-4">Add a form:</label>
    <div class="col-md-8">
        <INPUT TYPE="BUTTON" CLASS="btn btn-info btn-xs" onclick="addform(9);" value="Letter of Experience">&nbsp;&nbsp;
        <INPUT TYPE="BUTTON" CLASS="btn btn-info btn-xs" onclick="addform(10);" value="Education Verification">
    </div>
</div>
<SCRIPT LANGUAGE="JavaScript">
    var FormID = 0;
    function addform(formname){
        var element = document.getElementById("GNDN"), Title;
        var Form = createArray(2);
        switch(formname){
            case 9:
                Title = "Letter of Experience";
                Form[0] = ['<?= addslashes($strings["forms_companyname"]); ?>', 'text', 'form[' + FormID + '][company_name]', true];
                Form[1] = ['<?= addslashes($strings["forms_address"]); ?>', 'text', 'form[' + FormID + '][address]', false];
                Form[2] = ['<?= addslashes($strings["forms_city"]); ?>', 'text', 'form[' + FormID + '][city]', false];
                Form[3] = ['<?= addslashes($strings["forms_provincestate"]); ?>', 'text', 'form[' + FormID + '][state_province]', false];
                Form[4] = ['<?= addslashes($strings["forms_country"]); ?>', 'text', 'form[' + FormID + '][country]', false];
                Form[5] = ['<?= addslashes($strings["verifs_supername"]); ?>', 'text', 'form[' + FormID + '][supervisor_name]', false];
                Form[6] = ['<?= addslashes($strings["forms_phone"]); ?>', 'text', 'form[' + FormID + '][supervisor_phone]', false];
                Form[7] = ['<?= addslashes($strings["verifs_superemail"]); ?>', 'text', 'form[' + FormID + '][supervisor_email]', false];
                Form[8] = ['<?= addslashes($strings["verifs_secondarye"]); ?>', 'text', 'form[' + FormID + '][supervisor_secondary_email]', false];
                Form[9] = ['<?= addslashes($strings["verifs_employment"]); ?>', 'date', 'form[' + FormID + '][employment_start_date]', true];
                Form[10] = ['<?= addslashes($strings["verifs_employment2"]); ?>', 'date', 'form[' + FormID + '][employment_end_date]', true];
                Form[11] = ['<?= addslashes($strings["verifs_claimswith"]); ?>', 'radio', 'form[' + FormID + '][claims_with_employer]', false,
                    [0, '<?= addslashes($strings["dashboard_negative"]); ?>'],
                    [1, '<?= addslashes($strings["dashboard_affirmative"]); ?>']
                ];
                Form[12] = ['<?= addslashes($strings["verifs_dateclaims"]); ?>', 'date', 'form[' + FormID + '][claims_recovery_date]', false];
                Form[13] = ['<?= addslashes($strings["verifs_employment3"]); ?>', 'hidden', 'form[' + FormID + '][emploment_history_confirm_verify_use]', false];
                Form[14] = ['US DOT MC/MX#', 'text', 'form[' + FormID + '][us_dot]', false];
                Form[15] = ['<?= addslashes($strings["forms_signature"]); ?>', 'hidden', 'form[' + FormID + '][signature]', false];
                Form[16] = ['<?= addslashes($strings["verifs_date"]); ?>', 'date', 'form[' + FormID + '][signature_datetime]', false, '<?= date("m/d/Y"); ?>'];
                Form[17] = ['<?= addslashes($strings["verifs_equipmento"]); ?>', 'checkbox', '', false,
                    [1, '<?= addslashes($strings["verifs_vans"]); ?>', 'form[' + FormID + '][equipment_vans]'],
                    [1, '<?= addslashes($strings["verifs_reefers"]); ?>',  'form[' + FormID + '][equipment_reefer]'],
                    [1, '<?= addslashes($strings["verifs_decks"]); ?>', 'form[' + FormID + '][equipment_decks]'],
                    [1, '<?= addslashes($strings["verifs_superbs"]); ?>', 'form[' + FormID + '][equipment_super]'],
                    [1, '<?= addslashes($strings["verifs_straighttr"]); ?>', 'form[' + FormID + '][equipment_straight_truck]'],
                    [1, '<?= addslashes($strings["verifs_others"]); ?>', 'form[' + FormID + '][equipment_others]']
                ];
                Form[18] = ['<?= addslashes($strings["verifs_drivingexp"]); ?>', 'checkbox', '', false,
                    [1, '<?= addslashes($strings["verifs_local"]); ?>', 'form[' + FormID + '][driving_experince_local]'],
                    [1, '<?= addslashes($strings["verifs_canada"]); ?>', 'form[' + FormID + '][driving_experince_canada]'],
                    [1, '<?= addslashes($strings["verifs_canadarock"]); ?>', 'form[' + FormID + '][driving_experince_canada_rocky_mountains]'],
                    [1, '<?= addslashes($strings["verifs_usa"]); ?>', 'form[' + FormID + '][driving_experince_usa]']
                ];
                break;

            case 10:
                Title = '<?= addslashes($strings2["verifs_pasteducat"]); ?>';
                Form[0] = ['<?= addslashes($strings2["verifs_schoolcoll"]); ?>', 'text', 'form[' + FormID + '][college_school_name]', false];
                Form[1] = ['<?= addslashes($strings["forms_address"]); ?>', 'text', 'form[' + FormID + '][address]', false];
                Form[2] = ["Professor's Name", 'text', 'form[' + FormID + '][supervisior_name]', false];
                Form[3] = ['<?= addslashes($strings["forms_phone"]); ?>', 'text', 'form[' + FormID + '][supervisior_phone]', false];
                Form[4] = ["Professor's Email", 'text', 'form[' + FormID + '][supervisior_email]', false];
                Form[5] = ['Secondary Email', 'text', 'form[' + FormID + '][supervisior_secondary_email]', false];
                Form[6] = ['<?= addslashes($strings2["verifs_educations"]); ?>', 'date', 'form[' + FormID + '][education_start_date]', false];
                Form[7] = ['<?= addslashes($strings2["verifs_educatione"]); ?>', 'date', 'form[' + FormID + '][education_end_date]', false];
                Form[8] = ['<?= addslashes($strings2["verifs_claimswith"]); ?>', 'radio', 'form[' + FormID + '][claim_tutor]', false,
                    [0, '<?= addslashes($strings["dashboard_negative"]); ?>'],
                    [1, '<?= addslashes($strings["dashboard_affirmative"]); ?>']
                ];
                Form[9] = ['<?= addslashes($strings2["verifs_dateclaims"]); ?>', 'date', 'form[' + FormID + '][date_claims_occur]', false];
                Form[10] = ['<?= addslashes($strings2["verifs_educationh"]); ?>', 'hidden', 'form[' + FormID + '][education_history_confirmed_by]', false];
                Form[11] = ['<?= addslashes($strings2["verifs_highestgra"]); ?>', 'select', 'form[' + FormID + '][highest_grade_completed]', false, [1],[2],[3],[4],[5],[6],[7],[8]];
                Form[12] = ['<?= addslashes($strings2["verifs_highschool"] . '<small>' . $strings2["verifs_yearsatten"] . '</small>'); ?>', 'select', 'form[' + FormID + '][high_school]', false, [1],[2],[3],[4]];
                Form[13] = ['<?= addslashes($strings2["verifs_college"] . '<small>' . $strings2["verifs_yearsatten"] . '</small>'); ?>', 'select', 'form[' + FormID + '][college]', false, [1],[2],[3],[4]];
                Form[14] = ['<?= addslashes($strings["verifs_lastschool"]); ?>', 'text', 'form[' + FormID + '][last_school_attended]'];
                Form[14] = ['<?= addslashes($strings["verifs_didtheempl"]); ?>', 'text', 'form[' + FormID + '][performance_issue]'];
                Form[15] = ['<?= addslashes($strings["tasks_date"]); ?>', 'text', 'form[' + FormID + '][date_time]', false, '<?= date("m/d/Y"); ?>'];
                Form[16] = ['<?= addslashes($strings["forms_signature"]); ?>', 'hidden', 'form[' + FormID + '][signature]'];
                break;
        }
        element.insertAdjacentHTML('beforeend', makeform(FormID, Form, Title, formname));

        $(".datepicker").datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: '1980:2020',
            dateFormat: 'mm/dd/yy'
        });

        FormID++;
    }

    function createArray(length) {
        var arr = new Array(length || 0),
            i = length;

        if (arguments.length > 1) {
            var args = Array.prototype.slice.call(arguments, 1);
            while(i--) arr[length-1 - i] = createArray.apply(this, args);
        }

        return arr;
    }

    function makeform(ID, Data, Title, Acronym){
        var tempstr, CurrentData, tempstr2, Cols, Class, Role, Required, placeholder;
        tempstr = '<DIV ID="GNDN' + ID + '"><div class="form-group row"><center><h3 class="col-md-12">' + Title + '</h3></center></DIV><INPUT TYPE="HIDDEN" VALUE="' + Acronym + '" NAME="form[' + FormID + '][type]">';
        for(Index = 0; Index < Data.length; Index++ ){
            CurrentData = Data[Index];
            if(CurrentData && CurrentData.length > 0) {
                Class = "";
                Role="";
                placeholder="";
                Required="";
                if(CurrentData[1] == "hidden"){
                    tempstr2 = '<div style="display: none;"><label';
                } else {
                    tempstr2 = '<div class="form-group row nowrap"><label class="control-label nowrap';
                }
                if (CurrentData[3]) {
                    Required = " required";
                    Class = Class + Required;
                    tempstr2 = tempstr2 + Required;
                }
                tempstr2 = tempstr2 + ' col-md-3">' + CurrentData[0] + ':</label><div class="col-md-9">';
                switch (CurrentData[1]) {
                    case "date":
                        Class = Class + " datepicker";
                        CurrentData[1] = "text";
                        placeholder = "mm/dd/yyyy"
                        break;
                    case "email":case "phone":
                        Role = CurrentData[1];
                        CurrentData[1] = "text";
                        break;
                }
                switch (CurrentData[1]) {
                    case "text":case "hidden":
                        tempstr2 = tempstr2 + '<input type="' + CurrentData[1] + '" name="' + CurrentData[2] + '"' + Required + ' class="' + Class + ' form-control"';
                        if(CurrentData.length>4){
                            tempstr2 = tempstr2 + ' DISABLED VALUE="' + CurrentData[4] + '"';
                        }
                        if(Role){
                            tempstr2 = tempstr2 + ' role="' + Role + '"';
                        }
                        if(placeholder){
                            tempstr2 = tempstr2 + ' placeholder="' + placeholder + '"';
                        }
                        tempstr2 = tempstr2 + '/>';
                        break;
                    case "checkbox":case "radio":
                        for(Index2 = 4; Index2 < CurrentData.length; Index2++ ){
                            var Check = CurrentData[Index2];
                            var Name =  CurrentData[2];
                            if(Check.length>2){
                                Name = Check[2];
                            }
                            tempstr2 = tempstr2 + '<label><input type="' + CurrentData[1] + '" name="' + Name + '"' + Required + ' class="' + Class + '" value="' + Check[0] + '"/>&nbsp;&nbsp;' + Check[1] +  '</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                        }
                        break;
                    case "select":
                        tempstr2 = tempstr2 + '<SELECT CLASS="' + Class + 'form-control" NAME="' + Name + '"' + Required + '>';
                        for(Index2 = 4; Index2 < CurrentData.length; Index2++ ) {
                            var Check = CurrentData[Index2];
                            if(Check.length==1){
                                tempstr2 = tempstr2 + '<OPTION>' + Check[0] + '</OPTION>';
                            } else {
                                tempstr2 = tempstr2 + '<OPTION VALUE="' + Check[0] + '">' + Check[1] + '</OPTION>';
                            }
                        }
                        tempstr2 = tempstr2 + '</SELECT>';
                        break;
                }
                tempstr2 = tempstr2 + '</div></div>';
                tempstr = tempstr + tempstr2;
            }
        }
        tempstr2 = '<INPUT TYPE="BUTTON" CLASS="btn btn-danger btn-xs" VALUE="Remove this ' + Title + '" ONCLICK="removeelement(' + "'GNDN" + ID + "'" + ');">';
        return tempstr.replace("undefined", "") + tempstr2 + '</div>';
    }

    function product(ID){
        var element = document.getElementById("CHK" + ID);
        if(element.checked){
            addID("forms", ID);
        } else {
            removeID("forms", ID);
        }
    }

    function addID(ElementName, ID){
        var element = document.getElementById(ElementName);
        if(element.value){
            var values = element.value.split(",");
            for (temp = 0; temp< values.length; temp++){
                if(values[temp]== ID ) {
                    removeID(ElementName, ID);
                    return false;
                }
            }
            element.value = element.value + "," + ID;
        } else {
            element.value = ID;
        }
        return true;
    }

    function removeID(ElementName, ID){
        element = document.getElementById(ElementName);
        var values = element.value.split(",");
        var newvalue = "";
        for (temp = 0; temp< values.length; temp++){
            if(values[temp] != ID ) {
                if(newvalue){
                    newvalue=newvalue + "," + values[temp];
                }else{
                    newvalue=values[temp];
                }
            }
        }
        element.value=newvalue;
    }

    document.getElementById("forms").value = '<?= $Products; ?>';
</SCRIPT>