<?php
    //var_dump($arrs);die();
    echo $msg;
    foreach($arrs as $arr){
    $forms = $arr['forms'];
    $driver = $arr['driver'];
    echo $orders = $arr['order_id'];
    
    $driv = explode(',',$driver);
    $ord = explode(',',$orders);
    for($k=0;$k<count($driv);$k++)
    {
       $ch = file_get_contents(LOGIN.'orders/webservice/BUL/'.$forms.'/'.$driv[$k].'/'.$ord[$k]);
    }
    }



    
?>
<script>

//$(function(){

    <?php /*foreach($arrs as $arr){?>
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
   <?php }*/?>

//})

</script>