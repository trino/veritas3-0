<!DOCTYPE html><TITLE>Uniform</TITLE>
<?php
//include_once ($dirroot . '/../webroot/subpages/api.php');
include_once ('api.php');
$offsethours = 0;
$AllowUploads = ' style="display: none"';
$doback = true;
$dosubmit = true;

$language = get("language", "English");
$settings = array();

function offsettime($value, $period = "minutes", $date = "", $format = "Y-m-d H:i:s"){
    if (!$date) {$date = date($format);}
    $newdate= date_create($date);
    if ($value < 0) {$direction = "";} else {$direction = "+";}
    if ($value) {$newdate->modify($direction . $value . " " . $period);};
    return $newdate->format($format);
}
//returns the order ID
function constructorder($title, $user_id, $client_id, $conf_recruiter_name, $conf_driver_name, $forms, $otherdata = "", $order_type = "PSA"){
    global $offsethours, $con;
    $data = array("created" => offsettime($offsethours, "hours"), "socialdate1" => date('Y-m-d'), "socialdate2" => date('Y-m-d'), "physicaldate" => date('Y-m-d'));
    $data["description"] = "Website order";
    $data["title"] = $title;
    $data["user_id"] = $user_id;
    $data["client_id"] = $client_id;
    $data["conf_recruiter_name"] = $conf_recruiter_name;
    $data["conf_driver_name"] = $conf_driver_name;
    $data["forms"] = $forms;
    $data["order_type"] = $order_type;
    if(is_array($otherdata)){
        $data = array_merge($data, $otherdata);
    }
    insertdb($con, "orders", $data);
    return mysqli_insert_id($con);
}
function constructdocument($orderid, $document_type, $sub_doc_id, $user_id, $client_id, $uploaded_for = 0, $draft = 0, $Execute = True){
    //id, order_id, document_type, sub_doc_id, title, description, scale, reason, suggestion, user_id, client_id, uploaded_for, created, draft, file
    global $offsethours, $con;
    $data = array("created" => offsettime($offsethours, "hours"), "order_id" => $orderid);
    //$data["description"] = "Website order";
    $data["document_type"] = $document_type;
    $data["sub_doc_id"] = $sub_doc_id;
    $data["user_id"] = $user_id;
    $data["client_id"] = $client_id;
    $data["uploaded_for"] = $uploaded_for;
    $data["draft"] = $draft;
    $data = insertdb($con, "documents", $data, "", $Execute);//$conn, $Table, $DataArray, $PrimaryKey = "", $Execute =
    //die("<BR>Current date: " . $this->offsettime(0, "hours"));
    if($Execute){ return mysqli_insert_id($con); }
    return $data;
}

function constructsubdoc($data, $formID, $userID, $clientID, $orderid=0, $Execute = True){
    global $con;
    $subdocinfo = first("SELECT * from subdocuments WHERE id = " . $formID);
    $table = $subdocinfo["table_name"];
    $docTitle = $subdocinfo["title"];
    $docid = constructdocument($orderid, $docTitle, $formID, $userID, $clientID, 0,0, $Execute);//22= doc id number, 81 = user id for SMI site, 1=client id for SMI
    $data["document_id"] = $docid;
    $data["order_id"] = $orderid;
    $data["client_id"] = $clientID;
    $data["user_id"] = $userID;
    if(!$Execute){$data["document_id"] = " -- No Document ID --- ";}
    $remove = "";
    switch ($formID){
        case 9:
            $remove = array("count_past_emp", "attach_doc");
            break;
    }
    if (is_array($remove)){
        foreach($remove as $key){
            unset($data[$key]);
        }
    }
    $data = insertdb($con, $table, $data, "", $Execute);
    if($Execute){return $docid;}
    return $docid . "<BR>" . $data;
}

function converge($array){
    foreach($array as $Key => $Value){//it's doing some weird thing where values are put in arrays instead
        if (is_array($Value)){
            if (count($Value) == 1) {
                $array[$Key] = $Value[0];
            }
        }
    }
    return $array;
}

function AJAX($Query){
    $URL =  "http://" . $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    $URL = str_replace("index.php", "", $URL);
    $Q = strpos($URL, "?");
    if($Q){$URL = substr($URL, 0, $Q);}
    $URL = str_replace("application/", "", $URL);//must be updated to the current path of the file
    return file_get_contents($URL . $Query );
}

