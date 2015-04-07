<?php
 if($this->request->session()->read('debug')){  echo "<span style ='color:red;'>subpages/documents/pre_employment_road_tesdt.php #INC205</span>";}
 ?>
<form id="form_tab<?php echo $dx->id;?>" action="<?php echo $this->request->webroot;?>documents/pre_employment_road_test/<?php echo $cid .'/' .$did;?>" method="post">
        <input type="hidden" class="document_type" name="document_type" value="<?php echo $dx->title;?>"/>
        <input type="hidden" name="sub_doc_id" value="<?php echo $dx->id;?>" class="sub_docs_id" id="af" />
        <div class="clearfix"></div>
        <hr/>
        
        
        <div>
            <div class="col-md-4">
                    <label class="control-label col-md-4">Driver : </label>  
                    <div class="col-md-8">              
                        <input class="form-control" name="driver" value="<?php if(isset($pre_employment_road_test))echo $pre_employment_road_test->driver;?>"/>
                    </div>
            </div>

            <div class="col-md-4">
                    <label class="control-label col-md-4">Evaluator : </label>  
                    <div class="col-md-8">              
                        <input class="form-control" name="evaluator" value="<?php if(isset($pre_employment_road_test))echo $pre_employment_road_test->evaluator;?>"/>
                    </div>
            </div> 
            <div class="col-md-4">
                    <label class="control-label col-md-4">Date : </label>  
                    <div class="col-md-8">              
                        <input class="form-control" name="date" value="<?php if(isset($pre_employment_road_test))echo $pre_employment_road_test->date;?>"/>
                    </div>
            </div> 
        </div> 
        <div class="clearfix"></div>
        <p>&nbsp;</p>
        <table class="table table-bordered">
        <tr>
            <td>
        <div class="col-md-12">
            <input type="checkbox" name="c1" value="1" <?php if(isset($pre_employment_road_test) && $pre_employment_road_test->c1 =='1')echo "checked='checked'";?>/> <strong>Pre Trip Inspection performed as per GFS policy</strong>
        </div>
        <p>&nbsp;</p>
        <div class="col-md-12">
            <input type="checkbox" name="c2" value="1" <?php if(isset($pre_employment_road_test) && $pre_employment_road_test->c2 =='1')echo "checked='checked'";?>/> <strong>Applies 4 steps to proper coupling</strong>
        </div>
        <p>&nbsp;</p>
        <div class="col-md-12">
            <input type="checkbox" name="c3" value="1" <?php if(isset($pre_employment_road_test) && $pre_employment_road_test->c3 =='1')echo "checked='checked'";?>/> <strong>Uses the 5 Keys to Defensive Driving</strong>
        </div>
        <p>&nbsp;</p>
        <div class="col-md-12">
            <div class="col-md-12">
                <input type="checkbox" name="c4" value="1" <?php if(isset($pre_employment_road_test) && $pre_employment_road_test->c4 =='1')echo "checked='checked'";?>/> Aim High In Steering&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Looking 15 seconds ahead
                <p>&nbsp;</p>
                <input type="checkbox" name="c5" value="1" <?php if(isset($pre_employment_road_test) && $pre_employment_road_test->c5 =='1')echo "checked='checked'";?>/> Get The Big Picture&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Check mirrors every 5 to 8 seconds
                <p>&nbsp;</p>
                <input type="checkbox" name="c6" value="1" <?php if(isset($pre_employment_road_test) && $pre_employment_road_test->c6 =='1')echo "checked='checked'";?>/> Keep Your Eyes Moving&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Every 2 seconds, avoid stares
                <p>&nbsp;</p>
                <input type="checkbox" name="c7" value="1" <?php if(isset($pre_employment_road_test) && $pre_employment_road_test->c7 =='1')echo "checked='checked'";?>/> Leave Yourself An Out&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Surround Yourself With Space
                <p>&nbsp;</p>
                <input type="checkbox" name="c8" value="1" <?php if(isset($pre_employment_road_test) && $pre_employment_road_test->c8 =='1')echo "checked='checked'";?>/> Make Sure They See You&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Eye Contact, Tap of the Horn
                
            </div>
        </div>
        <p>&nbsp;</p>
        <div class="col-md-12">
            <input type="checkbox" name="c9" value="1" <?php if(isset($pre_employment_road_test) && $pre_employment_road_test->c9 =='1')echo "checked='checked'";?>/> <strong>Keeps following distance of 1 sec per 10 ft of vehicle</strong>
        </div>
        <p>&nbsp;</p>
        <div class="col-md-12">
            <input type="checkbox" name="c10" value="1" <?php if(isset($pre_employment_road_test) && $pre_employment_road_test->c10 =='1')echo "checked='checked'";?>/> <strong>Uses brakes smoothly, start braking early to avoid hard stops</strong>
        </div>
        <p>&nbsp;</p>
        <div class="col-md-12">
            <input type="checkbox" name="c11" value="1" <?php if(isset($pre_employment_road_test) && $pre_employment_road_test->c11 =='1')echo "checked='checked'";?>/> <strong>Smooth shifting, using proper gear, and down shifts</strong>
        </div>
        <p>&nbsp;</p>
        </td>
        
        <td>
        
        
        <div class="col-md-12">
            <input type="checkbox" name="c12" value="1" <?php if(isset($pre_employment_road_test) && $pre_employment_road_test->c12 =='1')echo "checked='checked'";?>/> <strong>Operating in Traffic</strong>
        </div>
        <p>&nbsp;</p>
        <div class="col-md-12">
            <div class="col-md-12">
                <input type="checkbox" name="c13" value="1" <?php if(isset($pre_employment_road_test) && $pre_employment_road_test->c13 =='1')echo "checked='checked'";?>/> Uses signals properly
                <p>&nbsp;</p>
                <input type="checkbox" name="c14" value="1" <?php if(isset($pre_employment_road_test) && $pre_employment_road_test->c14 =='1')echo "checked='checked'";?>/> Obeys traffic sings and signals
                <p>&nbsp;</p>
                <input type="checkbox" name="c15" value="1" <?php if(isset($pre_employment_road_test) && $pre_employment_road_test->c15 =='1')echo "checked='checked'";?>/> Intersections
                <p>&nbsp;</p>
                <div class="col-md-12">
                    <input type="checkbox" name="c16" value="1" <?php if(isset($pre_employment_road_test) && $pre_employment_road_test->c16 =='1')echo "checked='checked'";?>/> Stops ahead of crosswalk
                    <p>&nbsp;</p>
                    <input type="checkbox" name="c17" value="1" <?php if(isset($pre_employment_road_test) && $pre_employment_road_test->c17 =='1')echo "checked='checked'";?>/> Yields right of way
                    <p>&nbsp;</p>
                    <input type="checkbox" name="c18" value="1" <?php if(isset($pre_employment_road_test) && $pre_employment_road_test->c18 =='1')echo "checked='checked'";?>/> Looks left, right and left
                    <p>&nbsp;</p>
                </div>                
            </div>
        </div>
        <p>&nbsp;</p>
        <div class="col-md-12">
            <input type="checkbox" name="c19" value="1" <?php if(isset($pre_employment_road_test) && $pre_employment_road_test->c19 =='1')echo "checked='checked'";?>/> <strong>Passes only when safe to do so</strong>
        </div>
        <p>&nbsp;</p>
        <div class="col-md-12">
            <input type="checkbox" name="c20" value="1" <?php if(isset($pre_employment_road_test) && $pre_employment_road_test->c20 =='1')echo "checked='checked'";?>/> <strong>Uses right lane as a habit</strong>
        </div>
        <p>&nbsp;</p>
        <div class="col-md-12">
            <input type="checkbox" name="c21" value="1" <?php if(isset($pre_employment_road_test) && $pre_employment_road_test->c21 =='1')echo "checked='checked'";?>/> <strong>Observes speed limit</strong>
        </div>
        
        <p>&nbsp;</p>
        <div class="col-md-12">
            <input type="checkbox" name="c22" value="1" <?php if(isset($pre_employment_road_test) && $pre_employment_road_test->c22 =='1')echo "checked='checked'";?>/> <strong>Courteous to other drivers and pedestrians</strong>
        </div>
        
        <p>&nbsp;</p>
        <div class="col-md-12">
            <input type="checkbox" name="c23" value="1" <?php if(isset($pre_employment_road_test) && $pre_employment_road_test->c23 =='1')echo "checked='checked'";?>/> <strong>Backing</strong>
        </div>
        
        <p>&nbsp;</p>
        <div class="col-md-12">
            <div class="col-md-12">
                    <input type="checkbox" name="c24" value="1" <?php if(isset($pre_employment_road_test) && $pre_employment_road_test->c24 =='1')echo "checked='checked'";?>/> Avoid blind side backing whenever possible
                    <p>&nbsp;</p>
                    <input type="checkbox" name="c25" value="1" <?php if(isset($pre_employment_road_test) && $pre_employment_road_test->c25 =='1')echo "checked='checked'";?>/> Uses horn and hazards
                    <p>&nbsp;</p>
                    <input type="checkbox" name="c26" value="1" <?php if(isset($pre_employment_road_test) && $pre_employment_road_test->c26 =='1')echo "checked='checked'";?>/> Keeps eye on both sides of truck
                    <p>&nbsp;</p>
                    <input type="checkbox" name="c27" value="1" <?php if(isset($pre_employment_road_test) && $pre_employment_road_test->c27 =='1')echo "checked='checked'";?>/> Get out and look to ensure clearance 
                    <p>&nbsp;</p>
            </div>
        </div>
        
        <p>&nbsp;</p>
        <div class="col-md-12">
            <label class="col-md-12">Comments</label>
            <div class="col-md-12">
                <textarea name="comment" class="form-control"><?php if(isset($pre_employment_road_test))echo $pre_employment_road_test->comment;?></textarea>
            </div>
        </div>
        <p>&nbsp;</p>
        </td>
        </tr>
        </table>
        
                    
                
        <div class="clearfix"></div>
    

</form>
<script>
$(function(){
<?php
        if(isset($disabled))
        {
    ?>
           $('#form_tab17 input').attr('disabled','disabled');
           $('#form_tab17 textarea').attr('disabled','disabled');            
    <?php }
    ?>
    });
</script>