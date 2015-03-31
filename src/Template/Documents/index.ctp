<?php
    $settings = $this->requestAction('settings/get_settings');
    $sidebar = $this->requestAction("settings/all_settings/" . $this->Session->read('Profile.id') . "/sidebar");

if ($_SERVER['SERVER_NAME'] == "localhost" || $_SERVER['SERVER_NAME'] == "127.0.0.1") {
    include_once('/subpages/api.php');
} else {
    include_once('subpages/api.php');
}?>

<h3 class="page-title">
    <?php echo ucfirst($settings->document); ?>s <?php if (isset($_GET['draft'])) { ?>(Draft)<?php } ?>
</h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="<?php echo $this->request->webroot; ?>">Dashboard</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href=""><?php echo ucfirst($settings->document); ?>s</a>
        </li>
    </ul>

    <a href="javascript:window.print();" class="floatright btn btn-info">Print</a>
    <?php if ($sidebar->document_create == 1) { ?>
        <a href="<?php echo $this->request->webroot; ?>clients?flash" class="floatright btn btn-primary btnspc">
            Create <?php echo ucfirst($settings->document); ?></a>
    <?php }
        if (isset($_GET["draft"])) { ?>
            <a href="<?php echo $this->request->webroot; ?>documents/index" class="floatright btn btn-info btnspc">
                List <?php echo ucfirst($settings->document); ?>s</a>
        <?php } else { ?>
            <a href="<?php echo $this->request->webroot; ?>documents/index?draft"
               class="floatright btn btn-info btnspc">
                Drafts</a>
        <?php } ?>

</div>


