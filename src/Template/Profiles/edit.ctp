<link href="<?php echo $this->request->webroot; ?>assets/admin/pages/css/profile.css" rel="stylesheet"
      type="text/css"/> <!--REQUIRED-->
<style>
    @media print {
        .page-header {
            display: none;
        }

        .page-footer, .nav-tabs, .page-title, .page-bar, .theme-panel, .page-sidebar-wrapper {
            display: none !important;
        }

        .portlet-body, .portlet-title {
            border-top: 1px solid #578EBE;
        }

        .tabbable-line {
            border: none !important;
        }

        #tab_1_4, #tab_1_7 {
            display: block !important;
        }

        #tab_1_4, #tab_1_7 {
            visibility: visible !important;
        }

        #tab_1_4 *, #tab_1_7 * {
            visibility: visible !important;
        }
    }

</style>


<?php
    if (isset($disabled)) {
        $is_disabled = 'disabled="disabled"';// style="border: 0px solid;"';
        //echo "<style>select {    -webkit-appearance: none;    -moz-appearance: none;    text-indent: 1px;    text-overflow: '';}</style>";
    } else {
        $is_disabled = '';
    }
    if (isset($profile))
        $p = $profile;
    $settings = $this->requestAction('settings/get_settings');
    $sidebar = $this->requestAction("settings/all_settings/" . $this->request->session()->read('Profile.id') . "/sidebar"); ?>

<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
<!-- BEGIN STYLE CUSTOMIZER -->
<div class="theme-panel hidden-xs hidden-sm">
    <?php if (strlen($is_disabled) == 0) {
        if($_SERVER['SERVER_NAME'] =='localhost')
        {

        echo '<div class="toggler"></div>';//doesn't work in view mode, so remove it and be done with it
    }} ?>
    <div class="toggler-close">
    </div>

    <div class="theme-options">
        <div class="theme-option theme-colors clearfix">
						<span>
						THEME COLOR </span>
            <ul>
                <li class="color-default <?php if ($settings->layout == 'default') echo "current"; ?> tooltips"
                    data-style="default" onclick="change_layout('default');" data-container="body"
                    data-original-title="Default">
                </li>
                <li class="color-darkblue tooltips <?php if ($settings->layout == 'darkblue') echo "current"; ?>"
                    data-style="darkblue" onclick="change_layout('darkblue');" data-container="body"
                    data-original-title="Dark Blue">
                </li>
                <li class="color-blue tooltips <?php if ($settings->layout == 'blue') echo "current"; ?>"
                    data-style="blue" onclick="change_layout('blue');" data-container="body" data-original-title="Blue">
                </li>
                <li class="color-grey tooltips <?php if ($settings->layout == 'grey') echo "current"; ?>"
                    data-style="grey" onclick="change_layout('grey');" data-container="body" data-original-title="Grey">
                </li>
                <li class="color-light tooltips <?php if ($settings->layout == 'light') echo "current"; ?>"
                    data-style="light" onclick="change_layout('light');" data-container="body"
                    data-original-title="Light">
                </li>
                <li class="color-light2 tooltips <?php if ($settings->layout == 'light2') echo "current"; ?>"
                    data-style="light2" onclick="change_layout('light2');" data-container="body" data-html="true"
                    data-original-title="Light 2">
                </li>
            </ul>
        </div>
        <div class="theme-option">
						<span>
						Theme Style </span>
            <select class="layout-style-option form-control input-sm">
                <option value="square" selected="selected">Square corners</option>
                <option value="rounded">Rounded corners</option>
            </select>
        </div>
        <div class="theme-option">
						<span>
						Layout </span>
            <select class="layout-option form-control input-sm" onchange="change_box();" id="boxed">
                <option value="fluid" selected="selected">Fluid</option>
                <option value="boxed">Boxed</option>
            </select>
        </div>
        <div class="theme-option">
						<span>
						Header </span>
            <select class="page-header-option form-control input-sm" onchange="change_body();">
                <option value="fixed" selected="selected">Fixed</option>
                <option value="default">Default</option>
            </select>
        </div>
        <div class="theme-option">
						<span>
						Top Menu Dropdown</span>
            <select class="page-header-top-dropdown-style-option form-control input-sm" onchange="change_body();">
                <option value="light" selected="selected">Light</option>
                <option value="dark">Dark</option>
            </select>
        </div>
        <div class="theme-option">
						<span>
						Sidebar Mode</span>
            <select class="sidebar-option form-control input-sm" onchange="change_body();">
                <option value="fixed">Fixed</option>
                <option value="default" selected="selected">Default</option>
            </select>
        </div>
        <div class="theme-option">
						<span>
						Sidebar Menu </span>
            <select class="sidebar-menu-option form-control input-sm" onchange="change_body();">
                <option value="accordion" selected="selected">Accordion</option>
                <option value="hover">Hover</option>
            </select>
        </div>
        <div class="theme-option">
						<span>
						Sidebar Style </span>
            <select class="sidebar-style-option form-control input-sm" onchange="change_body();">
                <option value="default" selected="selected">Default</option>
                <option value="light">Light</option>
            </select>
        </div>
        <div class="theme-option">
						<span>
						Sidebar Position </span>
            <select class="sidebar-pos-option form-control input-sm" onchange="change_body();">
                <option value="left" selected="selected">Left</option>
                <option value="right">Right</option>
            </select>
        </div>
        <div class="theme-option">
						<span>
						Footer </span>
            <select class="page-footer-option form-control input-sm" onchange="change_body();">
                <option value="fixed">Fixed</option>
                <option value="default" selected="selected">Default</option>
            </select>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<?php $param = $this->request->params['action'];
    switch ($param) {
        case 'add':
            $param2 = 'Create';
            break;
        case 'view':
            $param2 = 'View';
            break;
        case 'edit':
            $param2 = 'Edit';
            break;
    }

