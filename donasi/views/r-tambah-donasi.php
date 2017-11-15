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

<section class="divider">
  <div class="row">
    <div class="container">
      <div class="col-md-6">
        <div class="border-1px p-20 mb-0">
          <div class="row mb-15 info-status-donasi">

          </div>
          <hr>
          <h3 class="text-theme-colored mt-0 pt-5">Daftar Donasi</h3>
          <form id="donasi_form" name="donasi_form"  action="action="<?=base_url('konsultasi/do_upload') ?> enctype="multipart/form-data" disabled>
           <div class="row">
            <div class="form-group col-md-12">
              <label >Jenis Donasi</label>
              <select class="form-control" name="donasi" id="donasi">
                <option>-Pilih Jenis Donasi-</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <a class="btn btn-block btn-dark btn-theme-colored btn-sm mt-20 pt-10 pb-10 simpandonasi" onclick="simpan()" >Daftar Donasi</a>
           
          </div>
        </form>
      <a class="btn btn-block btn-danger btn-sm mt-20 pt-10 pb-10" onclick="con_remove_donasi()" id="btn_remove">Batal Donasi</a>
      </div>
    </div>

    <div class="col-md-6 noselect">
      <div class="border-1px p-30 mb-0">
        <h3 class="text-theme-colored mt-0 pt-5">Konfirmasi Donasi</h3>
        <hr>

        <form id="konfirmasi_form" name="job_apply_form" action="<?=base_url()?>index.php/donasi/insert_konfirmasi" method="post" enctype="multipart/form-data">
          <?php echo $this->session->flashdata('msg'); ?> 
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group mb-10">
                <label for="form_name">Nama Pengirim</label>
                <input name="namapengirim" class="form-control required" type="text" required>
                <input name="id_donasi" type="hide" >
              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group mb-10">
                <label for="form_name">Bank Pengirim</label>
                <input name="bankpengirim" class="form-control required" type="text" placeholder="Bank Pengirim" aria-required="true">
              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group mb-10">
                <label for="form_name">Bank Penerima</label>
                <input name="bankpenerima" class="form-control required" type="text" placeholder="Bank Penerima" aria-required="true">
              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group mb-10">
                <label for="bukti">Bukti Transfer</label>
                <input name="bukti" class="form-control required" type="file" id="file_bukti_transfer" >
              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group mb-10">
                <label for="form_name">Tanggal Pengiriman</label>
                <input name="tglpengirim" class="form-control required" type="date" placeholder="Tanggal Pengirim" aria-required="true">
              </div>
            </div>
          </div>

          <div class="form-group button-konfirmasi">
            <!-- <input name="form_botcheck" class="form-control" type="hidden" value=""/> -->

          </div>
        </form>

      </div>


    </div>
  </div>
</div>
</section> 

