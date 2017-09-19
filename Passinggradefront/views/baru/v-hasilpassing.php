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

         <!-- Hero Header -->
        <div class="h-banner animated fadeindown">
          <div class="parallax bg-9"> 
          <div>  <?php foreach ($dataa as $d ) :?>
              <!-- menampilkan gambar -->
              <img src="<?= base_url('./assets/app/halo/img/'. $d['gambar']) ?>">
             <?php endforeach ?></div>
            <div class="floating-button animated bouncein delay-3">
            <span class="btn-floating resize btn-large waves-effect waves-light twitter btn z-depth-1">
              <i class="ion-social-twitter"></i>
            </span>
          </div>
            <div class="banner-title"></div>
          </div>
         </div>
        
        <!-- Article Content -->
        
        <div class="animated fadeinup delay-1">
        
          <!-- Daily Activity-->
          <div class="activities">
          <!-- pengecekan bila passing grade tidak ada -->
           <?php if ($data == array()): ?>
            <h4>Tidak ada Passing Grade.</h4>
            <?php else: ?>
              <!-- menampilkan data -->
            <?php foreach ($data as $p): ?>
           
            <div class="activity animated fadeinright delay-1">
            
              <p><?= $p['universitas'] ?></p>
             
              <span class="activity-time text-small text-light"><i class="ion-ios-arrow-forward"></i><span>Program Studi : </span>  <span class=""> <?= $p['prodi'] ?></span></span><br>
              <span class="activity-time text-small text-light"><i class="ion-ios-arrow-forward"></i><span>Passing Grade : </span> <span class=""> <?= $p['passinggrade'] ?>%</span></span>
              <span class="activity-type">
             
            
                
                 
                    <i class="ion-android-radio-button-on"></i>
                
                
              </span>
               
            </div>
            <?php 
            endforeach ?>
             <?php endif ?>
            
          </div>
        
        </div>
        
      </div> 



