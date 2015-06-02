<?php
 if($this->request->session()->read('debug'))
        echo "<span style ='color:red;'>requalify.php #INC1181</span>";
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
                    <th>Date</th>
                    <th>Client</th>
                    <th>Requalifed Profile</th>
                    
                    
                </tr>
                </thead>
                <tbody class="allct">
                <?php
                $today = date('Y-m-d');
                foreach($requalify as $k=>$d)
                {
                   
                    ?>
                    <tr>
                        <td><?php echo ++$k;?></td>
                        <td><?php echo $d->cron_date;?></td>
                        <td><?php echo $this->requestAction('/settings/getclient/'.$d->client_id);?></td>
                        <td><?php echo $this->requestAction('/settings/getprofile/'.$d->profile_id);?></td>
                        
                    </tr>        
                <?php
                }
                ?>
        </tbody>
        </table>
        
    </div>
    </div>
</div>