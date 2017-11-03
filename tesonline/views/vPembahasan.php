<!-- START Body -->
<style>
.pager li > a, .pager li > span{
    display: inline-block;
    padding: 5px 14px;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 0px;
    margin: 5px;
}

#jwb_sisJ {
    border-radius: 12px;
    /*background: #fff;*/
    padding: 2px 4px 2px 4px; 
    width: 20px;
    height: 20px;
    color : #06C;
    font-size: 12px;
    text-align: center;
    text-decoration: none;
    border: 1px soallid #63d3e9; 
    margin-left: 27px;
    margin-top: 4px;
}

#flex-item {
    float:left;
    width: 48px;
    height: 48px;
    /*margin: 1px;*/
    padding: 2px;
    margin-top: 12px; 

}


#lihatStatus{
    /*position: fixed;*/
    /*top: 0;*/
    /*left: 10px;*/
    /*z-index: 99;*/
    /*border-bottom: 1px solid #ddd;*/
    min-width: 10%;
    /*padding: 9px;*/
    /*background-color: #fff;*/
    /*border: 1px solid #555;*/
}
#lihat{
    margin: 5px;
}
#kotak{
    width: 30px;
    height: 30px;
    border: 1px solid aqua;
    margin: 5px;
    float: left;
    padding: 5px;
    /*position: absolute;*/
}

label > input{ /* HIDE RADIO */
  visibility: hidden;  
  position: absolute; /* Remove input from document flow */
}

label:hover{ /* HIDE RADIO */
  background-color: #63d3e9;
}

.terpilih{
    /*background-color: #63d3e9;*/
}
</style>

