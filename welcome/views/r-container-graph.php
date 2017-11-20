<style>
.canvasjs-chart-credit {
 display: none;
}
.table th:hover{
 cursor: hand;
}

.pagination li:before{
 color:white;
}
.headerDivider {
 border-right:2px dotted rgba(32, 44, 69,.3); 
 /*height: 200px;*/
 /*border-right:3px solid #16222c; */
 /*height:80px;*/
 /*position:absolute;*/
 /*right:249px;*/
 /*top:10px; */
}
</style>
<!-- MODAL LATIHAN PERSENTASE-->
<div class="modal fade" tabindex="-1" role="dialog" id="latihan_persentase">
 <div class="modal-dialog" role="document" style="width: 80%">
  <div class="modal-content">
   <div class="modal-header">
    <h3>Perkembangan Latihan</h3>

  </div>
  <div class="modal-body">

    <table class="table rpersentase table-striped table-schedule" width=100% style="font-size: 13px">
     <thead>
      <tr>
       <th>No</th>
       <th>Nama Bab</th>
       <th>Jumlah Soal</th>
       <th>Jumlah Salah</th>
       <th>Jumlah Kosong</th>
       <th>Jumlah Benar</th>
       <th>Score</th>
       <th>Persentase</th>
     </tr>
   </thead>
   <tbody>

   </tbody>
 </table>
</div>

<div class="modal-footer bg-color-3">
  <button type="button" class="cws-button bt-color-1 alt small selesai" data-dismiss="modal">Batal</button>
</div>

</div>
</div>
</div>
<!-- MODAL LATIHAN PERSENTASE-->

<!-- MODAL LATIHAN PERSENTASE-->
<div class="modal fade" tabindex="-1" role="dialog" id="learning_persentase">
 <div class="modal-dialog" role="document" style="width: 80%">
  <div class="modal-content">
   <div class="modal-header">
    <h3>Progress Learning Line</h3>

  </div>
  <div class="modal-body">

    <table class="table lpersentase" width=100% style="font-size: 13px">
     <thead>
      <tr>
       <th>No</th>
       <th>Nama Topik</th>
       <th>Step Dikerjakan</th>
       <th>Jumlah Step</th>
       <th>Persentase</th>
       <th>Bar</th>
     </tr>
   </thead>
   <tbody>

   </tbody>
 </table>
</div>

<div class="modal-footer bg-color-3">
  <button type="button" class="cws-button bt-color-1 alt small selesai" data-dismiss="modal">Batal</button>
</div>

</div>
</div>
</div>
<!-- MODAL LATIHAN PERSENTASE-->

<!-- MODAL LATIHAN PERSENTASE-->
<div class="modal fade" tabindex="-1" role="dialog" id="laporan_tryout">
 <div class="modal-dialog" role="document" style="width: 80%">
  <div class="modal-content">
   <div class="modal-header">
    <h3>Laporan Semua Paket Tryout</h3>

  </div>
  <div class="modal-body">

    <table class="table rpaket" width=100% style="font-size: 13px">
     <thead>
      <tr>
       <th>no</th>
       <th>Nama Paket</th>
       <th>Nama Tryout</th>
       <th>Jumlah Soal</th>
       <th>Benar</th>
       <th>Salah</th>
       <th>Kosong</th>
       <th>Nilai</th>
       <th>Waktu Mengerjakan</th>
     </tr>
   </thead>
   <tbody>

   </tbody>
 </table>
</div>

<div class="modal-footer bg-color-3">
  <button type="button" class="cws-button bt-color-1 alt small selesai" data-dismiss="modal">Batal</button>
</div>

</div>
</div>
</div>
<!-- MODAL LATIHAN PERSENTASE-->


<!-- TITLE -->
<section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="http://iyengineers.org/assets/img/artikel2.jpg">
 <div class="container pt-70 pb-20">
  <!-- Section Content -->
  <div class="section-content">
   <div class="row">
    <div class="col-md-12">
     <?php if ($this->session->userdata('HAKAKSES')=='ortu'): ?>
       <h1 class="text-center text-white">H<?=$this->session->userdata['USERNAME']?> Orang Tua Dari <?=$siswa?>  </h1>
     <?php else: ?>
      <h1 class="text-center text-white"><?=$this->session->userdata['USERNAME']?> </h1>
    <?php endif ?>
  </div>
</div>
</div>
</div>      
</section>
<!-- TITLE -->
<!-- 

