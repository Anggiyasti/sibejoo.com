<!-- Start main-content -->
<div class="main-content">
  <!-- Section: inner-header -->
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
  <!-- Section: Blog -->
  <section>
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-md-3">
          <div class="sidebar sidebar-left mt-sm-30">
            <div class="widget">
              <h5 class="widget-title line-bottom">Artikel Lain</h5>
              <div class="latest-posts">
                <?php foreach ($listheroo as $key): ?>
                  <article class="post media-post clearfix pb-0 mb-10">
                    <a class="post-thumb" href="javascript:void(0);" onclick="detailArtikel(<?=$key['id_art'] ?>)">
                      <!-- <img src="http://placehold.it/75x75" style="height: 75px; width: 75px;" alt=""> -->
                      <img src="<?= base_url('./assets/image/reportheroo/'. $key['gambar']) ?>" style="height: 75px; width: 75px;" alt="">
                    </a>
                    <div class="post-right">
                      <h5 class="post-title mt-0"><a href="javascript:void(0);" onclick="detailArtikel(<?=$key['id_art'] ?>)"><b><?=$key['judul_art_katagori'] ?></b></a></h5>
                      <p><?php $c = $key['isi_art_kategori']; echo substr($c, 0, 20) ?>...</p>
                    </div>
                  </article>
                  
                <?php endforeach ?>
              </div>
            </div>

          </div>

        </div>


        <div class="container mb-30 pb-30">

          <div class="row">
            <div class="col-md-9">
              <div class="portfolio-filter font-alt align-center">
                <div class="btn-group" data-toggle="buttons" > 
