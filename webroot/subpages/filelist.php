<?php
use Cake\ORM\TableRegistry;
if($this->request->session()->read('debug')){ echo "<BR><span style ='color:red;'>filelist.php #INC158</span>";}
$GLOBALS['webroot'] = $webroot= $this->request->webroot;

//other values PATHINFO_DIRNAME (/mnt/files) | PATHINFO_BASENAME (??????.mp3) | PATHINFO_FILENAME (??????)
function getextension($path, $value=PATHINFO_EXTENSION){
    return strtolower(pathinfo($path, $value));
}

function getattachments($OrderID){
    $all_attachments = TableRegistry::get('doc_attachments');
    return $all_attachments->find()->where(['order_id'=>$OrderID]);
}

function loadclient($ClientID, $table="clients"){
    $table = TableRegistry::get($table);
    $results = $table->find('all', array('conditions' => array('id'=>$ClientID)))->first();
    return $results;
}

function getdocumentinfo($ID, $isOrder = false){
    if ($isOrder) { $data = loadclient($ID, "orders" ); } else { $data = loadclient($ID, "documents" ); }
    if (is_object($data)) {
        $data->submitter = loadclient($data->user_id, "profiles");
        $data->reciever = loadclient($data->uploaded_for, "profiles");
        $data->client = loadclient($data->client_id);
        return $data;
    }
}

function PrintProfile($Description, $Profile, $webroot){
    echo '<TR><Th>' . $Description . '</Th>';
    if (is_object($Profile)) {
        echo '<TD width="1%" align="center">' . $Profile->id . '</TD><TD>';
        echo '<A class="nohide" HREF="' . $webroot . 'profiles/view/' . $Profile->id . '">';
        echo ucfirst($Profile->fname) . ' ' . ucfirst($Profile->lname) . ' (' . ucfirst($Profile->fname) . ')';
        echo '</A></TD></TR>';
    } else {
        echo '<TD colspan="2">Deleted or Missing Data</TD></TR>';
    }
}

function printdocumentinfo($ID, $isOrder = false, $linktoOrder = false){
    $data = getdocumentinfo($ID, $isOrder);
    $webroot=$GLOBALS['webroot'];//   profile: http://localhost/veritas3/profiles/view/[ID]   client:  http://localhost/veritas3/clients/edit/[ID]?view
    if (is_object($data)) {
        echo '<table class="table-condensed table-striped table-bordered table-hover dataTable no-footer"><TR><TH colspan="3">';
        if ($isOrder) {
            echo 'Order Information (ID: ' . $ID . ')';
            if ($linktoOrder) {
                echo '<a style="float:right;" href="' . $webroot . 'orders/vieworder/' . $data->client_id . '/' . $data->id ;
                echo '?order_type=' . $data->order_type;
                if ($data->forms) { echo '&forms=' . $data->forms; }
                echo '" class="nohide btn btn-xs btn-primary">View Order</a>';
            }
        } else {
            echo 'Document Information (ID: ' . $ID . ')';
        }

        echo '</TH></TR><TR><Th width="25%">Created on</Th><TD colspan="2">' . $data->created . '</TD></TR>';

        if ($isOrder) {echo '<TR><Th>Order Type</Th><TD COLSPAN="2">' . ucfirst($data->order_type) . '</TD></TR>';}

        PrintProfile('Submitted by', $data->submitter, $webroot);
        PrintProfile('Submitted for', $data->reciever, $webroot);

        echo '<TR><Th>Client</Th>';
        if (is_object($data->client)) {
            echo '<TD align="center">' . $data->client->id . '</TD><TD>' . ucfirst($data->client->company_name);
        } else {
            echo '<TD colspan="2">Deleted or Missing Data';
        }
        echo '</TD></TR>';
        echo '</table>';
        return $data;
    }
}

function printanattachment($Filename){
    if($Filename) {
        $ret = geticon($Filename);
        return "<i class='fa fa-" . $ret["icon"] . "'></i> " . $Filename;
    }
}

function geticon($extension){
    $ret = array();
    if(strpos($extension, ".")) { $extension = getextension($extension);}
    switch (TRUE) {//file-excel-o,,
        case $extension == 'jpg' || $extension == 'jpeg' || $extension == 'png' || $extension == 'bmp' || $extension == 'gif';
            $ret["type"] = "Image";
            $ret["icon"] = 'file-image-o';
            break;
        case $extension == "pdf";
            $ret["type"] = "Portable Document Format";
            $ret["icon"] = 'file-pdf-o';
            break;
        case $extension == 'zip' || $extension == 'rar';
            $ret["type"] = "File Archive";
            $ret["icon"] = 'file-archive-o';
            break;
        case $extension == 'wav' || $extension == 'mp3';
            $ret["type"] = "Audio Recording";
            $ret["icon"] = 'file-audio-o';
            break;
        case $extension == 'docx' || $extension == 'doc';
            $ret["type"] = "Microsoft Word Document";
            $ret["icon"] = 'file-word-o';
            break;
        case $extension == 'mp4' || $extension == 'avi';
            $ret["type"] = "Video";
            $ret["icon"] = 'file-video-o';
            break;
        case $extension == 'php' || $extension == 'js' || $extension == 'ctp';
            $ret["type"] = "Code Script";
            $ret["icon"] = 'file-code-o';
            break;
        case $extension == 'ppt' || $extension == 'pps';
            $ret["type"] = "Powerpoint Presentation";
            $ret["icon"] = 'file-powerpoint-o';
            break;
        default:
            $ret["type"] = "Unknown";
            $ret["icon"] = 'paperclip';
    }
    return $ret;
}