<section>
 <div class="container">
  <div class="section-content">
   <div class="row">
    <h2 class="font-20 text-theme-colored text-uppercase">
      <span class="text-theme-color-1"> Info Dasar Siswa
        <div class="separator left mt-0 mb-0">
          <i class="fa fa-user"></i>
        </div>
      </span></h2>



      <div class="col-xs-3">
        <img class="photo" src="<?=$photo  ?>" alt="<?=$this->session->userdata('USERNAME') ?>" width="200px">
      </div>

      <div class="col-xs-3 headerDivider">
        <span>Nama : </span> <BR>
        <span class="mt-100"><h2><?=str_replace(' ', '<br>', $this->session->userdata('NAMASISWA'));?></h2></span>
      </div>

      <div class="col-xs-3">

      </div>

      <div class="col-xs-3">
        4
      </div>

    </div>
  </div>
</div>
</section>
-->


<section>
 <div class="container">
  <div class="section-content">
   <div class="row">
    <h2 class="font-20 text-theme-colored text-uppercase">
      <span class="text-theme-color-1"> Daftar Topik
        <div class="separator left mt-0 mb-0">
          <i class="fa fa-user"></i>
        </div>
      </span></h2>
      <?php foreach ($topik  as $item): ?>
        <div class="col-xs-3 headerDivider">
          <?php $ava = $this->generateavatar->generate_first_letter_avtar_url($item['namaTopik'],250); ?>
          <img class="photo" src="<?=$ava ?>" alt="<?=$this->session->userdata('USERNAME') ?>" width="250px">
          <a onclick="getlearning(<?=$item['babID'] ?>)"><h5 class="font-16 title"><?= ucwords(strtolower($item['namaTopik'])) ?></h5></a>
          <?php $persentasi = (int)$item['stepDone'] / (int)$item['jumlah_step'] * 100; ?>
          <div class="progress-item">
            <div class="progress">
             <div class="progress-bar appeared" data-percent="<?=$persentasi ?>" style="width: <?=$persentasi ?>%;">
             </div>
           </div>
         </div>
         <h4><?=ceil($persentasi) ?>% Done! <a title="lanjutkan" onclick="getlearning(<?=$item['babID'] ?>)" style="cursor: hand"><i class="fa fa-caret-square-o-right"></i></a></h4>
         <div class="day"><?=$item['stepDone'] ?> / <?=$item['jumlah_step'] ?> Step Line Dikerjakan</div>
       </div>        
     <?php endforeach ?>
   </div>
 </div>
</div>
</section>

<section>
 <div class="container">
  <div class="section-content">
   <div class="row">


    <!-- LATIHAN -->
    <div class="col-xs-12 col-sm-12 col-md-12 pb-sm-20 mb10">
     <?php if ($this->session->userdata('HAKAKSES')=='ortu'): ?>
       <h2 class="line-bottom font-20 text-theme-colored text-uppercase mb-10 mt-0">
        <span class="text-theme-color-1"> Latihan yang telah dikerjakan <?=$siswa?>..</span></h2>
        <p class="lead font-18">Dibawah ini adalah latihan yang sudah dihitung berdasarkan babnya, silahkan untuk di lihat agar mengetahui perkembangan anda</p>
      <?php else: ?>
       <h2 class="line-bottom font-20 text-theme-colored text-uppercase mb-10 mt-0">
        <span class="text-theme-color-1"> Latihan yang telah dikerjakan <?=$this->session->userdata('USERNAME')?>..</span></h2>     
        <p class="lead font-18">Dibawah ini adalah latihan yang sudah dihitung berdasarkan babnya, silahkan untuk di lihat agar mengetahui perkembangan anda</p>
      <?php endif ?>

      <div class="container">
        <?php $no = 1; ?>
        <?php foreach ($latihan  as $item): ?>
          <?php $persentasi = (int)$item['total_benar'] / (int)$item['total_soal'] * 100; ?>
          <div class="col-md-4">
           <div class="progress-item">
            <div class="progress">
             <div class="progress-bar appeared" data-percent="<?=$persentasi ?>" style="width: <?=$persentasi ?>%;">
               <span class="percent"><?=ceil($persentasi) ?>%</span>
             </div>
           </div>

           <div class="progress-title">
             <h6><?=$no ?>. <?=$item['judulBab'] ?></h6>
             <h6><?=(int)$persentasi ?>% Benar</h6>
           </div>
         </div>
       </div>
       <?php $no++; ?>
     <?php endforeach ?>
   </div>
   <a onclick="show_modal_latihan()" class="btn btn-colored btn-theme-colored btn-sm">Selengkapnya</a><br><br><br>
 </div>

 <div class="separator separator-rouned">
  <i class="fa fa-cog fa-spin"></i>
