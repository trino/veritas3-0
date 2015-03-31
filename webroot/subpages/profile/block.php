<?php
 if($_SERVER['SERVER_NAME'] =='localhost')
        echo "<span style ='color:red;'>block.php #INC116</span>";
$uid = ($this->request['action'] == 'add') ? "0" : $this->request['pass'][0];
$sidebar = $this->requestAction("settings/all_settings/" . $uid . "/sidebar");
$block = $this->requestAction("settings/all_settings/" . $uid . "/blocks");
if (!isset($is_disabled1)) {
    $is_disabled1 = "";
}//something is wrong with this variable

if ($activetab == "permissions") {
    if ((isset($Clientcount) && $Clientcount == 0) || $this->request->session()->read('Profile.profile_type') == '2') {
        $activetab = "assign";
    } else {
        $activetab = "config";
    }
} else {
    if ($this->request->session()->read('Profile.profile_type') == '2')
        $activetab = "assign";
    else
        $activetab = "config";
}

?>

<!-- BEGIN BORDERED TABLE PORTLET--><!--
<div class="portlet box yellow">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-briefcase"></i>Permissions
        </div>
-->
<ul class="nav nav-tabs nav-justified">
    <?php if ($this->request->session()->read('Profile.profile_type') != '2') {
        ?>
        <li <?php if ((!isset($Clientcount) || (isset($Clientcount) && $Clientcount != 0))) activetab($activetab, "config"); ?>>
            <a href="#subtab_2_1" data-toggle="tab">Configuration</a>
        </li>
        <!--<li class="">
                <a href="#subtab_2_2" data-toggle="tab"><?php echo ucfirst($settings->document); ?></a>
            </li>-->
        <li class="">
            <a href="#subtab_2_3" data-toggle="tab">Top blocks</a>
        </li>
    <?php
    }
    ?>
    <!--<li >
        <a href="#tab_1_12" data-toggle="tab">Profile Types</a>
    </li>
     <li >
        <a href="#tab_1_13" data-toggle="tab">Client Types</a>
    </li>-->
    <li <?php if ($this->request->session()->read('Profile.profile_type') == '2' || (isset($Clientcount) && $Clientcount == 0)) echo 'class = "active"'; ?>>
        <a href="#subtab_2_4" data-toggle="tab">Assign to <?php echo ucfirst($settings->client) ?></a>
    </li>


