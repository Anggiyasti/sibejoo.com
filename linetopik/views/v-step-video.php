  <link rel="stylesheet" href="<?= base_url('assets/css/custom-time-line.css') ?>"/>
  <!-- Start main-content -->
  <div class="main-content" >
    <!-- Section: inner-header -->
    <section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="http://placehold.it/1920x1280">
      <div class="container pt-70 pb-20">
        <!-- Section Content -->
        <div class="section-content">
          <div class="row">
            <div class="col-md-12">
              <h1 class="text-center text-white">{judul_header2}</h1>
            
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Section: Blog -->
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
                      <input type="search" name="keycari" placeholder="Search" class="form-control search-input" id="caritopik">
                      <span class="input-group-btn">
                      <button type="submit" class="btn search-button"><i class="fa fa-search"></i></button>
                      </span>
                    </div>
                  </form>
                </div>
              </div>
              <div class="widget">
                <h2 ><a href="<?=base_url('index.php/linetopik/timeLine/').$topikUUID?>"><?= $datVideo['namaTopik']; ?></a></h2> 
                <hr class="divider-big">
                            <!-- Start Time Line -->
                            <ul class="media-list media-list-feed grid-col-3" >
                            <?php $i=0; ?>
                            <?php foreach ($datline as $key ): ?>
                                <li class="media" id="bg-<?=$i;?>">
                                     <div class="media-object pull-left ">
                                        <a href="<?=$key['link'];?>"  class="<?=$key['icon']?> " id="ico-<?=$i;?>"></a>
                                    </div>
                                    <div class="media-body">
                                    <!-- Untuk menampung staus step disable or enable -->
                                     <input type="text" id="status-<?=$i;?>" value="<?=$key["status"];?>" hidden="true">
                                     <!-- // Untuk menampung staus step disable or enable  -->
                                        <a href="<?=$key['link'];?>" class="media-heading" id="font-<?=$i;?>" style="padding-left:20px;"><?=$key['namaStep']?></a>
                                    </div>
                                </li>
                            <?php $i++; ?>
                            <?php endforeach ?>
                            </ul>
                            <!-- menampung nilai panjang array -->
                            <input id="n" type="text"  value="<?=$i;?>" hidden="true">
                <!--Step line side bar  -->
              </div>
            </div>
          </div>
          <!-- div isi materi -->
                    <div class="col-md-9 blog-pull-right">
            <div class="blog-posts single-post">
              <article class="post clearfix mb-0">
                <div class="entry-header">
             
                </div>  
                <div class="entry-title pt-10 pl-15">
                  <h4><a class="text-uppercase" href="#"> <?=$datVideo['judulVideo']?> </a></h4>
                </div>
                <div class="entry-meta pl-15">
                  <ul class="list-inline">
                    <li>Posted: <span class="text-theme-color-2"> <?= $datVideo['date_created']; ?></span></li>
                    <li>By: <span class="text-theme-color-2">Admin</span></li>
                    <li><i class="fa fa-comments-o ml-5 mr-5"></i> Step Video</li>
                  </ul>
                </div>
                <div class="entry-content mt-10">
                  <!-- video -->
                  <div class="post-thumb thumb">
                    <div class="video-player">
                    <iframe  width="600" height="360" src="<?=$datVideo['link']?>"></iframe> 
                    </div>


                  </div>
                  <h3>Deskripsi</h3>
            <p><?=$datVideo['deskripsiVideo']?></p>

                  <div class="mt-30 mb-0">
                    
                    <div class="tags">
                      <p class="mb-0"> 
                      <a href="#"><i class="fa fa-tags text-theme-color-2"></i><span><?=$tingkat;?>|</span></a> 
                      <a href="#"><i class="fa fa-tags text-theme-color-2"></i><?=$mapel;?>|</a> 
                      <a href="#"><i class="fa fa-tags text-theme-color-2"></i><?=$bab;?>|</a>
                      <a href="#"><i class="fa fa-tags text-theme-color-2"></i>Topik : <?=$topik;?></a>  
                      </p>
                    </div>
                  </div>
                </div>
              </article>


            </div>
          </div>
          <!-- / div isi materi -->
        </div>
      </div>
    </section>
  </div>
  <!-- end main-content -->

  <!-- JQ UNTUK RUBAH STYLE CSS STEPLINE BY MrBebek-->
<script type="text/javascript">
  $(document).ready(function() { 
      var n = $("#n").val();
      for (i = 0; i < n; i++) {
      var status = $("#status-"+i).val();
          // cek status disable
      if (status=="disable") {
        // jika status disable
        $("#ico-"+i).css("background","#b0b0b0");
        $("#font-"+i).css("color","#b0b0b0");
      }else if(status =="current"){
        // jika step line yg sedang di buka
        $("#ico-"+i).css("background","#D26161");
        $("#font-"+i).css("color","#D26161");
        $("#bg-"+i).css({ "background-color":"","box-shadow": "inset 0 0 0 1px #E4E4E4,inset 0 1px 6px #E6E6E6"});
      }
         
      }
  });
</script>
