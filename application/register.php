<!DOCTYPE html><TITLE>Register with MEE</TITLE>
<?php
    $logo = 'img/logos/';
    $company_name = "";

   include_once("api.php");

    if (isset($_GET["client"])) {
        $row = first("SELECT * FROM clients where id = " . $_GET["client"]);
        if ($row) {
            $logo = "img/jobs/" . $row["image"];
            $company_name = $row["company_name"];
        }

    }

    if (!$logo) {
        $logo = "";//default logo here
    }

    function printoption2($value, $selected = "", $option)
    {
        $tempstr = "";
        if ($option == $selected or $value == $selected) {
            $tempstr = " selected";
        }
        echo '<OPTION VALUE="' . $value . '"' . $tempstr . ">" . $option . "</OPTION>";
    }


    function printprovinces($name, $selected = "", $isdisabled = "", $isrequired = false, $Title = "Province")
    {
        printoptions($name, array("", "AB", "BC", "MB", "NB", "NL", "NT", "NS", "NU", "ON", "PE", "QC", "SK", "YT"), $selected, array($Title, "Alberta", "British Columbia", "Manitoba", "New Brunswick", "Newfoundland and Labrador", "Northwest Territories", "Nova Scotia", "Nunavut", "Ontario", "Prince Edward Island", "Quebec", "Saskatchewan", "Yukon Territories"), $isdisabled, $isrequired);
    }

?>

