<!DOCTYPE html>
<html lang="en">
<head>

    <!-- start: Meta -->
    <meta charset="utf-8"/>
    <title>博文酒家</title>
    <meta name="description" content="SimpliQ - Flat & Responsive Bootstrap Admin Template."/>
    <meta name="author" content="Łukasz Holeczek"/>
    <meta name="keyword" content="SimpliQ, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina"/>
    <!-- end: Meta -->

    <!-- start: Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <!-- end: Mobile Specific -->

    <!-- start: CSS -->
    <link href="<?php echo base_url('public/admin/css/bootstrap.min.css'); ?>" rel="stylesheet"/>
    <link href="<?php echo base_url('public/admin/css/bootstrap-responsive.min.css'); ?>" rel="stylesheet"/>
    <link href="<?php echo base_url('public/admin/css/style.min.css'); ?>" rel="stylesheet"/>
    <link href="<?php echo base_url('public/admin/css/style-responsive.min.css'); ?>" rel="stylesheet"/>
    <link href="<?php echo base_url('public/admin/css/retina.css'); ?>" rel="stylesheet"/>
    <!-- end: CSS -->


    <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <link id="ie-style" href="css/ie.css" rel="stylesheet">
    <![endif]-->

    <!--[if IE 9]>
    <link id="ie9style" href="css/ie9.css" rel="stylesheet">
    <![endif]-->

    <!-- start: Favicon and Touch Icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
          href="./public/admin/ico/apple-touch-icon-144-precomposed.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
          href="./public/admin/ico/apple-touch-icon-114-precomposed.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="72x72"
          href="./public/admin/ico/apple-touch-icon-72-precomposed.png"/>
    <link rel="apple-touch-icon-precomposed" href="./public/admin/ico/apple-touch-icon-57-precomposed.png"/>
    <link rel="shortcut icon" href="./public/admin/ico/favicon.png"/>
    <!-- end: Favicon and Touch Icons -->

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>

<body>

<div class="container-fluid-full">
    <div class="row-fluid">

        <div class="row-fluid">
            <div class="login-box">
                <h2>Login to your account</h2>
                <form class="form-horizontal" method="post" onsubmit="return false;">
                    <fieldset>

                        <input class="input-large span12" name="username" id="username" type="text"
                               placeholder="type username"/>

                        <input class="input-large span12" name="password" id="password" type="password"
                               placeholder="type password"/>

                        <div class="clearfix"></div>

                        <label class="remember" for="remember"><input type="checkbox" id="remember"/>Remember me</label>

                        <div class="clearfix"></div>

                        <button type="submit" class="btn btn-primary span12" onclick="requestLogin()">Login</button>
                    </fieldset>

                </form>
                <hr/>
                <h3>Forgot Password?</h3>
                <p>
                    No problem, <a href="#">click here</a> to get a new password.
                </p>
            </div>
        </div><!--/row-->

    </div><!--/fluid-row-->

</div><!--/.fluid-container-->

<!-- start: JavaScript-->
<script src="<?php echo base_url('public/admin/js/jquery-1.10.2.min.js'); ?>"></script>
<script src="<?php echo base_url('public/admin/js/jquery-migrate-1.2.1.min.js'); ?>"></script>
<script src="<?php echo base_url('public/admin/js/jquery-ui-1.10.3.custom.min.js'); ?>"></script>
<script src="<?php echo base_url('public/admin/js/jquery.ui.touch-punch.js'); ?>"></script>
<script src="<?php echo base_url('public/admin/js/modernizr.js'); ?>"></script>
<script src="<?php echo base_url('public/admin/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('public/admin/js/jquery.cookie.js'); ?>"></script>
<script src="<?php echo base_url('public/admin/js/fullcalendar.min.js'); ?>"></script>
<script src="<?php echo base_url('public/admin/js/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('public/admin/js/excanvas.js'); ?>"></script>
<script src="<?php echo base_url('public/admin/js/jquery.flot.js'); ?>"></script>
<script src="<?php echo base_url('public/admin/js/jquery.flot.pie.js'); ?>"></script>
<script src="<?php echo base_url('public/admin/js/jquery.flot.stack.js'); ?>"></script>
<script src="<?php echo base_url('public/admin/js/jquery.flot.resize.min.js'); ?>"></script>
<script src="<?php echo base_url('public/admin/js/jquery.flot.time.js'); ?>"></script>
<script src="<?php echo base_url('public/admin/js/jquery.chosen.min.js'); ?>"></script>
<script src="<?php echo base_url('public/admin/js/jquery.uniform.min.js'); ?>"></script>
<script src="<?php echo base_url('public/admin/js/jquery.cleditor.min.js'); ?>"></script>
<script src="<?php echo base_url('public/admin/js/jquery.noty.js'); ?>"></script>
<script src="<?php echo base_url('public/admin/js/jquery.elfinder.min.js'); ?>"></script>
<script src="<?php echo base_url('public/admin/js/jquery.raty.min.js'); ?>"></script>
<script src="<?php echo base_url('public/admin/js/jquery.iphone.toggle.js'); ?>"></script>
<script src="<?php echo base_url('public/admin/js/jquery.uploadify-3.1.min.js'); ?>"></script>
<script src="<?php echo base_url('public/admin/js/jquery.gritter.min.js'); ?>"></script>
<script src="<?php echo base_url('public/admin/js/jquery.imagesloaded.js'); ?>"></script>
<script src="<?php echo base_url('public/admin/js/jquery.masonry.min.js'); ?>"></script>
<script src="<?php echo base_url('public/admin/js/jquery.knob.modified.js'); ?>"></script>
<script src="<?php echo base_url('public/admin/js/jquery.sparkline.min.js'); ?>"></script>
<script src="<?php echo base_url('public/admin/js/counter.min.js'); ?>"></script>
<script src="<?php echo base_url('public/admin/js/raphael.2.1.0.min.js'); ?>"></script>
<script src="<?php echo base_url('public/admin/js/justgage.1.0.1.min.js'); ?>"></script>
<script src="<?php echo base_url('public/admin/js/jquery.autosize.min.js'); ?>"></script>
<script src="<?php echo base_url('public/admin/js/retina.js'); ?>"></script>
<script src="<?php echo base_url('public/admin/js/jquery.placeholder.min.js'); ?>"></script>
<script src="<?php echo base_url('public/admin/js/wizard.min.js'); ?>"></script>
<script src="<?php echo base_url('public/admin/js/core.min.js'); ?>"></script>
<script src="<?php echo base_url('public/admin/js/charts.min.js'); ?>"></script>
<script src="<?php echo base_url('public/admin/js/custom.min.js'); ?>"></script>
<!-- end: JavaScript-->

<script type="text/javascript">
    function requestLogin() {
        var username = $("#username");
        var password = $("#password");

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Login/doLogin')?>",
            data: {
                'username': username.val(),
                'password': password.val()
            },
            async: false,
            dataType: "JSON"
        }).done(function (data) {
            if (0 === data['errorCode']) {

            }
        }).always(function (data) {
            if (data['message'] && (data['message'].length > 0)) {
                alert(data['message']);
            }
        })
    }
</script>
</body>
</html>