</UL>
<!--</div>-->
<div class="portlet-body form">
    <div class="tab-content">

        <div
            class="tab-pane <?php if ((!isset($Clientcount) || (isset($Clientcount) && $Clientcount != 0))) activetab($activetab, "config", false); ?>"
            id="subtab_2_1">
            <div class="">
                <!--h1>Modules</h1-->

                <form action="#" method="post" id="blockform">
                    <input type="hidden" name="form" value="<?php echo $uid; ?>"/>
                    <input type="hidden" name="side[user_id]" value="<?php echo $uid; ?>"/>


                    <table class="table table-bordered table-hover">
                        <tr>
                            <td class="vtop">
                                <?php echo ucfirst($settings->profile); ?>
                            </td>
                            <td width="90%">
                                <label class="uniform-inline">
                                    <input <?php echo $is_disabled ?> type="radio" class="profile_enb"
                                                                      name="side[profile]"
                                                                      value="1"
                                                                      onclick="$('.ptypes').show();$(this).closest('td').find('.yesno span').each(function(){$(this).addClass('checked')});$(this).closest('td').find('.yesno input').each(function(){ this.checked = true;})" <?php if (isset($sidebar) && $sidebar->profile == 1) echo "checked"; ?> />
                                    Yes </label>
                                <label class="uniform-inline">
                                    <input <?php echo $is_disabled ?> type="radio"
                                                                      name="side[profile]"
                                                                      value="0"
                                                                      onclick="$('.ptypes').hide(); $(this).closest('td').find('.yesno span').each(function(){$(this).removeClass('checked')});$(this).closest('td').find('.yesno input').each(function(){ this.checked = false;})" <?php if (isset($sidebar) && $sidebar->profile == 0) echo "checked"; ?>/>
                                    No </label>

                                <div class="clearfix"></div>
                                <div class="col-md-12 nopad martop yesno">
                                    <label class="uniform-inline">
                                        <input <?php echo $is_disabled ?> type="checkbox"
                                                                          name="side[profile_list]"
                                                                          value="1" <?php if (isset($sidebar) && $sidebar->profile_list == 1) echo "checked"; ?> />
                                        List
                                    </label>
                                    <label class="uniform-inline">
                                        <input <?php echo $is_disabled ?> type="checkbox"
                                                                          name="side[profile_create]"
                                                                          value="1" <?php if (isset($sidebar) && $sidebar->profile_create == 1) echo "checked"; ?> />
                                        Create
                                    </label>
                                    <label class="uniform-inline">
                                        <input <?php echo $is_disabled ?> type="checkbox"
                                                                          name="side[profile_edit]"
                                                                          value="1" <?php if (isset($sidebar) && $sidebar->profile_edit == 1) echo "checked"; ?> />
                                        Edit
                                    </label>
                                    <label class="uniform-inline">
                                        <input <?php echo $is_disabled ?> type="checkbox"
                                                                          name="side[profile_delete]"
                                                                          value="1" <?php if (isset($sidebar) && $sidebar->profile_delete == 1) echo "checked"; ?> />
                                        Delete
                                    </label>
                                    <label class="uniform-inline">
                                        <input <?php echo $is_disabled ?> type="checkbox" name="side[email_profile]"
                                                                          value="1" <?php if (isset($sidebar) && $sidebar->email_profile == 1) echo "checked"; ?> />
                                        Recieve Email
                                    </label>
                                    
                                </div>
                                <div class="clearfix"></div>
                            </td>
                        </tr>
                        <tr class="ptypes" <?php if (isset($sidebar) && $sidebar->profile == 0) echo "style='display:none;'"; ?>>
                            <td><p>Can Create:</p></td>
                            <td style="padding: 1px;" >
                                <table style="margin-bottom: 0px; margin-top: 0px;"
                                    class=" ptypeform table table-condensed  table-striped table-bordered table-hover dataTable no-footer">
                                    <tr>

                                        <?php
                                        $pt = explode(",", $profile->ptypes);
                                        $cnt = 0;
                                        foreach ($ptypes as $product)
                                        {
                                        ++$cnt;
                                        ?>
                                        <td class="titleptype_<?php echo $product->id;?>">
                                            <input name="ptypes[]" type="checkbox" <?php  if(in_array($product->id,$pt)){echo "checked='checked'";}?> class="cenable" id="cchk_<?php echo $product->id;?>" value="<?php echo $product->id;?>" /><label for="cchk_<?php echo $product->id;?>"><?php echo $product->title;?></label>
                                        </td>
                                        <?php if ($cnt % 4 == 0)
                                        {
                                        ?>
                                    </tr>
                                    <tr>
                                        <?php
                                        }

                                        }
                                        ?>
                                    </tr>
                                    <tr style="display: none;">
                                        <td></td>
                                        <td></td>
                                        <td><a href="javascript:;" class="btn btn-primary" id="saveptype">Submit</a>
                                        </td>
                                    </tr>

                                </table>

                            </td>
                        </tr>
                        <tr><td colspan="2">&nbsp;</td></tr>
                        <tr>
                            <td class="vtop">
                                <?php echo ucfirst($settings->client); ?>
                            </td>
                            <td>

                                <label class="uniform-inline">
                                    <input <?php echo $is_disabled ?> type="radio" class="client_enb"
                                                                      name="side[client]"
                                                                      onclick="$('.ctypes').show();$(this).closest('td').find('.yesno span').each(function(){$(this).addClass('checked')});$(this).closest('td').find('.yesno input').each(function(){ this.checked = true;})"
                                                                      value="1" <?php if (isset($sidebar) && $sidebar->client == 1) echo "checked"; ?>/>
                                    Yes </label>
                                <label class="uniform-inline">
                                    <input <?php echo $is_disabled ?> type="radio"
                                                                      name="side[client]"
                                                                      onclick="$('.ctypes').hide();$(this).closest('td').find('.yesno span').each(function(){$(this).removeClass('checked')});$(this).closest('td').find('.yesno input').each(function(){ this.checked = false;})"
                                                                      value="0" <?php if (isset($sidebar) && $sidebar->client == 0) echo "checked"; ?>/>
                                    No </label>

                                <div class="clearfix"></div>
                                <div class="col-md-12 nopad martop yesno">
                                    <label class="uniform-inline">
                                        <input <?php echo $is_disabled ?> type="checkbox"
                                                                          name="side[client_list]"
                                                                          value="1" <?php if (isset($sidebar) && $sidebar->client_list == 1) echo "checked"; ?> />
                                        List
                                    </label>
                                    <label class="uniform-inline">
                                        <input <?php echo $is_disabled ?> type="checkbox"
                                                                          name="side[client_create]"
                                                                          value="1" <?php if (isset($sidebar) && $sidebar->client_create == 1) echo "checked"; ?> />
                                        Create
                                    </label>
                                    <label class="uniform-inline">
                                        <input <?php echo $is_disabled ?> type="checkbox"
                                                                          name="side[client_edit]"
                                                                          value="1" <?php if (isset($sidebar) && $sidebar->client_edit == 1) echo "checked"; ?> />
                                        Edit
                                    </label>
                                    <label class="uniform-inline">
                                        <input <?php echo $is_disabled ?> type="checkbox"
                                                                          name="side[client_delete]"
                                                                          value="1" <?php if (isset($sidebar) && $sidebar->client_delete == 1) echo "checked"; ?> />
                                        Delete
                                    </label>

                                </div>
                                <div class="clearfix"></div>
                            </td>
                        </tr>
                        <tr class="ctypes" <?php if (isset($sidebar) && $sidebar->client == 0) echo "style='display:none;'"; ?>>
                            <td>Can Create:</td>
                            <td style="padding: 1px;" >
                                <table style="margin-bottom: 0px; margin-top: 0px;"
                                    class="ctypeform table table-condensed  table-striped table-bordered table-hover dataTable no-footer">
                                    <tr>
                                        <?php
                                        $cnt = 0;
                                        if (isset($client_types)){
                                        $ct = explode(",", $profile->ctypes);
                                            foreach ($client_types as $product) {
                                                ++$cnt;
                                                ?>
                                                <td width="33%" class="titlectype_<?php echo $product->id;?>">
                                                <input name="ctypes[]"
                                                   type="checkbox" <?php if (in_array($product->id, $ct)) {
                                                        echo "checked='checked'";
                                                    }?> class="cenable" id="cchk_b<?php echo $product->id;?>"
                                                   value="<?php echo $product->id;?>"/><label
                                                for="cchk_b<?php echo $product->id;?>"><?php echo $product->title;?></label>
                                                </td>
                                            <?php if ($cnt % 4 == 0){
                                                echo "</tr><tr>";
                                            }
                                        }
                                        }
                                        ?>
                                    </tr>
                                    <tr style="display: none;">
                                        <td></td>
                                        <td></td>
                                        <td><a href="javascript:;" class="btn btn-primary" id="savectype">Submit</a>
                                        </td>
                                    </tr>

                                </table>

                            </td>
                        </tr>
                        <tr><td colspan="2">&nbsp;</td></tr>
                        <tr>
                            <td class="vtop">
                                Orders
                            </td>
                            <td>
                                <label class="uniform-inline">
                                    <input <?php echo $is_disabled ?> type="radio" name="side[orders]"
                                                                      onclick="$(this).closest('td').find('.yesno span').each(function(){$(this).addClass('checked')});$(this).closest('td').find('.yesno input').each(function(){ this.checked = true;})"
                                                                      value="1" <?php if (isset($sidebar) && $sidebar->orders == 1) echo "checked"; ?>/>
                                    Yes </label>
                                <label class="uniform-inline">
                                    <input <?php echo $is_disabled ?> type="radio"
                                                                      name="side[orders]"
                                                                      onclick="$(this).closest('td').find('.yesno span').each(function(){$(this).removeClass('checked')});$(this).closest('td').find('.yesno input').each(function(){$(this).removeAttr('checked');});"
                                                                      value="0" <?php if (isset($sidebar) && $sidebar->orders == 0) echo "checked"; ?>/>
                                    No </label>

                                <div class="clearfix"></div>
                                <div class="col-md-12 nopad martop yesno">
                                    <label class="uniform-inline">
                                        <input <?php echo $is_disabled ?> type="checkbox" name="side[orders_list]"
                                                                          value="1" <?php if (isset($sidebar) && $sidebar->orders_list == 1) echo "checked"; ?> />
                                        List
                                    </label>
                                    <label class="uniform-inline">
                                        <input <?php echo $is_disabled ?> type="checkbox" name="side[orders_create]"
                                                                          value="1" <?php if (isset($sidebar) && $sidebar->orders_create == 1) echo "checked"; ?> />
                                        Create
                                    </label>
                                    <label class="uniform-inline">
                                        <input <?php echo $is_disabled ?> type="checkbox" name="side[orders_edit]"
                                                                          value="1" <?php if (isset($sidebar) && $sidebar->orders_edit == 1) echo "checked"; ?> />
                                        Edit
                                    </label>
                                    <label class="uniform-inline">
                                        <input <?php echo $is_disabled ?> type="checkbox" name="side[orders_delete]"
                                                                          value="1" <?php if (isset($sidebar) && $sidebar->orders_delete == 1) echo "checked"; ?> />
                                        Delete
                                    </label>
                                    <label class="uniform-inline">
                                        <input <?php echo $is_disabled ?> type="checkbox" name="side[orders_others]"
                                                                          value="1" <?php if (isset($sidebar) && $sidebar->orders_others == 1) echo "checked"; ?> />
                                        View Other's
                                    </label>
                                   
                                    <label class="uniform-inline">
                                        <input <?php echo $is_disabled ?> type="checkbox" name="side[email_orders]"
                                                                          value="1" <?php if (isset($sidebar) && $sidebar->email_orders == 1) echo "checked"; ?> />
                                        Recieve Email
                                    </label>
                                    <!--label class="uniform-inline">

                                                                       <table class="table table-bordered table-hover">
                                            <tr>
                                                <td class="vtop">
                                                    <?php echo ucfirst($settings->profile); ?>
                                                </td>
                                                <td width="90%">
                                                    <label class="uniform-inline">
                                                        <input <?php echo $is_disabled ?> type="radio" class="profile_enb"
                                                                                          name="side[profile]"
                                                                                          value="1" onclick="$('.ptypes').show();$(this).closest('td').find('.yesno span').each(function(){$(this).addClass('checked')});$(this).closest('td').find('.yesno input').each(function(){ this.checked = true;})" <?php if (isset($sidebar) && $sidebar->profile == 1) echo "checked"; ?> />
                                                        Yes </label>
                                                    <label class="uniform-inline">
                                                        <input <?php echo $is_disabled ?> type="radio"
                                                                                          name="side[profile]"
                                                                                          value="0" onclick="$('.ptypes').hide(); $(this).closest('td').find('.yesno span').each(function(){$(this).removeClass('checked')});$(this).closest('td').find('.yesno input').each(function(){ this.checked = false;})" <?php if (isset($sidebar) && $sidebar->profile == 0) echo "checked"; ?>/>
                                                        No </label>
                                                        <div class="clearfix"></div>
                                                        <div class="col-md-12 nopad martop yesno" >
                                                            <label class="uniform-inline">
                                                                <input <?php echo $is_disabled ?> type="checkbox"
                                                                                          name="side[profile_list]"
                                                                                          value="1" <?php if (isset($sidebar) && $sidebar->profile_list == 1) echo "checked"; ?> /> List
                                                            </label>
                                                            <label class="uniform-inline">
                                                                <input <?php echo $is_disabled ?> type="checkbox"
                                                                                          name="side[profile_create]"
                                                                                          value="1" <?php if (isset($sidebar) && $sidebar->profile_create == 1) echo "checked"; ?> /> Create
                                                            </label>
                                                            <label class="uniform-inline">
                                                                <input <?php echo $is_disabled ?> type="checkbox"
                                                                       name="side[profile_edit]"
                                                                       value="1" <?php if ($sidebar->profile_edit == 1) echo "checked"; ?> /> Edit
                                                            </label>
                                                            <label class="uniform-inline">
                                                                <input <?php echo $is_disabled ?> type="checkbox"
                                                                                          name="side[profile_delete]"
                                                                                          value="1" <?php if ($sidebar->profile_delete == 1) echo "checked"; ?> /> Delete
                                                            </label>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                </td>
                                            </tr>
                                            <tr class="ptypes" <?php if (isset($sidebar) && $sidebar->profile == 0)echo "style='display:none;'";?>>
                                                <td>Profile Type</td>
                                                <td style="padding: 1px;" >

                                                    <table style="margin-bottom: 0px; margin-top: 0px;"
                                                            class=" ptypeform table table-condensed  table-striped table-bordered table-hover dataTable no-footer">


                                                            <tr>
                                                            <?php
                                    $pt = explode(",",$profile->ptypes);
                                    $cnt =0;
                                    foreach($ptypes as $product)
                                    {
                                        ++$cnt;
                                        ?>
                                                                <td class="titleptype_<?php echo $product->id;?>">
                                                                    <input name="ptypes[]" type="checkbox" <?php  if(in_array($product->id,$pt)){echo "checked='checked'";}?> class="cenable" id="cchk_<?php echo $product->id;?>" value="<?php echo $product->id;?>" /><label for="cchk_<?php echo $product->id;?>"><?php echo $product->title;?></label>
                                                                </td>
                                                                <?php if($cnt%4==0)
                                    {?>
                                                                   </tr><tr>
                                                            <?php
                                    }

                                    }
                                    ?>
                                                             </tr>
                                                             <tr style="display: none;">
                                                                <td></td>
                                                                <td></td>
                                                                <td><a href="javascript:;" class="btn btn-primary" id="saveptype" >Submit</a></td>
                                                            </tr>

                                                    </table>

                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="vtop">
                                                    <?php echo ucfirst($settings->client); ?>
                                                </td>
                                                <td>

                                                    <label class="uniform-inline">
                                                        <input <?php echo $is_disabled ?> type="radio" class="client_enb"
                                                                                          name="side[client]"
                                                                                          onclick="$('.ctypes').show();$(this).closest('td').find('.yesno span').each(function(){$(this).addClass('checked')});$(this).closest('td').find('.yesno input').each(function(){ this.checked = true;})"
                                                                                          value="1" <?php if (isset($sidebar) && $sidebar->client == 1) echo "checked"; ?>/>
                                                        Yes </label>
                                                    <label class="uniform-inline">
                                                        <input <?php echo $is_disabled ?> type="radio"
                                                                                          name="side[client]"
                                                                                          onclick="$('.ctypes').hide();$(this).closest('td').find('.yesno span').each(function(){$(this).removeClass('checked')});$(this).closest('td').find('.yesno input').each(function(){ this.checked = false;})"
                                                                                          value="0" <?php if (isset($sidebar) && $sidebar->client == 0) echo "checked"; ?>/>
                                                        No </label>
                                                        <div class="clearfix"></div>
                                                        <div class="col-md-12 nopad martop yesno" >
                                                            <label class="uniform-inline">
                                                                <input <?php echo $is_disabled ?> type="checkbox"
                                                                                          name="side[client_list]"
                                                                                          value="1" <?php if (isset($sidebar) && $sidebar->client_list == 1) echo "checked"; ?> /> List
                                                            </label>
                                                            <label class="uniform-inline">
                                                                <input <?php echo $is_disabled ?> type="checkbox"
                                                                                          name="side[client_create]"
                                                                                          value="1" <?php if (isset($sidebar) && $sidebar->client_create == 1) echo "checked"; ?> /> Create
                                                            </label>
                                                            <label class="uniform-inline">
                                                                <input <?php echo $is_disabled ?> type="checkbox"
                                                                                          name="side[client_edit]"
                                                                                          value="1" <?php if ($sidebar->client_edit == 1) echo "checked"; ?> /> Edit
                                                            </label>
                                                            <label class="uniform-inline">
                                                                <input <?php echo $is_disabled ?> type="checkbox"
                                                                                          name="side[client_delete]"
                                                                                          value="1" <?php if ($sidebar->client_delete == 1) echo "checked"; ?> /> Delete
                                                            </label>

                                                        </div>
                                                        <div class="clearfix"></div>
                                                </td>
                                            </tr>
                                            <tr class="ctypes" <?php if (isset($sidebar) && $sidebar->client == 0)echo "style='display:none;'";?>>
                                                <td>Client Type</td>
                                                <td style="padding: 1px;" >

                                                        <table style="margin-bottom: 0px; margin-top: 0px;"
                                                            class="ctypeform table table-condensed  table-striped table-bordered table-hover dataTable no-footer">
                                                                <tr>
                                                            <?php
                                    $cnt =0;
                                    $ct = explode(",",$profile->ctypes);
                                    foreach($client_types as $product)
                                    {
                                        ++$cnt;
                                        ?>
                                                                <td class="titlectype_<?php echo $product->id;?>">
                                                                        <input name="ctypes[]" type="checkbox" <?php if(in_array($product->id,$ct)){echo "checked='checked'";}?> class="cenable" id="bbhk_<?php echo $product->id;?>" value="<?php echo $product->id;?>" /><label for="bbhk_<?php echo $product->id;?>" ><?php echo $product->title;?></label>
                                                                </td>

                                                             <?php if($cnt%4==0)
                                    {?>
                                                                   </tr><tr>
                                                            <?php
                                    }
                                    }
                                    ?>
                                                            </tr>
                                                            <tr style="display: none;">
                                                                <td></td>
                                                                <td></td>
                                                                <td><a href="javascript:;" class="btn btn-primary" id="savectype" >Submit</a></td>
                                                            </tr>

                                                        </table>

                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="vtop">
                                                    Orders
                                                </td>
                                                <td>
                                                    <label class="uniform-inline">
                                                        <input <?php echo $is_disabled ?> type="radio" name="side[orders]" onclick="$(this).closest('td').find('.yesno span').each(function(){$(this).addClass('checked')});$(this).closest('td').find('.yesno input').each(function(){ this.checked = true;})" value="1" <?php if (isset($sidebar) && $sidebar->orders == 1) echo "checked"; ?>/>
                                                        Yes </label>
                                                    <label class="uniform-inline">
                                                        <input <?php echo $is_disabled ?> type="radio"
                                                                                          name="side[orders]"
                                                                                          onclick="$(this).closest('td').find('.yesno span').each(function(){$(this).removeClass('checked')});$(this).closest('td').find('.yesno input').each(function(){$(this).removeAttr('checked');});"
                                                                                          value="0" <?php if (isset($sidebar) && $sidebar->orders == 0) echo "checked"; ?>/>
                                                        No </label>
                                                        <div class="clearfix"></div>
                                                        <div class="col-md-12 nopad martop yesno" >
                                                            <label class="uniform-inline">
                                                                <input <?php echo $is_disabled ?> type="checkbox" name="side[orders_list]" value="1" <?php if (isset($sidebar) && $sidebar->orders_list == 1) echo "checked"; ?> /> List
                                                            </label>
                                                            <label class="uniform-inline">
                                                                <input <?php echo $is_disabled ?> type="checkbox" name="side[orders_create]" value="1" <?php if (isset($sidebar) && $sidebar->orders_create == 1) echo "checked"; ?> /> Create
                                                            </label>
                                                            <label class="uniform-inline">
                                                                <input <?php echo $is_disabled ?> type="checkbox" name="side[orders_edit]" value="1" <?php if ($sidebar->orders_edit == 1) echo "checked"; ?> /> Edit
                                                            </label>
                                                            <label class="uniform-inline">
                                                                <input <?php echo $is_disabled ?> type="checkbox" name="side[orders_delete]" value="1" <?php if ($sidebar->orders_delete == 1) echo "checked"; ?> /> Delete
                                                            </label>
                                                             <label class="uniform-inline">
                                                                <input <?php echo $is_disabled ?> type="checkbox" name="side[orders_others]" value="1" <?php if ($sidebar->orders_others == 1) echo "checked"; ?> /> View Other's
                                                            </label>
                                                            <!--label class="uniform-inline">
