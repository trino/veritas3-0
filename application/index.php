<!DOCTYPE html><TITLE>MEE</TITLE>
<STYLE>
    .required:after {
        content: " *";
        color: #e32;
    }

    .content{
        width: 70% !important;
    }

    @media print {
        .content{
            width: 90% !important;
        }

        a[href]:after {
            content: none !important;
        }

        .no-print, .no-print * {
            display: none !important;
        }


        .splitcolsOLD {
            -webkit-column-count: 2 !important; /* Chrome, Safari, Opera */
            -moz-column-count: 2 !important; /* Firefox */
            column-count: 2 !important; */
        }

        .row {
            margin-left: -30px;
            margin-right: -30px;
        }

        .col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12 {
            float: left;
        }
        .col-md-12 {
            width: 100%;
        }
        .col-md-11 {
            width: 91.66666666666666%;
        }
        .col-md-10 {
            width: 83.33333333333334%;
        }
        .col-md-9 {
            width: 75%;
        }
        .col-md-8 {
            width: 66.66666666666666%;
        }
        .col-md-7 {
            width: 58.333333333333336%;
        }
        .col-md-6 {
            width: 50%;
        }
        .col-md-5 {
            width: 41.66666666666667%;
        }
        .col-md-4 {
            width: 33.33333333333333%;
        }
        .col-md-3 {
            width: 25%;
        }
        .col-md-2 {
            width: 16.666666666666664%;
        }
        .col-md-1 {
            width: 8.333333333333332%;
        }

    }
</STYLE>
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
    $docid = constructdocument($orderid, $docTitle, $formID, $userID, $clientID, $userID,0, $Execute);//22= doc id number, 81 = user id for SMI site, 1=client id for SMI
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
    $ret="";
    switch ($formID){
        case 9:
            $formcount = countforms($data);
            for($index = 0; $index < $formcount; $index ++){
                $form = converge($data, $index);
                $ret .= "<BR>" . insertdb($con, $table, $form, "", $Execute);
            }
            break;
        default:
            $ret = "<BR>" . insertdb($con, $table, $data, "", $Execute);
    }
    if($Execute){return $docid;}
    return $docid . $ret;
}

function countforms($array){
    foreach($array as $Key => $Value) {
        if (is_array($Value)) {
            return count($Value);
        }
    }
    return 0;
}

function converge($array, $index){
    $data = array();
    foreach($array as $Key => $Value){//it's doing some weird thing where values are put in arrays instead
        $newKey = $Key;
        if (strpos($Key, "_")){//remove numbers from the end
            $newKey =  explode("_", $Key);
            $lastvalue = $newKey[count($newKey)-1];
            if (is_numeric($lastvalue)){
                $newKey = str_replace("_" . $lastvalue, "", $Key);
            } else {
                $newKey = $Key;
            }
        }

        if (is_array($Value)){
            if($index < count($Value)) {
                $data[$newKey] = $Value[$index];
            }
        } else {
            $data[$newKey] = $Value;
        }
    }
    return $data;
}

function AJAX($Query){
    $URL =  "http://" . $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    $URL = str_replace("index.php", "", $URL);
    $Q = strpos($URL, "?");
    if($Q){$URL = substr($URL, 0, $Q);}
    $URL = str_replace("application/", "", $URL);//must be updated to the current path of the file
    return file_get_contents($URL . $Query );
}

function handlemsg($strings = "", $bypass = false) {
    $message = "";
    if ($bypass || isset($_GET["msg"])) {
        if (!$bypass && isset($_GET["msg"])) {$bypass = isset($_GET["msg"]);}
        switch ($bypass) {
            case "success":
<<<<<<< HEAD
                $message = "The form has been submitted.";
=======
                $message = "Document saved successfully.";
>>>>>>> origin/master
                break;
            case "done":
                $message = "A GFS employee will get in touch with you shortly";
                break;

        }

        if ($message) {
            echo '<div class="alert alert-info"><button class="close" data-close="alert"></button>' . $message . '</div>';
        }
    }
}

