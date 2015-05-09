<?php if ($this->request->session()->read('debug')) {echo "<span style ='color:red;'>subpages/documents/mee_attach.php #INC203</span>";} ?>
<form id="form_tab15">
    <input type="hidden" class="document_type" name="document_type" value="<?php echo $dx->title;?>"/>
    <input type="hidden" name="sub_doc_id" value="15" class="sub_docs_id" id="af"/>

    <div class="clearfix"></div>

    <?php

        $skip=false;
        function alert($Text){
            echo "<SCRIPT>alert('" . $Text . "');</SCRIPT>";
        }

        if($action == "View" && $controller == "documents") {
            $data = getdocumentinfo($did);
            $DriverProvince =$data->reciever->driver_province;
        }

        function makeBrowseButton($ID, $Display, $Remove = true, $text=""){
            if(!$Display){$Display=' style="display: none;"';} else{ $Display="";}
            echo '<div' . $Display . '><span><a style="margin-bottom:5px;" href="javascript:void(0)" class="btn btn-primary additional" id="mee_att_' . $ID . '">Browse</a>&nbsp';
            if ($Remove) { echo '<a style="margin-bottom:5px;" class="btn btn-danger" href="javascript:void(0);" onclick="$(this).parent().parent().remove();">Remove</a>';}        echo '<span class="uploaded"></span></span><input type="hidden" name="mee_attachments[]" class="mee_att_' . $ID . '" /> ' . $text . '</div>';
        }

        $action = ucfirst($param);
        if (!isset($mee_att)) {$mee_att = array();}
        if (!isset($forms)){$forms = "";}
        if(!isset($DriverProvince)){$DriverProvince = "";}
        if (isset($_GET["forms"])) {$forms = explode(",", $_GET["forms"]);}
        $attachment = array();//Files are in: C:\wamp\www\veritas3-0\webroot\img\pdfs
        if (is_array($forms)) {
            if (in_array("1", $forms)) {//                  Name         Filename
                if ($DriverProvince == "QC") {
                    $attachment["Quebec MVR Consent"] = "1.QC.pdf";
                }
            }
            if (in_array("14", $forms)) {
                if ($DriverProvince == "SK") {
                    $attachment["Saskatchewan Abstract Consent"] = "14.SK.pdf";
                }
                if ($DriverProvince == "BC") {
                    $attachment["British Columbia Abstract Consent"] = "14.BC.pdf";
                }
            }
        }

        function nodocs($docsprinted){
            if($docsprinted==0){
                echo '<div class="form-group row"><div class="col-md-12" align="center">No attachments</div></div>';
            }
        }

        function printrequired($action, $forms, $AttachmentName, $DriversProvince, $attachment = 0, $message = "Required"){
            if ($action != "View" && $action != "Vieworder" && isrequired($forms, $AttachmentName, $DriversProvince, $attachment)) {
                return '<FONT COLOR="RED">* ' . $message . '</FONT>';
            }
        }

        function printdivrequired($Action, $forms, $AttachmentName, $DriversProvince, $attachment = 0, $Force = false){
            $doit = true;
            //echo $attachment . "ATTACH";
            if (!$Force) {
                if ($Action == "View" || $Action == "Vieworder") {
                    if (is_array($attachment)) {
                        $doit = true;
                    } elseif (is_numeric($attachment)) {
                        $doit = $attachment > 0;
                    } else {
                        if (!$attachment) {
                            $doit = false;
                        }
                    }
                }
            }
            if ($doit) { //isrequired($forms, $AttachmentName, $DriversProvince, $attachment)) {
                echo '<div class="form-group row">';
                return true;
            } else {
                //echo '<div style="display: none;">';
            }
            return $doit;
        }

        function isrequired($forms, $AttachmentName, $DriversProvince, $attachments = 0, $Force = false){
            //Attachment names are id_piece, driver_record_abstract, cvor, resume, certification, attachments
            if ($AttachmentName == "attachments" && $attachments > 0 || $Force) {
                return true;
            }
            $required = array("id_piece" => 1603);//, "driver_record_abstract" => 1, "cvor" => 14, "resume"=> 1627, "certification" => 1650);
            if (isset($required[$AttachmentName])) {
                $requirements = $required[$AttachmentName];
                if (is_array($requirements)) {
                    foreach ($requirements as $requirement) {
                        if (in_array($requirement, $forms)) {
                            return true;
                        }
                    }
                } elseif (is_array($forms)) {
                    return in_array($requirements, $forms);
                }
            }
            return false;
        }

        $controller = $this->request->params['controller'];
        $controller = strtolower($controller);
        include_once 'subpages/filelist.php';

        /*$controller = $this->request->params['controller'];
        $controller = strtolower($controller);


        printdocumentinfo($did);
        if( isset($pre_at)){  listfiles($pre_at['attach_doc'], "attachments/", "", false,3); }
        */
        //echo "</div>";

        function getattachment($mee_att, $name){
            if (isset($mee_att['attach_doc'])) {
                return $mee_att['attach_doc']->$name;
            }
        }

        function countfiles($mee_more){
            $files=0;
            foreach($mee_more as $key => $file) {//id, mee_id, attachments
                $realpath = getcwd() . "/attachments/" . $file->attachments;
                if (file_exists($realpath)) { $files++;}
            }
            return $files;
        }

        function printfile($webroot, $cc, $file, $skip=false){
            $path = $webroot . "attachments/" . $file->attachments;
            $realpath = getcwd() . "/attachments/" . $file->attachments;
            if (file_exists($realpath)) {//do not remove this check!
                if($skip){
                    $skip=false;
                } else {
                    ?>
                    <div>
                                    <span><a style="margin-bottom:5px;" href="javascript:void(0)"
                                             class="btn btn-primary additional" id="mee_att_<?php echo $cc;?>">Browse</a>&nbsp;
                                          <a style="margin-bottom:5px;" class="btn btn-danger" href="javascript:void(0);"
                                             onclick="$(this).parent().parent().remove();">Remove</a>
                                          <span class="uploaded nohide">
                                                <a class="dl nohide"
                                                   href="<?php echo $path?>"><?php echo printanattachment($file->attachments) ;?></a>
                                          </span>
                                    </span>
                        <input type="hidden" value="<?php echo $file->attachments;?>" name="mee_attachments[]"
                               class="mee_att_<?php echo $cc;?>"/>
                    </div>
                <?php
                }
                return true;
            }
        }
        //    if ($action != "View" && $action != "Vieworder") {

    ?>
    <div class="col-md-12">
        <hr/>

        <strong>Please upload the appropriate document or item to the associated field below. </strong><br><br>
        <ul>
            <li>Note that two pieces of Identification will be mandatory for any order including a Premium Criminal Record Check.</li>
            <li>British Columbia, Quebec and Saskatchewan require specific consent for Driver’s Record Abstracts and CVOR’s to be obtained. Please download the form found below and upload the signed consent in the proper field displayed below.</li>
            <li>ISB Canada is unable to obtain <strong>Alberta</strong> Driver’s Record Abstracts and CVOR’s. Please upload driver provided documentation for <strong>Alberta or any other province (optional)</strong> if you wish to include these products in the driver’s Score Card.</li>
            <li>We will contact you if a requested product has further requirements.</li>
        </ul>

        <?php
            $id_count = 7;
            $mand = "Optional";//isrequired($forms, $AttachmentName, $DriversProvince, $attachments = 0){
            if (count($attachment) > 0 || isrequired($forms, "id_piece", $DriverProvince, 0, True)) { $mand = "Mandatory"; }
            echo '<HR></div><div class="col-md-12"><strong>The following form(s) are ' . $mand . '</strong></div>';

            //printdivrequired needs to know if there are attachments BEFORE hand
            $morecount=0;
            if (isset($mee_att['attach_doc']->id) && $mee_att['attach_doc']->id) {
                //echo $mee_att['attach_doc']->id;
                $mee_more = $meedocs->find()->where(['mee_id' => $mee_att['attach_doc']->id]);
                if ($mee_more) {$morecount= countfiles($mee_more);}
            }

            $docsprinted=0;
            if (printdivrequired($action, $forms, "attachments", $DriverProvince, count($attachment))) {
            $doit = false;
            $description = '<strong>Step 2: </strong>Upload Abstract Consent Form (Above)';
            $docsprinted+=1;
            echo '</DIV>';
            if ($action == "View" || $action == "Vieworder") {
                if (count($attachment) > 0 && $morecount>0) {
                    $description="";
                    foreach ($attachment as $name => $file) {
                        if (strlen($description)>0){$description.=", ";}
                        $description.= $name;
                    }
                    $doit=true;
                }
            } else {
                $doit = true;
                if (count($attachment) > 0) {
                    echo '<div class="form-group row"><div class="col-md-12">';
                    echo '<label class="control-label col-md-4" align="right"><strong>Step 1: </strong>Please download, fill out, and upload: </label><div class="col-md-8">';
                    foreach ($attachment as $name => $file) {//C:\wamp\www\veritas3-0\webroot\ http://localhost/veritas3-0/webroot/img/certificates/certificate71-1.pdf
                        echo '<A class="btn btn-info" DOWNLOAD="' . $name . '.pdf" HREF="' . $this->request->webroot . 'webroot/img/pdfs/' . $file . '">';
                        echo '<i class="fa fa-floppy-o"></i> ' . $name . ' </A> ';
                    }
                    echo "</DIV></DIV></DIV>";
                }
            }
            echo '<DIV>';

            if ($doit) {
                echo "<div class='form-group row'>";
            } else {
                echo "<div>";
            }
            echo '<div class="col-md-12">';
            if ($doit && (count($attachment) > 0) || $morecount>0) {
            echo '<div class="col-md-4" align="right">' . $description . ': </div>';
            echo '<div class="col-md-8 mee_more">';
            if($action=="View" || $action == "Vieworder" ){
                $skip=true;
                $morecount = $morecount-1;
                foreach($mee_more as $key => $file) {//id, mee_id, attachments
                    if(printfile($this->request->webroot, 8, $file)) {
                        break;
                    }
                }
            } else {
                makeBrowseButton(7, true, false, '<FONT COLOR="RED">* Required</FONT>');
            }
        ?>


    </div>
<?php } ?>
                <div class="clearfix"></div>
                <!--p>&nbsp;</p>
                <div class="col-md-4">&nbsp;</div><div class="col-md-8"><a href="javascript:void(0);" id="mee_att_more" class="btn btn-success">Add More</a></div-->
            </div>
        </div>

        </div>

    <?php }