<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
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
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js" type="text/javascript"></script>

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
    <!--script src="<?= $webroot; ?>assets/admin/pages/scripts/login.js" type="text/javascript"></script-->
    <!-- END PAGE LEVEL SCRIPTS -->
    <script>
        $(document).ready(function () {
            Metronic.init(); // init metronic core components
            Layout.init(); // init current layout
            // Login.init();
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

<div class="content" style="width:60%">
    <center>
        <img src="<?= $webroot . $logo; ?>" style="max-width: 33%; max-height: 100px;"/></center>
    <form class="login-form" action="<?= $webroot; ?>rapid" method="post">
        <div class="col-md-12">

            <h3 class="form-title">Register for an account</h3>
        </div>
        <div class="clearfix"></div>
        <?php
            if (isset($_GET["username"])) {
                echo '<div class="alert alert-info display-hide col-md-12" style="display: block;">
                        <button class="close" data-close="alert"></button>

                        <!--A HREF="' . $webroot . "profiles/view/" . $_GET["userid"] . '">
                        User "' . $_GET["username"] . '" has been created.</A-->
                        Thank you for registering. We\'ll be in contact with you shortly.
                        </div>';
            }
            if (isset($_GET['error'])) {
                echo '<div class="col-md-12 alert alert-error display-hide" style="display: block;">
                        <button class="close" data-close="alert"></button>
                        User "' . $_GET["username"] . '" was not created.</div>';
            }
        ?>
        <div class="form-group col-md-4 col-sm-4">
            <label class="control-label visible-ie8 visible-ie9">Client</label>

            <div class="input-icon">
                <i class="fa fa-building"></i>
                <?php
                    if ($company_name) {
                        echo '<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Client" name="clientname" required="required" DISABLED VALUE="' . $company_name . '"/>';
                    } else {
                        echo '<select name="client_ids" class="form-control placeholder-no-fix clients" required="required">';
                        echo '<option value="">Select Client</option>';
                        $result = $con->query("SELECT * FROM clients");
                        while ($row = mysqli_fetch_array($result)) {
                            echo '<option value="' . $row['id'] . '">' . $row['company_name'] . '</option>';
                        }
                        echo '</select>';
                    }
                ?>
                <!--input type="hidden" value="5" name="profile_type"-->
                <!--input type="hidden" value="3" name="driver"-->
                <input type="hidden" value="<?php if (isset($_GET["client"])) {
                    echo $_GET["client"];
                } ?>" name="client_ids">
            </div>
        </div>

        <div class="form-group col-md-4 col-sm-4" TITLE="If left blank, the username will be 'Driver_[User ID#]'">
            <label class="control-label visible-ie8 visible-ie9">Username</label>

            <div class="input-icon">
                <i class="fa fa-user"></i>
                <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Username"
                       name="username"/>
            </div>
        </div>


        <div class="form-group col-md-4 col-sm-4">
            <label class="control-label visible-ie8 visible-ie9">Email</label>

            <div class="input-icon">
                <i class="fa fa-envelope"></i>
                <input class="email form-control placeholder-no-fix" type="email" autocomplete="off" placeholder="Email"
                       name="email" required="required"/>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="form-group col-md-4 col-sm-4">
            <label class="control-label visible-ie8 visible-ie9">Title</label>

            <div class="input-icon">
                <i class="fa fa-child"></i>
                <SELECT CLASS="form-control placeholder-no-fix" placeholder="Title" name="title" required="required"/>
                <?php
                    printoption("Select Title", "");
                    printoption("Mr.", $title, "Mr.");
                    printoption("Mrs.", $title, "Mrs.");
                    printoption("Ms.", $title, "Ms.");
                ?>
                </SELECT>
            </div>
        </div>
        <div class="form-group col-md-4 col-sm-4">
            <label class="control-label visible-ie8 visible-ie9">Phone Number</label>

            <div class="input-icon">
                <i class="fa fa-phone"></i>
                <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Phone Number"
                       name="phone" required="required"/>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="form-group col-md-4 col-sm-4">
            <div class="input-icon">
                <i class="fa fa-user"></i>
                <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="First Name"
                       name="fname" required="required"/>
            </div>
        </div>
        <div class="form-group col-md-4 col-sm-4">
            <div class="input-icon">
                <i class="fa fa-user"></i>
                <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Middle Name"
                       name="mname" required="required"/>
            </div>
        </div>
        <div class="form-group col-md-4 col-sm-4">
            <div class="input-icon">
                <i class="fa fa-user"></i>
                <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Last Name"
                       name="lname" required="required"/>
            </div>
        </div>
        <div class="clearfix"></div>


        <div class="clearfix"></div>
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

        <div class="form-group col-md-4 col-sm-4">
            <label class="control-label visible-ie8 visible-ie9">Place of Birth</label>

            <div class="input-icon">
                <i class="fa fa-globe"></i>
                <input class="form-control placeholder-no-fix" type="text" autocomplete="off"
                       placeholder="Place of Birth" name="placeofbirth" required="required"/>
            </div>
        </div>

        <div class="form-group col-md-4 col-sm-4">
            <label class="control-label visible-ie8 visible-ie9">Date of Birth</label>

            <div class="input-icon">
                <i class="fa fa-calendar"></i>
                <INPUT TYPE="Text" NAME="dob" size=10 MAXLENGTH="10" placeholder="Date of Birth"
                       CLASS="datepicker form-control placeholder-no-fix">

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
                        printoption($monthnames[$temp - 1], "", $temp);
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
        <div class="clearfix"></div>

        <div class="form-group col-md-12 col-sm-12">
            <label class="control-label">Address</label>
        </div>
        <div class="form-group col-md-4 col-sm-4">
            <div class="input-icon">
                <i class="fa fa-globe"></i>
                <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Street"
                       name="street" required="required"/>
            </div>
        </div>
        <div class="form-group col-md-4 col-sm-4">
            <div class="input-icon">
                <i class="fa fa-globe"></i>
                <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="City"
                       name="city" required="required"/>
            </div>
        </div>
        <div class="form-group col-md-4 col-sm-4">
            <div class="input-icon">
                <i class="fa fa-globe"></i>
                <?php printprovinces("province", "", "", false); ?>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="form-group col-md-4 col-sm-4">
            <div class="input-icon">
                <i class="fa fa-globe"></i>
                <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Postal Code"
                       name="postal" required="required"/>
            </div>
        </div>
        <div class="form-group col-md-4 col-sm-4">
            <div class="input-icon">
                <i class="fa fa-globe"></i>
                <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Country"
                       name="country" required="required" disabled value="Canada"/>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="form-group col-md-12 col-sm-12">
            <label class="control-label ">Driver's License</label>
        </div>
        <div class="form-group col-md-4 col-sm-4">
            <div class="input-icon">
                <i class="fa fa-credit-card"></i>
                <input class="form-control placeholder-no-fix" type="text" autocomplete="off"
                       placeholder="Driver's License #" name="driver_license_no" required="required"/>
            </div>
        </div>
        <div class="form-group col-md-4 col-sm-4">
            <div class="input-icon">
                <i class="fa fa-calendar"></i>
                <INPUT TYPE="Text" NAME="expiry_date" size=10 MAXLENGTH="10" placeholder="Expiry Date"
                       CLASS="datepicker form-control placeholder-no-fix">
            </div>
        </div>
        <div class="form-group col-md-4 col-sm-4">
            <div class="input-icon">
                <i class="fa fa-globe"></i>
                <?php printprovinces("driver_province", "", "", false, "Province Issued"); ?>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="form-group col-md-12 col-sm-12">
            <label class="control-label ">Where did you hear about us?</label>
        </div>
        <div class="form-group col-md-12 col-sm-12">
            <textarea name="hear" class="form-control"></textarea>
        </div>
        <div class="clearfix"></div>

        <div class="col-md-12">
            <a href="javascript:void(0);" class="btn green-haze pull-right" onclick="return check_username();">
                Submit <i class="m-icon-swapright m-icon-white"></i>
            </a>
        </div>
        <div class="clearfix"></div>

        <input type="submit" id="hiddensub" style="display: none;"/>
    </form>

    <div class="clearfix"></div>

    <DIV align="center"><A HREF="index.php<?php
        if (isset($_GET["user_id"])){
            echo "?user_id=" . $_GET["user_id"];
        }
        echo '">Back</A></DIV>';
        ?>
</div>
    <script>
        function check_username() {
            var client_id = $('.client_profile_id').val();
            if (client_id == "") {

            }
            var un = $('.uname').val();
            if (un) {
                $.ajax({
                    url: '<?php echo $webroot;?>profiles/check_user',
                    data: 'username=' + un,
                    type: 'post',
                    success: function (res) {
                        res = res.trim();
                        if (res == '1') {
                            //alert(res);
                            alert('Username already exists');

                            $('.uname').focus();
                            $('html,body').animate({
                                    scrollTop: $('.login-form').offset().top
                                },
                                'slow');

                            return false;
                        } else {
                            $('.flashUser').hide();
                            if ($('.email').val() != '') {
                                var un = $('.email').val();
                                $.ajax({
                                    url: '<?php echo $webroot;?>profiles/check_email',
                                    data: 'email=' + $('.email').val(),
                                    type: 'post',
                                    success: function (res) {
                                        res = res.trim();
                                        if (res == '1') {
                                            $('.email').focus();
                                            alert('Email already exists');
                                            $('html,body').animate({
                                                    scrollTop: $('.login-form').offset().top
                                                },
                                                'slow');

                                            return false;
                                        } else {
                                            $(this).attr('disabled', 'disabled');
                                            $('#hiddensub').click();
                                        }
                                    }
                                });
                            } else {
                                $('#hiddensub').click();
                            }
                        }
                    }
                });
            } else {
                $('#hiddensub').click();
            }
        }

        $(function () {
            $(".datepicker").datepicker({
                changeMonth: true,
                changeYear: true,
                yearRange: '1980:2020',
                dateFormat: 'yy-mm-dd'
            });
            $('.clients').change(function () {
                var cid = $(this).val();
                if (cid != "")
                    window.location = "<?php echo str_replace("webroot/", "", $webroot) ;?>application/register.php?client=" + cid;
            })
        });
    </script>

</body>
</html>