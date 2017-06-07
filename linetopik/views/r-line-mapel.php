<section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="http://placehold.it/1920x1280">
      <div class="container pt-60 pb-60">
        <!-- Section Content -->
        <div class="section-content">
          <div class="row">
            <div class="col-md-12 text-center">
              <h1 class="text-center text-white">{judul_header2}</h1>
              
            </div>
          </div>
        </div>
      </div>      
    </section>

<section>
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-md-3">
            <div class="sidebar sidebar-left mt-sm-30">
    <div class="widget">
    <?php  
                $n=0;
                $oldMpalel='';
          ?>
          <?php foreach ($datMapel as $key): ?>
            <?php $mapel=$key['mapel'] ?>
            <?php if ($n==0): ?>
              <?php $n=1; ?>
                <h5 class="widget-title line-bottom"><?=$mapel?></h5>
                <?php elseif($oldMpalel != $mapel) : ?>
                <h5 class="widget-title line-bottom"><?=$mapel?></h5>
                <?php endif ?>
                <div class="categories">
                  <ul class="list list-border angle-double-right">

                    <li><a href="<?=base_url('index.php')?>/linetopik/learningline/<?=$key['babID']?>"><?=$key['judulBab']?></a></li>
                  </ul>
                </div>
                <?php $oldMpalel=$mapel; ?>
              <?php endforeach ?>

              </div>


               </div>
              </div>
            </div>
            <?php if ($datMapel==array()): ?>
                <h4 class="text-center" style="color:#f27c66;">Maaf,Pada Tingkat ini belum tersedia learning line!</h4>
              <?php endif ?>

