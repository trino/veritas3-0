Re-qualification will be applied to all profiles that are active.
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
        <td><i class="fa fa-refresh"></i> Enable Requalify?</td>
        <td><input type="checkbox" <?php if(isset($client)&& $client->requalify=='1')echo "checked";?> name="requalify" value="1"> Yes</td>
    </tr>

    <tr>
        <td>When would you like to run re-qualifications?</td>
        <td><input type="checkbox" <?php if(isset($client)&& $client->requalify_re=='1')echo "checked";?> name="requalify_re" value="1"> Anniversary Date (Hire of hire? - what if the recruiter doesn't click hired on the profile?)
            <br> - or - <br> Select a date:
            <input type="text" class="form-control date-picker" style="width:50%;" name="requalify_date" value="<?php  if(isset($client)&& $client->requalify_date!="")echo $client->requalify_date; else echo date('Y-m-d');?>">
        </td>
    </tr>

    <tr>
        <td>Re-qualify Frequency?</td>
        <td>
            
            <input type="radio" <?php if(isset($client)&& $client->requalify_frequency=='3')echo "checked";?> value="3" name="requalify_frequency"> 3 Months
            &nbsp;&nbsp;<input type="radio" <?php if(isset($client)&& $client->requalify_frequency=='6')echo "checked";?> value="6" name="requalify_frequency"> 6 Months
            &nbsp;&nbsp;<input type="radio" <?php if(isset($client)&& $client->requalify_frequency=='12')echo "checked";?> value="12" name="requalify_frequency"> 12 Months


        </td>
    </tr>

    <tr>
        <td>Products Included</td>
        <td>
        <?php $r = explode(',',$client->requalify_product); ?>
            <input type="checkbox" <?php if(in_array('1',$r))echo "checked";?> name="requalify_product[]" value="1"> Driver's Record Abstract (MVR) #1
            &nbsp;&nbsp;<input type="checkbox" <?php if(in_array('2',$r))echo "checked";?> name="requalify_product[]" value="2"> CVOR #14
            &nbsp;&nbsp;<input type="checkbox" <?php if(in_array('3',$r))echo "checked";?>name="requalify_product[]" value="3"> Check DL #72
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