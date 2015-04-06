<form id="form_tab18" action="<?php echo $this->request->webroot;?>documents/application_employment/<?php echo $cid .'/' .$did;?>" method="post">
        
        <div class="clearfix"></div>
        <hr/>
        <div class="col-md-12">
            <div class="col-md-6"><img src="<?php echo $this->request->webroot;?>img/gfs.png" style="width: 120px;" /></div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
        <p>&nbsp;</p>
        <div>
            <div class="col-md-6">
                    <label class="control-label col-md-3">Name : </label>  
                    <div class="col-md-3">              
                        <input class="form-control" name="lname" placeholder="Last" value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?>" />
                    </div> 
                    <div class="col-md-3">              
                        <input class="form-control" name="mname" placeholder="Middle" value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?>" />
                    </div> 
                    <div class="col-md-3">              
                        <input class="form-control" name="fname" placeholder="First" value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?>" />
                    </div>
            </div>
            <div class="col-md-6">
                    <label class="control-label col-md-4">Telephone : </label>  
                    <div class="col-md-3">              
                        <input class="form-control" name="code" placeholder="Area Code" value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?>" />
                    </div>  
                    <div class="col-md-5">              
                        <input class="form-control" name="phone" value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?>" />
                    </div>
            </div> 
        </div>
        
        <p>&nbsp;</p>
            <div class="col-md-12">
                    <label class="control-label col-md-4">Current Address : </label>  
                    <div class="col-md-8">              
                        <input class="form-control" name="address" value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?>" />
                    </div>  
            </div>
            
        <p>&nbsp;</p>
            <div class="col-md-12">
                    <label class="control-label col-md-4">Have you ever applied for work with us before? </label>  
                    <div class="col-md-2 radio-list yesNoCheck">
                        <label class="radio-inline">              
                        <input type="radio" class="form-control" name="workedbefore" id="yesCheck" value="1"/> <span>Yes</span>
                        </label>
                        <label class="radio-inline">
                        <input type="radio" class="form-control" name="workedbefore" id="noCheck" value="0"/> <span>No</span>
                        </label>
                    </div>
                    <div id="yesDiv" style="display: none;">
                        <label class="control-label col-md-2">If yes, when? </label> 
                        <div class="col-md-4">              
                            <textarea class="form-control" name="worked"><?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?></textarea>
                        </div>
                    </div> 
            </div>
            <p>&nbsp;</p>
            <div class="col-md-12">
                    <label class="control-label col-md-4">List anyone you know who woks for us: </label>  
                    <div class="col-md-8">
                        <input class="form-control" name="for_us"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?>" /> 
                    </div>
            </div>
            <p>&nbsp;</p>
            <div class="col-md-12">
                    <label class="control-label col-md-4">Did anyone refer you? </label>  
                    <div class="col-md-8">
                        <input class="form-control" name="refer"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?>" /> 
                    </div>
            </div>
            <p>&nbsp;</p>
            <div class="col-md-6">
                    <label class="control-label col-md-8">Are you 18 years of age or older? </label>  
                    <div class="col-md-4 radio-list">
                        <label class="radio-inline">              
                        <input type="radio" class="form-control" name="age" value="1"/>Yes
                        </label>
                        <label class="radio-inline">
                        <input type="radio" class="form-control" name="age" value="0"/> No
                        </label>
                    </div>
            </div>
            <div class="col-md-6">
                    <label class="control-label col-md-8">Are you legally eligible to work in Canada? </label>  
                    <div class="col-md-4 radio-list">
                        <label class="radio-inline">              
                        <input type="radio" class="form-control" name="legal" value="1"/>Yes
                        </label>
                        <label class="radio-inline">
                        <input type="radio" class="form-control" name="legal" value="0"/> No
                        </label>
                    </div>
            </div>
        <div class="clearfix"></div>
        
        <p>&nbsp;</p>
        <hr />
        <div class="col-md-12">
            <h3>Education</h3>
        </div>
        <div class="col-md-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>School</th>
                        <th>No. of Years Attended</th>
                        <th>City, State</th>
                        <th>Course</th>
                        <th>Did you Graduate?</th>
                    </tr>
                </thead>
                
                <tbody>
                    <tr>
                        <th>Grammar</th>
                        <td><input class="form-control" name="g_years"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?>" /></td>
                        <td><input class="form-control" name="g_city"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?>" /></td>
                        <td><input class="form-control" name="g_course"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?>" /></td>
                        <td><input class="form-control" name="g_grad"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?>" /></td>
                    </tr>
                    <tr>
                        <th>High</th>
                        <td><input class="form-control" name="h_years"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?>" /></td>
                        <td><input class="form-control" name="h_city"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?>" /></td>
                        <td><input class="form-control" name="h_course"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?>" /></td>
                        <td><input class="form-control" name="h_grad"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?>" /></td>
                    </tr>
                    <tr>
                        <th>College</th>
                        <td><input class="form-control" name="c_years"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?>" /></td>
                        <td><input class="form-control" name="c_city"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?>" /></td>
                        <td><input class="form-control" name="c_course"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?>" /></td>
                        <td><input class="form-control" name="c_grad"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?>" /></td>
                    </tr>
                    <tr>
                        <th>Other</th>
                        <td><input class="form-control" name="o_years"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?>" /></td>
                        <td><input class="form-control" name="o_city"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?>" /></td>
                        <td><input class="form-control" name="o_course"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?>" /></td>
                        <td><input class="form-control" name="o_grad"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?>" /></td>
                    </tr>
                </tbody>
            </table>
        </div>
        
            <p>&nbsp;</p>
            <div class="col-md-12">
                    <label class="control-label col-md-10">Do you have any skills, qualifications or experiences which you feel would specially fit you for working with us? </label>  
                    <div class="col-md-2">
                        <textarea class="form-control" name="skills"><?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?></textarea> 
                    </div>
            </div>
            <p>&nbsp;</p>
            <div class="col-md-12">
                    <div class="col-md-12">
                        <label class="control-label col-md-2">Job(s) Applied for : </label> 
                    </div> 
                    <div class="col-md-12">
                        <label class="control-label col-md-1">1. </label>
                        <div class="col-md-3">
                            <input class="form-control" name="applied" value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?>" /> 
                        </div>
                        <label class="control-label col-md-3">Rate of pay expected $ </label>
                        <div class="col-md-2">
                            <input class="form-control" name="rate" value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?>" /> 
                        </div>
                        <label class="control-label col-md-1">per </label>
                        <div class="col-md-2">
                            <input class="form-control" name="per" value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?>" /> 
                        </div>
                    </div>
                    <p>&nbsp;</p>
                    <div class="col-md-12">
                        <label class="control-label col-md-1">2. </label>
                        <div class="col-md-3">
                            <input class="form-control" name="applied1" value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?>" /> 
                        </div>
                        <label class="control-label col-md-3">Rate of pay expected $ </label>
                        <div class="col-md-2">
                            <input class="form-control" name="rate1" value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?>" /> 
                        </div>
                        <label class="control-label col-md-1">per </label>
                        <div class="col-md-2">
                            <input class="form-control" name="per1" value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?>" /> 
                        </div>
                    </div>
            </div>
            <p>&nbsp;</p>
            <div class="col-md-12">
                    <label class="control-label col-md-5">Do you want to work: </label>  
                    <div class="col-md-7 radio-list">
                        <label class="radio-inline">              
                        <input type="radio" class="form-control" name="legal1" id="partTime" value="1"/> Part Time
                        </label>
                        <label class="radio-inline">
                        <input type="radio" class="form-control" name="legal1" id="fullTime" value="0"/> Full Time ?
                        </label>
                    </div>
            </div>
            <div id="partTimeDiv" style="display: none;">
            <p>&nbsp;</p>
            <div class="col-md-12">
                <label class="control-label col-md-5">If applying only for part-time, which days and hours?</label> 
                <div class="col-md-7">              
                    <textarea class="form-control" name="part"><?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?></textarea>
                </div>
            </div>
            </div>
            <p>&nbsp;</p>
            <div class="col-md-12">
                    <label class="control-label col-md-5">Are you able to do the job(s) for which you are applying? </label>  
                    <div class="col-md-7 radio-list">
                        <label class="radio-inline">              
                        <input type="radio" class="form-control" name="legal2" id="ableToWork" value="1"/> Yes
                        </label>
                        <label class="radio-inline">
                        <input type="radio" class="form-control" name="legal2" id="notAbleToWork" value="2"/> No
                        </label>
                    </div> 
            </div>
            <div id="notAbleDiv" style="display: none;">
            <p>&nbsp;</p>
            <div class="col-md-12">
                <label class="control-label col-md-5">If no, please explain: </label> 
                <div class="col-md-7">              
                    <textarea class="form-control" name="no_explain"><?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?></textarea>
                </div>
            </div>
             </div> 
             
             <p>&nbsp;</p>
            <div class="col-md-12">
                <label class="control-label col-md-5">If hired, when can you start?</label> 
                <div class="col-md-7">              
                    <input class="form-control" name="start"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?>" />
                </div>
            </div> 
            <div class="clearfix"></div>
            <hr />
            <div class="col-md-12">
              <h3>Driving Record</h3>
              </div>
              <div class="col-md-12">
              <p>Collision record for the past three (3) years (attach sheet if more space is needed).</p>
              </div>
              <div class="col-md-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Dates</th>
                        <th>Nature of Collision<br />(Head-On, Rear-End, Backing, etc.)</th>
                        <th>Injuries / Fatalities</th>
                        <th>Vehicle Type <br />(Commercial or Personal)</th>
                    </tr>
                </thead>
                
                <tbody>
                    <tr>
                        <th>Last Collision</th>
                        <td><input class="form-control" name="l_date"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?>" /></td>
                        <td><input class="form-control" name="l_nature"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?>" /></td>
                        <td><input class="form-control" name="l_type"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?>" /></td>
                    </tr>
                    <tr>
                        <th>Next Previous</th>
                         <td><input class="form-control" name="p_date"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?>" /></td>
                        <td><input class="form-control" name="p_nature"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?>" /></td>
                        <td><input class="form-control" name="p_type"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?>" /></td>
                    </tr>
                    <tr>
                        <th>Next Previous</th>
                         <td><input class="form-control" name="n_date"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?>" /></td>
                        <td><input class="form-control" name="n_nature"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?>" /></td>
                        <td><input class="form-control" name="n_type"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?>" /></td>
                    </tr>
                </tbody>
            </table>
        </div> 
        
        <div class="clearfix"></div>
            <hr />
            <div class="col-md-12">
              <h3>Driving Experience and Qualifications</h3>
              </div>
              <div class="col-md-6">
              <div class="col-md-12">
                <h3>Driver Licenses</h3>
              </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Class</th>
                        <th>Expires</th>
                    </tr>
                </thead>
                
                <tbody>
                    <tr>
                        <td><input class="form-control" name="class1"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?>" /></td>
                        <td><input class="form-control" name="expires1"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?>" /></td>
                    </tr>
                    <tr>
                        <td><input class="form-control" name="class2"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?>" /></td>
                        <td><input class="form-control" name="expires2"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?>" /></td>
                    </tr>
                    <tr>
                        <td><input class="form-control" name="class3"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?>" /></td>
                        <td><input class="form-control" name="expires3"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?>" /></td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <div class="col-md-6">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Class of Equipment</th>
                        <th>Approx. No. of Miles (Total)</th>
                    </tr>
                </thead>
                
                <tbody>
                    <tr>
                        <th>Straight Truck</th>
                        <td><input class="form-control" name="starigt_miles"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?>" /></td>
                    </tr>
                    <tr>
                        <th>Tractor and Semi-Trailer</th>
                        <td><input class="form-control" name="semi_miles"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?>" /></td>
                    </tr>
                    <tr>
                        <th>Tractor and Two-Trailer</th>
                        <td><input class="form-control" name="two_miles"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?>" /></td>
                    </tr>
                    <tr>
                        <th>Other</th>
                        <td><input class="form-control" name="other_miles"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?>" /></td>
                    </tr>
                </tbody>
            </table>
        </div>   
                
        
        <div class="col-md-12">
            <label class="col-md-6">Show special courses or training that will help you as as driver</label>
            <div class="col-md-6"><textarea class="form-control" name="special_course"><?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?></textarea></div>
            <p>&nbsp;</p>
        </div>
        <div class="col-md-12">
            <label class="col-md-6">Which safe driving awaards do you hold and from whom?</label>
            <div class="col-md-6"><textarea class="form-control" name="which_safe_driving"><?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?></textarea></div>
            <p>&nbsp;</p>
        </div>
        <div class="col-md-12">
            <label class="col-md-6">Show any trucking, transportation or other experiences that may help in your work for this company:</label>
            <div class="col-md-6"><textarea class="form-control" name="show_any_trucking"><?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?></textarea></div>
            <p>&nbsp;</p>
        </div>
        <div class="col-md-12">
            <label class="col-md-6">List courses and training other than shown elsewhere in this application</label>
            <div class="col-md-6"><textarea class="form-control" name="list_courses_training"><?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?></textarea></div>
            <p>&nbsp;</p>
        </div>
        <div class="col-md-12">
            <label class="col-md-6">List special equipment or technical materials you can work with (other than those already shown)</label>
            <div class="col-md-6"><textarea class="form-control" name="list_special_equipment"><?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?></textarea></div>
            <p>&nbsp;</p>
        </div>
        
        <hr>
        <div class="col-md-12">
             <h3>EMPLOYMENT HISTORY</h3>
             <p>Please list your most recent employment first. Add another sheet if necessary. History must be the last three year’s. Commercial drivers shall provide

                an additional seven year’s information on employers for whom the applicant operated a commercial vehicle.
            </p>
            <p>&nbsp;</p>
            <table class="table table-bordered">
                <tr>
                    <td colspan="3">
                        <label class="col-md-12">Name & Address Of Employer:</label>
                        <div class="col-md-12"><textarea name="name_and_address_employer1" class="form-control form-control"><?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?></textarea></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="col-md-12">Dates of Employment</label>
                        <div class="col-md-6"><input type="text" class="date-picker form-control" name="date_of_employment_from1" placeholder="From" value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?>" /></div><div class="col-md-6"><input type="text" class="date-picker form-control" name="date_of_employment_to1" placeholder="To" /></div></div>
                    </td>
                    <td colspan="2">
                        <label class="col-md-12">Type of work done</label>
                        <div class="col-md-12"><textarea name="type_of_work_done1" class="form-control"><?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?></textarea></div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <label class="col-md-12">Supervisor's Name & Phone No.:</label>
                        <div class="col-md-12"><textarea name="supervisor_name_phone1" class="form-control form-control"><?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?></textarea></div>
                    </td>
                    <td>
                       <label class="col-md-12">Final Salary</label> 
                       <div class="col-md-12"><input type="text" class="form-control" name="final_salary1" value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>" /></div>
                    </td>               
                </tr>
                <tr>
                    <td colspan="3">
                        <label class="col-md-12">Reasons of leaving:</label>
                        <div class="col-md-12"><textarea name="reasons_of_leaving1" class="form-control form-control"><?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?></textarea></div>
                    </td>
                </tr>
            </table>
            
            <p>&nbsp;</p>
            <table class="table table-bordered">
                <tr>
                    <td colspan="3">
                        <label class="col-md-12">Name & Address Of Employer:</label>
                        <div class="col-md-12"><textarea name="name_and_address_employer2" class="form-control form-control"><?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?></textarea></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="col-md-12">Dates of Employment</label>
                        <div class="col-md-6"><input type="text" class="date-picker form-control" name="date_of_employment_from2" placeholder="From" value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?>" /></div><div class="col-md-6"><input type="text" class="date-picker form-control" name="date_of_employment_to2" placeholder="To" value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?>" /></div></div>
                    </td>
                    <td colspan="2">
                        <label class="col-md-12">Type of work done</label>
                        <div class="col-md-12"><textarea name="type_of_work_done2" class="form-control"><?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?></textarea></div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <label class="col-md-12">Supervisor's Name & Phone No.:</label>
                        <div class="col-md-12"><textarea name="supervisor_name_phone2" class="form-control form-control"><?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?></textarea></div>
                    </td>
                    <td>
                       <label class="col-md-12">Final Salary</label> 
                       <div class="col-md-12"><input type="text" class="form-control" name="final_salary2" value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?>" /></div>
                    </td>               
                </tr>
                <tr>
                    <td colspan="3">
                        <label class="col-md-12">Reasons of leaving:</label>
                        <div class="col-md-12"><textarea name="reasons_of_leaving2" class="form-control form-control"><?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?></textarea></div>
                    </td>
                </tr>
            </table>
            
            <p>&nbsp;</p>
            <table class="table table-bordered">
                <tr>
                    <td colspan="3">
                        <label class="col-md-12">Name & Address Of Employer:</label>
                        <div class="col-md-12"><textarea name="name_and_address_employer3" class="form-control form-control"><?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?></textarea></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="col-md-12">Dates of Employment</label>
                        <div class="col-md-6"><input type="text" class="date-picker form-control" name="date_of_employment_from3" placeholder="From" value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?>" /></div><div class="col-md-6"><input type="text" class="date-picker form-control" name="date_of_employment_to3" placeholder="To" value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?>" /></div></div>
                    </td>
                    <td colspan="2">
                        <label class="col-md-12">Type of work done</label>
                        <div class="col-md-12"><textarea name="type_of_work_done3" class="form-control"><?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?></textarea></div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <label class="col-md-12">Supervisor's Name & Phone No.:</label>
                        <div class="col-md-12"><textarea name="supervisor_name_phone3" class="form-control form-control"><?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?></textarea></div>
                    </td>
                    <td>
                       <label class="col-md-12">Final Salary</label> 
                       <div class="col-md-12"><input type="text" class="form-control" name="final_salary3" value="<strong></strong>" /></div>
                    </td>               
                </tr>
                <tr>
                    <td colspan="3">
                        <label class="col-md-12">Reasons of leaving:</label>
                        <div class="col-md-12"><textarea name="reasons_of_leaving3" class="form-control form-control"><?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?></textarea></div>
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-md-12">
            <label class="col-md-6">Would you be willing to take a physical exam?</label>
            <div class="col-md-6"><input type="radio" name="physical_exam" value="1" /> Yes &nbsp; &nbsp; <input type="radio" name="physical_exam" value="0" /> No</div>
        </div>
        
        <div class="col-md-12">
            <label class="col-md-6">What are your aspirations, now and in the future?</label>
            <div class="col-md-12"><textarea class="fomr-control" name="aspirations"><?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?></textarea></div>
        </div>
        <div class="col-md-12">
            <label class="col-md-6">Why do you think you are the best qualified candidate?</label>
            <div class="col-md-12"><textarea class="fomr-control" name="best_qualified"><?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?></textarea></div>
        </div>
        <div class="col-md-12">
            <label class="col-md-6">Would you be willing to relocate?</label>
            <div class="col-md-6"><input type="radio" name="willing_relocate" value="1" /> Yes &nbsp; &nbsp; <input type="radio" name="willing_relocate" value="0" /> No</div>
        </div>
        <div class="col-md-12">
            <label class="col-md-6">Which of your former positions did you like best and why?</label>
            <div class="col-md-12"><textarea class="fomr-control" name="best_former_posotions"><?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lanme;?>;?></textarea></div>
        </div>
        
        <div class="clearfix"></div>
        
    

</form>
<script>
$(function(){
            $('#yesCheck').click(function(){
              $("#yesDiv").show();  
            });
            $('#noCheck').click(function(){
              $("#yesDiv").hide();  
            });
            
            $('#notAbleToWork').click(function(){
              $("#notAbleDiv").show();  
            });
            $('#ableToWork').click(function(){
              $("#notAbleDiv").hide();  
            });
            
            $('#partTime').click(function(){
              $("#partTimeDiv").show();  
            });
            $('#fullTime').click(function(){
              $("#partTimeDiv").hide();  
            });
});
</script>