    <!-- Search bar -->
          
              <div class="nav-wrapper">
                
              </div>



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
          <div class="parallax bg-9"> <div>  <?php foreach ($dataa as $d ) :?>
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
          <form method="get" class="search-form" action="<?=base_url()?>index.php/passinggrade/cari2"  accept-charset="utf-8" enctype="multipart/form-data">
                  <div class="input-field">
                    <input type="search" class="search-field" placeholder="Search"  name="keycari" title="Search for:">
                    <label for="search"></label>
                    <i class="ion-android-close"></i>
                  </div>
                </form>
