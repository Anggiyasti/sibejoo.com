<!-- Modal Score -->
<div class="modal fade " tabindex="-1" role="dialog" id="myModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><br>
        <h3 class="text-center mt-0 mb-0"><b>Nama Paket</b></h3>
      </div>
      <div class="modal-body">
          <canvas id="myChart" width="100" height="100"></canvas>
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
          

          <h3>DAFTAR PAKET TO </h3>
        </div>
        <?php if ($paket==array()): ?>
          <div class="col-md-12">
            <h5>Belum ada paket Try Out.</h5>
          </div>

        <?php else: ?>


            <div class="col-xs-12 col-sm-12 col-md-12 pb-sm-20 mb10">
            <table class="table table-hover daftarpaket" style="font-size: 13px" id="zero-configuration">
              <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Paket</th>
                    <th>Jenis Penilaian</th>
                    <th width="2%">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $no=1;
                  foreach ($paket as $paketitem): ?>
                    <tr>
                      <td><?= $no; ?></td>
                      <td><?=$paketitem['nm_paket'] ?></td>
                      <td><?=$paketitem['jenis_penilaian'] ?></td>
                      <td>
                        <?php if ($status_to=='doing'): ?>
                        <a href="<?=base_url()?>tryit_tryout/tamp_paket/<?=$paketitem['id_paket']?>" class="btn btn-dark btn-theme-colored btn-sm modal-on<?=$paketitem['id_paket']?>" 
                          title="Kerjakan">
                          <i class="glyphicon glyphicon-pencil"></i>
                        </a>
                        <?php elseif ($status_to=='done'): ?>
                        <a class="btn btn-dark btn-theme-colored btn-sm modal-on<?=$paketitem['id_paket']?>" 
                          title="Waktu Habis" 
                          onclick="habis()" disable data-todo='<?=json_encode($paketitem)?>'>
                          <i class="fa fa-close"></i>
                        </a>
                        <?php else: ?>
                          <a class="btn btn-dark btn-theme-colored btn-sm modal-on<?=$paketitem['id_paket']?>" 
                          title="Waktu Habis" 
                          onclick="forbiden()" disable data-todo='<?=json_encode($paketitem)?>'>>
                          <i class="fa fa-hourglass-half"></i>
                        </a>
                         <?php endif; ?>
                      </td>
                    </tr>
                  <?php 
                  $no++;
                  endforeach ?>
                </tbody>
            </table>
              </div>

       <?php endif; ?>
        



        
        
          <!-- <?php foreach ($paket_dikerjakan as $paketitem): ?> -->
            
          <!-- <?php endforeach ?> -->
       
        
      </div>
    
  </div>
</div>
</section>
<!-- <canvas id="myChart" width="400" height="400"></canvas> -->
<script src="<?=base_url("assets/plugins/plugins/Chart.js-master/samples/utils.js") ?>"></script>
<script src="<?=base_url("assets/plugins/plugins/Chart.js-master/samples/chart_bundles.js") ?>"></script>





<script type="text/javascript"> 


  $(document).ready(function(){
    $('.daftarpaket').DataTable({
      "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
      "bDestroy": true,
      "bLengthChange": false,
      "oLanguage": {"sLengthMenu": "\_MENU_"},
      "aoColumnDefs": [
        { "bSortable": false, "aTargets": [ "_all" ] }
        ],
    });

    $('.daftarpaket').find("thead th").removeClass("sorting_asc");
  });


  // jQuery(document).ready(function () {
  //   var ctx = document.getElementById("myChart").getContext('2d');
  // });

  // function kerjakan(id_to){
  //   var kelas = ".modal-on"+id_to;
  //   var data_to = $(kelas).data('todo');
  //   url = base_url+"index.php/tryout/buatto";

  //   var datas = {
  //     id_paket:data_to.id_paket,
  //     id_tryout:data_to.id_tryout,
  //     id_mm_tryoutpaket:data_to.mmid
  //   }

  //   $.ajax({
  //     url : url,
  //     type: "POST",
  //     data: datas,
  //     dataType: "TEXT",
  //     success: function(data)
  //     {
  //      window.location.href = base_url + "index.php/tryout/mulaitest";
  //    },
  //    error: function (jqXHR, textStatus, errorThrown) {
  //    }
  //  });
  // }

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
    $('.modal-header h3 b').text(data.nm_paket);
  // nilai =data.jmlh_benar/ data.jumlah_soal * 100;
  if (data.jenis_penilaian == 'SBMPTN') {
    nilai =((data.jmlh_benar * 4) + (data.jmlh_salah *(-1)) + (data.jmlh_kosong * 0)) / ( data.jumlah_soal*4) * 100;
  }
  else {
    nilai =data.jmlh_benar/ data.jumlah_soal * 100;
  }

  // CHART DONNUT

  var ctx = document.getElementById("myChart").getContext('2d');
  var myDoughnutChart = new Chart(ctx, {
   type: 'doughnut',
   data: {
    datasets: [{
      data: [
      data.jmlh_benar,
      data.jmlh_salah,
      data.jmlh_kosong,
      ],
      backgroundColor: [
      window.chartColors.blue,
      window.chartColors.red,
      window.chartColors.green,
      ],
      label: 'Dataset 1'
    }],
    labels: [
    "Benar",
    "Salah",
    "Kosong",
    ]
  },
  options: {
    responsive: true,
    legend: {
      position: 'top',
    },
    title: {
      display: true,
      text: "Nilai : "+nilai,
      fontSize: 25
    },
    animation: {
      animateScale: true,
      animateRotate: true
    }
  }

});
  // CHART DONNUT
/*
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
  chart.render();*/
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