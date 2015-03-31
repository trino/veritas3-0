<?php
 if($_SERVER['SERVER_NAME'] =='localhost'){ echo "<span style ='color:red;'>subpages/documents/attachments.php #INC131</span>";}
 ?>
<?php
$is_disabled = '';//there is no place for attachments
if(isset($disabled)) { $is_disabled = 'disabled="disabled"'; }

echo '<form role="form" enctype="multipart/form-data" action="' . $this->request->webroot . 'documents/addattachment/' . $cid . '/' . $did . '" method="post" id="form_tab7">';

include_once 'subpages/filelist.php';
printdocumentinfo($did);
?>

    <div class="row">
    <input type="hidden" class="document_type" name="document_type" value="Attachment"/>
    <input type="hidden" name="sub_doc_id" value="7" class="sub_docs_id" id="af" />
    <div class="form-group col-md-12">
            <label class="control-label col-md-3">Title</label>
            <div class="col-md-6">
                <input type="text" class="form-control" name="title" <?php echo $is_disabled;?> value="<?php if(isset($mod->title)){echo $mod->title;} ?>" />
            </div>
            <!--<div class="clearfix"></div>-->
           
    </div>
     <?php
        //include('subpages/documents/attach_doc.php');
     /* 
    if(isset($attachments) && count($attachments)>0){
        $allowed = array('jpg','jpeg','png','bmp','gif');
        ?>
       <?php
        foreach($attachments as $k=>$cd):
           
        ?>
         <div class="form-group col-md-12">
        <label class="control-label col-md-3">&nbsp;</label>
            <div class="col-md-6">
        <?php  
                $e = explode(".",$cd->file);
                $ext = end($e);
                if(in_array($ext, $allowed))
                {?>
                <img src="<?php echo $this->request->webroot;?>attachments/<?php echo $cd->file;?>" style="max-width: 200px;" />
                    
        <?php
                }
                else
                    echo "<span onclick='window.open(\"".$this->request->webroot."documents/download/".$cd->file."\")'>".$cd->file."</span>";
        ?>
        <!--<a href="<?php echo $this->request->webroot.'documents/download/'.$cd->file;?>" class="btn btn-inverse">Download</a>-->
        <a href="javascript:void(0);" onclick="$(this).parent().parent().remove()" class="btn btn-danger">Delete</a>
        <input type="hidden" name="client_doc[]" value="<?php echo $cd->file;?>" class="moredocs"/>
        </div>
        </div>   
    <?php
        endforeach;
  }?>
   <?php if(!isset($disabled)){?>
  <div class="form-group col-md-12 docMore"  data-count="1">
    <label class="control-label col-md-3">Attachments</label>
            <div class="col-md-6">
                <!--<input type="file" name="file"  />-->
                <?php if(isset($mod)){echo $mod->file;}?>
         <a href="javascript:void(0)" id="addMore1"  class="btn btn-primary">Browse</a>
          <input type="hidden" name="client_doc[]" value="" class="addMore1_doc moredocs"/>
          </div>
   </div>
    <div class="form-group col-md-12"  >
    <label class="control-label col-md-3">&nbsp;</label>
    <div class="col-md-6">
        <a href="javascript:void(0)" class="btn btn-info" id="addMoredoc" >Add More</a>
    </div>
    </div>
   <?php } */?>
    </div>


 <div class="addattachment7 form-group col-md-12"></div>
  </form>
 <div class="clearfix"></div>
<script>
$(function()
{
    $('#form_tab7').find("a").show();
 });
     <?php //if(!isset($disabled)){?>
    //initiate_ajax_upload('addMore1','doc');
    <?php //}?>
    /*$('#addMoredoc').click(function(){
         var total_count = $('.docMore').data('count');
        $('.docMore').data('count',parseInt(total_count)+1);
        total_count = $('.docMore').data('count');
         var input_field = '<div  class="form-group col-md-12"><label class="control-label col-md-3">&nbsp;</label><div class="col-md-6"><a href="javascript:void(0);" id="addMore'+total_count+'" class="btn btn-primary">Browse</a><input type="hidden" name="client_doc[]" value="" class="addMore'+total_count+'_doc moredocs" /><a href="javascript:void(0);" onclick="$(this).parent().parent().remove();" class = "btn btn-danger">Delete</a></div></div>';
    $('.docMore').append(input_field);
    initiate_ajax_upload('addMore'+total_count,'doc');
        
    })

                  
                function initiate_ajax_upload(button_id, doc){
                var button = $('#'+button_id), interval;
                new AjaxUpload(button,{
                    action: "<?php echo $this->request->webroot;?>documents/fileUpload/<?php if(isset($id))echo $id;?>",                      
                    name: 'myfile',
                    onSubmit : function(file, ext){
                        button.text('Uploading');
                        this.disable();
                        interval = window.setInterval(function(){
                            var text = button.text();
                            if (text.length < 13){
                                button.text(text + '.');					
                            } else {
                                button.text('Uploading');				
                            }
                        }, 200);
                    },
                    onComplete: function(file, response){
                        if(doc=="doc")
                            button.html('Browse');
                        else
                            button.html('<i class="fa fa-image"></i> Add/Edit Image');
                            
                            window.clearInterval(interval);
                            this.enable();
                            if(doc=="doc"){
                                $('#'+button_id).parent().append(" "+response);
                                $('.'+button_id+"_doc").val(response);
                            }
                            else
                            {
                                $("#clientpic").attr("src",'<?php echo $this->request->webroot;?>img/jobs/'+response);
                                $('#client_img').val(response);
                            }
                            //$('.flashimg').show();
                            }                        		
                    });                
            }*/
</script>


