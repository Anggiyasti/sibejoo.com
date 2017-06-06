  <!-- Start main-content -->
  <div class="main-content" >
    <!-- Section: inner-header -->
    <section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="http://placehold.it/1920x1280">
      <div class="container pt-70 pb-20">
        <!-- Section Content -->
        <div class="section-content">
          <div class="row">
            <div class="col-md-12">
              <h2 class="title text-white">{judul_header2}</h2>
              <ol class="breadcrumb text-left text-black mt-10">
                <li><a href="#">Home</a></li>
                <li><a href="#">Pages</a></li>
                <li class="active text-gray-silver">Page Title</li>
              </ol>
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
                  <form>
                    <div class="input-group">
                      <input type="text" placeholder="Click to Search" class="form-control search-input">
                      <span class="input-group-btn">
                      <button type="submit" class="btn search-button"><i class="fa fa-search"></i></button>
                      </span>
                    </div>
                  </form>
                </div>
              </div>
              <div class="widget">
                <h5 class="widget-title line-bottom"><a href="<?=base_url('index.php/linetopik/timeLine/').$topikUUID?>"><?= $datVideo['namaTopik']; ?></h5>
                <!-- <div class="categories">
                  <ul class="list list-border angle-double-right">
                    <li><a href="#">Creative<span>(19)</span></a></li>
                    <li><a href="#">Portfolio<span>(21)</span></a></li>
                    <li><a href="#">Fitness<span>(15)</span></a></li>
                    <li><a href="#">Gym<span>(35)</span></a></li>
                    <li><a href="#">Personal<span>(16)</span></a></li>
                  </ul>
                </div> -->
                <!-- Step line side bar -->
                <ul class="media-list media-list-feed  grid-col-3" >
                  <?php 
                  $i=0;
                  foreach ($datline as $key ):           
                    ?>
                  <li  class="media" id="bg-<?=$i;?>">
                   <div class="media-object pull-left ">
                    <i href="<?=$key['link'];?>"  class="<?=$key['icon']?> " id="ico-<?=$i;?>"></i>
                  </div>
                  <div class="media-body" >
                    <!-- Untuk menampung staus step disable or enable -->
                    <input type="text" id="status-<?=$i;?>" value="<?=$key["status"];?>" hidden="true">
                    <!-- // Untuk menampung staus step disable or enable  -->
                    <a href="<?=$key['link'];?>" class="media-heading headline"  id="font-<?=$i;?>" ><?=$key['namaStep']?></a>
                  </div>
                  <!-- <hr> -->
                </li>
                <?php 
                $i ++;
                endforeach ?>
              </ul>
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
                <div class="entry-content mt-10"  style="background:red;">
                  <!-- video -->
                  <div class="post-thumb thumb">
                    <div class="video-player">
                    <iframe  width="600" height="360" src="<?=$datVideo['link']?>"></iframe> 
                    </div>


                  </div>

                  <div class="mt-30 mb-0">
                    <h5 class="pull-left mt-10 mr-20 text-theme-color-2">Share:</h5>
                    <ul class="styled-icons icon-circled m-0">
                      <li><a href="#" data-bg-color="#3A5795"><i class="fa fa-facebook text-white"></i></a></li>
                      <li><a href="#" data-bg-color="#55ACEE"><i class="fa fa-twitter text-white"></i></a></li>
                      <li><a href="#" data-bg-color="#A11312"><i class="fa fa-google-plus text-white"></i></a></li>
                    </ul>
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

<!-- JQ untuk autocomplate search topik -->
<script type="text/javascript">

  $(document).ready(function() { 
    var site = "<?php echo site_url();?>";
    $( "#caritopik" ).autocomplete({
        source:  site+"/linetopik/autocompleteTopik",
        select: function (event, ui) {
                window.location = ui.item.url;
                }
    });

});
</script>