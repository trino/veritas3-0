<?php
 if($this->request->session()->read('debug'))
        echo "<span style ='color:red;'>subpages/profile/client_types.php #INC118</span>";
 ?>
<div class="portlet box green-haze">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-briefcase"></i>Client Types
        </div>
    </div>
    <div class="portlet-body">
    <div style="float: right; margin-bottom: 5px;" class="col-md-6">
        
        <a href="javascript:;" class="btn btn-primary act" style="float: right;" onclick="$(this).hide();$('.addctype').show();">Add Client Type</a>
        <div class="addctype" style="display: none;">
            <?php foreach($languages as $language) {
                if ($language == "English") {$language2 = "";} else {$language2 = $language;}
                echo '<span class="col-md-4"><input type="text" class="form-control"  placeholder="' . $language . ' title" id="titctype' . $language2 . '_0"/></span>';
            } ?>
            <span class="col-md-3"><a href="javascript:;" id="0" class="btn btn-primary savectypes">Add</a></span>
        </div>
    </div>
        <div class="table-scrollable">
        
            <table
                class="table table-condensed  table-striped table-bordered table-hover dataTable no-footer">
                <thead>
                <tr >
                    <th>Id</th>
                    <?php foreach($languages as $language) {
                        echo '<th>Title (' . $language . ')</th>';
                    } ?>
                    <th>Enable</th>
                    <th>Actions</th>

                </tr>
                </thead>
                <tbody class="allct">
                <?php
                foreach($client_types as $product)
                {?>
                    <tr>
                        <td><?php echo $product->id;?></td>
                        <?php foreach($languages as $language){
                            if ($language == "English"){$language = "";}
                            $keyname = "title" . $language;
                            echo '<td class="titlectype' . $language . '_' . $product->id . '">' . $product->$keyname . '</td>';
                        } ?>
                        <td><input type="checkbox" <?php if($product->enable=='1'){echo "checked='checked'";}?> class="cenable" id="cchk_<?php echo $product->id;?>" /><span class="span_<?php echo $product->id;?>"></span></td>
                        <td><a href="javascript:;" class="btn btn-info editctype" id="editctype_<?php echo $product->id;?>">Edit</a></td>
                    </tr>        
                <?php
                }
                ?>
        </tbody>
        </table>
        
    </div>
    </div>
</div>
<script>

$(function(){
    $('.editctype').live('click', function(){
        var id = $(this).attr('id').replace("editctype_","");
        <?php foreach($languages as $language) {
           if ($language == "English") {$language = "";}
           echo "var va" . $language . " = $('.titlectype" . $language . "_'+id).text();";
       } ?>
        if(va == 'Save'){return false;}

        $('.titlectype_'+id).html('<input type="text" value="'+va+'" class="form-control" id="titctype_'+id+'" /><a class="btn btn-primary savectypes" id ="ctypesave_'+id+'" >Save</a>');
        <?php foreach($languages as $language) {
       if ($language != "English") { ?>
        $('.titlectype<?= $language; ?>_'+id).html('<input type="text" value="'+va<?= $language; ?>+'" class="form-control" id="titctype<?= $language; ?>_'+id+'" /> ');
        <?php }} ?>
    });
    $('.savectypes').live('click',function(){
        var id = $(this).attr('id').replace("ctypesave_","");
        <?php foreach($languages as $language) {
           if ($language == "English") {$language = ""; }
           echo "var title" . $language . " = $('#titctype" . $language . "_'+id).val();";
       } ?>
        $.ajax({
            url:"<?php echo $this->request->webroot;?>profiles/ctypes/"+id,
            type:"post",
            dataType:"HTML",
            data: 'languages=<?php
                echo implode(",", $languages) . "'";
                foreach($languages as $language) {
                    if ($language == "English") {$language = "";}
                    echo ' + "&title' . $language . '=" + title' . $language;
                }
        ?>,
            success:function(msg) {
                if(id!=0) {
                    <?php foreach($languages as $language) {
                       if ($language == "English") {$language = ""; }
                       echo "$('.titlectype" . $language . "_' + id).html(title" . $language . ");";
                   } ?>
                } else {
                    $('.allct').append(msg);
                    $('.addctype').hide();
                    $('.act').show();
                    <?php foreach($languages as $language) {
                     if ($language == "English") {$language = ""; }
                     echo "$('#titctype" . $language . "_0').val('');";
                 } ?>
                }
            }
        })
    });
    $('.cenable').live('click',function(){
        var enb = "";
        var ids = $(this).attr('id');
        var id =  ids.replace("cchk_","");
       //alert(id);
       if($(this).is(":checked")) {
           enb = "1";
       }else {
           enb = "0";
       }

      $.ajax({
        url:"<?php echo $this->request->webroot;?>profiles/ctypesenable/"+id,
        data:"enable="+enb,
        type:"post",
        success: function(msg){
            $('.span_'+id).html(msg);
            $('.span_'+id).show();
            $('.span_'+id).fadeOut(2000);
        }
      })      
            
    });
})
</script>