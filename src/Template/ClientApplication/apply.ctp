<?php
//$settings = $this->requestAction('clientApplication/get_settings');
    //use Cake\ORM\TableRegistry;
    //$debug = $this->request->session()->read('debug');
    //include_once('subpages/api.php');
    //$language = $this->request->session()->read('Profile.language');
    
include_once('subpages/api.php');
$settings = $this->requestAction('clientApplication/get_settings');
    $language = $this->request->session()->read('Profile.language');
    $strings = CacheTranslations($language, array("documents_%", "forms_%", "clients_addeditimage", "infoorder_selectclient"), $settings);//,$registry);//$registry = $this->requestAction('/settings/getRegistry');

//$language = $this->request->session()->read('Profile.language');

//var_dump($strings);
?>
<h2>Application for <?php echo $client->company_name;?></h2>

<div class="steps" id="step0" class="active">
    <?php include('subpages/documents/driver_form.php');?>    
    <a href="javascript:void(0)" id="button0" class="buttons btn btn-primary">Proceed to step 1</a>
    </div>
<?php 
$cid = $client->id;
$jj=0;
foreach($subd as $s)
{
    $dx = $this->requestAction('/clientApplication/getSub/'.$s->sub_id);
    //var_dump($s);
    $jj++;
    ?>
    <div class="steps" id="step<?php echo $jj;?>" style="display:none;">
    <?php include('subpages/documents/'.$this->requestAction('/clientApplication/getForm/'.$s->sub_id));?>    
    <a href="javascript:void(0)" id="button<?php echo $jj;?>" class="buttons btn btn-primary">Proceed to step <?php echo $jj+1;?></a>
    </div>
    <?php
    //echo $s->sub_id;
}
?>
<script>
$(function(){
   $('.steps input').change(function(){
    $(this).parent().find('.error').html('');
   }); 
   $('.buttons').click(function(){
        
        var par = $(this).closest('.steps');
        checker = 0;
        var ch = '';
        par.find(".required:not('label')").each(function(){
            //alert($(this).attr('class'));
            if($(this).val() == '')
            {
                checker = 1;
                $(this).parent().find('.error').html('This field is required');
                $(this).focus();
                $('html,body').animate({ scrollTop: $(this).offset().top}, 'slow');
                return false;
                
            }
            else{
                if($(this).attr('role')=='email' && $(this).val()!='')
                {
                    var em = $(this).val();
                    if(em.replace('@','') == em || em.replace('.','') == em)
                    {
                        checker = 1;
                        $(this).parent().find('.error').html('Invalid Email');
                        $(this).focus();
                        $('html,body').animate({ scrollTop: $(this).offset().top}, 'slow');
                        return false;
                    }
                }
            }
        });
        
        
        if(checker == 0){
        par.hide();
        par.removeClass('active');
        var id = par.find('.buttons').attr('id').replace('button','');
        var type = par.find('input[name="document_type"]').val();
        if(type=='driver_form')
        {
            save_driver(par,'<?php echo $this->request->webroot;?>');
        }
        id = parseInt(id)+1;
        $('#step'+id).show();
        $('#step'+id).addClass('active');
        
        }
   });
    
});
function fileUpload(ID) {
        // e.preventDefault();

        var $type = $(".active").find("input[name='document_type']").val(),
            param = {
                type: 'order',
                doc_type: $type,
                order_id: '0',
                cid: '<?php echo $client->id;?>'
            };
        if ($type == "Consent Form") {
            //get sub content tab active
            var subContent = $(".active #form_tab4").find('.tab-content .tab-pane.active form').attr('id');
            // debugger;
            if (subContent == "form_consent") {
                param.subtype = 'Consent Form';
            } else if (subContent == "form_employment") {
                param.subtype = 'Employment';
            } else if (subContent == "form_education") {
                param.subtype = 'Education';
            }
        }

        var upload = new AjaxUpload("#" + ID, {
            action: "<?php echo $this->request->webroot;?>documents/fileUpload",
            enctype: 'multipart/form-data',
            data: param,
            name: 'myfile',
            onSubmit: function (file, ext) {

            },
            onComplete: function (file, response) {
                if (response != 'error') {
                    $('#' + ID).parent().find('.uploaded').text(response);
                    $('.' + ID).val(response);
                } else {
                    alert('Invalid file type.');
                }
            }

        });
    }
</script>