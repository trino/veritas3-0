<?php
$debug=$this->request->session()->read('debug');
if($debug)
    echo "<span style ='color:red;'>home_topblocks.php #INC112</span>";

?>
<?php
    $userid=$this->Session->read('Profile.id');
    $block = $this->requestAction("settings/all_settings/".$userid."/blocks");
    $sidebar = $this->requestAction("settings/all_settings/".$userid."/sidebar");
    //$order_url = $this->requestAction("settings/getclienturl/".$this->Session->read('Profile.id')."/order");
    $order_url = 'orders/productSelection?driver=0';
    $document_url = $this->requestAction("settings/getclienturl/".$userid."/document");

$lastcolor = "";
function randomcolor(){
    global $lastcolor;
    $colors = array("bg-green-meadow", "bg-red-sunglo", "bg-yellow-saffron", "bg-purple-studio", "bg-green", "bg-grey-cascade");
    $newcolor = $colors[rand(0, count($colors)-1)];
    while($newcolor == $lastcolor){
        $newcolor = $colors[rand(0, count($colors)-1)];
    }
    $lastcolor = $newcolor;
    echo $newcolor;
    srand();
}
?>

<div class="tiles">


    <?php if ($sidebar->client_list ==1 && $block->list_client =='1') { ?>
        <a href="<?php echo $this->request->webroot; ?>clients" class="tile bg-grey-cascade" style="display: block;">
            <div class="tile-body">
                <i class="fa fa-search"></i>
            </div>
            <div class="tile-object">
                <div class="name">List <?=$settings->client;?>s</div>
                <div class="number"></div>
            </div>
        </a>
    <?php } ?>
    <?php if ($sidebar->client_create ==1 && $block->add_client =='1') { ?>
        <a class="tile bg-grey-cascade" href="<?php echo $this->request->webroot; ?>clients/add" style="display: block;">
            <div class="tile-body">
                <i class="icon-globe"></i>
            </div>
            <div class="tile-object">
                <div class="name">Create <?=$settings->client;?></div>
                <div class="number"></div>
            </div>
        </a>
    <?php } ?>



    <?php if ($sidebar->client_list ==1 && $block->draft_client =='1' && false) { ?>
        <a href="<?php echo $this->request->webroot; ?>clients?draft" class="tile bg-grey-cascade" style="display: block;">
            <div class="tile-body">
                <i class="fa fa-pencil"></i>
            </div>
            <div class="tile-object">
                <div class="name"> <?=$settings->client;?> Drafts</div>
                <div class="number"></div>
            </div>
        </a>
    <?php } ?>



    <?php if ($sidebar->profile_list ==1 && $block->list_profile =='1') { ?>
        <a href="<?php echo $this->request->webroot; ?>profiles" class="tile bg-grey-cascade" style="display: block;">
            <div class="tile-body">
                <i class="fa fa-search"></i>
            </div>
            <div class="tile-object">
                <div class="name">List <?=$settings->profile;?>s</div>
                <div class="number"></div>
            </div>
        </a>
    <?php } ?>
    <?php if ($sidebar->profile_create ==1 && $block->addadriver =='1') { ?>
        <a class="tile bg-grey-cascade" href="<?php echo $this->request->webroot; ?>profiles/add" style="display: block;">
            <div class="tile-body">
                <i class="icon-user"></i>
            </div>
            <div class="tile-object">
                <div class="name">Create <?=$settings->profile;?></div>
                <div class="number"></div>
            </div>
        </a>
    <?php } ?>
    <?php  if ($sidebar->profile_list ==1 && $block->draft_profile =='1' && false) { ?>
		<a href="<?php echo $this->request->webroot; ?>profiles?draft" class="tile bg-grey-cascade" style="display: block;">
            <div class="tile-body">
                <i class="fa fa-pencil"></i>
            </div>
            <div class="tile-object">
                <div class="name"><?=$settings->profile;?> Drafts</div>
                <div class="number"></div>
            </div>
        </a>
    <?php } ?>





    <?php if ($sidebar->document_list ==1 && $block->list_document =='1') { ?>
        <a href="<?php echo $this->request->webroot; ?>documents" class="tile bg-grey-cascade" style="display: block;">
            <div class="tile-body">
                <i class="fa fa-search"></i>
            </div>
            <div class="tile-object">
                <div class="name">List <?=$settings->document;?>s</div>
                <div class="number"></div>
            </div>
        </a>
    <?php } ?>

    <?php if ($sidebar->orders_list ==1 && $block->list_order =='1') { ?>
        <a href="<?php echo $this->request->webroot; ?>orders/orderslist" style="display: block;" class="tile bg-grey-cascade">
            <div class="tile-body">
                <i class="fa fa-search"></i>
            </div>
            <div class="tile-object">
                <div class="name">List Orders</div>
                <div class="number"></div>
            </div>
        </a>
    <?php } ?>
    <?php if ($sidebar->order_intact ==1 && $block->orders_intact =='1') { ?>
        <a class="tile bg-blue-ebonyclay" href="<?php echo $this->request->webroot; ?>orders/intact" style="display: block;">
            <div class="tile-body">
                <i class="fa fa-pencil"></i>
            </div>
            <div class="tile-object">
                <div class="name">Intact Orders</div>
                <div class="number"></div>
            </div>
        </a>
    <?php } ?>

    <?php if ($sidebar->orders_create ==1) { ?>
        <!--<a href="<?php echo $this->request->webroot.$order_url.'&ordertype=MEE';?>" class="tile bg-yellow" style="display: block;">
            <div class="tile-body">
                <i class="icon-docs"></i>
            </div>
            <div class="tile-object">
                <div class="name">Create Order</div>
                <div class="number"></div>
            </div>
        </a>-->
        <STYLE>
            .icon-footprint:before { content: url('assets/global/img/footprint.png'); }
            .icon-surveillance:before { content: url('assets/global/img/surveillance.png'); }
            .icon-physical:before { content: url('assets/global/img/physical.png'); }
        </STYLE>


    <?php
        $formlist="";
        foreach($forms as $form){
            if (Strlen($formlist)>0){ $formlist.=",";}
            $formlist.=$form->number;
        }

        function makeblock($debug, $URL, $Name, $Icon = "icon-docs", $Color= "bg-grey-cascade"){//tile
            if(!$debug){$Color= "bg-grey-cascade";}
            if(!$Icon){$Icon = "icon-docs";}
            echo '<a href="' .  $URL . '" class="tile ' . $Color;
            echo '" style="display: block;"><div class="tile-body"><i class="' . $Icon . '"></i></div><div class="tile-object">';
            echo '<div class="name">' . $Name . '</div><div class="number"></div></div></a>';
        }

        $AssignedClient = GetAssignedClients($userid, $clients, true);
        if($AssignedClient){$AssignedClient= $AssignedClient->id;} else {$AssignedClient="";}

        $MEEname="";
        if($AssignedClient) {
            foreach($products as $product){
                //http://localhost/veritas3-0/orders/productSelection?driver=0&ordertype=MEE

                if ($product->Blocks_Alias) {
                    $sidebaralias = $product->Sidebar_Alias;
                    $blockalias = $product->Blocks_Alias;
                    //$blockaliasbypass= $blockalias . "b";
                    if ($product->Acronym == "MEE"){$MEEname = $product->Name;}
                    if ($blockalias && $block->$blockalias =='1' && $product->Visible==1) {
                        $URL="orders/productSelection?driver=0&ordertype=" . $product->Acronym;//ie: http://localhost/veritas3-0/orders/productSelection?driver=0&ordertype=MEE
                        //if($block->$blockaliasbypass==1){//ie: http://localhost/veritas3-0/orders/addorder/1/?driver=132&division=1&order_type=Driver+Order&forms=99
                        //    $URL="orders/addorder/1/?driver=" . $userid . "&order_type=" . $product->Name . "&forms=".$formlist;
                        //}

                        //http://localhost/veritas3-0/orders/addorder/1/?driver=0&order_type=Single+Product&forms=31
                        if($product->Bypass==1) {//change to ->Bypass When the parameter exists
                            $URL = "orders/addorder/" . $AssignedClient . "/?driver=0&order_type=" . $product->Acronym . "&forms=" . $product->doc_ids;
                        }
                        makeblock($debug, $URL, $product->Name, $product->Icon, "bg-green");
                    }
                }
            }



            $URL="orders/addorder/" . $AssignedClient . "/?driver=0&order_type=Single+Product&forms=";
            //makeblock($debug, $URL . "501&SpecificForm=footprint", "Footprint", "fa icon-footprint", "bg-red");
            //makeblock($debug, $URL . "surveillance", "Surveillance", "fa icon-surveillance", "bg-red");
            //makeblock($debug, $URL . "physical", "Physical", "fa icon-physical", "bg-red");
//makeblock($debug, $URL .  501, $sub->title, "icon-docs", "bg-blue");//$sub->id

            $subdoc = $this->requestAction('/profiles/getSub/' . $userid);
            //$URL = "orders/addorder/1/?driver=" . $userid . "&order_type=" . $MEEname . "&forms=" . $formlist . "&onlyshow=";
            //$URL = "documents/add/" . $AssignedClient . "?type=";
            foreach ($subdoc as $sub) {
                //$prosubdoc = $this->requestAction('/settings/all_settings/0/0/profile/' . $userid . '/' . $sub->id);
                $prosubdoc = FindIterator($subdoc->Subdocs, "subdoc_id", $sub->id);
                if ($prosubdoc->Topblock == 1) {
                    makeblock($debug, $this->request->webroot . $URL . $sub->forms, $sub->title, $sub->icon, "bg-blue");//$sub->id
                }
            }
        }


        foreach($theproductlist as $product){
            if($product->enable == 1 && $product->TopBlock == 1) {
                //$URL="orders/addorder/1/?driver=" . $userid . "&division=9&order_type=Not+Applicable&forms=" . $product->number;
                $URL="documents/add/1?type=" . $product->number;
                makeblock($debug, $this->request->webroot . $URL, $product->title, "icon-docs", "bg-yellow");
            }
        }
    }
