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
          <div class="col-md-9 blog-pull-right">
            <div class="blog-posts single-post">
            <?php foreach ($detartikel as $key): ?>
              
            
              <article class="post clearfix mb-0">
                <div class="entry-header">
                  <div class="post-thumb thumb"> <img src="<?= base_url('./assets/image/artikel/'. $key['gambar']) ?>" style="height: 600px; width: 450px;" alt="" class="img-responsive img-fullwidth"> </div>
                </div>
                <div class="entry-content">
                  <div class="entry-meta media no-bg no-border mt-15 pb-20">
                    <div class="entry-date media-left text-center flip bg-theme-colored pt-5 pr-15 pb-5 pl-15">
                      <ul>
                      </ul>
                    </div>
                    <div class="media-body pl-15">
                      <div class="event-content pull-left flip">
                        <h3 class="entry-title text-white text-uppercase pt-0 mt-0"><a href="blog-single-right-sidebar.html"><?=$key['judul_artikel'] ?></a></h3>
                        
                      </div>
                    </div>
                  </div>
                  <p class="mb-15"><?=$key['isi_artikel'] ?></p>
                  
                  
              </article>
              <?php endforeach ?>
              
              
            
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