if (count($_POST) > 0) {
    $strings = CacheTranslations($language, array("uniform_%", "addorder_back"), $settings);
    includeCSS("login");
    $_POST = converge($_POST);
    echo '<div class="logo"></div><div class="content" style="width:60%">';

    switch ($_GET["form"]) {
        case 4:////offence, date_of_sentence, location go into consent_form_criminal, then unset them
            $offences = $_POST["offence"];
            $date_of_sentences = $_POST["date_of_sentence"];
            $locations = $_POST["location"];
            unset($_POST["offence"]);
            unset($_POST["date_of_sentence"]);
            unset($_POST["location"]);
            break;
    }

    $dosubmit = false;
    if(isset($_GET["client_id"])){
        $clientID = $_GET["client_id"];
        $client = first("SELECT * FROM clients WHERE id = " . $clientID);
    } else {
        $client = first("SELECT * FROM clients WHERE company_name LIKE 'GFS%' OR company_name LIKE 'Gordon%'");//Find gordon food services
        $clientID = $client["id"];
    }
    $userID = get("user_id", 81);//TEST DATA
    $Execute = true;//False = test mode
    $query = constructsubdoc($_POST, $_GET["form"], $userID, $clientID, 0, $Execute);
    if($Execute) {
        switch ($_GET["form"]) {
            case 4:////offence, date_of_sentence, location go into consent_form_criminal
                $data = array("consent_form_id" => mysqli_insert_id($con));//might use $query instead
                foreach($offences as $ID => $offense){
                    $data["offence"] = $offense;
                    $data["date_of_sentence"] = $date_of_sentences[$ID];
                    $data["location"] = $locations[$ID];
                    insertdb($con, "consent_form_criminal", $data, "", $Execute);
                }
                break;
        }

        echo AJAX("clients/quickcontact?Type=email&user_id=" . $_POST["user_id"] . "&doc_id=" . $query . "&form=" . $_GET["form"] . "&client_id=" . $clientID);
    } else {
        echo "<P>" . $query . "<P>";
    }
} else {
    includeCSS("login");
    $is_disabled = '';
    if (isset($disabled)){ $is_disabled = 'disabled="disabled"';}
    $strings = CacheTranslations($language, array("orders_%", "forms_%", "documents_%", "profiles_null", "clients_addeditimage", "addorder_%", "uniform_%"), $settings);
    echo '<FORM ACTION="" METHOD="POST"><div class="logo"></div> <div class="content" style="width:60%">';

    $ignore = array("language", "form");
    foreach($_GET as $Key => $Value){
        if (!in_array($Key, $ignore)){
            echo '<INPUT TYPE="HIDDEN" NAME="' . $Key . '" VALUE="' . $Value . '">';
        }
    }

    if (isset($_GET["user_id"])){
        if(get("form")) {
            $profile = first("SELECT * FROM profiles WHERE id = " . $_GET["user_id"]);
            //print_r ($profile);
        }
    } else {
        $dosubmit= false;
        echo '<div class="alert alert-danger display-hide" style="display: block;">' . $strings["uniform_nouserid"] . '</div>';
    }

    echo '<DIV ALIGN="CENTER"><img src="' . $webroot . 'img/logo.png"  /></DIV>';//gfs

    switch (get("form")){
        case 9:
            include("forms/loe.php");//works!
        break;
        case 4:
            include("forms/consent.php");
        break;
        default:
            $doback = false;
            echo $strings["uniform_pleaseselect"] . ":<UL>";
            $forms = array(4,9);
            $fieldname = "title";
            if ($language != "English" && $language != "Debug"){ $fieldname.=$language;}
            foreach ($forms as $formID){
                $form = first("SELECT * FROM subdocuments WHERE id = " . $formID);
                echo '<LI><A HREF="' . getq("form=" . $formID) . '">'. $form[$fieldname] . '</A></LI>';
            }
            echo '<LI><A HREF="30days.php' . getq() . '">30 days</A></LI>';
            echo '<LI><A HREF="60days.php' . getq() . '">60 days</A></LI>';
            echo '<LI><A HREF="apply.php' . getq() . '">Apply</A></LI>';
            echo '<LI><A HREF="register.php' . getq() . '">Register</A></LI>';
            echo "</UL>";
    }
}

function getq($data = ""){
    if( $_SERVER['QUERY_STRING']){
        if($data) {
            return "?" . $_SERVER['QUERY_STRING'] . "&" . $data;
        } else {
            return "?" . $_SERVER['QUERY_STRING'];
        }
    } elseif($data) {
        return "?" . $data;
    }
}
?>
<SCRIPT>
    $(function () {
            $(".datepicker").datepicker({
                changeMonth: true,
                changeYear: true,
                yearRange: '1980:2020',
                dateFormat: 'mm/dd/yy'
            });
        });
</SCRIPT>
<?php if($doback){
    if ($dosubmit){ ?>
        <INPUT TYPE="SUBMIT" class="btn btn-info" VALUE="<?= $strings["forms_submit"]; ?>" STYLE="float: right;">
        <div class="clearfix"></div>
    <?php }
backbutton($strings["addorder_back"]);
    } ?>
</div></form>
</BODY>