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
<?php 
$cid = $client->id;
$jj=0;
foreach($subd as $s)
{
    $dx = $this->requestAction('/clientApplication/getSub/'.$s->sub_id);
    //var_dump($s);
    $jj++;
    ?>
    <div class="steps" id="step<?php echo $jj;?>" <?php if($jj!=1){?>style="display:none;"<?php }else{?> class="active"<?php }?>>
    <?php include('subpages/documents/'.$this->requestAction('/clientApplication/getForm/'.$s->sub_id));?>    
    <a href="javascript:void(0)" id="button<?php echo $jj;?>" class="buttons">Proceed to step <?php echo $jj+1;?></a>
    </div>
    <?php
    //echo $s->sub_id;
}
?>
<script>
$(function(){
   $('.buttons').click(function(){
        $(this).closest('.steps').hide();
        $(this).closest('.steps').removeClass('active');
        var id = $(this).attr('id').replace('button','');
        id = parseInt(id)+1;
        $('#step'+id).show();
        $('#step'+id).addClass('active');
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