?>

<h3 class="page-title">
    <?php echo $param2 . ' ' . ucfirst($settings->profile); ?>
</h3>

<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="<?php echo $this->request->webroot; ?>">Dashboard</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href=""><?php echo $param2 . ' ' . ucfirst($settings->profile); ?></a>
        </li>
    </ul>

    <?php
        if (isset($disabled)) { ?>
            <a href="javascript:window.print();" class="floatright btn btn-info">Print</a>
        <?php } ?>
    <?php if (isset($profile) && $sidebar->profile_delete == '1') {
        if ($this->request->session()->read('Profile.super') == '1') {
            if ($this->request->session()->read('Profile.id') != $profile->id) {
                ?>

                <a href="<?php echo $this->request->webroot; ?>profiles/delete/<?php echo $profile->id; ?><?php echo (isset($_GET['draft'])) ? "?draft" : ""; ?>"
                   onclick="return confirm('Are you sure you want to delete <?= ucfirst(h($profile->username)) ?>?');"
                   class="floatright btn btn-danger btnspc">Delete</a>
                </span>
            <?php
            }
        } else if ($this->request->session()->read('Profile.profile_type') == '2' && ($profile->profile_type == '5')) {
            ?>
            <a href="<?php echo $this->request->webroot; ?>profiles/delete/<?php echo $profile->id; ?><?php echo (isset($_GET['draft'])) ? "?draft" : ""; ?>"
               onclick="return confirm('Are you sure you want to delete <?= ucfirst(h($profile->username)) ?>?');"
               class="floatright btn btn-danger btnspc">Delete</a>
        <?php
        }

    }
    ?>
    <?php
        if (isset($profile)) {
            $checker = $this->requestAction('settings/check_edit_permission/' . $this->request->session()->read('Profile.id') . '/' . $profile->id);
            if ($sidebar->profile_edit == '1' && $param == 'view') {

                //if ($checker == 1) {
                    echo $this->Html->link(__('Edit'), ['action' => 'edit', $profile->id], ['class' => 'floatright btn btn-primary btnspc']);

                //}
            } else if ($param == 'edit') {
                echo $this->Html->link(__('View'), ['action' => 'view', $profile->id], ['class' => 'floatright btn btn-info btnspc']);
            }
        }
    ?>


    <?php


        if ($sidebar->profile_edit == '1' && $param == 'view') {
            
        $checker = $this->requestAction('settings/check_edit_permission/' . $this->request->session()->read('Profile.id') . '/' . $profile->id);

            if ($checker == 1) {

                ?>


                <a href="<?php
                    if ($profile->profile_type == '5') {
                        echo $this->request->webroot . 'documents/index?type=&submitted_for_id=' . $profile->id;
                    } else {
                        echo $this->request->webroot . 'documents/index?type=&submitted_by_id=' . $profile->id;
                    }
                ?>"  class=" floatright btn default btnspc">View My Documents</a>
            <?php
            }
        }


    ?>


