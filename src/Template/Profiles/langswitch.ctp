<?php
    include_once('subpages/api.php');
    if(count($languages)<3){
        $printscript=-1;
        $language = $this->requestAction('documents/translate');
        echo Translate("langswitched", $language);
    } else if(isset($newlanguage)) {
        echo Translate("langswitched", $language);
        $printscript = -2;
    } else {
        $printscript = 0;
        $languages = languagenames();
        echo "<UL>";
        foreach($languages as $English => $Native){
            echo '<LI><A HREF="' . $id . "/" . $English . '">' . $Native . '</A>';
        }
        if($this->request->session()->read('Profile.super')){
            echo '<LI><A HREF="' . $id . '/Debug">Debug</A>';
        }
        echo "</UL>";
    }
    if ($printscript < 0){
?>
<SCRIPT>
    window.setTimeout(function(){
        // Move to a new location or you can do something else
        var currentUrl = window.location.href;
        window.history.go(<?= $printscript; ?>);
        setTimeout(function(){
            // if location was not changed in 100 ms, then there is no history back
            if(currentUrl === window.location.href){
                // redirect to site root
                window.location.href = '..';
            }
        }, 3000);
    }, 2000);
</SCRIPT>
<?php } ?>