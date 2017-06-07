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
</style>
<!-- MODAL LATIHAN PERSENTASE-->
<div class="modal fade" tabindex="-1" role="dialog" id="latihan_persentase">
 <div class="modal-dialog" role="document" style="width: 80%">
  <div class="modal-content">
   <div class="modal-header">
    <h3>Perkembangan Latihan</h3>

  </div>
  <div class="modal-body">

    <table class="table rpersentase" width=100% style="font-size: 13px">
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

<section>
 <div class="container">
  <div class="section-content">
   <div class="row">
    <!-- PESAN -->
    <div class="col-xs-12 col-sm-12 col-md-12 pb-sm-20 mb10">
     <h2 class="line-bottom font-20 text-theme-colored text-uppercase mb-10 mt-0">

      <span class="text-theme-color-1"> Pesan</span></h2>
      <p class="lead font-18">hi, <?=$this->session->userdata['USERNAME']?> dibawah ini adalah pesan yang masuk.</p>
      <?php foreach ($pesan as $key ) : ?>
        <div class="col-md-4">
          <blockquote>
            <p><?php $c = $key['isi']; echo substr($c, 0, 30) ?></p>
            <footer><i class="fa fa-date"></i> <?=$key['date_created'] ?></footer>
          </blockquote>
        </div>
      <?php endforeach ?>
      <br><br><br>
      <a class="btn btn-colored btn-theme-colored btn-sm" href="<?=base_url('ortuback/pesan') ?>">Selengkapnya</a><br><br>

    </div>
    <!-- PESAN -->

    <!-- TOPIK -->
    <div class="col-xs-12 col-sm-12 col-md-12 pb-sm-20 mb10">
      <?php if ($this->session->userdata('HAKAKSES')=='ortu'): ?>
        <h2 class="line-bottom font-20 text-theme-colored text-uppercase mb-10 mt-0">
         <span class="text-theme-color-1"> Topik yang baru saja dipelajari <?=$siswa?>..</span></h2>
         Hi, <?=$this->session->userdata('USERNAME') ?> ! Dibawah ini adalah progress learning line dari <?=$siswa?>! 
       <?php else: ?>
        <h2 class="line-bottom font-20 text-theme-colored text-uppercase mb-10 mt-0">
         <span class="text-theme-color-1"> Topik yang baru saja dipelajari..</span></h2>
         <p class="lead font-18">Dibawah ini adalah progress learning line kamu, silahkan lanjutkan untuk bisa menyelesaikan topik-topik yang disediakan. Tetap semangat!</p> 
       <?php endif ?>

       <div class="row">
         <?php foreach ($topik  as $item): ?>
           <?php $persentasi = (int)$item['stepDone'] / (int)$item['jumlah_step'] * 100; ?>
           <div class="col-md-4" title="<?=(int)$persentasi ?>%">
            <div class="portfolio-item">
             <div class="picture">
              <div class="course-item">
               <div class="course-date bg-color-3 clear-fix skill-bar">
                <h5 class="font-16 title"><a href="#"><a href="<?=base_url("linetopik/learningline/".$item['babID']) ?>"><?=$item['namaTopik'] ?></a></a></h5>
                
                <div class="progress-item">
                <div class="progress">
                 <div class="progress-bar appeared" data-percent="<?=$persentasi ?>" style="width: <?=$persentasi ?>%;">
                   <span class="percent"><?=ceil($persentasi) ?>%</span>
                 </div>
               </div>
               </div>

               <div class="day"><?=$item['stepDone'] ?> / <?=$item['jumlah_step'] ?> Step Line Dikerjakan</div>
               <div class="bar">
                 <span class="bg-color-4 skill-bar-progress" processed="true" style="width: <?=$persentasi ?>%;"></span>
               </div>
             </div>
           </div>
         </div>
       </div>
     </div>
   <?php endforeach ?>
 </div>
 <br>
 <a onclick="show_modal_learning()" class="btn btn-colored btn-theme-colored btn-sm">Selengkapnya</a>
 <br>
 <br>

</div>
<!-- TOPIK -->

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
       <h6><?=$item['total_benar'] ?> Benar dari <?=$item['total_soal'] ?> soal</h6>
       <h6><?=(int)$persentasi ?>% Benar</h6>
       <h6>Nilai : <bold><i><?=(int)$item['total_benar'] / (int)$item['total_soal'] * 100 ?><bold></i></h6>
     </div>
   </div>
 </div>
 <?php $no++; ?>
<?php endforeach ?>
</div>
<a onclick="show_modal_latihan()" class="btn btn-colored btn-theme-colored btn-sm">Selengkapnya</a>
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
     <a onclick="show_modal_tryout()" class="cws-button bt-color-3 alt small">Selengkapnya</a> 
   <?php else: ?>
   <?php endif ?>
   <div class="panel-body" >
     <div class="panel-body pt0" id="resizeble" style="height:430px">
      <div class="container" id="chartContainer" style="width:100%">

      </div>
    </div>      
  </div>
</div> 
</div>
<!-- PERKEMBANGAN TO -->

<!-- video random -->
<section class="col-xs-12 col-sm-12 col-md-12 pb-sm-20 mb10" style="padding-bottom: : 0;">
 <div class="container">
  <div class="grid-row clear-fix">
   <h2 class="line-bottom font-20 text-theme-colored text-uppercase mb-10 mt-0">
    <span class="text-theme-color-1">Recent Video</span></h2>
    <p class="lead font-18">Nah, dibawah ini terdapat video terbaru loh, yuk coba tonton..
    </p>    

    
    <hr>  
    <div class="grid-col-row clear-fix">
     <?php foreach ($video as $item): ?>
       <div class="col-md-3">
        <div class=" portfolio-item">
         <div class="picture">
          <div class="hover-effect"></div>
          <div class="link-cont">
           <span></span>
           <?php $url =  base_url()."video/seevideo/".$item['videoid']?>

         </div>
         <center>
           <?php if (!empty($item['link'])): ?>
             <iframe  width="250" src="<?=$item['link'] ?>"></iframe>
           <?php endif ?>
         </center>

       </div>
       <a href="<?=$url ?>" class="cws-right"><h3><?=$item['judulVideo'] ?></h3></a>
       <p><?=$item['deskripsi'] ?></p>
     </div>
   </div>
 <?php endforeach ?>


</div>
<hr class="divider-color">  

</div>
</div>
</section>
<!-- video random -->







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
 });

  function load_grafik(data){
   var chart = new CanvasJS.Chart("chartContainer", {
    //   title:{
    //     text:"Grafik Perkembangan Paket Tryout"        
    // },
    theme: "theme1",
    animationEnabled: true,
    axisX:{
     interval: 1,
     gridThickness: 0,
     labelFontSize: 10,
     labelFontStyle: "normal",
     labelFontWeight: "normal",
     labelFontFamily: "Lucida Sans Unicode"
   },
   data: [
   {     
     type: "column",
     name: "companies",
     axisYType: "secondary",   
     dataPoints: data
   }

   ]
 });
   chart.render();
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
</script>