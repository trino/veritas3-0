<?php $settings = $this->requestAction('settings/get_settings'); ?>
<?php $sidebar =$this->requestAction("settings/get_side/".$this->Session->read('Profile.id'));?>


<?php
if ($sidebar->training == 1 && $sidebar->client_list == 0) {
header("Location: " . $this->request->webroot . "training");
die();
}?>



<script type="text/javascript" src="<?= $this->request->webroot;?>js/datetime.js"></script>
<body onLoad="ajaxpage('schedules/timezone');">

<h3 class="page-title">
    <?php echo $settings->mee;?> Dashboard <?php if($settings->mee == 'MEE'){ ?><small>Driver Qualification System</small><?php } ?>

    <!--img src="<?php echo $this->request->webroot; ?>img/logos/challenger_logoright.jpg" style="float:right;"/-->

</h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="<?php echo $this->request->webroot; ?>">Dashboard</a>

        </li>

    </ul>

    <!--a href="javascript:window.print();" class="floatright btn btn-info">Print</a-->
</div>


<div class="clearfix"></div>

<?php include('subpages/home_topblocks.php'); ?>
<div class="clearfix"></div>

<?php include('subpages/home_blocks.php'); ?>

<div class="clearfix"></div>

<?php
if(!$hideclient){
    $settings = $this->requestAction('settings/get_settings');
    $sidebar =$this->requestAction("settings/get_side/".$this->Session->read('Profile.id'));
    include('subpages/clients/listing.php');
}
echo '<div class="clearfix"></div>';
?>


<?php if($sidebar->recent ==1){?>
<?php include('subpages/recent_activities.php'); ?>
<div class="clearfix"></div>
<?php }?>



<style>
@media print {
    .page-header{display:none;}
    .page-footer,.nav-tabs,.page-title,.page-bar,.theme-panel,.page-sidebar-wrapper,.more{display:none!important;}
    .portlet-body,.portlet-title{border-top:1px solid #578EBE;}
    .tabbable-line{border:none!important;}
    }
</style>