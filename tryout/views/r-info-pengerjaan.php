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
                    <center>
                      <div class="col-sm-12" style="font-size: 15px;">
                        <label class="control-label">Nama Paket : <?=$paket['nm_paket'];?></label> <br>
                        <label class="control-label">Jumlah Soal : <?=$paket['jumlah_soal'];?></label> <br>
                        <label class="control-label">Durasi  : <?=$paket['durasi'];?> Menit</label>
                      </div>
                    </center>
                  </div>
                  <div class="separator separator-small-line separator-rouned">
                    <i class="fa fa-cog fa-spin"></i>
                  </div>
                  <p class="mt-10"><b>Sebelum Memulai Tes Perhatikan</b></p>
                  <ol>
                    <li>1. Gunakanlah browser terbaru, jika anda belum memperbarui browser anda silahkan untuk memperbaharui di lewat link dibawah ini
                      <b><a target="_blank" href="https://www.google.com/chrome/browser/desktop/index.html">Chrome</a>  |
                        <a target="_blank" href="https://www.mozilla.org/id/firefox/new/">Mozilla</a> |
                        <a target="_blank" href="www.opera.com/id/download">Opera</a> |
                        <a target="_blank" href="https://www.apple.com/id/safari/">Safari</a> |</b>
                      </li>
                      <li>2. Jangan lupa aktifkan <a target="_blank" href="https://www.youtube.com/results?search_query=activated+javascript"><b>javascript</b></a> di browser anda. <li>
                        <li>3. Waktu akan mulai berjalan setelah anda melakukan konfirmasi pada saat menekan tombol 'mulai tryout' </li>
                        <li>4. Jawaban akan tersimpan pada saat anda memilih jawaban</li>
                        <li>5. Jangan Lupa berdoa dan sukses selalu !</li>

                      </ol>                      
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