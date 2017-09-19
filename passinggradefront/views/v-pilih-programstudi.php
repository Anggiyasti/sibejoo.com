<!-- Page Content -->
      <div id="content" class="page">

        <!-- Toolbar -->
        <div id="toolbar" class="primary-color">
          <div class="open-left" id="open-left" data-activates="slide-out-left">
            <i class="ion-android-menu"></i>
          </div>
          <span class="title">Passing Grade</span>
          <div class="open-right" id="open-right" data-activates="slide-out">
            <i class="ion-android-person"></i>
          </div>
        </div>
        

<div class="animated fadeinup delay-1">
          <div class="page-content">
            
            
            <?php foreach ($data as $row): ?>
            <blockquote class="primary-border">
            <a href="<?=base_url()?>index.php/passinggrade/prodi/<?=$row['prodi']?>"><?=$row['prodi'];?></a>
            </blockquote>
            
            <?php endforeach ?> 
            <!-- Slider -->         
            <!-- End of Slider -->

          </div>

         
          
        </div> 

<!-- Page Content -->
      
 
