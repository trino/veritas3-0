<?php
 if($_SERVER['SERVER_NAME'] =='localhost'){  echo "<span style ='color:red;'>subpages/documents/mee_attach.php #INC203</span>";}
 ?>
<form id="form_tab15">
<input type="hidden" class="document_type" name="document_type" value="MEE Attachments"/>
<input type="hidden" name="sub_doc_id" value="15" class="sub_docs_id" id="af" />
<div class="clearfix"></div>
<hr/>

        
            <?php
            $forms = explode(",", $_GET["forms"]);
            $attachment = array();//Files are in: C:\wamp\www\veritas3-0\webroot\img\pdfs
            if (in_array("1", $forms)){//                  Name         Filename
                if ($DriverProvince == "QC") { $attachment["Quebec"] = "1.QC.pdf";}
            }
            if (in_array("14", $forms)){
                if ($DriverProvince == "SK") {$attachment["Saskatchewan"] = "14.SK.pdf";}
                if ($DriverProvince == "BC") {$attachment["British Columbia"] = "14.BC.pdf";}
            }

            function printrequired($forms, $AttachmentName, $DriversProvince, $attachment=0, $message = "Required"){
                if (isrequired($forms, $AttachmentName, $DriversProvince, $attachment)){
                    return '<FONT COLOR="RED">* ' . $message . '</FONT>';
                }
            }
            function printdivrequired($forms, $AttachmentName, $DriversProvince, $attachment=0){
                    if (isrequired($forms, $AttachmentName, $DriversProvince, $attachment)) {
                        echo '<div class="form-group row">';
                        return true;
                    } else {
                       // echo '<div style="display: none;">';
                    }

            }
            function isrequired($forms, $AttachmentName, $DriversProvince, $attachments=0){
                //Attachment names are id_piece, driver_record_abstract, cvor, resume, certification, attachments
                if ($AttachmentName=="attachments" && $attachments>0) {return true; }
                $required = array("id_piece" => 1603, "driver_record_abstract" => 1, "cvor" => 14, "resume"=> 1627, "certification" => 1650);
                if (isset($required[$AttachmentName])) {
                    $requirements = $required[$AttachmentName];
                    if (is_array($requirements)){
                        foreach($requirements as $requirement){
                            if (in_array($requirement, $forms)){return true;}
                        }
                    } else {
                        return in_array($requirements, $forms);
                    }
                }
                return false;
            }

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

    <?php
   if (printdivrequired($forms, "id_piece", $DriverProvince)){ ?>
            <div class="col-md-12">
                <label class="control-label col-md-4">Upload 2 pieces of ID : </label>  
                <div class="col-md-8">              
                    <span><a href="javascript:void(0)" class="btn btn-primary" id="mee_att_1">Browse</a>&nbsp;<span class="uploaded"><?php if(isset($mee_att['attach_doc']) && $mee_att['attach_doc']->id_piece1){?><a class="dl" href="<?php echo $this->request->webroot;?>documents/download/<?php echo $mee_att['attach_doc']->id_piece1;?>"><?php echo $mee_att['attach_doc']->id_piece1;?></a><?php }?></span></span> <span><a href="javascript:void(0)" class="btn btn-primary" id="mee_att_2">Browse</a>&nbsp;<span class="uploaded"><?php if(isset($mee_att['attach_doc']) && $mee_att['attach_doc']->id_piece1){?><a class="dl" href="<?php echo $this->request->webroot;?>documents/download/<?php echo $mee_att['attach_doc']->id_piece2;?>"><?php echo $mee_att['attach_doc']->id_piece2;?></a><?php }?></span></span>
                    <input type="hidden" name="id_piece1" class="mee_att_1" value="<?php if(isset($mee_att['attach_doc']) && $mee_att['attach_doc']->id_piece1){ echo $mee_att['attach_doc']->id_piece1; }?>" />
                    <input type="hidden" name="id_piece2" class="mee_att_2" value="<?php if(isset($mee_att['attach_doc']) && $mee_att['attach_doc']->id_piece2){ echo $mee_att['attach_doc']->id_piece2; }?>" />
                    <?= printrequired($forms, "id_piece", $DriverProvince, 0, "At least 1 is required"); ?>
                </div>
            </div>
        </div>
        <script>
        $(function(){
           fileUpload('mee_att_1');
           fileUpload('mee_att_2'); 
        });
        </script>
    <?php }

    if (printdivrequired($forms, "driver_record_abstract", $DriverProvince)) { ?>
            <div class="col-md-12">
                <label class="control-label col-md-4">Upload Driver’s Record Abstract : </label>
                <div class="col-md-8">
                    <span><a href="javascript:void(0)" class="btn btn-primary" id="mee_att_3">Browse</a>&nbsp;<span class="uploaded"><?php if (isset($mee_att['attach_doc']) && $mee_att['attach_doc']->driver_record_abstract) { ?>
        <a class="dl"
           href="<?php echo $this->request->webroot; ?>documents/download/<?php echo $mee_att['attach_doc']->driver_record_abstract; ?>"><?php echo $mee_att['attach_doc']->driver_record_abstract; ?></a><?php }?></span></span>
                    <input type="hidden" name="driver_record_abstract" class="mee_att_3" value="<?php if (isset($mee_att['attach_doc']) && $mee_att['attach_doc']->driver_record_abstract) {
        echo $mee_att['attach_doc']->driver_record_abstract;
    }?>" />
                    <?= printrequired($forms, "driver_record_abstract", $DriverProvince); ?>
                </div>
            </div>
        </div>
        <script>
        $(function(){
           fileUpload('mee_att_3');
           //fileUpload('mee_att_2'); 
        });
        </script>
    <?php
    }
    if(printdivrequired($forms, "cvor", $DriverProvince)) {?>
            <div class="col-md-12">
                <label class="control-label col-md-4">Upload CVOR : </label>
                <div class="col-md-8">
                    <span><a href="javascript:void(0)" class="btn btn-primary" id="mee_att_4">Browse</a>&nbsp;<span class="uploaded"><?php if(isset($mee_att['attach_doc']) && $mee_att['attach_doc']->cvor){?><a class="dl" href="<?php echo $this->request->webroot;?>documents/download/<?php echo $mee_att['attach_doc']->cvor;?>"><?php echo $mee_att['attach_doc']->cvor;?></a><?php }?></span></span>
                    <input type="hidden" name="cvor" class="mee_att_4" value="<?php if(isset($mee_att['attach_doc']) && $mee_att['attach_doc']->cvor){ echo $mee_att['attach_doc']->cvor; }?>" />
                    <?= printrequired($forms, "cvor", $DriverProvince); ?>
                </div>
            </div>
        </div>
        <script>
        $(function(){
           fileUpload('mee_att_4');
           //fileUpload('mee_att_2'); 
        });
        </script>
    <?php }

    if (printdivrequired($forms, "resume", $DriverProvince)){?>
            <div class="col-md-12">
                <label class="control-label col-md-4">Upload Resume : </label>
                <div class="col-md-8">
                    <span><a href="javascript:void(0)" class="btn btn-primary" id="mee_att_5">Browse</a>&nbsp;<span class="uploaded"><?php if(isset($mee_att['attach_doc']) && $mee_att['attach_doc']->resume){?><a class="dl" href="<?php echo $this->request->webroot;?>documents/download/<?php echo $mee_att['attach_doc']->resume;?>"><?php echo $mee_att['attach_doc']->resume;?></a><?php }?></span></span>
                    <input type="hidden" name="resume" class="mee_att_5" value="<?php if(isset($mee_att['attach_doc']) && $mee_att['attach_doc']->resume){ echo $mee_att['attach_doc']->resume; }?>" />
                    <?= printrequired($forms, "resume", $DriverProvince); ?>
                </div>
            </div>
        </div>
        <script>
        $(function(){
           fileUpload('mee_att_5');
           //fileUpload('mee_att_2'); 
        });
        </script>
    <?php }

    if (printdivrequired($forms, "certification", $DriverProvince)){?>
            <div class="col-md-12">
                <label class="control-label col-md-4">Upload Certifications : </label>
                <div class="col-md-8">
                    <span><a href="javascript:void(0)" class="btn btn-primary" id="mee_att_6">Browse</a>&nbsp;<span class="uploaded"><?php if(isset($mee_att['attach_doc']) && $mee_att['attach_doc']->certification){?><a class="dl" href="<?php echo $this->request->webroot;?>documents/download/<?php echo $mee_att['attach_doc']->certification;?>"><?php echo $mee_att['attach_doc']->certification;?></a><?php }?></span></span>
                    <input type="hidden" name="certification" class="mee_att_6" value="<?php if(isset($mee_att['attach_doc']) && $mee_att['attach_doc']->certification){ echo $mee_att['attach_doc']->certification; }?>" />
                    <?= printrequired($forms, "certification", $DriverProvince); ?>
                </div>
            </div>
        </div>
        <script>
        $(function(){
           fileUpload('mee_att_6');
           //fileUpload('mee_att_2'); 
        });
        </script>
    <?php }

    if  (printdivrequired($forms, "attachments", $DriverProvince, count($attachment))){
            echo '</DIV><HR><div class="form-group row"><div class="col-md-12">';
            echo '<label class="control-label col-md-4">Please download, fill out, and upload these forms : </label><div class="col-md-8">';
            foreach($attachment as $name => $file){//C:\wamp\www\veritas3-0\webroot\ http://localhost/veritas3-0/webroot/img/certificates/certificate71-1.pdf
                echo '<A class="btn btn-info" DOWNLOAD="' . $name . '.pdf" HREF="' . $this->request->webroot . 'webroot/img/pdfs/' . $file . '">';
                echo '<i class="fa fa-floppy-o"></i> ' . $name . ' </A> ';
            }
            echo "<FONT COLOR='red'> * Required</FONT></DIV></DIV></DIV><DIV>";
        ?>
        <div class="form-group row">
            <div class="col-md-12">
                <label class="control-label col-md-4">Upload Forms : </label>
                <div class="col-md-8 mee_more">
                <?php
                $morecount = 0;
                if($did)
                {
                        if(isset($mee_att['attach_doc']->id) && $mee_att['attach_doc']->id){
                            //echo $mee_att['attach_doc']->id;
                        $mee_more = $meedocs->find()->where(['mee_id'=>$mee_att['attach_doc']->id]);
                        if($mee_more)
                        foreach($mee_more as $mm)
                        {
                            $morecount++;
                        }}

                }
                if(!$morecount)
                {

                    ?>

                    <span><a style="margin-bottom:5px;" href="javascript:void(0)" class="btn btn-primary additional" id="mee_att_7">Browse</a>&nbsp;<span class="uploaded"></span></span>
                            <input type="hidden" name="mee_attachments[]" class="mee_att_7" />
                 <?php
                    echo  printrequired($forms, "attachments", $DriverProvince, count($attachment)) . "<br />";
                }
                else
                {
                    $id_count = 6;
                    foreach($mee_more as $mm)
                        {
                            $id_count++;
                           ?>
                            <div>
                            <span><a style="margin-bottom:5px;" href="javascript:void(0)" class="btn btn-primary additional" id="mee_att_<?php echo $id_count;?>">Browse</a>&nbsp;<a style="margin-bottom:5px;" class="btn btn-danger" href="javascript:void(0);" onclick="$(this).parent().parent().remove();">Remove</a> <span class="uploaded"><?php if(isset($mm->attachments) && $mm->attachments){?><a class="dl" href="<?php echo $this->request->webroot;?>documents/download/<?php echo $mm->attachments;?>"><?php echo $mm->attachments;?></a><?php }?></span></span>
                            <input type="hidden" name="mee_attachments[]" class="mee_att_<?php echo $id_count;?>" value="<?php if(isset($mm->attachments) && $mm->attachments){ echo $mm->attachments; }?>" />
                                <?= printrequired($forms, "attachments", $DriverProvince, count($attachment)) . "<br />"; ?>
                            </div>
                         <?php
                        }
                }
                ?>
                </div>
                <div class="clearfix"></div>
                <p>&nbsp;</p>
                <div class="col-md-4">&nbsp;</div><div class="col-md-8"><a href="javascript:void(0);" id="mee_att_more" class="btn btn-success">Add More</a></div>
            </div>
        </div>
        </div>
        <script>
        $(function(){
            var last_id = 7;
               $('.mee_more .additional').each(function(){
                var id = $(this).attr('id');
                fileUpload(id);
                id = id.replace('mee_att_','');
                last_id = parseFloat(id);
               }); 
               $('#mee_att_more').click(function(){
                last_id++;
                var strings = '<div><span><a style="margin-bottom:5px;" href="javascript:void(0)" class="btn btn-primary additional" id="mee_att_'+last_id+'">Browse</a>&nbsp;<a style="margin-bottom:5px;" class="btn btn-danger" href="javascript:void(0);" onclick="$(this).parent().parent().remove();">Remove</a> <span class="uploaded"></span></span>'+
                                        '<input type="hidden" name="mee_attachments[]" class="mee_att_'+last_id+'" /></div>';
                                        
                    $('.mee_more').append(strings);
                        fileUpload('mee_att_'+last_id);
                    
               });
        })
        </script>
    <?php } ?>
        
        <div class="clearfix"></div>
    

</form>
<script>
$(function(){
   
    /*if( $('.mee_att_1').length ){fileUpload('mee_att_1');}
    if( $('.mee_att_2').length ){fileUpload('mee_att_2');}
    if( $('.mee_att_3').length ){fileUpload('mee_att_3');}
    if( $('.mee_att_4').length ){fileUpload('mee_att_4');}
    if( $('.mee_att_5').length ){fileUpload('mee_att_5');}
    if( $('.mee_att_6').length ){fileUpload('mee_att_6');}
    fileUpload('mee_att_1');
    fileUpload('mee_att_2');
    fileUpload('mee_att_4');
    fileUpload('mee_att_3');
    fileUpload('mee_att_5');
    fileUpload('mee_att_6');*/
    
    

});
</script>