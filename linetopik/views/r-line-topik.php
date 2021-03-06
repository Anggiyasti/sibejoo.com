<link rel="stylesheet" href="<?= base_url('assets/css/custom-time-line.css') ?>"/>
<section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="http://www.ludodigitalstories.it/wp-content/uploads/2016/01/timeline.png">
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
  <div class="container" >
    <div class="row">
      <div class="col-sm-12 col-md-3">
        <div class="sidebar sidebar-left mt-sm-30">
          <div class="widget">
            <h5 class="widget-title line-bottom">Search box</h5>
            <div class="search-form">
              <form method="get" class="search-form" action="<?=base_url()?>index.php/linetopik/cariTopik"  accept-charset="utf-8" enctype="multipart/form-data">
                <div class="input-group">
                  <input type="search" class="form-control search-input" placeholder="Search"  name="keycari" title="Search for:" id="caritopik">
                  <span class="input-group-btn">
                    <button type="submit" class="btn search-button"><i class="fa fa-search"></i></button>
                  </span>
                </div>
              </form>
            </div>
          </div>
          <div class="widget">
            <?php if ($datline!='' || $datline!=''): ?>
              <h5 class="widget-title line-bottom">Topik</h5>
              <div class="categories">
                <ul class="list list-border angle-double-right">
                  <?php   $x=0; ?>
                  <?php foreach ($topik as $rows): ?>
                    <li><a href="#topik<?=$x?>"><?=$rows['namaTopik']?></a></li>
                    <?php $x++; ?>
                  <?php endforeach ?>
                </ul>
              <?php endif ?>
            </div>
          </div>
        </div>
      </div>
      

      <div class="col-md-9 blog-pull-right">
        <?php   $i=0;
        $noTopik=0; 
        $namaTopik=''; ?>
        <?php foreach ($datline as $key ): ?>
          <?php if ($namaTopik != $key['namaTopik'] && $i==0): ?>
            <div class="blog-post single-post" id="topik<?=$noTopik;?>">
              <?php $noTopik++; ?>
              <article class="post clearfix mb-0">

                <div class="entry-content" >
                  <div class="entry-meta media no-bg no-border mt-15 pb-20">
                    <div class="entry-date media-left text-center flip bg-theme-colored pt-5 pr-15 pb-5 pl-15">
                      <ul>
                        <li class="font-12 text-white font-weight-600" ><i class="fa fa-comment"></i>Topik</li>
                      </ul>
                    </div>
                    <div class="media-body pl-15">
                      <div class="event-content pull-left flip ">
                        <h3 class="entry-title pt-0 mt-0 ">Nama Topik: <?=$key['namaTopik']?></h3>
                      </div>
                    </div>
                    
                  </div>
                  
                  <p style="padding-left: 15px;">Deskripsi:' <?=$key['deskripsi']?> '</p>
                  <hr>
                  <ul class="media-list media-list-feed " >
                    <!-- end header line-->
                  <?php elseif($namaTopik != $key['namaTopik']) : ?>
                    <!-- END body line -->
                  </ul>
                  <br>
                  <div class="tags" style="margin-left: 20px;">
                  <i class="fa fa-graduation-cap text-theme-color-4 ml10"><b>Tingkat :</b> <?=$key['tingkat']?> | </i>
                  <i class="fa fa-tags text-theme-color-4 ml10"><b>Mata Pelajaran :</b> <?=$key['mapel']?> | </i>
                  <i class="fa fa-tags text-theme-color-4 ml10"><b>Bab :</b> <?=$key['bab']?> | </i>
                  </div>

                </div>
                

              </article>
              <hr>
              
              <div class="blog-post single-post" id="topik<?=$noTopik;?>">
                <?php $noTopik++; ?>
                <article class="post clearfix mb-0">

                  <div class="entry-content">
                    <div class="entry-meta media no-bg no-border mt-15 pb-20"> 
                      <div class="entry-date media-left text-center flip bg-theme-colored pt-5 pr-15 pb-5 pl-15">
                        <ul>
                          <li class="font-12 text-white font-weight-600"><i class="fa fa-comment"></i>Topik</li>
                        </ul>
                      </div>                
                      <div class="media-body pl-15">
                        <div class="event-content pull-left flip">
                          <h3 class="entry-title pt-0 mt-0 ">Nama Topik : <?=$key['namaTopik']?></h3>
                        </div>
                      </div>
                    </div>
                    <p style="padding-left: 15px;">Deskripsi:' <?=$key['deskripsi']?> '</p>
                    <hr>
                    <ul class="media-list media-list-feed " >
                      <!-- end header line-->
                    <?php endif ?>
                    <li for class="media">
                     <div class="media-object pull-left " >
                      <i  class="<?=$key['icon']?> " id="ico-<?=$i;?>"></i>
                      
                    </div>
                    <div class="media-body">

                      <!-- Untuk menampung staus step disable or enable -->
                      <input type="text" id="status-<?=$i;?>" value="<?=$key["status"];?>" hidden="true">
                      <?php 
                      $v = $key['icon'];
                      $u=$key['uuid'];
                      $a ='as';
                      ?>
                      
                      <?php if ($key['icon'] == "ico-play3" ): ?>
                        <a onclick="getvideo('<?=$u;?>')" href="javascript:void(0);" class="media-heading" id="font-<?=$i;?>" style="padding-left: 20px;"><?=$key['namaStep']?></a>
                      <?php elseif ($key['icon'] == "ico-folder" ): ?>
                        <a onclick="getmateri('<?=$u;?>')" href="javascript:void(0);" class="media-heading" id="font-<?=$i;?>" style="padding-left: 20px;"><?=$key['namaStep']?></a>
                      <?php else: ?>
                        <!-- // Untuk menampung staus step disable or enable  -->
                        <a  href="<?=$key['link'];?>" class="media-heading" id="font-<?=$i;?>" style="padding-left:  20px;"><?=$key['namaStep']?></a> 
                      <?php endif ?>
                    </div>
                  </li> 
                  <!-- </a>       -->
                  <?php $i++;  ?>
                  <?php  $namaTopik=$key['namaTopik'];  ?>
                  

                  
                <?php endforeach ?>
                
              </ul>
              <br>
              <input id="n" type="text"  value="<?=$i;?>" hidden="true">
              <?php if ($datline!= array()): ?>
                <div class="tags" style="margin-left: 20px;">
                  <i class="fa fa-graduation-cap text-theme-color-4 ml10"><b>Tingkat :</b> <?=$key['tingkat']?> | </i>
                  <i class="fa fa-tags text-theme-color-4 ml10"><b>Mata Pelajaran :</b> <?=$key['mapel']?> | </i>
                  <i class="fa fa-tags text-theme-color-4 ml10"><b>Bab :</b> <?=$key['bab']?> | </i>
                </div>
              </div>
            </article>
            
            <hr class="divider-color" />
          <?php else: ?>
            <div class="container-404">
              <div class="font-200 line-height-1em mt-0 mb-0 text-theme-color-2 text-center">U<span>P</span>S!</div>
              <h2 class="mt-0 text-center" ><span>Maaf:(</span>
              </h2>
              <h2 class="mt-0 text-center" >Step Line Belum Tersedia.</h2>
              
            </div>
          <?php endif ?>
          <div class="tagline p-0 pt-20 mt-5">
            <div class="row">
              <div class="col-md-8">

              </div>
              
            </div>
          </div>              
        </div>
      </div>
    </section>

    <script type="text/javascript">
      $(document).ready(function() { 
        var n = $("#n").val();
        for (i = 0; i < n; i++) {
          var status = $("#status-"+i).val();
          
          if (status=="disable") {
           $("#ico-"+i).css("background","#b0b0b0");
           $("#font-"+i).css("color","#b0b0b0");
         } 
         
       }
     });
   </script>


   <script type="text/javascript">
    function getvideo(uuid) {
      // uuid =$('input[name=uuid]').val();
      // console.log(uuid);
      url_ajax = base_url+"linetopik/tampunguuid";

      var global_properties = {
        uuid: uuid
      };

      $.ajax({
        type: "POST",
        dataType: "JSON",
        url: url_ajax,
        data: global_properties,
        success: function(data){
          window.location.href = base_url + "linetopik/step_video";  
        },error:function(data){
          sweetAlert("Oops...", "wah, gagal menghubungkan!", "error");
        }

      });
    }

    function getmateri(uuid) {
      url_ajax = base_url+"linetopik/tampunguuid";

      var global_properties = {
        uuid: uuid
      };

      $.ajax({
        type: "POST",
        dataType: "JSON",
        url: url_ajax,
        data: global_properties,
        success: function(data){
          window.location.href = base_url + "linetopik/step_materi";  
        },error:function(data){
          sweetAlert("Oops...", "wah, gagal menghubungkan!", "error");
        }

      });
    }
    
  </script>

