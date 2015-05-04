<H3 class="page-title">Settings</H3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="<?= $this->request->webroot ?>">Dashboard</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="">Settings</a>
        </li>
    </ul>
</div>


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
    $is_disabled = '';
    if (isset($disabled)) {$is_disabled = 'disabled="disabled"';}
    if (isset($profile)) {$p = $profile;}
    $settings = $this->requestAction('settings/get_settings');

function makeselect($is_disabled=false, $Name=""){
    if($Name){
        echo '<select class="form-control" ' . $is_disabled . ' id="'. $Name . '" >';
    }else{
        echo "</select>";
    }
}
function makedropdown($is_disabled, $Name, $TheValue, $Language, $EnglishValues, $FrenchValues = ""){
    makeselect($is_disabled, $Name);
    if ($FrenchValues == ""){ $Language = "English"; }
    $variable = $Language . "Values";
    foreach($$variable as $Key => $Value){
        makedropdownoption($Key, $Value, $TheValue);
    }
    echo '</select>';
}
function makedropdownoption($Key, $Value, $TheValue){
    echo '<option value="' . $Key . '"';
    if($TheValue == $Key){echo "selected='selected'";}
    echo '>' . $Value . '</option>';
}

?>

<div class="clearfix"></div>
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->



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

        <!--BEGIN TABS-->
        <div class="tabbable tabbable-custom">
            <ul class="nav nav-tabs">
                <?php
                if ($this->request['action'] != 'add') {
                    if ($this->request->session()->read('Profile.admin') && $this->request->session()->read('Profile.super')) {
                        ?>
                            <li <?php if(!isset($_GET['activedisplay'])){ ?> class="active" <?php } ?> >
                                    <a href="#tab_1_5" data-toggle="tab">Logo</a>
                            </li>
                            <li>
                                <a href="#tab_1_6" data-toggle="tab">Pages</a>
                            </li>
                            <li>
                                <a href="#tab_1_8" data-toggle="tab">Display</a>
                            </li>
                             <li>
                                <a href="#tab_1_10" data-toggle="tab">Packages</a>
                            </li>
                            <li>
                                <a href="#tab_1_14" data-toggle="tab">Configuration</a>
                            </li>
                            <li>
                                <a href="#tab_1_15" data-toggle="tab">Client Logo</a>
                            </li>
                             <?php
                             if($_SERVER['SERVER_NAME'] =='localhost') {
                             ?>
                             <li>
                                <a href="#tab_1_9" data-toggle="tab">Clear Data</a>
                            </li>
                            <?php
                            }
                                if($this->request->session()->read('Profile.super')) {
                            ?>
                            <li <?php if(isset($_GET['activedisplay'])){ ?> class="active" <?php } ?> >
                                    <a href="#tab_1_13" data-toggle="tab">Add/Edit Documents</a>
                            </li>
                            <LI>
                                <A HREF="producteditor">Product Types</A>
                            </LI>
                            <?php
                            }
                        }
                }

                ?>
            </ul>


            <div class="tab-content">
                <?php
                if ($this->request['action'] != 'add') {
                          if(!isset($_GET['activedisplay'])) {
                            echo '<div class="tab-pane active"  id="tab_1_5">';
                          } else {
                            echo '<div class="tab-pane"  id="tab_1_5">';
                          }
                           include('subpages/profile/logo.php');
                            echo '</div>';
                         ?>
                    

                    <div class="tab-pane" id="tab_1_6">
                        <?php include('subpages/profile/page.php'); ?>
                    </div>
                    <div class="tab-pane" id="tab_1_8">
                        <?php include('subpages/profile/client_setting.php'); ?>
                    </div>
                    <div class="tab-pane" id="tab_1_10">
                        <?php include('products.ctp'); //subpages/profile/products.php'); ?>
                    </div>
                    <div class="tab-pane" id="tab_1_15">
                        <?php include('subpages/client_logo.php'); ?>
                    </div>
                    <div class="tab-pane" id="tab_1_14">
                        <div class="tabbable tabbable-custom">
                            <ul class="nav nav-tabs">
                           
                                <li class="active">
                                    <a href="#tab_1_11" data-toggle="tab">Profile Types</a>
                                </li>
                                <li>
                                    <a href="#tab_1_12" data-toggle="tab">Client Types</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                 <div class="tab-pane active" id="tab_1_11">
                                    <?php include('subpages/profile/profile_types.php'); ?>
                                </div>
                                 <div class="tab-pane" id="tab_1_12">
                                    <?php include('subpages/profile/client_types.php'); ?>
                                </div>
                            </div>
                           </div>
                    </div>
                     <?php
                     if($_SERVER['SERVER_NAME'] =='localhost') {
                     ?>
                    <div class="tab-pane" id="tab_1_9">
                        <a href="javascript:void(0)" class="btn btn-danger" id="cleardata">Clear Data</a>
                        <div class="margin-top-10 alert alert-success display-hide cleardata_flash" style="display: none;">
                           Data Successfully Cleared.
                                                    <button class="close" data-close="alert"></button>
                                                   
                        </div>
                    </div>
                    <?php
                    }
                    if($this->request->session()->read('Profile.super')){
                          if(isset($_GET['activedisplay'])){
                            ?>
                            <div class="tab-pane active"  id="tab_1_13">
                            <?php
                          }else{
                            ?>
                            <div class="tab-pane"  id="tab_1_13">
                          <?php
                          }
                          ?>
                          <div class="col-md-12" style="text-align: right;">
                                <a href="#" class="btn btn-success"  style="margin:10px 0;" onclick="$('#sub_add').toggle(150);">Add New SubDocument</a>
                                <div class="col-md-12" id="sub_add" style="display: none;margin:10px 0;padding:0">
                                    <div class="col-md-10" style="text-align: right;padding:0;">
                                        <input type="text" placeholder="Sub-Document English title" class="form-control subdocname" />
                                        <input type="text" placeholder="Sub-Document French title" class="form-control subdocnameFrench" />
                                        <span class="error passerror flashSubDoc"
                                          style="display: none;">Subdocument name already exists</span>
                                        <span class="error passerror flashSubDoc1"
                                          style="display: none;">Please enter a subdocument name.</span>
                                    </div>
                                    <div class="col-md-2" style="text-align: right;padding:0;">
                                        <a class="btn btn-primary addsubdoc" href="javascript:void(0)">Add</a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                                        <div class="clearfix"></div>
                    <?php $subdoc = $this->requestAction('/clients/getSub'); ?>
                        <table class="table table-light table-hover sortable">
                            <tr class="myclass">
                                <th>English Title</th>
                                <th>French Title</th>
                                <th class="" colspan="2">Action</th>
                            </tr>
                                <?php
                                foreach($subdoc as $sub) {
                                ?>
                            <tr>
                                <td>
                                    <span><?php echo ucfirst($sub['title']); ?></span>
                                </td>
                                <td>
                                    <span><?php echo ucfirst($sub['titleFrench']); ?></span>
                                </td>
                                <td>
                                    <a href="javascript:void(0)" class="btn-xs btn-success"
                                       onclick="$('#edit_sub_<?php echo $sub['id']; ?>').toggle(150);$('.msg').hide();">Edit</a>
                                </td>
                                <td>
                                    <div class="col-md-12" id="edit_sub_<?php echo $sub['id']; ?>"
                                         style="display: none;margin:10px 0;padding:0">
                                        <div class="col-md-12" style="text-align: right;padding:0;">
                                            <input type="text" id="editsubdocname_<?php echo $sub['id']; ?>"
                                                   value="<?php echo ucfirst($sub['title']); ?>"
                                                   placeholder="Sub-Document English title"
                                                   class="form-control editsubdocname"/>
                                            <input type="text" id="editsubdocnameFrench_<?php echo $sub['id']; ?>"
                                                   value="<?php echo ucfirst($sub['titleFrench']); ?>"
                                                   placeholder="Sub-Document French title"
                                                   class="form-control editsubdocname"/>
                                            <span class="error" id="flasheditSub_<?php echo $sub['id']; ?>"
                                                  style="display: none;">Subdocument name already exists</span>
                                            <span class="error" id="flasheditSub1_<?php echo $sub['id']; ?>"
                                                  style="display: none;">Please enter a subdocument name.</span>
                                        </div>
                                        <br/><br/>

                                        <div class="col-md-12" style="text-align: right;padding:0;">
                                            <select class="form-control" id="select_color_<?php echo $sub['id']; ?>">
                                                <option value="">Select a color class</option>
                                                <?php
                                                $color = $this->requestAction('clients/getColorClass');
                                                if ($color) {
                                                    foreach ($color as $c) {
                                                        ?>
                                                        <option
                                                            value="<?php echo $c->id; ?>" <?php if (isset($sub['color_id']) && $sub['color_id'] == $c->id) { ?> selected="selected"<?php } ?>
                                                            style="background: <?php echo $c->rgb; ?>;"><?php echo $c->color; ?></option>
                                                    <?php
                                                    }
                                                }
                                                makeselect();

                                                makeselect($is_disabled, "select_icon_" . $sub['id']);
                                                makedropdownoption("", "Default", $sub["icon"]);
                                                makedropdownoption("fa icon-footprint", "Footprint", $sub["icon"]);
                                                makedropdownoption("fa icon-surveillance", "Surveillance", $sub["icon"]);
                                                makedropdownoption("fa icon-physical", "Physical", $sub["icon"]);
                                                makeselect();

                                                makeselect($is_disabled, "select_product_" . $sub['id']);
                                                foreach ($products as $product){
                                                    makedropdownoption($product->number, $product->title, $sub["ProductID"]);
                                                }
                                            makeselect();
                                             ?>




                                            <span class="error" id="flashSelectColor_<?php echo $sub['id']; ?>"
                                              style="display: none; width: auto;">Please  select a color.</span>
                                          </div> <br /> <br />
                                        <div class="col-md-12" style="text-align: right;padding:0;">
                                            <a class="btn-xs btn-primary editsubdoc" id="subbtn<?php echo $sub['id']; ?>" href="javascript:void(0)">Save</a>
                                            <a href="?DeleteDoc=<?php echo $sub['id']; ?>" class="btn-xs btn-danger deletesubdoc" id="delsubbtn" onclick="return confirm('Are you sure you want to delete <?= $sub['title'] ?>?');">Delete</a>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <span id="msg_<?php echo $sub['id']; ?>"></span>
                                <!--</div>-->
                            </td>
                            </tr>
                                    <?php
                                } 
                                }
                                ?>
                                
                        </table>
                        <?php
                        }
                         ?>
                         <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>





