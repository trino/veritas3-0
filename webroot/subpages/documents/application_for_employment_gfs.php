<form id="form_tab16">
        <input type="hidden" class="document_type" name="document_type" value="Past Employment Survey"/>
        <input type="hidden" name="sub_doc_id" value="16" class="sub_docs_id" id="af" />
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
                        <input class="form-control" name="name_gfs" placeholder="Last" />
                    </div> 
                    <div class="col-md-3">              
                        <input class="form-control" name="middle_gfs" placeholder="Middle" />
                    </div> 
                    <div class="col-md-3">              
                        <input class="form-control" name="first_gfs" placeholder="First" />
                    </div>
            </div>
            <div class="col-md-6">
                    <label class="control-label col-md-4">Telephone : </label>  
                    <div class="col-md-3">              
                        <input class="form-control" name="area_code_gfs" placeholder="Area Code" />
                    </div>  
                    <div class="col-md-5">              
                        <input class="form-control" name="phone_gfs" />
                    </div>
            </div> 
        </div>
        
        <p>&nbsp;</p>
            <div class="col-md-12">
                    <label class="control-label col-md-4">Current Address : </label>  
                    <div class="col-md-8">              
                        <input class="form-control" name="current_add_gfs"/>
                    </div>  
            </div>
            
        <p>&nbsp;</p>
            <div class="col-md-12">
                    <label class="control-label col-md-4">Have you ever applied for work with us before? </label>  
                    <div class="col-md-2 radio-list yesNoCheck">
                        <label class="radio-inline">              
                        <input type="radio" class="form-control" name="workedbefore" value="1" id="yesCheck"/> <span>Yes</span>
                        </label>
                        <label class="radio-inline">
                        <input type="radio" class="form-control" name="workedbefore" value="2" id="noCheck"/> <span>No</span>
                        </label>
                    </div>
                    <div id="yesDiv" style="display: none;">
                        <label class="control-label col-md-2">If yes, when? </label> 
                        <div class="col-md-4">              
                            <textarea class="form-control" name="if_yes"></textarea>
                        </div>
                    </div> 
            </div>
            <p>&nbsp;</p>
            <div class="col-md-12">
                    <label class="control-label col-md-4">List anyone you know who works for us: </label>  
                    <div class="col-md-8">
                        <input class="form-control" name="anyone_works"/> 
                    </div>
            </div>
            <p>&nbsp;</p>
            <div class="col-md-12">
                    <label class="control-label col-md-4">Did anyone refer you? </label>  
                    <div class="col-md-8">
                        <input class="form-control" name="anyone_refer"/> 
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
                        <td><input class="form-control" name="years_attended1"/></td>
                        <td><input class="form-control" name="city_state1"/></td>
                        <td><input class="form-control" name="course1"/></td>
                        <td><input class="form-control" name="graduate1"/></td>
                    </tr>
                    <tr>
                        <th>High</th>
                        <td><input class="form-control" name="years_attended2"/></td>
                        <td><input class="form-control" name="city_state2"/></td>
                        <td><input class="form-control" name="course2"/></td>
                        <td><input class="form-control" name="graduate2"/></td>
                    </tr>
                    <tr>
                        <th>College</th>
                        <td><input class="form-control" name="years_attended3"/></td>
                        <td><input class="form-control" name="city_state3"/></td>
                        <td><input class="form-control" name="course3"/></td>
                        <td><input class="form-control" name="graduate3"/></td>
                    </tr>
                    <tr>
                        <th>Other</th>
                        <td><input class="form-control" name="years_attended4"/></td>
                        <td><input class="form-control" name="city_state4"/></td>
                        <td><input class="form-control" name="course4"/></td>
                        <td><input class="form-control" name="graduate4"/></td>
                    </tr>
                </tbody>
            </table>
        </div>
        
            <p>&nbsp;</p>
            <div class="col-md-12">
                    <label class="control-label col-md-6">Do you have any skills, qualifications or experiences which you feel would specially fit you for working with us? </label>  
                    <div class="col-md-6">
                        <textarea class="form-control" name="any_skills"></textarea> 
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
                            <input class="form-control" name="applied_for_1" /> 
                        </div>
                        <label class="control-label col-md-3">Rate of pay expected $ </label>
                        <div class="col-md-2">
                            <input class="form-control" name="rate_pay_1" /> 
                        </div>
                        <label class="control-label col-md-1">per </label>
                        <div class="col-md-2">
                            <input class="form-control" name="per1" /> 
                        </div>
                    </div>
                    <p>&nbsp;</p>
                    <div class="col-md-12">
                        <label class="control-label col-md-1">2. </label>
                        <div class="col-md-3">
                            <input class="form-control" name="applied_for_2" /> 
                        </div>
                        <label class="control-label col-md-3">Rate of pay expected $ </label>
                        <div class="col-md-2">
                            <input class="form-control" name="rate_pay_2" /> 
                        </div>
                        <label class="control-label col-md-1">per </label>
                        <div class="col-md-2">
                            <input class="form-control" name="per2" /> 
                        </div>
                    </div>
            </div>
            <p>&nbsp;</p>
            <div class="col-md-12">
                    <label class="control-label col-md-5">Do you want to work: </label>  
                    <div class="col-md-7 radio-list">
                        <label class="radio-inline">              
                        <input type="radio" class="form-control" name="want_work" value="parttime" id="partTime"/> Part Time
                        </label>
                        <label class="radio-inline">
                        <input type="radio" class="form-control" name="want_work" value="fulltime" id="fullTime"/> Full Time ?
                        </label>
                    </div>
            </div>
            <div id="partTimeDiv" style="display: none;">
            <p>&nbsp;</p>
            <div class="col-md-12">
                <label class="control-label col-md-5">If applying only for part-time, which days and hours?</label> 
                <div class="col-md-7">              
                    <textarea class="form-control" name="which_day_hour"></textarea>
                </div>
            </div>
            </div>
            <p>&nbsp;</p>
            <div class="col-md-12">
                    <label class="control-label col-md-5">Are you able to do the job(s) for which you are applying? </label>  
                    <div class="col-md-7 radio-list">
                        <label class="radio-inline">              
                        <input type="radio" class="form-control" name="able_jobs" value="1" id="ableToWork"/> Yes
                        </label>
                        <label class="radio-inline">
                        <input type="radio" class="form-control" name="able_jobs" value="0" id="notAbleToWork"/> No
                        </label>
                    </div> 
            </div>
            <div id="notAbleDiv" style="display: none;">
            <p>&nbsp;</p>
            <div class="col-md-12">
                <label class="control-label col-md-5">If no, please explain: </label> 
                <div class="col-md-7">              
                    <textarea class="form-control" name="if_no_explain"></textarea>
                </div>
            </div>
             </div> 
             
             <p>&nbsp;</p>
            <div class="col-md-12">
                <label class="control-label col-md-5">If hired, when can you start?</label> 
                <div class="col-md-7">              
                    <input class="form-control" name="when_start"/>
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
                        <td><input class="form-control" name="nature_collision1"/></td>
                        <td><input class="form-control" name="injuries1"/></td>
                        <td><input class="form-control" name="vehicle_type1"/></td>
                    </tr>
                    <tr>
                        <th>Next Previous</th>
                        <td><input class="form-control" name="nature_collision2"/></td>
                        <td><input class="form-control" name="injuries2"/></td>
                        <td><input class="form-control" name="vehicle_type2"/></td>
                    </tr>
                    <tr>
                        <th>Next Previous</th>
                        <td><input class="form-control" name="nature_collision3"/></td>
                        <td><input class="form-control" name="injuries3"/></td>
                        <td><input class="form-control" name="vehicle_type3"/></td>
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
                        <td><input class="form-control" name="class1"/></td>
                        <td><input class="form-control" name="expires1"/></td>
                    </tr>
                    <tr>
                        <td><input class="form-control" name="class2"/></td>
                        <td><input class="form-control" name="expires2"/></td>
                    </tr>
                    <tr>
                        <td><input class="form-control" name="class3"/></td>
                        <td><input class="form-control" name="expires3"/></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <p>&nbsp;</p>
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
                        <td><input class="form-control" name="approx_miles1"/></td>
                    </tr>
                    <tr>
                        <th>Tractor and Semi-Trailer</th>
                        <td><input class="form-control" name="approx_miles2"/></td>
                    </tr>
                    <tr>
                        <th>Tractor and Two-Trailer</th>
                        <td><input class="form-control" name="approx_miles3"/></td>
                    </tr>
                    <tr>
                        <th>Other</th>
                        <td><input class="form-control" name="approx_miles4"/></td>
                    </tr>
                </tbody>
            </table>
        </div>   
          <p>&nbsp;</p>      
        
        <div class="col-md-12">
            <label class="col-md-6">Show special courses or training that will help you as as driver</label>
            <div class="col-md-6"><textarea class="form-control" name="special_course"></textarea></div>
            <p>&nbsp;</p>
        </div>
        <div class="col-md-12">
            <label class="col-md-6">Which safe driving awaards do you hold and from whom?</label>
            <div class="col-md-6"><textarea class="form-control" name="which_safe_driving"></textarea></div>
            <p>&nbsp;</p>
        </div>
        <div class="col-md-12">
            <label class="col-md-6">Show any trucking, transportation or other experiences that may help in your work for this company:</label>
            <div class="col-md-6"><textarea class="form-control" name="show_any_trucking"></textarea></div>
            <p>&nbsp;</p>
        </div>
        <div class="col-md-12">
            <label class="col-md-6">List courses and training other than shown elsewhere in this application</label>
            <div class="col-md-6"><textarea class="form-control" name="list_courses_training"></textarea></div>
            <p>&nbsp;</p>
        </div>
        <div class="col-md-12">
            <label class="col-md-6">List special equipment or technical materials you can work with (other than those already shown)</label>
            <div class="col-md-6"><textarea class="form-control" name="list_special_equipment"></textarea></div>
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
                        <div class="col-md-12"><textarea name="name_and_address_employer1" class="form-control form-control"></textarea></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="col-md-12">Dates of Employment</label>
                        <div class="col-md-6"><input type="text" class="date-picker form-control" name="date_of_employment_from1" placeholder="From" /></div><div class="col-md-6"><input type="text" class="date-picker form-control" name="date_of_employment_to1" placeholder="To" /></div>
                    </td>
                    <td colspan="2">
                        <label class="col-md-12">Type of work done</label>
                        <div class="col-md-12"><textarea name="type_of_work_done1" class="form-control"></textarea></div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <label class="col-md-12">Supervisor's Name & Phone No.:</label>
                        <div class="col-md-12"><textarea name="supervisor_name_phone1" class="form-control form-control"></textarea></div>
                    </td>
                    <td>
                       <label class="col-md-12">Final Salary</label> 
                       <div class="col-md-12"><input type="text" class="form-control" name="final_salary1" /></div>
                    </td>               
                </tr>
                <tr>
                    <td colspan="3">
                        <label class="col-md-12">Reasons of leaving:</label>
                        <div class="col-md-12"><textarea name="reasons_of_leaving1" class="form-control form-control"></textarea></div>
                    </td>
                </tr>
            </table>
            
            <p>&nbsp;</p>
            <table class="table table-bordered">
                <tr>
                    <td colspan="3">
                        <label class="col-md-12">Name & Address Of Employer:</label>
                        <div class="col-md-12"><textarea name="name_and_address_employer2" class="form-control form-control"></textarea></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="col-md-12">Dates of Employment</label>
                        <div class="col-md-6"><input type="text" class="date-picker form-control" name="date_of_employment_from2" placeholder="From" /></div><div class="col-md-6"><input type="text" class="date-picker form-control" name="date_of_employment_to2" placeholder="To" /></div>
                    </td>
                    <td colspan="2">
                        <label class="col-md-12">Type of work done</label>
                        <div class="col-md-12"><textarea name="type_of_work_done2" class="form-control"></textarea></div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <label class="col-md-12">Supervisor's Name & Phone No.:</label>
                        <div class="col-md-12"><textarea name="supervisor_name_phone2" class="form-control form-control"></textarea></div>
                    </td>
                    <td>
                       <label class="col-md-12">Final Salary</label> 
                       <div class="col-md-12"><input type="text" class="form-control" name="final_salary2" /></div>
                    </td>               
                </tr>
                <tr>
                    <td colspan="3">
                        <label class="col-md-12">Reasons of leaving:</label>
                        <div class="col-md-12"><textarea name="reasons_of_leaving2" class="form-control form-control"></textarea></div>
                    </td>
                </tr>
            </table>
            
            <p>&nbsp;</p>
            <table class="table table-bordered">
                <tr>
                    <td colspan="3">
                        <label class="col-md-12">Name & Address Of Employer:</label>
                        <div class="col-md-12"><textarea name="name_and_address_employer3" class="form-control form-control"></textarea></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="col-md-12">Dates of Employment</label>
                        <div class="col-md-6"><input type="text" class="date-picker form-control" name="date_of_employment_from3" placeholder="From" /></div><div class="col-md-6"><input type="text" class="date-picker form-control" name="date_of_employment_to3" placeholder="To" /></div>
                    </td>
                    <td colspan="2">
                        <label class="col-md-12">Type of work done</label>
                        <div class="col-md-12"><textarea name="type_of_work_done3" class="form-control"></textarea></div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <label class="col-md-12">Supervisor's Name & Phone No.:</label>
                        <div class="col-md-12"><textarea name="supervisor_name_phone3" class="form-control form-control"></textarea></div>
                    </td>
                    <td>
                       <label class="col-md-12">Final Salary</label> 
                       <div class="col-md-12"><input type="text" class="form-control" name="final_salary3" /></div>
                    </td>               
                </tr>
                <tr>
                    <td colspan="3">
                        <label class="col-md-12">Reasons of leaving:</label>
                        <div class="col-md-12"><textarea name="reasons_of_leaving3" class="form-control form-control"></textarea></div>
                    </td>
                </tr>
            </table>
        </div>
        <p>&nbsp;</p>
        <div class="col-md-12">
            <label class="col-md-6">Would you be willing to take a physical exam?</label>
            <div class="col-md-6"><input type="checkbox" name="physical_exam" value="1" /> Yes &nbsp; &nbsp; <input type="checkbox" name="physical_exam" value="0" /> No</div>
        </div>
        <p>&nbsp;</p>
        <div class="col-md-12">
            <label class="col-md-6">What are your aspirations, now and in the future?</label>
            <div class="col-md-12"><textarea class="form-control" name="aspirations"></textarea></div>
        </div>
        <p>&nbsp;</p>
        <div class="col-md-12">
            <label class="col-md-6">Why do you think you are the best qualified candidate?</label>
            <div class="col-md-12"><textarea class="form-control" name="best_qualified"></textarea></div>
        </div>
        <p>&nbsp;</p>
        <div class="col-md-12">
            <label class="col-md-6">Would you be willing to relocate?</label>
            <div class="col-md-6"><input type="checkbox" name="willing_relocate" value="1" /> Yes &nbsp; &nbsp; <input type="checkbox" name="willing_relocate" value="0" /> No</div>
        </div>
        <p>&nbsp;</p>
        <div class="col-md-12">
            <label class="col-md-6">Which of your former positions did you like best and why?</label>
            <div class="col-md-12"><textarea class="form-control" name="best_former_posotions"></textarea></div>
        </div>
        <p>&nbsp;</p>
        <div class="col-md-12">
             <h3>OTHER INFORMATION</h3>
             <p>
             You may attach a separate sheet of paper to list any other information necessary to answer fully the above, or add any additional information about

                yourself that you wish to be considered.
             </p>
             <textarea name="other_information" class="form-control" placeholder="OTHER INFORMATION"></textarea>
        </div>
        <p>&nbsp;</p>
        <div class="col-md-12">
             <h3>BUSINESS REFERENCES</h3>
             <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Address and Telephone No.</th>
                        <th>Occupation</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input name="business_communication_name1" class="form-control" /></td>                    
                        <td><input name="business_communication_address1" class="form-control" /></td>
                        <td><input name="business_communication_occupation1" class="form-control" /></td>
                    </tr>
                    <tr>
                        <td><input name="business_communication_name2" class="form-control" /></td>                    
                        <td><input name="business_communication_address2" class="form-control" /></td>
                        <td><input name="business_communication_occupation2" class="form-control" /></td>
                    </tr>
                </tbody>
             </table>
        </div>
        
        <p>&nbsp;</p>
        <div class="col-md-12">
            <h3>APPLICANT’S CERTIFICATION AND AGREEMENT</h3>   
            <strong>PLEASE READ EACH SECTION CAREFULLY AND CHECK THE BOX:</strong> 
            <p>&nbsp;</p>  
            <p><input type="checkbox" name="checkbox1" /> &nbsp; 1. AUTHORIZATION FOR EMPLOYMENT/EDUCATIONAL INFORMATION. I authorize the references listed in this
    
                Application for Employment, and any prior employer, educational institution, or any other persons or organizations to give Gordon Food Service
                
                any and all information concerning my previous employment/educational accomplishments, disciplinary information or any other pertinent informa-
                tion they may have, personal or otherwise, and release all parties from all liability for any damage that may result from furnishing same to you. I
                
                hereby waive written notice that employment information is being provided by any person or organization.
            </p> 
            <p><input type="checkbox" name="checkbox2" /> &nbsp; 2. TERMINATION OF EMPLOYMENT. If I am hired, in consideration of my employment, I agree to abide by the rules and policies of

                Gordon Food Service, including any changes made from time to time, and agree that my employment and compensation can be terminated with or
                
                without cause, at any time with the provision of the appropriate statutory notice or pay in lieu of notice.
            </p>  
            <p>
                <input type="checkbox" name="checkbox3" /> &nbsp; 3. RELEASE OF MEDICAL INFORMATION. I authorize every medical doctor, physician or other healthcare provider to provide any

                and all information, including but not limited to, all medical reports, laboratory reports, X-rays or clinical abstracts relating to my previous health
                
                history or employment in connection with any examination, consultation, tests or evaluation. I hereby release every medical doctor, healthcare per-
                sonnel and every other person, firm, officer, corporation, association, organization or institution which shall comply with the authorization or
                
                request made in this respect from any and all liability. I understand
                
                until a job offer has been made
            </p>
            <p>
                <input type="checkbox" name="checkbox4" /> &nbsp; 4. PHYSICAL EXAM AND DRUG AND ALCOHOL TESTING. I agree to take a physical exam and authorize Gordon Food Service

