<?php
$i=0;
foreach($contacts as $r)
{
//echo $r->username;continue;
if($i%2==0)
{
	?>
	<tr>
	<?php
}
?>

<td>
	<span><input class="contact_client" onchange="if($(this).is(':checked')){assignContact($(this).val(),'<?php echo $cid;?>','yes');}else{assignContact($(this).val(),'<?php echo $cid;?>','no');}" type="checkbox" <?php if(in_array($r->id,$contact)){?>checked="checked"<?php }?> value="<?php echo $r->id; ?>"/></span>
	<span> <?php echo $r->username; ?> </span>
</td>
<?php

if(($i+1)%2==0)
{
?>
</tr>
<?php
}

$i++;
}
if(($i+1)%2!=0)
{
echo "</td></tr>";
}
?>
<script>


function assignProfile(profile,client,status)
{
if(status=='yes')
{
var url= '<?php echo $this->request->webroot;?>clients/assignProfile/'+profile+'/'+client+'/yes';
}
else
{
var url= '<?php echo $this->request->webroot;?>clients/assignProfile/'+profile+'/'+client+'/no';
}
$.ajax({url:url});
}
function assignContact(profile,client,status)
{
if(status=='yes')
{
var url= '<?php echo $this->request->webroot;?>clients/assignContact/'+profile+'/'+client+'/yes';
}
else
{
var url= '<?php echo $this->request->webroot;?>clients/assignContact/'+profile+'/'+client+'/no';
}
$.ajax({url:url});
}


</script>