<body class="bgcolor-white">
    <!-- START Template Main -->
    <script src="<?= base_url('assets/js/bjqs-1.10.js') ?>"></script>
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $('#my-slideshow').bjqs({
//                'height': 400,
                // 'width': 600,
                // 'responsive': false
            });
        });
    </script>
    <section id="main" role="main">
        <!-- START page header -->
        <section class="page-header page-header-block nm" style="">
            <!-- pattern -->
            <!--/ pattern -->
            <div class="container pt15 pb15">
                <div class="">
                    <div class="page-header-section text-center">
                        <img src="https://sibejoo.com/img/logo-sibejoo.png" >
                        <p class="title font-alt">Latihan Online</p>
                    </div>
                </div>
            </div>
        </section>

        <!--/ END page header -->

        <!-- START Register Content -->
        <section class="section bgcolor-white">
            <div class="container-fluid">
              <div class="col-md-1" style="margin-right: 45px;"></div>
              <div class="col-md-9" style="width: 1060px;">
                <div class="panel panel-default">
                  <div class="panel-heading">
                  </div>
                  <div class="panel-body">
                    <div class="col-md-2">
                      <b>Benar</b> <br>
                      <b ><?=$score['jmlh_benar']?></b>
                    </div>
                    <div class="col-md-2">
                      <b>Salah</b> <br>
                      <b ><?=$score['jmlh_salah']?></b>
                    </div>
                    <div class="col-md-2">
                      <b>Kosong</b> <br>
                      <b ><?=$score['jmlh_kosong']?></b>
                    </div>
                    <div class="col-md-2">
                      <b>Score</b> <br>
                      <b ><?=$score['jmlh_benar']?></b>
                    </div>
                    <div class="col-md-4" style="">
                      <a href="<?=base_url('tesonline/daftarlatihan')?>" class="btn btn-danger btn-block" >Kembali</a>
                     </div>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-md-offset-3">
                
              </div>
                <div class="row">
                    <div class="col-md-10 col-md-offset-1" style="">
                        <!--<div class="clear-fix"></div>-->
                        <form method="post" id="hasil">
                            <div class="col-md-8" style="margin-bottom:30">
                                <row>
                                    <?php
                                    $i = 1;
                                    $nosoal = 1;
                                    ?>
                                    <div id="my-slideshow" style="">
         <ul class="bjqs" style="display: block;list-style: none">
          <?php foreach ($soal as $key): ?>
           <li class="bjqs-slide" style="display: none;">
            <div class="">
             <div class="panel panel-default" style="">
              <div class="panel-heading">
               <!-- <h1>Selamat datang</h1> -->
                 <?php 
                 if ($key['status_koreksi']==1) {
                  $status_color = ['ico'=>'ico-checkmark3','kelas'=>'btn-success','title'=>'Benar','kelas_txt'=>'text-success'];
                 }else if($key['status_koreksi']==2){
                  $status_color = ['ico'=>'ico-close4','kelas'=>'btn-danger','title'=>'Salah','kelas_txt'=>'text-danger'];
                 }else{
                  $status_color = ['ico'=>'ico-check-empty','kelas'=>'btn-warning','title'=>'Kosong','kelas_txt'=>'text-warning'];
                 }
                ?> 
               <div class="row" title="<?=$status_color['title'] ?>">

                <div class="col-md-6 center"><h4 class=""><h4 class="">ID Soal : <small> <?= $key['judul'] ?> </small></h4></div>
               
               </div>
              </div>
              <div class="panel-collapse">
               <div class="panel-body">
                <div class="row">
                 <div class="col-md-1 text-right">
                  <p><h4><?= $i ?>.</h4></p>
                 </div>
                 <div class="col-md-11">
                  <?php if (!empty($key['gambar'])) { ?>       
                  <img src="<?= base_url('./assets/image/soal/' . $key['gambar']) ?>" style="max-width: 100%">   
                  <?php } ?>
                  <h5><?= $key['soal'] ?></h5>
                  <br>
                 </div>  
                </div>
                <div class="row">
                 <div class="col-md-10 col-md-offset-1">
                  <h5 class="<?=$status_color['kelas_txt'] ?>">Jawaban anda : <?=$status_color['title'] ?></h5><br>
                  <?php
                  $k = $key['soalid'];
                  $pilihan = array("A", "B", "C", "D", "E");
                  $indexpil = 0;

                  $jawaban = $key['jaw'];
                  ?>

                  <?php foreach ($pil as $row): ?>
                   <?php if ($row['pilid'] == $k) { ?>
                   <div class="mb10">
                    <!-- <label id="pil[<?= $row['pilid']; ?>]" onclick="changeColor('pil[<?= $row['pilid']; ?>]')" style="border:1px solid #63d3e9; padding: 5px;width:100% "> -->
                      <span style="font-weight: bolder;position: absolute; left: -2px;"><?=$pilihan[$indexpil];?>.</span>
                    <label id="pil[<?= $row['pilid']; ?>]" onclick="changeColor('pil[<?= $row['pilid']; ?>]')" style="border:1px solid #63d3e9; padding: 5px;width:100%; 
                    <?php 
                     if ($jawaban == $row['pilpil']) {
                      echo "background-color:#8dcf8a";
                     }else{

                     }
                     ?>">
                     <input type="radio" id="<?= $i ?>" value="<?= $row['pilpil'].$pilihan[$indexpil]; ?>" name="pil[<?= $row['pilid']; ?>]" onclick="updateColor(<?= $i ?>)">
                     <!-- <div class ="btn"><?=  $pilihan[$indexpil];?>.
                     </div> -->
                     <?php
                     if (empty($row['pilgam'])) {
                      echo '';
                     } else {
                      ?>
                      <img src="<?= base_url('./assets/image/soal/' . $row['pilgam']) ?>" style="max-width: 100%">
                      <?php } ?>
                      <?= $row['piljaw'] ?>
                      <?php 
                      if ($jawaban == $row['pilpil']) {
                       // echo "<i class='fa fa-check fa-2x' aria-hidden='true'></i>";
                      }else{

                      }
                      ?>
                      <?php $indexpil++;?>
                     </label>  
                    </div>
                    <?php
                   } else {                                                                               // $indexpil=0;
                   }
                   ?>

                  <?php endforeach ?>
                 </div>
                </div>
                <hr>
                <div class="row">      
                 <div class="col-md-10 col-md-offset-1">
                  <?php                                                                            // if ($key['status_pembahasan'] == 0) {
                  if ($key['gambar_pembahasan'] == null && $key['pembahasan'] == null && $key['video_pembahasan'] == null && $key['link'] == null) {
                   echo "<h5><strong>Tidak ada pembahasan pada soal ini</strong></h5>";
                  }else{
                   echo "<h5><strong>Pembahasan :</strong></h5>";
                  }
                  ?>
                 </div>
                 <!-- CEK ADA PEMBAHASAN TIDAK ? -->
                 <?php if ($key['gambar_pembahasan'] != null || $key['pembahasan'] != null || $key['video_pembahasan'] != null || $key['link'] != null) { ?>
                  <div class="col-md-10 col-md-offset-1" style="border: 1px solid #63d3e9;min-height: 100px;padding:10px;text-align:justify">
                   <!-- CEK ADA GAMBAR PEMBAHASAN -->
                   <?php if ($key['gambar_pembahasan'] != null) { ?>
                   <img src="<?= base_url('assets/image/pembahasan/'.$key['gambar_pembahasan']) ?>" style="max-width: 100%" >
                   <?php
                  } 

                  if ($key['pembahasan'] != null) {
                   echo '<p>'.$key['pembahasan'].'</p>';
                  }

                  if ($key['video_pembahasan'] != null) { ?>
                  <video width=100% controls>
                   <source src="<?=base_url('assets/video/'.$key['video_pembahasan'])?>" type="video/mp4">
                   </video>
                   <?php
                  }
                  if ($key['link'] != null) {
                   echo '<iframe width=100% height="430" src="'.$key['link'].'"></iframe>';
                  }


                  ?>


                 </div>
                 <?php
                }
                ?>
                <!-- <div class="row"> -->

                <!-- </div> -->
               </div>
              </div>
             </div>
            </div>
           </div>
          </li>
          <?php
          $i++;
          $nosoal++;
          ?>
         <?php endforeach; ?>
        </ul>
       </div>
        <div style="margin-left:40">
            <div class="col-md-6">
                <button class="btn btn-info btn-block" id="btnPrev">Sebelumnya</button>
                <!--<button type="button" class="btn btn-primary btn-block">Selanjutnya</button>-->
            </div>
            <div class="col-md-6"> 
                <button class="btn btn-info btn-block" id="btnNext">Selanjutnya</button>
                <!--<button type="button" class="btn btn-teal btn-block">Sebelumnya</button>-->
            </div>
        </div>


    </row>  
