<?php
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;

function updatetable($Table, $PrimaryKey, $Value, $Data){
    if(!is_object($Table)) {$Table = TableRegistry::get($Table);}
    $item = $Table->find()->where([$PrimaryKey => $Value])->first();
    if($item){
        $Table->query()->update()->set($Data)->where([$PrimaryKey => $Value])->execute();
    } else {
        $Data[$PrimaryKey] = $Value;
        $Table->query()->insert(array_keys($Data))->values($Data)->execute();
    }
}

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
$GLOBALS["language"] = "English";

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
    if ($Lang) {//Remember: The datepicker and datetimepicker locales need to be fixed, see the french ones for an example
        JSinclude($_this, 'assets/global/plugins/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.' . $Lang . '.js');
        JSinclude($_this, 'assets/global/plugins/select2/select2_locale_' . $Lang . '.js');
        JSinclude($_this, 'assets/global/plugins/bootstrap-datepicker/js/locales/bootstrap-datepicker.' . $Lang . '.js');
        //echo '<script type="text/javascript" src="' . $webroot . 'assets/global/plugins/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.' . $Lang . '.js" charset="UTF-8"></script>';
        //echo '<script type="text/javascript" src="' . $webroot . 'assets/global/plugins/select2/select2_locale_' . $Lang . '.js"></script>';
        //echo '<script type="text/javascript" src="' . $webroot . 'assets/global/plugins/bootstrap-datepicker/js/locales/bootstrap-datepicker.' . $Lang . '.js"></script>';

/*<SCRIPT LANGUAGE="JAVASCRIPT">' . "//official code, and it doesn't work!
    $('.datepicker').datepicker({
            language: '" . $Lang . "'
    });
</SCRIPT>";
*/
    }
}