or its designated agent(s) to withdraw specimen(s) of my blood, urine or hair for chemical analysis. One purpose of this analysis is to determine or

exclude the presence of alcohol, drugs or other substances. I authorize the release of the test results to Gordon Food Service. I understand that deci-
sions concerning my employment will be made as a result of these tests.
            </p>
            <p>
                <input type="checkbox" name="checkbox5" /> &nbsp; 5. CONSIDERATION FOR EMPLOYMENT. I understand that my application will be considered pursuant

normal procedures for a period of thirty (30) days. If I am still interested in employment thereafter, I must reapply.
            </p>
            <p>
                <input type="checkbox" name="checkbox6" /> &nbsp; 6. DRIVING RECORDS CHECK. If applying for a position that requires driving a company vehicle, I authorize Gordon Food Service,

Inc. and its agents the authority to make investigations and inquiries of my driving record following a conditional offer of employment.
            </p>
            <p>
                <input type="checkbox" name="checkbox7" /> &nbsp; 7. CERTIFICATION OF TRUTHFULNESS. I certify that all statements on this Application for Employment are completed by me and

to the best of my knowledge are true, complete, without evasion, and further understand and agree that such statements may be investigated and if

found to be false will be sufficient reason for not being employed, or if employed may result in my dismissal. I have read and understood items one

