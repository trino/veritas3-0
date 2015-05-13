<?php
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;

$SQLfile = getcwd() .  "/strings.sql";
if (file_exists($SQLfile)) {//Check for translation update in veritsa3-0/webroot/strings.sql
    $Table = TableRegistry::get('strings');
    $LastUpdate = $Table->find()->select()->where(["Name" => "Date"])->first();
    if($LastUpdate){$LastUpdate = $LastUpdate->English;} else {$LastUpdate = 0;}
    $UpdateFile = filemtime($SQLfile);
    if ($LastUpdate < $UpdateFile) {
        //echo "<SCRIPT>alert('Applying translation update');</SCRIPT>";//silent, so no one will know I did anything...
        $SQLfile = getSQL($SQLfile);
        if ($SQLfile) {
            $db = ConnectionManager::get('default');
            $db->execute("TRUNCATE TABLE strings;");
            $db->execute($SQLfile);
            $Table->query()->update()->set(['English' => $UpdateFile])->where(['Name' => "Date"])->execute();
        }
    }
}

function JSinclude($_this, $File){
    $URL = $_this->request->webroot . $File;
    $File = getcwd() . "/" . $File;
    echo '<script src="' . $URL . '?' . filemtime($File) . '" type="text/javascript"></script>';
}


function getSQL($Filename){
    $File = file_get_contents($Filename);
    $Start = strpos($File, "--", strpos($File, "Dumping data for table ")) + 3;
    $End = strpos($File, "/*", $Start);
    return substr($File, $Start, $End-$Start);
}
//end auto updater

$islocal=false;
if ($_SERVER['SERVER_NAME'] == "localhost" || $_SERVER['SERVER_NAME'] == "127.0.0.1" || $_SERVER['SERVER_ADDR'] == "127.0.0.1") { $islocal=true;}
$GLOBALS["islocal"] =$islocal;
$GLOBALS["translated"] =false;
$emailaddress= "info@" . getHost("isbmee.com");
$GLOBALS["webroot"]="";

function translatedatepicker($Language='English', $_this) {
    $webroot = $_this->request->webroot;
    $Lang = "";
    switch ($Language) {
        case "French":
            $Lang = "fr";
            break;
        case "Debug":
            echo "<!-- DEBUG MODE -->";
            break;
    }
    if ($Lang) {//Remember: The datepicker locales need to be fixed, see the french one for an example
        echo '<script type="text/javascript" src="' . $webroot . 'assets/global/plugins/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.' . $Lang . '.js" charset="UTF-8"></script>';
        echo '<script type="text/javascript" src="' . $webroot . 'assets/global/plugins/select2/select2_locale_' . $Lang . '.js"></script>';
/*<SCRIPT LANGUAGE="JAVASCRIPT">' . "//official code, and it doesn't work!
    $('.datepicker').datepicker({
            language: '" . $Lang . "'
    });
</SCRIPT>";
*/
    }
}

