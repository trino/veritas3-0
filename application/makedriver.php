<!DOCTYPE html><TITLE>Rapid User Creation</TITLE>
<?php
$webroot = $_SERVER["REQUEST_URI"];
$start = strpos($webroot, "/", 1)+1;
$webroot = substr($webroot,0,$start);

$con = "";
$logo = 'img/logos/';
$company_name="Unknown";

function connectdb(){
    global $con;
    $con = mysqli_connect("localhost:3306", "root", "","veritas3") or die("Error " . mysqli_error($con));
    return $con;
}

function first($query){
    global $con;
    $result = $con->query($query);
    while ($row = mysqli_fetch_array($result)) {
        return $row;
    }
}

$con = connectdb();
if(isset($_GET["client"])) {
    $row = first("SELECT * FROM clients where id = " . $_GET["client"]);
    if($row) {
        $logo = "img/jobs/" . $row["image"];
        $company_name = $row["company_name"];
    }
    if(isset($_GET["username"])) {
        //INSERT CODE TO SAVE TO THE TABLE, HERE!
    }
}

if(!$logo){
    $logo = "";
}


function printoption($option, $selected, $value = ""){
    $tempstr = "";
    if ($option == $selected) {
        $tempstr = " selected";
    }
    if (strlen($value) > 0) {
        $value = " value='" . $value . "'";
    }
    echo '<option' . $value . $tempstr . ">" . $option . "</option>";
}

function printoption2($value, $selected = "", $option){
    $tempstr = "";
    if ($option == $selected or $value == $selected) {
        $tempstr = " selected";
    }
    echo '<OPTION VALUE="' . $value . '"' . $tempstr . ">" . $option . "</OPTION>";
}

function printoptions($name, $valuearray, $selected = "", $optionarray, $isdisabled = "", $isrequired = false){
    if ($name == 'profile_type') {
        echo '<SELECT ' . $isdisabled . ' name="' . $name . '" class="form-control member_type req_driver"';
    } else {
        echo '<SELECT ' . $isdisabled . ' name="' . $name . '" class="form-control req_driver"';
    }
    echo '>';

    for ($temp = 0; $temp < count($valuearray); $temp += 1) {
        printoption2($valuearray[$temp], $selected, $optionarray[$temp]);
    }
    echo '</SELECT>';
}

function printprovinces($name, $selected = "", $isdisabled = "", $isrequired = false, $Title= "Province"){
    printoptions($name, array("", "AB", "BC", "MB", "NB", "NL", "NT", "NS", "NU", "ON", "PE", "QC", "SK", "YT"), $selected, array($Title, "Alberta", "British Columbia", "Manitoba", "New Brunswick", "Newfoundland and Labrador", "Northwest Territories", "Nova Scotia", "Nunavut", "Ontario", "Prince Edward Island", "Quebec", "Saskatchewan", "Yukon Territories"), $isdisabled, $isrequired);
}

?>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8"/>
    <title></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
    <link href="<?= $webroot; ?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?= $webroot; ?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?= $webroot; ?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?= $webroot; ?>assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="<?= $webroot; ?>assets/global/plugins/select2/select2.css" rel="stylesheet" type="text/css"/>
    <link href="<?= $webroot; ?>assets/admin/pages/css/login3.css" rel="stylesheet" type="text/css"/>
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN THEME STYLES -->
    <link href="<?= $webroot; ?>assets/global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
    <link href="<?= $webroot; ?>assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
    <link href="<?= $webroot; ?>assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
    <link href="<?= $webroot; ?>assets/admin/layout/css/themes/darkblue.css" rel="stylesheet" type="text/css" id="style_color"/>
    <link href="<?= $webroot; ?>assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME STYLES -->
    <link rel="shortcut icon" href="favicon.ico"/>
    <!-- END COPYRIGHT -->
    <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
    <!-- BEGIN CORE PLUGINS -->
    <!--[if lt IE 9]>
    <script src="<?= $webroot; ?>assets/global/plugins/respond.min.js"></script>
    <script src="<?= $webroot; ?>assets/global/plugins/excanvas.min.js"></script>
    <![endif]-->
    <script src="<?= $webroot; ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
    <script src="<?= $webroot; ?>assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
    <script src="<?= $webroot; ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?= $webroot; ?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
    <script src="<?= $webroot; ?>assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
    <script src="<?= $webroot; ?>assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="<?= $webroot; ?>assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?= $webroot; ?>assets/global/plugins/select2/select2.min.js"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="<?= $webroot; ?>assets/global/scripts/metronic.js" type="text/javascript"></script>
    <script src="<?= $webroot; ?>assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
    <script src="<?= $webroot; ?>assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
    <script src="<?= $webroot; ?>assets/admin/pages/scripts/login.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <script>
        jQuery(document).ready(function() {
            Metronic.init(); // init metronic core components
            Layout.init(); // init current layout
            Login.init();
            Demo.init();
        });
    </script>
    <!-- END JAVASCRIPTS -->
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="login">
<!-- BEGIN LOGO -->

<!-- END LOGO -->
<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
<div class="menu-toggler sidebar-toggler">
</div>
<!-- END SIDEBAR TOGGLER BUTTON -->












<div class="logo"></div>

