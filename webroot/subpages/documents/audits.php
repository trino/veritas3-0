<?php
 if($_SERVER['SERVER_NAME'] =='localhost'){  echo "<span style ='color:red;'>subpages/documents/audits.php #INC128</span>";}
$is_disabled = '';
if(isset($disabled)){$is_disabled = 'disabled="disabled"';}

//this document type can't have attachments, reason unknown
?>
<div class="portlet-body form">
<!-- BEGIN FORM-->
<form  id="form_tab8" method="post" action="<?php echo $this->request->webroot;?>documents/audits/<?php echo $cid;?>/<?php echo $did;?>" class="form-horizontal">

    <?php
    include_once 'subpages/filelist.php';
    printdocumentinfo($did);
    //listfiles($sub['de_at'], "attachments/", "", false,3);
    ?>


<input type="hidden" class="document_type" name="document_type" value="Audits"/>
    <input type="hidden" name="sub_doc_id" value="8" class="sub_docs_id" id="af" />
<div class="form-body">
                                                
                                                <div class="form-group">
<label class="col-md-3 control-label">Company / Division : </label>
<div class="col-md-4">
<input type="text" name="company" class="form-control " <?php echo $is_disabled;?> placeholder="Enter text" value="<?php if(isset($audits))echo $audits->company;?>" />
</div>
</div>
                                                
<div class="form-group">
<label class="col-md-3 control-label">Conference Name : </label>
<div class="col-md-4">
<input type="text" name="conference_name"  class="form-control " <?php echo $is_disabled;?> placeholder="Enter text" value="<?php if(isset($audits))echo $audits->conference_name;?>" />
</div>
</div>

<div class="form-group">
<label class="col-md-3 control-label">Related Association : </label>
<div class="col-md-4">
<input type="text" name="association" class="form-control " <?php echo $is_disabled;?> placeholder="Enter text" value="<?php if(isset($audits))echo $audits->association;?>"/>	</div>
</div>
                                                                                                
<div class="form-group">
<label class="col-md-3 control-label">Date : </label>
<?php if(isset($audits))
{
    $date = explode("-",$audits->date);
    $year = $date[0];
    $month = $date[1];
}?>
                                                      <div class="col-md-3">
                                                      <select class="form-control member_type" <?php echo $is_disabled;?> name="month" >
                                                        <option value=""> Month </option>
                                                        <option value="1" <?php if(isset($audits)&& $month ==1)echo "selected='selected'";?>>January</option>
                                                        <option value="2" <?php if(isset($audits)&& $month ==2)echo "selected='selected'";?>>February</option>
                                                        <option value="3" <?php if(isset($audits)&& $month ==3)echo "selected='selected'";?>>March</option>
                                                        <option value="4" <?php if(isset($audits)&& $month ==4)echo "selected='selected'";?>>April</option>
                                                        <option value="5" <?php if(isset($audits)&& $month ==5)echo "selected='selected'";?>>May</option>
                                                        <option value="6" <?php if(isset($audits)&& $month ==6)echo "selected='selected'";?>>June</option>
                                                        <option value="7" <?php if(isset($audits)&& $month ==7)echo "selected='selected'";?>>July</option>
                                                        <option value="8" <?php if(isset($audits)&& $month ==8)echo "selected='selected'";?>>August</option>
                                                        <option value="9" <?php if(isset($audits)&& $month ==9)echo "selected='selected'";?>>September</option>
                                                        <option value="10" <?php if(isset($audits)&& $month ==10)echo "selected='selected'";?>>October</option>
                                                        <option value="11" <?php if(isset($audits)&& $month ==11)echo "selected='selected'";?>>November</option>
                                                        <option value="12" <?php if(isset($audits)&& $month ==12)echo "selected='selected'";?>>December</option>
                                                    </select>             
                                                      </div>
                                                      <div class="col-md-3">
                                                        <select class=" form-control member_type" <?php echo $is_disabled;?> name="year" >
                                                        <option value=""> Year </option>
                                                        <option value="2015" <?php if(isset($audits)&& $year ==2015)echo "selected='selected'";?>> 2015 </option>
                                                        <option value="2016" <?php if(isset($audits)&& $year ==2016)echo "selected='selected'";?>> 2016 </option>
                                                        <option value="2017" <?php if(isset($audits)&& $year ==2017)echo "selected='selected'";?>> 2017 </option>
                                                        <option value="2018" <?php if(isset($audits)&& $year ==2018)echo "selected='selected'";?>> 2018 </option>
                                                        <option value="2019" <?php if(isset($audits)&& $year ==2019)echo "selected='selected'";?>> 2019 </option>
                                                        <option value="2020" <?php if(isset($audits)&& $year ==2020)echo "selected='selected'";?>> 2020 </option>
                                                        
                                                    </select>
                             	  </div>
</div>


                                                <div class="form-group">
<label class="col-md-3 control-label">Location : </label>

