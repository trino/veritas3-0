<?php
 if($this->request->session()->read('debug'))
        echo "<span style ='color:red;'>survey.php #INC1180</span>";
 ?>
<div class="portlet box green-haze">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-briefcase"></i>Profile Crons(Survey)
        </div>
    </div>
    <div class="portlet-body">
    
        <div class="table-scrollable">
        
            <table
                class="table table-condensed  table-striped table-bordered table-hover dataTable no-footer">
                <thead>
                <tr >
                    <th>Sn</th>
                    <th>Hired Date</th>
                    <th>Profile</th>
                    <th>Status</th>
                    
                </tr>
                </thead>
                <tbody class="allct">
                <?php
                $today = date('Y-m-d');
                foreach($dates as $k=>$d)
                {
                    $thirty = date('Y-m-d', strtotime($d->hired_date.'+30 days'));
                    $sixty = date('Y-m-d', strtotime($d->hired_date.'+60 days'));
                    ?>
                    <tr>
                        <td><?php echo ++$k;?></td>
                        <td><?php echo $d->hired_date;?></td>
                        <td><?php if($d->hired_date < $today)
                                  {
                                        //echo "Cron Ran<br/>";
                                        if($d->automatic_sent== '1')
                                            echo "Sent for user:'";
                                        else
                                            echo "Pending for user:'";
                                        echo $d->username."'";
                                  }
                                  else
                                  {
                                        echo "User:'".$d->username."'";
                                  }?>
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
                                        echo $thirty;
                                    elseif($d->profile_type == '5' || $d->profile_type == '7'  || $d->profile_type == '8')
                                        echo $sixty;
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