</div>


<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<div class="row margin-top-20">
    <div class="col-md-12">

        <div class="profile-content">
            <div class="row">
                <div class="col-md-3">
                    <!-- PORTLET MAIN -->
                    <div class="portlet light profile-sidebar-portlet">
                        <!-- SIDEBAR USERPIC -->
                        <div class="profile-userpic" style="max-width:250px;margin:0 auto;">
                            <?php if (isset($p->image) && $p->image != "") { ?>
                                <img
                                    src="<?php echo $this->request->webroot; ?>img/profile/<?php echo $p->image ?>"
                                    class="img-responsive" alt="" id="clientpic" style="height: auto;"/>

                            <?php } else {
                                ?>
                                <img src="<?php echo $this->request->webroot; ?>img/profile/default.png"
                                     class="img-responsive" id="clientpic"
                                     alt="" style="height: auto;"/>
                            <?php
                            }
                            ?>
                            <?php if (isset($id) && !(isset($disabled))) { ?>
                                <center>
                                    <div class="form-group">
                                        <label class="sr-only" for="exampleInputEmail22">Add/Edit Image</label>

                                        <div class="input-icon">
                                            <br/>
                                            <a class="btn btn-xs  btn-success   margin-t10" href="javascript:void(0)"
                                               id="clientimg">
                                                <i class="fa fa-image"></i>
                                                Add/Edit Image
                                            </a>

                                        </div>
                                    </div>
                                </center>
                            <?php } ?>

                        </div>
                        <!-- END SIDEBAR USERPIC -->
                        <!-- SIDEBAR USER TITLE -->
                        <div class="profile-usertitle">
                            <div class="profile-usertitle-name">
                                <?php if (isset($p->fname)) echo ucwords($p->fname . ' ' . $p->lname); ?>
                            </div>

                            <?php if (isset($p->isb_id) && ($p->isb_id != "")) {
                                ?>
                                <div class="profile-usertitle-job">
                                    <small>
                                        ISB ID:



                                        <?php echo $p->isb_id; ?>

                                    </small>
                                </div>


                            <?php }
                                if (isset($p)) {
                                    if ($p->profile_type == 5) {
                                        ?>

                                        <label class="uniform-inline" style="margin-bottom:20px;">
                                            <input type="checkbox" name="stat" value="1"
                                                   id="<?php echo $profile->id; ?>"
                                                   class="checkhiredriver" <?php if ($p->is_hired == '1') echo "checked"; ?> />
                                            Was this driver hired? <span class="hired_msg"></span></label>

                                    <?php
                                    }
                                }

                                if (isset($p)) {
                                    if ($profile->profile_type == 5 || $profile->profile_type == 7 || $profile->profile_type == 8) {//driver, owner driver, owner operator
                                        if ($sidebar->orders_create == '1') {
                                            if ($sidebar->orders_mee == 1) {
                                                ?>

                                                <br>
                                                <a href="<?php echo $this->request->webroot; ?>orders/productSelection?driver=<?php echo $profile->id; ?>&ordertype=MEE"
                                                   class="btn red-flamingo clearfix"
                                                   style="margin-top:2px;width: 100%;">Order MEE <i
                                                        class="m-icon-swapright m-icon-white"></i></a>
                                            <?php }
                                            if ($sidebar->orders_products == 1) {
                                                ?>
                                                <br>
                                                <a href="<?php echo $this->request->webroot; ?>orders/productSelection?driver=<?php echo $profile->id; ?>&ordertype=CART"
                                                   class="btn btn-success" style="margin-top:2px;width: 100%;">Order
                                                    Products <i class="m-icon-swapright m-icon-white"></i></a>

                                            <?php }
                                            if ($sidebar->order_requalify == 1) {
                                                ?>
                                                <a href="<?php echo $this->request->webroot; ?>orders/productSelection?driver=<?php echo $profile->id; ?>&ordertype=QUA"
                                                   class="btn btn-primary" style="margin-top:2px;width: 100%;">Re-Qualify
                                                    <i class="m-icon-swapright m-icon-white"></i></a>
                                            <?php
                                            }
                                        }
                                    }
                                }

                            //if (isset($client_docs)) {
                            //    include_once 'subpages/filelist.php';
                            //    listfiles($client_docs, "img/jobs/", 'profile_doc', false, 2);
                            //}
                            ?>
                        </div>


                    </div>


                </div>


                <div class="col-md-9">
                    <div class="portlet paddingless">
                        <div class="portlet-title line" style="display:none;">
                            <div class="caption caption-md">
                                <i class="icon-globe theme-font hide"></i>
                                <span
                                    class="caption-subject font-blue-madison bold"><?php echo ucfirst($settings->profile); ?>
                                    Manager</span>
                            </div>
                        </div>

                        <div class="portlet-body">
                            <?php
                                $activetab = "profile";
                                //if ($this->request->session()->read('Profile.profile_type') > 1) {//is not an admin, block.php suggests using =2
                                if (isset($_GET['getprofilescore'])) {
                                    $activetab = "scorecard";
                                } //
                                if (isset($_SERVER['HTTP_REFERER'])){
                                    if (strpos($_SERVER['HTTP_REFERER'], "profiles/edit/" . $id) > 0 or strpos($_SERVER['HTTP_REFERER'], "profiles/add") > 0 or strpos($_SERVER['HTTP_REFERER'], "productSelection") > 0 or isset($_GET["clientflash"])) { //. $id
                                        if (isset($Clientcount) && $Clientcount == 0) {
                                            $activetab = "permissions";
                                        }
                                    }
                                }

                                if (isset($_GET['activetab'])) {
                                    $activetab = $_GET['activetab'];
                                }

                                function activetab($activetab, $name, $needsclass = True)
                                {
                                    if ($activetab == $name || $activetab == "") {
                                        if ($needsclass) {
                                            echo " class='active'";
                                        } else {
                                            echo " active";
                                        }
                                        return $name;
                                    }
                                    return $activetab;
                                }

                            ?>
                            <!--BEGIN TABS-->
                            <div class="tabbable tabbable-custom">
                                <ul class="nav nav-tabs">

                                    <!--<li <?php if ($this->request['action'] == 'add' || $this->request['action'] == 'view' || (!isset($_GET['getprofilescore']) && (isset($Clientcount) && $Clientcount != 0))) { ?> class="active" <?php } ?> >
