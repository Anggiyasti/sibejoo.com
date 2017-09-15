<!-- Page Content -->
      <div id="content" class="grey-blue">

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
         <div style="width: 100%; height: 30%; background-color: #19305B; "><p style="color: #ffffff; font-size: 25px; padding-left: 3%;" >Universitas</p></div>
          
          <form action="<?= base_url() ?>index.php/passinggrade/wilayah/" method="post" >
          <select class="browser-default" name="wilayah">
              <option value="" disabled selected>Pilih Wilayah</option>
              <option value="1">Wilayah 1</option>
              <option value="2">Wilayah 2</option>
              <option value="3">Wilayah 3</option>
              <option value="4">WIlayah 4</option>
            </select>
            <br>
            <input type="submit" name="cari" value="Tampilkan" class="btn-large primary-color width-100" >
            </form>
            <h4 class="p-20" align="center">Wilayah <?=$w?></h4>
            <div style="text-align: center;"><?php echo $this->session->flashdata('msg'); ?> </div>
        <?php foreach ($data as $univ) : ?>
       <!-- Profile Content -->
        <div class="animated fadeinup delay-1">
          
          <div class="card m-t-40 animated fadeinup delay-2">
            <div class="c-widget">
              <div class="c-widget-figure primary-color">
                <i class="ion-android-mail"></i>
              </div>
              <div class="c-widget-body">
                <p class="m-0"><a href="<?=base_url()?>index.php/passinggrade/set_prodi_univ/<?=$univ['universitas']?>"><?=$univ['universitas']?></a></p>
                
              </div>
            </div>
          </div>
          </div>

          <?php endforeach ?>
      
         
      </div> <!-- End of Page Content -->