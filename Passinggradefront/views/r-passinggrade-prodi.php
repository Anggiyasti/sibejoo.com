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
              <?php 
              if ($data==array()) : ?>
              <h5 class="text-center">Not Found.</h5>
              <?php else: ?>
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
                <?php endforeach;
                  endif;
                 ?>
             </div>
          </div>
          
          <div class="col-sm-12 col-md-3">
            <div class="sidebar sidebar-left mt-sm-30">
              <div class="widget">
                <h5 class="widget-title line-bottom">Cari Universitas</h5>
                <div class="search-form">
                  <form method="get" class="search-form" action="<?=base_url()?>index.php/passinggradefront/cariuniv"  accept-charset="utf-8" enctype="multipart/form-data">
                    <div class="input-group">
                      <input type="search" class="form-control search-input" placeholder="Cari Universitas"  name="keycari" title="Search for:" id="cariuniv">
                      <span class="input-group-btn">
                      <button type="submit" class="btn search-button"><i class="fa fa-search"></i></button>
                      </span>
                    </div>
                  </form>
                </div>
              </div>
              <div class="widget">
                <h5 class="widget-title line-bottom">Cari Prodi</h5>
                <div class="search-form">
                  <form method="get" class="search-form" action="<?=base_url()?>index.php/passinggradefront/cariprodi"  accept-charset="utf-8" enctype="multipart/form-data">
                    <div class="input-group">
                    <div class="input-group">
                      <input type="search" class="form-control search-input" placeholder="Cari Prodi"  name="keycari" title="Search for:" id="cariprodi">
                      <span class="input-group-btn">
                      <button type="submit" class="btn search-button"><i class="fa fa-search"></i></button>
                      </span>
                    </div>
                  </form>
                </div>
              </div>
              <div class="widget">
                <h5 class="widget-title line-bottom">ListPassing Grade</h5>
                <div class="categories">
                  <ul class="list list-border angle-double-right">
                    <?php for ($i=20; $i <=  55  ; $i+=5) : ?>
                      <li><a href="javascript:void(0);" onclick="pass_grade(<?=$i;?>,<?=$i+5;?>)"><?=$i;?>% - <?=$i+5;?>%</a></li>
                    <?php endfor ?>
                    <li><a href="javascript:void(0);" onclick="pass_grade(60,100)">>60%</a></li>
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
        window.location.href = base_url + "passinggradefront/passinggrade_univ";  
      },error:function(data){
        sweetAlert("Oops...", "wah, gagal menghubungkan!", "error");
      }

    });
  }

  function pass_grade(grade1, grade2) {
    var url_ajax = base_url+"passinggradefront/passgrade";
    var datas = {
                  awal:grade1, 
                  akhir:grade2
                };

    $.ajax({
      type: "POST",
      dataType: "JSON",
      url: url_ajax,
      data: datas,
      success: function(data){
        window.location.href = base_url + "passinggradefront/grade";  
      },error:function(data){
      }

    });
  }
    
  </script>