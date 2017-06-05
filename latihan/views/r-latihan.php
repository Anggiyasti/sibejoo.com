<!-- TITLE -->
<section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="http://placehold.it/1920x1280" style="background-image: url(&quot;http://placehold.it/1920x1280&quot;); background-position: 50% 99px;">
  <div class="container pt-70 pb-20">
    <!-- Section Content -->
    <div class="section-content">
      <div class="row">
        <div class="col-md-12">
          <?php if ($this->session->userdata('HAKAKSES')=='ortu'): ?>
          <h1 class="text-center text-white">Halo <?=$this->session->userdata['USERNAME']?> , orang tua dari <?=$siswa?>  </h1>
        <?php else: ?>
        <h1 class="text-center text-white">Halo, <?=$this->session->userdata['USERNAME']?> !  </h1>
      <?php endif ?>
    </div>
  </div>
</div>
</div>      
</section>
<!-- TITLE -->