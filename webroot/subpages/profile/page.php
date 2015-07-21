<!-- BEGIN PORTLET-->
<!--<div class="portlet box green-haze">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-briefcase"></i>Pages
        </div>
        -->
<?php
 if($this->request->session()->read('debug')){ echo "<span style ='color:red;'>subpages/profile/page.php #INC123</span>";}
include_once("subpages/api.php");
$languages = languages();

function makepage($languages, $webroot, $tabIndex, $name, $cms, $active){
    //$cms = $This->requestAction("/pages/get_content/' . $name . '");
    $Title = ucfirst(str_replace("_", " ", $name));

    echo '<!-- BEGIN FORM-->
                                        <div class="tab-pane ' . $active . '" id="subtab_1_' . $tabIndex . '">
                                            <div class="portlet box">
                                                <div class="portlet-body form">
<form action="' . $webroot . 'pages/edit/' . $name . '" method="post" class="form-horizontal form-bordered" id="' . $name . '">
    <div class="form-body">
        <div class="form-group last">
            <label class="col-md-2"></label>';

    echo '<INPUT TYPE="HIDDEN" NAME="languages" VALUE="' . implode(",", $languages) . '">';
    foreach($languages as $language) {
        echo '<label class="col-md-5" align="CENTER">' . $language . '</label>';
    }

    echo '    </div>
    </div>

    <div class="form-body">
        <div class="form-group last">
            <label class="control-label col-md-2">' . $Title . ' Title</label>';

    foreach($languages as $language) {
        if ($language == "English") {$language = "";}
        $keyname = "title"  . $language;

        echo '    <div class="col-md-5">
                <input class="form-control" name="title' . $language . '" id="title' . $language . '-' . $name . '" value="' . ucfirst($cms->$keyname) . '"/>
            </div>';
    }
           echo '
        </div>
    </div>
    <div class="form-body">
        <div class="form-group last">
            <label class="control-label col-md-2">Description</label>';

    foreach($languages as $language) {
        if ($language == "English") {$language = "";}
        $keyname = "desc" . $language;

        echo '   <div class="col-md-5">
                                                                    <textarea class="ckeditor form-control"
                                                                              name="desc' . $language . '" rows="6" id="desc' . $language . '">' . $cms->$keyname . '</textarea>
            </div>';
    }

       echo ' </div>
    </div>
    <div class="form-actions" style="margin-left: -10px;margin-right: -10px;">
        <div class="row" align="right">
            <div class="col-md-offset-2 col-md-10">
                <button type="submit"   class="btn blue" onclick="savepage(' . "'" . $name . "'" . ');">
                    Save Changes
                </button>
                <button type="button" class="btn default" style="margin-right: 8px;">Cancel
                </button>
            </div>
        </div>

    </div>
</form></div></div></div>
<!-- END FORM-->';
    return "";
}

$pages = array(11 => "product_example", 6 => "help",  7 => "privacy_code", 8 => "version_log",  4 => "terms", 5 => "faq");

echo '<ul class="nav nav-tabs nav-justified">';
$class = "active";
foreach($pages as $key => $value){
    $Title = ucfirst(str_replace("_", " ", $value));
    echo '<li class="' . $class . '"><a href="#subtab_1_' . $key . '" data-toggle="tab">' . $Title . '</a></li>';
    $class="";
}
echo '</ul><div class="portlet-body"><div class="tab-content">';
$class = "active";
foreach($pages as $key => $value){
    $class = makepage($languages, $this->request->webroot, $key, $value, $this->requestAction("/pages/get_content/" . $value), $class);
}
 ?>



                                                <!--div class="portlet-title">
                                                    <div class="caption">
                                                        <i class="fa fa-gift"></i>Page Manager - Help
                                                    </div>
                                                </div-->

                                    </div></div>
<script>
    /*function savepage(slug){
        var title = $('#title-'+slug).val();
        var editor1 = 'desc'+slug;
        var desc = CKEDITOR.instances.editor1.getData();
        alert(title+","+desc);
        $.ajax({
        });
    }*/

</script>

<!-- </div></div>-->
<!-- END PORTLET-->