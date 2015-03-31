
<!DOCTYPE html>

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
    <link href="<?php echo $this->request->webroot;?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo $this->request->webroot;?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo $this->request->webroot;?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo $this->request->webroot;?>assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="<?php echo $this->request->webroot;?>assets/global/plugins/select2/select2.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo $this->request->webroot;?>assets/admin/pages/css/login3.css" rel="stylesheet" type="text/css"/>
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN THEME STYLES -->
    <link href="<?php echo $this->request->webroot;?>assets/global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
    <link href="<?php echo $this->request->webroot;?>assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo $this->request->webroot;?>assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo $this->request->webroot;?>assets/admin/layout/css/themes/darkblue.css" rel="stylesheet" type="text/css" id="style_color"/>
    <link href="<?php echo $this->request->webroot;?>assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME STYLES -->
    <link rel="shortcut icon" href="favicon.ico"/>
    <!-- END COPYRIGHT -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="<?php echo $this->request->webroot;?>assets/global/plugins/respond.min.js"></script>
<script src="<?php echo $this->request->webroot;?>assets/global/plugins/excanvas.min.js"></script>
<![endif]-->
<script src="<?php echo $this->request->webroot;?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo $this->request->webroot;?>assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<script src="<?php echo $this->request->webroot;?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo $this->request->webroot;?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo $this->request->webroot;?>assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="<?php echo $this->request->webroot;?>assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo $this->request->webroot;?>assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo $this->request->webroot;?>assets/global/plugins/select2/select2.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo $this->request->webroot;?>assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?php echo $this->request->webroot;?>assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="<?php echo $this->request->webroot;?>assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="<?php echo $this->request->webroot;?>assets/admin/pages/scripts/login.js" type="text/javascript"></script>
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
<!-- BEGIN LOGIN -->


<div class="logo"></div>

<div class="content">
       <center><?php $logo = $this->requestAction('Logos/getlogo/2');?>
            	<img src="<?php echo $this->request->webroot.'img/logos/'.$logo;?>"  style="max-width: 100%; "  /></center>
        <!--<img src="http://isbmee.com/wp-content/uploads/2014/10/MEELogo1.png" alt="" style="max-width: 100%;"/>-->












<!-- BEGIN LOGIN FORM -->


        <form class="login-form" action="<?php echo $this->request->webroot;?>login/index<?php if(isset($_GET['url'])){?>?url=<?php echo $_GET['url']; }?>" method="post">
        <h3 class="form-title">Log in to your account</h3>
    
    <?= $this->Flash->render() ?>
    <div class="form-group">
        <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
        <label class="control-label visible-ie8 visible-ie9">Username</label>
        <div class="input-icon">
            <i class="fa fa-user"></i>
            <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="name" required="required" />
        </div>
    </div>
    <div class="form-group">
        <label class="control-label visible-ie8 visible-ie9">Password</label>
        <div class="input-icon">
            <i class="fa fa-lock"></i>
            <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" required="required"/>
        </div>
    </div>
    <div class="form-actions">
        <label class="checkbox">
            <input type="checkbox" name="remember" value="1"/> Remember me </label>
        <button type="submit" class="btn green-haze pull-right">
            Login <i class="m-icon-swapright m-icon-white"></i>
        </button>

        <div class="forget-password">
            <p>
                Forgot your password? Click <a href="javascript:;" id="forget-password">
                    here </a>
                to reset.
            </p>
        </div>
    </div>


    <!--div class="create-account">


        <p><strong>Welcome to MEE</strong></p>
        <p>MEE is designed to help the transportation industry in qualifying drivers and getting them on the road efficiently, safely and cost effectively by providing all the required documents and services through a single website.</p>
        <p>With MEE's easy to use platform, you can quickly and efficiently obtain all the required documents necessary to ensure the quality of your workforce. Please contact us for any further information.</p>


        <p>
            Interested in this product?&nbsp; <a href="javascript:;" id="register-btn">
                Create an account </a>
        </p>
    </div-->
</form>


<!-- END LOGIN FORM -->
<!-- BEGIN FORGOT PASSWORD FORM -->
<form class="forget-form" action="" method="post">
    <h3>Forget Password?</h3>
    <p>
        Enter your e-mail address below to reset your password.
    </p>
    <div class="form-group">
        <div class="input-icon">
            <i class="fa fa-envelope"></i>
            <input class="form-control placeholder-no-fix" type="text" id="forgetEmail" autocomplete="off" placeholder="Email" name="email"/>
        </div>
    </div>
    <div class="form-group forget_error" style="display: none;">
        
    </div>
    <div class="form-actions">
        <button type="button" id="back-btn" class="btn">
            <i class="m-icon-swapleft"></i> Back </button>
        <button type="button" class="btn green-haze pull-right forgetpass">
            Submit <i class="m-icon-swapright m-icon-white"></i>
        </button>
    </div>
</form>

<script>
$(function(){
    $('.forgetpass').click(function(){
        
        var email = $('#forgetEmail').val();
        $.ajax({
            url : "<?php echo $this->request->webroot;?>profiles/forgetpassword",
            type :"post",
            data :"email="+email,
            success: function(msg)
            {
                 $('.forget_error').text(msg);
                 $('.forget_error').show();
                 $('.forget_error').fadeOut(5000);
            }
        })
        
        
        
    })
})
</script>
<!-- END FORGOT PASSWORD FORM -->
<!-- BEGIN REGISTRATION FORM -->

