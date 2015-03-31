


<?php if ($_SERVER['SERVER_NAME'] == "localhost" || $_SERVER['SERVER_NAME'] == "127.0.0.1") {
          include_once('/subpages/api.php');
      } else {
          include_once('subpages/api.php');
      }

?>


<style>
    @media print {
        .page-header {
            display: none;
        }

        .page-footer, .chat-form, .nav-tabs, .page-title, .page-bar, .theme-panel, .page-sidebar-wrapper, .more {
            display: none !important;
        }

        .portlet-body, .portlet-title {
            border-top: 1px solid #578EBE;
        }

        .tabbable-line {
            border: none !important;
        }

        a:link:after,
        a:visited:after {
            content: "" !important;
        }

        .actions {
            display: none
        }

        .paging_simple_numbers {
            display: none;
        }
    }

</style>


<?php
    //include_once ('subpages/api.php');
    $dr_cl = $doc_comp->getDriverClient(0, 0);
    $getProfileType = $this->requestAction('profiles/getProfileType/' . $this->Session->read('Profile.id'));
    $settings = $this->requestAction('settings/get_settings');
    $sidebar = $this->requestAction("settings/all_settings/" . $this->request->session()->read('Profile.id') . "/sidebar");

    function hasget($name)
    {
        if (isset($_GET[$name])) {
            return strlen($_GET[$name]) > 0;
        }
        return false;
    }
?>

<h3 class="page-title">
    <?php echo ucfirst($settings->profile); ?>s
</h3>

<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="<?php echo $this->request->webroot; ?>">Dashboard</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href=""><?php echo ucfirst($settings->profile); ?>s</a>
        </li>
    </ul>
    <a href="javascript:window.print();" class="floatright btn btn-info">Print</a>

    <?php if ($sidebar->profile_create == 1) { ?>
        <a href="<?php echo WEB_ROOT; ?>profiles/add" class="floatright btn btn-primary btnspc">
            Add <?php echo ucfirst($settings->profile); ?></a>
    <?php } ?>

</div>

