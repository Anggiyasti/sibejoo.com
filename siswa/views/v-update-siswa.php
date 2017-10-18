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
                        <li class="text-right" style="width:20px;"><a href="javascript:void(0);"><i class="ico-question-sign fsize16"></i></a></li>
                    </ul>
                    <hr class="nm">

                    <div class="panel-body">
                        <div class="">
                            <p class="text-center">IDENTITAS PENGGUNA</p>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12 control-label">Nama Lengkap</label>
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
  function loadTingkat() {
  $(document).ready(function () {
    var oldtkt = $('#oldtkt').val();
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
        if (data.id==oldtkt) {
             $('#tingkatSekolah').append("<option value='" + data.id + "' selected>" + data.aliasTingkat + "</option>"); 
             $('.Keaktivan').removeClass('hide');
             $("#opNeutron").prop("selected",true);
        }else{
            $('#tingkatSekolah').append("<option value='" + data.id + "'>" + data.aliasTingkat + "</option>");
        }
        

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
    // set option dropdown bab
    loadKelas($('#oldtkt').val());
  });

  function loadKelas(tingkatID) {
   
    var kelasID = $('#oldkelas').val();
     $.ajax({
        type: "POST",
        dataType: "json",
        data: tingkatID.tingkat_id,
        url: "<?php echo base_url() ?>index.php/siswa/getKelasSiswa/" + tingkatID,
        success: function (data) {
          $('#kelasSiswa').html('<option value="">-- Pilih Kelas  --</option>');
          $.each(data, function (i, data) {
            if (data.id==kelasID) {
                 $('#kelasSiswa').append("<option value='" + data.id + "' selected>" + data.aliasTingkat + "</option>");
            } else {
                 $('#kelasSiswa').append("<option value='" + data.id + "'>" + data.aliasTingkat + "</option>");
            }
           
          });
        }
      });
  }

  function updateSiswa() {
    url = base_url+"siswa/editSiswa";
    datas = $('#form-siswa').serialize();
    $.ajax({
        url:url,
        data:datas,
        dataType:"TEXT",
        type:"POST",
        success:function(){
            swal({
                    title: "Siswa berhasil diubah!",
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
</script>
