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
$jj=0;
foreach($subd as $s)
{
    //var_dump($s);
    $jj++;
    ?>
    <div class="steps" id="step<?php echo $jj;?>" <?php if($jj!=1){?>style="display:none;"<?php }?>>
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
        var id = $(this).attr('id').replace('button','');
        id = parseInt(id)+1;
        $('#step'+id).show();
   }); 
});
</script>