<div class="row">


    <div class="col-md-12">


        <div class="portlet box green-haze">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-user"></i>
                    List <?php echo ucfirst($settings->profile); ?>s
                </div>
            </div>


            <div class="portlet-body form">


                <div class="form-actions top chat-form" style="margin-top:0;margin-bottom:0;">
                    <div class="btn-set pull-left">

                    </div>
                    <div class="btn-set pull-right">


                        <form action="<?php echo $this->request->webroot; ?>profiles/index" method="get">
                            <?php if (isset($_GET['draft'])) { ?><input type="hidden" name="draft"/><?php } ?>


                            <select class="form-control input-inline" style="" name="filter_profile_type">
                                <option value=""><?php echo ucfirst($settings->profile); ?> Type</option>

                                <?php
                                    $isISB = (isset($sidebar) && $sidebar->client_option == 0);
                                    if ($isISB) {
                                        ?>

                                        <option
                                            value="1" <?php if (isset($return_profile_type) && $return_profile_type == 1) { ?> selected="selected"<?php } ?> >
                                            Admin
                                        </option>
                                        <option
                                            value="2" <?php if (isset($return_profile_type) && $return_profile_type == 2) { ?> selected="selected"<?php } ?>>
                                            Recruiter
                                        </option>
                                        <option
                                            value="3" <?php if (isset($return_profile_type) && $return_profile_type == 3) { ?> selected="selected"<?php } ?>>
                                            External
                                        </option>
                                        <option
                                            value="4" <?php if (isset($return_profile_type) && $return_profile_type == 4) { ?> selected="selected"<?php } ?>>
                                            Safety
                                        </option>
                                        <option
                                            value="5" <?php if (isset($return_profile_type) && $return_profile_type == 5) { ?> selected="selected"<?php } ?>>
                                            Driver
                                        </option>
                                        <option
                                            value="6" <?php if (isset($return_profile_type) && $return_profile_type == 6) { ?> selected="selected"<?php } ?>>
                                            Contact
                                        </option>
                                        <option
                                            value="7" <?php if (isset($return_profile_type) && $return_profile_type == 7) { ?> selected="selected"<?php } ?>>
                                            Owner Operator
                                        </option>
                                        <option
                                            value="8" <?php if (isset($return_profile_type) && $return_profile_type == 8) { ?> selected="selected"<?php } ?>>
                                            Owner Driver
                                        </option>

                                    <?php } else { ?>
                                        <option
                                            value="9" <?php if (isset($return_profile_type) && $return_profile_type == 9) { ?> selected="selected"<?php } ?> >
                                            Employee
                                        </option>
                                        <option
                                            value="10" <?php if (isset($return_profile_type) && $return_profile_type == 10) { ?> selected="selected"<?php } ?> >
                                            Guest
                                        </option>
                                        <option
                                            value="11" <?php if (isset($return_profile_type) && $return_profile_type == 11) { ?> selected="selected"<?php } ?> >
                                            Partner
                                        </option>
                                    <?php } ?>

                            </select>

                            <?php
                                $super = $this->request->session()->read('Profile.super');
                                if (isset($super)) {
                                    $getClient = $this->requestAction('profiles/getClient');
                                    ?>
                                    <select class="form-control showprodivision input-inline" style=""
                                            name="filter_by_client">
                                        <option value=""><?php echo ucfirst($settings->client); ?></option>
                                        <?php
                                            if ($getClient) {
                                                foreach ($getClient as $g) {
                                                    ?>
                                                    <option
                                                        value="<?php echo $g->id; ?>" <?php if (isset($return_client) && $return_client == $g->id) { ?> selected="selected"<?php } ?> ><?php echo $g->company_name; ?></option>
                                                <?php
                                                }
                                            }
                                        ?>
                                    </select>


                                    <div class="prodivisions input-inline">
                                    </div>


                                <?php } ?>

                            <input class="form-control input-inline" type="search" name="searchprofile"
                                   placeholder=" Search for <?php echo ucfirst($settings->profile); ?>"
                                   value="<?php if (isset($search_text)) echo $search_text; ?>"
                                   aria-controls="sample_1"/>
                            <button type="submit" class="btn btn-primary input-inline">Search</button>
                        </form>
                    </div>
                </div>

                <div class="form-body">
                    <div class="table-scrollable">

                        <table
                            class="table table-condensed  table-striped table-bordered table-hover dataTable no-footer">
                            <thead>
                            <tr class="sorting">
                                <th><?= $this->Paginator->sort('id') ?></th>
                                <th style="width:7px;"><?= $this->Paginator->sort('image', 'Image') ?></th>
                                <th><?= $this->Paginator->sort('username', 'Username') ?></th>
                                <!--th><?= $this->Paginator->sort('email') ?></th-->
                                <th><?= $this->Paginator->sort('fname', 'Name') ?></th>
                                <th><?= $this->Paginator->sort('profile_type', ucfirst($settings->profile) . ' Type') ?></th>

                                <!--th><?= $this->Paginator->sort('lname', 'Last Name') ?></th-->
                                <th>Assigned to <?= $settings->clients; ?></th>
                                <th>Actions</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                $row_color_class = "odd";

                                $isISB = (isset($sidebar) && $sidebar->client_option == 0);
                                $profiletype = ['', 'Admin', 'Recruiter', 'External', 'Safety', 'Driver', 'Contact', 'Owner Operator', 'Owner Driver', 'Employee', 'Guest', 'Partner'];


                                if (count($profiles) == 0) {
                                    echo '<TR><TD COLSPAN="8" ALIGN="CENTER">No ' . strtolower($settings->profile) . 's found';
                                    if (hasget('searchprofile')) {
                                        echo " matching '" . $_GET['searchprofile'] . "'";
                                    }
                                    echo '</TD></TR>';
                                }

                                foreach ($profiles as $profile):
                                    if ($row_color_class == "even") {
                                        $row_color_class = "odd";
                                    } else {
                                        $row_color_class = "even";
                                    }
                                    ?>

                                    <tr class="<?= $row_color_class; ?>" role="row">
                                        <td><?php echo $this->Number->format($profile->id);
                                         if($profile->hasattachments) { echo '<BR><i title="Has Attachment" class="fa fa-paperclip"></i>';}
                                         ?></td>
                                        <td><?php
                                                if ($sidebar->profile_list == '1' && !isset($_GET["draft"])) {
                                                    ?>
                                                    <a href="<?php echo $this->request->webroot; ?>profiles/view/<?php echo $profile->id; ?>">
                                                        <img style="width:40px;" src="<?php
                                                            if ($profile->image) {
                                                                echo $this->request->webroot; ?>img/profile/<?php echo $profile->image;
                                                            } else {
                                                                echo $this->request->webroot; ?>img/profile/default.png;
                                           <?php } ?>" class="img-responsive" alt=""/>
                                                    </a>
                                                <?php
                                                }
                                            ?>

                                        </td>
                                        <td class="actions  util-btn-margin-bottom-5">
                                        <?php
                                        if($profile->profile_type == 5 || $profile->profile_type == 7 || $profile->profile_type == 8)
                                        {
                                        ?>
                                        <!--<input type="checkbox" class="form-control" value="<?php echo $profile->id; ?>" id="checkbox_id_<?php echo $profile->id; ?>" />-->
                                        <?php
                                        }
                                        ?>
                                            <?php if ($sidebar->profile_list == '1' && !isset($_GET["draft"])) {
                                                ?>
                                                <a href="<?php echo $this->request->webroot; ?>profiles/view/<?php echo $profile->id; ?>"> <?php echo ucfirst(h($profile->username)); if($profile->drafts == 1) echo ' ( Draft )'; ?> </a>
                                            <?php
                                            } else
                                                echo ucfirst(h($profile->username));
                                            ?>
                                            <br/>


                                        </td>

                                        <td><?= h($profile->fname) ?> <?= h($profile->lname) ?></td>

                                        <td><?php
                                                if (strlen($profile->profile_type) > 0) {
                                                    echo h($profiletype[$profile->profile_type]);
                                                    if ($profile->profile_type == 5) {//is a driver
                                                        $expires = strtotime($profile->expiry_date);
                                                        if ($expires) {
                                                            if ($expires < time()) {
                                                                echo '<span class="clearfix " style="color:#a94442">License Expired</span>';
                                                            }
                                                        }
                                                    }
                                                } else {
                                                    echo "Draft";
                                                }
                                            ?></td>


                                        <td><?php echo $ProClients->getAllClientsname($profile->id);?></td>
                                        <td class="actions  util-btn-margin-bottom-5">
                                            <?php if ($sidebar->profile_list == '1' && !isset($_GET["draft"])) {
                                                        echo $this->Html->link(__('View'), ['action' => 'view', $profile->id], ['class' => btnclass("VIEW")]);
                                                    } ?>

                                                    <?php
                                                       $checker = $this->requestAction('/settings/check_edit_permission/' . $this->request->session()->read('Profile.id') . '/' . $profile->id."/".$profile->created_by);
                                                        if ($sidebar->profile_edit == '1') {

                                                            if ($checker == 1 ) {
                                                                /*if ($this->request->session()->read('Profile.profile_type') == '2') {
                                                                    //echo $profile->profile_type;
                                                                    if ($profile->profile_type == '5' || $profile->profile_type == '7' || $profile->profile_type == '8')
                                                                        echo $this->Html->link(__('Edit'), ['action' => 'edit', $profile->id], ['class' => btnclass("EDIT")]);
                                                                } else
                                                                */
                                                                    echo $this->Html->link(__('Edit'), ['action' => 'edit', $profile->id], ['class' => btnclass("EDIT")]);
                                                            }
                                                        } ?>
                                                    <?php if ($sidebar->profile_delete == '1') {
                                                        if ($this->request->session()->read('Profile.super') == '1') {
                                                            if ($this->request->session()->read('Profile.id') != $profile->id) {
                                                                ?>

                                                                <a href="<?php echo $this->request->webroot; ?>profiles/delete/<?php echo $profile->id; ?><?php echo (isset($_GET['draft'])) ? "?draft" : ""; ?>"
                                                                   onclick="return confirm('Are you sure you want to delete <?= ucfirst(h($profile->username)) ?>?');"
                                                                   class="<?= btnclass("DELETE") ?>">Delete</a>
                                                                </span>
                                                            <?php
                                                            }
                                                        } else if ($this->request->session()->read('Profile.profile_type') == '2' && ($profile->profile_type == '5')) {
                                                            ?>
                                                            <a href="<?php echo $this->request->webroot; ?>profiles/delete/<?php echo $profile->id; ?><?php echo (isset($_GET['draft'])) ? "?draft" : ""; ?>"
                                                               onclick="return confirm('Are you sure you want to delete <?= ucfirst(h($profile->username)) ?>?');"
                                                               class="<?= btnclass("DELETE") ?>">Delete</a>
                                                        <?php
                                                        }

                                                    }


                                                if ($sidebar->document_list == 1/* && $doc != 0 && $cn != 0*/) {
                                                    ?>
                                                    <a href="<?php
                                                    if($profile->profile_type == '5' || $profile->profile_type == '7' || $profile->profile_type == '8' )
                                                    {
                                                        echo $this->request->webroot . 'documents/index?type=&submitted_for_id=' . $profile->id;
                                                     }
                                                     else
                                                     {
                                                        echo $this->request->webroot . 'documents/index?type=&submitted_by_id=' . $profile->id;
                                                     }
                                                      ?>"

                                                    class="<?= btnclass("btn-info", "blue-soft") ?>">View Documents</a>
                                                    <?php
                                                    }

                                                    if ($sidebar->orders_list == '1' ) {
                                                        ?>
                                                        <a href="<?php echo $this->request->webroot; ?>orders/orderslist/?uploaded_for=<?php echo $profile->id; ?>"
                                                           class="<?= btnclass("btn-info", "blue-soft") ?>">
                                                            View Orders</a>

                                                        
                                                    <?php

                                                    }
            
                                                     ?>
                                        </td>
                                    </tr>

                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="form-actions" style="height:75px;">
                    <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6" align="left">
                        <!--<a href="javascript:void(0);" class="bulk_order btn btn-primary">Bulk Orders</a>-->
                        </div>
                        <div class="col-md-6" align="right">
                            <div id="sample_2_paginate" class="dataTables_paginate paging_simple_numbers" align="right"
                                 style="margin-top:-10px;">
                                <ul class="pagination sorting">
                                    <?= $this->Paginator->prev('< ' . __('previous')); ?>
                                    <?= $this->Paginator->numbers(); ?>
                                    <?= $this->Paginator->next(__('next') . ' >'); ?>
                                </ul>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        $('.sorting').find('a').each(function () {

            <?php if(isset($_GET['draft'])){?>
            var hrf = $(this).attr('href');
            if (hrf != "")
                $(this).attr('href', hrf + '&draft');
            <?php } ?>
        });
    })
