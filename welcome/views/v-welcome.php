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

<div class="page-content grid-row">

    <main>

        <div class="grid-col-row clear-fix" style="list-style: none;" >
            <div class="grid-col col-md-2">
                <div class="hover-effect"></div>
                <h5><strong>Sekolah Dasar<hr></strong></h5>
                
                <?php foreach ($pelajaran_sd as $pelajaran_items): ?>
                    <li ><a href="<?=base_url('video/daftarallvideo/') ?><?=$pelajaran_items->id ?>"  class="text-info""><?= $pelajaran_items->namaMataPelajaran ?></a></li>
                <?php endforeach ?>
                <?php if ($pelajaran_sd == array()): ?>
                    <h6 style="color:orange;">Belum Tersedia Video Pembelajaran !</h6>
                <?php endif ?>

            </div>


            <div class="grid-col col-md-2">
                <div class="hover-effect"></div>
                <h5><strong>SMP<hr></strong></h5>

                <?php foreach ($pelajaran_smp as $pelajaran_items): ?>
                    <li ><a href="<?=base_url('video/daftarallvideo/') ?><?=$pelajaran_items->id ?>"  class="text-info"><?= $pelajaran_items->namaMataPelajaran ?></a></li>
                <?php endforeach ?>
                <?php if ($pelajaran_smp == array()): ?>
                    <h6 style="color:orange;">Belum Tersedia Video Pembelajaran !</h6>
                <?php endif ?>

            </div>

            <div class="grid-col col-md-2">
                <div class="hover-effect"></div>
                <h5><strong>SMA<hr></strong></h5>

                <?php foreach ($pelajaran_sma as $pelajaran_items): ?>
                 <li ><a href="<?=base_url('video/daftarallvideo/') ?><?=$pelajaran_items->id ?>"  class="text-info"><?= $pelajaran_items->namaMataPelajaran ?></a></li>
             <?php endforeach ?>

             <?php if ($pelajaran_sma == array()): ?>
                <h6 style="color:orange;">Belum Tersedia Video Pembelajaran !</h6>
            <?php endif ?>

        </div>

        <div class="grid-col col-md-2">
            <div class="hover-effect"></div>
            <h5><strong>SMA IPA<hr></strong></h5>

            <?php foreach ($pelajaran_sma_ipa as $pelajaran_items): ?>
             <li> <a href="<?=base_url('video/daftarallvideo/') ?><?=$pelajaran_items->id ?>"  class="text-info"><?= $pelajaran_items->namaMataPelajaran ?></a></li>
         <?php endforeach ?>
         <?php if ($pelajaran_sma_ipa == array()): ?>
            <h6 style="color:orange;">Belum Tersedia Video Pembelajaran !</h6>
        <?php endif ?>
    </div>


    <div class="grid-col col-md-2">
        <div class="hover-effect"></div>
        <h5><strong>SMA IPS<hr></strong></h5>
        <?php foreach ($pelajaran_sma_ips as $pelajaran_items): ?>
         <li> <a href="<?=base_url('video/daftarallvideo/') ?><?=$pelajaran_items->id ?>"  class="text-info"><?= $pelajaran_items->namaMataPelajaran ?></a></li>
     <?php endforeach ?>
     <?php if ($pelajaran_sma_ips == array()): ?>
        <h6 style="color:orange;">Belum Tersedia Video Pembelajaran !</h6>
    <?php endif ?>

</div>

</div>
</div>
</main>
</div>

<hr class="divider-color">