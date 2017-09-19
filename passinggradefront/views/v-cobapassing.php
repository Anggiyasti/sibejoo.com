


<!DOCTYPE HTML>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0 minimal-ui" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black">

<title>Epsilon 7.0</title>
    
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/minibar/dark/styles/style.css')?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/minibar/dark/styles/skin.css')?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/minibar/dark/styles/framework.css')?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/minibar/dark/styles/ionicons.min.css')?>">
<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>


<script type="text/javascript" src="<?php echo base_url('assets/minibar/dark/scripts/jquery.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/minibar/dark/scripts/plugins.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/minibar/dark/scripts/custom.js')?>"></script>

</head>

<body>
<div class="page-preloader page-preloader-dark">
    <div class="spinner"></div>
</div>

<div class="header header-dark">
    <a href="index.html" class="header-logo"><span class="color-red-dark">WORKOUT</span></a>
    <a href="#" class="header-icon header-icon-1 close-sidebar-mask"></a>
    <a href="#" class="header-icon header-icon-1 open-sidebar" disabled>
        <em class="line-1"></em>
        <em class="line-2"></em>
        <em class="line-3"></em>    
    </a>
</div>

<!-- Main Small Icon Sidebar -->
<div class="sidebar-menu sidebar-dark">
    <div class="sidebar-menu-scroll">
        <a class="current-menu" href="<?= base_url('index.php/Login/cek_login_siswa') ?>""><i class="ion-ios-star-outline"></i><em>Welcome</em></a>       
        <a data-submenus="sub1" href="#"><i class="ion-ios-home-outline"></i><em>User</em></a>       
        <a data-submenus="sub2" href="#"><i class="ion-ios-gear-outline"></i><em>Workout</em></a>      
    </div>
</div>
<!-- Home Submenus -->
<div class="submenu submenu-dark" id="sub1">
    <div class="submenu-scroll">
        <a class="close-sidebar" href="#"><i class="ion-ios-close-empty"></i><em>User Setting</em></a>        
        <a href="index.html"><i class="ion-ios-star-outline"></i><em>Logout</em></a>         
    </div>
</div>
<!-- Features Submenus -->
<div class="submenu submenu-dark" id="sub2">
    <div class="submenu-scroll">
        <a class="close-sidebar" href="#"><i class="ion-ios-close-empty"></i><em>Workout</em></a> 
        <a href="<?= base_url('index.php/workout1/pilihreport') ?>"><i class="ion-ios-star-outline"></i><em>Report</em></a>         
    </div>
</div>   
<div id="page-content" class="header-clear">
    <div id="page-content-scroll"><!--Enables this element to be scrolled --> 

         <div class="heading-strip bg-3">
         <?php if ($data == array()): ?>
                    <h4>Tidak ada Passing Grade.</h4>
        <?php else: ?>
         <?php foreach ($data as $p): ?>
            <em>Universitas : <?= $p['universitas'] ?></em><br>
            <em>Program Studi : <?= $p['prodi'] ?></em><br>
            <em>Passing Grade : <?= $p['passinggrade'] ?>%</em><br>
            <br>
            <?php 
            endforeach ?>
             <?php endif ?>
            
        </div>

        


    </div>
</div>
</body>