<label class="btn cws-button btn btn-default small" onclick="semua()"> 
                  <input type="radio" name="options"  autocomplete="off" checked="true" title="Tampilkan Semua Jenis Video"> Semua
                </label>

                 <label class="btn cws-button btn btn-default small" onclick="pass()"> 
                  <input type="radio" name="options"  autocomplete="off" checked="true" title="Tampilkan Semua Jenis Video"> Past
                </label>

                <label class="btn cws-button btn btn-default small" title="Tampilkan Jenis Video Room" onclick="now()"> 
                  <input type="radio" name="options" autocomplete="off" class="form-control"> Now
                </label> 

                <label class="btn cws-button btn btn-default  small"  title="Tampilkan Jenis Video Screen" onclick="soon()"> 
                  <input type="radio" name="options" autocomplete="off" class="form-control"> Soon
                </label> 

              </div>
            </div>
            <div class="blog-posts">
              <div class="col-md-12">
                <div class="row list-dashed">
                  <?php foreach ($allreportheroo as $key): ?>
                    <?php if ($key['id_kategori'] == 1): ?>
                      <article class="post clearfix mb-30 pb-30 pass" >
                        <div class="entry-header">
                          <div class="post-thumb thumb"> 

                          </div>
                        </div>
                        <div class="entry-content border-1px p-20 pr-10">
                          <img src="<?= base_url('./assets/image/reportheroo/'. $key['gambar']) ?>" alt="" class="img-responsive"> <br>
                          <div class="entry-meta media mt-0 no-bg no-border">
                            <div class="entry-date media-left text-center flip bg-theme-colored pt-5 pr-15 pb-5 pl-15">
                              <ul title="Dibuat Pada : <?=date('M - d - Y', strtotime($key['date_created'])) ?>">
                                <li class="font-16 text-white font-weight-600 border-bottom"><?=date('d', strtotime($key['date_created'])) ?></li>
                                <li class="font-12 text-white text-uppercase"><?=date('M', strtotime($key['date_created'])) ?></li>

                              </ul>
                            </div>
                            <div class="media-body pl-5">
                              <div class="event-content pull-left flip">
                                <h4 class="entry-title text-white text-uppercase m-0 mt-5"><a href="blog-single-right-sidebar.html"><?=$key['judul_art_katagori'] ?></a></h4>
                                <b></b><span class="mb-10  mr-10 font-13"><?=$key['nama_kategori'] ?>  </span></b>

                              </div>
                            </div>
                          </div>
                          <p class="mt-10"><?=$key['isi_art_kategori'] ?></p>

                          <div class="clearfix"></div>
                        </div>
                      </article>
                    <?php elseif ($key['id_kategori'] == 2): ?>

                      <article class="post clearfix mb-30 pb-30 now">
                        <div class="entry-header">
                          <div class="post-thumb thumb"> 

                          </div>
                        </div>
                        <div class="entry-content border-1px p-20 pr-10">
                          <img src="<?= base_url('./assets/image/reportheroo/'. $key['gambar']) ?>" alt="" class="img-responsive"> <br>
                          <div class="entry-meta media mt-0 no-bg no-border">
                            <div class="entry-date media-left text-center flip bg-theme-colored pt-5 pr-15 pb-5 pl-15">
                              <ul title="Dibuat Pada : <?=date('M - d - Y', strtotime($key['date_created'])) ?>">
                                <li class="font-16 text-white font-weight-600 border-bottom"><?=date('d', strtotime($key['date_created'])) ?></li>
                                <li class="font-12 text-white text-uppercase"><?=date('M', strtotime($key['date_created'])) ?></li>

                              </ul>
                            </div>
                            <div class="media-body pl-5">
                              <div class="event-content pull-left flip">
                                <h4 class="entry-title text-white text-uppercase m-0 mt-5"><a href="blog-single-right-sidebar.html"><?=$key['judul_art_katagori'] ?></a></h4>
                                <b></b><span class="mb-10  mr-10 font-13"><?=$key['nama_kategori'] ?>  </span></b>

                              </div>
                            </div>
                          </div>
                          <p class="mt-10"><?=$key['isi_art_kategori'] ?></p>

                          <div class="clearfix"></div>
                        </div>
                      </article>
                    <?php elseif ($key['id_kategori'] == 3): ?>

                      <article class="post clearfix mb-30 pb-30 soon ">
                        <div class="entry-header">
                          <div class="post-thumb thumb"> 

                          </div>
                        </div>
                        <div class="entry-content border-1px p-20 pr-10">
                          <img src="<?= base_url('./assets/image/reportheroo/'. $key['gambar']) ?>" alt="" class="img-responsive img-fullwidth"> <br>
                          <div class="entry-meta media mt-0 no-bg no-border">
                            <div class="entry-date media-left text-center flip bg-theme-colored pt-5 pr-15 pb-5 pl-15">
                              <ul title="Dibuat Pada : <?=date('M - d - Y', strtotime($key['date_created'])) ?>">
                                <li class="font-16 text-white font-weight-600 border-bottom"><?=date('d', strtotime($key['date_created'])) ?></li>
                                <li class="font-12 text-white text-uppercase"><?=date('M', strtotime($key['date_created'])) ?></li>

                              </ul>
                            </div>
                            <div class="media-body pl-5">
                              <div class="event-content pull-left flip">
                                <h4 class="entry-title text-white text-uppercase m-0 mt-5"><a href="blog-single-right-sidebar.html"><?=$key['judul_art_katagori'] ?></a></h4>
                                <b></b><span class="mb-10  mr-10 font-13"><?=$key['nama_kategori'] ?>  </span></b>

                              </div>
                            </div>
                          </div>
                          <p class="mt-10"><?=$key['isi_art_kategori'] ?></p>

                          <div class="clearfix"></div>
                        </div>
                      </article>

                    <?php endif ?>
                    

                  <?php endforeach ?>
                  <nav>
                    <center>
                      <ul class="pagination">
                        <li>
                          <a href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                          </a>
                        </li>
                        <li><?php echo $links; ?></li>
                        <li>
                          <a href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                          </a>
                        </li>
                      </ul>
                    </center>
                  </nav>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section> 
  </div>
  <!-- end main-content -->

  <script type="text/javascript">
    function detailArtikel(id_artikel) {
      url_ajax = base_url+"homepage/ambilid";

      var global_properties = {
        id_artikel: id_artikel
      };

      $.ajax({
        type: "POST",
        dataType: "JSON",
        url: url_ajax,
        data: global_properties,
        success: function(data){
          window.location.href = base_url + "homepage/detail_artikel";  
        },error:function(data){
          sweetAlert("Oops...", "wah, gagal menghubungkan!", "error");
        }

      });
    }


    function now(){
      $('.now').show("slow");
      $('.pass').hide("slow");
      $('.soon').hide("slow");
    }

    function soon(){
      $('.soon').show("slow");
      $('.pass').hide("slow");
      $('.now').hide("slow");

    }

    function pass(){
      $('.pass').show("slow");
      $('.now').hide("slow");
      $('.soon').hide("slow");
    }
    

    function semua(){
      $('.pass').show("slow");
      $('.now').show("slow");
      $('.soon').show("slow");
    }
    
  </script>