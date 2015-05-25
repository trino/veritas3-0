
<script>
$(function(){
    
    <?php  if(isset($profiles) &&$profiles!= ""){
      
        foreach($arrs as $arr){?>
    var forms = '<?php echo $arr['forms'];?>';
    var driver = '<?php echo $arr['driver'];?>';
    //var clients = '<?php echo $arr['client_id'];?>';
    var orders = '<?php echo $arr['order_id'];?>';
    var driv = driver.split(',');
    var ord = orders.split(',');
    //var c = clients.split(',');
    //for(var i = 0; i<c.length;i++)
    for(var k=0;k<driv.length;k++)
    {
        //check = k;
        $.ajax({
            url:'<?php echo $this->request->webroot;?>orders/webservice/BUL/'+forms+'/'+driv[k]+'/'+ord[k],

        });
    }
   <?php }
   }?>
   
})

</script>
<?php
    if(isset($profiles) && $profiles!="")
        echo $msg."<br/>";
    else
        echo "No profile found on this day(".date('Y-m-d').")";
   
 
?>