<form class="register-form" action="index.html" method="post">
<h3>Sign Up</h3>
    <p>By registering with MEE, you will have access to our online store where you may place your orders and begin qualifying candidates with a few simple clicks. We will just need a few bits of information. You will receive a confirmation email once we have activated your account. Thank you for choosing MEE.</p>

<div class="form-group">
    <label class="control-label visible-ie8 visible-ie9">Name of your Company</label>
    <div class="input-icon">
        <i class="fa fa-font"></i>
        <input class="form-control placeholder-no-fix" type="text" placeholder="Name of your Company" name="companyname"  required="required" />
    </div>
</div>
<div class="form-group">
    <label class="control-label visible-ie8 visible-ie9">Signatory's First Name</label>
    <div class="input-icon">
        <i class="fa fa-font"></i>
        <input class="form-control placeholder-no-fix" type="text" placeholder="Signatory's First Name" name="s_firstname"  required="required"/>
    </div>
</div>
<div class="form-group">
    <label class="control-label visible-ie8 visible-ie9">Signatory's Last Name</label>
    <div class="input-icon">
        <i class="fa fa-font"></i>
        <input class="form-control placeholder-no-fix" type="text" placeholder="Signatory's Last Name" name="s_lastname" required="required"/>
    </div>
</div>
<div class="form-group">
    <label class="control-label visible-ie8 visible-ie9">Signatory's Phone Number</label>
    <div class="input-icon">
        <i class="fa fa-check"></i>
        <input class="form-control placeholder-no-fix" type="text" placeholder="Signatory's Phone Number" name="s_phone" required="required"/>
    </div>
</div>
<div class="form-group">
    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
    <label class="control-label visible-ie8 visible-ie9">Signatory's Email Address</label>
    <div class="input-icon">
        <i class="fa fa-envelope"></i>
        <input class="form-control placeholder-no-fix" type="email" placeholder="Signatory's Email Address" name="s_email" required="required"/>
    </div>
</div>

<div class="form-group">
    <label class="control-label visible-ie8 visible-ie9">Billing Address Street Name and Number</label>
    <div class="input-icon">
        <i class="fa fa-map-marker"></i>
        <input class="form-control placeholder-no-fix" type="text" placeholder="Billing Address Street Name & No." name="billingadd" required="required"/>
    </div>
</div>

<div class="form-group">
    <label class="control-label visible-ie8 visible-ie9">City</label>
    <div class="input-icon">
        <i class="fa fa-location-arrow"></i>
        <input class="form-control placeholder-no-fix" type="text" placeholder="City" name="city" required="required"/>
    </div>
</div>

<div class="form-group">
    <label class="control-label visible-ie8 visible-ie9">Postal Code</label>
    <div class="input-icon">
        <i class="fa fa-location-arrow"></i>
        <input class="form-control placeholder-no-fix" type="text" placeholder="Postal Code" name="postalcode" required="required"/>
    </div>
</div>

<div class="form-group">
    <label class="control-label visible-ie8 visible-ie9">Country</label>
    <div class="input-icon">
        <i class="fa fa-map-marker"></i>
        <input class="form-control placeholder-no-fix" type="text" placeholder="Country" name="country" required="required"/>
    </div>
</div>

<div class="form-group">
    <label class="control-label visible-ie8 visible-ie9">Province/State</label>
    <div class="input-icon">
        <i class="fa fa-map-marker"></i>
        <input class="form-control placeholder-no-fix" type="text" placeholder="Province/State" name="province" required="required"/>
    </div>
</div>

<div class="form-group">
    <label class="control-label visible-ie8 visible-ie9">Signatory's First Name</label>
    <div class="input-icon">
        <i class="fa fa-font"></i>
        <input class="form-control placeholder-no-fix" type="text" placeholder="User's First Name" name="u_firstname" required="required"/>
    </div>
</div>
<div class="form-group">
    <label class="control-label visible-ie8 visible-ie9">Signatory's Last Name</label>
    <div class="input-icon">
        <i class="fa fa-font"></i>
        <input class="form-control placeholder-no-fix" type="text" placeholder="User's Last Name" name="u_lastname" required="required"/>
    </div>
</div>
<div class="form-group">
    <label class="control-label visible-ie8 visible-ie9">Signatory's Phone Number</label>
    <div class="input-icon">
        <i class="fa fa-check"></i>
        <input class="form-control placeholder-no-fix" type="text" placeholder="User's Phone Number" name="u_phone" required="required"/>
    </div>
</div>
<div class="form-group">
    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
    <label class="control-label visible-ie8 visible-ie9">User's Email Address</label>
    <div class="input-icon">
        <i class="fa fa-envelope"></i>
        <input class="form-control placeholder-no-fix" type="email" placeholder="User's Email Address" name="u_email" required="required"/>
    </div>
</div>
<!--
<div class="form-group">
    <label>
        <input type="checkbox" name="tnc"/> I agree to the <a href="#">
            Terms of Service </a>
        and <a href="#">
            Privacy Policy </a>
    </label>
    <div id="register_tnc_error">
    </div>
</div> --!>
<div class="form-actions">
    <button id="register-back-btn" type="button" class="btn">
        <i class="m-icon-swapleft"></i> Back </button>
    <button type="submit" id="register-submit-btn" class="btn green-haze pull-right">
        Sign Up <i class="m-icon-swapright m-icon-white"></i>
    </button>
</div>
</form>
<!-- END REGISTRATION FORM -->
</div>
<!-- END LOGIN -->
<!-- BEGIN COPYRIGHT -->
<div class="copyright">
    &copy; 2015 All Rights Reserved
</div>

</body>
<!-- END BODY -->
</html>