function listfiles($client_docs, $dir, $field_name='client_doc',$delete, $method=1){
    $webroot=$GLOBALS['webroot'] ;
    if($method==2) {
        echo '<div class="portlet box grey-salsa"><div class="portlet-title"><div class="caption"><i class="fa fa-paperclip"></i>Attachments</div>';
        echo '</div><div class="portlet-body form" align="left">';
        listfiles($client_docs, $dir, $field_name, $delete, 3);
        echo '</div></div>';
    } else if($method==3) {
        
        echo '<table class="table-condensed table-striped table-bordered table-hover dataTable no-footer">';
        $count = 0;
        foreach ($client_docs as $k => $cd) {
           
            $count += 1;
            if (isset($cd->attachment)) {
                $file = $cd->attachment;
            } else if (isset($cd->file)) {
                $file = $cd->file;
            }
                
            if ($file) {//id, client_id
                if ($count==1){ echo '<TR><TH colspan="5">Attachments</TH></TR>'; }
                $path = "/" . $dir . $file;
                $extension = getextension($file);
                $filename = getextension($file, PATHINFO_FILENAME);
                echo "<TR><TD width='29' align='center'><i class='fa fa-";
                $ret=geticon($extension);
                $type = $ret["type"];
                echo $ret["icon"];

                echo "' title='" . $type . "'></i></TD>";
                echo "<TD><A class='nohide' HREF='" . $webroot . $dir . $file . "'>" . $filename . "</A>
                <input type='hidden' value='".$file."' name='attach_doc[]' />
                </TD>";
                echo "<TD>" . date('Y-m-d H:i:s', filemtime(getcwd() . $path)) . "</TD>";
                switch (TRUE) {
                    case isset($cd->client_id):
                        echo "<TD>" . loadclient($cd->client_id)->company_name . "</TD>";
                        break;
                    case isset($cd->profile_id):
                        echo "<TD>" . loadclient($cd->profile_id, "profiles")->username . "</TD>";
                        break;
                }
                echo "<TD width='1%'>" . $extension . "</TD></TR>";
            }
        }
        echo '</table>';
    } else {//old layout ?>


        <div class="form-group col-md-12">
            <label class="control-label" id="attach_label">Attached Files: </label>

            <div class="row">
                <!-- <a href="#" class="btn btn-primary">Browse</a> -->
                <?php
                $count=0;
                //var_dump($client_docs);
                if (isset($client_docs) && count($client_docs) > 0) {
                    $allowed = array('jpg', 'jpeg', 'png', 'bmp', 'gif');
                    foreach ($client_docs as $k => $cd):
                        
                        $count+=1;
                        ?>
                        <div class="col-md-4" align="center">
                            <?php
                            if (isset($cd->attachment)) {
                                $file = $cd->attachment;
                            }//id, order_id, document_id, sub_id, attach_doc (null)
                            if (isset($cd->file)) {
                                $file = $cd->file;
                            }
                            $e = explode(".", $file);
                            $ext = end($e);
                            if (in_array($ext, $allowed)) {
                                ?>
                                <img src="<?php echo $webroot . $dir . $file; ?>" style="max-width: 200px;max-height: 200px;" title="<?php echo $cd->file;?>"/>

                            <?php
                            } else
                                echo "<a href='" .$webroot . $dir . $file."' target='_blank' class='uploaded'>".$file."</a>";
                                ?><BR><?php echo $file;?><BR>
                            <a href="<?php echo $webroot . $dir . $file ?>" download="<?= $file ?>" class="btn btn-info">Download</a>
							<span <?php if(($delete))echo "style='display:none;'";?>>
								<a href="javascript:void(0);" title="<?php echo $file?>&<?php echo $cd->id;?>" class="btn btn-danger img_delete">Delete</a>
                            </span>
                            <input type="hidden" name="<?php echo $field_name;?>[]" value="<?php echo $file;?>" class="moredocs"/>
                        </div>
                    <?php
                    endforeach;
                }
                if ($count==0){

                    ?>
                    <!--<div class="form-group col-md-12">

                        None
                    </div>-->

                <?


                }?>

            </div>
        </div>


    <?php } } ?>