-->
                                    <li  <?php activetab($activetab, "profile"); ?> >

                                        <a href="#tab_1_1" data-toggle="tab">Profile</a>
                                    </li>
                                    <?php
                                     if ($this->request['action'] == 'view' && ($p->profile_type == 5 || $p->profile_type == 7 || $p->profile_type == 8)) {
                                        //if (($this->request['action'] == 'edit' || $this->request['action'] == 'view') && ($p->profile_type == 5 || $p->profile_type == 7 || $p->profile_type == 8) ) {
                                    ?>
                                        <li <?php activetab($activetab, "scorecard"); ?>>
                                            <a href="#tab_1_11" data-toggle="tab">View Scorecard</a>
                                        </li>
                                    <?php
                                    }

                                        /*$needs = false;
                                        if (isset($id) and (isset($p) && $p->profile_type == 5) or $needs) {
                                            echo '<li';
                                            activetab($activetab, "orders");
                                            echo '><a href="#tab_1_10" data-toggle="tab">Orders</li></a></li>';
                                        } */

                                        if ($this->request['action'] != 'add') {

                                            if ($this->request->params['action'] != 'add' && ($profile->profile_type == '5')) {
                                                ?>
                                                <li<?php activetab($activetab, "notes"); ?>>
                                                    <a href="#tab_1_9" data-toggle="tab">Notes</a>
                                                </li>
                                                

                                            <?php }
                                            $checker = $this->requestAction('/settings/check_edit_permission/' . $this->request->session()->read('Profile.id') . '/' . $profile->id."/".$profile->created_by);
                                            if($this->request->session()->read('Profile.super') == '1' || ($sidebar->profile_create == '1' && $sidebar->profile_edit=='1')){
                                            //if ($this->request->session()->read('Profile.admin') || ($this->request->session()->read('Profile.id') != $id && $this->request->session()->read('Profile.profile_type') == '2')) { 
                                                ?>
                                                <li <?php activetab($activetab, "permissions"); ?>>
                                                    <a href="#tab_1_7" data-toggle="tab">Permissions</a>
                                                </li>

                                            <?php } ?>
                                                
                                               
                                            
                                        <?php    
                                        }
                                    ?>
                                </ul>


                                <div class="tab-content">
                                    <!-- PERSONAL INFO TAB -->

                                    <!--<div class="tab-pane  <?php if ($this->request['action'] == 'add' || $this->request['action'] == 'view' || (!isset($_GET['getprofilescore']) && ($Clientcount != 0))) { ?> active <?php } ?> " id="tab_1_1">
                                    -->
                                    <div class="tab-pane  <?php activetab($activetab, "profile", false); ?> "
                                         id="tab_1_1">

                                        <input type="hidden" name="user_id" value="<?php echo ""; ?>"/>
                                        <?php include('subpages/profile/info.php'); ?>
                                    </div>
                                    <!-- END PERSONAL INFO TAB -->
                                    <!-- CHANGE AVATAR TAB -->

                                    <?php
                                        if ($this->request['action'] != 'add') {
                                            ?>

                                            <!--php
                                            if (isset($id) and (isset($p) && $p->profile_type == 5) or $needs) {
                                                echo '<div class="tab-pane';
                                                activetab($activetab, "orders", false);
                                                echo '" id="tab_1_10">';
                                                include('subpages/profile/listorders.php');
                                                echo '</div>';//lists driver's orders
                                            }
                                            -->

                                            <div class="tab-pane <?php activetab($activetab, "notes", false); ?>"
                                                 id="tab_1_9">
                                                <div class="cleafix">&nbsp;</div>

                                                <div class="portlet-body">
                                                    <?php include('subpages/documents/recruiter_notes.php');//notes ?>
                                                </div>
                                                <!--</div>-->
                                            </div>

                                        <?php }
                                        if ($this->request['action'] == 'view') {
                                            ?>
                                            <div class="tab-pane <?php activetab($activetab, "scorecard", false); ?>"
                                                 id="tab_1_11">
                                                <?php
                                                    include('subpages/documents/forview.php');
                                                ?>
                                            </div>
                                        <?php } ?>
                                    <div class="tab-pane <?php activetab($activetab, "permissions", false); ?>"
                                         id="tab_1_7">
                                        <?php include('subpages/profile/block.php');//permissions ?>
                                    </div>
                                  
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PROFILE CONTENT -->
        </div>
    </div>
