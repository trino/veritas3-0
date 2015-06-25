<?php
 if($this->request->session()->read('debug'))
        echo "<span style ='color:red;'>survey.php #INC1180</span>";
 ?>
<div class="portlet box green-haze">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-briefcase"></i>Profile Crons (Survey)
        </div>
    </div>
    <div class="portlet-body">
    
        <div class="table-scrollable">
        
            <table
                class="table table-condensed  table-striped table-bordered table-hover dataTable no-footer">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Hired Date</th>
                    <th>Client</th>
                    <th>Profile</th>
                    <th>Survey</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody class="allct">
                <?php
                $today = date('Y-m-d');
                foreach($dates as $k=>$d) {
                    $thirty = date('Y-m-d', strtotime($d->hired_date.'+30 days'));
                    $sixty = date('Y-m-d', strtotime($d->hired_date.'+60 days'));
                    ?>
                    <tr>
                        <td><?php echo ++$k;?></td>
                        <td><?php echo $d->hired_date;?></td>
                        <td><?php echo $this->requestAction('/settings/getclient/26');?></td>
                        <td><?php if($d->hired_date < $today) {
                                        //echo "Cron Ran<br/>";
                                        if($d->automatic_sent== '1')
                                            echo "Sent for user:'";
                                        else
                                            echo "Pending for user:'";
                                        echo $d->username."'";
                                  } else {
                                        echo "User:'".$d->username."'";
                                  }?>
                        </td>
                        <td><?php if($d->profile_type == '9' || $d->profile_type == '12')
                                    echo "30 Day Survey";
                                  elseif($d->profile_type == '5' || $d->profile_type == '7'  || $d->profile_type == '8')
                                    echo "60 Day Survey";
                             ?>
                        </td>
                        <td><?php if($d->hired_date < $today)
                                  {
                                        echo "Cron Ran on ";
                                        if($d->profile_type == '9' || $d->profile_type == '12')
                                        echo $thirty;
                                    elseif($d->profile_type == '5' || $d->profile_type == '7'  || $d->profile_type == '8')
                                        echo $sixty;
                                  }
                                  else
                                  {
                                    echo "Cron Pending Scheduled for ";
                                    if($d->profile_type == '9' || $d->profile_type == '12')
                                        echo $type =$thirty;
                                    elseif($d->profile_type == '5' || $d->profile_type == '7'  || $d->profile_type == '8')
                                        echo $type =$sixty;
                                        ?>
                                        <a href="javascript:void(0);" class="send_now btn btn-primary" title="<?php echo $type."_".$d->id;?>">Send Now</a>
                                        <?php
                                  }?></td>
                        
                      
                        
                    </tr>        
                <?php
                }
                ?>
        </tbody>
        </table>
        
    </div>
    </div>
</div>
<script>
$(function(){
    $('.send_now').click(function(){
        var tis = $(this);
        var title = $(this).attr('title');
        var t = title.split("_");
        $.ajax({
          url:"<?php echo $this->request->webroot;?>profiles/ajax_cron/"+t[0]+"/"+t[1],
          success:function(msg){
              if(msg=='1')
              {
                tis.text("Sent");
                tis.attr('disabled','disabled');
              }
          }  
        })
    })
})
</script>