</div>

<div class="col-md-4">
  <div class="panel panel-default"  style="min-height:170px;">
    <!--panel heading/header--> 
    <div class="panel-heading">
      <div class="row">
      <div class="text-center"> <h4><span>Keterangan</span></h4></div>
      </div>
    </div>
    <!--/ panel heading/header--> 
    <!--panel body with collapse capabale--> 
    <div class="panel-collapse">
      <div class="panel-body">
        <div class="row">
          <div class="col-md-4">
            <h5><b>Benar </b></h5>
            <h5><b>Salah </b></h5>
            <h5><b>Kosong  </b></h5>
            <h5><b>Score  </b></h5>
          </div>
          <div class="col-md-1">
            <h5><b><?=$score['jmlh_benar']?></b></h5>
            <h5><b><?=$score['jmlh_salah']?></b></h5>
            <h5><b><?=$score['jmlh_kosong']?></b></h5>
            <h5><b><?=$score['jmlh_benar']?></b></h5>
          </div>
          <div class="col-md-12" style="">
            <hr>
            <a href="<?=base_url('tesonline/daftarlatihan')?>" class="btn btn-danger btn-block" >Kembali</a>
           </div>
        </div>
      </div>
    </div>
  </div>

       <div class="panel panel-default"  style="min-height:170px;">
        <!--panel heading/header--> 
        <div class="panel-heading">
         <div class="row">
          <!--<div class="text-center"><h4>Lembar Jawaban</h4></div>-->
          <!-- <div class="text-center"> <h4><span id="timer"></span></h4></div> -->  
          <div class="text-center"> <h4><span>Nomor Soal</span></h4></div>
         </div>
        </div>
        <!--/ panel heading/header--> 
        <!--panel body with collapse capabale--> 
        <div class="panel-collapse">
         <div class="panel-body">
          <div></div>
          <div class="row">
           <div class="col-md-10 col-md-offset-1">
            <!--<li class="pageNumbers"></li>-->
            <div class="ljk" style="">
             <?php
             $nojwb = 1;
             foreach ($soal as $jwb) {
              ?>
              
              <div id="flex-item" >
              <?php if ($jwb['status_koreksi']==1): ?>
               <a id ="nom_sisS" class ="go_slide btn btn-success"  alt="<?= $nojwb ?>" title="Jawaban Benar"><?= $nojwb ?></a>               
              <?php endif ?>

              <?php if ($jwb['status_koreksi']==2): ?>
               <a id ="nom_sisS" class ="go_slide btn btn-danger" alt="<?= $nojwb ?>" title="Jawaban Salah"><?= $nojwb ?></a>               
              <?php endif ?>

              <?php if ($jwb['status_koreksi']==3): ?>
               <a id ="nom_sisS" class ="go_slide btn btn-warning"  alt="<?= $nojwb ?>" title="Jawaban Kosong"><?= $nojwb ?></a>               
              <?php endif ?>


              </div>
              <?php
              $nojwb++;
             }
             ?>
            </div>

           </div>
           <!--</ul>-->  

           <div class="clear" style="clear:both"></div>

           <div class="col-md-12" style="">
            <hr> 
            <a href="<?=base_url('tesonline/daftarlatihan')?>" class="btn btn-info btn-block" >Pembahasan Selesai</a>
           </div>

          </div>
         </div> 
         <!--/ panel body with collapse capabale--> 
        </div>
        <!--/ END panel--> 
       </div>
      </div>
</form>
</div>
</div>
</div>
</section>

<!--/ END Register Content -->

<!-- START To Top Scroller -->

<a href="#" class="totop animation" data-toggle="waypoints totop" data-showanim="bounceIn" data-hideanim="bounceOut" data-offset="50%"><i class="ico-angle-up"></i></a>

<!--/ END To Top Scroller -->

</section>
<!--/ END Template Main -->
