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
                  <!-- pencarian -->
                    <input type="search" class="search-field" placeholder="Search"  name="keycari" title="Search for:">
                    <label for="search"></label>
                    <i class="ion-android-close"></i>
                  </div>
                </form>
          

          <div class="activities">
           <?php foreach ($data as $univ) : ?>
            <div class="activity animated fadeinright delay-1">
              <p><?=$univ['universitas']?></p>
             
              <span class="activity-time text-small text-light"><i class="ion-android-done"></i> <span class=""> <?=$univ['prodi']?>  | <?=$univ['passinggrade']?>%</span></span>
              <span class="activity-type">
             
            
                
                 <a href="<?=base_url()?>index.php/siswa/update_siswa/<?=$univ['prodi']?>/<?=$univ['universitas']?>">
                    <i class="ion-android-radio-button-on"></i>
                  </a>
                
                
              </span>
            </div>
             <?php endforeach ?> 
          </div>
        
        </div>
        
      </div> 







          <!-- Pencarian -->
                            <!-- <aside class="widget-search">
                                <form method="get" class="search-form" action="<?=base_url()?>index.php/passinggrade/cariTopik"  accept-charset="utf-8" enctype="multipart/form-data">
                                    <label>
                                        <span class="screen-reader-text">Search for:</span>
                                        <input type="search" class="search-field" placeholder="Search"  name="keycari" title="Search for:">
                                    </label>
                                    <input type="submit" class="search-submit" value="GO">
                                </form>
                            </aside> -->
                       <!-- /Pencarian -->
       <!--                  <div id="timeline">
                        <?php foreach ($data as $key) {?>
                        <p><?=$key['prodi'] ?></p>
                        <?php } ?>
                  
            </div>
          
                              <a href="#" class="btn">button</a> </div>
                          </div>
                        </div>
                                           
                </div>  
            </div>  --> 
