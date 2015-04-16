<?php if ($this->request->session()->read('debug')) {echo "<span style ='color:red;'>subpages/documents/mee_attach.php #INC203</span>";} ?>
<form id="form_tab15">
    <input type="hidden" class="document_type" name="document_type" value="<?php echo $dx->title;?>"/>
    <input type="hidden" name="sub_doc_id" value="15" class="sub_docs_id" id="af"/>

    <div class="clearfix"></div>

    <?php

    function alert($Text){
        echo "<SCRIPT>alert('" . $Text . "');</SCRIPT>";
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
    /*$controller = $this->request->params['controller'];
    $controller = strtolower($controller);

    include_once 'subpages/filelist.php';
    printdocumentinfo($did);
    if( isset($pre_at)){  listfiles($pre_at['attach_doc'], "attachments/", "", false,3); }
    */
    //echo "</div>";

    function getattachment($mee_att, $name){
        if (isset($mee_att['attach_doc'])) {
            return $mee_att['attach_doc']->$name;
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
    $mand = "Optional";//isrequired($forms, $AttachmentName, $DriversProvince, $attachments = 0){
    if (count($attachment) > 0 || isrequired($forms, "id_piece", $DriverProvince, 0, True)) { $mand = "Mandatory"; }
    echo '<HR></div><div class="col-md-12"><strong>The following form(s) are ' . $mand . '</strong></div>';

//printdivrequired needs to know if their are attachments BEFORE hand
$morecount=0;
if (isset($mee_att['attach_doc']->id) && $mee_att['attach_doc']->id) {
    //echo $mee_att['attach_doc']->id;
    $mee_more = $meedocs->find()->where(['mee_id' => $mee_att['attach_doc']->id]);
    if ($mee_more) {$morecount= iterator_count($mee_more);}
}

    $docsprinted=0;
    if (printdivrequired($action, $forms, "attachments", $DriverProvince, $morecount + count($attachment))) {
        $doit = false;
        $description = 'Upload BC, QU, SA Abstract Consent Form PDF';
        $docsprinted+=1;
        echo '</DIV>';
        if ($action == "View" || $action == "Vieworder") {
            if (count($attachment) > 0) {
                $description = "";
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
                echo '<label class="control-label col-md-4">Please download, fill out, and upload these forms (Required): </label><div class="col-md-8">';
                foreach ($attachment as $name => $file) {//C:\wamp\www\veritas3-0\webroot\ http://localhost/veritas3-0/webroot/img/certificates/certificate71-1.pdf
                    echo '<A class="btn btn-info" DOWNLOAD="' . $name . '.pdf" HREF="' . $this->request->webroot . 'webroot/img/pdfs/' . $file . '">';
                    echo '<i class="fa fa-floppy-o"></i> ' . $name . ' </A> ';
                }
                echo "</DIV></DIV></DIV>";
            }
        }
        echo "<DIV>";

        if ($doit) {
            echo "<div class='form-group row'>";
        } else {
            echo "<div>";
        }
        echo '<div class="col-md-12">';
        if ($doit && (count($attachment) > 0) || $morecount>0) {
            echo '<div class="col-md-4" align="right">' . $description . ': </div>';
        }
        echo '<div class="col-md-8 mee_more">';

        if (!$morecount ) {
            if(count($attachment) > 0) {
                ?>

                <span><a style="margin-bottom:5px;" href="javascript:void(0)" class="btn btn-primary additional"
                         id="mee_att_7">Browse</a>&nbsp;<span class="uploaded"></span></span>
                <input type="hidden" name="mee_attachments[]" class="mee_att_7"/><FONT COLOR="RED"> * Required</FONT>
            <?php
            }
            //echo  printrequired($action, $forms, "attachments", $DriverProvince, count($attachment)) . "<br />";
        } else {
            $id_count = 6;
            $directory = "attachments/";//"documents/download/"; //the download page crashes chrome!
            foreach ($mee_more as $mm) {//what is this code?
                $id_count++;
                if (file_exists(realpath("attachments/" . $mm->attachments))) {//fixes ghost file issue
                //rapid switching between PHP and HTML mode should not be used ?>
                       <div>
                                        <span><a style="margin-bottom:5px;" href="javascript:void(0)" class="btn btn-primary additional"
                                                 id="mee_att_<?php echo $id_count; ?>">Browse</a>&nbsp;<a style="margin-bottom:5px;"
                                                                                                          class="btn btn-danger"
                                                                                                          href="javascript:void(0);"
                                                                                                          onclick="$(this).parent().parent().remove();">Remove</a> <span
                                                class="uploaded"><?php if (isset($mm->attachments) && $mm->attachments) { ?><a
                                                    class="dl"
                                                    href="<?php echo $this->request->webroot . $directory . $mm->attachments; ?>">
                                                    <?php echo $mm->attachments; ?></a><?php } ?></span></span>
                           <input type="hidden" name="mee_attachments[]" class="mee_att_<?php echo $id_count; ?>"
                                  value="<?php if (isset($mm->attachments) && $mm->attachments) {
                                      echo $mm->attachments;
                                  } ?>"/>
                           <?php //echo printrequired($action, $forms, "attachments", $DriverProvince, count($attachment)) . "<br />";
                           echo "</div>";
                           }
                    }
        }
        ?>
                </div>
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
            <div class="col-md-12">
                <div class="col-md-4" align="right"> Upload 2 pieces of ID: </div>
                <div class="col-md-8">
                    <span><a href="javascript:void(0)" class="btn btn-primary" id="mee_att_1">Browse</a>
                    &nbsp;<span class="uploaded">

                    <?php if (isset($mee_att['attach_doc']) && $mee_att['attach_doc']->id_piece1) { ?>
        <a class="dl"
           href="<?php echo $this->request->webroot; ?>documents/download/<?php echo $mee_att['attach_doc']->id_piece1; ?>"><?php echo $mee_att['attach_doc']->id_piece1; ?></a><?php } ?></span>


               </span>
               <span><a href="javascript:void(0)" class="btn btn-primary" id="mee_att_2">Browse</a>&nbsp;<span class="uploaded"><?php if (isset($mee_att['attach_doc']) && $mee_att['attach_doc']->id_piece1) { ?>
        <a class="dl"
           href="<?php echo $this->request->webroot; ?>documents/download/<?php echo $mee_att['attach_doc']->id_piece2; ?>"><?php echo $mee_att['attach_doc']->id_piece2; ?></a><?php } ?></span>
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
           href="<?php echo $this->request->webroot; ?>documents/download/<?php echo $mee_att['attach_doc']->driver_record_abstract; ?>"><?php echo $mee_att['attach_doc']->driver_record_abstract; ?></a><?php } ?></span></span>
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
           href="<?php echo $this->request->webroot; ?>documents/download/<?php echo $mee_att['attach_doc']->cvor; ?>"><?php echo $mee_att['attach_doc']->cvor; ?></a><?php } ?></span></span>
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
               href="<?php echo $this->request->webroot; ?>documents/download/<?php echo $mee_att['attach_doc']->resume; ?>"><?php echo $mee_att['attach_doc']->resume; ?></a><?php } ?></span></span>
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
               href="<?php echo $this->request->webroot; ?>documents/download/<?php echo $mee_att['attach_doc']->certification; ?>"><?php echo $mee_att['attach_doc']->certification; ?></a><?php } ?></span></span>
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

    <div class="clearfix"></div>


</form>




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
