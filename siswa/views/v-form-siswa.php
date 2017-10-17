  <!-- START Template Main -->
  <section id="main" role="main">
    <!-- START Register Content -->
    <section class="container">
        <div class="row">
            <div class="col-md-11">
                <!-- Siswa form -->
                <form class="panel nm" name="form-register" action="javascript:void(0)" id="form-siswa" method="post">
                    <ul class="list-table pa15">
                        <li>
                            <!-- Alert message -->
                            <div class="alert alert-info nm text-center">
                                <span class="semibold text-center">Catatan :</span>&nbsp;&nbsp;Pastikan data form di isi dengan benar.
                            </div>
                            <!--/ Alert message -->
                        </li>
                        <li class="text-right" style="width:50px;"><a href="javascript:void(0);">Kembali</a></li>
                    </ul>
                    <hr class="nm">

                    <div class="panel-body">
                        <div class="">
                            <p class="text-center">IDENTITAS PENGGUNA</p>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12 control-label">Nama</label>
                            <div class="col-md-6">
                                <div class="has-icon pull-left">
                                    <input type="text" name="idsiswa" hidden="true" value="<?=$siswa['idsiswa'];?>" >
                                    <input type="text" name="namadepan" class="form-control" placeholder="Nama Depan" required="true" value="<?= $siswa['namaDepan'] ?>">
                                    <i class="ico-user2 form-control-icon"></i>
                                    <!-- untuk menampilkan pesan kesalahan penginputan alamat -->
                                    <span class="text-danger"> <?php echo form_error('namadepan'); ?></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="has-icon pull-left">
                                    <input type="text" name="namabelakang" class="form-control" placeholder="Nama Belakang"  value="<?= $siswa['namaBelakang'] ?>">
                                    <i class="ico-user2 form-control-icon"></i>
                                </div>
                         </div>
                     </div> 
                     <div class="col-md-12 form-group">
                        <label class="control-label">Alamat</label>
                        <div class="has-icon pull-left">
                            <textarea class="form-control" placeholder="Alamat" name="alamat" required><?= $siswa['alamat'] ?></textarea>
                            <i class="ico-home10 form-control-icon"></i>
                            <span class="text-danger"> <?php echo form_error('alamat'); ?></span> 
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <label class="control-label">No Kontak</label>
                        <div class="has-icon pull-left">
                            <input type="text" class="form-control" placeholder="No Kontak" name="nokontak" value="<?= $siswa['noKontak'] ?>" data-parsley-required required>
                            <i class="ico-phone3 form-control-icon"></i>
                            <span class="text-danger"> <?php echo form_error('alamat'); ?></span> 
                        </div>
                    </div>
                </div>

                <hr class="nm">

                    <div class="panel-body">
                        <div class="">
                            <p class="text-center">IDENTITAS SEKOLAH</p>
                            <input type="text" id="oldtkt" value="<?=$siswa['tingkatID'];?>" hidden >
                            <input type="text" id="oldkelas" value="<?=$siswa['kelasID'];?>" hidden>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12 control-label">Tingkat</label>
                            <div class="col-md-6">
                                <!-- menampilkan tingkat sekolah untuk memfilter kelas siswa-->
                                <select class="form-control" name="tingkatSiswaID" id="tingkatSekolah"  required>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <select class="form-control" name="tingkatID" id="kelasSiswa"  required>
                                </select>
                         </div>
                     </div> 
                     <div class="col-md-12 form-group">
                        <label class="control-label">Nama Sekolah</label>
                        <div class="has-icon pull-left">
                            <input type="text" placeholder="Nama Sekolah" class="form-control" name="namasekolah" value="<?= $siswa['namaSekolah']?>" data-parsley-required required>
                            <i class="ico-home6 form-control-icon"></i>
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <label class="control-label">Alamat</label>
                        <div class="has-icon pull-left">
                            <textarea placeholder="Alamat Sekolah" class="form-control" name="alamatsekolah"><?=$siswa['alamatSekolah']?></textarea>
                            <i class="ico-home10 form-control-icon"></i>
                        </div>
                    </div>
                </div>

                <div class="panel-footer">
                    <input type="submit" value="Simpan" class="btn btn-block btn-primary" onclick="updateSiswa()">
                </div>

            </form>

            <!-- Register form -->

        </div>

    </div>

</div>

</section>

<!--/ END Register Content -->



<!-- START To Top Scroller -->

<a href="#" class="totop animation" data-toggle="waypoints totop" data-showanim="bounceIn" data-hideanim="bounceOut" data-offset="50%"><i class="ico-angle-up"></i></a>

<!--/ END To Top Scroller -->

</section>

<!--/ END Template Main -->

