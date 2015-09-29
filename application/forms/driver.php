<div class="form-group row col-md-12 splitcols">
    <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
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
    <div class="col-md-4"><label class="control-label required"><?= $strings["forms_email"]; ?>: </label>
        <input type="text" class="form-control required" required name="email" />
    </div>
    <div class="col-md-4"><label class="control-label required"><?= $strings["forms_address"]; ?>: </label>
        <input type="text" class="form-control required" required name="street" />
    </div>
    <div class="col-md-4"><label class="control-label required"><?= $strings["forms_provincestate"]; ?>: </label>
        <?php provinces("province"); ?>
    </div>
    <div class="col-md-4"><label class="control-label required"><?= $strings["forms_address"]; ?>: </label>
        <input type="text" class="form-control required" required name="street" />
    </div>
    <div class="col-md-4"><label class="control-label required"><?= $strings["forms_postalcode"]; ?>: </label>
        <input type="text" class="form-control required" required name="postal" />
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
                      echo '<OPTION VALUE="' . $Data["id"] . '">' . $Data["company_name"] . '</OPTION>';
                }
            ?>
        </SELECT>
    </div>
    <div class="col-md-4"><label class="control-label required">Base64-encoded Driver ID file: </label>
        <TEXTAREA NAME="driverphotoBASE" class="form-control" title="Leave 'Upload Driver ID file' blank"></TEXTAREA>
    </DIV>
    <div class="col-md-4"><label class="control-label required">Upload Driver ID file: </label>
        <INPUT TYPE="file" name="driverphotoFILE" class="form-control" title="Leave 'Base64-encoded Driver ID file blank" />
    </div>
    <div class="col-md-4"><label class="control-label required">Order type: </label>
        <SELECT class="form-control required" name="ordertype" />
        <?php
        $result = Query("SELECT * FROM product_types");
        while ($Data = mysqli_fetch_array($result)) {
            echo '<OPTION VALUE="' . $Data["Acronym"] . '">(' . $Data["Acronym"] . ') ' . $Data["Name"] . '</OPTION>';
        }
        ?>
        </SELECT>
    </div>
</div>
<div class="clearfix"></div>