<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
<link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet"></link>

<style type="text/css">
  a, button {
      cursor: pointer;
  }
</style>


<!-- TITLE -->
<section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="http://www.adtaxi.com/wp-content/uploads/2016/10/shutterstock_365048603.jpg" style="background-image: url(&quot;http://placehold.it/1920x1280&quot;); background-position: 50% 99px;">
  <div class="container pt-70 pb-20">
    <!-- Section Content -->
    <div class="section-content">
      <div class="row">
          <div class="col-md-12 ">
            <h2 class="title text-black text-center"><img src="<?=base_url('assets/image/menu/.png') ?>"></h2>
            <h1 class="text-center text-white"><b>{judul_header}</b></h1><br><br><br><br>
          </div>
      </div>
    </div>
  </div>      
</section>
<!-- TITLE -->

<section>
  <div class="container">
    <div class="section-content">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 pb-sm-20 mb10">
                <?php if ($this->session->userdata('HAKAKSES')=='siswa'): ?>
              <!-- MENU UNTUK SISWA -->
                    <form class="form-group" action="javascript:void(0)">
                      <h4><b>Filter Pertanyaan</b></h4>
                      <div class="row">
                        <div class="form-group col-md-4">
                          <select class="form-control" name="mapel" id="mapelSelect" style="height: 35px;" onchange="ajax_filter_mapel()">
                            <option value="0">-Pilih Matapelajaran-</option>
                          </select>
                        </div>
                        <div class="form-group col-md-4">
                          <select class="form-control" name="tingkat" id="babSelect" style="height: 35px;" onchange="ajax_konsul_all()"><option value=0>-Pilih Bab-</option></select>
                        </div>
                        <div class="form-group col-md-4">
                          <a href="#" class="btn btn-default buat-btn"><i class="fa fa-plus"></i> Buat Pertanyaan</a>
                        </div>
                      </div>
                    </form>

                    <form class="form-group">
                      <h4><b>Pencarian Pertanyaan</b></h4>
                      <div class="row">
                        <div class="form-group col-md-4">
                          <select class="form-control" style="height: 35px;" name="" id="pencarian" >
                            <option value="pertanyaan_ku"  class="center-text">Pertanyaan Saya</option> 
                            <option selected value="pertanyaan_all">Semua Pertanyaan</option>
                            <option value="pertanyaan_grade">Pertanyaan Setingkat</option>
                            <option value="pertanyaan_mentor">Pertanyaan Sementor</option>
                          </select>
                        </div>
                        <div class="form-group col-md-4">
                          <div class="widget">
                        <div class="search-form">
                          <form>
                            <div class="input-group">
                              <input type="text" placeholder="Cari pertanyaanmu disini ..." class="form-control search-input" style="height: 35px;" name="cari" id="search1" onkeyup="ajax_konsul_all()">
                              <span class="input-group-btn">
                              <a onclick="ajax_konsul_all()" class="btn search-button" style="height: 35px;"><i class="fa fa-search"></i></a>
                              </span>
                            </div>
                          </form>
                        </div>
                      </div>
                        </div>
                        <div class="form-group col-md-4">
                          <a href="<?=base_url('konsultasi/pertanyaan_all') ?>" class="btn btn-default"><i class="fa fa-times"></i> Reset</a>
                        </div>
                      </div>
                    </form>
          <!-- END MENU UNTUK SISWA -->

        <?php else: ?>
          <!-- MENU UNTUK GURU -->
          <!-- END MENU UNTUK GURU -->
            <?php endif; ?>
            
             <!-- semua -->
                  <div id="konsulList">

              
                  </div>
                  <!-- / konsulList -->
                  <!-- loader -->
                  <div class="widget loading border-1px p-50" hidden="true">
                    <div class="preloader-whirlpool">
                        <div class="whirlpool"></div>
                    </div>
                  </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script type="text/javascript">
  function showmodal(){
    $('#myModal').modal('show');
  }

