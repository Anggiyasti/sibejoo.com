 <!-- TITLE -->
<section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="http://placehold.it/1920x1280" style="background-image: url(&quot;http://placehold.it/1920x1280&quot;); background-position: 50% 99px;">
  <div class="container pt-70 pb-20">
    <!-- Section Content -->
    <div class="section-content">
      <div class="row">
        <div class="col-md-12">
          <h1 class="text-center text-white">{judul_header}</h1>
        </div>
      </div>
    </div>
  </div>      
</section>
<!-- TITLE -->

 <section>
   
      <div class="container">
        <div class="row">
          <div class="col-md-9 blog-pull-right">
             <div class="row">
              <?php echo $this->session->flashdata('msg'); ?>
              <?php foreach ($data as $key): ?>
                <div class="col-sm-6 col-md-4">
                  <div class="service-block bg-white">
                    <div class="thumb"> 
                    <h4 class="text-white mt-0 mb-0"><span class="price">$125</span></h4>
                    </div>
                    <div class="content text-left flip p-25 pt-0">
                      <h4 class="line-bottom mb-5" style="height: 100px;"><?=$key['prodi'] ?></h4>
                      <p>Passing Grade: <?=$key['passinggrade'] ?>%</p>
                     <!-- <a class="btn btn-dark btn-theme-colored btn-sm text-uppercase mt-10" href="<?=base_url()?>index.php/passinggradefront/ubahprofilesiswa/<?=$key['prodi']?>/<?=$key['universitas']?>">Set Prodi</a> -->
                    </div>
                  </div>
                </div>
                <?php endforeach ?>
             </div>
          </div>
          
          <div class="col-sm-12 col-md-3">
            <div class="sidebar sidebar-left mt-sm-30">
              <div class="widget">
                <h5 class="widget-title line-bottom">Search Prodi</h5>
                <div class="search-form">
                  <form method="get" class="search-form" action="<?=base_url()?>index.php/passinggradefront/cariprodi"  accept-charset="utf-8" enctype="multipart/form-data">
                    <div class="input-group">
                    <div class="input-group">
                      <input type="search" class="form-control search-input" placeholder="Search"  name="keycari" title="Search for:" id="cariprodi">
                      <span class="input-group-btn">
                      <button type="submit" class="btn search-button"><i class="fa fa-search"></i></button>
                      </span>
                    </div>
                  </form>
                </div>
              </div>
              <div class="widget">
                <h5 class="widget-title line-bottom">Pilih Wilayah</h5>
                <div class="categories">
                  <ul class="list list-border angle-double-right">
                    <li><a href="javascript:void(0);" onclick="pilihwilayah(1)">Wilayah 1</a></li>
                    <li><a href="javascript:void(0);" onclick="pilihwilayah(2)">Wilayah 2</a></li>
                    <li><a href="javascript:void(0);" onclick="pilihwilayah(3)">Wilayah 3</a></li>
                    <li><a href="javascript:void(0);" onclick="pilihwilayah(4)">Wilayah 4</a></li>
                  </ul>
                </div>
              </div>
             
              
            </div>
          </div>
        </div>
        
      </div>
    </section>
  </div>


  <script type="text/javascript">
    
    function pilihwilayah(wilayah) {
    url_ajax = base_url+"passinggradefront/pilwilayah";

    var global_properties = {
      wilayah: wilayah
    };

    $.ajax({
      type: "POST",
      dataType: "JSON",
      url: url_ajax,
      data: global_properties,
      success: function(data){
        window.location.href = base_url + "passinggradefront/passinggrade_univ_wil";  
      },error:function(data){
        sweetAlert("Oops...", "wah, gagal menghubungkan!", "error");
      }

    });
  }
    
  </script>