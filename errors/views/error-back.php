<!DOCTYPE html>
<html class="backend">
  <!-- START Head -->
  <head>
    <!-- START META SECTION -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Forbidden Access</title>
    <meta name="author" content="pampersdry.info">
    <meta name="description" content="Adminre is a clean and flat backend and frontend theme build with twitter bootstrap 3.1.1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?= base_url('assets/image/touch/apple-touch-icon-144x144-precomposed.png') ?>">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?= base_url('assets/image/touch/apple-touch-icon-114x114-precomposed.png') ?>">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?= base_url('assets/image/touch/apple-touch-icon-72x72-precomposed.png') ?>">
    <link rel="apple-touch-icon-precomposed" href="<?= base_url('assets/image/touch/apple-touch-icon-57x57-precomposed.png') ?>">
    <link rel="shortcut icon" href="<?= base_url('assets/image/favicon.ico') ?>">
    <script type="text/javascript" src="<?= base_url('assets/library/jquery/js/jquery.min.js') ?>"></script>
    <link rel="stylesheet" href="<?= base_url('assets/plugins/datatables/css/jquery.datatables.min.css'); ?>">
    <script src="<?= base_url('assets/sal/sweetalert-dev.js');?>"></script>
    <link rel="stylesheet" href="<?= base_url('assets/sal/sweetalert.css');?>">
    <link rel="stylesheet" href="<?= base_url('assets/plugins/steps/css/jquery-steps.min.css');?>">
    <script>var base_url = '<?php echo base_url() ?>'</script>
    <!--/ END META SECTION -->
    <!-- START STYLESHEETS -->
    <!-- Plugins stylesheet : optional -->
    <!--/ Plugins stylesheet -->
    <!-- css aoutocomplate -->
    <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js" ></script>
    <link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet">
    </link>
    <!-- <link href='<?php echo base_url();?>assets/css/jquery.autocomplete.css' rel='stylesheet' />
      JS aoutocomplate
      <script type='text/javascript' src='<?php echo base_url();?>assets/js/jquery.autocomplete.js'></script> -->
    <!-- Application stylesheet : mandatory -->
    <link rel="stylesheet" href="<?= base_url('assets/library/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/stylesheet/layout.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/stylesheet/uielement.min.css') ?>">
    <!--/ Application stylesheet -->
    <!-- END STYLESHEETS -->
    <!-- START JAVASCRIPT SECTION - Load only modernizr script here -->
    <script src="<?= base_url('assets//library/modernizr/js/modernizr.min.js') ?>"></script>
    <!--/ END JAVASCRIPT SECTION -->
  </head>
  <!--/ END Head -->
 <body>
    <section id="main" role="main">
    <!-- START Template Container -->
    <section class="container animation delay animating fadeInDown">
        <!-- START row -->
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3">
                <div class="panel panel-minimal" style="margin-top:10%;">
                    <!-- Upper Text -->
                    <div class="panel-body text-center">
                        <i class="ico-shield4 longshadow fsize112 text-default"></i>
                    </div>
                    <div class="panel-body text-center">
                        <h1 class="semibold longshadow text-center text-default fsize32 mb10 mt0">HOLD UP!!</h1>
                        <h4 class="semibold text-primary text-center nm">You dont have permission to access this...</h4>
                    </div>
                    <!--/ Upper Text -->

                    <!-- Button -->
                    <div class="panel-body text-center">
                        <a href="<?=base_url('admin')?>" class="btn btn-default mb5">Back To Dashboard</a>
                        <span class="semibold text-default hidden-xs">&nbsp;&nbsp;OR&nbsp;&nbsp;</span>
                        <a href="javascript:void(0);" class="btn btn-success mb5">Report This Problem</a>
                    </div>
                    <!--/ Button -->
                </div>
            </div>
        </div>
        <!--/ END row -->
    </section>
    <!--/ END Template Container -->
</section>
<!--/ END Template Main -->
<!-- START JAVASCRIPT SECTION (Load javascripts at bottom to reduce load time) -->
<!-- Library script : mandatory -->
<script type="text/javascript" src="<?= base_url('assets/library/jquery/js/jquery-migrate.min.j') ?>s"></script>
<script type="text/javascript" src="<?= base_url('assets/library/bootstrap/js/bootstrap.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/library/core/js/core.min.js') ?>"></script>
<!--/ Library script -->
<!-- App and page level script -->
<script type="text/javascript" src="<?= base_url('assets/plugins/sparkline/js/jquery.sparkline.min.js') ?>"></script><!-- will be use globaly asummary on sidebar menu --> 
<script type="text/javascript" src="<?= base_url('assets/javascript/app.min.js') ?>"></script>
<!--/ App and page level script -->
<!--/ END JAVASCRIPT SECTION -->
</body>
<!--/ END Body -->
</html>