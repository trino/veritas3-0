<!DOCTYPE html><TITLE>Register with MEE</TITLE>
<?php
    $webroot = $_SERVER["REQUEST_URI"];
    $start = strpos($webroot, "/", 1) + 1;
    $webroot = substr($webroot, 0, $start);

    error_reporting(E_ERROR | E_PARSE);//suppress warnings
    include("../config/app.php");//config file is not meant to be run without cake, thus error reporting needs to be suppressed
    error_reporting(E_ALL);//re-enable warnings

    $con = "";
    $logo = 'img/logos/';
    $company_name = "";

    function connectdb()
    {
        global $con, $config;
        $con = mysqli_connect("localhost:3306", $config['Datasources']['default']['username'], $config['Datasources']['default']['password'], $config['Datasources']['default']['database']) or die("Error " . mysqli_error($con));
        return $con;
    }

    function first($query)
    {
        global $con;
        $result = $con->query($query);
        while ($row = mysqli_fetch_array($result)) {
            return $row;
        }
    }
    function second($query)
    {
        global $con;
        $result = $con->query($query);
        while ($row = mysqli_fetch_object($result)) {
            return $row;
        }
    }

    $con = connectdb();

    if (isset($_GET["client"])) {
        $row = first("SELECT * FROM clients where id = 26");
        if ($row) {
            $logo = "img/jobs/" . $row["image"];
            $company_name = $row["company_name"];
        }

    }
    
    if(isset($_GET['form_id']))
    {
        $application_for_employment_gfs = second("SELECT * FROM application_for_employment_gfs where id = ".$_GET['form_id']);
    }
    if (!$logo) {
        $logo = "";//default logo here
    }


    function printoption($option, $selected, $value = "")
    {
        $tempstr = "";
        if ($option == $selected) {
            $tempstr = " selected";
        }
        if (strlen($value) > 0) {
            $value = " value='" . $value . "'";
        }
        echo '<option' . $value . $tempstr . ">" . $option . "</option>";
    }

    function printoption2($value, $selected = "", $option)
    {
        $tempstr = "";
        if ($option == $selected or $value == $selected) {
            $tempstr = " selected";
        }
        echo '<OPTION VALUE="' . $value . '"' . $tempstr . ">" . $option . "</OPTION>";
    }

    function printoptions($name, $valuearray, $selected = "", $optionarray, $isdisabled = "", $isrequired = false)
    {
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
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"
          type="text/css"/>
    <link href="<?= $webroot; ?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="<?= $webroot; ?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="<?= $webroot; ?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="<?= $webroot; ?>assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet"
          type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="<?= $webroot; ?>assets/global/plugins/select2/select2.css" rel="stylesheet" type="text/css"/>
    <link href="<?= $webroot; ?>assets/admin/pages/css/login3.css" rel="stylesheet" type="text/css"/>
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN THEME STYLES -->
    <link href="<?= $webroot; ?>assets/global/css/components.css" id="style_components" rel="stylesheet"
          type="text/css"/>
    <link href="<?= $webroot; ?>assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
    <link href="<?= $webroot; ?>assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
    <link href="<?= $webroot; ?>assets/admin/layout/css/themes/darkblue.css" rel="stylesheet" type="text/css"
          id="style_color"/>
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
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet"
          type="text/css"/>


    <script src="<?= $webroot; ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
    <script src="<?= $webroot; ?>assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js" type="text/javascript"></script>
    <script src="<?= $webroot; ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?= $webroot; ?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
    <script src="<?= $webroot; ?>assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
    <script src="<?= $webroot; ?>assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="<?= $webroot; ?>assets/global/plugins/jquery-validation/js/jquery.validate.min.js"
            type="text/javascript"></script>
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

<div class="content" style="width:70%"> 
<?php if(isset($_GET['msg'])&& $_GET['msg']=='error'){?>
    <div class="alert alert-info " >
        <button class="close" data-close="alert"></button>
        Couldnot submit the form. Please try again.
    </div>

<?php }elseif(isset($_GET['msg'])&& $_GET['msg']=='success'){?>
     <div class="alert alert-info " >
        <button class="close" data-close="alert"></button>
        The Form has been submitted.
    </div>
<?php }?>

<div class="clearfix"></div>
    <form  action="<?php echo $webroot;?>rapid/application_employment" method="post" class="login-form">
        <div class="clearfix"></div>
        <hr/>
        <div class="col-md-12">
            <div class="col-md-6"><img src="<?php echo $webroot;?>img/gfs.png" style="width: 120px;" /></div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
        <p>&nbsp;</p>
        <div>
            <div class="col-md-6">
                    <label class="control-label col-md-3">Name: </label>  
                    <div class="col-md-3">              
                        <input class="form-control" name="lname" placeholder="Last" value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->lname;?>" />
                    </div> 
                    <div class="col-md-3">              
                        <input class="form-control" name="mname" placeholder="Middle" value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->mname;?>" />
                    </div> 
                    <div class="col-md-3">              
                        <input class="form-control" name="fname" placeholder="First" value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->fname;?>" />
                    </div>
            </div>
            <div class="col-md-6">
                    <label class="control-label col-md-4">Telephone: </label>  
                    <div class="col-md-3">              
                        <input class="form-control" name="code" placeholder="Area Code" value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->code;?>" />
                    </div>  
                    <div class="col-md-5">              
                        <input class="form-control" name="phone" value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->phone;?>" />
                    </div>
            </div> 
        </div>
        
        <p>&nbsp;</p>
            <div class="col-md-6">
                    <label class="control-label col-md-4">Current Address: </label>  
                    <div class="col-md-8">              
                        <input class="form-control" name="address" value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->address;?>" />
                    </div>  
            </div>
            <div class="col-md-6">
                    <label class="control-label col-md-4">Email: </label>  
                    <div class="col-md-8">              
                        <input class="form-control email" type="email"  name="email" required="required" value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->email;?>" />
                    </div>  
            </div>
          <div class="clearfix"></div>  
        <p>&nbsp;</p>
            <div class="col-md-12">
                    <label class="control-label col-md-4">Have you ever applied for work with us before? </label>  
                    <div class="col-md-2 radio-list yesNoCheck">
                        <label class="radio-inline">
                        <?php 
                        if(isset($_GET['form_id']))
                        {
                            if(isset($application_for_employment_gfs) && $application_for_employment_gfs->workedbefore=='1')
                            {
                                ?>
                                &#10004;
                                <?php
                            }
                            else 
                            {
                                ?>
                                &#10006;
                                <?php
                            } 
                        }
                        else
                        {
                            ?>                                      
                            <input type="radio" class="form-control" name="workedbefore" id="yesCheck" value="1" 
                            <?php if(isset($application_for_employment_gfs) && $application_for_employment_gfs->workedbefore=='1')echo "checked='checked'";?>/>
                            <?php
                        }
                         ?> <span>Yes</span>
                        </label>
                        <label class="radio-inline">
                        <?php 
                        if(isset($_GET['form_id']))
                        {
                            if(isset($application_for_employment_gfs) && $application_for_employment_gfs->workedbefore=='0')
                            {
                                ?>
                                &#10004;
                                <?php
                            }
                            else 
                            {
                                ?>
                                &#10006;
                                <?php
                            } 
                        }
                        else
                        {
                            ?>                                      
                            <input type="radio" class="form-control" name="workedbefore" id="noCheck" value="0" 
                            <?php if(isset($application_for_employment_gfs) && $application_for_employment_gfs->workedbefore=='0')echo "checked='checked'";?>/>
                            <?php
                        }
                         ?> 
                        <span>No</span>
                        </label>
                    </div>
                    <div id="yesDiv" style="display: none;">
                        <label class="control-label col-md-2">If yes, when? </label> 
                        <div class="col-md-4">              
                            <textarea class="form-control" name="worked"><?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->worked;?></textarea>
                        </div>
                    </div> 
            </div>
            <p>&nbsp;</p>
            <div class="col-md-12">
                    <label class="control-label col-md-4">List anyone you know who woks for us: </label>  
                    <div class="col-md-8">
                        <input class="form-control" name="for_us"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->for_us;?>" /> 
                    </div>
            </div>
            <p>&nbsp;</p>
            <div class="col-md-12">
                    <label class="control-label col-md-4">Did anyone refer you? </label>  
                    <div class="col-md-8">
                        <input class="form-control" name="refer"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->refer;?>" /> 
                    </div>
            </div>
            <p>&nbsp;</p>
            <div class="col-md-6">
                    <label class="control-label col-md-8">Are you 18 years of age or older? </label>  
                    <div class="col-md-4 radio-list">
                        <label class="radio-inline">
                        <?php 
                        if(isset($_GET['form_id']))
                        {
                            if(isset($application_for_employment_gfs) && $application_for_employment_gfs->age=='1')
                            {
                                ?>
                                &#10004;
                                <?php
                            }
                            else 
                            {
                                ?>
                                &#10006;
                                <?php
                            } 
                        }
                        else
                        {
                            ?>                                      
                            <input type="radio" class="form-control" name="age" value="1" <?php if(isset($application_for_employment_gfs) && $application_for_employment_gfs->age=='1')echo "checked='checked'";?>/>
                            <?php
                        }
                         ?>              
                        Yes
                        </label>
                        <label class="radio-inline">
                        <?php 
                        if(isset($_GET['form_id']))
                        {
                            if(isset($application_for_employment_gfs) && $application_for_employment_gfs->age=='0')
                            {
                                ?>
                                &#10004;
                                <?php
                            }
                            else 
                            {
                                ?>
                                &#10006;
                                <?php
                            } 
                        }
                        else
                        {
                            ?>                                      
                            <input type="radio" class="form-control" name="age" value="0" <?php if(isset($application_for_employment_gfs) && $application_for_employment_gfs->age=='0')echo "checked='checked'";?>/>
                            <?php
                        }
                         ?>
                         No
                        </label>
                    </div>
            </div>
            <div class="col-md-6">
                    <label class="control-label col-md-8">Are you legally eligible to work in Canada? </label>  
                    <div class="col-md-4 radio-list">
                        <label class="radio-inline">
                        <?php 
                        if(isset($_GET['form_id']))
                        {
                            if(isset($application_for_employment_gfs) && $application_for_employment_gfs->legal=='1')
                            {
                                ?>
                                &#10004;
                                <?php
                            }
                            else 
                            {
                                ?>
                                &#10006;
                                <?php
                            } 
                        }
                        else
                        {
                            ?>                                      
                            <input type="radio" class="form-control" name="legal" value="1" <?php if(isset($application_for_employment_gfs) && $application_for_employment_gfs->legal=='1')echo "checked='checked'";?>/>
                            <?php
                        }
                         ?>              
                        Yes
                        </label>
                        <label class="radio-inline">
                        <?php 
                        if(isset($_GET['form_id']))
                        {
                            if(isset($application_for_employment_gfs) && $application_for_employment_gfs->legal=='0')
                            {
                                ?>
                                &#10004;
                                <?php
                            }
                            else 
                            {
                                ?>
                                &#10006;
                                <?php
                            } 
                        }
                        else
                        {
                            ?>                                      
                            <input type="radio" class="form-control" name="legal" value="0" <?php if(isset($application_for_employment_gfs) && $application_for_employment_gfs->legal=='0')echo "checked='checked'";?>/>
                            <?php
                        }
                         ?>
                         No
                        </label>
                    </div>
            </div>
        <div class="clearfix"></div>
        
        <p>&nbsp;</p>
        <hr />
        <div class="col-md-12">
            <h3>Education</h3>
        </div>
        <!--div class="col-md-12">
        <div class="table-scrollable">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>School</th>
                        <th>No. of Years Attended</th>
                        <th>City, State</th>
                        <th>Course</th>
                        <th>Did you Graduate?</th>
                    </tr>
                </thead>
                
                <tbody>
                    <tr>
                        <th>Grammar</th>
                        <td><input class="form-control" name="g_years"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->g_years;?>" /></td>
                        <td><input class="form-control" name="g_city"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->g_city;?>" /></td>
                        <td><input class="form-control" name="g_course"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->g_course;?>" /></td>
                        <td><input class="form-control" name="g_grad"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->g_grad;?>" /></td>
                    </tr>
                    <tr>
                        <th>High</th>
                        <td><input class="form-control" name="h_years"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->h_years;?>" /></td>
                        <td><input class="form-control" name="h_city"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->h_city;?>" /></td>
                        <td><input class="form-control" name="h_course"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->h_course;?>" /></td>
                        <td><input class="form-control" name="h_grad"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->h_grad;?>" /></td>
                    </tr>
                    <tr>
                        <th>College</th>
                        <td><input class="form-control" name="c_years"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->c_years;?>" /></td>
                        <td><input class="form-control" name="c_city"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->c_city;?>" /></td>
                        <td><input class="form-control" name="c_course"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->c_course;?>" /></td>
                        <td><input class="form-control" name="c_grad"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->c_grad;?>" /></td>
                    </tr>
                    <tr>
                        <th>Other</th>
                        <td><input class="form-control" name="o_years"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->o_years;?>" /></td>
                        <td><input class="form-control" name="o_city"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->o_city;?>" /></td>
                        <td><input class="form-control" name="o_course"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->o_course;?>" /></td>
                        <td><input class="form-control" name="o_grad"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->o_grad;?>" /></td>
                    </tr>
                </tbody>
            </table>
        </div>
        </div>
        
            <p>&nbsp;</p-->
            <div class="col-md-12">
                    <label class="control-label col-md-10">Do you have any skills, qualifications or experiences which you feel would specially fit you for working with us? </label>  
                    <div class="col-md-2">
                        <textarea class="form-control" name="skills"><?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->skills;?></textarea> 
                    </div>
            </div>
            <p>&nbsp;</p>
            <div class="col-md-12">
                    <div class="col-md-12">
                        <label class="control-label col-md-2">Job(s) Applied for: </label> 
                    </div> 
                    <div class="col-md-12">
                        <label class="control-label col-md-1">1. </label>
                        <div class="col-md-3">
                            <input class="form-control" name="applied" value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->applied;?>" /> 
                        </div>
                        <label class="control-label col-md-3">Rate of pay expected $ </label>
                        <div class="col-md-2">
                            <input class="form-control" name="rate" value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->rate;?>" /> 
                        </div>
                        <label class="control-label col-md-1">per </label>
                        <div class="col-md-2">
                            <input class="form-control" name="per" value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->per;?>" /> 
                        </div>
                    </div>
                    <p>&nbsp;</p>
                    <div class="col-md-12">
                        <label class="control-label col-md-1">2. </label>
                        <div class="col-md-3">
                            <input class="form-control" name="applied1" value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->applied1;?>" /> 
                        </div>
                        <label class="control-label col-md-3">Rate of pay expected $ </label>
                        <div class="col-md-2">
                            <input class="form-control" name="rate1" value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->rate1;?>" /> 
                        </div>
                        <label class="control-label col-md-1">per </label>
                        <div class="col-md-2">
                            <input class="form-control" name="per1" value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->per1;?>" /> 
                        </div>
                    </div>
            </div>
            <p>&nbsp;</p>
            <div class="col-md-12">
                    <label class="control-label col-md-5">Do you want to work: </label>  
                    <div class="col-md-7 radio-list">
                        <label class="radio-inline">
                        <?php 
                        if(isset($_GET['form_id']))
                        {
                            if(isset($application_for_employment_gfs) && $application_for_employment_gfs->legal1=='1')
                            {
                                ?>
                                &#10004;
                                <?php
                            }
                            else 
                            {
                                ?>
                                &#10006;
                                <?php
                            } 
                        }
                        else
                        {
                            ?>                                      
                            <input type="radio" class="form-control" name="legal1" id="partTime" value="1" <?php if(isset($application_for_employment_gfs) && $application_for_employment_gfs->legal1=='1')echo "checked='checked'";?>/>
                            <?php
                        }
                         ?>               
                         Part Time
                        </label>
                        <label class="radio-inline">
                        <?php 
                        if(isset($_GET['form_id']))
                        {
                            if(isset($application_for_employment_gfs) && $application_for_employment_gfs->legal1=='0')
                            {
                                ?>
                                &#10004;
                                <?php
                            }
                            else 
                            {
                                ?>
                                &#10006;
                                <?php
                            } 
                        }
                        else
                        {
                            ?>                                      
                            <input type="radio" class="form-control" name="legal1" id="fullTime" value="0" <?php if(isset($application_for_employment_gfs) && $application_for_employment_gfs->legal1=='0')echo "checked='checked'";?>/>
                            <?php
                        }
                         ?>                        
                         Full Time ?
                        </label>
                    </div>
            </div>
            <div id="partTimeDiv" style="display: none;">
            <p>&nbsp;</p>
            <div class="col-md-12">
                <label class="control-label col-md-5">If applying only for part-time, which days and hours?</label> 
                <div class="col-md-7">              
                    <textarea class="form-control" name="part"><?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->part;?></textarea>
                </div>
            </div>
            </div>
            <p>&nbsp;</p>
            <div class="col-md-12">
                    <label class="control-label col-md-5">Are you able to do the job(s) for which you are applying? </label>  
                    <div class="col-md-7 radio-list">
                        <label class="radio-inline">
                        <?php 
                        if(isset($_GET['form_id']))
                        {
                            if(isset($application_for_employment_gfs) && $application_for_employment_gfs->legal2=='1')
                            {
                                ?>
                                &#10004;
                                <?php
                            }
                            else 
                            {
                                ?>
                                &#10006;
                                <?php
                            } 
                        }
                        else
                        {
                            ?>                                      
                            <input type="radio" class="form-control" name="legal2" id="ableToWork" value="1" <?php if(isset($application_for_employment_gfs) && $application_for_employment_gfs->legal2=='1')echo "checked='checked'";?>/> 
                            <?php
                        }
                         ?>               
                         Yes
                        </label>
                        <label class="radio-inline">
                        <?php 
                        if(isset($_GET['form_id']))
                        {
                            if(isset($application_for_employment_gfs) && $application_for_employment_gfs->legal2=='2')
                            {
                                ?>
                                &#10004;
                                <?php
                            }
                            else 
                            {
                                ?>
                                &#10006;
                                <?php
                            } 
                        }
                        else
                        {
                            ?>                                      
                            <input type="radio" class="form-control" name="legal2" id="notAbleToWork" value="2" <?php if(isset($application_for_employment_gfs) && $application_for_employment_gfs->legal2=='0')echo "checked='checked'";?>/>
                            <?php
                        }
                         ?>              
                        No
                        </label>
                    </div> 
            </div>
            <div id="notAbleDiv" style="display: none;">
            <p>&nbsp;</p>
            <div class="col-md-12">
                <label class="control-label col-md-5">If no, please explain: </label> 
                <div class="col-md-7">              
                    <textarea class="form-control" name="no_explain"><?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->no_explain;?></textarea>
                </div>
            </div>
             </div> 
             
             <p>&nbsp;</p>
            <!--div class="col-md-12">
                <label class="control-label col-md-5">If hired, when can you start?</label> 
                <div class="col-md-7">              
                    <input class="form-control" name="start"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->start;?>" />
                </div>
            </div> 
            <div class="clearfix"></div>
            <hr />
            <div class="col-md-12">
              <h3>Driving Record</h3>
              </div>
              <div class="col-md-12">
              <p>Collision record for the past three (3) years (attach sheet if more space is needed).</p>
              </div>
              <div class="col-md-12">
              <div class="table-scrollable">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Dates</th>
                        <th>Nature of Collision<br />(Head-On, Rear-End, Backing, etc.)</th>
                        <th>Injuries / Fatalities</th>
                        <th>Vehicle Type <br />(Commercial or Personal)</th>
                    </tr>
                </thead>
                
                <tbody>
                    <tr>
                        <th>Last Collision</th>
                        <td><input class="form-control" name="l_date"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->l_date;?>" /></td>
                        <td><input class="form-control" name="l_nature"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->l_nature;?>" /></td>
                        <td><input class="form-control" name="l_type"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->l_type;?>" /></td>
                    </tr>
                    <tr>
                        <th>Next Previous</th>
                         <td><input class="form-control" name="p_date"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->p_date;?>" /></td>
                        <td><input class="form-control" name="p_nature"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->p_nature;?>" /></td>
                        <td><input class="form-control" name="p_type"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->p_type;?>" /></td>
                    </tr>
                    <tr>
                        <th>Next Previous</th>
                         <td><input class="form-control" name="n_date"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->n_date;?>" /></td>
                        <td><input class="form-control" name="n_nature"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->n_nature;?>" /></td>
                        <td><input class="form-control" name="n_type"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->n_type;?>" /></td>
                    </tr>
                </tbody>
            </table>
        </div> 
        </div-->
        
        <div class="clearfix"></div>
            <hr />
    <div class="col-md-12">
        <h3>Driving Experience and Qualifications</h3>
    </div>
              <!--div class="col-md-6">
              <div class="col-md-12">
                <h3>Driver Licenses</h3>
              </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Class</th>
                        <th>Expires</th>
                    </tr>
                </thead>
                
                <tbody>
                    <tr>
                        <td><input class="form-control" name="class1"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->class1;?>" /></td>
                        <td><input class="form-control" name="expires1"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->expires1;?>" /></td>
                    </tr>
                    <tr>
                        <td><input class="form-control" name="class2"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->class2;?>" /></td>
                        <td><input class="form-control" name="expires2"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->expires2;?>" /></td>
                    </tr>
                    <tr>
                        <td><input class="form-control" name="class3"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->class3;?>" /></td>
                        <td><input class="form-control" name="expires3"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->expires3;?>" /></td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <div class="col-md-6">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Class of Equipment</th>
                        <th>Approx. No. of Miles (Total)</th>
                    </tr>
                </thead>
                
                <tbody>
                    <tr>
                        <th>Straight Truck</th>
                        <td><input class="form-control" name="starigt_miles"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->starigt_miles;?>" /></td>
                    </tr>
                    <tr>
                        <th>Tractor and Semi-Trailer</th>
                        <td><input class="form-control" name="semi_miles"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->semi_miles;?>" /></td>
                    </tr>
                    <tr>
                        <th>Tractor and Two-Trailer</th>
                        <td><input class="form-control" name="two_miles"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->two_miles;?>" /></td>
                    </tr>
                    <tr>
                        <th>Other</th>
                        <td><input class="form-control" name="other_miles"value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->other_miles;?>" /></td>
                    </tr>
                </tbody>
            </table>
        </div-->
                
        
        <div class="col-md-12">
            <label class="col-md-6">Show special courses or training that will help you as as driver</label>
            <div class="col-md-6"><textarea class="form-control" name="special_course"><?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->special_course;?></textarea></div>
            <p>&nbsp;</p>
        </div>
        <div class="col-md-12">
            <label class="col-md-6">Which safe driving awaards do you hold and from whom?</label>
            <div class="col-md-6"><textarea class="form-control" name="which_safe_driving"><?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->which_safe_driving;?></textarea></div>
            <p>&nbsp;</p>
        </div>
        <div class="col-md-12">
            <label class="col-md-6">Show any trucking, transportation or other experiences that may help in your work for this company:</label>
            <div class="col-md-6"><textarea class="form-control" name="show_any_trucking"><?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->show_any_trucking;?></textarea></div>
            <p>&nbsp;</p>
        </div>
        <div class="col-md-12">
            <label class="col-md-6">List courses and training other than shown elsewhere in this application</label>
            <div class="col-md-6"><textarea class="form-control" name="list_courses_training"><?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->list_courses_training;?></textarea></div>
            <p>&nbsp;</p>
        </div>
        <div class="col-md-12">
            <label class="col-md-6">List special equipment or technical materials you can work with (other than those already shown)</label>
            <div class="col-md-6"><textarea class="form-control" name="list_special_equipment"><?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->list_special_equipment;?></textarea></div>
            <p>&nbsp;</p>
        </div>
        
        <hr>
        <div class="col-md-12">
             <h3>EMPLOYMENT HISTORY</h3>
             <!--p>Please list your most recent employment first. Add another sheet if necessary. History must be the last three year’s. Commercial drivers shall provide

                an additional seven year’s information on employers for whom the applicant operated a commercial vehicle.
            </p>
            <p>&nbsp;</p>
            <table class="table table-bordered">
                <tr>
                    <td colspan="3">
                        <label class="col-md-12">Name & Address Of Employer:</label>
                        <div class="col-md-12"><textarea name="name_and_address_employer1" class="form-control form-control"><?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->name_and_address_employer1;?></textarea></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="col-md-12">Dates of Employment</label>
                        <div class="col-md-6"><input type="text" class="date-picker form-control" name="date_of_employment_from1" placeholder="From" value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->date_of_employment_from1;?>" /></div>
                        <div class="col-md-6"><input type="text" class="date-picker form-control" name="date_of_employment_to1" placeholder="To" value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->date_of_employment_to1;?>" /></div></div>
                    </td>
                    <td colspan="2">
                        <label class="col-md-12">Type of work done</label>
                        <div class="col-md-12"><textarea name="type_of_work_done1" class="form-control"><?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->type_of_work_done1;?></textarea></div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <label class="col-md-12">Supervisor's Name & Phone No.:</label>
                        <div class="col-md-12"><textarea name="supervisor_name_phone1" class="form-control form-control"><?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->supervisor_name_phone1;?></textarea></div>
                    </td>
                    <td>
                       <label class="col-md-12">Final Salary</label> 
                       <div class="col-md-12"><input type="text" class="form-control" name="final_salary1" value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->final_salary1;?>" /></div>
                    </td>               
                </tr>
                <tr>
                    <td colspan="3">
                        <label class="col-md-12">Reasons of leaving:</label>
                        <div class="col-md-12"><textarea name="reasons_of_leaving1" class="form-control form-control"><?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->reasons_of_leaving1;?></textarea></div>
                    </td>
                </tr>
            </table>
            
            <p>&nbsp;</p>
            <table class="table table-bordered">
                <tr>
                    <td colspan="3">
                        <label class="col-md-12">Name & Address Of Employer:</label>
                        <div class="col-md-12"><textarea name="name_and_address_employer2" class="form-control form-control"><?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->name_and_address_employer2;?></textarea></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="col-md-12">Dates of Employment</label>
                        <div class="col-md-6"><input type="text" class="date-picker form-control" name="date_of_employment_from2" placeholder="From" value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->date_of_employment_from2;?>" /></div>
                        <div class="col-md-6"><input type="text" class="date-picker form-control" name="date_of_employment_to2" placeholder="To" value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->date_of_employment_to2;?>" /></div></div>
                    </td>
                    <td colspan="2">
                        <label class="col-md-12">Type of work done</label>
                        <div class="col-md-12"><textarea name="type_of_work_done2" class="form-control"><?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->type_of_work_done2;?></textarea></div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <label class="col-md-12">Supervisor's Name & Phone No.:</label>
                        <div class="col-md-12"><textarea name="supervisor_name_phone2" class="form-control form-control"><?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->supervisor_name_phone2;?></textarea></div>
                    </td>
                    <td>
                       <label class="col-md-12">Final Salary</label> 
                       <div class="col-md-12"><input type="text" class="form-control" name="final_salary2" value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->final_salary2;?>" /></div>
                    </td>               
                </tr>
                <tr>
                    <td colspan="3">
                        <label class="col-md-12">Reasons of leaving:</label>
                        <div class="col-md-12"><textarea name="reasons_of_leaving2" class="form-control form-control"><?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->reasons_of_leaving2;?></textarea></div>
                    </td>
                </tr>
            </table>
            
            <p>&nbsp;</p>
            <table class="table table-bordered">
                <tr>
                    <td colspan="3">
                        <label class="col-md-12">Name & Address Of Employer:</label>
                        <div class="col-md-12"><textarea name="name_and_address_employer3" class="form-control form-control"><?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->name_and_address_employer3;?></textarea></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="col-md-12">Dates of Employment</label>
                        <div class="col-md-6"><input type="text" class="date-picker form-control" name="date_of_employment_from3" placeholder="From" value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->date_of_employment_from3;?>" /></div>
                        <div class="col-md-6"><input type="text" class="date-picker form-control" name="date_of_employment_to3" placeholder="To" value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->date_of_employment_to3;?>" /></div></div>
                    </td>
                    <td colspan="2">
                        <label class="col-md-12">Type of work done</label>
                        <div class="col-md-12"><textarea name="type_of_work_done3" class="form-control"><?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->type_of_work_done3;?></textarea></div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <label class="col-md-12">Supervisor's Name & Phone No.:</label>
                        <div class="col-md-12"><textarea name="supervisor_name_phone3" class="form-control form-control"><?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->supervisor_name_phone3;?></textarea></div>
                    </td>
                    <td>
                       <label class="col-md-12">Final Salary</label> 
                       <div class="col-md-12"><input type="text" class="form-control" name="final_salary3" value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->final_salary3;?>" /></div>
                    </td>               
                </tr>
                <tr>
                    <td colspan="3">
                        <label class="col-md-12">Reasons of leaving:</label>
                        <div class="col-md-12"><textarea name="reasons_of_leaving3" class="form-control form-control"><?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->reasons_of_leaving3;?></textarea></div>
                    </td>
                </tr>
            </table-->
        </div>
        <div class="col-md-12">
            <label class="col-md-6">Would you be willing to take a physical exam?</label>
            <div class="col-md-6 radio-list">
            <label class="radio-inline">
            <?php 
                        if(isset($_GET['form_id']))
                        {
                            if(isset($application_for_employment_gfs) && $application_for_employment_gfs->physical_exam=='1')
                            {
                                ?>
                                &#10004;
                                <?php
                            }
                            else 
                            {
                                ?>
                                &#10006;
                                <?php
                            } 
                        }
                        else
                        {
                            ?>                                      
                            <input type="radio" name="physical_exam" value="1" <?php if(isset($application_for_employment_gfs)&& $application_for_employment_gfs->physical_exam=='1')echo "checked='checked'";?> /> 
                            <?php
                        }
                         ?>
             Yes &nbsp; &nbsp;
             </label>
             <label class="radio-inline">
             <?php 
                        if(isset($_GET['form_id']))
                        {
                            if(isset($application_for_employment_gfs) && $application_for_employment_gfs->physical_exam=='0')
                            {
                                ?>
                                &#10004;
                                <?php
                            }
                            else 
                            {
                                ?>
                                &#10006;
                                <?php
                            } 
                        }
                        else
                        {
                            ?>                                      
                            <input type="radio" name="physical_exam" value="0" <?php if(isset($application_for_employment_gfs)&& $application_for_employment_gfs->physical_exam=='0')echo "checked='checked'";?> /> 
                            <?php
                        }
                         ?>
              No
              </label>
              </div>
        </div>
        
        <div class="col-md-12">
            <label class="col-md-6">What are your aspirations, now and in the future?</label>
            <div class="col-md-12"><textarea class="form-control" name="aspirations"><?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->aspirations;?></textarea></div>
        </div>
        <div class="col-md-12">
            <label class="col-md-6">Why do you think you are the best qualified candidate?</label>
            <div class="col-md-12"><textarea class="form-control" name="best_qualified"><?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->best_qualified;?></textarea></div>
        </div>
        <div class="col-md-12">
            <label class="col-md-6">Would you be willing to relocate?</label>
            <div class="col-md-6 radio-list">
                <label class="radio-inline">
                <?php 
                        if(isset($_GET['form_id']))
                        {
                            if(isset($application_for_employment_gfs) && $application_for_employment_gfs->willing_relocate=='1')
                            {
                                ?>
                                &#10004;
                                <?php
                            }
                            else 
                            {
                                ?>
                                &#10006;
                                <?php
                            } 
                        }
                        else
                        {
                            ?>                                      
                            <input type="radio" name="willing_relocate" value="1" <?php if(isset($application_for_employment_gfs)&& $application_for_employment_gfs->willing_relocate=='1')echo "checked='checked'";?>/> 
                            <?php
                        }
                         ?>
                    
                    Yes &nbsp; &nbsp; 
                 </label>
                 <label class="radio-inline">
                 <?php 
                        if(isset($_GET['form_id']))
                        {
                            if(isset($application_for_employment_gfs) && $application_for_employment_gfs->willing_relocate=='0')
                            {
                                ?>
                                &#10004;
                                <?php
                            }
                            else 
                            {
                                ?>
                                &#10006;
                                <?php
                            } 
                        }
                        else
                        {
                            ?>                                      
                            <input type="radio" name="willing_relocate" value="0" <?php if(isset($application_for_employment_gfs)&& $application_for_employment_gfs->willing_relocate=='0')echo "checked='checked'";?>/> 
                            <?php
                        }
                         ?>
                     No
                 </label>
             </div>
        </div>
        <div class="col-md-12">
            <label class="col-md-6">Which of your former positions did you like best and why?</label>
            <div class="col-md-12"><textarea class="form-control" name="best_former_positions"><?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->best_former_posotions;?></textarea></div>
        </div>
        <p>&nbsp;</p>
        <div class="col-md-12">
             <h3>OTHER INFORMATION</h3>
             <p>
             You may attach a separate sheet of paper to list any other information necessary to answer fully the above, or add any additional information about

                yourself that you wish to be considered.
             </p>
             <textarea name="other_information" class="form-control" placeholder="OTHER INFORMATION"><?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->other_information;?></textarea>
        </div>
        <p>&nbsp;</p>
        <div class="col-md-12">
             <h3>BUSINESS REFERENCES</h3>
             <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Address and Telephone No.</th>
                        <th>Occupation</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input name="business_communication_name1" class="form-control" value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->business_communication_name1;?>" /></td>                    
                        <td><input name="business_communication_address1" class="form-control" value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->business_communication_address1;?>" /></td>
                        <td><input name="business_communication_occupation1" class="form-control" value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->business_communication_occupation1;?>" /></td>
                    </tr>
                    <tr>
                        <td><input name="business_communication_name2" class="form-control" value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->business_communication_name2;?>" /></td>                    
                        <td><input name="business_communication_address2" class="form-control" value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->business_communication_address2;?>" /></td>
                        <td><input name="business_communication_occupation2" class="form-control" value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->business_communication_occupation2;?>" /></td>
                    </tr>
                </tbody>
             </table>
        </div>
        
        <p>&nbsp;</p>
        <div class="col-md-12">
            <h3>APPLICANT’S CERTIFICATION AND AGREEMENT</h3>   
            <strong>PLEASE READ EACH SECTION CAREFULLY AND CHECK THE BOX:</strong> 
            <p>&nbsp;</p>  
            <p><input type="checkbox" name="checkbox1" value="1" <?php if(isset($application_for_employment_gfs) && $application_for_employment_gfs->checkbox1=='1')echo "checked='checked'";?>/> &nbsp; 1. AUTHORIZATION FOR EMPLOYMENT/EDUCATIONAL INFORMATION. I authorize the references listed in this
    
                Application for Employment, and any prior employer, educational institution, or any other persons or organizations to give Gordon Food Service
                
                any and all information concerning my previous employment/educational accomplishments, disciplinary information or any other pertinent informa-
                tion they may have, personal or otherwise, and release all parties from all liability for any damage that may result from furnishing same to you. I
                
                hereby waive written notice that employment information is being provided by any person or organization.
            </p> 
            <p><input type="checkbox" name="checkbox2" value="1" <?php if(isset($application_for_employment_gfs) && $application_for_employment_gfs->checkbox2=='1')echo "checked='checked'";?>/> &nbsp; 2. TERMINATION OF EMPLOYMENT. If I am hired, in consideration of my employment, I agree to abide by the rules and policies of

                Gordon Food Service, including any changes made from time to time, and agree that my employment and compensation can be terminated with or
                
                without cause, at any time with the provision of the appropriate statutory notice or pay in lieu of notice.
            </p>  
            <p>
                <input type="checkbox" name="checkbox3" value="1" <?php if(isset($application_for_employment_gfs) && $application_for_employment_gfs->checkbox3=='1')echo "checked='checked'";?>/> &nbsp; 3. RELEASE OF MEDICAL INFORMATION. I authorize every medical doctor, physician or other healthcare provider to provide any

                and all information, including but not limited to, all medical reports, laboratory reports, X-rays or clinical abstracts relating to my previous health
                
                history or employment in connection with any examination, consultation, tests or evaluation. I hereby release every medical doctor, healthcare per-
                sonnel and every other person, firm, officer, corporation, association, organization or institution which shall comply with the authorization or
                
                request made in this respect from any and all liability. I understand
                
                until a job offer has been made
            </p>
            <p>
                <input type="checkbox" name="checkbox4" value="1" <?php if(isset($application_for_employment_gfs) && $application_for_employment_gfs->checkbox4=='1')echo "checked='checked'";?>/> &nbsp; 4. PHYSICAL EXAM AND DRUG AND ALCOHOL TESTING. I agree to take a physical exam and authorize Gordon Food Service

or its designated agent(s) to withdraw specimen(s) of my blood, urine or hair for chemical analysis. One purpose of this analysis is to determine or

exclude the presence of alcohol, drugs or other substances. I authorize the release of the test results to Gordon Food Service. I understand that deci-
sions concerning my employment will be made as a result of these tests.
            </p>
            <p>
                <input type="checkbox" name="checkbox5" value="1" <?php if(isset($application_for_employment_gfs) && $application_for_employment_gfs->checkbox5=='1')echo "checked='checked'";?>/> &nbsp; 5. CONSIDERATION FOR EMPLOYMENT. I understand that my application will be considered pursuant

normal procedures for a period of thirty (30) days. If I am still interested in employment thereafter, I must reapply.
            </p>
            <p>
                <input type="checkbox" name="checkbox6" value="1" <?php if(isset($application_for_employment_gfs) && $application_for_employment_gfs->checkbox6=='1')echo "checked='checked'";?>/> &nbsp; 6. DRIVING RECORDS CHECK. If applying for a position that requires driving a company vehicle, I authorize Gordon Food Service,

Inc. and its agents the authority to make investigations and inquiries of my driving record following a conditional offer of employment.
            </p>
            <p>
                <input type="checkbox" name="checkbox7" value="1" <?php if(isset($application_for_employment_gfs) && $application_for_employment_gfs->checkbox7=='1')echo "checked='checked'";?>/> &nbsp; 7. CERTIFICATION OF TRUTHFULNESS. I certify that all statements on this Application for Employment are completed by me and

to the best of my knowledge are true, complete, without evasion, and further understand and agree that such statements may be investigated and if

found to be false will be sufficient reason for not being employed, or if employed may result in my dismissal. I have read and understood items one

through 7 inclusive, and acknowledge that with my signature below.
            </p>
        </div>
        <div class="clearfix"></div>
        <p>&nbsp;</p>
        
        <div class="col-md-6">
            <label class="col-md-6">Dated</label>
            <input type="text" name="dated" class="form-control date-picker" value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->dated;?>" />
        </div>
        <div class="col-md-6">
            <label class="col-md-12">Signature</label>
            <input type="text" class="form-control" name="gfs_signature" value="<?php if(isset($application_for_employment_gfs))echo $application_for_employment_gfs->gfs_signature;?>" />
            
        </div>
         <div class="clearfix"></div>
          <p>&nbsp;</p>
          <div class="col-md-12 subz">
            <a href="javascript:void(0);" class="btn green-haze pull-right" onclick="return check_username();">
                Submit <i class="m-icon-swapright m-icon-white"></i>
            </a>
        </div>
       
        <input type="submit" id="hiddensub" style="display: none;"/>
</form>
<div class="clearfix"></div>

</div>
<script>
        function check_username() {
            
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
      $(function(){
        <?php if(isset($_GET['form_id'])){?>
            $('.login-form input').attr('disabled','disabled');
            $('.login-form textarea').attr('readonly','readonly');
            $('.subz').hide();
            
        <?php }?>
    })
    </script>
</body>
</html>