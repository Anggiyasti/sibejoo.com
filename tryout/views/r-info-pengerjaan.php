<section>
      <div class="container mt-30 mb-30 pt-30 pb-30">
        <div class="row">
          <div class="col-md-10 col-md-offset-1">
            <div class="blog-posts">
              <div class="col-md-12">
                <div class="row list-dashed">

                  <article class="post clearfix mb-30 pb-30">
                    <div class="entry-content border-1px p-20 pr-10">
                      <h2 class="text-center pb-30"><b>Selamat Datang di Try Out Online Sibejoo</b></h2>
                        <div class="row">
                          <div class="col-sm-12">
                            <label class="control-label">Nama Paket : <?=$paket['nm_paket'];?></label> <br>
                            <label class="control-label">Jumlah Soal : <?=$paket['jumlah_soal'];?></label> <br>
                            <label class="control-label">Durasi  : <?=$paket['durasi'];?> Menit</label>
                          </div>
                        </div>
                        <hr>
                      <p class="mt-10"><b>Sebelum Memulai Tes Perhatikan</b></p>
                      <p>1. OS Minimal <br>
                      2. Browser <br>
                      3. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                      tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                      quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                      consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                      cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                      proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                      <a class="modal-on" data-todo='<?=json_encode($paket)?>'></a>
                      <a class="col-sm-12 btn btn-colored btn-theme-colored btn-lg font-13 mt-30" onclick="konfirmasi_to()">Mulai Try Out</a> <br>
                      <div class="clearfix"></div>
                    </div>
                  </article>


                </div>
              </div>

          </div>  
        </div>
      </div>
    </section> 

<script type="text/javascript">
  function konfirmasi_to() {
    swal({
      title: "Apakah anda yakin akan mengerjakan Try Out?",
      text: "Anda  tidak dapat kembali",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Ya, Saya Yakin!",
      cancelButtonText: "Tidak!",
      closeOnConfirm: false,
      closeOnCancel: false
    },
    function(isConfirm) {
      if (isConfirm) {
        kerjakan();
      } else {
        swal("Cancelled", "Try Out dibatalkan", "error");
      }
    });
  }

  function kerjakan(){
    var kelas = ".modal-on";
    var data_to = $(kelas).data('todo');
    url = base_url+"index.php/tryout/buatto";

    var datas = {
      id_paket:data_to.id_paket,
      id_tryout:data_to.id_tryout,
      id_mm_tryoutpaket:data_to.mmid
    }

    $.ajax({
      url : url,
      type: "POST",
      data: datas,
      dataType: "TEXT",
      success: function(data)
      {
       window.location.href = base_url + "index.php/tryout/mulaitest";
     },
     error: function (jqXHR, textStatus, errorThrown) {
     }
   });
  }
</script>