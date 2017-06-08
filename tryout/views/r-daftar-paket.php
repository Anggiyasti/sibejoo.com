<!-- Modal Score -->
<div class="modal fade " tabindex="-1" role="dialog" id="myModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><br>
      </div>
      <div class="modal-body">
        <div id="chartContainer" style="height: 400px; width: 100%;">
        </div>
      </div>
    </div>
  </div>
</div>

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

<section>
  <div class="container">
    <div class="section-content">
      <div class="row">
        <div class="col-md-12">
          <h4><b>Daftar Paket TO yang Belum Dikerjakan</b></h4>
        </div>
        <?php if ($paket==array()): ?>
          <div class="col-md-12">
            <h5>Belum ada paket Try Out.</h5>
          </div>
        <?php else: ?>
          <?php foreach ($paket as $paketitem):?>
            <!-- <?php echo $status_to; ?> -->
            <div class="col-sm-6 col-md-3">
              <div class="service-block bg-white">
                <div class="thumb"> <img alt="featured project" src="http://placehold.it/125x55" class="img-fullwidth">
                </div>
                <div class="content text-left flip p-25 pt-0">
                  <h4 class="line-bottom mb-10"><?=$paketitem['nm_paket'] ?></h4>
                  <p>Status : Belum Dikerjakan</p>
                  <?php if ($status_to=='doing'): ?>
                    <a class="btn btn-dark btn-theme-colored btn-sm text-uppercase mt-10 modal-on<?=$paketitem['id_paket']?>" onclick="kerjakan(<?=$paketitem['id_paket']?>)" data-todo='<?=json_encode($paketitem)?>'><i class="fa fa-pencil-square-o"></i> Kerjakan</a>
                  <?php elseif ($status_to=='done'): ?>
                    <a class="btn btn-dark btn-theme-colored btn-sm text-uppercase mt-10 modal-on<?=$paketitem['id_paket']?>" onclick="habis()" disable data-todo='<?=json_encode($paketitem)?>'><i class="fa fa-times"></i></a>
                  <?php else: ?>
                    <a class="btn btn-dark btn-theme-colored btn-sm text-uppercase mt-10 modal-on<?=$paketitem['id_paket']?>" onclick="forbiden()" disable data-todo='<?=json_encode($paketitem)?>'><i class="fa fa-timess"></i></a>
                  <?php endif; ?>
                </div>
               </div>
            </div>
          <?php endforeach ?>
        <?php endif; ?>

        <div class="col-md-12">
          <h4><b>Paket Soal yang Sudah Dikerjakan</b></h4>
        </div>
        <?php if($paket_dikerjakan==array()): ?>
          <div class="col-md-12">
            <h5>Tidak ada paket soal.</h5>
          </div>
        <?php else: ?>
          <?php foreach ($paket_dikerjakan as $paketitem): ?>
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="icon-box media bg-deep p-30 mb-20"> <a class="media-left pull-left flip" href="#"> <i class="fa fa-file-text-o text-theme-colored"></i></a>
                  <div class="media-body">
                    <h5 class="mt-0"><?=$paketitem['nm_paket'] ?></h5>
                    <a class="btn btn-dark btn-theme-colored btn-sm text-uppercase mt-10 modal-on<?=$paketitem['id_paket']?>" onclick="detail_paket(<?=$paketitem['id_paket']?>)" data-todo='<?=json_encode($paketitem)?>' title="Lihat Score">Score</a>
                    <?php if ($status_to=="done"): ?>
                      <a class="btn btn-dark btn-theme-colored btn-sm text-uppercase mt-10" onclick="pembahasanto(<?=$paketitem['id_paket']?>)" data-todo='<?=json_encode($paketitem)?>' title="Pembahasan">Pembahasan</a>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
          <?php endforeach ?>
        <?php endif; ?>
        
      </div>
    </div>
  </div>
</section>

<script type="text/javascript"> 
  function kerjakan(id_to){
    var kelas = ".modal-on"+id_to;
    var data_to = $(kelas).data('todo');
    url = base_url+"index.php/tryout/buatto";

    var datas = {
      id_paket:data_to.id_paket,
      id_tryout:data_to.id_tryout,
      id_mm_tryoutpaket:data_to.mmid
    }

    $.ajax({
      url : url,
      type: "POST",
      data: datas,
      dataType: "TEXT",
      success: function(data)
      {
       window.location.href = base_url + "index.php/tryout/mulaitest";
      },
      error: function (jqXHR, textStatus, errorThrown) {
      }
    });
  }

  function pembahasanto(id_to){
    var kelas = ".modal-on"+id_to;
    var data_to = $(kelas).data('todo');
    url = base_url+"index.php/tryout/buatpembahasan";

    var datas = {
      id_paket:data_to.id_paket,
      id_tryout:data_to.id_tryout,
      id_mm_tryoutpaket:data_to.id
    }

    $.ajax({
      url : url,
      type: "POST",
      data: datas,
      dataType: "TEXT",
      success: function(data)
      {
        window.location.href = base_url + "index.php/tryout/mulaipembahasan";
      },
        error: function (jqXHR, textStatus, errorThrown)
      {
        swal("gagal");
      }
    });
  }

  function detail_paket(id_to){
    var kelas = ".modal-on"+id_to;
    var data_to = $(kelas).data('todo');

    $('.modal-title').text('Grafik Paket Soal Tryout');
    $('#myModal').modal('show');

    load_grafik(data_to);
  }

  function load_grafik(data) {
  nilai =data.jmlh_benar/ data.jumlah_soal * 100;

  var chart = new CanvasJS.Chart("chartContainer", {

     title: {
      text: data.nm_paket,
      fontSize: 30
      
    },
    subtitles:[
    {
      text: "Nilai : "+nilai.toFixed(2),
      //Uncomment properties below to see how they behave
      //fontColor: "red",
      fontSize: 30
    }
    ],
    animationEnabled: true,
    theme: "theme1",
    data: [
    {
      type: "doughnut",
      indexLabelFontFamily: "Garamond",
      indexLabelFontSize: 20,
      startAngle: 0,
      indexLabelFontColor: "dimgrey",
      indexLabelLineColor: "darkgrey",
      toolTipContent: "Jumlah : {y} ",

      dataPoints: [
      { y: data.jmlh_salah, indexLabel: "Salah {y}" },
      { y: data.jmlh_kosong, indexLabel: "Kosong {y}" },
      { y: data.jmlh_benar, indexLabel: "Benar {y}" },
      ]
    }
    ]
  });
   chart.render();
 }

function lihat_grafik(id){
  var kelas = ".modal-on"+id;
  var data = $(kelas).data('todo');

  $('.modal-title').text('Grafik Latihan ');
  $('#myModal').modal('show');

  load_grafik(data);
}

function show_report(){
  $('#myModal2').modal('show');
  $('#myModal2 modal-title').text('Report Latihan');
}

function forbiden(){
  swal('Maaf, to belum bisa di kerjakan!');
}

function habis(){
  swal('Waktu pengerjaan to sudah habis!, anda tidak dapat mengerjakan to.');
}
</script>

<script src="<?= base_url('assets/back/plugins/canvasjs.min.js') ?>"></script>