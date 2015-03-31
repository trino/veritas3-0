<?php
    $settings = $this->requestAction('settings/get_settings');
    $sidebar = $this->requestAction("settings/get_side/" . $this->Session->read('Profile.id'));


    if ($_SERVER['SERVER_NAME'] == "localhost" || $_SERVER['SERVER_NAME'] == "127.0.0.1") {
        include_once('/subpages/api.php');
    } else {
        include_once('subpages/api.php');
    } ?>

<h3 class="page-title">
    Orders <?php if (isset($_GET['draft'])) { ?>(Draft)<?php } ?>
</h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="<?php echo $this->request->webroot; ?>">Dashboard</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="">Orders</a>
        </li>
    </ul>
    <div class="page-toolbar">

    </div>
    <a href="javascript:window.print();" class="floatright btn btn-info">Print</a>

    <?php
        if ($sidebar->orders_list == 1 && !isset($_GET["draft"])) {
            ?>
            <a href="<?php echo $this->request->webroot; ?>orders/orderslist?draft"
               class="floatright btn btn-warning btnspc">
                List Order Drafts</a>
        <?php } elseif (isset($_GET["draft"])) { ?>
            <a href="<?php echo $this->request->webroot; ?>orders/orderslist" class="floatright btn btn-warning btnspc">
                List All Orders</a>
        <?php }
        if ($sidebar->orders_mee == 1) { ?>
            <a href="<?php /*echo $this->request->webroot . $order_url;*/
                echo $this->request->webroot; ?>orders/productSelection?driver=0&ordertype=MEE"
               class="floatright btn red btnspc">
                Order MEE</a>
        <?php }
        if ($sidebar->orders_create == 1) {
            if ($sidebar->order_requalify == 1) {
                ?>
                <a href="<?php echo $this->request->webroot; ?>orders/productSelection?driver=0&ordertype=QUA"
                   class="floatright btn btn-primary btnspc">
                    Re-Qualify </a>
            <?php }
            if ($sidebar->orders_products == 1) {
                ?>
                <a href="<?php echo $this->request->webroot; ?>orders/productSelection?driver=0&ordertype=CART"
                   class="floatright btn green-haze btnspc" color="#36d7ac">
                    Order Products </a>
            <?php }
        }
    ?>


</div>


