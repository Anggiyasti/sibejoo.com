<!-- TITLE -->
<section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="http://placehold.it/1920x1280" style="background-image: url(&quot;http://placehold.it/1920x1280&quot;); background-position: 50% 99px;">
  <div class="container pt-70 pb-20">
    <!-- Section Content -->
    <div class="section-content">
      <div class="row">
        <div class="col-md-12">
          <h1 class="text-center text-white">{judul_header}</h1>
        </div>
      </div>
    </div>
  </div>      
</section>
<!-- TITLE -->

<style type="text/css">
.col-md-2{
  margin: 20px;
  padding: 0;
}
</style>





<section>
  <div class="container">
    <div class="row">

      <div class="col-sm-12">
        <div class="sidebar sidebar-left mt-sm-30 ml-40">
          <div class="widget">
            <h4 class="widget-title line-bottom">Sekolah Dasar</h4>
            <div class="services-list">
              <?php foreach ($pelajaran_sd as $pelajaran_items): ?>
                <a href="<?=base_url('video/daftarallvideo/') ?><?=$pelajaran_items->id ?>" class="btn btn-colored btn-gray hvr-buzz-out"><i class="fa fa-file-text-o" aria-hidden="true" style="margin-right: 2px; font-size: 16px;"></i>
                  <span class="mr-5"><?= $pelajaran_items->namaMataPelajaran ?></span></a> 
                <?php endforeach ?>
                <?php if ($pelajaran_sd == array()): ?>
                  <h6 style="color:orange;">Belum Tersedia Video Pembelajaran !</h6>
                <?php endif ?>
              </div>
            </div>
            <div class="separator left">
              <i class="fa fa-pencil"></i>
            </div>

          </div>

          <div class="sidebar sidebar-left mt-sm-30 ml-40">
            <div class="widget">
              <h4 class="widget-title line-bottom">Sekolah Menengah Pertama</h4>
              <div class="services-list">
                <?php foreach ($pelajaran_smp as $pelajaran_items): ?>
                 <a href="<?=base_url('video/daftarallvideo/') ?><?=$pelajaran_items->id ?>" class="btn btn-colored btn-gray hvr-buzz-out"><i class="fa fa-file-text-o" aria-hidden="true" style="margin-right: 2px; font-size: 16px;"></i>
                  <span class="mr-5"><?= $pelajaran_items->namaMataPelajaran ?></span></a> 

                <?php endforeach ?>
                <?php if ($pelajaran_smp == array()): ?>
                  <h6 style="color:orange;">Belum Tersedia Video Pembelajaran !</h6>
                <?php endif ?>
              </div>
            </div>
            <div class="separator left">
              <i class="fa fa-pencil"></i>
            </div>

          </div>

          <div class="sidebar sidebar-left mt-sm-30 ml-40">
            <div class="widget">
              <h4 class="widget-title line-bottom">Sekolah Menengah Atas</h4>
              <div class="services-list">
                <?php foreach ($pelajaran_sma as $pelajaran_items): ?>
                  <a href="<?=base_url('video/daftarallvideo/') ?><?=$pelajaran_items->id ?>" class="btn btn-colored btn-gray hvr-buzz-out"><i class="fa fa-file-text-o" aria-hidden="true" style="margin-right: 2px; font-size: 16px;"></i>
                    <span class="mr-5"><?= $pelajaran_items->namaMataPelajaran ?></span></a> 

                  <?php endforeach ?>
                  <?php if ($pelajaran_sma == array()): ?>
                    <h6 style="color:orange;">Belum Tersedia Video Pembelajaran !</h6>
                  <?php endif ?>
                </div>
              </div>
              <div class="separator left">
                <i class="fa fa-pencil"></i>
              </div>

            </div>

            <div class="sidebar sidebar-left mt-sm-30 ml-40">
              <div class="widget">
                <h4 class="widget-title line-bottom">Sekolah Menengah Atas -  IPA</h4>
                <div class="services-list">
                  <?php foreach ($pelajaran_sma_ipa as $pelajaran_items): ?>
                    <a href="<?=base_url('video/daftarallvideo/') ?><?=$pelajaran_items->id ?>" class="btn btn-colored btn-gray hvr-buzz-out"><i class="fa fa-file-text-o" aria-hidden="true" style="margin-right: 2px; font-size: 16px;"></i>
                      <span class="mr-5"><?= $pelajaran_items->namaMataPelajaran ?></span></a> 

                    <?php endforeach ?>
                    <?php if ($pelajaran_sma_ipa == array()): ?>
                      <h6 style="color:orange;">Belum Tersedia Video Pembelajaran !</h6>
                    <?php endif ?>
                  </div>
                </div>
                <div class="separator left">
                  <i class="fa fa-pencil"></i>
                </div>


              </div>

              <div class="sidebar sidebar-left mt-sm-30 ml-40">
                <div class="widget">
                  <h4 class="widget-title line-bottom">Sekolah Menengah Atas -  IPS</h4>
                  <div class="services-list">
                    <?php foreach ($pelajaran_sma_ips as $pelajaran_items): ?>
                      <a href="<?=base_url('video/daftarallvideo/') ?><?=$pelajaran_items->id ?>" class="btn btn-colored btn-gray hvr-buzz-out"><i class="fa fa-file-text-o" aria-hidden="true" style="margin-right: 2px; font-size: 16px;"></i>
                        <span class="mr-5"><?= $pelajaran_items->namaMataPelajaran ?></span></a> 
                      <?php endforeach ?>
                      <?php if ($pelajaran_sma_ips == array()): ?>
                        <h6 style="color:orange;">Belum Tersedia Video Pembelajaran !</h6>
                      <?php endif ?>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </section>
        <hr class="divider-color">