?>


    <?php





        if (printdivrequired($action, $forms, "id_piece", $DriverProvince, getattachment($mee_att, "id_piece1") . getattachment($mee_att, "id_piece2"))) {
            $docsprinted+=1; ?>
            <div class="col-md-12" style="margin-top: 15px;">
                <div class="col-md-4" align="right">Upload 2 pieces of ID: </div>
                <div class="col-md-8">
                    <span><a href="javascript:void(0)" class="btn btn-primary" id="mee_att_1">Browse</a>
                    &nbsp;<span class="uploaded">

                    <?php
            if (isset($mee_att['attach_doc']) && $mee_att['attach_doc']->id_piece1) { ?>
                <a class="dl"
                   href="<?php echo $this->request->webroot; ?>documents/download/<?php echo $mee_att['attach_doc']->id_piece1; ?>"><?php echo printanattachment($mee_att['attach_doc']->id_piece1); ?></a><?php } ?></span>


               </span>
               <span><a href="javascript:void(0)" class="btn btn-primary" id="mee_att_2">Browse</a>&nbsp;<span class="uploaded"><?php if (isset($mee_att['attach_doc']) && $mee_att['attach_doc']->id_piece2) { ?>
                <a class="dl"
                   href="<?php echo $this->request->webroot; ?>documents/download/<?php echo $mee_att['attach_doc']->id_piece2; ?>"><?php echo printanattachment($mee_att['attach_doc']->id_piece2); ?></a><?php } ?></span>
               </span>

                    <input type="hidden" name="id_piece1" class="mee_att_1" value="<?php if (isset($mee_att['attach_doc']) && $mee_att['attach_doc']->id_piece1) {
                echo $mee_att['attach_doc']->id_piece1;
            } ?>" />
                    <input type="hidden" name="id_piece2" class="mee_att_2" value="<?php if (isset($mee_att['attach_doc']) && $mee_att['attach_doc']->id_piece2) {
                echo $mee_att['attach_doc']->id_piece2;
            } ?>" />
                    <?= printrequired($action, $forms, "id_piece", $DriverProvince, 0, "Required"); ?>
                </div>
            </div>
        </div>
        <script>
        $(function(){
           fileUpload('mee_att_1');
           fileUpload('mee_att_2');
        });
        </script>
    <?php
        }

        nodocs($docsprinted);
        if ($mand != "Optional") {
            echo '<div class="col-md-12"><hr></div><div class="col-md-12"><strong>The following form(s) are Optional</strong><br><br></div>';
        }

        $docsprinted=0;
        if (printdivrequired($action, $forms, "driver_record_abstract", $DriverProvince, getattachment($mee_att, "driver_record_abstract"))) {
            $docsprinted+=1;?>
            <div class="col-md-12">
                 <div class="col-md-4" align="right">Upload Driver's Record Abstract: </div>
                <div class="col-md-8">
                    <span><a href="javascript:void(0)" class="btn btn-primary" id="mee_att_3">Browse</a>&nbsp;<span class="uploaded"><?php if (isset($mee_att['attach_doc']) && $mee_att['attach_doc']->driver_record_abstract) { ?>
                <a class="dl"
                   href="<?php echo $this->request->webroot; ?>documents/download/<?php echo $mee_att['attach_doc']->driver_record_abstract; ?>"><?php echo  printanattachment($mee_att['attach_doc']->driver_record_abstract); ?></a><?php } ?></span></span>
                    <input type="hidden" name="driver_record_abstract" class="mee_att_3" value="<?php if (isset($mee_att['attach_doc']) && $mee_att['attach_doc']->driver_record_abstract) {
                echo $mee_att['attach_doc']->driver_record_abstract;
            } ?>" />
                    <?= printrequired($action, $forms, "driver_record_abstract", $DriverProvince); ?>
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
        if (printdivrequired($action, $forms, "cvor", $DriverProvince, getattachment($mee_att, 'cvor'))) {
            $docsprinted+=1;?>
            <div class="col-md-12">
            <div class="col-md-4" align="right">Upload CVOR:  </div>
                <!--label class="control-label col-md-4">Upload CVOR: </label-->
                <div class="col-md-8">
                    <span><a href="javascript:void(0)" class="btn btn-primary" id="mee_att_4">Browse</a>&nbsp;<span class="uploaded"><?php if (isset($mee_att['attach_doc']) && $mee_att['attach_doc']->cvor) { ?>
                <a class="dl"
                   href="<?php echo $this->request->webroot; ?>documents/download/<?php echo $mee_att['attach_doc']->cvor; ?>"><?php echo printanattachment($mee_att['attach_doc']->cvor); ?></a><?php } ?></span></span>
                    <input type="hidden" name="cvor" class="mee_att_4" value="<?php if (isset($mee_att['attach_doc']) && $mee_att['attach_doc']->cvor) {
                echo $mee_att['attach_doc']->cvor;
            } ?>" />
                    <?= printrequired($action, $forms, "cvor", $DriverProvince); ?>
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

        if (printdivrequired($action, $forms, "resume", $DriverProvince, getattachment($mee_att, 'resume'))) {
            $docsprinted+=1;
            ?>
            <div class="col-md-12">
            <div class="col-md-4" align="right">Upload Resume: </div>
                <div class="col-md-8">
                    <span><a href="javascript:void(0)" class="btn btn-primary" id="mee_att_5">Browse</a>&nbsp;<span class="uploaded"><?php if (isset($mee_att['attach_doc']) && $mee_att['attach_doc']->resume) { ?>
                <a class="dl"
                   href="<?php echo $this->request->webroot; ?>documents/download/<?php echo $mee_att['attach_doc']->resume; ?>"><?php echo printanattachment($mee_att['attach_doc']->resume); ?></a><?php } ?></span></span>
                    <input type="hidden" name="resume" class="mee_att_5" value="<?php if (isset($mee_att['attach_doc']) && $mee_att['attach_doc']->resume) {
                echo $mee_att['attach_doc']->resume;
            } ?>" />
                    <?= printrequired($action, $forms, "resume", $DriverProvince); ?>
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

        if (printdivrequired($action, $forms, "certification", $DriverProvince, getattachment($mee_att, 'certification'))) {
            $docsprinted+=1;
            ?>
            <div class="col-md-12">
            <div class="col-md-4" align="right">Upload Certifications: </div>
                <div class="col-md-8">
                    <span><a href="javascript:void(0)" class="btn btn-primary" id="mee_att_6">Browse</a>&nbsp;<span class="uploaded"><?php if (isset($mee_att['attach_doc']) && $mee_att['attach_doc']->certification) { ?>
                <a class="dl"
                   href="<?php echo $this->request->webroot; ?>documents/download/<?php echo $mee_att['attach_doc']->certification; ?>"><?php echo printanattachment($mee_att['attach_doc']->certification); ?></a><?php } ?></span></span>
                    <input type="hidden" name="certification" class="mee_att_6" value="<?php if (isset($mee_att['attach_doc']) && $mee_att['attach_doc']->certification) {
                echo $mee_att['attach_doc']->certification;
            } ?>" />
                    <?= printrequired($action, $forms, "certification", $DriverProvince); ?>
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
        nodocs($docsprinted);


    ?>
    <div class="form-group row">
        <div class="col-md-12">
            <div class="col-md-4" align="right"><?php if($morecount>0 || $action =="Addorder" ){ echo "Additional Attachment(s): ";} ?></div>
            <div class="col-md-8">
                <div class="mee_more">
                    <?php
                        $cc = 8;
                        if(isset($mee_more)) {
                            foreach($mee_more as $key => $file) {//id, mee_id, attachments
                                if( printfile($this->request->webroot, $cc, $file, $skip)){
                                    $skip=false;
                                }
                                $cc++;
                            }
                        }
                        //echo $cc;
                        if($cc==8) {
                            for($temp=8; $temp<18; $temp+=1){
                                makeBrowseButton($temp, $temp==8);
                            }
                        } else {
                            for ($h = $cc; $h<18; $h++) {
                                if ($h<>7){ ?>
                                    <div style="display: none;">
                            <span><a style="margin-bottom:5px;" href="javascript:void(0)" class="btn btn-primary additional"
                                     id="mee_att_<?php echo $h; ?>">Browse</a>&nbsp;<a style="margin-bottom:5px;"
                                                                                       class="btn btn-danger"
                                                                                       href="javascript:void(0);"
                                                                                       onclick="$(this).parent().parent().remove();">Remove</a> <span
                                    class="uploaded"></span></span>
                                        <input type="hidden" name="mee_attachments[]" class="mee_att_<?php echo $h; ?>"/>
                                    </div>
                                <?php
                                }
                            }
                        }
                    ?>

                </div>
                <a href="javascript:void(0)" class="btn btn-success" id="mee_att_more">Add More</a>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>


</form>




<script>
    $(function(){
        <?php
        $lastid = $cc;
        if($lastid!= 8){
            $lastid--;
        }
        ?>
        var last_id = <?php echo $lastid?>;
        $('.mee_more .additional').each(function(){
            var id = $(this).attr('id');
            fileUpload(id);
            id = id.replace('mee_att_','');
            //last_id = parseFloat(id);
        });
        $('#mee_att_more').click(function(){
            last_id++;
            if(last_id < 19)
            {
                $('.mee_att_'+last_id).parent().show();
            }
            else
            {
                var strings = '<div><span><a style="margin-bottom:5px;" href="javascript:void(0)" class="btn btn-primary additional" id="mee_att_'+last_id+'">Browse</a>&nbsp;<a style="margin-bottom:5px;" class="btn btn-danger" href="javascript:void(0);" onclick="$(this).parent().parent().remove();">Remove</a>&nbsp;<span class="uploaded"></span></span>'+
                    '<input type="hidden" name="mee_attachments[]" class="mee_att_'+last_id+'" /></div>';

                $('.mee_more').append(strings);
                fileUpload('mee_att_'+last_id);

            }


        });
    })
</script>



<script>
    $(function () {

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