<div class="row">
    <div class="col-md-12">
        <div class="portlet box yellow">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-clipboard"></i>
                    List Orders
                </div>
            </div>
            <div class="portlet-body form">


                <div class="form-actions top chat-form" style="margin-bottom:0;" align="right">

                    <div class="btn-set pull-left">

                    </div>
                    <div class="btn-set pull-right">

                        <form action="<?php echo $this->request->webroot; ?>orders/orderslist" method="get">
                            <?php if (isset($_GET['draft'])) { ?><input type="hidden" name="draft"/><?php } ?>
                            <?php
                                $users = $doc_comp->getAllUser();
                            ?>
                            <select class="form-control input-inline" name="submitted_by_id" style="">
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
                            <select class="form-control input-inline" name="uploaded_for" style="">
                                <option value="">Uploaded For</option>
                                <?php
                                    foreach ($users as $u) {
                                        //if($u->profile_type == '5' || $u->profile_type == '7' || $u->profile_type == '8'){
                                        ?>
                                        <option
                                            value="<?php echo $u->id; ?>" <?php if (isset($_GET['uploaded_for']) && $_GET['uploaded_for'] == $u->id) { ?> selected="selected"<?php } ?> ><?php echo ucfirst($u->fname) . " " . ucfirst($u->lname); ?></option>
                                        <?php
                                        //}
                                    }
                                ?>
                            </select>

                            <?php
                                $clients = $doc_comp->getAllClient();
                            ?>
                            <select class="form-control showdivision input-inline" name="client_id">
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

                            <div class=" divisions input-inline" style="">
                                <!-- Divisions section -->
                            </div>

                            <input class="form-control input-inline" name="searchdoc" type="search"
                                   placeholder="Search Orders"
                                   value="<?php if (isset($search_text)) echo $search_text; ?>"
                                   aria-controls="sample_1"/>


                            <button type="submit" class="btn btn-primary input-inline">Search</button>


                        </form>
                    </div>
                </div>


                <div class="clearfix"></div>

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

                <div class="form-body">
                    <div class="table-scrollable">
                        <table
                            class="table table-condensed table-striped table-bordered table-hover dataTable no-footer">
                            <thead>
                            <tr class="sorting">
                                <th><?= $this->Paginator->sort('id'); ?></th>
                                <th><?= $this->Paginator->sort('orders.order_type', "Order Type"); ?></th>
                                <th><?= $this->Paginator->sort('user_id', 'Recruiter'); ?></th>
                                <th><?= $this->Paginator->sort('uploaded_for', 'Driver'); ?></th>
                                <th><?= $this->Paginator->sort('client_id', ucfirst($settings->client)); ?></th>
                                <th>Division</th>
                                <th><?= $this->Paginator->sort('created', 'Created'); ?></th>
                                <th class="actions"><?= __('Actions') ?></th>
                                <!--th><?= $this->Paginator->sort('bright_planet_html_binary', 'Status'); ?></th-->
                                <th><?= $this->Paginator->sort('complete', 'Status'); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                $row_color_class = "odd";

                                function hasget($name)
                                {
                                    if (isset($_GET[$name])) {
                                        return strlen($_GET[$name]) > 0;
                                    }
                                    return false;
                                }

                                if (count($orders) == 0) {
                                    echo '<TR><TD COLSPAN="10" ALIGN="CENTER">No orders found';
                                    if (hasget('searchdoc')) {
                                        echo " matching '" . $_GET['searchdoc'] . "'";
                                    }
                                    echo '</TD></TR>';
                                }

                                foreach ($orders as $order):

                                    if ($row_color_class == "even") {
                                        $row_color_class = "odd";
                                    } else {
                                        $row_color_class = "even";
                                    }
                                    if ($order->user_id) {
                                        $uploaded_by = $doc_comp->getUser($order->user_id);
                                    }
                                    if ($order->uploaded_for) {
                                        $uploaded_for = $doc_comp->getUser($order->uploaded_for);
                                    }
                                    $client = $this->requestAction("clients/getClient/" . $order->client_id);
                                    ?>
                                    <tr class="<?= $row_color_class; ?>" role="row">
                                        <td><?= $this->Number->format($order->id);
                                                if ($order->hasattachments) {
                                                    echo '<BR><i  title="Has Attachment" class="fa fa-paperclip"></i>';
                                                }  //echo $order->profile->title;      ?></td>
                                        <td style="min-width: 125px;">

                                            <?php
                                                if ($order->order_type) {
                                                    echo '<div style="" class="dashboard-stat ';
                                                    $colors = array("Order_Products" => "green-haze", "Order_MEE" => "red-intense", "ReQualify" => "blue-madison");
                                                    if (isset($colors[str_replace(' ', '_', $order->order_type)])) {
                                                        echo $colors[str_replace(' ', '_', $order->order_type)];
                                                    } else {
                                                        echo "blue";
                                                    }
                                                    ?>">
                                                    <!--div class="whiteCorner"></div-->
                                                    <!--div class="visual" style="height: 40px;">
                                                        <i class="fa fa-copy"></i>
                                                    </div-->
                                                    <!--div class="details"> //WARNING: This won't work while in a table...
                                                        <div class="number"></div>
                                                        <div class="desc"></div>
                                                    </div-->
                                                    <a class="more" id="sub_doc_click1"
                                                       href="<?php if ($sidebar->document_list == '1' && !isset($_GET["draft"])) {

                                                           echo $this->request->webroot . 'orders/vieworder/' . $order->client_id . '/' . $order->id;
                                                           if ($order->order_type) {
                                                               echo '?order_type=' . urlencode($order->order_type);
                                                               if ($order->forms) echo '&forms=' . $order->forms;
                                                           }

                                                       } else {
                                                           if ($sidebar->document_list == '1') {
                                                               echo $this->request->webroot . 'orders/addorder/' . $order->client_id . '/' . $order->id;
                                                               if ($order->order_type) {
                                                                   echo '?order_type=' . urlencode($order->order_type);
                                                                   if ($order->forms) echo '&forms=' . $order->forms;
                                                               }
                                                           } else { ?>javascript:;<?php }
                                                       } ?>">

                                                        <i class="fa fa-copy"></i>



                                                        <?= h($order->order_type); //it won't let me put it in the desc   ?>
                                                    </a>
                                                    <?php echo "</div>";
                                                } else {
                                                    echo "Unknown";
                                                }
                                                //if($order->draft == 1) echo ' (Draft)';
                                            ?>


                                        </td>
                                        <td><?php if (isset($uploaded_by)) echo '<a href="' . $this->request->webroot . 'profiles/view/' . $order->user_id . '" target="_blank">' . ucfirst(h($uploaded_by->username));?></td>
                                        <td><?php if (isset($uploaded_for)) echo '<a href="' . $this->request->webroot . 'profiles/view/' . $order->uploaded_for . '" target="_blank">' . h(ucfirst($uploaded_for->fname) . ' ' . ucfirst($uploaded_for->mname) . ' ' . ucfirst($uploaded_for->lname)) . "</a>" ?></td>
                                        <td><?php
                                                if (is_object($client)) {
                                                    echo "<a href ='" . $this->request->webroot . "clients/edit/" . $order->client_id . "?view' target='_blank'>" . ucfirst(h($client->company_name)) . "</a>";
                                                } else {
                                                    echo "Deleted " . $settings->client;
                                                }
                                            ?></td>
                                        <td><?php if ($order->division) {
                                                $div = $doc_comp->getDivById($order->division);
                                                if (is_object($div)) {
                                                    echo ucfirst($div->title);
                                                } elseif ($this->request->session()->read('Profile.profile_type') == 1) {
                                                    echo "Missing division: " . $order->division; //only shows for admins
                                                }
                                            } else {
                                                echo '';
                                            } ?></td>

                                        <td><?= h($order->created) ?></td>
                                        <td class="actions  util-btn-margin-bottom-5">

                                            <?php
                                                if ($sidebar->orders_list == '1' && $order->draft != 1) {
                                                    ?>
                                                    <a class="<?= btnclass("VIEW") ?>"
                                                       href="<?php echo $this->request->webroot; ?>orders/vieworder/<?php echo $order->client_id; ?>/<?php echo $order->id;
                                                           if ($order->order_type) {
                                                               echo '?order_type=' . urlencode($order->order_type);
                                                               if ($order->forms) echo '&forms=' . $order->forms;
                                                           } ?>">View</a>
<?php
//if (!isset($_GET['table']))
//echo $this->Html->link(__('View'), ['action' => 'vieworder', $order->client_id, $order->id], ['class' => 'btn btn-info']);
                                                    /*else
                                                    echo $this->Html->link(__('View'), ['action' => 'vieworder', $order->client_id, $order->id, $_GET['table']], ['class' => 'btn btn-info']);*/
                                                } ?>

                                            <?php
                                                $super = $this->request->session()->read('Profile.super');
                                                //if (isset($super) || isset($_GET['draft'])) {
                                                    if ($sidebar->orders_edit == '1') {
                                                        if (!isset($_GET['table']) && $order->draft == 1) {
                                                            ?>
                                                            <a class="<?= btnclass("EDIT") ?>"
                                                               href="<?php echo $this->request->webroot; ?>orders/addorder/<?php echo $order->client_id; ?>/<?php echo $order->id;
                                                                   if ($order->order_type) {
                                                                       echo '?order_type=' . urlencode($order->order_type);
                                                                       if ($order->forms) echo '&forms=' . $order->forms;
                                                                   } ?>">Edit</a>
<?php
//echo $this->Html->link(__('Edit'), ['controller' => 'orders', 'action' => 'addorder', $order->client_id, $order->id], ['class' => 'btn btn-primary']);
                                                        } /*elseif (isset($_GET['table'])) {
echo $this->Html->link(__('Edit'), ['controller' => 'orders', 'action' => 'addorder', $order->client_id, $order->id, $_GET['table']], ['class' => 'btn btn-primary']);
}*/

                                                    }
                                                    if (isset($super) || (isset($_GET['draft']) && $this->request->session()->read('Profile.id') == $order->user_id)) {
                                                        ?><a
                                                        href="<?php echo $this->request->webroot; ?>orders/deleteorder/<?php echo $order->id; ?><?php if (isset($_GET['draft'])) echo "?draft"; ?>"
                                                        class="<?= btnclass("DELETE") ?>"
                                                        onclick="return confirm('Are you sure you want to delete order <?= $order->id ?>?');">
                                                            Delete</a>
                                                    <?php
                                                    }
                                                //}
                                            ?>

                                            <?php if ($sidebar->orders_requalify == '1' && $order->draft == '0') {
                                                ?>
                                                <!--a class="clearfix btn btn-warning" href="<?php echo $this->request->webroot; ?>documents/productSelection?driver=<?php echo $order->uploaded_for; ?>"/>Re-qualify</a-->
                                            <?php
                                            }
                                            ?>
                                            <?php if (!isset($_GET['draft']) && is_object($order->profile) && ($order->draft == 0)) {
                                                ?>
                                                <a href="<?php echo $this->request->webroot; ?>profiles/view/<?php echo $order->profile->id ?>?getprofilescore=1"
                                                   class="<?= btnclass("btn-success", "green-haze") ?>">Score Card</a>
                                            <?php
                                            } ?>
                                            <?php //if (!isset($_GET['draft'])) echo $this->Html->link(__('Score Card'), ['controller' => 'orders', 'action' => 'viewReport', $order->client_id, $order->id], ['class' => 'btn btn-success']);
                                            ?>
                                        </td>


                                        <td valign="middle">
                                            <?php
                                            //   var_dump($order);
                                            if($order->draft == 1)
                                            {
                                                ?>
                                                 <span class="label label-sm label-warning"
                                                          style="float:right;padding:4px;">draft</span>
                                                <?php
                                                
                                            }else
                                                if ($order->complete == 0) { 
                                                    ?>
                                                
                                                
                                                
                                                    <span class="label label-sm label-primary"
                                                          style="float:right;padding:4px;">pending</span>
                                                <?php 

                                            } else { ?>
                                                <span class="label label-sm label-success"
                                                      style="float:right;padding:4px;">complete</span>
                                            <?php } ?>
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
<script>
    $(function () {
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
                    $('.divisions').html(msg);
                }
            });
        }
        <?php
        }
        //if(isset($_GET['division'])&& $_GET['division']!="")
        ?>

        $('.showdivision').change(function () {
            var client_id = $(this).val();
            if (client_id != "") {
                $.ajax({
                    type: "post",
                    data: "client_id=" + client_id,
                    url: "<?php echo $this->request->webroot;?>clients/getdivisions",
                    success: function (msg) {
                        $('.divisions').html(msg);
                    }
                });
            }
        });
        var client_id = $('.showdivision').val();
        if (client_id != "") {
            $.ajax({
                type: "post",
                data: "client_id=" + client_id,
                url: "<?php echo $this->request->webroot;?>clients/getdivisions",
                success: function (msg) {
                    $('.divisions').html(msg);
                }
            });
        }

    });
</script>
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