<!-- ajax dropdown depedensi -->
<script type="text/javascript">
    function enable() {

        if (this.checked) {

         document.getElementById("kirimdata").disabled = false;

         } else {

             document.getElementById("kirimdata").disabled = true;

         }

    }

    document.getElementById("agree").addEventListener("change", enable);
  function loadTingkat() {
  $(document).ready(function () {
    
    var tingkat_id = {"tingkat_id": $('#tingkatSekolah').val()};
    var idTingkat;
    $.ajax({
    type: "POST",
    dataType: "json",
    data: tingkat_id,
    url: "<?= base_url() ?>index.php/siswa/getTingkatSiswa",

    success: function (data) {

      $('#tingkatSekolah').html('<option value="">-- Pilih Tingkat  --</option>');

      $.each(data, function (i, data) {

        $('#tingkatSekolah').append("<option value='" + data.id + "'>" + data.aliasTingkat + "</option>");

        return idTingkat = data.id;

            });

          }

        });
    });
}
  loadTingkat();
  // event
  $(document).ready(function () {
    $('#tingkatSekolah').change(function () {
      tingkat_id = {"tingkat_id": $('#tingkatSekolah').val()};
      loadKelas($('#tingkatSekolah').val());
 
    });
  });

  function loadKelas(tingkatID) {
     $.ajax({
        type: "POST",
        dataType: "json",
        data: tingkatID.tingkat_id,
        url: "<?php echo base_url() ?>index.php/siswa/getKelasSiswa/" + tingkatID,
        success: function (data) {
          $('#kelasSiswa').html('<option value="">-- Pilih Kelas  --</option>');
          $.each(data, function (i, data) {
            $('#kelasSiswa').append("<option value='" + data.id + "'>" + data.aliasTingkat + "</option>");
          });
        }
      });
  }

  function simpanSiswa() {
    url = base_url+"siswa/savesiswa";
    siswa = $('#form_siswa').serialize(); 
    namapengguna = $('input[name=namapengguna]').val();
    pola_username=new RegExp(/^[a-z A-Z 0-9 \_\-]+$/);

    if (!pola_username.test(namapengguna)){
        swal ('Oops','Username hanya boleh Huruf atau Angka!','warning');
    } else {
        $.ajax({
                url:url,
                data:siswa,
                dataType:"TEXT",
                type:"POST",
                success:function(){
                    swal({
                            title: "Siswa berhasil ditambahkan!",
                            type: "warning",
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Selesai",
                            closeOnConfirm: false,
                            closeOnCancel: false
                        },
                        function(isConfirm){
                            if (isConfirm) {
                                window.location.href = base_url+"siswa/listSiswa";
                            } 
                     });
                },
                error:function(){    
                }
        });

    }
  }

  function cekNamaPengguna() {
    var namaPengguna=$('[name=namapengguna]').val();
    if (namaPengguna) {
      var url =base_url + "siswa/cek_nama_pengguna";
      $.ajax({
        dataType:"text",
        data:{namapengguna:namaPengguna},
        type:"POST",
        url:url,
        success:function(data){
          var parData=JSON.parse(data);
          if (parData=="FALSE") {
            $(".msg-namaPengguna").removeClass('hidden');
            $(".fg-nmPengguna").addClass('has-error');
            $(".fg-nmPengguna").removeClass('has-success');
          } else {
             $(".fg-nmPengguna").addClass('has-success');
             $(".fg-nmPengguna").removeClass('has-error');
             $(".msg-namaPengguna").addClass('hidden');
          }
          
        }


      });
    }else{
       $(".fg-nmPengguna").addClass('has-error');
    }
  }

  function cekEmail() {
    var email=$('[name=email]').val();
    if (email) {
      var url =base_url + "siswa/cek_email/";
      $.ajax({
        dataType:"text",
        data:{email:email},
        type:"POST",
        url:url,
        success:function(data){
          var parData=JSON.parse(data);
          if (parData=="FALSE") {
            console.log("das");
            $(".msg-email").removeClass('hidden');
            $(".fg-email").addClass('has-error');
            $(".fg-email").removeClass('has-success');
          } else {
             $(".fg-email").addClass('has-success');
             $(".fg-email").removeClass('has-error');
             $(".msg-email").addClass('hidden');
          }
          
        }


      });
    }else{
       $(".fg-email").addClass('has-error');
    }
  }

  function checkPass() {

        //Store the password field objects into variables ...

        var pass1 = document.getElementById('password');

        var pass2 = document.getElementById('password2');

        //Store the Confimation Message Object ...

        var message = document.getElementById('confirmMessage');

        //Set the colors we will be using ...

        var goodColor = "#66cc66";

        var badColor = "#ff6666";

        var blank = "#fff"

        //Compare the values in the password field

        //and the confirmation field



        if (pass2.value == "") {

            message.style.color = blank;

            message.innerHTML = ""

        } else if (pass1.value == pass2.value) {

            //The passwords match.

            //Set the color to the good color and inform

            //the user that they have entered the correct password

            message.style.color = goodColor;

            message.innerHTML = "Passwords Cocok!"

        } else {

            //The passwords do not match.

            //Set the color to the bad color and

            //notify the user.

            message.style.color = badColor;

            message.innerHTML = "Passwords Tidak Cocok!"

        }

    }
</script>