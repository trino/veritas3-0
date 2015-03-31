<?php
 if($_SERVER['SERVER_NAME'] =='localhost'){ echo "<span style ='color:red;'>subpages/documents/past_employment.php #INC146</span>"; }
 ?>
<div id="toremove">
<div class="clearfix"></div>
<hr />
<div class="form-group col-md-12">
                
                                <h4 class="control-label col-md-12">Past Employer</h4>
                </div>
                
                               <div class="form-group col-md-12">
                                <label class="control-label col-md-3">Company Name</label>
                                <div class=" col-md-9">
                                <input type="text" class="form-control" name="company_name[]" />
                                </div>
                                </div>
                                <div class="form-group col-md-12">
                                <label class="control-label col-md-3">Address</label>
                                <div class="col-md-3">
                                    <input type="text" class="form-control" name="address[]" />
                                </div>
                                <label class="control-label col-md-3">City</label>
                                <div class="col-md-3">
                                    <input type="text" class="form-control" name="city[]" />
                                </div>
                                </div>
                                <div class="form-group col-md-12">
                                <label class="control-label col-md-3">State/Province</label>
                                <div class="col-md-3">
                                    <input type="text" class="form-control" name="state_province[]" />
                                </div>
                                <label class="control-label col-md-3">Country</label>
                                <div class="col-md-3">
                                <input type="text" class="form-control" name="country[]" />
                                </div>
                                </div>
                                <div class="form-group col-md-12">
                                <label class="control-label col-md-3">Supervisor's Name:</label>
                                <div class="col-md-3">
                                <input type="text" class="form-control" name="supervisor_name[]"/>
                                </div>
                               <label class="control-label col-md-3">Phone #:</label>
                               <div class="col-md-3">
                               <input type="text" class="form-control" name="supervisor_phone[]"/>
                               </div>
                               </div>
                               
                               <div class="form-group col-md-12">
                               <label class="control-label col-md-3">Supervisor's Email:</label>
                               <div class="col-md-3">
                               <input type="text" class="form-control email1" name="supervisor_email[]"/>
                               </div>
                               <label class="control-label col-md-3">Secondary Email:</label>
                               <div class="col-md-3">
                               <input type="text" class="form-control email1" name="supervisor_secondary_email[]"/>
                               </div>
                               </div>
                               
                               <div class="form-group col-md-12">
                                <label class="control-label col-md-3">Employment Start Date:</label>
                                <div class="col-md-3">
                                <input type="text" class="form-control date-picker" name="employment_start_date[]"/>
                                </div>
                                <label class="control-label col-md-3">Employment End Date:</label>
                                <div class="col-md-3">
                                <input type="text" class="form-control date-picker" name="employment_end_date[]"/>
                                </div>
                                </div>
                                <div class="form-group col-md-12">
                                <label class="control-label col-md-3">Claims with this Employer:</label>
                                <div class="col-md-3">
                                &nbsp;&nbsp;<input type="radio" name="claims_with_employer_<?php $rand =  rand(0,100); echo $rand; ?>[]" value="1"/>&nbsp;&nbsp;Yes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="radio" name="claims_with_employer_<?php echo $rand;?>[]"  value="0"/>&nbsp;&nbsp;&nbsp;&nbsp;No
                                </div>
                                 <label class="control-label col-md-3">Date Claims Occured:</label>
                                 <div class="col-md-3">
                                 <input type="text" class="form-control date-picker" name="claims_recovery_date[]"/>
                                 </div>
                                 </div>
                                 
                                 <div class="form-group col-md-12">
                                <label class="control-label col-md-6">Employment history confirmed by (Verifier Use Only):</label>
                                <div class="col-md-6">
                                <input type="text" class="form-control" name="emploment_history_confirm_verify_use[]"/>
                                </div>
                                </div>
                                
                                <div class="form-group col-md-12">
                                <label class="control-label col-md-3">US DOT MC/MX#:</label>
                                <div class="col-md-3">
                                <input name="us_dot[]" type="text" class="form-control" name="us_dot[]" />
                                </div>
                                <label class="control-label col-md-3" style="display: none;">Signature:</label>
                                <div class="col-md-3">
                                <input type="text" class="form-control" style="display: none;" name="signature[]"/>
                                </div>
                                </div>
                                
                                <div class="form-group col-md-12">
                                <label class="control-label col-md-3">Date:</label>
                                <div class="col-md-9">
                                <input type="text" class="form-control date-picker" name="signature_datetime[]"/>
                                </div>
                                </div>
                                <div class="form-group col-md-12">
                                            <label class="control-label col-md-3">Equipment Operated : </label>
                                            <div class="col-md-9">
                                                <input type="checkbox" name="equipment_vans[]" value="1"/>&nbsp;Vans&nbsp;
                                                <input type="checkbox" name="equipment_reefer[]" value="1"/>&nbsp;Reefers&nbsp;
                                                <input type="checkbox" name="equipment_decks[]" value="1"/>&nbsp;Decks&nbsp;
                                                <input type="checkbox" name="equipment_super[]" value="1"/>&nbsp;Super B's&nbsp;
                                                <input type="checkbox" name="equipment_straight_truck[]" value="1"/>&nbsp;Straight Truck&nbsp;
                                                <input type="checkbox" name="equipment_others[]" value="1"/>&nbsp;Others:
                                </div>
                                </div>
                                <div class="form-group col-md-12">
                                <label class="control-label col-md-3">Driving Experience : </label>
                                <div class="col-md-9">
                                    <input type="checkbox" name="driving_experince_local[]" value="1"/>&nbsp;Local&nbsp;
                                    <input type="checkbox" name="driving_experince_canada[]" value="1"/>&nbsp;Canada&nbsp;
                                    <input type="checkbox" name="driving_experince_canada_rocky_mountains[]" value="1"/>&nbsp;Canada : Rocky Mountains&nbsp;
                                    <input type="checkbox" name="driving_experince_usa[]" value="1"/>&nbsp;USA&nbsp;
                                </div>
                
                </div>
<div class="delete">
    <a href="javascript:void(0);" class="btn red" id="delete">Delete</a>
</div>
  </div>  

 