<div class="row">
    <div class="col-md-12">
        <div class="portlet box yellow-casablanca ">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-copy"></i>
                    List <?php echo ucfirst($settings->document); ?>s
                </div>
            </div>
            <div class="portlet-body form">

                <div class="form-actions top chat-form" style="margin-top:0;margin-bottom:0;" align="right">

                    <div class="btn-set pull-left">

                    </div>
                    <div class="btn-set pull-right">


                        <form action="<?php echo $this->request->webroot; ?>documents/index" method="get">
                            <?php if (isset($_GET['draft'])) { ?><input type="hidden" name="draft"/><?php } ?>






                            <?php
                                $type = $doc_comp->getDocType();
                            ?>

                            <select class="form-control input-inline" name="type">
                                <option value=""><?php echo ucfirst($settings->document); ?> type</option>
                                <?php
                                    foreach ($type as $t) {
                                        ?>
                                        <option
                                            value="<?php echo $t->id; ?>" <?php if (isset($return_type) && $return_type == $t->id) { ?> selected="selected"<?php } ?> ><?php echo ucfirst($t->title); ?></option>
                                    <?php
                                    }
                                ?>
                                <!--<option
                                    value="orders" <?php if (isset($return_type) && $return_type == 'orders') { ?> selected="selected"<?php } ?>>
                                    Orders
                                </option>
                                <option
                                    value="feedbacks" <?php if (isset($return_type) && $return_type == 'feedbacks') { ?> selected="selected"<?php } ?>>
                                    Feedback
                                </option>-->
                            </select>






                            <?php
                                $users = $doc_comp->getAllUser();
                            ?>


                            <select class="form-control input-inline" name="submitted_by_id" style="width:140px;">
                                <option value="">Submitted by</option>
                                <?php
                                    foreach ($users as $u) {
                                        ?>
                                        <option
                                            value="<?php echo $u->id; ?>" <?php if (isset($return_user_id) && $return_user_id == $u->id) { ?> selected="selected"<?php } ?> ><?php echo ucfirst($u->username); ?></option>
                                    <?php
                                    }
                                ?>
                            </select>

                            <select class="form-control input-inline" name="submitted_for_id" style="">
                                <option value="">Submitted for</option>
                                <?php
                                    $dr_cl = $doc_comp->getDriverClient(0, 0);
                                    $drcl_d = $dr_cl['driver'];
                                    foreach ($drcl_d as $drcld) {

                                        ?>
                                        <option
                                            value="<?php echo $drcld->id; ?>" <?php if (isset($return_submitted_for_id) && $return_submitted_for_id == $drcld->id) { ?> selected="selected"<?php } ?> ><?php echo ucfirst($drcld->username); ?></option>
                                    <?php
                                    }
                                ?>
                            </select>





                            <?php
                                $clients = $doc_comp->getAllClient();
                            ?>



                            <select class="form-control showclientdivision  input-inline" name="client_id">
                                <option value=""><?php echo ucfirst($settings->client); ?></option>
                                <?php
                                    foreach ($clients as $c) {
                                        ?>
                                        <option
                                            value="<?php echo $c->id; ?>" <?php if (isset($return_client_id) && $return_client_id == $c->id) { ?> selected="selected"<?php } ?> ><?php echo ucfirst($c->company_name); ?></option>
                                    <?php
                                    }
                                ?>

                            </select>


                            <input class="form-control input-inline" name="searchdoc" type="search"
                                   placeholder=" Search <?php echo ucfirst($settings->document); ?>s"
                                   value="<?php if (isset($search_text)) echo $search_text; ?>"
                                   aria-controls="sample_1"/>


                            <button type="submit" class="btn btn-primary input-inline" id="search">Search</button>

                        </form>
                    </div>
                </div>


                <div class="clearfix"></div>

                <div class="form-body">
                    <div class="table-scrollable">
                        <table
                            class="table table-condensed table-striped table-bordered table-hover dataTable no-footer">
                            <thead>
                            <tr class="sorting">
                                <th title="Document ID"><?= $this->Paginator->sort('id'); ?></th>
                                <th><?= $this->Paginator->sort('document_type', ucfirst($settings->document) . ' type'); ?></th>
                                <th title="Order ID" style="max-width: 58px;"><?= $this->Paginator->sort('oid', "Order ID"); ?></th>

                                <th><?= $this->Paginator->sort('user_id', 'Submitted by'); ?><?php if (isset($end)) echo $end;
                                        if (isset($start)) echo "//" . $start; ?></th>
                                <th><?= $this->Paginator->sort('uploaded_for', 'Driver'); ?><?php if (isset($end)) echo $end;
                                        if (isset($start)) echo "//" . $start; ?></th>
                                <th><?= $this->Paginator->sort('created', 'Date'); ?></th>
                                <th><?= $this->Paginator->sort('client_id', ucfirst($settings->client)); ?></th>
                                <th class="actions"><?= __('Actions') ?></th>
                                <th><?= $this->Paginator->sort('draft', "Status"); ?></th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                $row_color_class = "odd";
                                $subdoc = $this->requestAction('/profiles/getSub');
                                $docz = [''];
                                foreach ($subdoc as $d) {
                                    array_push($docz, $d->title);
                                }

                                function hasget($name)
                                {
                                    if (isset($_GET[$name])) {
                                        return strlen($_GET[$name]) > 0;
                                    }
                                    return false;
                                }

                                //var_dump($docz);
                                if (count($documents) == 0) {
                                    echo '<TR><TD COLSPAN="9" ALIGN="CENTER">No ' . strtolower($settings->document) . 's found';
                                    if (hasget('searchdoc')) {
                                        echo " matching '" . $_GET['searchdoc'] . "'";
                                    }
                                    echo '</TD></TR>';
                                }

                                foreach ($documents as $docs):

                                if ($docs->document_type == 'feedbacks' && !$this->request->session()->read('Profile.super'))
                                    continue;


                                if ($row_color_class == "even") {
                                    $row_color_class = "odd";
                                } else {
                                    $row_color_class = "even";
                                }
                                $uploaded_by = $doc_comp->getUser($docs->user_id);
                                $uploaded_for = $doc_comp->getUser($docs->uploaded_for);
                                $getClientById = $doc_comp->getClientById($docs->client_id);
                                $orderID = $this->Number->format($docs->order_id);
                                if($orderID)
                                $orderDetail = $doc_comp->getOrderById($docs->order_id);
                                $getColorId = $this->requestAction('documents/getColorId/'.$docs->sub_doc_id);
                                //$orderDetail = '<A HREF="'.$this->request->webroot.'orders/vieworder/'.$orderDetail->client_id.'/' . $orderID . '">' . $orderID . '</A>';
                            ?>
                            <tr class="<?= $row_color_class; ?>" role="row">
                                <td><?echo $this->Number->format($docs->id);
                                    if($docs->hasattachments) { echo '<BR><i  title="Has Attachment" class="fa fa-paperclip"></i>';} ?></td>

                                <td style="width: 220px;">
                                    <?php switch (1){//change the number to pick a style
                                        case 0://plain text
                                            echo h($docs->document_type);
                                            break;
                                        case 1://top block
                                        echo '<div class="dashboard-stat ';
                                        $colors = array("pre-screening" => "blue-madison", "survey" => "green", "driver application" => "red", "road test" => "yellow", "consent form" => "purple", "feedbacks" => "red-intense", "attachment" => "yellow-saffron", "audits" => "grey-cascade");
                                       /* if (isset($colors[strtolower($docs->document_type)])) {
                                            echo $colors[strtolower($docs->document_type)];
                                        }
                                        */
                                        if(isset($getColorId))
                                        echo $getColorId;
                                         else {
                                            echo "blue";
                                        }
                                    ?>">

                                    <!--div class="details"> //WARNING: This won't work while in a table...
                                        <div class="number"></div>
                                        <div class="desc"></div>
                                    </div-->
                                    <a class="more"  id="sub_doc_click1"
                                       href="<?php if ($sidebar->document_list == '1' && !isset($_GET["draft"])) {
                                           if (!$docs->order_id){
                                               echo $this->request->webroot . 'documents/view/' . $docs->client_id . '/' . $docs->id;if($docs->sub_doc_id==4)echo '?doc='.urlencode($docs->document_type);
                                               }
                                           else{
                                               echo $this->request->webroot . 'documents/view/' . $docs->client_id . '/' . $docs->id . '?order_id=' . $docs->order_id;if($docs->sub_doc_id==4)echo '&doc='.urlencode($docs->document_type);
                                               }
                                       } else { ?>javascript:;<?php } ?>">
                                        <?= h($docs->document_type); //it won't let me put it in the desc  ?>

                                        <i class="fa fa-copy"></i>



                                    </a>
                    </div>

                    <?php break;
                        case 2: //tile, doesn't work. CSS not included?
                            ?>

                            <a href=$this->request->webroot."orders/productSelection?driver=0&amp;ordertype=MEE"
                                class="tile bg-yellow" style="display: block; height: 100px; ">
                                <div class="tile-body">
                                    <i class="icon-docs"></i>
                                </div>
                                <div class="tile-object">
                                    <div class="name">Order MEE</div>
                                    <div class="number"></div>
                                </div>
                            </a>

                            <?php break;
                        } ?>
                    </td>



                    <td align=""><?php if ($orderID > 0) {
                            echo '<a href="'.$this->request->webroot.'orders/vieworder/'.$orderDetail->client_id.'/'.$orderDetail->id;if($orderDetail->order_type){echo '?order_type='.urlencode($orderDetail->order_type);if($orderDetail->forms)echo '&forms='.$orderDetail->forms;}echo '">'.$orderDetail->id;echo '</a>';
                        } else {
                            echo "N/A";
                        }  ?></td>





                    <td><?php
                            $docname = "";
                            if (isset($uploaded_by->username)) {
                                $user = '<a href="' . $this->request->webroot . 'profiles/view/' . $docs->user_id . '" target="_blank">' . ucfirst(h($uploaded_by->username));
                                $docname = h($docs->document_type) . " submitted by " . ucfirst($uploaded_by->username) . " at " . h($docs->created);
                            } else {
                                $user = "None";
                            }

                            echo $user;
                        ?></td>
                    <td><?php

                            if (isset($uploaded_for->username)) {
                                $user = '<a href="' . $this->request->webroot . 'profiles/view/' . $docs->uploaded_for . '" target="_blank">' . ucfirst(h($uploaded_for->username));
                                if (strlen($docname) == 0) {
                                    $docname = h($docs->document_type) . " uploaded for " . ucfirst($uploaded_for->username) . " at " . h($docs->created);
                                }else{



                                }
                            } else {
                                $user = "None";
                            }

                            echo $user;
                        ?></td>
                    <td><?= h($docs->created) ?></td>
                    <td>
                        <?php
                            if (is_object($getClientById)) {
                                echo "<a href ='" . $this->request->webroot . "clients/edit/" . $docs->client_id . "?view'>" . ucfirst(h($getClientById->company_name)) . "</a>";
                            } else {
                                echo "Deleted " . $settings->client;
                            }
                        ?>

                    </td>
                    <td class="actions  util-btn-margin-bottom-5 ">

                        <?php if ($sidebar->document_list == '1' && !isset($_GET["draft"])) {
                            if (!$docs->order_id){
                                //echo $this->Html->link(__('View'), ['action' => 'view', $docs->client_id, $docs->id], ['class' => btnclass("VIEW")]);
                                ?>
                                <a class="<?= btnclass("VIEW") ?>"
                                   href="<?php echo $this->request->webroot;?>documents/view/<?php echo $docs->client_id;?>/<?php echo $docs->id?><?php if($docs->sub_doc_id==4)echo '?doc='.urlencode($docs->document_type);?>">View</a>
                                   <?php
                                }
                            else {
                                ?>
                                <a class="<?= btnclass("VIEW") ?>"
                                   href="<?php echo $this->request->webroot;?>documents/view/<?php echo $docs->client_id;?>/<?php echo $docs->id?>?order_id=<?php echo $docs->order_id;if($docs->sub_doc_id==4)echo '&doc='.urlencode($docs->document_type);?>">View</a>
                            <?php
                            }
                        } ?>
                        <?php
                            if ($sidebar->document_edit == '1') {
                                if ($docs->document_type == 'feedbacks')
                                    echo $this->Html->link(__('Edit'), ['controller' => 'feedbacks', 'action' => 'edit', $docs->id], ['class' => btnclass("EDIT")]);
                                else {
                                    if (!$docs->order_id){
                                        //echo $this->Html->link(__('Edit'), ['action' => 'add', $docs->client_id, $docs->id], ['class' => btnclass("EDIT")]);
                                        ?>
                                        <a class="<?= btnclass("EDIT") ?>"
                                           href="<?php echo $this->request->webroot;?>documents/add/<?php echo $docs->client_id;?>/<?php echo $docs->id?><?php if($docs->sub_doc_id==4)echo '?doc='.urlencode($docs->document_type);?>">Edit</a>
                                        <?php
                                    }else {
                                        ?>
                                        <a class="<?= btnclass("EDIT") ?>"
                                           href="<?php echo $this->request->webroot;?>documents/add/<?php echo $docs->client_id;?>/<?php echo $docs->id?>?order_id=<?php echo $docs->order_id;?>">Edit</a>
                                    <?php
                                    }
                                }
                            }
                        ?>
                        <?php if ($sidebar->document_delete == '1' && $docs->order_id == 0) {
                            if (!$this->request->session()->read('Profile.super') && $docs->user_id == $this->request->session()->read('Profile.id')) {
                                $dl_show = 1;
                            } else if ($this->request->session()->read('Profile.super')) {
                                $dl_show = 1;
                            } else $dl_show = 0;
                            if ($dl_show == 1) {
                                if (isset($_GET['draft'])) {
                                    ?>
                                    <a href="<?php echo $this->request->webroot; ?>documents/delete/<?php echo $docs->id; ?>/draft"
                                       onclick="return confirm('Are you sure you want to delete <?= $docname; ?>?');"
                                       class="<?= btnclass("DELETE") ?>">Delete</a>

                                <?php
                                } else {
                                    ?>
                                    <a href="<?php echo $this->request->webroot; ?>documents/delete/<?php echo $docs->id; ?>"
                                       onclick="return confirm('Are you sure you want to delete <?= $docname; ?>?');"
                                       class="<?= btnclass("DELETE") ?>">Delete</a>
                                <?php
                                }
                            }

                        }

                        ?>

                    </td>
                    <td><?php  if($docs->draft == 1) echo '<span class="label label-sm label-warning" style="float:right;padding:4px;">draft</span>';else echo '<span class="label label-sm label-success" style="float:right;padding:4px;">saved</span>';?></td>
                    </tr>

                    <!--TR><TD colspan="8"><!php print_r($docs); !></TD></TR-->

                    <?php endforeach; ?>
                    </tbody>
                    </table>

                </div>
            </div>

            <div class="form-actions" style="height:75px;">
                <div class="row">
                    <div class="col-md-12" align="right">


                        <div id="sample_2_paginate" class="dataTables_paginate paging_simple_numbers"
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
    $('.applyBtn').live('click', function () {
        var to = $('.daterangepicker_end_input .input-mini').val();
        var from = $('.daterangepicker_start_input .input-mini').val();
        var url = '<?php echo $this->request->webroot; ?>documents/index';
        var base = url;

        <?php
        if(isset($_GET['searchdoc']))
        {
        ?>
        if (url == base)
            url = url + '?searchdoc=<?php echo $_GET['searchdoc']?>';
        else
            url = url + '&searchdoc=<?php echo $_GET['searchdoc']?>';
        <?php
        }
        ?>
        <?php
        if(isset($_GET['submitted_by_id']))
        {
        ?>
        if (url == base)
            url = url + '?submitted_by_id=<?php echo $_GET['submitted_by_id']?>';
        else
            url = url + '&submitted_by_id=<?php echo $_GET['submitted_by_id']?>';
        <?php
        }
        ?>
        <?php
        if(isset($_GET['type']))
        {
        ?>
        if (url == base)
            url = url + '?type=<?php echo $_GET['type']?>';
        else
            url = url + '&type=<?php echo $_GET['type']?>';
        <?php
        }
        ?>
        <?php
        if(isset($_GET['client_id']))
        {
        ?>
        if (url == base)
            url = url + '?client_id=<?php echo $_GET['client_id']?>';
        else
            url = url + '&client_id=<?php echo $_GET['client_id']?>';
        <?php
        }
        ?>
        if (url == base) {
            url = url + '?to=' + to + '&from=' + from;
        }
        else
            url = url + '&to=' + to + '&from=' + from;
        window.location = url;
    });

    <?php if(isset($_GET['division'])&& $_GET['division']!=""){
    //var_dump($_GET);
    ?>
    var client_id = <?php echo $_GET['client_id'];?>;
    var division_id = <?php echo $_GET['division'];?>;
    //alert(client_id+'__'+division_id);
    if (client_id != "") {
        $.ajax({
            type: "post",
            data: "client_id=" + client_id,
            url: "<?php echo $this->request->webroot;?>clients/getdivisions/" + division_id,
            success: function (msg) {
//alert(msg);
                $('.clientdivision').html(msg);
            }
        });
    }
    <?php
    }?>
    $('.showclientdivision').change(function () {
        var client_id = $(this).val();
        if (client_id != "") {
            $.ajax({
                type: "post",
                data: "client_id=" + client_id,
                url: "<?php echo $this->request->webroot;?>clients/getdivisions",
                success: function (msg) {
                    $('.clientdivision').html(msg);
                }
            });
        }
    });
    var client_id = $('.showclientdivision').val();
    if (client_id != "") {
        $.ajax({
            type: "post",
            data: "client_id=" + client_id,
            url: "<?php echo $this->request->webroot;?>clients/getdivisions",
            success: function (msg) {
                $('.clientdivision').html(msg);
            }
        });
    }
</script>
