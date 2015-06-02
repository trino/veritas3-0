<?php if($this->request->session()->read('debug')) {
    echo "<span style ='color:red;'>subpages/clients/requalify.php #INC???</span><BR>";
}
echo $strings["clients_requalifynotice"];
?>
<form action="" method="post" class="requalify_form">
<input type="hidden" name="id" value="<?php echo $client->id; ?>" />
<table class="table table-condensed  table-striped table-bordered table-hover dataTable no-footer" id="myTable">
    <!--thead>
    <tr>
        <th>ID</th>
        <th>Product</th>

    </tr>
    </thead>
    <tbody-->
    <tr>
        <td><i class="fa fa-refresh"></i> <?= $strings["clients_enablerequalify"]; ?></td>
        <td><input type="checkbox" <?php if(isset($client)&& $client->requalify=='1')echo "checked";?> name="requalify" value="1"> <?= $strings["dashboard_affirmative"]; ?></td>
    </tr>

    <tr>
        <td><?= $strings["clients_requalifywhen"] ?></td>
        <td><input type="radio" <?php if(isset($client)&& $client->requalify_re=='1')echo "checked";?> name="requalify_re" value="1" onclick="$('.r_date').hide();"/> <?= $strings["clients_anniversary"]; ?>
            <br><?= $strings["clients_or"]; ?><br> <input type="radio" <?php if(isset($client)&& $client->requalify_re=='0')echo "checked";?> name="requalify_re" value="0" onclick="$('.r_date').show();"><?= $strings["clients_selectadate"]; ?>
            <input type="text" class="form-control date-picker r_date" style="width:50%;<?php echo (isset($client)&& $client->requalify_re==1)?"display:none":"display:block";?>;" name="requalify_date" value="<?php  if(isset($client)&& $client->requalify_date!="")echo $client->requalify_date; else echo date('Y-m-d');?>">
        </td>
    </tr>

    <tr>
        <td>Re-qualify Frequency?</td>
        <td>
            <input type="radio" <?php if(isset($client)&& $client->requalify_frequency=='1')echo "checked";?> value="1" name="requalify_frequency"> 1 Month
            &nbsp;&nbsp;<input type="radio" <?php if(isset($client)&& $client->requalify_frequency=='3')echo "checked";?> value="3" name="requalify_frequency"> 3 Months
            &nbsp;&nbsp;<input type="radio" <?php if(isset($client)&& $client->requalify_frequency=='6')echo "checked";?> value="6" name="requalify_frequency"> 6 Months
            &nbsp;&nbsp;<input type="radio" <?php if(isset($client)&& $client->requalify_frequency=='12')echo "checked";?> value="12" name="requalify_frequency"> 12 Months


        </td>
    </tr>

    <tr>
        <td>Products Included</td>
        <td>
        <?php
            function productname($products, $number, $language){
                $product = getIterator($products, "number", $number);
                $title = getFieldname("title", $language);
                $title = $product->$title;
                if ($language == "Debug"){ $title.= " [Trans]";}
                return $title . " #" . $number;
            }
            function printproducts($r, $products, $numbers, $language){
                $hasprinted=false;
                foreach($numbers as $number){
                    if($hasprinted) { echo "&nbsp;&nbsp;"; }
                    echo '<input type="checkbox" id="p' . $number . '"';
                    if(in_array($number,$r)) {echo " checked";}
                    echo ' name="requalify_product[]" value="' . $number . '">';
                    echo '<label for="p' . $number . '">' . productname($products, $number, $language) . "</label>";
                    $hasprinted=true;
                }
            }

            $r = explode(',',$client->requalify_product);
            printproducts($r, $products, array(1, 14, 72), $language);
            ?>
        </td>
    </tr>
    
</table>
 <div class="form-actions">
    <button  type="button" class="btn btn-primary requalify_submit" >
        Submit <i class="m-icon-swapright m-icon-white"></i>
    </a>
 </div>
 <div class="margin-top-10 alert alert-success display-hide requalify_flash"  style="display: none;">
    <button class="close" data-close="alert"></button>
    Data saved successfully
</div>
<div class="clearfix"></div>
</form>
<div class="col-md-12">
    <table  class="table table-condensed  table-striped table-bordered table-hover dataTable no-footer">
        <tr>
            <td>Driver (Username)</td>
            <td>Hired Date</td>
            <td>Enable Requalify?</td>
            <td>Cron Orders Placed</td>
        </tr>
        <?php 
            $profiles = $this->requestAction('/rapid/getcronProfiles/'.$client->profile_id);
            foreach($profiles as $p) {//this line is erroring out
        ?>
            <tr>
                <td><?php echo $p->username;?></td>
                <td><?php echo $p->hired_date;?></td>
                <td><?php echo ($p->requalify=='1')? $strings["dashboard_affirmative"]: $strings["dashboard_negative"];?></td>
                <td><?php $crons = $this->requestAction('/rapid/cron_client/'.$p->id."/".$client->id);
                           $show ='';
                           $cron = explode(",",$crons);
                           foreach($cron as $cr)
                           {
                            
                                $pr = explode('&',$cr);
                                $show .= $pr[0]." <a href='".$this->request->webroot."profiles/view/".$p->id."?getprofilescore=1' target='_blank'>" . $strings["dashboard_view"] . "</a>,";
                                
                           }
                           echo $show = substr($show,0,strlen($show)-1);
                ?></td>
            </tr>
            <?php    
            }
        ?>
    </table>
</div>
<div class="clearfix"></div>
<script>
$(function(){
    $('.requalify_submit').click(function(){
       
        var datas = $('.requalify_form').serialize();
        $.ajax({
            type:"post",
            data: datas,
            url:"<?php echo $this->request->webroot;?>clients/requalify/<?php echo $client->id;?>",
            success: function()
            {
                $('.requalify_flash').show();
            }
        });
        
    });
})

</script>