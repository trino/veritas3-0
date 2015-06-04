<?php
    include_once('subpages/api.php');
    $language = $this->requestAction('documents/translate');
    echo Translate("langswitched", $language);
?>
<SCRIPT>
    window.setTimeout(function(){
        // Move to a new location or you can do something else
        window.history.go(-1);
    }, 2000);
</SCRIPT>