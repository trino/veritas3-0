<?php
use Cake\ORM\TableRegistry;

$islocal=false;
if ($_SERVER['SERVER_NAME'] == "localhost" || $_SERVER['SERVER_NAME'] == "127.0.0.1" || $_SERVER['SERVER_ADDR'] == "127.0.0.1") { $islocal=true;}
$GLOBALS["islocal"] =$islocal;
$emailaddress= "info@" . getHost("isbmee.com");

/*
if ($_SERVER['SERVER_NAME'] == "localhost" || $_SERVER['SERVER_NAME'] == "127.0.0.1") {
    include_once('/subpages/api.php');
} else {
    include_once('subpages/api.php');
}

btnclass("VIEW")
btnclass("EDIT")
btnclass("DELETE")

green
green-meadow
green-seagreen
green-turquoise
green-haze
green-jungle
green-sharp
green-soft

blue
blue-madison
blue-chambray
blue-ebonyclay
blue-hoki
blue-steel
blue-soft
blue-dark
blue-sharp

grey
grey-steel
grey-cararra
grey-gallery
grey-cascade
grey-silver
grey-salsa
grey-salt
grey-mint

red
red-pink
red-sunglo
red-intense
red-thunderbird
red-flamingo
red-soft

yellow
yellow-gold
yellow-casablanca
yellow-crusta
yellow-lemon
yellow-saffron

purple
purple-plum
purple-medium
purple-studio
purple-wisteria
purple-seance
purple-intense
purple-sharp
purple-soft
 */
function btnclass($xscolor, $stripecolor = ""){
    $size = "btn-xs";
    $mode = true;//true = regular button, false = striped
    switch ($xscolor){
        case "VIEW":
            $xscolor = "btn-primary";//light blue
            $stripecolor = "blue";
            break;
        case "EDIT":
            $xscolor = "btn-primary";
            $stripecolor = "blue";
            break;
        case "DELETE":
            $xscolor = "btn-danger";
            $stripecolor = "red";
    }

    if ($mode ){
        if (strlen($stripecolor)==0){$stripecolor = $xscolor;}
        return "btn default " . $size . " " . $stripecolor . "-stripe";
    } else {
        return "btn " . $size . " " . $xscolor;
    }
}






function getHost($localhost = "localhost") {//get HTTP host name
    if ($GLOBALS["islocal"] && $localhost) {return $localhost;}
    $possibleHostSources = array('HTTP_X_FORWARDED_HOST', 'HTTP_HOST', 'SERVER_NAME', 'SERVER_ADDR');
    $sourceTransformations = array(
        "HTTP_X_FORWARDED_HOST" => function($value) {
            $elements = explode(',', $value);
            return trim(end($elements));
        }
    );
    $host = '';
    foreach ($possibleHostSources as $source) {
        if (!empty($host)) break;
        if (empty($_SERVER[$source])) continue;
        $host = $_SERVER[$source];
        if (array_key_exists($source, $sourceTransformations)) {
            $host = $sourceTransformations[$source]($host);
        }
    }
    $host = preg_replace('/:\d+$/', '', $host); // Remove port number from host
    return trim($host);
}


function getIterator($Objects, $Fieldname, $Value){
    foreach($Objects as $Object){
        if ($Object->$Fieldname == $Value){
            return $Object;
        }
    }
    return false;
}


function Translate($ID, $Language, $Variables = ""){
    $table = TableRegistry::get('strings');
    if (is_numeric($ID)) {$column = "ID";} else {$column = "Name";}
    $query = $table->find()->select()->where([$column => $ID])->first();
    if ($query) {
        $query = $query->$Language;
        if (is_array($Variables)) {
            foreach ($Variables as $Key => $Value) {
                if (substr($Key, 0, 1) != "%") {$Key = "%" . $Key;}
                if (substr($Key, -1) != "%") {$Key .= "%";}
                $query = str_replace($Key, $Value, $query);
            }
        }
        return $query;
    } else {
        return $ID . "." . $Language . " is missing a translation";
    }
}


/*
function translate($language, $flushcache = false){
    //veritas3-0\webroot\Locale\[language]\LC_MESSAGES will need clearing of duplicate mo files
    //$language="fr_CA";


    putenv("LANG=$language");
    putenv("LANGUAGE=$language");
    putenv("LC_ALL=$language");
    setlocale(LC_ALL, $language);//.UTF-8
    $domain = 'default';
    $dir= getcwd() . "/Locale";
    if($flushcache){//MUST NOT USE ON LIVE!
        $path = $dir . "/" . $language . "/LC_MESSAGES/";
        $filename = $path . $domain . ".mo" ;
        $mtime = filemtime($filename);
        $filename_new = $path . $domain . $mtime . ".mo" ;
        if (!file_exists($filename_new)){
            copy($filename,$filename_new);
        }
        $domain = $domain . $mtime;
    }
    bindtextdomain($domain, $dir);//www/veritsa3-0/,   Locale
    textdomain($domain);
    if(gettext("test")=="test"){
        echo $language . " is not installed on this system.";
    }
    return $language;
}
*/
?>