<div class="col-md-3">
<input type="text" name="city"  class="form-control req_driver" <?php echo $is_disabled;?> placeholder="City" value="<?php if(isset($audits))echo $audits->city;?>">
</div>                                                    



                                                    <div class="col-md-3">

                                                            <select name="province" <?php echo $is_disabled;?> class="form-control member_type">
                                                                <option value="AB" <?php if(isset($audits)&& $audits->province =="AB")echo "selected='selected'";?>>AB</option>
                                                                <option value="BC" <?php if(isset($audits)&& $audits->province =="BC")echo "selected='selected'";?>>BC</option>
                                                                <option value="MB" <?php if(isset($audits)&& $audits->province =="MB")echo "selected='selected'";?>>MB</option>
                                                                <option value="NB" <?php if(isset($audits)&& $audits->province =="NB")echo "selected='selected'";?>>NB</option>
                                                                <option value="NL" <?php if(isset($audits)&& $audits->province =="NL")echo "selected='selected'";?>>NL</option>
                                                                <option value="NT" <?php if(isset($audits)&& $audits->province =="NT")echo "selected='selected'";?>>NT</option>
                                                                <option value="NS" <?php if(isset($audits)&& $audits->province =="NS")echo "selected='selected'";?>>NS</option>
                                                                <option value="NU" <?php if(isset($audits)&& $audits->province =="NU")echo "selected='selected'";?>>NU</option>
                                                                <option value="ON" <?php if(isset($audits)&& $audits->province =="ON")echo "selected='selected'";?>>ON</option>
                                                                <option value="PE" <?php if(isset($audits)&& $audits->province =="PE")echo "selected='selected'";?>>PE</option>
                                                                <option value="QC" <?php if(isset($audits)&& $audits->province =="QC")echo "selected='selected'";?>>QC</option>
                                                                <option value="SK" <?php if(isset($audits)&& $audits->province =="SK")echo "selected='selected'";?>>SK</option>
                                                                <option value="YT" <?php if(isset($audits)&& $audits->province =="YT")echo "selected='selected'";?>>YT</option>
                                                            </select>

                                </div>
                                                    <div class="col-md-3">
<input type="text" name="country" class="form-control req_driver" <?php echo $is_disabled;?> value="Canada" value="<?php if(isset($audits))echo $audits->country;?>">
</div>

</div>
 
 
                                                <div class="form-group">
<label class="col-md-3 control-label">Estimated Total Cost :
                                                    <small class=" control-label">Booth/Travel/Hotels/Meals</small>
                                                    </label>
                                                    
<div class="col-md-4">
<input type="text" name="total_cost" class="form-control " <?php echo $is_disabled;?> placeholder="Enter text" value="<?php if(isset($audits))echo $audits->total_cost;?>">
</div>
</div>                                                

 	<div class="form-group">
<label class="col-md-3 control-label">Rating Total
                                                    <small class=" control-label">[Out of 40]</small> :
                                                    </label>
                                                    
<div class="col-md-4">

                                                            <select name="total_rating" <?php echo $is_disabled;?> class="form-control member_type">
                                                              <?php for($i=1; $i<=40; $i++):?>
                                                              <option value="<?php echo $i;?>" <?php if(isset($audits)&& $audits->total_rating ==$i)echo "selected='selected'";?>><?php echo $i;?></option>
                                                              <?php endfor;?>
                                                            </select>

                                </div>
</div>
                                                
                                       	<h2> Objectives</h2>

<div class="form-group">
<label class="col-md-3 control-label">
                                                    What were the primary objectives at the show?
                                                    </label>
<div class="col-md-8">
<textarea class="form-control" name="primary_objectives" id="primary_objectives" <?php echo $is_disabled;?> rows="3"><?php if(isset($audits))echo $audits->primary_objectives;?></textarea>
</div>
                                                    
                                                    
</div>                                                

<div class="form-group">
<label class="col-md-3 control-label">
                                                    Do you feel the objectives were achieved? Provide a grade rating of 1 to 10 (10 is best) and provide details.
                                                    </label>
<div class="col-md-8">
<textarea class="form-control" name="objectives" id="primary_objectives" <?php echo $is_disabled;?> rows="3"><?php if(isset($audits))echo $audits->objectives;?></textarea>
</div>
</div>   

<div class="form-group">
<label class="col-md-3 control-label">
                                                    Please provide suggestions for improvement.
                                                    </label>
<div class="col-md-8">
<textarea class="form-control" name="improvement" id="primary_objectives" <?php echo $is_disabled;?> rows="3"><?php if(isset($audits))echo $audits->improvement;?></textarea>
</div>
</div> 
                                                <h2> Leads </h2>
                                                <div class="form-group">
<label class="col-md-3 control-label">
                                                    Was the lead-collecting process in the booth effective (e.g. badge scanner, business card collecting)?
                                                    </label>
<div class="col-md-8">
<textarea class="form-control" name="lead_effective" id="primary_objectives" <?php echo $is_disabled;?> rows="3"><?php if(isset($audits))echo $audits->lead_effective;?></textarea>
</div>
</div>
 
                                                 <div class="form-group">
