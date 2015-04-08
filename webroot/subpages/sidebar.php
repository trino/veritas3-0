<?php
$profileID = $this->Session->read('Profile.id');
 if(strlen($profileID)==0) {
  //  echo '<div class="alert alert-danger"><strong>Error!</strong> <a href="profiles/login">Your session has timed out, click here to log back in.</a></div>';

     header("Location: " . $this->request->webroot);

 }
    $sidebar = $this->requestAction("settings/all_settings/" . $profileID . "/sidebar");
    $order_url = $this->requestAction("settings/getclienturl/" . $profileID . "/order");
    $document_url = $this->requestAction("settings/getclienturl/" . $profileID . "/document");
    $ordertype = "MEE";
    if (isset($_GET["ordertype"])){ $ordertype = strtoupper($_GET["ordertype"]) ;}
?>

<div class="page-sidebar-wrapper">
 
    <div class="page-sidebar navbar-collapse collapse">
     <?php
 if($this->request->session()->read('debug'))
        echo "<span style ='color:red;'>sidebar.php #INC162</span>";
 ?>
        <ul id="mainbar" class="<?php echo $settings->sidebar; ?>" data-keep-expanded="false" data-auto-scroll="true"
            data-slide-speed="200">

            <li class="sidebar-search-wrapper margin-top-20">

                <form class="sidebar-search " action="<?php echo $this->request->webroot . 'documents'; ?>"
                      method="get">
                    <a href="javascript:;" class="remove">
                        <i class="icon-close"></i>
                    </a>

                    <div class="input-group">
                        <input type="text" name="searchdoc" class="form-control" placeholder="<?php echo ucfirst($settings->document); ?> Search...">
							<span class="input-group-btn">
							<a href="javascript:;" class="btn submit"><i class="icon-magnifier"></i></a>
							</span>
                    </div>
                </form>
                <!-- END RESPONSIVE QUICK SEARCH FORM -->
            </li>
            <li class="start <?php echo ($this->request['controller'] == 'Dashboard') ? 'active open' : ''; ?>">
                <a href="<?php echo WEB_ROOT; ?>">
                    <i class="icon-home"></i>
                    <span class="title">Dashboard </span>
                    <span class="selected"></span>

                </a>

            </li>

            <?php if ($sidebar->client == 1 && $this->request->session()->read('Profile.super')) { ?>

                <li class="<?php echo ($this->request['controller'] == 'Clients' && !isset($_GET['draft']) && $this->request['action'] != 'quickcontact') ? 'active open' : ''; ?>">
                    <a href="<?php echo WEB_ROOT; ?>clients">
                        <i class="icon-globe"></i>
                        <span class="title"><?php echo ucfirst($settings->client); ?>s</span>
                        <?php echo ($this->request['controller'] == 'Clients') ? '<span class="selected"></span>' : ''; ?>
                        <span class="arrow "></span>
                    </a>
                    <?php if ($sidebar->client_list == 1 || $sidebar->client_create == 1) { ?>
                        <ul class="sub-menu">
                            <?php if ($sidebar->client_list == 1) { ?>
                                <li <?php echo ($this->request['controller'] == 'Clients' && $this->request['action'] == 'index' && !isset($_GET["draft"]) ) ? 'class="active"' : ''; ?>>
                                    <a href="<?php echo WEB_ROOT; ?>clients">
                                        <i class="icon-list"></i>
                                        List <?php echo ucfirst($settings->client); ?>s</a>
                                </li>
                                
                            <?php }
                                if ($sidebar->client_create == 1) {
                                    ?>

                                    <li <?php echo ($this->request['controller'] == 'Clients' && $this->request['action'] == 'add') ? 'class="active"' : '';?>>
                                        <a href="<?php echo WEB_ROOT;?>clients/add">
                                            <i class="icon-plus"></i>
                                            Create <?php echo ucfirst($settings->client);?></a>
                                    </li>

                                <?php
                                }
								if ($sidebar->client_list == 1) { ?>
								
								
								<!--li <?php echo ($this->request['controller'] == 'Clients' && $this->request['action'] == 'index' && isset($_GET["draft"]) ) ? 'class="active"' : ''; ?>>
                                    <a href="<?php echo $this->request->webroot; ?>clients/index?draft">
                                        <i class="fa fa-pencil"></i>
                                        <?php echo ucfirst($settings->client); ?> Drafts</a>
                                </li-->
								
								<?php }     ?>




                        </ul>
                    <?php } ?>
                </li>
            <?php } ?>
            <?php if ($sidebar->profile == 1) { ?>
                <li class="<?php echo ($this->request['controller'] == 'Profiles' && !isset($_GET['draft']) && $this->request['action'] != 'logo' && $this->request['action'] != 'todo') ? 'active open' : ''; ?>">
                    <a href="<?php echo WEB_ROOT; ?>profiles">
                        <i class="icon-user"></i>
                        <span class="title"><?php echo ucfirst($settings->profile); ?>s</span>
                        <?php echo ($this->request['controller'] == 'Profiles') ? '<span class="selected"></span>' : ''; ?>

                        <span class="arrow "></span>
                    </a>
                    <?php if ($sidebar->profile_list == 1 || $sidebar->profile_create == 1) { ?>
                        <ul class="sub-menu">
                            <?php if ($sidebar->profile_list == 1) { ?>
                                <li <?php echo ($this->request['controller'] == 'Profiles' && $this->request['action'] == 'index' && !isset($_GET["draft"]) ) ? 'class="active"' : ''; ?>>
                                    <a href="<?php echo WEB_ROOT; ?>profiles">
                                        <i class="icon-list"></i>
                                        List <?php echo ucfirst($settings->profile); ?>s</a>
                                </li>

                                <!--li <?php echo ($this->request['controller'] == 'Profiles' && $this->request['action'] == 'index' && !isset($_GET["draft"]) ) ? 'class="active"' : ''; ?>>
                                    <a href="<?php echo WEB_ROOT; ?>profiles?all">
                                        <i class="icon-list"></i>
                                        List All <?php echo ucfirst($settings->profile); ?>s</a>
                                </li-->
                            <?php } ?>
                            <?php if ($sidebar->profile_create == 1) { ?>
                                <li <?php echo ($this->request['controller'] == 'Profiles' && $this->request['action'] == 'add') ? 'class="active"' : ''; ?>>
                                    <a href="<?php echo WEB_ROOT; ?>profiles/add">
                                        <i class="icon-plus"></i>
                                        Create <?php echo ucfirst($settings->profile); ?></a>
                                </li>
                            <?php } ?>
						<?php if ($sidebar->profile_create == 1 && 1+1==3) { ?>
                                <li <?php echo ($this->request['controller'] == 'Profiles' && $this->request['action'] == 'index' && isset($_GET["draft"]) ) ? 'class="active"' : ''; ?>>
                                    <a href="<?php echo WEB_ROOT; ?>profiles/index?draft">
                                        <i class="fa fa-pencil"></i>
                                        <?php echo ucfirst($settings->profile); ?> Drafts</a>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php } ?>
                </li>
            <?php } ?>

            <?php if ($sidebar->document == 1) { ?>
                <li class="<?php echo (($this->request['controller'] == 'Documents' && ($this->request['action'] == "index" || $this->request['action'] == "add")) && !isset($_GET['draft'])) ? 'active open' : ''; ?>">
                    <a href="<?php echo $this->request->webroot; ?>documents/index">
                        <i class="icon-doc"></i>
                        <span class="title"><?php echo ucfirst($settings->document); ?>s</span>
                        <?php echo ($this->request['controller'] == 'Documents') ? '<span class="selected"></span>' : ''; ?>
                        <span class="arrow "></span>
                    </a>
                    <?php if ($sidebar->document_list == 1 || $sidebar->document_create == 1) { ?>
                        <ul class="sub-menu">
                            <?php if ($sidebar->document_list == 1) { ?>
                                <li <?php echo ($this->request['controller'] == 'Documents' && $this->request['action'] == 'index' && !isset($_GET['draft'])) ? 'class="active"' : ''; ?>>
                                    <a href="<?php echo $this->request->webroot; ?>documents/index">
                                        <i class="icon-list"></i>
                                        List <?php echo ucfirst($settings->document); ?>s</a>
                                </li>
                            <?php } ?>
                            <?php if ($sidebar->document_create == 1) { ?>
                                <li <?php echo ($this->request['controller'] == 'Documents' && $this->request['action'] == 'add' && !isset($_GET['draft'])) ? 'class="active"' : ''; ?>>
                                    <a href="<?php echo $this->request->webroot . $document_url; ?>">
                                        <i class="icon-plus"></i>
                                        Create <?php echo ucfirst($settings->document); ?></a>
                                </li>

                            <?php } ?>
							<?php if ($sidebar->document_list == 1 && false) { ?>
                                <li <?php echo ($this->request['controller'] == 'Documents' && $this->request['action'] == 'index' && isset($_GET['draft'])) ? 'class="active"' : ''; ?>>
                                    <a href="<?php echo $this->request->webroot; ?>documents/index?draft">
                                        <i class="fa fa-pencil"></i>
                                        <?php echo ucfirst($settings->document); ?> Drafts</a>
                                </li>
                            <?php } 

                            ?>

                        </ul>
                    <?php } ?>
                </li>
            <?php }           ?>

            </li>
            <?php if ($sidebar->orders == 1) { ?>
                <li class="<?php echo (($this->request['action'] == 'orderslist' || $this->request['action'] == 'addorder') && !isset($_GET['draft'])) ? 'active open' : ''; ?>">
                    <a href="<?php echo $this->request->webroot; ?>orders/orderslist">
                        <i class="icon-docs"></i>
                        <span class="title">Orders</span>
                        <span class="selected"></span>
                        <span class="arrow "></span>
                    </a>
                    <?php if ($sidebar->orders_list == 1 || $sidebar->orders_create == 1) { ?>
                        <ul class="sub-menu">
                            <?php if ($sidebar->orders_list == 1) { ?>
                                <li <?php echo ($this->request['controller'] == 'Orders' && $this->request['action'] == 'orderslist' && !isset($_GET['draft'])) ? 'class="active"' : ''; ?>>
                                    <a href="<?php echo $this->request->webroot; ?>orders/orderslist">
                                        <i class="icon-list"></i>
                                        List Orders</a>
                                </li>
                            <?php } ?>

                            <?php if ($sidebar->orders_create == 1) { 
                                if ($sidebar->orders_mee == 1){
                                    foreach($productlist as $product){
                                        $alias = $product->Sidebar_Alias;
                                        if($sidebar->$alias ==1) {
                                            echo "<LI ";
                                            if ($this->request['controller'] == 'Orders' && $this->request['action'] == 'productSelection' && $ordertype == $product->Acronym && !isset($_GET['draft'])) {
                                                echo 'class="active"';
                                            }
                                            echo '><a href="';
                                            /*echo $this->request->webroot . $order_url;*/
                                            echo $this->request->webroot . "orders/productSelection?driver=0&ordertype=" . $product->Acronym . '">';
                                            echo '<i class="icon-plus"></i> ';
                                            echo $product->Name . "</a></li>";
                                        }
                                    }
                                }
                            } ?>
                        </ul>
                    <?php } ?>
                </li>
            <?php } ?>
            <?php if ($sidebar->messages == 1) { ?>
                <!--li class="<?php echo ($this->request['controller'] == 'Messages') ? 'active open' : ''; ?>">
                    <a href="<?php echo $this->request->webroot; ?>Messages">
                        <i class="icon-envelope"></i>
                        <span class="title">Messages</span>
                        <span class="selected"></span>
                    </a>
                </li-->
            <?php }

            ?>
             <?php if ($sidebar->analytics == 1) { ?>
                <li class="<?php echo ($this->request['action'] == 'analytics') ? 'active open' : ''; ?>">
                    <a href="<?php echo $this->request->webroot; ?>documents/analytics">
                        <i class="fa fa-bar-chart-o"></i>
                        <span class="title">Analytics</span>
                        <span class="selected"></span>
                    </a>
                </li>
            <?php } ?>
             <?php if ($sidebar->schedule == 1) { ?>
                <li class="<?php echo ($this->request['controller'] == 'Tasks') ? 'active open' : ''; ?>">
                    <a href="<?php echo $this->request->webroot;?>tasks/calender">
                        <i class="fa fa-calendar"></i>
                        <span class="title">Tasks</span>
                        <span class="selected"></span>
                    </a>
                    <ul class="sub-menu">
                            <li <?php echo ($this->request['controller'] == 'Tasks' && $this->request['action'] == 'calender') ? 'class="active"' : ''; ?>>
                                <a href="<?php echo $this->request->webroot;?>tasks/calender">
                                    <i class="icon-plus"></i>
                                    Calender</a>
                            </li>
                    <?php if ($sidebar->schedule_add =='1') { ?>
                            <li <?php echo ($this->request['controller'] == 'Tasks' && $this->request['action'] == 'add') ? 'class="active"' : ''; ?>>
                                <a href="<?php echo $this->request->webroot;?>tasks/add">
                                    <i class="icon-plus"></i>
                                    Add Tasks</a>
                            </li>
                    <?php } ?>
                    </ul>
                </li>
            <?php } ?>
            <?php if ($sidebar->training == 1) { ?>
                <li class="<?php echo ($this->request['controller'] == 'Training') ? 'active open' : ''; ?>">
                    <a href="<?php echo $this->request->webroot; ?>training">
                        <i class="fa fa-graduation-cap"></i>
                        <span class="title">Training</span>
                        <span class="selected"></span>
                    </a>
                    <ul class="sub-menu">
                                <li <?php echo ($this->request['controller'] == 'Training' && $this->request['action'] == 'index') ? 'class="active"' : ''; ?>>
                                    <a href="<?php echo $this->request->webroot;?>training">
                                        <i class="icon-plus"></i>
                                        Courses</a>
                                </li>
                        <?php if ($this->request->session()->read('Profile.super') or $this->request->session()->read('Profile.admin')) { ?>
                                <li <?php echo ($this->request['controller'] == 'Training' && $this->request['action'] == 'users') ? 'class="active"' : ''; ?>>
                                    <a href="<?php echo $this->request->webroot;?>training/users">
                                        <i class="icon-plus"></i>
                                        Quiz Results</a>
                                </li>
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>
             <?php /*if ($sidebar->bulk == 1) { ?>
                <li class="<?php echo ($this->request['controller'] == 'Profiles') ? 'active open' : ''; ?>">
                    <a href="<?php echo $this->request->webroot; ?>profiles">
                        <i class="fa fa-calendar"></i>
                        <span class="title">Bulk Order</span>
                        <span class="selected"></span>
                    </a>
                </li>
            <?php }*/ ?>

            <?php if ($sidebar->logo == '1') { ?>
                <li class="sidebar-toggler-wrapper">
                    <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                    <!--<div class="sidebar-toggler">
                    </div>-->
                    <!-- END SIDEBAR TOGGLER BUTTON -->
                    <?php $logo1 = $this->requestAction('Logos/getlogo/1'); ?>
                    <div class="whitecenterdiv">A service division of</div>

                    <img src="<?php echo $this->request->webroot . 'img/logos/' . $logo1; ?>" class="secondary_logo"/>
                </li>
            <?php } ?>
        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
</div>