</script>
<script>

    $(function () {
        $('.bulk_order').click(function(){
            var tempstr = '';
           $('.table-scrollable input[type="checkbox"]').each(function(){

            if($(this).is(':checked'))
            {
                if(tempstr == '')
                tempstr = $(this).val();
                else
                tempstr = tempstr+','+$(this).val();
            }


           });
           window.location = '<?php echo $this->request->webroot;?>orders/productSelection?driver=0&ordertype=CART&profiles='+tempstr;
        });
        <?php if(isset($_GET['division'])&& $_GET['division']!=""){
                 //var_dump($_GET);
                 ?>
        var client_id = <?php if(isset($_GET['filter_by_client'])&& $_GET['filter_by_client']!="") echo $_GET['filter_by_client'];?>;
        var division_id = <?php echo $_GET['division'];?>;
        //alert(client_id+'__'+division_id);
        if (client_id != "") {
            $.ajax({
                type: "post",
                data: "client_id=" + client_id,
                url: "<?php echo $this->request->webroot;?>clients/getdivisions/" + division_id,
                success: function (msg) {
                    //alert(msg);
                    $('.prodivisions').html(msg);
                }
            });
        }
        <?php
        }
        //if(isset($_GET['division'])&& $_GET['division']!="")
        ?>

        $('.showprodivision').change(function () {
            var client_id = $(this).val();
            if (client_id != "") {
                $.ajax({
                    type: "post",
                    data: "client_id=" + client_id,
                    url: "<?php echo $this->request->webroot;?>clients/getdivisions",
                    success: function (msg) {
                        $('.prodivisions').html(msg);
                    }
                });
            }
        });
        var client_id = $('.showprodivision').val();
        if (client_id != "") {
            $.ajax({
                type: "post",
                data: "client_id=" + client_id,
                url: "<?php echo $this->request->webroot;?>clients/getdivisions",
                success: function (msg) {
                    $('.prodivisions').html(msg);
                }
            });
        }
    });
</script>