</div>


<script>


    function initiate_ajax_upload(button_id) {
        var button = $('#' + button_id), interval;
        new AjaxUpload(button, {
            action: "<?php echo $this->request->webroot;?>profiles/upload_img/<?php if(isset($id))echo $id;?>",
            name: 'myfile',
            onSubmit: function (file, ext) {
                button.text('Uploading');
                this.disable();
                interval = window.setInterval(function () {
                    var text = button.text();
                    if (text.length < 13) {
                        button.text(text + '.');
                    } else {
                        button.text('Uploading');
                    }
                }, 200);
            },
            onComplete: function (file, response) {
                button.html('<i class="fa fa-image"></i> Add/Edit Image');
                window.clearInterval(interval);
                this.enable();
                $("#clientpic").attr("src", '<?php echo $this->request->webroot;?>img/profile/' + response);
                $('#client_img').val(response);
                alert('Image saved');
            }
        });
    }
    $(function () {

        <?php
        if(isset($id))
        {
            if($this->request->params['action'] != 'view')
            {
                ?>

        initiate_ajax_upload('clientimg');
        <?php
            }
         ?>
        $('.addclientz').click(function () {
            var client_id = $(this).val();
            var addclient = "";
            var msg = '';
            var nameId = 'msg_' + $(this).val();
            if ($(this).is(':checked')) {
                addclient = '1';
                msg = '<span class="msg" style="color:#45B6AF">Added</span>';
            }
            else {
                addclient = '0';
                msg = '<span class="msg" style="color:red">Removed</span>';
            }

            $.ajax({
                type: "post",
                data: "client_id=" + client_id + "&add=" + addclient + "&user_id=" +<?php echo $id;?>,
                url: "<?php echo $this->request->webroot;?>clients/addprofile",
                success: function () {
                    $('.' + nameId).html(msg);
                }
            })
        });
        <?php
         }
         else
         {?>
        $('.addclientz').click(function () {
            var nameId = 'msg_' + $(this).val();
            var client_id = "";
            var msg = '';
            $('.addclientz').each(function () {
                if ($(this).is(':checked')) {
                    msg = '<span class="msg" style="color:#45B6AF">Added</span>';
                    client_id = client_id + "," + $(this).val();
                }
                else {
                    msg = '<span class="msg" style="color:red">Removed</span>';
                }
            });

            client_id = client_id.substr(1, length.client_id);
            $('.client_profile_id').val(client_id);
            $('.' + nameId).html(msg);

        });
        <?php
        }
        ?>
        $('#save_client_p1').click(function () {

            $('#save_client_p1').text('Saving..');

            $("#pass_form").validate({
                rules: {
                    password: {
                        required: true
                    },
                    retype_password: {
                        required: true,
                        equalTo: "#password"
                    }
                },
                messages: {
                    password: "Please enter password",
                    retype_password: "Password do not match"
                },
                submitHandler: function () {
                    $('#pass_form').submit();
                },
            });
        });

    });