<script type="text/javascript" src="<?= base_url('assets/js/ajaxfileupload.js') ?>"></script>
<script type="text/javascript">
  $(document).ready(function(){
       var stat_donasi;
    loadDonasi();
     load_status_donasi();
     
  });
  function peringatan_belum_daftar(){
    swal("Oops!", "Mohon untuk melakukan pemilihan donasi terlebih dahulu", "warning")
  }

  function peringatan_sudah_donasi(){
    swal("Oops!", "Anda tidak dapat melakukan donasi sebelum melakukan Konfirmasi dan diaktifkan oleh admin!", "warning")
  }


  function loadDonasi() {
    jQuery(document).ready(function () {
      // disable form kalo sudah pernah daftar.
      var donasi_id = {"donasi_id": $('#donasi').val()};
      var iddonasi;

      $.ajax({
        type: "POST",
        dataType: "json",
        data: donasi_id,
        url: "<?= base_url() ?>index.php/donasi/getdonasi",
        success: function (data) {
          $('#donasi').html('<option value="">-- Pilih Donasi  --</option>');
          $.each(data, function (i, data) {
            $('#donasi').append("<option value='" + data.id_jenis + "'>" + data.jenis_donasi + "</option>");
            return iddonasi = data.id_jenis;
          });
        }
      });
    })
  }

  $('#donasi').change(function () {
    kategori_id = {"donasi_ids": $('#donasi').val()};
  });



  function simpan() {
    data =  
    {
      donasi:$('select[name=donasi]').val()
    };

    if (!data.donasi) {
      swal('Silahkan pilih donasi yang akan anda lakukan');
    }else{
      var url = base_url+"donasi/tambah_donasi";
      $.ajax({
        data:data,
        datatType:"text",
        url:url,
        type:"POST",
        success:function(data){
          swal('Donasi berhasil ditambahkan');
          $(".simpandonasi").addClass("hide");
            $("#btn_remove").removeClass("hide");
          // location.reload();
          load_status_donasi();
        },
        error:function(){
          sweetAlert('Data gagal disimpan','error');
        }
      });
    }
  }

  function form_aksi_konfirmasi() {
    var metode =  $('.simpan_konfirmasi').html();

    var data_insert = {
      'namapengirim':$('input[name=namapengirim]').val(),
      'bankpengirim':$('input[name=bankpengirim]').val(),
      'bukti':$('input[name=bukti]').val(),
      'bankpenerima':$('input[name=bankpenerima]').val(),
      'tglpengirim':$('input[name=tglpengirim]').val(),
      'id_donasi':$('input[name=id_donasi]').val()
    };

      //id fileinput
      var elementId = "file_bukti_transfer";
      var id;
      var datas;
      var url;

      // Cek button simpan atau ubah data
      if (metode=='Simpan') {
        datas = data_insert;
        url=base_url+"donasi/insert_konfirmasi";
      } else {
        id = $('[name=id]').val();
        var detail = '.detail-'+id;
        var old_logo=datas.logo;
        datas = data_insert;
        url=base_url+"donaturback/ubah_donatur_co";
      }
   
        $.ajaxFileUpload({
          url:url,
          data:datas,
          dataType:"JSON",
          type:"POST",
          fileElementId :elementId,
          success:function(Data){
            $('.simpan_konfirmasi').html('Simpan');
            swal("Info",Data,"success");
            $('#konfirmasi_form')[0].reset();
          },
          error:function(data){
          }
        });
    
    }

    function cek_stat_kon_donasi(){
     
      var id_donasi = $("input[name=id_donasi]").val();
      if (id_donasi != '' && id_donasi != ' ') {
         $.ajax({
          url:base_url+"donasi/get_stat_kon_donasi",
          data:{id_donasi:id_donasi},  
          dataType:"JSON",
          type:"POST",
          success:function(data_return){
            if (data_return) {
             form_aksi_konfirmasi();
           } else {
             swal('Opss!','Mohon tunggu konfirmasi dari adminn!',"error")
           }
           
         }

       });
      } else {
         swal('Opss!','Mohon tunggu konfirmasi dari adminn!',"error")
      }
   
      
    }
    function load_status_donasi(){
      $(".simpandonasi").off('click');
      $.post(base_url+"donasi/get_info_donasi", function(data, textStatus) {
        if (data.status==1) {
         $(".simpandonasi").addClass("hide");
          konten_button = '<a onclick="cek_stat_kon_donasi()" class="btn btn-block btn-dark btn-theme-colored btn-sm mt-20 pt-10 pb-10 simpan_konfirmasi" data-loading-text="Please wait...">Simpan</a> ';
          $('.info-status-donasi').fadeIn("slow").html(data.message);
         
          $('input[name=id_donasi]').val(data.id_donasi);
          if (data.status_donasi !=4) {
            $("#donasi_form").attr('onclick','peringatan_sudah_donasi()');
            $("#donasi_form a, #donasi_form select").attr('readonly',true);
          }else{
            $(".simpandonasi").off('click');
          }
        }else{
           $("#btn_remove").addClass("hide");
          konten_button = '<span class="btn btn-block btn-dark btn-theme-colored btn-sm mt-20 pt-10 pb-10 " data-loading-text="Please wait..." onclick="peringatan_belum_daftar()">Konfirmasi Donasi</span>';
        }
        $(".button-konfirmasi").fadeIn('slow').html(konten_button);
      }, "json");
    }

    function con_remove_donasi() {
      var id_donasi = $("input[name=id_donasi]").val();
      var url_post = base_url+"donasi/remove_donasi";
      $.ajax({
        url:url_post,
        data:{id_donasi:id_donasi},
        type:"post",
        dataType:"text",
        success:function(data_return){
           $('.info-status-donasi').empty();
           $("input[name=id_donasi]").val(null);
            $("#donasi_form").prop('onclick',null).off('click');
            $("#donasi_form a, #donasi_form select").attr('readonly',false);
            konten_button = '<span class="btn btn-block btn-dark btn-theme-colored btn-sm mt-20 pt-10 pb-10 " data-loading-text="Please wait..." onclick="peringatan_belum_daftar()">Konfirmasi Donasi</span>';
             $(".button-konfirmasi").fadeIn('slow').html(konten_button);
             $(".simpandonasi").removeClass("hide");
             $("#btn_remove").addClass("hide");
        },
        error:function(){

        }
      });

    }

   
  </script>