<label class="col-md-3 control-label">
How many leads were generated?                                                    </label>
<div class="col-md-8">
<textarea class="form-control" name="leads" id="primary_objectives" <?php echo $is_disabled;?> rows="3"><?php if(isset($audits))echo $audits->leads;?></textarea>
</div>
</div> 
 
                                                 <div class="form-group">
<label class="col-md-3 control-label">
Rate the leads - how many do you feel are “quality"? 
                                                        Provide a grade rating of 1 to 10 (10 is best) and provide details.                                                   </label>
<div class="col-md-8">
<textarea class="form-control" name="leads_rate" id="primary_objectives" <?php echo $is_disabled;?> rows="3"><?php if(isset($audits))echo $audits->leads_rate;?></textarea>
</div>
</div>

 
                                                 <div class="form-group">
<label class="col-md-3 control-label">
Please provide suggestions for improvement of the lead collection and handling process.                                                   </label>
<div class="col-md-8">
<textarea class="form-control" name="handling" id="primary_objectives" <?php echo $is_disabled;?> rows="3"><?php if(isset($audits))echo $audits->handling;?></textarea>
</div>
</div>
                                                
                                                <h2> Audience </h2>
   
                                                 <div class="form-group">
<label class="col-md-3 control-label">
Rate the type of attendees at the show 
                                                        (e.g. decision makers, decision influencers, general staff)?
                                                        Provide a grade rating of 1 to 10 (10 is best) and provide details.                                                   </label>
<div class="col-md-8">
<textarea class="form-control" name="attendees_rate" <?php echo $is_disabled;?> id="" rows="3"><?php if(isset($audits))echo $audits->attendees_rate;?></textarea>
</div>
</div> 
                                                                                             
                                                <h2> Booth </h2>
   
                                                 <div class="form-group">
<label class="col-md-3 control-label">
Which of our services/products we provide was of most interest?
                    </label>
<div class="col-md-8">
<textarea class="form-control" name="interest" <?php echo $is_disabled;?> id="primary_objectives" rows="3"><?php if(isset($audits))echo $audits->interest;?></textarea>
</div>
</div>                                                   
 
                                                  <div class="form-group">
<label class="col-md-3 control-label">
How was the booth location? Provide details.
                    </label>
<div class="col-md-8">
<textarea class="form-control" name="booth_location" <?php echo $is_disabled;?> id="primary_objectives" rows="3"><?php if(isset($audits))echo $audits->booth_location;?></textarea>
</div>
</div> 
 
                                                   <div class="form-group">
<label class="col-md-3 control-label">
Rate the volume of booth traffic. 
                                                        Provide a grade rating of 1 to 10 (10 is best) and provide details.
                    </label>
<div class="col-md-8">
<textarea class="form-control" name="rating" <?php echo $is_disabled;?> id="primary_objectives" rows="3"><?php if(isset($audits))echo $audits->rating;?></textarea>
</div>
</div> 
 
                                                    <div class="form-group">
<label class="col-md-3 control-label">
Please provide suggestions for improvement of the booth's appearance, 
                                                        messaging, display, location, etc.
                    </label>
<div class="col-md-8">
<textarea class="form-control" name="suggestions" <?php echo $is_disabled;?> id="primary_objectives" rows="3"><?php if(isset($audits))echo $audits->suggestions;?></textarea>
</div>
</div> 
 	
                                            <h2> Promotion </h2>
                                            
                                                <div class="form-group">
<label class="col-md-3 control-label">
How was the promotional giveaway received (if applicable)? Provide details.
                    </label>
<div class="col-md-8">
<textarea class="form-control" name="promotional" <?php echo $is_disabled;?> id="primary_objectives" rows="3"><?php if(isset($audits))echo $audits->promotional;?></textarea>
</div>
</div>                                            
 
                                             <h2> Staffing </h2>
                                            
                                                <div class="form-group">
<label class="col-md-3 control-label">
Approximately how many attendees did you engage in conversation?
                    </label>
<div class="col-md-8">
<textarea class="form-control" name="attendees" <?php echo $is_disabled;?> id="primary_objectives" rows="3"><?php if(isset($audits))echo $audits->attendees;?></textarea>
</div>
</div> 

                                                <div class="form-group">
<label class="col-md-3 control-label">
Do you feel there was enough booth staff?
                    </label>
<div class="col-md-8">
<textarea class="form-control" name="booth_staff" <?php echo $is_disabled;?> id="primary_objectives" rows="3"><?php if(isset($audits))echo $audits->booth_staff;?></textarea>
</div>
</div> 
 
 <div class="addattachment8 form-group col-md-12">

</div>
<div class="clearfix"></div>
</div>

<!--
Shouldn't there be a place to add attachements?

<div class="form-actions">
<div class="row">
<div class="col-md-offset-3 col-md-9">
<button type="submit" class="btn btn-circle blue">Submit</button>
<button type="button" class="btn btn-circle default">Cancel</button>
</div>
</div>
</div>-->
</form>
<!-- END FORM-->
</div>