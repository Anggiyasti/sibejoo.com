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
                <?php foreach ($listart as $key): ?>
                  <article class="post media-post clearfix pb-0 mb-10">
                    <a class="post-thumb" href="javascript:void(0);" onclick="detailArtikel(<?=$key['id_artikel'] ?>)"><img src="<?= base_url('./assets/image/artikel/'. $key['gambar']) ?>" style="height: 75px; width: 75px;" alt=""></a>
                    <div class="post-right">
                      <h5 class="post-title mt-0"><a href="javascript:void(0);" onclick="detailArtikel(<?=$key['id_artikel'] ?>)"><b><?=$key['judul_artikel'] ?></b></a></h5>
                      <p><?php $c = $key['isi_artikel']; echo substr($c, 0, 30) ?>...</p>
                    </div>
                  </article>
                  
                  <?php endforeach ?>
                </div>
              </div>
              
            </div>
            
          </div>
          

      <div class="container mt-30 mb-30 pt-30 pb-30">
        <div class="row">
          <div class="col-md-9">
            <div class="blog-posts">
              <div class="col-md-12">
                <div class="row list-dashed">
                <?php foreach ($allartikel as $key): ?>
                  <article class="post clearfix mb-30 pb-30">
                    <div class="entry-header">
                      <div class="post-thumb thumb"> 
                        
                      </div>
                    </div>
                    <div class="entry-content border-1px p-20 pr-10">
                    <img src="<?= base_url('./assets/image/artikel/'. $key['gambar']) ?>" style="height: 600px; width: 450px;" alt="" class="img-responsive img-fullwidth"> <br>
                      <div class="entry-meta media mt-0 no-bg no-border">
                        <div class="entry-date media-left text-center flip bg-theme-colored pt-5 pr-15 pb-5 pl-15">
                          
                        </div>
                        <div class="media-body pl-15">
                          <div class="event-content pull-left flip">
                            <h4 class="entry-title text-white text-uppercase m-0 mt-5"><a href="blog-single-right-sidebar.html"><?=$key['judul_artikel'] ?></a></h4>
                            <span class="mb-10 text-gray-darkgray mr-10 font-13"></span>      
                            
                          </div>
                        </div>
                      </div>
                      <p class="mt-10"><?=$key['isi_artikel'] ?></p>

                      <div class="clearfix"></div>
                    </div>
                  </article>
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
    
</script>