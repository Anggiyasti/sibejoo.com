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
            <h1>Wil 1</h1>
             <div class="row">
              <?php foreach ($data as $key): ?>
                <div class="col-sm-6 col-md-4">
                  <!-- <div class="service-block bg-white"> -->
                    <!-- <div class="content text-left flip p-25 pt-0"> -->
                      <h4 class="line-bottom mb-5"><?=$key['universitas'] ?></h4>
                     <!-- <a class="btn btn-dark btn-theme-colored btn-sm text-uppercase mt-10" href="javascript:void(0);" onclick="getuniv('<?=$key['universitas'] ?>')">Lihat Prodi</a> -->
                    <!-- </div> -->
                  <!-- </div> -->
                </div>
                <?php endforeach ?>
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
                  <form method="get" class="search-form" action="<?=base_url()?>index.php/passinggradefront/cariuniv"  accept-charset="utf-8" enctype="multipart/form-data">
                    <div class="input-group">
                      <input type="search" class="form-control search-input" placeholder="Cari Prodi"  name="keycari" title="Search for:" id="cariuniv">
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
              <div class="widget">
                <h5 class="widget-title line-bottom">Passing Grade</h5>
                <div class="categories">
                  <ul class="list list-border angle-double-right">
                    <?php for ($i=21; $i <=  81  ; $i+=5) : ?>
                      <li><a href="javascript:void(0);" onclick="pass_grade(<?=$i;?>,<?=$i+4;?>)"><?=$i;?>% - <?=$i+4;?>%</a></li>
                    <?php endfor ?>
                  </ul>
                </div>
              </div>
             
              
            </div>
          </div>
        </div>
        
      </div>
    </section>


  <script type="text/javascript">
    
    function getuniv(univ) {
    url_ajax = base_url+"passinggradefront/tampunguniv";

    var global_properties = {
      univ: univ
    };

    $.ajax({
      type: "POST",
      dataType: "JSON",
      url: url_ajax,
      data: global_properties,
      success: function(data){
        window.location.href = base_url + "passinggradefront/passinggrade_prodi";  
      },error:function(data){
        sweetAlert("Oops...", "wah, gagal menghubungkan!", "error");
      }

    });
  }

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