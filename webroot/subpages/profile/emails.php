<?php
$languages = array("English", "French");
$strings2 = array();
foreach($languages as $language){
    $data = CacheTranslations($language, array("email_%"), $settings, False);
    unset($data["Date"]);
    $strings2[$language] = $data;
}

$fullmode = false;

$emails = array();

foreach($strings2["English"] as $Key => $Data){
    $fullmode = strpos($Key, "_subject") || strpos($Key, "_message");
    break;
}

$FirstLanguage = $languages[0];
$strings3 = $strings2[$FirstLanguage];
if(!$fullmode) {$languages = array($FirstLanguage);}

foreach($strings3 as $Key => $Data){
    $currentemail = array();
    if ($fullmode){
        $name = str_replace("email_", "", $Key);
        if (strpos($Key, "_subject")){
            $name = str_replace("_subject", "", $name);
            $currentemail["subject[" . $FirstLanguage . "]"] = $Data;
            $currentemail["message[" . $FirstLanguage . "]"] = $strings3["email_" . $name . "_message"];
            foreach($languages as $language){
                if($language != $FirstLanguage){
                    $currentemail["subject[" . $language . "]"] = $strings2[$language]["email_" . $name . "_subject"];
                    $currentemail["message[" . $language . "]"] = $strings2[$language]["email_" . $name . "_message"];
                }
            }
        }
    } elseif(strpos($Key, "email_") === 0) {
        $name = str_replace("email_", "", $Key);
        $currentemail["subject"] = $Data;
        $currentemail["message"] = $strings2["French"]["email_" . $name];
    }
    if($currentemail) {
        $emails[$name] = $currentemail;
    }
}

echo '<TABLE CLASS="table table-hover" width="100%"><THEAD><TH>Key</TH><TH WIDTH="100%">Email</TH>';
echo '</THEAD><TBODY><TD>';
echo '<div class="tabbable tabbable-custom">';
            echo '<ul class="nav">';
$FirstEmail = "";
foreach($emails as $Key => $Data){
    if(!$FirstEmail){$FirstEmail = $Key;}
    echo '<LI><A onclick="return show(' . "'" . $Key  . "'" . ')">' . $Key . '</A></LI>';
}
echo '</DIV></DIV></TD><TD>';
?>
Global variables:
<UL>
    <LI>%webroot% = The webroot</LI>
    <LI>%created% = The current date/time</LI>
    <LI>%login% = The URL of the login page</LI>
    <LI>%variables% = A dump of all the variables</LI>
</UL>
<?php
foreach($emails as $Key => $Data){
    echo '<div id="email_' . $Key . '" style="display: none;">';
    echo '<H3>' . $Key . '</H3>';
    foreach($Data as $Key2 => $Value){
        echo '<div class="form-group"><label class="control-label">' . $Key2 . ': </label>';
        $id = $Key . "_" . $Key2;
        if(strpos($Key2, "subject") === 0){
            if(!$fullmode){$Key2 = "[English]";}
            echo '<INPUT ONCHANGE="haschanged = true;" ID="' . $id . '" TYPE="TEXT" CLASS="form-control email_' . $Key . '" NAME="' . $Key2 . '" VALUE="' . $Value . '">';
        } elseif(strpos($Key2, "message") === 0) {
            if(!$fullmode){$Key2 = "[French]";}
            echo '<TEXTAREA ONCHANGE="haschanged = true;" ID="' . $id . '" CLASS="form-control email_' . $Key . '" NAME="' . $Key2 . '">' . $Value . '</TEXTAREA>';
        }
        echo '</DIV>';
    }
    echo '</div>';
}
?></TD></TBODY>
<TFOOT>
<TD COLSPAN="2" ALIGN="RIGHT">
    <button class="btn btn-primary" id="save" onclick="saveall(lastkey);">Save</button>
</TD>
</TFOOT></TABLE>
<script>
    var lastkey = "";
    var haschanged = false;
    function show(key){
        if(haschanged){
            if (!confirm("You have unsaved changes, are you sure you want to switch to a different email?")){
                return false;
            }
        }

        var element;
        if(lastkey){
             element = document.getElementById("email_" + lastkey);
             element.style.display = 'none';
        }
        element = document.getElementById("email_" + key);
        element.style.display = 'block';
        lastkey = key;
        haschanged = false;
        return false;
    }
    show("<?= $FirstEmail; ?>");

    function saveall(key){
        if(!haschanged){
            alert("You have made no changes");
            return false;
        }

        var element = document.getElementById("save");
        var EndVar = "key=" + key;
        element.innerHTML = "Saving...";
        $('.email_' + key).each(function(){
            var NewVar = $(this).attr('name') + "=" + encodeURIComponent($(this).val());
            EndVar = EndVar + "&" + NewVar;
        });
        $.ajax({
            url: "<?php echo $this->request->webroot;?>profiles/products",
            type: "post",
            dataType: "HTML",
            data: "Type=editemail&" + EndVar,
            success: function (msg) {
                alert(msg);
                element.innerHTML = "Save";
                haschanged = false;
            }
        })
    }
</script>