<script>
     function initiate_ajax_upload(button_id,type) {
        if(type == 'logo') {
            var url = "<?php echo $this->request->webroot;?>profiles/upload_img/<?php if(isset($id))echo $id;?>";
        }else {
            var url = "<?php echo $this->request->webroot;?>profiles/client_default";
        }
        var button = $('#' + button_id), interval;
        new AjaxUpload(button, {
            action: url,
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
                if(type == 'logo') {
                    $("#clientpic").attr("src", '<?php echo $this->request->webroot;?>img/profile/' + response);
                    $('#client_img').val(response);
                } else {
                   //alert(response);
                    if(response != "error"){
                        $(".default_image").attr("src", '<?php echo $this->request->webroot;?>img/clients/' + response);
                        $('.flash').show();
                    } else {
                        $('.flash1').show();
                    }
                    //$('#client_img').val(response);
                }
            }
        });
    }
    $(function () {
        
        $('#cleardata').click(function(){
            $(this).attr("disabled","disabled");
            var dn = confirm("Confirm Clear Database Data.");
            if(dn == true)
            {
                $.ajax({
                    url:"<?php echo $this->request->webroot;?>profiles/cleardb",
                    type:"post",
                    success:function(msg){
                            $('#cleardata').removeAttr("disabled");
                            if(msg =='Cleared')
                            $(".cleardata_flash").show();
                    }
                });
            }
            
        });
        
        $('.addsubdoc').click(function(){
           var subname = $('.subdocname').val();
           var subnameFrench = $('.subdocnameFrench').val();
           if(subname == ''  ) {
                $('.flashSubDoc1').show();
                $('.flashSubDoc').hide();
                $('.subdocname').focus();
                        $('html,body').animate({
                                scrollTop: $('.page-title').offset().top
                            },
                            'slow');

                        return false;
           } else {
            $.ajax({
                url: '<?php echo $this->request->webroot;?>clients/check_document',
                data: 'subdocumentname=' + subname + '&subdocumentnameFrench=' + subnameFrench,
                type: 'post',
                success: function (res) {//alert(res);
                    if (res == '1') {
                        //alert(res);
                        $('.flashSubDoc').show();
                        $('.flashSubDoc1').hide();
                        $('.subdocname').focus();
                        $('html,body').animate({
                                scrollTop: $('.page-title').offset().top
                            },
                            'slow');

                        return false;
                    } else {
                         window.location = '<?php echo $this->request->webroot;?>clients/addsubdocs/?sub=' + subname + "&subFrench=" + subnameFrench;
                    }
                } 
            });
            } 
        });
        
        $('.editsubdoc').click(function(){
            $(this).html('Saving..'); 
            var id = $(this).attr('id').replace('subbtn','');
            var subname = $('#editsubdocname_'+id).val();
            var subnameFrench = $('#editsubdocnameFrench_'+id).val();
            var color = $('#select_color_'+id).val();
            var icon = $('#select_icon_'+id).val();
            var product = $('#select_product_'+id).val();

            var msg = '';
            var nameId = 'msg_'+id; //
            $('#flasheditSub1_'+id).hide();
                $('#flasheditSub_'+id).hide();
                $('#flashSelectColor_'+id).hide();
           if(!color && subname == '' && subnameFrench =='') {
                $('#flasheditSub1_'+id).show();
                $('#flasheditSub_'+id).hide();
                $('#flashSelectColor_'+id).show();
                $('#editsubdocname_'+id).focus();
                        $('html,body').animate({
                                scrollTop: $('#edit_sub_'+id).offset().top
                            },
                            'slow');
            $('#subbtn'+id).html('Save');
                        return false;
           } else if(!color && subname != '' && subnameFrench != '') {
            
            /**************************************************************************************************/
            
            
            $.ajax({
                url: '<?php echo $this->request->webroot;?>clients/check_document/'+id,
                data: 'subdocumentname=' + subname + '&subdocumentnameFrench=' + subnameFrench,
                type: 'post',
                success: function (res) {//alert(res);
                    if (res == '1') {
                        //alert(res);
                        $('#flasheditSub_'+id).show();
                        $('#flasheditSub1_'+id).hide();
                        $('#flashSelectColor_'+id).show();
                        $('#editsubdocname_'+id).focus();
                        $('html,body').animate({
                                scrollTop: $('#edit_sub_'+id).offset().top
                            },
                            'slow');
            $('#subbtn'+id).html('Save');
                        return false;
                    } else {
                        $('#flasheditSub1_'+id).hide();
                        $('#flasheditSub_'+id).hide();
                        $('#flashSelectColor_'+id).show();
                        $('#select_color_'+id).focus();
                                $('html,body').animate({
                                        scrollTop: $('#edit_sub_'+id).offset().top
                                    },
                                    'slow');
                         $('#subbtn'+id).html('Save');
                        return false;
                    }
                } 
            });
            
            
            /****************************************************************************************************/
                
           } else if(color && subname == '' && subnameFrench == '') {
                $('#flasheditSub1_'+id).show();
                $('#flasheditSub_'+id).hide();
                $('#flashSelectColor_'+id).hide();
                $('#editsubdocname_'+id).focus();
                        $('html,body').animate({
                                scrollTop: $('#edit_sub_'+id).offset().top
                            },
                            'slow');
            $('#subbtn'+id).html('Save');
                        return false;
           } else if(color && subname != '' ) {
            $.ajax({
                url: '<?php echo $this->request->webroot;?>clients/check_document/'+id,
                data: 'subdocumentname=' + subname+ '&subdocumentnameFrench' + subnameFrench,
                type: 'post',
                success: function (res) {//alert(res);
                    if (res == '1') {
                        //alert(res);
                        $('#flasheditSub_'+id).show();
                        $('#flasheditSub1_'+id).hide();
                        //$('#flashSelectColor_'+id).hide();
                        $('#editsubdocname_'+id).focus();
                        $('html,body').animate({
                                scrollTop: $('#edit_sub_'+id).offset().top
                            },
                            'slow');
            $('#subbtn'+id).html('Save');

                        return false;
                    } else {
                            msg = '<span class="msg" style="color:#45B6AF">Saved</span>';
                            var url = '<?php echo $this->request->webroot;?>clients/addsubdocs/?sub=' + subname + '&subFrench=' + subnameFrench + '&updatedoc_id=' + id;
                            url = url + "&icon=" + icon + "&productid=" + product;
                            if(color){url = url + '&color=' + color;}
                    $.ajax({
                        url: url,success:function(){
                            $('#edit_sub_'+id).hide();
                            $('#'+nameId).show();
                        $('#'+nameId).html(msg);
                        $('#sub_'+id).html(subname);
                        $('#subbtn'+id).html('Save');
                        }
                        });
                    }
                } 
            });
            } 
        });
         initiate_ajax_upload('client_default','client');
        <?php
        if(isset($id))
        {
         ?>
            initiate_ajax_upload('clientimg','logo');
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