<div class="content">
    <center>
        <img src="<?= $webroot . $logo;?>"  style="max-width: 100%;"/></center>
        <form class="login-form" action="<?php echo $webroot; ?>application/makedriver.php" method="get">
            <h3 class="form-title">Create a new driver</h3>
            <?php
                if (isset($_GET["username"])){
                    echo '<div class="alert alert-info display-hide" style="display: block;">
                        <button class="close" data-close="alert"></button>
                        User "' . $_GET["username"] . '" has been created.</div>';
                }
            ?>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Client</label>
                <div class="input-icon">
                    <i class="fa fa-building"></i>
                    <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Client" name="clientname" required="required" DISABLED VALUE="<?= $company_name; ?>"/>
                    <input type="hidden" value="<?php if(isset($_GET["client"])) {echo $_GET["client"];} ?>" name="client">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Username</label>
                <div class="input-icon">
                    <i class="fa fa-user"></i>
                    <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username" required="required" />
                </div>
            </div>

            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Email</label>
                <div class="input-icon">
                    <i class="fa fa-envelope"></i>
                    <input class="form-control placeholder-no-fix" type="email" autocomplete="off" placeholder="Email" name="email" required="required" />
                </div>
            </div>

            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Title</label>
                <div class="input-icon">
                    <i class="fa fa-child"></i>
                    <SELECT CLASS="form-control placeholder-no-fix" placeholder="Title" name="title" required="required" />
                        <?php
                            printoption("Select Title", "");
                            printoption("Mr.", $title, "Mr.");
                            printoption("Mrs.", $title, "Mrs.");
                            printoption("Ms.", $title, "Ms.");
                        ?>
                    </SELECT>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Name</label>
                <div class="input-icon">
                    <i class="fa fa-user"></i>
                    <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="First Name" name="fname" required="required" />
                    <i class="fa fa-user"></i>
                    <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Middle Name" name="mname" required="required" />
                    <i class="fa fa-user"></i>
                    <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Last Name" name="lname" required="required" />
                </div>
            </div>

            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Phone Number</label>
                <div class="input-icon">
                    <i class="fa fa-phone"></i>
                    <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Phone Number" name="phone" required="required" />
                </div>
            </div>

            <!--div class="form-group">     JUST BASE IT OFF THE TITLE!
                <label class="control-label visible-ie8 visible-ie9">Gender</label>
                <div class="input-icon">
                    <i class="fa fa-child"></i>
                    <SELECT CLASS="form-control placeholder-no-fix" placeholder="Gender" name="gender" required="required" />
                        <?php
                            printoption("Select Gender", "");
                            printoption("Male", $gender, "Male");
                            printoption("Female", $gender, "Female");
                        ?>
                    </SELECT>
                </div>
            </div-->

            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Place of Birth</label>
                <div class="input-icon">
                    <i class="fa fa-globe"></i>
                    <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Place of Birth" name="placeofbirth" required="required" />
                </div>
            </div>

            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Date of Birth</label>
                <div class="input-icon">
                    <i class="fa fa-calendar"></i>
                    <INPUT TYPE="Text" NAME="dob" size=10 MAXLENGTH="10" id="datepicker" placeholder="Date of Birth" CLASS="form-control placeholder-no-fix">

                    <!--SELECT CLASS="form-control placeholder-no-fix" placeholder="Title" name="dobY" required="required" />
                        <?php
                            $now = date("Y");
                            for ($temp = $now; $temp > 1899; $temp -= 1) {
                                printoption($temp, $currentyear, $temp);
                            }
                        ?>
                    </SELECT>

                    <i class="fa fa-calendar"></i>
                    <SELECT CLASS="form-control placeholder-no-fix" placeholder="Title" name="dobM" required="required" />
                        <?php
                            $monthnames = array("Jan", "Feb", "Mar", "Apr", "May", "June", "July", "Aug", "Sept", "Oct", "Nov", "Dec");
                            for ($temp = 1; $temp < 13; $temp += 1) {
                                if ($temp < 10) {
                                    $temp = "0" . $temp;
                                }
                                printoption($monthnames[$temp-1], "", $temp);
                            }
                        ?>
                    </SELECT>

                    <i class="fa fa-calendar"></i>
                    <SELECT CLASS="form-control placeholder-no-fix" placeholder="Title" name="dobD" required="required" />
                        <?php
                            for ($temp = 1; $temp < 32; $temp++) {
                                if ($temp < 10) {
                                    $temp = "0" . $temp;
                                }
                                printoption($temp, $currentday, $temp);
                            }
                        ?>
                    </SELECT-->
                </div>
            </div>

            <div class="form-group">
                <label class="control-label">Address</label>
                <div class="input-icon">
                    <i class="fa fa-globe"></i>
                    <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Street" name="street" required="required" />
                    <i class="fa fa-globe"></i>
                    <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="City" name="city" required="required" />
                    <i class="fa fa-globe"></i>
                    <?php printprovinces("province", "", "", false); ?>
                    <i class="fa fa-globe"></i>
                    <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Postal Code" name="postal" required="required" />
                    <i class="fa fa-globe"></i>
                    <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Country" name="country" required="required" disabled value="Canada"/>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label ">Driver's License</label>
                <div class="input-icon">
                    <i class="fa fa-credit-card"></i>
                    <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Driver's License #" name="driver_license_no" required="required" />

                    <i class="fa fa-calendar"></i>
                    <INPUT TYPE="Text" NAME="dob" size=10 MAXLENGTH="10" id="datepicker" placeholder="Expiry Date" CLASS="form-control placeholder-no-fix">

                    <i class="fa fa-globe"></i>
                    <?php printprovinces("driver_province", "", "", false, "Province Issued"); ?>

                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn green-haze pull-right" >
                    Create <i class="m-icon-swapright m-icon-white"></i>
                </button>
            </div>

        </form>

    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js" type="text/javascript"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js" type="text/javascript"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $(function() {
                $( "#datepicker" ).datepicker({
                    changeMonth: true,
                    changeYear: true,
                    yearRange: '1980:2020',
                    dateFormat: 'yy-mm-dd'
                });
            });
        });
    </script>

</body>
</html>