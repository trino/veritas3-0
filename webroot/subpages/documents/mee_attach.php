<?php
 if($_SERVER['SERVER_NAME'] =='localhost'){  echo "<span style ='color:red;'>subpages/documents/mee_attachments.php #INC203</span>";}
 ?>
<form id="form_tab15">
<input type="hidden" class="document_type" name="document_type" value="MEE Attachments"/>
<input type="hidden" name="sub_doc_id" value="15" class="sub_docs_id" id="af" />
<div class="clearfix"></div>
<hr/>

        
            <?php
            $controller = $this->request->params['controller'];
            $controller = strtolower($controller);
            /*$controller = $this->request->params['controller'];
            $controller = strtolower($controller);

            include_once 'subpages/filelist.php';
            printdocumentinfo($did);
            if( isset($pre_at)){  listfiles($pre_at['attach_doc'], "attachments/", "", false,3); }
            */
            //echo "</div>";
            if($controller == 'orders' )
            {
                //echo '<h4 class="col-md-12">MEE Attachments</h4>';
                }
                else {
                    
                }
                ?>
        <div class="form-group row">
            <div class="col-md-12">
                <label class="control-label col-md-4">Upload 2 pieces of ID : </label>                
                <span><a href="javascript:void(0)" class="btn btn-primary" id="mee_att_1">Browse</a>&nbsp;<span class="uploaded"><?php if(isset($mee_att['attach_doc']) && $mee_att['attach_doc']->id_piece1){?><a class="dl" href="<?php echo $this->request->webroot;?>documents/download/<?php echo $mee_att['attach_doc']->id_piece1;?>"><?php echo $mee_att['attach_doc']->id_piece1;?></a><?php }?></span></span> <span><a href="javascript:void(0)" class="btn btn-primary" id="mee_att_2">Browse</a>&nbsp;<span class="uploaded"><?php if(isset($mee_att['attach_doc']) && $mee_att['attach_doc']->id_piece1){?><a class="dl" href="<?php echo $this->request->webroot;?>documents/download/<?php echo $mee_att['attach_doc']->id_piece2;?>"><?php echo $mee_att['attach_doc']->id_piece2;?></a><?php }?></span></span>
                <input type="hidden" name="id_piece1" class="mee_att_1" value="<?php if(isset($mee_att['attach_doc']) && $mee_att['attach_doc']->id_piece1){ echo $mee_att['attach_doc']->id_piece1; }?>" />
                <input type="hidden" name="id_piece2" class="mee_att_2" value="<?php if(isset($mee_att['attach_doc']) && $mee_att['attach_doc']->id_piece2){ echo $mee_att['attach_doc']->id_piece2; }?>" />

            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-12">
                <label class="control-label col-md-4">Upload Driver’s Record Abstract : </label>    
                <span><a href="javascript:void(0)" class="btn btn-primary" id="mee_att_3">Browse</a>&nbsp;<span class="uploaded"><?php if(isset($mee_att['attach_doc']) && $mee_att['attach_doc']->driver_record_abstract){?><a class="dl" href="<?php echo $this->request->webroot;?>documents/download/<?php echo $mee_att['attach_doc']->driver_record_abstract;?>"><?php echo $mee_att['attach_doc']->driver_record_abstract;?></a><?php }?></span></span>
                <input type="hidden" name="driver_record_abstract" class="mee_att_3" value="<?php if(isset($mee_att['attach_doc']) && $mee_att['attach_doc']->driver_record_abstract){ echo $mee_att['attach_doc']->driver_record_abstract; }?>" />

            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-12">
                <label class="control-label col-md-4">Upload CVOR : </label>    
                <span><a href="javascript:void(0)" class="btn btn-primary" id="mee_att_4">Browse</a>&nbsp;<span class="uploaded"><?php if(isset($mee_att['attach_doc']) && $mee_att['attach_doc']->cvor){?><a class="dl" href="<?php echo $this->request->webroot;?>documents/download/<?php echo $mee_att['attach_doc']->cvor;?>"><?php echo $mee_att['attach_doc']->cvor;?></a><?php }?></span></span>
                <input type="hidden" name="cvor" class="mee_att_4" value="<?php if(isset($mee_att['attach_doc']) && $mee_att['attach_doc']->cvor){ echo $mee_att['attach_doc']->cvor; }?>" />
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-12">
                <label class="control-label col-md-4">Upload Resume : </label>    
                <span><a href="javascript:void(0)" class="btn btn-primary" id="mee_att_5">Browse</a>&nbsp;<span class="uploaded"><?php if(isset($mee_att['attach_doc']) && $mee_att['attach_doc']->resume){?><a class="dl" href="<?php echo $this->request->webroot;?>documents/download/<?php echo $mee_att['attach_doc']->resume;?>"><?php echo $mee_att['attach_doc']->resume;?></a><?php }?></span></span>
                <input type="hidden" name="resume" class="mee_att_5" value="<?php if(isset($mee_att['attach_doc']) && $mee_att['attach_doc']->resume){ echo $mee_att['attach_doc']->resume; }?>" />
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-12">
                <label class="control-label col-md-4">Upload Certifications : </label>    
                <span><a href="javascript:void(0)" class="btn btn-primary" id="mee_att_6">Browse</a>&nbsp;<span class="uploaded"><?php if(isset($mee_att['attach_doc']) && $mee_att['attach_doc']->certification){?><a class="dl" href="<?php echo $this->request->webroot;?>documents/download/<?php echo $mee_att['attach_doc']->certification;?>"><?php echo $mee_att['attach_doc']->certification;?></a><?php }?></span></span>
                <input type="hidden" name="certification" class="mee_att_6" value="<?php if(isset($mee_att['attach_doc']) && $mee_att['attach_doc']->certification){ echo $mee_att['attach_doc']->certification; }?>" />
            </div>
        </div>

        
        <div class="clearfix"></div>
    

</form>
<script>
$(function(){
   fileUpload('mee_att_1');
   fileUpload('mee_att_2');
   fileUpload('mee_att_3');
   fileUpload('mee_att_4');
   fileUpload('mee_att_5');
   fileUpload('mee_att_6'); 
});
</script>