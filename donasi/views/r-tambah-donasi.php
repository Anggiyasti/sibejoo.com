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

<!-- Section: Job Apply Form -->
    <section class="divider">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-md-push-3">

              <div class="border-1px p-30 mb-0">

              <h3 class="text-theme-colored mt-0 pt-5">Daftar Donasi</h3>
              <hr>

                
              
              <form id="job_apply_form" name="job_apply_form"  method="post" enctype="multipart/form-data">

                  
               <div class="row">
                    <div class="form-group col-md-12">
                      <label >Jenis Donasi</label>
                      <select class="form-control" name="donasi" id="donasi">
                      <option>-Pilih Jenis Donasi-</option>
                      </select>
                    </div>
                  </div>
                
                <div class="form-group">
                  <!-- <input name="form_botcheck" class="form-control" type="hidden" value="" /> -->
                  <a onclick="simpan()" class="btn btn-block btn-dark btn-theme-colored btn-sm mt-20 pt-10 pb-10 simpandonasi">Daftar Donasi</a>
                  <!-- <button type="submit" class="btn btn-block btn-dark btn-theme-colored btn-sm mt-20 pt-10 pb-10 simpandonasi" onclick="simpan()">Daftar Donasi</button> -->
                </div>
              </form>
              
            </div>
                         
            <div class="border-1px p-30 mb-0">
              <h3 class="text-theme-colored mt-0 pt-5">Konfirmasi Donasi</h3>
              <hr>

              <form name="job_apply_form" action="<?=base_url()?>index.php/donasi/insertKonfirmasi" method="post" enctype="multipart/form-data">
                <?php echo $this->session->flashdata('msg'); ?> 
                           
                    <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group mb-10">
                    <label for="form_name">Nama Pengirim</label>
                      <input name="namapengirim" class="form-control required" type="text" required="" placeholder="Nama Pengirim" aria-required="true">
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
                      <input name="bukti" class="form-control required" type="file" >
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group mb-10">
                    <label for="form_name">Tanggal Pengirim</label>
                      <input name="tglpengirim" class="form-control required" type="date" placeholder="Tanggal Pengirim" aria-required="true">
                    </div>
                  </div>
                </div>
                
                <div class="form-group">
                  <input name="form_botcheck" class="form-control" type="hidden" value="" />
                  <button type="submit" class="btn btn-block btn-dark btn-theme-colored btn-sm mt-20 pt-10 pb-10 " data-loading-text="Please wait...">Konfirmasi Donasi</button>
                </div>
              </form>
              
            </div>

           
          </div>
        </div>
      </div>
    </section> 

    

    <script type="text/javascript">
      //buat load tingkat
    function loadDonasi() {
      jQuery(document).ready(function () {
        var donasi_id = {"donasi_id": $('#donasi').val()};
        var iddonasi;
        $.ajax({
          type: "POST",
          dataType: "json",
          data: donasi_id,

          url: "<?= base_url() ?>index.php/donasi/getdonasi",

          success: function (data) {

            console.log("Data" + data);

            $('#donasi').html('<option value="">-- Pilih Donasi  --</option>');

            $.each(data, function (i, data) {

              $('#donasi').append("<option value='" + data.id_jenis + "'>" + data.jenis_donasi + "</option>");

              return iddonasi = data.id_jenis;

            });

          }

        });

        $('#donasi').change(function () {
          kategori_id = {"donasi_ids": $('#donasi').val()};

        })

        $('#pelajaran').change(function () {
          pelajaran_id = {"pelajaran_id": $('#pelajaran').val()};
          load_bab($('#pelajaran').val());
        })
        $('#bab').change(function () {
          load_sub_bab($('#bab').val());
        })
      })
    }
    ;
    loadDonasi();


// $('.simpandonasi').click(function(){
  function simpan() {
    
  data = 
  {
    donasi:$('select[name=donasi]').val()
};

  if (data.statusLearning=="kosongundefined" || data.namaTopik=="") {
    swal('Silahkan lengkapi data');
  }else{
    var url = base_url+"donasi/tambah_donasi";
    $.ajax({
      data:data,
      datatType:"text",
      url:url,
      type:"POST",
      success:function(data){
        console.log(data);
        swal('Donasi berhasil ditambahkan');
        $('.form-topik')[0].reset();
        swal({
          title: "Donasi berhasil ditambahkan!",
          text: "No rek",
          text: "Nama Bank",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Selesai",
          cancelButtonText: "Tambah",
          closeOnConfirm: false,
          closeOnCancel: false
        },
        function(isConfirm){
          if (isConfirm) {
            swal("selesai", "Anda akan dialihkan ke daftar topik", "success");
            link = base_url+"donasi/";
            window.location.href = link;
            console.log(link);
          } else {
          // swal("Cancelled", "Your imaginary file is safe :)", "error");
        }
      });
        
      },
      error:function(){
        sweetAlert('Data gagal disimpan','error');
      }
    });
  }

// });
}
function tes() {
  console.log('hello world');
}
    </script>