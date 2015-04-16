<?php
$settings = $this->requestAction('settings/get_settings');
$sidebar = $this->requestAction("settings/get_side/" . $this->Session->read('Profile.id'));
if (!isset($_GET["new"])) {
    if ($_SERVER['SERVER_NAME'] == "localhost" || $_SERVER['SERVER_NAME'] == "127.0.0.1") {
        include_once('/subpages/api.php');
    } else {
        include_once('subpages/api.php');
    }
}
?>


<h3 class="page-title">
    Users
</h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="<?php echo $this->request->webroot; ?>">Dashboard</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="<?php echo $this->request->webroot; ?>training">Training</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <?php if (isset($_GET["quizid"])) { ?>
            <li>
                <a href="<?php echo $this->request->webroot; ?>training/edit?quizid=<?= $_GET["quizid"]?>">Edit Quiz</a>
                <i class="fa fa-angle-right"></i>
            </li>
        <?php } ?>
        <li>
            <a href="">Enroll <?php echo ucfirst($settings->profile); ?>s</a>
        </li>
    </ul>
    <a href="javascript:window.print();" class="floatright btn btn-info">Print</a>
<?php

if (isset($_GET["new"])){
    echo '<a href="' . $this->request->webroot . 'training/enroll?quizid=' . $_GET["quizid"] . '" class="floatright btn btn-primary btnspc">Old</a>';
} else {
    echo '<a href="' . $this->request->webroot . 'training/enroll?quizid=' . $_GET["quizid"] . '&new" class="floatright btn btn-primary btnspc">New</a>';
}

echo "</div>";

if (isset($profiles) or isset($profile)) { ?>
    <div class="row">
    <div class="col-md-12">
    <div class="portlet box green-haze">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-user"></i>
            Enroll <?php echo ucfirst($settings->profile); ?>s
        </div>
    </div>


    <div class="portlet-body form">

    <?php
if (isset($_GET["new"])){
    include('userenrollment.php');
} else {
    ?>

                <div class="form-actions top chat-form" style="margin-top:0;margin-bottom:0;">
                    <div class="btn-set pull-left">

                    </div>
                    <div class="btn-set pull-right">


                        <form action="<?php echo $this->request->webroot; ?>training/enroll" method="get">
                            <?php if (isset($_GET['draft'])) { ?><input type="hidden" name="draft"/><?php } ?>
                            <input type="hidden" name="quizid" value="<?= $_GET["quizid"]; ?>"/>

                            <select class="form-control input-inline" style="" name="filter_profile_type">
                                <option value=""><?php echo ucfirst($settings->profile); ?> Type</option>

                                <?php
                                $isISB = (isset($sidebar) && $sidebar->client_option == 0);
                                if ($isISB) {
                                    ?>

                                    <option value="1" <?php if (isset($return_profile_type) && $return_profile_type == 1) { ?> selected="selected"<?php } ?> >
                                        Admin
                                    </option>
                                    <option value="2" <?php if (isset($return_profile_type) && $return_profile_type == 2) { ?> selected="selected"<?php } ?>>
                                        Recruiter
                                    </option>
                                    <option value="3" <?php if (isset($return_profile_type) && $return_profile_type == 3) { ?> selected="selected"<?php } ?>>
                                        External
                                    </option>
                                    <option value="4" <?php if (isset($return_profile_type) && $return_profile_type == 4) { ?> selected="selected"<?php } ?>>
                                        Safety
                                    </option>
                                    <option value="5" <?php if (isset($return_profile_type) && $return_profile_type == 5) { ?> selected="selected"<?php } ?>>
                                        Driver
                                    </option>
                                    <option value="6" <?php if (isset($return_profile_type) && $return_profile_type == 6) { ?> selected="selected"<?php } ?>>
                                        Contact
                                    </option>
                                    <option value="7" <?php if (isset($return_profile_type) && $return_profile_type == 7) { ?> selected="selected"<?php } ?>>
                                        Owner Operator
                                    </option>
                                    <option value="8" <?php if (isset($return_profile_type) && $return_profile_type == 8) { ?> selected="selected"<?php } ?>>
                                        Owner Driver
                                    </option>

                                <?php } else { ?>
                                    <option value="9" <?php if (isset($return_profile_type) && $return_profile_type == 9) { ?> selected="selected"<?php } ?> >
                                        Employee
                                    </option>
                                    <option value="10" <?php if (isset($return_profile_type) && $return_profile_type == 10) { ?> selected="selected"<?php } ?> >
                                        Guest
                                    </option>
                                    <option value="11" <?php if (isset($return_profile_type) && $return_profile_type == 11) { ?> selected="selected"<?php } ?> >
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
                                if (isset($_GET['searchprofile'])) {
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
                                    <td><?= $this->Number->format($profile->id) ?></td>
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
                                        <?php if ($sidebar->profile_list == '1' && !isset($_GET["draft"])) {
                                            ?>
                                            <a href="<?php echo $this->request->webroot; ?>profiles/view/<?php echo $profile->id; ?>"> <?php echo ucfirst(h($profile->username)); ?> </a>
                                        <?php
                                        } else
                                            echo ucfirst(h($profile->username));
                                        ?>
                                        <br/>


                                    </td>

                                    <td><?= h($profile->fname) ?> <?= h($profile->lname) ?></td>

                                    <td><?php
                                        if (strlen($profile->profile_type) > 0) {
                                            echo h($this->requestAction("profiles/getTypeTitle/".$profile->profile_type));
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

                                        <A href="enroll?quizid=<?= $_GET["quizid"] ?>&userid=<?= $this->Number->format($profile->id) ?>" class="<?= btnclass("btn-info", "yellow"); ?>">
                                            <?php if ($profile->isenrolled) { echo "Unenroll";} else {echo "Enroll";} ?>
                                        </A>

                                    </td>
                                </tr>

                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="form-actions" style="height:75px;">
                    <div class="row">
                        <div class="col-md-12" align="right">
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

    <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php } ?>