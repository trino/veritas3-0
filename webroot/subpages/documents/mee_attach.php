<?php
 if($_SERVER['SERVER_NAME'] =='localhost'){  echo "<span style ='color:red;'>subpages/documents/mee_attachments.php #INC203</span>";}
 ?>
<form id="form_tab15">
<input type="hidden" class="document_type" name="document_type" value="MEE Attachments"/>
<input type="hidden" name="sub_doc_id" value="15" class="sub_docs_id" id="af" />
<div class="clearfix"></div>
<hr/>

        <div class="form-group row"> <div class="col-md-12">
            <?php
            /*$controller = $this->request->params['controller'];
            $controller = strtolower($controller);

            include_once 'subpages/filelist.php';
            printdocumentinfo($did);
            if( isset($pre_at)){  listfiles($pre_at['attach_doc'], "attachments/", "", false,3); }
            echo "</div>";*/
            if($controller == 'orders' )
            {
                echo '<h4 class="col-md-12">MEE Attachments</h4>';
                }
                else {
                    
                }
                ?>
            <div class="col-md-12">
                <label class="control-label">Upload 2 pieces of ID : </label>
    
                <a href="javascript:void(0)" class="btn btn-primary" id="mee_att_1">Browse</a> <a href="javascript:void(0)" class="btn btn-primary" id="mee_att_2">Browse</a>

            </div>
            
            <div class="col-md-12">
                <label class="control-label">Upload 2 pieces of ID : </label>
    
                <a href="javascript:void(0)" class="btn btn-primary" id="mee_att_1">Browse</a> <a href="javascript:void(0)" class="btn btn-primary" id="mee_att_2">Browse</a>

            </div>
            
            <div class="col-md-12">
                <label class="control-label">Upload 2 pieces of ID : </label>
    
                <a href="javascript:void(0)" class="btn btn-primary" id="mee_att_1">Browse</a> <a href="javascript:void(0)" class="btn btn-primary" id="mee_att_2">Browse</a>

            </div>
            
            <div class="col-md-12">
                <label class="control-label">Upload 2 pieces of ID : </label>
    
                <a href="javascript:void(0)" class="btn btn-primary" id="mee_att_1">Browse</a> <a href="javascript:void(0)" class="btn btn-primary" id="mee_att_2">Browse</a>

            </div>
            
            <div class="col-md-12">
                <label class="control-label">Upload 2 pieces of ID : </label>
    
                <a href="javascript:void(0)" class="btn btn-primary" id="mee_att_1">Browse</a> <a href="javascript:void(0)" class="btn btn-primary" id="mee_att_2">Browse</a>

            </div>

        
        <div class="clearfix"></div>
    

</form>

<!--<script>
    $(function(){
        $('#addfiles').click(function(){
           $('#doc').append('<div style="padding-top:10px;"><a href="#" class="btn btn-success">Browse</a> <a href="javascript:void(0);" class="btn btn-danger" onclick="$(this).parent().remove();">Delete</a><br/></div>');
        });
        <?php
        if($this->request->params['action']=='addorder' || $this->request->params['action']=='add')
        {
            ?>
            fileUpload('fileUpload1');
            <?php
        }
        ?>

        $('.add_attach').click(function(){
            var count = $('.attach_more').data('count');
            $('.attach_more').data('count',parseInt(count)+1);
           $('.attach_more').append('<div class="pad_bot" id="del_pre"> <label class="control-label col-md-3"></label> <div class="col-md-6 pad_bot"><input type="hidden" class="fileUpload'+$('.attach_more').data('count')+'" name="attach_doc[]" /><a href="#" id="fileUpload'+$('.attach_more').data('count')+'"  class="btn btn-primary">Browse</a> <a  href="javascript:void(0);" class="btn btn-danger delete_attach">Delete</a> <span class="uploaded"></span></div></div><div class="clearfix"></div>');
            fileUpload('fileUpload'+$('.attach_more').data('count'));

        });

        $('.delete_attach').live('click',function(){
            var count = $('.attach_more').data('count');
            $('.attach_more').data('count',parseInt(count)-1);
            $(this).closest('#del_pre').remove();

        });
        //$("#test1").jqScribble();
        //$("#test2").jqScribble();

        $('.select_media').change(function(){
           if ($(this).attr("value") == 'other')
            {
                 $('.other_div').show();
            }
            else $('.other_div').hide();
        });
    });


		function save(numb)
		{
		  //alert('rest');return;
			$("#test"+numb).data("jqScribble").save(function(imageData)
			{
				$.post('image_save.php', {imagedata: imageData}, function(response)
					{

                        $.ajax({
                            url:'<?php echo $this->request->webroot;?>document/image_sess/'+numb+'/'+response
                        });
					});

			});
		}
		function addImage()
		{
			var img = prompt("Enter the URL of the image.");
			if(img !== '')$("#test").data("jqScribble").update({backgroundImage: img});
		}

		</script>-->