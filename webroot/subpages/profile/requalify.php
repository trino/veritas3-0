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
                    <th>Scheduled Date</th>
                    <th>Client</th>
                    <th>Requalifed Profile</th>
                    <th>Status</th>
                    
                    
                </tr>
                </thead>
                <tbody class="allct">
                <?php
                $today = date('Y-m-d');
                $k=0;
                foreach($requalify as $k=>$d)
                {
                   
                    ?>
                    <tr>
                        <td><?php echo ++$k;?></td>
                        <td><?php echo $d->cron_date;?></td>
                        <td><?php echo $this->requestAction('/settings/getclient/'.$d->client_id);?></td>
                        <td><?php echo $this->requestAction('/settings/getprofile/'.$d->profile_id);?></td>
                        <td>Requalifed</td>
                    </tr>        
                <?php
                }
                foreach($new_req as $d)
                {   
                    $fname = explode(',',$d['forms']);
                    $new_form = "";
                    foreach($fname as $n)
                    {
                        if($n=='1')
                            $nam = 'MVR';
                        elseif($n=='14')
                            $nam = 'CVOR';
                        elseif($n=='72')
                            $nam = 'DL';
                        $new_form .=$nam.","; 
                        
                    }
                    ?>
                    <tr>
                        <td><?php echo ++$k;?></td>
                        <td><?php echo $d['cron_date'];?></td>
                        <td><?php echo $this->requestAction('/settings/getclient/'.$d['client_id']);?></td>
                        <td><a href="<?php echo $this->request->webroot;?>profiles/view/<?php echo $d['profile_id'];?>"><?php echo $this->requestAction('/settings/getprofile/'.$d['profile_id']);?></a></td>
                        <td><?php $status= $this->requestAction('/rapid/check_status/'.$d['cron_date'].'/'.$d['client_id'].'/'.$d['profile_id']); if($status=='0'){?>Scheduled for requalification (products:<?php echo $new_form;?>)   <a href="<?php echo $this->request->webroot."rapid/cron_user/".$d['cron_date']."/".$d['client_id']."/".$d['profile_id'];?>" class="btn btn-primary">Send Now</a><?php }else echo "Manually Requalifed";?></td>

                    </tr>        
                <?php
                    unset($new_form);
                }
                ?>
        </tbody>
        </table>
        
    </div>
    </div>
</div>
