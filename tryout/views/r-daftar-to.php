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

<section id="pricing">
  <div class="container">
    <div class="section-content">
      <div class="row">
        <?php foreach ($tryout as $tryout_item): ?>
          <?php 
            $date1 = new DateTime($tryout_item['tgl_mulai']);
            $date2 = new DateTime($tryout_item['tgl_berhenti']);
            $date3 = $date2->diff($date1);
            $hariini = new DateTime(date("Y-m-d"));
            $sisa = new stdClass();
            if ($hariini>$date2) {
              $sisa->days = 0;
            } else {
              $sisa = $date2->diff($hariini);
            }
          ?>
          <div class="col-xs-12 col-sm-6 col-md-4 hvr-float-shadow mb-sm-30">
            <div class="pricing-table maxwidth400">
              <div class="font-16 pl-10 bg-theme-color-2 text-white text-left pr-20 p-10"> <p align="center"><?=$tryout_item['nm_tryout'] ?></p>
              </div>
                <img src="http://placehold.it/359x120" alt="">
                <div class=" bg-white border-1px p-30 pt-20 pb-20">
                  <h3 class="package-type font-14 m-0 text-black"><?=$tryout_item['nm_tryout'] ?></h3>
                  <ul class="table-list list-icon theme-colored pb-0">
                    <li><i class="fa fa-check"></i>Mulai : <?=$tryout_item['tgl_mulai']." ".$tryout_item['wkt_mulai'] ?></li>
                    <li><i class="fa fa-check"></i>Berakhir : <?=$tryout_item['tgl_berhenti']." ".$tryout_item['wkt_berakhir']?></li>
                    <li><i class="fa fa-check"></i>Masa Berlaku : <?=$date3->d." Hari" ?></li>
                    <?php if ($sisa->days == 0) : ?>
                      <li><i class="fa fa-times"></i>Keaktivan : <?=$sisa->days ?> Hari</li>
                    <?php else : ?>
                    <li><i class="fa fa-check"></i>Keaktivan : <?=$sisa->days ?> Hari</li>
                    <?php endif; ?>
                  </ul>
                </div>
                <?php if ($sisa->days == 0): ?>
                  <a class="btn btn-lg btn-theme-colored text-uppercase btn-block pt-20 pb-20 btn-flat detail-<?=$tryout_item['id_tryout']?>"
                    data-todo='<?=json_encode($tryout_item) ?>'
                    onclick="lihat_detail(<?=$tryout_item['id_tryout'] ?>)">Lihat Paket Soal</a>
                <?php else: ?>
                  <a class="btn btn-lg btn-theme-colored text-uppercase btn-block pt-20 pb-20 btn-flat detail-<?=$tryout_item['id_tryout']?>"
                    data-todo='<?=json_encode($tryout_item) ?>'
                    onclick="lihat_detail(<?=$tryout_item['id_tryout'] ?>)">Lihat Paket Soal</a>
                <?php endif; ?>
            </div>
          </div>
        <?php endforeach ?>
      </div>
    </div>
  </div>
</section>

<script type="text/javascript">
function lihat_detail(id_to){
  window.location.href = base_url + "index.php/tryout/create_seassoin_idto/"+id_to;
  var kelas = ".detail-"+id_to;
  var data_to = $(kelas).data('todo');
}

</script>