</script>
<script>
    $(function () {

        $('.checkhiredriver').click(function () {

            var oid = $(this).attr('id');
            var msgs = '';
            if ($(this).is(":checked")) {
                var hired = 1;
                msg = '<span class="msg" style="color:#45B6AF">Added</span>';
            }
            else {
                var hired = 0;
                msg = '<span class="msg" style="color:red">Removed</span>';
            }

            $.ajax({
                url: "<?php echo $this->request->webroot;?>orders/savedriver/" + oid,
                type: 'post',
                data: 'is_hired=' + hired,
                success: function () {
                    $('.hired_msg').html(msg);
                }
            })
        });

        /*$('.checkhiredriver').change(function () {
         var msg = '';
         var nameId = 'msg_'+$(this).val();
         if ($(this).is(':checked')) {
         msg = '<span class="msg" style="color:#45B6AF">Added</span>';

         var url = '
        <?php echo $this->request->webroot;?>clients/assignProfile/' + $(this).val() + '/
        <?php if(isset($id) && $id)echo $id;else echo '0'?>/yes';
         }
         else {
         msg = '<span class="msg" style="color:red">Removed</span>';
         var url = '
        <?php echo $this->request->webroot;?>clients/assignProfile/' + $(this).val() + '/
        <?php if(isset($id) && $id)echo $id;else echo '0'?>/no';
         }

         $.ajax({url: url,success:function(){$('.'+nameId).html(msg);}});
         }); */
    });
</script>
<script>
    <?php
    if($this->request->params['action']=='edit')
    {
        ?>

    function searchClient() {
        var key = $('#searchClient').val();
        $('#clientTable').html('<tbody><tr><td><img src="<?php echo $this->request->webroot;?>assets/admin/layout/img/ajax-loading.gif"/></td></tr></tbody>');
        $.ajax({
            url: '<?php echo $this->request->webroot;?>clients/getAjaxClient/<?php echo $id;?>',
            data: 'key=' + key,
            type: 'get',
            success: function (res) {
                $('#clientTable').html(res);
            }
        });
    }
    <?php
    }
    else
    {
    ?>
    function searchClient() {
        var key = $('#searchClient').val();
        $('#clientTable').html('<tbody><tr><td><img src="<?php echo $this->request->webroot;?>assets/admin/layout/img/ajax-loading.gif"/></td></tr></tbody>');
        $.ajax({
            url: '<?php echo $this->request->webroot;?>clients/getAjaxClient',
            data: 'key=' + key,
            type: 'get',
            success: function (res) {
                $('#clientTable').html(res);
            }
        });
    }
    <?php
    }
    ?>
    $(function () {
        $('.scrolldiv').slimScroll({
            height: '250px'
        });

    });
</script>
<style>
    .portlet-body {
        min-height: 250px !important;
    }
</style>