through 7 inclusive, and acknowledge that with my signature below.
            </p>
        </div>
        <div class="clearfix"></div>
        <p>&nbsp;</p>
        
        <div class="col-md-6">
            <label class="col-md-6">Dated</label>
            <input type="text" name="dated" class="form-control date-picker" />
        </div>
        <div class="col-md-6">
            <label class="col-md-12">Signature</label>
            <?php include('canvas/gfs_signature.php');?>
            
        </div>
        
        <p>&nbsp;</p>
        
        <div class="col-md-12" style="">
            <h3 style="color: #FFF;background: #5B5A5A;padding:5px;">Process Record - For Use by Gordon Food Service Representatives ONLY!</h3>
        </div>
        <div class="col-md-12">
            <div class="col-md-4">
                <label class="col-md-6">Applicant Hired</label>
                <div class="col-md-6"><input type="text" name="applicant_hired" class="form-control" /></div>            
            </div>
            <div class="col-md-4">
                <label class="col-md-6">Date Employed</label>
                <div class="col-md-6"><input type="text" name="date_employed" class="form-control date-picker" /></div>            
            </div>
            <div class="col-md-4">
                <label class="col-md-6">Starting Salary/Wage</label>
                <div class="col-md-6"><input type="text" name="starting_salary" class="form-control" /></div>            
            </div>
        </div>
        <p>&nbsp;</p>
        <div class="col-md-12">
            <div class="col-md-8">
                <label class="col-md-3">Position</label>
                <div class="col-md-9"><input type="text" name="position_company" class="form-control" /></div>            
            </div>
            <div class="col-md-4">
                <label class="col-md-6">Branch</label>
                <div class="col-md-6"><input type="text" name="branch_company" class="form-control" /></div>            
            </div>
            
        </div>
        <p>&nbsp;</p>
        <div class="col-md-12">
            <div class="col-md-12">
                <label class="col-md-12">Comments</label>
                <div class="col-md-12"><textarea name="comments_company" class="form-control"></textarea></div>            
            </div>
            <p>&nbsp;</p>
             <div class="col-md-12">
                <label class="col-md-12">If rejected, give reasons:</label>
                <div class="col-md-12"><textarea name="if_rejected" class="form-control"></textarea></div>            
            </div>       
        </div>
        <div class="clearfix"></div>
        
    

</form>
<script>
$(function () {
        <?php if($this->request->params['action'] != 'vieworder'  && $this->request->params['action']!= 'view'){?>
        $("#test0").jqScribble();
        <?php }?>
    });
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