<?php
$i=0;
$pType = $this->requestAction('/profiles/getProfileTypes');// ['','Admin','Recruiter','External','Safety','Driver','Contact'];

$mode = $profiles->mode;
switch ($mode){
    case 1://bulk order
        $sub = "addProfile";
        break;
}

foreach($profiles as $r) {
     $username = "[NO NAME]";
    if (strlen(trim($r->username)>0)) {
        $username = $r->username;
    } elseif(strlen(trim($r->fname . $r->lname))>0) {
        $username = $r->fname . " " . $r->lname;
    }
    $profiletype = "(" . $pType[$r->profile_type] . ")";
    if ($profiletype == "()") {$profiletype = "(Draft)"; }
//echo $r->username;continue;
//if($i%2==0)
//                                                    {
?>
<tr>
<?php
//}
?>

<td>
<span><input id="p_<?= $i ?>" class="profile_client" onchange="<?php
    if($mode==0) {
        echo "if($(this).is(':checked')){assignProfile($(this).val(),'" .  $cid . "','yes');}else{assignProfile($(this).val(),'" .  $cid . "','no');}";
    } else {
        echo $sub . "(" . $r->id . ")";
    }
        ?>" type="checkbox" <?php if($mode ==0 && in_array($r->id,$profile)){ echo 'checked="checked"'; }?> value="<?php echo $r->id; ?>"/></span>
<span><label for="p_<?= $i ?>"><?php echo $username; ?> <?php if($r->profile_type!=""){echo $profiletype;}?> </span></label>
<span class="msg_<?php echo $r->id; ?>"></span>
</td>
<?php

//if(($i+1)%2==0)
//                                                {
?>
</tr>
<?php
// }

$i++;
}
//if(($i+1)%2!=0)
//                                                {
//                                                    echo "</td></tr>";
//                                                }
?>

<script>
    function assignProfile(profile,client,status) {
        if(status=='yes') {
            var url= '<?php echo $this->request->webroot;?>clients/assignProfile/'+profile+'/'+client+'/yes';
        } else {
            var url= '<?php echo $this->request->webroot;?>clients/assignProfile/'+profile+'/'+client+'/no';
        }
        $.ajax({url:url});
    }

    function assignClient(profile,client,status) {
        if(status=='yes') {
            var url= '<?php echo $this->request->webroot;?>clients/assignClient/'+profile+'/'+client+'/yes';
        } else {
            var url= '<?php echo $this->request->webroot;?>clients/assignClient/'+profile+'/'+client+'/no';
        }
        $.ajax({url:url});
    }
</script>