</div>
<!-- LATIHAn -->
</div>
</div>
</div>
</section>


</div>




<!-- PERKEMBANGAN TO -->
<div class="container">
 <div class="grid-row clear-fix">
  <?php if ($this->session->userdata('HAKAKSES')=='ortu'): ?>
    <h2 class="line-bottom font-20 text-theme-colored text-uppercase mb-10 mt-0">
     <span class="text-theme-color-1">Grafik Tryout dari <?=$siswa?></span></h2>
     <p class="lead font-18">Dibawah ini adalah grafik perkembangan TO <?=$siswa?>..</p>    


   <?php else: ?>
    <h2 class="line-bottom font-20 text-theme-colored text-uppercase mb-10 mt-0">
     <span class="text-theme-color-1">Grafik Tryout</span></h2>
     <p class="lead font-18">Dibawah ini adalah grafik perkembangan TO kamu, jika nilaninya masih tidak memuaskan jangan khawatir pasti kamu bisa memperbaikinya dengan cara banyak mengikuti latihan. Tetap semangat! </p>    
   <?php endif ?>

   <?php if ($this->session->userdata('HAKAKSES')=='ortu'): ?>
   <?php else: ?>
   <?php endif ?>
   <div class="panel-body" >
     <div class="panel-body pt0" id="resizeble" style="height:430px">
      <div class="container" id="chartContainer" style="width:100%">

      </div>
    </div>  
    <br>
    <br>    
  </div>
  <a onclick="show_modal_tryout()" class="btn btn-colored btn-theme-colored btn-sm">Selengkapnya</a> 
</div> 
</div>
<!-- PERKEMBANGAN TO -->

<div class="separator separator-rouned">
  <i class="fa fa-cog fa-spin"></i>
</div>
<!-- video random -->
<section class="col-xs-12 col-sm-12 col-md-12 pb-sm-20 mb10" style="padding-bottom: : 0;">
 <div class="container">
  <div class="grid-row clear-fix">
   <h2 class="line-bottom font-20 text-theme-colored text-uppercase mb-10 mt-0">
    <span class="text-theme-color-1">Recent Video</span></h2>
    <p class="lead font-18">Nah, dibawah ini terdapat video terbaru loh, yuk coba tonton..
    </p>    
      <div class="col-md-12">
        <!-- Works Filter -->
        <!-- End Works Filter -->
        <!-- Portfolio Gallery Grid -->
        <div id="grid" class="gallery-isotope grid-4 gutter clearfix" style="position: relative; height: 780px;">
          <?php foreach ($video as $video): ?>
                <?php  $nama_file = base_url().'assets/video/'.$video['namaFile'] ?>
            <!-- Portfolio Item Start -->
            <div class="gallery-item photography" style="position: absolute; left: 0px; top: 0px;">
              <div class="thumb">
                <?php if ($video['link'] != '') { ?>
                 <iframe src="<?=$video['link'] ?>" frameborder="0" gesture="media" allowfullscreen="" id="fitvid0"></iframe> 
                <?php $temp = $video['link'] ?>
                <?php }else{ ?>
                <?php $temp = $nama_file ?>
                <video src="<?=$nama_file ?>" controlsList="nodownload" controls height="143px"></video>
                <?php } ?>
                <div class="overlay-shade"></div>
                <div class="icons-holder">
                  <div class="icons-holder-inner">
                    <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">
                      <a data-lightbox="video" href="<?=$temp ?>" target="_blank"><i class="fa fa-play"></i></a>
                    </div>
                  </div>
                </div>
                <a class="hover-link" data-lightbox="image" href="<?=$video['link'] ?>">View more</a>
              </div>
              <div class="portfolio-description">
                <h5 class="title"><a href="#"><?=$video['judulVideo'] ?></a></h5>
                <span class="category"><span><?=$video['deskripsi'] ?></span></span>
              </div>
            </div>
            
            <!-- Portfolio Item End 
          <?php endforeach ?>


        </div>
        <!-- End Portfolio Gallery Grid -->
      </div>
    <hr class="divider-color">  

  </div>