/*
    $URL=$this->request->webroot . "orders/addorder/1/?driver=132&division=1&order_type=Order+Products&forms=72";
    makeblock($debug, $URL, "Social media search", "fa fa-search" );
    makeblock($debug, $URL, "Social media investigation", "fa fa-twitter" );
    makeblock($debug, $URL, "Physical surveillance", "fa fa-search" );
*/

    function GetAssignedClients($UserID, $clients, $First = false){
        //$clients = $this->requestAction('/clients/getAllClient/');
        $clientlist = array();
        if ($clients) {
            foreach ($clients as $client) {
                $pro_ids = explode(",", $client->profile_id);
                if (in_array($UserID, $pro_ids)) {
                    if ($First){return $client;}
                    $clientlist[] = $client;
                }
            }
        }
        if(count($clientlist)>0){return $clientlist;}
    }
    ?>




    <?php if ($sidebar->orders_list ==1 && $block->document_draft =='1') { ?>
        <a class="tile bg-grey-cascade" href="<?php echo $this->request->webroot; ?>orders/orderslist?draft" style="display: block;">
            <div class="tile-body">
                <i class="fa fa-pencil"></i>
            </div>
            <div class="tile-object">
                <div class="name"> Order Drafts</div>
                <div class="number"></div>
            </div>
        </a>
    <?php } ?>




    <?php if ($sidebar->document_create ==1 && $block->submit_document =='1') { ?>
        <a href="<?php echo $this->request->webroot.$document_url;?>" class="tile bg-grey-cascade" style="display: block;">
            <div class="tile-body">
                <i class="icon-doc"></i>
            </div>
            <div class="tile-object">
                <div class="name">Create <?=$settings->document;?></div>
                <div class="number"></div>
            </div>
        </a>
    <?php } ?>
    <?php if ($sidebar->document_list ==1 && $block->document_draft =='1') { ?>
        <a class="tile bg-grey-cascade" href="<?php echo $this->request->webroot; ?>documents?draft" style="display: block;">
            <div class="tile-body">
                <i class="fa fa-pencil"></i>
            </div>
            <div class="tile-object">
                <div class="name"> <?=$settings->document;?> Drafts</div>
                <div class="number"></div>
            </div>
        </a>
    <?php } ?>



     <?php if ($sidebar->messages ==1 && $block->message =='1' && false) { ?>
        <a class="tile bg-green" href="<?php echo $this->request->webroot; ?>messages" style="display: block;">
            <div class="tile-body">
                <i class="fa icon-envelope"></i>
            </div>
            <div class="tile-object">
                <div class="name">Messages</div>
                <div class="number"></div>
            </div>
        </a>
    <?php } ?>

    <?php if ($sidebar->schedule ==1 && $block->schedule =='1') { ?>
    <!--<div class="input-group input-medium date date-picker" data-date-start-date="+0d" data-date-format="dd-mm-yyyy">-->
        <a  href="<?php echo $this->request->webroot;?>tasks/calender" class="tile bg-grey-cascade" style="display: block;">
            <div class="tile-body">
                <i class="fa fa-calendar"></i>
            </div>
            <div class="tile-object">
                <div class="name">Tasks</div>
                <div class="number"></div>
            </div>
         </a>
    <?php } ?>
     <?php if ($sidebar->schedule_add ==1 && $block->schedule_add =='1') { ?>
    <!--<div class="input-group input-medium date date-picker" data-date-start-date="+0d" data-date-format="dd-mm-yyyy">-->
        <a  href="<?php echo $this->request->webroot;?>tasks/add" class="tile bg-grey-cascade" style="display: block;">
            <div class="tile-body">
                <i class="fa fa-calendar"></i>
            </div>
            <div class="tile-object">
                <div class="name">Add Tasks</div>
                <div class="number"></div>
            </div>
         </a>
    <?php } ?>



    <?php /*if ($block->tasks == 1) { ?>

        <a class="tile bg-blue-steel" href="<?php echo $this->request->webroot;?>todo/date/<?php echo date('Y-m-d');?>" style="display: block;">
            <div class="tile-body">
                <i class="fa fa-tasks"></i>
            </div>
            <div class="tile-object">
                <div class="name">
                    Tasks
                </div>
                <div class="number">
                    34
                </div>
            </div>

        </a>

    <?php }*/?>



    <?php if ($sidebar->feedback == 1 && $block->feedback =='1') { ?>
        <a href="<?php echo $this->request->webroot.$document_url;?>" class="tile bg-grey-cascade">
            <div class="tile-body">
                <i class="fa fa-comments"></i>
            </div>
            <div class="tile-object">
                <div class="name">Feedback</div>
                <div class="number"></div>
            </div>
    </a>
    <?php } ?>


    <?php if ($sidebar->analytics ==1 && $block->analytics =='1') { ?>
        <a href="<?php echo $this->request->webroot;?>documents/analytics" class="tile bg-grey-cascade" style="display: block;">
            <div class="tile-body">
                <i class="fa fa-bar-chart-o"></i>
            </div>
            <div class="tile-object">
                <div class="name">Analytics</div>
                <div class="number"></div>
            </div>
        </a>
        <!--<a href="<?php echo $this->request->webroot;?>documents/analytics?drafts=1" class="tile bg-red-sunglo" style="display: block;">
            <div class="tile-body">
                <i class="fa fa-bar-chart-o"></i>
            </div>
            <div class="tile-object">
                <div class="name">Analytics for Drafts</div>
                <div class="number"></div>
            </div>
        </a>-->
    <?php } ?>

 <?php /* if ($sidebar->bulk == 1 && $block->bulk =='1') { ?>
        <a href="<?php echo $this->request->webroot;?>profiles" class="tile bg-green">
            <div class="tile-body">
                <i class="fa fa-comments"></i>
            </div>
            <div class="tile-object">
                <div class="name">Bulk Order</div>
                <div class="number"></div>
            </div>
    </a>
    <?php }*/ ?>








    <?php /* if ($block->masterjob == 1) { ?>
        <div class="tile bg-red-intense">
            <div class="tile-body">
                <i class="fa fa-globe"></i>
            </div>
            <div class="tile-object">
                <div class="name">
                    Master <?php echo ucfirst($settings->client); ?>
                </div>
                <div class="number">

                </div>
            </div>
        </div>

    <?php }*/ ?>



</div>
<script>
$(function(){
    
    $('.date-picker1').datepicker({
        
    })
    //Listen for the change even on the input
    .change(dateChanged)
    .on('changeDate', dateChanged);
});

function dateChanged(ev) {
    datez = (ev.date.valueOf())/1000;
    //alert(ev.date.valueOf());
    $(this).datepicker('hide');
    window.location.href="<?php echo $this->request->webroot;?>todo/date/"+datez;
}
</script>