if (count($_POST) > 0) {
    $strings = CacheTranslations($language, array("uniform_%", "addorder_back"), $settings);
    includeCSS("login");
    //var_dump($_POST);
    //$_POST = converge($_POST); //do not do
    echo '<div class="logo"></div><div class="content">';
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
    unset($_POST["msg"]);

    switch ($_GET["form"]) {
        case 4://consent: offence, date_of_sentence, location go into consent_form_criminal
            $offences = $_POST["offence"];
            $date_of_sentences = $_POST["date_of_sentence"];
            $locations = $_POST["location"];
            unset($_POST["offence"]);
            unset($_POST["date_of_sentence"]);
            unset($_POST["location"]);
            break;
    }

    $query = constructsubdoc($_POST, $_GET["form"], $userID, $clientID, 0, $Execute);
    $redir = "";
    if($Execute) {
        switch ($_GET["form"]) {
            case 4://consent: offence, date_of_sentence, location go into consent_form_criminal
                $data = array("consent_form_id" => mysqli_insert_id($con));//might use $query instead
                foreach($offences as $ID => $offense){
                    $data["offence"] = $offense;
                    $data["date_of_sentence"] = $date_of_sentences[$ID];
                    $data["location"] = $locations[$ID];
                    insertdb($con, "consent_form_criminal", $data, "", $Execute);
                }
                break;
            case 9://letter of experience
                $redir = '<script> window.location = "?form=4&msg=success&user_id=' . $_POST["user_id"] . '"; </script>';
                break;
        }

        //AJAX("clients/quickcontact?Type=email&user_id=" . $_POST["user_id"] . "&doc_id=" . $query . "&form=" . $_GET["form"] . "&client_id=" . $clientID);
        //echo "Application submitted successfully. A GFS employee will get in touch with you shortly";
        handlemsg($strings, "done");
        if($redir){ echo "<P>" . $redir;}
        //echo "<P>" . $query;
    } else {
        echo "<P>" . $query . "<P>";
    }
} else {
    includeCSS("login");
    $is_disabled = '';
    if (isset($disabled)){ $is_disabled = 'disabled="disabled"';}
    $strings = CacheTranslations($language, array("orders_%", "forms_%", "documents_%", "profiles_null", "clients_addeditimage", "addorder_%", "uniform_%", "verifs_%", "tasks_date"), $settings);

    echo '<FORM ACTION="" METHOD="POST"><div class="logo"></div> <div class="content">';

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
        echo '<div class="alert alert-danger display-hide no-print" style="display: block;">' . $strings["uniform_nouserid"] . '</div>';
    }
    handlemsg($strings);

   // echo '<a href="javascript:window.print();" class="floatright btn btn-info no-print" style="float:right;">' . $strings["dashboard_print"] . '</a>';
    echo '<DIV ALIGN="CENTER"><img src="' . $webroot . 'img/logo.png"  /></DIV>';//gfs

    $stages = "";
    switch (get("form")){
        case 9:
            $stages = " (2 of 3)";
            include("forms/loe.php");//works!
        break;
        case 4:
            $stages = " (3 of 3)";
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
    $(document).ready(function () {
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        // Login.init();
        Demo.init();
    });

    language = '<?= $language ?>';
    $(function () {
            $(".datepicker").datepicker({
                changeMonth: true,
                changeYear: true,
                yearRange: '1980:2020',
                dateFormat: 'mm/dd/yy'
            });
        });

    <?php loadstringsJS($strings); ?>

    function checkformext(){
        if (typeof checkformint == 'function') {
            return checkformint();
        } else {// No internal check
            return true;
        }
        return false;//debugging purposes
    }
</SCRIPT>
<?php if($doback){
    if ($dosubmit){ ?>
        <INPUT TYPE="SUBMIT" class="btn btn-info" onclick="return checkformext();" VALUE="<?= $strings["forms_submit"] . $stages; ?>" STYLE="float: right;">
        <div class="clearfix"></div>
    <?php }
        backbutton($strings["addorder_back"]);
    } ?>
</div></form>
</BODY>