/* //this is the code to include it, for some reason the regular way won't work on the live
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


function test(){
    die("HELLO WORLD");
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

function s($settings){
    $variables = Sadd("client", $settings);
    $variables = array_merge($variables,Sadd("document", $settings));
    $variables = array_merge($variables,Sadd("profile", $settings));
    return array_merge($variables,Sadd("mee", $settings));
}

function Sadd($Key, $Value){
    $P="%";
    $Value=$Value->$Key;
    $variables=array();
    $variables[$P. strtolower($Key) .$P] = strtolower($Value);
    $variables[$P. strtoupper($Key) .$P] = strtoupper($Value);
    $variables[$P. ucfirst($Key) .$P] = ucfirst($Value);
    return $variables;
}

function getIterator($Objects, $Fieldname, $Value){
    foreach($Objects as $Object){
        if ($Object->$Fieldname == $Value){
            return $Object;
        }
    }
    return false;
}

function CacheTranslations($Language='English', $Text, $Variables = ""){
    if (!is_array($Text)){
        $Text = array($Text);
    }
    if(is_object($Variables)){
        $Variables=s($Variables);
    }

    $Text[] = "dashboard_%";//for all pages
    $Text[] = "settings_%";//for all pages
    $Text[] = "index_%";//for all pages

    $table =  TableRegistry::get('strings');

    $query="Name = 'Date'";
    foreach($Text as $text){
        if(strlen($query)>0){ $query.= " OR ";}
        if (strpos($text, "%")){
            $query .= "Name LIKE '" . strtolower($text) . "'";
        } else {
            $query .= "Name = '" . strtolower($text) . "'";
        }
    }

    $Language = trim($Language);
    $acceptablelanguages = array("English", "French", "Debug");
    if(!in_array ($Language, $acceptablelanguages)){$Language = $acceptablelanguages[0]; }

    //echo "Query: " . $query;
    $table = $table->find()->where(["(" . $query . ")"])->all();
    $data = array();
    foreach($table as $entry){
        if($Language=="Debug"){
            $data[$entry->Name] = '[' . $entry->Name . ']';
        } else {
            $data[$entry->Name] = ProcessVariables($entry->Name, $entry->$Language, $Variables);
        }
    }
    $GLOBALS["translated"]= true;
    return $data;
}

function Translate($ID, $Language, $Variables = ""){
    $table = TableRegistry::get('strings');
    if (is_numeric($ID)) {$column = "ID";} else {$column = "Name";}
    $query = $table->find()->select()->where([$column => $ID])->first();
    if ($query && $Language!="Debug") {
        return  ProcessVariables($ID, $query->$Language, $Variables);
    } else {
        return $ID . "." . $Language . " is missing a translation";
    }
}
function ProcessVariables($ID, $Text, $Variables = ""){
    if (is_array($Variables)) {
        foreach ($Variables as $Key => $Value) {
            if (substr($Key, 0, 1) != "%") {$Key = "%" . $Key;}
            if (substr($Key, -1) != "%") {$Key .= "%";}
            if($ID == "Debug"){
                $Text.= " [" . $Key . "=" . $Value . "]";
            } else {
                $Text = str_replace($Key, $Value, $Text);
            }
        }
    }
    if($Text) {return $Text;}
    return $ID;
}

function FindIterator($ObjectArray, $FieldName, $FieldValue){
    foreach($ObjectArray as $Object){
        if ($Object->$FieldName == $FieldValue){return $Object;}
    }
    return false;
}

function getFieldname($Fieldname, $Language){
    if($Language == "English" || $Language == "Debug"){ return $Fieldname; }
    return $Fieldname . $Language;
}

function getField($Object, $Fieldname, $Language){
    if($Language!="English") {
        $newField = $Fieldname . $Language;
        if ($Object->$newField){return $Object->$newField;}
        return "[" . $Object->$Fieldname . "]";//untranslated notifier
    }
    if(is_object($Object)) {
        return $Object->$Fieldname;
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

function alert($Text){
    echo "<SCRIPT>alert('$Text');</SCRIPT>";
}
*/

function getdatestamp($date){
    $newdate = date_create($date);
    return date_timestamp_get($newdate);
}

function getdatecolor($date, $now=""){
    $datestamp = getdatestamp($date);
    if(!$now){$now=time();}
    $color = "";
    $oneday = 86400;//24*60*60
    $datediff = $now - $datestamp;
    if($datediff > $oneday){//0-24 hours no colour
        $title="Less than 24 hours old";
        if($datediff< $oneday*2){//24-48 hours green
            $color = "green";
        } elseif($datediff< $oneday*7){//48-one week yellow
            $color = "#FFAF0A";
        } else {//One week + red
            $color ="red";
        }
    }
    if($color){return '<FONT COLOR="' . $color . '">' . $date . "</FONT>";}
    return $date;
}
?>