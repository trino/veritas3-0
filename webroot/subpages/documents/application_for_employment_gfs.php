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
                        <input class="form-control" name="" placeholder="Last" />
                    </div> 
                    <div class="col-md-3">              
                        <input class="form-control" name="" placeholder="Middle" />
                    </div> 
                    <div class="col-md-3">              
                        <input class="form-control" name="" placeholder="First" />
                    </div>
            </div>
            <div class="col-md-6">
                    <label class="control-label col-md-4">Telephone : </label>  
                    <div class="col-md-3">              
                        <input class="form-control" name="" placeholder="Area Code" />
                    </div>  
                    <div class="col-md-5">              
                        <input class="form-control" name="" />
                    </div>
            </div> 
        </div>
        
        <p>&nbsp;</p>
            <div class="col-md-12">
                    <label class="control-label col-md-4">Current Address : </label>  
                    <div class="col-md-8">              
                        <input class="form-control" name=""/>
                    </div>  
            </div>
            
        <p>&nbsp;</p>
            <div class="col-md-12">
                    <label class="control-label col-md-4">Have you ever applied for work with us before? </label>  
                    <div class="col-md-2 radio-list yesNoCheck">
                        <label class="radio-inline">              
                        <input type="radio" class="form-control" name="workedbefore" id="yesCheck"/> <span>Yes</span>
                        </label>
                        <label class="radio-inline">
                        <input type="radio" class="form-control" name="workedbefore" id="noCheck"/> <span>No</span>
                        </label>
                    </div>
                    <div id="yesDiv" style="display: none;">
                        <label class="control-label col-md-2">If yes, when? </label> 
                        <div class="col-md-4">              
                            <textarea class="form-control" name=""></textarea>
                        </div>
                    </div> 
            </div>
            <p>&nbsp;</p>
            <div class="col-md-12">
                    <label class="control-label col-md-4">List anyone you know who woks for us: </label>  
                    <div class="col-md-8">
                        <input class="form-control" name=""/> 
                    </div>
            </div>
            <p>&nbsp;</p>
            <div class="col-md-12">
                    <label class="control-label col-md-4">Did anyone refer you? </label>  
                    <div class="col-md-8">
                        <input class="form-control" name=""/> 
                    </div>
            </div>
            <p>&nbsp;</p>
            <div class="col-md-6">
                    <label class="control-label col-md-8">Are you 18 years of age or older? </label>  
                    <div class="col-md-4 radio-list">
                        <label class="radio-inline">              
                        <input type="radio" class="form-control" name="age"/>Yes
                        </label>
                        <label class="radio-inline">
                        <input type="radio" class="form-control" name="age"/> No
                        </label>
                    </div>
            </div>
            <div class="col-md-6">
                    <label class="control-label col-md-8">Are you legally eligible to work in Canada? </label>  
                    <div class="col-md-4 radio-list">
                        <label class="radio-inline">              
                        <input type="radio" class="form-control" name="legal"/>Yes
                        </label>
                        <label class="radio-inline">
                        <input type="radio" class="form-control" name="legal"/> No
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
                        <td><input class="form-control"/></td>
                        <td><input class="form-control"/></td>
                        <td><input class="form-control"/></td>
                        <td><input class="form-control"/></td>
                    </tr>
                    <tr>
                        <th>High</th>
                        <td><input class="form-control"/></td>
                        <td><input class="form-control"/></td>
                        <td><input class="form-control"/></td>
                        <td><input class="form-control"/></td>
                    </tr>
                    <tr>
                        <th>College</th>
                        <td><input class="form-control"/></td>
                        <td><input class="form-control"/></td>
                        <td><input class="form-control"/></td>
                        <td><input class="form-control"/></td>
                    </tr>
                    <tr>
                        <th>Other</th>
                        <td><input class="form-control"/></td>
                        <td><input class="form-control"/></td>
                        <td><input class="form-control"/></td>
                        <td><input class="form-control"/></td>
                    </tr>
                </tbody>
            </table>
        </div>
        
            <p>&nbsp;</p>
            <div class="col-md-12">
                    <label class="control-label col-md-10">Do you have any skills, qualifications or experiences which you feel would specially fit you for working with us? </label>  
                    <div class="col-md-2">
                        <textarea class="form-control" name=""></textarea> 
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
                            <input class="form-control" /> 
                        </div>
                        <label class="control-label col-md-3">Rate of pay expected $ </label>
                        <div class="col-md-2">
                            <input class="form-control" /> 
                        </div>
                        <label class="control-label col-md-1">per </label>
                        <div class="col-md-2">
                            <input class="form-control" /> 
                        </div>
                    </div>
                    <p>&nbsp;</p>
                    <div class="col-md-12">
                        <label class="control-label col-md-1">2. </label>
                        <div class="col-md-3">
                            <input class="form-control" /> 
                        </div>
                        <label class="control-label col-md-3">Rate of pay expected $ </label>
                        <div class="col-md-2">
                            <input class="form-control" /> 
                        </div>
                        <label class="control-label col-md-1">per </label>
                        <div class="col-md-2">
                            <input class="form-control" /> 
                        </div>
                    </div>
            </div>
            <p>&nbsp;</p>
            <div class="col-md-12">
                    <label class="control-label col-md-5">Do you want to work: </label>  
                    <div class="col-md-7 radio-list">
                        <label class="radio-inline">              
                        <input type="radio" class="form-control" name="legal" id="partTime"/> Part Time
                        </label>
                        <label class="radio-inline">
                        <input type="radio" class="form-control" name="legal" id="fullTime"/> Full Time ?
                        </label>
                    </div>
            </div>
            <div id="partTimeDiv" style="display: none;">
            <p>&nbsp;</p>
            <div class="col-md-12">
                <label class="control-label col-md-5">If applying only for part-time, which days and hours?</label> 
                <div class="col-md-7">              
                    <textarea class="form-control" name=""></textarea>
                </div>
            </div>
            </div>
            <p>&nbsp;</p>
            <div class="col-md-12">
                    <label class="control-label col-md-5">Are you able to do the job(s) for which you are applying? </label>  
                    <div class="col-md-7 radio-list">
                        <label class="radio-inline">              
                        <input type="radio" class="form-control" name="legal" id="ableToWork"/> Yes
                        </label>
                        <label class="radio-inline">
                        <input type="radio" class="form-control" name="legal" id="notAbleToWork"/> No
                        </label>
                    </div> 
            </div>
            <div id="notAbleDiv" style="display: none;">
            <p>&nbsp;</p>
            <div class="col-md-12">
                <label class="control-label col-md-5">If no, please explain: </label> 
                <div class="col-md-7">              
                    <textarea class="form-control" name=""></textarea>
                </div>
            </div>
             </div> 
             
             <p>&nbsp;</p>
            <div class="col-md-12">
                <label class="control-label col-md-5">If hired, when can you start?</label> 
                <div class="col-md-7">              
                    <input class="form-control" name=""/>
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
                        <td><input class="form-control"/></td>
                        <td><input class="form-control"/></td>
                        <td><input class="form-control"/></td>
                    </tr>
                    <tr>
                        <th>Next Previous</th>
                        <td><input class="form-control"/></td>
                        <td><input class="form-control"/></td>
                        <td><input class="form-control"/></td>
                    </tr>
                    <tr>
                        <th>Next Previous</th>
                        <td><input class="form-control"/></td>
                        <td><input class="form-control"/></td>
                        <td><input class="form-control"/></td>
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
                        <td><input class="form-control"/></td>
                        <td><input class="form-control"/></td>
                    </tr>
                    <tr>
                        <td><input class="form-control"/></td>
                        <td><input class="form-control"/></td>
                    </tr>
                    <tr>
                        <td><input class="form-control"/></td>
                        <td><input class="form-control"/></td>
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
                        <td><input class="form-control"/></td>
                    </tr>
                    <tr>
                        <th>Tractor and Semi-Trailer</th>
                        <td><input class="form-control"/></td>
                    </tr>
                    <tr>
                        <th>Tractor and Two-Trailer</th>
                        <td><input class="form-control"/></td>
                    </tr>
                    <tr>
                        <th>Other</th>
                        <td><input class="form-control"/></td>
                    </tr>
                </tbody>
            </table>
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