</script>
<!-- on keypres cari soal -->
<script type="text/javascript">

  var hakAkses = "<?=$this->session->userdata('HAKAKSES') ?>";

  window.onload = function() {
      page_num=0;
      ajax_konsul_all(page_num);

      $("#search1").keydown(function(event) {
        if (event.keyCode == 13) {
            event.preventDefault();
            // ajax_konsul_all(page_num);
        }
      });

      // event ketika pencarian pertanyaan diklik
      $("#pencarian").change(function() {
          ajax_konsul_all(page_num);
      });
  }

  // fungsi untuk semua pertanyaan
  function ajax_konsul_all(page_num) {
    page_num = page_num?page_num:0;
    keyword = $('#search1').val();
    datas =[];
    id_bab = $('#babSelect').find(":selected").val();
    id_tingpel = $('#mapelSelect').find(":selected").val();
    if (id_bab == 0) {
      datas = { 
        id_tingpel:id_tingpel, 
        id_bab:'all',
        keyword: keyword,
        page: page_num,
        link:'ajax_konsul_all'};
    } else {  
      datas = { 
        id_tingpel:id_tingpel, 
        id_bab:id_bab,
        keyword: keyword,
        page: page_num,
        link:'ajax_konsul_all'};
    }

    pencarian=$('#pencarian').find(":selected").val();
    // cek berdasarkan filter pertanyaan yang diklik
    if (pencarian=="pertanyaan_all") {
      func="ajaxPaginationAll";
    } else if(pencarian=="pertanyaan_ku") {
      func="ajaxPaginationKu";
    } else if (pencarian=="pertanyaan_grade") {
      func="ajaxPaginationGrade";
    } else {
      func="ajaxPaginationMentor";
    }

      $.ajax({
          type: 'POST',
          url: base_url + 'konsultasi/'+func+'/'+page_num,
          data: datas,
          beforeSend: function () {
              $('.loading').show();
          },
          success: function (html) {
              $('#konsulList').html(html);
              $('.loading').hide();
          }
      });

  }

  // fungsi untuk filter ditagline
  function filter(page_num) {
    page_num = page_num?page_num:0;
    keyword = $('#search1').val();
    datas =[];
    id_tingpel = $('input[name=tamp_tingpel]').val();
    id_bab = $('input[name=tamp_bab]').val();
    if (id_bab == 0) {
      datas = { 
        id_tingpel:id_tingpel, 
        id_bab:'all',
        keyword: keyword,
        page: page_num,
        link:'filter'};
    } else {  
      datas = { 
        id_tingpel:id_tingpel, 
        id_bab:id_bab,
        keyword: keyword,
        page: page_num,
        link:'filter'};
    }
    pencarian=$('#pencarian').find(":selected").val();
    // cek berdasarkan filter pertanyaan yang diklik
    if (pencarian=="pertanyaan_all") {
      func="ajaxPaginationAll";
    } else if(pencarian=="pertanyaan_ku") {
      func="ajaxPaginationKu";
    } else if (pencarian=="pertanyaan_grade") {
      func="ajaxPaginationGrade";
    } else {
      func="ajaxPaginationMentor";
    }
      $.ajax({
          type: 'POST',
          url: base_url + 'konsultasi/'+func+'/'+page_num,
          data: datas,
          beforeSend: function () {
              $('.loading').show();
          },
          success: function (html) {
              $('#konsulList').html(html);
              $('.loading').hide();
          }
      });

  } 

  // fungsi untuk filter berdasarkan mapel
  function ajax_filter_mapel(page_num) {
    page_num = page_num?page_num:0;
    keyword = $('#search1').val();
    datas =[];
    id_bab = 0;
    id_tingpel = $('#mapelSelect').find(":selected").val();
      datas = { 
        id_tingpel:id_tingpel, 
        id_bab:'all',
        keyword: keyword,
        page: page_num,
        link:'ajax_konsul_all'};

      $.ajax({
          type: 'POST',
          url: base_url + 'konsultasi/ajaxPaginationAll/'+page_num,
          data: datas,
          beforeSend: function () {
              $('.loading').show();
          },
          success: function (html) {
              $('#konsulList').html(html);
              $('.loading').hide();
          }
      });

  }

  // redirect ke single konsultasi
  function single_konsul(pertanyaanID) {
    url_ajax = base_url+"konsultasi/tamp_single";

    var global_properties = {
      pertanyaanID: pertanyaanID
    };

    $.ajax({
      type: "POST",
      dataType: "JSON",
      url: url_ajax,
      data: global_properties,
      success: function(data){
        window.location.href = base_url + "konsultasi/singlekonsultasi";  
      },error:function(data){
        sweetAlert("Oops...", "wah, gagal menghubungkan!", "error");
      }

    });
  }

</script>