</div>
</section>
<!-- video random -->





<script src="<?=base_url()?>assets/plugins/highcharts/highcharts.js"></script>
<script src="<?=base_url()?>assets/plugins/highcharts/data.js"></script>
<script src="<?=base_url()?>assets/plugins/highcharts/drilldown.js"></script>
<script src="<?= base_url('assets/back/plugins/canvasjs.min.js') ?>"></script>
<script>
  $(document).ready(function(){
// ## datatable latihan
url4 = base_url+"welcome/get_data_latihan";

dataTableLatihan = $('.rpersentase').DataTable({
 "ajax": {
  "url": url4,
  "type": "POST",
},
"emptyTable": "Tidak Ada Data Pesan",
"info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
"bDestroy": true,
});
// ## datatable latihan

// ## datatable line log
url5 = base_url+"welcome/get_data_learning_line";

dataTableLearningLine = $('.lpersentase').DataTable({
 "ajax": {
  "url": url5,
  "type": "POST",
},
"emptyTable": "Tidak Ada Data Pesan",
"info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
"bDestroy": true,
});
// ## datatable line log

// ## datatable report tryout
url = base_url+"siswa/ajax_report_tryout";

dataTableReportPaket = $('.rpaket').DataTable({
 "ajax": {
  "url": url,
  "type": "POST",
},
"emptyTable": "Tidak Ada Data Pesan",
"info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
"bDestroy": true,
});
// ## datatable report tryout

})
</script>
<!-- LOAD GRAFIK PERSENTASE TO -->
<script type="text/javascript">

  $.getJSON(base_url+"tryout/report_to", function(data) {
   load_grafik(data);
   console.log('hello');
 });

  function load_grafik(data){
    // Create the chart
    Highcharts.chart('chartContainer', {
      chart: {
        type: 'column'
      },
      title: {
        text: 'Grafik Try Out'
      },
      subtitle: {
        text: 'Source: Raport Online Sibejoo'
      },
      xAxis: {
        type: 'category'
      },
      yAxis: {
        title: {
          text: 'Total percent try out'
        }

      },
      legend: {
        enabled: false
      },
      plotOptions: {
        series: {
          borderWidth: 0,
          dataLabels: {
            enabled: true,
            format: '{point.y:.1f}%'
          }
        }
      },

      tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
      },

      series: [{
        name: 'Brands',
        colorByPoint: true,
        colorByPoint: true,
        data: [
        data[0],
        data[1],
        data[2],
        data[3],
        data[4],
        data[5],
        ]
      }],
      drilldown: {
        series: [{
          name: 'Raport',
          id: 'Microsoft Internet Explorer',
          data: [
          data[0],
          data[1],
          data[2],
          data[3],
          data[4],
          data[5],
          ]
        }, {

        }]
      }
    });
  }
</script>
<!-- FILTER PENCARIAN TO -->
<script type="text/javascript">
  $.getJSON(base_url+"siswa/get_tryout_for_select", function(data) {
   $('.tryout_select').html('<option value="">-- Cari Berdasarkan Tryout --</option>');
   $.each(data, function (i, data) {
    $('.tryout_select').append("<option value='" + data.id_tryout + "'>" + data.nm_tryout + "</option>");
  });
 });

// KETIKA BAB CHANGE, LOOAD GRAFIK
$('.tryout_select').change(function () {
 id_to = $(this).val();
 if (id_to!="") {
  $.getJSON(base_url+"siswa/persentase_json/"+id_to, function(data) {
   load_grafik(data);
 });
}else{
  $.getJSON(base_url+"siswa/persentase_json/", function(data) {
   load_grafik(data);
 });
}
});
</script>
<script type="text/javascript">
  function show_modal_latihan() {
   $('#latihan_persentase').modal('show');
 }

 function show_modal_learning() {
   $('#learning_persentase').modal('show');
 }

 function show_modal_tryout() {
   $('#laporan_tryout').modal('show');
 }
 function getlearning(id_bab) {
  url_ajax = base_url+"linetopik/tampungid_bab";

  var global_properties = {
    judulBab: id_bab
  };

  $.ajax({
    type: "POST",
    dataType: "JSON",
    url: url_ajax,
    data: global_properties,
    success: function(data){
      window.location.href = base_url + "linetopik/learningline";  
    },error:function(data){
      sweetAlert("Oops...", "wah, gagal menghubungkan!", "error");
    }

  });
}
</script>