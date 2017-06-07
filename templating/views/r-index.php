<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>

  <!-- Meta Tags -->
  <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
  <meta name="description" content="StudyPress | Education & Courses HTML Template" />
  <meta name="keywords" content="academy, course, education, education html theme, elearning, learning," />
  <meta name="author" content="ThemeMascot" />

  <!-- Page Title -->
  <title>{judul_halaman}</title>

  <!-- Favicon and Touch Icons -->
  <link href="<?=base_url('assets/retemplate/images/favicon.png')?>" rel="shortcut icon" type="image/png">
  <link href="<?=base_url('assets/retemplate/images/apple-touch-icon.png')?>" rel="apple-touch-icon">
  <link href="<?=base_url('assets/retemplate/images/apple-touch-icon-72x72.png')?>" rel="apple-touch-icon" sizes="72x72">
  <link href="<?=base_url('assets/retemplate/images/apple-touch-icon-114x114.png')?>" rel="apple-touch-icon" sizes="114x114">
  <link href="<?=base_url('assets/retemplate/images/apple-touch-icon-144x144.png')?>" rel="apple-touch-icon" sizes="144x144">
  <script src="<?= base_url('assets/sal/sweetalert-dev.js');?>"></script>
  <link rel="stylesheet" href="<?= base_url('assets/sal/sweetalert.css');?>">


  <!-- Stylesheet -->
  <link href="<?=base_url('assets/retemplate/css/bootstrap.min.css')?>" rel="stylesheet" type="text/css">
  <link href="<?=base_url('assets/retemplate/css/jquery-ui.min.css')?>" rel="stylesheet" type="text/css">
  <link href="<?=base_url('assets/retemplate/css/animate.css')?>" rel="stylesheet" type="text/css">
  <link href="<?=base_url('assets/retemplate/css/css-plugin-collections.css')?>" rel="stylesheet"/>
  <!-- CSS | menuzord megamenu skins -->
  <link id="menuzord-menu-skins" href="<?=base_url('assets/retemplate/css/menuzord-skins/menuzord-rounded-boxed.css')?>" rel="stylesheet"/>
  <!-- CSS | Main style file -->
  <link href="<?=base_url('assets/retemplate/css/style-main.css')?>" rel="stylesheet" type="text/css">
  <!-- CSS | Preloader Styles -->
  <link href="<?=base_url('assets/retemplate/css/preloader.css')?>" rel="stylesheet" type="text/css">
  <!-- CSS | Custom Margin Padding Collection -->
  <link href="<?=base_url('assets/retemplate/css/custom-bootstrap-margin-padding.css')?>" rel="stylesheet" type="text/css">
  <!-- CSS | Responsive media queries -->
  <link href="<?=base_url('assets/retemplate/css/responsive.css')?>" rel="stylesheet" type="text/css">
  <!-- CSS | Style css. This is the file where you can place your own custom css code. Just uncomment it and use it. -->
  <!-- <link href="<?=base_url('assets/retemplate/css/style.css')?>" rel="stylesheet" type="text/css"> -->
  <script src="<?= base_url('assets/back/js/jquery.min.js') ?>"></script> 

  <!-- Revolution Slider 5.x CSS settings -->
  <link  href="<?=base_url('assets/retemplate/js/revolution-slider/css/settings.css')?>" rel="stylesheet" type="text/css"/>
  <link  href="<?=base_url('assets/retemplate/js/revolution-slider/css/layers.css')?>" rel="stylesheet" type="text/css"/>
  <link  href="<?=base_url('assets/retemplate/js/revolution-slider/css/navigation.css')?>" rel="stylesheet" type="text/css"/>

  <!-- CSS | Theme Color -->
  <link href="<?=base_url('assets/retemplate/css/colors/theme-skin-color-set-1.css')?>" rel="stylesheet" type="text/css">

  <!-- external javascripts -->
  <script src="<?=base_url('assets/retemplate/js/jquery-2.2.4.min.js')?>"></script>
  <script src="<?=base_url('assets/retemplate/js/jquery-ui.min.js')?>"></script>
  <script src="<?=base_url('assets/retemplate/js/bootstrap.min.js')?>"></script>
  
  <!-- JS | jquery plugin collection for this theme -->
  <script src="<?=base_url('assets/retemplate/js/jquery-plugin-collection.js')?>"></script>

  <!-- Revolution Slider 5.x SCRIPTS -->
  <script src="<?=base_url('assets/retemplate/js/revolution-slider/js/jquery.themepunch.tools.min.js')?>"></script>
  <script src="<?=base_url('assets/retemplate/js/revolution-slider/js/jquery.themepunch.revolution.min.js')?>"></script>

  <!-- Datatables -->
  <link href="<?=base_url('assets/plugins/datatables/css/jquery.datatables.min.css')?>" rel="stylesheet" type="text/css">


  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="dark">
  <div id="wrapper" class="clearfix">
    <script type="text/javascript">var base_url = "<?= base_url() ?>"</script>
    <?php
    
    foreach ($files as $key) {
      include ($key);
    }
    ?>
  </div>
  <!-- end wrapper -->

  <!-- Footer Scripts -->
  <!-- JS | Custom script for all pages -->
  <script src="<?=base_url('assets/retemplate/js/custom.js')?>"></script>

      <!-- SLIDER REVOLUTION 5.0 EXTENSIONS  
      (Load Extensions only on Local File Systems ! 
      The following part can be removed on Server for On Demand Loading) -->
      <script type="text/javascript" src="<?=base_url('assets/retemplate/js/revolution-slider/js/extensions/revolution.extension.actions.min.js')?>"></script>
      <script type="text/javascript" src="<?=base_url('assets/retemplate/js/revolution-slider/js/extensions/revolution.extension.carousel.min.js')?>"></script>
      <script type="text/javascript" src="<?=base_url('assets/retemplate/js/revolution-slider/js/extensions/revolution.extension.kenburn.min.js')?>"></script>
      <script type="text/javascript" src="<?=base_url('assets/retemplate/js/revolution-slider/js/extensions/revolution.extension.layeranimation.min.js')?>"></script>
      <script type="text/javascript" src="<?=base_url('assets/retemplate/js/revolution-slider/js/extensions/revolution.extension.migration.min.js')?>"></script>
      <script type="text/javascript" src="<?=base_url('assets/retemplate/js/revolution-slider/js/extensions/revolution.extension.navigation.min.js')?>"></script>
      <script type="text/javascript" src="<?=base_url('assets/retemplate/js/revolution-slider/js/extensions/revolution.extension.parallax.min.js')?>"></script>
      <script type="text/javascript" src="<?=base_url('assets/retemplate/js/revolution-slider/js/extensions/revolution.extension.slideanims.min.js')?>"></script>
      <script type="text/javascript" src="<?=base_url('assets/retemplate/js/revolution-slider/js/extensions/revolution.extension.video.min.js')?>"></script>

      <script type="text/javascript" src="<?= base_url('assets/plugins/datatables/js/jquery.datatables.min.js') ?>"></script>
      <script type="text/javascript" src="<?= base_url('assets/plugins/datatables/tabletools/js/tabletools.min.js') ?>"></script>
      <script type="text/javascript" src="<?= base_url('assets/plugins/datatables/js/jquery.datatables-custom.min.js') ?>"></script>
      <script type="text/javascript" src="<?= base_url('assets/javascript/tables/datatable.js') ?>"></script>

    </body>
    </html>