<!-- BEGIN PORTLET-->
<!--<div class="portlet box green-haze">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-briefcase"></i>Pages
        </div>
        -->
<?php
 if($_SERVER['SERVER_NAME'] =='localhost')
        echo "<span style ='color:red;'>page.php #INC123</span>";
 ?>        
                                        <ul class="nav nav-tabs nav-justified">


                                            <li class="active"><!-- warning: first and third tabs do not work! -->
                                                <a href="#subtab_1_11" data-toggle="tab">Products</a>
                                            </li>
                                            <li class="">
                                                <a href="#subtab_1_6" data-toggle="tab">Help</a>
                                            </li>
                                            <li>
                                                <a href="#subtab_1_7" data-toggle="tab">Privacy</a>
                                            </li>
                                            <li>
                                                <a href="#subtab_1_4" data-toggle="tab">Terms</a>
                                            </li>

                                            <li class="">
                                                <a href="#subtab_1_5" data-toggle="tab">FAQ</a>
                                            </li>
                                            <li class="">
                                                <a href="#subtab_1_8" data-toggle="tab">Version Log</a>
                                            </li>


                                        </ul>
                                    <!--</div>-->
    <div class="portlet-body">
                                    <div class="tab-content">

                                                <!--div class="portlet-title">
                                                    <div class="caption">
                                                        <i class="fa fa-gift"></i>Page Manager - Help
                                                    </div>

                                                </div-->


                                                    <!-- BEGIN FORM-->
                                        <div class="tab-pane active" id="subtab_1_11">
                                            <div class="portlet box">
                                                <div class="portlet-body form">
                                                    <?php $cms = $this->requestAction("/pages/get_content/product_example");?>
                                                    <form action="<?php echo $this->request->webroot;?>pages/edit/product_example" method="post" class="form-horizontal form-bordered" id="product_example">
                                                        <div class="form-body">
                                                            <div class="form-group last">
                                                                <label class="control-label col-md-2">Product Example Title</label>

                                                                <div class="col-md-4">
                                                                    <input class="form-control" name="title" id="title-product_example"
                                                                           value="<?php echo ucfirst($cms->title);?>"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-body">
                                                            <div class="form-group last">
                                                                <label class="control-label col-md-2">Description</label>

                                                                <div class="col-md-9">
                                                                    <textarea class="ckeditor form-control"
                                                                              name="editor1" rows="6" id="descproduct_example"><?php echo $cms->desc;?></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-actions" style="margin-left: -10px;margin-right: -10px;">
                                                            <div class="row" align="right">
                                                                <div class="col-md-offset-2 col-md-9">
                                                                    <button type="submit"   class="btn blue" onclick="savepage('product_example');">
                                                                        Save Changes
                                                                    </button>
                                                                    <button type="button" class="btn default" style="margin-right: 8px;">Cancel
                                                                    </button>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </form></div></div></div>
                                                    <!-- END FORM-->






                                        <div class="tab-pane" id="subtab_1_6">
                                            <div class="portlet box">
                                                <!--div class="portlet-title">
                                                    <div class="caption">
                                                        <i class="fa fa-gift"></i>Page Manager - Privacy Code
                                                    </div>

                                                </div-->

                                                <div class="portlet-body form">
                                                    <!-- BEGIN FORM-->
                                                    <?php $cms = $this->requestAction("/pages/get_content/help");?>
                                                    <form action="<?php echo $this->request->webroot;?>pages/edit/help" method="post" class="form-horizontal form-bordered" id="help">
                                                        <div class="form-body">
                                                            <div class="form-group last">
                                                                <label class="control-label col-md-2">Help Title</label>

                                                                <div class="col-md-4">
                                                                    <input class="form-control" name="title"  value="<?php echo ucfirst($cms->title);?>" id="title-help"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-body">
                                                            <div class="form-group last">
                                                                <label
                                                                    class="control-label col-md-2">Description</label>

                                                                <div class="col-md-9">
                                                                    <textarea class="ckeditor form-control" name="editor1" rows="6" id="deschelp"><?php echo $cms->desc;?></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-actions" style="margin-left: -10px;margin-right: -10px;">
                                                            <div class="row" align="right">
                                                                <div class="col-md-offset-2 col-md-9">
                                                                <button type="submit" class="btn blue" onclick="savepage('help');"> Save Changes
                                                                    </button>
                                                                    <button type="button" class="btn default" style="margin-right: 8px;">Cancel
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <!-- END FORM-->
                                                </div>
                                            </div>

                                        </div>

                                        <div class="tab-pane" id="subtab_1_7">
                                            <div class="portlet box">
                                                <!--div class="portlet-title">
                                                    <div class="caption">
                                                        <i class="fa fa-gift"></i>Page Manager - Product Example
                                                    </div>

                                                </div-->

                                                <div class="portlet-body form">
                                                    <!-- BEGIN FORM-->
                                                    <?php $cms = $this->requestAction("/pages/get_content/privacy_code");?>
                                                    <form action="<?php echo $this->request->webroot;?>pages/edit/privacy_code"  method="post"class="form-horizontal form-bordered" id="privacy_code">
                                                        <div class="form-body">
                                                            <div class="form-group last">
                                                                <label class="control-label col-md-2">Privacy Title</label>

                                                                <div class="col-md-4">
                                                                    <input class="form-control" name="title" id="title-privacy_code"
                                                                           value="<?php echo ucfirst($cms->title);?>"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-body">
                                                            <div class="form-group last">
                                                                <label
                                                                    class="control-label col-md-2">Description</label>

                                                                <div class="col-md-9">
                                                                    <textarea class="ckeditor form-control"
                                                                              name="editor1" rows="6" id="descprivacy_code"><?php echo $cms->desc;?></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-actions"  style="margin-left: -10px;margin-right: -10px;">
                                                            <div class="row" align="right">
                                                                <div class="col-md-offset-2 col-md-9">
                                                                    <button type="submit"  class="btn blue" onclick="savepage('privacy_code');"> Save Changes
                                                                    </button>
                                                                    <button type="button" class="btn default" style="margin-right: 8px;">Cancel
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <!-- END FORM-->
                                                </div>
                                            </div>

                                        </div>




                                        <div class="tab-pane" id="subtab_1_8">
                                            <div class="portlet box">
                                                <!--div class="portlet-title">
                                                    <div class="caption">
                                                        <i class="fa fa-gift"></i>Page Manager - Product Example
                                                    </div>

                                                </div-->

                                                <div class="portlet-body form">
                                                    <!-- BEGIN FORM-->
                                                    <?php $cms = $this->requestAction("/pages/get_content/version_log");?>
                                                    <form action="<?php echo $this->request->webroot;?>pages/edit/version_log"  method="post"class="form-horizontal form-bordered" id="version_log">
                                                        <div class="form-body">
                                                            <div class="form-group last">
                                                                <label class="control-label col-md-2">Version Log Title</label>

                                                                <div class="col-md-4">
                                                                    <input class="form-control" name="title" id="title-version_log"
                                                                           value="<?php echo ucfirst($cms->title);?>"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-body">
                                                            <div class="form-group last">
                                                                <label
                                                                    class="control-label col-md-2">Description</label>

                                                                <div class="col-md-9">
                                                                    <textarea class="ckeditor form-control"
                                                                              name="editor1" rows="6" id="descprivacy_code"><?php echo $cms->desc;?></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-actions" style="margin-left: -10px;margin-right: -10px;">
                                                            <div class="row" align="right">
                                                                <div class="col-md-offset-2 col-md-9" align="right">
                                                                    <button type="submit"  class="btn blue" onclick="savepage('privacy_code');">
                                                                        Save Changes
                                                                    </button>
                                                                    <button type="button" class="btn default" style="margin-right: 8px;">Cancel
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <!-- END FORM-->
                                                </div>
                                            </div>

                                        </div>



                                        <div class="tab-pane" id="subtab_1_4">
                                            <div class="portlet box">
                                                <!--div class="portlet-title">
                                                    <div class="caption">
                                                        <i class="fa fa-gift"></i>Page Manager - Terms
                                                    </div>

                                                </div-->

                                                    <div class="portlet-body form">
                                                        <!-- BEGIN FORM-->
                                                          <?php $cms = $this->requestAction("/pages/get_content/terms");?>
                                                        <form action="<?php echo $this->request->webroot;?>pages/edit/terms"  method="post"class="form-horizontal form-bordered" id="terms">
                                                            <div class="form-body">
                                                                <div class="form-group last">
                                                                    <label class="control-label col-md-2">Terms Title</label>

                                                                    <div class="col-md-4">
                                                                        <input class="form-control" name="title" id="title-terms" value="<?php echo ucfirst($cms->title);?>"/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-body">
                                                                <div class="form-group last">
                                                                    <label class="control-label col-md-2">Description</label>

                                                                    <div class="col-md-9">
                                                                        <textarea class="ckeditor form-control" id="descterms"
                                                                                  name="editor1" rows="6"><?php echo $cms->desc;?></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-actions" style="margin-left: -10px;margin-right: -10px;">
                                                                <div class="row" align="right">
                                                                    <div class="col-md-offset-2 col-md-9">
                                                                        <button type="submit"  class="btn blue" onclick="savepage('terms');">
                                                                            Save Changes
                                                                        </button>
                                                                        <button type="button" class="btn default" style="margin-right: 8px;">Cancel</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        <!-- END FORM-->
                                                    </div>
                                                </div>

                                        </div>

                                        <div class="tab-pane" id="subtab_1_5">
                                            <div class="portlet box">
                                                <!--div class="portlet-title">
                                                    <div class="caption">
                                                        <i class="fa fa-gift"></i>Page Manager - FAQ
                                                    </div>

                                                </div-->

                                                <div class="portlet-body form">
                                                    <!-- BEGIN FORM-->
                                                    <?php $cms = $this->requestAction("/pages/get_content/faq");?>
                                                    <form action="<?php echo $this->request->webroot;?>pages/edit/faq"  method="post"class="form-horizontal form-bordered" id="faq">
                                                        <div class="form-body">
                                                            <div class="form-group last">
                                                                <label class="control-label col-md-2">FAQ Page Title</label>

                                                                <div class="col-md-4">
                                                                    <input class="form-control" name="title" id="title-faq"
                                                                           value="<?php echo ucfirst($cms->title);?>"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-body">
                                                            <div class="form-group last">
                                                                <label
                                                                    class="control-label col-md-2">Description</label>

                                                                <div class="col-md-9">
                                                                    <textarea class="ckeditor form-control" id="descfaq"
                                                                              name="editor1" rows="6"><?php echo $cms->desc;?></textarea>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-actions" style="margin-left: -10px;margin-right: -10px;">
                                                            <div class="row" style="margin-left: -10px;">
                                                                <div class="col-md-offset-2 col-md-9" align="right">
                                                                    <button type="submit"   class="btn blue" onclick="savepage('faq');"> Save Changes
                                                                    </button>
                                                                    <button type="button" class="btn default" style="margin-right: 8px;">Cancel
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <!-- END FORM-->
                                                </div>
                                            </div>

                                        </div>

                                    </div>
<script>
    /*function savepage(slug)
    {
        var title = $('#title-'+slug).val();
        var editor1 = 'desc'+slug;
        var desc = CKEDITOR.instances.editor1.getData();
        alert(title+","+desc);
        $.ajax({
            
        });
    }*/

</script>
    </div>
<!--</div>-->
<!-- END PORTLET-->