/*
    include_once('subpages/api.php');

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

function s($settings, $language = "English"){
    $variables = Sadd("client", $language, $settings);
    $variables = array_merge($variables,Sadd("document", $language, $settings));
    $variables = array_merge($variables,Sadd("profile", $language, $settings));
    return array_merge($variables,Sadd("mee", "English", $settings));//no french equivalent
}

function Sadd($Key, $language, $Value){
    $P="%";
    $NewName = $Key;
    if($language != "English" && $language != "Debug"){$Key .= $language;}
    $Value=$Value->$Key;
    $variables=array();
    $variables[$P. strtolower($NewName) .$P] = strtolower($Value);
    $variables[$P. strtoupper($NewName) .$P] = strtoupper($Value);
    $variables[$P. ucfirst($NewName) .$P] = ucfirst($Value);
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
function addTrans($array, $Trans = ""){
    if($Trans){
        foreach($array as $Key => $Value){
            $array[$Key] = $Value . $Trans;
        }
    }
    return $array;
}

function CacheTranslations($Language='English', $Text, $Variables = "", $Common = True) {
    $GLOBALS["language"] = $Language;
    if (!is_array($Text)) {
        $Text = array($Text);
    }
    if (is_object($Variables)) {
        $Variables = s($Variables);
    }

    if ($Common) {
        $Text[] = "dashboard_%";//for all pages
        $Text[] = "settings_%";//for all pages
        $Text[] = "index_%";//for all pages
    }
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
function ProcessVariables($ID, $Text, $Variables = "", $addSlashes = false){
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
    if($addSlashes) {//&apos;
       $Text = str_replace("d&#039;", "\'", addslashes($Text));//d&#039; breaks javascript
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
    if(is_object($Object)) {
        if($Language!="English") {
            $newField = $Fieldname . $Language;
            if ($Object->$newField){return $Object->$newField;}
            return "[" . $Object->$Fieldname . "]";//untranslated notifier
        }
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

function provinces($name){
    echo '<SELECT class="form-control" name="' . $name . '">';
    $acronyms = getprovinces("Acronyms");
    $Provinces = getprovinces("");
    $ID=0;
    foreach($acronyms as $acronym){
        echo '<OPTION value="' . $acronym . '">' . $Provinces[$ID] . '</OPTION>';
        $ID++;
    }
    echo '</SELECT>';
}

function getprovinces($Language = "English", $IncludeUSA = False){
    $Trans="";
    if($Language == ""){$Language = $GLOBALS["language"];}
    if($Language == "Debug"){
        $Language = "English";
        $Trans = " [TRANS]";
    }
    switch ($Language){
        case "Acronyms":
            $Trans="";//these are keys, and must not be altered in any way
            $provinces = array("", "AB", "BC", "MB", "NB", "NL", "NT", "NS", "NU", "ON", "PE", "QC", "SK", "YT");
            if($IncludeUSA) {$states = array("AL", "AK", "AZ", "AR", "CA", "CO", "CT", "DE", "FL", "GA", "HI", "ID", "IL", "IN", "IA", "KS", "KY", "LA", "ME", "MD", "MA", "MI", "MN", "MS", "MO", "MT", "NE", "NV", "NH", "NJ", "NM", "NY", "NC", "ND", "OH", "OK", "OR", "PA", "RI", "SC", "SD", "TN", "TX", "UT", "VT", "VA", "WA", "WV", "WI", "WY");}
            break;
        case "English":
            $provinces = array("Select Province", "Alberta", "British Columbia", "Manitoba", "New Brunswick", "Newfoundland and Labrador", "Northwest Territories", "Nova Scotia", "Nunavut", "Ontario", "Prince Edward Island", "Quebec", "Saskatchewan", "Yukon Territories");
            if($IncludeUSA) {$states = array("Alabama", "Alaska", "Arizona", "Arkansas", "California", "Colorado", "Connecticut", "Delaware", "Florida", "Georgia", "Hawaii", "Idaho", "Illinois", "Indiana", "Iowa", "Kansas", "Kentucky", "Louisiana", "Maine", "Maryland", "Massachusetts", "Michigan", "Minnesota", "Mississippi", "Missouri", "Montana", "Nebraska", "Nevada", "New Hampshire", "New Jersey", "New Mexico", "New York", "North Carolina", "North Dakota", "Ohio", "Oklahoma", "Oregon", "Pennsylvania", "Rhode Island", "South Carolina", "South Dakota", "Tennessee", "Texas", "Utah", "Vermont", "Virginia", "Washington", "Virginia", "Wisconsin", "Wyoming");}
            break;
        case "French":
            $provinces = array("Choisir la province", "Alberta", "la Colombie-Britannique", "Manitoba", "Nouveau-Brunswick", "Terre-Neuve-et-Labrador", "Territoires du Nord-Ouest", "la Nouvelle-Écosse", "Nunavut", "Ontario", "Prince-Édouard Island", "Le Québec", "Saskatchewan", "Yukon");
            if($IncludeUSA) {$states = array("Alabama", "Alaska", "Arizona", "Arkansas", "California", "Colorado", "Connecticut", "Delaware", "Florida", "Georgia", "Hawaii", "Idaho", "Illinois", "Indiana", "Iowa", "Kansas", "Kentucky", "Louisiane", "Maine", "Maryland", "Massachusetts ", "Michigan", "Minnesota", "Mississippi", "Missouri", "Montana", "Nebraska", "Nevada", "New Hampshire", "New Jersey", "Nouveau-Mexique", "New York", "Nord Carolina", "le Dakota du Nord", "Ohio", "Oklahoma", "Oregon", "Pennsylvania", "Rhode Island", "Caroline du Sud", "Dakota du Sud", "Tennessee", "Texas", "Utah ", "Vermont", "Virginia", "Washington", "Virginia", "Wisconsin", "Wyoming");}
            break;
        default:
            echo "Please add support for '" . $Language . "' in subpages/api.php (getprovinces)";
            die();
    }
    if($IncludeUSA) {$provinces = array_merge($provinces, $states);}
    $provinces = addTrans($provinces, $Trans);//debug mode
    return $provinces;
}

function includejavascript($strings = "", $settings = ""){
    $language =  $GLOBALS["language"];
    $variables = array("SaveAndContinue" => "addorder_savecontinue", "SaveAsDraft" => "forms_savedraft", "Submit" => "forms_submit", "Select" => "forms_select", "SelectOne" => "forms_selectone", "SignPlease" => "forms_signplease", "MissingID" => "forms_missingid", "MissingAbstract" => "forms_missingabstract", "FillAll" => "forms_fillall", "SaveSig" => "forms_savesig", "Success" => "orders_success", "Clear" => "forms_clear", "ConfDelete" => "dashboard_confirmdelete", "FillAll" => "forms_fillall", "SelOne" => "forms_selectone");
    if (!$strings){
        $strings = CacheTranslations($GLOBALS["language"], array_values($variables), $settings, False);
    }
    echo "\r\n<SCRIPT>//pass data to form-wizard.js";
    foreach($variables as $key => $value){
        if (isset($strings[$value])) {
            echo "\r\n" . '    var ' . $key . ' = "' . addslashes($strings[$value]) . '";';
        } else {

        }
    }
    echo "\r\n";
?>
    var language = '<?= $language; ?>';

    function confirmdelete(Name){
        var text = "<?= addslashes($strings["dashboard_confirmdelete"]); ?>";
        return confirm(text.replace("%name%", Name));
    }
    <?php if($language != "English" && $language != "Debug") {
        echo '$(document).ready(function () {';
        changevalidation("INPUT", $strings["forms_fillall"]);
        changevalidation("SELECT", $strings["forms_selectone"]);
        echo '});';
    }
    echo '</SCRIPT>';
    $strings["hasJS"] = true;
    return true;
}

function changevalidation($inputtype, $message){
    ?>
        var intputElements = document.getElementsByTagName("<?= $inputtype; ?>");
        for (var i = 0; i < intputElements.length; i++) {
            element = intputElements[i];
            intputElements[i].oninvalid = function (e) {
                e.target.setCustomValidity("");
                if (!e.target.validity.valid) {
                    var message = "<?= addslashes($message); ?>";
                    e.target.setCustomValidity(message);
                }
            }
        }
    <?php
}

function copy2globals($strings, $values){
    foreach($values as $value){
        $GLOBALS[$value] = $strings[$value];
    }
}

function getpost($Key, $Default = ""){
    if (isset($_GET[$Key])){ return $_GET[$Key]; }
    if (isset($_POST[$Key])){ return $_POST[$Key]; }
    return $Default;
}

function formatname($profile){
    $name = trim(ucfirst(h($profile->fname)) . " " . ucfirst(h($profile->lname)));
    if ($profile->username){
        if($name){
            $name .= " (" . ucfirst(h($profile->username)) . ")";
        } else {
            $name =  ucfirst(h($profile->username));
        }
    }
    return $name;
}

function cleanit($array){
    return str_replace("\r\n", "", str_replace('\"', '"', addslashes(implode('", "',$array))));
}
function loadstringsJS($strings){
    echo 'var stringnames = ["' . cleanit(array_keys($strings)) . '"];' . "\r\n";
    echo '    var stringvalues = ["' . cleanit(array_values($strings)) . '"];' . "\r\n";
    ?>
    function getstring(Name){
        for (index = 0; index < stringnames.length; index++) {
            if (stringnames[index] == Name){
                return stringvalues[index];
            }
        }
    }
    function translate(){
        var elements = document.body.getElementsByTagName("translate");
        var key = "";
        for (id = 0; id < elements.length; id++) {
            element = elements[id];
            key = element.innerHTML;
            if (key.indexOf("_") > 0){
                value = getstring(key);
                element.innerHTML = value;
            }
        }
    }
    <?php
}
?>