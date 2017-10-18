
      <div id="content">

        <!-- Toolbar -->
        <div id="toolbar" class="halo-nav box-shad-none">
          <div class="open-left" id="open-left" data-activates="slide-out-left">
            <i class="ion-android-menu"></i>
          </div>
          <span class="title none">News</span>
          <div class="open-right" id="open-right" data-activates="slide-out">
            <i class="ion-android-person"></i>
          </div>
        </div>
        
        <!-- Hero Header -->
         
              
        <div class="h-banner animated fadeindown">
       
            
          <div class="parallax bg-2">
            <div class="floating-button animated bouncein delay-3">
            <span class="btn-floating resize btn-large waves-effect waves-light accent-color btn z-depth-1">
              <i class="ion-android-bookmark"></i>
            </span>
          </div>
            <div class="banner-title">News</div>
          </div>
         </div>
        <?php foreach ($datnews as $d ) :?>
        <!-- Article Content -->
        <div class="animated fadeinup delay-1">
          <div class="page-content">
            <h2 class="uppercase"><?=$d['judul_artikel'] ?></h2>
            <div class="post-author">
             
            </div>
            <p class="text-flow"><?=$d['isi_artikel'] ?></p>
           
            
          

          </div>

        </div>
         <?php endforeach ?>

        <span class="size">
          <center>
            <ul class="pagination" class="size">
            <?php 
            echo $this->pagination->create_links();
            ?>
            </ul>
          </center>
        </span>

        