>>>>>>> origin/master
                                                                <input <?php echo $is_disabled ?> type="checkbox" name="side[orders_requalify]" value="1" <?php if ($sidebar->orders_requalify == 1) echo "checked"; ?> /> Re-qualify
                                                            </label-->


                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-12 nopad martop yesno">
                                    <label class="uniform-inline">
                                        <input <?php echo $is_disabled ?> type="checkbox" name="side[orders_mee]"
                                                                          value="1" <?php if (isset($sidebar) && $sidebar->orders_mee == 1) echo "checked"; ?> />
                                        Order MEE
                                    </label>
                                    <label class="uniform-inline">
                                        <input <?php echo $is_disabled ?> type="checkbox" name="side[orders_products]"
                                                                          value="1" <?php if (isset($sidebar) && $sidebar->orders_products == 1) echo "checked"; ?> />
                                        Order Products
                                    </label>
                                    <label class="uniform-inline">
                                        <input <?php echo $is_disabled ?> type="checkbox" name="side[order_requalify]"
                                                                          value="1" <?php if (isset($sidebar) && $sidebar->order_requalify == 1) echo "checked"; ?> />
                                        Re-Qualify
                                    </label>

                                    <label class="uniform-inline">
                                        <input <?php echo $is_disabled ?> type="checkbox" name="side[order_intact]"
                                                                          value="1" <?php if (isset($sidebar) && $sidebar->order_intact == 1) echo "checked"; ?> />
                                        Intact Orders
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr><td colspan="2">&nbsp;</td></tr>
                        <!--<tr>
                            <td class="vtop">
                                Receive Email Notifications
                            </td>
                            <td>
                                <label class="uniform-inline">
                                    <input <?php echo $is_disabled ?> type="radio" name="side[email]"
                                                                      onclick="$(this).closest('td').find('.yesno span').each(function(){$(this).addClass('checked')});$(this).closest('td').find('.yesno input').each(function(){ this.checked = true;})"
                                                                      value="1" <?php if (isset($sidebar) && $sidebar->email == 1) echo "checked"; ?>/>
                                    Yes </label>
                                <label class="uniform-inline">
                                    <input <?php echo $is_disabled ?> type="radio"
                                                                      name="side[email]"
                                                                      onclick="$(this).closest('td').find('.yesno span').each(function(){$(this).removeClass('checked')});$(this).closest('td').find('.yesno input').each(function(){$(this).removeAttr('checked');});"
                                                                      value="0" <?php if (isset($sidebar) && $sidebar->email == 0) echo "checked"; ?>/>
                                    No </label>

                                <div class="clearfix"></div>
                                <div class="col-md-12 nopad martop yesno">
                                    <label class="uniform-inline">
                                        <input <?php echo $is_disabled ?> type="checkbox" name="side[email_todo]"
                                                                          value="1" <?php if (isset($sidebar) && $sidebar->email_todo == 1) echo "checked"; ?> />
                                        Orders
                                    </label>
                                    <label class="uniform-inline">
                                        <input <?php echo $is_disabled ?> type="checkbox" name="side[email_document]"
                                                                          value="1" <?php if (isset($sidebar) && $sidebar->email_document == 1) echo "checked"; ?> /> <?php echo ucwords($settings->document); ?>
                                    </label>
                                    <label class="uniform-inline">
                                        <input <?php echo $is_disabled ?> type="checkbox" name="side[email_orders]"
                                                                          value="1" <?php if ($sidebar->email_orders == 1) echo "checked"; ?> />
                                        Orders
                                    </label>

                                </div>
                                <div class="clearfix"></div>
                            </td>
                        </tr>-->
                        <!--<tr>
                                                <td class="vtop">Feedbacks</td>
                                                <td>
                                                        <label class="uniform-inline">
                                                        <input <?php echo $is_disabled ?> type="radio"
                                                                                          name="side[feedback]"
                                                                                          value="1" <?php if (isset($sidebar) && $sidebar->feedback == 1) echo "checked"; ?>/>
                                                        Yes </label>
                                                        <label class="uniform-inline">
                                                        <input <?php echo $is_disabled ?> type="radio"
                                                                                          name="side[feedback]"
                                                                                          value="0" <?php if (isset($sidebar) && $sidebar->feedback == 0) echo "checked"; ?>/>
                                                        No </label>
                                                </td>
                                            </tr>-->
                        <!--tr>
                                                <td class="vtop">Messages</td>
                                                <td>
                                                     <label class="uniform-inline">
                                                        <input <?php echo $is_disabled ?> type="radio"
                                                                                          name="side[messages]"
                                                                                          value="1" <?php if (isset($sidebar) && $sidebar->messages == 1) echo "checked"; ?>/>
                                                        Yes </label>
                                                        <label class="uniform-inline">
                                                        <input <?php echo $is_disabled ?> type="radio"
                                                                                          name="side[messages]"
                                                                                          value="0" <?php if (isset($sidebar) && $sidebar->messages == 0) echo "checked"; ?>/>
                                                        No </label>
                                                </td>
                                            </tr-->
                        <tr>
                            <td class="vtop">Tasks</td>
                            <td>
                                <label class="uniform-inline">
                                    <input <?php echo $is_disabled ?> type="radio"
                                                                      name="side[schedule]"
                                                                      value="1" <?php if (isset($sidebar) && $sidebar->schedule == 1) echo "checked"; ?>/>
                                    Yes </label>
                                <label class="uniform-inline">
                                    <input <?php echo $is_disabled ?> type="radio"
                                                                      name="side[schedule]"
                                                                      value="0" <?php if (isset($sidebar) && $sidebar->schedule == 0) echo "checked"; ?>/>
                                    No </label>
                            </td>
                        </tr>
                        <tr>
                            <td class="vtop">Add Tasks</td>
                            <td>
                                <label class="uniform-inline">
                                    <input <?php echo $is_disabled ?> type="radio"
                                                                      name="side[schedule_add]"
                                                                      value="1" <?php if (isset($sidebar) && $sidebar->schedule_add == 1) echo "checked"; ?>/>
                                    Yes </label>
                                <label class="uniform-inline">
                                    <input <?php echo $is_disabled ?> type="radio"
                                                                      name="side[schedule_add]"
                                                                      value="0" <?php if (isset($sidebar) && $sidebar->schedule_add == 0) echo "checked"; ?>/>
                                    No </label>
                            </td>
                        </tr>
                        <tr>
                            <td class="vtop">Analytics</td>
                            <td>
                                <label class="uniform-inline">
                                    <input <?php echo $is_disabled ?> type="radio"
                                                                      name="side[analytics]"
                                                                      value="1" <?php if (isset($sidebar) && $sidebar->analytics == 1) echo "checked"; ?>/>
                                    Yes </label>
                                <label class="uniform-inline">
                                    <input <?php echo $is_disabled ?> type="radio"
                                                                      name="side[analytics]"
                                                                      value="0" <?php if (isset($sidebar) && $sidebar->analytics == 0) echo "checked"; ?>/>
                                    No </label>
                            </td>
                        </tr>

                        <tr>
                            <td class="vtop">Training</td>
                            <td>
                                <label class="uniform-inline">
                                    <input <?php echo $is_disabled ?> type="radio"
                                                                      name="side[training]"
                                                                      value="1" <?php if (isset($sidebar) && $sidebar->training == 1) echo "checked"; ?>/>
                                    Yes </label>
                                <label class="uniform-inline">
                                    <input <?php echo $is_disabled ?> type="radio"
                                                                      name="side[training]"
                                                                      value="0" <?php if (isset($sidebar) && $sidebar->training == 0) echo "checked"; ?>/>
                                    No </label>
                            </td>
                        </tr>


                        <!--<tr>
                                                                           <td class="vtop">Drafts</td>
                                                                           <td>
                                                                                   <label class="uniform-inline">
                                                                                   <input <?php echo $is_disabled ?> type="radio"
                                                                                                                     name="side[drafts]"
                                                                                                                     value="1" <?php if (isset($sidebar) && $sidebar->drafts == 1) echo "checked"; ?>/>
                                                                                   Yes </label>
                                                                                   <label class="uniform-inline">
                                                                                   <input <?php echo $is_disabled ?> type="radio"
                                                                                                                     name="side[drafts]"
                                                                                                                     value="0" <?php if (isset($sidebar) && $sidebar->drafts == 0) echo "checked"; ?>/>
                                                                                   No </label>
                                                                           </td>
                                                                       </tr>-->
                        <tr>
                            <td class="vtop">Recent Activity</td>
                            <td>
                                <label class="uniform-inline">
                                    <input <?php echo $is_disabled ?> type="radio"
                                                                      name="side[recent]"
                                                                      value="1" <?php if (isset($sidebar) && $sidebar->recent == 1) echo "checked"; ?>/>
                                    Yes </label>
                                <label class="uniform-inline">
                                    <input <?php echo $is_disabled ?> type="radio"
                                                                      name="side[recent]"
                                                                      value="0" <?php if (isset($sidebar) && $sidebar->recent == 0) echo "checked"; ?>/>
                                    No </label>
                            </td>
                        </tr>
                        <tr>
                            <td class="vtop">Show Logo</td>
                            <td>
                                <label class="uniform-inline">
                                    <input <?php echo $is_disabled ?> type="radio"
                                                                      name="side[logo]"
                                                                      value="1" <?php if (isset($sidebar) && $sidebar->logo == 1) echo "checked"; ?>/>
                                    Yes </label>
                                <label class="uniform-inline">
                                    <input <?php echo $is_disabled ?> type="radio"
                                                                      name="side[logo]"
                                                                      value="0" <?php if (isset($sidebar) && $sidebar->logo == 0) echo "checked"; ?>/>
                                    No </label>
                            </td>
                        </tr>
                        <!--<tr>
                            <td class="vtop">Bulk Order</td>
                            <td>
                                <label class="uniform-inline">
                                    <input <?php echo $is_disabled ?> type="radio"
                                                                      name="side[bulk]"
                                                                      value="1" <?php if (isset($sidebar) && $sidebar->bulk == 1) echo "checked"; ?>/>
                                    Yes </label>
                                <label class="uniform-inline">
                                    <input <?php echo $is_disabled ?> type="radio"
                                                                      name="side[bulk]"
                                                                      value="0" <?php if (isset($sidebar) && $sidebar->bulk == 0) echo "checked"; ?>/>
                                    No </label>
                            </td>
                        </tr>-->
                        <tr>
                            <td class="vtop">
                                <?php echo ucfirst($settings->document); ?>
                            </td>
                            <td>
                                <label class="uniform-inline">
                                    <input <?php echo $is_disabled ?> type="radio"
                                                                      name="side[document]"
                                                                      onclick="$('.doc_more').show();$(this).closest('td').find('.yesno span').each(function(){$(this).addClass('checked')});$(this).closest('td').find('.yesno input').each(function(){ this.checked = true;});"
                                                                      value="1" <?php if (isset($sidebar) && $sidebar->document == 1) echo "checked"; ?>/>
                                    Yes </label>
                                <label class="uniform-inline">
                                    <input <?php echo $is_disabled ?> type="radio"
                                                                      name="side[document]"
                                                                      onclick="$('.doc_more').hide();$(this).closest('td').find('.yesno span').each(function(){$(this).removeClass('checked')});$(this).closest('td').find('.yesno input').each(function(){ this.checked = false;})"
                                                                      value="0" <?php if (isset($sidebar) && $sidebar->document == 0) echo "checked"; ?>/>
                                    No </label>

                                <div class="clearfix"></div>
                                <div class="col-md-12 nopad martop yesno">
                                    <label class="uniform-inline">
                                        <input <?php echo $is_disabled ?> type="checkbox"
                                                                          name="side[document_list]"
                                                                          value="1" <?php if (isset($sidebar) && $sidebar->document_list == 1) echo "checked"; ?> />
                                        List
                                    </label>
                                    <label class="uniform-inline">
                                        <input <?php echo $is_disabled ?> type="checkbox"
                                                                          name="side[document_create]"
                                                                          value="1" <?php if (isset($sidebar) && $sidebar->document_create == 1) echo "checked"; ?> />
                                        Create
                                    </label>
                                    <label class="uniform-inline">
                                        <input <?php echo $is_disabled ?> type="checkbox"
                                                                          name="side[document_edit]"
                                                                          value="1" <?php if (isset($sidebar) && $sidebar->document_edit == 1) echo "checked"; ?> />
                                        Edit
                                    </label>
                                    <label class="uniform-inline">
                                        <input <?php echo $is_disabled ?> type="checkbox"
                                                                          name="side[document_delete]"
                                                                          value="1" <?php if (isset($sidebar) && $sidebar->document_delete == 1) echo "checked"; ?> />
                                        Delete
                                    </label>
                                    <label class="uniform-inline">
                                        <input <?php echo $is_disabled ?> type="checkbox"
                                                                          name="side[document_others]"
                                                                          value="1" <?php if (isset($sidebar) && $sidebar->document_others == 1) echo "checked"; ?> />
                                        View Other's
                                    </label>
                                    <label class="uniform-inline">
                                        <input <?php echo $is_disabled ?> type="checkbox" name="side[email_document]"
                                                                          value="1" <?php if (isset($sidebar) && $sidebar->email_document == 1) echo "checked"; ?> />
                                        Recieve Email
                                    </label>
                                    <!--label class="uniform-inline">
                                                                <input <?php echo $is_disabled ?> type="checkbox"
                                                                                          name="side[document_requalify]"
                                                                                          value="1" <?php if (isset($sidebar) && $sidebar->document_requalify == 1) echo "checked"; ?> /> Re-qualify
                                                            </label-->


                                </div>
                                <div class="clearfix"></div>
                            </td>
                        </tr>
                        <tr class="doc_more" <?php if (isset($sidebar) && $sidebar->document == 0) {
                            echo "style='display:none;'";
                        } ?>>
                            <td></td>
                            <td>
                                <!--h1> Enable <?php echo ucfirst($settings->document); ?>?</h1-->
                                <form action="#" method="post" id="displayform">
                                    <table class="">

                                        <?php
                                        $subdoc = $this->requestAction('/profiles/getSub');

                                        foreach ($subdoc as $sub) {
                                            ?>
                                            <tr>
                                                <td>

                                                    <?php echo ucfirst($sub['title']);?>
                                                </td>
                                                <!--<td class="">
                                                                <label class="uniform-inline">
                                                                    <input <?php echo $is_disabled1?> type="radio" name="<?php echo $sub->id;?>" value="1" <?php if ($sub['display'] == 1) { ?>checked="checked" <?php }?> />
                                                                    Yes </label>
                                                                <label class="uniform-inline">
                                                                    <input <?php echo $is_disabled1?> type="radio" name="<?php echo $sub->id;?>" value="0" <?php if ($sub['display'] == 0) { ?>checked="checked" <?php }?> />
                                                                    No </label>
                                                            </td>-->
                                                <?php
                                                $prosubdoc = $this->requestAction('/settings/all_settings/0/0/profile/' . $id . '/' . $sub->id);
                                                ?>
                                                <td class="">
                                                    <!--<label class="uniform-inline">
                                                                    <input <?php echo $is_disabled?> type="radio" name="profileP[<?php echo $sub->id;?>]" value="" onclick="$(this).closest('tr').next('tr').show();" <?php if ($prosubdoc['display'] != 0) { ?> checked="checked" <?php } ?> />
                                                                    Yes </label>-->
                                                    <label class="uniform-inline">
                                                        <input <?php echo $is_disabled?> type="radio"
                                                                                         name="profile[<?php echo $sub->id;?>]"
                                                                                         value="0"  <?php if ($prosubdoc['display'] == 0) { ?> checked="checked" <?php } ?> />
                                                        None </label>
                                                    <label class="uniform-inline">
                                                        <input <?php echo $is_disabled?> type="radio"
                                                                                         name="profile[<?php echo $sub->id;?>]"
                                                                                         value="1" <?php if ($prosubdoc['display'] == 1) { ?> checked="checked" <?php } ?> />
                                                        View Only </label>
                                                    <label class="uniform-inline">
                                                        <input <?php echo $is_disabled?> type="radio"
                                                                                         name="profile[<?php echo $sub->id;?>]"
                                                                                         value="2" <?php if ($prosubdoc['display'] == 2) { ?> checked="checked" <?php } ?> />
                                                        Upload Only </label>
                                                    <label class="uniform-inline">
                                                        <input <?php echo $is_disabled?> type="radio"
                                                                                         name="profile[<?php echo $sub->id;?>]"
                                                                                         value="3" <?php if ($prosubdoc['display'] == 3) { ?> checked="checked" <?php } ?>/>
                                                        Both </label>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </table>

                                    <?php
                                    if (!isset($disabled)) {
                                        ?>

                                        <!--<div class="margin-top-10 alert alert-success display-hide flash" style="display: none;">
                                            <button class="close" data-close="alert"></button>
                                            Data saved successfully
                                        </div>-->
                                        <div class="form-actions"
                                             style="height:75px;margin-left:-10px;margin-right:-10px;margin-bottom:-10px;display: none;">
                                            <div class="row">
                                                <div class="col-md-12" align="right">
                                                    <a href="javascript:void(0)" id="save_display"
                                                       class="btn btn-primary">
                                                        Save Changes </a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </form>
                            </td>
                        </tr>
                    </table>
                    <!--end profile-settings-->










                    <?php
                    if (!isset($disabled)) {
                        ?>
                        <div class="res"></div>




                        <div class="margin-top-10 alert alert-success display-hide flash" style="display: none;">
                            <button class="close" data-close="alert"></button>
                            Data saved successfully
                        </div>
                        <div class="form-actions"
                             style="height:75px;margin-left:-10px;margin-right:-10px;margin-bottom:-10px;">
                            <div class="row">
                                <div class="col-md-12" align="right">
                                    <input type="button" name="submit" class="btn btn-primary" id="save_blocks"
                                           value="Save Changes"/>

                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>


                </form>

            </div>
        </div>

        <div class="tab-pane" id="subtab_2_3">


            <form id="homeform">
                <input type="hidden" name="form" value="<?php echo $uid; ?>"/>
                <input type="hidden" name="block[user_id]" value="<?php echo $uid; ?>"/>
                <table class="table table-bordered table-hover">
                    <tr>
                        <td>
                            Add a <?= $settings->profile; ?>
                        </td>
                        <td>
                            <label class="uniform-inline">
                                <input <?php echo $is_disabled ?> type="radio"
                                                                  name="block[addadriver]"
                                                                  value="1" <?php if (isset($block) && $block->addadriver == 1) echo "checked"; ?>/>
                                Yes </label>
                            <label class="uniform-inline">
                                <input <?php echo $is_disabled ?> type="radio"
                                                                  name="block[addadriver]"
                                                                  value="0" <?php if (isset($block) && $block->addadriver == 0) echo "checked"; ?>/>
                                No </label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            List a <?= $settings->profile; ?>
                        </td>
                        <td>
                            <label class="uniform-inline">
                                <input <?php echo $is_disabled ?> type="radio"
                                                                  name="block[list_profile]"
                                                                  value="1" <?php if (isset($block) && $block->list_profile == 1) echo "checked"; ?>/>
                                Yes </label>
                            <label class="uniform-inline">
                                <input <?php echo $is_disabled ?> type="radio"
                                                                  name="block[list_profile]"
                                                                  value="0" <?php if (isset($block) && $block->list_profile == 0) echo "checked"; ?>/>
                                No </label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Add a <?= $settings->client; ?>
                        </td>
                        <td>
                            <label class="uniform-inline">
                                <input <?php echo $is_disabled ?> type="radio"
                                                                  name="block[add_client]"
                                                                  value="1" <?php if (isset($block) && $block->add_client == 1) echo "checked"; ?>/>
                                Yes </label>
                            <label class="uniform-inline">
                                <input <?php echo $is_disabled ?> type="radio"
                                                                  name="block[add_client]"
                                                                  value="0" <?php if (isset($block) && $block->add_client == 0) echo "checked"; ?>/>
                                No </label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            List a <?= $settings->client; ?>
                        </td>
                        <td>
                            <label class="uniform-inline">
                                <input <?php echo $is_disabled ?> type="radio"
                                                                  name="block[list_client]"
                                                                  value="1" <?php if (isset($block) && $block->list_client == 1) echo "checked"; ?>/>
                                Yes </label>
                            <label class="uniform-inline">
                                <input <?php echo $is_disabled ?> type="radio"
                                                                  name="block[list_client]"
                                                                  value="0" <?php if (isset($block) && $block->list_client == 0) echo "checked"; ?>/>
                                No </label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Submit <?= $settings->document; ?>
                        </td>
                        <td>
                            <label class="uniform-inline">
                                <input <?php echo $is_disabled ?> type="radio"
                                                                  name="block[submit_document]"
                                                                  value="1" <?php if (isset($block) && $block->submit_document == 1) echo "checked"; ?>/>
                                Yes </label>
                            <label class="uniform-inline">
                                <input <?php echo $is_disabled ?> type="radio"
                                                                  name="block[submit_document]"
                                                                  value="0" <?php if (isset($block) && $block->submit_document == 0) echo "checked"; ?>/>
                                No </label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            List <?= $settings->document; ?>
                        </td>
                        <td>
                            <label class="uniform-inline">
                                <input <?php echo $is_disabled ?> type="radio"
                                                                  name="block[list_document]"
                                                                  value="1" <?php if (isset($block) && $block->list_document == 1) echo "checked"; ?>/>
                                Yes </label>
                            <label class="uniform-inline">
                                <input <?php echo $is_disabled ?> type="radio"
                                                                  name="block[list_document]"
                                                                  value="0" <?php if (isset($block) && $block->list_document == 0) echo "checked"; ?>/>
                                No </label>
                        </td>
                    </tr>

                    <!--<tr>
                                                <td>
                                                    Search <?= $settings->profile; ?>
                                                </td>
                                                <td>
                                                    <label class="uniform-inline">
                                                        <input <?php echo $is_disabled ?> type="radio" name="block[searchdriver]"
                                                                                          value="1" <?php if (isset($block) && $block->searchdriver == 1) echo "checked"; ?>/>
                                                        Yes </label>
                                                    <label class="uniform-inline">
                                                        <input <?php echo $is_disabled ?> type="radio" name="block[searchdriver]"
                                                                                          value="0" <?php if (isset($block) && $block->searchdriver == 0) echo "checked"; ?>/>
                                                        No </label>
                                                </td>
                                            </tr>-->

                    <tr>
                        <td>
                            Orders MEE
                        </td>
                        <td>
                            <label class="uniform-inline">
                                <input <?php echo $is_disabled ?> type="radio"
                                                                  name="block[ordersmee]"
                                                                  value="1" <?php if (isset($block) && $block->ordersmee == 1) echo "checked"; ?>/>
                                Yes </label>
                            <label class="uniform-inline">
                                <input <?php echo $is_disabled ?> type="radio"
                                                                  name="block[ordersmee]"
                                                                  value="0" <?php if (isset($block) && $block->ordersmee == 0) echo "checked"; ?>/>
                                No </label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Orders Products
                        </td>
                        <td>
                            <label class="uniform-inline">
                                <input <?php echo $is_disabled ?> type="radio"
                                                                  name="block[ordersproducts]"
                                                                  value="1" <?php if (isset($block) && $block->ordersproducts == 1) echo "checked"; ?>/>
                                Yes </label>
                            <label class="uniform-inline">
                                <input <?php echo $is_disabled ?> type="radio"
                                                                  name="block[ordersproducts]"
                                                                  value="0" <?php if (isset($block) && $block->ordersproducts == 0) echo "checked"; ?>/>
                                No </label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Orders Requalify
                        </td>
                        <td>
                            <label class="uniform-inline">
                                <input <?php echo $is_disabled ?> type="radio"
                                                                  name="block[ordersrequalify]"
                                                                  value="1" <?php if (isset($block) && $block->ordersrequalify == 1) echo "checked"; ?>/>
                                Yes </label>
                            <label class="uniform-inline">
                                <input <?php echo $is_disabled ?> type="radio"
                                                                  name="block[ordersrequalify]"
                                                                  value="0" <?php if (isset($block) && $block->ordersrequalify == 0) echo "checked"; ?>/>
                                No </label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            List Order
                        </td>
                        <td>
                            <label class="uniform-inline">
                                <input <?php echo $is_disabled ?> type="radio"
                                                                  name="block[list_order]"
                                                                  value="1" <?php if (isset($block) && $block->list_order == 1) echo "checked"; ?>/>
                                Yes </label>
                            <label class="uniform-inline">
                                <input <?php echo $is_disabled ?> type="radio"
                                                                  name="block[list_order]"
                                                                  value="0" <?php if (isset($block) && $block->list_order == 0) echo "checked"; ?>/>
                                No </label>
                        </td>
                    </tr>
                    <!--<tr>
                                                <td>
                                                    Order History
                                                </td>
                                                <td>
                                                    <label class="uniform-inline">
                                                        <input <?php echo $is_disabled ?> type="radio"
                                                                                          name="block[orderhistory]"
                                                                                          value="1" <?php if (isset($block) && $block->orderhistory == 1) echo "checked"; ?>/>
                                                        Yes </label>
                                                    <label class="uniform-inline">
                                                        <input <?php echo $is_disabled ?> type="radio"
                                                                                          name="block[orderhistory]"
                                                                                          value="0" <?php if (isset($block) && $block->orderhistory == 0) echo "checked"; ?>/>
                                                        No </label>
                                                </td>
                                            </tr>-->

                    <tr>
                        <td>
                            Tasks
                        </td>
                        <td>
                            <label class="uniform-inline">
                                <input <?php echo $is_disabled ?> type="radio"
                                                                  name="block[schedule]"
                                                                  value="1" <?php if (isset($block) && $block->schedule == 1) echo "checked"; ?>/>
                                Yes </label>
                            <label class="uniform-inline">
                                <input <?php echo $is_disabled ?> type="radio"
                                                                  name="block[schedule]"
                                                                  value="0" <?php if (isset($block) && $block->schedule == 0) echo "checked"; ?>/>
                                No </label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Add Tasks
                        </td>
                        <td>
                            <label class="uniform-inline">
                                <input <?php echo $is_disabled ?> type="radio"
                                                                  name="block[schedule_add]"
                                                                  value="1" <?php if (isset($block) && $block->schedule_add == 1) echo "checked"; ?>/>
                                Yes </label>
                            <label class="uniform-inline">
                                <input <?php echo $is_disabled ?> type="radio"
                                                                  name="block[schedule_add]"
                                                                  value="0" <?php if (isset($block) && $block->schedule_add == 0) echo "checked"; ?>/>
                                No </label>
                        </td>
                    </tr>
                                            <!-- <tr>
                                                <td>
                                                    Messages
                                                </td>
                                                <td>
                                                    <label class="uniform-inline">
                                                        <input <?php echo $is_disabled ?> type="radio"
                                                                                          name="block[message]"
                                                                                          value="1" <?php if (isset($block) && $block->message == 1) echo "checked"; ?>/>
                                                        Yes </label>
                                                    <label class="uniform-inline">
                                                        <input <?php echo $is_disabled ?> type="radio"
                                                                                          name="block[message]"
                                                                                          value="0" <?php if (isset($block) && $block->message == 0) echo "checked"; ?>/>
                                                        No </label>
                                                </td>
                                            </tr-->
                    <!--<tr>
                        <td>
                            <?php echo ucfirst($settings->client); ?>s Drafts
                        </td>
                        <td>
                            <label class="uniform-inline">
                                <input <?php echo $is_disabled ?> type="radio"
                                                                  name="block[draft_client]"
                                                                  value="1" <?php if (isset($block) && $block->draft_client == 1) echo "checked"; ?>/>
                                Yes </label>
                            <label class="uniform-inline">
                                <input <?php echo $is_disabled ?> type="radio"
                                                                  name="block[draft_client]"
                                                                  value="0" <?php if (isset($block) && $block->draft_client == 0) echo "checked"; ?>/>
                                No </label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo ucfirst($settings->profile); ?>s Drafts
                        </td>
                        <td>
                            <label class="uniform-inline">
                                <input <?php echo $is_disabled ?> type="radio"
                                                                  name="block[draft_profile]"
                                                                  value="1" <?php if (isset($block) && $block->draft_profile == 1) echo "checked"; ?>/>
                                Yes </label>
                            <label class="uniform-inline">
                                <input <?php echo $is_disabled ?> type="radio"
                                                                  name="block[draft_profile]"
                                                                  value="0" <?php if (isset($block) && $block->draft_profile == 0) echo "checked"; ?>/>
                                No </label>
                        </td>
                    </tr-->
                    <tr>
                        <td>
                            <?php echo ucfirst($settings->document); ?>s Drafts
                        </td>
                        <td>
                            <label class="uniform-inline">
                                <input <?php echo $is_disabled ?> type="radio"
                                                                  name="block[document_draft]"
                                                                  value="1" <?php if (isset($block) && $block->document_draft == 1) echo "checked"; ?>/>
                                Yes </label>
                            <label class="uniform-inline">
                                <input <?php echo $is_disabled ?> type="radio"
                                                                  name="block[document_draft]"
                                                                  value="0" <?php if (isset($block) && $block->document_draft == 0) echo "checked"; ?>/>
                                No </label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Orders Drafts
                        </td>
                        <td>
                            <label class="uniform-inline">
                                <input <?php echo $is_disabled ?> type="radio"
                                                                  name="block[orders_draft]"
                                                                  value="1" <?php if (isset($block) && $block->orders_draft == 1) echo "checked"; ?>/>
                                Yes </label>
                            <label class="uniform-inline">
                                <input <?php echo $is_disabled ?> type="radio"
                                                                  name="block[orders_draft]"
                                                                  value="0" <?php if (isset($block) && $block->orders_draft == 0) echo "checked"; ?>/>
                                No </label>
                        </td>
                    </tr>
                    <!-- <tr>
                                                <td>
                                                    Tasks
                                                </td>
                                                <td>
                                                    <label class="uniform-inline">
                                                        <input <?php echo $is_disabled ?> type="radio"
                                                                                          name="block[tasks]"
                                                                                          value="1" <?php if (isset($block) && $block->tasks == 1) echo "checked"; ?>/>
                                                        Yes </label>
                                                    <label class="uniform-inline">
                                                        <input <?php echo $is_disabled ?> type="radio"
                                                                                          name="block[tasks]"
                                                                                          value="0" <?php if (isset($block) && $block->tasks == 0) echo "checked"; ?>/>
                                                        No </label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Feedback
                                                </td>
                                                <td>
                                                    <label class="uniform-inline">
                                                        <input <?php echo $is_disabled ?> type="radio" name="block[feedback]"
                                                                                          value="1" <?php if (isset($block) && $block->feedback == 1) echo "checked"; ?>/>
                                                        Yes </label>
                                                    <label class="uniform-inline">
                                                        <input <?php echo $is_disabled ?> type="radio" name="block[feedback]"
                                                                                          value="0" <?php if (isset($block) && $block->feedback == 0) echo "checked"; ?>/>
                                                        No </label>
                                                </td>
                                            </tr>-->
                    <tr>
                        <td>
                            Analytics
                        </td>
                        <td>
                            <label class="uniform-inline">
                                <input <?php echo $is_disabled ?> type="radio"
                                                                  name="block[analytics]"
                                                                  value="1" <?php if (isset($block) && $block->analytics == 1) echo "checked"; ?>/>
                                Yes </label>
                            <label class="uniform-inline">
                                <input <?php echo $is_disabled ?> type="radio"
                                                                  name="block[analytics]"
                                                                  value="0" <?php if (isset($block) && $block->analytics == 0) echo "checked"; ?>/>
                                No </label>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            Intact Orders
                        </td>
                        <td>
                            <label class="uniform-inline">
                                <input <?php echo $is_disabled ?> type="radio"
                                                                  name="block[orders_intact]"
                                                                  value="1" <?php if (isset($block) && $block->orders_intact == 1) echo "checked"; ?>/>
                                Yes </label>
                            <label class="uniform-inline">
                                <input <?php echo $is_disabled ?> type="radio"
                                                                  name="block[orders_intact]"
                                                                  value="0" <?php if (isset($block) && $block->orders_intact == 0) echo "checked"; ?>/>
                                No </label>
                        </td>
                    </tr>
                     <!--<tr>
                        <td>
                            Bulk Order
                        </td>
                        <td>
                            <label class="uniform-inline">
                                <input <?php echo $is_disabled ?> type="radio"
                                                                  name="block[bulk]"
                                                                  value="1" <?php if (isset($block) && $block->bulk == 1) echo "checked"; ?>/>
                                Yes </label>
                            <label class="uniform-inline">
                                <input <?php echo $is_disabled ?> type="radio"
                                                                  name="block[bulk]"
                                                                  value="0" <?php if (isset($block) && $block->bulk == 0) echo "checked"; ?>/>
                                No </label>
                        </td>
                    </tr>-->
                    <!--tr>
                                                <td>
                                                    Master <?= $settings->client; ?>
                                                </td>
                                                <td>
                                                    <label class="uniform-inline">
                                                        <input <?php echo $is_disabled ?> type="radio"
                                                                                          name="block[masterjob]"
                                                                                          value="1" <?php if (isset($block) && $block->analytics == 1) echo "checked"; ?>/>
                                                        Yes </label>
                                                    <label class="uniform-inline">
                                                        <input <?php echo $is_disabled ?> type="radio"
                                                                                          name="block[masterjob]"
                                                                                          value="0" <?php if (isset($block) && $block->analytics == 0) echo "checked"; ?>/>
                                                        No </label>
                                                </td>
                                            </tr-->

                </table>
                <?php
                if (!isset($disabled)) {
                    ?>
                    <div class="res"></div>
                    <div class="margin-top-10 alert alert-success display-hide flash" style="display: none;">
                        <button class="close" data-close="alert"></button>
                        Data saved successfully
                    </div>

                    <div class="form-actions"
                         style="height:75px;margin-left:-10px;margin-right:-10px;margin-bottom:-10px;">
                        <div class="row">
                            <div class="col-md-12" align="right">

                                <input type="button" name="submit" class="btn btn-primary" id="save_home"
                                       value="Save Changes"/>

                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </form>
        </div>
        <div
            class="tab-pane <?php if ($this->request->session()->read("Profile.profile_type") == 2 || (isset($Clientcount) && $Clientcount == 0)) echo 'active'; ?>"
            id="subtab_2_4">

            <?php if ($this->request->params['action'] == 'edit' && ($this->request->session()->read("Profile.super") || ($this->request->session()->read("Profile.admin") == 1 || $this->request->session()->read("Profile.profile_type") == 2))) {
                //&& $this->request->session()->read("Profile.id")==$id
                ?>

                <!--
                <div class="portlet box">
                    <div class="portlet-title" style="background: #CCC;">
                        <div class="caption">Assign to client</div>
                    </div>
                    <div class="portlet-body">
                    -->

                <input type="text" id="searchClient" onkeyup="searchClient()" class="form-control"
                       <?php if ($this->request->session()->read('Profile.profile_type') == 2 && $this->request->session()->read('Profile.id') == $id){ ?>disabled=""<?php }?> />
                <div class="scrolldiv">
                    <table class="table" id="clientTable">
                        <?php

                        $clients = $this->requestAction('/clients/getAllClient/');
                        $count = 0;
                        if ($clients) {
                            foreach ($clients as $o) {
                                $pro_ids = explode(",", $o->profile_id);

                                ?>

                                <tr>
                                    <td>

                                        <?php if (strlen($o->image) > 0) {
                                            echo '<img height="32" src="' . $this->request->webroot . 'img/jobs/' . $o->image . '">';
                                        } else {
                                            echo '<img width="32" src="' . $this->request->webroot . 'img/logos/MEELogo.png">';
                                        }?>

                                        <input
                                            <?php if ($this->request->session()->read('Profile.profile_type') == 2 && $this->request->session()->read('Profile.id') == $id){ ?>disabled=""<?php }?>
                                            id="c_<?= $count ?>"
                                            type="checkbox" value="<?php echo $o->id; ?>"
                                            class="addclientz" <?php if (in_array($id, $pro_ids)) {
                                            echo "checked";
                                        }?>  <?php echo $is_disabled ?> /><label for="c_<?= $count ?>"><?php echo $o->company_name; ?></label><span
                                            class="msg_<?php echo $o->id; ?>"></span></td>
                                </tr>

                            <?php
                                $count+=1;
                            }
                        }
                        ?>

                    </table>
                </div>
                <div class="clearfix"></div>

                <!-- </div>
             </div>-->
            <?php } else {
                ?><!--
                                            <div class="portlet box">
                                                <div class="portlet-title">
                                                    <div class="caption">Assign to client</div>
                                                </div>
                                                <div class="portlet-body">-->
                <input type="text" id="searchClient" onkeyup="searchClient()"
                       class="form-control"  <?php echo $is_disabled ?> />
                <div class="scrolldiv">
                    <table class="table scrolldiv" id="clientTable">
                        <?php

                        $clients = $this->requestAction('/clients/getAllClient/');
                        $count = 0;
                        if ($clients)
                            foreach ($clients as $o) {
                                $pro_ids = explode(",", $o->profile_id);
                                ?>

                                <tr>
                                    <td><input  <?php echo $is_disabled ?>
                                            id="c_<?= $count ?>"
                                            type="checkbox" <?php if (in_array($id, $pro_ids)) {
                                            echo "checked";
                                        }?>   value="<?php echo $o->id; ?>"
                                            class="addclientz"/><label for="c_<?= $count ?>"><?php echo $o->company_name; ?></label><span
                                            class="msg_<?php echo $o->id; ?>"></span></td>
                                </tr>

                            <?php
                                $count+=1;
                            }
                        ?>

                    </table>
                </div>
                <div class="clearfix"></div>

                <!--  </div>
              </div>-->
            <?php
            } ?>
            <div class="margin-top-10 alert alert-success display-hide clientadd_flash"
                 style="display: none;">
                <button class="close" data-close="alert"></button>

            </div>

        </div>
        <!--<div class="tab-pane "
                                         id="tab_1_12">
                                        <?php include('subpages/profile/ptype.php');//permissions ?>
                                    </div>
                                    <div class="tab-pane "
                                         id="tab_1_13">
                                        <?php include('subpages/profile/ctype.php');//permissions ?>
                                    </div>-->
    </div>
</div>


<!-- put this back when the form is gone   </div>     </div>   -->

<script>
    $(function () {
        $('#saveptype').live('click', function () {
            $(this).text("Saving");
            var cids = $('.ptypeform input[type="checkbox"]').serialize();
            var id = <?php echo $id;?>;
            $.ajax({
                url: "<?php echo $this->request->webroot;?>profiles/ptypesenb/" + id,
                type: "post",
                dataType: "HTML",
                data: cids,
                success: function (msg) {
                    $('.ptype').show();
                    $('.ptype').fadeOut(7000);
                    $('#saveptype').text('Submit');
                }
            })
        });

        $('#savectype').live('click', function () {
            $(this).text("Saving");
            var cids = $('.ctypeform input[type="checkbox"]').serialize();
            var id = <?php echo $id;?>;
            $.ajax({
                url: "<?php echo $this->request->webroot;?>profiles/ctypesenb/" + id,
                type: "post",
                dataType: "HTML",
                data: cids,
                success: function (msg) {
                    $('.ctype').show();
                    $('.ctype').fadeOut(7000);
                    $('#savectype').text('Submit');
                }
            })
        });
        $('#save_blocks').click(function () {

            $('#save_blocks').text('Saving..');
            var str = $('#blockform input').serialize();
            $.ajax({
                url: '<?php echo $this->request->webroot; ?>profiles/blocks',
                data: str,
                type: 'post',
                success: function (res) {
                    if ($('.profile_enb').is(":checked"))
                        $('#saveptype').click();
                    if ($('.client_enb').is(":checked"))
                        $('#savectype').click();
                    $('#save_display').click();
                    //alert(res);
                    $('.res').text(res);
                    $('.flash').show();
                    $('.flash').fadeOut(7000);
                    $('#save_blocks').text(' Save Changes ');
                }
            })
        });


        $('#save_home').click(function () {
            $('#save_home').text('Saving..');
            var str = $('#homeform input').serialize();
            $.ajax({
                url: '<?php echo $this->request->webroot; ?>profiles/homeblocks',
                data: str,
                type: 'post',
                success: function (res) {
                    //alert(res);
                    $('.res').text(res);
                    $('.flash').show();
                    $('.flash').fadeOut(7000);
                    $('#save_home').text(' Save Changes ');
                }
            })
        });
        $('#save_display').click(function () {
            $('#save_display').text('Saving..');
            var str = $('.doc_more input').serialize();
            $.ajax({
                url: '<?php echo $this->request->webroot;?>profiles/displaySubdocs/<?php echo $id;?>',
                data: str,
                type: 'post',
                success: function (res) {
                    $('.flash').show();
                    $('.flash').fadeOut(7000);
                    $('#save_display').text(' Save Changes ');
                }
            })
        });

    });
</script>
