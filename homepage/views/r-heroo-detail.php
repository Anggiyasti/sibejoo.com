<!-- Start Script Matjax -->
<script type="text/x-mathjax-config">
 MathJax.Hub.Config({
 showProcessingMessages: false,
 tex2jax: { inlineMath: [['$','$'],['\\(','\\)']] }
});
</script>
<script type="text/javascript" src="<?= base_url('assets/plugins/MathJax-master/MathJax.js?config=TeX-MML-AM_HTMLorMML') ?>"></script>
  <!-- Start main-content -->
  <div class="main-content">
    <!-- Section: inner-header -->
    <section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="">
      <div class="container pt-60 pb-60" style="background-image: url('http://essentialappmarketing.com/wp-content/uploads/2016/09/PR-MEDIA-OUTREACH.jpg');background-position: bottom; width: 100%;">
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
                <h5 class="widget-title line-bottom">Report Heroo Lain</h5>
                <div class="latest-posts">
                  <?php foreach ($listheroo as $key): ?>
                    <article class="post media-post clearfix pb-0 mb-10">
                      <a class="post-thumb" href="javascript:void(0);" onclick="detailArtikel(<?=$key['id_art'] ?>)"><img src="<?= base_url('./assets/image/reportheroo/'. $key['gambar']) ?>" style="height: 75px; width: 75px;" alt=""></a>
                      <div class="post-right">
                        <h5 class="post-title mt-0"><a href="javascript:void(0);" onclick="detailArtikel(<?=$key['id_art'] ?>)"><b><?=$key['judul_art_katagori'] ?></b></a></h5>
                      </div>
                    </article>
                    
                  <?php endforeach ?>
                </div>
              </div>

            </div>

          </div>
          <div class="col-md-9 blog-pull-right">
            <div class="blog-posts single-post">
              <?php foreach ($detheroo as $key): ?>


                <article class="post clearfix mb-0">
                  <div class="entry-header">
                    <?php if (!$key['gambar']==""): ?>
                      <div class="post-thumb thumb"> <img src="<?= base_url('./assets/image/reportheroo/'. $key['gambar']) ?>" alt="" class="img-responsive img-fullwidth" style="margin: 0 auto;"> </div>
                    <?php endif ?>

                  </div>
                  <div class="entry-content">
                    <div class="entry-meta media no-bg no-border mt-15 pb-20">
                      <div class="entry-date media-left text-center flip bg-theme-colored pt-5 pr-15 pb-5 pl-15">
                        <ul>
                          <li class="font-16 text-white font-weight-600 border-bottom"><?=date('d', strtotime($key['date_created'])) ?></li>
                          <li class="font-12 text-white text-uppercase"><?=date('M', strtotime($key['date_created'])) ?></li>
                        </ul>
                      </div>
                      <div class="media-body pl-15">
                        <div class="event-content pull-left flip">
                          <h3 class="entry-title text-black text-uppercase pt-0 mt-0"><?=$key['judul_art_katagori'] ?></a></h3>
                          <h5 class="entry-title text-black text-uppercase pt-0 mt-0"><?=$key['nama_kategori'] ?></h5>

                        </div>
                      </div>
                    </div>
                    <p class="mb-15"><?=$key['isi_art_kategori'] ?></p>


                  </article>
                  <div class="separator separator-small-line separator-rouned">
                    <i class="fa fa-pencil"></i>
                  </div>

                <?php endforeach ?>
              </div>
            </div>

          </div>
        </div>
      </section>
    </div>
    <!-- end main-content -->

    <script type="text/javascript">
      function detailArtikel(id_report) {
        url_ajax = base_url+"homepage/create_id_report_session";

        var global_properties = {
          id_report: id_report
        };

        $.ajax({
          type: "POST",
          dataType: "JSON",
          url: url_ajax,
          data: global_properties,
          success: function(data){
            window.location.href = base_url + "homepage/detail_report";  
          },error:function(data){
            sweetAlert("Oops...", "wah, gagal menghubungkan!", "error");
          }

        });
      }

    </script>