<?php
 if($this->request->session()->read('debug')){  echo "<span style ='color:red;'>subpages/documents/mee_attach.php #INC204</span>";}
 ?>
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
                    <label class="control-label col-md-4">Applicant's Name : </label>  
                    <div class="col-md-8">              
                        <input class="form-control" name="applicant_name" />
                    </div>
            </div>
            <div class="col-md-6">
                    <label class="control-label col-md-4">Date : </label>  
                    <div class="col-md-8">              
                        <input class="form-control" name="date" />
                    </div>
            </div> 
        </div> 
        <div class="clearfix"></div>
        
        <div class="col-md-12">
            <p>&nbsp;</p>
            <em class="col-md-12">In order to better understand your interests and needs you believe should be present
    
            in the company you work for, please answer the following questions about a previous 
            
            employer. This is not a test, there are no right or wrong answers. The best answer 
            
            is always your honest opinion. Please respond as candidly as possible. Choose the 
            
            response which best reflects your opinion about each item:</em>
            <p>&nbsp;</p>
        <div class="clearfix"></div>
        </div>
        
        <div class="col-md-12">
            <label class="control-label col-md-4">Past Employer (Company): </label>  
            <div class="col-md-8">              
                <input class="form-control" name="past_employer" />
            </div>
        </div>
        <p>&nbsp;</p>
        <div class="col-md-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Statements</th>
                        <th>Strongly Disagree</th>
                        <th>Disagree</th>
                        <th>Neither agree nor disagree</th>
                        <th>Agree</th>
                        <th>Strongly Agree</th>
                    </tr>
                </thead>
                
                <tbody>
                    <tr>
                        <td>The working conditions were OK</td>
                        <td><input type="radio" name="c1" value="1" /></td>
                        <td><input type="radio" name="c1" value="2" /></td>
                        <td><input type="radio" name="c1" value="3" /></td>
                        <td><input type="radio" name="c1" value="4" /></td>
                        <td><input type="radio" name="c1" value="5" /></td>
                    </tr>
                    <tr>
                        <td>The people I worked with got along well together</td>
                        <td><input type="radio" name="c2" value="1" /></td>
                        <td><input type="radio" name="c2" value="2" /></td>
                        <td><input type="radio" name="c2" value="3" /></td>
                        <td><input type="radio" name="c2" value="4" /></td>
                        <td><input type="radio" name="c2" value="5" /></td>
                                         
                    </tr>
                    <tr>
                        <td>My supervisor was concerned about my ideas and my suggestions</td>
                        <td><input type="radio" name="c3" value="1" /></td>
                        <td><input type="radio" name="c3" value="2" /></td>
                        <td><input type="radio" name="c3" value="3" /></td>
                        <td><input type="radio" name="c3" value="4" /></td>
                        <td><input type="radio" name="c3" value="5" /></td> 
                    </tr>
                    <tr>
                        <td>I frequently was concerned about losing my job</td>
                        <td><input type="radio" name="c4" value="1" /></td>
                        <td><input type="radio" name="c4" value="2" /></td>
                        <td><input type="radio" name="c4" value="3" /></td>
                        <td><input type="radio" name="c4" value="4" /></td>
                        <td><input type="radio" name="c4" value="5" /></td>                     
                    </tr>
                    <tr>
                        <td>I made a good choice working for the above company</td>
                        <td><input type="radio" name="c5" value="1" /></td>
                        <td><input type="radio" name="c5" value="2" /></td>
                        <td><input type="radio" name="c5" value="3" /></td>
                        <td><input type="radio" name="c5" value="4" /></td>
                        <td><input type="radio" name="c5" value="5" /></td>
                    </tr>
                    <tr>
                        <td>Management was not responsive to employees' problems, or complaints</td> 
                        <td><input type="radio" name="c6" value="1" /></td>
                        <td><input type="radio" name="c6" value="2" /></td>
                        <td><input type="radio" name="c6" value="3" /></td>
                        <td><input type="radio" name="c6" value="4" /></td>
                        <td><input type="radio" name="c6" value="5" /></td>
                    </tr>
                    <tr>
                        <td>I liked my job - the kind of work I did</td> 
                        <td><input type="radio" name="c7" value="1" /></td>
                        <td><input type="radio" name="c7" value="2" /></td>
                        <td><input type="radio" name="c7" value="3" /></td>
                        <td><input type="radio" name="c7" value="4" /></td>
                        <td><input type="radio" name="c7" value="5" /></td>
                    </tr>
                    <tr>
                        <td>The pay I received was fair to the type of work I did</td> 
                        <td><input type="radio" name="c8" value="1" /></td>
                        <td><input type="radio" name="c8" value="2" /></td>
                        <td><input type="radio" name="c8" value="3" /></td>
                        <td><input type="radio" name="c8" value="4" /></td>
                        <td><input type="radio" name="c8" value="5" /></td>
                    </tr>
                    <tr>
                        <td>I received adequate recognition when I did a good job</td> 
                        <td><input type="radio" name="c9" value="1" /></td>
                        <td><input type="radio" name="c9" value="2" /></td>
                        <td><input type="radio" name="c9" value="3" /></td>
                        <td><input type="radio" name="c9" value="4" /></td>
                        <td><input type="radio" name="c9" value="5" /></td>
                    </tr>
                    <tr>
                        <td>I was satisfied with the benefits I received from the above company</td> 
                        <td><input type="radio" name="c10" value="1" /></td>
                        <td><input type="radio" name="c10" value="2" /></td>
                        <td><input type="radio" name="c10" value="3" /></td>
                        <td><input type="radio" name="c10" value="4" /></td>
                        <td><input type="radio" name="c10" value="5" /></td>
                    </tr>
                    <tr>
                        <td>My supervisor was not fair in dealing with me</td> 
                        <td><input type="radio" name="c11" value="1" /></td>
                        <td><input type="radio" name="c11" value="2" /></td>
                        <td><input type="radio" name="c11" value="3" /></td>
                        <td><input type="radio" name="c11" value="4" /></td>
                        <td><input type="radio" name="c11" value="5" /></td>
                    </tr>
                    <tr>
                        <td>Management lived up to their promises</td> 
                        <td><input type="radio" name="c12" value="1" /></td>
                        <td><input type="radio" name="c12" value="2" /></td>
                        <td><input type="radio" name="c12" value="3" /></td>
                        <td><input type="radio" name="c12" value="4" /></td>
                        <td><input type="radio" name="c12" value="5" /></td>
                    </tr>
                </tbody>
            </table>
        </div>
                    
                
        <div class="clearfix"></div>
    

</form>
<script>

</script>